<?php 
/*
GeoIP Country Flags for Vanilla Forums
By: vbgamer45, gingerbeardman
http://wwww.vanillaforfree.com

*/
if (!defined('APPLICATION')) 
	exit();

$PluginInfo['GeoIPFlags'] = array(
	'Name' => 'GeoIPFlags',
	'Description' => 'Adds a column in Dashboard/Users with the GeoIP country flag for the Last IP Address of each user.',
	'Version' => '1.1',
	'Date' => 'July 19, 2012',
	'Author' => 'vbgamer45, gingerbeardman',
	'AuthorEmail' => 'vbgamer45@gmail.com',
	'AuthorUrl' => 'http://www.vanillaforfree.com',
	'RequiredApplications' => array(
		'Dashboard' => '>=2.1'
	)
);


class GeoIPFlags implements Gdn_IPlugin 
{
	

	public function UserController_UserCell_Handler($Sender) 
	{
		if (empty($Sender->EventArgs['User']->Name))
			echo '<th>GeoIP Country</th>';
		else 
		{
			include_once(dirname(__FILE__) . "/extras/geoip.php");
			$gi = geoip_open(dirname(__FILE__) . "/extras/GeoIP.dat", GEOIP_MEMORY_CACHE);

			$countrycode = geoip_country_code_by_addr($gi, $Sender->EventArgs['User']->LastIPAddress);
			if (!$countrycode) $countrycode = 'none';
			geoip_close($gi);
				
			echo '<td><img src="/plugins/GeoIPFlags/flags/' . strtolower($countrycode) . '.png" alt="' . $countrycode . '" /></td>';
		}
		
	}

	
	public function Setup() 
	{
		
	}
}