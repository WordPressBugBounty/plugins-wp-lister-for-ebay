<?php
/* Generated on 14.02.18 14:28 by globalsync
 * $Id: $
 * $Log: $
 */

require_once 'AbstractRequestType.php';
require_once 'ItemIDType.php';
require_once 'SellingManagerAutoRelistType.php';
require_once 'SellingManagerAutoSecondChanceOfferType.php';

/**
  * Revises, or adds to, the set of Selling Manager automation rules associated with an item.
  * <br>
  * <br>
  * This call is subject to change without notice; the deprecation process is inapplicable to this call. You must have a Selling Manager Pro subscription to use this call.
  * <br>
  * <br>
  * Using this call, you can add an automated relisting rule. You also can add a Second Chance Offer rule. Note that automated relisting rules can only be set on templates. An automated relisting rule for an item is inherited from a template.
  * <br>
  * <br>
  * This call also enables you to specify particular information about automation rules.
  * <br>
  * <br>
  * If a node is not passed in the call, the setting for the corresponding
  * automation rule remains unchanged.
  * 
 **/

class SetSellingManagerItemAutomationRuleRequestType extends AbstractRequestType
{
	/**
	* @var ItemIDType
	**/
	protected $ItemID;

	/**
	* @var SellingManagerAutoRelistType
	**/
	protected $AutomatedRelistingRule;

	/**
	* @var SellingManagerAutoSecondChanceOfferType
	**/
	protected $AutomatedSecondChanceOfferRule;


	/**
	 * Class Constructor 
	 **/
	function __construct()
	{
		parent::__construct('SetSellingManagerItemAutomationRuleRequestType', 'urn:ebay:apis:eBLBaseComponents');
		if (!isset(self::$_elements[__CLASS__]))
		{
			self::$_elements[__CLASS__] = array_merge(self::$_elements[get_parent_class(__CLASS__)],
			array(
				'ItemID' =>
				array(
					'required' => false,
					'type' => 'ItemIDType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'AutomatedRelistingRule' =>
				array(
					'required' => false,
					'type' => 'SellingManagerAutoRelistType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'AutomatedSecondChanceOfferRule' =>
				array(
					'required' => false,
					'type' => 'SellingManagerAutoSecondChanceOfferType',
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
	 * @return ItemIDType
	 **/
	function getItemID()
	{
		return $this->ItemID;
	}

	/**
	 * @return void
	 **/
	function setItemID($value)
	{
		$this->ItemID = $value;
	}

	/**
	 * @return SellingManagerAutoRelistType
	 **/
	function getAutomatedRelistingRule()
	{
		return $this->AutomatedRelistingRule;
	}

	/**
	 * @return void
	 **/
	function setAutomatedRelistingRule($value)
	{
		$this->AutomatedRelistingRule = $value;
	}

	/**
	 * @return SellingManagerAutoSecondChanceOfferType
	 **/
	function getAutomatedSecondChanceOfferRule()
	{
		return $this->AutomatedSecondChanceOfferRule;
	}

	/**
	 * @return void
	 **/
	function setAutomatedSecondChanceOfferRule($value)
	{
		$this->AutomatedSecondChanceOfferRule = $value;
	}

}
?>
