<div>
<?php 
echo "<table class='table'><thead><th>Sender</th><th>Date</th><th>Message</th></thead>";
foreach ($receiver as $keyr) {
	# code...

	echo "<tr><td><a href='' data-toggle=\"modal\" data-target=\"#msg".$keyr['pm_id']."\">". $keyr['sender_user']."</a></td><td>". $keyr['date_sent']."</td><td>". $keyr['message']."</td></tr>";
	echo '<div id="msg'.$keyr['pm_id'].'" class="modal fade" role="dialog">
  	<div class="modal-dialog"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title">'. $keyr['sender_user'].'</h4></div><div class="modal-body"><p>'.$keyr['message'].'</p></div><div class="modal-footer"><a type="button" class="btn btn-default" href="'.site_url('messages/compose/').$keyr['sender_user'].'">Reply</a><button type="button" class="btn btn-default" data-dismiss="modal">Close</button></div></div></div>
  	</div>';




}

echo "</table>";
?>
</div>

<!-- Trigger the modal with a button -->


<!-- Modal -->
