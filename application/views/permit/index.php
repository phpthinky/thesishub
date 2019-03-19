<div class="wrapper">
	<div class="container">
	<?php if(!$this->aauth->is_allowed($this->uid)){?>
	<div class="well">
		<h5>This panel will only appear if you are not allowed to acces yet. Pls send us private message or call the administrator. Thank you.</h5>
	</div>

	<?php } ?>
		<div class="msg"></div>
<div class="panel">
	<div class="panel-heading">
		
	</div>
	<div class="panel-body">
			<?php
			foreach ($groups as $key) {
				# code...
				if ($key->id > 3) {
					# code...

				$a = $this->accessed_model->if_request_exist($key->id,$this->uid);
				
				if(!$this->accessed_model->is_allowed($key->id,$this->uid)){
					if($a <= 0){
					$button ="<a href='#' class='btn btn-success'  data-toggle=\"modal\" data-target=\"#msg\" onClick='join(".$key->id.",".$this->uid.");'>Join >></a>";
					}else{

						$button ="<a href='#' class='btn btn-warning'>Requested</a>";
					}

					echo "<div class='col-md-4 permit-group'><div class='item'>$key->name <br/>$button</div></div>";
				

				}
				
			
				
				

				}

			}
			?>
	</div>
</div>
	</div>
</div>
	<script type="text/javascript">

		function join(gid,uid) {
			var data = 'group_id='+gid;

			$('#gid').val(gid);
			return false;
            $.ajax({
            	url: '<?=site_url("a/req_access");?>',
            	type: 'post',
            	data: data,
            	dataType: 'json',
				success: function(response){
						console.log(response);


            				if(response.stat == true){

							alert(response.msg);

							var delay = 1000; 
							redirect = '<?=site_url("access");?>';
							setTimeout(function(){ 
								$('#msg').html('<span class="alert alert-success">Request sent. redirecting.</span>');
								window.location = redirect; 
							}, delay);

							return false;

							
							}else{
								
							alert(response.msg);return false;

							}
            	}


            });
			return false;

			
		}


	</script>


<a href='' data-toggle="modal" data-target="#msg">Show modal</a>

	<div id="msg" class="modal fade" role="dialog">
  	<div class="modal-dialog">
  		<div class="modal-content">
  			<div class="modal-header">
  				<button type="button" class="close" data-dismiss="modal">&times;</button>
  				<h4 class="modal-title"></h4>
  			</div>
  		<div class="modal-body">
  		<form class="form">
  			<div class="form-group">
  				<label for'group'>Group id</label><input type="text" id="gid" value="" name="gid">
  			</div>
  		</form>
  		</div>
  		<div class="modal-footer">
  		<a type="button" class="btn btn-default" href="'.site_url('messages/compose/').$keyr['sender_user'].'">Reply</a>
  		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
  		</div>
  		</div>
  	</div>
  	</div>