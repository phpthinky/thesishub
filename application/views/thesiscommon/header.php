<!DOCTYPE html>

<html lang="en" class="no-js">
   
    <head>
        <meta charset="utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport"/>
        <meta content="image/png"/>
		<title><?php if(isset($title)){echo $title;}else{ echo "Coloftech";} ?></title>

        <link href="<?=base_url('assets/bootstrap/css/bootstrap.min.css');?>" rel="stylesheet">
        <link href="<?=base_url('assets/bootstrap');?>/css/font-awesome.css" rel="stylesheet">
        <link href="<?=base_url('assets/css/animate.css');?>" rel="stylesheet">
        <link rel="shortcut icon" href="<?=base_url();?>public/images/logo-only-icon.png"/>

        <?php // add css files
        $this->minify->css(array('default.css','default/home.css','default/nav.css','default/login.css'));
        echo $this->minify->deploy_css();/*
        $this->minify->js(array('helpers.js', 'jqModal.js'));
        echo $this->minify->deploy_js(FALSE, 'custom_js_name.min.js');*/
        ?>
        <style type="text/css">
        html,body{
            min-width: 300px;
        }
        </style>

        <!--[if IE 8]>
        <style>
            .robot {
                display:none;
            }
        </style>
    <![endif]-->

            <!-- CORE PLUGINS -->
        <script src="<?=base_url('assets/js/jquery-1.11.0.min.js');?>" type="text/javascript"></script>
        <script src="<?=base_url('assets/bootstrap/js/bootstrap.min.js');?>" type="text/javascript"></script>
        <script src="<?=base_url('assets/js/jquery-migrate.min.js');?>" type="text/javascript"></script>


</head>
<body>

<div class="hidden " id="myalert"></div>