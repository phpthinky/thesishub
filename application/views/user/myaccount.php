<div class="container">
	<div class="panel">
	<div class="heading">
	<div class="col-md-12">
		
		<h3>My account security</h3>
	</div>
	</div>
	<div class="panel-body">
		<div class="col-md-12">
		<div class="col-md-12">
			<?php echo $this->input->get('stats'); ?>
		</div>
		<div class="col-md-4">
			
			<form class="form" name="frmsecurity" method="post" action="">

			<div class="form-group">
				<label>Password</label>	<input type="password" class='form-control' name="password" id="password" />
			</div>
			<div class="form-group">
				<label>Re-Password</label>	<input type="password" class='form-control' name="repassword" id="repassword" />
			</div>

			<div class="form-group">
				<label></label>	<button type="submit" class="btn btn-default">Submit</button>
			</div>
			 </form>

		</div>
		</div>
	</div>
	</div>
</div>