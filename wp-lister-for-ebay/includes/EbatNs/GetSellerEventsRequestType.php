<?php
/* Generated on 14.02.18 14:28 by globalsync
 * $Id: $
 * $Log: $
 */

require_once 'AbstractRequestType.php';
require_once 'UserIDType.php';

/**
  * Retrieves price changes, item revisions, description revisions,
  * and other changes that have occurred within the last 48 hours
  * related to a seller's eBay listings.
  * 
 **/

class GetSellerEventsRequestType extends AbstractRequestType
{
	/**
	* @var UserIDType
	**/
	protected $UserID;

	/**
	* @var dateTime
	**/
	protected $StartTimeFrom;

	/**
	* @var dateTime
	**/
	protected $StartTimeTo;

	/**
	* @var dateTime
	**/
	protected $EndTimeFrom;

	/**
	* @var dateTime
	**/
	protected $EndTimeTo;

	/**
	* @var dateTime
	**/
	protected $ModTimeFrom;

	/**
	* @var dateTime
	**/
	protected $ModTimeTo;

	/**
	* @var boolean
	**/
	protected $NewItemFilter;

	/**
	* @var boolean
	**/
	protected $IncludeWatchCount;

	/**
	* @var boolean
	**/
	protected $IncludeVariationSpecifics;

	/**
	* @var boolean
	**/
	protected $HideVariations;


	/**
	 * Class Constructor 
	 **/
	function __construct()
	{
		parent::__construct('GetSellerEventsRequestType', 'urn:ebay:apis:eBLBaseComponents');
		if (!isset(self::$_elements[__CLASS__]))
		{
			self::$_elements[__CLASS__] = array_merge(self::$_elements[get_parent_class(__CLASS__)],
			array(
				'UserID' =>
				array(
					'required' => false,
					'type' => 'UserIDType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'StartTimeFrom' =>
				array(
					'required' => false,
					'type' => 'dateTime',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'StartTimeTo' =>
				array(
					'required' => false,
					'type' => 'dateTime',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'EndTimeFrom' =>
				array(
					'required' => false,
					'type' => 'dateTime',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'EndTimeTo' =>
				array(
					'required' => false,
					'type' => 'dateTime',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'ModTimeFrom' =>
				array(
					'required' => false,
					'type' => 'dateTime',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'ModTimeTo' =>
				array(
					'required' => false,
					'type' => 'dateTime',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'NewItemFilter' =>
				array(
					'required' => false,
					'type' => 'boolean',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'IncludeWatchCount' =>
				array(
					'required' => false,
					'type' => 'boolean',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'IncludeVariationSpecifics' =>
				array(
					'required' => false,
					'type' => 'boolean',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'HideVariations' =>
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
	 * @return UserIDType
	 **/
	function getUserID()
	{
		return $this->UserID;
	}

	/**
	 * @return void
	 **/
	function setUserID($value)
	{
		$this->UserID = $value;
	}

	/**
	 * @return dateTime
	 **/
	function getStartTimeFrom()
	{
		return $this->StartTimeFrom;
	}

	/**
	 * @return void
	 **/
	function setStartTimeFrom($value)
	{
		$this->StartTimeFrom = $value;
	}

	/**
	 * @return dateTime
	 **/
	function getStartTimeTo()
	{
		return $this->StartTimeTo;
	}

	/**
	 * @return void
	 **/
	function setStartTimeTo($value)
	{
		$this->StartTimeTo = $value;
	}

	/**
	 * @return dateTime
	 **/
	function getEndTimeFrom()
	{
		return $this->EndTimeFrom;
	}

	/**
	 * @return void
	 **/
	function setEndTimeFrom($value)
	{
		$this->EndTimeFrom = $value;
	}

	/**
	 * @return dateTime
	 **/
	function getEndTimeTo()
	{
		return $this->EndTimeTo;
	}

	/**
	 * @return void
	 **/
	function setEndTimeTo($value)
	{
		$this->EndTimeTo = $value;
	}

	/**
	 * @return dateTime
	 **/
	function getModTimeFrom()
	{
		return $this->ModTimeFrom;
	}

	/**
	 * @return void
	 **/
	function setModTimeFrom($value)
	{
		$this->ModTimeFrom = $value;
	}

	/**
	 * @return dateTime
	 **/
	function getModTimeTo()
	{
		return $this->ModTimeTo;
	}

	/**
	 * @return void
	 **/
	function setModTimeTo($value)
	{
		$this->ModTimeTo = $value;
	}

	/**
	 * @return boolean
	 **/
	function getNewItemFilter()
	{
		return $this->NewItemFilter;
	}

	/**
	 * @return void
	 **/
	function setNewItemFilter($value)
	{
		$this->NewItemFilter = $value;
	}

	/**
	 * @return boolean
	 **/
	function getIncludeWatchCount()
	{
		return $this->IncludeWatchCount;
	}

	/**
	 * @return void
	 **/
	function setIncludeWatchCount($value)
	{
		$this->IncludeWatchCount = $value;
	}

	/**
	 * @return boolean
	 **/
	function getIncludeVariationSpecifics()
	{
		return $this->IncludeVariationSpecifics;
	}

	/**
	 * @return void
	 **/
	function setIncludeVariationSpecifics($value)
	{
		$this->IncludeVariationSpecifics = $value;
	}

	/**
	 * @return boolean
	 **/
	function getHideVariations()
	{
		return $this->HideVariations;
	}

	/**
	 * @return void
	 **/
	function setHideVariations($value)
	{
		$this->HideVariations = $value;
	}

}
?>
