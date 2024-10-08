<?php
/* Generated on 14.02.18 14:28 by globalsync
 * $Id: $
 * $Log: $
 */

require_once 'AbstractResponseType.php';
require_once 'TaskStatusCodeType.php';
require_once 'StoreCustomCategoryArrayType.php';

/**
  * Base response of the <b>SetStoreCategories</b> call. Returns the status of the eBay Store category changes.
  * 
 **/

class SetStoreCategoriesResponseType extends AbstractResponseType
{
	/**
	* @var long
	**/
	protected $TaskID;

	/**
	* @var TaskStatusCodeType
	**/
	protected $Status;

	/**
	* @var StoreCustomCategoryArrayType
	**/
	protected $CustomCategory;


	/**
	 * Class Constructor 
	 **/
	function __construct()
	{
		parent::__construct('SetStoreCategoriesResponseType', 'urn:ebay:apis:eBLBaseComponents');
		if (!isset(self::$_elements[__CLASS__]))
		{
			self::$_elements[__CLASS__] = array_merge(self::$_elements[get_parent_class(__CLASS__)],
			array(
				'TaskID' =>
				array(
					'required' => false,
					'type' => 'long',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'Status' =>
				array(
					'required' => false,
					'type' => 'TaskStatusCodeType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'CustomCategory' =>
				array(
					'required' => false,
					'type' => 'StoreCustomCategoryArrayType',
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
	 * @return long
	 **/
	function getTaskID()
	{
		return $this->TaskID;
	}

	/**
	 * @return void
	 **/
	function setTaskID($value)
	{
		$this->TaskID = $value;
	}

	/**
	 * @return TaskStatusCodeType
	 **/
	function getStatus()
	{
		return $this->Status;
	}

	/**
	 * @return void
	 **/
	function setStatus($value)
	{
		$this->Status = $value;
	}

	/**
	 * @return StoreCustomCategoryArrayType
	 **/
	function getCustomCategory()
	{
		return $this->CustomCategory;
	}

	/**
	 * @return void
	 **/
	function setCustomCategory($value)
	{
		$this->CustomCategory = $value;
	}

}
?>
