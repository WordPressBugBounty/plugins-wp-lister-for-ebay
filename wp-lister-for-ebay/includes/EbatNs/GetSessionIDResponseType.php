<?php
/* Generated on 14.02.18 14:28 by globalsync
 * $Id: $
 * $Log: $
 */

require_once 'AbstractResponseType.php';

/**
  * The base response of the <b>GetSessionID</b> call. This response will include the generated <b>SessionID</b> value, which is a unique identifier for authenticating data entry during the process that creates a user token.
  * 
 **/

class GetSessionIDResponseType extends AbstractResponseType
{
	/**
	* @var string
	**/
	protected $SessionID;


	/**
	 * Class Constructor 
	 **/
	function __construct()
	{
		parent::__construct('GetSessionIDResponseType', 'urn:ebay:apis:eBLBaseComponents');
		if (!isset(self::$_elements[__CLASS__]))
		{
			self::$_elements[__CLASS__] = array_merge(self::$_elements[get_parent_class(__CLASS__)],
			array(
				'SessionID' =>
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
	 * @return string
	 **/
	function getSessionID()
	{
		return $this->SessionID;
	}

	/**
	 * @return void
	 **/
	function setSessionID($value)
	{
		$this->SessionID = $value;
	}

}
?>
