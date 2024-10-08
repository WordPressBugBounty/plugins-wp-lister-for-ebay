<?php
/* Generated on 14.02.18 14:28 by globalsync
 * $Id: $
 * $Log: $
 */

require_once 'AbstractRequestType.php';

/**
  * This call returns a list of up to 10 eBay categories that have the highest percentage of listings whose listing titles or descriptions contain the keywords you specify.
  * 
 **/

class GetSuggestedCategoriesRequestType extends AbstractRequestType
{
	/**
	* @var string
	**/
	protected $Query;


	/**
	 * Class Constructor 
	 **/
	function __construct()
	{
		parent::__construct('GetSuggestedCategoriesRequestType', 'urn:ebay:apis:eBLBaseComponents');
		if (!isset(self::$_elements[__CLASS__]))
		{
			self::$_elements[__CLASS__] = array_merge(self::$_elements[get_parent_class(__CLASS__)],
			array(
				'Query' =>
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
	function getQuery()
	{
		return $this->Query;
	}

	/**
	 * @return void
	 **/
	function setQuery($value)
	{
		$this->Query = $value;
	}

}
?>
