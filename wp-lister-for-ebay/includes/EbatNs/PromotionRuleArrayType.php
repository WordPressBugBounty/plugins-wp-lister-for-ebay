<?php
/* Generated on 14.02.18 14:28 by globalsync
 * $Id: $
 * $Log: $
 */

require_once 'EbatNs_ComplexType.php';
require_once 'PromotionRuleType.php';

/**
  * This type is deprecated.
  * 
 **/

class PromotionRuleArrayType extends EbatNs_ComplexType
{
	/**
	* @var PromotionRuleType
	**/
	protected $PromotionRule;


	/**
	 * Class Constructor 
	 **/
	function __construct()
	{
		parent::__construct('PromotionRuleArrayType', 'urn:ebay:apis:eBLBaseComponents');
		if (!isset(self::$_elements[__CLASS__]))
		{
			self::$_elements[__CLASS__] = array_merge(self::$_elements[get_parent_class(__CLASS__)],
			array(
				'PromotionRule' =>
				array(
					'required' => false,
					'type' => 'PromotionRuleType',
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
	 * @return PromotionRuleType
	 * @param integer $index 
	 **/
	function getPromotionRule($index = null)
	{
		if ($index !== null)
		{
			return $this->PromotionRule[$index];
		}
		else
		{
			return $this->PromotionRule;
		}
	}

	/**
	 * @return void
	 * @param PromotionRuleType $value
	 * @param integer $index 
	 **/
	function setPromotionRule($value, $index = null)
	{
		if ($index !== null)
		{
			$this->PromotionRule[$index] = $value;
		}
		else
		{
			$this->PromotionRule= $value;
		}
	}

	/**
	 * @return void
	 * @param PromotionRuleType $value
	 **/
	function addPromotionRule($value)
	{
		$this->PromotionRule[] = $value;
	}

}
?>
