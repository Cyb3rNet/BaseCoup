<?php

// INCLUDED VIA bc.apiw.inc.php
//
//include("lib/bc.api.to-do-list-items.inc.php");

$sTitle = "Test Basecamp To-Do List Items API classes";
$sFileName = "lib/bc.api.to-do-list-items.inc.php";

_printTestFileHeader($sTitle, $sFileName);


$sAccountName = "";
$bHTTPS = true;


$oTCH = new CTestClassHelper("CBasecampToDoListItems", array($sAccountName, $bHTTPS));

//$iListId = "";
//$oTCH->RegisterMethodWithReturn("ShowAllFromList", array($iListId));

//$iItemId
//$oTCH->RegisterMethodWithReturn("Show", array($iItemId));

//$iItemId
//$oTCH->RegisterMethodWithReturn("CompleteItem", array($iItemId));

//$iItemId
//$oTCH->RegisterMethodWithReturn("UncompleteItem", array($iItemId));

//$iListId
//$oXMLRequest
//$oTCH->RegisterMethodWithReturn("Reorder", array($iListId, $oXMLRequest));


$oTCH->RunTestMap();


echo "Number of API requests: ".CBackpackAPICallLimitator::$_iCounter."<br />";
echo "Elapsed time since first request: ".CBackpackAPICallLimitator::$_iElapsedTime."<br />";


?>
