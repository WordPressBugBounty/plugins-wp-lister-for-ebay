<?php
/* Generated on 14.02.18 14:28 by globalsync
 * $Id: $
 * $Log: $
 */

require_once 'AbstractRequestType.php';
require_once 'DisputeIDType.php';
require_once 'DisputeResolutionReasonCodeType.php';

/**
  * Enables a seller to "reverse" an Unpaid Item dispute that has been closed in case the buyer and seller are able to reach a mutual agreement. If this action is successful, the seller receives a Final Value Fee
  * credit and the buyer's Unpaid Item strike are both reversed, if applicable.
  * The dispute might have resulted
  * in a strike to the buyer and a Final Value Fee credit to the seller. A buyer and
  * seller sometimes come to agreement after a dispute has been closed. In particular,
  * the seller might discover that the buyer actually paid, or the buyer might agree
  * to pay the seller's fees in exchange for having the strike removed.
  * <br><br>
  * A dispute can only be reversed if it was closed with <b>DisputeActivity</b> set to
  * <b>SellerEndCommunication</b>, <b>CameToAgreementNeedFVFCredit</b>, or
  * <b>MutualAgreementOrNoBuyerResponse</b>.
  * 
 **/

class SellerReverseDisputeRequestType extends AbstractRequestType
{
	/**
	* @var DisputeIDType
	**/
	protected $DisputeID;

	/**
	* @var DisputeResolutionReasonCodeType
	**/
	protected $DisputeResolutionReason;


	/**
	 * Class Constructor 
	 **/
	function __construct()
	{
		parent::__construct('SellerReverseDisputeRequestType', 'urn:ebay:apis:eBLBaseComponents');
		if (!isset(self::$_elements[__CLASS__]))
		{
			self::$_elements[__CLASS__] = array_merge(self::$_elements[get_parent_class(__CLASS__)],
			array(
				'DisputeID' =>
				array(
					'required' => false,
					'type' => 'DisputeIDType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'DisputeResolutionReason' =>
				array(
					'required' => false,
					'type' => 'DisputeResolutionReasonCodeType',
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
	 * @return DisputeIDType
	 **/
	function getDisputeID()
	{
		return $this->DisputeID;
	}

	/**
	 * @return void
	 **/
	function setDisputeID($value)
	{
		$this->DisputeID = $value;
	}

	/**
	 * @return DisputeResolutionReasonCodeType
	 **/
	function getDisputeResolutionReason()
	{
		return $this->DisputeResolutionReason;
	}

	/**
	 * @return void
	 **/
	function setDisputeResolutionReason($value)
	{
		$this->DisputeResolutionReason = $value;
	}

}
?>
