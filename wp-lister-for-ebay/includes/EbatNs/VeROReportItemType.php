<?php
/* Generated on 14.02.18 14:28 by globalsync
 * $Id: $
 * $Log: $
 */

require_once 'EbatNs_ComplexType.php';
require_once 'ItemIDType.php';
require_once 'ShippingRegionCodeType.php';
require_once 'CountryCodeType.php';

/**
  * This type is used by the <b>ReportItem</b> container. A <b>ReportItem</b> container is required for each eBay item that the product owner is reporting as violating the product owner's copyright, trademark, or intellectual property rights.
  * 
 **/

class VeROReportItemType extends EbatNs_ComplexType
{
	/**
	* @var ItemIDType
	**/
	protected $ItemID;

	/**
	* @var long
	**/
	protected $VeROReasonCodeID;

	/**
	* @var string
	**/
	protected $MessageToSeller;

	/**
	* @var boolean
	**/
	protected $CopyEmailToRightsOwner;

	/**
	* @var ShippingRegionCodeType
	**/
	protected $Region;

	/**
	* @var CountryCodeType
	**/
	protected $Country;

	/**
	* @var string
	**/
	protected $Patent;

	/**
	* @var string
	**/
	protected $DetailedMessage;


	/**
	 * Class Constructor 
	 **/
	function __construct()
	{
		parent::__construct('VeROReportItemType', 'urn:ebay:apis:eBLBaseComponents');
		if (!isset(self::$_elements[__CLASS__]))
		{
			self::$_elements[__CLASS__] = array_merge(self::$_elements[get_parent_class(__CLASS__)],
			array(
				'ItemID' =>
				array(
					'required' => false,
					'type' => 'ItemIDType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'VeROReasonCodeID' =>
				array(
					'required' => false,
					'type' => 'long',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'MessageToSeller' =>
				array(
					'required' => false,
					'type' => 'string',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'CopyEmailToRightsOwner' =>
				array(
					'required' => false,
					'type' => 'boolean',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'Region' =>
				array(
					'required' => false,
					'type' => 'ShippingRegionCodeType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => true,
					'cardinality' => '0..*'
				),
				'Country' =>
				array(
					'required' => false,
					'type' => 'CountryCodeType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => true,
					'cardinality' => '0..*'
				),
				'Patent' =>
				array(
					'required' => false,
					'type' => 'string',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'DetailedMessage' =>
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
	 * @return ItemIDType
	 **/
	function getItemID()
	{
		return $this->ItemID;
	}

	/**
	 * @return void
	 **/
	function setItemID($value)
	{
		$this->ItemID = $value;
	}

	/**
	 * @return long
	 **/
	function getVeROReasonCodeID()
	{
		return $this->VeROReasonCodeID;
	}

	/**
	 * @return void
	 **/
	function setVeROReasonCodeID($value)
	{
		$this->VeROReasonCodeID = $value;
	}

	/**
	 * @return string
	 **/
	function getMessageToSeller()
	{
		return $this->MessageToSeller;
	}

	/**
	 * @return void
	 **/
	function setMessageToSeller($value)
	{
		$this->MessageToSeller = $value;
	}

	/**
	 * @return boolean
	 **/
	function getCopyEmailToRightsOwner()
	{
		return $this->CopyEmailToRightsOwner;
	}

	/**
	 * @return void
	 **/
	function setCopyEmailToRightsOwner($value)
	{
		$this->CopyEmailToRightsOwner = $value;
	}

	/**
	 * @return ShippingRegionCodeType
	 * @param integer $index 
	 **/
	function getRegion($index = null)
	{
		if ($index !== null)
		{
			return $this->Region[$index];
		}
		else
		{
			return $this->Region;
		}
	}

	/**
	 * @return void
	 * @param ShippingRegionCodeType $value
	 * @param integer $index 
	 **/
	function setRegion($value, $index = null)
	{
		if ($index !== null)
		{
			$this->Region[$index] = $value;
		}
		else
		{
			$this->Region= $value;
		}
	}

	/**
	 * @return void
	 * @param ShippingRegionCodeType $value
	 **/
	function addRegion($value)
	{
		$this->Region[] = $value;
	}

	/**
	 * @return CountryCodeType
	 * @param integer $index 
	 **/
	function getCountry($index = null)
	{
		if ($index !== null)
		{
			return $this->Country[$index];
		}
		else
		{
			return $this->Country;
		}
	}

	/**
	 * @return void
	 * @param CountryCodeType $value
	 * @param integer $index 
	 **/
	function setCountry($value, $index = null)
	{
		if ($index !== null)
		{
			$this->Country[$index] = $value;
		}
		else
		{
			$this->Country= $value;
		}
	}

	/**
	 * @return void
	 * @param CountryCodeType $value
	 **/
	function addCountry($value)
	{
		$this->Country[] = $value;
	}

	/**
	 * @return string
	 **/
	function getPatent()
	{
		return $this->Patent;
	}

	/**
	 * @return void
	 **/
	function setPatent($value)
	{
		$this->Patent = $value;
	}

	/**
	 * @return string
	 **/
	function getDetailedMessage()
	{
		return $this->DetailedMessage;
	}

	/**
	 * @return void
	 **/
	function setDetailedMessage($value)
	{
		$this->DetailedMessage = $value;
	}

}
?>
