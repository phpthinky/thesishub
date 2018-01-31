<?php 

/**
* 
*/
class Permission
{
	public $ci;
	public function __construct($value='')
	{
		# code...
		$this->ci = & get_instance();

		// Dependancies
		if(CI_VERSION >= 2.2){
			$this->ci->load->library('driver');
		}
		$this->ci->load->library('session');


	}
	public function access()
	{
		# code...
		# code...
        if($this->ci->session->userdata['permit'] == 'students' || $this->ci->session->userdata['permit'] == 'instructors' ){
        	redirect();
        }
	}
}