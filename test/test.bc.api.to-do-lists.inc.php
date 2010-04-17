<?php

// INCLUDED VIA bc.apiw.inc.php
//
//include("lib/bc.api.to-do-lists.inc.php");

$sTitle = "Test Basecamp To-Do Lists API classes";
$sFileName = "lib/bc.api.to-do-lists.inc.php";

_printTestFileHeader($sTitle, $sFileName);


$sAccountName = "";
$bHTTPS = true;


$oTCH = new CTestClassHelper("CBasecampToDoLists", array($sAccountName, $bHTTPS));

//$ciPartyType
//$iResponsiblePartyId
$oTCH->RegisterMethodWithReturn("ShowAllFromAllProjects", array());

//$iProjectId
//$csFilter
//$oTCH->RegisterMethodWithReturn("ShowAllFromProject", array($iProjectId, $csFilter));

//$iListId = 0;
//$oTCH->RegisterMethodWithReturn("Show", array($iListId));


$oTCH->RunTestMap();


echo "Number of API requests: ".CBackpackAPICallLimitator::$_iCounter."<br />";
echo "Elapsed time since first request: ".CBackpackAPICallLimitator::$_iElapsedTime."<br />";


?>
