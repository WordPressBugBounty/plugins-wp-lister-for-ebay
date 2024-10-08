<?php
/* Generated on 14.02.18 14:28 by globalsync
 * $Id: $
 * $Log: $
 */

require_once 'EbatNs_ComplexType.php';

/**
  * Type defining the <b>BuyerGuaranteeEnabled</b> field that is
  * returned under the <b>FeatureDefinitions</b> container of the
  * <b>GetCategoryFeatures</b> response (as long as
  * <code>BuyerGuaranteeEnabled</code> is included as a <b>FeatureID</b> value in
  * the call request or no <b>FeatureID</b> values are passed into the call
  * request). This field is returned as an
  * empty element (a boolean value is not returned) if one or more eBay API-enabled sites
  * support the Buyer Guarantee feature.
  * <br/><br/>
  * To verify if a specific eBay site supports the Buyer Guarantee feature (for most
  * categories), look for a <code>true</code> value in the
  * <b>SiteDefaults.BuyerGuaranteeEnabled</b> field.
  * <br/><br/>
  * To verify if a specific category on a specific eBay site supports the Buyer Guarantee feature, pass in a <b>CategoryID</b> value in the request, and then
  * look for a <code>true</code> value in the <b>BuyerGuaranteeEnabled</b> field
  * of the corresponding Category node (match up the <b>CategoryID</b> values
  * if more than one Category IDs were passed in the request).
  * 
 **/

class BuyerGuaranteeEnabledDefinitionType extends EbatNs_ComplexType
{

	/**
	 * Class Constructor 
	 **/
	function __construct()
	{
		parent::__construct('BuyerGuaranteeEnabledDefinitionType', 'urn:ebay:apis:eBLBaseComponents');
		if (!isset(self::$_elements[__CLASS__]))
		{
			self::$_elements[__CLASS__] = array_merge(self::$_elements[get_parent_class(__CLASS__)],
			array(
));
		}
		$this->_attributes = array_merge($this->_attributes,
		array(
));
	}

}
?>
