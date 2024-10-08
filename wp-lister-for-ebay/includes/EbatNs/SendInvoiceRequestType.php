<?php
/* Generated on 14.02.18 14:28 by globalsync
 * $Id: $
 * $Log: $
 */

require_once 'AbstractRequestType.php';
require_once 'ItemIDType.php';
require_once 'OrderIDType.php';
require_once 'InternationalShippingServiceOptionsType.php';
require_once 'ShippingServiceOptionsType.php';
require_once 'SalesTaxType.php';
require_once 'InsuranceOptionCodeType.php';
require_once 'AmountType.php';
require_once 'BuyerPaymentMethodCodeType.php';
require_once 'SKUType.php';

/**
  * Enables a seller to send an order invoice to a buyer. Where applicable, updates
  * to shipping, payment methods, and sales tax made in this request are applied to
  * the specified order as a whole and to the individual order line items whose data
  * are stored in individual <b>Transaction</b> objects.
  * 
 **/

class SendInvoiceRequestType extends AbstractRequestType
{
	/**
	* @var ItemIDType
	**/
	protected $ItemID;

	/**
	* @var string
	**/
	protected $TransactionID;

	/**
	* @var OrderIDType
	**/
	protected $OrderID;

	/**
	* @var InternationalShippingServiceOptionsType
	**/
	protected $InternationalShippingServiceOptions;

	/**
	* @var ShippingServiceOptionsType
	**/
	protected $ShippingServiceOptions;

	/**
	* @var SalesTaxType
	**/
	protected $SalesTax;

	/**
	* @var InsuranceOptionCodeType
	**/
	protected $InsuranceOption;

	/**
	* @var AmountType
	**/
	protected $InsuranceFee;

	/**
	* @var BuyerPaymentMethodCodeType
	**/
	protected $PaymentMethods;

	/**
	* @var string
	**/
	protected $PayPalEmailAddress;

	/**
	* @var string
	**/
	protected $CheckoutInstructions;

	/**
	* @var boolean
	**/
	protected $EmailCopyToSeller;

	/**
	* @var AmountType
	**/
	protected $CODCost;

	/**
	* @var SKUType
	**/
	protected $SKU;

	/**
	* @var string
	**/
	protected $OrderLineItemID;

	/**
	* @var AmountType
	**/
	protected $AdjustmentAmount;


	/**
	 * Class Constructor 
	 **/
	function __construct()
	{
		parent::__construct('SendInvoiceRequestType', 'urn:ebay:apis:eBLBaseComponents');
		if (!isset(self::$_elements[__CLASS__]))
		{
			self::$_elements[__CLASS__] = array_merge(self::$_elements[get_parent_class(__CLASS__)],
			array(
				'ItemID' =>
				array(
					'required' => false,
					'type' => 'ItemIDType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'TransactionID' =>
				array(
					'required' => false,
					'type' => 'string',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'OrderID' =>
				array(
					'required' => false,
					'type' => 'OrderIDType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'InternationalShippingServiceOptions' =>
				array(
					'required' => false,
					'type' => 'InternationalShippingServiceOptionsType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => true,
					'cardinality' => '0..*'
				),
				'ShippingServiceOptions' =>
				array(
					'required' => false,
					'type' => 'ShippingServiceOptionsType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => true,
					'cardinality' => '0..*'
				),
				'SalesTax' =>
				array(
					'required' => false,
					'type' => 'SalesTaxType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'InsuranceOption' =>
				array(
					'required' => false,
					'type' => 'InsuranceOptionCodeType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'InsuranceFee' =>
				array(
					'required' => false,
					'type' => 'AmountType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'PaymentMethods' =>
				array(
					'required' => false,
					'type' => 'BuyerPaymentMethodCodeType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => true,
					'cardinality' => '0..*'
				),
				'PayPalEmailAddress' =>
				array(
					'required' => false,
					'type' => 'string',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'CheckoutInstructions' =>
				array(
					'required' => false,
					'type' => 'string',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'EmailCopyToSeller' =>
				array(
					'required' => false,
					'type' => 'boolean',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'CODCost' =>
				array(
					'required' => false,
					'type' => 'AmountType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'SKU' =>
				array(
					'required' => false,
					'type' => 'SKUType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'OrderLineItemID' =>
				array(
					'required' => false,
					'type' => 'string',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'AdjustmentAmount' =>
				array(
					'required' => false,
					'type' => 'AmountType',
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
	 * @return ItemIDType
	 **/
	function getItemID()
	{
		return $this->ItemID;
	}

	/**
	 * @return void
	 **/
	function setItemID($value)
	{
		$this->ItemID = $value;
	}

	/**
	 * @return string
	 **/
	function getTransactionID()
	{
		return $this->TransactionID;
	}

	/**
	 * @return void
	 **/
	function setTransactionID($value)
	{
		$this->TransactionID = $value;
	}

	/**
	 * @return OrderIDType
	 **/
	function getOrderID()
	{
		return $this->OrderID;
	}

	/**
	 * @return void
	 **/
	function setOrderID($value)
	{
		$this->OrderID = $value;
	}

	/**
	 * @return InternationalShippingServiceOptionsType
	 * @param integer $index 
	 **/
	function getInternationalShippingServiceOptions($index = null)
	{
		if ($index !== null)
		{
			return $this->InternationalShippingServiceOptions[$index];
		}
		else
		{
			return $this->InternationalShippingServiceOptions;
		}
	}

	/**
	 * @return void
	 * @param InternationalShippingServiceOptionsType $value
	 * @param integer $index 
	 **/
	function setInternationalShippingServiceOptions($value, $index = null)
	{
		if ($index !== null)
		{
			$this->InternationalShippingServiceOptions[$index] = $value;
		}
		else
		{
			$this->InternationalShippingServiceOptions= $value;
		}
	}

	/**
	 * @return void
	 * @param InternationalShippingServiceOptionsType $value
	 **/
	function addInternationalShippingServiceOptions($value)
	{
		$this->InternationalShippingServiceOptions[] = $value;
	}

	/**
	 * @return ShippingServiceOptionsType
	 * @param integer $index 
	 **/
	function getShippingServiceOptions($index = null)
	{
		if ($index !== null)
		{
			return $this->ShippingServiceOptions[$index];
		}
		else
		{
			return $this->ShippingServiceOptions;
		}
	}

	/**
	 * @return void
	 * @param ShippingServiceOptionsType $value
	 * @param integer $index 
	 **/
	function setShippingServiceOptions($value, $index = null)
	{
		if ($index !== null)
		{
			$this->ShippingServiceOptions[$index] = $value;
		}
		else
		{
			$this->ShippingServiceOptions= $value;
		}
	}

	/**
	 * @return void
	 * @param ShippingServiceOptionsType $value
	 **/
	function addShippingServiceOptions($value)
	{
		$this->ShippingServiceOptions[] = $value;
	}

	/**
	 * @return SalesTaxType
	 **/
	function getSalesTax()
	{
		return $this->SalesTax;
	}

	/**
	 * @return void
	 **/
	function setSalesTax($value)
	{
		$this->SalesTax = $value;
	}

	/**
	 * @return InsuranceOptionCodeType
	 **/
	function getInsuranceOption()
	{
		return $this->InsuranceOption;
	}

	/**
	 * @return void
	 **/
	function setInsuranceOption($value)
	{
		$this->InsuranceOption = $value;
	}

	/**
	 * @return AmountType
	 **/
	function getInsuranceFee()
	{
		return $this->InsuranceFee;
	}

	/**
	 * @return void
	 **/
	function setInsuranceFee($value)
	{
		$this->InsuranceFee = $value;
	}

	/**
	 * @return BuyerPaymentMethodCodeType
	 * @param integer $index 
	 **/
	function getPaymentMethods($index = null)
	{
		if ($index !== null)
		{
			return $this->PaymentMethods[$index];
		}
		else
		{
			return $this->PaymentMethods;
		}
	}

	/**
	 * @return void
	 * @param BuyerPaymentMethodCodeType $value
	 * @param integer $index 
	 **/
	function setPaymentMethods($value, $index = null)
	{
		if ($index !== null)
		{
			$this->PaymentMethods[$index] = $value;
		}
		else
		{
			$this->PaymentMethods= $value;
		}
	}

	/**
	 * @return void
	 * @param BuyerPaymentMethodCodeType $value
	 **/
	function addPaymentMethods($value)
	{
		$this->PaymentMethods[] = $value;
	}

	/**
	 * @return string
	 **/
	function getPayPalEmailAddress()
	{
		return $this->PayPalEmailAddress;
	}

	/**
	 * @return void
	 **/
	function setPayPalEmailAddress($value)
	{
		$this->PayPalEmailAddress = $value;
	}

	/**
	 * @return string
	 **/
	function getCheckoutInstructions()
	{
		return $this->CheckoutInstructions;
	}

	/**
	 * @return void
	 **/
	function setCheckoutInstructions($value)
	{
		$this->CheckoutInstructions = $value;
	}

	/**
	 * @return boolean
	 **/
	function getEmailCopyToSeller()
	{
		return $this->EmailCopyToSeller;
	}

	/**
	 * @return void
	 **/
	function setEmailCopyToSeller($value)
	{
		$this->EmailCopyToSeller = $value;
	}

	/**
	 * @return AmountType
	 **/
	function getCODCost()
	{
		return $this->CODCost;
	}

	/**
	 * @return void
	 **/
	function setCODCost($value)
	{
		$this->CODCost = $value;
	}

	/**
	 * @return SKUType
	 **/
	function getSKU()
	{
		return $this->SKU;
	}

	/**
	 * @return void
	 **/
	function setSKU($value)
	{
		$this->SKU = $value;
	}

	/**
	 * @return string
	 **/
	function getOrderLineItemID()
	{
		return $this->OrderLineItemID;
	}

	/**
	 * @return void
	 **/
	function setOrderLineItemID($value)
	{
		$this->OrderLineItemID = $value;
	}

	/**
	 * @return AmountType
	 **/
	function getAdjustmentAmount()
	{
		return $this->AdjustmentAmount;
	}

	/**
	 * @return void
	 **/
	function setAdjustmentAmount($value)
	{
		$this->AdjustmentAmount = $value;
	}

}
?>
