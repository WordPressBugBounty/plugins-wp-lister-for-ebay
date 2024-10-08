<?php
/* Generated on 14.02.18 14:28 by globalsync
 * $Id: $
 * $Log: $
 */

require_once 'AbstractResponseType.php';
require_once 'CategoryFeatureType.php';
require_once 'SiteDefaultsType.php';
require_once 'FeatureDefinitionsType.php';

/**
 **/

class GetCategoryFeaturesResponseType extends AbstractResponseType
{
	/**
	* @var string
	**/
	protected $CategoryVersion;

	/**
	* @var dateTime
	**/
	protected $UpdateTime;

	/**
	* @var CategoryFeatureType
	**/
	protected $Category;

	/**
	* @var SiteDefaultsType
	**/
	protected $SiteDefaults;

	/**
	* @var FeatureDefinitionsType
	**/
	protected $FeatureDefinitions;


	/**
	 * Class Constructor 
	 **/
	function __construct()
	{
		parent::__construct('GetCategoryFeaturesResponseType', 'urn:ebay:apis:eBLBaseComponents');
		if (!isset(self::$_elements[__CLASS__]))
		{
			self::$_elements[__CLASS__] = array_merge(self::$_elements[get_parent_class(__CLASS__)],
			array(
				'CategoryVersion' =>
				array(
					'required' => false,
					'type' => 'string',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'UpdateTime' =>
				array(
					'required' => false,
					'type' => 'dateTime',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'Category' =>
				array(
					'required' => false,
					'type' => 'CategoryFeatureType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => true,
					'cardinality' => '0..*'
				),
				'SiteDefaults' =>
				array(
					'required' => false,
					'type' => 'SiteDefaultsType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'FeatureDefinitions' =>
				array(
					'required' => false,
					'type' => 'FeatureDefinitionsType',
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
	 * @return string
	 **/
	function getCategoryVersion()
	{
		return $this->CategoryVersion;
	}

	/**
	 * @return void
	 **/
	function setCategoryVersion($value)
	{
		$this->CategoryVersion = $value;
	}

	/**
	 * @return dateTime
	 **/
	function getUpdateTime()
	{
		return $this->UpdateTime;
	}

	/**
	 * @return void
	 **/
	function setUpdateTime($value)
	{
		$this->UpdateTime = $value;
	}

	/**
	 * @return CategoryFeatureType
	 * @param integer $index 
	 **/
	function getCategory($index = null)
	{
		if ($index !== null)
		{
			return $this->Category[$index];
		}
		else
		{
			return $this->Category;
		}
	}

	/**
	 * @return void
	 * @param CategoryFeatureType $value
	 * @param integer $index 
	 **/
	function setCategory($value, $index = null)
	{
		if ($index !== null)
		{
			$this->Category[$index] = $value;
		}
		else
		{
			$this->Category= $value;
		}
	}

	/**
	 * @return void
	 * @param CategoryFeatureType $value
	 **/
	function addCategory($value)
	{
		$this->Category[] = $value;
	}

	/**
	 * @return SiteDefaultsType
	 **/
	function getSiteDefaults()
	{
		return $this->SiteDefaults;
	}

	/**
	 * @return void
	 **/
	function setSiteDefaults($value)
	{
		$this->SiteDefaults = $value;
	}

	/**
	 * @return FeatureDefinitionsType
	 **/
	function getFeatureDefinitions()
	{
		return $this->FeatureDefinitions;
	}

	/**
	 * @return void
	 **/
	function setFeatureDefinitions($value)
	{
		$this->FeatureDefinitions = $value;
	}

}
?>
