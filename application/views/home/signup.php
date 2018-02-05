<div class="container">
<div class="col-md-4">
	<?php 

        if (!$this->aauth->is_loggedin()){
        	?>
       
<div class="panel login">
	<div class="panel-heading"><h2></h2></div>
	<div class="panel-body">
		<form class="form" action="<?=site_url("signup");?>" method="post" id="loginform">
			<div class="error"></div>
			<div class="form-group">
				<label for="username">EMAIL</label><input type="text" class="form-control" name="s_email" id="s_email" style='width:84%;'autocomplete='nope' required>
			</div>
			<div class="form-group">
				<label for="username">USERNAME</label><input type="text" class="form-control" name="s_username" id="s_username" style='width:84%;'autocomplete='nope' required>
			</div>
				
			<div class="form-group">
				<!-- <label for="password1">PASSWORD</label><input type="password" class="form-control" name="fs_password" id="fs_password" autocomplete='false' required> -->
				<label for="password1" style="width:100%;display:inline-block">PASSWORD</label><input type="password" class="form-control" style='width:84%;display:inline-block'name="s_password" id="s_password" autocomplete='false' required><i class='btn fa fa-eye btn-eye' style='display:inline-block'></i>
			</div>
			<div class="form-group repass">
				<label for="password">RE-PASSWORD</label><input type="password" class="form-control"style='width:84%;display:inline-block' name="s_repassword" id="s_repassword" autocomplete='new-password' required>
			</div>
			<div class="form-group">
			
			</div>

			<div class="form-inline">
				<button class="btn btn-info" type="submit" name="btnlogin" id="btnlogin">&nbsp;SUBMIT&nbsp; </button><div class="loader" hidden></div>
			</div>
			
		</form>
	</div>
	<script>
		var eye = false;
			$(document).on( 'submit', '#loginform', function(e){
				
			var p  =  $('#s_password').val();
			var rp  =  $('#s_repassword').val();
			console.log(p);
			return true;
				});

			$('.btn-eye').on('click',function(){
				if(eye == false){
					eye = true;
					$('.btn-eye').removeClass('fa-eye');
					$('.btn-eye').addClass('fa-eye-slash');
					$('.repass').hide('fast');
					$('#s_password').attr('type','text');
					$('#s_repassword').val($('#s_password').val());
				}else{

					$('.btn-eye').addClass('fa-eye');
					$('.btn-eye').removeClass('fa-eye-slash');
					$('#s_password').attr('type','password');
					eye = false;
					$('.repass').show('fast');
				}
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