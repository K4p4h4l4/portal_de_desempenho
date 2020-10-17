<?php

//require("conexao.php");

Class UserInfo{
    
    public static function get_user_agent() {
		return  $_SERVER['HTTP_USER_AGENT'];
	}
    
	public static function get_ip() {
		$mainIp = '';
		if (getenv('HTTP_CLIENT_IP'))
			$mainIp = getenv('HTTP_CLIENT_IP');
		else if(getenv('HTTP_X_FORWARDED_FOR'))
			$mainIp = getenv('HTTP_X_FORWARDED_FOR');
		else if(getenv('HTTP_X_FORWARDED'))
			$mainIp = getenv('HTTP_X_FORWARDED');
		else if(getenv('HTTP_FORWARDED_FOR'))
			$mainIp = getenv('HTTP_FORWARDED_FOR');
		else if(getenv('HTTP_FORWARDED'))
			$mainIp = getenv('HTTP_FORWARDED');
		else if(getenv('REMOTE_ADDR'))
			$mainIp = getenv('REMOTE_ADDR');
		else
			$mainIp = 'UNKNOWN';
		return $mainIp;
	}
    
	public static function get_os() {
		$user_agent = self::get_user_agent();
		$os_platform    =   "Unknown OS Platform";
		$os_array       =   array(
			'/windows nt 10/i'     	=>  'Windows 10',
			'/windows nt 6.3/i'     =>  'Windows 8.1',
			'/windows nt 6.2/i'     =>  'Windows 8',
			'/windows nt 6.1/i'     =>  'Windows 7',
			'/windows nt 6.0/i'     =>  'Windows Vista',
			'/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
			'/windows nt 5.1/i'     =>  'Windows XP',
			'/windows xp/i'         =>  'Windows XP',
			'/windows nt 5.0/i'     =>  'Windows 2000',
			'/windows me/i'         =>  'Windows ME',
			'/win98/i'              =>  'Windows 98',
			'/win95/i'              =>  'Windows 95',
			'/win16/i'              =>  'Windows 3.11',
			'/macintosh|mac os x/i' =>  'Mac OS X',
			'/mac_powerpc/i'        =>  'Mac OS 9',
			'/linux/i'              =>  'Linux',
			'/ubuntu/i'             =>  'Ubuntu',
			'/iphone/i'             =>  'iPhone',
			'/ipod/i'               =>  'iPod',
			'/ipad/i'               =>  'iPad',
			'/android/i'            =>  'Android',
			'/blackberry/i'         =>  'BlackBerry',
			'/webos/i'              =>  'Mobile'
		);
		foreach ($os_array as $regex => $value) {
			if (preg_match($regex, $user_agent)) {
				$os_platform    =   $value;
			}
		}   
		return $os_platform;
	}
    
	public static function  get_browser() {
		$user_agent= self::get_user_agent();
		$browser        =   "Unknown Browser";
		$browser_array  =   array(
			'/msie/i'       =>  'Internet Explorer',
			'/Trident/i'    =>  'Internet Explorer',
			'/firefox/i'    =>  'Firefox',
			'/safari/i'     =>  'Safari',
			'/chrome/i'     =>  'Chrome',
			'/edge/i'       =>  'Edge',
			'/opera/i'      =>  'Opera',
			'/netscape/i'   =>  'Netscape',
			'/maxthon/i'    =>  'Maxthon',
			'/konqueror/i'  =>  'Konqueror',
			'/ubrowser/i'   =>  'UC Browser',
			'/mobile/i'     =>  'Handheld Browser'
		);
		foreach ($browser_array as $regex => $value) {
			if (preg_match($regex, $user_agent)) {
				$browser    =   $value;
			}
		}
		return $browser;
	}
    
	public static function  get_device(){
		$tablet_browser = 0;
		$mobile_browser = 0;
		if (preg_match('/(tablet|ipad|playbook)|(android(?!.*(mobi|opera mini)))/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
			$tablet_browser++;
		}
		if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android|iemobile)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
			$mobile_browser++;
		}
		if ((strpos(strtolower($_SERVER['HTTP_ACCEPT']),'application/vnd.wap.xhtml+xml') > 0) or ((isset($_SERVER['HTTP_X_WAP_PROFILE']) or isset($_SERVER['HTTP_PROFILE'])))) {
			$mobile_browser++;
		}
		$mobile_ua = strtolower(substr(self::get_user_agent(), 0, 4));
		$mobile_agents = array(
			'w3c ','acs-','alav','alca','amoi','audi','avan','benq','bird','blac',
			'blaz','brew','cell','cldc','cmd-','dang','doco','eric','hipt','inno',
			'ipaq','java','jigs','kddi','keji','leno','lg-c','lg-d','lg-g','lge-',
			'maui','maxo','midp','mits','mmef','mobi','mot-','moto','mwbp','nec-',
			'newt','noki','palm','pana','pant','phil','play','port','prox',
			'qwap','sage','sams','sany','sch-','sec-','send','seri','sgh-','shar',
			'sie-','siem','smal','smar','sony','sph-','symb','t-mo','teli','tim-',
			'tosh','tsm-','upg1','upsi','vk-v','voda','wap-','wapa','wapi','wapp',
			'wapr','webc','winw','winw','xda ','xda-');
		if (in_array($mobile_ua,$mobile_agents)) {
			$mobile_browser++;
		}
		if (strpos(strtolower(self::get_user_agent()),'opera mini') > 0) {
			$mobile_browser++;
	            //Check for tablets on opera mini alternative headers
			$stock_ua = strtolower(isset($_SERVER['HTTP_X_OPERAMINI_PHONE_UA'])?$_SERVER['HTTP_X_OPERAMINI_PHONE_UA']:(isset($_SERVER['HTTP_DEVICE_STOCK_UA'])?$_SERVER['HTTP_DEVICE_STOCK_UA']:''));
			if (preg_match('/(tablet|ipad|playbook)|(android(?!.*mobile))/i', $stock_ua)) {
				$tablet_browser++;
			}
		}
		if ($tablet_browser > 0) {
	           // do something for tablet devices
			return 'Tablet';
		}
		else if ($mobile_browser > 0) {
	           // do something for mobile devices
			return 'Mobile';
		}
		else {
	           // do something for everything else
			return 'Computer';
		}   
	}
    
    public static function get_page(){
        /*$uri = (isset($_SERVER['HTTPS']) ? "https":"http")."://".$_SERVER['HTTP_HOST']."".$_SERVER['REQUEST_URI']."";*/
        $uri = (isset($_SERVER['HTTPS']) ? "https":"http").":/".$_SERVER['REQUEST_URI']."";
        return $uri;
    }

}

$query = "";
$user_info = new UserInfo;
$user_agent = $user_info->get_user_agent();
$user_ip = $user_info->get_ip(); //41.63.170.74 , 80.88.6.71 , 40.67.254.36 , 105.172.5.13 , 13.107.42.14 , 209.85.202.188
$user_os = $user_info->get_os();
$user_browser = $user_info->get_browser();
$user_device = $user_info->get_device();
$user_date = date('d/m/Y');
$user_time = date('H:i:s');
$user_page = $user_info->get_page();

$ip_details = @json_decode(file_get_contents("http://ip-api.com/json/".$user_ip),true);
$query = "select * from tb_ips_visitantes where usr_ip='$user_ip'";
$result = mysqli_query($db, $query);
$row = mysqli_fetch_array($result);
$id = $row['id'];
if($row <= 0){
    $query = "insert into tb_ips_visitantes (id, usr_ip) values (null, '$user_ip')";
    mysqli_query($db, $query);
    $query = "select id from tb_ips_visitantes where urp_ip='$user_ip'";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_array($result);
    $id = $row['id'];
    
    if($ip_details && $ip_details['status'] == 'success'){
        $user_country = $ip_details['country'];
        $user_countryCode = $ip_details['countryCode'];
        $user_region = $ip_details['regionName'];
        $user_city = $ip_details['city'];
        $user_lat = $ip_details['lat'];
        $user_lon = $ip_details['lon'];
        $user_timezone = $ip_details['timezone'];
        $user_isp = $ip_details['isp'];
        $user_org = $ip_details['org'];
        $user_as = $ip_details['as'];

        $query = "insert into tb_historico_visitantes (id, visitante_id, usr_agente, usr_so, usr_navegador, usr_dispositivo, usr_pais, usr_pais_codigo, usr_regiao, usr_cidade, usr_latitude, usr_longitude, usr_timezone, usr_isp, usr_org, usr_as, usr_data, usr_hora, usr_page) values (null, '$id', '$user_agent', '$user_os', '$user_browser', '$user_device', '$user_country', '$user_countryCode', '$user_region', '$user_city', '$user_lat', '$user_lon', '$user_timezone', '$user_isp', '$user_org', '$user_as', '$user_date', '$user_time', '$user_page')";  mysqli_query($db, $query);
    }else{

        $query = "insert into tb_historico_visitantes (id, visitante_id, usr_agente, usr_ip, usr_so, usr_navegador, usr_dispositivo, usr_data, usr_hora, usr_page) values (null, '$id', '$user_agent', '$user_ip', '$user_os', '$user_browser', '$user_device', '$user_date', '$user_time', '$user_page')";
        mysqli_query($db, $query);
    }
}else if ($row >= 1){
    $query = "select * from tb_ips_visitantes where usr_ip='$user_ip'";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_array($result);
    $id = $row['id'];
    
    if($ip_details && $ip_details['status'] == 'success'){
        $user_country = $ip_details['country'];
        $user_countryCode = $ip_details['countryCode'];
        $user_region = $ip_details['regionName'];
        $user_city = $ip_details['city'];
        $user_lat = $ip_details['lat'];
        $user_lon = $ip_details['lon'];
        $user_timezone = $ip_details['timezone'];
        $user_isp = $ip_details['isp'];
        $user_org = $ip_details['org'];
        $user_as = $ip_details['as'];

        $query = "insert into tb_historico_visitantes (id, visitante_id, usr_agente, usr_so, usr_navegador, usr_dispositivo, usr_pais, usr_pais_codigo, usr_regiao, usr_cidade, usr_latitude, usr_longitude, usr_timezone, usr_isp, usr_org, usr_as, usr_data, usr_hora, usr_page) values (null, '$id', '$user_agent', '$user_os', '$user_browser', '$user_device', '$user_country', '$user_countryCode', '$user_region', '$user_city', '$user_lat', '$user_lon', '$user_timezone', '$user_isp', '$user_org', '$user_as', '$user_date', '$user_time', '$user_page')";  mysqli_query($db, $query);
    }else{
        
        $query = "insert into tb_historico_visitantes (id, visitante_id, usr_agente, usr_so, usr_navegador, usr_dispositivo, usr_data, usr_hora, usr_page) values (null, '$id', '$user_agent', '$user_os', '$user_browser', '$user_device', '$user_date', '$user_time', '$user_page')";
        mysqli_query($db, $query);
    }   
}

?>