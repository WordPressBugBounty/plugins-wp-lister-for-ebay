<?php
/* Generated on 14.02.18 14:28 by globalsync
 * $Id: $
 * $Log: $
 */

require_once 'AbstractRequestType.php';
require_once 'OfferType.php';
require_once 'ItemIDType.php';
require_once 'AffiliateTrackingDetailsType.php';
require_once 'NameValueListArrayType.php';

/**
  * Enables the authenticated user to to make a bid on an auction item, propose a Best Offer, or purchase a fixed-price/Buy It Now item.
  * 
 **/

class PlaceOfferRequestType extends AbstractRequestType
{
	/**
	* @var OfferType
	**/
	protected $Offer;

	/**
	* @var ItemIDType
	**/
	protected $ItemID;

	/**
	* @var boolean
	**/
	protected $BlockOnWarning;

	/**
	* @var AffiliateTrackingDetailsType
	**/
	protected $AffiliateTrackingDetails;

	/**
	* @var NameValueListArrayType
	**/
	protected $VariationSpecifics;


	/**
	 * Class Constructor 
	 **/
	function __construct()
	{
		parent::__construct('PlaceOfferRequestType', 'urn:ebay:apis:eBLBaseComponents');
		if (!isset(self::$_elements[__CLASS__]))
		{
			self::$_elements[__CLASS__] = array_merge(self::$_elements[get_parent_class(__CLASS__)],
			array(
				'Offer' =>
				array(
					'required' => false,
					'type' => 'OfferType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'ItemID' =>
				array(
					'required' => false,
					'type' => 'ItemIDType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'BlockOnWarning' =>
				array(
					'required' => false,
					'type' => 'boolean',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'AffiliateTrackingDetails' =>
				array(
					'required' => false,
					'type' => 'AffiliateTrackingDetailsType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'VariationSpecifics' =>
				array(
					'required' => false,
					'type' => 'NameValueListArrayType',
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
	 * @return OfferType
	 **/
	function getOffer()
	{
		return $this->Offer;
	}

	/**
	 * @return void
	 **/
	function setOffer($value)
	{
		$this->Offer = $value;
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
	 * @return boolean
	 **/
	function getBlockOnWarning()
	{
		return $this->BlockOnWarning;
	}

	/**
	 * @return void
	 **/
	function setBlockOnWarning($value)
	{
		$this->BlockOnWarning = $value;
	}

	/**
	 * @return AffiliateTrackingDetailsType
	 **/
	function getAffiliateTrackingDetails()
	{
		return $this->AffiliateTrackingDetails;
	}

	/**
	 * @return void
	 **/
	function setAffiliateTrackingDetails($value)
	{
		$this->AffiliateTrackingDetails = $value;
	}

	/**
	 * @return NameValueListArrayType
	 **/
	function getVariationSpecifics()
	{
		return $this->VariationSpecifics;
	}

	/**
	 * @return void
	 **/
	function setVariationSpecifics($value)
	{
		$this->VariationSpecifics = $value;
	}

}
?>
