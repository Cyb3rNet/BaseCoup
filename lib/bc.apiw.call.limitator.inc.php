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
 
 
class XBasecampLimitException extends Exception
{
	public function __construct($sMsg)
	{
		parent::__construct($sMsg);
	}
}


/**
 *	5 calls per 1 second max
 */
class CBasecampAPICallLimitator
{
	public static $_iCounter = 0;
	public static $_iStartTime = 0;
	public static $_iElapsedTime = 0;

	const iSeconds = BASECAMP_API_CALLS_WITHIN_SECONDS;
	
	public function __construct()
	{
		$iCallLimit = BASECAMP_API_CALL_LIMIT;
		$iNow = time();
		
		if (self::$_iStartTime == 0)
		{
			self::$_iStartTime = time();
		}
		else if
		(
			(
				$iNow - self::$_iStartTime < $iCallLimit
				&&
				self::$_iCounter >= $iCallLimit
			)
			||
			self::$_iCounter >= $iCallLimit
		)
		{
			throw new XBasecampLimitException("Exceeded limit requests (".$iCallLimit." per ".$iSeconds." seconds)");
		}
		else if ($iNow - self::$_iStartTime > self::iSeconds)
		{
			self::$_iCounter = 0;
			self::$_iStartTime = time();
		}

		self::$_iCounter++;
		self::$_iElapsedTime = $iNow - self::$_iStartTime;
	}
	
	public function GetCounter()
	{
		return self::$_iCounter;
	}
	
	public function GetElapsedTime()
	{
		return self::$_iElapsedTime;
	}
}

?>
