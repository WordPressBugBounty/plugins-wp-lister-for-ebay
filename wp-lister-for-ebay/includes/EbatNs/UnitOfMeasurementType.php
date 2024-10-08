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

class UnitOfMeasurementType extends EbatNs_ComplexType
{
	/**
	* @var string
	**/
	protected $AlternateText;

	/**
	* @var string
	**/
	protected $SuggestedText;


	/**
	 * Class Constructor 
	 **/
	function __construct()
	{
		parent::__construct('UnitOfMeasurementType', 'urn:ebay:apis:eBLBaseComponents');
		if (!isset(self::$_elements[__CLASS__]))
		{
			self::$_elements[__CLASS__] = array_merge(self::$_elements[get_parent_class(__CLASS__)],
			array(
				'AlternateText' =>
				array(
					'required' => false,
					'type' => 'string',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => true,
					'cardinality' => '0..*'
				),
				'SuggestedText' =>
				array(
					'required' => false,
					'type' => 'string',
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
	 * @return string
	 * @param integer $index 
	 **/
	function getAlternateText($index = null)
	{
		if ($index !== null)
		{
			return $this->AlternateText[$index];
		}
		else
		{
			return $this->AlternateText;
		}
	}

	/**
	 * @return void
	 * @param string $value
	 * @param integer $index 
	 **/
	function setAlternateText($value, $index = null)
	{
		if ($index !== null)
		{
			$this->AlternateText[$index] = $value;
		}
		else
		{
			$this->AlternateText= $value;
		}
	}

	/**
	 * @return void
	 * @param string $value
	 **/
	function addAlternateText($value)
	{
		$this->AlternateText[] = $value;
	}

	/**
	 * @return string
	 **/
	function getSuggestedText()
	{
		return $this->SuggestedText;
	}

	/**
	 * @return void
	 **/
	function setSuggestedText($value)
	{
		$this->SuggestedText = $value;
	}

}
?>
