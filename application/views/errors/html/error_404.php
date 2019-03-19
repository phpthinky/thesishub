<?php
defined('BASEPATH') OR exit('No direct script access allowed');

 if(!function_exists('site_url'))
 {
	function site_url($url='')
	{
		# code...
		return '//www.thesis.hub:8000/index.php/'.$url;
	}
}
	 
 if(!function_exists('base_url')){
	
	function base_url($url='')
	{
		# code...
		return '//www.thesis.hub:8000/'.$url;
	}
} 
?><!DOCTYPE html>
<!DOCTYPE html>

<html lang="en" class="no-js">
   
    <head>
        <meta charset="utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport"/>
		<title>404 Page Not Found</title>

        <link href="<?=base_url('assets/bootstrap/css/bootstrap.min.css');?>" rel="stylesheet">
        <link href="<?=base_url('assets/bootstrap');?>/css/font-awesome.css" rel="stylesheet">
        <link href="<?=base_url('assets/css/animate.css');?>" rel="stylesheet">
        <link href="<?=base_url();?>assets/userstyle.min.css" rel="stylesheet" type="text/css" />

       

        <!--[if IE 8]>
        <style>
            .pagination{
                display:inline;
            }
            .pagination li{
                list-style: none;
                display:inline;
                padding:5px;
            }
            .pagination li a{
                padding:5px;
            }
        </style>
    <![endif]-->
    <style type="text/css">
    </style>
        <link rel="shortcut icon" href="<?=base_url('public/images/favicon.png');?>"/>
        <!-- CORE PLUGINS -->
        <script src="<?=base_url('assets/js/jquery-1.11.0.min.js');?>" type="text/javascript"></script>
        <script src="<?=base_url('assets/bootstrap/js/bootstrap.min.js');?>" type="text/javascript"></script>
        <script src="<?=base_url('assets/js/jquery-migrate.min.js');?>" type="text/javascript"></script>

</head>
<body>

<div class="wrapper">
  <div class="container">
    <div class="row">

      <div class="col-md-12" id="search-top-menu">
        <div class="bisu-logo">
          <nav class="navbar navbar-inverse">
                  <!-- Brand and toggle get grouped for better mobile display -->
                  <div class="navbar-header">
                      <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                          <span class="sr-only">Toggle navigation</span>
                          <span class="icon-bar"></span>
                          <span class="icon-bar"></span>
                          <span class="icon-bar"></span>
                      </button>
                      <a href="#" class="navbar-brand"><a href="<?=site_url();?>"><img src="<?=base_url('public/images/logo-line-ss.png')?>"></a></a>

                  </div>
                  <!-- Collection of nav links, forms, and other content for toggling -->
                  <div id="navbarCollapse" class="collapse navbar-collapse">
                      

                  </div>
              </nav>

        </div>              
      </div>
      <div class="row">
          
        <div class="col-md-12" id="search-logo" <?php echo isset($ishide) ? $ishide : '';?> >
            <a href="#"><img src="<?=base_url('public/images/thesishub-500x200.png')?>"></a>
          
        </div>
      </div>
    </div> <!-- div row -->
  </div> <!-- div container -->
</div><!-- div wrapper -->
<div class="wrapper">
	<div class="container">
		<div class="col-md-12" id="search-content">
			<div class="panel">
			<div class="panel-heading">
				<h2>
		<?php echo $heading; ?></h2>
			</div>
				<div class="panel-body">
			
		<?php echo $message; ?> <a href="<?=site_url();?>" class="btn btn-info">Go back to site.</a>
      </div>
    </div> <!-- div row -->
  </div> <!-- div container -->
</div><!-- div wrapper -->
</body>
</html>