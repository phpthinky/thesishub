<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class Home extends CI_Controller
{
	public $uid = 0;
	
	function __construct()
	{
		# code...
		parent::__construct();

		$this->load->library('minify');
		$this->load->library('session');
		$this->load->library('pagecounter');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('cookie');
        $this->load->library("Aauth");
        $this->load->model("user_model");

		$this->uid = $this->session->userdata('id');

	}
	public function index($value='')
	{
		# code...
		if (preg_match('/MSIE\s(?P<v>\d+)/i', @$_SERVER['HTTP_USER_AGENT'], $B) && $B['v'] <= 8) {
    // Browsers IE 8 and below
			redirect('ie');
		} else {
		    // All other browsers
		    //echo "New supported browser";
			

			/*$this->load->library('captcha');
			$data['captcha'] = $this->captcha->main();
			$this->session->set_userdata('captcha_info', $data['captcha']);

			*/
			//$captcha = $this->aauth->generate_recaptcha_field();
			//var_dump($captcha);
		$data['title'] = 'Thesis Hub';
		$data['username'] = $this->session->username;
		$data['visits'] = $this->pagecounter->visit_total($this->pagecounter->get_pageUrl());
		$this->load->view('thesiscommon/header',$data);
		$this->load->view('thesiscommon/menu',$data);
		$this->load->view('home/home',$data);
		$this->load->view('thesiscommon/footer',$data);
		}
	}
	public function about($value='')
	{
		# code...
		$data['title'] = 'About';
		$data['visits'] = $this->pagecounter->visit_total($this->pagecounter->get_pageUrl());
		$data['content'] = '
		<p>Thesis Hub is an online library system for all thesis studies of students from BISU Bilar. It stored the title of the study, abstract, researchers, date of study, committe, and examining panel. On the other hand the full study is to be stored in offline database sytem</p>
		<p>It was developed to aide the researcher and instructors for easy retrieval of thesis information and to avoid duplication of the study. It can also find out the status of ...
		<p>This project was done by the three expert instructor of Department of Information and System Management name as followed:
		<br>
		Mrs. Arlen Gudmalin -  Team Leader
		<br>
		Mr. Harold Rita - Online System Developer
		<br>
		Mr. Joel Piollio - Offline Database System Developer
		</p>



		';
		$this->load->view('thesiscommon/header',$data);
		$this->load->view('thesiscommon/menu',$data);
		$this->load->view('home/content',$data);
		$this->load->view('thesiscommon/footer',$data);

	}
	public function contact($value='')
	{
		# code...

        /*print_r( $this->aauth->list_pms() );
    	exit();

    	*/

		if ($this->input->post()) {
			# code...


			$email = $this->input->post('email');
			$s = $this->input->post('subject');
			$msg = $this->input->post('message');
				$password = time();
				$username = 'Guest'.$password;

			if(isset($_COOKIE['pm'])){
				redirect(site_url('contact?stat=try-again-later'));
			}

			setcookie('pm',$subject, time() + 10000);

			if($this->user_model->email($email) > 0){
				//exit('Email is not available.');
				$id = $this->user_model->get_id_by_email($email);
				//echo $id;
				//exit();
			}else{
				//echo $user;
				$a = $this->aauth->create_user($email,$password,$username);
				$pm = $this->aauth->send_pm($a,1,$s,$msg);
			}

			redirect(site_url('contact?stat=').$pm);

		}
		$data['subtitle'] = 'Contact us';
		$data['title'] = 'Contact';
		$data['visits'] = $this->pagecounter->visit_total($this->pagecounter->get_pageUrl());
		$data['content'] = 'Content display here...';
		$this->load->view('thesiscommon/header',$data);
		$this->load->view('thesiscommon/menu',$data);
		$this->load->view('home/contactus',$data);
		$this->load->view('thesiscommon/footer',$data);

	}
	public function login($value='')
	{
		# code...
		//echo "Login";

		if($this->input->post()){

				$user = $this->input->post('username');
				$password = $this->input->post('password');

				    if(!filter_var($user, FILTER_VALIDATE_EMAIL)) {

				    	$user = $this->user_model->get_email_by_username($user);
				    }


	        if ($this->aauth->login($user, $password)){
	        	echo 'loggedIn';
	        }else{
			$error = $this->aauth->print_errors();
			

			print($error);

	        }

		}else{
			exit('No action received.');
		}

        /*$a = $this->aauth->update_user(1, "rhoy012@gmail.com", "admin123", "admin");
        print_r($a);*/
	}
	public function logout($value='')
	{
		# code...

        $this->aauth->logout();
        redirect('');
	}
	public function loginIE($value='')
	{
		# code
		//echo "Login by ie";	

		if($this->input->post()){

			$user = $this->input->post('username');
			$password = $this->input->post('password');


        if ($this->aauth->login($user, $password)){
        	redirect('search');
        }else{
		$error = $this->aauth->print_errors();
		$error = str_replace(' ', '-', $error);
		$error = str_replace('.', '', $error);
		$error = str_replace(',', '', $error);
		redirect('ie/login/'.$error);

        }

		}
			/*if($this->user_model->username($this->input->post('username'))){
				$u = $this->user_model->username($this->input->post('username'));
				foreach ($u as $key) {
					# code...
				echo $key['passwd'];
				}
            echo "loggedIn";    
        }else{
        	echo 'User not found';
        }*/

		//redirect('ie/login/error');
	}
	public function ie($value='')
	{
		# code...

			$error = '';
			if($this->uri->segment(3) !== ''){
				$error = $this->uri->segment(3) ;
			}

		$data['msg'] = $error;
		$data['title'] = 'Thesis Hub for IE';
		$data['username'] = $this->session->username;
		$data['visits'] = $this->pagecounter->visit_total($this->pagecounter->get_pageUrl());
		$this->load->view('thesiscommon/header',$data);
		$this->load->view('thesiscommon/menu',$data);
		$this->load->view('home/home-ie',$data);
		$this->load->view('thesiscommon/footer',$data);

	}
	public function signup($value='')
	{
		# code...

		//$a = $this->aauth->create_user('user2@gmail.com','12345','user2');
		//print($a);

		if ($this->input->post()) {
			# code...
			$email = $this->input->post('email');
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$cpassword = $this->input->post('cpassword');
			$group = $this->input->post('group');

			if($this->user_model->email($email) > 0){
				exit('Email is not available.');
			}elseif($this->user_model->username($username) > 0){
				exit('Username is not available.');
			}elseif($password !== $cpassword){
				exit('Password do not much.');
			}else{			
				$a = $this->aauth->create_user($email,$password,$username);
				$permit = $this->aauth->allow_user($a,2); // 2 researcher and 1 for employee
				$group = $this->aauth->add_member($a,$group);
			}





		}else{

		# code...
			$this->load->model('group_model');
			$type = $this->group_model->group_type(3);
			//var_dump($type);


		//$groups = $this->aauth->list_groups();
		$data['listgroup'] = $type ;
		
		$data['title'] = 'Register';
		$data['visits'] = $this->pagecounter->visit_total($this->pagecounter->get_pageUrl());
		$this->load->view('thesiscommon/header',$data);
		$this->load->view('thesiscommon/menu',$data);
		$this->load->view('register',$data);
		$this->load->view('thesiscommon/footer',$data);

		}




	}

	public function update($value='')
	{
		//echo $this->uid;

		//*
		$a = $this->aauth->is_allowed('walk_unseen',3);
		var_dump($a);
		/*/
		$b = $this->aauth->allow_user(2,'walk_unseen');
		var_dump($b);

		/**/

	}

	public function FunctionName($value='')
	{
		# code...
	}











}