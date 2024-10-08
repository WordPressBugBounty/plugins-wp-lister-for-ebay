<?php
/* Generated on 14.02.18 14:28 by globalsync
 * $Id: $
 * $Log: $
 */

require_once 'AbstractRequestType.php';
require_once 'StringMatchCodeType.php';

/**
  * This is the base request type for the <b>GetCharities</b> call. This call is used to search for eBay for Charity nonprofit organizations. This call allows users to search for a specific nonprofit organization, or to search for multiple nonprofit organizations from a particular category and/or geographical region, or by using a search string.
  * 
 **/

class GetCharitiesRequestType extends AbstractRequestType
{
	/**
	* @var string
	**/
	protected $CharityID;

	/**
	* @var string
	**/
	protected $CharityName;

	/**
	* @var string
	**/
	protected $Query;

	/**
	* @var int
	**/
	protected $CharityRegion;

	/**
	* @var int
	**/
	protected $CharityDomain;

	/**
	* @var boolean
	**/
	protected $IncludeDescription;

	/**
	* @var StringMatchCodeType
	**/
	protected $MatchType;

	/**
	* @var boolean
	**/
	protected $Featured;

	/**
	* @var long
	**/
	protected $CampaignID;


	/**
	 * Class Constructor 
	 **/
	function __construct()
	{
		parent::__construct('GetCharitiesRequestType', 'urn:ebay:apis:eBLBaseComponents');
		if (!isset(self::$_elements[__CLASS__]))
		{
			self::$_elements[__CLASS__] = array_merge(self::$_elements[get_parent_class(__CLASS__)],
			array(
				'CharityID' =>
				array(
					'required' => false,
					'type' => 'string',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'CharityName' =>
				array(
					'required' => false,
					'type' => 'string',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'Query' =>
				array(
					'required' => false,
					'type' => 'string',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'CharityRegion' =>
				array(
					'required' => false,
					'type' => 'int',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'CharityDomain' =>
				array(
					'required' => false,
					'type' => 'int',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'IncludeDescription' =>
				array(
					'required' => false,
					'type' => 'boolean',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'MatchType' =>
				array(
					'required' => false,
					'type' => 'StringMatchCodeType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'Featured' =>
				array(
					'required' => false,
					'type' => 'boolean',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'CampaignID' =>
				array(
					'required' => false,
					'type' => 'long',
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
	function getCharityID()
	{
		return $this->CharityID;
	}

	/**
	 * @return void
	 **/
	function setCharityID($value)
	{
		$this->CharityID = $value;
	}

	/**
	 * @return string
	 **/
	function getCharityName()
	{
		return $this->CharityName;
	}

	/**
	 * @return void
	 **/
	function setCharityName($value)
	{
		$this->CharityName = $value;
	}

	/**
	 * @return string
	 **/
	function getQuery()
	{
		return $this->Query;
	}

	/**
	 * @return void
	 **/
	function setQuery($value)
	{
		$this->Query = $value;
	}

	/**
	 * @return int
	 **/
	function getCharityRegion()
	{
		return $this->CharityRegion;
	}

	/**
	 * @return void
	 **/
	function setCharityRegion($value)
	{
		$this->CharityRegion = $value;
	}

	/**
	 * @return int
	 **/
	function getCharityDomain()
	{
		return $this->CharityDomain;
	}

	/**
	 * @return void
	 **/
	function setCharityDomain($value)
	{
		$this->CharityDomain = $value;
	}

	/**
	 * @return boolean
	 **/
	function getIncludeDescription()
	{
		return $this->IncludeDescription;
	}

	/**
	 * @return void
	 **/
	function setIncludeDescription($value)
	{
		$this->IncludeDescription = $value;
	}

	/**
	 * @return StringMatchCodeType
	 **/
	function getMatchType()
	{
		return $this->MatchType;
	}

	/**
	 * @return void
	 **/
	function setMatchType($value)
	{
		$this->MatchType = $value;
	}

	/**
	 * @return boolean
	 **/
	function getFeatured()
	{
		return $this->Featured;
	}

	/**
	 * @return void
	 **/
	function setFeatured($value)
	{
		$this->Featured = $value;
	}

	/**
	 * @return long
	 **/
	function getCampaignID()
	{
		return $this->CampaignID;
	}

	/**
	 * @return void
	 **/
	function setCampaignID($value)
	{
		$this->CampaignID = $value;
	}

}
?>
