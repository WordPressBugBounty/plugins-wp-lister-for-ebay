<?php
/* Generated on 14.02.18 14:28 by globalsync
 * $Id: $
 * $Log: $
 */

require_once 'EbatNs_ComplexType.php';

/**
  * Type defining the <b>BrandMPN</b> container which is used to identify a product (through unique product brand and Manufacturer Part Number combination).
  * <br>
  * <br>
  * <span class="tablenote"><b>Note:</b>
  * If a Brand/MPN pair is required for the category/brand, these values must still be input through the <b>BrandMPN</b> container, but a catalog product match is only possible with an ePID or one of the GTINs.
  * </span>
  * 
 **/

class BrandMPNType extends EbatNs_ComplexType
{
	/**
	* @var string
	**/
	protected $Brand;

	/**
	* @var string
	**/
	protected $MPN;


	/**
	 * Class Constructor 
	 **/
	function __construct()
	{
		parent::__construct('BrandMPNType', 'urn:ebay:apis:eBLBaseComponents');
		if (!isset(self::$_elements[__CLASS__]))
		{
			self::$_elements[__CLASS__] = array_merge(self::$_elements[get_parent_class(__CLASS__)],
			array(
				'Brand' =>
				array(
					'required' => false,
					'type' => 'string',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'MPN' =>
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
	 **/
	function getBrand()
	{
		return $this->Brand;
	}

	/**
	 * @return void
	 **/
	function setBrand($value)
	{
		$this->Brand = $value;
	}

	/**
	 * @return string
	 **/
	function getMPN()
	{
		return $this->MPN;
	}

	/**
	 * @return void
	 **/
	function setMPN($value)
	{
		$this->MPN = $value;
	}

}
?>
