<?php
/* Generated on 14.02.18 14:28 by globalsync
 * $Id: $
 * $Log: $
 */

require_once 'EbatNs_ComplexType.php';
require_once 'ProductInfoType.php';

/**
  * This type is deprecated.
  * 
 **/

class PricingRecommendationsType extends EbatNs_ComplexType
{
	/**
	* @var ProductInfoType
	**/
	protected $ProductInfo;


	/**
	 * Class Constructor 
	 **/
	function __construct()
	{
		parent::__construct('PricingRecommendationsType', 'urn:ebay:apis:eBLBaseComponents');
		if (!isset(self::$_elements[__CLASS__]))
		{
			self::$_elements[__CLASS__] = array_merge(self::$_elements[get_parent_class(__CLASS__)],
			array(
				'ProductInfo' =>
				array(
					'required' => false,
					'type' => 'ProductInfoType',
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
	 * @return ProductInfoType
	 **/
	function getProductInfo()
	{
		return $this->ProductInfo;
	}

	/**
	 * @return void
	 **/
	function setProductInfo($value)
	{
		$this->ProductInfo = $value;
	}

}
?>
