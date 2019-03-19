<?php 

defined('BASEPATH') OR exit('No direct script access allowed');


class Pagecounter_old {
	private $domain  = 'myapp.ci';
	public function __construct()
	{
		# code...
	        $this->ci =& get_instance();
	        $this->ci->load->database();
	        $this->ci->load->helper('cookie');
	}
	public function addpageurl($value='')
	{
		# code...
		return "Added";
	}
	public function pagesoncounter($value='')
	{
		# code...
		if($value !== ''){
			return $this->ci->db->select('*')->get('page_visits')->where('page_id',$value)->result();
		}
		$sql = "SELECT page_id, page, sum(count) as count from page_visits group by page";
		$result = $this->ci->db->query($sql)->result();
		return $result;
		//return $this->ci->db->select('*')->get('page_visits')->result();
		//return "List of all pages";
	}
	
	public function run_counter($item)
	{
		# code...

		$userip =$this->get_ip();

		$url =  $this->get_pageUrl();
		$agent = $this->get_agent();

		$machine =  $this->getOS($agent);
		$browser =  $this->getBrowser($agent);

		$page_id = $this->get_page_id($url);
		
		$status = $this->set_cookieArray($item,$this->encrypt_md($url));

		//var_dump($this->encrypt_md($url));
		if($status == false) {

			// code for add to db
			
			if(!$this->check_bots($agent)){

				//Store visit to database
				$result = $this->add_to_db($url,$page_id,date('Y-m-d'),$machine,$browser,$userip);
				if($result == true){
				return true;				
				}else{
				return false;
				}

					

			}

		}




	}
	public function add_to_db($page='',$page_id='',$date='',$machine='',$browser='',$userip='')
	  {
	  	# code...
		  	$now = date('Y-m-d');
		  	$year = date('Y');
		  	$day = date('d');
		  	$tday = date('D');
		  	$month = date('m');


		  	$checkresult = $this->check_on_db($userip,$page);
		  	//var_dump($checkresult);exit();
		  	if($checkresult == false){
		  		$data = array(
		        'userip' => $userip,
		        'page' => htmlentities($page),
		        'page_id' => $page_id,
		        'counter' => 1,
		        'complete_date' => $now,
		        'machine'=>$machine,
		        'browser'=>$browser,
		        'year'=>$year,
		        'month'=>$month,
		        'day'=>$day,
		        'tday'=>$tday,
			);

		  	//return $data;
		  	return $this->ci->db->insert('pageview',$data);
		  	}
		  	else{

		  		$this->update_counter($userip,$page,$browser);
		  	}
		  	$this->ci->db->reset_query();
		  	

	}
	public function session_time_out($value='')
	{
		# code...
		if (!isset($_SESSION['CREATED'])) {
		    $_SESSION['CREATED'] = time();
		} else if (time() - $_SESSION['CREATED'] > 1800) {
		    // session started more than 30 minutes ago
		    session_regenerate_id(true);    // change session ID for the current session and invalidate old session ID
		    $_SESSION['CREATED'] = time();  // update creation time
		}
	}

	public function check_on_db($userip='',$page='')
	{
		# code...
		$array = sprintf("page = '%s' AND userip = '%s' ",$page,$userip);
		//var_dump($array);
 		$this->ci->db->select('*');
 		$result = $this->ci->db->get_where('pageview',$array)->result();
 		//var_dump(count($result));
 		if(count($result) > 0){

 			return true;
 		}else{

 			return false;
 		}

	}
	public function update_counter($userip='',$page='',$browser)
	{
		# code...

		$array = sprintf("page = '%s' AND userip = '%s' ",$page,$userip);
		$this->ci->db->set('counter', 'counter+1', FALSE);
		$this->ci->db->set('last_used_browser', 'browser', FALSE);
		$this->ci->db->set('browser', $browser, true);
		$this->ci->db->where($array);
		return $this->ci->db->update('pageview');

	}
	public function cron_counter()
	{ 
		

		$time = date("h");
		if($time > 10 && $time < 12){
			$this->run_cron_job();
		}elseif ($time > 5 && $time < 7) {
			# code...
			$this->run_cron_job();
		}

	}
	public function run_cron_job()
		{
			# code...
		$this->ci->db->select('*');
		$result = $this->ci->db->get('pageview')->result();
		foreach ($result as $key) {
			$this->ci->db->select('sum(counter) as counter');
			$this->ci->db->where('page',$key->page);
			$this->ci->db->where('complete_date',$key->complete_date);
			$row = $this->ci->db->get('pageview')->result();
			$counter = $row[0]->counter;
			
			$this->update_pagevisit($key->page,$key->page_id,$counter, $key->complete_date,'');

			$this->del_on_pageview($key->page,$key->complete_date);
		}
		$this->ci->db->reset_query();

	}

	public function update_pagevisit($page='',$page_id=0,$counter = 0, $date = '',$country='')
	{
		# code...
		if($page != ''){
			$this->ci->db->select('*');
			$this->ci->db->where('page',$page);
			$this->ci->db->where('date_visited',$date);
			$result = count($this->ci->db->get('page_visits')->result());
			//var_dump($result);
			if($result > 0){
				$this->ci->db->set('count','count+'.$counter,false);
				$this->ci->db->where('page',$page);
				$this->ci->db->where('date_visited',$date);
				$this->ci->db->update('page_visits');

			}else{
				$array = array(
					'page' =>$page,
					'page_id' =>$page_id,
					'count' =>$counter,
					'date_visited' =>$date,
					'country'=>$country );
				$this->ci->db->set($array);
				$this->ci->db->insert('page_visits');
			}
			//09098867783/09274526969/09474785770
		}
		return;

	}
	public function del_on_pageview($page='',$date='')
	{
		# code...
		if($page != ''){
			$this->ci->db->where('page',$page);
			$this->ci->db->where('complete_date',$date);
			$this->ci->db->delete('pageview');
		}
		return;

	}
	public function visit_today($value='')
	{
		# code...
		$year = date('y');
		$month = date('m');
		$today = date('Y-m-d');
		$sql = sprintf("SELECT sum(count) as total from page_visits where page='%s' AND date_visited = '%s'  AND year(date_visited) = year(now())",$value,$today);
		// var_dump($sql);exit();
		$result = $this->ci->db->query($sql)->result();

		return isset($result[0]->total) ? $result[0]->total : 0;
	}
	public function visit_thisweek($value='')
	{
		# code...

		$year = date('y');
		$month = date('m');
		$today = date('Y-m-d');
		$sql = sprintf("SELECT sum(count) as total from page_visits where page='%s' AND week(date_sub(date_visited, interval + 7 day)) <= week(now()) AND week(date_visited) >= week(now()) AND year(date_visited) = year(now()) ",$value,$today,$today);
		// var_dump($sql);exit();
		$result = $this->ci->db->query($sql)->result();
		return isset($result[0]->total) ? $result[0]->total : 0;
	}
	public function visit_thismonth($value='')
	{
		# code...
		$year = date('y');
		$month = date('m');
		$sql = sprintf("SELECT sum(count) as total from page_visits where page='%s' AND month(date_visited) = month(now()) AND year(date_visited) = year(now()) ",$value);
		// var_dump($sql);exit();
		$result = $this->ci->db->query($sql)->result();
		return isset($result[0]->total) ? $result[0]->total : 0;
	}
	public function visit_thisyear($value='')
	{
		# code...
		$year = date('y');
		$month = date('m');
		$sql = sprintf("SELECT sum(count) as total from page_visits where page='%s' AND year(date_visited) = year(now()) ",$value);
		// var_dump($sql);exit();
		$result = $this->ci->db->query($sql)->result();
		return isset($result[0]->total) ? $result[0]->total : 0;
	}
	public function encrypt_md($value='')
	  {
	  	# code...
	  	$encrypted = md5($value);
	  	return $encrypted;
	}

  public function get_pageUrl()
  {
  	# code...

  	$session_page_url = $this->domain.$_SERVER['PHP_SELF'];
  	return $session_page_url;

  }
 public function set_cookieArray($item='', $value='')
 	{
 		# code...
        	$session = false;
        	delete_cookie($item);
        if (!isset($_COOKIE[$item])) {
        	$value  = array($value);
            setcookie($item, json_encode($value),strtotime( '+1 days' ));
            $session =  false;
        }
        else{
        	$cookie_page = stripcslashes($_COOKIE[$item]);
        	$cookie_page = json_decode($cookie_page);

        	foreach ($cookie_page as $key) {

	        	if($value == $key){
			
	        		$session = true;// "Session save.";   

	        	}
 				$array = array($key);
        	}
        	if($session == false){

			$addcookie = $this->add_cookieArray($item,$value,$array);
			//var_dump($_COOKIE[$item]);

        	}
        }
        
        	return $session; 

 	}
 	public function add_cookieArray($item='',$value='',$array='')
 	{
 		

        unset($_COOKIE[$item]);
        $array[] = $value;
        setcookie($item, json_encode($array),time() + 86400);
        var_dump($_COOKIE);

        
 	}
 public function unset_session_page($item='')
 	{
 		# code...
        if (isset($_SESSION[$item]))
            unset($_SESSION[$item]);

 	}
 	public function get_page_id($value='')
 	{
 		# code...
 		if ($this->ci->db->table_exists('pages') ){

 		$this->ci->db->select('page_id');
 		if($result = $this->ci->db->from('pages')->where('page_url',$value)->get()->result()){
 			return $result[0]->page_id;
 		}
 		return 0;
 		}
 		return 0;
 	}
 public function get_ip()
  {

  $user_ip=$_SERVER['REMOTE_ADDR'];
    return $user_ip;
  }
  public function get_agent()
  {
   $userAgent = $_SERVER['HTTP_USER_AGENT'];
   return $userAgent;
  }
  public function _bot_detected() {

  	return (
    isset($_SERVER['HTTP_USER_AGENT'])
    && preg_match('/bot|crawl|slurp|spider|mediapartners/i', $_SERVER['HTTP_USER_AGENT'])
  	);
	}
  public function check_bots($agent='')
	{
		# code...
	if (preg_match('/bot|crawl|curl|dataprovider|search|get|spider|find|java|majesticsEO|google|yahoo|teoma|contaxe|yandex|libwww-perl|facebookexternalhit/i', $agent)) {
    // is bot
		return true;
	}else {return false;}
	}
	public function white_bots($agent='')
	{
		# code...
	if (preg_match('/apple|baidu|bingbot|facebookexternalhit|googlebot|-google|ia_archiver|msnbot|naverbot|pingdom|seznambot|slurp|teoma|twitter|yandex|yeti/i', $agent)) {
    // allowed bot
		return true;
	} 
	}

	public function insert_to_file()
	{
		# code...
		$user_agent = strtolower($this->get_agent());
	if(!preg_match("/Googlebot|MJ12bot|yandexbot/i", $user_agent)){
    // if not meet the conditions then
    // do what you need

    // here open a file and write the user_agent down the file. You can check each day this file useragent.txt and know about new user_agents and put them in your condition of if clause
    if($user_agent!=""){
        $myfile = fopen("useragent.txt", "a") or die("Unable to open file useragent.txt!");
        fwrite($myfile, $user_agent);
        $user_agent = "\n";
        fwrite($myfile, $user_agent);
        fclose($myfile);
    }
	}
	}







//Get machine info

//$user_agent     =   $_SERVER['HTTP_USER_AGENT'];

function getOS($user_agent='') { 

   // global $user_agent;

    $os_platform    =   "Unknown OS Platform";

    $os_array       =   array(
                            '/windows nt 10/i'     =>  'Windows 10',
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

//Get browser info

function getBrowser($user_agent="") {

    //global $user_agent;

    $browser        =   "Unknown Browser";

    $browser_array  =   array(
                            '/msie/i'       =>  'Internet Explorer',
                            '/firefox/i'    =>  'Firefox',
                            '/safari/i'     =>  'Safari',
                            '/chrome/i'     =>  'Chrome',
                            '/edge/i'       =>  'Edge',
                            '/opera/i'      =>  'Opera',
                            '/netscape/i'   =>  'Netscape',
                            '/maxthon/i'    =>  'Maxthon',
                            '/konqueror/i'  =>  'Konqueror',
                            '/mobile/i'     =>  'Handheld Browser'
                        );

    foreach ($browser_array as $regex => $value) { 

        if (preg_match($regex, $user_agent)) {
            $browser    =   $value;
        }

    }

    return $browser;

}













	/********************end of class**********************************/
}