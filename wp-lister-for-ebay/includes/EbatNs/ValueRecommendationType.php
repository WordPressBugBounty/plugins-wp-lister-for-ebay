<?php
/* Generated on 14.02.18 14:28 by globalsync
 * $Id: $
 * $Log: $
 */

require_once 'EbatNs_ComplexType.php';
require_once 'RecommendationValidationRulesType.php';

/**
  * Type used by the <b>ValueRecommendation<b> container to provide recommended names for recommended item specifics.
  * 
 **/

class ValueRecommendationType extends EbatNs_ComplexType
{
	/**
	* @var string
	**/
	protected $Value;

	/**
	* @var RecommendationValidationRulesType
	**/
	protected $ValidationRules;


	/**
	 * Class Constructor 
	 **/
	function __construct()
	{
		parent::__construct('ValueRecommendationType', 'urn:ebay:apis:eBLBaseComponents');
		if (!isset(self::$_elements[__CLASS__]))
		{
			self::$_elements[__CLASS__] = array_merge(self::$_elements[get_parent_class(__CLASS__)],
			array(
				'Value' =>
				array(
					'required' => false,
					'type' => 'string',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'ValidationRules' =>
				array(
					'required' => false,
					'type' => 'RecommendationValidationRulesType',
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
	 * @return string
	 **/
	function getValue()
	{
		return $this->Value;
	}

	/**
	 * @return void
	 **/
	function setValue($value)
	{
		$this->Value = $value;
	}

	/**
	 * @return RecommendationValidationRulesType
	 **/
	function getValidationRules()
	{
		return $this->ValidationRules;
	}

	/**
	 * @return void
	 **/
	function setValidationRules($value)
	{
		$this->ValidationRules = $value;
	}

}
?>
