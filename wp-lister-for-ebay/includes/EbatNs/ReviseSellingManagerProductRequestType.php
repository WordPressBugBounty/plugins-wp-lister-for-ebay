<?php
/* Generated on 14.02.18 14:28 by globalsync
 * $Id: $
 * $Log: $
 */

require_once 'AbstractRequestType.php';
require_once 'SellingManagerProductDetailsType.php';
require_once 'SellingManagerFolderDetailsType.php';
require_once 'SellingManagerProductSpecificsType.php';

/**
  * Revises a Selling Manager Product.
  * <br><br>
  * This call is subject to change without notice; the
  * deprecation process is inapplicable to this call. The user must have a Selling Manager Pro subscription to use this call.
  * 
 **/

class ReviseSellingManagerProductRequestType extends AbstractRequestType
{
	/**
	* @var SellingManagerProductDetailsType
	**/
	protected $SellingManagerProductDetails;

	/**
	* @var SellingManagerFolderDetailsType
	**/
	protected $SellingManagerFolderDetails;

	/**
	* @var string
	**/
	protected $DeletedField;

	/**
	* @var SellingManagerProductSpecificsType
	**/
	protected $SellingManagerProductSpecifics;


	/**
	 * Class Constructor 
	 **/
	function __construct()
	{
		parent::__construct('ReviseSellingManagerProductRequestType', 'urn:ebay:apis:eBLBaseComponents');
		if (!isset(self::$_elements[__CLASS__]))
		{
			self::$_elements[__CLASS__] = array_merge(self::$_elements[get_parent_class(__CLASS__)],
			array(
				'SellingManagerProductDetails' =>
				array(
					'required' => false,
					'type' => 'SellingManagerProductDetailsType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'SellingManagerFolderDetails' =>
				array(
					'required' => false,
					'type' => 'SellingManagerFolderDetailsType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'DeletedField' =>
				array(
					'required' => false,
					'type' => 'string',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => true,
					'cardinality' => '0..*'
				),
				'SellingManagerProductSpecifics' =>
				array(
					'required' => false,
					'type' => 'SellingManagerProductSpecificsType',
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
	 * @return SellingManagerProductDetailsType
	 **/
	function getSellingManagerProductDetails()
	{
		return $this->SellingManagerProductDetails;
	}

	/**
	 * @return void
	 **/
	function setSellingManagerProductDetails($value)
	{
		$this->SellingManagerProductDetails = $value;
	}

	/**
	 * @return SellingManagerFolderDetailsType
	 **/
	function getSellingManagerFolderDetails()
	{
		return $this->SellingManagerFolderDetails;
	}

	/**
	 * @return void
	 **/
	function setSellingManagerFolderDetails($value)
	{
		$this->SellingManagerFolderDetails = $value;
	}

	/**
	 * @return string
	 * @param integer $index 
	 **/
	function getDeletedField($index = null)
	{
		if ($index !== null)
		{
			return $this->DeletedField[$index];
		}
		else
		{
			return $this->DeletedField;
		}
	}

	/**
	 * @return void
	 * @param string $value
	 * @param integer $index 
	 **/
	function setDeletedField($value, $index = null)
	{
		if ($index !== null)
		{
			$this->DeletedField[$index] = $value;
		}
		else
		{
			$this->DeletedField= $value;
		}
	}

	/**
	 * @return void
	 * @param string $value
	 **/
	function addDeletedField($value)
	{
		$this->DeletedField[] = $value;
	}

	/**
	 * @return SellingManagerProductSpecificsType
	 **/
	function getSellingManagerProductSpecifics()
	{
		return $this->SellingManagerProductSpecifics;
	}

	/**
	 * @return void
	 **/
	function setSellingManagerProductSpecifics($value)
	{
		$this->SellingManagerProductSpecifics = $value;
	}

}
?>
