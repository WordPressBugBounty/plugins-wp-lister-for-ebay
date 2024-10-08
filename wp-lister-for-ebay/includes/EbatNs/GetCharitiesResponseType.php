<?php
/* Generated on 14.02.18 14:28 by globalsync
 * $Id: $
 * $Log: $
 */

require_once 'AbstractResponseType.php';
require_once 'CharityInfoType.php';

/**
  * This is the base response type for the <b>GetCharities</b> call. This call is used to search for eBay for Charity nonprofit organizations. A <b>Charity</b> container is returned for each nonprofit organization that matches the criteria in the call request.
  * 
 **/

class GetCharitiesResponseType extends AbstractResponseType
{
	/**
	* @var CharityInfoType
	**/
	protected $Charity;


	/**
	 * Class Constructor 
	 **/
	function __construct()
	{
		parent::__construct('GetCharitiesResponseType', 'urn:ebay:apis:eBLBaseComponents');
		if (!isset(self::$_elements[__CLASS__]))
		{
			self::$_elements[__CLASS__] = array_merge(self::$_elements[get_parent_class(__CLASS__)],
			array(
				'Charity' =>
				array(
					'required' => false,
					'type' => 'CharityInfoType',
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
	 * @return CharityInfoType
	 * @param integer $index 
	 **/
	function getCharity($index = null)
	{
		if ($index !== null)
		{
			return $this->Charity[$index];
		}
		else
		{
			return $this->Charity;
		}
	}

	/**
	 * @return void
	 * @param CharityInfoType $value
	 * @param integer $index 
	 **/
	function setCharity($value, $index = null)
	{
		if ($index !== null)
		{
			$this->Charity[$index] = $value;
		}
		else
		{
			$this->Charity= $value;
		}
	}

	/**
	 * @return void
	 * @param CharityInfoType $value
	 **/
	function addCharity($value)
	{
		$this->Charity[] = $value;
	}

}
?>
