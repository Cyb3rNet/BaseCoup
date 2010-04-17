<html>

<head>

<title>BaseCoup API Wrapper Tests</title>

<style type="text/css">

body
{
	font-family:Georgia, serif;
	font-weight:bold;
}

h1.test-helper
{
	border:0px solid #666;
	border-top-width:3px;
}

h2.test-helper
{
	border:0px solid #999;
	border-top-width:3px;
	padding:10px
	margin:10px;
}

h3.test-helper
{
	border:0px solid #CCC;
	border-top-width:3px;
}

p.test-helper, code.test-helper, pre.test-helper
{
	border:2px dashed #666;
	background-color:#EEE;
	color:#000;
	font-size:;
	padding:10px;
	margin:5px;
	display:block;
}

p.test-helper-param
{
	border:2px solid #666;
	background-color:beige;
	color:#000;
	padding:10px;
	margin:5px;
}

</style>

</head>

<body>

<?php

// BASECAMP API WRAPPER
//
include("bc.apiw.inc.php");

// TEST UTILITARIES
//
include("test/utils.inc.php");

// INDIVIDUAL IMPLEMENTATION FILE TESTS
//
//include("test/test.bc.apiw.base.inc.php");
//include("test/test.bc.apiw.utils.inc.php");
//include("test/test.bc.api.base.inc.php");

// TEST THE FOLOWING FILE SEPARATELY
//include("test/test.bc.api.call.limitator.inc.php");

// BASECAMP API FILE TESTS
//
include("test/test.bc.api.projects.inc.php");
include("test/test.bc.api.to-do-lists.inc.php");
include("test/test.bc.api.to-do-list-items.inc.php");

?>

</body>

</html>
