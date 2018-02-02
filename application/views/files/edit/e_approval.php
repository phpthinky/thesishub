
			<div class="panel panel-default">
				<div class="panel-heading">
					<label>Committee <a href="javascript:void(0)" class="btn btn-default btn-more" title="Add Add more..." onclick="add_committee('committee')"><i class="fa fa-plus"></i></a></label>
					<div id="msgcommittee" style="display: inline-block;"></div>
				</div>
				<div class="panel-body">
					
					<input type="hidden" name="slug" id="slug">
							<table class="table table-bordered" id="table_researcher">
								<tr>
									<th>#</th>
									<th>NAME</th>
									<th>POSITION</th>
									<th></th>
								</tr>
								<tr>
									<?php 
									if (!empty($committee)) {
										# code...


									foreach ($committee as $key) {
										echo "<input type=\"hidden\" name=\"post_id_auth\" id=\"post_id_auth\" value='$key->post_id'>";

									echo "<tr id='tr_$key->info_id'><td>$key->id <input type='hidden' id='auth_id_$key->id' value='$key->id' /> <input type='hidden' id='role_id_$key->id' value='$key->role_id' /></td>
									<td contenteditable=\"true\" onBlur=\"saveToDatabase(this,'fullname',$key->id,$key->info_id)\">$key->fullname</td>
									<td contenteditable=\"true\" onBlur=\"saveToDatabase(this,'role_name',$key->id,$key->info_id)\">$key->position</td><td width='30px'><button class='btn btn-danger pull-right' type='button' id='$key->info_id' onclick='remove_author(this.id)'><i class='fa fa-remove'></i></button></td></tr>";

									 }

									}


									  ?>
								</tr>
							</table>

				</div>
				<div class="panel-body">

					<form class="form" id="frm_committee" name='frm_committee' action="#../post/save_committee" method="post">
								
					<div class="row hidden"  id="divcommittee">
						<div class="response_committee"></div>
						<input type="hidden" name="post_id" id="post_id_committee" value="<?php echo $this->input->get('id'); ?>">
						<div class="col-md-8">
							
							<label>Name of committee</label><input type="text" class="form-control" name="committee[]" id="committee" placeholder="Type committee full name" onkeyup="names(this.id)" autocomplete="off">
							<ul class="ul-on-input" id="ul-on-input-committee" onmouseleave="hide_selection(this.id)"></ul>
						</div>
						<div class="col-md-4">
							<label>Position / title </label><?php //input type="text" class="form-control" name="committee-position[]" id="committee-position" placeholder="Type committee position or NA" ?>
							<select class="form-control" name="committee-position[]" id="committee-position">
										<option value="0">Select here</option>
										<?php foreach ($position as $key): ?>
											<option value="<?=$key->role_name;?>"><?=$key->role_name;?></option>
										<?php endforeach ?>
									</select>
					
						</div>	
							<div class="col-md-12"><br/></div>
							<div class="col-md-12"><button class="btn btn-success" type="submit" id="btn_committee">Save</button></div>
					</div>

				</form>

				</div>

			</div>

			<div class="panel panel-default">
				<div class="panel-heading">
					<label>Examining Panel <a href="javascript:void(0)" class="btn btn-default btn-more" title="Add Add more..." onclick="add_panel('panel')"><i class="fa fa-plus"></i></a></label>
					<div id="msgpanel" style="display: inline-block;"></div>
				</div>


				<div class="panel-body">
					
					<input type="hidden" name="slug" id="slug">
							<table class="table table-bordered" id="table_researcher">
								<tr>
									<th>#</th>
									<th>NAME</th>
									<th>POSITION</th>
									<th></th>
								</tr>
								<tr>
									<?php 
									if (!empty($panel)) {
										# code...


									foreach ($panel as $key) {
										echo "<input type=\"hidden\" name=\"post_id_auth\" id=\"post_id_auth\" value='$key->post_id'>";

									echo "<tr id='tr_$key->info_id'><td>$key->id <input type='hidden' id='auth_id_$key->id' value='$key->id' /> <input type='hidden' id='role_id_$key->id' value='$key->role_id' /></td>
									<td contenteditable=\"true\" onBlur=\"saveToDatabase(this,'fullname',$key->id,$key->info_id)\">$key->fullname</td>
									<td contenteditable=\"true\" onBlur=\"saveToDatabase(this,'role_name',$key->id,$key->info_id)\">$key->position</td><td width='30px'><button class='btn btn-danger pull-right' type='button' id='$key->info_id' onclick='remove_author(this.id)'><i class='fa fa-remove'></i></button></td></tr>";

									 }

									}


									  ?>
								</tr>
							</table>

				</div>

				<div class="panel-body">

				<form class="form" id="frm_panel" action="../post/save_panel" method="post">
					<div class="row hidden"  id="divpanel">
						<div class="response_panel"></div>
						<input type="hidden" name="post_id" id="post_id_panel" value="<?php echo $this->input->get('id'); ?>">
						<div class="col-md-8">
							
							<label>Name of panel</label><input type="text" class="form-control" name="panel[]" id="panel" placeholder="Type panel full name" onkeyup="names(this.id)" autocomplete="off">
							<ul class="ul-on-input" id="ul-on-input-panel" onmouseleave="hide_selection(this.id)"></ul>
						
						</div>
						<div class="col-md-4">
							
							<label>Position / title </label><?php//input type="text" class="form-control" name="panel-position[]" id="panel-position" placeholder="Type panel position or NA" ?>
							<select class="form-control" name="panel-position[]" id="panel-position">
										<option value="0">Select here</option>
										<?php foreach ($position as $key): ?>
											<option value="<?=$key->role_name;?>"><?=$key->role_name;?></option>
										<?php endforeach ?>
									</select>
					
						</div>
							<div class="col-md-12"><br/></div>
							<div class="col-md-12"><button class="btn btn-success">Save</button></div>
					</div>
				</form>

				</div>

			</div>

			<div class="panel panel-default">
				<div class="panel-body">
					<div class="row">
						
					<div class="col-md-6">
							
						<div class="form-group">
						<label>Adviser</label>
						<?php $adv = '';
							$role_id = 0;
							$info_id = 0;
							$name_id = 0;
						?>
						<?php foreach ($adviser as $key): ?>
							<?php $adv = ($adviser) ? $key->fullname : ''; ?>

							<?php 
								$name_id = isset($key->id) ? $key->id : 0;
								$role_id = isset($key->role_id) ? $key->role_id : 0;
								$info_id = isset($key->info_id) ? $key->info_id : 0;
							 ?>
						
						<?php endforeach ?>




							<input type="hidden" name="col" id="adviser_col" value="adviser">
							<input type="hidden" name="name_id" id="adviser_name_id" value="<?=$name_id;?>">
						<input type="hidden" name="post_id" id="post_id_adviser" value="<?php echo $this->input->get('id'); ?>">

							<input type="text" class="form-control" name="adviser" id="adviser" placeholder='Type daviser here...' autocomplete="off" value="<?=$adv;?>" onBLur="saveAdviser(this,'adviser',<?=$name_id;?>,<?=$info_id;?>)">
						</div>
					</div>

						
					<div class="col-md-6">
							
						<div class="form-group">
						<label>Rating</label>
						<input type="hidden" name="post_id" id="post_id_rating" value="<?php echo $this->input->get('id'); ?>">
							<input type="number" max="3" step="0.01"   class="form-control" name="rating" id="rating" placeholder='Type rating here...' onBLur="saveRating(this,'rating')" value="<?=$infos[0]->rating;?>" >
						</div>
					</div>
					</div>
				</div>
			</div>


<script type="text/javascript">

	function saveAdviser(editableObj,column,name_id,info_id) {

	var post_id = $('#post_id_adviser').val();
	var name = $('#adviser_name_id').val();


	$(editableObj).css("background","#FFF url(../../public/images/loading.gif) no-repeat right");
	$(editableObj).css("background-size","15px");

	var data = 'column= '+column+'&adviser='+$(editableObj).val()+'&post_id='+post_id+'&name_id='+name+'&info_id='+info_id;

	//console.log(data);
	//return false;
	$.ajax({
		url: "../post/edit_adviser",
		type: "POST",
		data: data,
		dataType: 'json',
		success: function(data){
			console.clear()
						console.log(data);
			if (data.stats = true) {
				//if(data.col == 'adviser'){
						$('#adviser_name_id').val(data.name_id);
					//}
			}else{

			$(editableObj).css("background","#FDFDFD");

			}
			$(editableObj).css("background","#FDFDFD");
		}        
   });
}


	function saveRating(editableObj,column) {

		var post_id = $('#post_id_rating').val();

		$(editableObj).css("background","#FFF url(../../public/images/loading.gif) no-repeat right");
		$(editableObj).css("background-size","15px");

		var data = 'column= '+column+'&rating='+$(editableObj).val()+'&post_id='+post_id;

		$.ajax({
			url: "../post/edit_rating",
			type: "POST",
			data: data,
			dataType: 'json',
			success: function(data){
				console.clear()
				console.log(data);
				
				$(editableObj).css("background","#FDFDFD");
			}        
	  	 });

	}
		function add_committee(id){

			if ($('#divcommittee').hasClass('hidden')) {
			$('#divcommittee').removeClass('hidden')
			return false;
		}

  		    var error = 0;

			    $.each( $("input[name='"+id+"[]']"), function(index,value){
			        if( value.value.length == 0){
			            error = 1;

			        	$("#msg"+id).html("<font color='red'>Please input "+id+" first</font>"); 

			        	setTimeout(function(){
			        	$("#msg"+id).html("");
			        	},1000);
			            return false;
			        }
			    });
			    if(!error){
			    	var name = id.replace(/\d+/g, '')

			    	var position = document.getElementById('researcher-position');
			    	var pos_c = position.innerHTML;

			        $("#msg"+id).html(""); 
			        $('#div'+id).append('<br><div class="col-md-8"><label for="Title">Name of '+id+'</label><input  type="text" class="form-control" name="'+name+'[]" id="'+id+more+'" placeholder="Enter '+id+' here" onkeyup="names(this.id)" autocomplete="off" required><ul class="ul-on-input" id="ul-on-input-'+id+more+'" onmouseleave="hide_selection(this.id)"></ul></div><div class="col-md-4"><label for="Title">Position / title</label><select id="'+id+more+'-position" name="'+id+'-position"class="form-control">'+pos_c+'</select></div>');

			    more = more + 1;
			    }


  		
	}


		function add_panel(id){

			if ($('#divpanel').hasClass('hidden')) {
			$('#divpanel').removeClass('hidden')
			return false;
		}

  		    var error = 0;

			    $.each( $("input[name='"+id+"[]']"), function(index,value){
			        if( value.value.length == 0){
			            error = 1;

			        	$("#msg"+id).html("<font color='red'>Please input "+id+" first</font>"); 

			        	setTimeout(function(){
			        	$("#msg"+id).html("");
			        	},1000);
			            return false;
			        }
			    });
			    if(!error){
			    	var name = id.replace(/\d+/g, '')

			    	var position = document.getElementById('researcher-position');
			    	var pos_c = position.innerHTML;

			        $("#msg"+id).html(""); 
			        $('#div'+id).append('<br><div class="col-md-8"><label for="Title">Name of '+id+'</label><input  type="text" class="form-control" name="'+name+'[]" id="'+id+more+'" placeholder="Enter '+id+' here" onkeyup="names(this.id)" autocomplete="off" required><ul class="ul-on-input" id="ul-on-input-'+id+more+'" onmouseleave="hide_selection(this.id)"></ul></div><div class="col-md-4"><label for="Title">Position / title</label><select id="'+id+more+'-position" name="'+id+'-position"class="form-control">'+pos_c+'</select></div>');

			    more = more + 1;
			    }


  		
	}


	$('#frm_committee').on('submit',function () {

		var data = $(this).serialize();



			$.ajax({
    			type: 'post',
    			url: '<?php echo site_url("post/save_committee");?>',
    			data: data,
    			dataType: 'json',
    			success: function (resp) {
    				console.clear();
    				console.log(resp);

    				if (resp.stats == true) {
    						$('.response_committee').html('<div class="alert alert-success">'+resp.msg+' Pls. reload the page to see changes</div>')



    					}
    					else{

    						$('.response_committee').html('<div class="alert alert-danger">Author not added.</div>')
    					}
    					return false;
    			},
    			error: function (resp) {
    				// body...

    						$('.response_committee').html('<div class="alert alert-danger">Unknow error occured.</div>');

					        setTimeout(function(){
					        	 $('.response_committee').html('');
					        },5000);
    			}

    		});


			return false;
	});

	$('#frm_panel').on('submit',function () {

		var data = $(this).serialize();



			$.ajax({
    			type: 'post',
    			url: '<?php echo site_url("post/save_panel");?>',
    			data: data,
    			dataType: 'json',
    			success: function (resp) {
    				console.clear();
    				console.log(resp);

    				if (resp.stats == true) {

				         // $('.thesis').hide('fast');
				          //$('.resource').show('slow');
    						$('.response_panel').html('<div class="alert alert-success">'+resp.msg+' Pls. reload the page to see changes</div>')

    					}
    					else{

    						$('.response_panel').html('<div class="alert alert-danger">Author not added.</div>')
    					}
    					return false;
    			},
    			error: function (resp) {
    				// body...

    						$('.response_panel').html('<div class="alert alert-danger">Unknow error occured.</div>');

					        setTimeout(function(){
					        	 $('.response_panel').html('');
					        },5000);
    			}

    		});


			return false;
	});
</script>