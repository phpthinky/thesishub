<div class="container">
	
	<h3>Search &amp; Download</h3>
	<div class="col-md-10">
		<div class="panel">
			<div class="panel-body">
				<form class="form" action="" method="post">
					<div class="form-inline">
						<input type="text" name="q" id="q" class="form-control" style="width:95%;" placeholder="Search here.." value="<?=isset($_POST['q']) ? $_POST['q'] : '';?>"><button class="btn btn-default"><i class="fa fa-search"></i></button>
					</div>
				</form>
			</div>
			<div class="panel-body">
				
					<div class="output" onload="call_clear()">
					<div class="panel">
					<div class="panel-body">
						
						<div class="search-result" id="searchresult">
							<div class="col-md-12">
								<style type="text/css">
									.tbl-user .btn{margin:1px;}
								</style>
								<?php 
	if (isset($list_life)) {
	 	# code...
	 	if (is_array($list_life)) {
	 		# code...
	 		echo "<table class='table table-striped tbl-user'>";
	 		echo "<thead>
	 		<tr>
	 		<th>TITLE</th>
	 		<th>DESCRIPTION</th>
	 		<th>TYPE</th>
	 		<th style='max-width:80px;text-align:center;'>ACTION</th>
	 		</tr>
	 		</thead>";
	 		echo "<tbody>";
	 		foreach ($list_life as $key) {
	 			# code...
	 			switch ($key->type) {
	 				case 'application/vnd.openxmlformats-officedocument.wordprocessingml.document':
	 					# code...
	 					$type='Word';
	 					break;
	 				case 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet':
	 					# code...
	 					$type='Spreadsheet';
	 					break;
	 				case 'application/vnd.openxmlformats-officedocument.presentationml.presentation':
	 					# code...
	 					$type='Powerpoint';
	 					break;
	 				case 'application/pdf':
	 					# code...
	 					$type='PDF';
	 					break;
	 					
	 				case 'text/plain':
	 					# code...
	 					$type='Text File';
	 					break;
	 				
	 				case 'image/png':
	 					# code...
	 					$type='Image';
	 					break;
	 				case 'image/jpeg':
	 					# code...
	 					$type='Image';
	 					break;
	 				case 'image/jpg':
	 					# code...
	 					$type='Image';
	 					break;
	 				case 'image/gif':
	 					# code...
	 					$type='Image';
	 					break;
	 				
	 				
	 				default:
	 					$type = 'Unknown type';
	 					break;
	 			}
                $key->description = $key->contents;
	 			echo "<tr>
	 				<td>$key->title</td>
	 				<td>$key->description</td>
	 				<td>$type</td>
	 				<td style='max-width:80px;text-align:right;'><a href='".site_url('file/download')."/$key->nfile/$key->page_id' class='btn btn-success'><i class='fa fa-download'></i></a> <a href='".site_url('user/read')."/$key->file_id' class='btn btn-info'><i class='fa fa-eye'></i></a> <a href='".site_url('file/save')."/$key->page_id' class='btn btn-default hidden'><i class='fa fa-save'></i></a></td>
	 			</tr>"	;

	 		}
	 		echo "</tbody>";
	 		echo "</table>";
	 	}
	 } ?>
	 	
	 </div>
							<div class="col-md-10"><?php echo isset($links) ? $links : "-"; ?></div>
							<div class="col-md-2"><ul class="pagination" style="min-width: 200px;"><li><a href="" class="">Records: <?php 
								# code...
							/*if ($content) {
								# code...
								//echo isset($start) ? ($start+1) : 1; 
								if($total > $limit){
									echo ($limit+$start);
								}else{
									echo $total;
								}
							}else{ echo 0; }

							 ?> of <?php echo isset($total) ? ($total) : 0; */?></a></li></ul></div>
							
						</div>
					</div>
						
					</div>

					</div>
			</div>
		</div>
	</div>
	<div class="col-md-2 hidden">Submenus</div>
</div>