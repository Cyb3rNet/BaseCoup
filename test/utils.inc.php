<?php

// TEST UTILITARIES


//// HTML MAINHEADER - H1
//
function _printHTMLTitleHeader($sTitle)
{
	echo "<h1 class='test-helper'>".$sTitle."</h1>";
}

//// HTML SECTION HEADER - H2
//
function _printHTMLSectionHeader($sTitle)
{
	echo "<h2 class='test-helper'>".$sTitle."</h2>";
}

//// HTML SUB SECTION HEADER - H3
//
function _printHTMLSubSectionHeader($sTitle)
{
	echo "<h3 class='test-helper'>".$sTitle."</h3>";
}

//// HTML SUB SECTION HEADER - H4
//
function _printHTMLSubSubSectionHeader($sTitle)
{
	echo "<h4 class='test-helper'>".$sTitle."</h3>";
}

//// HTML PARAGRAPH - FILE PATH
//
function _printHTMLFileName($sFileName)
{
	echo "<p class='test-helper-param'><em>File path: </em>".$sFileName."</p>";
}

//// HTML PARAGRAPH
//
function _printHTMLP($sContent)
{
	echo "<p class='test-helper'>".$sContent."</p>";
}

//// HTML CODE
//
function _printHTMLC($sContent)
{
	echo "<pre class='test-helper'>".htmlentities($sContent)."</pre>";
}

//// TEST FILE HEADER
//
function _printTestFileHeader($sTitle, $sFileName)
{
	_printHTMLTitleHeader($sTitle);
	_printHTMLFileName($sFileName);
}

//// TEST CLASS HEADER
//
function _printTestClassHeader($sTitle)
{
	_printHTMLSectionHeader($sTitle);
}

//// TEST CLASS METHOD HEADER
//
function _printTestClassMethodHeader($sTitle)
{
	_printHTMLSubSectionHeader($sTitle);
}

//// TEST CLASS METHOD RESULT
//
function _printTestClassMethodResult($sContent)
{
	_printHTMLSubSubSectionHeader("Result:");
	_printHTMLC($sContent);
}


////
//// CLASS - TEST METHOD CLASS FOR MAIN TEST UTILITARY
////
//
class CTestMethodHelper
{
	const iNoReturn = 0;
	const iWithReturn = 1;
	
	private $_iType;
	private $_sMethodName;
	private $_avArgs;
	
	public function __construct($iType, $sMethodName, $avArgs)
	{
		$this->_iType = $iType;
		$this->_sMethodName = $sMethodName;
		$this->_avArgs = $avArgs;
	}
	
	public function GetType()
	{
		return $this->_iType;
	}
	
	public function GetMethodName()
	{
		return $this->_sMethodName;
	}
	
	public function GetArgs()
	{
		return $this->_avArgs;
	}
}


////
//// CLASS - MAIN TEST UTILITARY
////
//
class CTestClassHelper extends CTestClass
{
	private $_aoMethodHelpers;
	
	public function __construct($sClassName, $avArgs)
	{
		parent::__construct($sClassName, $avArgs);
		
		$this->_aoMethodHelpers = array();
	}
	
	public function RegisterMethodNoReturn($sMethodName, $avArgs)
	{
		$this->_aoMethodHelpers[] = new CTestMethodHelper(CTestMethodHelper::iNoReturn, $sMethodName, $avArgs);
	}
	
	public function RegisterMethodWithReturn($sMethodName, $avArgs)
	{
		$this->_aoMethodHelpers[] = new CTestMethodHelper(CTestMethodHelper::iWithReturn, $sMethodName, $avArgs);
	}
	
	public function RunTestMap()
	{
		foreach ($this->_aoMethodHelpers as $oMethodHelper)
		{
			sleep(1);
		
			switch ($oMethodHelper->GetType())
			{
				case CTestMethodHelper::iNoReturn:
					$this->CallMethodVoidReturn($oMethodHelper->GetMethodName(), $oMethodHelper->GetArgs());
				break;

				case CTestMethodHelper::iWithReturn:
					$this->CallMethodWithReturn($oMethodHelper->GetMethodName(), $oMethodHelper->GetArgs());
				break;
			}
		}
	}
}


////
//// CLASS - CLASS TESTER
////
//
class CTestClass
{
	private $_oC;
	private $_sC;
	
	public function __construct($sTestClass, $avArgs)
	{
		$this->_sC = $sTestClass;
	
		_printTestClassHeader("Testing Class: ".$this->_sC);
		
		$oRC = new ReflectionClass($sTestClass);
		
		$this->_oC = $oRC->newInstanceArgs($avArgs);
	}
	
	public function CallMethodVoidReturn($sMethodName, $avArgs)
	{
		_printTestClassMethodHeader("Calling: ".$this->_sC."->".$sMethodName);
		
		$this->_callMethodVoidReturn($sMethodName, $avArgs);
	}

	public function CallMethodWithReturn($sMethodName, $avArgs)
	{
		_printTestClassMethodHeader("Calling: ".$this->_sC."->".$sMethodName);
		
		$vReturn = $this->_callMethodWithReturn($sMethodName, $avArgs);
		
		_printTestClassMethodResult((string) $vReturn);
	}
	
	private function _callMethodVoidReturn($sMethodName, $avArgs)
	{
		if (count($avArgs))
		{
			call_user_func_array(array($this->_oC, $sMethodName), $avArgs);
		}
		else
		{
			call_user_func(array($this->_oC, $sMethodName));
		}
	}
	
	private function _callMethodWithReturn($sMethodName, $avArgs)
	{
		ob_start();
			
		if (count($avArgs))
		{
			$vReturn1 = call_user_func_array(array($this->_oC, $sMethodName), $avArgs);
		}
		else
		{
			$vReturn1 = call_user_func(array($this->_oC, $sMethodName));
		}
		
		$vReturn2 = ob_get_contents();
		
		ob_end_clean();
		
		return $vReturn1.$vReturn2;
	}
}

?>
