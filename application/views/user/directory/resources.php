<div class="row col-md-9" id="resources">
	<h4>Upload file</h4>
      <div class="col-md-12">
      <form class="form" id="frmresources" accept="" method="post"   enctype="multipart/form-data">
      	
<div class="form-group">
          <label for="Title">File Category</label>
          <select class="form-control" name="group_category" id="group_category">            
					<option value="0">--- SELECT HERE ---</option>
					<option value="6">Student Thesis (pdf,word etc.)</option>
					<option value="2">Journal (pdf,word etc.)</option>
					<!--option value="1">Books</option>
					<option value="3">Newspaper</option>
					<option value="4">Report</option>
					<option value="5">Research</option -->
					<option value="8">Video (mp4)</option>
					<option value="9">Image (jpeg,png,tif,gif)</option>
					<option value="7">Personal (others)</option>
					<option value="11">Archived (zip/rar)</option>
					<option value="10">Others (others)</option>
          </select> 
        </div>
      </div>
      <div class="col-md-12">
      <input type="hidden" name="post_id" id="post_id" value="0">
      <div class="form-group">

        <input type="file" name="image[]" id="image" class="btn btn-warning btn-files" accept="image/*" multiple>
       	<input type="file" name="video[]" id="video" class="btn btn-warning btn-files" accept="video/*" multiple>
       	<input type="file" name="docs[]" id="docs" class="btn btn-warning btn-files" accept="application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint,
 application/pdf,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.openxmlformats-officedocument.presentationml.presentation" multiple>
       	<input type="file" name="zipped[]" id="zipped" class="btn btn-warning btn-files" accept="application/x-rar,application/zip" multiple>
       	<input type="file" name="others[]" id="others" class="btn btn-warning btn-files" multiple>

       	<div class="note"></div>
       	
      </div>

      </div>

      <div class="col-md-6">
    

      <div class="form-group">
      <br />
      <input type="submit" class="btn btn-info" name="btn-next" id="btn-next" value="Save and continue >>">
      <button type="button" class="btn btn-default" onclick="skip1()">Skip</button> 
      <button type="button" class="btn btn-default" onclick="skipAll()">Skip all</button> 
      <br />


      </div>

    
      </div>
      </form>
        

</div>

<script type="text/javascript">
	var	selected = 0;
	var btnInput;
 $( '#filez' ).on('change',function(){

      $( '#filez' ).addClass('alert-info');
      $( '#filez' ).removeClass('alert-warning');
      var filez =$('#filez').val();
      if(filez == ''){

      $( '#filez' ).addClass('alert-warning');
      $( '#filez' ).removeClass('alert-info');
      }
 });
function skip1 () {
	// body...
	if(selected == 0){
		$('.response').html('<div class="alert alert-warning">Please select file category first.</div>');

        setTimeout(function(){
        	 $('.response').html('');
        },5000);
		return false;
	}
  	$('.div-form').hide('fast');
	$('#option-'+selected).show('slow');
}
 
	$('#group_category').on('change',function(){
		selected = $(this).val();
		var note = $('.note');
		//alert(selected);
		console.clear();
		switch(parseInt(selected)){
			case 2:
			$('.btn-files').hide('fast');
			$('#docs').show('slow');
			note.html('Please select PDF, MS Application file only.');
			btnInput = 'docs';
			break;
			case 6:
			$('.btn-files').hide('fast');
			$('#docs').show('slow');
			note.html('Please select PDF, MS Application file only.');
			btnInput = 'docs';
			break;
			case 7:
			$('.btn-files').hide('fast');
			$('#others').show('slow');
			note.html('Please select Video,Image, PDF, MS Application file only.');
			btnInput = 'others';
			break;
			case 8:
			$('.btn-files').hide('fast');
			$('#video').show('slow');
			note.html('Please select MP4 video file only.');
			btnInput = 'video';
			break;
			case 9:
			$('.btn-files').hide('fast');
			$('#image').show('slow');
			note.html('Please select jpeg,png,gif file only.');
			btnInput = 'image';
			break;
			case 10:
			$('.btn-files').hide('fast');
			$('#others').show('slow');
			note.html('Please select Video,Image, PDF, MS Application file only.');
			btnInput = 'others';
			break;
			case 11:
			$('.btn-files').hide('fast');
			$('#zipped').show('slow');
			note.html('Please select Video,Image, PDF, MS Application file only.');
			btnInput = 'zipped';
			break;
			default:
			$('.btn-files').hide('fast');
			$('#others').show('slow');
			note.html('Please select Video,Image, PDF, MS Application file only.');
			btnInput = 'others';
			break;
		}

	});
</script>

<script type="text/javascript">

    var xhr;
	$('#frmresources').on('submit',function(){

		var frmdata = new FormData();
		var sfile = $('#'+btnInput).val() ;
		var file = $('#'+btnInput);
		///alert(btnInput);return false;
		var ins = document.getElementById(btnInput).files.length;
		for (var x = 0; x < ins; x++) {
		    frmdata.append(btnInput+"[]", document.getElementById(btnInput).files[x]);
		}
		frmdata.append('btnInput',btnInput);
		frmdata.append('post_id',$('#post_id').val());

		if (sfile == '') {

			$('.response').html('<div class="alert alert-danger">Please upload file.</div>');
			 $( '#'+btnInput ).removeClass('alert-info');
			 $( '#'+btnInput ).addClass('alert-warning');
			return false;
		}else{
			$('.response').html('');
			$( '#'+btnInput ).addClass('alert-info');
			$( '#'+btnInput ).removeClass('alert-warning');
			
		};


	  var i = 0;
    var percentComplete;
          $('.on-progress').removeClass('hidden');
    $.ajax({
    	xhr: function() {
          $('#frmpost').hide('slow');
                xhr = new window.XMLHttpRequest();

                xhr.upload.addEventListener("progress", function(evt) {
                  if (evt.lengthComputable) {
                    percentComplete = evt.loaded / evt.total;
                    percentComplete = parseInt(percentComplete * 100);
                    $('.upload').html('Upload on progress with '+percentComplete+' % to complete.');
                    //console.log(percentComplete);
                   
                    $(".progress").show('fast');
                    $(".progress").width('100%');
                    $(".bar").width(percentComplete +'%')
                    
                    if (percentComplete < 10) {
                      $('.upload').addClass('alert-danger');
                    $(".bar").addClass('color-10');
                    }
                    if (percentComplete >=10 && percentComplete < 25) {
                      $('.upload').removeClass('alert-danger');
                    $(".bar").removeClass('color-10');
                    $(".bar").addClass('color-25');
                    }
                    if (percentComplete >= 25 && percentComplete < 50) {
                      $('.upload').removeClass('alert-danger');
                      $('.upload').addClass('alert-warning');
                    $(".bar").removeClass('color-25');
                    $(".bar").addClass('color-50');
                    }
                    if (percentComplete >= 50 && percentComplete < 75) {
                      $('.upload').removeClass('alert-warning');
                      $('.upload').addClass('alert-info');
                    $(".bar").removeClass('color-50');
                    $(".bar").addClass('color-75');
                    }
                    if (percentComplete === 100) {
                      $('.upload').removeClass('alert-info');
                      $('.upload').addClass('alert-success');
                      $('.upload').html('proccessing...');
                    $(".bar").removeClass('color-75');
                    $(".bar").addClass('color-100');

                    }

                  }
                }, false);

                return xhr;
         },
      type: 'post',
      url: '<?=site_url('file/save_file');?>',
      data: frmdata,
      processData: false,
      contentType: false,
      success: function (resp) {
          $('.upload').html('');
          $('.on-progress').addClass('hidden');

        console.clear();

        var data;
        if(data = JSON.parse(resp)){


            if (data.stats == true) {
              $('.response').html('<div class="alert alert-success">'+data.msg+'</div>');
              setTimeout(function(){
                $('.div-form').hide('fast');
                $('#option-'+parseInt(selected)).show('slow');
              },2000);

          }else{

              $('.response').html('<div class="alert alert-danger">'+data.msg+'</div>');
              setTimeout(function(){
                 $('.response').html('');
              },10000);
          }

        }else{

          $('.response').html('<div class="alert alert-danger">Unknown error.</div>');
        }

       
      },
         complete: function() {
              if (i <= 0) {
                      $('.upload').removeClass('alert-success');
                      $('.upload').removeClass('btn');
                  $('.upload').html('');
                  
                  $('.progress').hide('fast');
               $('.on-progress').addClass('hidden');

              }
          }
    });
    	return false;
	});
</script>