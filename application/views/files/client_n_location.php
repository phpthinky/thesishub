        	<style type="text/css">
        		#ul-address{
        			display: none;
        			margin: 0;
        			margin-top: -10px;
        			position: absolute;
        		}
        		#ul-address li{
        			background-color: #000;
        			color:#fff;
        			list-style: none;
        			padding:2px;
        			cursor: pointer;
        		}
        		#ul-address li:hover{

        			background-color: dodgerblue;
        			color:#fff;
        		}
        	</style>
        	<div class="row " style="display: block;">
        		<div class="col-md-6">

                                
        			<form class="form form-horizontal">
        				<div class="form-group">
        					<label>Client name</label> <input type="text" class="form-control"  name="client" id="client"  onkeyup="names(this.id);" >
								<ul class="ul-on-input" id="ul-on-input-client"></ul>
        				</div>

        				<div class="form-group">
        					<label>Client address</label> <input type="text"  class="form-control" name="client_address" id="client_address"  onkeyup="get_barangay(this.id)">
        					<ul id="ul-address"></ul>
        				</div>

        				<div class="form-group">
        					<label>Company name</label> <input type="text" class="form-control"  name="client_company" id="client_company" >
        				</div>

        				<div class="form-group">
        					<label></label> <button type="submit" class="btn btn-info">Save</button> <button type="button" class="btn btn-default" onclick="skip_c(this.id)">Skip</button>
        				</div>
        			</form>
        		</div>
        	</div>


<script type="text/javascript">
	function skip_c(id) {
		// body...
		$(".client").hide('fast');
		$(".end").show('slow');

	}
	function get_barangay(id) {
			// body...
			var data = $('#'+id).val();
			$('#ul-address').html('');
			setTimeout(function(){
				call_barangay(data);
			},1000);

	}
	function call_barangay(value) {
		// body...
			var barangay = '<?=site_url('post/showbarangay');?>';
			var	html;
				$.ajax({
				type : 'post',
				dataType: 'json',
				url: barangay,
				data: 'barangay='+value,
				success: function(resp){
					console.log(resp);
					for (var i = resp.length - 1; i >= 0; i--) {
						var add = resp[i].brgyDesc;
						$('#ul-address').append('<li>'+add+'</li>');
					}

					$('#ul-address').show('fast');

				}
			});
	}
	//get_barangay();



</script>