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

class BidAssistantListType extends EbatNs_ComplexType
{
	/**
	* @var long
	**/
	protected $BidGroupID;

	/**
	* @var boolean
	**/
	protected $IncludeNotes;


	/**
	 * Class Constructor 
	 **/
	function __construct()
	{
		parent::__construct('BidAssistantListType', 'urn:ebay:apis:eBLBaseComponents');
		if (!isset(self::$_elements[__CLASS__]))
		{
			self::$_elements[__CLASS__] = array_merge(self::$_elements[get_parent_class(__CLASS__)],
			array(
				'BidGroupID' =>
				array(
					'required' => false,
					'type' => 'long',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'IncludeNotes' =>
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
	 * @return long
	 **/
	function getBidGroupID()
	{
		return $this->BidGroupID;
	}

	/**
	 * @return void
	 **/
	function setBidGroupID($value)
	{
		$this->BidGroupID = $value;
	}

	/**
	 * @return boolean
	 **/
	function getIncludeNotes()
	{
		return $this->IncludeNotes;
	}

	/**
	 * @return void
	 **/
	function setIncludeNotes($value)
	{
		$this->IncludeNotes = $value;
	}

}
?>
