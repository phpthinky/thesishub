<?php 


defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Statistics extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->init();
	}
	public function init()
	{
		if (!$this->aauth->is_loggedin()) {
			redirect();
		}

		$this->load->model('group_m');
		$this->load->model('file_m');
		$this->load->model('post_m');
		$this->load->model('setting_m');
		$this->load->model('statistics_m');
	}
	public function index($value='')
	{
		
		//$data['utility_start'] = 

		//$y1 = $this->statistics_m->render_by_yearcourse(9,2016,false,'no');
		//$y2= $this->statistics_m->render_by_yearcourse(9,2017,false,'no');
		//$y3 = $this->statistics_m->render_by_yearcourse(9,2018,false,'no');
		$is_course = '';
		$end =  2018;
		$start =  2018 -5;
		$j=0;
		$course_id = 9;
		if($this->input->get()){
			$input = (object)$this->input->get();

			$end = $input->year2;
			$start =$input->year;
			$is_course =$input->courses;

			$course_id = $this->aauth->get_group_id($is_course);

		}
		$data['start_year'] = $start;
		$data['end_year'] = $end;
		$data['is_course'] = ($is_course) ? $is_course : '' ;

		for ($i=$start; $i <= $end ; $i++) { 
			# code...
		$yes[$j] = $this->statistics_m->render_yes_by_yearcourse($course_id,$i);
		$no[$j] = $this->statistics_m->render_no_by_yearcourse($course_id,$i);
		$na[$j] = $this->statistics_m->render_na_by_yearcourse($course_id,$i);


		$j++;
		}
		$obj = ''; 
			$k=0;$s= $start;
			foreach ($yes as $key) {

			$obj[$k]['year'] = $s;
			$obj[$k]['counter'] = $key[0]->counter;
			$obj[$k]['yof'] = $key[0]->yearofstudy;
			$s++;
			$k++;
			}

		$obj2 = '';
			$k=0;$s= $start;
			foreach ($no as $key) {

			$obj2[$k]['year'] = $s;
			$obj2[$k]['counter'] = $key[0]->counter;
			$obj2[$k]['yof'] = $key[0]->yearofstudy;
			$s++;
			$k++;
			}

		$obj3 = '';
			$k=0;$s= $start;
			foreach ($na as $key) {

			$obj3[$k]['year'] = $s;
			$obj3[$k]['counter'] = $key[0]->counter;
			$obj3[$k]['yof'] = $key[0]->yearofstudy;
			$s++;
			$k++;
			}

			foreach ($obj as $key) {
				$count[] = $key['counter'];
				$year[] =$key['year'];
			}
			//$year = implode(',',$year);
			$count = implode(',',$count);
			$data['years'] = json_encode($year);
			$data['counters'] =$count;// json_encode($count);


			foreach ($obj2 as $key) {
				$count_n[] = $key['counter'];
				$year_n[] =$key['year'];
			}
			//$year = implode(',',$year);
			$count = implode(',',$count_n);
			$data['years_n'] = json_encode($year_n);
			$data['counters_n'] =$count;// json_encode($count);


			foreach ($obj3 as $key) {
				$count_na[] = $key['counter'];
				$year_na[] =$key['year'];
			}
			//$year = implode(',',$year);
			$count = implode(',',$count_na);
			$data['years_na'] = json_encode($year_na);
			$data['counters_na'] =$count;// json_encode($count);


			$data['yes'] = $obj;

			$data['no'] = $obj2;

			$data['na'] = $obj3;

		//$data['statistics'] = array($y1,$y2,$y3);

		$data['courses'] = $this->group_m->group_type(3);

		$data['title'] = 'Statistics';
		$this->template->load('admin','statistics/index',$data);
	}
}