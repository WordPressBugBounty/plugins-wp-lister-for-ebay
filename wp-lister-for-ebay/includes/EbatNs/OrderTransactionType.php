<?php
/* Generated on 14.02.18 14:28 by globalsync
 * $Id: $
 * $Log: $
 */

require_once 'EbatNs_ComplexType.php';
require_once 'OrderType.php';
require_once 'EbayTransactionType.php';

/**
  * Contains an order or a transaction. A transaction is the sale of one or
  * more items from a seller's listing to a buyer. An order combines two or more transactions
  * into a single payment.
  * 
 **/

class OrderTransactionType extends EbatNs_ComplexType
{
	/**
	* @var OrderType
	**/
	protected $Order;

	/**
	* @var EbayTransactionType
	**/
	protected $Transaction;


	/**
	 * Class Constructor 
	 **/
	function __construct()
	{
		parent::__construct('OrderTransactionType', 'urn:ebay:apis:eBLBaseComponents');
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
				),
				'Transaction' =>
				array(
					'required' => false,
					'type' => 'TransactionType',
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

	/**
	 * @return EbayTransactionType
	 **/
	function getTransaction()
	{
		return $this->Transaction;
	}

	/**
	 * @return void
	 **/
	function setTransaction($value)
	{
		$this->Transaction = $value;
	}

}
?>
