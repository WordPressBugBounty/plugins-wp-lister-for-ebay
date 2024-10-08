<?php
/* Generated on 14.02.18 14:28 by globalsync
 * $Id: $
 * $Log: $
 */

require_once 'EbatNs_ComplexType.php';
require_once 'SKUType.php';
require_once 'AmountType.php';
require_once 'NameValueListArrayType.php';
require_once 'SellingStatusType.php';
require_once 'SellingManagerProductInventoryStatusType.php';
require_once 'DiscountPriceInfoType.php';
require_once 'VariationProductListingDetailsType.php';

/**
  * This type defines the <b>Variation</b> container, which provides full
  * details on each item variation in a multiple-variation listing.
  * 
 **/

class VariationType extends EbatNs_ComplexType
{
	/**
	* @var SKUType
	**/
	protected $SKU;

	/**
	* @var AmountType
	**/
	protected $StartPrice;

	/**
	* @var int
	**/
	protected $Quantity;

	/**
	* @var NameValueListArrayType
	**/
	protected $VariationSpecifics;

	/**
	* @var int
	**/
	protected $UnitsAvailable;

	/**
	* @var AmountType
	**/
	protected $UnitCost;

	/**
	* @var SellingStatusType
	**/
	protected $SellingStatus;

	/**
	* @var string
	**/
	protected $VariationTitle;

	/**
	* @var anyURI
	**/
	protected $VariationViewItemURL;

	/**
	* @var boolean
	**/
	protected $Delete;

	/**
	* @var SellingManagerProductInventoryStatusType
	**/
	protected $SellingManagerProductInventoryStatus;

	/**
	* @var long
	**/
	protected $WatchCount;

	/**
	* @var string
	**/
	protected $PrivateNotes;

	/**
	* @var DiscountPriceInfoType
	**/
	protected $DiscountPriceInfo;

	/**
	* @var VariationProductListingDetailsType
	**/
	protected $VariationProductListingDetails;


	/**
	 * Class Constructor 
	 **/
	function __construct()
	{
		parent::__construct('VariationType', 'urn:ebay:apis:eBLBaseComponents');
		if (!isset(self::$_elements[__CLASS__]))
		{
			self::$_elements[__CLASS__] = array_merge(self::$_elements[get_parent_class(__CLASS__)],
			array(
				'SKU' =>
				array(
					'required' => false,
					'type' => 'SKUType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'StartPrice' =>
				array(
					'required' => false,
					'type' => 'AmountType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'Quantity' =>
				array(
					'required' => false,
					'type' => 'int',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'VariationSpecifics' =>
				array(
					'required' => false,
					'type' => 'NameValueListArrayType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'UnitsAvailable' =>
				array(
					'required' => false,
					'type' => 'int',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'UnitCost' =>
				array(
					'required' => false,
					'type' => 'AmountType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'SellingStatus' =>
				array(
					'required' => false,
					'type' => 'SellingStatusType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'VariationTitle' =>
				array(
					'required' => false,
					'type' => 'string',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'VariationViewItemURL' =>
				array(
					'required' => false,
					'type' => 'anyURI',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'Delete' =>
				array(
					'required' => false,
					'type' => 'boolean',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'SellingManagerProductInventoryStatus' =>
				array(
					'required' => false,
					'type' => 'SellingManagerProductInventoryStatusType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'WatchCount' =>
				array(
					'required' => false,
					'type' => 'long',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'PrivateNotes' =>
				array(
					'required' => false,
					'type' => 'string',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'DiscountPriceInfo' =>
				array(
					'required' => false,
					'type' => 'DiscountPriceInfoType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'VariationProductListingDetails' =>
				array(
					'required' => false,
					'type' => 'VariationProductListingDetailsType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				)));
		}
		$this->_attributes = array_merge($this->_attributes,
		array(
));
	}

	/**
	 * @return SKUType
	 **/
	function getSKU()
	{
		return $this->SKU;
	}

	/**
	 * @return void
	 **/
	function setSKU($value)
	{
		$this->SKU = $value;
	}

	/**
	 * @return AmountType
	 **/
	function getStartPrice()
	{
		return $this->StartPrice;
	}

	/**
	 * @return void
	 **/
	function setStartPrice($value)
	{
		$this->StartPrice = $value;
	}

	/**
	 * @return int
	 **/
	function getQuantity()
	{
		return $this->Quantity;
	}

	/**
	 * @return void
	 **/
	function setQuantity($value)
	{
		$this->Quantity = $value;
	}

	/**
	 * @return NameValueListArrayType
	 **/
	function getVariationSpecifics()
	{
		return $this->VariationSpecifics;
	}

	/**
	 * @return void
	 **/
	function setVariationSpecifics($value)
	{
		$this->VariationSpecifics = $value;
	}

	/**
	 * @return int
	 **/
	function getUnitsAvailable()
	{
		return $this->UnitsAvailable;
	}

	/**
	 * @return void
	 **/
	function setUnitsAvailable($value)
	{
		$this->UnitsAvailable = $value;
	}

	/**
	 * @return AmountType
	 **/
	function getUnitCost()
	{
		return $this->UnitCost;
	}

	/**
	 * @return void
	 **/
	function setUnitCost($value)
	{
		$this->UnitCost = $value;
	}

	/**
	 * @return SellingStatusType
	 **/
	function getSellingStatus()
	{
		return $this->SellingStatus;
	}

	/**
	 * @return void
	 **/
	function setSellingStatus($value)
	{
		$this->SellingStatus = $value;
	}

	/**
	 * @return string
	 **/
	function getVariationTitle()
	{
		return $this->VariationTitle;
	}

	/**
	 * @return void
	 **/
	function setVariationTitle($value)
	{
		$this->VariationTitle = $value;
	}

	/**
	 * @return anyURI
	 **/
	function getVariationViewItemURL()
	{
		return $this->VariationViewItemURL;
	}

	/**
	 * @return void
	 **/
	function setVariationViewItemURL($value)
	{
		$this->VariationViewItemURL = $value;
	}

	/**
	 * @return boolean
	 **/
	function getDelete()
	{
		return $this->Delete;
	}

	/**
	 * @return void
	 **/
	function setDelete($value)
	{
		$this->Delete = $value;
	}

	/**
	 * @return SellingManagerProductInventoryStatusType
	 **/
	function getSellingManagerProductInventoryStatus()
	{
		return $this->SellingManagerProductInventoryStatus;
	}

	/**
	 * @return void
	 **/
	function setSellingManagerProductInventoryStatus($value)
	{
		$this->SellingManagerProductInventoryStatus = $value;
	}

	/**
	 * @return long
	 **/
	function getWatchCount()
	{
		return $this->WatchCount;
	}

	/**
	 * @return void
	 **/
	function setWatchCount($value)
	{
		$this->WatchCount = $value;
	}

	/**
	 * @return string
	 **/
	function getPrivateNotes()
	{
		return $this->PrivateNotes;
	}

	/**
	 * @return void
	 **/
	function setPrivateNotes($value)
	{
		$this->PrivateNotes = $value;
	}

	/**
	 * @return DiscountPriceInfoType
	 **/
	function getDiscountPriceInfo()
	{
		return $this->DiscountPriceInfo;
	}

	/**
	 * @return void
	 **/
	function setDiscountPriceInfo($value)
	{
		$this->DiscountPriceInfo = $value;
	}

	/**
	 * @return VariationProductListingDetailsType
	 **/
	function getVariationProductListingDetails()
	{
		return $this->VariationProductListingDetails;
	}

	/**
	 * @return void
	 **/
	function setVariationProductListingDetails($value)
	{
		$this->VariationProductListingDetails = $value;
	}

}
?>
