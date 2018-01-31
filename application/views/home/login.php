<div class="">
<div class="col-md-4">
	<?php 

        if (!$this->aauth->is_loggedin()){
        	?>
       
<div class="panel login">
	<div class="panel-heading">
				<h2>Login</h2>
				</div>
	<div class="panel-body">
		<form class="form" action="<?=site_url("login");?>" method="post" id="loginform">
			<div class="form-group">
			</div>
			<div class="error"></div>
			<div class="form-group">
				<label for="username">EMAIL</label><input type="text" class="form-control" name="username" id="username" required>
			</div>
			<div class="form-group">
				<label for="password">PASSWORD</label><input type="password" class="form-control" name="password" id="password" required>
			</div>
			<div class="form-group">
			
			</div>

			<div class="form-inline">
				<button class="btn btn-info" type="submit" name="btnlogin" id="btnlogin">&nbsp;LOGIN&nbsp; </button><div class="loader" hidden></div>
			</div>
			
		</form>
	</div>
	<script>
			$(document).on( 'submit', '#loginform', function(e){
				
            var data = $('#loginform').serialize();
			$('.error').html('');


            $('.loader').show();//return false;
            //alert(data); return false;
					$.ajax({
						type: 'post',
						url: '<?=site_url("login");?>',
						data: data,
						success: function(response){
							console.log(response);
							if(response == true){
            					$('.loader').hide();

								$('.error').html('<p class="alert alert-success">Success, Please wait! redirecting..</p>');
								window.location = '<?=site_url();?>';
							}else{
            					$('.loader').hide();
								$('.error').html('<p class="alert alert-danger">'+response+'</p>');
							}


						}
					});
					return false;
				});
		</script>
</div>
</div>
</div>

	<?php  }else{  ?>
	<div class="well well-default">
        <h3>Welcome back</h3><a href="<?=site_url('user');?>" class="btn btn-info">Go to search <i class="fa fa-sign-in"></i></a>
		<?php if($this->aauth->is_admin()){ ?>
        <a href="<?=site_url('dashboard');?>" class="btn btn-warning">Go to panel <i class="fa fa-sign-in"></i></a>
		<?php }?>
	</div>


        <?php
	}

	?>
</div>