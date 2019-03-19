<div class="col-md-12">
	<?php 

        if (!$this->aauth->is_loggedin()){
        	?>
       
<div class="panel login">
	<div class="panel-heading"><p><?php echo isset($msg) ? $msg : '';?></p></div>
	<div class="panel-body">
		<form class="form" action="<?=site_url("loginIE");?>" method="post" id="loginform">
			<div class="error"></div>
			<div class="form-group">
				<label for="username">EMAIL</label><input type="text" class="form-control" name="username" id="username" required>
			</div>
			<div class="form-group">
				<label for="password">PASSWORD</label><input type="password" class="form-control" name="password" id="password" required>
			</div>
			<div class="form-inline">
				<button class="btn btn-info" type="submit" name="btnlogin" id="btnlogin">&nbsp;LOGIN&nbsp; </button><div class="loader" hidden></div>
			</div>
			<div class="form-inline"><p><br><a href="<?=site_url('register');?>" class='btn btn-default'>Register</a></p></div>
		</form>
	</div>
	
</div>
</div>


	<?php  }else{  ?>
	<div class="well well-default">
        <h3>Welcome back <?=$username;?></h3><a href="<?=site_url('dashboard');?>" class="btn btn-default">Go to dashboard <i class="fa fa-sign-in"></i></a>
		
	</div>

        <?php
	}

	?>
</div>