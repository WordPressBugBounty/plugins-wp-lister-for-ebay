<?php
/* Generated on 14.02.18 14:28 by globalsync
 * $Id: $
 * $Log: $
 */

require_once 'EbatNs_ComplexType.php';
require_once 'RefundFailureCodeType.php';

/**
  * This type is deprecated.
  * 
 **/

class RefundFailureReasonType extends EbatNs_ComplexType
{
	/**
	* @var RefundFailureCodeType
	**/
	protected $RefundFailureCode;


	/**
	 * Class Constructor 
	 **/
	function __construct()
	{
		parent::__construct('RefundFailureReasonType', 'urn:ebay:apis:eBLBaseComponents');
		if (!isset(self::$_elements[__CLASS__]))
		{
			self::$_elements[__CLASS__] = array_merge(self::$_elements[get_parent_class(__CLASS__)],
			array(
				'RefundFailureCode' =>
				array(
					'required' => false,
					'type' => 'RefundFailureCodeType',
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
	 * @return RefundFailureCodeType
	 **/
	function getRefundFailureCode()
	{
		return $this->RefundFailureCode;
	}

	/**
	 * @return void
	 **/
	function setRefundFailureCode($value)
	{
		$this->RefundFailureCode = $value;
	}

}
?>
