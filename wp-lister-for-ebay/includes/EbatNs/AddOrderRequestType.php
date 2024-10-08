<?php
/* Generated on 14.02.18 14:28 by globalsync
 * $Id: $
 * $Log: $
 */

require_once 'AbstractRequestType.php';
require_once 'OrderType.php';

/**
  * The <b>AddOrder</b> call can be used by a seller to combine two or more unpaid, single line item orders from the same buyer into one 'Combined Invoice' order with multiple line items. Once multiple line items are combined into one order, the buyer can make one single payment for multiple line item order. If possible and agreed to, the seller can then ship multiple line items in the same shipping package, saving on shipping costs, and possibly passing that savings down to the buyer through Combined Shipping Discount rules set up in My eBay.
  * 
 **/

class AddOrderRequestType extends AbstractRequestType
{
	/**
	* @var OrderType
	**/
	protected $Order;


	/**
	 * Class Constructor 
	 **/
	function __construct()
	{
		parent::__construct('AddOrderRequestType', 'urn:ebay:apis:eBLBaseComponents');
		if (!isset(self::$_elements[__CLASS__]))
		{
			self::$_elements[__CLASS__] = array_merge(self::$_elements[get_parent_class(__CLASS__)],
			array(
				'Order' =>
				array(
					'required' => false,
					'type' => 'OrderType',
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
	 * @return OrderType
	 **/
	function getOrder()
	{
		return $this->Order;
	}

	/**
	 * @return void
	 **/
	function setOrder($value)
	{
		$this->Order = $value;
	}

}
?>
