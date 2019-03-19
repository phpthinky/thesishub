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

		$inbox = $this->user_model->inbox($this->uid);

		$data['inbox'] = $inbox;
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
		
		$sents = $this->user_model->sent($this->uid);

		$data['sents'] = $sents;

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
		$group = $this->aauth->get_user_groups($this->uid);
		if (is_array($group)) {
			# code...
			foreach ($group as $key) {
				# code...
				$groups[] = $key->id;
			}
		}
		//var_dump($groups);
		foreach ($groups as $key2) {
			# code...
			$list_users = $this->aauth->list_users($key2);
			foreach ($list_users as $key3) {
				# code...
				if ($key3->username) {
					# code...
				$user[] = $key3->username;
				}
			}
			//print_r($list_users);
		}
		//var_dump($user);exit();
		$usernames = array_unique($user);
		//var_dump($usernames);exit();
		$data['users'] = $usernames;
		$data['action'] = 'compose';
		$data['subtitle']= "Messages ";
		$data['title']= "Messages";
		$data['username']= $this->session->username;


		$this->load->view('search/common/header',$data);
		$this->load->view('search/common/menu',$data);

		$this->load->view('users/composer',$data);

		$this->load->view('search/common/footer',$data);
	}
	public function search_user($q='')
	{
		# code...
		//if($this->input->post()){

			echo "<ul class='find-userlist'>";
			$usernames = $this->user_model->user_like($this->input->post('q'));
			//var_dump($this->input->post('q'));exit();
			if($usernames){
				foreach ($usernames as $key) {
					# code...

					if ($key->username != $this->session->userdata('username')) {
					echo "<li onClick=\"selectuser('".$key->username."')\"  title='Click send message to this user.'>$key->username</li>";
					}
				}
			}else{
				echo '<li>User not found</li>';
			}
			echo "</ul>";
		//}
	}
	public function send_now()
	{
		# code...
		if($this->input->post()){
			$user = $this->input->post('email');
			$content = $this->input->post('message');
			$receiver = $this->user_model->get_id_by_username($user);
			if($receiver){

				$send = $this->aauth->send_pm($this->uid,$receiver,'null',$content);
				echo $send;
				/*if($send == 1){
					echo "Message sent.";
				}else{
				echo 'Message not sent';

				}*/
			}else{
				echo 'Message not sent';
			}

		}else{
			echo "No Action";;
		}
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