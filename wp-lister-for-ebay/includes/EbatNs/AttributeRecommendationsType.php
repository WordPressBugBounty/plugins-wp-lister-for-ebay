<?php
/* Generated on 14.02.18 14:28 by globalsync
 * $Id: $
 * $Log: $
 */

require_once 'EbatNs_ComplexType.php';
require_once 'AttributeSetArrayType.php';

/**
  * This type is deprecated.
  * 
 **/

class AttributeRecommendationsType extends EbatNs_ComplexType
{
	/**
	* @var AttributeSetArrayType
	**/
	protected $AttributeSetArray;


	/**
	 * Class Constructor 
	 **/
	function __construct()
	{
		parent::__construct('AttributeRecommendationsType', 'urn:ebay:apis:eBLBaseComponents');
		if (!isset(self::$_elements[__CLASS__]))
		{
			self::$_elements[__CLASS__] = array_merge(self::$_elements[get_parent_class(__CLASS__)],
			array(
				'AttributeSetArray' =>
				array(
					'required' => false,
					'type' => 'AttributeSetArrayType',
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
	 * @return AttributeSetArrayType
	 **/
	function getAttributeSetArray()
	{
		return $this->AttributeSetArray;
	}

	/**
	 * @return void
	 **/
	function setAttributeSetArray($value)
	{
		$this->AttributeSetArray = $value;
	}

}
?>
