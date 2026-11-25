<?php

class EbayController {
    
    var $logger;

    var $signin;
    var $devId;
    var $appId;
    var $certId;
    var $RuName;
    var $siteId;
    var $sandbox;

	var $error_reporting_level;

    var $compLevel;

    /* @var EbatNs_Session */
    public $session;            // ebay session
    /* @var EbatNs_ServiceProxy */
    public $sp;                 // ebay service proxy    
    public $message     = false;    
    public $error       = false;
    public $lastResults = array();
    public $isSuccess   = null;
    public $hasErrors   = null;
    public $hasWarnings = null;

    public function __construct() {

        // set up autoloader for eBay classes
        self::loadEbayClasses();

    }

    public function config() {
    }

    static function loadEbayClasses() {

        // make sure this only runs once
        $autoload_functions = spl_autoload_functions();
        if ( is_array( $autoload_functions ) ) {
            foreach ( $autoload_functions as $func ) {
                // return if WPL_Autoloader already loaded
                if ( is_array($func) && $func[1] == 'autoloadEbayClasses' )
                    return;
            }
        }

        // we want to be patient when talking to ebay
        if( ! ini_get('safe_mode') && function_exists( 'set_time_limit' ) ) {
			set_time_limit(600);
        }

        ini_set( 'mysql.connect_timeout', 600 );
        ini_set( 'default_socket_timeout', 600 );

        // add EbatNs folder to include path - required for SDK
        $incPath = WPLE_PLUGIN_PATH . '/includes/EbatNs';
        set_include_path( get_include_path() . ':' . $incPath );

        // TODO: check if set_include_path() was successfull!

        // use autoloader to load EbatNs classes
        spl_autoload_register('WPL_Autoloader::autoloadEbayClasses');

    } // loadEbayClasses()


    function GetEbaySignInUrl($RuName = null, $Params = null)
    {
        $s = $this->session;
        if ($s->getAppMode() == 0) 
            $url = 'https://signin.' . self::getDomainnameBySiteId( $s->getSiteId() ) . '/ws/eBayISAPI.dll?SignIn';
        else 
            $url = 'https://signin.sandbox.' . self::getDomainnameBySiteId( $s->getSiteId() ) . '/ws/eBayISAPI.dll?SignIn';
        if ($RuName != null)
            $url .= '&runame=' . $RuName;
        if ($Params != null)
            $url .= '&ruparams=' . $Params;
        return $url;
    }
    
    
    // get SessionID and build AuthURL
    public function getAuthUrl(){ 

        // fetch SessionID - valid for about 5 minutes
        $SessionID = $this->GetSessionID( $this->RuName );

        // save SessionID to DB
        update_option('wplister_ebay_sessionid', $SessionID);
        WPLE()->logger->info( 'new SessionID: ' . $SessionID );


        // build auth url
        $query = array( 'RuName' => $this->RuName, 'SessID' => $SessionID );
        $url = $this->GetEbaySignInUrl() . '&' . http_build_query( $query, '', '&' );
        WPLE()->logger->info( 'AuthUrl: ' . $url );

        return $url;
    }

    public static function getOAuthStateString() {
        $url = trailingslashit( get_bloginfo('url'));
        WPLE()->logger->info( 'site url: '. $url);
        WPLE()->logger->info( 'state: '. md5($url));

        return md5( $url );
    }

    public static function getOAuthUrl( $sandbox = false ) {
        $state_code = self::getOAuthStateString();

        $auth_url = 'https://auth.wplister.com/ebay-oauth/?action=auth&state='. $state_code;

        if ( $sandbox ) {
            $auth_url = add_query_arg( 'test', 1, $auth_url );
        }

        return $auth_url;
    }

    public static function getOAuthRefreshToken() {
        WPLE()->logger->info( 'getOAuthRefreshToken' );

        $response = wp_remote_get(
            'https://auth.wplister.com/ebay-oauth/?action=get_refresh_token&key='. self::getOAuthStateString(),
            [
                'sslverify' => false,
                'timeout'   => 30
            ]
        );

        if ( is_wp_error( $response ) ) {
            WPLE()->logger->error( 'Error: '. $response->get_error_message() );
            wple_show_message( 'Error fetching token. Auth Server said '. $response->get_error_message() .'. Please Connect with eBay again.' );
            return false;
        }

        $refresh_token = urldecode(wp_remote_retrieve_body( $response ));

        WPLE()->logger->info('token: '. $refresh_token);

        return $refresh_token;
    }

    public static function getOAuthAccessToken( $refresh_token, $sandbox = false, $mint_token = false ) {
        WPLE()->logger->info('getOAuthAccessToken');
        $sandbox = ($sandbox) ? 1 : 0;
        $action = $mint_token ? 'mint_access_token' : 'get_access_token';
        $response = wp_remote_get(
            'https://auth.wplister.com/ebay-oauth/?action='.$action.'&key='. urlencode( $refresh_token ) .'&test='. $sandbox,
            array(
                'sslverify' => false,
                'timeout'   => 15
            )
        );
        $body = json_decode( wp_remote_retrieve_body( $response ) );

        // log request to db
        if ( get_option('wplister_log_to_db') == '1' ) {
            $dblogger = new WPL_EbatNs_Logger();
            $dblogger->updateLog( array(
                'callname'    => 'getOAuthAccessToken',
                'request_url' => '/ebay-oauth/',
                'request'     => 'action='.$action.'&key='. urlencode( $refresh_token ) .'&test='. $sandbox,
                'response'    => print_r($body,1),
                'success'     => wp_remote_retrieve_response_code( $response ) == 200 ? 'Success' : 'Failure'
            ));
        }

        if ( is_wp_error( $response ) ) {
            WPLE()->logger->error( 'getOauthAccessToken error: '. $response->get_error_message() );
            wple_show_message( 'Error fetching token. Auth Server said '. $response->get_error_message() .'. Please Connect with eBay again.', 'error' );
            return false;
        } elseif ( wp_remote_retrieve_response_code( $response ) != 200 ) {
            WPLE()->logger->error( 'Error HTTP('.wp_remote_retrieve_response_code( $response ).'): '. print_r($body,1) );

            if ( is_object($body) && isset( $body->errorMessage ) ) {
                $error = $body->errorMessage->error[0]->longMessage;
                $message = 'Error fetching token. eBay said "'. $error .'". Please try Connect with eBay again.';
            } else {
                $message = 'Error fetching token. Auth Server said '. $body->error_description .'. Please Connect with eBay again.';
            }

            wple_show_message( $message, 'error' );
            return false;
        }

        WPLE()->logger->debug( 'getOAuthAccessToken body: '. print_r($body,1) );
        return $body;
    }
 
    // do FetchToken and save to DB
    public function doFetchToken( $account_id = false ){ 
        
        // $account_id = $account_id ? $account_id : get_option('wplister_default_account_id'); // we can *not* fall back to the default account here, or adding a new account would overwrite the default account's token
        $SessionID  = get_option('wplister_ebay_sessionid');        
        $token      = $this->FetchToken( $SessionID );

        if ($token) {

            if ( $account_id ) {
                $account = new WPLE_eBayAccount( $account_id );
                $account->token = $token;
                $account->update();
            }

            // check if setup wizard is still active
            if ( get_option( 'wplister_setup_next_step' ) == 1 ) {

                // update legacy data
                update_option('wplister_ebay_token', $token);

                // move setup to step 2
                update_option('wplister_setup_next_step', '2');                

                // remember when WP-Lister was connected to an eBay account for the first time
                update_option( 'wplister_ignore_orders_before_ts', time() );
            }

            // // obsolete - already called in fetchTokenForAccount()
            // update_option('wplister_ebay_token_is_invalid', false );

        }
        
        return $token;
    }
 
    // do getTokenExpirationTime and save to DB (deprecated)
    public function getTokenExpirationTime( $site_id, $sandbox_enabled ){ 

        $token = get_option('wplister_ebay_token');
        $expdate = $this->fetchTokenExpirationTime( $token );

        // update legacy option (1.x)
        update_option('wplister_ebay_token_expirationtime', $expdate);
        
        return $expdate;
    }
 
    // establish connection to eBay API
    public function initEbay( $site_id, $sandbox_enabled, $token = false, $oauth_token = false, $account_id = false ){

        // init autoloader fro EbatNs classes
        $this->loadEbayClasses();

        WPLE()->logger->info("initEbay( $account_id )");
        // require_once 'EbatNs_ServiceProxy.php';
        // require_once 'EbatNs_Logger.php';

        // hide inevitable cURL warnings from SDK 
        // *** DISABLE FOR DEBUGGING ***
        $this->error_reporting_level = error_reporting();
        WPLE()->logger->debug( 'original error reporting level: '.$this->error_reporting_level );

        // // regard php_error_handling option
        // // first bit (1) will show all php errors if set
        // if ( 1 & get_option( 'wplister_php_error_handling', 0 ) ) {
        //     error_reporting( E_ALL | E_STRICT );            
        // } else {
        //     // only show fatal errors (default)
        //     error_reporting( E_ERROR );            
        // }
        error_reporting( E_ERROR );            
        WPLE()->logger->debug( 'new error reporting level: '.error_reporting() );

        $this->siteId = $site_id;
        $this->sandbox = $sandbox_enabled;
        #$this->compLevel = 765;

        if ( $sandbox_enabled ) {
            
            // sandbox keys
            $this->devId  = 'db0c17b6-c357-4a38-aa60-7e80158f57dc';
            $this->appId  = 'LWSWerbu-c159-4552-8411-1406ca5a2bba';
            $this->certId = '33272b6e-ef02-4d22-a487-a1a3f02b9c66';
            $this->RuName = 'LWS_Werbung_Gmb-LWSWerbu-c159-4-tchfyrowj';

            $this->signin = 'https://signin.sandbox.ebay.com/ws/eBayISAPI.dll?SignIn&';

        } else {

            // production keys
            $instance_key = str_replace( array('http://','https://','www.'), '', get_site_url() ); // example.com
            $admin_email  = wple_get_license_email();
            $this->appId  = urlencode( $instance_key );
            $this->devId  = $admin_email   ? $admin_email : get_option( 'admin_email' );
            $this->certId = WPLE_IS_LITE_VERSION ? 'LITE'       : wple_get_license_key();
            $this->RuName = 'LWS_Werbung_Gmb-LWSWerbu-6147-4-ywstl';

            $this->signin = 'https://signin.ebay.com/ws/eBayISAPI.dll?SignIn&';
        }

        // filter RuName
        if ( defined('WPLISTER_RESELLER_VERSION') ) {
            $this->RuName = apply_filters_deprecated( 'wplister_runame', array($this->RuName, $sandbox_enabled), '2.8.4', 'wple_runame' );
            $this->RuName = apply_filters( 'wple_runame', $this->RuName, $sandbox_enabled );
        }

        // init session
        $session = new EbatNs_Session();

        // depends on the site working on (needs ID-Value !)
        $session->setSiteId($site_id);
        $session->wple_account_id = $account_id;

        // regard WP proxy server
        if ( defined('WP_USEPROXY') && WP_USEPROXY ) {
            if ( defined('WP_PROXY_HOST') && defined('WP_PROXY_PORT') )
                $session->setProxyServer( WP_PROXY_HOST . ':' . WP_PROXY_PORT );
        }

        // environment (0=production, 1=sandbox)
        if ( $sandbox_enabled == '1' ) {
            WPLE()->logger->info('initEbay(): SANDBOX ENABLED');
            $session->setAppMode(1);    // this must be set *before* setting the keys (appId, devId, ...)
        } else {
            $session->setAppMode(0);    
        }

        $session->setAppId($this->appId);
        $session->setDevId($this->devId);
        $session->setCertId($this->certId);

        if ( $oauth_token ) {
            $session->setAuthType(EBAY_AUTHTYPE_OAUTH);

            // use a token as credential
            $session->setTokenMode(2);

            // do NOT use a token file !
            $session->setTokenUsePickupFile(false);

            // token of the user
            $session->setRequestToken($oauth_token);
        } elseif ( $token ) {
            
            // use a token as credential
            $session->setTokenMode(true);

            // do NOT use a token file !
            $session->setTokenUsePickupFile(false);

            // token of the user
            $session->setRequestToken($token);

        } else {
            $session->setTokenMode(false);
        }

        // prevent Undefined index: UseStandardLogger
        $session->setUseStandardLogger(false);

        // creating a proxy for UTF8
        $sp = new EbatNs_ServiceProxy($session, 'EbatNs_DataConverterUtf8');

        // // logger doc: http://www.intradesys.com/de/forum/1528
        // if ( get_option('wplister_log_level') > 5 ) {
        //     #$sp->attachLogger( new EbatNs_Logger(false, 'stdout', true, false) );
        //     $sp->attachLogger( new EbatNs_Logger(false, WPLE()->logger->file ) );
        // }

        // attach custom DB Logger for Tools page
        if ( isset($_REQUEST['page']) && $_REQUEST['page'] == 'wplister-tools' ) {
            $sp->attachLogger( new WPL_EbatNs_Logger( false, 'db', $account_id, $site_id ) );
        }
        
        // save service proxy - and session
        $this->sp = $sp;
        $this->session = $session;

    }

    // re-attach logger - required to log multiple requests in the same session
    public function initLogger(){ 
        $this->sp->attachLogger( new WPL_EbatNs_Logger( false, 'db', $this->session->wple_account_id, $this->siteId ) );
    }

    // close connection to eBay API
    public function closeEbay(){ 
        // restore error reporting level 
        error_reporting( $this->error_reporting_level );
        // WPLE()->logger->info( 'switched back error reporting level to: '.error_reporting() );
    }
 

    // get SessionID for Auth&Auth
    public function GetSessionID( $RuName ){ 

        // prepare request
        $req = new GetSessionIDRequestType();
        $req->setRuName($RuName);
        
        // send request
        $res = $this->sp->GetSessionID($req);

        // handle errors like blocked ips
        if ( $res->Ack != 'Success' ) {
            echo "<h1>Problem connecting to eBay</h1>";
            echo "<p>WP-Lister can't seem to establish a connection to eBay's servers. This could be caused by a firewall blocking cURL from accessing unkown ip addresses.</p>";
            echo "<p>Only your hosting company can sort out the problems causing cURL not to connect properly. Your hosting company's server administrator should be able to resolve the permission problems preventing cURL from working. They've probably got overly limiting restrictions configured on the server, preventing it from being able to do the communication required for listing items on eBay.</p>";
            echo "<p>debug output:</p>";
            echo "<pre>"; print_r($res); echo "</pre>";
            echo "<pre>"; print_r($req); echo "</pre>";
            die();
        }

        // TODO: handle error        
        return ( $res->SessionID );
        
    }
    public function FetchToken( $SessionID ){ 

        // prepare request
        $req = new FetchTokenRequestType();
        $req->setSessionID($SessionID);
        
        // send request
        $res = $this->sp->FetchToken($req);

        // TODO: handle error
        if ( ! $res->eBayAuthToken ) {
            echo "<pre>Error in FetchToken(): ";print_r($res);echo"</pre>";
            return false;
        }

        return ( urldecode( $res->eBayAuthToken ) );
    }

    public function fetchTokenExpirationTime( $SessionID ){ 

        // prepare request
        $req = new GetTokenStatusRequestType();
        $req->setSessionID($SessionID);
        
        // send request
        $res = $this->sp->GetTokenStatus($req);

        // TODO: handle error        
        return ( $res->ExpirationTime );
        
    }

    // ajax: initialize categories update
    // returns: tasklist
    public function initCategoriesUpdate( $site_id ){ 
        $cm = new EbayCategoriesModel();
        return $cm->initCategoriesUpdate( $this->session, $site_id );
    }
    // ajax: load single branch of ebay categories
    // returns: result
    public function loadEbayCategoriesBranch( $cat_id, $site_id ){ 
        $cm = new EbayCategoriesModel();
        return $cm->loadEbayCategoriesBranch( $cat_id, $this->session, $site_id );
    }

    // load Store categories list and insert to db
    public function loadStoreCategories( $account_id ) { 
        $cm = new EbayCategoriesModel();
        $cm->downloadStoreCategories( $this->session, $account_id );
    }

	public function loadHazardousMaterialsLabels( $account_id ) {
		$account = WPLE()->accounts[$account_id];
		$marketplace = new EbayMarketplaceApi( $account_id );
		$labels = $marketplace->getHazardousMaterialsLabels();

		$data = [
			'signal_words'  => [],
			'statements'    => [],
			'pictograms'    => []
		];
		if ( $labels ) {
			foreach ( $labels->getSignalWords() as $signal_word ) {
				$data['signal_words'][] = [
					'signal_word_id'            => $signal_word->getSignalWordId(),
					'signal_word_description'   => $signal_word->getSignalWordDescription()
				];
			}

			foreach ( $labels->getStatements() as $statement ) {
				$data['statements'][] = [
					'statement_id'          => $statement->getStatementId(),
					'statement_description' => $statement->getStatementDescription()
				];
			}

			foreach ( $labels->getPictograms() as $pictogram ) {
				$data['pictograms'][] = [
					'pictogram_id'          => $pictogram->getPictogramId(),
					'pictogram_description' => $pictogram->getPictogramDescription(),
					'pictogram_url'         => $pictogram->getPictogramUrl()
				];
			}
		}

		$Site = new WPLE_eBaySite( $account->site_id );
		$Site->HazardousMaterialsLabels = serialize( $data );
		$Site->update();
	}

	public function loadProductSafetyLabels( $account_id ) {
		$account = WPLE()->accounts[$account_id];
		$marketplace = new EbayMarketplaceApi( $account_id );
		$labels = $marketplace->getProductSafetyLabels();

		$data = [
			'statements'    => [],
			'pictograms'    => []
		];
		if ( $labels ) {
			foreach ( $labels->getStatements() as $statement ) {
				$data['statements'][] = [
					'statement_id'          => $statement->getStatementId(),
					'statement_description' => $statement->getStatementDescription()
				];
			}

			foreach ( $labels->getPictograms() as $pictogram ) {
				$data['pictograms'][] = [
					'pictogram_id'          => $pictogram->getPictogramId(),
					'pictogram_description' => $pictogram->getPictogramDescription(),
					'pictogram_url'         => $pictogram->getPictogramUrl()
				];
			}
		}

		$Site = new WPLE_eBaySite( $account->site_id );
		$Site->ProductSafetyLabels = serialize( $data );
		$Site->update();
	}

    // load shipping services and insert to db
    public function loadShippingServices( $site_id ){ 
        $sm = new EbayShippingModel();
        $sm->downloadCountryDetails( $this->session, $site_id );
        $sm->downloadShippingLocations( $this->session, $site_id );
        $sm->downloadShippingDetails( $this->session, $site_id );
        $sm->downloadDispatchTimes( $this->session, $site_id );      
        $sm->downloadShippingPackages( $this->session, $site_id );      
        $sm->downloadExcludeShippingLocations( $this->session, $site_id );
        $sm->fetchDoesNotApplyText( $this->session, $site_id );
        $sm->downloadShippingDiscountProfiles( $this->session );
    }

    public function getCountryDetails( $site_id ) {
        $sm = new EbayShippingModel();
        $sm->downloadCountryDetails( $this->session, $site_id );
    }

    public function getShippingLocations( $site_id ) {
        $sm = new EbayShippingModel();
        $sm->downloadShippingLocations( $this->session, $site_id );
    }

    public function getShippingDetails( $site_id ) {
        $sm = new EbayShippingModel();
        $sm->downloadShippingDetails( $this->session, $site_id );
    }

    public function getDispatchTimes( $site_id ) {
        $sm = new EbayShippingModel();
        $sm->downloadDispatchTimes( $this->session, $site_id );
    }

    public function getShippingPackages( $site_id ) {
        $sm = new EbayShippingModel();
        $sm->downloadShippingPackages( $this->session, $site_id );
    }

    public function getExcludeShippingLocations( $site_id ) {
        $sm = new EbayShippingModel();
        $sm->downloadExcludeShippingLocations( $this->session, $site_id );
    }

    public function getDoesNotApplyText( $site_id ) {
        $sm = new EbayShippingModel();
        $sm->fetchDoesNotApplyText( $this->session, $site_id );
    }

    // load shipping services and insert to db
    public function loadPaymentOptions( $site_id ){ 
        $sm = new EbayPaymentModel();
        $sm->downloadPaymentDetails( $this->session, $site_id );      
        $sm->downloadMinimumStartPrices( $this->session, $site_id );      
        $sm->downloadReturnPolicyDetails( $this->session, $site_id );      

        // set date of last update for site
        $Site = new WPLE_eBaySite( $site_id );
        $Site->last_refresh = gmdate('Y-m-d H:i:s');
        $Site->update();
    }

    public function getPaymentDetails( $site_id ) {
        $sm = new EbayPaymentModel();
        $sm->downloadPaymentDetails( $this->session, $site_id );
    }

    public function getMinimumStartPrices( $site_id ) {
        $sm = new EbayPaymentModel();
        $sm->downloadMinimumStartPrices( $this->session, $site_id );
    }

    public function getReturnPolicyDetails( $site_id ) {
        $sm = new EbayPaymentModel();
        $sm->downloadReturnPolicyDetails( $this->session, $site_id );

        // set date of last update for site
        $Site = new WPLE_eBaySite( $site_id );
        $Site->last_refresh = gmdate('Y-m-d H:i:s');
        $Site->update();
    }

    // load user / account specific details from eBay
    public function loadUserAccountDetails() { 

        // update user details
        $this->initLogger();
        $this->GetUser();
        $this->initLogger();
        $this->GetUserPreferences();

        // Store the discount profiles in the ebay_accounts table
        $sm = new EbayShippingModel();
        $discount_profiles = $sm->downloadShippingDiscountProfiles( $this->session );

        if ( $discount_profiles ) {
            $am = new WPLE_eBayAccount();
            $am->id = $this->session->wple_account_id;
            $am->shipping_discount_profiles = maybe_serialize( $discount_profiles );
            $am->update();
        }
    }

    // load available dispatch times
    public function loadDispatchTimes(){ 
        $sm = new EbayShippingModel();
        return $sm->downloadDispatchTimes( $this->session );      
    }
    
    // load available shipping packages
    public function loadShippingPackages(){ 
        $sm = new EbayShippingModel();
        return $sm->downloadShippingPackages( $this->session );      
    }

    // load available shipping discount profiles
    public function loadShippingDiscountProfiles(){ 
        $sm = new EbayShippingModel();
        return $sm->downloadShippingDiscountProfiles( $this->session );      
    }


    // update ebay orders (deprecated)
    public function loadEbayOrders( $days = null ){ 
        $m = new EbayOrdersModel();
        $m->updateOrders( $this->session, $days );
        return $m;
    }
    // update ebay orders (new)
    public function updateEbayOrders( $days = false, $order_ids = false ){ 
        $m = new EbayOrdersModel();
        $m->updateOrders( $this->session, $days, 1, $order_ids );
        return $m;
    }

    /**
     * Look for and update active orders that are passed that LastOrderDate value
     */
    public function updateActiveOrders(){
        $m = new EbayOrdersModel();
        $m->updateActiveOrders( $this->session );
        return $m;
    }

    // update ebay messages
    public function updateEbayMessages( $days = false, $message_ids = false ){ 

        if ( ! get_option( 'wplister_enable_messages_page' ) ) return;
        $m = new EbayMessagesModel();
        $m->updateMessages( $this->session, $days, 1, $message_ids );
        if ( $message_ids ) return $m;

        // automatically fetch message body for up to 10 messages
        $message_ids_to_update = EbayMessagesModel::getMessageIDsToFetch( $this->session->wple_account_id );
        if ( ! empty($message_ids_to_update) ) {
            $m->updateMessages( $this->session, $days, 1, $message_ids_to_update );
        }

        return $m;
    }

    // update listings
    // - process auto relist schedule (must run BEFORE updateEndedListings to prevent rescheduling items that are due)
    // - update ended listings
    public function updateListings(){
        // Process scheduled relists FIRST, before updateEndedListings reschedules them
        $this->processAutoRelistSchedule();

        $lm = new ListingsModel();
        $lm->updateEndedListings( $this->session );
    }

    // process listings scheduled for auto relist
    public function processAutoRelistSchedule(){
    }

    // get category conditions
    public function getCategoryConditions( $category_id, $site_id = false ) { 
        if ( ! $site_id ) $site_id = $this->siteId;

        //$account = WPLE
        $cm = new EbayCategoriesModel();
        // always update conditions before specifics
        $conditions = $cm->fetchCategoryConditions( $this->session, $category_id, $site_id );
        //$specifics  = $cm->fetchCategorySpecifics(  $this->session, $category_id, $site_id );
        return $conditions;
    }

    // get category specifics
    public function getCategorySpecifics( $category_id, $site_id = false ) { 
        if ( ! $site_id ) $site_id = $this->siteId;
        $cm = new EbayCategoriesModel();
        // always update conditions before specifics
        $conditions = $cm->fetchCategoryConditions( $this->session, $category_id, $site_id );
        $specifics  = $cm->fetchCategorySpecifics(  $this->session, $category_id, $site_id );
        return $specifics;
    }



    // process $this->lastResults and look for errors and/or warnings
    public function processLastResults(){ 
        WPLE()->logger->debug('processLastResults()'.print_r( $this->lastResults, 1 ));

        // Filter out the empty values/arrays to prevent WPLister from displaying false error messages #16980
        $results = array_filter( $this->lastResults );

        $this->isSuccess = true;
        $this->hasErrors = false;
        $this->hasWarnings = false;

        foreach ($results as $result) {
            if ( ! $result->success ) $this->isSuccess = false;
        }

    }



    // call verifyAddItem on selected items
    public function verifyItems( $id ){ 
        WPLE()->logger->info('EC::verifyItems('.$id.')');
        
        $sm = new ListingsModel();

        if ( is_array( $id )) {
            foreach( $id as $single_id ) {
                $this->lastResults[] = $sm->verifyAddItem( $single_id, $this->session );   
            }
            $this->processLastResults();
        } else {
            $this->lastResults[] = $sm->verifyAddItem( $id, $this->session );          
            $this->processLastResults();
            return $this->lastResults;
        }
        
    }

    // call ReviseItem on selected items
    public function reviseItems( $id ){ 
        
        $sm = new ListingsModel();

        if ( is_array( $id )) {
            foreach( $id as $single_id ) {
                $this->lastResults[] = $sm->reviseItem( $single_id, $this->session );  
            }
            $this->processLastResults();
        } else {
            $this->lastResults[] = $sm->reviseItem( $id, $this->session );         
            $this->processLastResults();
        }
        return $this->lastResults;
    }

    // call ReviseInventoryStatus on selected cart items
    public function reviseInventoryForCartItems( $cart_items ){ 
        
        $sm = new ListingsModel();
        if ( ! is_array( $cart_items ) ) return;
        
        foreach( $cart_items as $item ) {
            $this->lastResults[] = $sm->reviseInventoryStatus( $item->listing_id, $this->session, $item );  
        }
        
        $this->processLastResults();
    }

    // call ReviseInventoryStatus for given listing ID
    // (called from 'wplister_revise_inventory_status' api hook)
    public function reviseInventoryForListing( $listing_id, $force = false ){

        $lm = new ListingsModel();
        $this->lastResults[] = $lm->reviseInventoryStatus( $listing_id, $this->session, false, $force );
       
        $this->processLastResults();
    } // reviseInventoryForListing()


    // // call ReviseInventoryStatus on selected products - DEPRECATED: use reviseInventoryForListing() instead
    // // Note: if $product_ids is an array containing multiple IDs, all items need to use the same account,
    // //       which is why this method is currently only called with a single $post_id as a parameter
    // // (previously called from 'wplister_revise_inventory_status' api hook - using only a single $post_id at a time)
    // public function reviseInventoryForProducts( $product_ids ){ 

    //     if ( ! is_array( $product_ids ) && ! is_numeric( $product_ids ) ) return; 
    //     if ( ! is_array( $product_ids ) ) $product_ids = array( $product_ids );
        
    //     $lm = new ListingsModel();
    //     foreach( $product_ids as $post_id ) {
    //         $listing_id = WPLE_ListingQueryHelper::getListingIDFromPostID( $post_id );

    //         // if no listing found, check parent_id for variations
    //         if ( ! $listing_id ) {
    //             $_product = ProductWrapper::getProduct( $post_id );
    //             if ( ! $_product ) continue;

    //             if ( wple_get_product_meta( $_product, 'product_type' ) == 'variation' ) {
    //                 $parent_id = is_callable( array( $_product, 'get_parent_id' ) ) ? $_product->get_parent_id() : $_product->parent->id;
    //                 $listing_id = WPLE_ListingQueryHelper::getListingIDFromPostID( $parent_id );
    //             }
    //         }

    //         // check if API is allowed to relist ended items (deprecated option)
    //         if ( get_option( 'wplister_api_enable_auto_relist' ) ) {

    //             // check listing status - only ended and sold items can be relisted
    //             $allowed_statuses = array( 'ended', 'sold' );
    //             if ( $lm->itemHasAllowedStatus( $listing_id, $allowed_statuses ) ) {

    //                 // ok, we have an ended item - check if it's in stock
    //                 $listing_item = ListingsModel::getItem( $listing_id );
    //                 if ( ListingsModel::checkStockLevel( $listing_item ) ) {

    //                     // let's relist
    //                     $this->lastResults[] = $lm->relistItem( $listing_id, $this->session );  
    //                     continue;

    //                 } // is in stock

    //             } // is ended

    //         } // if API relist enabled

    //         // revise inventory status (default)
    //         $this->lastResults[] = $lm->reviseInventoryStatus( $listing_id, $this->session, false );  

    //     } // each $post_id
        
    //     $this->processLastResults();
    // } // reviseInventoryForProducts()

    // call AddItem on selected items
    public function sendItemsToEbay( $id ){ 
        
        $sm = new ListingsModel();

        if ( is_array( $id )) {
            foreach( $id as $single_id ) {
                $this->lastResults[] = $sm->addItem( $single_id, $this->session ); 
            }
            $this->processLastResults();
        } else {
            $this->lastResults[] = $sm->addItem( $id, $this->session );            
            $this->processLastResults();
            return $this->lastResults;
        }
        
    }

    // call EddItem on selected items
    public function endItemsOnEbay( $id ){
        
        $sm = new ListingsModel();

        if ( is_array( $id )) {
            foreach( $id as $single_id ) {
                $this->lastResults[] = $sm->endItem( $single_id, $this->session ); 
            }
            $this->processLastResults();
        } else {
            $this->lastResults[] = $sm->endItem( $id, $this->session );            
            $this->processLastResults();
            return $this->lastResults;
        }
        
    }

    // call relistItem on selected items
    public function relistItems( $id ){ 
        WPLE()->logger->info('EC::relistItems('.$id.')');
        
        $sm = new ListingsModel();

        if ( is_array( $id )) {
            foreach( $id as $single_id ) {
                $this->lastResults[] = $sm->relistItem( $single_id, $this->session );   
            }
            $this->processLastResults();
        } else {
            $this->lastResults[] = $sm->relistItem( $id, $this->session );          
            $this->processLastResults();
            return $this->lastResults;
        }
        
    }


    // call autoRelistItem on selected items - quick relist without any changes
    public function autoRelistItems( $id ){
        WPLE()->logger->info('EC::autoRelistItems('.( is_array($id) ? count($id).' items' : $id ).')');

        $sm = new ListingsModel();

        if ( is_array( $id )) {
            foreach( $id as $single_id ) {
                $this->lastResults[] = $sm->autoRelistItem( $single_id, $this->session );   
            }
            $this->processLastResults();
        } else {
            $this->lastResults[] = $sm->autoRelistItem( $id, $this->session );          
            $this->processLastResults();
            return $this->lastResults;
        }
        
    }


    // call GetItemDetails on selected items
    public function updateItemsFromEbay( $id ){ 
        
        $sm = new ListingsModel();

        if ( is_array( $id )) {
            foreach( $id as $single_id ) {
                $this->lastResults[] = $sm->updateItemDetails( $single_id, $this->session );   
            }
            $this->processLastResults();
        } else {
            $this->lastResults[] = $sm->updateItemDetails( $id, $this->session );          
            $this->processLastResults();
            return $this->lastResults;
        }
        
    }


    // delete selected items
    public function deleteProfiles( $id ){ 
        
        $sm = new ProfilesModel();

        if ( is_array( $id )) {
            foreach( $id as $single_id ) {
                $sm->deleteItem( $single_id );  
            }
        } else {
            $sm->deleteItem( $id );         
        }
        
    }

    // delete selected items
    public function deleteTransactions( $id ){ 
        
        $sm = new TransactionsModel();

        if ( is_array( $id )) {
            foreach( $id as $single_id ) {
                $sm->deleteItem( $single_id );  
            }
        } else {
            $sm->deleteItem( $id );         
        }
        
    }


    // call verifyAddItem on all prepared items
    public function verifyAllPreparedItems(){   

        $items = WPLE_ListingQueryHelper::getAllPrepared();
        
        foreach( $items as $item ) {
            $sm->verifyAddItem( $item['id'], $this->session );  
        }
        
    }

    // call AddItem on all verified items
    public function publishAllVerifiedItems(){  

        $items = WPLE_ListingQueryHelper::getAllVerified();
        
        foreach( $items as $item ) {
            $sm->addItem( $item['id'], $this->session );    
        }
        
    }

    // call reviseItem on all changed items
    public function reviseAllChangedItems(){   

        $items = WPLE_ListingQueryHelper::getAllChangedItemsToRevise( null, true );
        $sm = new ListingsModel();

        foreach( $items as $item ) {
            $sm->reviseItem( $item['id'], $this->session );  
        }
        
    }


    // call updateSingleTransaction on selected transactions
    public function updateTransactionsFromEbay( $id ){ 
        
        $sm = new TransactionsModel();

        if ( is_array( $id )) {
            foreach( $id as $single_id ) {
                $sm->updateSingleTransaction( $this->session, $single_id );   
            }
        } else {
            $sm->updateSingleTransaction( $this->session, $id );          
        }
        
    }


    // GetNotificationPreferences
    public function GetNotificationPreferences(){ 
        $req = new GetNotificationPreferencesRequestType();
        
        // 1st request for user prefs
        $req->setPreferenceLevel('User');
        $res = $this->sp->GetNotificationPreferences($req);

        // 2nd request for user data
        $this->initLogger();
        $req->setPreferenceLevel('UserData');
        $res2 = $this->sp->GetNotificationPreferences($req);

        // 3rd request for app data
        $this->initLogger();
        $req->setPreferenceLevel('Application');
        $res3 = $this->sp->GetNotificationPreferences($req);

        // 4th request for event data (always empty?)
        $this->initLogger();
        $req->setPreferenceLevel('Event');
        $res4 = $this->sp->GetNotificationPreferences($req);

        // handle result
        return ( print_r( $res, 1 ) . print_r( $res2, 1 ) . print_r( $res3, 1 ) . print_r( $res4, 1 ) );
    }

    // SetNotificationPreferences for User
    // inspired by http://jolierouge.net/2011/05/spree-commerce-ebay-trading-api-and-the-ebay-accelerator-toolkit-from-intradesys-ebatns/
    public function SetUserNotificationPreferences( $mode = 'Enable' ){ 
        // $app_url = admin_url().'admin-ajax.php?action=handle_ebay_notify';

        // build request
        $req = new SetNotificationPreferencesRequestType();

        // // set UserData
        // $UserData = new NotificationUserDataType();
        // $UserData->setExternalUserData( admin_url() );
        // $req->setUserData( $UserData );

        // set UserDeliveryPreferenceArray
        $UserDeliveryPreferenceArray = new NotificationEnableArrayType();
        $NotificationEnable          = array();
        $mode                        = $mode == 'Enable' ? $mode : 'Disable';

        // subscribe to events
        $events = array(
            'ItemSold',
            'ItemClosed',
            'ItemListed',
            'ItemRevised',
            'BidReceived',
            'EndOfAuction',
            'FeedbackReceived',
            'FixedPriceTransaction',
        );

        foreach ( $events as $event ) {
            $n = new NotificationEnableType();
            $n->setEventType( $event );
            $n->setEventEnable( $mode ); // Enable / Disable
            $NotificationEnable[] = $n;
        }

        $UserDeliveryPreferenceArray->setNotificationEnable( $NotificationEnable, null );
        $req->setUserDeliveryPreferenceArray( $UserDeliveryPreferenceArray );

        // send request
        $res = $this->sp->SetNotificationPreferences($req);


        // send second request with ExternalUserData
        // https://ebaydts.com/eBayKBDetails?KBid=2042

        // build request
        $req = new SetNotificationPreferencesRequestType();

        // set ApplicationDeliveryPreferences (without this, eBay ignores UserData container)
        $req->ApplicationDeliveryPreferences = new ApplicationDeliveryPreferencesType();
        $req->ApplicationDeliveryPreferences->setApplicationEnable('Enable');

        // set UserData
        $UserData = new NotificationUserDataType();
        $UserData->setExternalUserData( admin_url() );
        $req->setUserData( $UserData );

        // send request
        $this->initLogger();
        $res2 = $this->sp->SetNotificationPreferences($req);


        // handle result
        return ( print_r( $res, 1 ) . print_r( $res2, 1 ) );        
    } // SetUserNotificationPreferences()


    // reset NotificationPreferences for Application
    public function ResetNotificationPreferences(){ 

        // reset application prefs to default
        $req = new SetNotificationPreferencesRequestType();
        $req->ApplicationDeliveryPreferences = new ApplicationDeliveryPreferencesType();
        $req->ApplicationDeliveryPreferences->setAlertEmail('mailto://info@wplab.com');
        $req->ApplicationDeliveryPreferences->setAlertEnable('Enable');
        $req->ApplicationDeliveryPreferences->setApplicationEnable('Enable');
        $req->ApplicationDeliveryPreferences->setApplicationURL( 'http://ping.wplister.com/?key=wple_notify_handler' );
        $req->ApplicationDeliveryPreferences->setPayloadVersion( 1045 );

        // // disabled
        // $details = new DeliveryURLDetailType();
        // $details->setDeliveryURLName('wple_notify_handler');
        // $details->setDeliveryURL('mailto://info@wplab.com');
        // $details->setStatus('Disable');
        // $req->ApplicationDeliveryPreferences->setDeliveryURLDetails($details,null);

        // set UserData (if omitted here, ExternalUserData will be removed)
        $UserData = new NotificationUserDataType();
        $UserData->setExternalUserData( admin_url() );
        $req->setUserData( $UserData );

        // send request
        $res = $this->sp->SetNotificationPreferences($req);
        // echo "<pre>";print_r($req);echo"</pre>";

        // handle result
        return ( print_r( $res, 1 ) );
    } // ResetNotificationPreferences()


    // GetNotificationsUsage
    public function GetNotificationsUsage(){ 

        $EndTime   = gmdate('Y-m-d\TH:i:s').'.000Z';                        // now
        $StartTime = gmdate('Y-m-d\TH:i:s', strtotime('-2 days') ).'.000Z'; // 2 days ago (3 days max)
       
        // send request
        $req = new GetNotificationsUsageRequestType();
        $req->setEndTime( $EndTime );
        $req->setStartTime( $StartTime );
        // $req->setItemID( $ebay_id ); // get detailed events for single item
        $res = $this->sp->GetNotificationsUsage($req);

        // handle result
        return ( print_r( $res, 1 ) );
    }




    // GetUserPreferences
    public function GetUserPreferences( $return_result = false ){ 

        // prepare request
        $req = new GetUserPreferencesRequestType();
        $req->setShowSellerProfilePreferences( 'true' );
        $req->setShowOutOfStockControlPreference( 'true' );
        $req->setShoweBayPLUSPreference( 'true' );
        // $req->setShowSellerExcludeShipToLocationPreference( true );

        // send request
        $res = $this->sp->GetUserPreferences($req);
        // echo "<pre>";print_r($res);echo"</pre>";#die();

        // handle response error
        if ( !$res || 'EbatNs_ResponseError' == get_class( $res ) )
            return false;

        $result = new stdClass();
        $result->success                  = true;
        $result->seller_shipping_profiles = array();
        $result->seller_payment_profiles  = array();
        $result->seller_return_profiles   = array();

        $result->SellerProfileOptedIn     = $res->SellerProfilePreferences->SellerProfileOptedIn ?? false;
        $result->OutOfStockControl        = $res->OutOfStockControlPreference;

        // $profiles = $res->getSellerProfilePreferences()->getSupportedSellerProfiles()->getSupportedSellerProfile(); // can trigger Fatal Error: Call to a member function getSupportedSellerProfiles() on a non-object
        // echo "<pre>";print_r($profiles);echo"</pre>";#die();

        // if ( $result->SellerProfileOptedIn ) {
	    if ( is_array($res->SellerProfilePreferences->SupportedSellerProfiles->SupportedSellerProfile) ) {
		    foreach ( $res->SellerProfilePreferences->SupportedSellerProfiles->SupportedSellerProfile as $profile ) {
			    $seller_profile = new stdClass();
			    $seller_profile->ProfileID    = $profile->ProfileID;
			    $seller_profile->ProfileName  = $profile->ProfileName;
			    $seller_profile->ProfileType  = $profile->ProfileType;
			    $seller_profile->ShortSummary = $profile->ShortSummary;

			    switch ( $profile->ProfileType ) {
				    case 'SHIPPING':
					    $result->seller_shipping_profiles[] = $seller_profile;
					    break;

				    case 'PAYMENT':
					    $result->seller_payment_profiles[] = $seller_profile;
					    break;

				    case 'RETURN_POLICY':
					    $result->seller_return_profiles[] = $seller_profile;
					    break;
			    }
		    }

		    if ( $return_result ) return $result;

		    update_option('wplister_ebay_seller_shipping_profiles', $result->seller_shipping_profiles, false);
		    update_option('wplister_ebay_seller_payment_profiles', $result->seller_payment_profiles, false);
		    update_option('wplister_ebay_seller_return_profiles', $result->seller_return_profiles, false);
	    } else {
		    if ( $return_result ) return $result;
		    delete_option( 'wplister_ebay_seller_shipping_profiles' );
		    delete_option( 'wplister_ebay_seller_payment_profiles' );
		    delete_option( 'wplister_ebay_seller_return_profiles' );
	    }

        if ( $return_result ) return $result;
        update_option('wplister_ebay_seller_profiles_enabled', $result->SellerProfileOptedIn ? 'yes' : 'no' );
        delete_option( 'wplister_ebay_seller_profiles' );

    }



    // GetUser
    public function GetUser( $return_result = false ){ 

        // prepare request
        $req = new GetUserRequestType();
        
        // send request
        $res = $this->sp->GetUser($req);

        if ( $res instanceof EbatNs_ResponseError ) {
            $errors = '';
            foreach ( $res->Errors as $error ) {
                $errors .= '<p>'. $error->LongMessage .'</p>';
            }

            if ( $errors ) wple_show_message( $errors, 'error' );

            return false;
        } else {
            $user = new stdClass();
            $user->UserID              = $res->User->UserID;
            $user->Email               = $res->User->Email;
            $user->FeedbackScore       = $res->User->FeedbackScore;
            $user->FeedbackRatingStar  = $res->User->FeedbackRatingStar;
            $user->NewUser             = $res->User->NewUser;
            $user->IDVerified          = $res->User->IDVerified;
            $user->eBayGoodStanding    = $res->User->eBayGoodStanding;
            $user->Status              = $res->User->Status;
            $user->Site                = $res->User->Site;
            $user->VATStatus           = $res->User->VATStatus;
            $user->PayPalAccountLevel  = $res->User->PayPalAccountLevel;
            $user->PayPalAccountType   = $res->User->PayPalAccountType;
            $user->PayPalAccountStatus = $res->User->PayPalAccountStatus;

            $user->StoreOwner          = $res->User->SellerInfo->StoreOwner;
            $user->StoreURL            = $res->User->SellerInfo->StoreURL;
            $user->SellerBusinessType  = $res->User->SellerInfo->SellerBusinessType;
            $user->ExpressEligible     = $res->User->SellerInfo->ExpressEligible;
            $user->StoreSite           = $res->User->SellerInfo->StoreSite;

            if ( $return_result ) return $user;

            $UserID = $res->User->UserID;
            update_option('wplister_ebay_token_userid', $UserID);
            update_option('wplister_ebay_user', $user);

            return ( $UserID );
        }

    }

    // GetTokenStatus
    public function GetTokenStatus( $return_result = false ){ 

        // prepare request
        $req = new GetTokenStatusRequestType();
        
        // send request
        $res = $this->sp->GetTokenStatus($req);

        // Say why it failed, in eBay's own words. Without this the caller only gets an
        // empty date and the UI has nothing to offer but "check the log" - which is off
        // unless the customer turned it on.
        //
        // Two failure shapes have to be covered, and neither may be tested with isset():
        // EbatNs_SimpleType declares __get() but no __isset(), so isset( $res->Ack ) is
        // false even when $res->Ack is 'Failure'. Measured against a live account, not
        // assumed. The shapes are:
        //   - a transport or parse failure, which arrives as EbatNs_ResponseError and
        //     usually carries no Errors at all
        //   - an application failure, which arrives as an ordinary response with
        //     Ack=Failure and populated Errors. This is what the button actually hits:
        //     error 16112 "Invalid authentication method" on every OAuth account.
        // Testing only instanceof - the way GetUser() does it - would miss the second
        // one, which is the case this ticket is about. (#77127)
        $ack = $res->Ack;

        if ( ( $res instanceof EbatNs_ResponseError ) || ( $ack && ! in_array( $ack, array( 'Success', 'Warning' ) ) ) ) {

            $errors    = '';
            $error_set = $res->Errors;
            if ( is_array( $error_set ) ) {
                foreach ( $error_set as $error ) {
                    $errors .= '<p>'. $error->LongMessage .'</p>';
                }
            }

            // WPLE()->logger, not $this->logger: the class declares a $logger property but
            // never assigns it, so $this->logger->error() is a fatal. Every one of the 52
            // other log calls in this file goes through WPLE()->logger. (#77127)
            WPLE()->logger->error( 'GetTokenStatus failed: ' . ( $errors ? wp_strip_all_tags( $errors ) : 'eBay returned no error message (Ack=' . var_export( $ack, true ) . ')' ) );

            if ( $errors ) wple_show_message( $errors, 'error' );

            return false;
        }

        $expdate = $res->TokenStatus->ExpirationTime;

        if ( $expdate ) {

            $expdate = str_replace('T', ' ', $expdate);
            $expdate = str_replace('.000Z', '', $expdate);

            if ( $return_result ) return $expdate;

            update_option( 'wplister_ebay_token_expirationtime', $expdate );
            update_option( 'wplister_ebay_token_is_invalid', false );

        }

        // handle result
        return ( $expdate );
        
    }

    // GetApiAccessRules
    public function GetApiAccessRules(){ 
        $req = new GetApiAccessRulesRequestType();
        $res = $this->sp->GetApiAccessRules($req);
        return ( $res );       
    }

    // test connection to ebay api by single GetTokenStatus request
    // (used by import plugin until version 1.3.8)
    public function testConnection(){
	    $this->initEC();
	    $res = $this->EC->GetTokenStatus();
	    $this->EC->closeEbay();
        
		/*$req = new GeteBayOfficialTimeRequestType();
        $res = $this->sp->GeteBayOfficialTime($req);*/
        return $res;
    }
     
    // get current time on ebay
    public function getEbayTime(){ 
	    // prepare request
        $req = new GeteBayOfficialTimeRequestType();
        
        // send request
        $res = $this->sp->GeteBayOfficialTime($req);

        // process timestamp
        if ( $res->Ack == 'Success' ) {
            $ts = $res->Timestamp;              // 2013-06-06T07:45:19.898Z
            $ts = str_replace('T', ' ', $ts);   // 2013-06-06 07:45:19.898Z
            $ts = substr( $ts, 0, 19 );         // 2013-06-06 07:45:19
            return $ts;
        }

        // return result on error
        return ( $res );
        
    }

	public function getNTPTime() {
	    // Define NTP server and port
	    $server = 'time.google.com';
	    $port = 123;

	    // Create a 48-byte NTP packet
	    $packet = "\010" . str_repeat("\0", 47);

	    // Open a UDP connection to the NTP server
	    $socket = @fsockopen("udp://$server", $port, $err_no, $err_str, 1);

	    if ($socket) {
	        // Send the packet to the NTP server
	        fwrite($socket, $packet);

	        // Read the response (48 bytes)
	        $response = fread($socket, 48);
	        fclose($socket);

	        // Process the NTP response to extract the timestamp
	        if (strlen($response) == 48) {
	            $unpack = unpack('N12', $response);
	            $timestamp = sprintf('%u', $unpack[9]);

	            // Convert NTP timestamp to Unix epoch
	            $ntp_time = $timestamp - 2208988800;
	            return gmdate("Y-m-d H:i:s", $ntp_time);
	        } else {
				return false;
			}
		} else {
			return false;
		}
	}


// call Shopping API to fetch matching products
    public function callFindProducts( $query, $account_id = null ) {
        // $query = "test";

        //$api_url = $this->sandbox ? 'https://open.api.sandbox.ebay.com/shopping' : 'https://open.api.ebay.com/shopping';
	    $api_url = $this->sandbox ? 'https://sandbox.api.ebay.com/buy/browse/v1/item_summary/search' : 'https://api.ebay.com/buy/browse/v1/item_summary/search';
        $api_id  = $this->appId;
		$params = [
			'q'     => urlencode( $query ),
		];
        /*$params = array(
            'callname'           => 'FindProducts',
            'responseencoding'   => 'JSON',
            'appid'              => $api_id,
            'siteid'             => $this->siteId,
            // 'version'            => '885',
            'version'            => '789',
            'QueryKeywords'      => urlencode( $query ),
            'AvailableItemsOnly' => 'true',
            'MaxEntries'         => '2',
        );*/
        $request_url = add_query_arg( $params, $api_url );

		if ( is_null( $account_id ) ) {
			$account_id = get_option( 'wplister_default_account_id' );
		}

        if (! isset( WPLE()->accounts[ $account_id ] ) ) {
            return [];
        }

		WPLE_eBayAccount::maybeMintToken( $account_id );

        $account = WPLE()->accounts[$account_id];
		$site = WPLE_eBaySite::getSite( $account->site_id );
        
        // call API
        $response = wp_remote_get( $request_url, ['headers' => [
			'Authorization' => 'Bearer '. $account->oauth_token,
	        'X-EBAY-C-MARKETPLACE-ID' => $site->code
        ] ] );

        // skip further processing if an error was returned
        if ( is_wp_error( $response ) ) return $response;

        // decode result
        $result = json_decode( wp_remote_retrieve_body( $response ) );

        // check if result was decoded
        if ( ! is_object( $result ) || $result->total == 0  ) {
			return 'Unable to parse FindProducts result for query '.$query;
        }

        // return products array
        $products = $result->itemSummaries;

        return $products;
    } // callFindProducts()

    // get site code by site_id
    static public function getEbaySiteCode( $site_id ) {
        $sites = self::getEbaySites();
        if ( ! array_key_exists( $site_id, $sites) ) return false;
        return $sites[ $site_id ];        
    } // getEbaySiteCode()

    // TODO: fetch ebaySites from eBay
    static public function getEbaySites() {

        $sites = array (        
            '0'   => 'US', 
            '2'   => 'Canada', 
            '3'   => 'UK', 
            '77'  => 'Germany', 
            '15'  => 'Australia', 
            '71'  => 'France', 
            '100' => 'eBayMotors', 
            '101' => 'Italy', 
            '146' => 'Netherlands', 
            '186' => 'Spain', 
            '203' => 'India', 
            '201' => 'HongKong', 
            '216' => 'Singapore', 
            '207' => 'Malaysia', 
            '211' => 'Philippines', 
            '210' => 'CanadaFrench', 
            '212' => 'Poland', 
            '123' => 'Belgium_Dutch', 
            '23'  => 'Belgium_French', 
            '16'  => 'Austria', 
            '193' => 'Switzerland', 
            '205' => 'Ireland'
        );
        return $sites;
    }

    // get domain name by site_id
    static function getDomainnameBySiteId($siteid = 0)
    {
        switch ($siteid) {
            case 0:
                return 'ebay.com';
            case 2:
                return 'ebay.ca';
            case 3:
                return 'ebay.co.uk';
            case 15:
                return 'ebay.com.au';
            case 16:
                return 'ebay.at';
            case 23:
                return 'befr.ebay.be';
            case 71:
                return 'ebay.fr';
            case 77:
                return 'ebay.de';
            case 100:
                // return 'ebaymotors.com'; # doesnt work anymore
                return 'ebay.com';
            case 101:
                return 'ebay.it';
            case 123:
                return 'benl.ebay.be';
            case 146:
                return 'ebay.nl';
            case 186:
                return 'ebay.es';
            case 193:
                return 'ebay.ch';
            case 196:
                return 'ebay.tw';
            case 201:
                return 'ebay.com.hk';
            case 203:
                return 'ebay.in';
            case 205:
                return 'ebay.ie';
            case 207:
                return 'ebay.com.my';
            case 211:
                return 'ebay.ph';
            case 212:
                return 'ebay.pl';
            case 216:
                return 'ebay.com.sg';
            case 218:
                return 'ebay.se';
            case 223:
                return 'ebay.cn';
        }
        return 'ebay.com';

    } // getDomainnameBySiteId()

	/**
	 * Uploads a picture to eBay Picture Services (EPS) and returns a Trading-shaped
	 * response, no matter which transport actually did the work.
	 *
	 * eBay retires the Trading API's UploadSiteHostedPictures call on 2026-09-30, so
	 * the Media API (commerce/media/v1_beta) is now the default transport - see
	 * uploadToEPSViaMediaApi(). The old Trading transport is kept fully intact and
	 * reachable behind a filter/option (see below) so a rollback is possible without
	 * shipping a release, in case the new adapter needs to be pulled quickly.
	 *
	 * All 12 existing callers keep working unchanged either way: this always
	 * returns either a WP_Error (failure) or an object exposing
	 * ->SiteHostedPictureDetails->FullURL and ->SiteHostedPictureDetails->UseByDate
	 * (success), exactly like the original Trading-only implementation did.
	 *
	 * @param $url
	 * @param $session
	 *
	 * @return object|WP_Error
	 */
	public function uploadToEPS( $url, $session ) {
		$use_legacy_trading_api = apply_filters(
			'wple_eps_use_legacy_trading_api',
			get_option( 'wplister_eps_use_legacy_trading_api', false )
		);

		if ( $use_legacy_trading_api ) {
			return $this->uploadToEPSViaTradingApi( $url, $session );
		}

		return $this->uploadToEPSViaMediaApi( $url, $session );
	}

	/**
	 * Legacy transport: eBay Trading API UploadSiteHostedPictures, via
	 * callUploadSiteHostedPictures() further below. eBay is retiring this call on
	 * 2026-09-30 - kept only as a rollback path, see uploadToEPS().
	 *
	 * This is the original body of uploadToEPS() before the Media API adapter was
	 * added; behaviour is unchanged except that the final "handle response, build
	 * error" step now lives in the shared finishEpsUpload() (see there for the
	 * error-handling mitfix).
	 *
	 * @param $url
	 * @param $session
	 *
	 * @return object|WP_Error
	 */
	private function uploadToEPSViaTradingApi( $url, $session ) {
		$req = new UploadSiteHostedPicturesRequestType();
		// $req->setExternalPictureURL( $url );
		$req->setPictureSet( 'Supersize' );

		// switch EPS transfer mode - according to settings
		$eps_xfer_mode = get_option( 'wplister_eps_xfer_mode', 'passive' );
		if ( $eps_xfer_mode == 'active' ) {
			$picture_data = null;

			// try to load image data from filesystem first
			$upload_dir = wp_upload_dir();

			// Fix the URL
			$ib = new ItemBuilderModel();
			$url = $ib->normalizeUrl( $url, true );

			$local_path = str_replace( $upload_dir['baseurl'], $upload_dir['basedir'], $url );

			// #77835 - the caller hands us a percent-encoded URL: uploadPictureToEPS()
			// rawurlencode()s the basename and turns remaining spaces into %20, so the derived
			// path does not exist on disk for any filename with accents or spaces and we fall
			// back to wp_remote_get() for a file we are sitting on. Try the literal path first
			// so a file really named "pre%20encoded.jpg" keeps working, then the decoded one.
			if ( ! file_exists( $local_path ) ) {
				$decoded_path = rawurldecode( $local_path );
				if ( $decoded_path !== $local_path && file_exists( $decoded_path ) ) {
					$local_path = $decoded_path;
				}
			}

			if ( file_exists( $local_path ) && is_readable( $local_path ) ) {
				$picture_data = file_get_contents( $local_path );
				WPLE()->logger->info( "loaded ".strlen($picture_data)." bytes from local file: ".$local_path );
			}

			// if image data is empty, load from URL
			if ( empty( $picture_data ) ) {
				// $picture_data = file_get_contents($url);
				$response = wp_remote_get( $url );

				if ( ! is_wp_error( $response ) && wp_remote_retrieve_response_code( $response ) == 200 ) {
					$picture_data = wp_remote_retrieve_body( $response );
					WPLE()->logger->info( "loaded ".strlen($picture_data)." bytes from URL: ".$url );
				} elseif ( is_wp_error( $response ) ) {
					$details  = 'wp_remote_get() failed to connect to ' . $url . '<br>';
					$details .= 'Error:' . ' ' . $response->get_error_message() . '<br>';
					wple_show_message( 'Connection to '.$url.' failed: '.$details, 'error' );
					WPLE()->logger->info( 'Connection to '.$url.' failed: '.$details );
				} else {
					$details  = 'wp_remote_get() returned an unexpected HTTP status code: ' . wp_remote_retrieve_response_code( $response );
					wple_show_message( 'Connection to '.$url.' failed: '.$details, 'error' );
					WPLE()->logger->info( 'Connection to '.$url.' failed: '.$details );
					WPLE()->logger->info( "reponse object: ".print_r($response,1) );
				}

			}

			// if image data is STILL empty, show error message to the user
			if ( empty( $picture_data ) ) {
				WPLE()->logger->error( "Could not load image data for URL: ".$url );
				//wple_show_message("There was a problem loading the product image from $url. Please make sure this image URL is accessible or disable the <i>Upload to EPS</i> option in your listing profile.",'error');
				return new WP_Error( 400, "There was a problem loading the product image from $url. Please make sure this image URL is accessible or disable the <i>Upload to EPS</i> option in your listing profile.");
			}

			$req->setPictureName( basename($url) );
			$req->setPictureData( $picture_data );
			WPLE()->logger->info( "EPS mode: active - filesize: ".strlen($picture_data) );
		} else {
			$req->setExternalPictureURL( $url );
		}


		WPLE()->logger->info( "calling UploadSiteHostedPictures - $url " );
		$res = $this->callUploadSiteHostedPictures($req, $session );
		WPLE()->logger->info( "UploadSiteHostedPictures Complete" );
		WPLE()->logger->debug( "Response: ".print_r($res,1) );

		return $this->finishEpsUpload( $res, $url );
	}

	/**
	 * New transport: eBay Media API (commerce/media/v1_beta), replacing the retired
	 * Trading UploadSiteHostedPictures call. Uses EbayMediaApi (classes/helper/
	 * EbayMediaApi.php), the same OAuth-bearer/Guzzle transport already shipping
	 * since Nov 2024 for GPSR document uploads - just pointed at the Image resource
	 * instead of the Document resource.
	 *
	 * Mode mapping (same 'wplister_eps_xfer_mode' option, same two modes as before):
	 *   - passive -> POST /image/create_image_from_url  (EbayMediaApi::createImageFromUrl())
	 *   - active  -> POST /image/create_image_from_file (EbayMediaApi::createImageFromFile())
	 *
	 * create_image_from_url requires an HTTPS source URL (eBay rejects http://
	 * outright). If passive mode is configured but the URL is not HTTPS, this falls
	 * back to the file-upload (active) path automatically instead of failing the
	 * upload outright - the plugin already has all the machinery to load the
	 * picture bytes for active mode, so there is no reason to hard-fail a fixable
	 * case. This is a deliberate choice, documented here: it mirrors the *intent*
	 * (though not the mechanism - there is no separate retry pass) of the 4.x
	 * uploadToEPSWithFallback() auto-retry, which does not exist on this branch.
	 *
	 * @param $url
	 * @param $session
	 *
	 * @return object|WP_Error
	 */
	private function uploadToEPSViaMediaApi( $url, $session ) {
		$account_id    = $session->wple_account_id;
		$eps_xfer_mode = get_option( 'wplister_eps_xfer_mode', 'passive' );

		$media_api = new EbayMediaApi( $account_id );

		// active mode, or passive mode with a non-HTTPS URL (Media API requires HTTPS
		// for create_image_from_url) - load picture bytes and upload them directly
		if ( $eps_xfer_mode == 'active' || stripos( $url, 'https://' ) !== 0 ) {

			if ( $eps_xfer_mode != 'active' ) {
				WPLE()->logger->info( "EPS media API: passive mode requires an HTTPS source URL, falling back to active (file) mode for: ".$url );
			}

			$picture_data = null;

			// try to load image data from filesystem first
			$upload_dir = wp_upload_dir();

			// Fix the URL
			$ib = new ItemBuilderModel();
			$url = $ib->normalizeUrl( $url, true );

			$local_path = str_replace( $upload_dir['baseurl'], $upload_dir['basedir'], $url );

			// #77835 - the caller hands us a percent-encoded URL: uploadPictureToEPS()
			// rawurlencode()s the basename and turns remaining spaces into %20, so the derived
			// path does not exist on disk for any filename with accents or spaces and we fall
			// back to wp_remote_get() for a file we are sitting on. Try the literal path first
			// so a file really named "pre%20encoded.jpg" keeps working, then the decoded one.
			if ( ! file_exists( $local_path ) ) {
				$decoded_path = rawurldecode( $local_path );
				if ( $decoded_path !== $local_path && file_exists( $decoded_path ) ) {
					$local_path = $decoded_path;
				}
			}

			if ( file_exists( $local_path ) && is_readable( $local_path ) ) {
				$picture_data = file_get_contents( $local_path );
				WPLE()->logger->info( "loaded ".strlen($picture_data)." bytes from local file: ".$local_path );
			}

			// if image data is empty, load from URL
			if ( empty( $picture_data ) ) {
				$response = wp_remote_get( $url );

				if ( ! is_wp_error( $response ) && wp_remote_retrieve_response_code( $response ) == 200 ) {
					$picture_data = wp_remote_retrieve_body( $response );
					WPLE()->logger->info( "loaded ".strlen($picture_data)." bytes from URL: ".$url );
				} elseif ( is_wp_error( $response ) ) {
					$details  = 'wp_remote_get() failed to connect to ' . $url . '<br>';
					$details .= 'Error:' . ' ' . $response->get_error_message() . '<br>';
					wple_show_message( 'Connection to '.$url.' failed: '.$details, 'error' );
					WPLE()->logger->info( 'Connection to '.$url.' failed: '.$details );
				} else {
					$details  = 'wp_remote_get() returned an unexpected HTTP status code: ' . wp_remote_retrieve_response_code( $response );
					wple_show_message( 'Connection to '.$url.' failed: '.$details, 'error' );
					WPLE()->logger->info( 'Connection to '.$url.' failed: '.$details );
					WPLE()->logger->info( "reponse object: ".print_r($response,1) );
				}
			}

			// if image data is STILL empty, show error message to the user
			if ( empty( $picture_data ) ) {
				WPLE()->logger->error( "Could not load image data for URL: ".$url );
				return new WP_Error( 400, "There was a problem loading the product image from $url. Please make sure this image URL is accessible or disable the <i>Upload to EPS</i> option in your listing profile.");
			}

			WPLE()->logger->info( "calling Media API create_image_from_file - $url (".strlen($picture_data)." bytes)" );
			$media_response = $media_api->createImageFromFile( $picture_data );

		} else {
			WPLE()->logger->info( "calling Media API create_image_from_url - $url" );
			$media_response = $media_api->createImageFromUrl( $url );
		}

		WPLE()->logger->debug( "Media API response: ".print_r($media_response,1) );

		// build a Trading-shaped UploadSiteHostedPicturesResponseType so all existing
		// callers (WPL_Model::handleResponse(), and the direct
		// ->SiteHostedPictureDetails->FullURL / ->UseByDate dereferences in
		// ListingsModel/ItemBuilderModel/ProfilesPage) keep working unchanged.
		$res = new UploadSiteHostedPicturesResponseType();

		if ( $media_response instanceof \Swagger\Client\Model\ImageResponse ) {
			$res->setAck( 'Success' );

			$details = new SiteHostedPictureDetailsType();
			$details->setFullURL( $media_response->getImageUrl() );
			$details->setUseByDate( $media_response->getExpirationDate() );
			$details->setExternalPictureURL( $url );
			$res->setSiteHostedPictureDetails( $details );

			WPLE()->logger->info( "image was uploaded to EPS successfully via Media API: ".$media_response->getImageUrl() );
		} else {
			// EbayMediaApi already logged the underlying exception (if any); build a
			// Trading-shaped error here so handleResponse()/finishEpsUpload() have
			// something real to work with instead of a bare `false`.
			$res->setAck( 'Failure' );

			$error = new ErrorType();
			$error->setErrorCode( 500 );
			$error->setSeverityCode( 'Error' );
			$error->setShortMessage( 'Failed to upload image to eBay Picture Services' );

			$last_error = $media_api->getLastError();
			$long_message = $last_error
				? "eBay Media API request for $url failed: ".$last_error
				: "eBay Media API request for $url did not return an image. Check the WP-Lister log for details.";

			// The message the user reads in the moment of the failure is the only place
			// that reaches someone who is not following a release note, so name the
			// remedy here - but only for the one failure that HAS this remedy.
			$hint = $this->getEpsPermissionHint( $media_api, $account_id );
			if ( $hint ) {
				$long_message .= '<br>' . $hint;
				WPLE()->logger->error( 'EPS upload was refused for lack of permission - account '. $account_id .' needs to be reconnected.' );
			}

			$error->setLongMessage( $long_message );

			$res->addErrors( $error );
		}

		return $this->finishEpsUpload( $res, $url );
	}

	/**
	 * The sentence that turns "eBay refused the image" into something the user can act
	 * on, for the ONE Media API failure that has a self-service remedy: the stored eBay
	 * authorization does not carry the permission the Media API needs.
	 *
	 * Deliberately narrow. A reconnect does nothing for a 500, for eBay's errorId 2003
	 * ("Internal error"), or for a connection failure, and a reconnect hint on those
	 * produces "I reconnected and it still fails" instead of a usable report. So the
	 * hint is only emitted when eBay actually said "insufficient permissions"
	 * (errorId 1100, domain ACCESS) - or, if the body did not survive the client, when
	 * the status was 403, which is the only status eBay answers that with.
	 *
	 * Why the account is inspected here instead of quoting the "Valid Until < 7 June
	 * 2027" rule of thumb from the release notes: that rule is a proxy for people who
	 * cannot see this error, and it has a blind spot - accounts still on the old
	 * Auth'n'Auth system show an unrelated date in the same column, which gets renewed
	 * without any consent and so can read as "fine" (measured by dave, 2026-11-15,
	 * /home/shared/2026-11-15-wple-3.8.16-release-notice-reconnect-DAVE.md). In the
	 * error moment the account is known, so the applicable branch can be named outright:
	 * a legacy account needs the switch to the eBay login, not "connect again".
	 *
	 * @param EbayMediaApi $media_api  the instance that just failed
	 * @param int          $account_id account the upload ran for
	 *
	 * @return string empty when this failure has no reconnect remedy
	 */
	private function getEpsPermissionHint( $media_api, $account_id ) {
		if ( ! $this->epsErrorIsInsufficientPermission( $media_api ) ) return '';

		$account = WPLE_eBayAccount::getAccount( $account_id );
		if ( ! $account ) return '';

		// same discriminator the accounts list uses for its red "old authentication
		// system" line (classes/table/AccountsTable.php:154) - no refresh token means
		// no OAuth consent was ever granted for this account, so there is nothing to
		// re-grant and the Media API will keep refusing it after any number of reconnects.
		$is_legacy_auth = empty( $account->refresh_token ) && empty( $account->refresh_token_expiry );

		if ( $is_legacy_auth ) {
			return 'This eBay account still uses eBay\'s old authentication system, which cannot be used '
			     . 'to upload images to eBay Picture Services. Switch it to the new eBay login: '
			     . '<b>WP-Lister &raquo; Settings &raquo; Accounts</b>, <b>Edit</b> on this account, then '
			     . '<b>Connect with eBay</b>. Your listings are published in the meantime - the images are '
			     . 'served from your own shop instead of from eBay.';
		}

		return 'The eBay authorization stored for this account does not include the permission that '
		     . 'eBay now requires for image uploads. Granting it takes one reconnect, and you do not have '
		     . 'to delete or disconnect the account first: <b>WP-Lister &raquo; Settings &raquo; Accounts</b>, '
		     . '<b>Edit</b> on this account, then <b>Connect with eBay</b> and <b>Fetch eBay Token</b>. '
		     . 'Your listings are published in the meantime - the images are served from your own shop '
		     . 'instead of from eBay.';
	}

	/**
	 * TRUE only when eBay itself answered the Image call with "insufficient permissions".
	 *
	 * @param EbayMediaApi $media_api
	 *
	 * @return bool
	 */
	private function epsErrorIsInsufficientPermission( $media_api ) {
		$body = $media_api->getLastErrorBody();
		$code = (int) $media_api->getLastErrorCode();

		if ( ! empty( $body ) ) {
			$decoded = json_decode( $body, true );
			if ( is_array( $decoded ) && ! empty( $decoded['errors'] ) && is_array( $decoded['errors'] ) ) {
				foreach ( $decoded['errors'] as $err ) {
					if ( isset( $err['errorId'] ) && (int) $err['errorId'] === 1100 ) return true;
				}
				// eBay answered with a different error - that is an answer, so do not
				// fall through to the status-code guess below.
				return false;
			}
		}

		// No usable body: Guzzle embeds only a truncated copy in the exception message,
		// and a 403 from the Image resource is eBay's insufficient-permission answer.
		return $code === 403;
	}

	/**
	 * Shared tail of both EPS upload transports (Trading + Media API): run the
	 * Trading-shaped response through WPL_Model::handleResponse() - exactly like
	 * every other eBay call - and return either that response object (success) or
	 * a WP_Error built from the *real* eBay error.
	 *
	 * Mitfix (see the "uploadToEPS" migration notes): this tail used to always
	 * collapse any failure into the generic WP_Error(500, 'Failed to upload image:
	 * <url>'), discarding whatever handleResponse() actually saw. That is why the
	 * 4.x uploadToEPSWithFallback()'s shouldRetryWithActiveMode() could never see a
	 * useful signal from a real failure - it only ever got the generic string back.
	 * We now read the real error code/message off the response (when present) and
	 * attach the full Trading-shaped $res as the WP_Error's error data
	 * (get_error_data()), so a caller that wants to inspect the real Ack/Errors can,
	 * without changing the is_wp_error() contract all 12 existing callers rely on.
	 * shouldRetryWithActiveMode() itself does not exist on this branch and is
	 * intentionally not touched here.
	 *
	 * @param object $res Trading-shaped UploadSiteHostedPicturesResponseType
	 * @param string $url the image URL that was being uploaded, for the fallback message
	 *
	 * @return object|WP_Error
	 */
	private function finishEpsUpload( $res, $url ) {
		// handle response and check if successful
		$mdl = new WPL_Model();
		if ( $mdl->handleResponse( $res ) ) {
			return $res;
		} // call successful

		$error_code    = 500;
		$error_message = 'Failed to upload image: <code>'. $url .'</code>';

		$errors = $res->getErrors();
		if ( $errors ) {
			$first_error = is_array( $errors ) ? reset( $errors ) : $errors;
			if ( $first_error ) {
				$error_code   = $first_error->getErrorCode() ?: $error_code;
				$real_message = trim( $first_error->getShortMessage() . ' ' . $first_error->getLongMessage() );
				if ( $real_message ) {
					$error_message = $real_message;
				}
			}
		}

		// attach the real Trading-shaped response as error data, so a caller that
		// wants more than the message string (e.g. a future shouldRetryWithActiveMode())
		// can get at the real Ack/Errors via get_error_data() instead of parsing text.
		return new WP_Error( $error_code, $error_message, $res );
	}

	/**
	 * @param $request
	 * @param $session
	 * @param $parseMode
	 *
	 * @return mixed
	 * @throws Exception
	 */
	private function callUploadSiteHostedPictures( $request, $session, $parseMode = EBATNS_PARSEMODE_CALL )
	{
		$service = new EbatNs_ServiceProxy($session, 'EbatNs_DataConverterUtf8');

		// Fixes the failed UploadSiteHostedPictures calls #60433
		$new_token = WPLE_eBayAccount::maybeMintToken( $session->wple_account_id );

		if ( $new_token ) {
			$session->setRequestToken( $new_token );
		}

		//$this->_session     = $session;
		$userToken          = $session->getRequestToken();
		$version            = $service->getVersion();
		$ExternalPictureURL = $request->getExternalPictureURL();
		$PictureName        = $request->getPictureName();

		///Build the request XML request which is first part of multi-part POST
		$xmlMessage  = '<?xml version="1.0" encoding="utf-8"?>' . "\n";
		$xmlMessage .= '<UploadSiteHostedPicturesRequest xmlns="urn:ebay:apis:eBLBaseComponents">' . "\n";
		$xmlMessage .= "<Version>$version</Version>\n";
		$xmlMessage .= $ExternalPictureURL ? "<ExternalPictureURL>$ExternalPictureURL</ExternalPictureURL>\n" : '';
		$xmlMessage .= $PictureName ? "<PictureName>$PictureName</PictureName>\n" : '';
		$xmlMessage .= "<PictureSet>Supersize</PictureSet>\n";
		$xmlMessage .= "<RequesterCredentials><eBayAuthToken>$userToken</eBayAuthToken></RequesterCredentials>\n";
		$xmlMessage .= '</UploadSiteHostedPicturesRequest>';

		// place all data into the HTTP header
		// Note: this does not use the actual key set anymore, but eBay seems to accept any keys here
		$reqHeaders[] = 'X-EBAY-API-COMPATIBILITY-LEVEL: ' . $version;
		$reqHeaders[] = 'X-EBAY-API-DEV-NAME: '  . $session->getDevId();
		$reqHeaders[] = 'X-EBAY-API-APP-NAME: '  . $session->getAppId();
		$reqHeaders[] = 'X-EBAY-API-CERT-NAME: ' . 'none'; // don't send the license API key to eBay
		$reqHeaders[] = 'X-EBAY-API-CALL-NAME: ' . 'UploadSiteHostedPictures';
		$reqHeaders[] = 'X-EBAY-API-SITEID: ' . $session->getSiteId();

		$multiPartData = null;
		if ( empty( $ExternalPictureURL ) ) {
			// extract picture-binary data from $request->PictureData property
			// and store as $multiPartData which is passed to sendXmlMessage method
			$multiPartData = $request->getPictureData();
			$request->setPictureData(null);
		}

		// Sandbox or Production
		if ($session->getAppMode() == 1)
			$ep = "https://api.sandbox.ebay.com/wsapi";
		else
			$ep = 'https://api.ebay.com/ws/api.dll';

		$ep .= '?callname=' . 'UploadSiteHostedPictures';
		$ep .= '&version=' . $version;

		// upload image using EbatNs_Client::sendMessageXmlStyle()
		$service->setEP( $ep ); // set endpoint in EbatNs_Client
		$responseMsg    = $service->sendMessageXmlStyle( $xmlMessage, $reqHeaders, $multiPartData );

		// old version - using custom method (works)
		// $responseMsg = $this->sendMessageXmlStyle( $xmlMessage, $reqHeaders, $multiPartData );
		// old version - using WP HTTP API (does not work!)
		// $responseMsg = $this->sendXmlMessageWithoutCurl( $xmlMessage, $reqHeaders, $multiPartData );

		// NOTE: the log row is written AFTER the decode on purpose - see
		// epsUploadLogLabel(). Before 2026-11-06 it was written here, BEFORE the
		// decode, and the only thing available at that point was the raw response
		// string.
		if ( $responseMsg )	{
			$ret = $service->decodeMessage( 'UploadSiteHostedPictures', $responseMsg, $parseMode );
		} else {
			$ret = $service->getCurrentResult();
		}

		if ( get_option('wplister_log_to_db') == '1' ) {
			$dblogger = new WPL_EbatNs_Logger();
			$dblogger->updateLog( array(
				'callname'    => 'UploadSiteHostedPictures',
				'request_url' => $ep,
				'request'     => $xmlMessage,
				'response'    => print_r($responseMsg,1),
				'success'     => $this->epsUploadLogLabel( $responseMsg, $ret )
			));
		}

		return $ret;
	} // callUploadSiteHostedPictures()

	/**
	 * The 'success' column for the UploadSiteHostedPictures log row.
	 *
	 * Reported independently by four sellers during the 2026-10-28 EPS outage:
	 * #77855 (screenshots), #77838 (29.10., "the log still marks them 'Success'"),
	 * #77862 (30.10., "Despite this response, the Logs list marks these calls as
	 * 'Success'") and #77865 (30.10., who also named the fix: "It might be worth
	 * logging them as a failure to make troubleshooting easier").
	 *
	 * The old line was
	 *     strpos( $responseMsg, 'ErrorCode' ) ? 'Failure' : 'Success'
	 * and it mislabels a failure in three separate ways, all measured against the
	 * 3.8.15 bytes on 2026-11-06:
	 *
	 *  1. NO WORD "ErrorCode". The outage response was the plain-text body
	 *     "Resource not found" - no XML, no ErrorCode - so the needle missed and
	 *     the row went out green. This is the one the four sellers saw.
	 *  2. NO RESPONSE AT ALL. On a transport failure $responseMsg is false/null/''.
	 *     strpos() then returns false (and raises a deprecation on PHP 8.1+), which
	 *     is also falsy => 'Success'. A call that never reached eBay was logged as
	 *     a success.
	 *  3. THE MISSING === false. strpos() returns 0 when the needle sits at offset
	 *     0, and 0 is falsy => 'Success'. The one position that is certainly an
	 *     error reads as the cleanest result.
	 *
	 * The honest verdict already exists two lines up: $ret carries eBay's Ack, and
	 * WPL_Model::handleResponse() (classes/core/WPL_Model.php, the Ack check that
	 * decides whether the caller treats the upload as done) counts exactly
	 * Success|Warning as a success. This method uses the SAME rule, so the log row
	 * and the plugin's own behaviour cannot disagree.
	 *
	 * This is a DISPLAY fix. It does not upload a single missing picture; it stops
	 * the Logs list from hiding which calls failed. Both halves were stated to the
	 * reporting sellers as separate things.
	 *
	 * @param mixed $responseMsg raw response body from EbatNs_Client
	 * @param mixed $ret         decoded response object, or whatever came back
	 * @return string 'Success'|'Failure'
	 */
	private function epsUploadLogLabel( $responseMsg, $ret ) {

		// (2) nothing came back - a call that produced no body did not succeed.
		if ( ! is_string( $responseMsg ) || '' === trim( $responseMsg ) ) {
			return 'Failure';
		}

		// eBay's own verdict, same rule as WPL_Model::handleResponse().
		if ( is_object( $ret ) && method_exists( $ret, 'getAck' ) ) {
			$ack = $ret->getAck();
			if ( is_string( $ack ) && '' !== $ack ) {
				return ( 'Success' === $ack || 'Warning' === $ack ) ? 'Success' : 'Failure';
			}
		}

		// (1) a body that carries no <Ack> at all is not an eBay success response -
		// "Resource not found" lands here.
		if ( false === stripos( $responseMsg, '<Ack>' ) ) {
			return 'Failure';
		}

		// (3) last resort, with the === false the old line was missing.
		return ( false === stripos( $responseMsg, 'ErrorCode' )
		      && false === stripos( $responseMsg, '<Ack>Failure' ) ) ? 'Success' : 'Failure';
	}


} // class EbayController
