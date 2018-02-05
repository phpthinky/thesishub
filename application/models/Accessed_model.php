<?php 

/**
* 
*/
class Accessed_model extends CI_Model
{
	
	function __construct()
	{
		# code...
		parent::__construct();
	}

		public function list_request($group_par = FALSE, $limit = FALSE, $offset = FALSE, $include_banneds = FALSE, $sort = FALSE) {

		// if group_par is given
		if ($group_par != FALSE) {

			//$group_par = $this->get_group_id($group_par);
			$this->db->select('*')
				->from('aauth_perms_req')
				->where(array("group_id"=>$group_par,"request_status"=>1));

			// if group_par is not given, lists all users
		} else {

			$this->db->select('*')
				->from('aauth_perms_req');
		}


		// order_by
		if ($sort) {
			$this->db->order_by($sort);
		}

		// limit
		if ($limit) {

			if ($offset == FALSE)
				$this->db->limit($limit);
			else
				$this->db->limit($limit, $offset);
		}

		$query = $this->db->get();

		return $query->result();
	}

	public function request($group_id=false, $user_id= false,$perm_id = false)
	{
		# code...
		if($group_id && $user_id){


		$a = $this->accessed_model->if_request_exist($group_id,$this->uid);

		if ($a <= 0) {
			# code...

			$data = array(
				'group_id'=>$group_id,
				'user_id'=>$user_id,
				'request_status'=>1
				);

			$result = $this->db->insert('aauth_perms_req',$data);
			return $result;
		}else{
			return false;
		}

		}else{
			return false;
		}
	}
	public function if_request_exist($group_id=false, $user_id= false,$perm_id = false)
	{
		# code...
		$this->db->select('*')->from('aauth_perms_req')->where(array('group_id'=>$group_id,'user_id'=>$user_id));
		$query = $this->db->get();
		return $query->num_rows();

	}

	public function is_allowed($group_id=false, $user_id= false,$perm_id = false)
	{
		# code...
		$this->db->select('request_status')->from('aauth_perms_req')->where(array('group_id'=>$group_id,'user_id'=>$user_id));
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$result = $query->result();
			if($result[0]->request_status == 2){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}

	}
	public function allow_access($rid=0)
	{
		# code...
		if ($rid <> 0) {
			# code...
			$data['request_status'] = 2;
			$this->db->where('id',$rid);
			//return true;
			return $this->db->update('aauth_perms_req',$data);
		}else{
			return false;
		}
	}
}