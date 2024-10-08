<?php
/* Generated on 14.02.18 14:28 by globalsync
 * $Id: $
 * $Log: $
 */

require_once 'AbstractResponseType.php';
require_once 'CountryDetailsType.php';
require_once 'CurrencyDetailsType.php';
require_once 'DispatchTimeMaxDetailsType.php';
require_once 'PaymentOptionDetailsType.php';
require_once 'RegionDetailsType.php';
require_once 'ShippingLocationDetailsType.php';
require_once 'ShippingServiceDetailsType.php';
require_once 'SiteDetailsType.php';
require_once 'TaxJurisdictionType.php';
require_once 'URLDetailsType.php';
require_once 'TimeZoneDetailsType.php';
require_once 'ItemSpecificDetailsType.php';
require_once 'UnitOfMeasurementDetailsType.php';
require_once 'RegionOfOriginDetailsType.php';
require_once 'ShippingPackageDetailsType.php';
require_once 'ShippingCarrierDetailsType.php';
require_once 'ReturnPolicyDetailsType.php';
require_once 'ListingStartPriceDetailsType.php';
require_once 'SiteBuyerRequirementDetailsType.php';
require_once 'ListingFeatureDetailsType.php';
require_once 'VariationDetailsType.php';
require_once 'ExcludeShippingLocationDetailsType.php';
require_once 'RecoupmentPolicyDetailsType.php';
require_once 'ShippingCategoryDetailsType.php';
require_once 'ProductDetailsType.php';

/**
  * Details about a specified site in response to <b>GeteBayDetailsRequest</b>. If no <b>DetailName</b> field is identified in the request, all elements of <b>GeteBayDetailsResponse</b> are returned. Otherwise, eBay returns only the elements corresponding to the specified <b>DetailName</b> fields. <b>UpdateTime</b> gives the time of modification of the most recently modified <b>DetailName</b>.
  * 
 **/

class GeteBayDetailsResponseType extends AbstractResponseType
{
	/**
	* @var CountryDetailsType
	**/
	protected $CountryDetails;

	/**
	* @var CurrencyDetailsType
	**/
	protected $CurrencyDetails;

	/**
	* @var DispatchTimeMaxDetailsType
	**/
	protected $DispatchTimeMaxDetails;

	/**
	* @var PaymentOptionDetailsType
	**/
	protected $PaymentOptionDetails;

	/**
	* @var RegionDetailsType
	**/
	protected $RegionDetails;

	/**
	* @var ShippingLocationDetailsType
	**/
	protected $ShippingLocationDetails;

	/**
	* @var ShippingServiceDetailsType
	**/
	protected $ShippingServiceDetails;

	/**
	* @var SiteDetailsType
	**/
	protected $SiteDetails;

	/**
	* @var TaxJurisdictionType
	**/
	protected $TaxJurisdiction;

	/**
	* @var URLDetailsType
	**/
	protected $URLDetails;

	/**
	* @var TimeZoneDetailsType
	**/
	protected $TimeZoneDetails;

	/**
	* @var ItemSpecificDetailsType
	**/
	protected $ItemSpecificDetails;

	/**
	* @var UnitOfMeasurementDetailsType
	**/
	protected $UnitOfMeasurementDetails;

	/**
	* @var RegionOfOriginDetailsType
	**/
	protected $RegionOfOriginDetails;

	/**
	* @var ShippingPackageDetailsType
	**/
	protected $ShippingPackageDetails;

	/**
	* @var ShippingCarrierDetailsType
	**/
	protected $ShippingCarrierDetails;

	/**
	* @var ReturnPolicyDetailsType
	**/
	protected $ReturnPolicyDetails;

	/**
	* @var ListingStartPriceDetailsType
	**/
	protected $ListingStartPriceDetails;

	/**
	* @var SiteBuyerRequirementDetailsType
	**/
	protected $BuyerRequirementDetails;

	/**
	* @var ListingFeatureDetailsType
	**/
	protected $ListingFeatureDetails;

	/**
	* @var VariationDetailsType
	**/
	protected $VariationDetails;

	/**
	* @var ExcludeShippingLocationDetailsType
	**/
	protected $ExcludeShippingLocationDetails;

	/**
	* @var dateTime
	**/
	protected $UpdateTime;

	/**
	* @var RecoupmentPolicyDetailsType
	**/
	protected $RecoupmentPolicyDetails;

	/**
	* @var ShippingCategoryDetailsType
	**/
	protected $ShippingCategoryDetails;

	/**
	* @var ProductDetailsType
	**/
	protected $ProductDetails;


	/**
	 * Class Constructor 
	 **/
	function __construct()
	{
		parent::__construct('GeteBayDetailsResponseType', 'urn:ebay:apis:eBLBaseComponents');
		if (!isset(self::$_elements[__CLASS__]))
		{
			self::$_elements[__CLASS__] = array_merge(self::$_elements[get_parent_class(__CLASS__)],
			array(
				'CountryDetails' =>
				array(
					'required' => false,
					'type' => 'CountryDetailsType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => true,
					'cardinality' => '0..*'
				),
				'CurrencyDetails' =>
				array(
					'required' => false,
					'type' => 'CurrencyDetailsType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => true,
					'cardinality' => '0..*'
				),
				'DispatchTimeMaxDetails' =>
				array(
					'required' => false,
					'type' => 'DispatchTimeMaxDetailsType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => true,
					'cardinality' => '0..*'
				),
				'PaymentOptionDetails' =>
				array(
					'required' => false,
					'type' => 'PaymentOptionDetailsType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => true,
					'cardinality' => '0..*'
				),
				'RegionDetails' =>
				array(
					'required' => false,
					'type' => 'RegionDetailsType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => true,
					'cardinality' => '0..*'
				),
				'ShippingLocationDetails' =>
				array(
					'required' => false,
					'type' => 'ShippingLocationDetailsType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => true,
					'cardinality' => '0..*'
				),
				'ShippingServiceDetails' =>
				array(
					'required' => false,
					'type' => 'ShippingServiceDetailsType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => true,
					'cardinality' => '0..*'
				),
				'SiteDetails' =>
				array(
					'required' => false,
					'type' => 'SiteDetailsType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => true,
					'cardinality' => '0..*'
				),
				'TaxJurisdiction' =>
				array(
					'required' => false,
					'type' => 'TaxJurisdictionType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => true,
					'cardinality' => '0..*'
				),
				'URLDetails' =>
				array(
					'required' => false,
					'type' => 'URLDetailsType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => true,
					'cardinality' => '0..*'
				),
				'TimeZoneDetails' =>
				array(
					'required' => false,
					'type' => 'TimeZoneDetailsType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => true,
					'cardinality' => '0..*'
				),
				'ItemSpecificDetails' =>
				array(
					'required' => false,
					'type' => 'ItemSpecificDetailsType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => true,
					'cardinality' => '0..*'
				),
				'UnitOfMeasurementDetails' =>
				array(
					'required' => false,
					'type' => 'UnitOfMeasurementDetailsType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => true,
					'cardinality' => '0..*'
				),
				'RegionOfOriginDetails' =>
				array(
					'required' => false,
					'type' => 'RegionOfOriginDetailsType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => true,
					'cardinality' => '0..*'
				),
				'ShippingPackageDetails' =>
				array(
					'required' => false,
					'type' => 'ShippingPackageDetailsType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => true,
					'cardinality' => '0..*'
				),
				'ShippingCarrierDetails' =>
				array(
					'required' => false,
					'type' => 'ShippingCarrierDetailsType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => true,
					'cardinality' => '0..*'
				),
				'ReturnPolicyDetails' =>
				array(
					'required' => false,
					'type' => 'ReturnPolicyDetailsType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'ListingStartPriceDetails' =>
				array(
					'required' => false,
					'type' => 'ListingStartPriceDetailsType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => true,
					'cardinality' => '0..*'
				),
				'BuyerRequirementDetails' =>
				array(
					'required' => false,
					'type' => 'SiteBuyerRequirementDetailsType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => true,
					'cardinality' => '0..*'
				),
				'ListingFeatureDetails' =>
				array(
					'required' => false,
					'type' => 'ListingFeatureDetailsType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => true,
					'cardinality' => '0..*'
				),
				'VariationDetails' =>
				array(
					'required' => false,
					'type' => 'VariationDetailsType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'ExcludeShippingLocationDetails' =>
				array(
					'required' => false,
					'type' => 'ExcludeShippingLocationDetailsType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => true,
					'cardinality' => '0..*'
				),
				'UpdateTime' =>
				array(
					'required' => false,
					'type' => 'dateTime',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'RecoupmentPolicyDetails' =>
				array(
					'required' => false,
					'type' => 'RecoupmentPolicyDetailsType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => true,
					'cardinality' => '0..*'
				),
				'ShippingCategoryDetails' =>
				array(
					'required' => false,
					'type' => 'ShippingCategoryDetailsType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => true,
					'cardinality' => '0..*'
				),
				'ProductDetails' =>
				array(
					'required' => false,
					'type' => 'ProductDetailsType',
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
	 * @return CountryDetailsType
	 * @param integer $index 
	 **/
	function getCountryDetails($index = null)
	{
		if ($index !== null)
		{
			return $this->CountryDetails[$index];
		}
		else
		{
			return $this->CountryDetails;
		}
	}

	/**
	 * @return void
	 * @param CountryDetailsType $value
	 * @param integer $index 
	 **/
	function setCountryDetails($value, $index = null)
	{
		if ($index !== null)
		{
			$this->CountryDetails[$index] = $value;
		}
		else
		{
			$this->CountryDetails= $value;
		}
	}

	/**
	 * @return void
	 * @param CountryDetailsType $value
	 **/
	function addCountryDetails($value)
	{
		$this->CountryDetails[] = $value;
	}

	/**
	 * @return CurrencyDetailsType
	 * @param integer $index 
	 **/
	function getCurrencyDetails($index = null)
	{
		if ($index !== null)
		{
			return $this->CurrencyDetails[$index];
		}
		else
		{
			return $this->CurrencyDetails;
		}
	}

	/**
	 * @return void
	 * @param CurrencyDetailsType $value
	 * @param integer $index 
	 **/
	function setCurrencyDetails($value, $index = null)
	{
		if ($index !== null)
		{
			$this->CurrencyDetails[$index] = $value;
		}
		else
		{
			$this->CurrencyDetails= $value;
		}
	}

	/**
	 * @return void
	 * @param CurrencyDetailsType $value
	 **/
	function addCurrencyDetails($value)
	{
		$this->CurrencyDetails[] = $value;
	}

	/**
	 * @return DispatchTimeMaxDetailsType
	 * @param integer $index 
	 **/
	function getDispatchTimeMaxDetails($index = null)
	{
		if ($index !== null)
		{
			return $this->DispatchTimeMaxDetails[$index];
		}
		else
		{
			return $this->DispatchTimeMaxDetails;
		}
	}

	/**
	 * @return void
	 * @param DispatchTimeMaxDetailsType $value
	 * @param integer $index 
	 **/
	function setDispatchTimeMaxDetails($value, $index = null)
	{
		if ($index !== null)
		{
			$this->DispatchTimeMaxDetails[$index] = $value;
		}
		else
		{
			$this->DispatchTimeMaxDetails= $value;
		}
	}

	/**
	 * @return void
	 * @param DispatchTimeMaxDetailsType $value
	 **/
	function addDispatchTimeMaxDetails($value)
	{
		$this->DispatchTimeMaxDetails[] = $value;
	}

	/**
	 * @return PaymentOptionDetailsType
	 * @param integer $index 
	 **/
	function getPaymentOptionDetails($index = null)
	{
		if ($index !== null)
		{
			return $this->PaymentOptionDetails[$index];
		}
		else
		{
			return $this->PaymentOptionDetails;
		}
	}

	/**
	 * @return void
	 * @param PaymentOptionDetailsType $value
	 * @param integer $index 
	 **/
	function setPaymentOptionDetails($value, $index = null)
	{
		if ($index !== null)
		{
			$this->PaymentOptionDetails[$index] = $value;
		}
		else
		{
			$this->PaymentOptionDetails= $value;
		}
	}

	/**
	 * @return void
	 * @param PaymentOptionDetailsType $value
	 **/
	function addPaymentOptionDetails($value)
	{
		$this->PaymentOptionDetails[] = $value;
	}

	/**
	 * @return RegionDetailsType
	 * @param integer $index 
	 **/
	function getRegionDetails($index = null)
	{
		if ($index !== null)
		{
			return $this->RegionDetails[$index];
		}
		else
		{
			return $this->RegionDetails;
		}
	}

	/**
	 * @return void
	 * @param RegionDetailsType $value
	 * @param integer $index 
	 **/
	function setRegionDetails($value, $index = null)
	{
		if ($index !== null)
		{
			$this->RegionDetails[$index] = $value;
		}
		else
		{
			$this->RegionDetails= $value;
		}
	}

	/**
	 * @return void
	 * @param RegionDetailsType $value
	 **/
	function addRegionDetails($value)
	{
		$this->RegionDetails[] = $value;
	}

	/**
	 * @return ShippingLocationDetailsType
	 * @param integer $index 
	 **/
	function getShippingLocationDetails($index = null)
	{
		if ($index !== null)
		{
			return $this->ShippingLocationDetails[$index];
		}
		else
		{
			return $this->ShippingLocationDetails;
		}
	}

	/**
	 * @return void
	 * @param ShippingLocationDetailsType $value
	 * @param integer $index 
	 **/
	function setShippingLocationDetails($value, $index = null)
	{
		if ($index !== null)
		{
			$this->ShippingLocationDetails[$index] = $value;
		}
		else
		{
			$this->ShippingLocationDetails= $value;
		}
	}

	/**
	 * @return void
	 * @param ShippingLocationDetailsType $value
	 **/
	function addShippingLocationDetails($value)
	{
		$this->ShippingLocationDetails[] = $value;
	}

	/**
	 * @return ShippingServiceDetailsType
	 * @param integer $index 
	 **/
	function getShippingServiceDetails($index = null)
	{
		if ($index !== null)
		{
			return $this->ShippingServiceDetails[$index];
		}
		else
		{
			return $this->ShippingServiceDetails;
		}
	}

	/**
	 * @return void
	 * @param ShippingServiceDetailsType $value
	 * @param integer $index 
	 **/
	function setShippingServiceDetails($value, $index = null)
	{
		if ($index !== null)
		{
			$this->ShippingServiceDetails[$index] = $value;
		}
		else
		{
			$this->ShippingServiceDetails= $value;
		}
	}

	/**
	 * @return void
	 * @param ShippingServiceDetailsType $value
	 **/
	function addShippingServiceDetails($value)
	{
		$this->ShippingServiceDetails[] = $value;
	}

	/**
	 * @return SiteDetailsType
	 * @param integer $index 
	 **/
	function getSiteDetails($index = null)
	{
		if ($index !== null)
		{
			return $this->SiteDetails[$index];
		}
		else
		{
			return $this->SiteDetails;
		}
	}

	/**
	 * @return void
	 * @param SiteDetailsType $value
	 * @param integer $index 
	 **/
	function setSiteDetails($value, $index = null)
	{
		if ($index !== null)
		{
			$this->SiteDetails[$index] = $value;
		}
		else
		{
			$this->SiteDetails= $value;
		}
	}

	/**
	 * @return void
	 * @param SiteDetailsType $value
	 **/
	function addSiteDetails($value)
	{
		$this->SiteDetails[] = $value;
	}

	/**
	 * @return TaxJurisdictionType
	 * @param integer $index 
	 **/
	function getTaxJurisdiction($index = null)
	{
		if ($index !== null)
		{
			return $this->TaxJurisdiction[$index];
		}
		else
		{
			return $this->TaxJurisdiction;
		}
	}

	/**
	 * @return void
	 * @param TaxJurisdictionType $value
	 * @param integer $index 
	 **/
	function setTaxJurisdiction($value, $index = null)
	{
		if ($index !== null)
		{
			$this->TaxJurisdiction[$index] = $value;
		}
		else
		{
			$this->TaxJurisdiction= $value;
		}
	}

	/**
	 * @return void
	 * @param TaxJurisdictionType $value
	 **/
	function addTaxJurisdiction($value)
	{
		$this->TaxJurisdiction[] = $value;
	}

	/**
	 * @return URLDetailsType
	 * @param integer $index 
	 **/
	function getURLDetails($index = null)
	{
		if ($index !== null)
		{
			return $this->URLDetails[$index];
		}
		else
		{
			return $this->URLDetails;
		}
	}

	/**
	 * @return void
	 * @param URLDetailsType $value
	 * @param integer $index 
	 **/
	function setURLDetails($value, $index = null)
	{
		if ($index !== null)
		{
			$this->URLDetails[$index] = $value;
		}
		else
		{
			$this->URLDetails= $value;
		}
	}

	/**
	 * @return void
	 * @param URLDetailsType $value
	 **/
	function addURLDetails($value)
	{
		$this->URLDetails[] = $value;
	}

	/**
	 * @return TimeZoneDetailsType
	 * @param integer $index 
	 **/
	function getTimeZoneDetails($index = null)
	{
		if ($index !== null)
		{
			return $this->TimeZoneDetails[$index];
		}
		else
		{
			return $this->TimeZoneDetails;
		}
	}

	/**
	 * @return void
	 * @param TimeZoneDetailsType $value
	 * @param integer $index 
	 **/
	function setTimeZoneDetails($value, $index = null)
	{
		if ($index !== null)
		{
			$this->TimeZoneDetails[$index] = $value;
		}
		else
		{
			$this->TimeZoneDetails= $value;
		}
	}

	/**
	 * @return void
	 * @param TimeZoneDetailsType $value
	 **/
	function addTimeZoneDetails($value)
	{
		$this->TimeZoneDetails[] = $value;
	}

	/**
	 * @return ItemSpecificDetailsType
	 * @param integer $index 
	 **/
	function getItemSpecificDetails($index = null)
	{
		if ($index !== null)
		{
			return $this->ItemSpecificDetails[$index];
		}
		else
		{
			return $this->ItemSpecificDetails;
		}
	}

	/**
	 * @return void
	 * @param ItemSpecificDetailsType $value
	 * @param integer $index 
	 **/
	function setItemSpecificDetails($value, $index = null)
	{
		if ($index !== null)
		{
			$this->ItemSpecificDetails[$index] = $value;
		}
		else
		{
			$this->ItemSpecificDetails= $value;
		}
	}

	/**
	 * @return void
	 * @param ItemSpecificDetailsType $value
	 **/
	function addItemSpecificDetails($value)
	{
		$this->ItemSpecificDetails[] = $value;
	}

	/**
	 * @return UnitOfMeasurementDetailsType
	 * @param integer $index 
	 **/
	function getUnitOfMeasurementDetails($index = null)
	{
		if ($index !== null)
		{
			return $this->UnitOfMeasurementDetails[$index];
		}
		else
		{
			return $this->UnitOfMeasurementDetails;
		}
	}

	/**
	 * @return void
	 * @param UnitOfMeasurementDetailsType $value
	 * @param integer $index 
	 **/
	function setUnitOfMeasurementDetails($value, $index = null)
	{
		if ($index !== null)
		{
			$this->UnitOfMeasurementDetails[$index] = $value;
		}
		else
		{
			$this->UnitOfMeasurementDetails= $value;
		}
	}

	/**
	 * @return void
	 * @param UnitOfMeasurementDetailsType $value
	 **/
	function addUnitOfMeasurementDetails($value)
	{
		$this->UnitOfMeasurementDetails[] = $value;
	}

	/**
	 * @return RegionOfOriginDetailsType
	 * @param integer $index 
	 **/
	function getRegionOfOriginDetails($index = null)
	{
		if ($index !== null)
		{
			return $this->RegionOfOriginDetails[$index];
		}
		else
		{
			return $this->RegionOfOriginDetails;
		}
	}

	/**
	 * @return void
	 * @param RegionOfOriginDetailsType $value
	 * @param integer $index 
	 **/
	function setRegionOfOriginDetails($value, $index = null)
	{
		if ($index !== null)
		{
			$this->RegionOfOriginDetails[$index] = $value;
		}
		else
		{
			$this->RegionOfOriginDetails= $value;
		}
	}

	/**
	 * @return void
	 * @param RegionOfOriginDetailsType $value
	 **/
	function addRegionOfOriginDetails($value)
	{
		$this->RegionOfOriginDetails[] = $value;
	}

	/**
	 * @return ShippingPackageDetailsType
	 * @param integer $index 
	 **/
	function getShippingPackageDetails($index = null)
	{
		if ($index !== null)
		{
			return $this->ShippingPackageDetails[$index];
		}
		else
		{
			return $this->ShippingPackageDetails;
		}
	}

	/**
	 * @return void
	 * @param ShippingPackageDetailsType $value
	 * @param integer $index 
	 **/
	function setShippingPackageDetails($value, $index = null)
	{
		if ($index !== null)
		{
			$this->ShippingPackageDetails[$index] = $value;
		}
		else
		{
			$this->ShippingPackageDetails= $value;
		}
	}

	/**
	 * @return void
	 * @param ShippingPackageDetailsType $value
	 **/
	function addShippingPackageDetails($value)
	{
		$this->ShippingPackageDetails[] = $value;
	}

	/**
	 * @return ShippingCarrierDetailsType
	 * @param integer $index 
	 **/
	function getShippingCarrierDetails($index = null)
	{
		if ($index !== null)
		{
			return $this->ShippingCarrierDetails[$index];
		}
		else
		{
			return $this->ShippingCarrierDetails;
		}
	}

	/**
	 * @return void
	 * @param ShippingCarrierDetailsType $value
	 * @param integer $index 
	 **/
	function setShippingCarrierDetails($value, $index = null)
	{
		if ($index !== null)
		{
			$this->ShippingCarrierDetails[$index] = $value;
		}
		else
		{
			$this->ShippingCarrierDetails= $value;
		}
	}

	/**
	 * @return void
	 * @param ShippingCarrierDetailsType $value
	 **/
	function addShippingCarrierDetails($value)
	{
		$this->ShippingCarrierDetails[] = $value;
	}

	/**
	 * @return ReturnPolicyDetailsType
	 **/
	function getReturnPolicyDetails()
	{
		return $this->ReturnPolicyDetails;
	}

	/**
	 * @return void
	 **/
	function setReturnPolicyDetails($value)
	{
		$this->ReturnPolicyDetails = $value;
	}

	/**
	 * @return ListingStartPriceDetailsType
	 * @param integer $index 
	 **/
	function getListingStartPriceDetails($index = null)
	{
		if ($index !== null)
		{
			return $this->ListingStartPriceDetails[$index];
		}
		else
		{
			return $this->ListingStartPriceDetails;
		}
	}

	/**
	 * @return void
	 * @param ListingStartPriceDetailsType $value
	 * @param integer $index 
	 **/
	function setListingStartPriceDetails($value, $index = null)
	{
		if ($index !== null)
		{
			$this->ListingStartPriceDetails[$index] = $value;
		}
		else
		{
			$this->ListingStartPriceDetails= $value;
		}
	}

	/**
	 * @return void
	 * @param ListingStartPriceDetailsType $value
	 **/
	function addListingStartPriceDetails($value)
	{
		$this->ListingStartPriceDetails[] = $value;
	}

	/**
	 * @return SiteBuyerRequirementDetailsType
	 * @param integer $index 
	 **/
	function getBuyerRequirementDetails($index = null)
	{
		if ($index !== null)
		{
			return $this->BuyerRequirementDetails[$index];
		}
		else
		{
			return $this->BuyerRequirementDetails;
		}
	}

	/**
	 * @return void
	 * @param SiteBuyerRequirementDetailsType $value
	 * @param integer $index 
	 **/
	function setBuyerRequirementDetails($value, $index = null)
	{
		if ($index !== null)
		{
			$this->BuyerRequirementDetails[$index] = $value;
		}
		else
		{
			$this->BuyerRequirementDetails= $value;
		}
	}

	/**
	 * @return void
	 * @param SiteBuyerRequirementDetailsType $value
	 **/
	function addBuyerRequirementDetails($value)
	{
		$this->BuyerRequirementDetails[] = $value;
	}

	/**
	 * @return ListingFeatureDetailsType
	 * @param integer $index 
	 **/
	function getListingFeatureDetails($index = null)
	{
		if ($index !== null)
		{
			return $this->ListingFeatureDetails[$index];
		}
		else
		{
			return $this->ListingFeatureDetails;
		}
	}

	/**
	 * @return void
	 * @param ListingFeatureDetailsType $value
	 * @param integer $index 
	 **/
	function setListingFeatureDetails($value, $index = null)
	{
		if ($index !== null)
		{
			$this->ListingFeatureDetails[$index] = $value;
		}
		else
		{
			$this->ListingFeatureDetails= $value;
		}
	}

	/**
	 * @return void
	 * @param ListingFeatureDetailsType $value
	 **/
	function addListingFeatureDetails($value)
	{
		$this->ListingFeatureDetails[] = $value;
	}

	/**
	 * @return VariationDetailsType
	 **/
	function getVariationDetails()
	{
		return $this->VariationDetails;
	}

	/**
	 * @return void
	 **/
	function setVariationDetails($value)
	{
		$this->VariationDetails = $value;
	}

	/**
	 * @return ExcludeShippingLocationDetailsType
	 * @param integer $index 
	 **/
	function getExcludeShippingLocationDetails($index = null)
	{
		if ($index !== null)
		{
			return $this->ExcludeShippingLocationDetails[$index];
		}
		else
		{
			return $this->ExcludeShippingLocationDetails;
		}
	}

	/**
	 * @return void
	 * @param ExcludeShippingLocationDetailsType $value
	 * @param integer $index 
	 **/
	function setExcludeShippingLocationDetails($value, $index = null)
	{
		if ($index !== null)
		{
			$this->ExcludeShippingLocationDetails[$index] = $value;
		}
		else
		{
			$this->ExcludeShippingLocationDetails= $value;
		}
	}

	/**
	 * @return void
	 * @param ExcludeShippingLocationDetailsType $value
	 **/
	function addExcludeShippingLocationDetails($value)
	{
		$this->ExcludeShippingLocationDetails[] = $value;
	}

	/**
	 * @return dateTime
	 **/
	function getUpdateTime()
	{
		return $this->UpdateTime;
	}

	/**
	 * @return void
	 **/
	function setUpdateTime($value)
	{
		$this->UpdateTime = $value;
	}

	/**
	 * @return RecoupmentPolicyDetailsType
	 * @param integer $index 
	 **/
	function getRecoupmentPolicyDetails($index = null)
	{
		if ($index !== null)
		{
			return $this->RecoupmentPolicyDetails[$index];
		}
		else
		{
			return $this->RecoupmentPolicyDetails;
		}
	}

	/**
	 * @return void
	 * @param RecoupmentPolicyDetailsType $value
	 * @param integer $index 
	 **/
	function setRecoupmentPolicyDetails($value, $index = null)
	{
		if ($index !== null)
		{
			$this->RecoupmentPolicyDetails[$index] = $value;
		}
		else
		{
			$this->RecoupmentPolicyDetails= $value;
		}
	}

	/**
	 * @return void
	 * @param RecoupmentPolicyDetailsType $value
	 **/
	function addRecoupmentPolicyDetails($value)
	{
		$this->RecoupmentPolicyDetails[] = $value;
	}

	/**
	 * @return ShippingCategoryDetailsType
	 * @param integer $index 
	 **/
	function getShippingCategoryDetails($index = null)
	{
		if ($index !== null)
		{
			return $this->ShippingCategoryDetails[$index];
		}
		else
		{
			return $this->ShippingCategoryDetails;
		}
	}

	/**
	 * @return void
	 * @param ShippingCategoryDetailsType $value
	 * @param integer $index 
	 **/
	function setShippingCategoryDetails($value, $index = null)
	{
		if ($index !== null)
		{
			$this->ShippingCategoryDetails[$index] = $value;
		}
		else
		{
			$this->ShippingCategoryDetails= $value;
		}
	}

	/**
	 * @return void
	 * @param ShippingCategoryDetailsType $value
	 **/
	function addShippingCategoryDetails($value)
	{
		$this->ShippingCategoryDetails[] = $value;
	}

	/**
	 * @return ProductDetailsType
	 **/
	function getProductDetails()
	{
		return $this->ProductDetails;
	}

	/**
	 * @return void
	 **/
	function setProductDetails($value)
	{
		$this->ProductDetails = $value;
	}

}
?>
