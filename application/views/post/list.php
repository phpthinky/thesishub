<div class="col-sm-12 col-md-12 col-lg-12 listall">

	<div class="form-responsive list-search">
		<form class="form form-horizontal">

			<div class="form-inline">
				
				<input type="text" name="q" id="q" class="form-control" style="min-width:40%;" placeholder="Search here..">
			
				<label>Filter &nbsp;</label><select class="form-control" style="min-width:20%;"><option>All thesis</option>
				<?php 
				foreach ($listgroup as $key) {
					# code...
					echo "<option value='$key->id'>$key->name</option>";

				}
			?>
			</select>
				<label>Year &nbsp;</label><select class="form-control"><option>All year</option>
				<?php 
			$currentY = date('Y');
			//echo $currentY;
			for ($i=1950; $i < 2050; $i++) { 
				# code...
				if($i == $currentY){$iscurrent = 'selected';}else{$iscurrent='';}
				echo "<option value='$i' $iscurrent>$i</option>";

			}
			?>
			</select>

				<button type="submit" class="btn btn-info"><i class="fa fa-search"></i></button>
			</div>
		</form>
	</div>
	<div class="result-table">
<br>
<?php echo isset($content) ? $content : ''; ?>
		
	</div>
	<div class="result-link">
<br>
<?php echo isset($links) ? $links : ''; ?></div>
</div>

</div>