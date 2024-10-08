<?php
/* Generated on 14.02.18 14:28 by globalsync
 * $Id: $
 * $Log: $
 */

require_once 'EbatNs_ComplexType.php';

/**
  * Type defining the <b>SellerPaymentProfile</b> container, which is used in an Add/Revise/Relist/Verify Trading API call to reference a Business Policies payment profile.
  * 
 **/

class SellerPaymentProfileType extends EbatNs_ComplexType
{
	/**
	* @var long
	**/
	protected $PaymentProfileID;

	/**
	* @var string
	**/
	protected $PaymentProfileName;


	/**
	 * Class Constructor 
	 **/
	function __construct()
	{
		parent::__construct('SellerPaymentProfileType', 'urn:ebay:apis:eBLBaseComponents');
		if (!isset(self::$_elements[__CLASS__]))
		{
			self::$_elements[__CLASS__] = array_merge(self::$_elements[get_parent_class(__CLASS__)],
			array(
				'PaymentProfileID' =>
				array(
					'required' => false,
					'type' => 'long',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'PaymentProfileName' =>
				array(
					'required' => false,
					'type' => 'string',
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
	 * @return long
	 **/
	function getPaymentProfileID()
	{
		return $this->PaymentProfileID;
	}

	/**
	 * @return void
	 **/
	function setPaymentProfileID($value)
	{
		$this->PaymentProfileID = $value;
	}

	/**
	 * @return string
	 **/
	function getPaymentProfileName()
	{
		return $this->PaymentProfileName;
	}

	/**
	 * @return void
	 **/
	function setPaymentProfileName($value)
	{
		$this->PaymentProfileName = $value;
	}

}
?>
