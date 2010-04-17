<?php


/**
 *	@package [0]Base
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


define("BC_NULL", null);


define("BC_EMPTY_STRING", "");


/**
 *
 */
class HTTPException extends Exception
{
	/**
	 *
	 */
	private $_iCode;


	/**
	 *
	 */
	public function __construct($iCode)
	{
		$this->_iCode = $iCode;
	
		$sHTTPResponse = $this->GetCodeMessage($iCode);
	
		$sMessage = "HTTP response is ".$iCode." : ".$sHTTPResponse;
	
		parent::__construct($sMessage);
	}
	

	/**
	 *
	 */
	public function GetStatusCode()
	{
		return $this->_iCode;
	}
	

	/**
	 *
	 */
	private function GetCodeMessage($iCode)
	{
		switch ($iCode)
		{
			// FROM WIKIPEDIA
			// http://en.wikipedia.org/wiki/List_of_HTTP_status_codes
			
			// 1xx Informational
			// 
			// Request received, continuing process.[2]
			// This class of status code indicates a provisional response, consisting only of the Status-Line and optional headers, and is terminated by an empty line. Since HTTP/1.0 did not define any 1xx status codes, servers must not send a 1xx response to an HTTP/1.0 client except under experimental conditions.
			case 100:
				$sMessage = "Continue";
			// This means that the server has received the request headers, and that the client should proceed to send the request body (in the case of a request for which a body needs to be sent; for example, a POST request). If the request body is large, sending it to a server when a request has already been rejected based upon inappropriate headers is inefficient. To have a server check if the request could be accepted based on the request's headers alone, a client must send Expect: 100-continue as a header in its initial request[2] and check if a 100 Continue status code is received in response before continuing (or receive 417 Expectation Failed and not continue).[2]
			break;
			case 101:
				$sMessage = "Switching Protocols";
			// This means the requester has asked the server to switch protocols and the server is acknowledging that it will do so.[2]
			break;
			case 102:
				$sMessage = "Processing";
			// As a WebDAV request may contain many sub-requests involving file operations, it may take a long time to complete the request. This code indicates that the server has received and is processing the request, but no response is available yet.[3] This prevents the client from timing out and assuming the request was lost.

			// 2xx Success
			// 
			// This class of status codes indicates the action requested by the client was received, understood, accepted and processed successfully.
			break;
			case 200:
				$sMessage = "OK";
			// Standard response for successful HTTP requests. The actual response will depend on the request method used. In a GET request, the response will contain an entity corresponding to the requested resource. In a POST request the response will contain an entity describing or containing the result of the action.[2]
			break;
			case 201:
				$sMessage = "Created";
			// The request has been fulfilled and resulted in a new resource being created.[2]
			break;
			case 202:
				$sMessage = "Accepted";
			// The request has been accepted for processing, but the processing has not been completed. The request might or might not eventually be acted upon, as it might be disallowed when processing actually takes place.[2]
			break;
			case 203:
				$sMessage = "Non-Authoritative Information";
			// The server successfully processed the request, but is returning information that may be from another source.[2]
			break;
			case 204:
				$sMessage = "No Content";
			// The server successfully processed the request, but is not returning any content.[2]
			break;
			case 205:
				$sMessage = "Reset Content";
			// The server successfully processed the request, but is not returning any content. Unlike a 204 response, this response requires that the requester reset the document view.[2]
			break;
			case 206:
				$sMessage = "Partial Content";
			// The server is delivering only part of the resource due to a range header sent by the client. This is used by tools like wget to enable resuming of interrupted downloads, or split a download into multiple simultaneous streams.[2]
			break;
			case 207:
				$sMessage = "Multi-Status";
			// The message body that follows is an XML message and can contain a number of separate response codes, depending on how many sub-requests were made.[4]

			// 3xx Redirection
			// 
			// The client must take additional action to complete the request.[2]
			// This class of status code indicates that further action needs to be taken by the user agent in order to fulfil the request. The action required may be carried out by the user agent without interaction with the user if and only if the method used in the second request is GET or HEAD. A user agent should not automatically redirect a request more than five times, since such redirections usually indicate an infinite loop.
			break;
			case 300:
				$sMessage = "Multiple Choices";
			// Indicates multiple options for the resource that the client may follow. It, for instance, could be used to present different format options for video, list files with different extensions, or word sense disambiguation.[2]
			break;
			case 301:
				$sMessage = "Moved Permanently";
			// This and all future requests should be directed to the given URI.[2]
			break;
			case 302:
				$sMessage = "Found";
			// This is the most popular redirect code[citation needed], but also an example of industrial practice contradicting the standard.[2] HTTP/1.0 specification (RFC 1945) required the client to perform a temporary redirect (the original describing phrase was "Moved Temporarily"),[5] but popular browsers implemented 302 with the functionality of a 303 See Other. Therefore, HTTP/1.1 added status codes 303 and 307 to distinguish between the two behaviours. However, the majority of Web applications and frameworks still use the 302 status code as if it were the 303[citation needed].
			break;
			case 303:
				$sMessage = "See Other";
			// The response to the request can be found under another URI using a GET method. When received in response to a PUT, it should be assumed that the server has received the data and the redirect should be issued with a separate GET message.[2]
			break;
			case 304:
				$sMessage = "Not Modified";
			// Indicates the resource has not been modified since last requested.[2] Typically, the HTTP client provides a header like the If-Modified-Since header to provide a time against which to compare. Utilizing this saves bandwidth and reprocessing on both the server and client, as only the header data must be sent and received in comparison to the entirety of the page being re-processed by the server, then resent using more bandwidth of the server and client.
			break;
			case 305:
				$sMessage = "Use Proxy";
			// Many HTTP clients (such as Mozilla[6] and Internet Explorer) do not correctly handle responses with this status code, primarily for security reasons.[2]
			break;
			case 306:
				$sMessage = "Switch Proxy";
			// No longer used.[2]
			break;
			case 307:
				$sMessage = "Temporary Redirect";
			// In this occasion, the request should be repeated with another URI, but future requests can still use the original URI.[2] In contrast to 303, the request method should not be changed when reissuing the original request. For instance, a POST request must be repeated using another POST request.

			// [edit]4xx Client Error
			// 
			// The 4xx class of status code is intended for cases in which the client seems to have erred. Except when responding to a HEAD request, the server should include an entity containing an explanation of the error situation, and whether it is a temporary or permanent condition. These status codes are applicable to any request method. User agents should display any included entity to the user. These are typically the most common error codes encountered while online.
			break;
			case 400:
				$sMessage = "Bad Request";
			// The request contains bad syntax or cannot be fulfilled.[2]
			break;
			case 401:
				$sMessage = "Unauthorized";
			// Similar to 403 Forbidden, but specifically for use when authentication is possible but has failed or not yet been provided.[2] The response must include a WWW-Authenticate header field containing a challenge applicable to the requested resource. See Basic access authentication and Digest access authentication.
			break;
			case 402:
				$sMessage = "Payment Required";
			// Reserved for future use.[2] The original intention was that this code might be used as part of some form of digital cash or micropayment scheme, but that has not happened, and this code is not usually used. As an example of its use, however, Apple's MobileMe service generates a 402 error ("httpStatusCode:402" in the Mac OS X Console log) if the MobileMe account is delinquent.
			break;
			case 403:
				$sMessage = "Forbidden";
			// The request was a legal request, but the server is refusing to respond to it.[2] Unlike a 401 Unauthorized response, authenticating will make no difference.[2]
			break;
			case 404:
				$sMessage = "Not Found";
			// The requested resource could not be found but may be available again in the future.[2] Subsequent requests by the client are permissible.
			break;
			case 405:
				$sMessage = "Method Not Allowed";
			// A request was made of a resource using a request method not supported by that resource;[2] for example, using GET on a form which requires data to be presented via POST, or using PUT on a read-only resource.
			break;
			case 406:
				$sMessage = "Not Acceptable";
			// The requested resource is only capable of generating content not acceptable according to the Accept headers sent in the request.[2]
			break;
			case 407:
				$sMessage = "Proxy Authentication Required";
			break;
			case 408:
				$sMessage = "Request Timeout";
			// The server timed out waiting for the request.[2] According to W3 HTTP specifications: "The client did not produce a request within the time that the server was prepared to wait. The client MAY repeat the request without modifications at any later time."
			break;
			case 409:
				$sMessage = "Conflict";
			// Indicates that the request could not be processed because of conflict in the request, such as an edit conflict.[2]
			break;
			case 410:
				$sMessage = "Gone";
			// Indicates that the resource requested is no longer available and will not be available again.[2] This should be used when a resource has been intentionally removed; however, it is not necessary to return this code and a 404 Not Found can be issued instead. Upon receiving a 410 status code, the client should not request the resource again in the future. Clients such as search engines should remove the resource from their indexes.
			break;
			case 411:
				$sMessage = "Length Required";
			// The request did not specify the length of its content, which is required by the requested resource.[2]
			break;
			case 412:
				$sMessage = "Precondition Failed";
			// The server does not meet one of the preconditions that the requester put on the request.[2]
			break;
			case 413:
				$sMessage = "Request Entity Too Large";
			// The request is larger than the server is willing or able to process.[2]
			break;
			case 414:
				$sMessage = "Request-URI Too Long";
			// The URI provided was too long for the server to process.[2]
			break;
			case 415:
				$sMessage = "Unsupported Media Type";
			// The request did not specify any media types that the server or resource supports.[2] For example the client specified that an image resource should be served as image/svg+xml, but the server cannot find a matching version of the image.
			break;
			case 416:
				$sMessage = "Requested Range Not Satisfiable";
			// The client has asked for a portion of the file, but the server cannot supply that portion.[2] For example, if the client asked for a part of the file that lies beyond the end of the file.
			break;
			case 417:
				$sMessage = "Expectation Failed";
			// The server cannot meet the requirements of the Expect request-header field.[2]
			break;
			case 418:
				$sMessage = "I'm a teapot";
			// The HTCPCP server is a teapot.[7] The responding entity MAY be short and stout.[7] This code was defined as one of the traditional IETF April Fools' jokes, in RFC 2324, Hyper Text Coffee Pot Control Protocol, and is not expected to be implemented by actual HTTP servers.
			break;
			case 422:
				$sMessage = "Unprocessable Entity";
			// The request was well-formed but was unable to be followed due to semantic errors.[4]
			break;
			case 423:
				$sMessage = "Locked";
			// The resource that is being accessed is locked[4]
			break;
			case 424:
				$sMessage = "Failed Dependency";
			// The request failed due to failure of a previous request (e.g. a PROPPATCH).[4]
			break;
			case 425:
				$sMessage = "Unordered Collection";
			// Defined in drafts of "WebDAV Advanced Collections Protocol",[8] but not present in "Web Distributed Authoring and Versioning (WebDAV) Ordered Collections Protocol".[9]
			break;
			case 426:
				$sMessage = "Upgrade Required";
			// The client should switch to a different protocol such as TLS/1.0.[10]
			break;
			case 449:
				$sMessage = "Retry With";
			// A Microsoft extension. The request should be retried after doing the appropriate action.[11]
			break;
			case 450:
				$sMessage = "Blocked by Windows Parental Controls";
			// A Microsoft extension. This error is given when Windows Parental Controls are turned on and are blocking access to the given webpage.[12]

			// 5xx Server Error
			// 
			// The server failed to fulfill an apparently valid request.[2]
			// Response status codes beginning with the digit "5" indicate cases in which the server is aware that it has encountered an error or is otherwise incapable of performing the request. Except when responding to a HEAD request, the server should include an entity containing an explanation of the error situation, and indicate whether it is a temporary or permanent condition. Likewise, user agents should display any included entity to the user. These response codes are applicable to any request method.
			break;
			case 500:
				$sMessage = "Internal Server Error";
			// A generic error message, given when no more specific message is suitable.[2]
			break;
			case 501:
				$sMessage = "Not Implemented";
			// The server either does not recognise the request method, or it lacks the ability to fulfill the request.[2]
			break;
			case 502:
				$sMessage = "Bad Gateway";
			// The server was acting as a gateway or proxy and received an invalid response from the upstream server.[2]
			break;
			case 503:
				$sMessage = "Service Unavailable";
			// The server is currently unavailable (because it is overloaded or down for maintenance).[2] Generally, this is a temporary state.
			break;
			case 504:
				$sMessage = "Gateway Timeout";
			// The server was acting as a gateway or proxy and did not receive a timely request from the upstream server.[2]
			break;
			case 505:
				$sMessage = "HTTP Version Not Supported";
			// The server does not support the HTTP protocol version used in the request.[2]
			break;
			case 506:
				$sMessage = "Variant Also Negotiates";
			// Transparent content negotiation for the request, results in a circular reference.[13]
			break;
			case 507:
				$sMessage = "Insufficient Storage";
			break;
			case 509:
				$sMessage = "Bandwidth Limit Exceeded";
			// This status code, while used by many servers, is not specified in any RFCs.
			break;
			case 510:
				$sMessage = "Not Extended";
			// Further extensions to the request are required for the server to fulfill it.[14]
			break;
		}
		
		return $sMessage;
	}
}


/**
 *
 */
class NHTTPMethods
{
	/**
	 *
	 */
	const iPost = 0;


	/**
	 *
	 */
	const iGet = 1;


	/**
	 *
	 */
	const iDelete = 2;


	/**
	 *
	 */
	const iPut = 3;
}


/**
 *	Class Implementation of CURL
 */
class CHTTPCurl
{
	/**
	 *
	 */
	protected $_ch;
	

	/**
	 *
	 */
	private $_sURL;
	
	
	/**
	 *
	 */
	private $_ciHTTPMethod;


	/**
	 *
	 */
	private $_sPost;


	/**
	 *
	 */
	private $_aHTTPHeaders;
	
	
	/**
	 *
	 */
	public function __construct($sURL, $ciHTTPMethod = NHTTPMethods::iGet)
	{
		$this->_ch = curl_init();
		
		$this->_sURL = $sURL;
		$this->_ciHTTPMethod = $ciHTTPMethod;
		$this->_sPost = "";
		$this->_aHTTPHeaders = array();
	}


	/**
	 *
	 */
	public function __destruct()
	{
		//closing the curl
		curl_close($this->_ch);
	}
	

	/**
	 *
	 */
	protected function _readHeader($_ch, $sHeader)
	{
		//echo $sHeader;
	}
	

	/**
	 *
	 */
	public function GetURL()
	{
		return $this->_sURL;
	}
	
	
	/**
	 *
	 */
	public function AddHeader($sHeader)
	{
		$this->_aHTTPHeaders[] = $sHeader;
	}


	/**
	 *
	 */
	public function PrepareOptions()
	{
		curl_setopt($this->_ch, CURLOPT_URL, $this->_sURL);
		curl_setopt($this->_ch, CURLOPT_RETURNTRANSFER, 1);
		
		switch ($this->_ciHTTPMethod)
		{
			case NHTTPMethods::iGet:
				//	default curl request is get
				//curl_setopt($this->_ch, CURLOPT_HTTPGET , true);
			break;
			case NHTTPMethods::iPost:
				curl_setopt($this->_ch, CURLOPT_POST, true);
			break;
			case NHTTPMethods::iDelete:
				curl_setopt($this->_ch, CURLOPT_CUSTOMREQUEST, "DELETE");
			break;
			case NHTTPMethods::iPut:
				curl_setopt($this->_ch, CURLOPT_PUT, true);
			break;
		}
		
		curl_setopt($this->_ch, CURLOPT_HTTPHEADER, $this->_aHTTPHeaders);
		
		if (strlen($this->_sPost))
			curl_setopt($this->_ch, CURLOPT_POSTFIELDS, $this->_sPost);
	}
	

	/**
	 *
	 */
	public function SetPostString($sPost)
	{
		$this->_sPost = $sPost;
	}


	/**
	 *
	 */
	public function GetPostString()
	{
		return $this->_sPost;
	}
	

	/**
	 *
	 */
	public function Execute()
	{
		//getting response from server
		$sResponse = curl_exec($this->_ch);
		
		$iHTTPResponse = curl_getinfo($this->_ch, CURLINFO_HTTP_CODE);
		
		switch ($iHTTPResponse)
		{
			case 200:
			case 201:
			case 202:
				return $sResponse;
			break;
			default:
				throw new HTTPException($iHTTPResponse);
		}
	}
}


?>
