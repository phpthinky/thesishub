<div class="row create">
	<div class="col-md-12 col-lg-12 ">
	<div class="row">		
		<div class="col-md-12">
			<div class="form-group">
				<div class="response"></div>
			</div>
		<form class="form" id="frmpost" name="frmpost" action="<?=site_url('post/save_post');?>" method="post">
			<div class="col-md-12">
			<div class="form-group">
				<label for="Title">Title</label><input type="text" class="form-control" name="title" id="title" placeholder="Type title here"  autocomplete="off"  required>
			</div>

			<div id='textareafield' class="">
			<div class="form-group">
				<label for="Title">Abstract</label><textarea name="contents"  id="contents" style="width:100%;height:100px;"  placeholder="Type abstract here"></textarea>
			</div>
			</div>

			<div id='uploadpdffield' class="hidden">
			<div class="form-group">
				<label for="Title">Abstract</label><input type="file" class="btn alert-info" >
			</div>
			</div>

			<div class="form-group">
				<label for="Title">Tags </label> <input type="text" class="form-control"  data-role="tagsinput" name="tags" id="tags" placeholder='Type tag separate by comma' autocomplete="off" >
				<div id="listoftags" class="listoftags"></div>
			</div>

			</div>
			<div class="col-md-6"><div class="form-group">
					<label for="Title">Thesis code number: </label><input type="text" class="form-control" name="code" id="code" placeholder='Type code here... (optional)'>
				</div>
			</div>
			<div class="col-md-6"><div class="form-group">
					<label for="Title">Course</label><select class="form-control" name="group" id="group">
						<?php 
							foreach ($listgroup as $key) {
								# code...
								echo "<option value='$key->id'>$key->name</option>";

							}
						?>
					</select> 
				</div>
			</div>
			<div class="col-md-6">

			<div class="form-inline">

				<label for="Title">Month &nbsp;</label>

				<select class="form-control" name="selectmonth" id="selectmonth" style="width:25%;min-width:95px;">
				<?php 
				$months = array(
					array('id'=>1,'name'=>'Jan'),
					array('id'=>2,'name'=>'Feb'),
					array('id'=>3,'name'=>'Mar'),
					array('id'=>4,'name'=>'Apr'),
					array('id'=>5,'name'=>'May'),
					array('id'=>6,'name'=>'Jun'),
					array('id'=>7,'name'=>'Jul'),
					array('id'=>8,'name'=>'Aug'),
					array('id'=>9,'name'=>'Sep'),
					array('id'=>10,'name'=>'Oct'),
					array('id'=>11,'name'=>'Nov'),
					array('id'=>12,'name'=>'Dec')

					);

				$m = date('m');

				foreach ($months as $key) {
					# code...
						if($key['id'] == $m){$iscurrent = 'selected';}else{$iscurrent='';}
						echo "<option value='".$key['id']."' $iscurrent>".$key['name']."</option>";
				}
				?>
				</select> 
				
				<label for="Title">Year &nbsp;</label><select class="form-control" name="selectyear" id="selectyear"  style="width:25%;min-width:95px;">
					<?php 
					$currentY = date('Y');
					//echo $currentY;
					for ($i=2000; $i < 2025; $i++) { 
						# code...
						if($i == $currentY){$iscurrent = 'selected';}else{$iscurrent='';}
						echo "<option value='$i' $iscurrent>$i</option>";

					}
					?>
				</select> 
			</div><br>
				
			</div>	
				
			<div class="col-md-6">
				



			<div class="form-inline">
			<input type="submit" class="btn btn-info" name="btnsubmit" id="btnsubmit" value="Next >>">
			<br />
				<div class="response"></div>

			<!--input type="submit" class="btn btn-success" name="btnabstractonly" id="btnabstractonly" value="Save &amp; Done"-->
			<button class="btn btn-default push-right hidden" id="btnpdf">Upload abstract in PDF</button>
			<button class="btn btn-default hidden push-right" id="btntextarea">Insert abstract in text</button>
			</div>

			</div>

			


			<div class="form-group">
			<div class="row"><br>
			<!--div class="alert alert-warning">
				<p><b>Notes:</b></p>
				<p>Next >> (Click this button to continue to other information.)</p>
				<p>Save &amp; Done (Click this button to save the title and abstract only and update the other information later.)</p-->
			
			</div>
			</div>
			</div>

		</form>
		</div>

		</div>	
	<div class="row">
		<div class="col-md-12">
		<form class="form " id="frm-other-info" style="display: none;">
			<input type="hidden" name="slug" id="slug">
			<style type="text/css">
				ul.ul-on-input{
					text-decoration: none;
					list-style: none;
					margin:0;
					padding:0;
					margin-left: 5px;
					margin-top: -5px;
					background-color: #e5e5e5;
					position: absolute;
					width: 96%;
					min-width: 100px;
					padding: 4px;
					display: none;
				}
				ul.ul-on-input > li{

					padding: 4px;
				}
				ul.ul-on-input > li:hover{
					background-color: #4543a9;
					color: #fff;
					cursor: pointer;
				}
			</style>
			<div class="panel">
				<div class="panel-heading">
					<label>Researcher <a href="javascript:void(0)" class="btn btn-default btn-more" title="Add Add more..." onclick="addmore('researcher')">Add more...</a></label>
					<div id="msgresearcher" style="display: inline-block;"></div>
				</div>
				<div class="panel-body">
					<div class="col-md-12"  id="divresearcher">
						
					<label>Name of researcher</label><input type="text" class="form-control" name="researcher[]" id="researcher" placeholder="Type researcher full name">
				
					<label>Position / title </label><input type="text" class="form-control" name="researcher-position[]" id="researcher-position" placeholder="Type researcher position or NA">
					</div>
				</div>

			</div>
			<div class="panel">
				<div class="panel-heading">
					<label>Committee <a href="javascript:void(0)" class="btn btn-default btn-more" title="Add Add more..." onclick="addmore('committee')">Add more...</a></label>
					<div id="msgcommittee" style="display: inline-block;"></div>
				</div>
				<div class="panel-body">
					<div class="col-md-12"  id="divcommittee">
						
					<label>Name of committee</label><input type="text" class="form-control" name="committee[]" id="committee" placeholder="Type committee full name" onkeyup="names(this.id)">
					<ul class="ul-on-input" id="ul-on-input-committee"></ul>
				
				
					<label>Position / title </label><input type="text" class="form-control" name="committee-position[]" id="committee-position" placeholder="Type committee position or NA">
					</div>
				</div>

			</div>

			<div class="panel">
				<div class="panel-heading">
					<label>Examining Panel <a href="javascript:void(0)" class="btn btn-default btn-more" title="Add Add more..." onclick="addmore('panel')">Add more...</a></label>
					<div id="msgpanel" style="display: inline-block;"></div>
				</div>
				<div class="panel-body">
					<div class="col-md-12"  id="divpanel">
						
					<label>Name of panel</label><input type="text" class="form-control" name="panel[]" id="panel" placeholder="Type panel full name" onkeyup="names(this.id)">
					<ul class="ul-on-input" id="ul-on-input-panel"></ul>
				
					<label>Position / title </label><input type="text" class="form-control" name="panel-position[]" id="panel-position" placeholder="Type panel position or NA">
					</div>
				</div>

			</div>

			


			<div class="panel">
				<div class="panel-heading"><label>Rating</label></div>
				<div class="panel-body">
					<div class="col-md-12">
						
			<div class="form-group">
				<label for="Title"></label><input type="number" max="5" class="form-control" name="rating" id="rating" placeholder='Type rating here...'>
			</div>
					</div>
					<br />
			<div class="form-group">
					<div class="col-md-12"><label for="Title"></label><button type="submit" class="btn btn-info" >Save</button></div>
				
			</div>
			</div>
			</div>
		</form>

		</div>
	</div>
	</div>
</div>	
<script type="text/javascript">
	/*$('.tm-input').tagsManager();

	$('#tags').on('keyup',function (e) {
		// body...

		var istag = $('#tags').val();
		if (istag.length < 3) {

				$('#listoftags').html('');
		}
			else{

				$('#listoftags').html('<font color="red"><i>Press enter to add tags</i></font>');
			
			}
			

	});
	*/

	var timer;
	var inputId;
	function names(id) {
		// body...
		var names = $('#'+id).val();

		inputId = id;

		if ($.trim(names).length < 2) {
			return false;
		}


		$('#ul-on-input-'+id).show();
		$('#ul-on-input-'+id).html('<li>searching...</li>');

		
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
			        	},3000);
			            return false;
			        }
			    });
			    if(!error){
			        $("#msg"+id).html(""); 
			        $('#div'+id).append('<br><label for="Title">Name of '+id+'</label><input  type="text" class="form-control" name="'+id+'[]" id="'+id+'" placeholder="Enter '+id+' here" required><label for="Title">Position</label><input type="text" class="form-control" name="'+id+'-position[]" id="'+id+'-position" placeholder="Enter position here" required>');

			    }


  		
	}
	

	$('#frmpost').on('submit',function(e){

		e.preventDefault();

		var data = $('#frmpost').serialize();

  		var abstract = $('#contents').summernote('code');

  		data = data + '&abstract='+abstract;



		$.ajax({
			type: 'post',
			dataType: 'json',
			url: '<?=site_url('post/save');?>',
			data: data,
			success: function (resp) {

				console.log(resp);

				if (resp.stats == true) {
					$('#slug').val(resp.slug);
					$('.response').html('<div class="alert alert-success">Post successfully added.</div>');
					$('#frmpost').hide('slow');
					$('#frm-other-info').show('slow');

						setTimeout(function () {
						$('#researcher').focus();
						},2000);


				}else{
					$('.response').html('<div class="alert alert-danger">'+resp.error+'</div>');
				}
			}
		});

		return false;
	});

	$('#frm-other-info').on('submit',function(e){
		var data2 = $('#frm-other-info').serialize();




		$.ajax({
			type: 'post',
			dataType: 'json',
			url: '<?=site_url('post/save');?>',
			data: data2,
			success: function (resp) {

				console.log(resp);

				if (resp.stats == true) {
					$('.response').html('<div class="alert alert-success">Post successfully updated.</div>');
					
					setTimeout(function () {
						$('.response').html('');

					},5000);

						clearform('frmpost');
						clearform('frm-other-info');
						$('#frmpost').show('slow');
						$('#frm-other-info').hide('slow');
						$('#title').focus();

				}else{
					$('.response').html('<div class="alert alert-danger">'+resp.error+'</div>');
				}
			}
		});

		return false;
	});
	

	function clearform (frm) {
		// body...
		document.getElementById(frm).reset();
		$('.response').html();
		$('#slug').val('');
		$('.tm-input').tagsManager('empty');
		$('#contents').summernote('reset');
		return;
	}

$('#contents').summernote({
    callbacks: {
        onPaste: function (e) {
            var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
            e.preventDefault();
            document.execCommand('insertText', false, bufferText);
        }
    }
});


</script>