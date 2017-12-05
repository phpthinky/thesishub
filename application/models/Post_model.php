<?php
/**
* 
*/
class Post_model extends CI_Model
{
	
	function __construct()
	{
		# code...
		parent::__construct();
	}
    public function limitext($string='')
    {
        # code...
        $string = strip_tags($string);

        if (strlen($string) > 50) {

            // truncate string
            $stringCut = substr($string, 0, 50);

            // make sure it ends in a word so assassinate doesn't become ass...
            $string = substr($stringCut, 0, strrpos($stringCut, ' ')); 
        }
        return $string;
    }

	public function isExist($value='')
	{
		# code...
		$this->db->select('*');
		$this->db->where('title',$value);
		if($this->db->get('pages')->result()){
			return true;
		}else{
			return false;
		}
	}
	public function save_abstract($value='')
	{


		if($this->db->insert('pages',array('title'=>$value['title'],'slug'=>$value['slug'],'year_presented'=>$value['year'],'date_presented'=>$value['month']))){
			//var_dump($pages);

		$id = $this->db->insert_id();

		$content  = array('name' => 'content','value'=>$value['content'],'group_id'=>$id,'date_updated'=>date("Y-d-m") );
		$result = $this->db->insert('page_contents',$content);
		
		return $id;
		}
		//var_dump($id);
		return false;
	}
	    public function get_current_page_records($limit, $start) 
    {
        $this->db->limit($limit, $start);
        $query = $this->db->get("pages");
 
        if ($query->num_rows() > 0) 
        {
            foreach ($query->result() as $row) 
            {
                $data[] = $row;
            }
             
            return $data;
        }
 
        return false;
    }
     
    public function get_total() 
    {
        return $this->db->count_all("pages");
    }

    public function get_pageTitle($slug = '') 
    {
        if($slug <> ''){
            $query = $this->db->select('title')->from('pages')->where('slug',$slug)->get();
            if($query->num_rows() > 0){
                foreach ($query->result() as $key) {
                    # code...
                    return $key->title;
                }
            }else{
                    return 0;
            }
        }
        return 0;
    }

    public function get_pageId($slug = '') 
    {
    	if($slug <> ''){
    		$query = $this->db->select('page_id')->from('pages')->where('slug',$slug)->get();
    		if($query->num_rows() > 0){
    			foreach ($query->result() as $key) {
    				# code...
    				return $key->page_id;
    			}
    		}else{
    				return 0;
    		}
    	}
        return 0;
    }

    public function get_content($id = 0) 
    {
    	if($id > 0){
    		$query = $this->db->select('value')->from('page_contents')->where(array('name'=>'content','group_id'=>$id))->get();
    		if($query->num_rows() > 0){
    			foreach ($query->result() as $key) {
    				# code...
    				return $key->value;
    			}
    		}else{
    				return null;
    		}
    	}
        return null;
    }

    public function get_proponents($id = 0) 
    {
    	if($id > 0){
    		$query = $this->db->select('value')->from('page_contents')->where(array('name'=>'proponents','group_id'=>$id))->get();
    		if($query->num_rows() > 0){
    			foreach ($query->result() as $key) {
    				# code...
    				return $key->value;
    			}
    		}else{
    				return null;
    		}
    	}
        return null;
    }

    public function get_clients($id = 0) 
    {
    	if($id > 0){
    		$query = $this->db->select('value')->from('page_contents')->where(array('name'=>'clients','group_id'=>$id))->get();
    		if($query->num_rows() > 0){
    			foreach ($query->result() as $key) {
    				# code...
    				return $key->value;
    			}
    		}else{
    				return null;
    		}
    	}
        return null;
    }

    public function insert($data=null)
    {
    	# code...
    	if($data !== null){

		//$content  = array('name' => 'content','value'=>$value['content'],'group_id'=>$id,'date_updated'=>date("Y-d-m") );
		$result = $this->db->insert('page_contents',$data);
    		return$result;
    	}else{
    		return false;
    	}
    }

    public function insertTags($data=null)
    {
    	# code...
    	if($data !== null){


		$result = $this->db->insert('page_tag',$data);
    		return$result;
    	}else{
    		return false;
    	}
    }
    public function page_permission($page=false,$group=false,$perm=0)
    {
        # code...
        if ($group && $page) {
            # code...
            $sql = "INSERT INTO `page_perm_group` (`page_id`, `group_id`, `perm_id`) VALUES (?, ?, ?)";
            $result = $this->db->query($sql,array($page,$group,$perm));
            return $result;

        }
        return false;


    }

    public function search($tags='',$limit,$start)
    {
    	# code...

    $tags = explode(' ',$tags) ;
	foreach ($tags as $keyword) {
	# code...

    $this->db->select('p.*,t.keyword');
    $this->db->from('pages p'); 
    $this->db->join('page_tag t', 't.group_id=p.page_id', 'left');
    $this->db->join('page_contents c', 'c.group_id=t.group_id','right');
    //$this->db->where('c.album_id',$id);
    $this->db->like('t.keyword',$keyword);
    $this->db->or_like('p.title',$keyword);
    $this->db->or_like('c.value',$keyword);
    $this->db->limit($limit,$start);
    $this->db->group_by('p.page_id'); 
    $this->db->order_by('p.page_id','asc');  

    $query = $this->db->get(); 
    if($query->num_rows() != 0)
    {
        return $query->result();
    }
	}
    
        return false;
    

    }

    public function searchBy($tags='',$limit,$start,$filter,$by)
    {
        # code...

    $tags = explode(' ',$tags) ;
    foreach ($tags as $keyword) {
    # code...
        $sql = sprintf("SELECT p.*,t.keyword FROM pages p left join page_tag t on t.group_id = p.page_id left join page_contents c on c.group_id = t.group_id where t.keyword like '%s' or  p.title like '%s' or c.value = '%s' and %s = '%s' ",$v,$v,$v,$filter,$by); 


    $query = $this->db->get(); 
    if($query->num_rows() != 0)
    {
        return $query->result();
    }
    }
    
        return false;
    

    }

    public function like_total($tags='')
    {
    	# code...
    $tags = explode(' ',$tags) ;
	foreach ($tags as $keyword) {


    $this->db->select('p.*,t.keyword');
    $this->db->from('pages p'); 
    $this->db->join('page_tag t', 't.group_id=p.page_id', 'left');
    $this->db->join('page_contents c', 'c.group_id=p.page_id', 'left');
    //$this->db->where('c.album_id',$id);
    $this->db->like('t.keyword',$keyword);
    $this->db->or_like('p.title',$keyword);
    $this->db->or_like('c.value',$keyword);
   // $this->db->limit($limit,$start);
    $this->db->order_by('p.page_id','asc');  

    $query = $this->db->get(); 
    if($query->num_rows() != 0)
    {
        return count($query->result());
    }
	}
	return 0;
    
    }




}
