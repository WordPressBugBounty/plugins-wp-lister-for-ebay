<?php
/* Generated on 14.02.18 14:28 by globalsync
 * $Id: $
 * $Log: $
 */

require_once 'EbatNs_ComplexType.php';

/**
  * Type defining the <b>eBayMotorsProPaymentMethodCheckOutEnabled</b> field that is returned under the <b>FeatureDefinitions</b> container if <code>eBayMotorsProPaymentMethodCheckOutEnabled</code> is used as a <b>FeatureID</b> value in the request, or if no <b>FeatureID</b> values are used in the request. This field is returned as an empty element (a boolean value is not returned) if one or more eBay API-enabled sites support the display of accepted payment methods for eBay Motors Classified Ad listings. Only eBay Motors Pro users are eligible to use eBay Motors Classified Ad listings.
  * 
 **/

class eBayMotorsProPaymentMethodCheckOutEnabledDefinitionType extends EbatNs_ComplexType
{

	/**
	 * Class Constructor 
	 **/
	function __construct()
	{
		parent::__construct('eBayMotorsProPaymentMethodCheckOutEnabledDefinitionType', 'urn:ebay:apis:eBLBaseComponents');
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
