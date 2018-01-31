<div class="container">
	<div class="panel">
		<div class="heading">
	<h4></h4></div>
		<div class="panel-body">
			<?php if (isset($content)): ?>
				<?php if (is_array($content)): ?>
					<?php foreach ($content as $key): ?>
						<div class="col-md-12">
							<div class="row"><h4><?=$key->title;?></h4></div>
							</div>
							<br / >

							<div class="row">
								<div class="desc" style="margin-left:50px; "> <?php echo ucfirst($key->description);?></div>
							</div>

							<br / >
				<?php if (isset($researcher)): ?>
					<?php if (is_array($researcher)): ?>

						<?php $j = 0 ;foreach ($researcher as $key2): ?>
							<?php if ($j =0): ?>
								
						<label>Researcher(s)</label>
							<?php endif ?>

						<div class="col-md-12">
							<div class="row"><p><?php echo $key2->fullname .' - '. $key2->position ?></p></div>
						</div>
						<?php $j++; endforeach ?>
					<?php endif ?>
				<?php endif ?>
							<br />

							<div class="row">
								<div class="options">
									<?php
									if(!$this->aauth->is_loggedin()  && $key->status != 2){
											echo "<div class='col-md-12'>You  must login to view/download this file.</div>";
										}else{

									if ($key->type == 'image/jpeg'  || 
										$key->type == 'image/png' || 
										$key->type == 'image/gif' || 
										$key->type == 'image/tiff'
										){
											//echo " <a href='".site_url('user/viewpdf')."/$key->nfile/$key->file_id' class='btn btn-info'>View image</a>";
											echo "<div class='col-md-6'><img src='".site_url('reader?file=').$key->nfile."' style='width:100%;' /> <br /><br /><br /></div>";
											
										}

										//*
										if (
										$key->type == 'application/octet-stream' || 
										$key->type == 'video/x-matroska' || 
										$key->type == 'video/mp4'
										){
										
										echo '<video width="540" height="310" controls>
									<source src="'.site_url('reader?file=').$key->nfile.'&id='.$key->file_id.'" type="'.$key->type.'">
									<source src="'.site_url('reader?file=').$key->nfile.'&id='.$key->file_id.'" type="video/ogg" />
									</video>';

										echo "
								<br /><p>Download the video if not playing. it may not be supported yet.</p>";
								
										}/*/

										if (
										$key->type == 'application/octet-stream'|| 
										$key->type == 'video/mp4'
										){
											echo '<video id="my-player" class="video-js" controls preload="auto"  poster=""   data-setup="{}">  <source src="'.site_url('reader?file=').$key->nfile.'&id='.$key->file_id.'" type="'.$key->type.'"></source>  <p class="vjs-no-js">    To view this video please enable JavaScript, and consider upgrading to a    web browser that    <a href="http://videojs.com/html5-video-support/" target="_blank">      supports HTML5 video    </a>  </p></video><br />';
										
										echo "<br /><p>Download the video if not playing. it may not be supported yet.</p>";
										}
										//*/

									echo "<div class='col-md-12'>
									<a href='".site_url('file/download')."/$key->nfile/$key->page_id' class='btn btn-success'><i class='fa fa-download'></i></a>";
									if($key->type == 'application/pdf'){

									echo " <a href='".site_url('viewer?file=')."$key->nfile&id=$key->file_id' class='btn btn-info'>PDF</a>";
									}

									
									
									}

		

									echo " <a href='".site_url('file/save')."/$key->page_id' class='btn btn-default hidden'><i class='fa fa-save'></i></a>
									</div>";
									?>
								</div>
							</div>


						</div>
					<?php endforeach ?>
				<?php endif ?>
			<?php endif ?>
		</div>
	</div>
</div>