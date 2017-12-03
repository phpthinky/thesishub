<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class Usermodel extends CI_Model
{
	
	function __construct()
	{
		# code...
	}
	function username($user = null){

		if($user <> null){

		$result = $this->db->select('*')->from('users')->where('email',$user)->get()->result();
		return $result;
		}

	}
}