<?php 


defined('BASEPATH') OR exit('No direct script access allowed');


/**
* 
*/
class Backup extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
                $this->load->library('excel');//load PHPExcel library 
		//$this->load->model('upload_model');//To Upload file in a directory
                $this->load->model('file_m');
                $this->load->model('excel_m');
                $this->load->helper('form');
	}
	public function index2($value='')
	{
	  # code...
	  $this->load->view('excel/import');
	}

	public function index()
	{
		# code...

		/*$out = fopen('php://output', 'w');
		fputcsv($out, array('this','is some', 'csv "stuff", you know.'));
		fclose($out);
		*/


		$list_life =  $this->file_m->listall();
		$list = array (
		    array('aaa', 'bbb', 'ccc', 'dddd'),
		    array('123', '456', '789'),
		    array('"aaa"', '"bbb"')
		);

		$fp = fopen('importexport.csv', 'w');

   		fputs($fp, $bom =( chr(0xEF) . chr(0xBB) . chr(0xBF) ));
		foreach ($list_life as $fields) {
		    fputcsv($fp, $fields);
		}

		fclose($fp);
	}
	

	
}