<?php


/**
 *	@package Wrappers
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
class CBasecampToDoListItems extends CBasecampAPI
{
	/**
	 *
	 */
	public function __construct($sAccountName, $bHTTPS = true)
	{
		parent::__construct($sAccountName, $bHTTPS);
	}	
	
	
	/**
	 *
	 */
	public function ShowAllFromList($iListId)
	{
		$iMethod = NHTTPMethods::iGet;
		$sRESTURL = "/todo_lists/".$iListId."/todo_items.xml";
		
		$sBpResponse = parent::_Call($iMethod, $sRESTURL);
		
		return $sBpResponse;
	}


	/**
	 *
	 */
	public function Show($iItemId)
	{
		$iMethod = NHTTPMethods::iGet;
		$sRESTURL = "/todo_items/".$iItemId.".xml";
		
		$sBpResponse = parent::_Call($iMethod, $sRESTURL);
		
		return $sBpResponse;
	}
	

	/**
	 *
	 */
	public function CompleteItem($iItemId)
	{
		$iMethod = NHTTPMethods::iPut;
		$sRESTURL = "/todo_items/".$iItemId."/complete.xml";
		
		$sBpResponse = parent::_Call($iMethod, $sRESTURL);
		
		return $sBpResponse;
	}


	/**
	 *
	 */
	public function UncompleteItem($iItemId)
	{
		$iMethod = NHTTPMethods::iPut;
		$sRESTURL = "/todo_items/".$iItemId."/uncomplete.xml";
		
		$sBpResponse = parent::_Call($iMethod, $sRESTURL);
		
		return $sBpResponse;
	}
	
	
	/**
	 *
	 */
	public function Reorder($iListId, $oXMLRequest)
	{
		$iMethod = NHTTPMethods::iPost;
		$sRESTURL = "/todo_lists/".$iListId."/todo_items/reorder.xml";
		
		$sBpResponse = parent::_Call($iMethod, $sRESTURL, $oXMLRequest);
		
		return $sBpResponse;
	}
}

 
?>
