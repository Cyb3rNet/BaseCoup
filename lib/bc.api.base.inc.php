<?php


/**
 *	@package [3]APIParent
 *	@version 1.0
 *	@license MIT License
 *
 *	@copyright Copyright (c) 2010 Serafim Junior Dos Santos Fagundes Cyb3r Network
 *	@author Serafim Junior Dos Santos Fagundes <serafim@cyb3r.ca>
 *	
 *	API Wrapper for 37Signals's Basecamp Web Application
 *
 *	This file offers the request methods for the ? API service as documented at http://developer.37signals.com.
 */

 
/**
 *	
 */
require_once("bc.api.objects.inc.php");


/**
 *	
 */
abstract class CBasecampAPI
{
	/**
	 *
	 */
	private $_sAccountName;


	/**
	 *
	 */
	private $_bHTTPS;


	/**
	 *
	 */
	public function __construct($sAccountName, $bHTTPS)
	{
		$this->_sAccountName = $sAccountName;
		$this->_bHTTPS = $bHTTPS;
	}
	
	
	/**
	 *
	 */
	protected function _Call($iHTTPMethod, $sRESTURL, $oXMLRequest = BC_NULL)
	{
		$oRequester = new CBasecampRequestor($this->_sAccountName, $iHTTPMethod, $sRESTURL, $this->_bHTTPS);
		
		if ($oXMLRequest != BC_NULL)
		{
			$sPostString = (string) $oXMLRequest;
		
			$oRequester->SetRequestObject($sPostString);
		}
		
		return $oRequester->Query();
	}
}


?>
