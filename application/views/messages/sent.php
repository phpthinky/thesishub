<div>
<?php 
echo "<table class='table'><thead><th>Receiver</th><th>Date</th><th>Message</th></thead>";
foreach ($receiver as $keyr) {
	# code...

	echo "<tr><td><a href=''  data-toggle=\"modal\" data-target=\"#msg".$keyr['pm_id']."\">". $keyr['receiver_user']."</a></td><td>". $keyr['date_sent']."</td><td>". $keyr['message']."</td></tr>";
		echo '<div id="msg'.$keyr['pm_id'].'" class="modal fade" role="dialog">
  	<div class="modal-dialog"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title">'. $keyr['receiver_user'].'</h4></div><div class="modal-body"><p>'.$keyr['message'].'</p></div><div class="modal-footer"><button type="button" class="btn btn-default" data-dismiss="modal">Close</button></div></div></div>
  	</div>';




}

echo "</table>";
?>
</div>