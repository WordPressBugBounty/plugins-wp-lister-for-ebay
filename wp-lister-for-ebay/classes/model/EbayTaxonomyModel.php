<?php

/**
 * EbayTaxonomyModel class
 *
 * An interface for eBay's Taxonomy API that's used to get category specifics from eBay
 *
 */

require_once WPLE_PLUGIN_PATH . '/includes/ebay-rest-api/vendor/wplab/guzzle/src/functions_include.php';
require_once WPLE_PLUGIN_PATH . '/includes/ebay-rest-api/vendor/guzzlehttp/guzzle/src/functions_include.php';
//require_once WPLE_PLUGIN_PATH . '/includes/ebay-rest-api/vendor/guzzlehttp/psr7/src/functions_include.php';
//require_once WPLE_PLUGIN_PATH . '/includes/ebay-rest-api/vendor/guzzlehttp/promises/src/functions_include.php';
require_once WPLE_PLUGIN_PATH . '/includes/ebay-rest-api/vendor/autoload.php';

class EbayTaxonomyModel extends WPL_Model {

    private $api_url;

    private $wpl_account;

    /* @var Swagger\Client\Configuration */
    private $api_config;

    public function __construct( $wple_account_id ) {
        $account = WPLE()->accounts[ $wple_account_id ];

        $this->wpl_account  = $account;
        $this->api_url      = $account->sandbox_mode
            ? 'https://api.sandbox.ebay.com/commerce/taxonomy/v1'
            : 'https://api.ebay.com/commerce/taxonomy/v1';

        $this->api_config = Swagger\Client\Configuration::getDefaultConfiguration()
            ->setAccessToken($account->oauth_token)
            ->setHost( $this->api_url );
    }

    /**
     * @param string        $category_id
     * @param string|null   $category_tree_id
     * @return bool|stdClass[]
     */
    public function getItemAspectsForCategory( $category_id, $category_tree_id = null ) {
        WPLE()->logger->debug( 'getItemAspectsForCategory( '. $category_id .', '. $category_tree_id .')' );
        $cache_tree_id = $category_tree_id ? $category_tree_id : 0;
        $cache_key = 'wple_item_aspects_for_category_'. $category_id .'_'. $cache_tree_id;
        WPLE()->logger->debug( 'cache key: '. $cache_key );

        $aspects = get_transient( $cache_key );
//        $aspects = false;

	    // return cached response
	    if ( !empty( $aspects ) && get_option( 'wplister_disable_item_specifics_cache', 0 ) == 0 ) {
		    WPLE()->logger->debug( 'Returning aspects from cache:' . print_r( $aspects, 1 ) );
		    return $aspects;
	    }
		
        try {

            if ( is_null( $category_tree_id ) ) {
                $wpl_site = WPLE_eBaySite::getSite( $this->wpl_account->site_id );
                $category_tree_id = $wpl_site->default_category_tree_id;
                WPLE()->logger->debug( 'category_tree_id from wpl_site: '. $category_tree_id );
            }

            $aspects_url = 'https://update.wplister.com/aspects/?category_tree_id='. $category_tree_id .'&category_id='. $category_id;
            $response = wp_remote_get(
                $aspects_url,
                [
                    'sslverify' => 0,
                    'timeout'   => 600
                ]
            );
            $response_code = (int) wp_remote_retrieve_response_code( $response );
            $body    = wp_remote_retrieve_body( $response );
            $aspects = '';

            // #74289 - tell a failed lookup apart from a category that genuinely has no
            // item specifics. Both used to end up as `false` here, and the caller then
            // wrote an empty specifics list over whatever was stored. The endpoint
            // answers HTTP 200 with a plain error string when its own upstream fails, so
            // the status code alone is not enough: a usable response is 200 AND decodes
            // to a payload that carries an 'aspects' key. A WP_Error also lands here,
            // with an empty response code.
            $response_is_usable = false;

            if ( 200 === $response_code && $body ) {
                $body = json_decode( $body, true );
                if ( is_array( $body ) && array_key_exists( 'aspects', $body ) ) {
                    $response_is_usable = true;
                    if ( !empty( $body['aspects'] ) ) {
                        $aspects = json_decode( $body['aspects'] );
                    }
                }
            }

            // log request to db
            if ( get_option('wplister_log_to_db') == '1' ) {
                $dblogger = new WPL_EbatNs_Logger();
                $dblogger->updateLog( array(
                    'callname'    => 'getItemAspectsForCategory',
                    'request_url' => $aspects_url,
                    'request'     => '',
                    'response'    => print_r($aspects,1),
                    'success'     => $aspects ? 'Success' : ( $response_is_usable ? 'Empty' : 'Failure' )
                ));
            }

            // $response sometimes is null as reported in #53525
            if ( $aspects ) {
                //WPLE()->logger->debug( 'Received aspects from the API: '. print_r( $aspects, 1 ) );
                set_transient( $cache_key, $aspects, 86400 );
                return $aspects;
            }

            // #74289 - the lookup FAILED. Returning false tells the caller to keep the
            // item specifics it already has instead of storing an empty list.
            if ( ! $response_is_usable ) {
                $error_message = sprintf(
                    __('Could not load item specifics for category %1$s (HTTP %2$s). Any item specifics already stored for this category were left unchanged - please try again later.', 'wp-lister-for-ebay'),
                    $category_id,
                    $response_code ? $response_code : '-'
                );
                WPLE()->logger->error( $error_message );
                wple_show_message( $error_message, 'error' );
                return false;
            }

            // the API answered correctly and this category has no item specifics - this
            // is not an error, and an empty array (not false) is stored as before.
            WPLE()->logger->info( 'No item specifics are defined for category '. $category_id );
            return array();


        } catch ( Exception $e ) {
            //WPLE()->logger->error('Error #'. $e->getCode() .': Failed getting Category Aspects. eBay said "'. $e->getMessage() .'".');
            wple_show_message( __('Error #'. $e->getCode() .': Failed getting Category Aspects. eBay said "'. $e->getMessage() .'".' ) );

            // log request to db
            if ( get_option('wplister_log_to_db') == '1' ) {
                $dblogger = new WPL_EbatNs_Logger();
                $dblogger->updateLog( array(
                    'callname'    => 'getItemAspectsForCategory',
                    'request_url' => '',
                    'request'     => maybe_serialize( [$category_id, $category_tree_id] ),
                    'response'    => print_r($e,1),
                    'success'     => 'Failure'
                ));
            }
            return false;
        }

    }

    /**
     * @param string $category_tree_id
     * @return \Swagger\Client\Model\CategoryTree|false
     */
    public function getCategoryTree( $category_tree_id ) {
        WPLE()->logger->info( 'getCategoryTree( '. $category_tree_id .')' );

        $request_url = $this->api_url . '/category_tree/' . $category_tree_id;

        try {
            $api = new \Swagger\Client\Api\CategoryTreeApi(
                new \WPLab\GuzzleHttp\Client(),
                $this->api_config
            );

            $result = $api->getCategoryTree( $category_tree_id );

            if ( get_option( 'wplister_log_to_db' ) == '1' ) {
                $dblogger = new WPL_EbatNs_Logger( false, 'db', $this->wpl_account->id );
                $dblogger->updateLog( [
                    'callname'    => 'getCategoryTree',
                    'request_url' => $request_url,
                    'request'     => '',
                    'response'    => $result ? 'version: ' . $result->getCategoryTreeVersion() : 'null',
                    'success'     => 'Success',
                ] );
            }

            return $result;

        } catch ( Exception $e ) {
            WPLE()->logger->error( 'getCategoryTree() failed: '. $e->getMessage() );

            if ( get_option( 'wplister_log_to_db' ) == '1' ) {
                $dblogger = new WPL_EbatNs_Logger( false, 'db', $this->wpl_account->id );
                $dblogger->updateLog( [
                    'callname'    => 'getCategoryTree',
                    'request_url' => $request_url,
                    'request'     => '',
                    'response'    => $e->getMessage(),
                    'success'     => 'Failure',
                ] );
            }

            return false;
        }
    }

    /**
     * @param string $category_id
     * @param string $category_tree_id
     * @return \Swagger\Client\Model\CategorySubtree|false
     */
    public function getCategorySubtree( $category_id, $category_tree_id ) {
        WPLE()->logger->info( 'getCategorySubtree( '. $category_id .', '. $category_tree_id .')' );

        $request_url = $this->api_url . '/category_tree/' . $category_tree_id . '/get_category_subtree?category_id=' . $category_id;

        try {
            $api = new \Swagger\Client\Api\CategoryTreeApi(
                new \WPLab\GuzzleHttp\Client(),
                $this->api_config
            );

            $result = $api->getCategorySubtree( $category_id, $category_tree_id );

            if ( get_option( 'wplister_log_to_db' ) == '1' ) {
                $dblogger = new WPL_EbatNs_Logger( false, 'db', $this->wpl_account->id );
                $dblogger->updateLog( [
                    'callname'    => 'getCategorySubtree',
                    'request_url' => $request_url,
                    'request'     => '',
                    'response'    => $result ? 'version: ' . $result->getCategoryTreeVersion() : 'null',
                    'success'     => 'Success',
                ] );
            }

            return $result;

        } catch ( Exception $e ) {
            WPLE()->logger->error( 'getCategorySubtree() failed: '. $e->getMessage() );

            if ( get_option( 'wplister_log_to_db' ) == '1' ) {
                $dblogger = new WPL_EbatNs_Logger( false, 'db', $this->wpl_account->id );
                $dblogger->updateLog( [
                    'callname'    => 'getCategorySubtree',
                    'request_url' => $request_url,
                    'request'     => '',
                    'response'    => $e->getMessage(),
                    'success'     => 'Failure',
                ] );
            }

            return false;
        }
    }

}