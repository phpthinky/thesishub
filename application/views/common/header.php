<!DOCTYPE html>
<html>
<head>	
<title><?=isset($title) ? $title : 'Thesis Hub';?></title>
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta content="width=device-width, initial-scale=1" name="viewport"/>
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<noscript>
  <meta http-equiv="refresh" content="0;url=noscript.html">
</noscript>
        <link href="<?=base_url('assets/bootstrap/css/bootstrap.min.css');?>" rel="stylesheet">
        <link href="<?=base_url('assets/bootstrap');?>/css/font-awesome.css" rel="stylesheet">
        <link href="<?=base_url('assets/css/animate.css');?>" rel="stylesheet">
    <?php 
    if (isset($home)) {
       # code...
      echo '

        <link href="<?=base_url(\'assets/bootstrap/css/bootstrap.min.css\');?>" rel="stylesheet">
        <link href="<?=base_url(\'assets/bootstrap\');?>/css/font-awesome.css" rel="stylesheet">
        <link href="<?=base_url(\'assets/css/animate.css\');?>" rel="stylesheet">
        ';
     } else{
        # code...
      echo '

        <link href="<?=base_url(\'assets/bootstrap/css/bootstrap.min.css\');?>" rel="stylesheet">
        <link href="<?=base_url(\'assets/bootstrap\');?>/css/font-awesome.css" rel="stylesheet">
        <link href="<?=base_url(\'assets/css/animate.css\');?>" rel="stylesheet">
        <link href="<?=base_url(\'assets/plugin/videoplayer/video-js.min.css\');?>" rel="stylesheet">
        ';
     }

     ?>
       

        <?php // add css files
        $this->minify->css(array('default/home.css'));
        echo $this->minify->deploy_css();
        ?>

    <style type="text/css">
    </style>
        <!-- CORE PLUGINS -->
        <script src="<?=base_url('assets/js/jquery-1.11.0.min.js');?>" type="text/javascript"></script>
        <script src="<?=base_url('assets/bootstrap/js/bootstrap.min.js');?>" type="text/javascript"></script>
        <script src="<?=base_url('assets/js/jquery-migrate.min.js');?>" type="text/javascript"></script>
        <script src="<?=base_url();?>assets/plugin/PDFObject/pdfobject.js"></script>

        <script src="<?=base_url();?>assets/plugin/videoplayer/video.min.js"></script>
        
</head>
<body>


<header class="wrapper">
  <div class="container brand_logo">
    
          <div class="col-md-1">
                
            <img  style='width:50px;height:50px;display:inline-block;margin:10px;' src="<?=base_url();?>public/images/logob.png">
         
          </div>
          <div class="col-md-11">
              <h2 style='color:white'>
                Thesis Hub
                </h2>
              </div>
          </div>

  </div>
  <div class="container brand_menu">
    
            <?php include 'menu.php'; ?>
  </div>
</header>

