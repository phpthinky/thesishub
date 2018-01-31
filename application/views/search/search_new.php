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
								<?php 
								if (is_array($start_year)) {
									# code...
									foreach ($start_year as $key) {
										# code...
										echo "<option value='$key->years'>$key->years</option>";
									}
								}

								?>
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
							<div class="col-md-12"><?php echo isset($content) ? $content : "";  ?></div>
							<div class="col-md-10"><?php echo isset($links) ? $links : ""; ?></div>
							<div class="col-md-2"><ul class="pagination"><li><a href="" class="">Records: <?php 
								# code...
							if ($content) {
								# code...
								//echo isset($start) ? ($start+1) : 1; 
								if($total > $limit){
									echo ($limit+$start);
								}else{
									echo $total;
								}
							}else{ echo 0; }

							 ?> of <?php echo isset($total) ? ($total) : 0; ?></a></li></ul></div>
							
						</div>
					</div>
						
					</div>

					</div>
		</div>
	</div>
</div>
		

