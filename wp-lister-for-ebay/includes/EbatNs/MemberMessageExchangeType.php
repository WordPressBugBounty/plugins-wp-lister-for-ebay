<?php
/* Generated on 14.02.18 14:28 by globalsync
 * $Id: $
 * $Log: $
 */

require_once 'EbatNs_ComplexType.php';
require_once 'ItemType.php';
require_once 'MemberMessageType.php';
require_once 'MessageStatusTypeCodeType.php';
require_once 'MessageMediaType.php';

/**
  * Container for message metadata.
  * 
 **/

class MemberMessageExchangeType extends EbatNs_ComplexType
{
	/**
	* @var ItemType
	**/
	protected $Item;

	/**
	* @var MemberMessageType
	**/
	protected $Question;

	/**
	* @var string
	**/
	protected $Response;

	/**
	* @var MessageStatusTypeCodeType
	**/
	protected $MessageStatus;

	/**
	* @var dateTime
	**/
	protected $CreationDate;

	/**
	* @var dateTime
	**/
	protected $LastModifiedDate;

	/**
	* @var MessageMediaType
	**/
	protected $MessageMedia;


	/**
	 * Class Constructor 
	 **/
	function __construct()
	{
		parent::__construct('MemberMessageExchangeType', 'urn:ebay:apis:eBLBaseComponents');
		if (!isset(self::$_elements[__CLASS__]))
		{
			self::$_elements[__CLASS__] = array_merge(self::$_elements[get_parent_class(__CLASS__)],
			array(
				'Item' =>
				array(
					'required' => false,
					'type' => 'ItemType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'Question' =>
				array(
					'required' => false,
					'type' => 'MemberMessageType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'Response' =>
				array(
					'required' => false,
					'type' => 'string',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => true,
					'cardinality' => '0..*'
				),
				'MessageStatus' =>
				array(
					'required' => false,
					'type' => 'MessageStatusTypeCodeType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'CreationDate' =>
				array(
					'required' => false,
					'type' => 'dateTime',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'LastModifiedDate' =>
				array(
					'required' => false,
					'type' => 'dateTime',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'MessageMedia' =>
				array(
					'required' => false,
					'type' => 'MessageMediaType',
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
	 * @return ItemType
	 **/
	function getItem()
	{
		return $this->Item;
	}

	/**
	 * @return void
	 **/
	function setItem($value)
	{
		$this->Item = $value;
	}

	/**
	 * @return MemberMessageType
	 **/
	function getQuestion()
	{
		return $this->Question;
	}

	/**
	 * @return void
	 **/
	function setQuestion($value)
	{
		$this->Question = $value;
	}

	/**
	 * @return string
	 * @param integer $index 
	 **/
	function getResponse($index = null)
	{
		if ($index !== null)
		{
			return $this->Response[$index];
		}
		else
		{
			return $this->Response;
		}
	}

	/**
	 * @return void
	 * @param string $value
	 * @param integer $index 
	 **/
	function setResponse($value, $index = null)
	{
		if ($index !== null)
		{
			$this->Response[$index] = $value;
		}
		else
		{
			$this->Response= $value;
		}
	}

	/**
	 * @return void
	 * @param string $value
	 **/
	function addResponse($value)
	{
		$this->Response[] = $value;
	}

	/**
	 * @return MessageStatusTypeCodeType
	 **/
	function getMessageStatus()
	{
		return $this->MessageStatus;
	}

	/**
	 * @return void
	 **/
	function setMessageStatus($value)
	{
		$this->MessageStatus = $value;
	}

	/**
	 * @return dateTime
	 **/
	function getCreationDate()
	{
		return $this->CreationDate;
	}

	/**
	 * @return void
	 **/
	function setCreationDate($value)
	{
		$this->CreationDate = $value;
	}

	/**
	 * @return dateTime
	 **/
	function getLastModifiedDate()
	{
		return $this->LastModifiedDate;
	}

	/**
	 * @return void
	 **/
	function setLastModifiedDate($value)
	{
		$this->LastModifiedDate = $value;
	}

	/**
	 * @return MessageMediaType
	 * @param integer $index 
	 **/
	function getMessageMedia($index = null)
	{
		if ($index !== null)
		{
			return $this->MessageMedia[$index];
		}
		else
		{
			return $this->MessageMedia;
		}
	}

	/**
	 * @return void
	 * @param MessageMediaType $value
	 * @param integer $index 
	 **/
	function setMessageMedia($value, $index = null)
	{
		if ($index !== null)
		{
			$this->MessageMedia[$index] = $value;
		}
		else
		{
			$this->MessageMedia= $value;
		}
	}

	/**
	 * @return void
	 * @param MessageMediaType $value
	 **/
	function addMessageMedia($value)
	{
		$this->MessageMedia[] = $value;
	}

}
?>
