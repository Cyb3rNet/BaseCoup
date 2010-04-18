<?php


/**
 *	@package [5]APIChild
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
require_once("bc.api.base.inc.php");


/**
 *
 */
class CBasecampAPIProjects extends CBasecampAPI
{
	/**
	 *
	 */
	public function __construct($sAccountName, $sToken, $bHTTPS = true)
	{
		parent::__construct($sAccountName, $sToken, $bHTTPS);
	}
	
	
	/**
	 *
	 */
	public function ShowAll()
	{
		$iMethod = NHTTPMethods::iGet;
		$sRESTURL = "/projects.xml";
		
		$sBpResponse = parent::_Call($iMethod, $sRESTURL);
		
		return $sBpResponse;
	}


	/**
	 *
	 */
	public function Show($iProjectId)
	{
		$iMethod = NHTTPMethods::iGet;
		$sRESTURL = "/projects/".$iProjectId.".xml";
		
		$sBpResponse = parent::_Call($iMethod, $sRESTURL);
		
		return $sBpResponse;
	}
}
 
 
?>
