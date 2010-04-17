<?php


/**
 *	@package [2]APIObjects
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


require_once("bc.apiw.utils.inc.php");


class CBcXOReorderToDoItems extends CXMLObject
{
	public function __construct()
	{
		parent::__construct("todo-items");
		
		parent::AddAttr("type", "array");
	}
	
	public function SetOrder($sCSVItemIds)
	{
		$aItemIds = explode(",", $sCSVItemIds);
		
		foreach ($aItemIds as $sItemId)
		{
			$oXOToDoItem = new CXMLObject("todo-item");
		
				$oXOId = new CXMLObject("id");
			
				$oXOId->AppendContent($sItemId);
			
			$oXOToDoItem->AppendContent($oXOId);
			
			parent::AppendContent($oXOToDoItem);
		}
	}
}

?>
