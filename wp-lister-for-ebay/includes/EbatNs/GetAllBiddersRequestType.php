<?php
/* Generated on 14.02.18 14:28 by globalsync
 * $Id: $
 * $Log: $
 */

require_once 'AbstractRequestType.php';
require_once 'ItemIDType.php';
require_once 'GetAllBiddersModeCodeType.php';

/**
  * This is the base request type for the <b>GetAllBidders</b> call, which is used to retrieve bidders from an active or recently-ended auction listing.
  * 
 **/

class GetAllBiddersRequestType extends AbstractRequestType
{
	/**
	* @var ItemIDType
	**/
	protected $ItemID;

	/**
	* @var GetAllBiddersModeCodeType
	**/
	protected $CallMode;

	/**
	* @var boolean
	**/
	protected $IncludeBiddingSummary;


	/**
	 * Class Constructor 
	 **/
	function __construct()
	{
		parent::__construct('GetAllBiddersRequestType', 'urn:ebay:apis:eBLBaseComponents');
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
				'CallMode' =>
				array(
					'required' => false,
					'type' => 'GetAllBiddersModeCodeType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'IncludeBiddingSummary' =>
				array(
					'required' => false,
					'type' => 'boolean',
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
	 * @return GetAllBiddersModeCodeType
	 **/
	function getCallMode()
	{
		return $this->CallMode;
	}

	/**
	 * @return void
	 **/
	function setCallMode($value)
	{
		$this->CallMode = $value;
	}

	/**
	 * @return boolean
	 **/
	function getIncludeBiddingSummary()
	{
		return $this->IncludeBiddingSummary;
	}

	/**
	 * @return void
	 **/
	function setIncludeBiddingSummary($value)
	{
		$this->IncludeBiddingSummary = $value;
	}

}
?>
