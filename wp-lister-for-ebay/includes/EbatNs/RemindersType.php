<?php
/* Generated on 14.02.18 14:28 by globalsync
 * $Id: $
 * $Log: $
 */

require_once 'EbatNs_ComplexType.php';

/**
  * This type contains the counts of various eBay Buying and Seller Reminders that are returned in the <b>GetMyeBayReminders</b> call.
  * 
 **/

class RemindersType extends EbatNs_ComplexType
{
	/**
	* @var int
	**/
	protected $PaymentToSendCount;

	/**
	* @var int
	**/
	protected $FeedbackToReceiveCount;

	/**
	* @var int
	**/
	protected $FeedbackToSendCount;

	/**
	* @var int
	**/
	protected $OutbidCount;

	/**
	* @var int
	**/
	protected $PaymentToReceiveCount;

	/**
	* @var int
	**/
	protected $SecondChanceOfferCount;

	/**
	* @var int
	**/
	protected $ShippingNeededCount;

	/**
	* @var int
	**/
	protected $RelistingNeededCount;

	/**
	* @var int
	**/
	protected $TotalNewLeadsCount;

	/**
	* @var int
	**/
	protected $DocsForCCProcessingToSendCount;

	/**
	* @var int
	**/
	protected $RTEToProcessCount;

	/**
	* @var int
	**/
	protected $ItemReceiptToConfirmCount;

	/**
	* @var int
	**/
	protected $RefundOnHoldCount;

	/**
	* @var int
	**/
	protected $RefundCancelledCount;

	/**
	* @var int
	**/
	protected $ShippingDetailsToBeProvidedCount;

	/**
	* @var int
	**/
	protected $ItemReceiptConfirmationToReceiveCount;

	/**
	* @var int
	**/
	protected $RefundInitiatedCount;

	/**
	* @var int
	**/
	protected $PendingRTERequestCount;

	/**
	* @var int
	**/
	protected $DeclinedRTERequestCount;


	/**
	 * Class Constructor 
	 **/
	function __construct()
	{
		parent::__construct('RemindersType', 'urn:ebay:apis:eBLBaseComponents');
		if (!isset(self::$_elements[__CLASS__]))
		{
			self::$_elements[__CLASS__] = array_merge(self::$_elements[get_parent_class(__CLASS__)],
			array(
				'PaymentToSendCount' =>
				array(
					'required' => false,
					'type' => 'int',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'FeedbackToReceiveCount' =>
				array(
					'required' => false,
					'type' => 'int',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'FeedbackToSendCount' =>
				array(
					'required' => false,
					'type' => 'int',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'OutbidCount' =>
				array(
					'required' => false,
					'type' => 'int',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'PaymentToReceiveCount' =>
				array(
					'required' => false,
					'type' => 'int',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'SecondChanceOfferCount' =>
				array(
					'required' => false,
					'type' => 'int',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'ShippingNeededCount' =>
				array(
					'required' => false,
					'type' => 'int',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'RelistingNeededCount' =>
				array(
					'required' => false,
					'type' => 'int',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'TotalNewLeadsCount' =>
				array(
					'required' => false,
					'type' => 'int',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'DocsForCCProcessingToSendCount' =>
				array(
					'required' => false,
					'type' => 'int',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'RTEToProcessCount' =>
				array(
					'required' => false,
					'type' => 'int',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'ItemReceiptToConfirmCount' =>
				array(
					'required' => false,
					'type' => 'int',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'RefundOnHoldCount' =>
				array(
					'required' => false,
					'type' => 'int',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'RefundCancelledCount' =>
				array(
					'required' => false,
					'type' => 'int',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'ShippingDetailsToBeProvidedCount' =>
				array(
					'required' => false,
					'type' => 'int',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'ItemReceiptConfirmationToReceiveCount' =>
				array(
					'required' => false,
					'type' => 'int',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'RefundInitiatedCount' =>
				array(
					'required' => false,
					'type' => 'int',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'PendingRTERequestCount' =>
				array(
					'required' => false,
					'type' => 'int',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'DeclinedRTERequestCount' =>
				array(
					'required' => false,
					'type' => 'int',
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
	 * @return int
	 **/
	function getPaymentToSendCount()
	{
		return $this->PaymentToSendCount;
	}

	/**
	 * @return void
	 **/
	function setPaymentToSendCount($value)
	{
		$this->PaymentToSendCount = $value;
	}

	/**
	 * @return int
	 **/
	function getFeedbackToReceiveCount()
	{
		return $this->FeedbackToReceiveCount;
	}

	/**
	 * @return void
	 **/
	function setFeedbackToReceiveCount($value)
	{
		$this->FeedbackToReceiveCount = $value;
	}

	/**
	 * @return int
	 **/
	function getFeedbackToSendCount()
	{
		return $this->FeedbackToSendCount;
	}

	/**
	 * @return void
	 **/
	function setFeedbackToSendCount($value)
	{
		$this->FeedbackToSendCount = $value;
	}

	/**
	 * @return int
	 **/
	function getOutbidCount()
	{
		return $this->OutbidCount;
	}

	/**
	 * @return void
	 **/
	function setOutbidCount($value)
	{
		$this->OutbidCount = $value;
	}

	/**
	 * @return int
	 **/
	function getPaymentToReceiveCount()
	{
		return $this->PaymentToReceiveCount;
	}

	/**
	 * @return void
	 **/
	function setPaymentToReceiveCount($value)
	{
		$this->PaymentToReceiveCount = $value;
	}

	/**
	 * @return int
	 **/
	function getSecondChanceOfferCount()
	{
		return $this->SecondChanceOfferCount;
	}

	/**
	 * @return void
	 **/
	function setSecondChanceOfferCount($value)
	{
		$this->SecondChanceOfferCount = $value;
	}

	/**
	 * @return int
	 **/
	function getShippingNeededCount()
	{
		return $this->ShippingNeededCount;
	}

	/**
	 * @return void
	 **/
	function setShippingNeededCount($value)
	{
		$this->ShippingNeededCount = $value;
	}

	/**
	 * @return int
	 **/
	function getRelistingNeededCount()
	{
		return $this->RelistingNeededCount;
	}

	/**
	 * @return void
	 **/
	function setRelistingNeededCount($value)
	{
		$this->RelistingNeededCount = $value;
	}

	/**
	 * @return int
	 **/
	function getTotalNewLeadsCount()
	{
		return $this->TotalNewLeadsCount;
	}

	/**
	 * @return void
	 **/
	function setTotalNewLeadsCount($value)
	{
		$this->TotalNewLeadsCount = $value;
	}

	/**
	 * @return int
	 **/
	function getDocsForCCProcessingToSendCount()
	{
		return $this->DocsForCCProcessingToSendCount;
	}

	/**
	 * @return void
	 **/
	function setDocsForCCProcessingToSendCount($value)
	{
		$this->DocsForCCProcessingToSendCount = $value;
	}

	/**
	 * @return int
	 **/
	function getRTEToProcessCount()
	{
		return $this->RTEToProcessCount;
	}

	/**
	 * @return void
	 **/
	function setRTEToProcessCount($value)
	{
		$this->RTEToProcessCount = $value;
	}

	/**
	 * @return int
	 **/
	function getItemReceiptToConfirmCount()
	{
		return $this->ItemReceiptToConfirmCount;
	}

	/**
	 * @return void
	 **/
	function setItemReceiptToConfirmCount($value)
	{
		$this->ItemReceiptToConfirmCount = $value;
	}

	/**
	 * @return int
	 **/
	function getRefundOnHoldCount()
	{
		return $this->RefundOnHoldCount;
	}

	/**
	 * @return void
	 **/
	function setRefundOnHoldCount($value)
	{
		$this->RefundOnHoldCount = $value;
	}

	/**
	 * @return int
	 **/
	function getRefundCancelledCount()
	{
		return $this->RefundCancelledCount;
	}

	/**
	 * @return void
	 **/
	function setRefundCancelledCount($value)
	{
		$this->RefundCancelledCount = $value;
	}

	/**
	 * @return int
	 **/
	function getShippingDetailsToBeProvidedCount()
	{
		return $this->ShippingDetailsToBeProvidedCount;
	}

	/**
	 * @return void
	 **/
	function setShippingDetailsToBeProvidedCount($value)
	{
		$this->ShippingDetailsToBeProvidedCount = $value;
	}

	/**
	 * @return int
	 **/
	function getItemReceiptConfirmationToReceiveCount()
	{
		return $this->ItemReceiptConfirmationToReceiveCount;
	}

	/**
	 * @return void
	 **/
	function setItemReceiptConfirmationToReceiveCount($value)
	{
		$this->ItemReceiptConfirmationToReceiveCount = $value;
	}

	/**
	 * @return int
	 **/
	function getRefundInitiatedCount()
	{
		return $this->RefundInitiatedCount;
	}

	/**
	 * @return void
	 **/
	function setRefundInitiatedCount($value)
	{
		$this->RefundInitiatedCount = $value;
	}

	/**
	 * @return int
	 **/
	function getPendingRTERequestCount()
	{
		return $this->PendingRTERequestCount;
	}

	/**
	 * @return void
	 **/
	function setPendingRTERequestCount($value)
	{
		$this->PendingRTERequestCount = $value;
	}

	/**
	 * @return int
	 **/
	function getDeclinedRTERequestCount()
	{
		return $this->DeclinedRTERequestCount;
	}

	/**
	 * @return void
	 **/
	function setDeclinedRTERequestCount($value)
	{
		$this->DeclinedRTERequestCount = $value;
	}

}
?>
