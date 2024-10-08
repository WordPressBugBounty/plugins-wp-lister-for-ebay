<?php
/* Generated on 14.02.18 14:28 by globalsync
 * $Id: $
 * $Log: $
 */

require_once 'EbatNs_ComplexType.php';
require_once 'ItemSpecificSourceCodeType.php';

/**
  * This type is used to set or identify either an Item Specific name/value pair for a category/item/variation, a Parts Compatibility name/value pair, or a Global Trade Item Number (GTIN) or other product identifier.
  * 
 **/

class NameValueListType extends EbatNs_ComplexType
{
	/**
	* @var string
	**/
	protected $Name;

	/**
	* @var string
	**/
	protected $Value;

	/**
	* @var ItemSpecificSourceCodeType
	**/
	protected $Source;


	/**
	 * Class Constructor 
	 **/
	function __construct()
	{
		parent::__construct('NameValueListType', 'urn:ebay:apis:eBLBaseComponents');
		if (!isset(self::$_elements[__CLASS__]))
		{
			self::$_elements[__CLASS__] = array_merge(self::$_elements[get_parent_class(__CLASS__)],
			array(
				'Name' =>
				array(
					'required' => false,
					'type' => 'string',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'Value' =>
				array(
					'required' => false,
					'type' => 'string',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => true,
					'cardinality' => '0..*'
				),
				'Source' =>
				array(
					'required' => false,
					'type' => 'ItemSpecificSourceCodeType',
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
	 * @return string
	 **/
	function getName()
	{
		return $this->Name;
	}

	/**
	 * @return void
	 **/
	function setName($value)
	{
		$this->Name = $value;
	}

	/**
	 * @return string
	 * @param integer $index 
	 **/
	function getValue($index = null)
	{
		if ($index !== null)
		{
			return $this->Value[$index];
		}
		else
		{
			return $this->Value;
		}
	}

	/**
	 * @return void
	 * @param string $value
	 * @param integer $index 
	 **/
	function setValue($value, $index = null)
	{
		if ($index !== null)
		{
			$this->Value[$index] = $value;
		}
		else
		{
			$this->Value= $value;
		}
	}

	/**
	 * @return void
	 * @param string $value
	 **/
	function addValue($value)
	{
		$this->Value[] = $value;
	}

	/**
	 * @return ItemSpecificSourceCodeType
	 **/
	function getSource()
	{
		return $this->Source;
	}

	/**
	 * @return void
	 **/
	function setSource($value)
	{
		$this->Source = $value;
	}

}
?>
