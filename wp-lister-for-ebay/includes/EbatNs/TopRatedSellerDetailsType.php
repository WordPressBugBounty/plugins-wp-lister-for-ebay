<?php
/* Generated on 14.02.18 14:28 by globalsync
 * $Id: $
 * $Log: $
 */

require_once 'EbatNs_ComplexType.php';
require_once 'TopRatedProgramCodeType.php';

/**
  * Container for Top-Rated Seller program information.
  * 
 **/

class TopRatedSellerDetailsType extends EbatNs_ComplexType
{
	/**
	* @var TopRatedProgramCodeType
	**/
	protected $TopRatedProgram;


	/**
	 * Class Constructor 
	 **/
	function __construct()
	{
		parent::__construct('TopRatedSellerDetailsType', 'urn:ebay:apis:eBLBaseComponents');
		if (!isset(self::$_elements[__CLASS__]))
		{
			self::$_elements[__CLASS__] = array_merge(self::$_elements[get_parent_class(__CLASS__)],
			array(
				'TopRatedProgram' =>
				array(
					'required' => false,
					'type' => 'TopRatedProgramCodeType',
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
	 * @return TopRatedProgramCodeType
	 * @param integer $index 
	 **/
	function getTopRatedProgram($index = null)
	{
		if ($index !== null)
		{
			return $this->TopRatedProgram[$index];
		}
		else
		{
			return $this->TopRatedProgram;
		}
	}

	/**
	 * @return void
	 * @param TopRatedProgramCodeType $value
	 * @param integer $index 
	 **/
	function setTopRatedProgram($value, $index = null)
	{
		if ($index !== null)
		{
			$this->TopRatedProgram[$index] = $value;
		}
		else
		{
			$this->TopRatedProgram= $value;
		}
	}

	/**
	 * @return void
	 * @param TopRatedProgramCodeType $value
	 **/
	function addTopRatedProgram($value)
	{
		$this->TopRatedProgram[] = $value;
	}

}
?>
