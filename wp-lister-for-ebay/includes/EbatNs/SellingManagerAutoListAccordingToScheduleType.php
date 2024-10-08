<?php
/* Generated on 14.02.18 14:28 by globalsync
 * $Id: $
 * $Log: $
 */

require_once 'EbatNs_ComplexType.php';
require_once 'DayOfWeekCodeType.php';

/**Defines the options available for an Automated Listing Rule that 
  * keeps a fixed number of items on the site
 **/

class SellingManagerAutoListAccordingToScheduleType extends EbatNs_ComplexType
{
	/**
	* @var DayOfWeekCodeType
	**/
	protected $DayOfWeek;

	/**
	* @var int
	**/
	protected $ListingPeriodInWeeks;

	/**
	* @var time
	**/
	protected $ListAtSpecificTimeOfDay;

	/**
	* @var dateTime
	**/
	protected $StartTime;

	/**
	* @var dateTime
	**/
	protected $EndTime;

	/**
	* @var int
	**/
	protected $MaxActiveItemCount;

	/**
	* @var int
	**/
	protected $ListingHoldInventoryLevel;


	/**
	 * Class Constructor 
	 **/
	function __construct()
	{
		parent::__construct('SellingManagerAutoListAccordingToScheduleType', 'urn:ebay:apis:eBLBaseComponents');
		if (!isset(self::$_elements[__CLASS__]))
		{
			self::$_elements[__CLASS__] = array_merge(self::$_elements[get_parent_class(__CLASS__)],
			array(
				'DayOfWeek' =>
				array(
					'required' => false,
					'type' => 'DayOfWeekCodeType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => true,
					'cardinality' => '0..*'
				),
				'ListingPeriodInWeeks' =>
				array(
					'required' => false,
					'type' => 'int',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'ListAtSpecificTimeOfDay' =>
				array(
					'required' => false,
					'type' => 'time',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
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
				'MaxActiveItemCount' =>
				array(
					'required' => false,
					'type' => 'int',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'ListingHoldInventoryLevel' =>
				array(
					'required' => false,
					'type' => 'int',
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
	 * @return DayOfWeekCodeType
	 * @param integer $index 
	 **/
	function getDayOfWeek($index = null)
	{
		if ($index !== null)
		{
			return $this->DayOfWeek[$index];
		}
		else
		{
			return $this->DayOfWeek;
		}
	}

	/**
	 * @return void
	 * @param DayOfWeekCodeType $value
	 * @param integer $index 
	 **/
	function setDayOfWeek($value, $index = null)
	{
		if ($index !== null)
		{
			$this->DayOfWeek[$index] = $value;
		}
		else
		{
			$this->DayOfWeek= $value;
		}
	}

	/**
	 * @return void
	 * @param DayOfWeekCodeType $value
	 **/
	function addDayOfWeek($value)
	{
		$this->DayOfWeek[] = $value;
	}

	/**
	 * @return int
	 **/
	function getListingPeriodInWeeks()
	{
		return $this->ListingPeriodInWeeks;
	}

	/**
	 * @return void
	 **/
	function setListingPeriodInWeeks($value)
	{
		$this->ListingPeriodInWeeks = $value;
	}

	/**
	 * @return time
	 **/
	function getListAtSpecificTimeOfDay()
	{
		return $this->ListAtSpecificTimeOfDay;
	}

	/**
	 * @return void
	 **/
	function setListAtSpecificTimeOfDay($value)
	{
		$this->ListAtSpecificTimeOfDay = $value;
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
	 * @return int
	 **/
	function getMaxActiveItemCount()
	{
		return $this->MaxActiveItemCount;
	}

	/**
	 * @return void
	 **/
	function setMaxActiveItemCount($value)
	{
		$this->MaxActiveItemCount = $value;
	}

	/**
	 * @return int
	 **/
	function getListingHoldInventoryLevel()
	{
		return $this->ListingHoldInventoryLevel;
	}

	/**
	 * @return void
	 **/
	function setListingHoldInventoryLevel($value)
	{
		$this->ListingHoldInventoryLevel = $value;
	}

}
?>
