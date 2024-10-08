<?php
/* Generated on 14.02.18 14:28 by globalsync
 * $Id: $
 * $Log: $
 */

require_once 'AbstractResponseType.php';
require_once 'VeROReasonCodeDetailsType.php';

/**
  * Base response of the <strong>GetVeROReasonCodeDetails</strong> call. This response will consists of one or more VeRO Program copyright/intellectual property infringement violation types.
  * 
 **/

class GetVeROReasonCodeDetailsResponseType extends AbstractResponseType
{
	/**
	* @var VeROReasonCodeDetailsType
	**/
	protected $VeROReasonCodeDetails;


	/**
	 * Class Constructor 
	 **/
	function __construct()
	{
		parent::__construct('GetVeROReasonCodeDetailsResponseType', 'urn:ebay:apis:eBLBaseComponents');
		if (!isset(self::$_elements[__CLASS__]))
		{
			self::$_elements[__CLASS__] = array_merge(self::$_elements[get_parent_class(__CLASS__)],
			array(
				'VeROReasonCodeDetails' =>
				array(
					'required' => false,
					'type' => 'VeROReasonCodeDetailsType',
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
	 * @return VeROReasonCodeDetailsType
	 **/
	function getVeROReasonCodeDetails()
	{
		return $this->VeROReasonCodeDetails;
	}

	/**
	 * @return void
	 **/
	function setVeROReasonCodeDetails($value)
	{
		$this->VeROReasonCodeDetails = $value;
	}

}
?>
