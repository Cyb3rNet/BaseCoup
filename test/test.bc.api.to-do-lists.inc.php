<?php

// INCLUDED VIA bc.apiw.inc.php
//
//include("lib/bc.api.to-do-lists.inc.php");

$sTitle = "Test Basecamp To-Do Lists API classes";
$sFileName = "lib/bc.api.to-do-lists.inc.php";

_printTestFileHeader($sTitle, $sFileName);


$sAccountName = "";
$sToken = "";
$bHTTPS = true;


$oTCH = new CTestClassHelper("CBasecampToDoLists", array($sAccountName, $sToken, $bHTTPS));

//$ciPartyType
//$iResponsiblePartyId
$oTCH->RegisterMethodWithReturn("ShowAllFromAllProjects", array());

//$iProjectId = ;
//$csFilter = CBasecampToDoLists::sFilterAll;
//$oTCH->RegisterMethodWithReturn("ShowAllFromProject", array($iProjectId, $csFilter));

//$iListId = ;
//$oTCH->RegisterMethodWithReturn("Show", array($iListId));


$oTCH->RunTestMap();


echo "Number of API requests: ".CBasecampAPICallLimitator::$_iCounter."<br />";
echo "Elapsed time since first request: ".CBasecampAPICallLimitator::$_iElapsedTime."<br />";


?>
