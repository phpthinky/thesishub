<div class='panel'><div class='panel-body'>
		<form class='form' name='frmgroup' id='frmgroup' action='' method='post'>
		<div class='form-group'>
		<label for='groupname'>Group name</label><input type='text' class='form-control' name='groupname' id='groupname'>
		</div>
		<div class='form-group'>
		<label for='groupname'>Group Definition</label><input type='text' class='form-control' name='groupdefinition' id='groupdefinition'>
		</div>
		<div class='form-group'>
		<label for='groupname'>Group Permission</label>
			<select class="form-control" name="selectgroup" id="selectgroup"  style='text-transform:capitalize' >
				<?php 
					foreach ($list_perms as $key) {
						# code...
						
						echo "<option value='$key->id'>$key->name</option>";

						
					}
				?>
			</select> 
		</div>

		<div class='form-group'>
		<label for='groupname'></label><input type='submit' class='btn btn-info' name='submit' id='submit' value='Save'>
		</div>
		</form>
		</div>
</div>