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
?>
<!DOCTYPE html>
<html>
 
    <head>
        <title>COLOFTECH | <?php echo $heading; ?></title>
        <link rel="shortcut icon" href="<?=base_url(); ?>public/images/logo-only-icon.png"/>
        <link rel="stylesheet" type="text/css" href="<?=base_url(); ?>public/assets/bootstrap/css/bootstrap.min.css">        
        <link href="<?=base_url(); ?>public/assets/css/animate.css" rel="stylesheet">
            <link href="<?=base_url(); ?>assets/styles.min.css" rel="stylesheet" type="text/css" />
        <!-- CORE PLUGINS -->
        <script src="<?=base_url(); ?>public/assets/js/jquery-1.11.0.min.js" type="text/javascript"></script>
        <script src="<?=base_url(); ?>public/assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?=base_url(); ?>public/assets/js/jquery-migrate.min.js" type="text/javascript"></script>
       
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
                      <a href="#" class="navbar-brand"><a href="<?=base_url(); ?>index.php"><img src="<?=base_url(); ?>public/images/logo-line-sss.png"></a></a>
                  <form class="navbar-form " action="<?=base_url(); ?>index.php/search" method="get">
                          <div class="input-group">
                              <input type="text" class="form-control" placeholder="Search" name="q">
                              <span class="input-group-btn">
                                  <button type="submit" class="btn btn-default" ><span class="glyphicon glyphicon-search"></span></button>
                              </span>
                          </div>
                      </form>
                  </div>
                  <!-- Collection of nav links, forms, and other content for toggling -->
                  <div id="navbarCollapse" class="collapse navbar-collapse">
                      
                      <ul class="nav navbar-nav navbar-right">

                          <li class=""><a href="<?=base_url(); ?>index.php"><i class="fa fa-university"></i> Home</a></li>
                          
                          
                            <li><a href='<?=base_url(); ?>index.php/h/about'><i class="fa fa-power-off"></i> <span>About</span></a></li>
                            <li><a href='<?=base_url(); ?>index.php/blog'><i class="fa fa-power-off"></i> <span>Blog</span></a></li>
                            <li><a href='<?=base_url(); ?>index.php/project'><i class="fa fa-power-off"></i> <span>Project</span></a></li>
                            <li><a href='<?=base_url(); ?>index.php/login'><i class="fa fa-power-off"></i> <span>Login</span></a></li>
                                                  </ul>
                  </div>
              </nav>

        </div>              
      </div>
      <div class="row">
          
      </div>
    </div> <!-- div row -->        </div>
     </div>
        <div class="wrapper">
             <div class="container">
             <div class="row">
                         <div class="col-md-12">
                           
            <h1><?php echo $heading; ?></h1>
            <?php echo $message; ?>
                         </div>
            </div>
             </div>
             
        </div>
         
        <!-- niceDIT! text area html editor -->
        <script type="text/javascript" src="<?=base_url(); ?>public/assets/nicEdit.js"></script>
    </body>
     
</html>