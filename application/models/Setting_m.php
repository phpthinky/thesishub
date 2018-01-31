<?php 

/**
* 
*/
class Setting_m extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}
	public function get_all_setting($id=0)
	{
		# code...
		$this->db->select('*');
		$query = $this->db->get_where('col_settings',array('id'=>$id));
		return $query->result();
	}
	public function get_active_setting($id=0)
	{
		# code...
		$this->db->select('*');
		$query = $this->db->get_where('col_settings',array('id'=>$id,'setting_status'=>1));
		return $query->result();
	}
	public function save($id=0,$data)
	{
		# code...

		$this->db->where('id', $id);
		return $this->db->update('col_settings', $data);

	}

	public function insert_course($course=false,$definition=false,$perm=false)
	{

		if ($course) {
			
			if($group_id = $this->aauth->create_group($course, $definition )){

				return $this->db->insert('more_group_type',array('group_id'=>$group_id,'group_type'=>3));

			}else{
				return $this->aauth->print_errors();
			}
		}
		return false;
	}
	public function list_course($perm=false)
	{
		if($perm){
			$this->db->select('aauth_groups.*')
					->from('aauth_groups')
					->join('more_group_type','more_group_type.group_id = aauth_groups.id','left')
					->where('more_group_type.group_type',3);
					return $this->db->get()->result();
		}
	}
	public function remove_course($id=0)
	{
		# code...
		if ($id > 0) {

			$tbl = array('aauth_groups','more_group_type');

				$this->db->where('group_id',$id);	
				$this->db->delete('more_group_type');
				$this->db->where('id',$id);	
				$this->db->delete('aauth_groups');
		}
	}

}