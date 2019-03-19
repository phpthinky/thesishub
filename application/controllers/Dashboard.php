<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class Dashboard extends CI_Controller
{
	public $uid = 0;
	
	function __construct()
	{
		# code...
		parent::__construct();
		$this->load->library('minify');
		$this->load->model('post_model');
		//$this->load->library('Aauth');
        if (!$this->aauth->is_loggedin()){
        	redirect();
        }elseif(!$this->aauth->is_allowed('staff',$this->uid)){
        	redirect('permission');
        }
	}
	public function update_user() {
       // $a = $this->aauth->update_user(6, "a@a.com", "12345", "tested");

       // print_r($a);
    }
	public function index()
	{
		# code...
		


       $user = $this->aauth->get_user();
       //$a = $this->aauth->update_user($user->id, $user->email, 'admin123', $user->username);

        $b = $this->aauth->get_perm_id($user->id);



		$content = "
		<div class='col-sm-12 col-md-12 col-lg-12'>
		<div class='col-sm-3 col-md-3 col-lg-3'>
			<div class='alert alert-warning'>Thesis : ".$this->post_model->get_total()."</div>
		</div>
		<div class='col-sm-3 col-md-3 col-lg-3'>
			<div class='alert alert-warning'>Visitors: ".$this->pagecounter->visit_total()."</div>
		</div>
		<div class='col-sm-3 col-md-3 col-lg-3'>
			<div class='alert alert-warning'>Messages: 0</div>
		</div>
		<div class='col-sm-3 col-md-3 col-lg-3'>
			<div class='alert alert-warning'>Comments: 0</div>
		</div>
		<div class='divider divider-line'></div>
		</div>

		";
		/*

		$ifsearch = '';
		if($this->uri->segment(3)){
		$ifsearch = $this->searche();
		}elseif ($this->uri->segment(2) === 'index') {
			# code...
		$ifsearch = $this->searche();
		}else{
			$this->session->tags = '';
		}

		$tags = isset($this->session->tags) ? $this->session->tags : '';
		*/
		//$searchbox = '<div class="col-md-12"><div class="alert alert-success"><form class="form" action="" method="post" id="frmsearch"><div class="form-inline"><input type="text" id="txtsearch" name="txtsearch" class="form-control" placeholder="Search here..." style="width:95%;" value="'.$tags.'"><button href="#" class="btn btn-default"><i class="fa fa-search"></i></button></div></form></div>';
		$searchbox = '<div class="col-md-12"><div class="alert alert-success"><form class="form" action="" method="post" id="frmsearch"><div class="form-inline"><input type="text" id="txtsearch" name="txtsearch" class="form-control" placeholder="Search here..." style="width:95%;"><button href="#" class="btn btn-default"><i class="fa fa-search"></i></button></div></form></div>';
	

		/*
		
		$searchresult = '<div id="searchoutput">'.$ifsearch.'</div></div>';
		*/
		//var_dump($this->session->tags);


		$data['content'] = $content.$searchbox;//.$searchresult;
		$data['subtitle']= "Welcome ".$this->session->username;
		$data['title']= "THESIS HUB";
		$data['username']= $this->session->username;


		$this->load->view('admin/default/header',$data);
		$this->load->view('admin/default/sidemenu',$data);
		$this->load->view('admin/contents',$data);
		$this->load->view('admin/default/footer',$data);
	}
	public function myaccount($value='')
	{
		# code...
		echo "My account";
	}

	public function profile($value='')
	{
		# code...
		echo "My account";
	}
	public function settings($value='')
	{
		# code...
		$this->load->view('admin/common/header2');
		$this->load->view('admin/common/menu2');
		$this->load->view('admin/blank.html');
		$this->load->view('admin/common/footer2');
	}



	public function searche($value='')
	{

		/**************************************************/


		if($this->input->post('txtsearch')){

		$tags = $this->input->post('txtsearch');
		$this->session->tags = $tags;

		}else{

  		$tags = $this->session->tags;

		}

        $q = trim($this->input->get('q'));

        $limit_per_page = 2;
       // $start = 0;

						if($this->uri->segment(3))
				            {
				                $page = $this->uri->segment(3);
				                //echo $page;
				            }else{
				            	$page = 0;
				            }


		/*****************************************************/
        //print_r(strlen($q));
        if(strlen($q)>0)
        {
            $config['enable_query_strings']=TRUE;
            //print($tags);

        }else{

            $config['enable_query_strings']=TRUE;
            //print($tags);


            	$result2 = $this->post_model->search($tags,$limit_per_page,$page);
            	if($result2 !== false){


						$content = '<table class="table">';
						$info2 = '';

						foreach ($result2 as $key) {

							$info = $this->post_model->get_content($key->page_id);
							$info2 .= "<tr><td><h3>$key->title</h3></td></tr>";

							
						}
						$content .= $info2.'<table>';
						//$data['searchresult'] = $content;

			            $total_row = $this->post_model->like_total($tags);
						$config['base_url'] = site_url() . '/dashboard/index';
			            $config['total_rows']=$total_row;
			            $config['per_page'] = $limit_per_page;
			            $config["uri_segment"] = 3;
             
			            $this->pagination->initialize($config);
			                 
			            $links = $this->pagination->create_links();

			            $content .= $links;
			            return $content;


            	}

        }
    

	}
}

       	/*$userinfo = "<div class='col-sm-12 col-md-12 col-lg-12><div class='alert alert-success'>";
        $userinfo .= "Last login:".$user->last_login;
       	$userinfo .= "</div><div>";*/
        /*
email rhoy012@gmail.com
pass 85331630fca2b67c234b6b57e7affc9403d62cf186989c71675956e3ccc2a20d
username runnerx
banned 0
last_login 2017-11-13 06:29:44
last_activity 2017-11-13 06:29:44
date_created 2017-11-12 21:30:00
forgot_exp
remember_time
remember_exp
verification_code
totp_secret
ip_address 127.0.0.1*/
