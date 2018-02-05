<?php 

/**
* 
*/
class User extends CI_Controller
{
	public $uid;
	function __construct()
	{
		# code...

		parent::__construct();
		$this->init();
	}
	public function init($value='')
	{
		# code...
		$this->uid = $this->session->userdata['id'];
		$this->load->library('aauth');
		$this->load->library('slug');
		$this->load->model('search_model');
		$this->load->model('post_model');
		$this->load->model('user_model');
		$this->load->model('post_m');
		$this->load->model('file_m');
		$this->load->model('group_m');
		if (!$this->aauth->is_loggedin()){
        	redirect();
        }
	}
	public function index($value='')
	{
	    $perm = $this->session->userdata['permit'];
	   
		$latest_file = $this->file_m->latest_file(12,false);

		$data['latest_file']= $latest_file;

		$data['title'] = 'User';
		//
		$this->template->load(false,'user/index.php',$data);
		//
	}
	public function directory()
	{
		# code...
		$limit = 20;
		$start = 0;
		$links = '';

		if ($start > 0) {
			# code...

		$list_life = $this->file_m->get_post_by_user($this->uid,$limit,$start);

		}else{

		$list_life = $this->file_m->get_post_by_user($this->uid,$limit);
		
		}

		$data['list_life']= $list_life;
		$data['links']= $links;

		$data['title'] = 'User - directory';
		//
		$this->template->load(false,'user/directory/index.php',$data);
		//
	}
	public function read($value='')
	{
		# code...


        	$id = $this->uri->segment(3);
        	$info = $this->file_m->get_file_info($id);


        $data['content'] = $info;

		$data['title'] = 'User - read info';
		$this->template->load(false,'user/read.php',$data);
		


	}
	
	public function reader()
	{
	    if($this->input->get()){
    		
            $file = $this->input->get('file');
            $id = $this->input->get('id');
			$file_path = $this->file_m->get_link($file,$id);

            //$file = 'uploads/files/'.$url;
            $mime = mime_content_type($file_path);
			header('Content-Length: '.filesize($file_path)); // provide file size    
			header("Expires: -1");    
			header("Cache-Control: no-store, no-cache, must-revalidate");    
			header("Cache-Control: post-check=0, pre-check=0", false); 
            header("Content-type: $mime");
            //header('Content-Disposition: filename="'.$url.'"'); //tell browser what's the file name
		
            return readfile($file_path);
            
            exit();
            }
            return false;


	}
	
	public function upload($value='')
	{
		# code...

		$data['listgroup'] = $this->group_m->group_type(3);
		$data['category'] = $this->group_m->group_type(2);
		$data['title'] = 'User - upload';
		
		$this->template->load(false,'user/directory/upload',$data);
		
	}
	public function file($q=false,$start=0)
	{
		# code...
		$perm = $this->session->userdata['permit'];


        	$start = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
			$limit = $this->input->post('limit') ? $this->input->post('limit') : 10;
			$segment='-';
		if($this->input->post()){


						$q = $this->input->post('q');

						$q = array_unique(array_filter(explode(' ', $q)));

						$segment = implode('-', $q);




						$list_life = $this->file_m->find($q,false,$limit);







	}else{
		if ($start > 0) {
			# code...

		$list_life = $this->file_m->lisfile(false,$limit,$start);
		}else{

		$list_life = $this->file_m->lisfile(false,$limit,false);
		}


	
	}

			if($segment != '-'){
			            $total_row = $this->file_m->file_total($q);

			}else{
			            $total_row = $this->file_m->file_total(false);

			}


						$config['base_url'] = site_url() . "/user/file/$segment";
			            $config['total_rows']=$total_row;
			            $config['per_page'] = $limit;
				        $config["uri_segment"] = 4;
				        $choice = $config["total_rows"]/$config["per_page"];
				        $config["num_links"] = floor($choice);
             
             
			            $this->pagination->initialize($config);
			                 
			            $links = $this->pagination->create_links();


		$data['list_life']= $list_life;
		$data['links']= $links;


		$data['title'] = 'User - download file';
		
		$this->template->load(false,'user/file.php',$data);
		
	}

	public function viewpdf()
	{
		# code...

		$filename = urldecode($this->uri->segment(3));
		$post_id = $this->uri->segment(4);

		$file_path = $this->file_m->get_link($filename,$post_id,true);
        //echo $filename.$post_id;
		$file_type = $this->file_m->get_type($filename,$post_id,true);
		//echo $file_type;
		//exit();
		
		$stored = $this->file_m->save_download(array('post_id'=>$post_id,'user_id'=>$this->uid));

		
		if ($file_type == 'application/pdf' || $file_type == 'image/jpeg'  || $file_type == 'image/png' || $file_type == 'image/gif' || $file_type == 'image/tiff') {
			# code...
			//if($this->is_connected()){
				
			redirect('user/word/'.'?file='.$filename);
			//}

		}elseif($file_type == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'){
		}else{
			redirect('file/download/'.$filename.'/'.$post_id);
			exit();
		}

		$path = $_SERVER['DOCUMENT_ROOT'].'/';

		$data['mypdf'] = $file_path;
		$data['title'] = 'User - view pdf';
		
		$this->template->load(false,'blank.php',$data);
		
	}
	public function viewer($value='')
	{
		# code...
		$file = $this->input->get('file') ? $this->input->get('file') : 'false';
		$post_id = $this->input->get('file') ? $this->input->get('id') : 0;
		$stored = $this->file_m->save_download(array('post_id'=>$post_id,'user_id'=>$this->uid));
		$url = site_url('user/pdf?file=').$file;
		$data['url'] = $url;
		$data['title'] = 'User - File viewer';
		
		$this->template->load(false,'user/viewer',$data);
		
	}
	public function pdf($value='')
	{
		# code...
		$reader = $this->reader();
	}
	public function word($value='')
	{
	    
		# code...
		$reader = $this->reader();
		exit();
		// $up = urldecode($this->uri->segment(3));
	//	$dir = $this->uri->segment(4);
		// $file = $this->uri->segment(5);

	 //$path = $up.'/'.$dir.'/'.$file;

		$data['myfile'] = $reader;
		$data['title'] = 'User - view pdf';
		
		$this->template->load(false,'word.php',$data);
		
	}
	
	
	function is_connected()
	{
    $connected = @fsockopen("www.google.com", 80); 
                                        //website, port  (try 80 or 443)
    if ($connected){
        $is_conn = true; //action when connected
        fclose($connected);

    }else{
        $is_conn = false; //action in connection failure
    }
    return $is_conn;

	}
	
	public function pdfurl($filename =false,$path = false)
	{
		# code...
		$path ='uploads/files/';
		$file = $path.$this->input->get('file');
		$mime = mime_content_type($file);
		header('Content-Type:'.$mime);
		header('Content-Length: '.filesize($file));
		return file_get_contents($path.$file);
	}
}