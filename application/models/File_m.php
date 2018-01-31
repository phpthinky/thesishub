<?php 

/**
* 
*/
class File_m extends CI_Model
{
	
	function __construct()
	{
		# code...
		parent::__construct();
	}

	public function allow_user($post_id=false,$status = false)
	{
		# code...
		if ($post_id) {
			# code...
			if($status < 1){

			$this->db->set('status',1);
			$this->db->WHERE('page_id',$post_id);
			return $this->db->update('post');
			}else{

			$this->db->set('status',0);
			$this->db->WHERE('page_id',$post_id);
			return $this->db->update('post');
			}
		}
	}

	public function title($title = false){

		if($title){
			
		$result = $this->db->select('*')->from('post')->where('title',$title)->get()->result();
		return count($result);
		}else{
			return 0;
		}

	}

	public function course_title($title = false){

		if($title){
			
		$result = $this->db->select('*')->from('aauth_groups')->where('name',$title)->get()->result();
		return count($result);
		}else{
			return false;
		}

	}
		public function title_and_id($title = false,$id = 0){

		if($title && $id > 0){
			
		$result = $this->db->select('*')
		->from('post')
		->where(array('title'=>$title,'page_id'=>$id))
			->get()->result();
		return count($result);
		}else{
			return 0;
		}

	}
	public function save_download($data=false)
	{
		# code...
		if ($data) {
			if($data['post_id'] == NULL){
				$data['post_id'] = 0;
			}
			
			return $this->db->insert('post_download',$data);

		}
	}
	public function save_resource_info($info,$desc=false)
	{
		if (is_array($info)) {
			# code...
			$this->db->insert('post',$info);
			$id = $this->db->insert_id();
			if ($desc) {

			$this->db->insert('post_content',array('name'=>'description','value'=>$desc,'post_id'=>$id));
			
			}
			return $id;

		}
		return false;

	}
	public function update_resource_info($info,$desc=false)
	{
		if (is_array($info)) {
			# code...
			$this->db->where('page_id',$info['page_id']);
			return $this->db->update_batch('post',array($info),'page_id');
			//if ($desc) {

			//$this->db->insert('post_content',array('name'=>'description','value'=>$desc,'post_id'=>$id));
			
			//$this->db->where(array('post_id'=>$info['page_id'],'name'=>'description'));
			//$this->db->update_batch('post_content',array(array('value'=>$desc,'post_id'=>$info['page_id'])),'post_id');
			//}
			//return true;

		}
		return false;

	}
	public function update_file_title($file_id,$caption)
	{
		if ($caption) {
			# code...
			$this->db->where('id',$file_id);
			return $this->db->update('post_file',array('title'=>$caption));		

		}
		return false;

	}
	public function update_file_caption($file_id,$caption)
	{
		if ($caption) {
			# code...
			$this->db->where('id',$file_id);
			return $this->db->update('post_file',array('caption'=>$caption));		

		}
		return false;

	}
	public function save_resource($file=false)
	{
		# code...

			if ($file) {

			 return $this->db->insert('post_files',$file);

			}
			return false;
	}
	public function save_file_array($data)
	{
		if (is_array($data)) {
			return $this->db->insert_batch('post_file',$data);
		}
	
		
	}
	public function remove_one_file($id=false){
	    if($id){

		$query = $this->db->get_where('post_file',array('id'=>$id));
		if($result = $query->result()){
			foreach ($result as $key) {
				unlink($key->link);
			}
		}
		$this->db->where('id',$id);	
		$this->db->delete('post_file');
		return true;

	    }
	    return false;
		
	}
	public function delete_file($post_id=false){
	    if($post_id){
		$this->db->where('page_id',$post_id);		
		$this->db->delete('post');


		$query = $this->db->get_where('post_file',array('post_id'=>$post_id));
		if($result = $query->result()){
			foreach ($result as $key) {
				# code...
				unlink($key->link);
			}
		}


	    	$tables = array(	    		
	    		'post_tag',
	    		'post_by_course',
	    		'post_other_information',
	    		'post_file'
	    		);

		$this->db->where('post_id',$post_id);	
		$this->db->delete($tables);
		return true;

	    }
	    return false;
		
	}

	public function post_perm_exist($post_id=0,$perm_id=0,$user_id=0)
	{
		# code...
		if ($post_id > 0 && $perm_id > 0 && $user_id > 0) {
			
			$sql = sprintf("SELECT * FROM pos_perm_user WHERE post_id = %d AND perm_id = %d AND user_id = %d",$post_id,$perm_id,$user_id);
			$query = $this->db->query($sql);
			if ($result = $query->result()) {
				# code...
				return $result;
			}
			return false;
		}
			return false;
	}

	public function post_perm($post_id=0,$perm_id=0,$user_id=0)
	{
		# code...
		if ($post_id > 0 && $perm_id > 0 && $user_id > 0) {

					# code...
				if(!$this->post_perm_exist($post_id,$perm_id)){
					return $this->db->insert('pos_perm_user',array('post_id'=>$post_id,'perm_id'=>$perm_id,'user_id'=>$user_id));
				}	
			return false;
		}
			return false;
	}
	public function lisfile($limit = 10,$start=0,$perm= false){


		if($this->aauth->is_loggedin() && $this->session->userdata['permit'] == 'public'){
				if ($start > 0) {
					$this->db->select('*')
							->from('post')
							->where('status !=',3)
							->order_by('date_created','desc')
							->limit($start,$limit);
							$q = $this->db->get();
							return $q->result();
				}else{

					$this->db->select('*')
							->from('post')
							->where('status !=',3)
							->order_by('date_created','desc')
							->limit($limit);
							$q = $this->db->get();
							return $q->result();

				}
		}
		if($this->aauth->is_loggedin() &&  $this->session->userdata['permit'] == 'students'){
					if ($start > 0) {
					$this->db->select('*')
							->from('post')
							->where('status !=',3)
							->order_by('date_created','desc')
							->limit($start,$limit);
							$q = $this->db->get();
							return $q->result();
				}else{

					$this->db->select('*')
							->from('post')
							->where('status !=',3)
							->order_by('date_created','desc')
							->limit($limit);
							$q = $this->db->get();
							return $q->result();

				}

		}

		if($this->aauth->is_loggedin() &&  $this->session->userdata['permit'] == 'instructors'){
					if ($start > 0) {
					$this->db->select('*')
							->from('post')
							->where('status !=',3)
							->order_by('date_created','desc')
							->limit($start,$limit);
							$q = $this->db->get();
							return $q->result();
				}else{

					$this->db->select('*')
							->from('post')
							->where('status !=',3)
							->order_by('date_created','desc')
							->limit($limit);
							$q = $this->db->get();
							return $q->result();

				}

		}

		if($this->aauth->is_loggedin()){
					if ($start > 0) {
					$this->db->select('*')
							->from('post')
							->order_by('date_created','desc')
							->limit($start,$limit);
							$q = $this->db->get();
							return $q->result();
				}else{

					$this->db->select('*')
							->from('post')
							->order_by('date_created','desc')
							->limit($limit);
							$q = $this->db->get();
							return $q->result();

				}

		}else{

					if ($start > 0) {
					$this->db->select('*')
							->from('post')
							->where('status',2)
							->order_by('date_created','desc')
							->limit($start,$limit);
							$q = $this->db->get();
							return $q->result();
				}else{

					$this->db->select('*')
							->from('post')
							->where('status',2)
							->order_by('date_created','desc')
							->limit($limit);
							$q = $this->db->get();
							return $q->result();

				}
		}
	}



	public function file_total($q = false,$perm = false)
	{
		if($this->aauth->is_loggedin() && $this->session->userdata['permit'] == 'public'){

			if ($q) {
			# code...
			if (is_array($q)) {
				# code...
				foreach ($q as $key) {
					# code...
				$sql = "SELECT *  FROM post as p LEFT JOIN post_tag as t ON t.post_id = p.page_id WHERE t.keyword LIKE '%".$key."%'  AND p.status != 3 GROUP BY t.post_id  ORDER BY p.title ASC";

				$query = $this->db->query($sql);
				$num = $query->num_rows();

				}
				return $num;
			}
		}else{

		$sql = "SELECT * FROM post";
		$query = $this->db->query($sql);
		return $query->num_rows();

		}
		return false;
	}
	if($this->aauth->is_loggedin() && $this->session->userdata['permit'] == 'students'){

			if ($q) {
			# code...
			if (is_array($q)) {
				# code...
				foreach ($q as $key) {
					# code...
				$sql = "SELECT *  FROM post as p LEFT JOIN post_tag as t ON t.post_id = p.page_id WHERE t.keyword LIKE '%".$key."%'  AND p.status != 3 GROUP BY t.post_id  ORDER BY p.title ASC";

				$query = $this->db->query($sql);
				$num = $query->num_rows();

				}
				return $num;
			}
		}else{

		$sql = "SELECT * FROM post";
		$query = $this->db->query($sql);
		return $query->num_rows();

		}
		return false;
	}

	if($this->aauth->is_loggedin() && $this->session->userdata['permit'] == 'instructors'){

			if ($q) {
			# code...
			if (is_array($q)) {
				# code...
				foreach ($q as $key) {
					# code...
				$sql = "SELECT *  FROM post as p LEFT JOIN post_tag as t ON t.post_id = p.page_id WHERE t.keyword LIKE '%".$key."%'  AND p.status != 3 GROUP BY t.post_id  ORDER BY p.title ASC";

				$query = $this->db->query($sql);
				$num = $query->num_rows();

				}
				return $num;
			}
		}else{

		$sql = "SELECT * FROM post";
		$query = $this->db->query($sql);
		return $query->num_rows();

		}
		return false;
	}


		if($this->aauth->is_loggedin()){
			if ($q) {
			# code...
			if (is_array($q)) {
				# code...
				foreach ($q as $key) {
					# code...
			$sql = "SELECT *  FROM post as p LEFT JOIN post_tag as t ON t.post_id = p.page_id WHERE t.keyword LIKE '%".$key."%' GROUP BY t.post_id  ORDER BY p.title ASC";

				$query = $this->db->query($sql);
				$num = $query->num_rows();

				}
				return $num;
			}
		}else{

		$sql = "SELECT * FROM post";
		$query = $this->db->query($sql);
		return $query->num_rows();

		}
	}else{
		if ($q) {
			# code...
			if (is_array($q)) {
				# code...
				foreach ($q as $key) {
					# code...

				$sql = "SELECT * FROM post WHERE status = 2 AND title LIKE '%".$key."%'";
				$query = $this->db->query($sql);
				$num = $query->num_rows();

				}
				return $num;
			}
		}else{

		$sql = "SELECT * FROM post WHERE status = 2";
		$query = $this->db->query($sql);
		return $query->num_rows();

		}
	}

	}

	public function latest_file($id=false,$limit=false,$perm=false)
	{
		# code...
			      
		if($this->aauth->is_loggedin() && $this->session->userdata['permit'] == 'public'){

		if($limit){

		$sql = "SELECT  p.page_id, p.title,p.slug,year(dp.ate_created) as years, p.contents as description FROM post as p WHERE  p.status != 3  ORDER BY p.date_created DESC LIMIT ".$limit;
		$query = $this->db->query($sql);
		return $query->result();
		}
		$sql = "SELECT  p.page_id, p.title,p.slug,year(p.date_created)  as years, p.contents as description FROM post as p WHERE  p.status != 3  ORDER BY p.date_created DESC LIMIT 12";
		$query = $this->db->query($sql);
		return $query->result();
	}	 

		if($this->aauth->is_loggedin() && $this->session->userdata['permit'] == 'students'){

		if($limit){

		$sql = "SELECT  p.page_id, p.title,p.slug,year(p.date_created) as years, p.contents as description FROM post as p WHERE  p.status != 3  ORDER BY p.date_created DESC LIMIT ".$limit;
		$query = $this->db->query($sql);
		return $query->result();
		}
		$sql = "SELECT  p.page_id, p.title,p.slug,year(p.date_created)  as years, p.contents as description FROM post as p WHERE  p.status != 3  ORDER BY p.date_created DESC LIMIT 12";
		$query = $this->db->query($sql);
		return $query->result();
	}	

			if($this->aauth->is_loggedin() && $this->session->userdata['permit'] == 'instructors'){

		if($limit){

		$sql = "SELECT  p.page_id, p.title,p.slug,year(p.date_created) as years, p.contents as description FROM post as p  where p.status != 3  ORDER BY p.date_created DESC LIMIT ".$limit;
		$query = $this->db->query($sql);
		return $query->result();
		}
		$sql = "SELECT  p.page_id, p.title,p.slug,year(p.date_created)  as years, p.contents as description FROM post as p  where p.status != 3  ORDER BY p.date_created DESC LIMIT 12";
		$query = $this->db->query($sql);
		return $query->result();
	}

		if($this->aauth->is_loggedin()){

		if($limit){

		$sql = "SELECT  p.page_id, p.title,p.slug,year(p.date_created) as years, p.contents as description FROM post as p  ORDER BY p.date_created DESC LIMIT ".$limit;
		$query = $this->db->query($sql);
		return $query->result();
		}
		$sql = "SELECT  p.page_id, p.title,p.slug,year(p.date_created)  as years, p.contents as description FROM post as p ORDER BY p.date_created DESC LIMIT 12";
		$query = $this->db->query($sql);
		return $query->result();
	}else{

		if($limit){

		$sql = "SELECT  p.page_id, p.title,p.slug,year(p.date_created)  as years, p.contents as description FROM post as p   WHERE p.status = 2 ORDER BY p.date_created DESC LIMIT ".$limit;
		$query = $this->db->query($sql);
		return $query->result();
		}
		$sql = "SELECT  p.page_id, p.title,p.slug,year(p.date_created)  as years, p.contents as description FROM post as p    WHERE  p.status = 2 ORDER BY p.date_created DESC LIMIT 12";
		$query = $this->db->query($sql);
		return $query->result();
	}

	}

	public function get_link($filename=false,$id = false, $allowed = false)
	{
		# code...
		if ($filename) {
			# code...

	    $this->db->select('link');
	    	$this->db->where(array('newfilename' =>$filename,'id'=>$id));
            $this->db->or_where(array('newfilename' =>$filename));
            $query = $this->db->get('post_file');
			if($result = $query->result()){
				return $result[0]->link;
			}
		}
		else{
			return false;
		}
	}

	public function get_unlink($id = false)
	{
		# code...
		
			return false;
		
	}
	public function get_type($filename=false,$id = false, $allowed = false)
	{
		# code...
		if ($id) {
			# code...

	    $this->db->select('mtype');
	    	$this->db->where(array('newfilename' =>$filename,'id'=>$id));
            $query = $this->db->get('post_file');
			if($result = $query->result()){
				return $result[0]->mtype;
			}
		}
		else{
			return false;
		}
	}

	public function get_post_by_user($user_id='',$limit=0,$start = false)
	{
				# code...
		if (is_numeric($user_id)) {
			# code...

		$sql = "SELECT p.page_id, p.title, p.contents as description,p.slug,year(date_created) as years FROM post as p WHERE p.posted_by = '".$user_id."' ORDER BY p.date_created DESC LIMIT ".$limit;
		$query = $this->db->query($sql);
		return $query->result();
		}else{
			return false;
		}
	}


	public function get_file_info($id=false)
	{
		# code...

		if (is_string($id)) {
			# code...

			$query = $this->db->select('post.page_id,post.title,post.slug,post.status,post.group_course,post.contents as description,month(post.date_created) as months,year(post.date_created) as years,DAYOFMONTH(post.date_created) as days,post.bookno')
					->from('post')
					->where(array('post.slug'=>$id))
					->get();

		if ($result = $query->result()) {
			return $result;
		}
		}
		return false;

	}

	public function get_file_info_id($id=false)
	{
		# code...

		if (is_numeric($id)) {
			# code...

			$query = $this->db->select('post.page_id,post.title,post.slug,post.status,post.group_course,post.contents as description,month(post.date_created) as months,year(post.date_created) as years,DAYOFMONTH(post.date_created) as days,post.implemented')
					->from('post')					
					->where(array('post.page_id'=>$id))
					->get();

		if ($result = $query->result()) {
			return $result;
		}
		}
		return false;

	}
	public function get_files($post_id=false)
	{
		# code...
		if ($post_id && is_numeric($post_id)) {
			$query = $this->db->get_where('post_file', array('post_id' => $post_id));
			return $query->result();
		}
	}
	public function get_tags($post_id=false)
	{
		# code...
		if ($post_id && is_numeric($post_id)) {
			$this->db->select('keyword');
			$query = $this->db->get_where('post_tag', array('post_id' => $post_id));
			return $query->result();
		}
	}
	public function find($q='',$limit=false,$start = 0)
	{
		# code...
		$rows =false;
		if($this->aauth->is_loggedin() && $this->session->userdata['permit'] == 'public'){

			if (is_array($q)) {
				foreach ($q as $key) {
					# code...
					if($limit > 0){
						if($start > 0){

						$query = $this->db->select('p.page_id, p.title, p.contents as description,year(p.date_created) as years,p.slug')
									->from('post as p')
									
									->join('post_tag as t','t.post_id = p.page_id','left')
									->where('p.status !=',3)
									->like('t.keyword',$key,'both')
									->limit($start,$limit)
									->get();
									$rows[] = $query->result();
								}else{

						$query = $this->db->select('p.page_id, p.title, p.contents as description,year(p.date_created) as years,p.slug')
									->from('post as p')
									
									->join('post_tag as t','t.post_id = p.page_id','left')
									
									->where('p.status !=',3)
									->like('t.keyword',$key,'both')
									->limit($limit)
									->get();
									$rows[] = $query->result();
								}

								
					}else{
						$query = $this->db->select('p.page_id, p.title, p.contents as description,year(p.date_created) as years,p.slug')
									->from('post as p')
									
									->join('post_tag as t','t.post_id = p.page_id','left')
									
									->where('p.status !=',3)
									->like('t.keyword',$key,'both')
									->get();
									$rows[] = $query->result();

					}
				}
			}

			return $rows;
		}
if($this->aauth->is_loggedin() && $this->session->userdata['permit'] == 'students'){

			if (is_array($q)) {
				foreach ($q as $key) {
					# code...
					if($limit > 0){
						if($start > 0){

						$query = $this->db->select('p.page_id, p.title, p.contents as description,year(p.date_created) as years,p.slug')
									->from('post as p')
									
									->join('post_tag as t','t.post_id = p.page_id','left')
									
									->where('p.status !=',3)
									->like('t.keyword',$key,'both')
									->limit($start,$limit)
									->get();
									$rows[] = $query->result();
								}else{

						$query = $this->db->select('p.page_id, p.title, p.contents as description,year(p.date_created) as years,p.slug')
									->from('post as p')
									
									->join('post_tag as t','t.post_id = p.page_id','left')
									
									->where('p.status !=',3)
									->like('t.keyword',$key,'both')
									->limit($limit)
									->get();
									$rows[] = $query->result();
								}

								
					}else{
						$query = $this->db->select('p.page_id, p.title, p.contents as description,year(p.date_created) as years,p.slug')
									->from('post as p')
									
									->join('post_tag as t','t.post_id = p.page_id','left')
									
									->where('p.status !=',3)
									->like('t.keyword',$key,'both')
									->get();
									$rows[] = $query->result();

					}
				}
			}

			return $rows;
		}if($this->aauth->is_loggedin() && $this->session->userdata['permit'] == 'instructors'){

			if (is_array($q)) {
				foreach ($q as $key) {
					# code...
					if($limit > 0){
						if($start > 0){

						$query = $this->db->select('p.page_id, p.title, p.contents as description,year(p.date_created) as years,p.slug')
									->from('post as p')
									
									->join('post_tag as t','t.post_id = p.page_id','left')
									
									->where('p.status !=',3)
									->like('t.keyword',$key,'both')
									->limit($start,$limit)
									->get();
									$rows[] = $query->result();
								}else{

						$query = $this->db->select('p.page_id, p.title, p.contents as description,year(p.date_created) as years,p.slug')
									->from('post as p')
									
									->join('post_tag as t','t.post_id = p.page_id','left')
									
									->where('p.status !=',3)
									->like('t.keyword',$key,'both')
									->limit($limit)
									->get();
									$rows[] = $query->result();
								}

								
					}else{
						$query = $this->db->select('p.page_id, p.title, p.contents as description,year(p.date_created) as years,p.slug')
									->from('post as p')
									
									->join('post_tag as t','t.post_id = p.page_id','left')
									
									->where('p.status !=',3)
									->like('t.keyword',$key,'both')
									->get();
									$rows[] = $query->result();

					}
				}
			}

			return $rows;
		}
		if($this->aauth->is_loggedin()){

			if (is_array($q)) {
				foreach ($q as $key) {
					# code...
					if($limit > 0){
						if($start > 0){

						$query = $this->db->select('p.page_id, p.title, p.contents as description,year(p.date_created) as years,p.slug')
									->from('post as p')
									
									->join('post_tag as t','t.post_id = p.page_id','left')
									
									->like('t.keyword',$key,'both')
									->limit($start,$limit)
									->get();
									$rows[] = $query->result();
								}else{

						$query = $this->db->select('p.page_id, p.title, p.contents as description,year(p.date_created) as years,p.slug')
									->from('post as p')
									
									->join('post_tag as t','t.post_id = p.page_id','left')
									
									->like('t.keyword',$key,'both')
									->limit($limit)
									->get();
									$rows[] = $query->result();
								}

								
					}else{
						$query = $this->db->select('p.page_id, p.title, p.contents as description,year(p.date_created) as years,p.slug')
									->from('post as p')
									
									->join('post_tag as t','t.post_id = p.page_id','left')
									
									->like('t.keyword',$key,'both')
									->get();
									$rows[] = $query->result();

					}
				}
			}

			return $rows;
		}else{
			if (is_array($q)) {
				foreach ($q as $key) {
					# code...
					if($limit > 0){
						if($start > 0){

						$query = $this->db->select('p.page_id, p.title, p.contents as description,year(p.date_created) as years,p.slug')
									->from('post as p')
									
									->join('post_tag as t','t.post_id = p.page_id','left')
									
									->where('p.status',2)
									->like('t.keyword',$key,'both')
									->limit($start,$limit)
									->get();
									$rows[] = $query->result();
								}else{

						$query = $this->db->select('p.page_id, p.title, p.contents as description,year(p.date_created) as years,p.slug')
									->from('post as p')
									
									->join('post_tag as t','t.post_id = p.page_id','left')
									
									->where('p.status',2)
									->like('t.keyword',$key,'both')
									->limit($limit)
									->get();
									$rows[] = $query->result();
								}

								
					}else{
						$query = $this->db->select('p.page_id, p.title, p.contents as description,year(p.date_created) as years,p.slug')
									->from('post as p')
									
									->join('post_tag as t','t.post_id = p.page_id','left')
									
									->where('p.status',2)
									->like('t.keyword',$key,'both')
									->get();
									$rows[] = $query->result();

					}
				}
			}

			return $rows;
		}
	}

	public function find_by_title($q='',$limit=false,$start = 0,$course=false)
	{
		if(is_string($q)){
			//exit();
			$rows = false;

		if($this->aauth->is_loggedin() && $this->session->userdata['permit'] == 'public'){

			if($limit > 0){
						if($start > 0){

						$this->db->select('p.page_id, p.title, p.contents as description,year(p.date_created) as years,p.slug')
									->from('post as p')
									->where('p.status !=',3);
									if($course){
										
									$this->db->where('p.group_course',$course);

									}
									$query = $this->db->where('p.title',$q)
									->limit($start,$limit)
									->get();
									$rows[] = $query->result();
								}else{

						$this->db->select('p.page_id, p.title, p.contents as description,year(p.date_created) as years,p.slug')
									->from('post as p')
									->where('p.status !=',3);
									if($course){
										
									$this->db->where('p.group_course',$course);

									}
									$query = $this->db->where('p.title',$q)
									->limit($limit)
									->get();
									$rows[] = $query->result();
								}

								
					}else{
						$this->db->select('p.page_id, p.title, p.contents as description,year(p.date_created) as years,p.slug')
									->from('post as p')
									->where('p.status !=',3);
									if($course){
										
									$this->db->where('p.group_course',$course);

									}
									$query = $this->db->where('p.title',$q)
									->get();
									$rows[] = $query->result();

					}
					return $rows;
				}
		if($this->aauth->is_loggedin() && $this->session->userdata['permit'] == 'students'){

			if($limit > 0){
						if($start > 0){

						$this->db->select('p.page_id, p.title, p.contents as description,year(p.date_created) as years,p.slug')
									->from('post as p')
									->where('p.status !=',3);
									if($course){
										
									$this->db->where('p.group_course',$course);

									}
								$query = 	$this->db->where('p.title',$q)
									->limit($start,$limit)
									->get();
									$rows[] = $query->result();
								}else{

						$this->db->select('p.page_id, p.title, p.contents as description,year(p.date_created) as years,p.slug')
									->from('post as p')
									->where('p.status !=',3);
									if($course){
										
									$this->db->where('p.group_course',$course);

									}
									$query = $this->db->where('p.title',$q)
									->limit($limit)
									->get();
									$rows[] = $query->result();
								}

								
					}else{
						$this->db->select('p.page_id, p.title, p.contents as description,year(p.date_created) as years,p.slug')
									->from('post as p')
									->where('p.status !=',3);
									if($course){
										
									$this->db->where('p.group_course',$course);

									}
								$query = 	$this->db->where('p.title',$q)
									->get();
									$rows[] = $query->result();

					}
					return $rows;

		}

		if($this->aauth->is_loggedin() && $this->session->userdata['permit'] == 'instructors'){
			
			if($limit > 0){
						if($start > 0){

						$this->db->select('p.page_id, p.title, p.contents as description,year(p.date_created) as years,p.slug')
									->from('post as p')
									->where('p.status !=',3);
									if($course){
										
									$this->db->where('p.group_course',$course);

									}
									$query = $this->db->where('p.title',$q)
									->limit($start,$limit)
									->get();
									$rows[] = $query->result();
								}else{

						$this->db->select('p.page_id, p.title, p.contents as description,year(p.date_created) as years,p.slug')
									->from('post as p')
									->where('p.status !=',3);
									if($course){
										
									$this->db->where('p.group_course',$course);

									}
								$query = 	$this->db->where('p.title',$q)
									->limit($limit)
									->get();
									$rows[] = $query->result();
								}

								
					}else{
						$this->db->select('p.page_id, p.title, p.contents as description,year(p.date_created) as years,p.slug')
									->from('post as p')
									->where('p.status !=',3);
									if($course){
										
									$this->db->where('p.group_course',$course);

									}
								$query = 	$this->db->where('p.title',$q)
									->get();
									$rows[] = $query->result();

					}
					return $rows;

		}

		if($this->aauth->is_loggedin()){
			
			if($limit > 0){
						if($start > 0){

						$this->db->select('p.page_id, p.title, p.contents as description,year(p.date_created) as years,p.slug')
									->from('post as p');
									if($course){
										
									$this->db->where('p.group_course',$course);

									}
							$query = 		$this->db->where('p.title',$q)
									->limit($start,$limit)
									->get();
									$rows[] = $query->result();
								}else{

						$this->db->select('p.page_id, p.title, p.contents as description,year(p.date_created) as years,p.slug')
									->from('post as p');
									if($course){
										
									$this->db->where('p.group_course',$course);

									}
									$query = $this->db->where('p.title',$q)
									->limit($limit)
									->get();
									$rows[] = $query->result();
								}

								
					}else{
						$this->db->select('p.page_id, p.title, p.contents as description,year(p.date_created) as years,p.slug')
									->from('post as p');
									if($course){

									$this->db->where('p.group_course',$course);

									}

									$query = $this->db->where('p.title',$q)
									->get();
									$rows[] = $query->result();

					}
					return $rows;

		}else{

# code...
					if($limit > 0){
						if($start > 0){

						$this->db->select('p.page_id, p.title, p.contents as description,year(p.date_created) as years,p.slug')
									->from('post as p')
																	
									->where('p.status',2);
									if($course){

									$this->db->where('p.group_course',$course);

									}

									$query = $this->db->where('p.title',$q)
									->limit($start,$limit)
									->get();
									$rows[] = $query->result();
								}else{

						$this->db->select('p.page_id, p.title, p.contents as description,year(p.date_created) as years,p.slug')
									->from('post as p')									
									->where('p.status',2);
									if($course){

									$this->db->where('p.group_course',$course);

									}

									$query = $this->db->where('p.title',$q)
									->limit($limit)
									->get();
									$rows[] = $query->result();
								}

								
					}else{
						$query = $this->db->select('p.page_id, p.title, p.contents as description,year(p.date_created) as years,p.slug')
									->from('post as p')
									
									->where('p.status',2);
									if($course){

									$this->db->where('p.group_course',$course);

									}

									$query = $this->db->where('p.title',$q)
									->get();
									$rows[] = $query->result();

					}
					return $rows;
		}


		}
	}
	public function find_by_course($q='',$limit=false,$start = 0,$course=false)
	{
		# code...
		$rows =false;
		if($this->aauth->is_loggedin() && $this->session->userdata['permit'] == 'public'){

			if (is_array($q)) {
				foreach ($q as $key) {
					# code...
					if($limit > 0){
						if($start > 0){

						$query = $this->db->select('p.page_id, p.title, p.contents as description,year(p.date_created) as years,p.slug')
									->from('post as p')
									
									->join('post_tag as t','t.post_id = p.page_id','left')
									
									->where('p.status !=',3)
									->where('p.group_course',$course)
									->like('t.keyword',$key,'both')
									->limit($start,$limit)
									->get();
									$rows[] = $query->result();
								}else{

						$query = $this->db->select('p.page_id, p.title, p.contents as description,year(p.date_created) as years,p.slug')
									->from('post as p')
									
									->join('post_tag as t','t.post_id = p.page_id','left')
									
									->where('p.status !=',3)
									->where('p.group_course',$course)
									->like('t.keyword',$key,'both')
									->limit($limit)
									->get();
									$rows[] = $query->result();
								}

								
					}else{
						$query = $this->db->select('p.page_id, p.title, p.contents as description,year(p.date_created) as years,p.slug')
									->from('post as p')
									
									->join('post_tag as t','t.post_id = p.page_id','left')
									
									->where('p.status !=',3)
									->where('p.group_course',$course)
									->like('t.keyword',$key,'both')
									->get();
									$rows[] = $query->result();

					}
				}
			}

			return $rows;
		}
if($this->aauth->is_loggedin() && $this->session->userdata['permit'] == 'students'){

			if (is_array($q)) {
				foreach ($q as $key) {
					# code...
					if($limit > 0){
						if($start > 0){

						$query = $this->db->select('p.page_id, p.title, p.contents as description,year(p.date_created) as years,p.slug')
									->from('post as p')
									
									->join('post_tag as t','t.post_id = p.page_id','left')
									
									->where('p.status !=',3)
									->where('p.group_course',$course)
									->like('t.keyword',$key,'both')
									->limit($start,$limit)
									->get();
									$rows[] = $query->result();
								}else{

						$query = $this->db->select('p.page_id, p.title, p.contents as description,year(p.date_created) as years,p.slug')
									->from('post as p')
									
									->join('post_tag as t','t.post_id = p.page_id','left')
									
									->where('p.status !=',3)
									->where('p.group_course',$course)
									->like('t.keyword',$key,'both')
									->limit($limit)
									->get();
									$rows[] = $query->result();
								}

								
					}else{
						$query = $this->db->select('p.page_id, p.title, p.contents as description,year(p.date_created) as years,p.slug')
									->from('post as p')
									
									->join('post_tag as t','t.post_id = p.page_id','left')
									
									->where('p.status !=',3)
									->where('p.group_course',$course)
									->like('t.keyword',$key,'both')
									->get();
									$rows[] = $query->result();

					}
				}
			}

			return $rows;
		}if($this->aauth->is_loggedin() && $this->session->userdata['permit'] == 'instructors'){

			if (is_array($q)) {
				foreach ($q as $key) {
					# code...
					if($limit > 0){
						if($start > 0){

						$query = $this->db->select('p.page_id, p.title, p.contents as description,year(p.date_created) as years,p.slug')
									->from('post as p')
									
									->join('post_tag as t','t.post_id = p.page_id','left')
									
									->where('p.status !=',3)
									->where('p.group_course',$course)
									->like('t.keyword',$key,'both')
									->limit($start,$limit)
									->get();
									$rows[] = $query->result();
								}else{

						$query = $this->db->select('p.page_id, p.title, p.contents as description,year(p.date_created) as years,p.slug')
									->from('post as p')
									
									->join('post_tag as t','t.post_id = p.page_id','left')
									
									->where('p.status !=',3)
									->where('p.group_course',$course)
									->like('t.keyword',$key,'both')
									->limit($limit)
									->get();
									$rows[] = $query->result();
								}

								
					}else{
						$query = $this->db->select('p.page_id, p.title, p.contents as description,year(p.date_created) as years,p.slug')
									->from('post as p')
									
									->join('post_tag as t','t.post_id = p.page_id','left')
									
									->where('p.status !=',3)
									->where('p.group_course',$course)
									->like('t.keyword',$key,'both')
									->get();
									$rows[] = $query->result();

					}
				}
			}

			return $rows;
		}
		if($this->aauth->is_loggedin()){


			if (is_array($q)) {
				foreach ($q as $key) {
					# code...
					if($limit > 0){
						if($start > 0){

						$query = $this->db->select('p.page_id, p.title, p.contents as description,year(p.date_created) as years,p.slug')
									->from('post as p')
									
									->join('post_tag as t','t.post_id = p.page_id','left')
									
									->where('p.group_course',$course)
									->like('t.keyword',$key,'both')
									->limit($start,$limit)
									->get();
									$rows[] = $query->result();
								}else{

						$query = $this->db->select('p.page_id, p.title, p.contents as description,year(p.date_created) as years,p.slug')
									->from('post as p')
									
									->join('post_tag as t','t.post_id = p.page_id','left')
									
									->where('p.group_course',$course)
									->like('t.keyword',$key,'both')
									->limit($limit)
									->get();
									$rows[] = $query->result();
								}

								
					}else{

						$query = $this->db->select('p.page_id, p.title, p.contents as description,year(p.date_created) as years,p.slug')
									->from('post as p')
									
									->join('post_tag as t','t.post_id = p.page_id','left')
									
									->where('p.group_course',$course)
									->like('t.keyword',$key,'both')
									->get();
									$rows[] = $query->result();

					}
				}
			}

			return $rows;
		}else{
			
			if (is_array($q)) {
				foreach ($q as $key) {
					# code...
					if($limit > 0){
						if($start > 0){

						$query = $this->db->select('p.page_id, p.title, p.contents as description,year(p.date_created) as years,p.slug')
									->from('post as p')
									
									->join('post_tag as t','t.post_id = p.page_id','left')
									
									->where('p.status',2)
									->where('p.group_course',$course)
									->like('t.keyword',$key,'both')
									->limit($start,$limit)
									->get();
									$rows[] = $query->result();
								}else{

						$query = $this->db->select('p.page_id, p.title, p.contents as description,year(p.date_created) as years,p.slug')
									->from('post as p')
									
									->join('post_tag as t','t.post_id = p.page_id','left')
									
									->where('p.status',2)
									->where('p.group_course',$course)
									->like('t.keyword',$key,'both')
									->limit($limit)
									->get();
									$rows[] = $query->result();
								}

								
					}else{
						$query = $this->db->select('p.page_id, p.title, p.contents as description,year(p.date_created) as years,p.slug')
									->from('post as p')
									
									->join('post_tag as t','t.post_id = p.page_id','left')
									
									->where('p.status',2)
									->where('p.group_course',$course)
									->like('t.keyword',$key,'both')
									->get();
									$rows[] = $query->result();

					}
				}
			}

			return $rows;
		}
	}

	public function find_by_year($q='',$limit=false,$start = 0,$year=false)
	{
		# code...
		$rows =false;
		if($this->aauth->is_loggedin() && $this->session->userdata['permit'] == 'public'){

			if (is_array($q)) {
				foreach ($q as $key) {
					# code...
					if($limit > 0){
						if($start > 0){

						$query = $this->db->select('p.page_id, p.title, p.contents as description,year(p.date_created) as years,p.slug')
									->from('post as p')
									
									->join('post_tag as t','t.post_id = p.page_id','left')
									
									->where('p.status !=',3)
									->where('YEAR(p.date_created)',$year)
									->like('t.keyword',$key,'both')
									->limit($start,$limit)
									->get();
									$rows[] = $query->result();
								}else{

						$query = $this->db->select('p.page_id, p.title, p.contents as description,year(p.date_created) as years,p.slug')
									->from('post as p')
									
									->join('post_tag as t','t.post_id = p.page_id','left')
									
									->where('p.status !=',3)
									->where('YEAR(p.date_created)',$year)
									->like('t.keyword',$key,'both')
									->limit($limit)
									->get();
									$rows[] = $query->result();
								}

								
					}else{
						$query = $this->db->select('p.page_id, p.title, p.contents as description,year(p.date_created) as years,p.slug')
									->from('post as p')
									
									->join('post_tag as t','t.post_id = p.page_id','left')
									
									->where('p.status !=',3)
									->where('YEAR(p.date_created)',$year)
									->like('t.keyword',$key,'both')
									->get();
									$rows[] = $query->result();

					}
				}
			}

			return $rows;
		}
if($this->aauth->is_loggedin() && $this->session->userdata['permit'] == 'students'){

			if (is_array($q)) {
				foreach ($q as $key) {
					# code...
					if($limit > 0){
						if($start > 0){

						$query = $this->db->select('p.page_id, p.title, p.contents as description,year(p.date_created) as years,p.slug')
									->from('post as p')
									
									->join('post_tag as t','t.post_id = p.page_id','left')
									
									->where('p.status !=',3)
									->where('YEAR(p.date_created)',$year)
									->like('t.keyword',$key,'both')
									->limit($start,$limit)
									->get();
									$rows[] = $query->result();
								}else{

						$query = $this->db->select('p.page_id, p.title, p.contents as description,year(p.date_created) as years,p.slug')
									->from('post as p')
									
									->join('post_tag as t','t.post_id = p.page_id','left')
									
									->where('p.status !=',3)
									->where('YEAR(p.date_created)',$year)
									->like('t.keyword',$key,'both')
									->limit($limit)
									->get();
									$rows[] = $query->result();
								}

								
					}else{
						$query = $this->db->select('p.page_id, p.title, p.contents as description,year(p.date_created) as years,p.slug')
									->from('post as p')
									
									->join('post_tag as t','t.post_id = p.page_id','left')
									
									->where('p.status !=',3)
									->where('YEAR(p.date_created)',$year)
									->like('t.keyword',$key,'both')
									->get();
									$rows[] = $query->result();

					}
				}
			}

			return $rows;
		}if($this->aauth->is_loggedin() && $this->session->userdata['permit'] == 'instructors'){

			if (is_array($q)) {
				foreach ($q as $key) {
					# code...
					if($limit > 0){
						if($start > 0){

						$query = $this->db->select('p.page_id, p.title, p.contents as description,year(p.date_created) as years,p.slug')
									->from('post as p')
									
									->join('post_tag as t','t.post_id = p.page_id','left')
									
									->where('p.status !=',3)
									->where('YEAR(p.date_created)',$year)
									->like('t.keyword',$key,'both')
									->limit($start,$limit)
									->get();
									$rows[] = $query->result();
								}else{

						$query = $this->db->select('p.page_id, p.title, p.contents as description,year(p.date_created) as years,p.slug')
									->from('post as p')
									
									->join('post_tag as t','t.post_id = p.page_id','left')
									
									->where('p.status !=',3)
									->where('YEAR(p.date_created)',$year)
									->like('t.keyword',$key,'both')
									->limit($limit)
									->get();
									$rows[] = $query->result();
								}

								
					}else{
						$query = $this->db->select('p.page_id, p.title, p.contents as description,year(p.date_created) as years,p.slug')
									->from('post as p')
									
									->join('post_tag as t','t.post_id = p.page_id','left')
									
									->where('p.status !=',3)
									->where('YEAR(p.date_created)',$year)
									->like('t.keyword',$key,'both')
									->get();
									$rows[] = $query->result();

					}
				}
			}

			return $rows;
		}
		if($this->aauth->is_loggedin()){


			if (is_array($q)) {
				foreach ($q as $key) {
					# code...
					if($limit > 0){
						if($start > 0){

						$query = $this->db->select('p.page_id, p.title, p.contents as description,year(p.date_created) as years,p.slug')
									->from('post as p')
									
									->join('post_tag as t','t.post_id = p.page_id','left')
									
									->where('YEAR(p.date_created)',$year)
									->like('t.keyword',$key,'both')
									->limit($start,$limit)
									->get();
									$rows[] = $query->result();
								}else{

						$query = $this->db->select('p.page_id, p.title, p.contents as description,year(p.date_created) as years,p.slug')
									->from('post as p')
									
									->join('post_tag as t','t.post_id = p.page_id','left')
									
									->where('YEAR(p.date_created)',$year)
									->like('t.keyword',$key,'both')
									->limit($limit)
									->get();
									$rows[] = $query->result();
								}

								
					}else{

						$query = $this->db->select('p.page_id, p.title, p.contents as description,year(p.date_created) as years,p.slug')
									->from('post as p')
									
									->join('post_tag as t','t.post_id = p.page_id','left')
									
									->where('YEAR(p.date_created)',$year)
									->like('t.keyword',$key,'both')
									->get();
									$rows[] = $query->result();

					}
				}
			}

			return $rows;
		}else{
			
			if (is_array($q)) {
				foreach ($q as $key) {
					# code...
					if($limit > 0){
						if($start > 0){

						$query = $this->db->select('p.page_id, p.title, p.contents as description,year(p.date_created) as years,p.slug')
									->from('post as p')
									
									->join('post_tag as t','t.post_id = p.page_id','left')
									
									->where('p.status',2)
									->where('YEAR(p.date_created)',$year)
									->like('t.keyword',$key,'both')
									->limit($start,$limit)
									->get();
									$rows[] = $query->result();
								}else{

						$query = $this->db->select('p.page_id, p.title, p.contents as description,year(p.date_created) as years,p.slug')
									->from('post as p')
									
									->join('post_tag as t','t.post_id = p.page_id','left')
									
									->where('p.status',2)
									->where('YEAR(p.date_created)',$year)
									->like('t.keyword',$key,'both')
									->limit($limit)
									->get();
									$rows[] = $query->result();
								}

								
					}else{
						$query = $this->db->select('p.page_id, p.title, p.contents as description,year(p.date_created) as years,p.slug')
									->from('post as p')
									
									->join('post_tag as t','t.post_id = p.page_id','left')
									
									->where('p.status',2)
									->where('YEAR(p.date_created)',$year)
									->like('t.keyword',$key,'both')
									->get();
									$rows[] = $query->result();

					}
				}
			}

			return $rows;
		}
	}

	public function find_by_course_year($q='',$limit=false,$start = 0,$course=false,$year=false)
	{
		# code...
		$rows =false;
		if($this->aauth->is_loggedin() && $this->session->userdata['permit'] == 'public'){

			if (is_array($q)) {
				foreach ($q as $key) {
					# code...
					if($limit > 0){
						if($start > 0){

						$query = $this->db->select('p.page_id, p.title, p.contents as description,year(p.date_created) as years,p.slug')
									->from('post as p')
									
									->join('post_tag as t','t.post_id = p.page_id','left')
									
									->where('p.status !=',3)
									->where('p.group_course',$course)
									->where('YEAR(p.date_created)',$year)
									->like('t.keyword',$key,'both')
									->limit($start,$limit)
									->get();
									$rows[] = $query->result();
								}else{

						$query = $this->db->select('p.page_id, p.title, p.contents as description,year(p.date_created) as years,p.slug')
									->from('post as p')
									
									->join('post_tag as t','t.post_id = p.page_id','left')
									
									->where('p.status !=',3)
									->where('p.group_course',$course)
									->where('YEAR(p.date_created)',$year)
									->like('t.keyword',$key,'both')
									->limit($limit)
									->get();
									$rows[] = $query->result();
								}

								
					}else{
						$query = $this->db->select('p.page_id, p.title, p.contents as description,year(p.date_created) as years,p.slug')
									->from('post as p')
									
									->join('post_tag as t','t.post_id = p.page_id','left')
									
									->where('p.status !=',3)
									->where('p.group_course',$course)
									->where('YEAR(p.date_created)',$year)
									->like('t.keyword',$key,'both')
									->get();
									$rows[] = $query->result();

					}
				}
			}

			return $rows;
		}
if($this->aauth->is_loggedin() && $this->session->userdata['permit'] == 'students'){

			if (is_array($q)) {
				foreach ($q as $key) {
					# code...
					if($limit > 0){
						if($start > 0){

						$query = $this->db->select('p.page_id, p.title, p.contents as description,year(p.date_created) as years,p.slug')
									->from('post as p')
									
									->join('post_tag as t','t.post_id = p.page_id','left')
									
									->where('p.status !=',3)
									->where('p.group_course',$course)
									->where('YEAR(p.date_created)',$year)
									->like('t.keyword',$key,'both')
									->limit($start,$limit)
									->get();
									$rows[] = $query->result();
								}else{

						$query = $this->db->select('p.page_id, p.title, p.contents as description,year(p.date_created) as years,p.slug')
									->from('post as p')
									
									->join('post_tag as t','t.post_id = p.page_id','left')
									
									->where('p.status !=',3)
									->where('p.group_course',$course)
									->where('YEAR(p.date_created)',$year)
									->like('t.keyword',$key,'both')
									->limit($limit)
									->get();
									$rows[] = $query->result();
								}

								
					}else{
						$query = $this->db->select('p.page_id, p.title, p.contents as description,year(p.date_created) as years,p.slug')
									->from('post as p')
									
									->join('post_tag as t','t.post_id = p.page_id','left')
									
									->where('p.status !=',3)
									->where('p.group_course',$course)
									->where('YEAR(p.date_created)',$year)
									->like('t.keyword',$key,'both')
									->get();
									$rows[] = $query->result();

					}
				}
			}

			return $rows;
		}if($this->aauth->is_loggedin() && $this->session->userdata['permit'] == 'instructors'){

			if (is_array($q)) {
				foreach ($q as $key) {
					# code...
					if($limit > 0){
						if($start > 0){

						$query = $this->db->select('p.page_id, p.title, p.contents as description,year(p.date_created) as years,p.slug')
									->from('post as p')
									
									->join('post_tag as t','t.post_id = p.page_id','left')
									
									->where('p.status !=',3)
									->where('p.group_course',$course)
									->where('YEAR(p.date_created)',$year)
									->like('t.keyword',$key,'both')
									->limit($start,$limit)
									->get();
									$rows[] = $query->result();
								}else{

						$query = $this->db->select('p.page_id, p.title, p.contents as description,year(p.date_created) as years,p.slug')
									->from('post as p')
									
									->join('post_tag as t','t.post_id = p.page_id','left')
									
									->where('p.status !=',3)
									->where('p.group_course',$course)
									->where('YEAR(p.date_created)',$year)
									->like('t.keyword',$key,'both')
									->limit($limit)
									->get();
									$rows[] = $query->result();
								}

								
					}else{
						$query = $this->db->select('p.page_id, p.title, p.contents as description,year(p.date_created) as years,p.slug')
									->from('post as p')
									
									->join('post_tag as t','t.post_id = p.page_id','left')
									
									->where('p.status !=',3)
									->where('p.group_course',$course)
									->where('YEAR(p.date_created)',$year)
									->like('t.keyword',$key,'both')
									->get();
									$rows[] = $query->result();

					}
				}
			}

			return $rows;
		}
		if($this->aauth->is_loggedin()){


			if (is_array($q)) {
				foreach ($q as $key) {
					# code...
					if($limit > 0){
						if($start > 0){

						$query = $this->db->select('p.page_id, p.title, p.contents as description,year(p.date_created) as years,p.slug')
									->from('post as p')
									
									->join('post_tag as t','t.post_id = p.page_id','left')
									
									->where('p.group_course',$course)
									->where('YEAR(p.date_created)',$year)
									->like('t.keyword',$key,'both')
									->limit($start,$limit)
									->get();
									$rows[] = $query->result();
								}else{

						$query = $this->db->select('p.page_id, p.title, p.contents as description,year(p.date_created) as years,p.slug')
									->from('post as p')
									
									->join('post_tag as t','t.post_id = p.page_id','left')
									
									->where('p.group_course',$course)
									->where('YEAR(p.date_created)',$year)
									->like('t.keyword',$key,'both')
									->limit($limit)
									->get();
									$rows[] = $query->result();
								}

								
					}else{

						$query = $this->db->select('p.page_id, p.title, p.contents as description,year(p.date_created) as years,p.slug')
									->from('post as p')
									
									->join('post_tag as t','t.post_id = p.page_id','left')
									
									->where('p.group_course',$course)
									->where('YEAR(p.date_created)',$year)
									->like('t.keyword',$key,'both')
									->get();
									$rows[] = $query->result();

					}
				}
			}

			return $rows;
		}else{
			
			if (is_array($q)) {
				foreach ($q as $key) {
					# code...
					if($limit > 0){
						if($start > 0){

						$query = $this->db->select('p.page_id, p.title, p.contents as description,year(p.date_created) as years,p.slug')
									->from('post as p')
									
									->join('post_tag as t','t.post_id = p.page_id','left')
									
									->where('p.status',2)
									->where('p.group_course',$course)
									->where('YEAR(p.date_created)',$year)
									->like('t.keyword',$key,'both')
									->limit($start,$limit)
									->get();
									$rows[] = $query->result();
								}else{

						$query = $this->db->select('p.page_id, p.title, p.contents as description,year(p.date_created) as years,p.slug')
									->from('post as p')
									
									->join('post_tag as t','t.post_id = p.page_id','left')
									
									->where('p.status',2)
									->where('p.group_course',$course)
									->where('YEAR(p.date_created)',$year)
									->like('t.keyword',$key,'both')
									->limit($limit)
									->get();
									$rows[] = $query->result();
								}

								
					}else{
						$query = $this->db->select('p.page_id, p.title, p.contents as description,year(p.date_created) as years,p.slug')
									->from('post as p')
									
									->join('post_tag as t','t.post_id = p.page_id','left')
									
									->where('p.status',2)
									->where('p.group_course',$course)
									->where('YEAR(p.date_created)',$year)
									->like('t.keyword',$key,'both')
									->get();
									$rows[] = $query->result();

					}
				}
			}

			return $rows;
		}
	}



	public function find_admin($q='',$limit=false,$start = 0,$course=false,$year=false)
	{
		# code...
		$rows =false;
		if($this->aauth->is_loggedin()){


			if (is_array($q)) {
				foreach ($q as $key) {
					# code...
					if($limit > 0){
						if($start > 0){

						$query = $this->db->select('p.page_id, p.title, p.contents as description,year(p.date_created) as years,p.slug')
									->from('post as p')
									
									->join('post_tag as t','t.post_id = p.page_id','left')
									
									->like('t.keyword',$key,'both')
									->limit($start,$limit)
									->get();
									$rows[] = $query->result();
								}else{

						$query = $this->db->select('p.page_id, p.title, p.contents as description,year(p.date_created) as years,p.slug')
									->from('post as p')
									
									->join('post_tag as t','t.post_id = p.page_id','left')
									
									->like('t.keyword',$key,'both')
									->limit($limit)
									->get();
									$rows[] = $query->result();
								}

								
					}else{

						$query = $this->db->select('p.page_id, p.title, p.contents as description,year(p.date_created) as years,p.slug')
									->from('post as p')
									
									->join('post_tag as t','t.post_id = p.page_id','left')
									
									->like('t.keyword',$key,'both')
									->get();
									$rows[] = $query->result();

					}
				}
			}

			return $rows;
		}else{
			
			if (is_array($q)) {
				foreach ($q as $key) {
					# code...
					if($limit > 0){
						if($start > 0){

						$query = $this->db->select('p.page_id, p.title, p.contents as description,year(p.date_created) as years,p.slug')
									->from('post as p')
									
									->join('post_tag as t','t.post_id = p.page_id','left')
									
									->where('p.status',2)
									->like('t.keyword',$key,'both')
									->limit($start,$limit)
									->get();
									$rows[] = $query->result();
								}else{

						$query = $this->db->select('p.page_id, p.title, p.contents as description,year(p.date_created) as years,p.slug')
									->from('post as p')
									
									->join('post_tag as t','t.post_id = p.page_id','left')
									
									->where('p.status',2)
									->like('t.keyword',$key,'both')
									->limit($limit)
									->get();
									$rows[] = $query->result();
								}

								
					}else{
						$query = $this->db->select('p.page_id, p.title, p.contents as description,year(p.date_created) as years,p.slug')
									->from('post as p')
									
									->join('post_tag as t','t.post_id = p.page_id','left')
									
									->where('p.status',2)
									->like('t.keyword',$key,'both')
									->get();
									$rows[] = $query->result();

					}
				}
			}

			return $rows;
		}
	}

	public function find2($string=false,$start=false,$limit=0,$perm = false)
	{
		# code...

		$rows =false;
		if($this->aauth->is_loggedin()){

		if (is_array($string)) {
			# code...
			foreach ($string as $key) {
				# code...
				//var_dump($key);

				if($limit > 0){

							$sql = "SELECT p.page_id, p.title, p.contents as description, f.original_name as file,f.newfilename as nfile,f.id as file_id,f.mtype as type  FROM post as p LEFT JOIN post_content c ON c.post_id = p.page_id LEFT JOIN post_files f ON f.post_id = p.page_id LEFT JOIN post_tag as t ON t.post_id = p.page_id WHERE  t.keyword LIKE '%".$key."%' GROUP BY t.post_id  ORDER BY p.title ASC LIMIT ?";

							$result = $this->db->query($sql,$limit);
								if($result->num_rows() > 0){
								$rows[] = $result->result();
								}
				}else{

							$sql = "SELECT p.page_id, p.title, p.contents as description, f.original_name as file,f.newfilename as nfile,f.id as file_id,f.mtype as type  FROM post as p LEFT JOIN post_content c ON c.post_id = p.page_id LEFT JOIN post_files f ON f.post_id = p.page_id LEFT JOIN post_tag as t ON t.post_id = p.page_id WHERE  t.keyword LIKE '%".$key."%' GROUP BY t.post_id  ORDER BY p.title ASC";

							$result = $this->db->query($sql);
								if($result->num_rows() > 0){
								$rows[] = $result->result();
								}
				}
			}
		}
	}else{

		if (is_array($string)) {
			# code...
			foreach ($string as $key) {
				# code...
				//var_dump($key);


		$sql = "SELECT p.page_id, p.title, p.contents as description, f.original_name as file,f.newfilename as nfile,f.id as file_id,f.mtype as type  FROM post as p LEFT JOIN post_content c ON c.post_id = p.page_id LEFT JOIN post_files f ON f.post_id = p.page_id LEFT JOIN post_tag as t ON t.post_id = p.page_id WHERE  p.status = 2 AND t.keyword LIKE '%".$key."%' GROUP BY t.post_id  ORDER BY p.date_created DESC";

							$result = $this->db->query($sql);
								if($result->num_rows() > 0){
								$rows[] = $result->result();
								}
			}
		}
	}

		return $rows;


			

	}















/*////////////////////////////////////////////REPORTS///////////////////*/

	public function most_downloaded($limit = false)
	{

		if ($limit) {
			# code...
		$sql = "SELECT p.page_id,d.post_id,p.title,COUNT(d.post_id) as visita,d.date_downloaded as d_date,year(p.date_created) as years,p.slug FROM post as p LEFT JOIN post_download d ON d.post_id = p.page_id  GROUP BY d.post_id ORDER BY count(d.post_id) DESC LIMIT ".$limit;

		$query = $this->db->query($sql);
		if ($r = $query->result()) {
			return $r;
		}
		return false;
		}
		return false;

	}

	public function less_downloaded($limit = false)
	{
		# code...
		if ($limit) {
			# code...
		$sql = "SELECT p.page_id,d.post_id,p.title,COUNT(d.post_id) as visita,d.date_downloaded as d_date,year(p.date_created) as years,p.slug  FROM post as p LEFT JOIN post_download d ON d.post_id = p.page_id  GROUP BY d.post_id ORDER BY count(d.post_id) ASC LIMIT ".$limit;

		$query = $this->db->query($sql);
		if ($r = $query->result()) {
			return $r;
		}
		return false;

		}
		return false;
	}

	public function random_downloaded($limit = false)
	{
		# code...
		if ($limit) {
			# code...
		$sql = "SELECT p.page_id,d.post_id,p.title,COUNT(d.post_id) as visita,d.date_downloaded as d_date,year(p.date_created) as years,p.slug FROM post as p LEFT JOIN post_download d ON d.post_id = p.page_id  GROUP BY d.post_id ORDER BY d.date_downloaded ASC LIMIT ".$limit;

		$query = $this->db->query($sql);
		if ($r = $query->result()) {
			return $r;
		}
		return false;

	}
		return false;
	}
	
	
	
	public function recent_upload($limit = false,$user_id = false)
	{
		# code...
		if ($user_id) {
			# code...
				if ($limit) {
					# code...
				$sql = "SELECT p.page_id as post_id,p.title, CONCAT(u.fname , ' ', u.lname) as name,p.date_created as d_date,p.posted_by,year(p.date_created) as years,p.slug FROM post as p LEFT JOIN aauth_users u ON u.id = p.posted_by WHERE p.posted_by = ".$user_id." ORDER BY p.date_created asc LIMIT ".$limit;

				$query = $this->db->query($sql);
				if ($r = $query->result()) {
					return $r;
				}
				return false;

			}
			return false;
		}
		if ($limit) {
			# code...
				$sql = "SELECT p.page_id as post_id,p.title, CONCAT(u.fname , ' ', u.lname) as name,p.date_created as d_date,p.posted_by,year(p.date_created) as years,p.slug FROM post as p LEFT JOIN aauth_users u ON u.id = p.posted_by ORDER BY p.date_created asc LIMIT ".$limit;

		$query = $this->db->query($sql);
		if ($r = $query->result()) {
			return $r;
		}
		return false;

	}
		return false;
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}