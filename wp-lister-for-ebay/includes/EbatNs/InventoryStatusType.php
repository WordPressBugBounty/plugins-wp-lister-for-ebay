<?php
/* Generated on 14.02.18 14:28 by globalsync
 * $Id: $
 * $Log: $
 */

require_once 'EbatNs_ComplexType.php';
require_once 'SKUType.php';
require_once 'ItemIDType.php';
require_once 'AmountType.php';

/**
  * This type is used by the <b>ReviseInventoryStatus</b> call to update the price and/or quantity of an item or an item variation within a single-variation or multiple-variation, fixed-price listing.
  * 
 **/

class InventoryStatusType extends EbatNs_ComplexType
{
	/**
	* @var SKUType
	**/
	protected $SKU;

	/**
	* @var ItemIDType
	**/
	protected $ItemID;

	/**
	* @var AmountType
	**/
	protected $StartPrice;

	/**
	* @var int
	**/
	protected $Quantity;


	/**
	 * Class Constructor 
	 **/
	function __construct()
	{
		parent::__construct('InventoryStatusType', 'urn:ebay:apis:eBLBaseComponents');
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
				'ItemID' =>
				array(
					'required' => false,
					'type' => 'ItemIDType',
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
	 * @return ItemIDType
	 **/
	function getItemID()
	{
		return $this->ItemID;
	}

	/**
	 * @return void
	 **/
	function setItemID($value)
	{
		$this->ItemID = $value;
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

}
?>
