<?php
/* Generated on 14.02.18 14:28 by globalsync
 * $Id: $
 * $Log: $
 */

require_once 'EbatNs_ComplexType.php';
require_once 'RefundType.php';

/**
  * <span class="tablenote"><b>Note: </b> This type was only used for Half.com order refunds, and since the Half.com site has been shut down, this type is no longer applicable.
  * </span>
  * Type used by the <strong>RefundArray</strong> container, which consists of an array of Half.com refunds.
  * 
 **/

class RefundArrayType extends EbatNs_ComplexType
{
	/**
	* @var RefundType
	**/
	protected $Refund;


	/**
	 * Class Constructor 
	 **/
	function __construct()
	{
		parent::__construct('RefundArrayType', 'urn:ebay:apis:eBLBaseComponents');
		if (!isset(self::$_elements[__CLASS__]))
		{
			self::$_elements[__CLASS__] = array_merge(self::$_elements[get_parent_class(__CLASS__)],
			array(
				'Refund' =>
				array(
					'required' => false,
					'type' => 'RefundType',
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
	 * @return RefundType
	 * @param integer $index 
	 **/
	function getRefund($index = null)
	{
		if ($index !== null)
		{
			return $this->Refund[$index];
		}
		else
		{
			return $this->Refund;
		}
	}

	/**
	 * @return void
	 * @param RefundType $value
	 * @param integer $index 
	 **/
	function setRefund($value, $index = null)
	{
		if ($index !== null)
		{
			$this->Refund[$index] = $value;
		}
		else
		{
			$this->Refund= $value;
		}
	}

	/**
	 * @return void
	 * @param RefundType $value
	 **/
	function addRefund($value)
	{
		$this->Refund[] = $value;
	}

}
?>
