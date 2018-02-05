<?php  

/**
* 
*/
class Access extends CI_Controller
{
	public $uid;
	function __construct()
	{
		# code...
		parent::__construct();
        if (!$this->aauth->is_loggedin()){
        	redirect();
        }

        $this->load->model('accessed_model');
		$this->uid = $this->session->userdata('id');

	}

	public function index()
	{
		# code...

		$groups = $this->aauth->list_groups();
		$data['groups'] = $groups;

		$data['title'] = "Thesis Hub : Permission";
		$this->load->view('search/common/header',$data);
		$this->load->view('search/common/menu',$data);
		$this->load->view('permit/index',$data);
		$this->load->view('search/common/footer',$data);

	}
	public function req_access()
	{

		if($this->input->post()){
			
			/*
			echo json_encode(array('stat'=>true,'msg'=>$this->input->post('group_id')));
			exit();
			*/
		if($a = $this->accessed_model->request($this->input->post('group_id'),$this->uid)){

			echo json_encode(array('stat'=>true,'msg'=>$a));
		}else{
			echo json_encode(array('stat'=>false,'msg'=>'Request failed.'));
		}

		}else{
			echo json_encode(array('stat'=>false,'msg'=>'No action done.'));
		}

	}

	public function request($group=false,$user_id=false)
	{
		# code...

		//var_dump($group);
		$a = $this->accessed_model->request($this->input->post('group_id'),$this->uid);
		//$a = $this->accessed_model->if_request_exist(4,$this->uid);
		$result = array('stat' => true,$a);
		echo json_encode($result);


		//$b = $this->accessed_model->list_request();
		//var_dump($b);
	}
}