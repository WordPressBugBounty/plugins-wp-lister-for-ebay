<?php
/* Generated on 14.02.18 14:28 by globalsync
 * $Id: $
 * $Log: $
 */

require_once 'EbatNs_ComplexType.php';
require_once 'NameValueListType.php';

/**
  * This type defines the <b>VariationProductListingDetails</b> container that is used to specify an EAN, an ISBN, or a UPC value to identify a specific product variation in a multi-variation listing. For multi-variation listings, the same product identifier type must be used for all product variations within the listing. For instance, if one product variation uses ISBNs, all product variations must use ISBN values.
  * 
 **/

class VariationProductListingDetailsType extends EbatNs_ComplexType
{
	/**
	* @var string
	**/
	protected $ISBN;

	/**
	* @var string
	**/
	protected $UPC;

	/**
	* @var string
	**/
	protected $EAN;

	/**
	* @var NameValueListType
	**/
	protected $NameValueList;


	/**
	 * Class Constructor 
	 **/
	function __construct()
	{
		parent::__construct('VariationProductListingDetailsType', 'urn:ebay:apis:eBLBaseComponents');
		if (!isset(self::$_elements[__CLASS__]))
		{
			self::$_elements[__CLASS__] = array_merge(self::$_elements[get_parent_class(__CLASS__)],
			array(
				'ISBN' =>
				array(
					'required' => false,
					'type' => 'string',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'UPC' =>
				array(
					'required' => false,
					'type' => 'string',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'EAN' =>
				array(
					'required' => false,
					'type' => 'string',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'NameValueList' =>
				array(
					'required' => false,
					'type' => 'NameValueListType',
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
	 * @return string
	 **/
	function getISBN()
	{
		return $this->ISBN;
	}

	/**
	 * @return void
	 **/
	function setISBN($value)
	{
		$this->ISBN = $value;
	}

	/**
	 * @return string
	 **/
	function getUPC()
	{
		return $this->UPC;
	}

	/**
	 * @return void
	 **/
	function setUPC($value)
	{
		$this->UPC = $value;
	}

	/**
	 * @return string
	 **/
	function getEAN()
	{
		return $this->EAN;
	}

	/**
	 * @return void
	 **/
	function setEAN($value)
	{
		$this->EAN = $value;
	}

	/**
	 * @return NameValueListType
	 * @param integer $index 
	 **/
	function getNameValueList($index = null)
	{
		if ($index !== null)
		{
			return $this->NameValueList[$index];
		}
		else
		{
			return $this->NameValueList;
		}
	}

	/**
	 * @return void
	 * @param NameValueListType $value
	 * @param integer $index 
	 **/
	function setNameValueList($value, $index = null)
	{
		if ($index !== null)
		{
			$this->NameValueList[$index] = $value;
		}
		else
		{
			$this->NameValueList= $value;
		}
	}

	/**
	 * @return void
	 * @param NameValueListType $value
	 **/
	function addNameValueList($value)
	{
		$this->NameValueList[] = $value;
	}

}
?>
