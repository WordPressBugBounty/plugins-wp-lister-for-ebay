<?php
/* Generated on 14.02.18 14:28 by globalsync
 * $Id: $
 * $Log: $
 */

require_once 'EbatNs_ComplexType.php';
require_once 'MultiLegShippingServiceType.php';
require_once 'AddressType.php';

/**
  *    This type provides information about the shipping service, cost, address, and delivery estimates for the domestic leg of a Global Shipping Program shipment. This type is only applicable for international shipments using the GSP program.
  * 
 **/

class MultiLegShipmentType extends EbatNs_ComplexType
{
	/**
	* @var MultiLegShippingServiceType
	**/
	protected $ShippingServiceDetails;

	/**
	* @var AddressType
	**/
	protected $ShipToAddress;

	/**
	* @var int
	**/
	protected $ShippingTimeMin;

	/**
	* @var int
	**/
	protected $ShippingTimeMax;


	/**
	 * Class Constructor 
	 **/
	function __construct()
	{
		parent::__construct('MultiLegShipmentType', 'urn:ebay:apis:eBLBaseComponents');
		if (!isset(self::$_elements[__CLASS__]))
		{
			self::$_elements[__CLASS__] = array_merge(self::$_elements[get_parent_class(__CLASS__)],
			array(
				'ShippingServiceDetails' =>
				array(
					'required' => false,
					'type' => 'MultiLegShippingServiceType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'ShipToAddress' =>
				array(
					'required' => false,
					'type' => 'AddressType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'ShippingTimeMin' =>
				array(
					'required' => false,
					'type' => 'int',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'ShippingTimeMax' =>
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
	 * @return MultiLegShippingServiceType
	 **/
	function getShippingServiceDetails()
	{
		return $this->ShippingServiceDetails;
	}

	/**
	 * @return void
	 **/
	function setShippingServiceDetails($value)
	{
		$this->ShippingServiceDetails = $value;
	}

	/**
	 * @return AddressType
	 **/
	function getShipToAddress()
	{
		return $this->ShipToAddress;
	}

	/**
	 * @return void
	 **/
	function setShipToAddress($value)
	{
		$this->ShipToAddress = $value;
	}

	/**
	 * @return int
	 **/
	function getShippingTimeMin()
	{
		return $this->ShippingTimeMin;
	}

	/**
	 * @return void
	 **/
	function setShippingTimeMin($value)
	{
		$this->ShippingTimeMin = $value;
	}

	/**
	 * @return int
	 **/
	function getShippingTimeMax()
	{
		return $this->ShippingTimeMax;
	}

	/**
	 * @return void
	 **/
	function setShippingTimeMax($value)
	{
		$this->ShippingTimeMax = $value;
	}

}
?>
