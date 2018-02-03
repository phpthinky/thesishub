
    <!-- Main Content -->
    <div class="container-fluid">
        <div class="side-body">
        	<div class="col-md-12">
        		<h4>Courses settings </h4>
        	</div>
        	<div class="col-md-12">
        	<div class="col-md-12">
        		<div class="result"></div>
        	</div>
        		<form class="form" action="<?=site_url('setting/course');?>" method="post" name="frmcourses" id="frmcourses">
        			<div class="from-group">
        				<label>Course title</label>
        				<input type="text" id="courses" name="courses" class="form-control" onkeyup="names(this.id)">
        			</div>

                    <div class="from-group">
                        <label>Short definition</label>
                        <textarea class="form-control" name="definition" id="definition"></textarea>
                    </div>

        			<div class="from-group"><br/>
        				<label></label>
        				<button class="btn btn-info" type="submit">Save</button>
        			</div>
        		</form>
                <div class="col-md-12"><br />
                    <?php if(isset($groups)){
                        if (is_array($groups)) {
                            //var_dump($groups);
                            echo "<table class='table table-bordered'><h4>List of active courses</h4>
                                    <tr><th></th><th>Name</th><th>Definitions</th><th>Action</th></tr>
                                ";
                                $i = 1;
                            foreach ($groups as $key) {
                                
                                    echo "<tr id='tr-$key->id'><td style='text-align:right'>$i</td><td>$key->name</td><td>$key->definition</td><td><button type='button' class='btn btn-danger' onclick='delete_role($key->id,1)'><i class='fa fa-remove'></i></button></td></tr>";
                                    $i++;
                            }
                            echo "</table'>
                                ";
                        }
                    } ?>
                </div>
        	</div>
       	</div>
     </div>


<script type="text/javascript">
	

	var timer;
	var inputId;
	function names(id) {
		// body...
		var names = $('#'+id).val();

		inputId = id;

		if ($.trim(names).length < 2) {
			return false;
		}

		
		  clearTimeout(timer);       // clear timer
		  timer = setTimeout(get_names, 2000);

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
    				console.log(resp);

    				if (resp.stats == true) {
    					$('.result').html('Course not already exist.');
    				}else{

    					$('.result').html('Available');
    				}
    				setTimeout(function () {
    					// body...
    					$('.result').hide();
    				},3000);
    			}

    		});

					
    	}
    	function get_selected(string) {
    		// body...
    		$('#'+inputId).val(string);
    		$('#ul-on-input-'+inputId).hide();
    	}

           function delete_role(id,status) {
        // body...
        //alert(status);return false;
            $.ajax({
                type: 'post',
                url: '<?=site_url("setting/delete_course");?>',
                data: 'role_id='+id+'&status='+status,
                dataType:'json',
                success: function (resp) {
                    console.clear();
                    console.log(resp);
                    if (resp.stats == true) {
                        if (status == 1) {

                        $('#tr-'+id).remove(); 
                    }else{

                        $('#tr-'+id).remove();  
                    }                   
                    }

                }
            });
    }

</script>