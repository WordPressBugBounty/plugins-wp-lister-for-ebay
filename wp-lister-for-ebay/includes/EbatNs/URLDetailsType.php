<?php
/* Generated on 14.02.18 14:28 by globalsync
 * $Id: $
 * $Log: $
 */

require_once 'EbatNs_ComplexType.php';
require_once 'URLTypeCodeType.php';

/**
  * This type is used by the <b>URLDetails</b> containers that are returned in the response of <b>GeteBayDetails</b> if the <code>URLDetails</code> value is used in the <b>DetailName</b> field of the call request. Each <b>URLDetails</b> container conists of the URL of the different eBay pages, such as the View Item URL, the eBay Store URL, and others.
  * 
 **/

class URLDetailsType extends EbatNs_ComplexType
{
	/**
	* @var URLTypeCodeType
	**/
	protected $URLType;

	/**
	* @var anyURI
	**/
	protected $URL;

	/**
	* @var string
	**/
	protected $DetailVersion;

	/**
	* @var dateTime
	**/
	protected $UpdateTime;


	/**
	 * Class Constructor 
	 **/
	function __construct()
	{
		parent::__construct('URLDetailsType', 'urn:ebay:apis:eBLBaseComponents');
		if (!isset(self::$_elements[__CLASS__]))
		{
			self::$_elements[__CLASS__] = array_merge(self::$_elements[get_parent_class(__CLASS__)],
			array(
				'URLType' =>
				array(
					'required' => false,
					'type' => 'URLTypeCodeType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'URL' =>
				array(
					'required' => false,
					'type' => 'anyURI',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'DetailVersion' =>
				array(
					'required' => false,
					'type' => 'string',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'UpdateTime' =>
				array(
					'required' => false,
					'type' => 'dateTime',
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
	 * @return URLTypeCodeType
	 **/
	function getURLType()
	{
		return $this->URLType;
	}

	/**
	 * @return void
	 **/
	function setURLType($value)
	{
		$this->URLType = $value;
	}

	/**
	 * @return anyURI
	 **/
	function getURL()
	{
		return $this->URL;
	}

	/**
	 * @return void
	 **/
	function setURL($value)
	{
		$this->URL = $value;
	}

	/**
	 * @return string
	 **/
	function getDetailVersion()
	{
		return $this->DetailVersion;
	}

	/**
	 * @return void
	 **/
	function setDetailVersion($value)
	{
		$this->DetailVersion = $value;
	}

	/**
	 * @return dateTime
	 **/
	function getUpdateTime()
	{
		return $this->UpdateTime;
	}

	/**
	 * @return void
	 **/
	function setUpdateTime($value)
	{
		$this->UpdateTime = $value;
	}

}
?>
