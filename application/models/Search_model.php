<?php  

/**
* 
*/
class Search_model extends CI_Model
{
	
	function __construct()
	{
		# code...
		parent::__construct();
	}
	public function find($uid=false,$string=false,$group_ids=false,$limit=false,$start=false)
	{
		# code...
		$rows='';
		if($string){
		foreach ($string as $tags) {

		$tags = $this->db->escape_str($tags);

			// if the user is an admin
			if($this->aauth->is_admin()){
				$sql = "SELECT p.page_id,p.title,p.year_presented as year,p.slug,c.value as content,t.keyword,pg.group_id,ag.name FROM pages p INNER JOIN page_contents c on c.group_id = p.page_id INNER JOIN page_perm_group pg on p.page_id = pg.page_id INNER JOIN aauth_groups ag on pg.group_id = ag.id LEFT JOIN page_tag t on t.group_id = p.page_id WHERE c.name='content' AND t.keyword LIKE '".$tags."%' ORDER BY p.page_id ASC LIMIT ".$start.",".$limit;
							$result = $this->db->query($sql);
								if($result->num_rows() > 0){

								$rows = $result->result();
								}

			
			}// end of admin accessed
			else{
						



			if(is_array($group_ids)){

				foreach ($group_ids as $key) {
					# code...
						# code...
						$sql = "SELECT p.page_id,p.title,p.year_presented as year,p.slug,c.value as content,t.keyword,pg.group_id,ag.name FROM pages p INNER JOIN page_contents c on c.group_id = p.page_id INNER JOIN page_perm_group pg on p.page_id = pg.page_id INNER JOIN aauth_groups ag on pg.group_id = ag.id LEFT JOIN page_tag t on t.group_id = p.page_id WHERE c.name='content' AND pg.group_id=? AND t.keyword LIKE '".$tags."%' ORDER BY p.page_id ASC LIMIT ".$start.",".$limit;
							$result = $this->db->query($sql,$key);
								if($result->num_rows() > 0){

								$rows = $result->result();
								}
				}								
			}

		}




			}
		}else{
			if($this->aauth->is_admin()){

						$sql = "SELECT p.page_id,p.title,p.year_presented as year,p.slug,c.value as content,t.keyword,pg.group_id,ag.name FROM pages p INNER JOIN page_contents c on c.group_id = p.page_id INNER JOIN page_perm_group pg on p.page_id = pg.page_id INNER JOIN aauth_groups ag on pg.group_id = ag.id  LEFT JOIN page_tag t on t.group_id = p.page_id WHERE c.name='content' ORDER BY p.page_id ASC LIMIT ".$start.",".$limit;
							$result = $this->db->query($sql);
								if($result->num_rows() > 0){

								$rows = $result->result();
								}
			}else{
				if(is_array($group_ids)){

				foreach ($group_ids as $key) {
					# code...
						$sql = "SELECT p.page_id,p.title,p.year_presented as year,p.slug,c.value as content,t.keyword,pg.group_id,ag.name FROM pages p INNER JOIN page_contents c on c.group_id = p.page_id INNER JOIN page_perm_group pg on p.page_id = pg.page_id INNER JOIN aauth_groups ag on pg.group_id = ag.id  LEFT JOIN page_tag t on t.group_id = p.page_id WHERE c.name='content' AND pg.group_id=? ORDER BY p.page_id ASC LIMIT ".$start.",".$limit;
							$result = $this->db->query($sql,$key);
								if($result->num_rows() > 0){

								$rows = $result->result();
								}
				}								
				}				
			}



		}
		
		
			



		return $rows;
	}

	public function page_total($group_ids=false,$string=false)
	{
		# code...
		$num = 0;
		if($string){
			foreach ($string as $tags) {
				# code...
				if ($this->aauth->is_admin()) {
					# code...

							# code...
						$sql = "SELECT p.page_id,p.title,p.year_presented as year,p.slug,c.value as content,t.keyword,pg.group_id,ag.name FROM pages p INNER JOIN page_contents c on c.group_id = p.page_id INNER JOIN page_perm_group pg on p.page_id = pg.page_id INNER JOIN aauth_groups ag on pg.group_id = ag.id  LEFT JOIN page_tag t on t.group_id = p.page_id WHERE c.name='content' AND t.keyword LIKE '".$tags."%' ORDER BY p.year_presented DESC";
						$result = $this->db->query($sql);
						$num += $result->num_rows();
						return $num;
				}else{
				if(is_array($group_ids)){

						foreach ($group_ids as $key) {
							# code...
						$sql = "SELECT p.page_id,p.title,p.year_presented as year,p.slug,c.value as content,t.keyword,pg.group_id,ag.name FROM pages p INNER JOIN page_contents c on c.group_id = p.page_id INNER JOIN page_perm_group pg on p.page_id = pg.page_id INNER JOIN aauth_groups ag on pg.group_id = ag.id  LEFT JOIN page_tag t on t.group_id = p.page_id WHERE c.name='content' AND pg.group_id=? AND t.keyword LIKE '".$tags."%' ORDER BY p.year_presented DESC";
						$result = $this->db->query($sql,$key);
						$num += $result->num_rows();
						}
						return $num;
				}}

			}

		}else{
			if ($this->aauth->is_admin()) {
				# code...

					$sql = "SELECT p.page_id,p.title,p.year_presented as year,p.slug,c.value as content,t.keyword,pg.group_id,ag.name FROM pages p INNER JOIN page_contents c on c.group_id = p.page_id INNER JOIN page_perm_group pg on p.page_id = pg.page_id INNER JOIN aauth_groups ag on pg.group_id = ag.id LEFT JOIN page_tag t on t.group_id = p.page_id WHERE c.name='content' ORDER BY p.year_presented DESC";
					$result = $this->db->query($sql);
					$num += $result->num_rows();
					return $num;
			}
			if(is_array($group_ids)){

					foreach ($group_ids as $key) {
						# code...
					$sql = "SELECT p.page_id,p.title,p.year_presented as year,p.slug,c.value as content,t.keyword,pg.group_id,ag.name FROM pages p INNER JOIN page_contents c on c.group_id = p.page_id INNER JOIN page_perm_group pg on p.page_id = pg.page_id INNER JOIN aauth_groups ag on pg.group_id = ag.id LEFT JOIN page_tag t on t.group_id = p.page_id WHERE c.name='content' AND pg.group_id=? ORDER BY p.year_presented DESC";
					$result = $this->db->query($sql,$key);
					$num += $result->num_rows();
					}
					return $num;
			}
		}
	}
}