<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post extends CI_Controller {

	public $uid = 0;

	public function __construct()
	{
		# code...
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->library('pagecounter');
		$this->load->library('minify');
		$this->load->library('slug');
		$this->load->library('pagination');
		$this->load->model('post_model');
		$this->load->model('group_model');
		$this->load->model('search_model');
		//$this->load->library('Aauth');
		if(!$this->aauth->is_loggedin()){

			redirect('');
		}elseif (!$this->aauth->is_admin()) {
			# code...

			redirect('search');
		}


        $this->uid = $this->session->userdata('id');
	}
	public function index($value='')
	{
		# code...
		redirect('post/listall');
	}
	public function listall($start=0)
	{
		# code...


		$start = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
		$limit = 5;

		$groups = $this->aauth->get_user_groups($this->uid);			
			if($groups){
				foreach ($groups as $key) {
					# code...
					$ids[]= $key->group_id;
				}
			}
	    $total = $this->search_model->page_total();




			            $total_row = $this->search_model->page_total($ids);
						$config['base_url'] = site_url() . "/post/listall";
			            $config['total_rows']=$total_row;
			            $config['per_page'] = $limit;
				        $config["uri_segment"] = 3;
				        $choice = $config["total_rows"]/$config["per_page"];
				        $config["num_links"] = floor($choice);
             
             
			            $this->pagination->initialize($config);
			                 
			            $links = $this->pagination->create_links();
			            //var_dump($links);

			$pages = $this->search_model->find($this->uid,false,$ids,$limit,$start);
			$content = '<table class="table table-bordered">

						<thead><tr><th>Title</th><th>Course</th><th>Year</th><th>Action</th></tr></thead>';

			if(is_array($pages)){

				foreach ($pages as $key) {

						$content .= "<tr>
						<td>$key->title</td>
						<td>$key->name</td>
						<td>$key->year</td>
						<td width='150px;'><a href='' class='btn btn-success'><i class='fa fa-book'></i></a>&nbsp;<a href='' class='btn btn-default'><i class='fa fa-edit'></i></a>&nbsp;<a href='' class='btn btn-danger'><i class='fa fa-remove'></i></a></td></tr>";
				}
			}
			$content .="</table>";


		
		

		$data['content']= $content;
		$data['links']= $links;



		$data['listgroup'] = $this->group_model->group_type(3);

		$data['title'] = 'List all';
		$data['subtitle'] = 'List all';

		$this->load->view('admin/default/header',$data);
		$this->load->view('admin/default/sidemenu',$data);
		$this->load->view('post/list',$data);
		$this->load->view('admin/default/footer',$data);

	}


		public function more($slug=''){
		//exit('Great');

        $slug = ($this->uri->segment(3)) ? $this->uri->segment(3) : '';
		if($slug !== ''){
			$page_id = $this->post_model->get_pageId($slug);
			if ($page_id > 0) {
				# code...
				$abstract = $this->post_model->get_content($page_id);//'This is the info';
				$print1 = '<label for="abstract">Abstract</label> <br>'.$abstract;

				$clients = $this->post_model->get_clients($page_id);//'This is the info';
				$print2 = '<br><br><label for="abstract">Clients</label> <br>'.$clients;

				$proponets = $this->post_model->get_proponents($page_id);//'This is the info';
				$print3 ='<br><br><label for="abstract">Proponent</label> <br>'.$proponets;


			$data['content'] = $print1.$print2.$print3;
			}
		}else{
			$data['content'] = ('No information to display');
		}

		$this->load->view('admin/default/header',$data);
		$this->load->view('admin/default/sidemenu',$data);
		$this->load->view('admin/contents',$data);
		$this->load->view('admin/default/footer',$data);

	}

	public function view($value='')
	{
		# code...
		$content = '';
		$data['content'] = $content;
		$data['subtitle']= "THESIS ";
		$data['username']= $this->session->username;



        // init params
        $params = array();
        $limit_per_page = 10;
        $page = ($this->uri->segment(3)) ? ($this->uri->segment(3) - 1) : 0;
        $total_records = $this->post_model->get_total();
     
        if ($total_records > 0)
        {
            // get current page records
            $data["results"] = $this->post_model->get_current_page_records($limit_per_page, $page*$limit_per_page);
                 
            $config['base_url'] = site_url() . '/post/view';
            $config['total_rows'] = $total_records;
            $config['per_page'] = $limit_per_page;
            $config["uri_segment"] = 3;
             
            // custom paging configuration
            $config['num_links'] = 2;
            $config['use_page_numbers'] = TRUE;
            $config['reuse_query_string'] = TRUE;
             
            /* This Application Must Be Used With BootStrap 3 *  */
			
             
            $this->pagination->initialize($config);
                 
            // build paging links
            $data["links"] = $this->pagination->create_links();

		


		$this->load->view('admin/default/header',$data);
		$this->load->view('admin/default/sidemenu',$data);
		$this->load->view('post/post',$data);
		$this->load->view('admin/default/footer',$data);
		}
	}

	public function create($value='')
	{
		# code...


		$data['listgroup'] = $this->group_model->group_type(3);

		$content = '';
		$data['content'] = $content;
		$data['subtitle']= "THESIS - Abstract";
		$data['username']= $this->session->username;


		$this->load->view('admin/default/header',$data);
		$this->load->view('admin/default/sidemenu',$data);
		$this->load->view('post/create',$data);
		$this->load->view('admin/default/footer',$data);
	}
		public function clients($slug='')
	{
		# code...
		if ($this->input->post()) {
			//var_dump($this->input->post());exit();
			//if(count($this->input->post('txtproponent')) > 0){
				//$posit = $this->input->post('txtposition');
				//$i = 0;
				/*foreach ($this->input->post('txtproponent') as $key) {
					# code...
					$data[] = array('name' => $key,'position'=>$posit[$i]);
					$i++;
				}*/
				$client = $this->input->post('txtclient');
				$clientaddress = $this->input->post('txtclientaddress');

				$clients = json_encode(array('client'=>$client,'address'=>$clientaddress));
				$id = $this->post_model->get_pageId($this->input->post('savetitle'));

				$insert = $this->post_model->insert(array('name'=>'clients','value'=>$clients,'group_id'=>$id));
				if($insert === true){
					echo json_encode(array('stats'=>true,'msg'=>"Client updated successfully."));
				}else{
					echo json_encode(array('stats'=>false,'msg'=>"Unknown error occured."));
				}
			//}
		}else{
			echo json_encode(array('stats'=>false,'msg'=>"No input receieved"));
		}

	}

	public function proponent($slug='')
	{
		# code...
		if ($this->input->post()) {
			//var_dump($this->input->post());exit();
			if(count($this->input->post('txtproponent')) > 0){
				$posit = $this->input->post('txtposition');
				$i = 0;
				foreach ($this->input->post('txtproponent') as $key) {
					# code...
					$data[] = array('name' => $key,'position'=>$posit[$i]);
					$i++;
				}

				$proponets = json_encode($data);
				$id = $this->post_model->get_pageId($this->input->post('savetitle'));

				$insert = $this->post_model->insert(array('name'=>'proponent','value'=>$proponets,'group_id'=>$id));
				if($insert === true){
					echo json_encode(array('stats'=>true,'msg'=>"Proponent updated successfully."));
				}else{
					echo json_encode(array('stats'=>false,'msg'=>"Unknown error occured."));
				}
			}
		}else{
			echo json_encode(array('stats'=>false,'msg'=>"No input receieved"));
		}

	}
	public function panels($slug='')
	{
		# code...
				if ($this->input->post()) {
			//var_dump($this->input->post());exit();
			if(count($this->input->post('txtexampanel')) > 0){
				$panelpos = $this->input->post('txtexampanelposition');
				$i = 0;
				foreach ($this->input->post('txtexampanel') as $key) {
					# code...
					$data[] = array('name' => $key,'position'=>$panelpos[$i]);
					$i++;
				}

				$panels = json_encode($data);
				$id = $this->post_model->get_pageId($this->input->post('savetitle'));

				$insert = $this->post_model->insert(array('name'=>'panels','value'=>$panels,'group_id'=>$id));
				if($insert === true){
					echo json_encode(array('stats'=>true,'msg'=>"Panels updated successfully."));
				}else{
					echo json_encode(array('stats'=>false,'msg'=>"Unknown error occured."));
				}
			}
		}else{
			echo json_encode(array('stats'=>false,'msg'=>"No input receieved"));
		}
	}
		public function panel($slug='')
	{
		# code...
		if ($this->input->post()) {
			//var_dump($this->input->post());exit();
			if(count($this->input->post('txtexampanel')) > 0){
				$posit = $this->input->post('txtexampanelposition');
				$i = 0;
				foreach ($this->input->post('txtexampanel') as $key) {
					# code...
					$data[] = array('panel' => $key,'position'=>$posit[$i]);
					$i++;
				}
				//var_dump($data);

				$panels = json_encode($data);
				$id = $this->post_model->get_pageId($this->input->post('savetitle'));

				$insert = $this->post_model->insert(array('name'=>'panel','value'=>$panels,'group_id'=>$id));
				if($insert === true){
					echo json_encode(array('stats'=>true,'msg'=>"Panel updated successfully."));
				}else{
					echo json_encode(array('stats'=>false,'msg'=>"Unknown error occured."));
				}
			}
		}else{
			echo json_encode(array('stats'=>false,'msg'=>"No input receieved"));
		}

	}
		public function committee($slug='')
	{
		# code...
		if ($this->input->post()) {
			//var_dump($this->input->post());exit();
			if(count($this->input->post('txtcommittee')) > 0){
				$posit = $this->input->post('txtcommitteeposition');
				$i = 0;
				foreach ($this->input->post('txtcommittee') as $key) {
					# code...
					$data[] = array('committee' => $key,'committeeposition'=>$posit[$i]);
					$i++;
				}

				$committees = json_encode($data);
				$id = $this->post_model->get_pageId($this->input->post('savetitle'));

				$insert = $this->post_model->insert(array('name'=>'committee','value'=>$committees,'group_id'=>$id));
				if($insert === true){
					echo json_encode(array('stats'=>true,'msg'=>"Committee updated successfully."));
				}else{
					echo json_encode(array('stats'=>false,'msg'=>"Unknown error occured."));
				}
			}
		}else{
			echo json_encode(array('stats'=>false,'msg'=>"No input receieved"));
		}

	}
		public function course($slug='')
	{
		# code...
		if ($this->input->post()) {
			//var_dump($this->input->post());exit();
			//if(count($this->input->post('txtcollege')) > 0){
				$college = $this->input->post('selectcollege');
				//$course = $this->input->post('selectcourse');

				$colleges = json_encode(array('college'=>$college));
				$id = $this->post_model->get_pageId($this->input->post('savetitle'));

				$insert = $this->post_model->insert(array('name'=>'college','value'=>$colleges,'group_id'=>$id));
				if($insert === true){
					echo json_encode(array('stats'=>true,'msg'=>"College updated successfully."));
				}else{
					echo json_encode(array('stats'=>false,'msg'=>"Unknown error occured."));
				}
			//}
		}else{
			echo json_encode(array('stats'=>false,'msg'=>"No input receieved"));
		}

	}
	public function save($value='')
	{
		# code...
		//echo "save";
		if($this->input->post()){

			$title = $this->input->post('title');
			$clean_url = $this->slug->create($this->input->post('title'));
			$tags = $this->input->post('tags');
			$group = $this->input->post('group');
			$content = $this->input->post('contents');
			$year = $this->input->post('selectyear');
			$month = $this->input->post('selectmonth');
			//var_dump($content);
			if(!$this->post_model->isExist($title)){
				$result = $this->post_model->save_abstract(array('title'=>$title,'slug'=>$clean_url,'year'=>$year,'month'=>$month,'content'=>$content));
				$id = $result;

				$insert = $this->post_model->insertTags(array('keyword'=>$tags,'group_id'=>$id));

				$page_permission = $this->post_model->page_permission($id,$group,2);

				if($result){
					echo json_encode(array('stats'=>true,'slug'=>$clean_url));
				}else{
					echo json_encode(array('stats'=>false,'error'=>'Unknown Error occured.'));
				}
			}else{
					echo json_encode(array('stats'=>false,'error'=>'Title already exist!'));
			}

		}else{
			exit('No action received');
		}
	}




	public function searchee($value='')
	{

		/**************************************************/


		if($this->input->post('txtsearch')){

		$tags = $this->input->post('txtsearch');
		$this->session->tags = $tags;

		}else{

  		$tags = $this->session->tags;

		}

        $q = trim($this->input->get('q'));

        $limit_per_page = 2;
       // $start = 0;

						if($this->uri->segment(3))
				            {
				                $page = $this->uri->segment(3);
				                //echo $page;
				            }else{
				            	$page = 0;
				            }


		/*****************************************************/
        //print_r(strlen($q));
        if(strlen($q)>0)
        {
            $config['enable_query_strings']=TRUE;
            //print($tags);

        }else{

            $config['enable_query_strings']=TRUE;
            //print($tags);


            	$result2 = $this->post_model->search($tags,$limit_per_page,$page);
            	if($result2 !== false){


						$content = '<table class="table">';
						$info2 = '';

						foreach ($result2 as $key) {

							$info = $this->post_model->get_content($key->page_id);
							$info2 .= "<tr><td> <a  target='_blank' href='".site_url('post/more/').$key->slug."'><h3>$key->title</h3></a>$info</td></tr>";

							
						}
						$content .= $info2.'<table>';
						echo $content;

			            $total_row = $this->post_model->like_total($tags);
						$config['base_url'] = site_url() . '/dashboard/index';
			            $config['total_rows']=$total_row;
			            $config['per_page'] = $limit_per_page;
			            $config["uri_segment"] = 3;
             
			            $this->pagination->initialize($config);
			                 
			            $links = $this->pagination->create_links();

			            echo $links;


            	}else{

            	//print_r($result2);
            	}

        }
    

	}







	/* ----------------------------------------------------------------------------------------- */



	public function search($string='')
	{
		# code...
		$string = $this->input->post('txtsearch');
		//var_dump($string);

		$content = '';
		$title = '';
		$info = '';
		$links = '';

        $limit_per_page = 10;
        $page = ($this->uri->segment(3)) ? ($this->uri->segment(3) - 1) : 0;
        $total_records = $this->post_model->like_total($string);
     

		if($result2 = $this->post_model->search($string,$limit_per_page,0))
		{
			$content = '<table class="table">';
			$info2 = '';
			//var_dump($result2)
			foreach ($result2 as $key) {

				$info = $this->post_model->get_content($key->page_id);
				$info2 .= "<tr><td> <a  target='_blank' href='".site_url('post/more/').$key->slug."'><h3>$key->title</h3></a>$info</td></tr>";

				
			}
			$content .= $info2.'<table>';

			$config['base_url'] = site_url() . '/post/index';
            $config['total_rows'] = $this->post_model->like_total($string);
            $config['per_page'] = $limit_per_page;
            $config["uri_segment"] = 3;
             
             
            /* This Application Must Be Used With BootStrap 3 *  */ //to edit go too global_model
			
             
            $this->pagination->initialize($config);
                 
            $links = $this->pagination->create_links();

			echo $content;

            echo $links;
		
		}




	}

		public function read($value='')
	{
		# code...

        $slug = ($this->uri->segment(3)) ? $this->uri->segment(3) : '';
		if($slug !== ''){
			$page_id = $this->post_model->get_pageId($slug);
			if ($page_id > 0) {
				# code...
				$title = $this->post_model->get_pageTitle($slug);//'This is the info';
				$print0 = '<h3 style="text-transform:uppercase;">'.$title.'</h3>';

				$abstract = $this->post_model->get_content($page_id);//'This is the info';
				$print1 = '<label for="abstract">Abstract:</label> <br>'.$abstract;

				$clients = $this->post_model->get_clients($page_id);//'This is the info';
				$print2 = '<br><br><label for="abstract">Clients:</label> <br>'.$clients;

				$proponets = $this->post_model->get_proponents($page_id);//'This is the info';
				$print3 ='<label for="abstract">Researcher:</label> <br>'.$proponets;


			$data['content'] = $print0. $print3.$print1.$print2;
			}
		}else{
			$data['content'] = ('No information to display');
		}
		$data['ishide'] = 'hidden';

		$data['title'] = "Thesis Hub";
		$this->load->view('search/common/header',$data);
		$this->load->view('search/common/menu',$data);
		$this->load->view('search/result',$data);
		$this->load->view('search/common/footer');
	}
}

/*
accepted
This isn't the way it shouldn't be done, like the comments adressed. You should split up this in three tables:

A table which stores the posts itself;

Table posts
-----------
id
text
A table for all the tags;

Table tags
-----------
id
name
And finally a table to connect the two;

Table postTags
-----------
id
postId
tagId
When selecting data from these, you can use a query like the one below:

SELECT * FROM posts p
INNER JOIN postTags pt ON pt.postId = p.id
INNER JOIN tags t ON pt.tagId = t.id  */