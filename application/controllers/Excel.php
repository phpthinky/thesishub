<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Excel
 extends CI_Controller
{

public function __construct() {
        parent::__construct();
                $this->load->library('excel');//load PHPExcel library 
		//$this->load->model('upload_model');//To Upload file in a directory
                $this->load->model('excel_m');
                $this->load->helper('form');
}	

public function index($value='')
{
  # code...
  $this->load->view('excel/import');
}
	
}