<?php  

/**
* 
*/
class Thesis extends CI_Controller
{
	public $uid = 0;
	
	function __construct()
	{
		# code...
		parent::__construct();
		$this->load->library('aauth');
		$this->load->model('search_model');
		if (!$this->aauth->is_loggedin()){
        	redirect();
        }
        $this->uid = $this->session->userdata('id');
	}
	public function index()
	{
		# code...
		redirect('t/search');
	}
	public function search($value='')
	{
		# code...
		$groups = $this->aauth->get_user_groups($this->uid);
		//var_dump($groups);
		if($groups){
			foreach ($groups as $key) {
				# code...
				$ids[]= $key->group_id;
			}
			var_dump($ids);
		}
		$page = $this->search_model->find($this->uid,'test',0);
		foreach ($page as $key) {
			# code...
			print_r($key);
			echo "<br>";
		}

/*
		$data['title'] = "Thesis Hub";
		$this->load->view('search/common/header',$data);
		$this->load->view('search/common/menu',$data);
		$this->load->view('search/search',$data);
		$this->load->view('search/common/footer');

		*/
	}

}