<div class="row" id="resources" >
      <div class="col-md-12">
      <form class="form" id="frmresources" accept="" method="post"   enctype="multipart/form-data">
      	
        <div class="div-file hidden">

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
                    <div class="upload_response"></div>

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
                    <div class="upload_response"></div>    
                    </div>
                </div>
            </div>

            
            </div>

      </div>

      <div class="col-md-12">


      <div class="form-group">
      <br />
      <input type="submit" class="btn btn-success" name="btn-next" id="btn-next" value="Upload">

      <button type="button" class="btn btn-default hidden" onclick="skipAll()">Skip</button> 
      <br />

          <div class="col-md-6 on-progress hidden" >
            
              <div style="width:100%;margin-left:10px;text-align:left;" class="upload"></div> 

              <div class="col-md-12">
                <br />
              <div class="progress" id="progress-div" width="0%"><div class="bar" id="progress-bar"></div></div>
              
              <button class="btn btn-warning" id="cancelupload">Cancel</button>
              </div>
          </div>

      </div>

    
      </div>
      </div>
      </div>
      </form>



        <div class="row save-files">
        <?php if (isset($files)): ?>
          <?php if (!empty($files)): ?>
            <?php foreach ($files as $key2): ?>
              <?php if ($key2->type == 'image'): ?>
                <div class='col-md-4 file_id_<?=$key2->id;?>' ><div class='alert alert-info' style='min-height:325px;'>
                <img  style='width:100%;height:100% !important;max-width:200px;max-height:200px;' alt='<?=$key2->newfilename;?>' src="<?=site_url('reader?file=').$key2->newfilename."&id=".$key2->id;?>"><i style='position:absolute;right:20px;top:5px;' class='btn btn-danger fa fa-remove' onclick='delete_file(<?=$key2->id;?>)'></i>
                    <p>
                            <input type='text' class='form-control' name='file_title<?=$key2->id;?>' id='file_title<?=$key2->id;?>' value='<?=!empty($key2->title) ? $key2->title : $key2->newfilename;?>' placeholder='Enter file caption title' onkeyup='savetitle(<?=$key2->id;?>,this.id)' />
                            <textarea  class='form-control' name='file_desc<?=$key2->id;?>' id='file_desc<?=$key2->id;?>' max-length='100' placeholder='Enter file caption desction' onkeyup='savecaption(<?=$key2->id;?>,this.id)'><?=$key2->caption;?></textarea>
                    </p></div></div>
              <?php endif ?>
              <?php
                  if($key2->type == 'pdf'){
                              echo "<div class='col-md-4 file_id_$key2->id' ><div class='alert alert-info' style='min-width:250px;'><img style='width:100%;max-width:200px;max-height:200px;' alt='$key2->newfilename' src='".base_url('public/images/pdf.png')."' /><i style='position:absolute;right:20px;top:5px;' class='btn btn-danger fa fa-remove' onclick='delete_file($key2->id)'></i><br />";
                              echo "<p>";
                              echo "<input type='text' class='form-control' name='file_title$key2->id' id='file_title$key2->id' value='";
                              echo !empty($key2->title) ? $key2->title : $key2->newfilename;
                              echo "' placeholder='Enter file caption title' onkeyup='savetitle($key2->id,this.id)' />";
                              echo "<textarea  class='form-control' name='file_desc$key2->id' id='file_desc$key2->id' max-length='100' placeholder='Enter file caption desction' onkeyup='savecaption($key2->id,this.id)'>$key2->caption</textarea>";
                              echo "</p></div></div>";                            
                            }

                  if(
                   $key2->type == 'word' ||
                   $key2->type == 'spreadsheet' ||
                   $key2->type == 'powerpoint'
                   ){
                      echo "<div class='col-md-4 file_id_$key2->id' ><div class='alert alert-info' style='min-width:250px;'><img style='width:100%';max-width:200px;max-height:200px;  alt='$key2->newfilename' src='".base_url('public/images/docs1.jpg')."'  /><i style='position:absolute;right:20px;top:5px;' class='btn btn-danger fa fa-remove' onclick='delete_file($key2->id)'></i><br />";
                      echo "<p>";
                              echo "<input type='text' class='form-control' name='file_title$key2->id' id='file_title$key2->id' value='";
                              echo !empty($key2->title) ? $key2->title : $key2->newfilename;
                              echo "' placeholder='Enter file caption title' onkeyup='savetitle($key2->id,this.id)' />";
                              echo "<textarea  class='form-control' name='file_desc$key2->id' id='file_desc$key2->id' max-length='100' placeholder='Enter file caption desction' onkeyup='savecaption($key2->id,this.id)'>$key2->caption</textarea>";
                              echo "</p></div></div>";
                  } 

                          if($key2->type == 'zipped'){
                                echo "<div class='col-md-4 file_id_$key2->id' ><div class='alert alert-info' style='min-width:250px;'><img style='width:100%;max-width:200px;max-height:200px;'  alt='$key2->newfilename' src='".base_url('public/images/archived.png')."'  /><i style='position:absolute;right:20px;top:5px;' class='btn btn-danger fa fa-remove' onclick='delete_file($key2->id)'></i><br />";
                                echo "<p>";
                              echo "<input type='text' class='form-control' name='file_title$key2->id' id='file_title$key2->id' value='";
                              echo !empty($key2->title) ? $key2->title : $key2->newfilename;
                              echo "' placeholder='Enter file caption title' onkeyup='savetitle($key2->id,this.id)' />";
                              echo "<textarea  class='form-control' name='file_desc$key2->id' id='file_desc$key2->id' max-length='100' placeholder='Enter file caption desction' onkeyup='savecaption($key2->id,this.id)'>$key2->caption</textarea>";
                              echo "</p></div></div>";

                          }
                          if($key2->type == 'video'){
                                echo "<div class='col-md-4 file_id_$key2->id' ><div class='alert alert-info' style='min-width:250px;'><video width=\"200px\" height=\"200px\" controls>".'
                              <source src="'.site_url('reader?file=').$key2->newfilename.'&id='.$key2->id.'" type="'.$key2->mtype.'">
                              </video>'."<i style='position:absolute;right:20px;top:5px;' class='btn btn-danger fa fa-remove' onclick='delete_file($key2->id)'></i><br />";;
                                echo "<p>";
                              echo "<input type='text' class='form-control' name='file_title$key2->id' id='file_title$key2->id' value='";
                              echo !empty($key2->title) ? $key2->title : $key2->newfilename."' placeholder='Enter file caption title' onkeyup='savetitle($key2->id,this.id)' />";
                              echo "<textarea  class='form-control' name='file_desc$key2->id' id='file_desc$key2->id' max-length='100' placeholder='Enter file caption desction' onkeyup='savecaption($key2->id,this.id)'>$key2->caption</textarea>";
                              echo "</p></div></div>";

                          }

                          
              ?>
            <?php endforeach ?>
          <?php endif ?>
        <?php endif ?>
        </div>

</div>

<script type="text/javascript">
	var	selected = 0;
  var btnInput;
  var title_a;

function savetitle(id,title){
  console.clear();
  var title_v = $('#'+title).val();
  var frmdata = 'title='+title_v+'&id='+id;
  setTimeout(function () {
    // body...
    $.ajax({
      type: 'post',
      url: '<?=site_url('file/save_captions');?>',
      data: frmdata,
      success: function (resp) {
        console.clear();
        console.log(resp);
      }

    });
  },1500);
}
function savecaption(id,caption){
  console.clear();
  var caption_v = $('#'+caption).val();
  var frmdata = 'caption='+caption_v+'&id='+id;
  setTimeout(function () {
    // body...
    $.ajax({
      type: 'post',
      url: '<?=site_url('file/save_captions');?>',
      data: frmdata,
      success: function (resp) {
        console.clear();
        console.log(resp);

      }

    });
  },1500);
}

function delete_file(id){
  console.clear();
  var frmdata = 'id='+id;
  setTimeout(function () {
    // body...
    $.ajax({
      type: 'post',
      url: '<?=site_url('file/remove_file');?>',
      data: frmdata,
      success: function (resp) {
        console.log(resp);
        $('.file_id_'+id).remove()

      }

    });
  },300);
}

 $( '#filez' ).on('change',function(){

      $( '#filez' ).addClass('alert-info');
      $( '#filez' ).removeClass('alert-warning');
      var filez =$('#filez').val();
      if(filez == ''){

      $( '#filez' ).addClass('alert-warning');
      $( '#filez' ).removeClass('alert-info');
      }
 });
 


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
    frmdata.append('post_id','<?php echo $this->input->get('id'); ?>');

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
              $('.upload_response').html('<div class="alert alert-success">'+data.msg+' </div>');
              setTimeout(function(){

              $('#'+btnInput).val('') ;
              },2000);

          }else{

               $('.upload_response').html('<div class="alert alert-danger">'+data.msg+'</div>');
              setTimeout(function(){
                 $('.upload_response').html('');
              },10000);
          }

        }else{

          $('.upload_response').html('<div class="alert alert-danger">Unknown error.</div>');
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

<script type="text/javascript">
  function add_file() {
    // body...

    if($('.div-file').hasClass('hidden')){

      $('.div-file').removeClass('hidden');
      $('.save-files').addClass('hidden');
      return false;
    }
  }

</script>