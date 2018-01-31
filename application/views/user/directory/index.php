<div class="container">
	<div class="col-md-12">
	<h3 style="display: inline-block;">My Directory</h3></div>
	<div class="col-md-9">

		<?php if ($this->session->userdata['permit'] == 'instructors' || $this->session->userdata['permit'] == 'staffs' || $this->aauth->is_admin()): ?>
			
		<div class="panel">
			<div class="panel-heading"><h4>My personal files <a href="upload" class="btn btn-default">Upload <i class="fa fa-upload"></i></a></h4></div>
			<div class="panel-body">
				
		<?php 
		if (isset($list_life)) {
			# code...
			if (is_array($list_life)) {
				# code...
				$type = 'Read more...';
				foreach ($list_life as $key) {
					# code...
					?>
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
	 					$type='Video';
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
	 					$type = 'Unknown type';
	 					break;
	 				}
	 				*/
						?>
					<div class="col-md-3 box">
					<a href="<?=site_url("read/").$key->years.'/'.$key->slug;?>">
					<div class="box-content"><?=$key->title;?></div>
					<div class="box-type"><?=$type;?></div>
					</a></div>
					<?php
				}
			}
		}

	?>
			</div>
		</div>

		<?php endif ?>

		<div class="panel hidden">
			<div class="panel-heading"><h4>My save files</h4></div>
			<div class="panel-body">
				
		<?php 
		if (isset($save_list)) {
			# code...
			if (is_array($save_list)) {
				# code...
				foreach ($save_list as $key2) {
					# code...
					?>
					<div class="col-md-3 box"><a href="<?=site_url("read/").$key->page_id;?>"><div class="box-content"><?=$key2->title;?></div></a></div>
					<?php
				}
			}
		}

	?>
			</div>
		</div>
		
	</div>
	<div class="col-md-3 hidden"><h4>History</h4></div>
</div>