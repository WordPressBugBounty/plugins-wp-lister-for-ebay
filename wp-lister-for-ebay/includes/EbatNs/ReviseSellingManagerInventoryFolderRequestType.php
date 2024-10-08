<?php
/* Generated on 14.02.18 14:28 by globalsync
 * $Id: $
 * $Log: $
 */

require_once 'AbstractRequestType.php';
require_once 'SellingManagerFolderDetailsType.php';

/**
  *   This call is uses to rename and/or move a Selling Manager Inventory folder.
  * This call is subject to change without notice; the deprecation process is
  * inapplicable to this call. The user must have a Selling Manager Pro subscription to use this call.
  * 
 **/

class ReviseSellingManagerInventoryFolderRequestType extends AbstractRequestType
{
	/**
	* @var SellingManagerFolderDetailsType
	**/
	protected $Folder;


	/**
	 * Class Constructor 
	 **/
	function __construct()
	{
		parent::__construct('ReviseSellingManagerInventoryFolderRequestType', 'urn:ebay:apis:eBLBaseComponents');
		if (!isset(self::$_elements[__CLASS__]))
		{
			self::$_elements[__CLASS__] = array_merge(self::$_elements[get_parent_class(__CLASS__)],
			array(
				'Folder' =>
				array(
					'required' => false,
					'type' => 'SellingManagerFolderDetailsType',
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
	 * @return SellingManagerFolderDetailsType
	 **/
	function getFolder()
	{
		return $this->Folder;
	}

	/**
	 * @return void
	 **/
	function setFolder($value)
	{
		$this->Folder = $value;
	}

}
?>
