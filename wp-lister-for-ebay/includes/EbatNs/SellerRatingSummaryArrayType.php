<?php
/* Generated on 14.02.18 14:28 by globalsync
 * $Id: $
 * $Log: $
 */

require_once 'EbatNs_ComplexType.php';
require_once 'AverageRatingSummaryType.php';

/**
  * Type defining the <b>SellerRatingSummaryArray</b> container that is returned 
  * in the <b>GetFeedback</b> response. The <b>SellerRatingSummaryArray</b> 
  * container consists of an array of <b>AverageRatingSummary</b> containers, 
  * which provide details on Detailed Seller Ratings (DSRs), including the type of rating 
  * (Communication, Item As Described, Shipping and Handling Charges, or Shipping Time), the 
  * seller's average rating for that DSR type, the total number of DSR ratings, and the 
  * period in which those ratings were received (the last year or the last 30 days).
  * 
 **/

class SellerRatingSummaryArrayType extends EbatNs_ComplexType
{
	/**
	* @var AverageRatingSummaryType
	**/
	protected $AverageRatingSummary;


	/**
	 * Class Constructor 
	 **/
	function __construct()
	{
		parent::__construct('SellerRatingSummaryArrayType', 'urn:ebay:apis:eBLBaseComponents');
		if (!isset(self::$_elements[__CLASS__]))
		{
			self::$_elements[__CLASS__] = array_merge(self::$_elements[get_parent_class(__CLASS__)],
			array(
				'AverageRatingSummary' =>
				array(
					'required' => false,
					'type' => 'AverageRatingSummaryType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => true,
					'cardinality' => '0..*'
				)));
		}
		$this->_attributes = array_merge($this->_attributes,
		array(
));
	}

	/**
	 * @return AverageRatingSummaryType
	 * @param integer $index 
	 **/
	function getAverageRatingSummary($index = null)
	{
		if ($index !== null)
		{
			return $this->AverageRatingSummary[$index];
		}
		else
		{
			return $this->AverageRatingSummary;
		}
	}

	/**
	 * @return void
	 * @param AverageRatingSummaryType $value
	 * @param integer $index 
	 **/
	function setAverageRatingSummary($value, $index = null)
	{
		if ($index !== null)
		{
			$this->AverageRatingSummary[$index] = $value;
		}
		else
		{
			$this->AverageRatingSummary= $value;
		}
	}

	/**
	 * @return void
	 * @param AverageRatingSummaryType $value
	 **/
	function addAverageRatingSummary($value)
	{
		$this->AverageRatingSummary[] = $value;
	}

}
?>
