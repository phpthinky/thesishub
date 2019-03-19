<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Help extends CI_Controller {


	public function __construct()
	{
		# code...
		parent::__construct();
		$this->load->library('session');
		$this->load->library('pagecounter');
		$this->load->library('minify');
		//$this->load->library('Aauth');
		if(!$this->aauth->is_loggedin())
			redirect('');
	}
	public function index($value='')
	{
		# code...

		$content = '';
		$data['content'] = $content;
		$data['subtitle']= "FAQ ";
		$data['username']= $this->session->username;


		$this->load->view('admin/default/header',$data);
		$this->load->view('admin/default/sidemenu',$data);
		$this->load->view('admin/contents',$data);
		$this->load->view('admin/default/footer',$data);
	}
}