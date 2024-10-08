<?php
/* Generated on 14.02.18 14:28 by globalsync
 * $Id: $
 * $Log: $
 */

require_once 'EbatNs_ComplexType.php';
require_once 'EnableCodeType.php';
require_once 'NotificationPayloadTypeCodeType.php';
require_once 'DeviceTypeCodeType.php';
require_once 'DeliveryURLDetailType.php';

/**
  * Type used by the <b>ApplicationDeliveryPreferences</b> container to control/indicate where and how Platform Notifications and/or Client Alerts are delivered to a user application, server, and/or email address.
  * 
 **/

class ApplicationDeliveryPreferencesType extends EbatNs_ComplexType
{
	/**
	* @var anyURI
	**/
	protected $ApplicationURL;

	/**
	* @var EnableCodeType
	**/
	protected $ApplicationEnable;

	/**
	* @var anyURI
	**/
	protected $AlertEmail;

	/**
	* @var EnableCodeType
	**/
	protected $AlertEnable;

	/**
	* @var NotificationPayloadTypeCodeType
	**/
	protected $NotificationPayloadType;

	/**
	* @var DeviceTypeCodeType
	**/
	protected $DeviceType;

	/**
	* @var string
	**/
	protected $PayloadVersion;

	/**
	* @var DeliveryURLDetailType
	**/
	protected $DeliveryURLDetails;


	/**
	 * Class Constructor 
	 **/
	function __construct()
	{
		parent::__construct('ApplicationDeliveryPreferencesType', 'urn:ebay:apis:eBLBaseComponents');
		if (!isset(self::$_elements[__CLASS__]))
		{
			self::$_elements[__CLASS__] = array_merge(self::$_elements[get_parent_class(__CLASS__)],
			array(
				'ApplicationURL' =>
				array(
					'required' => false,
					'type' => 'anyURI',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'ApplicationEnable' =>
				array(
					'required' => false,
					'type' => 'EnableCodeType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'AlertEmail' =>
				array(
					'required' => false,
					'type' => 'anyURI',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'AlertEnable' =>
				array(
					'required' => false,
					'type' => 'EnableCodeType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'NotificationPayloadType' =>
				array(
					'required' => false,
					'type' => 'NotificationPayloadTypeCodeType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'DeviceType' =>
				array(
					'required' => false,
					'type' => 'DeviceTypeCodeType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'PayloadVersion' =>
				array(
					'required' => false,
					'type' => 'string',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'DeliveryURLDetails' =>
				array(
					'required' => false,
					'type' => 'DeliveryURLDetailType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => true,
					'cardinality' => '0..*'
				)));
		}
		$this->_attributes = array_merge($this->_attributes,
		array(
));
	}

	/**
	 * @return anyURI
	 **/
	function getApplicationURL()
	{
		return $this->ApplicationURL;
	}

	/**
	 * @return void
	 **/
	function setApplicationURL($value)
	{
		$this->ApplicationURL = $value;
	}

	/**
	 * @return EnableCodeType
	 **/
	function getApplicationEnable()
	{
		return $this->ApplicationEnable;
	}

	/**
	 * @return void
	 **/
	function setApplicationEnable($value)
	{
		$this->ApplicationEnable = $value;
	}

	/**
	 * @return anyURI
	 **/
	function getAlertEmail()
	{
		return $this->AlertEmail;
	}

	/**
	 * @return void
	 **/
	function setAlertEmail($value)
	{
		$this->AlertEmail = $value;
	}

	/**
	 * @return EnableCodeType
	 **/
	function getAlertEnable()
	{
		return $this->AlertEnable;
	}

	/**
	 * @return void
	 **/
	function setAlertEnable($value)
	{
		$this->AlertEnable = $value;
	}

	/**
	 * @return NotificationPayloadTypeCodeType
	 **/
	function getNotificationPayloadType()
	{
		return $this->NotificationPayloadType;
	}

	/**
	 * @return void
	 **/
	function setNotificationPayloadType($value)
	{
		$this->NotificationPayloadType = $value;
	}

	/**
	 * @return DeviceTypeCodeType
	 **/
	function getDeviceType()
	{
		return $this->DeviceType;
	}

	/**
	 * @return void
	 **/
	function setDeviceType($value)
	{
		$this->DeviceType = $value;
	}

	/**
	 * @return string
	 **/
	function getPayloadVersion()
	{
		return $this->PayloadVersion;
	}

	/**
	 * @return void
	 **/
	function setPayloadVersion($value)
	{
		$this->PayloadVersion = $value;
	}

	/**
	 * @return DeliveryURLDetailType
	 * @param integer $index 
	 **/
	function getDeliveryURLDetails($index = null)
	{
		if ($index !== null)
		{
			return $this->DeliveryURLDetails[$index];
		}
		else
		{
			return $this->DeliveryURLDetails;
		}
	}

	/**
	 * @return void
	 * @param DeliveryURLDetailType $value
	 * @param integer $index 
	 **/
	function setDeliveryURLDetails($value, $index = null)
	{
		if ($index !== null)
		{
			$this->DeliveryURLDetails[$index] = $value;
		}
		else
		{
			$this->DeliveryURLDetails= $value;
		}
	}

	/**
	 * @return void
	 * @param DeliveryURLDetailType $value
	 **/
	function addDeliveryURLDetails($value)
	{
		$this->DeliveryURLDetails[] = $value;
	}

}
?>
