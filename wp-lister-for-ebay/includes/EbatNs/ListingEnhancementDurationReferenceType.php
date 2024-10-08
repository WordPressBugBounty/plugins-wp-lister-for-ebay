<?php
/* Generated on 14.02.18 14:28 by globalsync
 * $Id: $
 * $Log: $
 */

require_once 'EbatNs_ComplexType.php';

/**
  * Type used by the <b>GalleryFeaturedDurations</b> container that is returned at the <b>SiteDefaults</b> and <b>Category</b> level in a <b>GetCategoryFeatures</b> response. <b>GalleryFeaturedDurations</b> container consists of the supported time durations that a picture gallery can be featured
  * 
 **/

class ListingEnhancementDurationReferenceType extends EbatNs_ComplexType
{
	/**
	* @var token
	**/
	protected $Duration;


	/**
	 * Class Constructor 
	 **/
	function __construct()
	{
		parent::__construct('ListingEnhancementDurationReferenceType', 'urn:ebay:apis:eBLBaseComponents');
		if (!isset(self::$_elements[__CLASS__]))
		{
			self::$_elements[__CLASS__] = array_merge(self::$_elements[get_parent_class(__CLASS__)],
			array(
				'Duration' =>
				array(
					'required' => false,
					'type' => 'token',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => true,
					'cardinality' => '0..*'
				)));
		}
		$this->_attributes = array_merge($this->_attributes,
		array(
));
	}

	/**
	 * @return token
	 * @param integer $index 
	 **/
	function getDuration($index = null)
	{
		if ($index !== null)
		{
			return $this->Duration[$index];
		}
		else
		{
			return $this->Duration;
		}
	}

	/**
	 * @return void
	 * @param token $value
	 * @param integer $index 
	 **/
	function setDuration($value, $index = null)
	{
		if ($index !== null)
		{
			$this->Duration[$index] = $value;
		}
		else
		{
			$this->Duration= $value;
		}
	}

	/**
	 * @return void
	 * @param token $value
	 **/
	function addDuration($value)
	{
		$this->Duration[] = $value;
	}

}
?>
