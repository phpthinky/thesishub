
        <link href="<?=base_url();?>assets/plugin/summernote/summernote.css" rel="stylesheet">
        <link href="<?=base_url();?>assets/plugin/bootstrap-tagsinput/dist/bootstrap-tagsinput.css" rel="stylesheet">
        
        <script src="<?=base_url();?>assets/plugin/bootstrap-tagsinput/dist/bootstrap-tagsinput.js" type="text/javascript"></script>
        <script src="<?=base_url();?>assets/plugin/summernote/summernote.js" type="text/javascript"></script>
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
          z-index: 99;
        }
        ul.ul-on-input > li{

          padding: 4px;
        }
        ul.ul-on-input > li:hover{
          background-color: #4543a9;
          color: #fff;
          cursor: pointer;
}
.response{
  text-align: left;
}
.progress 
{
  display:none; 
  position:relative; 
  width:400px; 
  border: 1px solid #ddd; 
  padding: 1px; 
  border-radius: 3px; 
}
.bar 
{ 
  background-color: red; 
  width:0%; 
  height:20px; 
  border-radius: 3px; 
}
.color-10{

  background-color: #DC020C ; 
}

.color-25{

  background-color: #DC0247   ; 
}

.color-50{

  background-color: #FF5733 ; 
}

.color-75{

  background-color: #0268DC ; 
}

.color-100{

  background-color: #02DC51   ; 
}


.percent 
{ 
  position:absolute; 
  display:inline-block; 
  top:3px; 
  left:48%; 
}
.btn.btn-files{
  display: none;
}
</style>


    <!-- Main Content -->
  <div class="container">
  <div class="col-md-9">
  <h3 style="display: inline-block;"><?php echo isset($title) ? $title : "Portal"; ?></h3>
  </div>
  <div class="col-md-9">
          <div class="response"></div>
        </div>
        <div class="div-form abstract" id="option-default" style="display:block;">
        <?php include 'abstract.php'; ?>
          
        </div>
        <div class="div-form resource" id="option-resource"  style="display:none;">
        <?php include 'resources.php'; ?>
          
        </div>
        <div class="div-form other-info col-md-12" id="option-6" style="display:none;">
        <button class="btn btn-success" onclick="skipAll()">Skip &amp; Done</button>
        </div>

        <div class="div-form other-info col-md-12" id="option-7" style="display:none;">
        <button class="btn btn-success" onclick="skipAll()">Done</button>
        </div>
        <div class="div-form other-info col-md-12" id="option-8" style="display:none;">
        <button class="btn btn-success" onclick="skipAll()">Done</button>
        </div>
        <div class="div-form other-info col-md-12" id="option-9" style="display:none;">
        <button class="btn btn-success" onclick="skipAll()">Done</button>
        </div>
        <div class="div-form other-info col-md-12" id="option-10" style="display:none;">
        <button class="btn btn-success" onclick="skipAll()">Done</button>
        </div>
        <div class="div-form other-info col-md-12" id="option-11" style="display:none;">
        <button class="btn btn-success" onclick="skipAll()">Done</button>
        </div>
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

    <script type="text/javascript">
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
  function skipAll () {
  // body...
/*
  $('form').each(function() { this.reset() });
  cleartags('tags');
  cleartextarea('contents');
  $('.other-info').hide('fast');
  $('.resource').hide('fast');
  $('.abstract').show('slow');
  */
  window.location = '<?=site_url("user/directory");?>'
 }
 $('#cancelupload').on('click',function(){
  if(confirm('Warning! Your upload session will be aborted. Click OK to continue...')){
    
  xhr.abort();
  }
 });
  </script>