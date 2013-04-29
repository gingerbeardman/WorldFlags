<?php 
if (!defined('APPLICATION')) 
	exit();

$PluginInfo['WorldFlags'] = array(
	'Name' => 'World Flags',
	'Description' => 'Adds a column in Dashboard/Users with a country flag displaying the location of the Last IP Address for each user. Also adds a flag to the user profile page.',
	'Version' => '1.13',
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
	
	private function _GeoLiteCity($Sender, $UseLocation) {
		$extraspath = dirname(__FILE__).'/extras/';

		if ($UseLocation == 'DashboardUsers') $ip = $Sender->EventArgs['User']->LastIPAddress;
		if ($UseLocation == 'UserProfile') $ip = $Sender->User->LastIPAddress;

		include_once($extraspath."geoipcity.inc");
		include_once($extraspath."geoipregionvars.php"); 

		$gi = geoip_open($extraspath."GeoLiteCity.dat", GEOIP_MEMORY_CACHE);
		$record = geoip_record_by_addr($gi, $ip);
		// echo '<pre>';
		// print_r($record);
		// echo '</pre>';
		geoip_close($gi);

		$countrycode = strtolower($record->country_code);
		if (!$countrycode) {
			$countrycode = 'none';
			$title = '';
		} else {
			$country = htmlentities($record->country_name);
			$region = htmlentities($record->region);
			$metro = htmlentities($record->metro_code);
			
			$cityname = htmlentities($record->city);
			
			$specific = (strlen($cityname)) ? "$cityname" : "";
			if ($specific) $location = (strlen($metro)) ? " ($specific, $region)" : " ($specific)";
			$title = "$country$location";
		}
		
		return array($countrycode, $title);
	}
	
	public function UserInfoModule_OnBasicInfo_Handler($Sender) {
		list($countrycode, $title) = $this->_GeoLiteCity($Sender, 'UserProfile');
		
		if ($countrycode != 'none') {
			echo '<dt>Location</dt>';
			echo <<< USER
					<dd>
						<div class="flag flag-$countrycode" title="$title">
							<span>$title</span>
						</div>
					</dd>
USER;
		}
	}
	
	public function UserController_UserCell_Handler($Sender) {
		if (empty($Sender->EventArgs['User']->Name)) {
			echo '<th>Location</th>';
		} else {
			list($countrycode, $title) = $this->_GeoLiteCity($Sender, 'DashboardUsers');

			echo <<< DASH
				<td>
					<div class="flag flag-$countrycode" title="$title">
						<span>$title</span>
					</div>
				</td>
DASH;
		}
		
	}

	public function Setup() {
		return TRUE;
	}
}