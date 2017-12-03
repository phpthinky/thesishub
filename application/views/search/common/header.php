<!DOCTYPE html>

<html lang="en" class="no-js">
   
    <head>
        <meta charset="utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport"/>
		<title><?php if(isset($title)){echo $title;}else{ echo "Coloftech";} ?></title>

        <link href="<?=base_url('assets/bootstrap/css/bootstrap.min.css');?>" rel="stylesheet">
        <link href="<?=base_url('assets/bootstrap');?>/css/font-awesome.css" rel="stylesheet">
        <link href="<?=base_url('assets/css/animate.css');?>" rel="stylesheet">

        <?php // add css files
        $this->minify->css(array('search.css'));
        echo $this->minify->deploy_css(FALSE, 'userstyle.min.css');/*
        $this->minify->js(array('helpers.js', 'jqModal.js'));
        echo $this->minify->deploy_js(FALSE, 'custom_js_name.min.js');*/
        ?>


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