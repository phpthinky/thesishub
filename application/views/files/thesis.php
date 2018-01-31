<div class="row other-option" id="option-thesis" style="display:block;">
				<div class="col-md-12">
				<h4><label>Other information</label></h4>
				<div class="row">
				<form class="form " id="frm-6" action="../post/save_info" method="post">
					<input type="hidden" name="slug" id="slug">
					<div class="panel panel-default">
						<div class="panel-heading">
							<label>Researcher <a href="javascript:void(0)" class="btn btn-default btn-more" title="Add Add more..." onclick="addmore('researcher')"><i class="fa fa-plus"></i></a></label>
							<div id="msgresearcher" style="display: inline-block;"></div>
						</div>
						<div class="panel-body">
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
						</div>

					</div>


			<div class="panel panel-default">
				<div class="panel-heading">
					<label>Committee <a href="javascript:void(0)" class="btn btn-default btn-more" title="Add Add more..." onclick="addmore('committee')"><i class="fa fa-plus"></i></a></label>
					<div id="msgcommittee" style="display: inline-block;"></div>
				</div>
				<div class="panel-body">
					<div class="row"  id="divcommittee">
						<div class="col-md-8">
							
							<label>Name of committee</label><input type="text" class="form-control" name="committee[]" id="committee" placeholder="Type committee full name" onkeyup="names(this.id)" autocomplete="off">
							<ul class="ul-on-input" id="ul-on-input-committee" onmouseleave="hide_selection(this.id)"></ul>
						</div>
						<div class="col-md-4">
							<label>Position / title </label><?php //input type="text" class="form-control" name="committee-position[]" id="committee-position" placeholder="Type committee position or NA" ?>
							<select class="form-control" name="committee-position[]" id="committee-position">
										<option value="0">Select here</option>
										<?php foreach ($position as $key): ?>
											<option value="<?=$key->id;?>"><?=$key->role_name;?></option>
										<?php endforeach ?>
									</select>
					
						</div>	
					</div>
				</div>

			</div>

			<div class="panel panel-default">
				<div class="panel-heading">
					<label>Examining Panel <a href="javascript:void(0)" class="btn btn-default btn-more" title="Add Add more..." onclick="addmore('panel')"><i class="fa fa-plus"></i></a></label>
					<div id="msgpanel" style="display: inline-block;"></div>
				</div>
				<div class="panel-body">
					<div class="row"  id="divpanel">
						<div class="col-md-8">
							
							<label>Name of panel</label><input type="text" class="form-control" name="panel[]" id="panel" placeholder="Type panel full name" onkeyup="names(this.id)" autocomplete="off">
							<ul class="ul-on-input" id="ul-on-input-panel" onmouseleave="hide_selection(this.id)"></ul>
						
						</div>
						<div class="col-md-4">
							
							<label>Position / title </label><?php//input type="text" class="form-control" name="panel-position[]" id="panel-position" placeholder="Type panel position or NA" ?>
							<select class="form-control" name="panel-position[]" id="panel-position">
										<option value="0">Select here</option>
										<?php foreach ($position as $key): ?>
											<option value="<?=$key->id;?>"><?=$key->role_name;?></option>
										<?php endforeach ?>
									</select>
					
						</div>
					</div>
				</div>

			</div>

			<div class="panel panel-default">
				<div class="panel-body">
					<div class="row">
						
					<div class="col-md-6">
							
						<div class="form-group">
						<label>Adviser</label>
							<input type="text" class="form-control" name="adviser" id="adviser" placeholder='Type daviser here...' onkeyup="names(this.id)" autocomplete="off">
							<ul class="ul-on-input" id="ul-on-input-adviser" onmouseleave="hide_selection(this.id)"></ul>
						
						</div>
					</div>

						
					<div class="col-md-6">
							
						<div class="form-group">
						<label>Rating</label>
							<input type="number" max="3" step="0.01"   class="form-control" name="rating" id="rating" placeholder='Type rating here...'>
						</div>
					</div>
					</div>
				</div>
			</div>

			<button type="submit" name="btn-submit" id="btn-submit" class="btn btn-success">Save</button>
			<button type="button" name="btn-skip"  id="btn-skip" class="btn btn-default" onclick="skipinfo(this.id)" >Skip</button>
			<br />
			<br />
			<br />
				</form>
				</div>
				</div>
			</div>



<script type="text/javascript">

	function skipinfo(id) {
		// body...
				          $('.thesis').hide('fast');
				          $('.resource').show('slow');
	}
	//form for other information or second form
var	activeId;

	$('#frm-6').on('submit',function () {
		$('#option-thesis').hide('fast');
		
		//return true;
		/*
		$('#frm-'+activeId).submit();
		});
		//*/
		//if (activeId == 6) {

		var data = $(this).serialize();
			data = data+'&option='+activeId;
			//console.log(data);return false;
			$.ajax({
    			type: 'post',
    			url: '<?php echo site_url("post/save_info");?>',
    			data: data,
    			dataType: 'json',
    			success: function (resp) {
    				console.clear();
    				console.log(resp.stats);
    				if (resp.stats == true) {

				          $('.thesis').hide('fast');
				          $('.resource').show('slow');
    						$('.response').html('<div class="alert alert-success">'+resp.msg+'</div>')

    					}
    					else{

						$('#option-thesis').show('slow');
    						$('.response').html('<div class="alert alert-danger">Unknow error occured.</div>')
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
		//};
		//	return false;
	})

	//*/
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
	function addmore(id){
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

	function hide_selection(id){

    		$('#ul-on-input-'+inputId).hide();
    		 clearTimeout(timer); 
	}




</script>