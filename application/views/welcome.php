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
        $this->minify->css(array('default/home.css','default/nav.css','default/login.css'));
        echo $this->minify->deploy_css();/*
        $this->minify->js(array('helpers.js', 'jqModal.js'));
        echo $this->minify->deploy_js(FALSE, 'custom_js_name.min.js');*/
        ?>
        <!-- CORE PLUGINS -->
        <script src="<?=base_url('assets/js/jquery-1.11.0.min.js');?>" type="text/javascript"></script>
        <script src="<?=base_url('assets/bootstrap/js/bootstrap.min.js');?>" type="text/javascript"></script>
        <script src="<?=base_url('assets/js/jquery-migrate.min.js');?>" type="text/javascript"></script>

</head>
<body>
<div class="container welcome">
<div class="col-md-6 col-lg-6 welcome-robo">
	
	<div class="row">

	<div class="robot">
		
		<img src="<?=base_url('/public/images/robo2.png');?>">
	</div>
	</div>
</div>
<div class="col-md-6 welcome-content">
	<div class="header">
	<div class="col-md-6">
		<a href=""><img src="<?=base_url('/public/images/coloftech.png');?>"></a>
		
	</div>
	<div class="col-md-6">
		<div class="form-search right">
			<form class="form ">
				<div class="form-inline">
					<label for="search"><input type="text" class="form-control input-search " placeholder="Search..."><button class="btn btn-info">Go</button></label>
				</div>
			</form>
		</div>
		
	</div>
	</div>
<div class="col-md-12">
	
<nav class="navbar navbar-default">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
    </div>
    <!-- Collection of nav links and other content for toggling -->
    <div id="navbarCollapse" class="collapse navbar-collapse">
        <ul class="nav navbar-nav navbar-right">
            <li ><a href="#">Home</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Contact</a></li>
        </ul>

    </div>
</nav>
</div>
<div class="col-md-12">
	
<div class="panel login">
	<div class="panel-heading"><h2></h2></div>
	<div class="panel-body">
		<form class="form" action="" method="post" id="loginform">
			<div class="error"></div>
			<div class="form-group">
				<label for="username">USERNAME</label><input type="text" class="form-control" name="username" id="username" required>
			</div>
			<div class="form-group">
				<label for="password">PASSWORD</label><input type="password" class="form-control" name="password" id="password" required>
			</div>
			<div class="form-inline">
				<button class="btn btn-info" type="submit" name="btnlogin" id="btnlogin">LOGIN</button><div class="loader" hidden></div>
			</div>
		</form>
	</div>
	<script>
			$(document).on( 'submit', 'form', function(e){

            //var user = $("#username").val();
            //var pass = $("#password").val();
            var data = $('#loginform').serialize();

            $('.loader').show();//return false;
            //alert(data); return false;
					$.ajax({
						type: 'post',
						url: '<?=site_url("login");?>',
						data: data,
						success: function(response){
							console.log(response);
							if(response === 'loggedIn'){
								window.location = '<?=site_url("home");?>';
							}else{
            					$('.loader').hide();//return false;
								$('.error').html(response);
							}


						}
					});
					return false;
				});
		</script>
</div>
</div>
</div>
</div>
</body>
</html>