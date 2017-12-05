<?php 
defined('BASEPATH') or exit('Not allowed');

/**
* 
*/
class Test extends CI_Controller
{
	
	function __construct()
	{
		# code...
		parent::__construct();
		$this->load->library('pagecounter');
		$this->load->library('session');
		$this->load->library('minify');
	}
	public function index()
	{

 		//setcookie('page',"");exit();
		/*
		$this->pagecounter->run_counter('page');
		if(isset($_COOKIE['page']))
		print_r($_COOKIE['page']);
	
	

		$browser =  $this->pagecounter->getBrowser($this->pagecounter->get_agent());
		echo $browser;

		*/
		$this->pagecounter->run_counter('page');
		//var_dump($_COOKIE['page']);
		//$this->pagecounter->cron_counter();
		//echo $this->pagecounter->get_pageUrl();

		//var_dump($_COOKIE['page']);
		//exit();
		//var_dump($this->cookie->page);
		$this->load->view('admin/common/header2');
		//echo count($this->session->page);



	/*
		# code...
		//$this->pagecounter->unset_session_page('page');

		$userip =$this->pagecounter->get_ip();
		$url =  $this->pagecounter->get_pageUrl();
		$agent = $this->pagecounter->get_agent();

		$machine =  $this->pagecounter->getOS($agent);
		$browser =  $this->pagecounter->getBrowser($agent);

		$page_id = $this->pagecounter->get_page_id($url);
		


		if(!$this->pagecounter->check_bots($agent)){
			//$agent = 'Safe list';
			//Store visit to database
				if(!$this->pagecounter->set_session_page('page',$url)){

					$result = $this->pagecounter->add_to_db($url,$page_id,date('Y-m-d'),$machine,$browser,$userip);
					var_dump($result);

				}

		}else{
			//Visitor is a robot/spam/spider/worm
			}

		*/
	}
	public function hello($value='')
	{
		# code...
		//setcookie('page','');
		$this->pagecounter->run_counter('page');
		//$this->pagecounter->cron_counter();
		echo $this->pagecounter->get_pageUrl();

		var_dump($_COOKIE['page']);
		exit();
	}
}