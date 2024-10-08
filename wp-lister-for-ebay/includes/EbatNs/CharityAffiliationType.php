<?php
/* Generated on 14.02.18 14:28 by globalsync
 * $Id: $
 * $Log: $
 */

require_once 'EbatNs_ComplexType.php';
require_once 'CharityAffiliationTypeCodeType.php';

/**
  *  This type is deprecated. Replaced by <b>CharityAffiliationDetailType</b>
  * 
 **/

class CharityAffiliationType extends EbatNs_ComplexType
{

	/**
	 * Class Constructor 
	 **/
	function __construct()
	{
		parent::__construct('CharityAffiliationType', 'urn:ebay:apis:eBLBaseComponents');
		if (!isset(self::$_elements[__CLASS__]))
		{
			self::$_elements[__CLASS__] = array_merge(self::$_elements[get_parent_class(__CLASS__)],
			array(
));
		}
		$this->_attributes = array_merge($this->_attributes,
		array(
			'id' =>
			array(
				'name' => ' id',
				'type' => 'string',
				'use' => 'optional'
			),
			'type' =>
			array(
				'name' => ' type',
				'type' => 'CharityAffiliationTypeCodeType',
				'use' => 'optional'
			)));
	}



}
?>
