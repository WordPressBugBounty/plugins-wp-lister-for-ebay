<?php
/* Generated on 14.02.18 14:28 by globalsync
 * $Id: $
 * $Log: $
 */

require_once 'EbatNs_ComplexType.php';
require_once 'StoreFontFaceCodeType.php';
require_once 'StoreFontSizeCodeType.php';

/**
  *   Store font set.
  *   
 **/

class StoreFontType extends EbatNs_ComplexType
{
	/**
	* @var StoreFontFaceCodeType
	**/
	protected $NameFace;

	/**
	* @var StoreFontSizeCodeType
	**/
	protected $NameSize;

	/**
	* @var string
	**/
	protected $NameColor;

	/**
	* @var StoreFontFaceCodeType
	**/
	protected $TitleFace;

	/**
	* @var StoreFontSizeCodeType
	**/
	protected $TitleSize;

	/**
	* @var string
	**/
	protected $TitleColor;

	/**
	* @var StoreFontFaceCodeType
	**/
	protected $DescFace;

	/**
	* @var StoreFontSizeCodeType
	**/
	protected $DescSize;

	/**
	* @var string
	**/
	protected $DescColor;


	/**
	 * Class Constructor 
	 **/
	function __construct()
	{
		parent::__construct('StoreFontType', 'urn:ebay:apis:eBLBaseComponents');
		if (!isset(self::$_elements[__CLASS__]))
		{
			self::$_elements[__CLASS__] = array_merge(self::$_elements[get_parent_class(__CLASS__)],
			array(
				'NameFace' =>
				array(
					'required' => false,
					'type' => 'StoreFontFaceCodeType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'NameSize' =>
				array(
					'required' => false,
					'type' => 'StoreFontSizeCodeType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'NameColor' =>
				array(
					'required' => false,
					'type' => 'string',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'TitleFace' =>
				array(
					'required' => false,
					'type' => 'StoreFontFaceCodeType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'TitleSize' =>
				array(
					'required' => false,
					'type' => 'StoreFontSizeCodeType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'TitleColor' =>
				array(
					'required' => false,
					'type' => 'string',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'DescFace' =>
				array(
					'required' => false,
					'type' => 'StoreFontFaceCodeType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'DescSize' =>
				array(
					'required' => false,
					'type' => 'StoreFontSizeCodeType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'DescColor' =>
				array(
					'required' => false,
					'type' => 'string',
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
	 * @return StoreFontFaceCodeType
	 **/
	function getNameFace()
	{
		return $this->NameFace;
	}

	/**
	 * @return void
	 **/
	function setNameFace($value)
	{
		$this->NameFace = $value;
	}

	/**
	 * @return StoreFontSizeCodeType
	 **/
	function getNameSize()
	{
		return $this->NameSize;
	}

	/**
	 * @return void
	 **/
	function setNameSize($value)
	{
		$this->NameSize = $value;
	}

	/**
	 * @return string
	 **/
	function getNameColor()
	{
		return $this->NameColor;
	}

	/**
	 * @return void
	 **/
	function setNameColor($value)
	{
		$this->NameColor = $value;
	}

	/**
	 * @return StoreFontFaceCodeType
	 **/
	function getTitleFace()
	{
		return $this->TitleFace;
	}

	/**
	 * @return void
	 **/
	function setTitleFace($value)
	{
		$this->TitleFace = $value;
	}

	/**
	 * @return StoreFontSizeCodeType
	 **/
	function getTitleSize()
	{
		return $this->TitleSize;
	}

	/**
	 * @return void
	 **/
	function setTitleSize($value)
	{
		$this->TitleSize = $value;
	}

	/**
	 * @return string
	 **/
	function getTitleColor()
	{
		return $this->TitleColor;
	}

	/**
	 * @return void
	 **/
	function setTitleColor($value)
	{
		$this->TitleColor = $value;
	}

	/**
	 * @return StoreFontFaceCodeType
	 **/
	function getDescFace()
	{
		return $this->DescFace;
	}

	/**
	 * @return void
	 **/
	function setDescFace($value)
	{
		$this->DescFace = $value;
	}

	/**
	 * @return StoreFontSizeCodeType
	 **/
	function getDescSize()
	{
		return $this->DescSize;
	}

	/**
	 * @return void
	 **/
	function setDescSize($value)
	{
		$this->DescSize = $value;
	}

	/**
	 * @return string
	 **/
	function getDescColor()
	{
		return $this->DescColor;
	}

	/**
	 * @return void
	 **/
	function setDescColor($value)
	{
		$this->DescColor = $value;
	}

}
?>
