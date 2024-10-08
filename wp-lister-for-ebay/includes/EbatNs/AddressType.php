<?php
/* Generated on 14.02.18 14:28 by globalsync
 * $Id: $
 * $Log: $
 */

require_once 'EbatNs_ComplexType.php';
require_once 'CountryCodeType.php';
require_once 'AddressOwnerCodeType.php';
require_once 'AddressStatusCodeType.php';
require_once 'AddressRecordTypeCodeType.php';
require_once 'AddressUsageCodeType.php';
require_once 'AddressAttributeType.php';

/**
  * Contains the data for an eBay user's address. This is the base type for a
  * number of user addresses, including seller payment address, buyer
  * shipping address and buyer and seller registration address.
  * 
 **/

class AddressType extends EbatNs_ComplexType
{
	/**
	* @var string
	**/
	protected $Name;

	/**
	* @var string
	**/
	protected $Street;

	/**
	* @var string
	**/
	protected $Street1;

	/**
	* @var string
	**/
	protected $Street2;

	/**
	* @var string
	**/
	protected $CityName;

	/**
	* @var string
	**/
	protected $County;

	/**
	* @var string
	**/
	protected $StateOrProvince;

	/**
	* @var CountryCodeType
	**/
	protected $Country;

	/**
	* @var string
	**/
	protected $CountryName;

	/**
	* @var string
	**/
	protected $Phone;

	/**
	* @var CountryCodeType
	**/
	protected $PhoneCountryCode;

	/**
	* @var string
	**/
	protected $PhoneCountryPrefix;

	/**
	* @var string
	**/
	protected $PhoneAreaOrCityCode;

	/**
	* @var string
	**/
	protected $PhoneLocalNumber;

	/**
	* @var CountryCodeType
	**/
	protected $Phone2CountryCode;

	/**
	* @var string
	**/
	protected $Phone2CountryPrefix;

	/**
	* @var string
	**/
	protected $Phone2AreaOrCityCode;

	/**
	* @var string
	**/
	protected $Phone2LocalNumber;

	/**
	* @var string
	**/
	protected $PostalCode;

	/**
	* @var string
	**/
	protected $AddressID;

	/**
	* @var AddressOwnerCodeType
	**/
	protected $AddressOwner;

	/**
	* @var AddressStatusCodeType
	**/
	protected $AddressStatus;

	/**
	* @var string
	**/
	protected $ExternalAddressID;

	/**
	* @var string
	**/
	protected $InternationalName;

	/**
	* @var string
	**/
	protected $InternationalStateAndCity;

	/**
	* @var string
	**/
	protected $InternationalStreet;

	/**
	* @var string
	**/
	protected $CompanyName;

	/**
	* @var AddressRecordTypeCodeType
	**/
	protected $AddressRecordType;

	/**
	* @var string
	**/
	protected $FirstName;

	/**
	* @var string
	**/
	protected $LastName;

	/**
	* @var string
	**/
	protected $Phone2;

	/**
	* @var AddressUsageCodeType
	**/
	protected $AddressUsage;

	/**
	* @var string
	**/
	protected $ReferenceID;

	/**
	* @var AddressAttributeType
	**/
	protected $AddressAttribute;


	/**
	 * Class Constructor 
	 **/
	function __construct()
	{
		parent::__construct('AddressType', 'urn:ebay:apis:eBLBaseComponents');
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
				'Street' =>
				array(
					'required' => false,
					'type' => 'string',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'Street1' =>
				array(
					'required' => false,
					'type' => 'string',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'Street2' =>
				array(
					'required' => false,
					'type' => 'string',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'CityName' =>
				array(
					'required' => false,
					'type' => 'string',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'County' =>
				array(
					'required' => false,
					'type' => 'string',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'StateOrProvince' =>
				array(
					'required' => false,
					'type' => 'string',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'Country' =>
				array(
					'required' => false,
					'type' => 'CountryCodeType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'CountryName' =>
				array(
					'required' => false,
					'type' => 'string',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'Phone' =>
				array(
					'required' => false,
					'type' => 'string',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'PhoneCountryCode' =>
				array(
					'required' => false,
					'type' => 'CountryCodeType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'PhoneCountryPrefix' =>
				array(
					'required' => false,
					'type' => 'string',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'PhoneAreaOrCityCode' =>
				array(
					'required' => false,
					'type' => 'string',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'PhoneLocalNumber' =>
				array(
					'required' => false,
					'type' => 'string',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'Phone2CountryCode' =>
				array(
					'required' => false,
					'type' => 'CountryCodeType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'Phone2CountryPrefix' =>
				array(
					'required' => false,
					'type' => 'string',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'Phone2AreaOrCityCode' =>
				array(
					'required' => false,
					'type' => 'string',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'Phone2LocalNumber' =>
				array(
					'required' => false,
					'type' => 'string',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'PostalCode' =>
				array(
					'required' => false,
					'type' => 'string',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'AddressID' =>
				array(
					'required' => false,
					'type' => 'string',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'AddressOwner' =>
				array(
					'required' => false,
					'type' => 'AddressOwnerCodeType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'AddressStatus' =>
				array(
					'required' => false,
					'type' => 'AddressStatusCodeType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'ExternalAddressID' =>
				array(
					'required' => false,
					'type' => 'string',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'InternationalName' =>
				array(
					'required' => false,
					'type' => 'string',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'InternationalStateAndCity' =>
				array(
					'required' => false,
					'type' => 'string',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'InternationalStreet' =>
				array(
					'required' => false,
					'type' => 'string',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'CompanyName' =>
				array(
					'required' => false,
					'type' => 'string',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'AddressRecordType' =>
				array(
					'required' => false,
					'type' => 'AddressRecordTypeCodeType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'FirstName' =>
				array(
					'required' => false,
					'type' => 'string',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'LastName' =>
				array(
					'required' => false,
					'type' => 'string',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'Phone2' =>
				array(
					'required' => false,
					'type' => 'string',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'AddressUsage' =>
				array(
					'required' => false,
					'type' => 'AddressUsageCodeType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'ReferenceID' =>
				array(
					'required' => false,
					'type' => 'string',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'AddressAttribute' =>
				array(
					'required' => false,
					'type' => 'AddressAttributeType',
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
	 **/
	function getStreet()
	{
		return $this->Street;
	}

	/**
	 * @return void
	 **/
	function setStreet($value)
	{
		$this->Street = $value;
	}

	/**
	 * @return string
	 **/
	function getStreet1()
	{
		return $this->Street1;
	}

	/**
	 * @return void
	 **/
	function setStreet1($value)
	{
		$this->Street1 = $value;
	}

	/**
	 * @return string
	 **/
	function getStreet2()
	{
		return $this->Street2;
	}

	/**
	 * @return void
	 **/
	function setStreet2($value)
	{
		$this->Street2 = $value;
	}

	/**
	 * @return string
	 **/
	function getCityName()
	{
		return $this->CityName;
	}

	/**
	 * @return void
	 **/
	function setCityName($value)
	{
		$this->CityName = $value;
	}

	/**
	 * @return string
	 **/
	function getCounty()
	{
		return $this->County;
	}

	/**
	 * @return void
	 **/
	function setCounty($value)
	{
		$this->County = $value;
	}

	/**
	 * @return string
	 **/
	function getStateOrProvince()
	{
		return $this->StateOrProvince;
	}

	/**
	 * @return void
	 **/
	function setStateOrProvince($value)
	{
		$this->StateOrProvince = $value;
	}

	/**
	 * @return CountryCodeType
	 **/
	function getCountry()
	{
		return $this->Country;
	}

	/**
	 * @return void
	 **/
	function setCountry($value)
	{
		$this->Country = $value;
	}

	/**
	 * @return string
	 **/
	function getCountryName()
	{
		return $this->CountryName;
	}

	/**
	 * @return void
	 **/
	function setCountryName($value)
	{
		$this->CountryName = $value;
	}

	/**
	 * @return string
	 **/
	function getPhone()
	{
		return $this->Phone;
	}

	/**
	 * @return void
	 **/
	function setPhone($value)
	{
		$this->Phone = $value;
	}

	/**
	 * @return CountryCodeType
	 **/
	function getPhoneCountryCode()
	{
		return $this->PhoneCountryCode;
	}

	/**
	 * @return void
	 **/
	function setPhoneCountryCode($value)
	{
		$this->PhoneCountryCode = $value;
	}

	/**
	 * @return string
	 **/
	function getPhoneCountryPrefix()
	{
		return $this->PhoneCountryPrefix;
	}

	/**
	 * @return void
	 **/
	function setPhoneCountryPrefix($value)
	{
		$this->PhoneCountryPrefix = $value;
	}

	/**
	 * @return string
	 **/
	function getPhoneAreaOrCityCode()
	{
		return $this->PhoneAreaOrCityCode;
	}

	/**
	 * @return void
	 **/
	function setPhoneAreaOrCityCode($value)
	{
		$this->PhoneAreaOrCityCode = $value;
	}

	/**
	 * @return string
	 **/
	function getPhoneLocalNumber()
	{
		return $this->PhoneLocalNumber;
	}

	/**
	 * @return void
	 **/
	function setPhoneLocalNumber($value)
	{
		$this->PhoneLocalNumber = $value;
	}

	/**
	 * @return CountryCodeType
	 **/
	function getPhone2CountryCode()
	{
		return $this->Phone2CountryCode;
	}

	/**
	 * @return void
	 **/
	function setPhone2CountryCode($value)
	{
		$this->Phone2CountryCode = $value;
	}

	/**
	 * @return string
	 **/
	function getPhone2CountryPrefix()
	{
		return $this->Phone2CountryPrefix;
	}

	/**
	 * @return void
	 **/
	function setPhone2CountryPrefix($value)
	{
		$this->Phone2CountryPrefix = $value;
	}

	/**
	 * @return string
	 **/
	function getPhone2AreaOrCityCode()
	{
		return $this->Phone2AreaOrCityCode;
	}

	/**
	 * @return void
	 **/
	function setPhone2AreaOrCityCode($value)
	{
		$this->Phone2AreaOrCityCode = $value;
	}

	/**
	 * @return string
	 **/
	function getPhone2LocalNumber()
	{
		return $this->Phone2LocalNumber;
	}

	/**
	 * @return void
	 **/
	function setPhone2LocalNumber($value)
	{
		$this->Phone2LocalNumber = $value;
	}

	/**
	 * @return string
	 **/
	function getPostalCode()
	{
		return $this->PostalCode;
	}

	/**
	 * @return void
	 **/
	function setPostalCode($value)
	{
		$this->PostalCode = $value;
	}

	/**
	 * @return string
	 **/
	function getAddressID()
	{
		return $this->AddressID;
	}

	/**
	 * @return void
	 **/
	function setAddressID($value)
	{
		$this->AddressID = $value;
	}

	/**
	 * @return AddressOwnerCodeType
	 **/
	function getAddressOwner()
	{
		return $this->AddressOwner;
	}

	/**
	 * @return void
	 **/
	function setAddressOwner($value)
	{
		$this->AddressOwner = $value;
	}

	/**
	 * @return AddressStatusCodeType
	 **/
	function getAddressStatus()
	{
		return $this->AddressStatus;
	}

	/**
	 * @return void
	 **/
	function setAddressStatus($value)
	{
		$this->AddressStatus = $value;
	}

	/**
	 * @return string
	 **/
	function getExternalAddressID()
	{
		return $this->ExternalAddressID;
	}

	/**
	 * @return void
	 **/
	function setExternalAddressID($value)
	{
		$this->ExternalAddressID = $value;
	}

	/**
	 * @return string
	 **/
	function getInternationalName()
	{
		return $this->InternationalName;
	}

	/**
	 * @return void
	 **/
	function setInternationalName($value)
	{
		$this->InternationalName = $value;
	}

	/**
	 * @return string
	 **/
	function getInternationalStateAndCity()
	{
		return $this->InternationalStateAndCity;
	}

	/**
	 * @return void
	 **/
	function setInternationalStateAndCity($value)
	{
		$this->InternationalStateAndCity = $value;
	}

	/**
	 * @return string
	 **/
	function getInternationalStreet()
	{
		return $this->InternationalStreet;
	}

	/**
	 * @return void
	 **/
	function setInternationalStreet($value)
	{
		$this->InternationalStreet = $value;
	}

	/**
	 * @return string
	 **/
	function getCompanyName()
	{
		return $this->CompanyName;
	}

	/**
	 * @return void
	 **/
	function setCompanyName($value)
	{
		$this->CompanyName = $value;
	}

	/**
	 * @return AddressRecordTypeCodeType
	 **/
	function getAddressRecordType()
	{
		return $this->AddressRecordType;
	}

	/**
	 * @return void
	 **/
	function setAddressRecordType($value)
	{
		$this->AddressRecordType = $value;
	}

	/**
	 * @return string
	 **/
	function getFirstName()
	{
		return $this->FirstName;
	}

	/**
	 * @return void
	 **/
	function setFirstName($value)
	{
		$this->FirstName = $value;
	}

	/**
	 * @return string
	 **/
	function getLastName()
	{
		return $this->LastName;
	}

	/**
	 * @return void
	 **/
	function setLastName($value)
	{
		$this->LastName = $value;
	}

	/**
	 * @return string
	 **/
	function getPhone2()
	{
		return $this->Phone2;
	}

	/**
	 * @return void
	 **/
	function setPhone2($value)
	{
		$this->Phone2 = $value;
	}

	/**
	 * @return AddressUsageCodeType
	 **/
	function getAddressUsage()
	{
		return $this->AddressUsage;
	}

	/**
	 * @return void
	 **/
	function setAddressUsage($value)
	{
		$this->AddressUsage = $value;
	}

	/**
	 * @return string
	 **/
	function getReferenceID()
	{
		return $this->ReferenceID;
	}

	/**
	 * @return void
	 **/
	function setReferenceID($value)
	{
		$this->ReferenceID = $value;
	}

	/**
	 * @return AddressAttributeType
	 * @param integer $index 
	 **/
	function getAddressAttribute($index = null)
	{
		if ($index !== null)
		{
			return $this->AddressAttribute[$index];
		}
		else
		{
			return $this->AddressAttribute;
		}
	}

	/**
	 * @return void
	 * @param AddressAttributeType $value
	 * @param integer $index 
	 **/
	function setAddressAttribute($value, $index = null)
	{
		if ($index !== null)
		{
			$this->AddressAttribute[$index] = $value;
		}
		else
		{
			$this->AddressAttribute= $value;
		}
	}

	/**
	 * @return void
	 * @param AddressAttributeType $value
	 **/
	function addAddressAttribute($value)
	{
		$this->AddressAttribute[] = $value;
	}

}
?>
