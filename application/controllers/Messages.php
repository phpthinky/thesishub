<?php 

/**
* 
*/
class Messages extends CI_Controller
{
	public $uid;
	function __construct()
	{
		# code...
		parent::__construct();

		$this->uid = $this->session->userdata('id');

		$this->load->model('user_model');
	}
	public function limitext($string='')
	{
		# code...
		$string = strip_tags($string);

		if (strlen($string) > 50) {

		    // truncate string
		    $stringCut = substr($string, 0, 50);

		    // make sure it ends in a word so assassinate doesn't become ass...
		    $string = substr($stringCut, 0, strrpos($stringCut, ' ')); 
		}
		return $string;
	}
	public function index($value='')
	{
		# code...

		$receive = $this->aauth->list_pms(5,0,$this->uid);
				$i = 0;
				foreach ($receive as $key) {
					# code...
					$obj[] = array('pm_id' => $key->id,'sender_id'=>$key->sender_id,'sender_user'=>$this->user_model->get_username_by_id($key->sender_id),'receiver_id'=>$key->receiver_id,'message'=>$this->limitext($key->message),'date_sent'=>$key->date_sent);
					$i++;
				}

		$data['receiver'] = $obj;
		$data['subtitle']= "Messages ";
		$data['title']= "Messages";
		$data['username']= $this->session->username;


		$this->load->view('admin/default/header',$data);
		$this->load->view('admin/default/sidemenu',$data);
		$this->load->view('messages/inbox',$data);
		$this->load->view('admin/default/footer',$data);
	}
	public function compose($value='')
	{
		# code...

		$sendto = $this->uri->segment(3);

		if(empty($sendto)){
			$sendto = '';
		}
		$data['sendto']= $sendto;
		$data['subtitle']= "Messages Compose";
		$data['title']= "Messages Compose";
		$data['username']= $this->session->username;


		$this->load->view('admin/default/header',$data);
		$this->load->view('admin/default/sidemenu',$data);
		$this->load->view('messages/compose',$data);
		$this->load->view('admin/default/footer',$data);
	}

	public function sent($value='')
	{
		# code...


		$receive = $this->aauth->list_pms(5,0,NULL,$this->uid);
				$i = 0;
				foreach ($receive as $key) {
					# code...
					$obj[] = array('pm_id' => $key->id,'receiver_id'=>$key->receiver_id,'receiver_user'=>$this->user_model->get_username_by_id($key->receiver_id),'message'=>$key->message,'date_sent'=>$key->date_sent);
					$i++;
				}

		$data['receiver'] = $obj;
		$data['subtitle']= "Messages ";
		$data['title']= "Messages";
		$data['username']= $this->session->username;


		$this->load->view('admin/default/header',$data);
		$this->load->view('admin/default/sidemenu',$data);
		$this->load->view('messages/sent',$data);
		$this->load->view('admin/default/footer',$data);
	}
}