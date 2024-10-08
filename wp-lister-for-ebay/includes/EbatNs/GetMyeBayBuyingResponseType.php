<?php
/* Generated on 14.02.18 14:28 by globalsync
 * $Id: $
 * $Log: $
 */

require_once 'AbstractResponseType.php';
require_once 'BuyingSummaryType.php';
require_once 'PaginatedItemArrayType.php';
require_once 'PaginatedOrderTransactionArrayType.php';
require_once 'MyeBayFavoriteSearchListType.php';
require_once 'MyeBayFavoriteSellerListType.php';
require_once 'ItemType.php';
require_once 'BidGroupArrayType.php';
require_once 'UserDefinedListType.php';

/**
  * Returns information regarding a user's buying activity, such as items they are watching, bidding on, have won, did not win, and have made Best Offers on.
  * 
 **/

class GetMyeBayBuyingResponseType extends AbstractResponseType
{
	/**
	* @var BuyingSummaryType
	**/
	protected $BuyingSummary;

	/**
	* @var PaginatedItemArrayType
	**/
	protected $WatchList;

	/**
	* @var PaginatedItemArrayType
	**/
	protected $BidList;

	/**
	* @var PaginatedItemArrayType
	**/
	protected $BestOfferList;

	/**
	* @var PaginatedOrderTransactionArrayType
	**/
	protected $WonList;

	/**
	* @var PaginatedItemArrayType
	**/
	protected $LostList;

	/**
	* @var MyeBayFavoriteSearchListType
	**/
	protected $FavoriteSearches;

	/**
	* @var MyeBayFavoriteSellerListType
	**/
	protected $FavoriteSellers;

	/**
	* @var ItemType
	**/
	protected $SecondChanceOffer;

	/**
	* @var BidGroupArrayType
	**/
	protected $BidAssistantList;

	/**
	* @var PaginatedOrderTransactionArrayType
	**/
	protected $DeletedFromWonList;

	/**
	* @var PaginatedItemArrayType
	**/
	protected $DeletedFromLostList;

	/**
	* @var UserDefinedListType
	**/
	protected $UserDefinedList;


	/**
	 * Class Constructor 
	 **/
	function __construct()
	{
		parent::__construct('GetMyeBayBuyingResponseType', 'urn:ebay:apis:eBLBaseComponents');
		if (!isset(self::$_elements[__CLASS__]))
		{
			self::$_elements[__CLASS__] = array_merge(self::$_elements[get_parent_class(__CLASS__)],
			array(
				'BuyingSummary' =>
				array(
					'required' => false,
					'type' => 'BuyingSummaryType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'WatchList' =>
				array(
					'required' => false,
					'type' => 'PaginatedItemArrayType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'BidList' =>
				array(
					'required' => false,
					'type' => 'PaginatedItemArrayType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'BestOfferList' =>
				array(
					'required' => false,
					'type' => 'PaginatedItemArrayType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'WonList' =>
				array(
					'required' => false,
					'type' => 'PaginatedOrderTransactionArrayType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'LostList' =>
				array(
					'required' => false,
					'type' => 'PaginatedItemArrayType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'FavoriteSearches' =>
				array(
					'required' => false,
					'type' => 'MyeBayFavoriteSearchListType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'FavoriteSellers' =>
				array(
					'required' => false,
					'type' => 'MyeBayFavoriteSellerListType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'SecondChanceOffer' =>
				array(
					'required' => false,
					'type' => 'ItemType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => true,
					'cardinality' => '0..*'
				),
				'BidAssistantList' =>
				array(
					'required' => false,
					'type' => 'BidGroupArrayType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'DeletedFromWonList' =>
				array(
					'required' => false,
					'type' => 'PaginatedOrderTransactionArrayType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'DeletedFromLostList' =>
				array(
					'required' => false,
					'type' => 'PaginatedItemArrayType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'UserDefinedList' =>
				array(
					'required' => false,
					'type' => 'UserDefinedListType',
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
	 * @return BuyingSummaryType
	 **/
	function getBuyingSummary()
	{
		return $this->BuyingSummary;
	}

	/**
	 * @return void
	 **/
	function setBuyingSummary($value)
	{
		$this->BuyingSummary = $value;
	}

	/**
	 * @return PaginatedItemArrayType
	 **/
	function getWatchList()
	{
		return $this->WatchList;
	}

	/**
	 * @return void
	 **/
	function setWatchList($value)
	{
		$this->WatchList = $value;
	}

	/**
	 * @return PaginatedItemArrayType
	 **/
	function getBidList()
	{
		return $this->BidList;
	}

	/**
	 * @return void
	 **/
	function setBidList($value)
	{
		$this->BidList = $value;
	}

	/**
	 * @return PaginatedItemArrayType
	 **/
	function getBestOfferList()
	{
		return $this->BestOfferList;
	}

	/**
	 * @return void
	 **/
	function setBestOfferList($value)
	{
		$this->BestOfferList = $value;
	}

	/**
	 * @return PaginatedOrderTransactionArrayType
	 **/
	function getWonList()
	{
		return $this->WonList;
	}

	/**
	 * @return void
	 **/
	function setWonList($value)
	{
		$this->WonList = $value;
	}

	/**
	 * @return PaginatedItemArrayType
	 **/
	function getLostList()
	{
		return $this->LostList;
	}

	/**
	 * @return void
	 **/
	function setLostList($value)
	{
		$this->LostList = $value;
	}

	/**
	 * @return MyeBayFavoriteSearchListType
	 **/
	function getFavoriteSearches()
	{
		return $this->FavoriteSearches;
	}

	/**
	 * @return void
	 **/
	function setFavoriteSearches($value)
	{
		$this->FavoriteSearches = $value;
	}

	/**
	 * @return MyeBayFavoriteSellerListType
	 **/
	function getFavoriteSellers()
	{
		return $this->FavoriteSellers;
	}

	/**
	 * @return void
	 **/
	function setFavoriteSellers($value)
	{
		$this->FavoriteSellers = $value;
	}

	/**
	 * @return ItemType
	 * @param integer $index 
	 **/
	function getSecondChanceOffer($index = null)
	{
		if ($index !== null)
		{
			return $this->SecondChanceOffer[$index];
		}
		else
		{
			return $this->SecondChanceOffer;
		}
	}

	/**
	 * @return void
	 * @param ItemType $value
	 * @param integer $index 
	 **/
	function setSecondChanceOffer($value, $index = null)
	{
		if ($index !== null)
		{
			$this->SecondChanceOffer[$index] = $value;
		}
		else
		{
			$this->SecondChanceOffer= $value;
		}
	}

	/**
	 * @return void
	 * @param ItemType $value
	 **/
	function addSecondChanceOffer($value)
	{
		$this->SecondChanceOffer[] = $value;
	}

	/**
	 * @return BidGroupArrayType
	 **/
	function getBidAssistantList()
	{
		return $this->BidAssistantList;
	}

	/**
	 * @return void
	 **/
	function setBidAssistantList($value)
	{
		$this->BidAssistantList = $value;
	}

	/**
	 * @return PaginatedOrderTransactionArrayType
	 **/
	function getDeletedFromWonList()
	{
		return $this->DeletedFromWonList;
	}

	/**
	 * @return void
	 **/
	function setDeletedFromWonList($value)
	{
		$this->DeletedFromWonList = $value;
	}

	/**
	 * @return PaginatedItemArrayType
	 **/
	function getDeletedFromLostList()
	{
		return $this->DeletedFromLostList;
	}

	/**
	 * @return void
	 **/
	function setDeletedFromLostList($value)
	{
		$this->DeletedFromLostList = $value;
	}

	/**
	 * @return UserDefinedListType
	 * @param integer $index 
	 **/
	function getUserDefinedList($index = null)
	{
		if ($index !== null)
		{
			return $this->UserDefinedList[$index];
		}
		else
		{
			return $this->UserDefinedList;
		}
	}

	/**
	 * @return void
	 * @param UserDefinedListType $value
	 * @param integer $index 
	 **/
	function setUserDefinedList($value, $index = null)
	{
		if ($index !== null)
		{
			$this->UserDefinedList[$index] = $value;
		}
		else
		{
			$this->UserDefinedList= $value;
		}
	}

	/**
	 * @return void
	 * @param UserDefinedListType $value
	 **/
	function addUserDefinedList($value)
	{
		$this->UserDefinedList[] = $value;
	}

}
?>
