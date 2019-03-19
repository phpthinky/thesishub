<div class="wrapper">
	<div class="container">
		<div class="col-md-12">
<div class="col-md-9 msg-user-compose">
<center class="center-loader"><div class="big-loader hidden" id="big_loader"></div></center>
<div class="panel">

	<div class="panel-heading">Compose</div>
	<div class="panel-body">
		<form class="form" action="" method="post" name="frmcompose" id="frmcompose" >
			<div class="msg">
				<label for="E-mail: "></label>
			</div>
			<div class="form-group">

				<label for="E-mail: ">Receiver:</label><input type="text" class="form-control" id="email"  name="email" value="<?php echo isset($sendto) ? $sendto : ''; ?>" autocomplete="off" required>
				<div id="searchuser" style="display:none;"></div>
			</div>


			<div class="form-group">
				<label for="E-mail: ">Message</label><textarea class="form-control" name="message" id="message" rows="5" required></textarea>
			</div>

			<div class="form-inline">
				<label for="E-mail: ">Solve &nbsp;</label><input type="number" class="form-control" id="num1" name="num1" value="<?=rand(10,100);?>" style="max-width:100px;"	disabled	required> + <input type="number" class="form-control" id="num2" name="num2" value="<?=rand(10,100);?>" style="max-width:100px;"	disabled required> = <input type="number" class="form-control" id="utot" name="utot" style="max-width:100px;"	 required>
			</div><br>


			<div class="form-group button">
				<label for="E-mail: "></label><button type="submit" class="btn btn-info">Send</button> &nbsp;<button type="submit" class="btn btn-warning">Cancel</button>
			</div>

		</form>
	</div>
</div>
</div>
<div class="col-md-3 msg-user-list">
	<div class="panel">
		<div class="panel-heading">Active user</div>
		<div class="panel-body">
			<ul class="find-userlist">
			<?php
				foreach ($users as $key3) {
					# code...
					if ($key3 != $this->session->userdata('username')) {
						# code...
					echo "<li onClick=\"selectuser('$key3')\" title='Click send message to this user.'>$key3</li>";
					}
				}
							 ?>
				
			</ul>
		</div>
	</div>
</div>


</div>
	</div>	
</div>


<script type="text/javascript">
var sendnow = false;

  $(function(){


  	$('#frmcompose').on('submit',function(){
  		if (sendnow == false) {
  			alert('Warning! Invalid Receiver.');
  			return false;
  		};

  		//var data = $('#frmcompose').serialize();
  		var data = 'email='+$('#email').val()+'&message='+$('#message').val();
  		//alert($('#message').val());
  		//return	 false;


  		$.ajax({
  			type: 'post',
  			url:'<?=site_url("u/send_now"); ?>',
  			data: data,
			beforeSend: function(){
  				$('#big_loader').removeClass('hidden');
  				$('.button').addClass('hidden');
			},
			success: function(resp){
				console.log(resp);
  				$('#big_loader').addClass('hidden');
  				if(resp == 1){
				$('.center-loader').append('<p class="alert alert-info">Message sent. reloading...</p>');
  				setTimeout(function(){
  					window.location = '<?=site_url("u/inbox");?>';
  				},2000);

				return false;
  				}
				$('.center-loader').append('<p class="alert alert-info">'+resp+'</p>');
			}


  		});
  		return false;
  	});
	$('#email').on('keyup',function(){
		var user = $('#email').val();
		if(user.length < 3){
			$('#searchuser').hide(100);

		sendnow = false;
			return false;
		}
		$.ajax({
			type: 'post',
			data: 'q='+user,
			url: '<?=site_url("u/search_user"); ?>',
			beforeSend: function(){
				$('#searchuser').show('<ul class="find-userlist"><li>Loader..</li></ul>');

			},
			success: function(resp){
				console.log(resp);
				$('#searchuser').html('<i>'+resp+'</i>');
			}

		});
	});

	});



function selectuser (user) {

		$('#email').val(user);
		$('#searchuser').html('');
		sendnow = true;
	}

</script>