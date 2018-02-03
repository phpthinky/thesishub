<form class="form" id="frmpost" name="frmpost" action="<?=site_url('post/save_abstract');?>" method="post">
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
      <div class="col-md-6">
        <div class="form-group">
          <label for="Title">Privacy</label><select class="form-control" name="group_privacy" id="group_privacy">
            
            <option value="1">Private - only registered user</option>
            <option value="2">Public - all user</option>
            <option value="3">Limited - only staff </option>
          </select> 
        </div>
      </div>

      <div class="col-md-6">
        <div class="form-group">
          <label for="Title">Course</label><select class="form-control" name="group_course" id="group_course">
            
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
        <select  class="form-control hidden" name='days' id='days' style="width:25%;min-width:95px;" >
          
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
          <label>Book no.</label>
          <input type="text" class="form-control" name="bookno" id="bookno"  autocomplete="off">
        </div>
      </div>

      <div class="col-md-6">
        <div class="form-group">
    <label>Is this study utilized? </label><br />
      <div class='radio-inline'>
      <label><input type='radio' name='implemented' id='implemented-y' value='yes' >Yes</label>
      </div>

      <div class='radio-inline'>
        <label><input type='radio' name='implemented' id='implemented-n' value='no'>No</label>
      </div>
      <div class='radio-inline'>
        <label><input type='radio' name='implemented' id='implemented-n' value='na' checked>NA</label>
      </div>
        </div>
      </div>
        
      <div class="col-md-6">
    

      <div class="form-group">
      <br />
      <input type="submit" class="btn btn-success" name="btn-next" id="btn-next" value="NEXT >>">
      <button type="button" class="btn btn-warning" onclick="resetall()">Clear</button> 
      <br />


      </div>
      <div class="col-md-6">
        <div class="response-1"></div>
      </div>
    
      </div>

    </form>

<script type="text/javascript" src='<?=base_url("assets/plugin/notify/notify.min.js");?>'></script>

<script type="text/javascript">
  $("#bookno").on('keyup',function () {
    // body...

    var bookno = $(this).val();

    setTimeout(function(){

    show_notify('bookno',bookno);
      
    },2000);

  });

   $("#title").on('keyup',function () {
    // body...

    var title_v = $(this).val();

    setTimeout(function(){

    show_notify('title',title_v);
      
    },2000);

  });

   function show_notify(id,value) {

    var link;

    if (id == 'title') {
      link = 'is_title';
    }
    if (id == 'bookno') {
      link = 'get_book_no';
    }
      $.ajax({
        type: 'post',
        data: id+'='+value,

        url: '<?=site_url("post/");?>'+link,

        dataType : 'json',
        success: function(resp){
        //  console.log(resp);
          if (resp.stats == true) {

            $("#"+id).notify("Available","success");

          }else{

            $("#"+id).notify("Not available","danger",
            {
              autoHideDelay: 10000
            });
          }


        },
        error: function(){
            //$(this).notify("Book no not available","danger");
            //alert('Error');
            return false;
        }
      });
   }
</script>
    <script type="text/javascript">

  $('#contents').summernote({
    callbacks: {
        onPaste: function (e) {
            var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
            e.preventDefault();
            document.execCommand('insertText', false, bufferText);
        }
    },
    height:100,
    toolbar: [
      ['style', ['highlight', 'bold', 'italic', 'underline', 'clear','color']],
      ['font', ['strikethrough', 'superscript', 'subscript']],
      ['para', ['ul', 'ol', 'paragraph']],
    ['table', ['table']],
    ['insert', ['link']],
      ['view', ['codeview']]
    ]
});

function resetall(){

  if (confirm('This will clear all your unsave data,are you sure?')) {
    // Save it!
    clearall();
} else {
    // Do nothing!
}
      

}

function clearall (argument) {
  
$('form').each(function() { this.reset() });
  cleartags('tags');
  cleartextarea('contents');
  $('#frmpost').show('slow');
  $('#other-info').hide('fast');

  $( '#filez' ).addClass('alert-warning');
  $( '#filez' ).removeClass('alert-info');
  $('.response').html('');
}


 </script>


 <script type="text/javascript">

  $('#frmpost').on('submit',function(e){

//return true;
    e.preventDefault();


    var frmdata = new FormData();
    var data = $('#frmpost').serialize();
    var i = 0;
    var percentComplete;
    //console.clear();
    //console.log(data);
    //return false;

    var content = $('#contents').summernote('code');
    if(content.length < 10 || content === '<p><br></p>'){
      $('.response').addClass('alert alert-danger');
      $('.response').html('Abstract/Description field is required');

        setTimeout(function(){
      $('.response').removeClass('alert alert-danger');
           $('.response').html('');
        },5000);
     return false;

    }

    $.ajax({

      type: 'post',
      dataType: 'json',
      url: '<?=site_url('post/save_abstract');?>',
      data: data,

  		beforeSend: function() {
        	// setting a timeout
        			$('.abstract').hide('slow');	
          			$('.upload').html('processing...');				
			        i++;
			    },
      	success: function (resp) {
        $('.upload').html('');
       // console.clear()
        //console.log(resp);


        if (resp.stats == true) {
          $('#slug').val(resp.slug);
          $('#post_id').val(resp.post_id);
          $('input[name=post_id]').val(resp.post_id);

          $('.response').html('<div class="alert alert-success">Post successfully added.</div>');
          
          show_others_menu(true);
          show_author();


        }else{
          $('.abstract').show('slow');
          $('.response').html('<div class="alert alert-danger">'+resp.msg+'</div>');
        }
        setTimeout(function(){
        	 $('.response').html('');
        },5000);
      },
         complete: function() {
          // setting a timeouti--;
              if (i <= 0) {
                  $('.upload').html('');     

              }
          }
    });

    return false;
  });

</script>

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
  window.location = '<?=site_url("file/add");?>'
 }
 $('#cancelupload').on('click',function(){
  if(confirm('Warning! Your upload session will be aborted. Click OK to continue...')){
    
  xhr.abort();
  }
 });

</script>