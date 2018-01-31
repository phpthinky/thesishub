<!DOCTYPE html>
<html>
<head>
	    <meta charset="utf-8"/>
        <title><?php print(isset($title) ? $title : "THESIS HUB"); ?></title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta http-equiv="refresh" content="3000" >
        <meta content="width=device-width, initial-scale=1" name="viewport"/>
        <meta content="BISU Bilar Resource Portal" name="description"/>
        <meta content="Riziel Mendez" name="author"/>


       <link href="<?=base_url('assets/bootstrap/css/bootstrap.min.css');?>" rel="stylesheet">
        <link href="<?=base_url('assets/bootstrap');?>/css/font-awesome.css" rel="stylesheet">
        <link href="<?=base_url('assets/css/animate.css');?>" rel="stylesheet">
        <link href="<?=base_url('assets/plugin/summernote/summernote.css');?>" rel="stylesheet">
        <link href="<?=base_url('assets/plugin/bootstrap-tagsinput/dist/bootstrap-tagsinput.css');?>" rel="stylesheet">
        
        <link rel="shortcut icon" href="<?=base_url('public/images/favicon.png');?>"/>


            <?php // add css files
        $this->minify->css(array('default.css','admin.2.css','print.css'));
        echo $this->minify->deploy_css(FALSE, 'admin.min.2.css');


    ?>
        
        <!-- CORE PLUGINS -->
        <script src="<?=base_url('assets/js/jquery-1.11.0.min.js');?>" type="text/javascript"></script>
        <script src="<?=base_url('assets/bootstrap/js/bootstrap.min.js');?>" type="text/javascript"></script>
        <script src="<?=base_url('assets/js/jquery-migrate.min.js');?>" type="text/javascript"></script>
        <script src="<?=base_url('assets/js/admin.js');?>" type="text/javascript"></script>
        <script src="<?=base_url('assets/plugin/bootstrap-tagsinput/dist/bootstrap-tagsinput.js');?>" type="text/javascript"></script>
        <script src="<?=base_url('assets/plugin/summernote/summernote.js');?>" type="text/javascript"></script>
            <script type="text/javascript">
                $(function () {
    $('.navbar-toggle').click(function () {
        $('.navbar-nav').toggleClass('slide-in');
        $('.side-body').toggleClass('body-slide-in');
        $('#search').removeClass('in').addClass('collapse').slideUp(200);

        
    });
   
   // Remove menu for searching
   $('#search-trigger').click(function () {
        $('.navbar-nav').removeClass('slide-in');
        $('.side-body').removeClass('body-slide-in');


    });
});
                function callprint() {
                    window.print(this);
                }
                
            </script>
    </head>

</head>
<body>

    <div class="print-header">
        <img src="<?=base_url();?>public/images/logob.png" style="width:80px;height: 80px;margin-right: 20px;">
    BISU Bilar Resource Portal <br />
    Date: <?php echo date('Y/m/d h:m:s');?>
</div>
