<?php
/* Generated on 14.02.18 14:28 by globalsync
 * $Id: $
 * $Log: $
 */

require_once 'AbstractResponseType.php';
require_once 'ItemIDType.php';
require_once 'FeesType.php';
require_once 'DiscountReasonCodeType.php';
require_once 'ProductSuggestionsType.php';
require_once 'ListingRecommendationsType.php';

/**
  * The base response type for the <b>VerifyRelistItem</b> call. The response includes the Item ID for the relisted item, the SKU value for the item (if any), listing recommendations (if applicable), the estimated fees for the relisted item (except the Final Value Fee, which isn't calculated until the item has sold), the start and end times of the listing, and other details.
  * 
 **/

class VerifyRelistItemResponseType extends AbstractResponseType
{
	/**
	* @var ItemIDType
	**/
	protected $ItemID;

	/**
	* @var FeesType
	**/
	protected $Fees;

	/**
	* @var dateTime
	**/
	protected $StartTime;

	/**
	* @var dateTime
	**/
	protected $EndTime;

	/**
	* @var DiscountReasonCodeType
	**/
	protected $DiscountReason;

	/**
	* @var ProductSuggestionsType
	**/
	protected $ProductSuggestions;

	/**
	* @var ListingRecommendationsType
	**/
	protected $ListingRecommendations;


	/**
	 * Class Constructor 
	 **/
	function __construct()
	{
		parent::__construct('VerifyRelistItemResponseType', 'urn:ebay:apis:eBLBaseComponents');
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
				'Fees' =>
				array(
					'required' => false,
					'type' => 'FeesType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'StartTime' =>
				array(
					'required' => false,
					'type' => 'dateTime',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'EndTime' =>
				array(
					'required' => false,
					'type' => 'dateTime',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'DiscountReason' =>
				array(
					'required' => false,
					'type' => 'DiscountReasonCodeType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => true,
					'cardinality' => '0..*'
				),
				'ProductSuggestions' =>
				array(
					'required' => false,
					'type' => 'ProductSuggestionsType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'ListingRecommendations' =>
				array(
					'required' => false,
					'type' => 'ListingRecommendationsType',
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
	 * @return FeesType
	 **/
	function getFees()
	{
		return $this->Fees;
	}

	/**
	 * @return void
	 **/
	function setFees($value)
	{
		$this->Fees = $value;
	}

	/**
	 * @return dateTime
	 **/
	function getStartTime()
	{
		return $this->StartTime;
	}

	/**
	 * @return void
	 **/
	function setStartTime($value)
	{
		$this->StartTime = $value;
	}

	/**
	 * @return dateTime
	 **/
	function getEndTime()
	{
		return $this->EndTime;
	}

	/**
	 * @return void
	 **/
	function setEndTime($value)
	{
		$this->EndTime = $value;
	}

	/**
	 * @return DiscountReasonCodeType
	 * @param integer $index 
	 **/
	function getDiscountReason($index = null)
	{
		if ($index !== null)
		{
			return $this->DiscountReason[$index];
		}
		else
		{
			return $this->DiscountReason;
		}
	}

	/**
	 * @return void
	 * @param DiscountReasonCodeType $value
	 * @param integer $index 
	 **/
	function setDiscountReason($value, $index = null)
	{
		if ($index !== null)
		{
			$this->DiscountReason[$index] = $value;
		}
		else
		{
			$this->DiscountReason= $value;
		}
	}

	/**
	 * @return void
	 * @param DiscountReasonCodeType $value
	 **/
	function addDiscountReason($value)
	{
		$this->DiscountReason[] = $value;
	}

	/**
	 * @return ProductSuggestionsType
	 **/
	function getProductSuggestions()
	{
		return $this->ProductSuggestions;
	}

	/**
	 * @return void
	 **/
	function setProductSuggestions($value)
	{
		$this->ProductSuggestions = $value;
	}

	/**
	 * @return ListingRecommendationsType
	 **/
	function getListingRecommendations()
	{
		return $this->ListingRecommendations;
	}

	/**
	 * @return void
	 **/
	function setListingRecommendations($value)
	{
		$this->ListingRecommendations = $value;
	}

}
?>
