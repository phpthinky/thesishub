
	
<div class="col-md-12">
	
<div class="panel login">
	<div class="panel-heading"><h3><?php print(isset($subtitle) ? $subtitle : '');?></h3></div>
	<div class="panel-body">

		<form class="form form-responsive" action="" method="post">
			<div class="msg">
				<label for="E-mail: "></label>
			</div>
			<div class="form-group">
				<label for="E-mail: ">E-mail:</label><input type="email" class="form-control" id="email" name="email" required>
			</div>

			<div class="form-group">
				<label for="E-mail: ">Subject</label><input type="text" class="form-control" id="subject" name="subject" required>
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
	
	$('form').on('submit',function(){
		var num1 = parseInt($('#num1').val());
		var num2 = parseInt($('#num2').val());
		var utot = parseInt($('#utot').val());
		var tot = (num1+num2);
		//alert(tot);return false;
		if(utot !== tot ){
			$('.msg label').html('Solve the math first.');
			$('#utot').focus();
			return false;
		}else{
			alert('Thesis hub','Sending message...');
			//return false;
		}
	});
</script>