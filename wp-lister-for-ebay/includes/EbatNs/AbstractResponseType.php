<?php
/* Generated on 14.02.18 14:28 by globalsync
 * $Id: $
 * $Log: $
 */

require_once 'EbatNs_ComplexType.php';
require_once 'AckCodeType.php';
require_once 'ErrorType.php';
require_once 'DuplicateInvocationDetailsType.php';
require_once 'BotBlockResponseType.php';

/**
  * Base type definition of a response payload that can carry any
  * type of payload content with following optional elements:
  * <ul>
  * <li>timestamp of response message</li>
  * <li>application-level acknowledgement</li>
  * <li>application-level (business-level) errors and warnings</li>
  * </ul>
  * 
 **/

class AbstractResponseType extends EbatNs_ComplexType
{
	/**
	* @var dateTime
	**/
	protected $Timestamp;

	/**
	* @var AckCodeType
	**/
	protected $Ack;

	/**
	* @var string
	**/
	protected $CorrelationID;

	/**
	* @var ErrorType
	**/
	protected $Errors;

	/**
	* @var string
	**/
	protected $Message;

	/**
	* @var string
	**/
	protected $Version;

	/**
	* @var string
	**/
	protected $Build;

	/**
	* @var string
	**/
	protected $NotificationEventName;

	/**
	* @var DuplicateInvocationDetailsType
	**/
	protected $DuplicateInvocationDetails;

	/**
	* @var string
	**/
	protected $RecipientUserID;

	/**
	* @var string
	**/
	protected $EIASToken;

	/**
	* @var string
	**/
	protected $NotificationSignature;

	/**
	* @var string
	**/
	protected $HardExpirationWarning;

	/**
	* @var BotBlockResponseType
	**/
	protected $BotBlock;

	/**
	* @var string
	**/
	protected $ExternalUserData;


	/**
	 * Class Constructor 
	 **/
	function __construct()
	{
		parent::__construct('AbstractResponseType', 'urn:ebay:apis:eBLBaseComponents');
		if (!isset(self::$_elements[__CLASS__]))
		{
			self::$_elements[__CLASS__] = array_merge(self::$_elements[get_parent_class(__CLASS__)],
			array(
				'Timestamp' =>
				array(
					'required' => false,
					'type' => 'dateTime',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'Ack' =>
				array(
					'required' => false,
					'type' => 'AckCodeType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'CorrelationID' =>
				array(
					'required' => false,
					'type' => 'string',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'Errors' =>
				array(
					'required' => false,
					'type' => 'ErrorType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => true,
					'cardinality' => '0..*'
				),
				'Message' =>
				array(
					'required' => false,
					'type' => 'string',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'Version' =>
				array(
					'required' => false,
					'type' => 'string',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'Build' =>
				array(
					'required' => false,
					'type' => 'string',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'NotificationEventName' =>
				array(
					'required' => false,
					'type' => 'string',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'DuplicateInvocationDetails' =>
				array(
					'required' => false,
					'type' => 'DuplicateInvocationDetailsType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'RecipientUserID' =>
				array(
					'required' => false,
					'type' => 'string',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'EIASToken' =>
				array(
					'required' => false,
					'type' => 'string',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'NotificationSignature' =>
				array(
					'required' => false,
					'type' => 'string',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'HardExpirationWarning' =>
				array(
					'required' => false,
					'type' => 'string',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'BotBlock' =>
				array(
					'required' => false,
					'type' => 'BotBlockResponseType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'ExternalUserData' =>
				array(
					'required' => false,
					'type' => 'string',
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
	 * @return dateTime
	 **/
	function getTimestamp()
	{
		return $this->Timestamp;
	}

	/**
	 * @return void
	 **/
	function setTimestamp($value)
	{
		$this->Timestamp = $value;
	}

	/**
	 * @return AckCodeType
	 **/
	function getAck()
	{
		return $this->Ack;
	}

	/**
	 * @return void
	 **/
	function setAck($value)
	{
		$this->Ack = $value;
	}

	/**
	 * @return string
	 **/
	function getCorrelationID()
	{
		return $this->CorrelationID;
	}

	/**
	 * @return void
	 **/
	function setCorrelationID($value)
	{
		$this->CorrelationID = $value;
	}

	/**
	 * @return ErrorType
	 * @param integer $index 
	 **/
	function getErrors($index = null)
	{
		if ($index !== null)
		{
			return $this->Errors[$index];
		}
		else
		{
			return $this->Errors;
		}
	}

	/**
	 * @return void
	 * @param ErrorType $value
	 * @param integer $index 
	 **/
	function setErrors($value, $index = null)
	{
		if ($index !== null)
		{
			$this->Errors[$index] = $value;
		}
		else
		{
			$this->Errors= $value;
		}
	}

	/**
	 * @return void
	 * @param ErrorType $value
	 **/
	function addErrors($value)
	{
		$this->Errors[] = $value;
	}

	/**
	 * @return string
	 **/
	function getMessage()
	{
		return $this->Message;
	}

	/**
	 * @return void
	 **/
	function setMessage($value)
	{
		$this->Message = $value;
	}

	/**
	 * @return string
	 **/
	function getVersion()
	{
		return $this->Version;
	}

	/**
	 * @return void
	 **/
	function setVersion($value)
	{
		$this->Version = $value;
	}

	/**
	 * @return string
	 **/
	function getBuild()
	{
		return $this->Build;
	}

	/**
	 * @return void
	 **/
	function setBuild($value)
	{
		$this->Build = $value;
	}

	/**
	 * @return string
	 **/
	function getNotificationEventName()
	{
		return $this->NotificationEventName;
	}

	/**
	 * @return void
	 **/
	function setNotificationEventName($value)
	{
		$this->NotificationEventName = $value;
	}

	/**
	 * @return DuplicateInvocationDetailsType
	 **/
	function getDuplicateInvocationDetails()
	{
		return $this->DuplicateInvocationDetails;
	}

	/**
	 * @return void
	 **/
	function setDuplicateInvocationDetails($value)
	{
		$this->DuplicateInvocationDetails = $value;
	}

	/**
	 * @return string
	 **/
	function getRecipientUserID()
	{
		return $this->RecipientUserID;
	}

	/**
	 * @return void
	 **/
	function setRecipientUserID($value)
	{
		$this->RecipientUserID = $value;
	}

	/**
	 * @return string
	 **/
	function getEIASToken()
	{
		return $this->EIASToken;
	}

	/**
	 * @return void
	 **/
	function setEIASToken($value)
	{
		$this->EIASToken = $value;
	}

	/**
	 * @return string
	 **/
	function getNotificationSignature()
	{
		return $this->NotificationSignature;
	}

	/**
	 * @return void
	 **/
	function setNotificationSignature($value)
	{
		$this->NotificationSignature = $value;
	}

	/**
	 * @return string
	 **/
	function getHardExpirationWarning()
	{
		return $this->HardExpirationWarning;
	}

	/**
	 * @return void
	 **/
	function setHardExpirationWarning($value)
	{
		$this->HardExpirationWarning = $value;
	}

	/**
	 * @return BotBlockResponseType
	 **/
	function getBotBlock()
	{
		return $this->BotBlock;
	}

	/**
	 * @return void
	 **/
	function setBotBlock($value)
	{
		$this->BotBlock = $value;
	}

	/**
	 * @return string
	 **/
	function getExternalUserData()
	{
		return $this->ExternalUserData;
	}

	/**
	 * @return void
	 **/
	function setExternalUserData($value)
	{
		$this->ExternalUserData = $value;
	}

}
?>
