<?php
/* Generated on 14.02.18 14:28 by globalsync
 * $Id: $
 * $Log: $
 */

require_once 'AbstractResponseType.php';
require_once 'TokenStatusType.php';

/**
  * The base response of the <b>GetTokenStatus</b> call. This call retrieves the status of a user token.
  * 
 **/

class GetTokenStatusResponseType extends AbstractResponseType
{
	/**
	* @var TokenStatusType
	**/
	protected $TokenStatus;


	/**
	 * Class Constructor 
	 **/
	function __construct()
	{
		parent::__construct('GetTokenStatusResponseType', 'urn:ebay:apis:eBLBaseComponents');
		if (!isset(self::$_elements[__CLASS__]))
		{
			self::$_elements[__CLASS__] = array_merge(self::$_elements[get_parent_class(__CLASS__)],
			array(
				'TokenStatus' =>
				array(
					'required' => false,
					'type' => 'TokenStatusType',
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
	 * @return TokenStatusType
	 **/
	function getTokenStatus()
	{
		return $this->TokenStatus;
	}

	/**
	 * @return void
	 **/
	function setTokenStatus($value)
	{
		$this->TokenStatus = $value;
	}

}
?>
