<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {


	public $uid;
	function __construct()
	{
		# code...
		parent::__construct();

		$this->uid = $this->session->userdata('id');


		$this->load->library('session');
		$this->load->library('pagecounter');
		$this->load->library('minify');
		$this->load->model('user_model');
		$this->load->model('post_model');
		//$this->load->library('Aauth');
		if(!$this->aauth->is_loggedin()){
			redirect();
		}

	}
	public function my_account($value='')
	{
		# code...
		//echo "My account";

		$u =  $this->aauth->get_user();
		if(count($u) > 0){
			$data['username']=$u->username;
			$data['email'] = $u->email;
			$data['stud_id'] = $u->stud_id;
			$data['stud_id_ex'] = $u->stud_id_ex;
		}
		

		$name = json_decode($this->user_model->get_info('fullname',$this->uid));
		$data['fname'] = isset($name->fname) ? $name->fname:'';
		$data['mname'] = isset($name->mname) ? $name->mname:'';
		$data['lname'] = isset($name->lname) ? $name->lname:'';

		$contact = json_decode($this->user_model->get_info('contact',$this->uid));
		$mobile = isset($contact->mobile) ? $contact->mobile:'';
		$address = isset($contact->address) ? $contact->address:'';


		$data['isactive'] = 'profile';
		$data['title'] = "My account";
		$this->load->view('search/common/header',$data);
		$this->load->view('search/common/menu',$data);
		$this->load->view('users/researchers',$data);
		$this->load->view('search/common/footer');

	}
	public function inbox($value='')
	{
		# code...


		$receive = $this->aauth->list_pms(5,0,$this->uid);
		$obj ='';
		if(count($receive) > 0){

				$i = 0;
				foreach ($receive as $key) {
					# code...
					$obj[] = array('pm_id' => $key->id,'sender_id'=>$key->sender_id,'sender_user'=>$this->user_model->get_username_by_id($key->sender_id),'receiver_id'=>$key->receiver_id,'message'=>$this->post_model->limitext($key->message),'date_sent'=>$key->date_sent);
					$i++;
				}
		}

		$data['receiver'] = $obj;
		$data['action'] = 'inbox';
		$data['subtitle']= "Messages ";
		$data['title']= "Messages";
		$data['username']= $this->session->username;


		$this->load->view('search/common/header',$data);
		$this->load->view('search/common/menu',$data);
		$this->load->view('users/inbox',$data);
		$this->load->view('search/common/footer',$data);
	}
	public function sents($value='')
	{
		# code...
		$data['action'] = 'sents';
		$data['subtitle']= "Messages ";
		$data['title']= "Messages";
		$data['username']= $this->session->username;


		$this->load->view('search/common/header',$data);
		$this->load->view('search/common/menu',$data);
		$this->load->view('users/inbox',$data);
		$this->load->view('search/common/footer',$data);
	}
	public function drafts($value='')
	{
		# code...

		$data['action'] = 'drafts';
		$data['subtitle']= "Messages ";
		$data['title']= "Messages";
		$data['username']= $this->session->username;


		$this->load->view('search/common/header',$data);
		$this->load->view('search/common/menu',$data);
		$this->load->view('users/inbox',$data);
		$this->load->view('search/common/footer',$data);
	}
	public function trash($value='')
	{
		# code...

		$data['action'] = 'trash';
		$data['subtitle']= "Messages ";
		$data['title']= "Messages";
		$data['username']= $this->session->username;


		$this->load->view('search/common/header',$data);
		$this->load->view('search/common/menu',$data);
		$this->load->view('users/inbox',$data);
		$this->load->view('search/common/footer',$data);
	}
	public function compose($value='')
	{
		# code...

		$data['action'] = 'compose';
		$data['subtitle']= "Messages ";
		$data['title']= "Messages";
		$data['username']= $this->session->username;


		$this->load->view('search/common/header',$data);
		$this->load->view('search/common/menu',$data);

		$this->load->view('users/composer',$data);

		$this->load->view('search/common/footer',$data);
	}
	public function index($value='')
	{
		# code...

		if(!$this->aauth->is_allowed('employee',$this->uid) || !$this->aauth->is_admin($this->uid)){
			redirect('users/my_account');
		}
		$content = '';

		//$user_info = $this->aauth->get_user();
		$user_info = $this->user_model->getAllUsers();

		$content = '<table class="table table-bordered"><thead><th>Username</th><th>E-mail</th><th>Groups</th></thead>';
		foreach ($user_info as $key) {
			# code...
						$group = false; 
			        foreach($this->aauth->get_user_groups($key->id) as $a){

            			$group .= $a->name. " ";
            			

        			}
			$content .= "<tr><td>$key->username</td><td>$key->email</td><td>$group</td></tr>";
		}
			$content .= '</table>';
		//var_dump($user_info);

		$data['content'] = $content;
		$data['subtitle']= "User ";
		$data['username']= $this->session->username;


		$this->load->view('admin/default/header',$data);
		$this->load->view('admin/default/sidemenu',$data);
		$this->load->view('admin/contents',$data);
		$this->load->view('admin/default/footer',$data);
	}
	public function signup($value='')
	{
		# code...
		/*$a = $this->aauth->allow_group('staff','employee');
		var_dump($a);

		*/
		//if($this->is_group_allowed(p,g))
		/*if($this->aauth->is_group_allowed(1,4)){
			echo "Yes! Staff allowed is allowed ";
		}else{

			echo "Sorry! Staff allowed is not allowed ";
		}*/


        //$a = $this->aauth->create_user('letswrite14@gmail.com','sub123','subadmin')
        //var_dump($a);

        if($this->input->post()){

        }


		# code...
		$data['title'] = 'Register';
		$data['visits'] = $this->pagecounter->visit_total($this->pagecounter->get_pageUrl());
		$this->load->view('thesiscommon/header',$data);
		$this->load->view('thesiscommon/menu',$data);
		$this->load->view('register',$data);
		$this->load->view('thesiscommon/footer',$data);

	}

	public function getUser($user='')
	{
		# code...
		$user = $this->user_model->username($user);
		var_dump($user);
	}

	public function changepermission($value='')
	{
		# code...

        $a = $this->aauth->allow_user($this->uid,2);
	}
}