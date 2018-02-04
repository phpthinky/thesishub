<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class Statistics_m extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}



	public function render_by_yearcourse($course=false,$year_s=false,$year_e=false,$utility = false)
	{
		if($year_s){
		$query = $this->db->select('count(page_id) as counter,YEAR(date_created) as year_c, implemented')
			->where('group_course',$course)
			->where('YEAR(date_created)',$year_s)
			->where('implemented',$utility)
			->get('post');
		return $query->result();

		}else{
		$query = $this->db->select('count(page_id) as counter,YEAR(date_created) as year_c, implemented')
			->where('group_course',$course)
			->where('YEAR(date_created)',$year_e)
			->where('implemented',$utility)
			->get('post');
		return $query->result();
		}
	}
	public function render_no_by_yearcourse($course=false,$year_e = false)
	{
		$query = $this->db->select('count(*) as counter, YEAR(date_created) as yearofstudy')
				->where('group_course',$course)
				->where('YEAR(date_created)',$year_e)
				->where('implemented','no')
				->get('post');
				return $query->result();

	}
	public function render_yes_by_yearcourse($course=false,$year_e = false)
	{
		$query = $this->db->select('count(*) as counter, YEAR(date_created) as yearofstudy')
				->where('group_course',$course)
				->where('YEAR(date_created)',$year_e)
				->where('implemented','yes')
				->get('post');
				return $query->result();

	}

	public function render_na_by_yearcourse($course=false,$year_e = false)
	{
		$query = $this->db->select('count(*) as counter, YEAR(date_created) as yearofstudy')
				->where('group_course',$course)
				->where('YEAR(date_created)',$year_e)
				->where('implemented','na')
				->get('post');
				return $query->result();

	}
	





}