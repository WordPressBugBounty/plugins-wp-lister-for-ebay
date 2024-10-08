<?php
/* Generated on 14.02.18 14:28 by globalsync
 * $Id: $
 * $Log: $
 */

require_once 'AbstractResponseType.php';
require_once 'StoreCustomPageArrayType.php';

/**
  * The base response of the <b>GetStoreCustomPage</b> call.
  * 
 **/

class GetStoreCustomPageResponseType extends AbstractResponseType
{
	/**
	* @var StoreCustomPageArrayType
	**/
	protected $CustomPageArray;


	/**
	 * Class Constructor 
	 **/
	function __construct()
	{
		parent::__construct('GetStoreCustomPageResponseType', 'urn:ebay:apis:eBLBaseComponents');
		if (!isset(self::$_elements[__CLASS__]))
		{
			self::$_elements[__CLASS__] = array_merge(self::$_elements[get_parent_class(__CLASS__)],
			array(
				'CustomPageArray' =>
				array(
					'required' => false,
					'type' => 'StoreCustomPageArrayType',
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
	 * @return StoreCustomPageArrayType
	 **/
	function getCustomPageArray()
	{
		return $this->CustomPageArray;
	}

	/**
	 * @return void
	 **/
	function setCustomPageArray($value)
	{
		$this->CustomPageArray = $value;
	}

}
?>
