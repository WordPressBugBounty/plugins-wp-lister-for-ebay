<?php
/* Generated on 14.02.18 14:28 by globalsync
 * $Id: $
 * $Log: $
 */

require_once 'AbstractRequestType.php';

/**
  * Retrieves Selling Manager alerts.
  * This call is subject to change without notice; the deprecation process is
  * inapplicable to this call.
  * 
 **/

class GetSellingManagerAlertsRequestType extends AbstractRequestType
{

	/**
	 * Class Constructor 
	 **/
	function __construct()
	{
		parent::__construct('GetSellingManagerAlertsRequestType', 'urn:ebay:apis:eBLBaseComponents');
		if (!isset(self::$_elements[__CLASS__]))
		{
			self::$_elements[__CLASS__] = array_merge(self::$_elements[get_parent_class(__CLASS__)],
			array(
));
		}
		$this->_attributes = array_merge($this->_attributes,
		array(
));
	}

}
?>
