<!DOCTYPE html>
<html>
<head>
	    <meta charset="utf-8"/>
        <title><?php print(isset($title) ? $title : "THESIS HUB"); ?></title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta http-equiv="refresh" content="3000" >
        <meta content="width=device-width, initial-scale=1" name="viewport"/>
        <meta content="FlameOnePage freebie theme for web startups by FairTech SEO." name="description"/>
        <meta content="FairTech" name="author"/>


       <link href="<?=base_url('assets/bootstrap/css/bootstrap.min.css');?>" rel="stylesheet">
        <link href="<?=base_url('assets/bootstrap');?>/css/font-awesome.css" rel="stylesheet">
        <link href="<?=base_url('assets/css/animate.css');?>" rel="stylesheet">
        <link rel="shortcut icon" href="<?=base_url('public/images/favicon.png');?>"/>


            <?php // add css files
        $this->minify->css(array('default/admin.css',));
        echo $this->minify->deploy_css(FALSE, 'admin.min.css');

        //$this->minify->js(array('helpers.js','admin.js'));
        //echo $this->minify->deploy_js(FALSE, 'admin.min.js');
        //echo $this->minify->deploy_js();

    ?>
        
        <!-- CORE PLUGINS -->
        <script src="<?=base_url('assets/js/jquery-1.11.0.min.js');?>" type="text/javascript"></script>
        <script src="<?=base_url('assets/bootstrap/js/bootstrap.min.js');?>" type="text/javascript"></script>
        <script src="<?=base_url('assets/js/jquery-migrate.min.js');?>" type="text/javascript"></script>
        <script src="<?=base_url('assets/js/admin.js');?>" type="text/javascript"></script>
            <!-- niceDIT! text area html editor -->
            <script type="text/javascript" src="<?=base_url('assets/nicEdit.js');?>"></script>
    </head>

</head>
<body>