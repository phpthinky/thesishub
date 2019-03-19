<div class="col-md-12">
	
<div class="panel login">
	<div class="panel-body">

		<form class="form form-responsive" action="" method="post">
			<div class="msg">
				<label for="E-mail: "></label>
			</div>
			<div class="form-group">
				<label for="E-mail: ">Receiver:</label><input type="email" class="form-control" id="email" name="email" value="<?php echo isset($sendto) ? $sendto : ''; ?>" required>
			<div class="search-user hidden"></div>
			<div class="loader hidden">loading...</div>
			</div>


			<div class="form-group">
				<label for="E-mail: ">Message</label><textarea class="form-control" name="message" id="message" rows="5" required></textarea>
			</div>

			<div class="form-inline">
				<label for="E-mail: ">Solve &nbsp;</label><input type="number" class="form-control" id="num1" name="num1" value="<?=rand(10,100);?>" style="max-width:100px;"	disabled	required> + <input type="number" class="form-control" id="num2" name="num2" value="<?=rand(10,100);?>" style="max-width:100px;"	disabled required> = <input type="number" class="form-control" id="utot" name="utot" style="max-width:100px;"	 required>
			</div><br>


			<div class="form-group">
				<label for="E-mail: "></label><button type="submit" class="btn btn-info">Send</button> &nbsp;<button type="submit" class="btn btn-warning">Cancel</button>
			</div>

		</form>
	</div>
</div>

</div>


<script type="text/javascript">
$(document).ready(function(){
	$('#email').on('keyup',function(){
		var user = $('#email').val();

		$.ajax({
			type: 'post',
			data: 'q='+user,
			url: '<?=site_url("u/search_user"); ?>',
			beforeSend: function(){
				$('.loader').removeClass('hidden');
			},
			success: function(resp){
				console.log(resp);
				$('.loader').addClass('hidden');
				$('.search_user').removeClass('hidden');
				$('.search_user').html('<i class="well">'+resp+'</i>');
			}

		});
	});

});

</script>