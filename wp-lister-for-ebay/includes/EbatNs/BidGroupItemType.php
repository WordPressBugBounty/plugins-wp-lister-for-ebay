<?php
/* Generated on 14.02.18 14:28 by globalsync
 * $Id: $
 * $Log: $
 */

require_once 'EbatNs_ComplexType.php';
require_once 'ItemType.php';
require_once 'BidGroupItemStatusCodeType.php';
require_once 'AmountType.php';

/**
  * This type is deprecated.
  * 
 **/

class BidGroupItemType extends EbatNs_ComplexType
{
	/**
	* @var ItemType
	**/
	protected $Item;

	/**
	* @var BidGroupItemStatusCodeType
	**/
	protected $BidGroupItemStatus;

	/**
	* @var AmountType
	**/
	protected $MaxBidAmount;


	/**
	 * Class Constructor 
	 **/
	function __construct()
	{
		parent::__construct('BidGroupItemType', 'urn:ebay:apis:eBLBaseComponents');
		if (!isset(self::$_elements[__CLASS__]))
		{
			self::$_elements[__CLASS__] = array_merge(self::$_elements[get_parent_class(__CLASS__)],
			array(
				'Item' =>
				array(
					'required' => false,
					'type' => 'ItemType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'BidGroupItemStatus' =>
				array(
					'required' => false,
					'type' => 'BidGroupItemStatusCodeType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'MaxBidAmount' =>
				array(
					'required' => false,
					'type' => 'AmountType',
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
	 * @return ItemType
	 **/
	function getItem()
	{
		return $this->Item;
	}

	/**
	 * @return void
	 **/
	function setItem($value)
	{
		$this->Item = $value;
	}

	/**
	 * @return BidGroupItemStatusCodeType
	 **/
	function getBidGroupItemStatus()
	{
		return $this->BidGroupItemStatus;
	}

	/**
	 * @return void
	 **/
	function setBidGroupItemStatus($value)
	{
		$this->BidGroupItemStatus = $value;
	}

	/**
	 * @return AmountType
	 **/
	function getMaxBidAmount()
	{
		return $this->MaxBidAmount;
	}

	/**
	 * @return void
	 **/
	function setMaxBidAmount($value)
	{
		$this->MaxBidAmount = $value;
	}

}
?>
