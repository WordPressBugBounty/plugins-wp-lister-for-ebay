<?php
/* Generated on 14.02.18 14:28 by globalsync
 * $Id: $
 * $Log: $
 */

require_once 'EbatNs_ComplexType.php';
require_once 'ShippingServiceCostOverrideType.php';

/**
  * Type defining the <b>ShippingServiceCostOverrideList</b> container, which is used when the seller wants to override the flat shipping costs for all domestic and/or all international shipping services defined in the Business Policies shipping profile referenced in the <b>SellerProfiles.SellerShippingProfile.ShippingProfileID</b> field of an Add/Revise/Relist call. 
  * <br/><br/> 
  * Shipping service cost overrides are a listing-level concept, and the shipping costs specified through each <b>ShippingServiceCostOverrideList.ShippingServiceCostOverride</b> container will not change the shipping costs defined for the same shipping services in the Business Policies shipping profile.
  * 
 **/

class ShippingServiceCostOverrideListType extends EbatNs_ComplexType
{
	/**
	* @var ShippingServiceCostOverrideType
	**/
	protected $ShippingServiceCostOverride;


	/**
	 * Class Constructor 
	 **/
	function __construct()
	{
		parent::__construct('ShippingServiceCostOverrideListType', 'urn:ebay:apis:eBLBaseComponents');
		if (!isset(self::$_elements[__CLASS__]))
		{
			self::$_elements[__CLASS__] = array_merge(self::$_elements[get_parent_class(__CLASS__)],
			array(
				'ShippingServiceCostOverride' =>
				array(
					'required' => false,
					'type' => 'ShippingServiceCostOverrideType',
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
	 * @return ShippingServiceCostOverrideType
	 * @param integer $index 
	 **/
	function getShippingServiceCostOverride($index = null)
	{
		if ($index !== null)
		{
			return $this->ShippingServiceCostOverride[$index];
		}
		else
		{
			return $this->ShippingServiceCostOverride;
		}
	}

	/**
	 * @return void
	 * @param ShippingServiceCostOverrideType $value
	 * @param integer $index 
	 **/
	function setShippingServiceCostOverride($value, $index = null)
	{
		if ($index !== null)
		{
			$this->ShippingServiceCostOverride[$index] = $value;
		}
		else
		{
			$this->ShippingServiceCostOverride= $value;
		}
	}

	/**
	 * @return void
	 * @param ShippingServiceCostOverrideType $value
	 **/
	function addShippingServiceCostOverride($value)
	{
		$this->ShippingServiceCostOverride[] = $value;
	}

}
?>
