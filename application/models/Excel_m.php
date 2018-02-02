<?php
class Excel_m extends CI_Model {

    public function  __construct() {
        parent::__construct();
        
    }
	
public function Add_User($data_user){
$this->db->insert('user', $data_user);
   }
  
	
}
