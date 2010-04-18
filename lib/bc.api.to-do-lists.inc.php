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
class CBasecampToDoLists extends CBasecampAPI
{
	/**
	 *
	 */
	const iPartyMe = 0;
	

	/**
	 *
	 */
	const iPartyPerson = 1;


	/**
	 *
	 */
	const iPartyCompany = 2;


	/**
	 *
	 */
	const sFilterAll = 'all';
	
	
	/**
	 *
	 */
	const sFilterPending = 'pending';
	
	
	/**
	 *
	 */
	const sFilterFinished = 'finished';
	
	
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
	public function ShowAllFromAllProjects($ciPartyType = CBasecampToDoLists::iPartyMe, $iResponsiblePartyId = 0)
	{
		$iMethod = NHTTPMethods::iGet;

		switch ($ciPartyType)
		{
			case CBasecampToDoLists::iPartyMe:
				$sQuery = "";
			break;
			case CBasecampToDoLists::iPartyPerson:
				$sQuery = "?responsible_party=".$iResponsiblePartyId;
			break;
			case CBasecampToDoLists::iPartyCompany:
				$sQuery = "?responsible_party=c".$iResponsiblePartyId;
			break;
		}
		
		$sRESTURL = "/todo_lists.xml".$sQuery;
		
		$sBpResponse = parent::_Call($iMethod, $sRESTURL);
		
		return $sBpResponse;
	}


	/**
	 *
	 */
	public function ShowAllFromProject($iProjectId, $csFilter = CBasecampToDoLists::sFilterAll)
	{
		$iMethod = NHTTPMethods::iGet;

		$sQuery = "?filter=".$csFilter;
		
		$sRESTURL = "/projects/".$iProjectId."/todo_lists.xml".$sQuery;
		
		$sBpResponse = parent::_Call($iMethod, $sRESTURL);
		
		return $sBpResponse;
	}


	/**
	 *
	 */
	public function Show($iListId)
	{
		$iMethod = NHTTPMethods::iGet;

		$sRESTURL = "/todo_lists/".$iListId.".xml";
		
		$sBpResponse = parent::_Call($iMethod, $sRESTURL);
		
		return $sBpResponse;
	}
}

 
?>
