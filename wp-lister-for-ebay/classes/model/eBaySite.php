<?php
/**
 * WPLE_eBaySite class
 *
 */

// class WPLE_eBaySite extends WPLE_NewModel {
class WPLE_eBaySite extends WPL_Core {

	const TABLENAME = 'ebay_sites';

	var $id;
	var $title;
	var $site_id;
	var $site_code;
	var $fieldnames;
	var $code;
	var $url;
	var $enabled;
	var $sort_order;
	var $last_refresh;
	var $default_category_tree_id;
	var $categories_map_ebay;

	var $DispatchTimeMaxDetails;
	var $MinListingStartPrices;
	var $ReturnsWithinOptions;
	var $CountryDetails;
	var $ShippingPackageDetails;
	var $ShippingCostPaidByOptions;
	var $ShippingLocationDetails;
	var $ExcludeShippingLocationDetails;
	var $DoesNotApplyText;
	var $ItemConditionPolicies;
	var $HazardousMaterialsLabels;
	var $ProductSafetyLabels;


	function __construct( $id = null ) {

		$this->init();

		if ( $id !== null ) {
			$site = $this->getSite( $id );

			// Create site row if it doesn't exist
			if ( ! $site ) {
				$this->createSiteIfNotExists( $id );
				$site = $this->getSite( $id );
			}

			if ( ! $site ) {
				return false;
			}

			$this->id = $id;

			// load data into object
			foreach ( $site as $key => $value ) {
			    $this->$key = $value;
			}

			return $this;
		}

	}

	/**
	 * Create a site record if it doesn't exist.
	 *
	 * @param int $site_id The eBay site ID.
	 */
	private function createSiteIfNotExists( $site_id ) {
		global $wpdb;
		$table = $wpdb->prefix . self::TABLENAME;

		// Get site info from the static list
		$ebay_sites = EbayController::getEbaySites();
		if ( ! isset( $ebay_sites[ $site_id ] ) ) {
			return;
		}

		$data = array(
			'id'         => $site_id,
			'title'      => $ebay_sites[ $site_id ],
			'url'        => EbayController::getDomainnameBySiteId( $site_id ),
			'enabled'    => 1,
			'sort_order' => 99,
		);

		$wpdb->insert( $table, $data );
	}

	function init()	{

		$this->fieldnames = array(
			// 'id',
			'title',
			'code',
			'url',
			'enabled',
			'sort_order',
			'last_refresh',
			'categories_map_ebay',
			'DispatchTimeMaxDetails',
			'MinListingStartPrices',
			'ReturnsWithinOptions',
			'CountryDetails',
			'ShippingPackageDetails',
			'ShippingCostPaidByOptions',
			'ShippingLocationDetails',
			'ExcludeShippingLocationDetails',
			'HazardousMaterialsLabels',
			'ProductSafetyLabels',
			'DoesNotApplyText',
		);

	}

	// get single site
	static function getSiteObj( $id )	{
		return new WPLE_eBaySite( $id );
	}

	// get single site
	static function getSite( $id )	{
		global $wpdb;
		$table = $wpdb->prefix . self::TABLENAME;
		
		$item = $wpdb->get_row( $wpdb->prepare("
			SELECT *
			FROM $table
			WHERE id = %s
		", $id 
		), OBJECT);

		return $item;
	}

	// get all sites
	static function getAll( $include_inactive = false ) {
		global $wpdb;
		$table = $wpdb->prefix . self::TABLENAME;

		$where_sql = $include_inactive ? '' : 'WHERE enabled = 1';
		$items = $wpdb->get_results("
			SELECT *
			FROM $table
			$where_sql
			ORDER BY sort_order ASC
		", OBJECT_K);

		return $items;
	}

	// get site title
	static function getSiteTitle( $id )	{
		global $wpdb;
		$table = $wpdb->prefix . self::TABLENAME;
		
		$site_title = $wpdb->get_var( $wpdb->prepare("
			SELECT title
			FROM $table
			WHERE id = %s
		", $id ) );
		return $site_title;
	}

	function getDispatchTimeMaxDetails() {
		return maybe_unserialize( @$this->DispatchTimeMaxDetails );
	}
	function getShippingPackageDetails() {
	    $shipping_details = $this->ShippingPackageDetails ?? '';
		return apply_filters( 'wple_shipping_package_details', maybe_unserialize( $shipping_details ), $this );
	}
	function getReturnsWithinOptions() {
		return maybe_unserialize( @$this->ReturnsWithinOptions );
	}
	function getShippingCostPaidByOptions() {
		return maybe_unserialize( @$this->ShippingCostPaidByOptions );
	}

	// save site
	function add() {
		global $wpdb;
		$table = $wpdb->prefix . self::TABLENAME;

		$data = array();
		foreach ( $this->fieldnames as $key ) {
			if ( isset( $this->$key ) ) {
				$data[ $key ] = $this->$key;
			} 
		}

		if ( sizeof( $data ) > 0 ) {
			$result = $wpdb->insert( $table, $data );
			echo $wpdb->last_error;

			$this->id = $wpdb->insert_id;
			return $wpdb->insert_id;		
		}

	}

	// update feed
	function update() {
		global $wpdb;
		$table = $wpdb->prefix . self::TABLENAME;
		if ( $this->id === null ) return;

		$data = array();
		foreach ( $this->fieldnames as $key ) {
			if ( isset( $this->$key ) ) {
				$data[ $key ] = $this->$key;
			} 
		}

		if ( sizeof( $data ) > 0 ) {
			$result = $wpdb->update( $table, $data, array( 'id' => $this->id ) );
			echo $wpdb->last_error;
			// echo "<pre>";print_r($wpdb->last_query);echo"</pre>";#die();
			// return $wpdb->insert_id;		
		}

	}

	// TODO:
	function updateSiteDetails() {
		if ( $this->id === null ) return;

		// update token expiration date
		$this->initEC( $this->id );
		$expdate = $this->EC->GetTokenStatus( true );
		$this->EC->closeEbay();
		if ( $expdate ) {
			$this->valid_until = $expdate;
			$this->update();
		}

		// update user details
		$this->initEC( $this->id );
		$user_details = $this->EC->GetUser( true );
		$this->EC->closeEbay();
		if ( $user_details ) {
			$this->user_name 	= $user_details->UserID;
			$this->user_details = maybe_serialize( $user_details );
			$this->update();
		}

		// update seller profiles
		$this->initEC( $this->id );
		$result = $this->EC->GetUserPreferences( true );
		$this->EC->closeEbay();
		if ( $result ) {
			$this->seller_profiles   = $result->SellerProfileOptedIn ? 1 : 0;
			$this->shipping_profiles = maybe_serialize( $result->seller_shipping_profiles );
			$this->payment_profiles  = maybe_serialize( $result->seller_payment_profiles );
			$this->return_profiles   = maybe_serialize( $result->seller_return_profiles );
			$this->update();
		}

	} // updateSiteDetails()


	function getPageItems( $current_page, $per_page ) {
		global $wpdb;
		$table = $wpdb->prefix . self::TABLENAME;

        // CVE-2026-11973: whitelist orderby/order - esc_sql() does not sanitize SQL
        // identifiers and must never be used to build an ORDER BY clause from user input
        $allowed_orderby = array( 'title', 'code', 'sort_order', 'enabled', 'last_refresh' );
        $orderby  = wple_sanitize_orderby( isset($_REQUEST['orderby']) ? $_REQUEST['orderby'] : '', $allowed_orderby, 'title' );
        $order    = wple_sanitize_order( isset($_REQUEST['order']) ? $_REQUEST['order'] : '', 'ASC' );
        $offset   = absint( ( $current_page - 1 ) * $per_page );
        $per_page = absint( $per_page );

        // get items
		$items = $wpdb->get_results("
			SELECT *
			FROM $table
			ORDER BY $orderby $order
            LIMIT $offset, $per_page
		", ARRAY_A);

		// get total items count - if needed
		if ( ( $current_page == 1 ) && ( count( $items ) < $per_page ) ) {
			$this->total_items = count( $items );
		} else {
			$this->total_items = $wpdb->get_var("
				SELECT COUNT(*)
				FROM $table
				ORDER BY $orderby $order
			");			
		}

		return $items;
	}

	public static function getDefaultShippingPackages() {
	    $packages_json = '[
	        {
	            "ShippingPackage": "Letter",
	            "Description": "Letter",
	            "PackageID": 1,
	            "DefaultValue": true
            },
            {
                "ShippingPackage": "LargeEnvelope",
	            "Description": "LargeEnvelope",
	            "PackageID": 2,
	            "DefaultValue": ""
            },
            {
                "ShippingPackage": "PackageThickEnvelope",
	            "Description": "PackageThickEnvelope",
	            "PackageID": 4,
	            "DefaultValue": ""
            }
	    ]';

	    return json_decode($packages_json);
    }


} // class WPLE_eBaySite()
