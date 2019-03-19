<div class="col-md-12">
	<?php 

        if (!$this->aauth->is_loggedin()){
        	?>
       
<div class="panel login">
	<div class="panel-heading"><h2></h2></div>
	<div class="panel-body">
		<form class="form" action="<?=site_url("login2");?>" method="post" id="loginform">
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
				<label for="E-mail: ">Solve &nbsp;</label><input type="number" class="form-control" id="num1" name="num1" value="<?=rand(10,100);?>" style="max-width:100px;"	disabled	required> + <input type="number" class="form-control" id="num2" name="num2" value="<?=rand(10,100);?>" style="max-width:100px;"	disabled required> = <input type="number" class="form-control" id="utot" name="utot" style="max-width:100px;"	 required>
			</div><br>
			<div class="form-inline">
				<button class="btn btn-info" type="submit" name="btnlogin" id="btnlogin">&nbsp;LOGIN&nbsp; </button><div class="loader" hidden></div>
			</div>
			<div class="form-inline"><p><br><a href="<?=site_url('signup');?>" class='btn btn-default'>Register</a></p></div>
		</form>
	</div>
	<script>
			$(document).on( 'submit', '#loginform', function(e){

            //var user = $("#username").val();
            //var pass = $("#password").val();
            var data = $('#loginform').serialize();
			$('.error').html('');

		var num1 = parseInt($('#num1').val());
		var num2 = parseInt($('#num2').val());
		var utot = parseInt($('#utot').val());
		var tot = (num1+num2);
		//alert(tot);return false;
		if(utot !== tot ){
			$('.error').html('<label for="error">Solve the math first.</label>');
			$('#utot').focus();
			return false;
		}


            $('.loader').show();//return false;
            //alert(data); return false;
					$.ajax({
						type: 'post',
						url: '<?=site_url("login");?>',
						data: data,
						success: function(response){
							console.log(response);
							if(response === 'loggedIn'){
            					$('.loader').hide();//return false;
								window.location = '<?=site_url("thesis");?>';
							}else{
            					$('.loader').hide();//return false;

							//var response = response.split('-').join(' ');
								$('.error').html('<p class="alert alert-danger">'+response+'</p>');
							}


						}
					});
					return false;
				});
		</script>
</div>
</div>


	<?php  }else{  ?>
	<div class="well well-default">
        <h3>Welcome back <?=$username;?></h3><a href="<?=site_url('search');?>" class="btn btn-info">Go to search <i class="fa fa-sign-in"></i></a>
		<?php if($this->aauth->is_admin()){ ?>
        <a href="<?=site_url('dashboard');?>" class="btn btn-warning">Go to panel <i class="fa fa-sign-in"></i></a>
		<?php }?>
	</div>


        <?php
	}

	?>
</div>