					
					<div class="panel panel-default">
						<div class="panel-heading">
							<label>Researcher <a href="javascript:void(0)" class="btn btn-default btn-more" title="Add Add more..." onclick="add_auth('researcher')"><i class="fa fa-plus"></i></a></label>
							<div id="msgresearcher" style="display: inline-block;"></div>
						</div>
						<div class="panel-body">
							<div class="response"></div>
							<form class="form" id="frm_researcher" action="../post/save_author" method="post">
								
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
							<div class="col-md-12"><button class="btn btn-success" type="submit">Save</button></div>
						</form>

						</div>

					</div>




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

  		    var error = 0;

			    $.each( $("input[name='"+id+"[]']"), function(index,value){
			    	//console.log(value);return false
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
		var post_id = $('#post_id').val();
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

    						$('.response').html('<div class="alert alert-success">'+resp.msg+'</div>')
         			 		show_approval();

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