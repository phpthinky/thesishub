<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class Home extends CI_Controller
{
	public $uid;
	public $username;
	
	function __construct()
	{
		parent::__construct();
		$this->init();
	}
	public function init($value='')
	{
		# code...
		if ($this->aauth->is_loggedin()){
        	
		$this->uid = $this->session->userdata('id');
		$this->username = $this->session->userdata('username');

        }

		$this->load->model('file_m');
		$this->load->model('group_m');
		$this->load->model('post_m');
        $this->load->library("slug");
        $this->load->model('setting_m');
        $this->load->model('user_model');
	}
	public function index($value='')
	{
		$latest_file = $this->file_m->latest_file(false,6);

		$data['latest_post'] = $latest_file;
		$data['title'] = 'Welcome';
		$data['welcome'] = $this->setting_m->get_all_setting(1);
		$data['guide'] = $this->setting_m->get_all_setting(5);
		$data['username'] = $this->session->username;
		$data['visits'] = $this->pagecounter->visit_total($this->pagecounter->get_pageUrl());
		//$this->load->view('common/header',$data);
		$this->template->load('false','home/home',$data);
		//$this->load->view('common/footer',$data);
	}
	public function signin($value='')
	{
		# code...
		$data['title'] = 'Signin';
		$this->template->load('false','home/login',$data);
	}
	public function signup($value='')
	{
		# code...
		if ($this->input->post()) {
			# code...
			$email = $this->input->post('s_email');
			$password = $this->input->post('s_password');
			$cpassword = $this->input->post('s_repassword');
			$username = $this->input->post('s_username');

				    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {

						exit('Invalid email .');
				    }


			if($this->user_model->email($email) > 0){
				exit('Email is not available.');
			}elseif($password !== $cpassword){
				exit('Password do not much.');
			}else{			
				if(!$a = $this->aauth->create_user($email,$password,$username)){

				    echo  json_encode(array('stats'=>false,'msg'=>$this->aauth->print_errors()));
				    exit();
				}
				$permit = $this->aauth->allow_user($a,2); // 2 researcher and 1 for employee
			
			}
			exit();
		}
		$data['title'] = 'Signup';

		$this->template->load('false','home/signup',$data);

	}
	public function contact($value='')
	{
		# code...

        /*print_r( $this->aauth->list_pms() );
    	exit();

    	*/

		if ($this->input->post()) {
			# code...


			$email = $this->input->post('email');
			$s = $this->input->post('subject');
			$msg = $this->input->post('message');
				$password = time();
				$username = 'Guest'.$password;

			if(isset($_COOKIE['pm'])){
				redirect(site_url('contact?stat=try-again-later'));
			}

			setcookie('pm',$subject, time() + 10000);

			if($this->user_model->email($email) > 0){
				//exit('Email is not available.');
				$id = $this->user_model->get_id_by_email($email);
				//echo $id;
				//exit();
			}else{
				//echo $user;
				$a = $this->aauth->create_user($email,$password,$username);
				$pm = $this->aauth->send_pm($a,1,$s,$msg);
			}

			redirect(site_url('contact?stat=').$pm);

		}
		$data['subtitle'] = 'Contact us';
		$data['title'] = 'Contact';
		$data['visits'] = $this->pagecounter->visit_total($this->pagecounter->get_pageUrl());
		$data['content'] = 'Content display here...';
		$this->template->load('false','home/contactus',$data);

	}
	public function login($value='')
	{
		# code...
		//echo "Login";

		if($this->input->post()){

				$user = $this->input->post('username');
				$password = $this->input->post('password');

				    if(!filter_var($user, FILTER_VALIDATE_EMAIL)) {

				    	$user = $this->user_model->get_email_by_username($user);
				    }


	        if ($this->aauth->login($user, $password)){
	        	echo true;
	        	$id =  $this->user_model->get_id_by_email($user);
	        	$permits = $this->user_model->get_permission($id);
	        	$this->session->userdata['permit'] = $permits;


	        }else{
			$error = $this->aauth->print_errors();
			

			print($error);

	        }

		}else{
			exit('No action received.');
		}

        /*$a = $this->aauth->update_user(1, "rhoy012@gmail.com", "admin123", "admin");
        print_r($a);*/
	}
	public function logout($value='')
	{
		# code...

        $this->aauth->logout();
        redirect('');
	}
	public function signup1($value='')
	{
		# code...

		//$a = $this->aauth->create_user('user2@gmail.com','12345','user2');
		//print($a);

		if ($this->input->post()) {
			# code...
			$email = $this->input->post('email');
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$cpassword = $this->input->post('cpassword');
			$group = $this->input->post('group');

			if($this->user_model->email($email) > 0){
				exit('Email is not available.');
			}elseif($this->user_model->username($username) > 0){
				exit('Username is not available.');
			}elseif($password !== $cpassword){
				exit('Password do not much.');
			}else{			
				$a = $this->aauth->create_user($email,$password,$username);
				$permit = $this->aauth->allow_user($a,2); // 2 researcher and 1 for employee
				$group = $this->aauth->add_member($a,$group);
			}





		}else{

		# code...
			$this->load->model('group_model');
			$type = $this->group_model->group_type(3);
			//var_dump($type);


		//$groups = $this->aauth->list_groups();
		$data['listgroup'] = $type ;
		
		$data['title'] = 'Register';
		$data['visits'] = $this->pagecounter->visit_total($this->pagecounter->get_pageUrl());
		$this->load->view('thesiscommon/header',$data);
		$this->load->view('thesiscommon/menu',$data);
		$this->load->view('register',$data);
		$this->load->view('thesiscommon/footer',$data);

		}




	}


	public function search($q='',$course= 0,$next_page=false)
	{
		# code...
		if($this->input->get('q')){
			$get =(object) $this->input->get();
			$keys = $this->slug->create($get->q);


			
			redirect('search/'.$keys.'/'.$get->course.'/'. $get->year.'?isequal='.$get->islike);
			}

		$q = $this->uri->segment(2) ? $this->uri->segment(2) : '-q-';		
		$course =  $this->uri->segment(3) ?  $this->uri->segment(3) : 0;	
		$year =  $this->uri->segment(4) ?  $this->uri->segment(4) : 0;		
		$start =  $this->uri->segment(5) ?  $this->uri->segment(5) : 0;

		$limit = 10;


		$data['keys'] = str_replace('-', ' ', $q);
		if($q != '-q-'){

			if($this->input->get('isequal') == 'equal'){
				//exit();
					$search = $q;
					$rows = $this->file_m->find_by_title($q);
					$total = count($rows[0]);
					$list_life = $this->file_m->find_by_title($q,$limit,$start,$course,$year);

					$data['links'] = $this->paging($q,$search,$course,$total,$limit,$start,$year);
			}
			elseif((int) $course > 0 && (int)$year > 0){

				if($this->aauth->is_loggedin()){

					$search = $q;
					$q = array_unique(explode('-', $q));
					$rows = $this->file_m->find_by_course($q);
					$total = count($rows[0]);
					$list_life = $this->file_m->find_by_course($q,$limit,$start,$course,$year);

					$data['links'] = $this->paging($q,$search,$course,$total,$limit,$start,$year);


				}else{

					$search = $q;
					$q = array_unique(explode('-', $q));
					$rows = $this->file_m->find_by_course($q);
					$total = count($rows[0]);
					$list_life = $this->file_m->find_by_course($q,$limit,$start,$course,$year);

					$data['links'] = $this->paging($q,$search,$course,$total,$limit,$start,$year);
				}
			}

			elseif((int) $year > 0){

				if($this->aauth->is_loggedin()){

					$search = $q;
					$q = array_unique(explode('-', $q));
					$rows = $this->file_m->find_by_year($q);
					$total = count($rows[0]);
					$list_life = $this->file_m->find_by_year($q,$limit,$start,$year);

					$data['links'] = $this->paging($q,$search,$course,$total,$limit,$start,$year);


				}else{

					$search = $q;
					$q = array_unique(explode('-', $q));
					$rows = $this->file_m->find_by_year($q);
					$total = count($rows[0]);
					$list_life = $this->file_m->find_by_year($q,$limit,$start,$year);

					$data['links'] = $this->paging($q,$search,$course,$total,$limit,$start,$year);
				}
			}
			elseif((int) $course > 0){

				if($this->aauth->is_loggedin()){

					$search = $q;
					$q = array_unique(explode('-', $q));
					$rows = $this->file_m->find_by_course($q);
					$total = count($rows[0]);
					$list_life = $this->file_m->find_by_course($q,$limit,$start,$course);

					$data['links'] = $this->paging($q,$search,$course,$total,$limit,$start);


				}else{

					$search = $q;
					$q = array_unique(explode('-', $q));
					$rows = $this->file_m->find_by_course($q);
					$total = count($rows[0]);
					$list_life = $this->file_m->find_by_course($q,$limit,$start,$course);

					$data['links'] = $this->paging($q,$search,$course,$total,$limit,$start);
				}
			}
			else{
				if($this->aauth->is_loggedin()){

					$search = $q;
					$q = array_unique(explode('-', $q));
					$rows = $this->file_m->find($q);
					$total = count($rows[0]);
					$list_life = $this->file_m->find($q,$limit,$start);

					$data['links'] = $this->paging($q,$search,$course,$total,$limit,$start,$year);


				}else{

					$search = $q;
					$q = array_unique(explode('-', $q));
					$rows = $this->file_m->find($q);
					$total = count($rows[0]);
					$list_life = $this->file_m->find($q,$limit,$start);

					$data['links'] = $this->paging($q,$search,$course,$total,$limit,$start,$year);
				}
			}
		}



		$latest_file = $this->file_m->latest_file(false,6);
        $download = $this->file_m->random_downloaded(6);



		$data['listgroup'] = $this->group_m->group_type(3);
		$data['category'] = $this->group_m->group_type(2);

		$data['recent_downloads']= $download;
		$data['latest_file']= $latest_file;


		$posted_id = array();
		$list_post = false;
		$i = 0;
		if(!empty($list_life)){

			if (is_array($list_life)) {
				# code...		
				foreach ($list_life as $key) {
				
					foreach ($key as $obj) {
						# code...
						if(in_array($obj->page_id,$posted_id)){

						}else{

							$list_post[] = array($obj);
							$posted_id[] = $obj->page_id;

							}
					}
					$i++;
			}
			}
		}



		$data['list_life']= $list_post;

		$data['start']= $start;
		$data['limit']= $limit;

		$data['title'] = 'Search';
		$this->template->load('false','public/index.php',$data);
	}

	public function paging($q='',$search='',$course = 0,$total=0,$limit=0,$start=0,$year=0)
	{
		
						$config['base_url'] = site_url() . "/search/$search/$course/$year";
			            $config['total_rows']=$total;
			            $config['per_page'] = $limit;
				        $config["uri_segment"] = 5;
				        $choice = $config["total_rows"]/$config["per_page"];
				        $config["num_links"] = floor($choice);             
             
			            $this->pagination->initialize($config);
			                 
			            /*$data['links'] =*/ 
			            return $this->pagination->create_links();
	}

	public function read($id=0)
	{
		# code...


        	$slug = $this->uri->segment(3);
        	$info = $this->file_m->get_file_info($slug);

        
        $post_id = $this->post_m->get_id_by_slug($slug);
        $data['files'] = $this->file_m->get_files($post_id);

        $data['researcher'] = $this->post_m->get_experts('researcher',$post_id) ;
        $data['panel'] = $this->post_m->get_experts('panel',$post_id) ;
        $data['committee'] = $this->post_m->get_experts('committee',$post_id) ;
        $data['adviser'] = $this->post_m->get_experts('adviser',$post_id) ;

        $data['content'] = $info;
        //$data['researcher'] = $researcher;

		$data['title'] = 'Read info';

		$this->template->load(false,'user/readinfo.php',$data);



	}

	
	public function reader()
	{
	    if($this->input->get()){
    		
            $file = $this->input->get('file');
            $id = $this->input->get('id');
			$file_path = $this->file_m->get_link($file,$id);
			//echo "$file_path";
			//exit();
            $mime = mime_content_type($file_path);

            if($mime == 'video/mp4' || $mime == 'application/octet-stream'){
            	ob_clean();
				@ini_set('error_reporting', E_ALL & ~ E_NOTICE);
				@apache_setenv('no-gzip', 1);
				@ini_set('zlib.output_compression', 'Off');
				 
				$file = $file_path; // The media file's location
				//$mime = "application/octet-stream"; // The MIME type of the file, this should be replaced with your own.
				$size = filesize($file); // The size of the file
				 
				// Send the content type header
				header('Content-type: ' . $mime);
				 
				// Check if it's a HTTP range request
				if(isset($_SERVER['HTTP_RANGE'])){
				    // Parse the range header to get the byte offset
				    $ranges = array_map(
				        'intval', // Parse the parts into integer
				        explode(
				            '-', // The range separator
				            substr($_SERVER['HTTP_RANGE'], 6) // Skip the `bytes=` part of the header
				        )
				    );
				 
				    // If the last range param is empty, it means the EOF (End of File)
				    if(!$ranges[1]){
				        $ranges[1] = $size - 1;
				    }
				 
				    // Send the appropriate headers
				    header('HTTP/1.1 206 Partial Content');
				    header('Accept-Ranges: bytes');
				    header('Content-Length: ' . ($ranges[1] - $ranges[0])); // The size of the range
				 
				    // Send the ranges we offered
				    header(
				        sprintf(
				            'Content-Range: bytes %d-%d/%d', // The header format
				            $ranges[0], // The start range
				            $ranges[1], // The end range
				            $size // Total size of the file
				        )
				    );
				 
				    // It's time to output the file
				    $f = fopen($file, 'rb'); // Open the file in binary mode
				    $chunkSize = 8192; // The size of each chunk to output
				 
				    // Seek to the requested start range
				    fseek($f, $ranges[0]);
				 
				    // Start outputting the data
				    while(true){
				        // Check if we have outputted all the data requested
				        if(ftell($f) >= $ranges[1]){
				            break;
				        }
				 
				        // Output the data
				        echo fread($f, $chunkSize);
				 
				        // Flush the buffer immediately
				        @ob_flush();
				        flush();
				    }
				}
				else {
				    // It's not a range request, output the file anyway
				    header('Content-Length: ' . $size);
				 
				    // Read the file
				    @readfile($file);
				 
				    // and flush the buffer
				    @ob_flush();
				    flush();
				}
            	exit();
            }
			header('Content-type: ' . $mime);
			header('Content-Length: '.filesize($file_path)); // provide file size   
           	return readfile($file_path);
            
            exit();
            }


	}
	public function viewer($value='')
	{
		# code...
		$file = $this->input->get('file') ? $this->input->get('file') : 'false';
		$post_id = $this->input->get('file') ? $this->input->get('id') : 0;
		$ip = $this->pagecounter->get_ip();
		if($this->uid){

		$stored = $this->file_m->save_download(array('post_id'=>$post_id,'ip_address'=>$ip));

		}else{
		$stored = $this->file_m->save_download(array('post_id'=>$post_id,'ip_address'=>$ip));

		}
		$url = site_url('reader?file=').$file;

		$data['url'] = $url;
		$data['title'] = 'User - File viewer';
		//$this->load->view('common/header',$data);
		$this->template->load('false','user/viewer',$data);
		//$this->load->view('common/footer',$data);
	}

	public function video($video,$mime){
		return '<video
    id="my-player"
    class="video-js"
    controls
    preload="auto"
    poster="//vjs.zencdn.net/v/oceans.png"
    data-setup="{}"">
  <source src="'.$video.'" type="'.$type.'"></source>
  <p class="vjs-no-js">
    To view this video please enable JavaScript, and consider upgrading to a
    web browser that
    <a href="http://videojs.com/html5-video-support/" target="_blank">
      supports HTML5 video
    </a>
  </p>
</video>';

/*
var options = {};

var player = videojs('my-player', options, function onPlayerReady() {
  videojs.log('Your player is ready!');

  // In this context, `this` is the player that was created by Video.js.
  this.play();

  // How about an event listener?
  this.on('ended', function() {
    videojs.log('Awww...over so soon?!');
  });
});

*///optional
	}


public function download($value='')
{
	# code...
		$this->load->helper('download');

		//echo $filename = urldecode($this->uri->segment(3));
		$filename = $this->input->get('file');
		
		//$title = urldecode($this->uri->segment(4));
		$post_id = $this->uri->segment(4);
		if($this->uid){

		$stored = $this->file_m->save_download(array('post_id'=>$post_id,'user_id'=>$this->uid));

	}else{
		$ip = $this->pagecounter->get_ip();
		$stored = $this->file_m->save_download(array('post_id'=>$post_id,'ip_address'=>$ip));

	}

		$file_path = $this->file_m->get_link($filename,$post_id,true);
        //echo $file_path;
		if ($file_path) {
			# code...
		force_download($file_path,NULL);
		}
}







}