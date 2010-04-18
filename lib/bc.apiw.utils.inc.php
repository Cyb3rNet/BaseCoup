<?php


/**
 *	@package [1]Utilitaries
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
require_once("bc.apiw.base.inc.php");


/**
 *	
 */
require_once("bc.apiw.call.limitator.inc.php");


/**
 *	
 */
class CXMLObject
{
	/**
	 *	
	 */
	private $_sStartNode;


	/**
	 *	
	 */
	private $_sEndNode;


	/**
	 *	
	 */
	private $_sContent;


	/**
	 *	
	 */
	private $_aAttrs;
	

	/**
	 *	
	 */
	public function __construct($sTagName)
	{
		$this->_sTagName = $sTagName;
	
		$this->_sStartNode = "";
		$this->_sEndNode = "";
		
		$this->_sContent = "";
		
		$this->_aAttrs = array();
	}
	

	/**
	 *	
	 */
	public function AddAttr($sName, $sValue)
	{
		$this->_aAttrs[$sName] = $sValue;
	}
	

	/**
	 *	
	 */
	public function AppendContent($sContent)
	{
		$this->_sContent .= $sContent;
	}
	

	/**
	 *	
	 */
	public function ReplaceContent($sContent)
	{
		$this->_sContent = $sContent;
	}
	

	/**
	 *	
	 */
	protected function _ComposeStartNode()
	{
		$sAttrs = "";
	
		foreach ($this->_aAttrs as $k => $v)
		{
			$sAttrs .= $k.'="'.$v.'" ';
		}
	
		return "<".$this->_sTagName." ".$sAttrs.">";
	}
	
	
	/**
	 *
	 */
	protected function _ComposeEndNode()
	{
		$sEndNode = "</".$this->_sTagName.">";
		
		return $sEndNode;
	}
	

	/**
	 *	
	 */
	protected function _Generate()
	{
		$this->_sStartNode = $this->_ComposeStartNode();
		$this->_sEndNode = $this->_ComposeEndNode();
	
		return $this->_sStartNode.$this->_sContent.$this->_sEndNode;
	}


	/**
	 *	
	 */
	public function __toString()
	{
		return self::_Generate();
	}
}


/**
 *	
 */
class CBasecampRequestor extends CBasecampAPICallLimitator
{
	/**
	 *	
	 */
	private $_oConnection;


	/**
	 *	
	 */
	protected $_sAccountName;


	/**
	 *	
	 */
	protected $_iHTTPMethod;


	/**
	 *	
	 */
	protected $_sRESTURL;


	/**
	 *	
	 */
	private $_sProtocol;
	

	/**
	 *	
	 */
	private $_sURL;
	
	
	/**
	 *	
	 */
	private $_iContentLength;


	/**
	 *	
	 */
	public function __construct($sAccountName, $sToken, $ciHTTPMethod, $sRESTURL, $bHTTPS = true)
	{
		$sBpDomain = "basecamphq.com";
		
		$this->_sAccountName = $sAccountName;
		$this->_iHTTPMethod = $ciHTTPMethod;
		$this->_sRESTURL = $sRESTURL;
		
		if ($bHTTPS)
			$this->_sProtocol = "https";
		else
			$this->_sProtocol = "http";
		
		$this->_sURL = $this->_sProtocol."://".$this->_sAccountName.".".$sBpDomain.$this->_sRESTURL;

		$this->_iContentLength = 0;

		$this->_oConnection = new CHTTPCurl($this->_sURL, $this->_iHTTPMethod, $sToken, "X");
		
		parent::__construct();
	}
	
	
	/**
	 *
	 */
	public function SetRequestObject($oRequest)
	{
		$this->_iContentLength = strlen((string) $oRequest);
	
		$this->_oConnection->SetPostString($oRequest);
	}
	

	/**
	 *	
	 */
	public function Query()
	{
		$this->_oConnection->AddHeader('Content-type: application/xml');
		$this->_oConnection->AddHeader('Accept: application/xml');

		if ($this->_iHTTPMethod == NHTTPMethods::iPut)
			$this->_oConnection->AddHeader('Content-Length: '.$this->_iContentLength);

		$this->_oConnection->PrepareOptions();
		
		$sResponse = $this->_oConnection->Execute();
		
		unset($this->_oConnection);
		
		return $sResponse;
	}

	 
	/**
	 *	
	 */
	public function GetProtocol()
	{
		return $this->_sProtocol;
	}
	
	
	/**
	 *
	 */
	public function GetAccountName()
	{
		return $this->_sAccountName;
	}
}


?>
