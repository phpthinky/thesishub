
    <!-- Main Content -->
    <div class="container">
	<div class="col-md-12">
	<h3 style="display: inline-block;"><?php echo isset($title) ? $title : "Portal"; ?></h3>
	</div>
	<div class="col-md-9">
        	

        	<div class="panel">
        		<div class="panel-body">
        		</div>

        		<div class="panel-body" id="div-add-resource">
        			<div class="result"></div>
        			<form class="form" method="post" action="file/save_resource" enctype="multipart/form-data" id="frmresources" name="frmresources">
        				<div class="form-group">
        					<label class="title">Title</label>
        					<input type="text" name="title" id="title" class="form-control" placeholder="Type title here">
        				</div>
        				<div class="form-group">
        					<label class="title">Description</label>
        					<textarea type="text" name="desc" id="desc" class="form-control" placeholder="Type short descrition here"></textarea>
        				</div>

        				<div class="form-group">
        					<label class="title">Keyword</label>
        					<input type="text" name="tags" id="tags" class="form-control" placeholder="Type keyword here separate by comma eg. hello,hi,world">
        				</div>

        				<div class="form-group">
        					<label class="title">Upload</label>
        					<input type="file" name="filez" id="filez" class="btn alert-info" accept="image/*,audio/mp3,video/*,application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint,
text/plain, application/pdf">
        				</div>
        				<div class="from-group">
        					<label></label><button class="btn btn-info" id="btnsave">Save</button>
        				</div>
        			</form>
        		</div>
        	</div>
        	<div class="content-area">
        		
			
        	</div>
           
         
        </div>
    </div>

<script type="text/javascript">
	function clearform (frm) {
		// body...
		document.getElementById(frm).reset();
		return;
	}
	$('#frmresources').on('submit',function(e){
		var frmdata = new FormData();

		var title = $('#title').val();
		var desc =  $('#desc').val();
		var tags =  $('#tags').val();

    	frmdata.append( 'filez', $( '#filez' )[0].files[0] );
		frmdata.append('title',title);
		frmdata.append('desc',desc);
		frmdata.append('tags',tags);

        

			$.ajax({
    			type: 'post',
    			url: '<?=site_url("file/save_resource");?>',
    			data: frmdata,
        		processData: false,
  				contentType: false,
  				beforeSend: function(){
  					$('#frmresources').hide('fast');
  					$('.result').html('<center><div class="loader"></div></center>');
  				},
    			success: function (resp) {
    				console.clear();

    				console.log(resp);

  					$('#frmresources').show('slow');
    				if (resp == true) {

    				$('.result').html('<div class="btn alert-success">'+title + ' -successfully added.</div>');
    					setTimeout(function () {
    						// body...

    				$('.result').html('');
    					},5000)
    				clearform('frmresources');

	    			}else if(resp == 2){
	    				$('.result').html('<div class="btn alert-danger">'+title + ' - is already used.</div>');
	    			}else{
	    				$('.result').html('<div class="btn alert-danger">Unknown error occured!</div>');
	    			}


				

    			}
    		});
		return false; 
	});

</script>