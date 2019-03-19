<div class="wrapper">
	<div class="container">
		<div class="col-md-12" id="search-content">
			<div class="panel">
				<div class="panel-body">
					<form class="form" method="post" action="" id="frmsearch" name="frmsearch">
						<div class="form-inline">
							<input type="text" class="form-control" id="txtsearch" name="txtsearch" placeholder="Search here..." value="<?php echo isset($tags) ? $tags : '';?>">
							<select class="form-control" id="selectby" name="selectby">
								<option value="0">All</option>
								<option value="1">By Year</option>
								<option value="2">By Abstract</option>
								<option value="3">By Proponent</option>
								<option value="4">By Client</option>
								<option value="5">By Colleges</option>								
								<option value="6">By Department</option>
							</select>
							<button type="submit" class="btn btn-info" name="btnsearch" id="btnsearch"><i class="fa fa-search"></i></button>
						</div>

					</form>
				</div>

			</div>

					<div class="output" onload="call_clear()">
					<div class="panel">
					<div class="panel-body">
						
						<div class="search-result" id="searchresult">
							<?php echo isset($searchresult) ? $searchresult : ""; ?>
						</div>
					</div>
						
					</div>

					</div>
		</div>
	</div>
</div>
		

<script type="text/javascript">
	
	

	$('#txtsearch').on('keyup',function(){

			var searchh = $('#txtsearch').val();
			var selectby = $('#selectby').val();
			var data = "txtsearch=" + searchh + "&selectby="+selectby;

		if(searchh.length < 2){
			return false;
		}
		call_search(data);
		return false;


	});

	$('#frmsearch').on('submit',function(){

			var searchh = $('#txtsearch').val();
			var selectby = $('#selectby').val();
			var data = "txtsearch=" + searchh + "&selectby="+selectby;

		if(searchh.length < 2){
			return false;
		}
		call_search(data);
		return false;


	});
	function call_search (data) {
		// body...


					$.ajax({
						type: 'post',
						url: '<?=site_url("search/hanapin");?>',
						dataType: 'html',
						data: data,
						success: function(response){
                            console.log(response);
							//alert(response);
							if(response.length <= 0){
							$('.search-result').html("<div class='alert alert-danger'>No result.</div>");
							return false;

							}
							$('.search-result').removeClass('hidden');
							$('.search-result').html(response)



						}
					});

	}
</script>