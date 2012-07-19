<?php 
if (!defined('APPLICATION')) 
	exit();

$PluginInfo['WorldFlags'] = array(
	'Name' => 'World Flags',
	'Description' => 'Adds a column in Dashboard/Users with a country flag displaying the location of the Last IP Address for each user.',
	'Version' => '1.0',
	'Date' => 'July 19, 2012',
	'Author' 	=>	 "Matt Sephton",
	'AuthorEmail' => 'matt@gingerbeardman.com',
	'AuthorUrl' =>	 'http://www.gingerbeardman.com',
	'License' => 'GPL v2',
	'RequiredApplications' => array(
		'Dashboard' => '>=2.1'
	)
);


class WorldFlags implements Gdn_IPlugin 
{

	public function Base_Render_Before($Sender) {
		$this->_WorldFlagsSetup($Sender);
	}
	
	private function _WorldFlagsSetup($Sender) {
		$Sender->AddCssFile('flags.css', 'plugins/WorldFlags');
	}
	
	public function UserController_UserCell_Handler($Sender) 
	{
		if (empty($Sender->EventArgs['User']->Name))
			echo '<th>Location</th>';
		else 
		{
			$extraspath = dirname(__FILE__).'/extras/';
			$ip = $Sender->EventArgs['User']->LastIPAddress;

			include_once($extraspath."geoipcity.inc");
			include_once($extraspath."geoipregionvars.php"); 

			$gi = geoip_open($extraspath."GeoLiteCity.dat", GEOIP_MEMORY_CACHE);
			$record = geoip_record_by_addr($gi, $ip);
			geoip_close($gi);

			$countrycode = strtolower($record->country_code);
			if (!$countrycode) {
				$countrycode = 'none';
				$title = '';
			} else {
				$countryname = $record->country_name;
				$cityname = utf8_decode($record->city);
				$title =  "$countryname, $cityname";
			}

			echo <<< FLAG
				<td>
					<div class="flag flag-$countrycode" title="$title">
						<span>$title</span>
					</div>
				</td>
FLAG;
		}
		
	}

	public function Setup() {
		return TRUE;
	}
}