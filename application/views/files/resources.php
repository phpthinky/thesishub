<div class="row" id="resources" >
	<h4>Upload file</h4>
      <div class="col-md-12">
      <form class="form" id="frmresources" accept="" method="post"   enctype="multipart/form-data">
      	

      <div class="form-group">
          <label for="Title">File Category</label>
        <input type="hidden" name="post_id" id="post_id" value="0">


          <ul class="nav nav-tabs">
          <li class="active"><a data-toggle="tab" href="#welcome" id="li_pdf">PDF</a></li>
          <li><a data-toggle="tab" href="#header" id="li_photo">PHOTO</a></li>
        </ul>


        <div class="tab-content">
          <div id="welcome" class="col-md-12 tab-pane fade in active">
            <div class="panel">
              <div class="panel-heading"><h3>PDF</h3></div>
              <div class="panel-body">
                <p>Please select PDF, MS Application file only.</p>

                    <input type="file" name="docs[]" id="docs" class="btn btn-warning btn-files-1" accept="application/pdf" multiple>
                    
                      <br /> <br />


              </div>
            </div>
          </div>

            <div id="header" class="col-md-12 tab-pane fade">
                <div class="panel">
                    <div class="panel-heading"><h3>PHOTO</h3></div>
                    <div class="panel-body">
                      <p>Please select jpeg,png,gif file only. </p>

                     <input type="file" name="image[]" id="image" class="btn btn-warning btn-files-1" accept="image/*" multiple>
                      <br /> <br />      
                    </div>
                </div>
            </div>

            
            </div>

      </div>


      </div>
      <div class="col-md-12">
      </div>

      <div class="col-md-6">
    

      <div class="form-group">
      <br />
      <input type="submit" class="btn btn-success" name="btn-next" id="btn-next" value="Save and continue >>">

      <button type="button" class="btn btn-default" onclick="skipAll()">Skip</button> 
      <br />

    
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
              $('.response').html('<div class="alert alert-success">'+data.msg+' </div> <button type="button" class="btn btn-success" onclick="skipAll()">Done</btn>');
              setTimeout(function(){
                $('.div-form').hide('fast');
                $('#option-end').show('slow');
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

<script type="text/javascript">
  btnInput = 'docs';
  $('#li_pdf').on('click',function(){
    btnInput = 'docs';
  });
  $('#li_photo').on('click',function(){
    btnInput = 'image';
  });
</script>