<?php
/* Generated on 14.02.18 14:28 by globalsync
 * $Id: $
 * $Log: $
 */

require_once 'AbstractResponseType.php';

/**
  * Base response of the <b>ValidateChallengeInput</b> call. The response indicates whether the botblock challenge was successful.
  * 
 **/

class ValidateChallengeInputResponseType extends AbstractResponseType
{
	/**
	* @var boolean
	**/
	protected $ValidToken;


	/**
	 * Class Constructor 
	 **/
	function __construct()
	{
		parent::__construct('ValidateChallengeInputResponseType', 'urn:ebay:apis:eBLBaseComponents');
		if (!isset(self::$_elements[__CLASS__]))
		{
			self::$_elements[__CLASS__] = array_merge(self::$_elements[get_parent_class(__CLASS__)],
			array(
				'ValidToken' =>
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
	 * @return boolean
	 **/
	function getValidToken()
	{
		return $this->ValidToken;
	}

	/**
	 * @return void
	 **/
	function setValidToken($value)
	{
		$this->ValidToken = $value;
	}

}
?>
