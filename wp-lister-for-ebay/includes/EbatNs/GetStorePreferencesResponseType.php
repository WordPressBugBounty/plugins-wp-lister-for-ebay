<?php
/* Generated on 14.02.18 14:28 by globalsync
 * $Id: $
 * $Log: $
 */

require_once 'AbstractResponseType.php';
require_once 'StorePreferencesType.php';

/**
  * Base response of the <b>GetStorePreferences</b> call.
  * 
 **/

class GetStorePreferencesResponseType extends AbstractResponseType
{
	/**
	* @var StorePreferencesType
	**/
	protected $StorePreferences;


	/**
	 * Class Constructor 
	 **/
	function __construct()
	{
		parent::__construct('GetStorePreferencesResponseType', 'urn:ebay:apis:eBLBaseComponents');
		if (!isset(self::$_elements[__CLASS__]))
		{
			self::$_elements[__CLASS__] = array_merge(self::$_elements[get_parent_class(__CLASS__)],
			array(
				'StorePreferences' =>
				array(
					'required' => false,
					'type' => 'StorePreferencesType',
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
	 * @return StorePreferencesType
	 **/
	function getStorePreferences()
	{
		return $this->StorePreferences;
	}

	/**
	 * @return void
	 **/
	function setStorePreferences($value)
	{
		$this->StorePreferences = $value;
	}

}
?>
