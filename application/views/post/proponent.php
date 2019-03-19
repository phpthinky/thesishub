<div class="col-sm-12 col-md-12 col-lg-12">

	<?php print(isset($content) ? $content : "Nothing to display here."); ?>


<form class="form" id="frmpost" name="frmpost" action="" method="post">
	<div class="form-group">
		<div class="response"></div>
	</div>
	<div class="form-group">
		<label for="Title">Title</label><input type="text" class="form-control" name="posttitle" id="posttitle" placeholder="Enter title here" required>
	</div>
	<div class="form-group">
		<label for="Title">Tags</label><input type="text" class="form-control" name="posttag" id="posttag" placeholder='Enter tag separate by comma'>
	</div>

	<div class="form-group">
		<label for="Title">Group</label><select class="form-control" name="selectgroup" id="selectgroup">
			<?php 
				foreach ($listgroup as $key) {
					# code...
					if($key->id <> 1){
					echo "<option value='$key->id'>$key->name</option>";

					}
				}
			?>
		</select> 
	</div>


	<div class="form-inline">
	<input type="submit" class="btn btn-success" name="btnsubmit" id="btnsubmit" value="Save">
	</div>
	</div>

</form>

</div>

<script>
  $(function () {
      editor = new nicEditor({fullPanel : false}).panelInstance('postcontent');
  })

  $(window).resize(function() {
     editor.removeInstance('postcontent'); 
     editor = new nicEditor({fullPanel : false}).panelInstance('postcontent');
  });

  $('#btnpdf').on('click',function(){
  	$('#textareafield').addClass('hidden');
  	$('#uploadpdffield').removeClass('hidden');
  	$('#btnpdf').hide();

  	$('#btntextarea').removeClass('hidden');


  	return false;
  });


  $('#btntextarea').on('click',function(){
  	$('#textareafield').removeClass('hidden');
  	$('#uploadpdffield').addClass('hidden');
  	$('#btnpdf').show();

  	$('#btntextarea').addClass('hidden');


  	return false;
  });

  $(function(){
  	$('#frmpost').on('submit',function(){
  		var nicE = new nicEditors.findEditor('postcontent');
		var contents = nicE.getContent();
		var	 title = $('#posttitle').val();
		var tags = $('#posttag').val();
		var group = $('#selectgroup').val();
    	var data = "title="+title+"&tags="+tags+"&group="+group+"&contents="+contents;

  		//alert(contents+title+tags+group);


  					$.ajax({
						type: 'post',
						url: '<?=site_url("post/save");?>',
						data: data,
						success: function(response){
							console.log(response);
							if(response === 'save'){
            					$('.loader').hide();//return false;
								$('.response').html('<p class="alert alert-success">Hurray! Post added successfully.</p>');

							}else{
            					$('.loader').hide();//return false;
								$('.response').html('<p class="alert alert-danger">Warning! '+response+'</p>');
							}


						}
					});


  		return false;
  	});
  });

</script>