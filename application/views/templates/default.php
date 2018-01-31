<!DOCTYPE html>
<html>
<head>
	<title>Thesis Hub <?php echo isset($title) ? ' : '.$title : '' ;?></title>
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta content="width=device-width, initial-scale=1" name="viewport"/>
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

        <link href="<?=base_url('assets/bootstrap/css/bootstrap.min.css');?>" rel="stylesheet">
        <link href="<?=base_url('assets/bootstrap');?>/css/font-awesome.css" rel="stylesheet">
        <link href="<?=base_url('assets/css/animate.css');?>" rel="stylesheet">
        <link href="<?=base_url('assets/plugin/videoplayer/video-js.min.css');?>" rel="stylesheet">
       

        <?php // add css files
        $this->minify->css(array('default.css'));
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
<header class="wrapper" >
	<div class="container" >
		

        <div class="logo"><a href="<?=site_url();?>"><img src="<?=base_url();?>public/images/logob.png"></div></a>
        <div class="title"><a href="<?=site_url();?>"><h1 style="display:inline-block;color:#fff;"><span style='margin-top:-10px;position:absolute;font-size:1em;'>Thesis hub</span></h1></a></div>
	</div>
	<div class="container">
		<?php include VIEWPATH.'common/menu.php';?>
	</div>
</header>

<div class="body">
	<div class="container">

	<?php echo $body; ?>
	</div> <!-- container -->
</div> <!-- body -->
</body>
</html>