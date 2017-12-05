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
	public function find($uid=false,$string=false,$group=false)
	{
		# code...

		$sql = "SELECT p.page_id,p.title,p.slug,c.value as content FROM pages p INNER JOIN page_contents c on c.group_id = p.page_id INNER JOIN page_perm_group pg on p.page_id = pg.page_id WHERE c.name='content' AND pg.group_id=?";
		$result = $this->db->query($sql,$group);
		return $result->result();
	}
}