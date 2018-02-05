<?php 


defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class Counter extends CI_Controller
{
	
	function __construct()
	{
		# code...
		parent::__construct();
		$this->load->library('minify');
		$this->load->library('session');
		$this->load->library('pagecounter');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('cookie');

		$this->load->model('user_model');
	}
	public function index($value='')
	{
		# code...
		
		$data['title'] = 'Counter';

		$this->load->view('admin/default/header',$data);
		$this->load->view('admin/default/sidemenu',$data);

		$page = '';
		$result =  $this->pagecounter->pagesoncounter($page);
		$html =  '<table class="table table-bordered">
		<tr><th>ID</th><th>URL</th><th>Total visit</th><th>This year<th>This month</th><th>This week</th><th>Today</th></tr>

		';
		$i=0;
		foreach ($result as $key) {
			# code...
			$i++;
			$page = urldecode($key->page);
			$month = $this->pagecounter->visit_thismonth($page);
			$today = $this->pagecounter->visit_today($page);
			$thisweek = $this->pagecounter->visit_thisweek($page);
			$thisyear = $this->pagecounter->visit_thisyear($page);
			$html .= "<tr><td>$i</td><td>$page</td><td>$key->count</td><td>$thisyear</td><td>$month</td><td>$thisweek</td><td>$today</td><tr>";

		}
		$html .= '<table>';
		$data['content'] = $html;
		$this->load->view('admin/contents',$data);
		$this->load->view('admin/default/footer',$data);
	}
	public function add($request='')
	{
		# code...
		$this->load->view('admin/common/header2');
		$sitehost1 = 'www.myapp.ci';
		$sitehost2 = 'myapp.ci';
		/*$url = 'http://www.text.com/index.php/hello/world';
		$new_url = parse_url($url,PHP_URL_PATH);
		echo $new_url;
		$new_url = parse_url($url,PHP_URL_HOST);
		echo $new_url;
		$new_url = parse_url($url,PHP_URL_SCHEME);
		echo $new_url;*/

		if($this->input->post()){
			if($this->input->post('submit')){
				$url = $this->input->post('newurl');
				$scheme_url = parse_url($url,PHP_URL_SCHEME);
				$host_url = parse_url($url,PHP_URL_HOST);
				if(!empty($scheme_url) || !empty($host_url)){


					if($sitehost1 !== $host_url || $sitehost2 !== $host_url){
						echo $path_url = '<p class="alert alert-danger">Invalid url: the url address you trying to add is not allowed. Try again.</p>';
					}else{

					$path_url = parse_url($url,PHP_URL_PATH);
					}

				}else{
				$path_url = $url;
				}
				echo $path_url;

				//echo $this->pagecounter->addpageurl();

				//echo $new_url;

			}
		}
		echo '<div class="panel><div class="panel-heading><h2>Note:The url you encoded here will be added to page your counter</h2></div>
		<div class="panel-body"><form class="form" method="post" action="'.site_url("counter/add").'">
				<div class="form-group">
					<label for="page-url"><input type="text" class="form-control" name="newurl">
				</div>

				<div class="form-group">
					<label for="page-url"><input type="submit" class="btn btn-info" name="submit" id="submit">
				</div>
				</form>
				</div>
				</div>
				';
	}
}