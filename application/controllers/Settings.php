<?php 

/**
* 
*/
class Settings extends CI_Controller
{
	
	function __construct()
	{
		# code...
		parent::__construct();
	}
	public function index($value='')
	{
		# code...
		$data['title'] = 'Site settings';
		$data['subtitle'] = 'Site settings';
		$data['content'] = '
		<div class="welcome col-sm-12 col-md-12 col-lg-12"><div class="well well-info"><a href="#" onClick="showinfo(\'welcome\');">Welcome</a></div></div>
		<div class="about col-sm-12 col-md-12 col-lg-12"><div class="well well-info"><a href="#" onClick="showinfo(\'about\');">About</a></div></div>
		<div class="contact col-sm-12 col-md-12 col-lg-12"><div class="well well-info"><a href="#" onClick="showinfo(\'contact\');">Contact</a></div></div>

		';
		$data['content'] .='<script type="text/javascript">
			function showinfo(i)
			{
				//alert(i);
				$(\'.\'+i).append(\'<br><b>Bold</b>\');
			}
		</script>';
		$this->load->view('admin/default/header',$data);
		$this->load->view('admin/default/sidemenu',$data);
		$this->load->view('admin/contents',$data);
		$this->load->view('admin/default/footer',$data);
	}
	public function welcome($value='')
	{
		# code...
	}
	public function about($value='')
	{
		# code...
	}
	public function contact($value='')
	{
		# code...
	}
	public function permission($value='')
	{
		# code...

		/*$this->aauth->create_perm('admin');
		$this->aauth->create_perm('staff');
		$this->aauth->create_perm('student');*/
	}
	public function allow_group($value='')
	{
		# code...


		$this->aauth->allow_group('hobbits','walk_unseen');
		$this->aauth->allow_group('elves','immortality');
		  
  
$this->aauth->allow_group('hobbits','immortality');
		//$this->aauth->allow_group('default','staff');
	}
	public function create_group($value='')
	{
		# code...

		$a = $this->aauth->create_group('Researcher');
		//print($a);
	}
	public function allow_user($value='')
	{
		# code...
		$a = $this->aauth->allow_user(2,'student');
		var_dump($a);
	}
	public function is_allow($value='')
	{
		# code...
		/*if($a = $this->aauth->is_allowed(2,3)){
			echo "User is allowed";
		}else{
			echo "User is not allowed";
		}

		var_dump($a);

		if($a = $this->aauth->is_group_allowed('student','admin')){
			echo "Public are Student";
		} else {
			echo "Public are NOT Student";
		}
*/
		//var_dump($a);

	}




    function get_user_groups(){
        //print_r( $this->aauth->get_user_groups());

        foreach($this->aauth->get_user_groups() as $a){

            echo $a->id . " " . $a->name . "<br>";
        }
    }













}