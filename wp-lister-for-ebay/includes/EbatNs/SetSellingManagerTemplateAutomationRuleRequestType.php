<?php
/* Generated on 14.02.18 14:28 by globalsync
 * $Id: $
 * $Log: $
 */

require_once 'AbstractRequestType.php';
require_once 'SellingManagerAutoListType.php';
require_once 'SellingManagerAutoRelistType.php';
require_once 'SellingManagerAutoSecondChanceOfferType.php';

/**
  * Revises, or adds to, the Selling Manager automation rules associated with a template.
  * <br>
  * <br>
  * This call is subject to change without notice; the deprecation process is inapplicable to this call. You must have a Selling Manager Pro subscription to use this call.
  * <br>
  * <br>
  * Using this call, you can add either an automated listing or relisting rule, but not both. You also can add a Second Chance Offer rule.
  * <br>
  * <br>
  * This call also enables you to specify particular information about automation rules.
  * <br>
  * <br>
  * If a node is not passed in the call, the setting for the corresponding automation rule remains unchanged.
  * 
 **/

class SetSellingManagerTemplateAutomationRuleRequestType extends AbstractRequestType
{
	/**
	* @var long
	**/
	protected $SaleTemplateID;

	/**
	* @var SellingManagerAutoListType
	**/
	protected $AutomatedListingRule;

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
		parent::__construct('SetSellingManagerTemplateAutomationRuleRequestType', 'urn:ebay:apis:eBLBaseComponents');
		if (!isset(self::$_elements[__CLASS__]))
		{
			self::$_elements[__CLASS__] = array_merge(self::$_elements[get_parent_class(__CLASS__)],
			array(
				'SaleTemplateID' =>
				array(
					'required' => false,
					'type' => 'long',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'AutomatedListingRule' =>
				array(
					'required' => false,
					'type' => 'SellingManagerAutoListType',
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
	 * @return long
	 **/
	function getSaleTemplateID()
	{
		return $this->SaleTemplateID;
	}

	/**
	 * @return void
	 **/
	function setSaleTemplateID($value)
	{
		$this->SaleTemplateID = $value;
	}

	/**
	 * @return SellingManagerAutoListType
	 **/
	function getAutomatedListingRule()
	{
		return $this->AutomatedListingRule;
	}

	/**
	 * @return void
	 **/
	function setAutomatedListingRule($value)
	{
		$this->AutomatedListingRule = $value;
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
