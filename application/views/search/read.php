<div class="wrapper">
	<div class="container read">
		<div class="row">
			<div class="col-md-9">
				<div class="row">
					<div class="col-md-2"><label>Title</label></div><div class="col-md-10"><span style="font-size:16px;"><?php echo $p_title; ?></span></div>
				</div>
					<br />
					<br />
				<div class="row">
					<div class="col-md-2"><label>Abstract</label></div><div class="col-md-10"><?php echo $p_abstract; ?></div>
					
				</div>
				<div class="row">
					<div class="divider">

					<br />
					<br />
					<br />
					</div>
				</div>
				<div class="row">
					<div class="col-md-2"><label>Researcher</label></div><div class="col-md-10"><?php  echo isset($researcher) ? $researcher : '-' ?></div>
				</div>
				<div class="row">
					<div class="col-md-2"><label>Examining Panel</label></div><div class="col-md-10"><?php  echo isset($panel) ? $panel : '-' ?></div>
				</div>
				<div class="row">
					<div class="col-md-2"><label>Committee</label></div><div class="col-md-10"><?php  echo isset($committee) ? $committee : '-' ?></div>
				</div>
				<div class="row">
					<div class="col-md-2"><label>Year presented</label></div><div class="col-md-10"><div class="col-md-12"><?php  echo isset($year) ? $year : '-' ?></div></div>
				</div>
				<div class="row">
					<div class="col-md-2"><label>Rating</label></div><div class="col-md-10"><div class="col-md-12"><?php  echo isset($rating) ? $rating : '-' ?></div></div>
				</div>

				<div class="row">
					<div class="col-md-2"><label>Views</label></div><div class="col-md-10"><div class="col-md-12"><?php  echo isset($views) ? $views : 0 ?></div></div>
				</div>
			</div>
			<div class="col-md-3">Related link</div>
		</div>
	</div>
</div>