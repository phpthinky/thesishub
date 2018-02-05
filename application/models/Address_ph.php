<?php 

/**
* 
*/
class Address_ph extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}
	/*public function get_address($strin='')
	{
		$sql = "SELECT b.brgyCode as bcode , b.brgyDesc as bname, c.citymunDesc as city, p.provDesc as province, r.regDesc as region FROM refbrgy as b LEFT JOIN refcitymun as c ON c.citymunCode = b.citymunCode LEFT JOIN refprovince as p ON p.provCode = c.provCode LEFT JOIN refregion as r ON r.regCode = p.regCode where b.brgyDesc like '%".$strin."%'";
		return $this->db->query($sql)->result();
	}
	*/

	public function get_barangay($strin='')
	{
		//$sql = "SELECT b.brgyCode as bcode , b.brgyDesc as bnameFROM refbrgy as b LEFT JOIN refcitymun as c ON c.citymunCode = b.citymunCode LEFT JOIN refprovince as p ON p.provCode = c.provCode LEFT JOIN refregion as r ON r.regCode = p.regCode where b.brgyDesc like '%".$strin."%'";

		return $this->db->select('*')
				->from('refbrgy')
				->like('brgyDesc',$strin,'both')
				->get()
				->result();
		
	}
}