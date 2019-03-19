<div class="wrapper">
	<div class="container u-profile">
		<div class="row">
			
			<div class="col-md-12 search-content">
				<div class="row">
					<div class="col-xs-3">
					<label for="username">Username: &nbsp; </label>					
					</div>
					<div class="col-xs-4"><input type="text" class="form-control" value="<?php echo isset($username) ? $username : null; ?>" disabled>					
					</div>	
					<div class="col-xs-5">
					</div>			
				</div>

				<div class="row">
					<div class="col-xs-3">
					<label for="username">Email: &nbsp; </label>					
					</div>
					<div class="col-xs-4"><input type="text" class="form-control" value="<?php echo isset($email) ? $email : null; ?>" name="email" id="email">					
					</div>	
					<div class="col-xs-5">
					</div>			
				</div>
				<div class="divider-20"></div>

				<div class="row">
					<div class="col-xs-3">
					<label for="username">Student ID: &nbsp; </label>					
					</div>
					<div class="col-xs-4"><input type="text" class="form-control" id="studentId" name="studentId" value="<?php echo isset($stud_id) ? $stud_id : null; ?>"disabled>					
					</div>	
					<div class="col-xs-5">
					</div>			
				</div>
				<div class="row">
					<div class="col-xs-3">
					<label for="username">Expiration: &nbsp; </label>					
					</div>
					<div class="col-xs-4"><input type="text" class="form-control" id="studentIdx" name="studentIdx" value="<?php echo isset($stud_id_ex) ? $stud_id_ex : null; ?>"disabled>					
					</div>	
					<div class="col-xs-5">
					</div>			
				</div>
				<div class="divider-20"></div>
				<div class="row">
					<div class="col-xs-3">
					<label for="username">Firstname: &nbsp; </label>					
					</div>
					<div class="col-xs-4"><input type="text" class="form-control" name="fname" id="fname" value="<?php echo isset($fname) ? $fname : null; ?>">					
					</div>	
					<div class="col-xs-5">
					</div>			
				</div>
				<div class="row">
					<div class="col-xs-3">
					<label for="username">Middlename: &nbsp; </label>					
					</div>
					<div class="col-xs-4"><input type="text" class="form-control"name="mname" id="mname" value="<?php echo isset($mname) ? $mname : null; ?>">					
					</div>	
					<div class="col-xs-5">
					</div>			
				</div>
				<div class="row">
					<div class="col-xs-3">
					<label for="username">Lastname: &nbsp; </label>					
					</div>
					<div class="col-xs-4"><input type="text" class="form-control" name="lname" id="lname" value="<?php echo isset($lname) ? $lname : null; ?>">					
					</div>	
					<div class="col-xs-5">
					</div>			
				</div>
				<div class="row">
					<div class="col-xs-3"><br></div>
					<div class="col-xs-4"></div>
					<div class="col-xs-5"></div>
				</div>
				<div class="row">
					<div class="col-xs-3"></div>
					<div class="col-xs-4"><button class="btn btn-info">Update</button></div>
					<div class="col-xs-5"></div>
				</div>
			</div>
			</div>
		</div>	
	</div>
</div>