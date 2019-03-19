<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class User_model extends CI_Model
{
	
	function estr($string){
		return $this->db->escape_str($string);
	}
	function username($user = null){

		if($user <> null){
			
		$user = $this->estr($user);
		$result = $this->db->select('*')->from('aauth_users')->where('username',$user)->get()->result();
		return count($result);
		}else{
			return 0;
		}

	}
	public function user_like($q=false)
	{
		# code...
		if ($q) {

			$q = $this->estr($q);
			$sql = "SELECT username FROM aauth_users WHERE username LIKE '".$q."%'";
			$query = $this->db->query($sql);
			return $query->result();
		}
		return false;

	}


	function email($email = null){

		if($email <> null){
			$email = $this->estr($email);

		$result = $this->db->select('*')->from('aauth_users')->where('email',$email)->get()->result();
		return count($result);
		}else{
			return 0;
		}

	}

	function get_username_by_id($id = 0){
		if (!is_numeric($id)) {
			# code...
			return null;
		}
		if($id <> 0){

		$result = $this->db->select('username')->from('aauth_users')->where('id',$id)->get()->result();
		return $result[0]->username;
		}else{
			return null;
		}

	}

	function get_id_by_username($username = false){

		if($username){
		$username = $this->estr($username);

		$result = $this->db->select('id')->from('aauth_users')->where('username',$username)->get()->result();
		return $result[0]->id;
		}else{
			return false;
		}

	}

	function get_id_by_email($email = null){

		if($email <> null){
			$email = $this->estr($email);
		$result = $this->db->select('id')->from('aauth_users')->where('email',$email)->get()->result();
		return $result[0]->id;
		}else{
			return 0;
		}

	}
		function get_email_by_username($username = null){

		if($username <> null){
			$username = $this->estr($username);
			if($result = $this->db->select('email')->from('aauth_users')->where('username',$username)->get()->result()){

			return $result[0]->email;
			}
			return false;
		}else{
			return false;
		}

	}
	public function password($user=null)
	{
		# code...

		if($user <> null){
		$user = $this->estr($user);
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
		if($name && is_numeric($uid)){
			$this->db->select('value')
			->from('more_user_info');
			$this->db->where(array('settings'=>$name,'user_id'=>$uid));
			$query = $this->db->get();
			if($query->num_rows() > 0){
				$result = $query->result();
				return $result[0]->value;
			}

		}
			return false;
		
	}
	public function inbox($uid='',$start=false,$limit=false)
	{
		# code...
		if(is_numeric($uid)){

		$this->db->select('id as pm_id,sender_id,message,date_sent,date_read')->from('aauth_pms')->where(array('receiver_id'=>$uid,'pm_deleted_receiver'=>NULL));
		return $this->db->get()->result();
		}
		return false;
	}

	public function sent($uid='',$start=false,$limit=false)
	{
		# code...
		if(is_numeric($uid)){
		$this->db->select('id as pm_id,receiver_id,message,date_sent,date_read')->from('aauth_pms')->where(array('sender_id'=>$uid,'pm_deleted_sender'=>NULL));
		return $this->db->get()->result();
		}return false;
	}
}