<?php
defined('BASEPATH') OR exit('No direct script access allowed');

 if(!function_exists('site_url'))
 {
  function site_url($url='')
  {
    # code...
    return 'https://www.coloftech.com/comsci/portal/index.php/'.$url;
  }
}
   
 if(!function_exists('base_url')){
  
  function base_url($url='')
  {
    # code...
    return 'https://www.coloftech.com/comsci/portal/'.$url;
  }
} 
?>
<!DOCTYPE html>
<html>
 
    <head>
        <title>Portal | <?php echo $heading; ?></title>
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
         
    </body>
     
</html>