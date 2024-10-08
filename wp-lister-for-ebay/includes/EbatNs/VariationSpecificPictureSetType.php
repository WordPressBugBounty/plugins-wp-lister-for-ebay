<?php
/* Generated on 14.02.18 14:28 by globalsync
 * $Id: $
 * $Log: $
 */

require_once 'EbatNs_ComplexType.php';
require_once 'ExtendedPictureDetailsType.php';

/**
  *  Type defining the <b>VariationSpecificPictureSet</b> container, which is
  *  used to specify the URL(s) where the picture(s) of the variation specific will be
  *  hosted. If the <b>Variations.Pictures</b> container is used, at least one
  *  <b>VariationSpecificPictureSet</b> container is required.
  * 
 **/

class VariationSpecificPictureSetType extends EbatNs_ComplexType
{
	/**
	* @var string
	**/
	protected $VariationSpecificValue;

	/**
	* @var anyURI
	**/
	protected $PictureURL;

	/**
	* @var anyURI
	**/
	protected $GalleryURL;

	/**
	* @var anyURI
	**/
	protected $ExternalPictureURL;

	/**
	* @var ExtendedPictureDetailsType
	**/
	protected $ExtendedPictureDetails;


	/**
	 * Class Constructor 
	 **/
	function __construct()
	{
		parent::__construct('VariationSpecificPictureSetType', 'urn:ebay:apis:eBLBaseComponents');
		if (!isset(self::$_elements[__CLASS__]))
		{
			self::$_elements[__CLASS__] = array_merge(self::$_elements[get_parent_class(__CLASS__)],
			array(
				'VariationSpecificValue' =>
				array(
					'required' => false,
					'type' => 'string',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'PictureURL' =>
				array(
					'required' => false,
					'type' => 'anyURI',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => true,
					'cardinality' => '0..*'
				),
				'GalleryURL' =>
				array(
					'required' => false,
					'type' => 'anyURI',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'ExternalPictureURL' =>
				array(
					'required' => false,
					'type' => 'anyURI',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => true,
					'cardinality' => '0..*'
				),
				'ExtendedPictureDetails' =>
				array(
					'required' => false,
					'type' => 'ExtendedPictureDetailsType',
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
	function getVariationSpecificValue()
	{
		return $this->VariationSpecificValue;
	}

	/**
	 * @return void
	 **/
	function setVariationSpecificValue($value)
	{
		$this->VariationSpecificValue = $value;
	}

	/**
	 * @return anyURI
	 * @param integer $index 
	 **/
	function getPictureURL($index = null)
	{
		if ($index !== null)
		{
			return $this->PictureURL[$index];
		}
		else
		{
			return $this->PictureURL;
		}
	}

	/**
	 * @return void
	 * @param anyURI $value
	 * @param integer $index 
	 **/
	function setPictureURL($value, $index = null)
	{
		if ($index !== null)
		{
			$this->PictureURL[$index] = $value;
		}
		else
		{
			$this->PictureURL= $value;
		}
	}

	/**
	 * @return void
	 * @param anyURI $value
	 **/
	function addPictureURL($value)
	{
		$this->PictureURL[] = $value;
	}

	/**
	 * @return anyURI
	 **/
	function getGalleryURL()
	{
		return $this->GalleryURL;
	}

	/**
	 * @return void
	 **/
	function setGalleryURL($value)
	{
		$this->GalleryURL = $value;
	}

	/**
	 * @return anyURI
	 * @param integer $index 
	 **/
	function getExternalPictureURL($index = null)
	{
		if ($index !== null)
		{
			return $this->ExternalPictureURL[$index];
		}
		else
		{
			return $this->ExternalPictureURL;
		}
	}

	/**
	 * @return void
	 * @param anyURI $value
	 * @param integer $index 
	 **/
	function setExternalPictureURL($value, $index = null)
	{
		if ($index !== null)
		{
			$this->ExternalPictureURL[$index] = $value;
		}
		else
		{
			$this->ExternalPictureURL= $value;
		}
	}

	/**
	 * @return void
	 * @param anyURI $value
	 **/
	function addExternalPictureURL($value)
	{
		$this->ExternalPictureURL[] = $value;
	}

	/**
	 * @return ExtendedPictureDetailsType
	 **/
	function getExtendedPictureDetails()
	{
		return $this->ExtendedPictureDetails;
	}

	/**
	 * @return void
	 **/
	function setExtendedPictureDetails($value)
	{
		$this->ExtendedPictureDetails = $value;
	}

}
?>
