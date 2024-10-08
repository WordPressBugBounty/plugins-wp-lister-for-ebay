<?php
/* Generated on 14.02.18 14:28 by globalsync
 * $Id: $
 * $Log: $
 */

require_once 'EbatNs_ComplexType.php';

/**
  * This type is deprecated.
  * 
 **/

class HistogramEntryType extends EbatNs_ComplexType
{
	/**
	* @var int
	**/
	protected $Count;


	/**
	 * Class Constructor 
	 **/
	function __construct()
	{
		parent::__construct('HistogramEntryType', 'urn:ebay:apis:eBLBaseComponents');
		if (!isset(self::$_elements[__CLASS__]))
		{
			self::$_elements[__CLASS__] = array_merge(self::$_elements[get_parent_class(__CLASS__)],
			array(
				'Count' =>
				array(
					'required' => false,
					'type' => 'int',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				)));
		}
		$this->_attributes = array_merge($this->_attributes,
		array(
			'id' =>
			array(
				'name' => ' id',
				'type' => 'string',
				'use' => 'optional'
			),
			'name' =>
			array(
				'name' => ' name',
				'type' => 'string',
				'use' => 'optional'
			)));
	}

	/**
	 * @return int
	 **/
	function getCount()
	{
		return $this->Count;
	}

	/**
	 * @return void
	 **/
	function setCount($value)
	{
		$this->Count = $value;
	}



}
?>
