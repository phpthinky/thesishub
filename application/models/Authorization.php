<?php 
/**
* 
*/
class Authorization extends CI_Model
{
	

	public function authorized()
	{
		# code...
		$this->load->library('session');
		if($this->session->userdata('logged_in')){
			return true;
		}else{
			return false;
		}
	}
	public function isAuthorized()
	{
		# code...
		if($this->authorized == false){
			redirect('user');
		}
	}
}