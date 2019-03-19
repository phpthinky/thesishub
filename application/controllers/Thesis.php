<?php  

/**
* 
*/
class Thesis extends CI_Controller
{
	public $uid = 0;
	
	function __construct()
	{
		# code...
		parent::__construct();
		$this->load->library('aauth');
		$this->load->library('slug');
		$this->load->model('search_model');
		if (!$this->aauth->is_loggedin()){
        	redirect();
        }
        $this->uid = $this->session->userdata('id');
	}
	public function index($start=0)
	{
		# code...


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
						$config['base_url'] = site_url() . "/t/index";
			            $config['total_rows']=$total_row;
			            $config['per_page'] = $limit;
				        $config["uri_segment"] = 3;
				        $choice = $config["total_rows"]/$config["per_page"];
				        $config["num_links"] = floor($choice);
             
             
			            $this->pagination->initialize($config);
			                 
			            $links = $this->pagination->create_links();
			           // var_dump($total_row);

        	//$start = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
			$pages = $this->search_model->find($this->uid,false,$ids,$limit,$start);
			if(is_array($pages)){
			$content = '<table class="table">';

				foreach ($pages as $key) {

						$content .= "<tr><td><a href=''>$key->title</a><p style='padding-left:20px;'>$key->content </p></td></tr>";
				}
			$content .="</table>";
			}


		
		$data['limit'] = $limit;
		$data['start'] = $start;
		$data['total'] = $total_row;
		$data['content']= isset($content) ? $content : false;
		$data['links']= $links;
		$data['title'] = "Thesis Hub";
		$this->load->view('search/common/header',$data);
		$this->load->view('search/common/menu',$data);
		$this->load->view('search/search_new',$data);
		$this->load->view('search/common/footer');
	}
	public function search($search=false,$start=0)
	{

		if($this->input->post()){
			$segment = $this->slug->create($this->input->post('q'));
			redirect("t/search/$segment");
		}elseif($search == false){
			redirect('thesis');
		}else{
			//$search = str_replace('-', ' ', $search);
			$segment = $search;
			$search = array_unique(array_filter(explode('-',$search)));
			
		}
		$limit = 5;

		$groups = $this->aauth->get_user_groups($this->uid);			
			if($groups){
				foreach ($groups as $key) {
					# code...
					$ids[]= $key->group_id;
				}
			}
	    $total = $this->search_model->page_total();

        //$search = ($this->input->post("q"))? $this->input->post("q") : FALSE;

        //$search = ($this->uri->segment(3)) ? $this->uri->segment(3) : $search;





			            $total_row = $this->search_model->page_total($ids,$search);
						$config['base_url'] = site_url() . "/t/search/$segment";
			            $config['total_rows']=$total_row;
			            $config['per_page'] = $limit;
             
             
			            $this->pagination->initialize($config);
			                 
			            $links = $this->pagination->create_links();
			           // var_dump($total_row);

        	//$start = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
			$pages = $this->search_model->find($this->uid,$search,$ids,$limit,$start);
			if(is_array($pages)){
			$content = '<table class="table">';

				foreach ($pages as $key) {

						$content .= "<tr><td><a href=''>$key->title</a><p style='padding-left:20px;'>$key->content </p></td></tr>";
				}
			$content .="</table>";
			}


		
		
		$data['limit'] = $limit;
		$data['start'] = $start;
		$data['total'] = $total_row;
		$data['content']= isset($content) ? $content : false;
		$data['links']= $links;
		$data['title'] = "Thesis Hub";
		$this->load->view('search/common/header',$data);
		$this->load->view('search/common/menu',$data);
		$this->load->view('search/search_new',$data);
		$this->load->view('search/common/footer');

		
	}

	function search2()
    {
        // get search string
        $search = ($this->input->post("book_name"))? $this->input->post("book_name") : "NULL";

        $search = ($this->uri->segment(3)) ? $this->uri->segment(3) : $search;

        // pagination settings
        $config = array();
        $config['base_url'] = site_url("pagination/search/$search");
        $config['total_rows'] = $this->pagination_model->get_books_count($search);
        $config['per_page'] = "5";
        $config["uri_segment"] = 4;
        $choice = $config["total_rows"]/$config["per_page"];
        $config["num_links"] = floor($choice);

        // integrate bootstrap pagination
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = 'Prev';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = 'Next';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $this->pagination->initialize($config);

        $data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        // get books list
        $data['booklist'] = $this->pagination_model->get_books($config['per_page'], $data['page'], $search);

        $data['pagination'] = $this->pagination->create_links();

        //Load view
        $this->load->view('pagination_view',$data);
    }

}