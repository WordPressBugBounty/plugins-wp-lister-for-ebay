<?php

class WPLE_AdminMessages {

	private $messages       = array();
	private $flash_messages = array();

	// The persistent messages THIS request queued. $messages is loaded from a transient that
	// outlives the request, so it also holds entries from earlier requests. The progress window
	// renders one line per AJAX task (JobRunner.js), and a task must report its own messages -
	// not the ones its predecessors left behind. (#78026)
	private $request_messages = array();

    function __construct() {
        add_action( 'admin_notices', array( &$this, 'show_admin_notices' ), 10 );
        add_action( 'wple_admin_notices', array( &$this, 'show_admin_notices' ), 10 );
        // add_action( 'admin_footer', array( &$this, 'show_admin_notices' ), 10 );
        $this->flash_messages = array();
        $this->messages       = get_transient( 'wple_admin_messages' );

        if ( !$this->messages ) {
            $this->messages = array();
        }
    }

    function add_message( $message, $type = 'info', $params = [] ) {
        // convert old error codes
        if ( $type === 0 ) $type = 'info';
        if ( $type === 1 ) $type = 'error';
        if ( $type === 2 ) $type = 'warn';

        $msg = new stdClass();
        $msg->type    = $type;
        $msg->message = $message;
        $msg->params  = $params;

        if ( empty($msg->params['persistent']) ) {
            $this->flash_messages[] = $msg;
        } else {
            // Persistent messages live in a transient that outlives the request, so the next
            // request queues its copy on top of ours. Bulk actions run ONE AJAX request per
            // listing (_create_bulk_listing_job), so 200 listings hitting the same problem left
            // 200 identical entries in the transient - measured at 89 KB (#77223). Queue each
            // distinct message once; the logfile keeps the complete per listing trace.
            // Already queued - by an earlier task or earlier in this request. Either way this
            // request produced it, so it belongs on this task's line even though the transient
            // keeps only the one copy.
            if ( $this->is_message_queued( $msg ) ) {
                $this->record_request_message( $msg );
                return;
            }

            // Distinct messages still add up, so bound the transient - a bulk action must not be
            // able to grow it without limit. Filterable for support cases that want to see all.
            // The last slot is reserved for the "and N more" line below, so hitting the cap
            // stays visible instead of dropping messages without a trace.
            $max_messages = (int) apply_filters( 'wple_max_persistent_messages', 50 );
            if ( $max_messages < 2 ) $max_messages = 2; // one message plus the "and N more" line

            if ( count( $this->messages ) >= $max_messages - 1 ) {
                $this->count_suppressed_message( $msg, $max_messages );
                return;
            }

            $this->messages[] = $msg;
            $this->record_request_message( $msg );
            set_transient( 'wple_admin_messages', $this->messages );
        }

    } // add_message()


    /**
     * Remember a persistent message as produced by this request. (#78026)
     *
     * Identity first, then type+text: the "and N more" line is one object whose text changes
     * as the counter grows, so comparing text alone would record it twice.
     *
     * @param stdClass $msg the message this request queued, deduplicated against or counted
     */
    private function record_request_message( $msg ) {

        if ( ! is_object( $msg ) ) return;

        foreach ( $this->request_messages as $queued ) {
            if ( $queued === $msg ) return;
            if ( ! is_object( $queued ) ) continue;
            if ( ! isset( $queued->type, $queued->message, $msg->type, $msg->message ) ) continue;

            if ( $queued->type === $msg->type && $queued->message === $msg->message ) return;
        }

        $this->request_messages[] = $msg;

    } // record_request_message()


    /**
     * Is an identical message already queued for display? (#77223)
     *
     * Only persistent messages are checked - flash messages live and die within one request.
     *
     * @param stdClass $msg the message about to be queued
     * @return bool
     */
    private function is_message_queued( $msg ) {

        foreach ( $this->messages as $queued ) {
            if ( ! is_object( $queued ) ) continue;
            if ( ! isset( $queued->type, $queued->message ) ) continue;

            if ( $queued->type === $msg->type && $queued->message === $msg->message ) {
                return true;
            }
        }

        return false;
    } // is_message_queued()


    /**
     * Count a message that the cap kept out - and say so on screen. (#77223)
     *
     * The cap used to return without any signal, so a run with many different problems could
     * hide exactly the message someone needed to see. The counter lives in the last slot of
     * the queue, which keeps the transient bounded and the drop visible.
     *
     * Repeats of an already counted message do not raise the number - otherwise a bulk run
     * with one recurring problem would claim hundreds of separate ones. The list of counted
     * messages is bounded like the queue itself; beyond that a repeat can be counted twice,
     * which is the cheaper mistake at that point.
     *
     * @param stdClass $msg          the message that did not fit
     * @param int      $max_messages the cap in force for this request
     */
    private function count_suppressed_message( $msg, $max_messages ) {

        $hash = md5( $msg->type . '|' . $msg->message );

        foreach ( $this->messages as $key => $queued ) {
            if ( ! is_object( $queued ) ) continue;
            if ( empty( $queued->wple_suppressed_count ) ) continue;

            // The counter line is what carries this message, so it is this request's line too -
            // also when the hash was already counted and nothing below changes. (#78026)
            $this->record_request_message( $queued );

            $counted = isset( $queued->wple_suppressed_hashes ) ? (array) $queued->wple_suppressed_hashes : array();
            if ( in_array( $hash, $counted, true ) ) return;

            if ( count( $counted ) < $max_messages ) $counted[] = $hash;

            $queued->wple_suppressed_hashes = $counted;
            $queued->wple_suppressed_count++;
            $queued->message = $this->get_suppressed_message_text( $queued->wple_suppressed_count );

            $this->messages[ $key ] = $queued;
            set_transient( 'wple_admin_messages', $this->messages );
            return;
        }

        $overflow = new stdClass();
        $overflow->type    = 'warn';
        $overflow->message = $this->get_suppressed_message_text( 1 );
        $overflow->params  = array( 'persistent' => true );
        $overflow->wple_suppressed_count  = 1;
        $overflow->wple_suppressed_hashes = array( $hash );

        $this->messages[] = $overflow;
        $this->record_request_message( $overflow );
        set_transient( 'wple_admin_messages', $this->messages );

    } // count_suppressed_message()


    /**
     * The text of the "and N more" line. (#77223)
     *
     * @param int $count number of messages that were not queued
     * @return string
     */
    private function get_suppressed_message_text( $count ) {

        return sprintf(
            _n(
                '%s more WP-Lister message is not shown here - there were too many for one page. Check the log for details: WooCommerce &rarr; Status &rarr; Logs (source: WPLE).',
                '%s more WP-Lister messages are not shown here - there were too many for one page. Check the log for details: WooCommerce &rarr; Status &rarr; Logs (source: WPLE).',
                $count,
                'wp-lister-for-ebay'
            ),
            number_format_i18n( $count )
        );
    } // get_suppressed_message_text()


    function show_admin_notices() {
        // Don't show ouput when request is done via AJAX or REST
        if ( wple_request_is_ajax() || wple_request_is_rest() ) {
            return;
        }

        // dont output any messages when on SagePay endpoints #13032
        if ( isset( $_POST['cwcontroller'] ) ) {
            return;
        }

        // Track if we have persistent messages to clear
        $had_persistent_messages = !empty( $this->messages );

        // Start with flash messages
        foreach ( $this->flash_messages as $msg ) {
            $this->show_single_message( $msg->message, $msg->type, $msg->params );
        }

        // Display persistent messages
        foreach ( $this->messages as $msg ) {
            $this->show_single_message( $msg->message, $msg->type, $msg->params );
        }

        // clear messages after display
        $this->messages = array();
        $this->flash_messages = array();

        // Only update transient if we actually had persistent messages to clear
        if ( $had_persistent_messages ) {
            set_transient( 'wple_admin_messages', $this->messages );
        }

    } // show_admin_notices()


    // display a single admin notice - the WordPress way
    function show_single_message( $message, $msg_type = 'info', $params = [] ) {
        $params = wp_parse_args( $params, array(
            'dismissible'   => false,
            'persistent'    => false,
        ));


        switch ( $msg_type ) {
            case 'error':
                $class = 'notice error';
                break;
            
            case 'warn':
                $class = 'notice notice-warning';
                break;
            
            case 'info':
                $class = 'notice notice-success';
                break;
            
            default:
                $class = 'notice';
                break;
        }

        $message = apply_filters_deprecated( 'wplister_admin_message_text', array($message), '2.8.4', 'wple_admin_message_text' );
        $message = apply_filters( 'wple_admin_message_text', $message );

        $message_hash = 'wple_notice_'. md5( $message );
        $class .= $params['dismissible'] ? ' is-dismissible' : '';

        // check if this has been dismissed before
        if ( get_option( 'wple_dismissed_'. $message_hash, 0 ) ) {
            // yes, exit without showing anything
            return;
        }

        echo '<div id="message" class="wple-notice '.$class.'" data-msg_id="'. $message_hash .'" style="display:block !important; position: relative;"><p>'.$message.'</p></div>';

    } // show_single_message()




    // create JSON compatible array to display in progress window
    //
    // Only the messages THIS request queued. returnJSON() attaches this to every task answer
    // and JobRunner.js renders response.errors.length on that task's row, so iterating the
    // transient queue made every task report its predecessors' messages as well: three failing
    // images in one job rendered 1 + 2 + 3 lines and a later - possibly successful - task
    // claimed "3 warnings" that were not its own. (#78026)
    function get_admin_notices_for_json_result() {
        $errors = array();

        foreach ( $this->request_messages as $msg ) {
            $errors[] = $this->get_single_message_as_json_error( $msg->message, $msg->type );
        }

        return $errors;
    } // get_admin_notices_for_json_result()

    // get a single admin notice - for progress window
    function get_single_message_as_json_error( $message, $msg_type = 'info' ) {

        switch ( $msg_type ) {
            case 'error':
                $class = 'error';
                $SeverityCode = 'Error';
                break;
            
            case 'warn':
                $class = 'updated update-nag';
                $SeverityCode = 'Warning';
                break;
            
            default:
                $class = 'updated';
                $SeverityCode = 'Note';
                break;
        }

        $message = apply_filters_deprecated( 'wplister_admin_message_text', array($message), '2.8.4', 'wple_admin_message_text' );
        $message = apply_filters( 'wple_admin_message_text', $message );
        $html_message = '<div id="message" class="'.$class.'" style="display:block !important"><p>'.$message.'</p></div>';

        // build error object
        $error = new stdClass();
        $error->SeverityCode = $SeverityCode;
        $error->ErrorCode    = 42;
        $error->ShortMessage = 'Your attention is required.';
        $error->LongMessage  = $message;
        $error->HtmlMessage  = $html_message;

        return $error;
    } // get_single_message_as_json_error()





} // class WPLE_AdminMessages
