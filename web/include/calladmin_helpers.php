<?php
/**
 * -----------------------------------------------------
 * File        calladmin_helpers.php
 * Authors     Impact, David <popoklopsi> Ordnung
 * License     GPLv3
 * Web         http://gugyclan.eu, http://popoklopsi.de
 * -----------------------------------------------------
 * 
 * CallAdmin
 * Copyright (C) 2013 Impact, David <popoklopsi> Ordnung
 * 
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>
 */
 
class CallAdmin_Helpers
{
	/**
	 * Quotes chars for use in xml
	 * 
	 * @var       string
	 * @return    string
	 */
	public function _xmlentities($input)
	{
		return str_replace(array("&", "<", ">", "\"", "'"), array("&amp;", "&lt;", "&gt;", "&quot;", "&apos;"), $input);
	}


	
	/**
	 * Returns if an steamid is valid
	 * 
	 * @var       string
	 * @return    bool
	 */
	public function IsValidSteamID($steamID)
	{
		return preg_match("/^STEAM_[0-1]:[0-1]:[0-9]{3,11}+$/", $steamID);
	}
	
	
	
	
	/**
	 * Converts an steamid to an friendid
	 * 
	 * @var       string
	 * @return    string
	 */
	function SteamIDToComm($steamId)
	{
		//Example SteamID: "STEAM_X:Y:ZZZZZZZZ"
		$gameType   = 0; //This is X.  It's either 0 or 1 depending on which game you are playing (CSS, L4D, TF2, etc)
		$authServer = 0; //This is Y.  Some people have a 0, some people have a 1
		$clientId   = ''; //This is ZZZZZZZZ.

		//Remove the "STEAM_"
		$steamId = str_replace('STEAM_', '' ,$steamId);

		//Split steamId into parts
		$parts      = explode(':', $steamId);
		$gameType   = $parts[0];
		$authServer = $parts[1];
		$clientId   = $parts[2];

		//Calculate friendId
		$result = bcadd((bcadd('76561197960265728', $authServer)), (bcmul($clientId, '2')));
		return $result;
	}
	
	

	
	/**
	 * Converts the last token pair of an ip to 0
	 * 
	 * @var       int
	 * @return    string
	 */
	public function AnonymizeIP($ip)
	{
		return preg_replace("/[0-9]{1,3}+\z/", '0', $ip);
	}


	
	/**
	 * Prints an xmlerror and dies
	 * 
	 * @var    string
	 * @var    string
	 * @noreturn
	 */
	public function printXmlError($error, $tag)
	{
		if(!headers_sent())
		{
			header("Content-type: text/xml; charset=utf-8"); 
		}

		$xml = new SimpleXMLElement("<$tag/>");

		$xml->addChild("error", $error);
		echo $xml->asXML();
		exit;
	}
}
// End of file
