<div class="wrapper">
	<div class="container">
		<div class="col-md-12" id="search-content">
			<div class="panel">
				<div class="panel-body">
					<form class="form" method="POST" action="<?=site_url('t/search');?>" id="frmsearch" name="frmsearch">
						<div class="form-inline">
							<input type="text" class="form-control" id="q" name="q" placeholder="Search here..." value="<?php echo isset($tags) ? $tags : '';?>">
							<select class="form-control" id="selectby" name="selectby">
								<option value="0">All</option>
								<option value="1">By Year</option>
								<option value="2">By Abstract</option>
								<option value="3">By Proponent</option>
								<option value="4">By Client</option>
								<option value="5">By Colleges</option>								
								<option value="6">By Department</option>
							</select>
							<button type="submit" class="btn btn-info" name="btnsearch" id="btnsearch"><i class="fa fa-search"></i></button>
						</div>

					</form>
				</div>

			</div>

					<div class="output" onload="call_clear()">
					<div class="panel">
					<div class="panel-body">
						
						<div class="search-result" id="searchresult">
							<?php echo isset($content) ? $content : ""; ?>
							<?php echo isset($links) ? $links : ""; ?>
						</div>
					</div>
						
					</div>

					</div>
		</div>
	</div>
</div>
		

