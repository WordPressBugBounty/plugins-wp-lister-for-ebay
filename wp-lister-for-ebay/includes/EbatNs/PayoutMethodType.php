<?php
/* Generated on 14.02.18 14:28 by globalsync
 * $Id: $
 * $Log: $
 */

require_once 'EbatNs_FacetType.php';

class PayoutMethodType extends EbatNs_FacetType
{
	const CodeType_PAYPAL = 'PAYPAL';
	const CodeType_EFT = 'EFT';
	const CodeType_MONEYBOOKERS = 'MONEYBOOKERS';

	/**
	 * @return 
	 **/
	function __construct()
	{
		parent::__construct('PayoutMethodType', 'urn:ebay:apis:eBLBaseComponents');
	}
}
$Facet_PayoutMethodType = new PayoutMethodType();
?>