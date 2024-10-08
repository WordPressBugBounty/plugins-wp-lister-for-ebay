<?php
/* Generated on 14.02.18 14:28 by globalsync
 * $Id: $
 * $Log: $
 */

require_once 'EbatNs_ComplexType.php';
require_once 'ListingTypeCodeType.php';
require_once 'AmountType.php';

/**
  * Type defining the <b>ListingStartPriceDetails</b> container returned in
  * <b>GeteBayDetails</b>. The <b>ListingStartPriceDetails</b> 
  * container lists the minimum start price for auction listings, the minimum sale price 
  * for fixed-price listings, and the minimum percentage value that a Buy It Now price for 
  * an auction listing must be above the minimum start price for that same listing.
  * <br><br>
  * The <b>ListingStartPriceDetails</b> container is returned if
  * <b>ListingStartPriceDetails</b> is included as a <b>DetailName</b> 
  * filter in the request, or if no lt;b>DetailName</b> filters are used in the request.
  * 
 **/

class ListingStartPriceDetailsType extends EbatNs_ComplexType
{
	/**
	* @var string
	**/
	protected $Description;

	/**
	* @var ListingTypeCodeType
	**/
	protected $ListingType;

	/**
	* @var AmountType
	**/
	protected $StartPrice;

	/**
	* @var string
	**/
	protected $DetailVersion;

	/**
	* @var dateTime
	**/
	protected $UpdateTime;

	/**
	* @var float
	**/
	protected $MinBuyItNowPricePercent;


	/**
	 * Class Constructor 
	 **/
	function __construct()
	{
		parent::__construct('ListingStartPriceDetailsType', 'urn:ebay:apis:eBLBaseComponents');
		if (!isset(self::$_elements[__CLASS__]))
		{
			self::$_elements[__CLASS__] = array_merge(self::$_elements[get_parent_class(__CLASS__)],
			array(
				'Description' =>
				array(
					'required' => false,
					'type' => 'string',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'ListingType' =>
				array(
					'required' => false,
					'type' => 'ListingTypeCodeType',
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
				'DetailVersion' =>
				array(
					'required' => false,
					'type' => 'string',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'UpdateTime' =>
				array(
					'required' => false,
					'type' => 'dateTime',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'MinBuyItNowPricePercent' =>
				array(
					'required' => false,
					'type' => 'float',
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
	 * @return ListingTypeCodeType
	 **/
	function getListingType()
	{
		return $this->ListingType;
	}

	/**
	 * @return void
	 **/
	function setListingType($value)
	{
		$this->ListingType = $value;
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
	 * @return string
	 **/
	function getDetailVersion()
	{
		return $this->DetailVersion;
	}

	/**
	 * @return void
	 **/
	function setDetailVersion($value)
	{
		$this->DetailVersion = $value;
	}

	/**
	 * @return dateTime
	 **/
	function getUpdateTime()
	{
		return $this->UpdateTime;
	}

	/**
	 * @return void
	 **/
	function setUpdateTime($value)
	{
		$this->UpdateTime = $value;
	}

	/**
	 * @return float
	 **/
	function getMinBuyItNowPricePercent()
	{
		return $this->MinBuyItNowPricePercent;
	}

	/**
	 * @return void
	 **/
	function setMinBuyItNowPricePercent($value)
	{
		$this->MinBuyItNowPricePercent = $value;
	}

}
?>
