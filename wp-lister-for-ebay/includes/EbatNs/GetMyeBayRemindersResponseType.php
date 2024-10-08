<?php
/* Generated on 14.02.18 14:28 by globalsync
 * $Id: $
 * $Log: $
 */

require_once 'AbstractResponseType.php';
require_once 'RemindersType.php';

/**
  * This is the base response type of the <b>GetMyeBayReminders</b> call. This call returns the total counts for My eBay Buying and/or My eBay Selling Reminders for a user.
  * 
 **/

class GetMyeBayRemindersResponseType extends AbstractResponseType
{
	/**
	* @var RemindersType
	**/
	protected $BuyingReminders;

	/**
	* @var RemindersType
	**/
	protected $SellingReminders;


	/**
	 * Class Constructor 
	 **/
	function __construct()
	{
		parent::__construct('GetMyeBayRemindersResponseType', 'urn:ebay:apis:eBLBaseComponents');
		if (!isset(self::$_elements[__CLASS__]))
		{
			self::$_elements[__CLASS__] = array_merge(self::$_elements[get_parent_class(__CLASS__)],
			array(
				'BuyingReminders' =>
				array(
					'required' => false,
					'type' => 'RemindersType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'SellingReminders' =>
				array(
					'required' => false,
					'type' => 'RemindersType',
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
	 * @return RemindersType
	 **/
	function getBuyingReminders()
	{
		return $this->BuyingReminders;
	}

	/**
	 * @return void
	 **/
	function setBuyingReminders($value)
	{
		$this->BuyingReminders = $value;
	}

	/**
	 * @return RemindersType
	 **/
	function getSellingReminders()
	{
		return $this->SellingReminders;
	}

	/**
	 * @return void
	 **/
	function setSellingReminders($value)
	{
		$this->SellingReminders = $value;
	}

}
?>
