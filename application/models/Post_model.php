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
		if($this->db->get('post')->result()){
			return true;
		}else{
			return false;
		}
	}
	public function save_abstract($value='')
	{


		if($this->db->insert('post',array('title'=>$value['title'],'slug'=>$value['slug'],'year_presented'=>$value['year'],'date_presented'=>$value['month']))){
			//var_dump($post);

		$id = $this->db->insert_id();

		$content  = array('name' => 'content','value'=>$value['content'],'group_id'=>$id,'date_updated'=>date("Y-d-m") );
		$result = $this->db->insert('post_content',$content);
		
		return $id;
		}
		//var_dump($id);
		return false;
	}
	    public function get_current_page_records($limit, $start) 
    {
        $this->db->limit($limit, $start);
        $query = $this->db->get("post");
 
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
        return $this->db->count_all("post");
    }

    public function get_pageTitle($slug = '') 
    {
        if($slug <> ''){
            $query = $this->db->select('title')->from('post')->where('slug',$slug)->get();
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
    		$query = $this->db->select('page_id')->from('post')->where('slug',$slug)->get();
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
    		$query = $this->db->select('value')->from('post_content')->where(array('name'=>'content','group_id'=>$id))->get();
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
    		$query = $this->db->select('value')->from('post_content')->where(array('name'=>'proponents','group_id'=>$id))->get();
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
            $query = $this->db->select('value')->from('post_content')->where(array('name'=>'clients','group_id'=>$id))->get();
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
    public function get_year($id = 0) //get year presented of the requested post
    {
        if($id > 0){
            $query = $this->db->select('year_presented')->from('post')->where('page_id',$id)->get();
            if($query->num_rows() > 0){
                foreach ($query->result() as $key) {
                    # code...
                    return $key->year_presented;
                }
            }else{
                    return false;
            }
        }
        return false;
    }
    public function get_year_posted($keyword='')
    {
        # code...
        $sql = "SELECT year_presented as years FROM post  GROUP BY year_presented ORDER BY year_presented DESC";
        $query = $this->db->query($sql);
        if($result = $query->result()){
            return $result;
        }
        return 0;
    }

    public function insert($data=null)
    {
    	# code...
    	if($data !== null){

		//$content  = array('name' => 'content','value'=>$value['content'],'group_id'=>$id,'date_updated'=>date("Y-d-m") );
		$result = $this->db->insert('post_content',$data);
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
            $sql = "INSERT INTO `pos_perm_group` (`page_id`, `group_id`, `perm_id`) VALUES (?, ?, ?)";
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
    $this->db->from('post p'); 
    $this->db->join('pst_tag t', 't.group_id=p.page_id', 'left');
    $this->db->join('post_content c', 'c.group_id=t.group_id','right');
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
        $sql = sprintf("SELECT p.*,t.keyword FROM post p left join page_tag t on t.group_id = p.page_id left join post_content c on c.group_id = t.group_id where t.keyword like '%s' or  p.title like '%s' or c.value = '%s' and %s = '%s' ",$v,$v,$v,$filter,$by); 


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
    $this->db->from('post p'); 
    $this->db->join('page_tag t', 't.group_id=p.page_id', 'left');
    $this->db->join('post_content c', 'c.group_id=p.page_id', 'left');
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
