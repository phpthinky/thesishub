<?php $action = isset($action) ? $action : 'compose';

	switch ($action) {
		case 'inbox':
			# code...
		?>

<div class="wrapper">
	<div class="container">
		<div class="row">
			<div class="panel">
				<div class="panel-heading"><h3>My Inbox</h3></div>
				<div class="panel-body">
					<div class="col-md-10 inbox-left">
						<table class="table table-bordered">
							<thead>
							<tr><th width="200px;">Sender</th><th>Message</th><th width="150px;">Date sent</th></tr>
							</thead>
							
							<tbody>
							<?php
							//var_dump($this->session->userdata('id'));
							if ($inbox) {
								# code...

							foreach ($inbox as $keyr) {
								# code...
							
								echo "<tr><td><a href='' data-toggle=\"modal\" data-target=\"#msg".$keyr->pm_id."\">". $this->user_model->get_username_by_id($keyr->sender_id)."</a></td><td>". $this->post_model->limitext($keyr->message)."</td><td>". $keyr->date_sent."</td></tr>";
								}
							}else{
								echo "<tr><td></td><td>No message</td></tr>";
							}
							?>
							</tbody>
						</table>
					</div>
					<div class="col-md-2 inbox-right"><h4>Settings</h4></div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php


			break;
		case 'sents':
			# code...
		?>
		

<div class="wrapper">
	<div class="container">
		<div class="row">
			<div class="panel">
				<div class="panel-heading"><h3>My sent item</h3></div>
				<div class="panel-body">
					<div class="col-md-10 inbox-left">
						<table class="table table-bordered">
							<thead><tr><th width="200px;">receiver</th><th>Message</th><th width="150px;">Date sent</th></tr></thead>
							<tbody>
							<?php
							//var_dump($sender);
							if ($sents) {
								# code...

								foreach ($sents as $keyr) {

								echo "<tr><td><a href='' data-toggle=\"modal\" data-target=\"#msg".$keyr->pm_id."\">". $this->user_model->get_username_by_id($keyr->receiver_id)."</a></td><td>". $this->post_model->limitext($keyr->message)."</td><td>". $keyr->date_sent."</td></tr>";
								




								}
							}else{
								echo "<tr><td></td><td>No message</td></tr>";
							}
							?>
							</tbody>
						</table>
					</div>
					<div class="col-md-2 inbox-right"><h4>Settings</h4></div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php

			break;
		case 'drafts':
			# code...
	
		 ?>
		 <div class="wrapper">
			<div class="container">
				<div class="row">
					<div class="panel">
						<div class="panel-heading"><h3>My Sent</h3></div>
						<div class="panel-body">
							<div class="col-md-3 inbox-left"><h4>Sender</h4></div>
							<div class="col-md-7 inbox-content"><h4>Message</h4><div id="view-message">Click sender to read message</div></div>
							<div class="col-md-2 inbox-right"><h4>Settings</h4></div>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php

			break;
		case 'trash':
			# code...

	
		 ?>
		 <div class="wrapper">
			<div class="container">
				<div class="row">
					<div class="panel">
						<div class="panel-heading"><h3>My Sent</h3></div>
						<div class="panel-body">
							<div class="col-md-3 inbox-left"><h4>Sender</h4></div>
							<div class="col-md-7 inbox-content"><h4>Message</h4><div id="view-message">Click sender to read message</div></div>
							<div class="col-md-2 inbox-right"><h4>Settings</h4></div>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php

			break;
		default:
			# code...
		break;
	}
		 ?>

