<?php
/* Generated on 14.02.18 14:28 by globalsync
 * $Id: $
 * $Log: $
 */

require_once 'EbatNs_ComplexType.php';
require_once 'ProductIdentifiersType.php';
require_once 'NameRecommendationType.php';

/**
  * This type is used to provide details about recommended Item Specifics and Product Identifier types.
  * 
 **/

class RecommendationsType extends EbatNs_ComplexType
{
	/**
	* @var string
	**/
	protected $CategoryID;

	/**
	* @var ProductIdentifiersType
	**/
	protected $ProductIdentifiers;

	/**
	* @var NameRecommendationType
	**/
	protected $NameRecommendation;

	/**
	* @var boolean
	**/
	protected $Updated;


	/**
	 * Class Constructor 
	 **/
	function __construct()
	{
		parent::__construct('RecommendationsType', 'urn:ebay:apis:eBLBaseComponents');
		if (!isset(self::$_elements[__CLASS__]))
		{
			self::$_elements[__CLASS__] = array_merge(self::$_elements[get_parent_class(__CLASS__)],
			array(
				'CategoryID' =>
				array(
					'required' => false,
					'type' => 'string',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'ProductIdentifiers' =>
				array(
					'required' => false,
					'type' => 'ProductIdentifiersType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => true,
					'cardinality' => '0..*'
				),
				'NameRecommendation' =>
				array(
					'required' => false,
					'type' => 'NameRecommendationType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => true,
					'cardinality' => '0..*'
				),
				'Updated' =>
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
	 * @return string
	 **/
	function getCategoryID()
	{
		return $this->CategoryID;
	}

	/**
	 * @return void
	 **/
	function setCategoryID($value)
	{
		$this->CategoryID = $value;
	}

	/**
	 * @return ProductIdentifiersType
	 * @param integer $index 
	 **/
	function getProductIdentifiers($index = null)
	{
		if ($index !== null)
		{
			return $this->ProductIdentifiers[$index];
		}
		else
		{
			return $this->ProductIdentifiers;
		}
	}

	/**
	 * @return void
	 * @param ProductIdentifiersType $value
	 * @param integer $index 
	 **/
	function setProductIdentifiers($value, $index = null)
	{
		if ($index !== null)
		{
			$this->ProductIdentifiers[$index] = $value;
		}
		else
		{
			$this->ProductIdentifiers= $value;
		}
	}

	/**
	 * @return void
	 * @param ProductIdentifiersType $value
	 **/
	function addProductIdentifiers($value)
	{
		$this->ProductIdentifiers[] = $value;
	}

	/**
	 * @return NameRecommendationType
	 * @param integer $index 
	 **/
	function getNameRecommendation($index = null)
	{
		if ($index !== null)
		{
			return $this->NameRecommendation[$index];
		}
		else
		{
			return $this->NameRecommendation;
		}
	}

	/**
	 * @return void
	 * @param NameRecommendationType $value
	 * @param integer $index 
	 **/
	function setNameRecommendation($value, $index = null)
	{
		if ($index !== null)
		{
			$this->NameRecommendation[$index] = $value;
		}
		else
		{
			$this->NameRecommendation= $value;
		}
	}

	/**
	 * @return void
	 * @param NameRecommendationType $value
	 **/
	function addNameRecommendation($value)
	{
		$this->NameRecommendation[] = $value;
	}

	/**
	 * @return boolean
	 **/
	function getUpdated()
	{
		return $this->Updated;
	}

	/**
	 * @return void
	 **/
	function setUpdated($value)
	{
		$this->Updated = $value;
	}

}
?>
