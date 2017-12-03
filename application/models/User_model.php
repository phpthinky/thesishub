<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class User_model extends CI_Model
{
	

	function username($user = null){

		if($user <> null){

		$result = $this->db->select('*')->from('aauth_users')->where('username',$user)->get()->result();
		return count($result);
		}else{
			return 0;
		}

	}


	function email($email = null){

		if($email <> null){

		$result = $this->db->select('*')->from('aauth_users')->where('email',$email)->get()->result();
		return count($result);
		}else{
			return 0;
		}

	}

	function get_username_by_id($id = 0){

		if($id <> 0){

		$result = $this->db->select('username')->from('aauth_users')->where('id',$id)->get()->result();
		return $result[0]->username;
		}else{
			return null;
		}

	}

	function get_id_by_email($email = null){

		if($email <> null){

		$result = $this->db->select('id')->from('aauth_users')->where('email',$email)->get()->result();
		return $result[0]->id;
		}else{
			return 0;
		}

	}
	public function password($user=null)
	{
		# code...

		if($user <> null){

		$result = $this->db->select('password')->from('users')->where('username',$user)->get()->result();
		return $result;
		}

	}
	public function userLogout($value='')
	{
		# code...
		$user = $this->session->userdata('username');


	}

	public function getAllUsers()
	{
		# code...

		$result = $this->db->select('*')->from('aauth_users')->get()->result();
		return $result;

	}
	public function get_info($name=false,$uid=false)
	{
		# code...
		if($name && $uid){
			$this->db->select('value')
			->from('more_user_info');
			$this->db->where(array('settings'=>$name,'user_id'=>$uid));
			$query = $this->db->get();
			if($query->num_rows() > 0){
				$result = $query->result();
				return $result[0]->value;
			}

		}else{
			return false;
		}
	}
}