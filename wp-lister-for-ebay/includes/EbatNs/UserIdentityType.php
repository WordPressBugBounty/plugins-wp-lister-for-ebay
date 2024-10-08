<?php
/* Generated on 14.02.18 14:28 by globalsync
 * $Id: $
 * $Log: $
 */

require_once 'EbatNs_ComplexType.php';
require_once 'UserIdentityCodeType.php';

/**
  * Based on the context of the field, this type defines the user is sending or receiving a payment.
  * 
  * This attribute indicates if the payer or payee is an eBay user or an eBay partner.
  * 
 **/

class UserIdentityType extends EbatNs_ComplexType
{

	/**
	 * Class Constructor 
	 **/
	function __construct()
	{
		parent::__construct('UserIdentityType', 'urn:ebay:apis:eBLBaseComponents');
		if (!isset(self::$_elements[__CLASS__]))
		{
			self::$_elements[__CLASS__] = array_merge(self::$_elements[get_parent_class(__CLASS__)],
			array(
));
		}
		$this->_attributes = array_merge($this->_attributes,
		array(
			'type' =>
			array(
				'name' => ' type',
				'type' => 'UserIdentityCodeType',
				'use' => 'optional'
			)));
	}



}
?>
