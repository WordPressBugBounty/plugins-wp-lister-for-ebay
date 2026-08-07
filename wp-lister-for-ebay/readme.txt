=== WP-Lister Lite for eBay ===
Contributors: wp-lab
Tags: ebay, woocommerce, products, export
Requires at least: 4.2
Tested up to: 7.0
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

List products from WordPress on eBay. The easy way.

== Description ==

WP-Lister connects your WooCommerce shop with your eBay Store. You can select multiple products right from your products page, select a profile to apply a set of predefined options and list them all on eBay with just a few clicks.

We worked hard to make WP-Lister easy to use but flexible. The workflow of listing items requires not a single click more than neccessary. Due to its tight integration in WordPress you will feel right at home.

= Features =

* list any number of items
* create listing profiles and apply multiple products
* verify items and get listing fees before actually listing them
* choose categories from eBay and your eBay Store
* national and international shipping options
* support for product variations
* create simple listing templates using WordPress post editor
* advanced template editor with HTML / CSS syntax highlighting
* download / upload listing templates – makes life easy for 3rd party template developers

= Localization =

* english
* german
* french
* italian
* spanish
* dutch
* korean
* latvian
* bulgarian

= Screencast =

http://www.youtube.com/watch?feature=player_embedded&v=XvbHob8pfes

= More information and Pro version =

Visit <https://www.wplister.com/plugins/wp-lister/> to read more about WP-Lister including documentation, installation instructions and user reviews.

To find out more about the different versions have a look on our [feature comparison table](https://www.wplister.com/plugins/wp-lister/feature-comparison/).

== Installation ==

1. Install WP-Lister for eBay either via the WordPress.org plugin repository, or by uploading the files to your server.
2. After activating the plugin, visit the new "eBay" page and follow the setup instructions. 

== Frequently Asked Questions ==

= Does WP-Lister work with all eBay sites? =

Yes, it does.

= What are the requirements to run WP-Lister? =

WP-Lister requires a decent version of WordPress (4.2+) with WooCommerce (3.0+) installed. Your server should run on Linux and have PHP 5.6 or better with cURL support.

Please check out the [list of incompatible hosting providers](https://docs.wplab.com/article/8-wp-lister-for-ebay-requirements) as well. If your provider is on that list, we will not be able to provide any kind of support.

= I use products variations on my site but eBay doesn’t allow variations in the selected category. How can I find out in which categories variations are allowed? =

To learn more about variations and allowed categories you should visit this page: <http://pages.ebay.com/help/sell/listing-variations.html>. There you will find a link to eBay’s look up table for categories allowing variations. If you can only list to categories where no variations are allowed, consider purchasing WP-Lister Pro which can split variations into single listings.

= I already have listed my products on eBay. Can WP-Lister import them to WooCommerce? =

No, WP-Lister itself was created to let you manage your products in WordPress - and list them *from* WordPress *to* eBay. 

But if you need to import all your items from eBay to WooCommerce first to be able to use WP-Lister, you can use the [importer add-on plugin](https://www.wplister.com/plugins/import-from-ebay-to-woocommerce/) we developed to get you started. Since importing from eBay is rather complex and support intensive this add-on plugin does have a price tag attached. 

= Does WP-Lister support windows servers? =

No, and there are no plans on adding support for IIS.

= Are there any more FAQ? =

Yes, there are! Please check out our growing knowledgebase at <https://www.wplister.com/plugins/wp-lister/faq/>.

= Is there a WP-Lister for Amazon? =

Yes, there is. WP-Lister for Amazon is currently in beta and we still have to work on the documentation, but you are welcome to give it a try: <https://wordpress.org/plugins/wp-lister-for-amazon/>

= How can I report security bugs? =

You can report security bugs through the Patchstack Vulnerability Disclosure Program. The Patchstack team help validate, triage and handle any security vulnerabilities. [Report a security vulnerability.](https://patchstack.com/database/vdp/wp-lister-for-ebay)

== Screenshots ==

1. Listings Page
2. Orders Page
3. Profile Editor - part 1
4. Profile Editor - part 2
5. Profile Editor - part 3
6. Template Editor

== Changelog ==
= 3.8.10 - 2026-08-07 =
* Security: fixed a stored cross-site scripting vulnerability that could be triggered without an account. The AJAX endpoint used by external cron services accepted arbitrary request parameters and wrote them into the eBay log table, where the listings log screen rendered parts of them unescaped back to an administrator. Request payloads are now sanitised - parameter names as well as values - before they are stored, and every value the log table lifts back out of a stored row is escaped on output. Only sites with "Log to database" enabled were affected. Reported responsibly via Wordfence; our thanks to the reporter and to the Wordfence team.

= 3.8.9 - 2026-07-30 =
* Security: fixed a SQL injection via the `orderby` and `order` request parameters on admin list screens, exploitable by users with the `manage_ebay_listings` capability (by default Administrator and Shop Manager) (CVE-2026-11973). Sort parameters are now validated against a strict allow-list of real sortable columns instead of being escaped, and pagination values are cast to integers. Reported responsibly by Yousof Nahya and Hamza Nour via Wordfence; our thanks to them and to the Wordfence team.

= 3.8.8 - 2026-06-03 =
* Fix: Defer eBay revisions for locked listings on REST API stock updates
* Fix: Migrate category download from deprecated GetCategories Trading API to Taxonomy REST API
* Fix: Quantity column sorting incorrect due to NULL quantity_sold and variable product mismatch
* Fix: Cast product_id to int to prevent type mismatch
* Fix: Unknown column 'listing_title' error in logArchiveAction
* Fix: Grid editor price changes not saving or triggering revisions
* Fix: Site details not saving when ebay_sites row is missing
* Fix: Deprecated xml_set_object() function in PHP 8.4
* Dev: Add filter hooks for the WooCommerce Multi Inventory plugin by welaunch
* Dev: Add performance warning to "Show eBay product totals" setting
* Dev: Domain changed to wplister.com

= 3.8.7.1 - 2026-02-18 =
* Fix: eBay Tracking metabox Javascript not executing

= 3.8.7 - 2026-02-17 =
* Fix: REST API permission check allowing unauthenticated access
* Fix: Refetch tracking data when using background task to complete sale on eBay
* Fix: Currency format handling for European decimal separators
* Tweak: Updated Max WP Version and WC tested up to values
* Tweak: Removed legacy Add Account form
* Dev: Replace deprecated wc_enqueue_js() with wp_add_inline_script()

= 3.8.6 - 2026-01-28 =
* New: Setting to disable the automatic archiving of listings
* Fix: Profile Secondary Category form displays wrong value due to key mismatch
* Fix: Profile secondary category setting ignored when category mapping exists
* Fix: Bulk edit clears custom eBay Start Price when field is left empty
* Fix: Preparing a listing overwrites any existing product-level Item Conditions without checking
* Fix: Null pointer exception when processing refunds with corrupted data
* Fix: Order sync infinite loop caused by inclusive timestamp boundary
* Fix: Fatal error when verifying listings without assigned profiles
* Fix: License UI deadlock when activation flag set without credentials
* Fix: Hidden variation prices included in display and flatten calculations
* Fix: Apply unit quantity decimal fix to product-level attributes
* Fix: Unit quantity decimal separator handling for EU decimals
* Fix: SiteID is incorrect when relisting to eBayMotors
* Fix: Auto-relist infinite rescheduling loop and processing order
* Fix: Double profile price adjustment in listings table for simple products
* Fix: URL-decode taxonomy names for proper variation attribute display
* Fix: Prevent VAT calculation on eBay-collected fees
* Fix: "Placed on eBay" filter conflicts with Amazon plugin filter highlighting
* Fix: eBay Fee label showing on non-eBay orders with discount fees
* Fix: Only set the StoreFront if at least one store category has a valid ID
* Fix: PHP Warning: preg_match(): Unknown modifier 't'
* Dev: Ajax Handler security fixes

= 3.8.5 - 2025-11-19 =
* Fix: Packaging and Handling Cost for International Shipping always showing 1
* Fix: Double encoding of variation values causing Variation Specifics Mismatch error
* Fix: Security fixes
* Fix: Match Product window is blank if the product title doesn't return any matches
* Fix: Additional fix to check for the value of the Secondary Store Category ID
* Fix: Extending the WC_Rest_Controller class when WC isn't active is causing a fatal error
* Fix: Skip setting the SecondaryCategory to 0 if no category is selected
* Fix: Don't read MPNs for variations if it is disabled in the settings
* Fix: Profile price adjustments ignored for simple products in listings table
* Dev: Only update admin message transient when messages were displayed

= 3.8.4 - 2025-10-02 =
* Fix: Decode HTML entities prior to sending them to eBay as item attributes
* Fix: Undefined array key "custom_tracking_link"
* Fix: Switching profiles should overwrite product-level auction type and duration
* Fix: Error when trying to access $Pictures->getPicture()
* Fix: Use eBay Order Number setting not working with HPOS
* Fix: Allow zero-quantity variable listings when Out-of-Stock Control is enabled
* Fix: Quantity check for items returning FALSE even when Quantity is set to 1

= 3.8.3 - 2025-09-08 =
* New: Added support for TranslatePress
* Fix: Include the price of variations for deletion to prevent getting Invalid Price errors when revising parent variables that are out of stock
* Fix: Added HPOS support for Order Number searching
* Fix: Item Specifics form not rendering
* Fix: Edit Product page notices
* Fix: JobRunner.js syntax error
* Fix: Count value for Not on eBay not recognizing the Hide from Unlisted option
* Fix: Not on eBay filter not showing all products
* Fix: Double-encoding bug in wple_encode_url()
* Fix: WooCommerce order refunds not calculating correctly due to tax handling
* Fix: JS error preventing the loading of Item Specifics
* Tweak: Accounts row actions will now always be visible

= 3.8.2.1 - 2025-06-26 =
* Hotfix: Reverted calling woocommerce_update_product due to fatal errors

= 3.8.2 - 2025-06-26 =
* New: Added tool to clear the EPS (eBay Picture Services) from all listings
* New: Added safe mode setting in the template editor page
* Fix: AdjustmentAmount now properly handled as refund when negative value, preventing incorrect fee processing
* Fix: Set the refund_payment property to false when calling wc_create_refund() to tell payment methods not to process the refund
* Fix: Condition attribute not getting displayed if no other attributes exist for the product
* Fix: Link auctions setting not showing correctly for GTC listings
* Fix: Item Specifics not loading for some marketplaces
* Fix: Make sure the default Site ID matches the current default account's Site ID
* Fix: Moved refund processing to after the initial order has been saved
* Fix: Do not record AdjustmentAmount if the Record Fees setting is disabled
* Fix: Use get_meta on WC_Order_Refund objects
* Fix: Make HTTP errors skippable in the JobRunner window
* Fix: Disable automatic relisting and background inventory checks on staging sites
* Tweak: Trigger the woocommerce_update_product action after reducing item stock from eBay orders to notify Square about changes
* Dev: Added support for updating Trading Cards' grading attributes via REST API
* Dev: Added new parameters to the wple_orderbuilder_update_order_status hook
* Dev: New filter `wple_templates_directory` to allow 3rd-party code to change the location of templates
* Dev: Removed deprecated [[widget_*]] shortcodes

= 3.8.1 - 2025-05-13 =
* New: Added support for the new Global Unique ID in WooCommerce
* Fix: Security patch for ticket #70341
* Fix: Formatting issue when displaying the number of bids on the View Product page
* Fix: Do not print/echo errors during REST requests
* Fix: Fixed Quantity not getting implemented by variable products on the Listings table page
* Fix: Split variation title issue due to the double-serialization of variation attributes
* Fix: Map Size Replacements not being applied to Item Specifics
* Dev: Added the ability to change the Profile ID of a listing using the REST API
* Dev: ConditionDescriptorsType data type issue
* Dev: Grouped ActionScheduler tasks
* Dev: Accept the text version of the listing condition when publishing or updating a listing using the REST API


= 3.8.0 - 2025-04-27 =
* New: Record Buyer VAT ID if provided by eBay
* New: Support for updating product-level Item Specifics using the REST API (beta)
* Tweak: Add links to the Duplicate Listings report table
* Tweak: Moved the provider value of the Shipment Tracking metadata to the custom_tracking_provider property
* Tweak: Change the context when fetching the order tracking information from view to edit to bypass the cache
* Tweak: Added a fallback method with file_put_contents fail when saving templates
* Fix: Changed calls triggered by the plugins_loaded to the init event to prevent getting the _load_textdomain_just_in_time warning
* Fix: Cannot access offset of type string on string
* Fix: Title prefix and suffix for split variations are still pulled from the parent product
* Fix: Mapped categories not getting loaded for new/unlisted products
* Fix: Warning when trying to access HazMat Statements
* Fix: Include variation price in the request when deleting listing on eBay
* Fix: Error when the WPL_WooOrderBuilder::updateShippingTotal() is NaN
* Dev: Scope warning of the WPL_Model::handle_error_code property
* Dev: New filter `wple_listings_search_description`
* Dev: Changed the priority of handle_woocommerce_order_status_update to allow shipment tracking plugins to store the tracking data first
* Dev: Commented out the action_scheduler_queue_runner_time_limit add_filter call which could be causing stalled actions in Action Scheduler
* Dev: Increased the column length for the ShippingAddress_City

= 3.7.7 - 2025-03-31 =
* New: Ability to add eBay Start Price via Bulk Edit
* Fix: Updated the call to search for products to use the Browse API
* Fix: Various deprecated code warnings
* Fix: Improved support for the Aelia Currency Switcher plugin
* Fix: Bottom bulk actions form displaying a Link Expired error page
* Fix: Error file_exists(): Passing null to parameter #1 ($filename)
* Fix: Error Cannot access offset of type string on string
* Fix: Decode the return value from ProductWrapper::getBrand()
* Fix: Added Near Mint condition to Ungraded Trading Cards
* Dev: Added the filter `wple_variation_attribute_value`
* Dev: Store the Tax Tracking Code in a separate order meta (e.g. IOSS, ABN)
* Dev: New filter wple_append_tax_tracking_to_company

= 3.7.6 - 2025-02-28 =
* New: Added setting to record Seller Promotions as order discounts
* Fix: Attribute Mapping setting in the Profile page always set to Yes
* Fix: Errors while trying to access non-existent pictograms and signal words
* Fix: Primary category getting loaded from a different Site ID in some cases
* Fix: `Cannot access offset of type string on string` while trying to access the profile without a valid profile_details data
* Fix: Creation of dynamic property WPL_API_Hooks::$dblogger
* Dev: Removed deprecated function utf8_encode()

= 3.7.5.1 - 2025-02-15 =
* Fix: Error in PHP8+ when testing for a possible undefined constant
* Fix: Various code warnings

= 3.7.5 - 2025-02-12 =
* Tweak: Rename the attribute WC Brands Addon to WooCommerce Brands
* Fix: Item Specifics are always being loaded from the default category
* Fix: Errors from background tasks showing up in the backend
* Dev: Allow WPLE to convert armscii8 to UTF8

= 3.7.4 - 2025-02-10 =
* New: Added the ability to edit Manufacturers and Responsible Persons
* Fix: Variation start price not getting assigned when the Custom Price field is disabled
* Fix: Always send the manufacturer and responsible persons' countries in uppercase
* Dev: Fixed support for the WooCommerce Perfect Brands plugin
* Dev: Errors from the Listings check are not getting displayed

= 3.7.3 - 2025-01-23 =
* New: Added support for pulling Manufacturer and Responsible Persons data from product attributes
* New: Added a tool that fixes the endless loop when running the delayed profile update routine
* Fix: Item Specifics not loading in the Edit Product screen
* Fix: Grid Listings loading issue due to AG-Grid version incompatibility
* Fix: Format decimals correctly using wc_format_decimal()
* Fix: Ignore Older Orders Date not getting pulled correctly
* Dev: Switched the dropdowns from Chosen to SelectWoo

= 3.7.2.2 - 2025-01-08 =
* Fix: eBay profiles and store categories are not getting downloaded into WP-Lister

= 3.7.2.1 - 2025-01-08 =
* Fix: Incomplete HazMat properties getting sent to eBay
* Fix: Warning caused by as_next_scheduled_action() getting called too early
* Fix: Undefined array key gpsr_enabled
* Dev: Rolled back composer packages to retain compatibility with PHP 7.4

= 3.7.2 - 2025-01-06 =
* New: Added the shortcodes [ebay_gpsr_manufacturer] and [ebay_gpsr_responsible_persons]
* Fix: The Inventory Check tool now compares against sale prices if enabled
* Fix: Item Specifics for the default eBay category not getting rendered
* Fix: Prices for variations not getting stored in the variations cache
* Fix: Javascript error `Invalid assignment to const CategoryConditionsData`
* Fix: Warning `Undefined property stdClass::$errors`
* Fix: Warning `Cannot access offset of type string on string`
* Fix: Item conditions dropdown not fetching values for the default eBay category
* Fix: Various code warnings
* Fix: Save WC_Order after changing the `stock_reduced` property
* Fix: Check for duplicate Manufacturers and Responsible Persons before saving
* Fix: Product-level Manufacturer and Responsible Persons not clearing after removing and saving
* Tweak: Made the View on eBay link in the Edit Order page open in a new tab
* Dev: Updated GuzzleHttp/Guzzle
* Dev: New methods to help in pulling GPSR data from the DB

= 3.7.1.1 - 2024-12-14 =
* Fix: Fatal error in the class EbayAddress
* Fix: ItemBuilderModel::isGpsrEnabled() not returning the expected result

= 3.7.1 - 2024-12-13 =
* Fix: Javascript error in the Edit Profile page preventing the Responsible Persons field from rendering
* Fix: Error in the Edit Product screen (explode(): Argument #2 ($string) must be of type string, array given)
* Fix: CSS issues with the GPSR table
* Fix: Character encoding issue in the Manufacturer and Responsible Persons data
* Fix: Display issue in the jQuery Chosen fields

= 3.7.0 - 2024-12-11 =
* New: Support for the General Product Safety Regulation (GPSR)
* Fix: Undefined profile attributes messing up the default properties
* Fix: Check if the set_time_limit() function is available before using it
* Fix: `Unsupported operand types` in TransactionsModel::getRealTransactionID()
* Fix: Item Specifics for the default category not getting loaded in the Edit Profile page
* Fix: Prevent sending listings to the wrong account by initializing a new eBay session with the correct eBay account before calling ReviseInventoryStatus
* Fix: Improved the searching using the REST API using the `search` parameter
* Fix: Variable GTINs not getting accessed correctly
* Fix: Item Specifics getting loaded first from the profile instead of the mapped category
* Fix: Error generated in commented code in the Edit Product page
* Fix: Error `Call to a member function getId() on Int` in wc-emails.php
* Fix: MinMax price in the Inventory Check tool does not take into account the sale price
* Dev: New filter `wple_product_send_stock_notifications`
* Dev: New filter `wple_wc_shipping_line_item`
* Dev: New filter `wple_map_secondary_category`
* Dev: Removed the deprecated GeteBayOfficialTime calls
* Dev: Updated the eBay REST API and added support for the Marketplace, Document, and Video APIs

= 3.6.7.1 - 2024-10-03 =
* Hotfix: `Call to a member function get_id()` breaking order imports

= 3.6.7 - 2024-10-02 =
* Fix: Persistent errors getting displayed

= 3.6.6 - 2024-09-26 =
* Fix: Grid Editor not displaying the listings
* Fix: Errors returned during the BuildItem process not getting displayed
* Fix: DB error when trying to update a log using an empty $data array
* Fix: Error in the \WPLab\Ebay\Listings\Listing::getMsrpPrice() method
* Fix: Fatal error when retrieving the number of hidden columns
* Fix: Secondary store category not getting published
* Fix: Warning `Deprecated: Automatic conversion of false to array is deprecated`
* Tweak: Skip setting the ReturnPolicy if a Returns Business Policy is being used

= 3.6.5 - 2024-08-28 =
* Fix: Fatal error when trying to access get_meta() on an invalid product
* Fix: Warnings in the Add Profile page
* Fix: Potential XSS issue in the profile page
* Fix: Split variations not getting the correct ConditionID value
* Dev: New filters `wple_variation_attribute_name` and `wple_item_specifics_attribute_name`

= 3.6.4 - 2024-08-19 =
* Fix: Listing errors not getting displayed in the Listings page
* Fix: Apply profile price modifier to eBay price even if the Custom eBay Price UI is disabled
* Fix: Use Sale Price setting getting ignored
* Dev: New filter `wple_always_use_variation_parent_description`

= 3.6.3 - 2024-08-07 =
* Hotfix: eBay Start Price getting ignored

= 3.6.2 - 2024-08-05 =
* Fix: Unlock All Listings tool's functionality
* Fix: Error when creating WC_Order `Cannot use object of type WC_Order as array`
* Fix: Notice of trying get property `value` of non-object
* Fix: Profile price getting lost in the ItemBuilderModel::buildPrices call
* Fix: Categories with disabled ConditionEnabled property causing the `soap-fault: Input data is invalid` error
* Fix: Cannot access offset of type string on string
* Fix: UPC and EAN not getting read for split variations

= 3.6.1 - 2024-07-30 =
* Fix: Parent MPN being used by the variations causing a `duplicate custom variation label` error
* Fix: Added a check to prevent assigning duplicate categories to listings
* Fix: Security patch #66898

= 3.6.0 - 2024-07-17 =
* New: REST API Endpoint to edit, prepare, verify, publish, and revise listings
* New: Tool to archive all sold and ended listings
* New: Added support for Order Attribution Tracking in WooCommerce
* Fix: Security fixes
* Fix: Use variation description for split variations
* Fix: MaybeMintToken() failing when the current and expiry date and time are the same
* Fix: Backwards compatibility with set_order_stock_reduced() and get_order_stock_reduced()
* Fix: Skip Importing Orders setting not getting saved
* Fix: Scope issue for eBay order address in WC orders
* Fix: Profile price getting applied twice
* Fix: Disabled template uploads by default
* Fix: Invalid profile data causing fatal errors
* Fix: Warning when loading the shipping providers in WP-Lister Lite
* Fix: Function name collision for usort_reorder()
* Fix: Warning when checking for eBay Plus orders
* Fix: Missing the Custom Attributes from the Attributes dropdown in Edit Product pages
* Fix: Fixed Quantity rules not getting applied to ReviseInventoryStatus calls
* Fix: Fatal error when GetUserPreferences returns null
* Fix: Warning in preg_replace in the Edit Profile page
* Fix: Table converter skipping tables with utf8mb3 charsets
* Fix: Shipment tracking data getting recorded multiple times
* Fix: Warning from WooCommerce Shipment Tracking when processing orders created by WPLE
* Fix: Profile details not getting saved correctly
* Fix: AU shipping details not getting downloaded
* Fix: Start Price not getting set when the Custom eBay Prices setting is disabled
* Fix: eBay Motors categories not getting displayed
* Fix: Check wc_get_product() return value before using it
* Fix: Fatal Error in WPL_InventoryCheck
* Fix: Warnings when recording shipment tracking details for WC Shipment Tracking
* Fix: Warnings in the TransactionsModel class
* Fix: Added a 2-minute buffer when minting tokens instead of waiting for them to expire
* Fix: Double submissions on the listings page on reload
* Fix: Load and use the parent dimensions as the default variation dimensions
* Tweak: Display the Listing ID in the Listings table
* Tweak: Skip completing eBay orders again during HPOS sync
* Tweak: WooCommerce not displaying negative eBay Fees in the Order Summary
* Tweak: Show orders with a CheckoutStatus of Incomplete as Payment Incomplete in the Orders table
* Dev: WSDL version bumped to 1311
* Dev: Minor code cleanup in ItemBuilderModel
* Dev: New filter wple_listing_calculated_quantity
* Dev: Deprecated code warnings
* Dev: New \WPLab\Ebay\Listings\Listing class
* Dev: Backwards compatibility for WC_Order::set_order_stock_reduced()
* Dev: Backwards compatibility for the wple_process_single_variation_title parameter
* Dev: Rename the TransactionType class to prevent clashing with TakePayments
* Dev: Added the filter wple_name_your_price_enabled to disable support for the Name Your Price plugin

= 3.5.11 - 2024-03-14 =
* Fix: Fatal Error in the Advanced Settings page

= 3.5.10 - 2024-02-19 =
* Fix: Use wp_remote_fopen() to get around allow_url_fopen restriction
* Fix: Check the input URL before including it in the request to add or revise eBay listings
* Dev: Display Pro features in WP-Lister Lite

= 3.5.9 - 2024-02-02 =
* Fix: Grid Editor not loading the listings
* Dev: Listings table not applying the wple_ebay_price filter
* Dev: Run a credentials check when viewing eBay logs

= 3.5.8 - 2024-01-18 =
* Fix: Escape input data used in links to prevent XSS
* Fix: Primate Store Category getting overwritten when a Secondary Store Category is set
* Fix: Warnings when importing orders from eBay
* Fix: Check for staging site status when listening to frontend checkouts
* Dev: Removed deprecated code

= 3.5.7 - 2024-01-02 =
* Fix: List on eBay action not working when WC Block Editor is enabled
* Fix: Error when trying to list a product with no primary category set
* Fix: Removed the deprecated Item.ShippingDetails.CalculatedShippingRate.OriginatingPostalCode
* Dev: Added the action wple_reset_item to reset sold and archived listings to their prepared state
* Dev: Set the HTTP version to 1.1 in the eBay API library

= 3.5.6 - 2023-12-05 =
* Fix: Missing Condition Description field for non-Trading Card categories
* Fix: ContentDescriptor not being added when no category is set in the profile
* Fix: Item Conditions not loading for mapped categories
* Fix: SQL error when downloading larger messages from eBay
* Fix: Error when adding tracking details to WooCommerce
* Dev: Fixed sandbox URL

= 3.5.5 - 2023-11-14 =
* New: Added support for the new Category Descriptor fields for Trading Cards
* Fix: Warnings when displaying admin messages
* Fix: Lite version broken Edit Orders page
* Fix: Missing Category Tree ID for BE marketplace
* Fix: Custom eBay title not getting the prefix and suffix from the profile
* Fix: Archived GTC listings not getting cleared automatically
* Fix: Some sites are not getting notified of new releases
* Dev: Added the filter wple_product_get_price

= 3.5.4 - 2023-10-18 =
* Fix: Error in renaming Listing Template functions
* Fix: SQL error when getting an empty API response
* Fix: Date created not showing the correct value for relisted items
* Fix: License getting removed on HTTP errors

= 3.5.3 - 2023-10-11 =
* New: Added the Overdue Order Shipments check to notify users of orders that need to be shipped out
* Fix: Variable clash causing an error when viewing eBay Plus orders
* Fix: Error trying to access profile data
* Fix: Condition Description not getting sent to eBay

= 3.5.2 - 2023-09-28 =
* Tweak: Use WC_Data::save_meta_data() whenever possible
* Fix: Refund reference IDs not getting recorded
* Fix: Check the return value of wc_get_order() prior to using it
* Fix: Error when calling property_exists() on missing orders
* Fix: Orders table not showing WPLE columns and meta boxes

= 3.5.1 - 2023-09-20 =
* New: Added support for the ConditionDescriptor field for the other trading card categories
* Fix: Name clash in GuzzleHttp
* Fix: Missing second parameter for the handle_woocommerce_order_status_update() method

= 3.5.0 - 2023-09-08 =
* New: Support for WooCommerce's High Performance Order Storage feature
* New: Added the Post Italiane shipping provider
* New: Added a setting to select the product statuses that can be published to eBay
* New: Variation Size Mapping to display different variation options to eBay depending on the marketplace
* Tweak: Improved licensing system with regular status checks
* Tweak: Improved performance when searching for listings
* Tweak: Send stock monitor notifications to the admin email
* Tweak: Item Specifics UI
* Fix: Fatal error in calculating Product Bundles stocks
* Fix: Fatal error when editing post comments
* Fix: Fatal error in the Lite version when importing orders from eBay
* Fix: Error trying to assign a Secondary Store Category
* Fix: Error saving response_url from eBay Messages
* Fix: Error when saving an empty response from eBay
* Fix: Warnings in the Orders page
* Fix: Notices in the Edit Product page
* Fix: Missing CategoryTreeID for NL-BE marketplace
* Fix: Timeout while trying to activate the license
* Fix: Set WC order's status to Refunded when the full order amount has been refunded on eBay
* Fix: Refunds not getting processed when "refund including line items" is selected
* Fix: Errors in the Listings page when one or more listings are assigned to a non-existing profile
* Fix: Feedback text not getting stored and displayed in the View/Edit Order page
* Fix: Warnings in the Edit Profile page
* Fix: eBay total sales tax being added as line taxes
* Dev: Removed references to some order attributes that have been marked as deprecated by eBay
* Dev: Removed unnecessary logs
* Dev: Added missing primary keys on some tables
* Dev: Added a prefix to the instance ID to fix some activation errors
* Dev: Updated GuzzleHttp/Psr7 to 1.9.1

= 3.4.7 - 2023-08-24 =
* Fix: Pull Item Specifics from the WPLab servers
* Fix: Run check_admin_referer() prior to displaying log entries


= 3.4.6 - 2023-08-22 =
* Hotfix: Unable to pull Item Specifics from the eBay REST API

= 3.4.5 - 2023-05-09 =
* Hotfix: Error in the fronted product page when building the compatibility table

= 3.4.4 - 2023-05-08 =
* New: Added the option to store the eBay Order ID as an order note and a customer note
* New: Added a new setting to skip processing order updates for older orders
* Tweak: Skip adding order notes to non-eBay orders
* Fix: Checkout message from eBay not being imported
* Fix: Clear All Listing Policies tool sometimes goes on an endless loop
* Fix: Sorting bug in the Quantity column of the WP-Lister Listings table
* Fix: Error in the Listings table when a profile used by one of the listings gets deleted
* Fix: Token error when uploading images to the EPS
* Fix: Error in ItemBuilderModel when generating picture sets for variations
* Dev: Added the filters wple_get_item_compatibility_list and wple_get_item_compatibility_names
* Dev: Added the action hooks wple_set_compatibility_list and wple_set_compatibility_names

= 3.4.3 – 2023-03-20 =
* Tweak: Only allow setting the Paid property when completing a sale to either TRUE or not set - never FALSE
* Fixed: Javascript error that causes multiple repeated shipping fields in the profile and edit product pages
* Fixed: Missing Grid Editor CSS files
* Fixed: FindProducts via EPID not returning results
* Fixed: Fix: Image URLs getting double encoding when uploading to EPS
* Dev:   Added new filters to customize the minimum image dimensions: wple_listing_image_min_width and wple_listing_image_min_height
* Dev:   Translate item specific names using the wple_item_specific_name_translations filter for 3rd-parties
* Dev:   Added new filter to disable eBay Motors category importing wple_fetch_ebay_motors_categories

= 3.4.2 – 2023-02-23 =
* Added: Setting that lets WP-Lister override the "Prices entered with tax" WooCommerce setting for stores that have different tax settings from their eBay stores
* Added: Setting to add/remove the tax amount from the order total when creating orders from eBay
* Tweak: Replaced the edit_others_pages capability with edit_others_shop_orders to have access to orders and edit_others_products to view listings
* Tweak: Additional check to determine if a listing is GTC
* Fixed: Division by 0 error when getting quantity with bundled products
* Fixed: Shipping discount profiles are not getting downloaded
* Fixed: Check for existing email address to see if buyer already has a Customer account
* Fixed: Warning "Undefined array key "total"
* Fixed: Unable to use multiple values in Item Specifics due to size limit
* Dev:   Remove calls to the deprecated methods WPL_WooOrderBuilder::updateLegacyOrderFromEbayOrder() and WPL_WooOrderBuilder::createLegacyOrderFromEbayOrder()

= 3.4.1 – 2023-01-24 =
* Added: Check for a _shipped_time postmeta to use when completing orders on eBay
* Fixed: GTC listings are getting ended and unlinked
* Fixed: Warnings in the Settings > Accounts page
* Fixed: Updated the maximum number of allowed listing images from 12 to 24
* Fixed: Adding a shipping service for Freight shipping caused errors for some sellers
* Dev: Added new filter wple_data_pre_handleItemDetail
* Dev: Added new action wple_post_handleItemDetail
* Dev: Added support for 3rd-party code to add order Shipped Time using the _shipped_time postmeta

= 3.4 – 2023-01-02 =
* Added: New shipping service for the Freight shipping type
* Fixed: Missing variations data results missing attributes in listing title 
* Fixed: Fix Listing Title method for split variations doesn't work when one or more variations is sold out
* Fixed: PHP Warning: Undefined index ebay_category_1_id 
* Tweak: Optimized database structure (changed ebay_order::details field to longtext)
* Dev: Improved storing log records to reduce file size
* Dev: Compatible with WooCommerce 7.2.x

= 3.3.5 – 2022-11-24 =
* Fixed: Content shortcodes were not getting processed when Force Immediate Revision option is enabled
* Fixed: Error when merging product item specifics with profile specifics (array_merge(): Argument #2 must be of type array)

= 3.3.4 – 2022-11-09 =
* New: Added option to deduct the eBay Fee (FVF) from the order total, and include the FVF in the line item meta data
* Tweak: Revise listing immediately if 'Revise on Update' is ticked, even when 'Background Revision' is also enabled
* Tweak: Trigger wplister_product_has_changed action when a product's sale price is changed by a scheduled sale
* Tweak: If the 'Use local product name/title in orders' option is enabled, use the variation's name for order line items
* Fixed: Item specifics defined on the product level should have priority when merged with item specifics defined on the profile level
* Fixed: Record the ShippedTime property when updating orders from eBay to prevent fatal errors with the WooCommerce Shipment Tracking plugin
* Fixed: Warnings: Undefined array key "post_id" / Undefined array key "OrderLineItemID"
* Fixed: Warning: Attempt to read property "Name" on null
* Fixed: Possible fatal error when clearing all product-level policies
* Dev: Added wple_shipping_method_title filter to change the shipping method title
* Dev: Added logging in the prepareProductForListing() method

= 3.3.3 – 2022-10-13 =
* Tweak: Skip listings with a fixed quantity when running the Inventory Check tool
* Tweak: Force ReviseInventoryStatus calls when the sale price schedule updates the prices
* Fixed: The API token could be showing as invalid after a UploadSiteHostedPictures call
* Fixed: Listing status filters getting ignored when SKU searching/sorting is enabled
* Fixed: Javascript error preventing some item specifics from loading on edit product page
* Fixed: Check for possible empty/invalid address from the DB to prevent a fatal error
* Fixed: Check for matching staging site pattern before running background revisions
* Fixed: Some PHP warnings could be shown on the developer tools page

= 3.3.2 – 2022-09-17 =
* Fixed: Listing titles containing UTF-8 characters could cause XML errors in EPS uploads
* Fixed: Select Profile bulk action is submitting the page when selected
* Fixed: Move to archive bulk action was getting ignored
* Fixed: Converting database tables to utf8mb4 could trigger warning in printing object variable
* Dev: Added filter wple_remove_variable_item_parent_sku
* Dev: Added filter wple_attribute_comma_separated_values

= 3.3.1 – 2022-08-26 =
* Tweak: Exclude product meta when cloning products
* Tweak: Uncluttered persistent messages shown during the import process
* Fixed: Freight service must submit an empty ShippingServiceOptions container
* Fixed: Fatal error "Attempt to assign property SellerProfiles" when running the Clean Policies tool
* Dev: Load the cart functions file to prevent getting a fatal error when calling wc_get_chosen_shipping_method_ids()

= 3.3.0 – 2022-08-12 =
* New: Display more detailed error messages in the Listings table
* Tweak: Update WooCommerce order even if the order status is complete to process possible refunds
* Tweak: Store and read eBayPlusTransaction details separately to improve performance on the WooCommerce Orders page
* Fixed: Check that a profile exists to prevent warnings
* Fixed: ReviseInventoryStatus getting passed an incorrect listing ID
* Fixed: Issue where 404 errors during import could halt the import process

= 3.2.12 – 2022-07-21 =
* Hotfix: Listings not getting marked as changed - bug introduced in 3.2.11
* New: Improved performance by useing object caching for pulling accounts from the DB
* Fixed: Check for custom eBay titles when looking for broken split variation titles
* Fixed: Tax code in the shipping address must only be added if there's any tax collected by eBay
* Fixed: Variations getting removed from the listing cache because of a missing Quantity key in the response object after ReviseVariationStatus

= 3.2.11 – 2022-07-11 =
* New: Display the default Item Specifics value from the listing profile
* New: Added the Fix Split Title action for split listings with missing suffixes
* Tweak: Rephrased the "Use local product name" setting
* Tweak: Apply the wple_orderbuilder_prices_include_tax filter when pulling the value of the option woocommerce_prices_include_tax
* Tweak: Improved the markItemAsModified() method and wplister_product_has_changed hook to handle products with multiple listings better
* Fixed: Use the new OAuth token to re-enable the find Matching Product feature
* Fixed: Make sure there's a valid oAuth token before getItemAspectsForCategory()
* Fixed: Clear last_errors when trying to revise variables with no changed variations
* Fixed: Check for the value of the filter wple_Activate_profile_update_checkboxes before running delayed profile update
* Fixed: Incorrect category name is returned because site_id is not getting used if 0 is passed in EbayCategoriesModel::getCategoryName()
* Fixed: Load the product thumbnail using WC_Product::get_image() instead of get_the_post_thumbnail()
* Fixed: Remove the key wple_job_reapply_profile_id to prevent the delayed "Applying Profile" modal from going on an infinite loop 
* Fixed: Record FinalValueFee on order updates from eBay
* Fixed: Implemented a fix for ATUM inventory plugins
* Fixed: Undefined property StdClass::$Site warning
* Dev: Added filter wple_split_variation_match_variation_attributes to allow listings to fallback to the old way of just comparing the post IDs
* Dev: Added the filter wple_profile_set_default_brand_mpn_attribute to disable the setting of default Brand and MPN attributes as ItemSpecs

= 3.2.10 – 2022-05-26 =
* Tweak: Display the item specifics for the default mapped category on new listings
* Tweak: The "Clean policies" operation now includes prepared and verified listings
* Tweak: Load a default list of shipping packages in case the eBay API returns an empty result
* Fixed: Revert stock changes made on active orders that have been cancelled
* Fixed: Category Special Features (additional Item Conditions) not getting downloaded and displayed in the profile page
* Fixed: Possible error "Call to undefined method stdClass::getListingDuration()" when updating orders
* Fixed: Possible error "Call to undefined method stdClass::setSellerProfiles()" when clearing policies
* Fixed: Possible warning "Undefined property stdClass::$PictureDetails" in the WP-Lister Listings table
* Fixed: Use the AspectUsage property to display required/recommended item specifics
* Fixed: Issue with very long values of the ShippingAddress_City field
* Fixed: Fixed an incorrect code and category tree ID for the eBay Motors site
* Fixed: Check for the GuzzleHttp\describe_type function to prevent "cannot redeclare" error
* Dev: Get the ListingDuration by accessing the property instead of using the method
* Dev: Added the filter wple_activate_profile_update_checkboxes to change the behavior of the checkboxes in the Edit Profile screen to be off by default

= 3.2.9 – 2022-05-06 =
* Fixed: Improved loading times by making sure that fetchCategorySpecifics() caches the data fetched from ebay
* Fixed: Issue where you could see the message "eBay does not allow attribute values longer than 65 characters" even though the item specific in question were not longer than 65 characters
* Fixed: Rare issue where a product's stock level could be set to 0 when updating the product in WooCommerce
* Dev: Added filter wple_item_specifics_cache_lifetime
* Dev: Compatible with WooCommerce 6.4.1

= 3.2.8 – 2022-04-06 =
* New: Include IOSS line in the address2 field if found
* Fixed: Warnings and notices getting thrown
* Fixed: GSP orders still including shipping costs
* Fixed: Prevent the Expired IAF Token errors from popping up regularly
* Fixed: Prevent getting a fatal error when the order data is incomplete
* Fixed: Check sold product stocks in batches to prevent memory limit errors
* Fixed: Item specifics with multiple values being sent as one comma-separated value
* Fixed: Background inventory check creating recurring schedule even when disabled
* Fixed: Incorrect marketplace code and default_category_id for Ireland marketplace
* Fixed: Disabled support for ATUM Product Levels, which was causing fatal errors. Would appreciate help from plugin author.
* Fixed: Unschedule inventory check jobs when Background Inventory Check has been disabled
* Fixed: Implemented workaround for the broken AU shipping details API call
* Dev: Normalize the bloginfo(url) value to always have a trailing slash to prevent different states from being passed to the auth server
* Dev: Switched from json_encode() to serialize() to prevent issues where json_encode() is missing most of the order data (beta)
* Dev: Compatible with WooCommerce 6.3.1

= 3.2.7 – 2022-02-18 =
* New: Record and store tax tracking number for Norway orders (VOEC No.)
* Tweak: Try to determine if WP-Lister should apply the DoesNotApply text to missing item specifics based on the aspect_required property
* Fixed: Mapped categories not displaying correctly in the Product Edit page
* Fixed: Templates per page not getting saved
* Fixed: PHP Error: Call to a member function getAspects() on null
* Fixed: PHP Error: Invalid argument supplied for foreach()
* Fixed: PHP Notice: Undefined property: stdClass::$oauth_token
* Dev: WC_Order_Item_Tax::set_rate_percent() is not available in WooCommerce 3.6
* Dev: Compatible with WooCommerce 6.2

= 3.2.6 – 2022-02-03 =
* Fixed: Possible conflict with other plugins that bundle the Guzzle HTTP library: "Uncaught Error: Call to undefined function GuzzleHttp\choose_handler()"

= 3.2.5 – 2022-02-02 =
* Fixed: Token expiry date getting overwritten when updating ebay account
* Tweak: Check for expired OAuth tokens and refresh if necessary prior to performing an API request

= 3.2.4 – 2022-01-31 =
* Fixed: Write the 'Unable to get new access tokens' error message to the log instead of displaying it to the user
* Tweak: Cache taxonomy API data (category aspects) in WP Transients to minimize the number of required API calls

= 3.2.3 – 2022-01-28 =
* Fixed: Issue where WP-Lister would be applying the template again and again
* Fixed: Check for OAuth Error #930 and retry the call if necessary
* Fixed: Tagify not allowing any options to be selected
* Fixed: Load the default account if none is provided
* Fixed: Updated the composer.json and Guzzle package to fix the missing method error 
* Dev: Store the prices_include_tax in the order meta applying the wple_orderbuilder_prices_include_tax filter

= 3.2.2 – 2022-01-23 =
* Fixed: Issue with access tokens not refreshing properly
* Fixed: Refreshed token was not getting stored
* Tweak: Increase the timeout value when minting a new token

= 3.2.1 – 2022-01-19 =
* Fixed: Added new columns in ebay_accounts table
* Fixed: Cast prices to float to prevent fatal errors

= 3.2.0 – 2022-01-18 =
* New: Added support for the Taxonomy API to replace the deprecated GetCategorySpecifics call
* New: Use OAuth authentication method instead of the deprecated AuthnAuth method
* Tweak: Disable Push to eBay (background revisions) if WP-Lister detects it's on a staging site
* Fixed: Show the mapped category in the Edit Product screen
* Fixed: Use cat_id to check for the custom "Other" store category
* Fixed: Prevent getting fatal errors when WooCommerce is deactivated
* Fixed: Make sure the set_shipping_phone() method exists to prevent possible errors on older WooCommerce versions
* Fixed: Use the ebay.com domain instead of the old ebaymotors.com
* Fixed: Possible is_ajax() is deprecated error

View the full changelog at https://www.wplister.com/plugins/wp-lister-for-ebay/changelog/

== Upgrade Notice ==

= 3.8.10 =
Security release. Fixes a stored cross-site scripting vulnerability that could be triggered without an account. Update is recommended for all users.

= 3.8.9 =
Security release. Fixes an authenticated SQL injection on admin list screens (CVE-2026-11973). Update is recommended for all users.
