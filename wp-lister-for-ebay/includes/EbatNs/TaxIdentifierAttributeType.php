<?php
/* Generated on 14.02.18 14:28 by globalsync
 * $Id: $
 * $Log: $
 */

require_once 'EbatNs_ComplexType.php';
require_once 'TaxIdentifierAttributeCodeType.php';

/**
  * This type is used to display the value of the <b>name</b> attribute of the <b>BuyerTaxIdentifier.Attribute</b> field.
  * 
  * The only supported value for this attribute is 'IssuingCountry', but in the future, other attributes related to the tax ID may be supported.
  * 
 **/

class TaxIdentifierAttributeType extends EbatNs_ComplexType
{

	/**
	 * Class Constructor 
	 **/
	function __construct()
	{
		parent::__construct('TaxIdentifierAttributeType', 'urn:ebay:apis:eBLBaseComponents');
		if (!isset(self::$_elements[__CLASS__]))
		{
			self::$_elements[__CLASS__] = array_merge(self::$_elements[get_parent_class(__CLASS__)],
			array(
));
		}
		$this->_attributes = array_merge($this->_attributes,
		array(
			'name' =>
			array(
				'name' => ' name',
				'type' => 'TaxIdentifierAttributeCodeType',
				'use' => 'optional'
			)));
	}



}
?>
