<?php

// INCLUDED VIA bc.apiw.inc.php
//
//include("lib/bp.api.pages.inc.php");

$sTitle = "Test Basecamp Projects API classes";
$sFileName = "lib/bc.api.projects.inc.php";

_printTestFileHeader($sTitle, $sFileName);


$sAccountName = "";
$bHTTPS = true;


$oTCH = new CTestClassHelper("CBasecampAPIProjects", array($sAccountName, $bHTTPS));

$oTCH->RegisterMethodWithReturn("ShowAll", array());

//$iProjectId = 0;
//$oTCH->RegisterMethodWithReturn("Show", array($iProjectId));


$oTCH->RunTestMap();


echo "Number of API requests: ".CBasecampAPICallLimitator::$_iCounter."<br />";
echo "Elapsed time since first request: ".CBasecampAPICallLimitator::$_iElapsedTime."<br />";


?>
