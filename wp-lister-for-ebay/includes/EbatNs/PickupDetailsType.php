<?php
/* Generated on 14.02.18 14:28 by globalsync
 * $Id: $
 * $Log: $
 */

require_once 'EbatNs_ComplexType.php';
require_once 'PickupOptionsType.php';

/**
  *               This type defines the <strong>PickupDetails</strong> container, which contains an array of <strong>PickupOptions</strong> containers. Each <strong>PickupOptions</strong> container consists of the pickup method and its priority.
  *               <br/><br/>
  * <span class="tablenote">
  * <strong>Note:</strong> At this time, the In-Store Pickup and Click and Collect features are generally only available to large retail merchants, and can only be applied to multi-quantity, fixed-price listings. In-Store Pickup is only applicable to the US site, and Click and Collect is only applicable to the UK, Germany, and Australia sites.
  * </span>
  *             
 **/

class PickupDetailsType extends EbatNs_ComplexType
{
	/**
	* @var PickupOptionsType
	**/
	protected $PickupOptions;


	/**
	 * Class Constructor 
	 **/
	function __construct()
	{
		parent::__construct('PickupDetailsType', 'urn:ebay:apis:eBLBaseComponents');
		if (!isset(self::$_elements[__CLASS__]))
		{
			self::$_elements[__CLASS__] = array_merge(self::$_elements[get_parent_class(__CLASS__)],
			array(
				'PickupOptions' =>
				array(
					'required' => false,
					'type' => 'PickupOptionsType',
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
	 * @return PickupOptionsType
	 * @param integer $index 
	 **/
	function getPickupOptions($index = null)
	{
		if ($index !== null)
		{
			return $this->PickupOptions[$index];
		}
		else
		{
			return $this->PickupOptions;
		}
	}

	/**
	 * @return void
	 * @param PickupOptionsType $value
	 * @param integer $index 
	 **/
	function setPickupOptions($value, $index = null)
	{
		if ($index !== null)
		{
			$this->PickupOptions[$index] = $value;
		}
		else
		{
			$this->PickupOptions= $value;
		}
	}

	/**
	 * @return void
	 * @param PickupOptionsType $value
	 **/
	function addPickupOptions($value)
	{
		$this->PickupOptions[] = $value;
	}

}
?>
