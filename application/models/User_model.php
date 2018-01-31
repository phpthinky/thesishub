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
	function get_ip_on_attemp($id = 0){
		if ($id > 0) {
			# code...

		$sql = "SELECT ip_address FROM aauth_login_attempts WHERE id = ".$id;
		$q = $this->db->query($sql);
		if($r = $q->result()){
			return $r[0]->ip_address;
		}
		return false;
		}
		return false;
	}
	function username($user = false){

		if($user){
			
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


	function email($email = false){

		if($email){
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
	
	
	public function get_all_user_except_students($allowed = false)
	{
		# code...
		if ($allowed) {
			$sql = "SELECT  u.id, CONCAT(u.fname,' ',u.lname) as name FROM aauth_users u LEFT JOIN aauth_perm_to_user pu ON pu.user_id = u.id LEFT JOIN aauth_perms p ON p.id = pu.perm_id WHERE p.name <> 'students'";
			$q = $this->db->query($sql);
				if($result = $q->result()){

					return $result;
				}
		}
		return false;
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
	public function list_users($perm = false)
	{
		# code...
		if($perm){
			$sql = "SELECT u.id, u.fname,u.mname, u.lname, u.email,u.stud_id as idno,u.username FROM aauth_users u LEFT JOIN aauth_perm_to_user au ON au.user_id = u.id LEFT JOIN aauth_perms p ON p.id = au.perm_id WHERE u.isdeleted = 0 AND p.name = '".$perm."' GROUP BY u.id";
			$query = $this->db->query($sql);

			if($result = $query->result()){
				return $result;
			}
			return false;
		}
	}
	public function remove_user($id=false)
	{
		# code...
		if ($id) {
			# code...
		$this->db->where('id',$id)
					->delete('aauth_users');
		$this->db->where('user_id',$id)
					->delete('aauth_perm_to_user');
			return true;

		}
		return false;
	}

	public function update_authentication($id=false,$username=false,$email=false)
	{
		# code...

		if($id){


		$sql = sprintf("UPDATE `aauth_users` SET `username` = '%s', `email` = '%s' WHERE `aauth_users`.`id` = %d",$username,$email,$id);
		return $query = $this->db->query($sql);
		}
		return false;



	}
	public function update_user_info($id,$data)
	{
		# code...

		if($id){
			$this->db->where('id',$id);
			return $this->db->update('aauth_users',$data);


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

	public function add_user_info($fname='',$mname='',$lname='',$idno='',$id=0)
	{


		if ($id > 0) {
			# code...

		$sql = sprintf("UPDATE `aauth_users` SET `fname` = '%s', `mname` = '%s', `lname` = '%s', `stud_id` = '%s' WHERE `aauth_users`.`id` = %d",$fname,$mname,$lname,$idno,$id);
		return $query = $this->db->query($sql);

		}
		return false;
	}

	public function get_stud_id($id=false)
	{
		if($id){

		$sql = sprintf("SELECT stud_id FROM `aauth_users` WHERE stud_id = '%s' ",$id);
			$query = $this->db->query($sql);
			if($result = $query->result()){
				return $result[0]->stud_id;
			}
			return false;

		}

	}

	public function get_permission($id=0)
	{
		# code...
		if (is_numeric($id)) {
				# code...

			if ($id > 0) {
				# code...
				$sql = "SELECT p.name FROM aauth_perms p LEFT JOIN aauth_perm_to_user up ON up.perm_id = p.id WHERE up.user_id =".$id;

				$query = $this->db->query($sql);
				if ($result = $query->result()) {
					# code...
					return $result[0]->name;
				}
				return false;

			}
		}return false;
	}


	public function update_activity($id=false, $user_id= false,$page= false)
	{
		# code...
	}
	public function get_activity($id=false, $user_id= false,$page= false)
	{
		# code...
	}
}