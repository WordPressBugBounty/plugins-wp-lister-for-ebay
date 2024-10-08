<?php
/* Generated on 14.02.18 14:28 by globalsync
 * $Id: $
 * $Log: $
 */

require_once 'EbatNs_ComplexType.php';
require_once 'CheckoutStatusCodeType.php';
require_once 'SellingManagerPaidStatusCodeType.php';
require_once 'SellingManagerShippedStatusCodeType.php';
require_once 'PaymentStatusCodeType.php';
require_once 'BuyerPaymentMethodCodeType.php';
require_once 'CommentTypeCodeType.php';
require_once 'PaymentHoldStatusCodeType.php';

/**
  * This type contains details on the status of an order.
  * 
 **/

class SellingManagerOrderStatusType extends EbatNs_ComplexType
{
	/**
	* @var CheckoutStatusCodeType
	**/
	protected $CheckoutStatus;

	/**
	* @var SellingManagerPaidStatusCodeType
	**/
	protected $PaidStatus;

	/**
	* @var SellingManagerShippedStatusCodeType
	**/
	protected $ShippedStatus;

	/**
	* @var PaymentStatusCodeType
	**/
	protected $eBayPaymentStatus;

	/**
	* @var string
	**/
	protected $PayPalTransactionID;

	/**
	* @var BuyerPaymentMethodCodeType
	**/
	protected $PaymentMethodUsed;

	/**
	* @var CommentTypeCodeType
	**/
	protected $FeedbackReceived;

	/**
	* @var boolean
	**/
	protected $FeedbackSent;

	/**
	* @var int
	**/
	protected $TotalEmailsSent;

	/**
	* @var PaymentHoldStatusCodeType
	**/
	protected $PaymentHoldStatus;

	/**
	* @var string
	**/
	protected $SellerInvoiceNumber;

	/**
	* @var dateTime
	**/
	protected $ShippedTime;

	/**
	* @var dateTime
	**/
	protected $PaidTime;

	/**
	* @var dateTime
	**/
	protected $LastEmailSentTime;

	/**
	* @var dateTime
	**/
	protected $SellerInvoiceTime;

	/**
	* @var boolean
	**/
	protected $IntegratedMerchantCreditCardEnabled;


	/**
	 * Class Constructor 
	 **/
	function __construct()
	{
		parent::__construct('SellingManagerOrderStatusType', 'urn:ebay:apis:eBLBaseComponents');
		if (!isset(self::$_elements[__CLASS__]))
		{
			self::$_elements[__CLASS__] = array_merge(self::$_elements[get_parent_class(__CLASS__)],
			array(
				'CheckoutStatus' =>
				array(
					'required' => false,
					'type' => 'CheckoutStatusCodeType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'PaidStatus' =>
				array(
					'required' => false,
					'type' => 'SellingManagerPaidStatusCodeType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'ShippedStatus' =>
				array(
					'required' => false,
					'type' => 'SellingManagerShippedStatusCodeType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'eBayPaymentStatus' =>
				array(
					'required' => false,
					'type' => 'PaymentStatusCodeType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'PayPalTransactionID' =>
				array(
					'required' => false,
					'type' => 'string',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'PaymentMethodUsed' =>
				array(
					'required' => false,
					'type' => 'BuyerPaymentMethodCodeType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'FeedbackReceived' =>
				array(
					'required' => false,
					'type' => 'CommentTypeCodeType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'FeedbackSent' =>
				array(
					'required' => false,
					'type' => 'boolean',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'TotalEmailsSent' =>
				array(
					'required' => false,
					'type' => 'int',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'PaymentHoldStatus' =>
				array(
					'required' => false,
					'type' => 'PaymentHoldStatusCodeType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'SellerInvoiceNumber' =>
				array(
					'required' => false,
					'type' => 'string',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'ShippedTime' =>
				array(
					'required' => false,
					'type' => 'dateTime',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'PaidTime' =>
				array(
					'required' => false,
					'type' => 'dateTime',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'LastEmailSentTime' =>
				array(
					'required' => false,
					'type' => 'dateTime',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'SellerInvoiceTime' =>
				array(
					'required' => false,
					'type' => 'dateTime',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'IntegratedMerchantCreditCardEnabled' =>
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
	 * @return CheckoutStatusCodeType
	 **/
	function getCheckoutStatus()
	{
		return $this->CheckoutStatus;
	}

	/**
	 * @return void
	 **/
	function setCheckoutStatus($value)
	{
		$this->CheckoutStatus = $value;
	}

	/**
	 * @return SellingManagerPaidStatusCodeType
	 **/
	function getPaidStatus()
	{
		return $this->PaidStatus;
	}

	/**
	 * @return void
	 **/
	function setPaidStatus($value)
	{
		$this->PaidStatus = $value;
	}

	/**
	 * @return SellingManagerShippedStatusCodeType
	 **/
	function getShippedStatus()
	{
		return $this->ShippedStatus;
	}

	/**
	 * @return void
	 **/
	function setShippedStatus($value)
	{
		$this->ShippedStatus = $value;
	}

	/**
	 * @return PaymentStatusCodeType
	 **/
	function geteBayPaymentStatus()
	{
		return $this->eBayPaymentStatus;
	}

	/**
	 * @return void
	 **/
	function seteBayPaymentStatus($value)
	{
		$this->eBayPaymentStatus = $value;
	}

	/**
	 * @return string
	 **/
	function getPayPalTransactionID()
	{
		return $this->PayPalTransactionID;
	}

	/**
	 * @return void
	 **/
	function setPayPalTransactionID($value)
	{
		$this->PayPalTransactionID = $value;
	}

	/**
	 * @return BuyerPaymentMethodCodeType
	 **/
	function getPaymentMethodUsed()
	{
		return $this->PaymentMethodUsed;
	}

	/**
	 * @return void
	 **/
	function setPaymentMethodUsed($value)
	{
		$this->PaymentMethodUsed = $value;
	}

	/**
	 * @return CommentTypeCodeType
	 **/
	function getFeedbackReceived()
	{
		return $this->FeedbackReceived;
	}

	/**
	 * @return void
	 **/
	function setFeedbackReceived($value)
	{
		$this->FeedbackReceived = $value;
	}

	/**
	 * @return boolean
	 **/
	function getFeedbackSent()
	{
		return $this->FeedbackSent;
	}

	/**
	 * @return void
	 **/
	function setFeedbackSent($value)
	{
		$this->FeedbackSent = $value;
	}

	/**
	 * @return int
	 **/
	function getTotalEmailsSent()
	{
		return $this->TotalEmailsSent;
	}

	/**
	 * @return void
	 **/
	function setTotalEmailsSent($value)
	{
		$this->TotalEmailsSent = $value;
	}

	/**
	 * @return PaymentHoldStatusCodeType
	 **/
	function getPaymentHoldStatus()
	{
		return $this->PaymentHoldStatus;
	}

	/**
	 * @return void
	 **/
	function setPaymentHoldStatus($value)
	{
		$this->PaymentHoldStatus = $value;
	}

	/**
	 * @return string
	 **/
	function getSellerInvoiceNumber()
	{
		return $this->SellerInvoiceNumber;
	}

	/**
	 * @return void
	 **/
	function setSellerInvoiceNumber($value)
	{
		$this->SellerInvoiceNumber = $value;
	}

	/**
	 * @return dateTime
	 **/
	function getShippedTime()
	{
		return $this->ShippedTime;
	}

	/**
	 * @return void
	 **/
	function setShippedTime($value)
	{
		$this->ShippedTime = $value;
	}

	/**
	 * @return dateTime
	 **/
	function getPaidTime()
	{
		return $this->PaidTime;
	}

	/**
	 * @return void
	 **/
	function setPaidTime($value)
	{
		$this->PaidTime = $value;
	}

	/**
	 * @return dateTime
	 **/
	function getLastEmailSentTime()
	{
		return $this->LastEmailSentTime;
	}

	/**
	 * @return void
	 **/
	function setLastEmailSentTime($value)
	{
		$this->LastEmailSentTime = $value;
	}

	/**
	 * @return dateTime
	 **/
	function getSellerInvoiceTime()
	{
		return $this->SellerInvoiceTime;
	}

	/**
	 * @return void
	 **/
	function setSellerInvoiceTime($value)
	{
		$this->SellerInvoiceTime = $value;
	}

	/**
	 * @return boolean
	 **/
	function getIntegratedMerchantCreditCardEnabled()
	{
		return $this->IntegratedMerchantCreditCardEnabled;
	}

	/**
	 * @return void
	 **/
	function setIntegratedMerchantCreditCardEnabled($value)
	{
		$this->IntegratedMerchantCreditCardEnabled = $value;
	}

}
?>
