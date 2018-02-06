<div class="row" id="other-info" style="display:none;">
			<div class="col-md-12">
			<div class="panel">
				<div class="panel-body">
				<div class="col-md-12">
				<label>Other information</label>
				<select class="form-control" id="select-other-info">
					<option value="0">--- SELECT HERE ---</option>
					<option value="1">Books</option>
					<option value="2">Journal</option>
					<option value="3">Newspaper</option>
					<option value="4">Report</option>
					<option value="5">Research</option>
					<option value="6">Undergraduate Thesis</option>
				</select>
					<br />
				</div>



			<div class="row other-option" id="option-1" style="display:none;">
				<div class="col-md-12">					
				Books
				</div>
			</div>

			<div class="row other-option" id="option-2" style="display:none;">
				<div class="col-md-12">
				Journal					
				</div>
			</div>
			<div class="row other-option" id="option-3" style="display:none;">
				<div class="col-md-12">					
				Newspaper
				</div>
			</div>

			<div class="row other-option" id="option-4" style="display:none;">
				<div class="col-md-12">
				Report					
				</div>
			</div>

			<div class="row other-option" id="option-5" style="display:none;">
				<div class="col-md-12">					
				Research
				</div>
			</div>

			<?php 
				include 'thesis.php';
			?>

			<div class="row other-option option-client" id="option-client" style="display:none;">
				<div class="col-md-12">	
					<?php 
						include 'client_n_location.php';
					?>
				</div>
			</div>
       	</div>
			<div class="row buttons">
					
			<div class="form-inline">
					<div class="col-md-12"><label for="Title"></label>
					<button type="submit" class="btn btn-info btn-submit" id="btn-submit">Save</button> &nbsp;
					<button type="button" class="btn btn-default" onclick="skipall()">Skip</button>
					<p>Note: You can use "SKIP" button to skip this step and return to the first form.</p>
					</div>
				
			</div>
			</div>
				</div>
			</div>
</div>

