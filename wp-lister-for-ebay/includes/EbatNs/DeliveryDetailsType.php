<?php
/* Generated on 14.02.18 14:28 by globalsync
 * $Id: $
 * $Log: $
 */

require_once 'EbatNs_ComplexType.php';
require_once 'DigitalDeliveryUserType.php';

/**
  * This type is used by the <b>DeliveryDetails</b>container that is returned by <b>GetOrders</b> and other order management calls. The <b>DeliveryDetails</b> container is only applicable and returned if the buyer purchased a digital gift card, and is either keeping the gift card or giving that gift card to another person.
  * 
 **/

class DeliveryDetailsType extends EbatNs_ComplexType
{
	/**
	* @var DigitalDeliveryUserType
	**/
	protected $Recipient;

	/**
	* @var DigitalDeliveryUserType
	**/
	protected $Sender;


	/**
	 * Class Constructor 
	 **/
	function __construct()
	{
		parent::__construct('DeliveryDetailsType', 'urn:ebay:apis:eBLBaseComponents');
		if (!isset(self::$_elements[__CLASS__]))
		{
			self::$_elements[__CLASS__] = array_merge(self::$_elements[get_parent_class(__CLASS__)],
			array(
				'Recipient' =>
				array(
					'required' => false,
					'type' => 'DigitalDeliveryUserType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'Sender' =>
				array(
					'required' => false,
					'type' => 'DigitalDeliveryUserType',
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
	 * @return DigitalDeliveryUserType
	 **/
	function getRecipient()
	{
		return $this->Recipient;
	}

	/**
	 * @return void
	 **/
	function setRecipient($value)
	{
		$this->Recipient = $value;
	}

	/**
	 * @return DigitalDeliveryUserType
	 **/
	function getSender()
	{
		return $this->Sender;
	}

	/**
	 * @return void
	 **/
	function setSender($value)
	{
		$this->Sender = $value;
	}

}
?>
