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
		case 'sents':
			# code...
		?>
		
<div class="wrapper">
	<div class="container">
		<div class="row">
			<div class="panel">
				<div class="panel-heading"><h3>My Sent</h3></div>
				<div class="panel-body">
					<div class="col-md-3 inbox-left"><h4>Receiver</h4></div>
					<div class="col-md-7 inbox-content"><h4>Message</h4><div id="view-message">Click sender to read message</div></div>
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

