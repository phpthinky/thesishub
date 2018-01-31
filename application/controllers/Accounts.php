<?php 

/**
* 
*/
class Accounts extends CI_Controller
{
	
	function __construct()
	{
		# code...
		parent::__construct();

		$this->init();
	}
	public function init($value='')
	{
		# code...
        if (!$this->aauth->is_loggedin()){
        	redirect();
        }
        if($this->session->userdata['permit'] == 'students'){
        	redirect();
        }
		$this->load->model('user_model');
	}
	public function index($value='')
	{
		# code...
	}
	public function guest($value='')
	{
		# code...

		$content = $this->user_model->list_users('public');


		$data['content']= $content;
		$data['title']= "Resource Portal - students";
		$data['username']= $this->session->username;


		$this->load->view('admin/default/header',$data);
		$this->load->view('admin/default/menu',$data);
		$this->load->view('admin/accounts/students',$data);
		$this->load->view('admin/default/footer',$data);
	}
	public function students($value='')
	{
		# code...

		$content = $this->user_model->list_users('students');


		$data['content']= $content;
		$data['title']= "Resource Portal - students";
		$data['username']= $this->session->username;


		$this->load->view('admin/default/header',$data);
		$this->load->view('admin/default/menu',$data);
		$this->load->view('admin/accounts/students',$data);
		$this->load->view('admin/default/footer',$data);
	}
	public function instructors($value='')
	{
		# code...
		$content = $this->user_model->list_users('instructors');
		$data['content']= $content;

		$data['title']= "Resource Portal - instructors";
		$data['username']= $this->session->username;


		$this->load->view('admin/default/header',$data);
		$this->load->view('admin/default/menu',$data);
		$this->load->view('admin/accounts/instructors',$data);
		$this->load->view('admin/default/footer',$data);
	}
	public function staff($value='')
	{
		# code...

		$content = $this->user_model->list_users('staffs');
		$data['content']= $content;


		$data['title']= "Resource Portal - staffs";
		$data['username']= $this->session->username;


		$this->load->view('admin/default/header',$data);
		$this->load->view('admin/default/menu',$data);
		$this->load->view('admin/accounts/staff',$data);
		$this->load->view('admin/default/footer',$data);
	}

	public function edit_info($value='')
	{
		# code...

		if($this->input->post()){
			
			/*$email = $this->input->post('eemail');
			$username = $this->input->post('eusername');
			*/
			$u_id = $this->input->post('uid');
			$pass = $this->input->post('epass');


       	  $firstname = $this->input->post('efirstname');
       	  $middlename = $this->input->post('emiddlename');
       	  $lastname = $this->input->post('elastname');
       	  $idno = $this->input->post('eidno');

       	  $username = $this->user_model->get_username_by_id($u_id);
       	  $email = $this->user_model->get_email_by_username($username);

       	  $auth = true;
       	  $error = '';
       	  if(!empty($pass)){

       	  	if(!$auth = $this->aauth->update_user($u_id,$email,$pass,$username)){
       	  		$aauth = false;
       	  		$error = $this->aauth->print_errors();
       	  	}
       	  }

       	  $infos = array('fname' =>$firstname ,'mname'=>$middlename,'lname'=>$lastname,'stud_id'=>$idno);
       	  if(!$other_info = $this->user_model->update_user_info($u_id,$infos)){
       	  	$error .= ' error on other info';
       	  }

       	  if($auth && $other_info){
       	  	echo json_encode(array('stats'=>true,'msg'=>'Account updated successfully'));
       	  }else{

       	  	echo json_encode(array('stats'=>false,'msg'=>'Error 0000: Account not updated. '.$error));
       	  }


	}
	}

	public function remove_user($value='')
	{
		# code...
		if ($this->input->post()) {
			# code...
			$id = $this->input->post('uid');
			if($removed = $this->user_model->remove_user($id)){
				echo json_encode(array('stats'=>true));
			}else{
				echo json_encode(array('stats'=>false,'msg'=>$id));
			}
		}
	}
	public function validate_email($email='')
	{
		# code...

		$pattern = '/^(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){255,})(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){65,}@)(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22))(?:\\.(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-+[a-z0-9]+)*\\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-+[a-z0-9]+)*)|(?:\\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\\]))$/iD';


			if (preg_match($pattern, $email) === 1) {
			    // emailaddress is valid
			    return true;
			}else{
				return false;
			}
	}
	public function add_staff()
	{
		# code...
		if($this->input->post()){
			$email = $this->input->post('email');
			$username = $this->input->post('username');
			$pass = $this->input->post('pass');


       	  $firstname = $this->input->post('firstname');
       	  $middlename = $this->input->post('middlename');
       	  $lastname = $this->input->post('lastname');
       	  $idno = $this->input->post('idno');


				if (!$this->validate_email($email)) {
					# code...
		       		echo json_encode(array('stats'=>false,'msg'=>'Invalid Email'));
		       		exit();
				}


				if ($this->user_model->email($email)) {
					# code...
		       		echo json_encode(array('stats'=>false,'msg'=>'Email already used.'));
		       		exit();
				}

			if ($idexist = $this->user_model->get_stud_id($idno)) {
				# code...
		       		echo json_encode(array('stats'=>false,'msg'=>'Opps! It seems like some already used this id number.'));
		       		exit();
			}


			if ($isuser = $this->user_model->username($username)) {
				# code...
		       		echo json_encode(array('stats'=>false,'msg'=>'Opps! It seems like some already used this username.'));
		       		exit();
			}
			

			
       	  $id = $this->aauth->create_user($email,$pass,$username);

		
       	  		if($id > 0)
       	  		{

       	  			$permission = $this->aauth->allow_user($id,'staffs');

		       	  if($info = $this->user_model->add_user_info($firstname,$middlename,$lastname,$idno,$id)){

		       	  echo json_encode(array('stats'=>true,'msg'=>'Account added.'));
			       	}else{
			       echo json_encode(array('stats'=>false,'msg'=>'Unknown error occured: error no 0001'));
			       	}
	       	  	

	       	 	 }else{
	       	 	 	 $error = $this->aauth->print_errors();
			       		echo json_encode(array('stats'=>false,'msg'=>'Account  not save. '.$error));
			       	}

	       	  
		}else{
			echo json_decode(array('stats'=>false,'msg'=>'No input received.'));
		}
	}
	public function add_students()
	{
		
		# code...
		if($this->input->post()){
			$email = $this->input->post('email');
			$username = $this->input->post('username');
			$pass = $this->input->post('pass');


       	  $firstname = $this->input->post('firstname');
       	  $middlename = $this->input->post('middlename');
       	  $lastname = $this->input->post('lastname');
       	  $idno = $this->input->post('idno');


				if (!$this->validate_email($email)) {
					# code...
		       		echo json_encode(array('stats'=>false,'msg'=>'Invalid Email'));
		       		exit();
				}


				if ($this->user_model->email($email)) {
					# code...
		       		echo json_encode(array('stats'=>false,'msg'=>'Email already used.'));
		       		exit();
				}

			if ($idexist = $this->user_model->get_stud_id($idno)) {
				# code...
		       		echo json_encode(array('stats'=>false,'msg'=>'Opps! It seems like some already used this id number.'));
		       		exit();
			}


			if ($isuser = $this->user_model->username($username)) {
				# code...
		       		echo json_encode(array('stats'=>false,'msg'=>'Opps! It seems like some already used this username.'));
		       		exit();
			}
			

			
       	  $id = $this->aauth->create_user($email,$pass,$username);

		
       	  		if($id > 0)
       	  		{

       	  			$permission = $this->aauth->allow_user($id,'students');

		       	  if($info = $this->user_model->add_user_info($firstname,$middlename,$lastname,$idno,$id)){

		       	  echo json_encode(array('stats'=>true,'msg'=>'Account added.'));
			       	}else{
			       echo json_encode(array('stats'=>false,'msg'=>'Unknown error occured: error no 0001'));
			       	}
	       	  	

	       	 	 }else{
	       	 	 	 $error = $this->aauth->print_errors();
			       		echo json_encode(array('stats'=>false,'msg'=>'Account  not save. '.$error));
			       	}

	       	  
		}else{
			echo json_decode(array('stats'=>false,'msg'=>'No input received.'));
		}
	}
	public function add_instructors()
	{
		# code...

		# code...
		if($this->input->post()){
			$email = $this->input->post('email');
			$username = $this->input->post('username');
			$pass = $this->input->post('pass');


       	  $firstname = $this->input->post('firstname');
       	  $middlename = $this->input->post('middlename');
       	  $lastname = $this->input->post('lastname');
       	  $idno = $this->input->post('idno');


				if (!$this->validate_email($email)) {
					# code...
		       		echo json_encode(array('stats'=>false,'msg'=>'Invalid Email'));
		       		exit();
				}


				if ($this->user_model->email($email)) {
					# code...
		       		echo json_encode(array('stats'=>false,'msg'=>'Email already used.'));
		       		exit();
				}

			if ($idexist = $this->user_model->get_stud_id($idno)) {
				# code...
		       		echo json_encode(array('stats'=>false,'msg'=>'Opps! It seems like some already used this id number.'));
		       		exit();
			}


			if ($isuser = $this->user_model->username($username)) {
				# code...
		       		echo json_encode(array('stats'=>false,'msg'=>'Opps! It seems like some already used this username.'));
		       		exit();
			}
			

			
       	  $id = $this->aauth->create_user($email,$pass,$username);

		
       	  		if($id > 0)
       	  		{

       	  			$permission = $this->aauth->allow_user($id,'instructors');

		       	  if($info = $this->user_model->add_user_info($firstname,$middlename,$lastname,$idno,$id)){

		       	  echo json_encode(array('stats'=>true,'msg'=>'Account added.'));
			       	}else{
			       echo json_encode(array('stats'=>false,'msg'=>'Unknown error occured: error no 0001'));
			       	}
	       	  	

	       	 	 }else{
	       	 	 	 $error = $this->aauth->print_errors();
			       		echo json_encode(array('stats'=>false,'msg'=>'Account  not save. '.$error));
			       	}

	       	  
		}else{
			echo json_decode(array('stats'=>false,'msg'=>'No input received.'));
		}
	}
}