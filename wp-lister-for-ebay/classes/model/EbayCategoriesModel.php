<?php
/**
 * EbayCategoriesModel class
 *
 * responsible for managing ebay categories and store categories and talking to ebay
 * 
 */

// list of used EbatNs classes:

// require_once 'EbatNs_ServiceProxy.php';
// require_once 'GetCategoriesRequestType.php';
// require_once 'GetStoreRequestType.php';
// require_once 'CategoryType.php';	
// require_once 'EbatNs_Logger.php';
// require_once 'GetCategoryFeaturesRequestType.php';

class EbayCategoriesModel extends WPL_Model {
	const table = 'ebay_categories';

	var $_session;
	var $_cs;
	var $_categoryVersion;
	var $_siteid;

	public function __construct() {
		parent::__construct();
		
		global $wpdb;
		$this->tablename = $wpdb->prefix . self::table;
	}
	
	function initCategoriesUpdate( $session, $site_id )
	{
		WPLE()->logger->info("initCategoriesUpdate( $site_id )");

		global $wpdb;

		$account_id = $session->wple_account_id;

		$wpl_site         = WPLE_eBaySite::getSite( $site_id );
		$category_tree_id = $wpl_site->default_category_tree_id;

		// Fetch BEFORE deleting anything. This used to delete first and fetch
		// second, so any failed call left the customer with an empty category
		// table and no way to recover by retrying. See #74289.
		WPLE_eBayAccount::maybeMintToken( $account_id );
		$taxonomy = new EbayTaxonomyModel( $account_id );
		$tree     = $taxonomy->getCategoryTree( $category_tree_id );

		$root_children = ( $tree && $tree->getRootCategoryNode() )
			? $tree->getRootCategoryNode()->getChildCategoryTreeNodes()
			: null;

		if ( ! is_array( $root_children ) || empty( $root_children ) ) {
			// Keep the existing categories - a failed download is not a reason
			// to throw away a working mapping.
			$msg = sprintf(
				__( 'eBay did not return any categories for site %1$s (category tree %2$s). Your existing category mappings have been left untouched - please try again later.', 'wp-lister-for-ebay' ),
				$site_id,
				$category_tree_id
			);
			WPLE()->logger->error( 'initCategoriesUpdate() aborted - empty category tree for site ' . $site_id . ' (tree id ' . $category_tree_id . '); existing categories preserved' );
			$this->showMessage( $msg, true );

			return array();
		}

		$this->_categoryVersion = $tree->getCategoryTreeVersion();
		$this->_siteid          = $site_id;

		// Safe to swap now: we have level-1 categories to put back.
		$wpdb->query( $wpdb->prepare("DELETE FROM {$this->tablename} WHERE site_id = %s ", $site_id ) );

		// Store level-1 categories from the root node's direct children
		foreach ( $root_children as $node ) {
			$this->storeCategoryNode( $node, 0, $site_id, $this->_categoryVersion );
		}

		// Update version on all top-level entries
		$wpdb->update(
			$this->tablename,
			[ 'version' => $this->_categoryVersion, 'site_id' => $site_id ],
			[ 'parent_cat_id' => '0', 'site_id' => $site_id ]
		);

		// include other site specific update tasks
		$tasks = array();
		/*$tasks[] = array(
			'task'        => 'loadShippingServices', 
			'displayName' => 'update shipping services', 
			'params'      => array(),
			'site_id'     => $site_id,
		);*/

        $tasks[] = array(
            'task'        => 'getCountryDetails',
            'displayName' => 'Downloading country details',
            'params'      => array(),
            'site_id'     => $site_id,
            'account_id'    => $account_id
        );

        $tasks[] = array(
            'task'        => 'getShippingLocations',
            'displayName' => 'Downloading shipping locations',
            'params'      => array(),
            'site_id'     => $site_id,
            'account_id'    => $account_id
        );

        $tasks[] = array(
            'task'        => 'getShippingDetails',
            'displayName' => 'Downloading shipping details',
            'params'      => array(),
            'site_id'     => $site_id,
            'account_id'    => $account_id
        );

        $tasks[] = array(
            'task'        => 'getDispatchTimes',
            'displayName' => 'Downloading dispatch times',
            'params'      => array(),
            'site_id'     => $site_id,
        );

        $tasks[] = array(
            'task'        => 'getShippingPackages',
            'displayName' => 'Downloading shipping packages',
            'params'      => array(),
            'site_id'     => $site_id,
            'account_id'    => $account_id
        );

        $tasks[] = array(
            'task'        => 'getExcludeShippingLocations',
            'displayName' => 'Downloading excluded shipping locations',
            'params'      => array(),
            'site_id'     => $site_id,
            'account_id'    => $account_id
        );

        $tasks[] = array(
            'task'        => 'getDoesNotApplyText',
            'displayName' => 'Downloading "Does not apply" text',
            'params'      => array(),
            'site_id'     => $site_id,
            'account_id'    => $account_id
        );

		/*$tasks[] = array(
			'task'        => 'loadPaymentOptions', 
			'displayName' => 'update payment options',
			'site_id'     => $site_id,
		);*/

        $tasks[] = array(
            'task'        => 'getPaymentDetails',
            'displayName' => 'Downloading payment details',
            'params'      => array(),
            'site_id'     => $site_id,
            'account_id'    => $account_id
        );

        $tasks[] = array(
            'task'        => 'getMinimumStartPrices',
            'displayName' => 'Downloading minimum start prices',
            'params'      => array(),
            'site_id'     => $site_id,
            'account_id'    => $account_id
        );

        $tasks[] = array(
            'task'        => 'getReturnPolicyDetails',
            'displayName' => 'Downloading return policy details',
            'params'      => array(),
            'site_id'     => $site_id,
            'account_id'    => $account_id
        );


		// include eBay Motors for US site - automatically
		// if ( ( $site_id === 0 ) && ( get_option( 'wplister_enable_ebay_motors' ) == 1 ) ) {
        // Allow users to skip fetching categories for eBay Motors - the implications for this, if any, is still unknown #59867
		if ( $site_id === 0 || $site_id === '0' && apply_filters( 'wple_fetch_ebay_motors_categories', true ) ) {

			// insert top level motors category manually
			$wpdb->query("DELETE FROM {$this->tablename} WHERE site_id = 100 ");
			$data['cat_id']        = 6000;
			$data['parent_cat_id'] = 0;
			$data['level']         = 1;
			$data['leaf']          = 0;
			$data['cat_name']      = 'eBay Motors';
			$data['site_id']       = 100;
			$wpdb->insert( $this->tablename, $data );

			$task = array( 
				'task'        => 'loadEbayCategoriesBranch', 
				'displayName' => 'eBay Motors', 
				'cat_id'      =>  6000,
				'site_id'     =>  100,
                'account_id'    => $account_id
			);
			$tasks[] = $task;

		}

		// fetch the data back from the db and add a task for each top-level id
		$rows = $wpdb->get_results( $wpdb->prepare( "SELECT cat_id, cat_name, site_id FROM {$this->tablename} WHERE parent_cat_id = 0 AND site_id = %s ", $site_id ), ARRAY_A );
		foreach ($rows as $row)
		{
			WPLE()->logger->info('adding task for category #'.$row['cat_id'] . ' - '.$row['cat_name']);

			$task = array( 
				'task'        => 'loadEbayCategoriesBranch', 
				'displayName' => $row['cat_name'], 
				'cat_id'      => $row['cat_id'],
				'site_id'     => $row['site_id'],
                'account_id'    => $account_id
			);
			$tasks[] = $task;
		}

		return $tasks;
	}
	
	function loadEbayCategoriesBranch( $cat_id, $session, $site_id )
	{
		WPLE()->logger->info("loadEbayCategoriesBranch() - cat_id: $cat_id, site_id: $site_id" );

		// Handle eBay Motors category (US only)
		if ( $cat_id == 6000 && $site_id == 0 ) $site_id = 100;
		$this->_siteid = $site_id;

		$account_id = $session->wple_account_id;

		$wpl_site         = WPLE_eBaySite::getSite( $site_id );
		$category_tree_id = $wpl_site->default_category_tree_id;

		WPLE_eBayAccount::maybeMintToken( $account_id );
		$taxonomy = new EbayTaxonomyModel( $account_id );
		$subtree  = $taxonomy->getCategorySubtree( $cat_id, $category_tree_id );

		if ( $subtree && $subtree->getCategorySubtreeNode() ) {
			$this->_categoryVersion = $subtree->getCategoryTreeVersion();
			$this->storeCategoryNode( $subtree->getCategorySubtreeNode(), 0, $site_id, $this->_categoryVersion );
		} else {
			// Do not fail silently - a skipped branch means a whole section of
			// the category tree is missing and the customer gets no clue why.
			WPLE()->logger->error( 'loadEbayCategoriesBranch() - no subtree returned for cat_id ' . $cat_id . ' on site ' . $site_id . ' (tree id ' . $category_tree_id . '); this branch will be missing from the category list' );
		}
	}	
	
	/**
	 * Recursively store a CategoryTreeNode and all its children.
	 * Skips the node if it was already stored (e.g. the branch root stored by initCategoriesUpdate).
	 *
	 * @param \Swagger\Client\Model\CategoryTreeNode $node
	 * @param int    $parent_id
	 * @param int    $site_id
	 * @param string $version
	 */
	private function storeCategoryNode( $node, $parent_id, $site_id, $version ) {
		global $wpdb;

		$cat_id   = $node->getCategory()->getCategoryId();
		$cat_name = $node->getCategory()->getCategoryName();
		$level    = $node->getCategoryTreeNodeLevel();
		$is_leaf  = $node->getLeafCategoryTreeNode() ? 1 : 0;

		// Skip if already stored (branch root was inserted by initCategoriesUpdate)
		if ( $parent_id === 0 && $this->getItem( $cat_id, $site_id ) ) {
			if ( !$is_leaf && $node->getChildCategoryTreeNodes() ) {
				foreach ( $node->getChildCategoryTreeNodes() as $child ) {
					$this->storeCategoryNode( $child, $cat_id, $site_id, $version );
				}
			}
			return;
		}

		$data = [
			'cat_id'        => $cat_id,
			'parent_cat_id' => $parent_id,
			'cat_name'      => $cat_name,
			'level'         => $level,
			'leaf'          => $is_leaf,
			'version'       => $version ?: 0,
			'site_id'       => $site_id,
		];

		$wpdb->insert( $this->tablename, $data );
		if ( $wpdb->last_error ) {
			WPLE()->logger->error( 'failed to insert category '. $cat_id .' - '. $cat_name );
			WPLE()->logger->error( 'mysql said: '. $wpdb->last_error );
		} else {
			WPLE()->logger->info( 'category inserted() '. $cat_id .' - '. $cat_name );
		}

		if ( !$is_leaf && $node->getChildCategoryTreeNodes() ) {
			foreach ( $node->getChildCategoryTreeNodes() as $child ) {
				$this->storeCategoryNode( $child, $cat_id, $site_id, $version );
			}
		}
	}

	function storeCategory( $type, $Category )
	{
		global $wpdb;
		
		//#type $Category CategoryType
		$data['cat_id'] = $Category->CategoryID;
		if ( $Category->CategoryParentID[0] == $Category->CategoryID ) {

			// avoid duplicate main categories due to the structure of the response
			if ( $this->getItem( $Category->CategoryID, $this->_siteid ) ) return true;

			$data['parent_cat_id'] = '0';

		} else {
			$data['parent_cat_id'] = $Category->CategoryParentID[0];			
		}
		$data['cat_name'] = $Category->CategoryName;
		$data['level']    = $Category->CategoryLevel;
		$data['leaf']     = $Category->LeafCategory ? $Category->LeafCategory : 0;
		$data['version']  = $this->_categoryVersion ? $this->_categoryVersion : 0;
		$data['site_id']  = $this->_siteid;
		
		// remove unrecognizable chars from category name
		// $data['cat_name'] = trim(str_replace('?','', $data['cat_name'] ));

		$wpdb->insert( $this->tablename, $data );
		if ( $wpdb->last_error ) {
			WPLE()->logger->error('failed to insert category '.$data['cat_id'] . ' - ' . $data['cat_name'] );
			WPLE()->logger->error('mysql said: '.$wpdb->last_error );
			WPLE()->logger->error('data: '. print_r( $data, 1 ) );
		} else {
			WPLE()->logger->info('category inserted() '.$data['cat_id'] . ' - ' . $data['cat_name'] );
		}
					
		return true;
	}
	
	

	function downloadStoreCategories( $session, $account_id )
	{
		global $wpdb;
		$this->initServiceProxy($session);
		WPLE()->logger->info('downloadStoreCategories()');
		$this->account_id = $account_id;
		
		// download store categories
		$req = new GetStoreRequestType();
		$req->CategoryStructureOnly = true;
		
		$res = $this->_cs->GetStore($req);
		
		// empty table
		$wpdb->query( $wpdb->prepare("DELETE FROM {$wpdb->prefix}ebay_store_categories WHERE account_id = %s ", $account_id ) );
		
		// insert each category

		if ( is_array($res->Store->CustomCategories) ) {
			foreach( $res->Store->CustomCategories as $Category ) {
				$this->handleStoreCategory( $Category, 1, 0 );
			}
		}

	}
		
	
	function handleStoreCategory( $Category, $level, $parent_cat_id )
	{
		global $wpdb;
		if ( $level > 5 ) return false;		

		$data = array();
		$data['cat_id'] 		= $Category->CategoryID;
		$data['cat_name'] 		= $Category->Name;
		$data['order'] 			= $Category->Order;
		$data['leaf'] 			= is_array( $Category->ChildCategory ) ? '0' : '1';
		$data['level'] 			= $level;
		$data['parent_cat_id'] 	= $parent_cat_id;
		$data['account_id']     = $this->account_id;
		$data['site_id']        = WPLE()->accounts[ $this->account_id ]->site_id;

		// move "Other" category to the end of the list
        // Fix: Use cat_id==1 instead of order==0 to look for the "Other" category
		//if ( $data['order'] == 0 ) $data['order'] = 999;
		if ( $data['cat_id'] == 1 ) $data['order'] = 999;

		// insert row - and manually set field type to string. 
		// without parameter '%s' $wpdb would convert cat_id to int instead of bigint - on some servers!
		$wpdb->insert( $wpdb->prefix.'ebay_store_categories', $data, '%s' );

		// handle children recursively
		if ( is_array( $Category->ChildCategory ) ) {
			foreach ( $Category->ChildCategory as $ChildCategory ) {
				$this->handleStoreCategory( $ChildCategory, $level + 1, $Category->CategoryID );
			}
		}

	}
	

	
	function fetchCategoryConditions( $session, $category_id, $site_id )
	{

		// adjust Site if required - eBay Motors (beta)
		$test_site_id = $site_id == 0 ? 100 : $site_id;
		$primary_category = $this->getItem( $category_id, $test_site_id );
		WPLE()->logger->info("fetchCategoryConditions( $category_id, $test_site_id ) primary_category: ".print_r($primary_category,1));
		if ( $primary_category && $primary_category['site_id'] == 100 ) {
			$session->setSiteId( 100 );
			$site_id = 100;
		}

		$this->initServiceProxy($session);
		
		// download store categories
		$req = new GetCategoryFeaturesRequestType();
		$req->setCategoryID( $category_id );
		$req->setDetailLevel( 'ReturnAll' );
		
		$res = $this->_cs->GetCategoryFeatures($req);
		WPLE()->logger->info('fetchCategoryConditions() for category ID '.$category_id);
		// #74289 / #74564 - a failed call must never overwrite what is already stored.
		// GetCategoryFeatures is decommissioned and answers HTTP 410 with an empty body,
		// which arrives here as $res === null. Everything below then builds an EMPTY
		// features object from it, and the update at the end of this function writes
		// that over a perfectly good condition list. Because last_updated is
		// deliberately not touched, a never-stamped or stale row repeats the wipe on
		// every single page load. Bail out and keep what we have.
		if ( ! is_object( $res ) || ! is_array( $res->Category ) || empty( $res->Category ) ) {
			WPLE()->logger->error( 'fetchCategoryConditions() got no usable response for category ' . $category_id . ' (site ' . $session->getSiteId() . ') - existing category features left untouched' );

			$existing   = self::getItem( $category_id, $session->getSiteId() );
			$features   = $existing ? maybe_unserialize( $existing['features'] ) : false;
			$conditions = ( is_object( $features ) && is_array( $features->conditions ) ) ? $features->conditions : array();

			return array( $category_id => $conditions );
		}

		// WPLE()->logger->info('fetchCategoryConditions: '.print_r($res,1));

		// build $conditions array
		$conditions = array();
		if ( @$res->Category[0]->ConditionValues && $res->Category[0]->ConditionValues->Condition && count($res->Category[0]->ConditionValues->Condition) > 0 )
		foreach ($res->Category[0]->ConditionValues->Condition as $Condition) {
			$conditions[$Condition->ID] = $Condition->DisplayName;
		}
		//WPLE()->logger->info('fetchCategoryConditions: '.print_r($conditions,1));

        ###
        # This does not work due to the version of the Ebat_NS library that WPLE is using - it does not recognize the SpecialFeatures element in the response #51239
        ###
		// Include SpecialFeatures in the conditions array
        if ( isset( $res->Category[0] ) && $res->Category[0]->SpecialFeatures && is_object( $res->Category[0]->SpecialFeatures) && $res->Category[0]->SpecialFeatures->Condition && count( $res->Category[0]->SpecialFeatures->Condition ) > 0 ) {
            foreach ($res->Category[0]->SpecialFeatures->Condition as $Condition) {
                $conditions[$Condition->ID] = $Condition->DisplayName;
            }
            WPLE()->logger->info('fetchCategoryConditions: '.print_r($conditions,1));
        }
		
		if (!is_array($conditions)) $conditions = 'none';

		// build features object
		$features = new stdClass();
		$features->conditions = $conditions;
		$features->ConditionEnabled          = !is_array($res->Category) ? null : $res->Category[0]->getConditionEnabled();
		$features->UPCEnabled                = !is_array($res->Category) ? null : $res->Category[0]->getUPCEnabled();
		$features->EANEnabled                = !is_array($res->Category) ? null : $res->Category[0]->getEANEnabled();
		$features->ISBNEnabled               = !is_array($res->Category) ? null : $res->Category[0]->getISBNEnabled();
		$features->BrandMPNIdentifierEnabled = !is_array($res->Category) ? null : $res->Category[0]->getBrandMPNIdentifierEnabled();
		$features->ItemCompatibilityEnabled  = !is_array($res->Category) ? null : $res->Category[0]->getItemCompatibilityEnabled();
		$features->VariationsEnabled         = !is_array($res->Category) ? null : $res->Category[0]->getVariationsEnabled();

		// #77127 - stamp the conditions blob itself. The row's last_updated column is
		// written by the item specifics path only (fetchCategorySpecifics), so it says
		// nothing about whether the conditions below came from a real answer. Without a
		// stamp of its own an empty list is indistinguishable from a failed lookup and
		// getConditionsForCategory() has to guess. Set on the success path only - the
		// guard above returns before this point when the call did not answer usably.
		$features->conditions_updated = date('Y-m-d H:i:s');

		// store result in ebay_categories table
		global $wpdb;
		$data = array();
		$data['features']     = serialize( $features );
		// $data['last_updated'] = date('Y-m-d H:i:s'); // will be updated when storing item specifics
		$wpdb->update( $wpdb->prefix . self::table, $data, array( 'cat_id' => $category_id, 'site_id' => $session->getSiteId() ) );
		WPLE()->logger->info('category features / conditions were stored...'.$wpdb->last_error);
		
		// legacy return format
		return array( $category_id => $conditions );

	} // fetchCategoryConditions()

    /**
     * @deprecated Use EbayTaxonomyModel::getItemAspectsForCategory() instead
     * @param $session
     * @param $category_id
     * @param bool $site_id
     * @return array[]|string[]
     */
	function fetchCategorySpecifics( $session, $category_id, $site_id = false )
	{
	    global $wpdb;
	    //_deprecated_function( 'EbayCategoriesModel::fetchCategorySpecifics', '3.2', 'EbayTaxonomyModel::getItemAspectsForCategory' );

		// adjust Site if required - eBay Motors (beta)
		$test_site_id = $site_id == 0 ? 100 : $site_id;
		$primary_category = $this->getItem( $category_id, $test_site_id );
		WPLE()->logger->info("fetchCategorySpecifics( $category_id, $test_site_id ) primary_category: ".print_r($primary_category,1));
		if ( $primary_category && $primary_category['site_id'] == 100 ) {
			$session->setSiteId( 100 );
			$site_id = 100;
		}

		$account = WPLE()->accounts[ $session->wple_account_id ];

		if ( $account && $account->oauth_token ) {
            // make sure we have a valid oauth token
            WPLE_eBayAccount::maybeMintToken( $session->wple_account_id );

            $taxonomy_mdl = new EbayTaxonomyModel( $session->wple_account_id );

            $wpl_site = WPLE_eBaySite::getSite( $site_id );
            $category_tree_id = $wpl_site->default_category_tree_id;
            $aspects = $taxonomy_mdl->getItemAspectsForCategory( $category_id, $category_tree_id );

            // #74289 - a failed lookup must never overwrite stored item specifics.
            // getItemAspectsForCategory() returns false only when the taxonomy endpoint
            // could not be reached or answered something unusable; a category that
            // genuinely has no item specifics returns an empty array and is stored as
            // before. Without this the loop below is skipped, an empty specifics blob is
            // written AND last_updated is stamped fresh - so the empty result is then
            // served from cache for a month while the row looks perfectly healthy.
            if ( false === $aspects ) {
                WPLE()->logger->error( 'fetchCategorySpecifics() got no usable response for category ' . $category_id . ' (site ' . $site_id . ') - existing item specifics left untouched' );

                $existing  = self::getItem( $category_id, $site_id );
                $specifics = $existing ? maybe_unserialize( $existing['specifics'] ) : array();

                return is_array( $specifics ) ? $specifics : array();
            }

            $specifics = [];

            if ( $aspects ) foreach ( $aspects as $aspect ) {
                $name = $aspect->localizedAspectName;

                $min_value = '';
                if ( $aspect->aspectConstraint->aspectRequired ) {
                    $min_value = 1;
                }

                $new_specs = new stdClass();
                $new_specs->Name          = $name;
                $new_specs->ValueType     = $aspect->aspectConstraint->aspectDataType;
                $new_specs->MinValues     = $min_value;
                $new_specs->MaxValues     = $aspect->aspectConstraint->itemToAspectCardinality == 'SINGLE' ? 1 : '';
                $new_specs->SelectionMode = $aspect->aspectConstraint->aspectMode;
                // store the Usage to be able to display the recommended Item Specifics #54107
                $new_specs->Usage         = $aspect->aspectConstraint->aspectUsage;
                $new_specs->recommendedValues = [];

                if ( !empty($aspect->aspectValues) ) {
	                $aspect_values = $aspect->aspectValues;
                    foreach ( $aspect_values as $value ) {
                        // WPLE()->logger->info('*** '.$Recommendation->Name.' recommendedValue: '.$recommendedValue->Value);
                        $value = $value->localizedValue;

                        if ( strpos( $value, chr(239) ) ) continue; // skip values with 0xEF / BOM (these are broken on eBay and cause problems on some servers)
                        if ( strpos( $value, chr(226) ) ) continue; // skip values with 0xE2
                        if ( strpos( $value, chr(128) ) ) continue; // skip values with 0x80
                        if ( strpos( $value, chr(139) ) ) continue; // skip values with 0x8B
                        $value = preg_replace('/[[:cntrl:]]/i', '', $value); // remove control characters (not encountered yet)
                        $new_specs->recommendedValues[] = $value;
                    }
                }


                $specifics[] = $new_specs;
            }
            WPLE()->logger->debug( 'Got specifics: '. print_r( $specifics, 1 ) );

            // store result in ebay_categories table
            $data = array();
            $data['specifics']    = serialize( $specifics );
            $data['last_updated'] = date('Y-m-d H:i:s');
            $wpdb->update( $wpdb->prefix . self::table, $data, array( 'cat_id' => $category_id, 'site_id' => $site_id ) );
            WPLE()->logger->info('category specifics were stored...'.$wpdb->last_error);

            return $specifics;
        }

		$this->initServiceProxy($session);
		
		// download store categories
		$req = new GetCategorySpecificsRequestType();
		$req->setCategoryID( $category_id );
		$req->setDetailLevel( 'ReturnAll' );
		$req->setMaxNames( apply_filters( 'wple_category_specifics_max_names', get_option( 'wplister_item_specifics_limit', 100 ) ) ); 			// eBay default is 30
		$req->setMaxValuesPerName( apply_filters( 'wple_category_specifics_max_name_value', 1000 ) ); 	// eBay default is 25 - no maximum
		
		$res = $this->_cs->GetCategorySpecifics($req);
		WPLE()->logger->info('fetchCategorySpecifics() for category ID '.$category_id);
		// #74289 - same guard for the legacy Trading call. A gated or failed call arrives
		// here as $res === null, which builds an empty $specifics array and writes it -
		// with a fresh last_updated - over the stored item specifics.
		if ( ! is_object( $res ) ) {
			WPLE()->logger->error( 'fetchCategorySpecifics() got no usable GetCategorySpecifics response for category ' . $category_id . ' (site ' . $site_id . ') - existing item specifics left untouched' );

			$existing  = self::getItem( $category_id, $site_id );
			$specifics = $existing ? maybe_unserialize( $existing['specifics'] ) : array();

			return array( $category_id => ( is_array( $specifics ) ? $specifics : array() ) );
		}

		// build $specifics array
		$specifics = array();
		if ( @$res->Recommendations[0]->NameRecommendation && count($res->Recommendations[0]->NameRecommendation) > 0 ) {
			foreach ($res->Recommendations[0]->NameRecommendation as $Recommendation) {

				// ignore invalid data - Name is required
				// if ( empty( $Recommendation->getName() ) ) continue; // does not work in PHP 5.4 and before (Fatal Error: Can't use method return value in write context)
                if ( ! $Recommendation->getName() ) continue;			// works in all PHP versions

				$new_specs                = new stdClass();
				$new_specs->Name          = $Recommendation->Name;
				$new_specs->ValueType     = $Recommendation->ValidationRules->ValueType;
				$new_specs->MinValues     = $Recommendation->ValidationRules->MinValues;
				$new_specs->MaxValues     = $Recommendation->ValidationRules->MaxValues;
				$new_specs->SelectionMode = $Recommendation->ValidationRules->SelectionMode;

				if ( is_array( $Recommendation->ValueRecommendation ) ) {
					foreach ($Recommendation->ValueRecommendation as $recommendedValue) {
						// WPLE()->logger->info('*** '.$Recommendation->Name.' recommendedValue: '.$recommendedValue->Value);
						if ( strpos( $recommendedValue->Value, chr(239) ) ) continue; // skip values with 0xEF / BOM (these are broken on eBay and cause problems on some servers)
						if ( strpos( $recommendedValue->Value, chr(226) ) ) continue; // skip values with 0xE2
						if ( strpos( $recommendedValue->Value, chr(128) ) ) continue; // skip values with 0x80
						if ( strpos( $recommendedValue->Value, chr(139) ) ) continue; // skip values with 0x8B
        				$value = preg_replace('/[[:cntrl:]]/i', '', $recommendedValue->Value); // remove control characters (not encountered yet)
						$new_specs->recommendedValues[] = $value;
					}
				}

				$specifics[] = $new_specs;
			}		
		}
		// WPLE()->logger->info('fetchCategorySpecifics: '.print_r($specifics,1));
		if (!is_array($specifics)) $specifics = 'none';

		// store result in ebay_categories table
		global $wpdb;
		$data = array();
		$data['specifics']    = serialize( $specifics );
		$data['last_updated'] = date('Y-m-d H:i:s');
		$wpdb->update( $wpdb->prefix . self::table, $data, array( 'cat_id' => $category_id, 'site_id' => $site_id ) );
		WPLE()->logger->info('category specifics were stored...'.$wpdb->last_error);
		
		// legacy return format
		return array( $category_id => $specifics );

	} // fetchCategorySpecifics()
		
	
	static function getItemSpecificsForCategory( $category_id, $site_id = false, $account_id = false ) {
		// if site_id is empty, get it from account_id or default account
		if ( ! $site_id && ! $account_id ) {
		    if ( empty( WPLE()->accounts ) ) {
		        // no accounts exist, return an empty array
                return array();
            }

			$account = WPLE()->accounts[ get_option('wplister_default_account_id') ];
			$site_id = $account->site_id;
		}
		if ( ! $site_id && $account_id && array_key_exists( $account_id, WPLE()->accounts ) ) {
			$account = WPLE()->accounts[ $account_id ];
			$site_id = $account->site_id;
		}

		// get category from db
		$category = self::getItem( $category_id, $site_id );
		if ( ! $category_id ) return array();
		if ( ! $category    ) return array();

		// if timestamp is recent, return item specifics
        $item_specifics = maybe_unserialize( $category['specifics'] );
        $cache_lifetime = apply_filters( 'wple_item_specifics_cache_lifetime', '1 month' );
		if ( !empty( $item_specifics ) && get_option( 'wplister_disable_item_specifics_cache', 0 ) == 0 && strtotime( $category['last_updated']  ) > strtotime("-{$cache_lifetime}") ) {
			// WPLE()->logger->info('found recent item specifics from '.$category['last_updated'] );
			return maybe_unserialize( $category['specifics'] );
		}
		WPLE()->logger->info('updating outdated item specifics - last update: '.$category['last_updated'] );

		// fetch info from eBay
		WPLE()->initEC( $account_id );
		$result = WPLE()->EC->getCategorySpecifics( $category_id );
		WPLE()->EC->closeEbay();

		// always return an array
		return $result;
		//return is_array($result) ? reset($result) : array();

	} // getItemSpecificsForCategory()

	static function mergeItemSpecifics( $specifics1, $specifics2 ) {
		$new_specifics = $specifics1;

		$names = wp_list_pluck( $specifics1, 'Name' );

		foreach ( $specifics2 as $spec ) {
			if ( in_array( $spec->Name, $names ) ) {
				continue;
			}

			$new_specifics[] = $spec;
		}

		return $new_specifics;
	}

	
	static function getConditionsForCategory( $category_id, $site_id = false, $account_id = false ) {

		// if site_id is empty, get it from account_id or default account
		if ( ! $site_id && ! $account_id ) {
            if ( empty( WPLE()->accounts ) ) {
                // no accounts exist, return an empty array
                return apply_filters( 'wple_get_conditions_for_category', array(), $category_id, $site_id, $account_id );
            }

			$account = WPLE()->accounts[ get_option('wplister_default_account_id') ];
			$site_id = $account->site_id;
		}
		if ( ! $site_id && $account_id ) {
			$account = WPLE()->accounts[ $account_id ] ?? false;
			$site_id =  ($account) ? $account->site_id : $site_id;
		}

		// get category from db
		$category = self::getItem( $category_id, $site_id );
        if ( ! $category_id ) return apply_filters( 'wple_get_conditions_for_category', array(), $category_id, $site_id, $account_id );
        if ( ! $category    ) return apply_filters( 'wple_get_conditions_for_category', array(), $category_id, $site_id, $account_id );

        // if timestamp is recent, return category conditions
        // #77127 - this used to read $category['last_updated'], which is written by the
        // ITEM SPECIFICS path only (fetchCategorySpecifics stamps it, fetchCategoryConditions
        // deliberately does not). Any page load that refreshed specifics after a failed
        // conditions lookup therefore left a freshly stamped row holding an EMPTY list, and
        // this branch served that empty list for a month without ever retrying - to a seller
        // who had never had working data in the first place. Gate on a stamp that belongs to
        // the conditions blob instead. Rows written before this fix carry no such stamp and
        // fall through to a refresh, so no database migration is needed.
        $features         = maybe_unserialize( $category['features'] );
        $conditions_stamp = ( is_object( $features ) && ! empty( $features->conditions_updated ) )
            ? $features->conditions_updated
            : null;

        if ( $conditions_stamp && strtotime( $conditions_stamp ) > strtotime('-1 month') && get_option( 'wplister_log_level', 0 ) < 7 ) {
            // an empty list IS a valid answer here - plenty of categories genuinely offer no
            // condition choice. It is only trustworthy because the stamp is set on success only.
            $cached = isset( $features->conditions ) ? $features->conditions : array();
            return apply_filters( 'wple_get_conditions_for_category', $cached, $category_id, $site_id, $account_id );
        }
		WPLE()->logger->info('updating outdated category conditions - conditions last updated: '. ( $conditions_stamp ? $conditions_stamp : 'never' ) );

        // #77127 - refresh from the Sell Metadata API first. GetCategoryFeatures, which the
        // Trading call below depends on, is decommissioned and answers HTTP 410 with an empty
        // body (measured 2026-08-06, endpoint-wide, both DE and US), so that path can no longer
        // put a condition list back - it can only confirm that there is none. The REST endpoint
        // answers 200 and returns the whole marketplace in one call.
        if ( self::refreshConditionsFromMarketplaceApi( $site_id, $account_id ) ) {
            $category = self::getItem( $category_id, $site_id );
            $features = $category ? maybe_unserialize( $category['features'] ) : false;
            if ( is_object( $features ) && ! empty( $features->conditions_updated ) ) {
                $conditions = isset( $features->conditions ) ? $features->conditions : array();
                return apply_filters( 'wple_get_conditions_for_category', $conditions, $category_id, $site_id, $account_id );
            }
        }

        // fetch info from eBay
        WPLE()->initEC( $account_id );
        $result = WPLE()->EC->getCategoryConditions( $category_id );
        WPLE()->EC->closeEbay();

		// always return an array
		//return is_array($result) ? reset($result) : array();
        $conditions = is_array($result) ? reset($result) : array();

        // Neither refresh produced anything - fall back to whatever is stored.
        //
        // The stamp gate above deliberately distrusts a row that carries no
        // conditions stamp, because such a row may hold the empty list that
        // #77127 wrote. But distrusting it is only safe as long as SOMETHING
        // can put a list back. On an install that still runs on a legacy
        // Auth'n'Auth token the REST refresh cannot run (no OAuth token) and
        // GetCategoryFeatures is decommissioned, so both refreshes come back
        // empty and a seller whose stored list was perfectly good would lose
        // the condition dropdown he had before the update. Measured against
        // 3.8.8 on a token-less install: 3.8.8 served the stored list, this
        // method returned an empty one.
        //
        // A stored NON-EMPTY list is strictly better than nothing here. An
        // empty stored list is still not trusted - that is the #77127 case
        // and it must keep falling through to a retry.
        if ( empty( $conditions ) ) {
            $stored = ( isset( $features ) && is_object( $features ) && ! empty( $features->conditions ) )
                ? $features->conditions
                : array();
            if ( ! empty( $stored ) ) {
                WPLE()->logger->info( 'getConditionsForCategory(): no refresh available, serving the stored condition list for category '. $category_id );
                $conditions = $stored;
            }
        }

        return apply_filters( 'wple_get_conditions_for_category', $conditions, $category_id, $site_id, $account_id );

    } // getConditionsForCategory()

	/**
	 * Refresh the stored condition lists for one site from the Sell Metadata API.
	 *
	 * #74289 / #77127 - the live replacement for the decommissioned GetCategoryFeatures
	 * ConditionValues. One request returns the condition policies for the entire
	 * marketplace, so this refreshes a whole site at a time and caches the parsed map;
	 * individual category rows are then written lazily, one UPDATE per page load at most.
	 *
	 * @param int       $site_id
	 * @param int|false $account_id
	 * @return bool  true when a usable map is available for this site
	 */
	static function refreshConditionsFromMarketplaceApi( $site_id, $account_id = false ) {
		global $wpdb;

		if ( ! function_exists( 'wp_remote_get' ) ) return false;

		$map = self::getConditionsMapForSite( $site_id, $account_id );
		if ( ! is_array( $map ) || empty( $map ) ) return false;

		$now  = date('Y-m-d H:i:s');
		$rows = $wpdb->get_results( $wpdb->prepare(
			"SELECT cat_id, features FROM {$wpdb->prefix}" . self::table . " WHERE site_id = %s",
			$site_id
		), ARRAY_A );

		$updated = 0;
		foreach ( (array) $rows as $row ) {
			if ( ! array_key_exists( $row['cat_id'], $map ) ) continue;

			$features = maybe_unserialize( $row['features'] );
			if ( ! is_object( $features ) ) $features = new stdClass();

			$features->conditions         = $map[ $row['cat_id'] ];
			$features->conditions_updated = $now;

			$wpdb->update(
				$wpdb->prefix . self::table,
				array( 'features' => serialize( $features ) ),
				array( 'cat_id' => $row['cat_id'], 'site_id' => $site_id )
			);
			$updated++;
		}

		WPLE()->logger->info( 'refreshConditionsFromMarketplaceApi(): updated '. $updated .' of '. count( (array) $rows ) .' stored categories for site '. $site_id );

		return $updated > 0;
	} // refreshConditionsFromMarketplaceApi()

	/**
	 * The parsed marketplace condition map, cached in a transient.
	 *
	 * A failed lookup caches a short negative result so a dead or throttled endpoint is
	 * not called again on every single page load - the defect this whole fix is about.
	 *
	 * @return array|false  array( cat_id => array( condition_id => label ) )
	 */
	static function getConditionsMapForSite( $site_id, $account_id = false ) {
		$transient = 'wple_conditions_map_' . (int) $site_id;
		$cached    = get_transient( $transient );
		if ( 'none' === $cached ) return false;          // recent failure, do not hammer
		if ( is_array( $cached ) )  return $cached;

		$site        = WPLE_eBaySite::getSite( $site_id );
		$marketplace = ( $site && ! empty( $site->code ) ) ? $site->code : false;
		if ( ! $marketplace ) {
			WPLE()->logger->error( 'getConditionsMapForSite(): no marketplace code stored for site '. $site_id );
			set_transient( $transient, 'none', HOUR_IN_SECONDS );
			return false;
		}

		// an account on this site - the call needs a user access token
		if ( ! $account_id || ! isset( WPLE()->accounts[ $account_id ] ) ) {
			$account_id = false;
			foreach ( (array) WPLE()->accounts as $acc ) {
				if ( $acc->site_id == $site_id ) { $account_id = $acc->id; break; }
			}
		}
		if ( ! $account_id ) {
			set_transient( $transient, 'none', HOUR_IN_SECONDS );
			return false;
		}

		// re-read the account after minting - WPLE()->accounts can still hold the old token
		WPLE_eBayAccount::maybeMintToken( $account_id );
		$account = WPLE_eBayAccount::getAccount( $account_id );
		$token   = $account ? $account->oauth_token : '';
		if ( empty( $token ) ) {
			WPLE()->logger->error( 'getConditionsMapForSite(): no access token for account '. $account_id );
			set_transient( $transient, 'none', HOUR_IN_SECONDS );
			return false;
		}

		$host = $account->sandbox_mode ? 'https://api.sandbox.ebay.com' : 'https://api.ebay.com';
		$url  = $host . '/sell/metadata/v1/marketplace/' . rawurlencode( $marketplace ) . '/get_item_condition_policies';

		$response = wp_remote_get( $url, array(
			'timeout' => 60,
			'headers' => array(
				'Authorization' => 'Bearer ' . $token,
				'Accept'        => 'application/json',
			),
		) );

		if ( is_wp_error( $response ) ) {
			WPLE()->logger->error( 'getConditionsMapForSite(): '. $response->get_error_message() );
			set_transient( $transient, 'none', HOUR_IN_SECONDS );
			return false;
		}

		$status = wp_remote_retrieve_response_code( $response );
		if ( 200 != $status ) {
			WPLE()->logger->error( 'getConditionsMapForSite(): '. $marketplace .' answered HTTP '. $status );
			set_transient( $transient, 'none', HOUR_IN_SECONDS );
			return false;
		}

		$data = json_decode( wp_remote_retrieve_body( $response ), true );
		if ( empty( $data['itemConditionPolicies'] ) || ! is_array( $data['itemConditionPolicies'] ) ) {
			WPLE()->logger->error( 'getConditionsMapForSite(): no itemConditionPolicies in the response for '. $marketplace );
			set_transient( $transient, 'none', HOUR_IN_SECONDS );
			return false;
		}

		$map = array();
		foreach ( $data['itemConditionPolicies'] as $policy ) {
			if ( empty( $policy['categoryId'] ) ) continue;
			$conditions = array();
			if ( ! empty( $policy['itemConditions'] ) && is_array( $policy['itemConditions'] ) ) {
				foreach ( $policy['itemConditions'] as $item_condition ) {
					if ( ! isset( $item_condition['conditionId'] ) ) continue;
					$conditions[ (string) $item_condition['conditionId'] ] = isset( $item_condition['conditionDescription'] )
						? $item_condition['conditionDescription']
						: (string) $item_condition['conditionId'];
				}
			}
			// an empty list is stored as such - many categories genuinely offer no choice
			$map[ (string) $policy['categoryId'] ] = $conditions;
		}

		WPLE()->logger->info( 'getConditionsMapForSite(): '. $marketplace .' returned condition policies for '. count( $map ) .' categories' );
		set_transient( $transient, $map, WEEK_IN_SECONDS );

		return $map;
	} // getConditionsMapForSite()

	
	static function getUPCEnabledForCategory( $category_id, $site_id = false, $account_id = false ) {

		// if site_id is empty, get it from account_id or default account
		if ( ! $site_id && ! $account_id ) {
			$account = WPLE()->accounts[ get_option('wplister_default_account_id') ];
			$site_id = $account->site_id;
		}
		if ( ! $site_id && $account_id ) {
			$account = WPLE()->accounts[ $account_id ];
			$site_id = $account->site_id;
		}

		// get category from db
		$category = self::getItem( $category_id, $site_id );
		if ( ! $category_id ) return array();
		if ( ! $category    ) return false;

		// if timestamp is recent, return category features
		if ( strtotime( $category['last_updated']  ) > strtotime('-1 month') ) {
			// WPLE()->logger->info('found recent category features from '.$category['last_updated'] );
			$features = maybe_unserialize( $category['features'] );
			if ( is_object($features) )
				return isset( $features->UPCEnabled ) ? $features->UPCEnabled : null;
		}
		WPLE()->logger->info('updating outdated category features (UPCEnabled) - last update: '.$category['last_updated'] );

		// fetch info from eBay
		WPLE()->initEC( $account_id );
		$result = WPLE()->EC->getCategoryConditions( $category_id );
		WPLE()->EC->closeEbay();

		// fetch updated category details from DB
		$category = self::getItem( $category_id, $site_id );
		$features = maybe_unserialize( $category['features'] );
		if ( is_object($features) ) {
			return isset( $features->UPCEnabled ) ? $features->UPCEnabled : null;
		}

		// nothing found
		return false;
	} // getUPCEnabledForCategory()

	static function getEANEnabledForCategory( $category_id, $site_id = false, $account_id = false ) {

		// if site_id is empty, get it from account_id or default account
		if ( ! $site_id && ! $account_id ) {
			$account = WPLE()->accounts[ get_option('wplister_default_account_id') ];
			$site_id = $account->site_id;
		}
		if ( ! $site_id && $account_id ) {
			$account = WPLE()->accounts[ $account_id ];
			$site_id = $account->site_id;
		}

		// get category from db
		$category = self::getItem( $category_id, $site_id );
		if ( ! $category_id ) return array();
		if ( ! $category    ) return false;

		// if timestamp is recent, return category features
		if ( strtotime( $category['last_updated']  ) > strtotime('-1 month') ) {
			// WPLE()->logger->info('found recent category features from '.$category['last_updated'] );
			$features = maybe_unserialize( $category['features'] );
			if ( is_object($features) )
				return isset( $features->EANEnabled ) ? $features->EANEnabled : null;
		}
		WPLE()->logger->info('updating outdated category features (EANEnabled) - last update: '.$category['last_updated'] );

		// fetch info from eBay
		WPLE()->initEC( $account_id );
		$result = WPLE()->EC->getCategoryConditions( $category_id );
		WPLE()->EC->closeEbay();

		// fetch updated category details from DB
		$category = self::getItem( $category_id, $site_id );
		$features = maybe_unserialize( $category['features'] );
		if ( is_object($features) ) {
			return isset( $features->EANEnabled ) ? $features->EANEnabled : null;
		}

		// nothing found
		return false;
	} // getEANEnabledForCategory()

	

	/* the following methods could go into another class, since they use wpdb instead of EbatNs_DatabaseProvider */
	
	static function getAll() {
		global $wpdb;	
		$table = $wpdb->prefix . self::table;
		$profiles = $wpdb->get_results("
			SELECT * 
			FROM $table
			ORDER BY cat_name
		", ARRAY_A);		

		return $profiles;		
	}

	static function getItem( $id, $site_id = false ) {
		global $wpdb;	
		$table = $wpdb->prefix . self::table;
		
		// when site is US (0), find eBay Motors categories (100) as well
		$where_site_sql = $site_id === false ? '' : "AND site_id ='".esc_sql($site_id)."'";
		if ( $site_id === 0 || $site_id === '0' ) $where_site_sql = "AND ( site_id = 0 OR site_id = 100 )";

        $item = $wpdb->get_row( $wpdb->prepare("
			SELECT * 
			FROM $table
			WHERE cat_id = %s
			$where_site_sql
		", $id
		), ARRAY_A);

		return $item;		
	}

	static function getCategoryName( $id, $site_id = null ) {
		global $wpdb;

		$table = $wpdb->prefix . self::table;
		$args = array( $id );
		$site_id_sql = '';

		if ( !is_null($site_id) ) {
		    $site_id_sql = " AND (site_id = %d";
			if ( $site_id == 0 ) {
				$site_id_sql .= " OR site_id = 100";
			}
			$site_id_sql .= ")";

		    $args[] = $site_id;
        }

		$value = $wpdb->get_var( $wpdb->prepare("
			SELECT cat_name 
			FROM $table
			WHERE cat_id = %s
			$site_id_sql
		", $args ) );

		return $value;		
	}

	static function getCategoryType( $id, $site_id ) {
		global $wpdb;	
		$table = $wpdb->prefix . self::table;
		$ebay_motors_sql = $site_id == 0 ? 'OR site_id = 100' : '';
		$value = $wpdb->get_var( $wpdb->prepare("
			SELECT leaf 
			FROM $table
			WHERE cat_id    = %s
			  AND ( site_id = %s
			  $ebay_motors_sql )
		", $id, $site_id ) );		

		$value = apply_filters_deprecated('wplister_get_ebay_category_type', array($value, $id), '2.8.4', 'wple_get_ebay_category_type' );
		$value = apply_filters('wple_get_ebay_category_type', $value, $id );
		return $value ? 'leaf' : 'parent';
	}

	static function getChildrenOf( $id, $site_id ) {
		global $wpdb;	
		$table = $wpdb->prefix . self::table;
		$ebay_motors_sql = $site_id == 0 ? 'OR site_id = 100' : '';
		$items = $wpdb->get_results( $wpdb->prepare("
			SELECT DISTINCT * 
			FROM $table
			WHERE parent_cat_id = %s
			  AND ( site_id     = %s
			  $ebay_motors_sql )
		", $id, $site_id 
		), ARRAY_A);		

		return $items;		
	}

	static function getStoreCategoryName( $id ) {
		global $wpdb;	
		$table = $wpdb->prefix . 'ebay_store_categories';
		$value = $wpdb->get_var( $wpdb->prepare("
			SELECT cat_name 
			FROM $table
			WHERE cat_id = %s
		", $id ) );		

		return $value;		
	}
	static function getStoreCategoryType( $id, $account_id ) {
		global $wpdb;	
		// $this->tablename = $wpdb->prefix . self::table;
		$table = $wpdb->prefix . 'ebay_store_categories';
		$value = $wpdb->get_var( $wpdb->prepare("
			SELECT leaf 
			FROM $table
			WHERE cat_id     = %s
			  AND account_id = %s
		", $id, $account_id ) );		

		return $value ? 'leaf' : 'parent';		
	}
	static function getChildrenOfStoreCategory( $id, $account_id ) {
		global $wpdb;	
		$table = $wpdb->prefix . 'ebay_store_categories';
		$sortby = ( get_option( 'wplister_store_categories_sorting', 'default' ) == 'default' ) ? 'order' : 'cat_name';
		$items = $wpdb->get_results( $wpdb->prepare("
			SELECT DISTINCT * 
			FROM $table
			WHERE parent_cat_id = %s
			  AND account_id    = %s
			ORDER BY `$sortby` ASC
		", $id, $account_id 
		), ARRAY_A);		

		return $items;		
	}

	// recursive method to get entire store category tree
	static function getEntireStoreCategoryTree( $id, $account_id ) {		

		// get account
		$accounts = WPLE()->accounts;
		$account  = isset( $accounts[ $account_id ] ) ? $accounts[ $account_id ] : false;
		if ( ! $account ) die('Invalid account!');

		// get StoreURL for account
		$user_details = maybe_unserialize( $account->user_details );
		$StoreURL     = $user_details->StoreURL;

		$items = self::getChildrenOfStoreCategory( $id, $account_id );
		foreach ( $items as &$item ) {

			// add store url
			$item['url'] = $StoreURL . '/?_fsub=' . $item['cat_id'];

			// these should be left out when returning JSON
			unset( $item['parent_cat_id'] );
			unset( $item['wp_term_id'] );
			unset( $item['version'] );
			unset( $item['site_id'] );
			unset( $item['account_id'] );

			if ( $item['leaf']      ) continue;
			if ( $item['level'] > 5 ) continue;
			$item['children'] = self::getEntireStoreCategoryTree( $item['cat_id'], $account_id );
		}

		return $items;		
	}


		
	/* recursively get full ebay category name */	
	static function getFullEbayCategoryName( $cat_id, $site_id = false ) {
		global $wpdb;
		$table = $wpdb->prefix . self::table;

		if ( intval($cat_id) == 0 ) return null;
		if ( $site_id === false ) $site_id = get_option('wplister_ebay_site_id');
		$ebay_motors_sql = $site_id == 0 ? 'OR site_id = 100' : '';

		$result = $wpdb->get_row( $wpdb->prepare("
			SELECT * 
			FROM $table
			WHERE cat_id    = %s
			  AND ( site_id = %s
			  $ebay_motors_sql )
		", $cat_id, $site_id ) );

		if ( $result ) { 
			if ( $result->parent_cat_id != 0 ) {
				$parentname = self::getFullEbayCategoryName( $result->parent_cat_id, $site_id ) . ' &raquo; ';
			} else {
				$parentname = '';
			}
			return $parentname . $result->cat_name;
		}

		// if there is a category ID, but no category found, return warning
        return '<span style="color:darkred;">' . __( 'Unknown category ID', 'wp-lister-for-ebay' ).': '.$cat_id . '</span>';
	}

	/* recursively get full store category name */	
	static function getFullStoreCategoryName( $cat_id, $account_id = false ) {
		global $wpdb;
		if ( intval($cat_id) == 0 ) return null;
		if ( ! $account_id ) $account_id = get_option('wplister_default_account_id');

		$result = $wpdb->get_row( $wpdb->prepare("
			SELECT * 
			FROM {$wpdb->prefix}ebay_store_categories
			WHERE cat_id     = %s
			  AND account_id = %s
		", $cat_id, $account_id ) );
		// $result = $wpdb->get_row('SELECT * FROM '.$wpdb->prefix.'ebay_store_categories WHERE cat_id = '.$cat_id.' AND account_id = '.$account_id );

		if ( $result ) { 
			if ( $result->parent_cat_id != 0 ) {
				$parentname = self::getFullStoreCategoryName( $result->parent_cat_id, $account_id ) . ' &raquo; ';
			} else {
				$parentname = '';
			}
			return $parentname . $result->cat_name;
		}

		// if there is a category ID, but no category found, return warning
        return '<span style="color:darkred;">' . __( 'Unknown category ID', 'wp-lister-for-ebay' ).': '.$cat_id . '</span>';
	}

	public static function getTradingCardsCategories() {
	    return ['183050', '183454', '261328'];
    }

	public static function getTradingCardsConditionDescriptions() {
		$conditions_and_descriptions = [
			261328 => [
				400010  => 'Near mint or better',
				400011  => 'Excellent',
				400012  => 'Very good',
				400013  => 'Poor'
			],
			183050  => [
				400010  => 'Near mint or better',
				400011  => 'Excellent',
				400012  => 'Very good',
				400013  => 'Poor'
			],
			183454  => [
				400010  => 'Near mint or better',
				400015  => 'Lightly Played (Excellent)',
				400016  => 'Moderately Played (Very Good)',
				400017  => 'Heavily Played (Poor)',
			]
		];
		return $conditions_and_descriptions;
	}

	public static function getTradingCardsDescriptorFields() {
		$fields = [
			27501   => [
				'name'  => 'Professional Grader',
				'grader_ids'  => [
					183050 => [
						275010  => 'PSA',
						275011  => 'BCCG',
						275012  => 'BVG',
						275013  => 'BGS',
						275015  => 'CGC',
						275016  => 'SGC',
						275017  => 'KSA',
						275018  => 'GMA',
						275019  => 'HGA',
						2750110 => 'ISA',
						2750112 => 'GSG',
						2750113 => 'PGS',
						2750114 => 'MNT',
						2750115 => 'TAG',
						2750116 => 'Rare',
						2750117 => 'RCG',
						2750120 => 'CGA',
						2750123 => 'Other'
					],
					261328 => [
						275010  => 'PSA',
						275011  => 'BCCG',
						275012  => 'BVG',
						275013  => 'BGS',
						275014  => 'CSG',
						275015  => 'CGC',
						275016  => 'SGC',
						275017  => 'KSA',
						275018  => 'GMA',
						275019  => 'HGA',
						2750110 => 'ISA',
						2750112 => 'GSG',
						2750113 => 'PGS',
						2750114 => 'MNT',
						2750115 => 'TAG',
						2750116 => 'Rare',
						2750117 => 'RCG',
						2750120 => 'CGA',
						2750123 => 'Other'
					],
					183454 => [
						275010  => 'PSA',
						275011  => 'BCCG',
						275012  => 'BVG',
						275013  => 'BGS',
						275015  => 'CGC',
						275016  => 'SGC',
						275017  => 'KSA',
						275018  => 'GMA',
						275019  => 'HGA',
						2750110 => 'ISA',
						2750111 => 'PCA',
						2750112 => 'GSG',
						2750113 => 'PGS',
						2750114 => 'MNT',
						2750115 => 'TAG',
						2750116 => 'Rare',
						2750117 => 'RCG',
						2750118 => 'PCG',
						2750119 => 'Ace',
						2750120 => 'CGA',
						2750121 => 'TCG',
						2750122 => 'ARK',
						2750123 => 'Other'
					],
				]
			],
			27502   => [
				'name'  => 'Grade',
				'grade_ids' => [
					275020  => 10,
					275021  => 9.5,
					275022  => 9,
					275023  => 8.5,
					275024  => 8,
					275025  => 7.5,
					275026  => 7,
					275027  => 6.5,
					275028  => 6,
					275029  => 5.5,
					2750210 => 5,
					2750211 => 4.5,
					2750212 => 4,
					2750213 => 3.5,
					2750214 => 3,
					2750215 => 2.5,
					2750216 => 2,
					2750217 => 1.5,
					2750218 => 1,
					2750219 => 'Authentic',
					2750220 => 'Authentic Altered',
					2750221 => 'Authentic - Trimmed',
					2750222 => 'Authentic - Coloured'
				]
			],
			27503 => [
				'name'  => 'Certification Number',
				'value' => ''
			]
		];

		return $fields;
	}
	
	
} // class EbayCategoriesModel
