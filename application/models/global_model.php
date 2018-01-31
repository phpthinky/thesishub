<?php 

/**
* 
*/

function admin_url($url=''){
    $admin_url = 'http://roy-dell/';
    return $admin_url.$url;
}
class Global_model extends CI_Model
{
	
	function __construct()
	{
		# code...
		parent::__construct();
		$this->load->library('Aauth');
		$this->load->library('minify');
		$this->load->library('session');
		$this->load->library('pagination');

                    // integrate bootstrap pagination
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        //$config['use_page_numbers'] = TRUE;
        $config['display_pages'] = FALSE;
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '<< PREV';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = 'NEXT >>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
			
            $this->pagination->initialize($config);
	}
	public function index()
	{
		# code...
		//$this->load->library('Aauth');

	}
    public function limitext($string='')
    {
        # code...
                // strip tags to avoid breaking any html
        $string = strip_tags($string);

        if (strlen($string) > 300) {

            // truncate string
            $stringCut = substr($string, 0, 300);

            // make sure it ends in a word so assassinate doesn't become ass...
            $string = substr($stringCut, 0, strrpos($stringCut, ' ')).'...'; 
        }
        return $string;
    }

    public function activity($value='')
    {
        # code...
        
    }    public function headerfooter($value='')
    {
        # code...
        $header = 'Thesis Hub';
        $footer_copy = 'BISU BILAR 2017 - '.date('Y');
        $footer_dev = 'Harold Rita';
        $footer_dev_link = '//coloftech.com';
        return "<footer class='container'><span class='col-md-6 push-left'>Copyright &copy; $footer_copy</span><span class='col-md-6 push-right' style='text-align:right'><span>Developer &copy; <a href='$footer_dev_link' title='visit our website'>$footer_dev</a></span></span></footer>"; 
    }
    public function footer()
    {
        # code...
        $this->load->model('setting_m');
        if($footer = $this->setting_m->get_active_setting(3)){
            return $footer[0]->setting_value;
        }
        return false;

    }
    public function getAddress() {
    $protocol = $_SERVER['HTTPS'] == 'on' ? 'https' : 'http';
    return $protocol.'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
}
}