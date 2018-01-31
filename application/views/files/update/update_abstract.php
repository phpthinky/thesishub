<form class="form" id="frmpost" name="frmpost" action="<?=site_url('file/update_abstract');?>" method="post">
      <div class="col-md-12">
      <div class="form-group">
      <input type="hidden" id="edit_id" name="edit_id" value="<?=$infos[0]->page_id;?>">
        <label for="Title">Title</label><input type="text" class="form-control" name="title" id="title" placeholder="Type title here" value="<?=isset($infos[0]->title) ? $infos[0]->title :"";?>" autocomplete="off"   required>
      </div>

      <div id='textareafield' class="">
      <div class="form-group">
        <label for="Title">Abstract/Description <i class='btn fa fa-undo' style='color:dodgerblue' onclick='cleartextarea("contents")' title='Clear abstract/description'></i></label>
        <textarea name="contents"  id="contents" style="width:100%;height:100px;"  placeholder="Type abstract here"><?=isset($infos[0]->description) ? $infos[0]->description :"";?></textarea>
      </div>
      </div>


      <div class="form-group">
        <label for="Title">Keyword<i class='btn fa fa-undo' style='color:dodgerblue' onclick='cleartags("tags")' title='Clear all tags'></i></label><br/> 
        <input type="text" class="form-control"  data-role="tagsinput" name="tags" id="tags" value="<?=isset($tags) ? $tags :"";?>" placeholder='Type here and press Enter' autocomplete="off"  style='min-width:200px;'>
        <div id="listoftags" class="listoftags"></div>
      </div>

      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label for="Title">Privacy</label><select class="form-control" name="group_privacy" id="group_privacy">
            
            <option value="1"   <?=($infos[0]->status == 1) ? 'selected' : '';?>>Private - only registered user</option>
            <option value="2"  <?=($infos[0]->status == 2) ? 'selected' : '';?>>Public - all user</option>
            <option value="3"  <?=($infos[0]->status == 3) ? 'selected' : '';?>>Limited - only staff </option></select> 
        </div>
      </div>

      <div class="col-md-6">
        <div class="form-group">
          <label for="Title">Course</label><select class="form-control" name="group_course" id="group_course">
            
            <?php 
              foreach ($listgroup as $key) {
                # code...
                echo "<option value='$key->id'";
                echo ($key->id == $infos[0]->group_course) ? 'selected' : '';
                echo ">$key->name</option>";

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


        foreach ($months as $key) {
          # code...
            $iscurrent = ($key['id'] == $infos[0]->months) ? 'selected' :'';
            echo "<option value='".$key['id']."' $iscurrent>".$key['name']."</option>";
        }
        ?>
        </select> 
        
        <select  class="form-control" name='days' id='days' style="width:25%;min-width:95px;" >
          
        <?php
        for ($i=1; $i <=31; $i++) { 
          # code...
          echo "<option value ='$i'";
          
            echo $iscurrent = ($i == $infos[0]->days) ? 'selected' :'';
          echo ">$i</option>";
        }
        ?>
        </select>
        
        <select class="form-control" name="years" id="years"  style="width:25%;min-width:95px;">
          <?php 
          $currentY = date('Y');
          for ($i=1912; $i <= $currentY; $i++) { 
            # code...
            $iscurrent = ($i == $infos[0]->years) ? 'selected' :'';
            echo "<option value='$i' $iscurrent>$i</option>";

          }
          ?>
        </select> 
        </div>
        
      </div>  

      <div class="col-md-6">
        <div class="form-group">

        <label>Is this study implemented? </label><br />
          <div class='radio-inline'>
          <label><input type='radio' name='implemented' id='implemented-y' value='yes' <?php if($infos[0]->implemented == 'yes'){echo 'checked';} ?> >Yes</label>
          </div>

          <div class='radio-inline'>
          <label><input type='radio' name='implemented' id='implemented-n' value='no' <?php if($infos[0]->implemented == 'no'){echo 'checked';} ?>>No</label>
      </div>
        </div>
    </div>
        
      <div class="col-md-6">
    

      <div class="form-group">
      <br />
      <input type="submit" class="btn btn-info" name="btn-next" id="btn-next" value="Save and continue >>">
      <button type="button" class="btn btn-warning" onclick="resetall()">Clear</button> 
      <button type="button" class="btn btn-default" onclick="skipme()">Skip</button>
      <br />


      </div>

    
      </div>

    </form>


    <script type="text/javascript">

  $('#contents').summernote({
    callbacks: {
        onPaste: function (e) {
            var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
            e.preventDefault();
            document.execCommand('insertText', false, bufferText);
        }
    },
    height:100
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


    e.preventDefault();


    var frmdata = new FormData();
    var data = $('#frmpost').serialize();
    var i = 0;
    var percentComplete;

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
      url: '<?=site_url('file/update_abstract');?>',
      data: data,

  		beforeSend: function() {
        	// setting a timeout
        			$('.abstract').hide('slow');	
          			$('.upload').html('processing...');				
			        i++;
			    },
      	success: function (resp) {
        $('.upload').html('');
        console.clear()
        console.log(resp);


        if (resp.stats == true) {
          $('#slug').val(resp.slug);
          $('#post_id').val(resp.post_id);

          $('.response').html('<div class="alert alert-success">Post successfully added.</div>');
          $('.abstract').hide('fast');
          $('.resource').show('slow');

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