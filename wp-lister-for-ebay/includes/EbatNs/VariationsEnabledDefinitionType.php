<?php
/* Generated on 14.02.18 14:28 by globalsync
 * $Id: $
 * $Log: $
 */

require_once 'EbatNs_ComplexType.php';

/**
  * Defines the multi-variation listing feature. If the field is present, 
  * the  corresponding feature applies to the site. The field is returned as 
  * an empty element (e.g., a boolean value is not returned).<br>
  * <br>
  * Multi-variation listings contain items that are logically the same 
  * product, but that vary in their manufacturing details or packaging. 
  * For example, a particular brand and style of shirt could be 
  * available in different sizes and colors, such as "large blue" and 
  * "medium black" variations.
  * 
 **/

class VariationsEnabledDefinitionType extends EbatNs_ComplexType
{

	/**
	 * Class Constructor 
	 **/
	function __construct()
	{
		parent::__construct('VariationsEnabledDefinitionType', 'urn:ebay:apis:eBLBaseComponents');
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
