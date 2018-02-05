
								<style type="text/css">
									.tbl-user .btn{margin:1px;}
									

								</style>
<div class="container">
	
	<h3>Search area</h3>
	<div class="col-md-12">
		<div class="col-md-9">
			
	<div class="form-responsive">
		<form class="form form-horizontal" action="<?=site_url('search');?>" method="GET">
			<div class="form-group">
				<div class="col-md-10">
					<input type="text" name="q" id="q" class='form-control' placeholder='Search here...' value="<?=isset($keys) ? $keys : '';?>"  onfocus="this.select();" onmouseup="return false;"  required/>
				</div>
				<div class="col-md-2">
					<button class="btn btn-info" type="submit"><i class="fa fa-search"></i></button>
				</div>
			</div>
			<div class="form-group">

				<div class="col-md-2">
					<select class="form-control" id="islike" name="islike" style="padding: 1px;">
						<option value="like">Is like</option>
						<option value="equal">Is equal</option>
					</select>
				</div>
				<div class="col-md-6">
					<select class="form-control" name="course" id="course"  style="padding: 1px;">
						<option value="0">All course</option>
						<?php 
						//var_dump($category);
						if (!empty($listgroup)) {
							//var_dump($listgroup);
							if (is_array($listgroup)) {
								foreach ($listgroup as $key) {
									if ($key->id <> 7) {
									?>
									<option value="<?=$key->id;?>"><?=$key->name;?></option>
									<?php
									}
								}
							}
						 } ?>
					</select>
				</div>
				<div class="col-md-2">
					<select class="form-control" name="year" id="year"  style="padding: 1px;">
						<option value="0">All year</option>
					<?php 
					$y = (int)date('Y');
					$l = 10;
					for ($i=$y; $i > ($y-$l)  ; $i--) { 
						# code...

						echo "<option value='$i'>$i</option>";
					}
					 ?>
					</select>
				</div>
				
			</div>
		</form>
			</div>
				<br />

						<div class="search-result" id="searchresult">
							<div class="col-md-12">



<?php 
	if (isset($list_life)) {
	 	# code...

	 	//var_dump($list_life);
	 	if(empty($list_life)){

	 			echo "<div class='col-md-12'>";
	 			echo "<div class='row'>";
	 			echo "<div class='alert alert-warning' style='max-width:90%;'>No result</div></div></div>";
	 	//exit();
	 	}else{
	 	if (is_array($list_life)) {

	 		if($start > 0){
	 			$i = 1 + $start;
	 		}else{
	 			$i=1;
	 		}

	 		foreach ($list_life as $keys) {
	 			foreach ($keys as $key) {
	 			echo "<div class='col-md-12'>";
	 			echo "<div class='row'>
	 				<div class='form-group'>
	 				<label><h4><a href='".site_url('read')."/$key->years/$key->slug'>$i. $key->title</a></h4></label>
	 				<p>";
	 				echo $this->global_model->limitext($key->description);
	 				echo "</p>";
	 				
	 				echo "</p></div></div></div>";
	 			$i++;
	 			}
	 		}
	 	}
	 }
	 } ?>



	 						<div class="col-md-12">

	 						<?=isset($links) ? $links : '';?>
	 						
	 						</div>
							</div>
						</div>
		</div>
		<div class="col-md-3">
			<div class="col-md-12 hidden"><h4>Announcement</h4></div>
			<div class="col-md-12 user-latest-post"><h4>Most downloaded</h4>

			<?php if (isset($recent_downloads)): ?>
				<?php if (is_array($recent_downloads)): ?>
					<?php foreach ($recent_downloads as $key): ?>
						<?php
							$type = 'Read more...';
						?>
						<?php 
						//if($key->nfile){
							
						echo '<div class="col-md-12 box">
						<a href="'.site_url("read/").$key->years.'/'.$key->slug.'">
						<div class="box-content">'.$key->title.'</div>
						<div class="box-type">'.$type.'</div>
						</a> <br />
						</div>'; 
						//}
						?>
					<?php endforeach ?>
				<?php endif ?>
			<?php endif ?>
			</div>		
			<div class="col-md-12 user-latest-post"><br /><br /><h4>Latest uploads</h4>

			<?php if (isset($latest_file)): ?>
				<?php if (is_array($latest_file)): ?>
					<?php foreach ($latest_file as $key): ?>
						<?php
						
						/*
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
	 				
	 				case 'video/mp4':
	 					# code...
	 					$type='Video';
	 					break;
	 				case 'application/octet-stream':
	 					# code...
	 					$type='video';
	 					break;
	 				case 'application/x-rar':
	 					# code...
	 					$type='ZIP/RAR';
	 					break;
	 				case 'application/zip':
	 					# code...
	 					$type='ZIP/RAR';
	 					break;
	 				
	 				
	 				default:
	 					$type = 'Unknown';
	 					break;
	 				}*/
						?>
						<?php 
						//if($key->nfile){
							
						echo '<div class="col-md-12 box">
						<a href="'.site_url("read/").$key->years.'/'.$key->slug.'">
						<div class="box-content">'.$key->title.'</div>
						<div class="box-type">Read more...</div>
						</a> <br />
						</div>'; 
						//}
						?>
					<?php endforeach ?>
				<?php endif ?>
			<?php endif ?>
			</div>
		</div>
	</div>


</div> <!--container -->



<script type="text/javascript">
  
$(document).ready(function() {
    $("input:text").focus(function() { $(this).select(); } );
});
</script>