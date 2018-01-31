<div class="container">
	
	<h3>User area</h3>
	<div class="col-md-9">
		<div class="col-md-12 user-latest-post"><h4>Latest file uploaded</h4>

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
						<?php echo '<div class="col-md-3 box">
						<a href="'.site_url("read/").$key->years.'/'.$key->slug.'">
						<div class="box-content">'.$key->title.'</div>
						<div class="box-type">Read more...</div>
						</a>
						</div>'; ?>
					

					<?php endforeach ?>
				<?php endif ?>
			<?php endif ?>
		</div>
	</div>
	<div class="col-md-3"><div class="col-md-12 hidden"><h4>Announcement</h4></div></div>
</div>