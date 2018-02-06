					
					<div class="panel panel-default">
						<div class="panel-heading">
							<label>Researcher <a href="javascript:void(0)" class="btn btn-default btn-more" title="Add Add more..." onclick="add_auth('researcher')"><i class="fa fa-plus"></i></a></label>
							<div id="msgresearcher" style="display: inline-block;"></div>
						</div>
						<div class="panel-body">
				<form class="form " id="frm_author" action="../post/edit_author" method="post">
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
									if (!empty($researcher)) {
										# code...


									foreach ($researcher as $key) {
										echo "<input type=\"hidden\" name=\"post_id_auth\" id=\"post_id_auth\" value='$key->post_id'>";

									echo "<tr id='tr_$key->info_id'><td>$key->id <input type='hidden' id='auth_id_$key->id' value='$key->id' /> <input type='hidden' id='role_id_$key->id' value='$key->role_id' /></td>
									<td contenteditable=\"true\" onBlur=\"saveToDatabase(this,'fullname',$key->id,$key->info_id)\">$key->fullname</td>
									<td contenteditable=\"true\" onBlur=\"saveToDatabase(this,'role_name',$key->id,$key->info_id)\">$key->position</td><td width='30px'><button class='btn btn-danger pull-right' type='button' id='$key->info_id' onclick='remove_author(this.id)'><i class='fa fa-remove'></i></button></td></tr>";

									 }

									}


									  ?>
								</tr>
							</table>
				</form>
						</div>
						<div class="panel-body">
							<div class="response"></div>
							<form class="form hidden" id="frm_researcher" action="../post/save_author" method="post">
								
							<div class="row"  id="divresearcher">
							<div class="col-md-8">
									
								<label>Name of researcher</label>
								<input type="text" class="form-control researcher" name="researcher[]" id="researcher" placeholder="Type researcher full name" autocomplete="off">
								<ul class="ul-on-input" id="ul-on-input-researcher" onmouseleave="hide_selection(this.id)"></ul>
							</div>
							<div class="col-md-4">
									<label>Position / title </label><!-- input type="text" class="form-control" name="researcher-position[]" id="researcher-position" placeholder="Type researcher position or NA" autocomplete="off" -->
									<select class="form-control" name="researcher-position[]" id="researcher-position">
										<option value="0">Select here</option>
										<?php foreach ($position as $key): ?>
											<option value="<?=$key->role_name;?>"><?=strtoupper($key->role_name);?></option>
										<?php endforeach ?>
									</select>
							
							</div>
						
							</div>
							<div class="col-md-12"><br/></div>
							<div class="col-md-12"><button class="btn btn-success">Save</button></div>
						</form>

						</div>

					</div>


<script type="text/javascript">
var name;
function saveToDatabase(editableObj,column,id,info_id) {

	var auth_id = $('#auth_id_'+id).val();
	var role_id = $('#role_id_'+id).val();

	$(editableObj).css("background","#FFF url(../../public/images/loading.gif) no-repeat right");
	$(editableObj).css("background-size","15px");
	$.ajax({
		url: "../post/edit_author",
		type: "POST",
		data:'column='+column+'&editval='+editableObj.innerHTML+'&id='+auth_id+'&info_id='+info_id+'&role_id='+role_id,
		dataType: 'json',
		success: function(data){
						console.log(data);
			if (data.stats = true) {

					if(data.col == 'fullname'){
						$('#auth_id_'+id).val(data.name_id);
					}
					if(data.col == 'role_name'){
						$('#role_id_'+id).val(data.role_id);
					}

			}else{

			}
			$(editableObj).css("background","#FDFDFD");
		}        
   });
}




function add_tab(id) {
	var markup = '<tr><td></td><td  contenteditable="true"></td><td contenteditable="true"></td></tr>';
	$('#table_'+id+ ' tbody').append(markup);

}
</script>


<script type="text/javascript">
	var timer;
	var inputId;
	var more = 2;
	function names(id) {
		// body...
		console.log(id);
		var names = $('#'+id).val();

		inputId = id;
		if($('#'+id).hasClass('researcher')){
			return false;
		}
		if ($.trim(names).length < 2) {
			return false;
		}


		$('#ul-on-input-'+id).show();
		$('#ul-on-input-'+id).html('<li>searching...</li>');

		
		  clearTimeout(timer);       // clear timer
		  timer = setTimeout(get_names, 500);

    		return false;
    	};

			$('#panel').on('keydown', function(){
				  clearTimeout(timer);       // clear timer
		    });
			$('#committee').on('keydown', function(){
				  clearTimeout(timer);       // clear timer
		    });

    	 function get_names(id){

    	 	var name = $('#'+inputId).val();


    		$.ajax({
    			type: 'post',
    			url: '<?php echo site_url("post/search_names");?>',
    			data: 'name='+name,
    			dataType: 'json',
    			success: function (resp) {
    				console.clear();
    				//console.log(resp);

    				if (resp.stats == true) {
    					$('#ul-on-input-'+inputId).html(resp.msg);
    				}
    				setTimeout(function () {
    					// body...
    					$('#ul-on-input-'+inputId).hide();
    				},10000);
    			}

    		});

					
    	}
    	function get_selected(string) {
    		// body...
    		$('#'+inputId).val(string);
    		$('#ul-on-input-'+inputId).hide();
    	}
	function add_auth(id){

		if ($('#frm_researcher').hasClass('hidden')) {
			$('#frm_researcher').removeClass('hidden')
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
			        $('#div'+id).append('<br><div class="col-md-8"><label for="Title">Name of '+id+'</label><input  type="text" class="form-control" name="'+name+'[]" id="'+id+more+'" placeholder="Enter '+id+' here" autocomplete="off" required></div><div class="col-md-4"><label for="Title">Position / title</label><select id="'+id+more+'-position" name="'+id+'-position"class="form-control">'+pos_c+'</select></div>');

			    more = more + 1;
			    }


  		
	}

	function hide_selection(id){

    		$('#ul-on-input-'+inputId).hide();
    		 clearTimeout(timer); 
	}

</script>

<script type="text/javascript">
	var	activeId;

	$('#frm_researcher').on('submit',function () {
		var post_id = $('#post_id_auth').val();
		var data = $(this).serialize();

			data = data+'&post_id='+post_id;


			$.ajax({
    			type: 'post',
    			url: '<?php echo site_url("post/save_author");?>',
    			data: data,
    			dataType: 'json',
    			success: function (resp) {
    				console.clear();
    				console.log(resp);

    				if (resp.stats == true) {

				         // $('.thesis').hide('fast');
				          //$('.resource').show('slow');
    						$('.response').html('<div class="alert alert-success">'+resp.msg+'</div>')

    					}
    					else{

						$('#option-thesis').show('slow');
    						$('.response').html('<div class="alert alert-danger">Author not added.</div>')
    					}
    					return false;
    			},
    			error: function (resp) {
    				// body...

    						$('.response').html('<div class="alert alert-danger">Unknow error occured.</div>');

					        setTimeout(function(){
					        	 $('.response').html('');
					        },5000);
    			}

    		});


			return false;
	});

	function remove_author(id) {
		// body...

		var data = 'id='+id;

			$.ajax({
    			type: 'post',
    			url: '<?php echo site_url("post/remove_author");?>',
    			data: data,
    			dataType: 'json',
    			success: function (resp) {
    				console.clear();
    				console.log(resp);

    				if (resp.stats == true) {
    						$('#tr_'+id).remove();
    						$('.response').html('<div class="alert alert-success">'+resp.msg+'</div>')

    					}
    					else{

						$('#option-thesis').show('slow');
    						$('.response').html('<div class="alert alert-danger"'+resp.msg+'</div>')
    					}
    					return false;
    			},
    			error: function (resp) {
    				// body...

    						$('.response').html('<div class="alert alert-danger">Unknow error occured.</div>');

					        setTimeout(function(){
					        	 $('.response').html('');
					        },5000);
    			}

    		});


			return false;
	}

</script>