<?php
/* Generated on 14.02.18 14:28 by globalsync
 * $Id: $
 * $Log: $
 */

require_once 'EbatNs_ComplexType.php';
require_once 'ProductSuggestionType.php';

/**
  * Provides a list of products recommended by eBay, which match the item information
  * provided by the seller.
  * 
 **/

class ProductSuggestionsType extends EbatNs_ComplexType
{
	/**
	* @var ProductSuggestionType
	**/
	protected $ProductSuggestion;


	/**
	 * Class Constructor 
	 **/
	function __construct()
	{
		parent::__construct('ProductSuggestionsType', 'urn:ebay:apis:eBLBaseComponents');
		if (!isset(self::$_elements[__CLASS__]))
		{
			self::$_elements[__CLASS__] = array_merge(self::$_elements[get_parent_class(__CLASS__)],
			array(
				'ProductSuggestion' =>
				array(
					'required' => false,
					'type' => 'ProductSuggestionType',
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
	 * @return ProductSuggestionType
	 * @param integer $index 
	 **/
	function getProductSuggestion($index = null)
	{
		if ($index !== null)
		{
			return $this->ProductSuggestion[$index];
		}
		else
		{
			return $this->ProductSuggestion;
		}
	}

	/**
	 * @return void
	 * @param ProductSuggestionType $value
	 * @param integer $index 
	 **/
	function setProductSuggestion($value, $index = null)
	{
		if ($index !== null)
		{
			$this->ProductSuggestion[$index] = $value;
		}
		else
		{
			$this->ProductSuggestion= $value;
		}
	}

	/**
	 * @return void
	 * @param ProductSuggestionType $value
	 **/
	function addProductSuggestion($value)
	{
		$this->ProductSuggestion[] = $value;
	}

}
?>
