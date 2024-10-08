<?php
/* Generated on 14.02.18 14:28 by globalsync
 * $Id: $
 * $Log: $
 */

require_once 'EbatNs_ComplexType.php';

/**
  * Type defining the <b>SellerReturnPreferences</b> container, which consists of the <b>OptedIn</b> flag that indicates whether or not the seller has opted in to eBay Managed Returns.
  * 
 **/

class SellerReturnPreferencesType extends EbatNs_ComplexType
{
	/**
	* @var boolean
	**/
	protected $OptedIn;


	/**
	 * Class Constructor 
	 **/
	function __construct()
	{
		parent::__construct('SellerReturnPreferencesType', 'urn:ebay:apis:eBLBaseComponents');
		if (!isset(self::$_elements[__CLASS__]))
		{
			self::$_elements[__CLASS__] = array_merge(self::$_elements[get_parent_class(__CLASS__)],
			array(
				'OptedIn' =>
				array(
					'required' => false,
					'type' => 'boolean',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				)));
		}
		$this->_attributes = array_merge($this->_attributes,
		array(
));
	}

	/**
	 * @return boolean
	 **/
	function getOptedIn()
	{
		return $this->OptedIn;
	}

	/**
	 * @return void
	 **/
	function setOptedIn($value)
	{
		$this->OptedIn = $value;
	}

}
?>
