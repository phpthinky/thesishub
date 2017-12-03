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

            /* This Application Must Be Used With BootStrap 3 *  */
			$config['full_tag_open'] = "<ul class='pagination'>";
			$config['full_tag_close'] ="</ul>";
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';
			$config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
			$config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
			$config['next_tag_open'] = "<li>";
			$config['next_tagl_close'] = "</li>";
			$config['prev_tag_open'] = "<li>";
			$config['prev_tagl_close'] = "</li>";
			$config['first_tag_open'] = "<li>";
			$config['first_tagl_close'] = "</li>";
			$config['last_tag_open'] = "<li>";
			$config['last_tagl_close'] = "</li>";
			
            $this->pagination->initialize($config);
	}
	public function index()
	{
		# code...
		//$this->load->library('Aauth');

	}
}