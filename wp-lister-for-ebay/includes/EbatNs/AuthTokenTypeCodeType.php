<?php
/* Generated on 14.02.18 14:28 by globalsync
 * $Id: $
 * $Log: $
 */

require_once 'EbatNs_FacetType.php';

class AuthTokenTypeCodeType extends EbatNs_FacetType
{
	const CodeType_ClientAlertsToken = 'ClientAlertsToken';
	const CodeType_CustomCode = 'CustomCode';

	/**
	 * @return 
	 **/
	function __construct()
	{
		parent::__construct('AuthTokenTypeCodeType', 'urn:ebay:apis:eBLBaseComponents');
	}
}
$Facet_AuthTokenTypeCodeType = new AuthTokenTypeCodeType();
?>