<style type="text/css">
	.form-group{
		margin-bottom: 5px;
	}
	.form-group .form-control{
		margin-bottom: 0px;
	}
</style>
<div class="col-md-12">
	
<div class="panel login">
	<div class="panel-heading"><h2>Register an account</h2></div>
	<div class="panel-body">

<form method='post' action='<?=site_url('validate');?>' class='form' id='registerform'>
		<center><div class="error"></div></center>

			<div class='form-group'>
				<label form='email'>Email: <input type='text' class='form-control' name='email' id='email'></label>
			</div>

			<div class='form-group'>
				<label form='username'>Username: <input type='text' class='form-control' name='username' id='username'></label>
			</div>

			<div class='form-group'>
				<label form='password'>Password: <input type='password' class='form-control' name='password' id='password'></label>
			</div>

			<div class='form-group'>
				<label form='email'>Re-type Password: <input type='password' class='form-control' name='cpassword' id='cpassword'></label>
			</div>

			<div class='form-group'>
				<label form='course'>Select Course:</label>
				<select class="form-control" name="group" id="group">
					<option value="0">Select here</option>
				<?php 
					
				foreach ($listgroup as $key) {
					# code...
					if($key->id > 3){
					echo "<option value='$key->id'>$key->name</option>";

					}
				}
				?>
				</select>
			</div>

			<div class='form-group'>
				<label form='email'><input type='submit' class='btn btn-info' name='submit' id='submit'></label><div class='loader' hidden></div>
			</div>



		</form>
	</div>
	<script>
			$(document).on( 'submit', '#registerform', function(e){

            //var user = $("#username").val();
            //var pass = $("#password").val();
            var data = $('#registerform').serialize();
			$('.error').html('');

            $('.loader').show();//return false;
            //alert(data); return false;
					$.ajax({
						type: 'post',
						url: '<?=site_url("signup");?>',
						data: data,
						success: function(response){
							console.log(response);
            				//$('.loader').hide();//return false;
							//$('.error').html(response);

							if(response.length <= 0){
            					$('.loader').hide();//return false;
								window.location = '<?=site_url("search");?>';
							}else{
            					$('.loader').hide();//return false;
								$('.error').html('<div class="alert alert-warning">'+response+'</div>');
								return false;
							}


						}
					});
					return false;
				});
		</script>
</div>
</div>
</div>