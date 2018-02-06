
    <!-- Main Content -->
    <div class="container-fluid">
        <div class="side-body">

        <div class="row create">
	<div class="col-md-12 col-lg-12 ">
	<div class="row">		
		<div class="col-md-12">
			<div class="form-group">
				<div class="response"></div>
				<div class="upload"></div>
			</div>
		<form class="form" id="frmpost" name="frmpost" action="<?=site_url('file/save_resource');?>" method="post"  enctype="multipart/form-data">
			<div class="col-md-12">
			<div class="form-group">
				<label for="Title">Title</label><input type="text" class="form-control" name="title" id="title" placeholder="Type title here"  autocomplete="off"  required>
			</div>

			<div id='textareafield' class="">
			<div class="form-group">
				<label for="Title">Abstract/Description <i class='btn fa fa-undo' style='color:dodgerblue' onclick='cleartextarea("contents")' title='Clear abstract/description'></i></label>
				<textarea name="contents"  id="contents" style="width:100%;height:100px;"  placeholder="Type abstract here"></textarea>
			</div>
			</div>


			<div class="form-group">
				<label for="Title">Keyword<i class='btn fa fa-undo' style='color:dodgerblue' onclick='cleartags("tags")' title='Clear all tags'></i></label><br/> <input type="text" class="form-control"  data-role="tagsinput" name="tags" id="tags" placeholder='Type here and press Enter' autocomplete="off"  style='min-width:200px;'>
				<div id="listoftags" class="listoftags"></div>
			</div>

			</div>
			<div class="col-md-12">
			<div class="form-group">
				<label for="Title">Select file</label>

        					<input type="file" name="filez" id="filez" class="btn alert-warning" accept="image/*,audio/mp3,video/*,application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint,
 application/pdf,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.openxmlformats-officedocument.presentationml.presentation,application/x-rar,application/zip">
			</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="Title">File Privacy</label><select class="form-control" name="group-privacy" id="group-privacy">
						
						<option value="1">Staff only</option>
						<option value="2">Public</option>
					</select> 
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="Title">File Category</label><select class="form-control" name="group-category" id="group-category">
						<?php 
							foreach ($category as $key) {
								# code...
								echo "<option value='$key->id'>$key->name</option>";

							}
						?>
					</select> 
				</div>
			</div>

			<div class="col-md-6">
				<div class="form-group">
					<label for="Title">Course</label><select class="form-control" name="group-course" id="group-course">
						
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

				<label for="Title">Date &nbsp;</label><br />

				<select class="form-control" name="months" id="months" style="width:25%;min-width:95px;">
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
				<select  class="form-control" name='days' id='days' style="width:25%;min-width:95px;" >
					
				<?php
				$d = date('d');
				for ($i=1; $i <=31; $i++) { 
					# code...
					echo "<option value ='$i'";
					if ($i == $d) {
						# code...
						echo ' selected';
					}
					echo ">$i</option>";
				}
				?>
				</select>
				
				<select class="form-control" name="years" id="years"  style="width:25%;min-width:95px;">
					<?php 
					$currentY = date('Y');
					//echo $currentY;
					for ($i=1912; $i <= $currentY; $i++) { 
						# code...
						if($i == $currentY){$iscurrent = 'selected';}else{$iscurrent='';}
						echo "<option value='$i' $iscurrent>$i</option>";

					}
					?>
				</select> 
				</div>
				
			</div>	
				
			<div class="col-md-6">
		

			<div class="form-group">
			<br />
			<input type="submit" class="btn btn-info" name="btnsubmit" id="btnsubmit" value="Next >>">
			<button type="button" class="btn btn-warning" onclick="resetall()">Clear all</button> 
			<br />
				<div class="response"></div>


			</div>

		
			</div>
			</div>

		</form>
		</div>

		</div>	
		<div class="row" id="other-info" style="display:block;">
			<div class="col-md-12">
			<div class="panel">
				<div class="panel-body">
				
				<div class="col-md-12">
				<label>Other information</label>
				<select class="form-control">
					<option value="0">--- SELECT HERE ---</option>
					<option value="1">Books</option>
					<option value="2">Journal</option>
					<option value="3">Newspaper</option>
					<option value="4">Report</option>
					<option value="5">Research</option>
					<option value="6">Thesis</option>
				</select>
					<br />
				</div>

			<div class="form-inline">
					<div class="col-md-12"><label for="Title"></label>
					<button type="submit" class="btn btn-info" >Save</button> &nbsp;
					<button type="button" class="btn btn-default" onclick="skip()">Skip</button>
					</div>
				
			</div>

				</div>
			</div>
			</div>

		<div class="row" id="books"  style="display:none;">
			<div class="col-md-12">
				<form class="form" id="frm-books">
					
				</form>
			</div>
		</div>
	<div class="row" id='thesis' style="display:none;">
		<div class="col-md-12">
		<form class="form " id="frm-thesis" style="display: none;" action="../post/save" method="post">
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
					width: 95%;
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
			<h2>Other information <span style='font-size:14px;'>(optional)</span></h2>
				<div class="panel-heading">
					<label>Researcher <a href="javascript:void(0)" class="btn btn-default btn-more" title="Add Add more..." onclick="addmore('researcher')">Add more...</a></label>
					<div id="msgresearcher" style="display: inline-block;"></div>
				</div>
				<div class="panel-body">
					<div class="col-md-12"  id="divresearcher">
						
					<label>Name of researcher</label>
					<input type="text" class="form-control" name="researcher[]" id="researcher" placeholder="Type researcher full name" onkeyup="names(this.id);" autocomplete="off">
					<ul class="ul-on-input" id="ul-on-input-researcher"></ul>
				
					<label>Position / title </label><input type="text" class="form-control" name="researcher-position[]" id="researcher-position" placeholder="Type researcher position or NA" autocomplete="off">
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
						
					<label>Name of committee</label><input type="text" class="form-control" name="committee[]" id="committee" placeholder="Type committee full name" onkeyup="names(this.id)" autocomplete="off">
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
						
					<label>Name of panel</label><input type="text" class="form-control" name="panel[]" id="panel" placeholder="Type panel full name" onkeyup="names(this.id)" autocomplete="off">
					<ul class="ul-on-input" id="ul-on-input-panel"></ul>
				
					<label>Position / title </label><input type="text" class="form-control" name="panel-position[]" id="panel-position" placeholder="Type panel position or NA">
					</div>
				</div>

			</div>

			


			<div class="panel">
				<!--div class="panel-heading"><label>Rating</label></div>
				<div class="panel-body">
					<div class="col-md-12">
						
			<div class="form-group">
				<label for="Title"></label>
				<input type="number" max="5" class="form-control" name="rating" id="rating" placeholder='Type rating here...'>
			</div>
					</div-->
			<div class="panel-body">
			<div class="form-inline">
					<div class="col-md-12"><label for="Title"></label>
					<button type="submit" class="btn btn-info" >Save</button> &nbsp;
					<button type="button" class="btn btn-default" onclick="skip()">Skip</button>
					</div>
				
			</div>
			</div>
			</div>
		</form>

		</div>
	</div>
	</div>
	</div>
</div>	
	</div>
</div>	
<script type="text/javascript">

function resetall(){

	if (confirm('This will clear all your unsave data,are you sure?')) {
    // Save it!
    clearall();
} else {
    // Do nothing!
}
			

}

function clearall (argument) {
	
	document.getElementById("frmpost").reset();
	document.getElementById("frm-other-info").reset();
	cleartags('tags');
	cleartextarea('contents');
	$('#frmpost').show('slow');
	$('#frm-other-info').hide('fast');

	$( '#filez' ).addClass('alert-warning');
	$( '#filez' ).removeClass('alert-info');
	$('.response').html('');
}

function skip(){

	if (confirm('This action will skip and return to add resource form, click Ok to continue...?')) {
    // Save it!
	document.getElementById("frmpost").reset();
	//document.getElementById("frm-other-info").reset();
	cleartags('tags');
	cleartextarea('contents');
	$('#frmpost').show('slow');
	$('#other-info').hide('fast');

	$( '#filez' ).addClass('alert-warning');
	$( '#filez' ).removeClass('alert-info');
	$('.response').html('');
} else {
    // Do nothing!
}
			

}
	function cleartags (id) {
		// body...
		$("#"+id).tagsinput('removeAll');
	}

	function cleartextarea (id) {

		$("#"+id).each(function() {
        if (
            $(this).summernote('isEmpty') || 
            $(this).val() == '<p dir="auto"><br></p>' ||
            // this is needed in some rare cases, 
            // ex. validating inputs when updating an entry in laravel ""
           !$('.note-editable > p').html('<br>')
           ) {
            $(this).val('');
        }
    	});
	}

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
    				console.clear();
    				console.log(resp);

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
	
 $( '#filez' ).on('change',function(){

			$( '#filez' ).addClass('alert-info');
			$( '#filez' ).removeClass('alert-warning');
			var filez =$('#filez').val();
			if(filez == ''){

			$( '#filez' ).addClass('alert-warning');
			$( '#filez' ).removeClass('alert-info');
			}
 })
	$('#frmpost').on('submit',function(e){
		e.preventDefault();

		var frmdata = new FormData();
		//var data = $('#frmpost').serialize();

		var title = $('#title').val();
		var desc = $('#contents').summernote('code');//$('#title').val();
		var tags =  $('#tags').val();
		var sfile = $( '#filez' ).val() ;
		var file = $( '#filez' )[0].files[0] ;

		if (sfile == '') {

			$('.response').html('<div class="alert alert-danger">Please upload file.</div>');
			 $( '#filez' ).removeClass('alert-info');
			 $( '#filez' ).addClass('alert-warning');
			return false;
		}else{
			$('.response').html('');
			$( '#filez' ).addClass('alert-info');
			$( '#filez' ).removeClass('alert-warning');
			
		};

    	frmdata.append( 'filez', file);
		frmdata.append('title',title);
		frmdata.append('contents',desc);
		frmdata.append('tags',tags);
		frmdata.append('group-privacy',$('#group-privacy').val());
		frmdata.append('group-category',$('#group-category').val());
		frmdata.append('group-course',$('#group-course').val());
		frmdata.append('months',$('#months').val());
		frmdata.append('days',$('#days').val());
		frmdata.append('years',$('#years').val());
		/*
  		console.log(desc);
  		return false;
  		//*/
  		
  		var i = 0;
		$.ajax({
			type: 'post',
			//dataType: 'json',
			url: '<?=site_url('file/save_resource');?>',
			data: frmdata,
        		processData: false,
  				contentType: false,
  			 beforeSend: function() {
        	// setting a timeout

        			$('#frmpost').hide('slow');
					
			        $('.upload').html('Upload on progress...<br /><img style="width:95%;height:80vh;position:absolute;opacity:0.7;z-index:999;" src="<?=base_url();?>public/images/upload_circling.gif" />');
			        i++;
			    },
			success: function (resp) {
			    $('.upload').html('');
				console.clear()
				console.log(resp);
				var data;
				if(data = JSON.parse(resp)){


				if (data.stats == true) {
					$('#slug').val(data.slug);
					$('.response').html('<div class="alert alert-success">Post successfully added.</div>');
					$('#frmpost').hide('slow');
					$('#other-info').show('slow');

						setTimeout(function () {
						$('#researcher').focus();
						},2000);


				}else{
  					$('#frmpost').show('slow');
					$('.response').html('<div class="alert alert-danger">'+data.msg+'</div>');
				}
			}else{  
					$('#frmpost').show('slow');

					$('.response').html('<div class="alert alert-danger">Unknown error.</div>');
			
				
			}
			},
  			 complete: function() {
        	// setting a timeouti--;
			        if (i <= 0) {
			            $('.upload').html('');
			        }
			    },
			   error: function(){
			   	$('#frmpost').show('slow');

					$('.response').html('<div class="alert alert-danger">Unknown error.</div>');
			
			   }
		});

		return false;
	});

	$('#frm-other-info').on('submit',function(e){

		if($('#researcher').val()=='' && $('#panel').val()==''  && $('#committee').val()=='' ){
				if (confirm("Oops! seems like you don't have any other information entered, click Cancel to enter data.")) {
    // Save it!
				    clearall();
				}
			return false;
		}
		//return true;
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
		//$('.tm-input').tagsManager('empty');
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
    },
    height:150
});


</script>