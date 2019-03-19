<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Search extends CI_Controller
{
	public $uid = 0;
	
	function __construct()
	{
		# code...
		parent::__construct();
		$this->load->library('minify');
		$this->load->model('post_model');
		$this->uid = $this->session->userdata('id');
		//$this->load->library('Aauth');
        if (!$this->aauth->is_loggedin()){
        	redirect();
        }elseif(!$this->aauth->is_allowed('researcher',$this->uid)){
        	redirect('access');
        }

	}

	public function index($tags='',$p=0)
	{
		# code...
		redirect('thesis');




		$ifsearch = '';
		$tags = '';
		if($this->uri->segment(3)){
			$tags = $this->session->tags;
			$ifsearch = $this->tag($tags);
		}elseif ($this->uri->segment(2) === 'index') {
			# code...
			$tags = $this->session->tags;
			$ifsearch = $this->tag($tags);
		}elseif (isset($_GET['q'])){
			$tags = $_GET['q'];
			$ifsearch = $this->tag($tags);


		
		}else{
			$this->session->tags = '';
		}


		$data['tags'] = $tags;//isset($this->session->tags) ?  $this->session->tags :  '';
		$data['ishidesearch'] ='hidden';
		$data['isactive'] ='home';
		$data['searchresult'] = $ifsearch;//$this->tag($data['tags']);
		$data['title'] = "Thesis Hub";
		$this->load->view('search/common/header',$data);
		$this->load->view('search/common/menu',$data);
		$this->load->view('search/search',$data);
		$this->load->view('search/common/footer');
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

		$data['title'] = "Thesis Hub";
		$this->load->view('search/common/header',$data);
		$this->load->view('search/common/menu',$data);
		$this->load->view('search/result',$data);
		$this->load->view('search/common/footer');
	}

	public function hanapin()
	{
		# code...
		if($this->input->post()){
			if($this->input->post('selectby') > 0){

				print($this->tag_by($this->input->post('txtsearch'),$this->input->post('selectby')));
			}else{
				print($this->tag());

			}
		//echo "Nakita\n";

			//print $this->input->post('txtsearch');
		}
	}
	public function tag_by($value='',$by = 0)
	{
		# code...
		print('Temporary Unavailable');

	}
	public function tag($value='')
	{

		/**************************************************/


		if($this->input->post('txtsearch')){

		$tags = $this->input->post('txtsearch');
		$this->session->tags = $tags;

		}
		else{

  		$tags = $value;//$this->session->tags;

		}

        $q = trim($this->input->get('q'));

        $limit_per_page = 5;
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

            	$result2 = $this->post_model->search($tags,$limit_per_page,$page);
            	//var_dump($result2);
            	if($result2 !== false){

            		$content = '<table class="table">';
						$info2 = '';

						foreach ($result2 as $key) {

							$info = $this->post_model->get_content($key->page_id);
							$info2 .= "<tr><td> <a   href='".site_url('post/read/').$key->slug."'><h3>$key->title</h3></a>$info</td></tr>";

							
						}
						$content .= $info2.'<table>';

			            $total_row = $this->post_model->like_total($tags);
						$config['base_url'] = site_url() . '/search/index';
			            $config['total_rows']=$total_row;
			            $config['per_page'] = $limit_per_page;
			            $config["uri_segment"] = 3;
             
			            $this->pagination->initialize($config);
			                 
			            $links = $this->pagination->create_links();

			            $content .= $links;
						return $content;
            	}


        }else{

            $config['enable_query_strings']=TRUE;
            //print($tags);


            	$result2 = $this->post_model->search($tags,$limit_per_page,$page);
            	if($result2 !== false){


						$content = '<table class="table">';
						$info2 = '';

						foreach ($result2 as $key) {

							$info = $this->post_model->get_content($key->page_id);
							$info2 .= "<tr><td> <a   href='".site_url('post/read/').$key->slug."'><h3>$key->title</h3></a>$info</td></tr>";

							
						}
						$content .= $info2.'<table>';
						//$data['searchresult'] = $content;

			            $total_row = $this->post_model->like_total($tags);
						$config['base_url'] = site_url() . '/search/index';
			            $config['total_rows']=$total_row;
			            $config['per_page'] = $limit_per_page;
			            $config["uri_segment"] = 3;
             
			            $this->pagination->initialize($config);
			                 
			            $links = $this->pagination->create_links();

			            $content .= $links;
			            return $content;


            	}

        }
    

	}





































	/****************** end of class ************************/
}