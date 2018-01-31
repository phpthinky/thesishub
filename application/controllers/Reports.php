<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
* 
*/
class Reports extends CI_Controller
{
	
	public $uid = 0;
	
	public function __construct()
	{
		# code...
		parent::__construct();
		$this->load->library('aauth');
		$this->load->library('slug');
		$this->load->library('excel');
		$this->load->model('search_model');
		$this->load->model('user_model');
		$this->load->model('file_m');
		if (!$this->aauth->is_loggedin()){
        	redirect();
        }
        if($this->session->userdata['permit'] == 'students'){
        	redirect();
        }
        $this->uid = $this->session->userdata('id');

	}
	public function index($value='')
	{
		# code...
		redirect('dashboard');
	}
	public function userlogs($value='')
	{
		# code...

		$data['title']= "Reports - user activities";
		$this->load->view('admin/default/header',$data);
		$this->load->view('admin/default/menu',$data);
		$this->load->view('admin/reports/download_report',$data);
		$this->load->view('admin/default/footer',$data);
	}
	public function visitorlogs($value='')
	{
		# code...

		$data['title']= "Reports - visitorlogs";
		$this->load->view('admin/default/header',$data);
		$this->load->view('admin/default/menu',$data);
		$this->load->view('admin/reports/download_report',$data);
		$this->load->view('admin/default/footer',$data);
	}


	public function download($value='')
	{
	 
		# code...
		$limit = $this->input->get('limit') ? $this->input->get('limit')  : 0;

		if ($this->input->get()) {


			# code...
			$selection = $this->input->get('selection');

			if ($selection == 'less') {

			$data['content'] = $this->file_m->less_downloaded($limit);
			$this->session->userdata['download'] = json_encode(array('s'=>$selection,'l'=>$limit));
				# code...
			}elseif($selection == 'most'){


			$data['content'] = $this->file_m->most_downloaded($limit);
			$this->session->userdata['download'] = json_encode(array('s'=>$selection,'l'=>$limit));
			}else{


			$data['content'] = $this->file_m->random_downloaded($limit);
			$this->session->userdata['download'] = json_encode(array('s'=>'random','l'=>$limit));
			}
		}else{
			$this->session->userdata['download'] = json_encode(array('s'=>'random','l'=>$limit));

			$data['content'] = $this->file_m->random_downloaded($limit);

		}



		$data['title']= "Reports - download logs";
		$this->load->view('admin/default/header',$data);
		$this->load->view('admin/default/menu',$data);
		$this->load->view('admin/reports/download_report',$data);
		$this->load->view('admin/default/footer',$data);
	}


	public function upload($value='')
	{
		# code...
		$userlist = $this->user_model->get_all_user_except_students(true);
		$limit = $this->input->get('limit') ? $this->input->get('limit')  : 0;

		if ($this->input->get()) {


			# code...
			$selection = $this->input->get('selection');
			$users = $this->input->get('users');


			if ($selection == 'recent') {

				if ((int)$users > 0) {
			//echo "$limit $selection $users";
					# code...
			$data['content'] = $this->file_m->recent_upload($limit,$users);

				}else{
			$data['content'] = $this->file_m->recent_upload($limit);

				}



			$this->session->userdata['upload'] = json_encode(array('s'=>$selection,'l'=>$limit,'u'=>$users));
				# code...


			}


		}else{
			$this->session->userdata['upload'] = json_encode(array('s'=>'recent','l'=>$limit));

			$data['content'] = $this->file_m->recent_upload($limit);

		}

		$data['listusers'] = $userlist;

		$data['title']= "Reports - Upload logs";
		$this->load->view('admin/default/header',$data);
		$this->load->view('admin/default/menu',$data);
		$this->load->view('admin/reports/upload_report',$data);
		$this->load->view('admin/default/footer',$data);
	}
	

	public function printexcel($value='')
	{
		# code...

		$session = json_decode($this->session->userdata['download']);

		$limit= $session->l;
		$selection= $session->s;

			if ($selection == 'less') {

			$data = $this->file_m->less_downloaded($limit);
				# code...
			}elseif($selection == 'most'){

			$data = $this->file_m->most_downloaded($limit);

			}else{

			$data = $this->file_m->random_downloaded($limit);

			}

			$i=2;
			$j = 1;
			if (is_array($data)) {
				# code...
			foreach ($data as $key) {
				# code...

				$this->excel->getActiveSheet()->setCellValue('A'.$i, $j );
				$this->excel->getActiveSheet()->setCellValue('B'.$i, $key->title );
				$this->excel->getActiveSheet()->setCellValue('C'.$i, $key->d_date );
				$this->excel->getActiveSheet()->setCellValue('D'.$i, $key->visita );
				$i++;$j++;
			}
			}
		//load our new PHPExcel library
		$this->load->library('excel');
		//activate worksheet number 1
		$this->excel->setActiveSheetIndex(0);
		//name the worksheet
		$this->excel->getActiveSheet()->setTitle('Download Reports');
		//set cell A1 content with some text
		$this->excel->getActiveSheet()->setCellValue('B1', 'TITLE');
		$this->excel->getActiveSheet()->setCellValue('C1', 'DATE');
		$this->excel->getActiveSheet()->setCellValue('D1', 'DOWNLOAD');
		//change the font size
		$this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(12);
		$this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(12);
		$this->excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(12);

		//make the font become bold
		//$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
		//merge cell A1 until D1
		//$this->excel->getActiveSheet()->mergeCells('A1:D1');
		//set aligment to center for that merged cell (A1 to D1)
		$this->excel->getActiveSheet()->getStyle('B1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('C1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('D1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		 $date = (date('Y-m-d-h:m:s'));
		$filename='Download_logs-'.$date.'.xlsx'; //save our workbook as this file name
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		//header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
		             
		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');  
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
	}


	public function uploadprintexcel($value='')
	{
		# code...

		$session = json_decode($this->session->userdata['upload']);

		$limit= $session->l;
		$selection= $session->s;
		$users = $session->u;

			if ($selection == 'recent') {
				if ($users > 0) {
					# code...
			$data = $this->file_m->recent_upload($limit,$users);
				}else{

			$data = $this->file_m->recent_upload($limit);
				}
				# code...
			}


			$i=2;
			$j = 1;
			if (is_array($data)) {
				# code...
			foreach ($data as $key) {
				# code...

				$this->excel->getActiveSheet()->setCellValue('A'.$i, $j );
				$this->excel->getActiveSheet()->setCellValue('B'.$i, $key->title );
				$this->excel->getActiveSheet()->setCellValue('C'.$i, $key->d_date );
				$this->excel->getActiveSheet()->setCellValue('D'.$i, $key->name );
				$i++;$j++;
			}
			}
		//load our new PHPExcel library
		$this->load->library('excel');
		//activate worksheet number 1
		$this->excel->setActiveSheetIndex(0);
		//name the worksheet
		$this->excel->getActiveSheet()->setTitle('Download Reports');
		//set cell A1 content with some text
		$this->excel->getActiveSheet()->setCellValue('A1', '#');
		$this->excel->getActiveSheet()->setCellValue('B1', 'TITLE');
		$this->excel->getActiveSheet()->setCellValue('C1', 'DATE POSTED');
		$this->excel->getActiveSheet()->setCellValue('D1', 'POSTED BY');
		//change the font size
		$this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(12);
		$this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(12);
		$this->excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(12);

		//make the font become bold
		//$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
		//merge cell A1 until D1
		//$this->excel->getActiveSheet()->mergeCells('A1:D1');
		//set aligment to center for that merged cell (A1 to D1)
		$this->excel->getActiveSheet()->getStyle('B1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('C1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('D1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


		foreach(range('A','D') as $columnID) {
		    $this->excel->getActiveSheet()->getColumnDimension($columnID)
		        ->setAutoSize(true);
		}
		 $date = (date('Y-m-d-h:m:s'));
		$filename='Upload_logs-'.$date.'.xlsx'; //save our workbook as this file name
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		//header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
		             
		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');  
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
	}
}