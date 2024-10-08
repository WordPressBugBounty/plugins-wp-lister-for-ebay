<?php
/* Generated on 14.02.18 14:28 by globalsync
 * $Id: $
 * $Log: $
 */

require_once 'EbatNs_ComplexType.php';
require_once 'StoreSubscriptionLevelCodeType.php';
require_once 'StoreLogoType.php';
require_once 'StoreThemeType.php';
require_once 'StoreHeaderStyleCodeType.php';
require_once 'StoreItemListLayoutCodeType.php';
require_once 'StoreItemListSortOrderCodeType.php';
require_once 'StoreCustomHeaderLayoutCodeType.php';
require_once 'StoreCustomCategoryArrayType.php';
require_once 'StoreCustomListingHeaderType.php';
require_once 'MerchDisplayCodeType.php';

/**
  *       The configuration of an eBay Store.
  *     
 **/

class StoreType extends EbatNs_ComplexType
{
	/**
	* @var string
	**/
	protected $Name;

	/**
	* @var string
	**/
	protected $URLPath;

	/**
	* @var anyURI
	**/
	protected $URL;

	/**
	* @var StoreSubscriptionLevelCodeType
	**/
	protected $SubscriptionLevel;

	/**
	* @var string
	**/
	protected $Description;

	/**
	* @var StoreLogoType
	**/
	protected $Logo;

	/**
	* @var StoreThemeType
	**/
	protected $Theme;

	/**
	* @var StoreHeaderStyleCodeType
	**/
	protected $HeaderStyle;

	/**
	* @var long
	**/
	protected $HomePage;

	/**
	* @var StoreItemListLayoutCodeType
	**/
	protected $ItemListLayout;

	/**
	* @var StoreItemListSortOrderCodeType
	**/
	protected $ItemListSortOrder;

	/**
	* @var StoreCustomHeaderLayoutCodeType
	**/
	protected $CustomHeaderLayout;

	/**
	* @var string
	**/
	protected $CustomHeader;

	/**
	* @var boolean
	**/
	protected $ExportListings;

	/**
	* @var StoreCustomCategoryArrayType
	**/
	protected $CustomCategories;

	/**
	* @var StoreCustomListingHeaderType
	**/
	protected $CustomListingHeader;

	/**
	* @var MerchDisplayCodeType
	**/
	protected $MerchDisplay;

	/**
	* @var dateTime
	**/
	protected $LastOpenedTime;

	/**
	* @var boolean
	**/
	protected $TitleWithCompatibility;


	/**
	 * Class Constructor 
	 **/
	function __construct()
	{
		parent::__construct('StoreType', 'urn:ebay:apis:eBLBaseComponents');
		if (!isset(self::$_elements[__CLASS__]))
		{
			self::$_elements[__CLASS__] = array_merge(self::$_elements[get_parent_class(__CLASS__)],
			array(
				'Name' =>
				array(
					'required' => false,
					'type' => 'string',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'URLPath' =>
				array(
					'required' => false,
					'type' => 'string',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'URL' =>
				array(
					'required' => false,
					'type' => 'anyURI',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'SubscriptionLevel' =>
				array(
					'required' => false,
					'type' => 'StoreSubscriptionLevelCodeType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'Description' =>
				array(
					'required' => false,
					'type' => 'string',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'Logo' =>
				array(
					'required' => false,
					'type' => 'StoreLogoType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'Theme' =>
				array(
					'required' => false,
					'type' => 'StoreThemeType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'HeaderStyle' =>
				array(
					'required' => false,
					'type' => 'StoreHeaderStyleCodeType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'HomePage' =>
				array(
					'required' => false,
					'type' => 'long',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'ItemListLayout' =>
				array(
					'required' => false,
					'type' => 'StoreItemListLayoutCodeType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'ItemListSortOrder' =>
				array(
					'required' => false,
					'type' => 'StoreItemListSortOrderCodeType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'CustomHeaderLayout' =>
				array(
					'required' => false,
					'type' => 'StoreCustomHeaderLayoutCodeType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'CustomHeader' =>
				array(
					'required' => false,
					'type' => 'string',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'ExportListings' =>
				array(
					'required' => false,
					'type' => 'boolean',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'CustomCategories' =>
				array(
					'required' => false,
					'type' => 'StoreCustomCategoryArrayType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'CustomListingHeader' =>
				array(
					'required' => false,
					'type' => 'StoreCustomListingHeaderType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'MerchDisplay' =>
				array(
					'required' => false,
					'type' => 'MerchDisplayCodeType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'LastOpenedTime' =>
				array(
					'required' => false,
					'type' => 'dateTime',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'TitleWithCompatibility' =>
				array(
					'required' => false,
					'type' => 'boolean',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				)));
		}
		$this->_attributes = array_merge($this->_attributes,
		array(
));
	}

	/**
	 * @return string
	 **/
	function getName()
	{
		return $this->Name;
	}

	/**
	 * @return void
	 **/
	function setName($value)
	{
		$this->Name = $value;
	}

	/**
	 * @return string
	 **/
	function getURLPath()
	{
		return $this->URLPath;
	}

	/**
	 * @return void
	 **/
	function setURLPath($value)
	{
		$this->URLPath = $value;
	}

	/**
	 * @return anyURI
	 **/
	function getURL()
	{
		return $this->URL;
	}

	/**
	 * @return void
	 **/
	function setURL($value)
	{
		$this->URL = $value;
	}

	/**
	 * @return StoreSubscriptionLevelCodeType
	 **/
	function getSubscriptionLevel()
	{
		return $this->SubscriptionLevel;
	}

	/**
	 * @return void
	 **/
	function setSubscriptionLevel($value)
	{
		$this->SubscriptionLevel = $value;
	}

	/**
	 * @return string
	 **/
	function getDescription()
	{
		return $this->Description;
	}

	/**
	 * @return void
	 **/
	function setDescription($value)
	{
		$this->Description = $value;
	}

	/**
	 * @return StoreLogoType
	 **/
	function getLogo()
	{
		return $this->Logo;
	}

	/**
	 * @return void
	 **/
	function setLogo($value)
	{
		$this->Logo = $value;
	}

	/**
	 * @return StoreThemeType
	 **/
	function getTheme()
	{
		return $this->Theme;
	}

	/**
	 * @return void
	 **/
	function setTheme($value)
	{
		$this->Theme = $value;
	}

	/**
	 * @return StoreHeaderStyleCodeType
	 **/
	function getHeaderStyle()
	{
		return $this->HeaderStyle;
	}

	/**
	 * @return void
	 **/
	function setHeaderStyle($value)
	{
		$this->HeaderStyle = $value;
	}

	/**
	 * @return long
	 **/
	function getHomePage()
	{
		return $this->HomePage;
	}

	/**
	 * @return void
	 **/
	function setHomePage($value)
	{
		$this->HomePage = $value;
	}

	/**
	 * @return StoreItemListLayoutCodeType
	 **/
	function getItemListLayout()
	{
		return $this->ItemListLayout;
	}

	/**
	 * @return void
	 **/
	function setItemListLayout($value)
	{
		$this->ItemListLayout = $value;
	}

	/**
	 * @return StoreItemListSortOrderCodeType
	 **/
	function getItemListSortOrder()
	{
		return $this->ItemListSortOrder;
	}

	/**
	 * @return void
	 **/
	function setItemListSortOrder($value)
	{
		$this->ItemListSortOrder = $value;
	}

	/**
	 * @return StoreCustomHeaderLayoutCodeType
	 **/
	function getCustomHeaderLayout()
	{
		return $this->CustomHeaderLayout;
	}

	/**
	 * @return void
	 **/
	function setCustomHeaderLayout($value)
	{
		$this->CustomHeaderLayout = $value;
	}

	/**
	 * @return string
	 **/
	function getCustomHeader()
	{
		return $this->CustomHeader;
	}

	/**
	 * @return void
	 **/
	function setCustomHeader($value)
	{
		$this->CustomHeader = $value;
	}

	/**
	 * @return boolean
	 **/
	function getExportListings()
	{
		return $this->ExportListings;
	}

	/**
	 * @return void
	 **/
	function setExportListings($value)
	{
		$this->ExportListings = $value;
	}

	/**
	 * @return StoreCustomCategoryArrayType
	 **/
	function getCustomCategories()
	{
		return $this->CustomCategories;
	}

	/**
	 * @return void
	 **/
	function setCustomCategories($value)
	{
		$this->CustomCategories = $value;
	}

	/**
	 * @return StoreCustomListingHeaderType
	 **/
	function getCustomListingHeader()
	{
		return $this->CustomListingHeader;
	}

	/**
	 * @return void
	 **/
	function setCustomListingHeader($value)
	{
		$this->CustomListingHeader = $value;
	}

	/**
	 * @return MerchDisplayCodeType
	 **/
	function getMerchDisplay()
	{
		return $this->MerchDisplay;
	}

	/**
	 * @return void
	 **/
	function setMerchDisplay($value)
	{
		$this->MerchDisplay = $value;
	}

	/**
	 * @return dateTime
	 **/
	function getLastOpenedTime()
	{
		return $this->LastOpenedTime;
	}

	/**
	 * @return void
	 **/
	function setLastOpenedTime($value)
	{
		$this->LastOpenedTime = $value;
	}

	/**
	 * @return boolean
	 **/
	function getTitleWithCompatibility()
	{
		return $this->TitleWithCompatibility;
	}

	/**
	 * @return void
	 **/
	function setTitleWithCompatibility($value)
	{
		$this->TitleWithCompatibility = $value;
	}

}
?>
