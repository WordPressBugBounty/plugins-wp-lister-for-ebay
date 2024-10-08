<?php
/* Generated on 14.02.18 14:28 by globalsync
 * $Id: $
 * $Log: $
 */

require_once 'EbatNs_ComplexType.php';
require_once 'LookupAttributeType.php';

/**
  * This type is deprecated.
  * 
 **/

class LookupAttributeArrayType extends EbatNs_ComplexType
{
	/**
	* @var LookupAttributeType
	**/
	protected $LookupAttribute;


	/**
	 * Class Constructor 
	 **/
	function __construct()
	{
		parent::__construct('LookupAttributeArrayType', 'urn:ebay:apis:eBLBaseComponents');
		if (!isset(self::$_elements[__CLASS__]))
		{
			self::$_elements[__CLASS__] = array_merge(self::$_elements[get_parent_class(__CLASS__)],
			array(
				'LookupAttribute' =>
				array(
					'required' => false,
					'type' => 'LookupAttributeType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => true,
					'cardinality' => '0..*'
				)));
		}
		$this->_attributes = array_merge($this->_attributes,
		array(
));
	}

	/**
	 * @return LookupAttributeType
	 * @param integer $index 
	 **/
	function getLookupAttribute($index = null)
	{
		if ($index !== null)
		{
			return $this->LookupAttribute[$index];
		}
		else
		{
			return $this->LookupAttribute;
		}
	}

	/**
	 * @return void
	 * @param LookupAttributeType $value
	 * @param integer $index 
	 **/
	function setLookupAttribute($value, $index = null)
	{
		if ($index !== null)
		{
			$this->LookupAttribute[$index] = $value;
		}
		else
		{
			$this->LookupAttribute= $value;
		}
	}

	/**
	 * @return void
	 * @param LookupAttributeType $value
	 **/
	function addLookupAttribute($value)
	{
		$this->LookupAttribute[] = $value;
	}

}
?>
