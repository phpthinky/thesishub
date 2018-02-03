	<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post extends CI_Controller {

	public $uid;
	public $username;
	
	function __construct()
	{
		parent::__construct();
		$this->init();
	}
	public function init($value='')
	{
		if (!$this->aauth->is_loggedin()){
        	//redirect();
        	$this->uid = 0;
        	$this->username = 'guest'.rand(10,100);
        }else{
		$this->uid = $this->session->userdata('id');
		$this->username = $this->session->userdata('username');

        }

		$this->uid = $this->session->userdata('id');
		$this->username = $this->session->userdata('username');
		$this->load->model('file_m');
		$this->load->model('group_m');
		$this->load->model('post_m');
        $this->load->library("slug");
	}
	public function index($value='')
	{
		# code...
		if (!$this->aauth->is_loggedin()){
        	redirect();
        }	
        if($this->session->userdata['permit'] == 'students'){
        	redirect();
        }
		$this->permission->access();

		$limit = 10;	
		$start =  $this->uri->segment(4) ?  $this->uri->segment(4) : 0;

		//echo $start;

		if ($this->input->get()) {
					$q = $this->slug->create($this->input->get('q'));
					$search = $q;
					$q = array_unique(explode('-', $q));
					$rows = $this->file_m->find_admin($q);
					$total = count($rows[0]);

					$list_life = $this->file_m->find_admin($q,$limit,$start);
					//var_dump($list_life);
					$list_life = $list_life[0];
					$data['links'] = $this->paging($total,$limit,$start,$q,$search);


				
		}else{
			if ($start > 0) {

		$list_life = $this->file_m->lisfile($start,$limit);
			}else{

		$list_life = $this->file_m->lisfile($limit);
			}


		$total =  $this->file_m->file_total();


		$data['links'] = $this->paging($total,$limit);

		}

			
		




		$data['list_life']= $list_life;
		$data['title']= "List all post";
		$this->load->view('admin/default/header',$data);
		$this->load->view('admin/default/menu',$data);
		$this->load->view('files/list_post',$data);
		$this->load->view('admin/default/footer',$data);
	}

	public function paging($total=0,$limit=0,$start=0,$q='',$search=false)
	{
						if($search){
						$config['base_url'] = site_url() . "/post/index/$search";    

						}else{
						$config['base_url'] = site_url() . "/post/index/-";

						}


			            $config['total_rows']=$total;
			            $config['per_page'] = $limit;
				        $choice = $config["total_rows"]/$config["per_page"];
				        $config["num_links"] = floor($choice);
				        $config["uri_segment"] = 4;

             
			            $this->pagination->initialize($config);
			                 
			            /*$data['links'] =*/ 
			            return $this->pagination->create_links();
	}

		public function add($value='')
	{
		# code...
		if (!$this->aauth->is_loggedin()){
        	redirect();
        }	
        if($this->session->userdata['permit'] == 'students'){
        	redirect();
        }
		$this->permission->access();

		$limit = 20;

		$list_life = $this->file_m->lisfile($limit);
		$data['listgroup'] = $this->group_m->group_type(3);
		$data['category'] = $this->group_m->group_type(2);
		$data['position'] = $this->group_m->expert_role_type();

		$data['list_life']= $list_life;
		$data['title']= "Add new post";
		$this->load->view('admin/default/header',$data);
		$this->load->view('admin/default/menu',$data);
		$this->load->view('files/new',$data);
		$this->load->view('admin/default/footer',$data);
	}
	public function showbarangay()
	{
		# code...
		if($this->input->post()){
			$this->load->model('address_ph');
			$address = $this->address_ph->get_barangay($this->input->post('barangay'));
			echo json_encode($address);
		}
	}
	public function edit()
	{
		# code...

		if($this->input->get()){
			if($this->input->get('id')){
				$post_id = $this->input->get('id');
        		$data['infos'] = $this->file_m->get_file_info_id($post_id);
		       // $post_id = $this->post_m->get_id_by_slug($slug);
		        $data['files'] = $this->file_m->get_files($post_id);
		        if($tags=$this->file_m->get_tags($post_id)){
		        	foreach ($tags as $key) {
		        		# code...
		        		$keys[] = $key->keyword;
		        	}
		        	$data['tags'] = implode(',', $keys);
		        }


	        $data['files'] = $this->file_m->get_files($post_id);

	        $data['researcher'] = $this->post_m->get_experts('researcher',$post_id) ;
	        $data['panel'] = $this->post_m->get_experts('panel',$post_id) ;
	        $data['committee'] = $this->post_m->get_experts('committee',$post_id) ;
	        $data['adviser'] = $this->post_m->get_experts('adviser',$post_id) ;
		$data['position'] = $this->group_m->expert_role_type();



			}
		}else{
			echo 'No input received.';
			exit();
		}

		$data['listgroup'] = $this->group_m->group_type(3);
		$data['category'] = $this->group_m->group_type(2);
		$data['title'] = 'Edit post';

		$this->load->view('admin/default/header',$data);
		$this->load->view('admin/default/menu',$data);
		$this->load->view('files/edit/edit_all',$data);
		$this->load->view('admin/default/footer',$data);

	}
	public function edit_author($value='')
	{
		# code...
		if($this->input->post()){
			$input = (object)$this->input->post();

			$col =  $input->column;
			$name =  $input->editval;
			$id =  $input->id;
			$info_id =  $input->info_id;
			$role =  $input->role_id;


			if ($col == 'fullname') {

				$last_id = $this->post_m->last_id();

				$name_id = $this->post_m->get_name_id($name);


				if($name_id != $id){

					if($update = $this->post_m->change_expert($info_id,$name_id)){
						echo json_encode(array('stats'=>true,'msg'=>'Update successfully','name_id'=>$name_id,'col'=>$col));
					}else{

						echo json_encode(array('stats'=>false,'msg'=>'Update unsuccessful','name_id'=>$name_id,'col'=>$col));
					}

				}else{

						echo json_encode(array('stats'=>false,'msg'=>'No changes','name_id'=>$name_id,'col'=>$col));
				}
				

			}elseif($col == 'role_name'){


				$role_id = $this->post_m->get_role_id($name);


				if($role_id != $role){
					//echo "string";
					if($update = $this->post_m->change_expert_role($info_id,$role_id)){
						echo json_encode(array('stats'=>true,'msg'=>'Update successfully','role_id'=>$role_id,'col'=>$col));
					}else{

						echo json_encode(array('stats'=>false,'msg'=>'Update unsuccessful','role_id'=>$role_id,'col'=>$col));
					}

				}else{
				echo json_encode(array('stats'=>true,'msg'=>'No changes','col'=>$role,'role_id'=>$role_id));
				}
			}elseif($col == 'adviser'){


				$name_id = $this->post_m->get_name_id($name);


				if($name_id != $id){
					//echo "string";
					if($update = $this->post_m->change_expert($info_id,$name_id)){
						echo json_encode(array('stats'=>true,'msg'=>'Update successfully','name_id'=>$name_id,'col'=>$col));
					}else{

						echo json_encode(array('stats'=>false,'msg'=>'Update unsuccessful','name_id'=>$name_id,'col'=>$col));
					}

				}else{
				echo json_encode(array('stats'=>true,'msg'=>'No changes','col'=>$col,'name_id'=>$name_id));
				}
			}



			}
		
	}

	public function edit_adviser($value='')
	{
		# code...
		if($this->input->post()){
			$input = (object)$this->input->post();

			$col =  $input->column;
			$name =  $input->adviser;
			$post_id =  $input->post_id;
			$o_name_id =  $input->name_id;
			$info_id =  $input->info_id;


				$name_id = $this->post_m->get_name_id($name);

				if((int)$o_name_id == 0){
				//var_dump($input);exit();

					$adviser[0]['name_id'] = $name_id;
					$adviser[0]['role_id'] = (int)$this->post_m->get_role_id('adviser');
					$adviser[0]['post_id'] = $post_id;
					$adviser[0]['group_type'] = 'adviser';
			
				

					if($adv = $this->post_m->insert_info_by_batch($adviser)){

						echo json_encode(array('stats'=>true,'msg'=>'Update successfully','name_id'=>$name_id,'col'=>$col));

					}else{

						echo json_encode(array('stats'=>false,'msg'=>'Update unsuccessful','name_id'=>$name_id,'col'=>$col));
					}
				exit();
				}	
				//exit();


				if($name_id != $o_name_id){



					if($update = $this->post_m->change_expert($info_id,$name_id)){

						echo json_encode(array('stats'=>true,'msg'=>'Update successfully','name_id'=>$name_id,'col'=>$col));

					}else{

						echo json_encode(array('stats'=>false,'msg'=>'Update unsuccessful','name_id'=>$name_id,'col'=>$col));
					}

					exit();

				}else{
					echo json_encode(array('stats'=>true,'msg'=>'No changes','col'=>$col,'name_id'=>$name_id));
				}

		}
	}


	public function edit_rating($value='')
	{
		# code...
		if($this->input->post()){
			$input = (object)$this->input->post();

			//var_dump($input);exit();

				if($rate = $this->post_m->change_rating($input->rating,$input->post_id)){
					echo json_encode(array('stats'=>true,'msg'=>$rate));
				}else{

					echo json_encode(array('stats'=>false));
				}
			}
		
	}
	public function save_author($value='')
	{
		if($this->input->post()){

			$post_id = $this->input->post('post_id');

			$r_name = $this->input->post('researcher');
			$r_pos = $this->input->post('researcher-position');

			if(!empty($r_name[0])){
				$i = 0;
				$r='';
				foreach ($r_name as $key) {
					# code...

					$name_id = $this->post_m->get_name_id($key);

					if ($used_id = $this->post_m->name_id_used($post_id,$name_id,'researcher')) {
						# code...
						//echo json_encode($this->input->post());
					//exit();
					}else{
					$r[$i]['name_id'] = $name_id;
					$r[$i]['role_id'] = isset($r_pos[$i]) ? (int)$this->post_m->get_role_id($r_pos[$i]) : 0;
					$r[$i]['post_id'] = $post_id;
					$r[$i]['group_type'] = 'researcher';

					$i++;
					}

				}

				if(!empty($r)){

				$r = array_filter(array_unique($r));
				//echo json_encode($r);exit();
				if($re = $this->post_m->insert_info_by_batch($r)){
					echo json_encode(array('stats'=>true,'msg'=>'Author is added successfully.'));
				}else{

					echo json_encode(array('stats'=>false));
				}
			}else{

					echo json_encode(array('stats'=>false,'msg'=>'No author added.'));
			}


						
						exit();


			}

		}

	}
		public function save_committee($value='')
	{
		if($this->input->post()){

			$post_id = $this->input->post('post_id');

			$r_name = $this->input->post('committee');
			$r_pos = $this->input->post('committee-position');
			
			if(!empty($r_name[0])){
				$i = 0;
				$r='';
				foreach ($r_name as $key) {
					# code...

					$name_id = $this->post_m->get_name_id($key);

					if ($used_id = $this->post_m->name_id_used($post_id,$name_id,'committee')) {
						# code...
						//echo json_encode($this->input->post());
					//exit();
					}else{
					$r[$i]['name_id'] = $name_id;
					$r[$i]['role_id'] = isset($r_pos[$i]) ? (int)$this->post_m->get_role_id($r_pos[$i]) : 0;
					$r[$i]['post_id'] = $post_id;
					$r[$i]['group_type'] = 'committee';

					$i++;
					}

				}

				if(!empty($r)){

				$r = array_filter(array_unique($r));
				//echo json_encode($r);exit();
				if($re = $this->post_m->insert_info_by_batch($r)){
					echo json_encode(array('stats'=>true,'msg'=>'Committee is added successfully.'));
				}else{

					echo json_encode(array('stats'=>false));
				}
			}else{

					echo json_encode(array('stats'=>false,'msg'=>'No committee is  added.'));
			}


						
						exit();


			}

		}

	}
		public function save_panel($value='')
	{
		if($this->input->post()){

			$post_id = $this->input->post('post_id');

			$r_name = $this->input->post('panel');
			$r_pos = $this->input->post('panel-position');
			
			if(!empty($r_name[0])){
				$i = 0;
				$r='';
				foreach ($r_name as $key) {
					# code...

					$name_id = $this->post_m->get_name_id($key);

					if ($used_id = $this->post_m->name_id_used($post_id,$name_id,'panel')) {
						# code...
						//echo json_encode($this->input->post());
					//exit();
					}else{
					$r[$i]['name_id'] = $name_id;
					$r[$i]['role_id'] = isset($r_pos[$i]) ? (int)$this->post_m->get_role_id($r_pos[$i]) : 0;
					$r[$i]['post_id'] = $post_id;
					$r[$i]['group_type'] = 'panel';

					$i++;
					}

				}

				if(!empty($r)){

				$r = array_filter(array_unique($r));
				//echo json_encode($r);exit();
				if($re = $this->post_m->insert_info_by_batch($r)){
					echo json_encode(array('stats'=>true,'msg'=>'Panelist is added successfully.'));
				}else{

					echo json_encode(array('stats'=>false));
				}
			}else{

					echo json_encode(array('stats'=>false,'msg'=>'No panel is added.'));
			}


						
						exit();


			}

		}

	}
	
	public function remove_author(){
	    if($this->input->post()){
	       $author_id =  $this->input->post('id');
	    if($this->post_m->remove_expert($author_id)){
				echo json_encode(array('stats'=>true,'msg'=>'Author remove'));
			}else{

				echo json_encode(array('stats'=>false,'msg'=>'Author not remove'));
			}
	    }
	    else{
				echo json_encode(array('stats'=>false,'msg'=>'No input received'));
	    }
	}
	public function delete_file(){
	    if($this->input->post()){
	       $post_id =  $this->input->post('file_id');
	    if($this->file_m->delete_file($post_id)){
				echo json_encode(array('stats'=>true));
			}else{

				echo json_encode(array('stats'=>false));
			}
	    }
	    else{
				echo json_encode(array('stats'=>false));
	    }
	}
	public function allowuser($value='')
	{
		# code...
		if (!$this->aauth->is_loggedin()){
        	redirect();
        }	
		# code...
		if ($this->input->post()) {
			# code...

			$id = $this->input->post('uid');
			$stats = $this->input->post('status');

			if($this->file_m->allow_user($id,$stats)){
				echo json_encode(array('stats'=>true));
			}else{

				echo json_encode(array('stats'=>false));
			}
		}
	}
	public function download($filename='',$title='',$post_id = false)
	{
		# code...
		$this->load->helper('download');

		$filename = urldecode($this->uri->segment(3));
		//$title = urldecode($this->uri->segment(4));
		$post_id = $this->uri->segment(4);
		if($this->uid){

		$stored = $this->file_m->save_download(array('post_id'=>$post_id,'user_id'=>$this->uid));

	}else{
		$ip = $this->pagecounter->get_ip();
		$stored = $this->file_m->save_download(array('post_id'=>$post_id,'ip_address'=>$ip));

	}

		$file_path = $this->file_m->get_link($filename,$post_id,true);
        //echo $file_path;
		if ($file_path) {
			# code...
		force_download($file_path,NULL);
		}
		echo "<html><title>Resource portal</title></html>";
	}
public function update_abstract($value='')
	{
		if (!$this->aauth->is_loggedin()){
        	redirect();
        }
        if ($this->input->post()) {
        	$input = (object) $this->input->post();
        	$tags = explode('-', str_replace('-', ' ', $this->slug->create($input->title)).'-'.str_replace(',', '-', $input->tags));
			$tags = array_unique(array_filter($tags));


			$date = "$input->years/$input->months/$input->days ".date('h:m:s');;


			$title_exist = $this->file_m->title($input->title);
			$id_by_title = $this->post_m->get_id_by_title($input->title);

			if($title_exist > 0 && $input->edit_id != $id_by_title){
				echo json_encode(array('stats'=>false,'msg'=>'Title not available.'));
				exit();
			}

			$info = array(
					'title'=>$input->title,
					'date_presented'=>date('Y-m-d h:m:s'),
					'slug'=>$this->slug->create($input->title),
					'date_created'=>$date,
					'group_course'=>$input->group_course,
					'status'=>$input->group_privacy,
					'posted_by'=>$this->uid,
					'contents'=>$input->contents,
					'page_id'=>$input->edit_id,
					'bookno'=>$input->bookno,
					'implemented'=>$input->implemented

					);

			if($update = $this->file_m->update_resource_info($info,$input->contents)){


			$grouping = $this->post_m->update_in_table('post_by_course',
				array(array(
					'course_group_id'=>$input->group_course,
					'post_id'=>$input->edit_id
				)));


				if (is_array($tags)) {
					$this->post_m->remove_tags($input->edit_id);
					foreach ($tags as $key) {
						# code...
					$insert = $this->post_m->save_tag($key,$input->edit_id);
						}
					}else{

					$insert = $this->post_m->save_tag($tags,$input->edit_id);
					}



				echo json_encode(array('stats'=>true,'msg'=>"Post successfully updated.",'slug'=>$this->slug->create($input->title),'post_id'=>$input->edit_id,'book'=>$input->bookno));
			}else{
				echo json_encode(array('stats'=>false,'msg'=>$input->edit_id));
			}

        }
	}
	public function save_captions($value='')
	{
		if (!$this->aauth->is_loggedin()){
        	redirect();
        }
        if ($this->input->post()) {
        	$input = (object)$this->input->post();

        	if(isset($input->title)){
        		$this->file_m->update_file_title($input->id,$input->title);
        	}elseif(isset($input->caption)){

        		$this->file_m->update_file_caption($input->id,$input->caption);
        	}

        }
    }
    public function remove_file($value='')
	{
		if (!$this->aauth->is_loggedin()){
        	redirect();
        }
        if ($this->input->post()) {
        	$input = (object)$this->input->post();

        	if(isset($input->id)){
        		$this->file_m->remove_one_file($input->id);
        	}

        }
    }
    
	public function save_abstract($value='')
	{
		if (!$this->aauth->is_loggedin()){
        	redirect();
        }
        if ($this->input->post()) {
        	$input = (object) $this->input->post();

        	//var_dump($input);exit();
        	$tags = explode('-', str_replace('-', ' ', $this->slug->create($input->title)).'-'.str_replace(',', '-', $input->tags));
			$tags = array_unique(array_filter($tags));


			$date = "$input->years/$input->months/$input->days ".date('h:m:s');;


			$exist = $this->file_m->title($input->title);
			if($exist > 0){
				echo json_encode(array('stats'=>false,'msg'=>'Title already used.'));
				exit();
			}
			if(!empty($input->bookno)){

				$book = $this->file_m->is_book_no($input->bookno);
				if($book > 0){
				echo json_encode(array('stats'=>false,'msg'=>'Book number already used'));
					exit();

				}
			}

			$info = array(
					'title'=>$input->title,
					'date_presented'=>date('Y-m-d h:m:s'),
					'slug'=>$this->slug->create($input->title),
					'date_created'=>$date,
					'group_course'=>$input->group_course,
					'status'=>$input->group_privacy,
					'posted_by'=>$this->uid,
					'contents'=>$input->contents,
					'bookno'=>$input->bookno,
					'implemented'=>$input->implemented
					);

			if($post_id = $this->file_m->save_resource_info($info)){


			$grouping = $this->post_m->insert_in_table('post_by_course',
				array(
					'course_group_id'=>$input->group_course,
					'post_id'=>$post_id
				));


				if (is_array($tags)) {
					foreach ($tags as $key) {
						# code...
					$insert = $this->post_m->save_tag($key,$post_id);
						}
					}else{

					$insert = $this->post_m->save_tag($tags,$post_id);
					}

			$admin_permission = $this->file_m->post_perm($post_id,5,$this->uid);
			$staff_permission = $this->file_m->post_perm($post_id,4,$this->uid);


				echo json_encode(array('stats'=>true,'msg'=>"Post successfully added.",'slug'=>$this->slug->create($input->title),'post_id'=>$post_id));
			}else{
				echo json_encode(array('stats'=>false,'msg'=>$post_id));
			}

        }
	}
	public function get_book_no()
	{
		# code...
		if ($this->input->post()) {
			//echo json_encode(array('stats'=>false,'msg'=>'books'));
			//exit();

			$bookno = $this->input->post('bookno');



			$book = $this->file_m->is_book_no($bookno);
			if($book > 0){
			echo json_encode(array('stats'=>false,'msg'=>$book));

			}else{

			echo json_encode(array('stats'=>true,'msg'=>$book));
			}

		}//else{
		//	echo json_encode(array('stats'=>false,'msg'=>'No input received.'));
		//}

	}

	public function is_title($value='')
	{
		if ($this->input->post()) {

			$title = $this->input->post('title');

			$istitle = $this->file_m->title($title);
			if($istitle > 0){
			echo json_encode(array('stats'=>false,'msg'=>$istitle));

			}else{

			echo json_encode(array('stats'=>true,'msg'=>$istitle));
			}

		}


	}
	public function save_file()
	{
		# code...
		if($this->input->post()){

			$input = (object)$this->input->post();
			$file = $input->btnInput;
			$upload = false;

			$count = count($_FILES[$file]['name']);
			$title = $this->post_m->get_title_by_id($input->post_id);
			$j=0;
			for ($i = 0; $i < $count; $i++) {

			    if($upload[$j] = $this->upload($title,$file,$i)){
			    	$upload[$j]['post_id'] = $input->post_id;
			    	$j++;
			    }

			}
			if ($j == 0) {
				# code...
					echo json_encode(array('stats'=>false,'msg'=>'Upload unsuccessful! No file selected/Invalid file.'));
					exit();
			}
			if ($upload) {

				if($uploaded = $this->file_m->save_file_array(array_filter($upload))){
					//var_dump($upload);
					echo json_encode(array('stats'=>true,'msg'=>$j.' of '.$count.' file uploaded.'));
					exit();
				}else{
					echo json_encode(array('stats'=>false,'msg'=>$uploaded));
					exit();
				}

			}else{

					echo json_encode(array('stats'=>false,'msg'=>'Upload unsuccessful! No file selected/Invalid file.'));
			}

		}
	}
	

	public function upload($title=false,$file,$i)
	{
		if (!$this->aauth->is_loggedin()){
        	redirect();
        }	
		# code...
            	$tmp_file = $_FILES[$file]['tmp_name'][$i];
            	$mimetype = mime_content_type($tmp_file);
              	$date =  date('y-m-d-h-m-s');
              		switch ($mimetype) {
	 				case 'application/vnd.openxmlformats-officedocument.wordprocessingml.document':
	 					# code...
	 					$type='word';
	 					break;
	 				case 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet':
	 					# code...
	 					$type='spreadsheet';
	 					break;
	 				case 'application/vnd.openxmlformats-officedocument.presentationml.presentation':
	 					# code...
	 					$type='powerpoint';
	 					break;
	 				case 'application/pdf':
	 					# code...
	 					$type='pdf';
	 					break;	 			
	 				case 'image/png':
	 					# code...
	 					$type='image';
	 					break;
	 				case 'image/jpeg':
	 					# code...
	 					$type='image';
	 					break;
	 				case 'image/jpg':
	 					# code...
	 					$type='image';
	 					break;
	 				case 'image/gif':
	 					# code...
	 					$type='image';
	 					break;
	 				case 'image/tiff':
	 					# code...
	 					$type='photoshop';
	 					break;
	 				case 'image/vnd.adobe.photoshop':
	 					$type = 'photoshop';
	 					break;	
	 				case 'video/mp4':
	 					# code...
	 					$type='video';
	 					break;
	 				case 'application/octet-stream':
	 					# code...
	 					$type='video';
	 					break;
	 				case 'application/x-dosexec':
	 					# code...
	 					$type='exefile';
	 					break;

	 				case 'text/html':
	 					# code...
	 					$type='block';
	 					break;	
	 				case 'text/x-php':
	 					# code...
	 					$type='block';
	 					break;	 						
	 				case 'text/plain':
	 					# code...
	 					$type='block';
	 					break;	

	 				case 'application/x-rar':
	 					# code...
	 					$type='zipped';
	 					break;	 						
	 				case 'application/zip':
	 					# code...
	 					$type='zipped';
	 					break;	
	 				default:
	 					$type = 'others';
	 					break;
	 				}
	 				if($type === 'block' || $type === 'exefile'){
	 					return false;
	 				}
	 				if($type === 'word' || $type === 'powerpoint' || $type === 'spreadsheet'  || $type === 'pdf'){
	 					$ftype = 'docs';
	 				}else{
	 						$ftype = $type;
	 				}
	 				if($file != $ftype){
	 					//echo $ftype;
	 					return false;
	 				}


	 				

            $dirname = $this->username;

			$target_dir = UPLOADPATH . $dirname . "/";
			if (!file_exists($target_dir)) {
               	mkdir(UPLOADPATH.$dirname,0777);
			} 
            $dirname2 = $this->username.'/'.$type;
			$target_dir2 = UPLOADPATH . $dirname2 . "/";

			if (!file_exists($target_dir2)) {
               	mkdir(UPLOADPATH.$dirname2,0777);
			} 
                
                $filename = basename($_FILES[$file]["name"][$i]);
                $targetfile = $target_dir2 . basename($_FILES[$file]["name"][$i]);

                $ext = pathinfo($filename, PATHINFO_EXTENSION);
                $oldname = pathinfo($filename, PATHINFO_FILENAME);

                $oldname = $this->slug->create($oldname);
                if($title){

                $title = $this->slug->create($title);
                $newfile = $target_dir2.$title.'-'.$oldname.'-'.$date.'.'.$ext;
                $newfilename = $title.'-'.$oldname.'-'.$date.'.'.$ext;
	            }else{

	                $newfile = $target_dir2.$oldname.'-'.$date.'.'.$ext;
	                $newfilename = $oldname.'-'.$date.'.'.$ext;
	            }


        		if(move_uploaded_file($tmp_file, $newfile)){

                    $data = array('link'=>$newfile,'mtype'=>$mimetype,'newfilename'=>$newfilename,'type'=>$type);
                    
                    return $data;
                }else{

                    return false;
                }
            
	}
	    function check_mimetype($filename)
    {
		if (!$this->aauth->is_loggedin()){
        	redirect();
        }	
        $mimetype = false;
        if(function_exists('mime_content_type')) {
            $mimetype = mime_content_type($filename); 

            $allowed = array('image/jpeg','image/pjpeg','image/png','image/x-png','audio/mp3','video/*','application/msword', 'application/vnd.ms-excel', 'application/vnd.ms-powerpoint','application/pdf');
            if (in_array($mimetype, $allowed)) {

                return true;
            }else{
                return false;
            }
        }
       return true;
    }



	public function search_courses()
	{
		# code...
		$string = $this->input->post('name');

		if(!$msgs = $this->file_m->course_title($string)){

		echo json_encode(array('stats'=>false,'msg'=>$msg));
		}else{

			echo json_encode(array('stats'=>true,'msg'=>$msg));
		}
		
		
	}
    public function save_info()
    {
		if (!$this->aauth->is_loggedin()){
        	redirect();
        }	
    	if ($this->input->post()) {
		$slug = $this->input->post('slug');
		$post_id = $this->post_m->get_id_by_slug($slug);
    		$option = $this->input->post('option');


    		if((int)$option = 6){


			$r_name = $this->input->post('researcher');
			$r_pos = $this->input->post('researcher-position');

			$p_name = $this->input->post('panel');
			$p_pos = $this->input->post('panel-position');

			$c_name = $this->input->post('committee');
			$c_pos = $this->input->post('committee-position');


			$a_name = $this->input->post('adviser');
			$rating = $this->input->post('rating');


			if(!empty($r_name[0])){
				$i = 0;
				$r='';
				foreach ($r_name as $key) {
					# code...
					$r[$i]['name_id'] = $this->post_m->get_name_id($key);
					$r[$i]['role_id'] = isset($r_pos[$i]) ? (int)$this->post_m->get_role_id($r_pos[$i]) : 0;
					$r[$i]['post_id'] = $post_id;
					$r[$i]['group_type'] = 'researcher';
					$i++;
				}
				$re = $this->post_m->insert_info_by_batch($r);


			}
			
			
			if(!empty($p_name[0])){
				
				$i = 0;$p='';
				foreach ($p_name as $key) {
					# code...
					$p[$i]['name_id'] = $this->post_m->get_name_id($key);
					$p[$i]['role_id'] = isset($p_pos[$i]) ? (int)$this->post_m->get_role_id($p_pos[$i]) : 0;
					$p[$i]['post_id'] = $post_id;
					$p[$i]['group_type'] = 'panel';
					$i++;
				}
				$pa = $this->post_m->insert_info_by_batch($p);


			}

			if(!empty($c_name[0])){
				
				$i = 0;$c='';
				foreach ($c_name as $key) {
					# code...
					$c[$i]['name_id'] = $this->post_m->get_name_id($key);
					$c[$i]['role_id'] = isset($c_pos[$i]) ? (int)$this->post_m->get_role_id($c_pos[$i]) : 0;
					$c[$i]['post_id'] = $post_id;
					$c[$i]['group_type'] = 'committee';
					$i++;
				}
				$co = $this->post_m->insert_info_by_batch($c);




			}

			if($this->input->post('adviser')){
				//$adviser[] = array(

					$adviser[0]['name_id'] = $this->post_m->get_name_id($a_name);
					$adviser[0]['role_id'] = (int)$this->post_m->get_role_id('adviser');
					$adviser[0]['post_id'] = $post_id;
					$adviser[0]['group_type'] = 'adviser';
			//);
				$adv = $this->post_m->insert_info_by_batch($adviser);
			}




			if(!empty($rating)){
				$rate = $this->post_m->update_post_by_batch(array(array('rating'=>$rating,'page_id'=>$post_id)));

			}
			echo json_encode(array('stats'=>true,'msg'=>'All data added successfully.'));
			exit();

    		}
    		echo json_encode(array('stats'=>false,'msg'=>'No input.'));
			
    	}
    }

	public function search_names()
	{
		# code...
		$string = $this->input->post('name');

		$msgs = $this->post_m->get_name($string);
			$i = 0;
		$msg = '';
			foreach ($msgs as $key) {
				# code...
				$name = ucwords($key->fullname);
				$msg .="<li id='$i' onclick='get_selected(\"$name\")'>$name</li>";
				$i++;
			}
		
		echo json_encode(array('stats'=>true,'msg'=>$msg));
	}







//class end
}