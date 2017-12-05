<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class Group_model extends CI_Model
{
	
	function __construct()
	{
		# code...
		parent::__construct();
	}
	function insert_group_type($gid = false, $type = false){

		if($gid && $type){
			$result = $this->db->insert('more_group_type',array('group_id'=>$gid,'group_type'=>$type));
			return $result;
		}else{
			return false;
		}
	}

	function group_type($type='')
	{
		# code...
		$sql = "SELECT g.id, g.name FROM aauth_groups g LEFT JOIN more_group_type t ON t.group_id = g.id WHERE t.group_type = ? GROUP BY g.id";
		$result = $this->db->query($sql,$type)->result();
		return $result;
	}


}