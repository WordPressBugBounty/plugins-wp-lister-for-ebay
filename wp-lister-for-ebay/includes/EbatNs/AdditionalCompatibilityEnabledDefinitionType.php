<?php
/* Generated on 14.02.18 14:28 by globalsync
 * $Id: $
 * $Log: $
 */

require_once 'EbatNs_ComplexType.php';

/**
  * Type defining the <b>AdditionalCompatibilityEnabled</b> field that is
  * returned under the <b>FeatureDefinitions</b> container of the
  * <b>GetCategoryFeatures</b> response (as long as
  * <code>AdditionalCompatibilityEnabled</code> is included as a <b>FeatureID</b> value in
  * the call request or no <b>FeatureID</b> values are passed into the call
  * request). This field is returned as an
  * empty element (a boolean value is not returned) if one or more eBay API-enabled sites
  * support the Boats Parts Compatibility feature.
  * <br/><br/>
  * To verify if a specific eBay site supports Boats Parts Compatibility (for most
  * categories), look for a <code>true</code> value in the
  * <b>SiteDefaults.AdditionalCompatibilityEnabled</b> field.
  * <br/><br/>
  * To verify if a specific category on a specific eBay site supports Boats Parts
  * Compatibility, pass in a <b>CategoryID</b> value in the request, and then
  * look for a <code>true</code> value in the <b>AdditionalCompatibilityEnabled</b> field
  * of the corresponding Category node (match up the <b>CategoryID</b> values
  * if more than one Category IDs were passed in the request).
  * 
 **/

class AdditionalCompatibilityEnabledDefinitionType extends EbatNs_ComplexType
{

	/**
	 * Class Constructor 
	 **/
	function __construct()
	{
		parent::__construct('AdditionalCompatibilityEnabledDefinitionType', 'urn:ebay:apis:eBLBaseComponents');
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
