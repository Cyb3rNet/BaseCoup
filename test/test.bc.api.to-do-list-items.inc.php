<?php

// INCLUDED VIA bc.apiw.inc.php
//
//include("lib/bc.api.to-do-list-items.inc.php");

$sTitle = "Test Basecamp To-Do List Items API classes";
$sFileName = "lib/bc.api.to-do-list-items.inc.php";

_printTestFileHeader($sTitle, $sFileName);


$sAccountName = "";
$sToken = "";
$bHTTPS = true;


$oTCH = new CTestClassHelper("CBasecampToDoListItems", array($sAccountName, $sToken, $bHTTPS));

//$iListId = ;
//$oTCH->RegisterMethodWithReturn("ShowAllFromList", array($iListId));

//$iItemId = ;
//$oTCH->RegisterMethodWithReturn("Show", array($iItemId));

//$iItemId = ;
//$oTCH->RegisterMethodNoReturn("CompleteItem", array($iItemId));

//$iItemId = ;
//$oTCH->RegisterMethodNoReturn("UncompleteItem", array($iItemId));

//$iListId = ;
//$oXMLRequest = new CBcXOReorderToDoItems();
//$oXMLRequest->SetOrder("1, 2, 3");
//$oTCH->RegisterMethodNoReturn("Reorder", array($iListId, $oXMLRequest));


$oTCH->RunTestMap();


echo "Number of API requests: ".CBasecampAPICallLimitator::$_iCounter."<br />";
echo "Elapsed time since first request: ".CBasecampAPICallLimitator::$_iElapsedTime."<br />";


?>
