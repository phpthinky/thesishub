<?php 

/**
* 
*/
class Group extends CI_Controller
{
	public $id;
	
	function __construct()
	{
		# code...
		parent::__construct();
		$this->uid = $this->session->userdata('id');
		$this->load->library('minify');
		$this->load->library('Aauth');
		$this->load->model('user_model');
		$this->load->model('accessed_model');
		if (!$this->aauth->is_admin()) {
			# code...
			redirect('search');
		}

	}
	public function index($value='')
	{
		# code...
        if (!$this->aauth->is_loggedin()){
        	redirect(site_url());
        }
		$groups = $this->aauth->list_groups();
		//var_dump($groups);

		$content = '<table class="table table-bordered"><thead><tr><th>Group name</th><th>Definition</th><th>Member</th><th>Access Request</th><th>Action</th></tr></thead><tbody>';
		foreach ($groups as $key) {
			# code...
			$total_req = count($this->accessed_model->list_request($key->id));
			$content .= "<tr><td>$key->name</td><td>$key->definition</td><td align='center'><a href='".site_url('group/request/').$key->id."' class='btn btn-info'>0</a></td><td align='center'><a href='".site_url('group/request/').$key->id."' class='btn btn-warning'>".$total_req."</a></td><td><a href='".site_url('group/edit')."' class='btn btn-default'><i class='fa fa-edit'></i></a>";
			if($this->aauth->is_admin()){
				$content .= "&nbsp;<a href='#' class='btn btn-danger'><i class='fa fa-remove'></i></a>";
			}
			$content .= "</td></tr>";
		}
		$content .= '</tbody></table><p>';
		$data['content'] = $content;
		$data['title'] = "Group - List all";
		$data['subtitle'] = "Group - List all <a href='".site_url('group/create')."' class='btn btn-info' >New</a>";
		$this->load->view('admin/default/header',$data);
		$this->load->view('admin/default/sidemenu',$data);
		$this->load->view('admin/contents',$data);
		$this->load->view('admin/default/footer',$data);
	}

	public function request($group_id='')
	{
		# code...
		if($group_id == 0){
			$group_id = $this->uri->segment(3);
		}

		$b = $this->accessed_model->list_request($group_id);
		//var_dump($b);exit();

		$content = '<table class="table table-bordered"><thead><th>Username</th><th>Message</th><th>Action</th></thead>';
		foreach ($b as $key) {
			# code...
			$Username = $this->user_model->get_username_by_id($key->user_id);
			$content .= "<tr id='tr$key->id' class=''><td width='200px;'>$Username</td><td align='center'>NA</td><td width='100px'><a href='javascript:void(0)' onClick='approvedaccessed(".$group_id.",".$key->user_id.",".$key->id.")' class='btn btn-success'><i class='fa fa-check'></i></a> <a href='".site_url('group/disapprove')."' class='btn btn-warning'><i class='fa fa-remove'></i></a></td></tr>";
		}
		$content .= '<p>';

		$script = "<script>
					function approvedaccessed(gId,uId,trId){
						//alert(gId+'-'+uId);
						//$('#tr'+trId).addClass('hidden');
						var data = 'gId='+gId+'&uId='+uId+'&rId='+trId;
						$.ajax({
							type: 'post',
							dataType: 'html',
							data: data,
							url: '".site_url('group/approved_request')."',
							success: function(response){
								console.log;
								alert(response);
							}

						});
						return false;
					}
					</script>"; 
		$data['content'] = $content.$script;
		$data['title'] = "Group - List all";
		$data['subtitle'] = "Group - ".$this->aauth->get_group_name($group_id);
		$this->load->view('admin/default/header',$data);
		$this->load->view('admin/default/sidemenu',$data);
		$this->load->view('admin/contents',$data);
		$this->load->view('admin/default/footer',$data);
	}
	public function approved_request($value='')
	{
		# code...
		if ($this->input->post()) {
			# code...
			//var_dump($this->input->post('rId'));exit();
        $a = $this->aauth->allow_user($this->input->post('uId'),2);
        $b = $this->accessed_model->allow_access($this->input->post('rId'));

        var_dump($b);

		}
	}

	public function addmember($user_id=0, $group_par=false)
	{
		# code...
		//$a = $this->aauth->add_member($user_id, $group_par);
		//return $a;

        //$a = $this->aauth->create_user("user@gmail.com", "12345", "user");


	}
	public function create($value='')
	{
		# code...
		if($this->input->post()){

		$this->load->model('group_model');

        $gid = $this->aauth->create_group($this->input->post('groupname'),$this->input->post('groupdefinition'));
        if($gid > 0){
        	$permission = $this->aauth->allow_group($gid,$this->input->post('permission'));
        	$type = $this->group_model->insert_group_type($gid, $this->input->post('group_type'));
        }

        //print($a);
        //print('<a href="Group')
        redirect(site_url('group'));
		}else{


        $data['list_perms'] = $this->aauth->list_perms();


        //print_r($a);
		$data['title'] = "Create Group";
		$data['subtitle'] = "Create Group";
		$this->load->view('admin/default/header',$data);
		$this->load->view('admin/default/sidemenu',$data);
		$this->load->view('group/creategroup',$data);
		$this->load->view('admin/default/footer',$data);
			
		}

	}

	public function req_ac()
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
}