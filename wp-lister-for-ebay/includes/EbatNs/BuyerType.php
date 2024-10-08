<?php
/* Generated on 14.02.18 14:28 by globalsync
 * $Id: $
 * $Log: $
 */

require_once 'EbatNs_ComplexType.php';
require_once 'AddressType.php';
require_once 'TaxIdentifierType.php';

/**
  * This type is used by various <b>Get</b> calls, including <b>GetItem</b> and <b>GetOrders</b>. Only the order management calls return the <b>BuyerTaxIdentifier</b> container, and each call that uses <b>BuyerType</b> uses the <b>ShippingAddress</b> container a little differently.
  * 
 **/

class BuyerType extends EbatNs_ComplexType
{
	/**
	* @var AddressType
	**/
	protected $ShippingAddress;

	/**
	* @var TaxIdentifierType
	**/
	protected $BuyerTaxIdentifier;


	/**
	 * Class Constructor 
	 **/
	function __construct()
	{
		parent::__construct('BuyerType', 'urn:ebay:apis:eBLBaseComponents');
		if (!isset(self::$_elements[__CLASS__]))
		{
			self::$_elements[__CLASS__] = array_merge(self::$_elements[get_parent_class(__CLASS__)],
			array(
				'ShippingAddress' =>
				array(
					'required' => false,
					'type' => 'AddressType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'BuyerTaxIdentifier' =>
				array(
					'required' => false,
					'type' => 'TaxIdentifierType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => true,
					'cardinality' => '0..*'
				)));
		}
		$this->_attributes = array_merge($this->_attributes,
		array(
));
	}

	/**
	 * @return AddressType
	 **/
	function getShippingAddress()
	{
		return $this->ShippingAddress;
	}

	/**
	 * @return void
	 **/
	function setShippingAddress($value)
	{
		$this->ShippingAddress = $value;
	}

	/**
	 * @return TaxIdentifierType
	 * @param integer $index 
	 **/
	function getBuyerTaxIdentifier($index = null)
	{
		if ($index !== null)
		{
			return $this->BuyerTaxIdentifier[$index];
		}
		else
		{
			return $this->BuyerTaxIdentifier;
		}
	}

	/**
	 * @return void
	 * @param TaxIdentifierType $value
	 * @param integer $index 
	 **/
	function setBuyerTaxIdentifier($value, $index = null)
	{
		if ($index !== null)
		{
			$this->BuyerTaxIdentifier[$index] = $value;
		}
		else
		{
			$this->BuyerTaxIdentifier= $value;
		}
	}

	/**
	 * @return void
	 * @param TaxIdentifierType $value
	 **/
	function addBuyerTaxIdentifier($value)
	{
		$this->BuyerTaxIdentifier[] = $value;
	}

}
?>
