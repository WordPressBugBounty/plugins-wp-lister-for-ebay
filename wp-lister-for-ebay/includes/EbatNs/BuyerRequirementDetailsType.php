<?php
/* Generated on 14.02.18 14:28 by globalsync
 * $Id: $
 * $Log: $
 */

require_once 'EbatNs_ComplexType.php';
require_once 'MaximumItemRequirementsType.php';
require_once 'VerifiedUserRequirementsType.php';
require_once 'MaximumUnpaidItemStrikesInfoType.php';
require_once 'MaximumBuyerPolicyViolationsType.php';

/**
  * Type defining the <b>BuyerRequirementDetails</b> container, which allows the seller to set buyer requirements at the listing level. For the corresponding listing, all buyer requirement values/settings will overwrite values/settings in Buyer Requirements preferences in My eBay.
  * 
 **/

class BuyerRequirementDetailsType extends EbatNs_ComplexType
{
	/**
	* @var boolean
	**/
	protected $ShipToRegistrationCountry;

	/**
	* @var boolean
	**/
	protected $ZeroFeedbackScore;

	/**
	* @var int
	**/
	protected $MinimumFeedbackScore;

	/**
	* @var MaximumItemRequirementsType
	**/
	protected $MaximumItemRequirements;

	/**
	* @var boolean
	**/
	protected $LinkedPayPalAccount;

	/**
	* @var VerifiedUserRequirementsType
	**/
	protected $VerifiedUserRequirements;

	/**
	* @var MaximumUnpaidItemStrikesInfoType
	**/
	protected $MaximumUnpaidItemStrikesInfo;

	/**
	* @var MaximumBuyerPolicyViolationsType
	**/
	protected $MaximumBuyerPolicyViolations;


	/**
	 * Class Constructor 
	 **/
	function __construct()
	{
		parent::__construct('BuyerRequirementDetailsType', 'urn:ebay:apis:eBLBaseComponents');
		if (!isset(self::$_elements[__CLASS__]))
		{
			self::$_elements[__CLASS__] = array_merge(self::$_elements[get_parent_class(__CLASS__)],
			array(
				'ShipToRegistrationCountry' =>
				array(
					'required' => false,
					'type' => 'boolean',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'ZeroFeedbackScore' =>
				array(
					'required' => false,
					'type' => 'boolean',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'MinimumFeedbackScore' =>
				array(
					'required' => false,
					'type' => 'int',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'MaximumItemRequirements' =>
				array(
					'required' => false,
					'type' => 'MaximumItemRequirementsType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'LinkedPayPalAccount' =>
				array(
					'required' => false,
					'type' => 'boolean',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'VerifiedUserRequirements' =>
				array(
					'required' => false,
					'type' => 'VerifiedUserRequirementsType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'MaximumUnpaidItemStrikesInfo' =>
				array(
					'required' => false,
					'type' => 'MaximumUnpaidItemStrikesInfoType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'MaximumBuyerPolicyViolations' =>
				array(
					'required' => false,
					'type' => 'MaximumBuyerPolicyViolationsType',
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
	 * @return boolean
	 **/
	function getShipToRegistrationCountry()
	{
		return $this->ShipToRegistrationCountry;
	}

	/**
	 * @return void
	 **/
	function setShipToRegistrationCountry($value)
	{
		$this->ShipToRegistrationCountry = $value;
	}

	/**
	 * @return boolean
	 **/
	function getZeroFeedbackScore()
	{
		return $this->ZeroFeedbackScore;
	}

	/**
	 * @return void
	 **/
	function setZeroFeedbackScore($value)
	{
		$this->ZeroFeedbackScore = $value;
	}

	/**
	 * @return int
	 **/
	function getMinimumFeedbackScore()
	{
		return $this->MinimumFeedbackScore;
	}

	/**
	 * @return void
	 **/
	function setMinimumFeedbackScore($value)
	{
		$this->MinimumFeedbackScore = $value;
	}

	/**
	 * @return MaximumItemRequirementsType
	 **/
	function getMaximumItemRequirements()
	{
		return $this->MaximumItemRequirements;
	}

	/**
	 * @return void
	 **/
	function setMaximumItemRequirements($value)
	{
		$this->MaximumItemRequirements = $value;
	}

	/**
	 * @return boolean
	 **/
	function getLinkedPayPalAccount()
	{
		return $this->LinkedPayPalAccount;
	}

	/**
	 * @return void
	 **/
	function setLinkedPayPalAccount($value)
	{
		$this->LinkedPayPalAccount = $value;
	}

	/**
	 * @return VerifiedUserRequirementsType
	 **/
	function getVerifiedUserRequirements()
	{
		return $this->VerifiedUserRequirements;
	}

	/**
	 * @return void
	 **/
	function setVerifiedUserRequirements($value)
	{
		$this->VerifiedUserRequirements = $value;
	}

	/**
	 * @return MaximumUnpaidItemStrikesInfoType
	 **/
	function getMaximumUnpaidItemStrikesInfo()
	{
		return $this->MaximumUnpaidItemStrikesInfo;
	}

	/**
	 * @return void
	 **/
	function setMaximumUnpaidItemStrikesInfo($value)
	{
		$this->MaximumUnpaidItemStrikesInfo = $value;
	}

	/**
	 * @return MaximumBuyerPolicyViolationsType
	 **/
	function getMaximumBuyerPolicyViolations()
	{
		return $this->MaximumBuyerPolicyViolations;
	}

	/**
	 * @return void
	 **/
	function setMaximumBuyerPolicyViolations($value)
	{
		$this->MaximumBuyerPolicyViolations = $value;
	}

}
?>
