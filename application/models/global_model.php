<?php 

/**
* 
*/
class Global_model extends CI_Model
{
	
	function __construct()
	{
		# code...
		parent::__construct();
		$this->load->library('Aauth');
		$this->load->library('minify');
		$this->load->library('session');
		$this->load->library('pagination');

                    // integrate bootstrap pagination
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '«';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '»';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
			
            $this->pagination->initialize($config);
	}
	public function index()
	{
		# code...
		//$this->load->library('Aauth');

	}
}