<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
    class Template 
    {
        var $ci;
        var $template;
         
        function __construct() 
        {
            $this->ci =& get_instance();
			$this->template = $this->ci->config->item('template');
	        $this->ci->load->database();
        }
        function load($tpl_view=false, $body_view = null, $data = null) 
			{
				if ($tpl_view <> 'admin') {
					# code...

					$active_tpl = $this->active_tpl();
					if ($active_tpl) {
					# code...
					$tpl_view = $active_tpl;
					}
				}
				





				if ($tpl_view == false) {
					# code...
					$tpl_view = $this->template;
				}
				
				//exit();
				$dir = explode('/', $body_view); // check if the body views is inside the subfolder
				$dir_total = count($dir);

		    if ( ! is_null( $body_view ) ) 
		    {
		        if ( file_exists( APPPATH.'views/'.$tpl_view.'/'.$body_view ) ) 
		        {
		            $body_view_path = $tpl_view.'/'.$body_view;
		        }
		        else if ( file_exists( APPPATH.'views/'.$tpl_view.'/'.$body_view.'.php' ) ) 
		        {
		            $body_view_path = $tpl_view.'/'.$body_view.'.php';
		        }
		        else if ( file_exists( APPPATH.'views/'.$body_view ) ) 
		        {
		            $body_view_path = $body_view;
		        }
		        else if ( file_exists( APPPATH.'views/'.$body_view.'.php' ) ) 
		        {
		            $body_view_path = $body_view.'.php';
		        }
		        else if($dir_total > 1) {
					# code...
					$i = 1;
					$folder = '';
					foreach ($dir as $key) {
						# code...
						if ($i<$dir_total) {
									# code...
							$folder .=$key.'/';
								}else{
							$view = $key;
								}
						$i++;		
					}

		            $body_view_path = $folder.$view.'.php';

		        }
		        else

		        {
		        	
		            show_error('Unable to load the requested file: ' . $tpl_name.'/'.$view_name.'.php');
		        }
		         
		        $body = $this->ci->load->view($body_view_path, $data, TRUE);
		         
		        if ( is_null($data) ) 
		        {
		            $data = array('body' => $body);
		        }
		        else if ( is_array($data) )
		        {
		            $data['body'] = $body;
		        }
		        else if ( is_object($data) )
		        {
		            $data->body = $body;
		        }
		    }
     
		    $this->ci->load->view('templates/'.$tpl_view, $data);
			}

			public function active_tpl($tpl=false)
			{
				# code...
				if ($tpl == false) {
					# code...
					$this->ci->db->select('name,status')->from('col_template')->where('name <>  "admin" and status = 1')->limit(1);
					$result = $this->ci->db->get()->result();

					if ($tpl != $result[0]->name) {

						return $result[0]->name;
					}else{
						return false;
					}

				}

			}
    }
