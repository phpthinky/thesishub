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
		$this->load->model('user_model');
		$this->load->model('file_m');
		$this->load->library('excel');
		//$this->load->library('Aauth');
        if (!$this->aauth->is_loggedin()){
        	redirect();
        }
        if($this->session->userdata['permit'] == 'students'){
        	redirect();
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

        $attempts = $this->aauth->get_login_attempts(10);

        $att = '<table class="table table-bordered"><tbody>';
        if (is_array($attempts)) {
        	# code...
        	foreach ($attempts as $key) {
        		# code...

        	$att .= "<tr  id='tr-$key->id'><td>$key->ip_address</td><td>$key->login_attempts</td><td><a class='btn' style='margin:0;padding:1px;' onclick='unblocked($key->id)'>Unblocked</a></td></tr>";
        	}
        }
        $att .= '</tbody></table>';



        $download = $this->file_m->random_downloaded(10);


        $dl = '<table class="table table-bordered"><tbody>';
        if (is_array($download)) {
        	# code...
        	foreach ($download as $key) {
        		# code...

        	$dl .= "<tr  id='tr-$key->post_id'><td>$key->title</td><td>$key->visita</td><td class='hidden'><a class='btn' style='margin:0;padding:1px;'><i class='fa fa-eye'></i></a></td></tr>";
        	}
        }
        $dl .= '</tbody></table>';



        //$upload = $this->file_m->random_downloaded(20);

		$upload = $this->file_m->latest_file(false,10);

        $up = '<table class="table table-bordered"><tbody>';
        
        if (is_array($upload)) {
        	# code...
        	foreach ($upload as $key) {
        		# code...

        	$up .= "<tr  id='tr-$key->page_id'><td>$key->title</td><td class='hidden'><a class='btn' style='margin:0;padding:1px;'><i class='fa fa-eye'></i></a></a></td></tr>";
        	}
        }

        
        $up .= '</tbody></table>';




        






		$content = "
		<div class='col-sm-12 col-md-12 col-lg-12'>
		<div class='col-md-4'><p class='alert alert-info'><a href='#' class='btn'>Recently View</a></p><p>$dl</p></div>
		<div class='col-md-4'><p class='alert alert-info'><a href='#' class='btn'>Recent post</a></p><p>$up</p></div>
		<div class='col-md-4'><p class='alert alert-info'><a href='#' class='btn'>Login attempt</a></p><p>$att</p></div>
		<div class='divider divider-line'></div>
		</div>


		<div class='col-sm-12 col-md-12 col-lg-12 hidden'>
		<div class='col-md-4'><p class='alert alert-warning'><a href='#' class='btn'>Recent added user</a></p><p>-</p></div>
		<div class='col-md-4'><p class='alert alert-warning'><a href='#' class='btn'>Recents logon user</a></p><p>-</p></div>
		<div class='col-md-4'><p class='alert alert-warning'><a href='#' class='btn'>Recent activity</a></p><p>-</p></div>
		<div class='divider divider-line'></div>
		</div>

		";
		$this->load->model('setting_m');

		$data['guide'] = $this->setting_m->get_all_setting(5);

		$data['content'] = $content;//.$searchresult;
		$data['subtitle']= "Welcome ".$this->session->username;
		$data['title']= "Administration";
		$data['username']= $this->session->username;


		$this->load->view('admin/default/header',$data);
		$this->load->view('admin/default/menu',$data);
		$this->load->view('admin/contents',$data);
		$this->load->view('admin/default/footer',$data);
	}
	public function unblocked($id='')
	{
		# code...
		if ($this->input->post()) {
			# code...
			$id = $this->input->post('id');
			/*	echo json_encode(array('stats'=>false,'msg'=>$ip));
exit();*/
			//if(
				$reset = $this->aauth->reset_login_attempts($id);//){
				echo json_encode(array('stats'=>true));
			//}
				//echo json_encode(array('stats'=>false));
		}
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
