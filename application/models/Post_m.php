<?php 

/**
* 
*/
class Post_m extends CI_Model
{
	
	function __construct()
	{
		# code...
		parent::__construct();
	}
	public function get_title_by_id($id=false)
	{
		# code...
		if($id){
			if (is_numeric($id)) {
					if ($id) {
						$sql = "SELECT title FROM post WHERE page_id = ? LIMIT 1";
						$query = $this->db->query($sql,$id);
						if($result = $query->result()){
							return $result[0]->title;
						}
						else{
							return false;
						}
					}
			}
		}
	}
		public function get_id_by_title($title=false)
	{
		# code...
		if($title && is_string($title)) {
						$sql = "SELECT page_id FROM post WHERE title = ? LIMIT 1";
						$query = $this->db->query($sql,$title);
						if($result = $query->result()){
							return $result[0]->page_id;
						}
						else{
							return 0;
						}							
		}
	}
	public function get_id_by_slug($slug=false){

		if ($slug) {
			$sql = sprintf("SELECT page_id FROM post WHERE slug = '%s' LIMIT 1",$slug);
			$query = $this->db->query($sql);
			if($result = $query->result()){
				return $result[0]->page_id;
			}
			else{
				return false;
			}
		}
	}

	public function get_experts($type=false,$post_id = 0)
	{
		if ($type) {

			$this->db->select('r.role_name as position,n.fullname,')
					->from('post_other_information as i')
					->join('col_names as n','n.id = i.name_id','left')
					->join('col_roles as r','r.id = i.role_id','left')
					->where('group_type',$type)
					->where('post_id',$post_id);
					return $this->db->get()->result();


		}
		return false;
	}
	public function list_researchers($id=0)
	{
		if(is_numeric($id)){
			if ($id > 0) {
				return $this->db->select('col_names.fullname,post_researcher.position')
					->from('post_researcher')
					->join('col_names','col_names.id = post_researcher.names_id','left')
					->where('post_researcher.post_id',$id)
					->get()
					->result();
					//return $q->result();

			}
		}
	}
	public function list_committees($id=0)
	{
		if(is_numeric($id)){
			if ($id > 0) {
				return $this->db->select('col_names.fullname,post_committee.position')
					->from('post_committee')
					->join('col_names','col_names.id = post_committee.names_id','left')
					->where('post_committee.post_id',$id)
					->get()
					->result();
					//return $q->result();

			}
		}
	}
	public function list_panels($id=0)
	{
		if(is_numeric($id)){
			if ($id > 0) {
				return $this->db->select('col_names.fullname,post_panel.position')
					->from('post_panel')
					->join('col_names','col_names.id = post_panel.names_id','left')
					->where('post_panel.post_id',$id)
					->get()
					->result();
					//return $q->result();

			}
		}
	}


	public function get_committee($id=0)
	{
		if ($id > 0) {

			$sql = sprintf("SELECT * FROM pos_committee WHERE post_id = %d ",$id);
			$query = $this->db->query($sql);
			return $query->result();

		}
		return false;
	}
	public function get_panel($id=0)
	{
		if ($id > 0) {

			$sql = sprintf("SELECT * FROM pos_panel WHERE post_id = %d ",$id);
			$query = $this->db->query($sql);
			return $query->result();

		}
		return false;
	}

	public function get_rating($id=0)
	{
		if ($id > 0) {

			$sql = sprintf("SELECT rating FROM pos_ratings WHERE post_id = %d LIMIT 1",$id);
			$query = $this->db->query($sql);
			if($result =  $query->result()){
				return $result[0]->rating;
			}

		}
		return false;
	}


	public function get_name($string=false)
	{
		//if ($id > 0) {
		if ($string) {
			//$string = $this->db->esc_str($string);
			$sql = "SELECT id,fullname FROM `col_names` WHERE fullname like '%".$string."%'";
			$query = $this->db->query($sql);
			return $query->result();

		}
		//}
		return false;
	}


	public function save_tag($tags=false,$id)
	{
		# code...
		if ($tags) {
			# code...
			$this->db->insert('post_tag',array('keyword'=>$tags,'post_id'=>$id));
			return;
		}
	}

	public function remove_tags($id)
	{
		# code...
		if (is_numeric($id)) {
			# code...
			$this->db->where('post_id',$id);	
			$this->db->delete('post_tag');
			return;
		}
	}
	public function search_by_tags($tags=false)
	{

		if (is_array($tags)) {

			foreach ($tags as $tag) {

					$sql = "SELECT p.page_id,p.title,c.value as content, p.slug FROM post p LEFT JOIN post_contents c ON c.group_id = p.page_id LEFT JOIN post_tags t ON t.post_id = p.page_id WHERE c.name = 'content' AND t.tags LIKE '%".$tag."%' GROUP BY t.post_id";
					$query = $this->db->query($sql);
					if($result = $query->result()){
						return $result;
					}


			} //end foreach tags
		} //end is array
	}
	public function insert_in_table($table,$data)
	{
		# code...
		return $this->db->insert($table,$data);
	}
	public function update_in_table($table,$data)
	{
		# code...
		return $this->db->update_batch($table,$data,'post_id');
	}

	public function insert_other_info($tbl=false,$data=false)
	{
		# code...
		if ($tbl && is_array($data)) {
			$i = 0;
			foreach ($data as $r) {
						$id = 0;
						$id2 = 0;
				//if ($tbl == 'post_panel' || $tbl == 'post_committee') {

						$sql = sprintf("SELECT id FROM `col_names` WHERE fullname = '%s'",$r['fullname']);
						$query = $this->db->query($sql);
						if (!$result = $query->result()) {

						$this->db->insert('col_names',array('fullname'=>$r['fullname']));
							$id = $this->db->insert_id();
						}else{
							$id = $result[0]->id;
						}
						$r['id'] = $id;


						$sql2 = sprintf("SELECT id FROM `col_roles` WHERE role_name = '%s'",$r['position']);
						$query2 = $this->db->query($sql2);
						if (!$result2 = $query->result()) {

						$this->db->insert('col_roles',array('role_name'=>$r['position']));
							$id2 = $this->db->insert_id();
						}else{
							$id2 = $result2[0]->id;
						}
						$r['id'] = $id2;

					$arr['post_id'] = $r['post_id'];
					$arr['names_id'] = $r['id'];
					$arr['position'] = $r['position'];
				//}

				$this->db->insert($tbl,$arr);
				$i++;

			}
			return true;

		}
		return false;
	}
	

	public function get_role_id($str=false)
	{
		# code...
		if($str){
			$q = $this->db
					->select('id')
					->from('col_roles')
					->where('role_name',$str)
					->get();
					if($result = $q->result()){
						return $result[0]->id;
					}else{
						$this->db->insert('col_roles',array('role_name'=>$str));
						return $this->db->insert_id();
					}
		}
	}
	public function get_name_id($str=false)
	{
		# code...
		if($str){
			$q = $this->db
					->select('id')
					->from('col_names')
					->where('fullname',$str)
					->get();
					if($result = $q ->result()){
						return $result[0]->id;
					}else{
						$this->db->insert('col_names',array('fullname'=>$str));
						return $this->db->insert_id();
					}
		}
	}
	public function insert_info_by_batch($data=false)
	{
		# code...
		if ($data) {
			return $this->db->insert_batch('post_other_information',$data);
		}
	}

	public function update_post_by_batch($data=false)
	{
		# code...

		if(($data)){
			if(is_array($data)){
				//$data[]=$data;
				return $this->db->update_batch('post',$data,'page_id');
			}

		}
	}

}