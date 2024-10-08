<?php
/* Generated on 14.02.18 14:28 by globalsync
 * $Id: $
 * $Log: $
 */

require_once 'AbstractRequestType.php';
require_once 'PromotionalSaleStatusCodeType.php';

/**
  * The base request type for the <b>GetPromotionalSaleDetails</b> call. This call retrieves information about promotional sales set up by an eBay store owner. The eBay store owner has the option to retrieve all promotional sales, a specific promotional sale, or promotional sales in a specific state.
  * 
 **/

class GetPromotionalSaleDetailsRequestType extends AbstractRequestType
{
	/**
	* @var long
	**/
	protected $PromotionalSaleID;

	/**
	* @var PromotionalSaleStatusCodeType
	**/
	protected $PromotionalSaleStatus;


	/**
	 * Class Constructor 
	 **/
	function __construct()
	{
		parent::__construct('GetPromotionalSaleDetailsRequestType', 'urn:ebay:apis:eBLBaseComponents');
		if (!isset(self::$_elements[__CLASS__]))
		{
			self::$_elements[__CLASS__] = array_merge(self::$_elements[get_parent_class(__CLASS__)],
			array(
				'PromotionalSaleID' =>
				array(
					'required' => false,
					'type' => 'long',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'PromotionalSaleStatus' =>
				array(
					'required' => false,
					'type' => 'PromotionalSaleStatusCodeType',
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
	 * @return long
	 **/
	function getPromotionalSaleID()
	{
		return $this->PromotionalSaleID;
	}

	/**
	 * @return void
	 **/
	function setPromotionalSaleID($value)
	{
		$this->PromotionalSaleID = $value;
	}

	/**
	 * @return PromotionalSaleStatusCodeType
	 * @param integer $index 
	 **/
	function getPromotionalSaleStatus($index = null)
	{
		if ($index !== null)
		{
			return $this->PromotionalSaleStatus[$index];
		}
		else
		{
			return $this->PromotionalSaleStatus;
		}
	}

	/**
	 * @return void
	 * @param PromotionalSaleStatusCodeType $value
	 * @param integer $index 
	 **/
	function setPromotionalSaleStatus($value, $index = null)
	{
		if ($index !== null)
		{
			$this->PromotionalSaleStatus[$index] = $value;
		}
		else
		{
			$this->PromotionalSaleStatus= $value;
		}
	}

	/**
	 * @return void
	 * @param PromotionalSaleStatusCodeType $value
	 **/
	function addPromotionalSaleStatus($value)
	{
		$this->PromotionalSaleStatus[] = $value;
	}

}
?>
