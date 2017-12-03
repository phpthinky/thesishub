<div class="col-sm-12 col-md-12 col-lg-12 create">

	<?php print(isset($content) ? $content : "Nothing to display here."); ?>


<form class="form" id="frmpost" name="frmpost" action="" method="post">
	<div class="form-group">
		<div class="response"></div>
	</div>
	<div class="form-group">
		<label for="Title">Title</label><input type="text" class="form-control" name="posttitle" id="posttitle" placeholder="Enter title here" required>
	</div>

	<div id='textareafield' class="">
	<div class="form-group">
		<label for="Title">Abstract</label><textarea name="postcontent"  id="postcontent" style="width:100%;height:100px;"  placeholder="Enter abstract here"></textarea>
	</div>
	</div>

	<div id='uploadpdffield' class="hidden">
	<div class="form-group">
		<label for="Title">Abstract</label><input type="file" class="btn alert-info" >
	</div>
	</div>

	<div class="form-group">
		<label for="Title">Tags</label><input type="text" class="form-control" name="posttag" id="posttag" placeholder='Enter tag separate by comma'>
	</div>

	<div class="form-group">
		<label for="Title">Program</label><select class="form-control" name="selectgroup" id="selectgroup">
			<?php 
				foreach ($listgroup as $key) {
					# code...
					if($key->id > 3){
					echo "<option value='$key->id'>$key->name</option>";

					}
				}
			?>
		</select> 
	</div>

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
		var_dump($months);
		//echo $m;
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




	<div class="form-inline">
	<input type="submit" class="btn btn-info" name="btnsubmit" id="btnsubmit" value="Next >>">
	<input type="submit" class="btn btn-success" name="btnabstractonly" id="btnabstractonly" value="Save &amp; Done">
	<button class="btn btn-default push-right hidden" id="btnpdf">Upload abstract in PDF</button>
	<button class="btn btn-default hidden push-right" id="btntextarea">Insert abstract in text</button>
	</div>

	<div class="form-group">
	<div class="row"><br>
	<div class="alert alert-warning">
		<p><b>Notes:</b></p>
		<p>Next >> (Click this button to continue to other information.)</p>
		<p>Save &amp; Done (Click this button to save the title and abstract only and update the other information later.)</p>
	
	</div>
	</div>
	</div>

</form>


<form class="form hidden" id="frmclients" name="frmclients" action="" method="post">

	<div class="form-group">

		<div class="response2"><label for="title"><h3></h3></label></div>
		<div class="hidden"><input type="hidden" name="savetitle" id="savetitle"></div>
		<div class="response3"></div>
	</div>

	<div class="form-group">
		<label for="Title">Client</label><input type="text" class="form-control" name="txtclient" id="txtclient" placeholder='Enter client name here or NA' required>
	</div>

	<div class="form-group">
		<label for="Title">Address</label><input type="text" class="form-control" name="txtclientaddress" id="txtclientaddress" placeholder='Enter client name here or NA' required>
	</div>


	<div class="form-inline">
	<input type="submit" class="btn btn-info" name="btnclients" id="btnclients" value="Next >>">
	<input  type="button" class="btn btn-warning" onclick="shownext(this.form,'frmproponent');" name="btnclientskip" id="btnclientskip" value="Skip >">
	<div class="loader"></div>
	</div>

</form>



<form class="form hidden" id="frmproponent" name="frmpost" action="" method="post">

	<div class="form-group">

		<div class="response4"><label for="title"><h3></h3></label></div>
		<div class="hidden"><input type="hidden" name="savetitle" id="savetitle"></div>
		<div class="response5"></div>
	</div>
	<div class="form-group" id="divproponent">
		<label for="Title">Proponent</label><input  type="text" class="form-control" name="txtproponent[]" id="txtproponent" placeholder="Enter proponent here" required><label for="Title">Position</label><input type="text" class="form-control" name="txtposition[]" id="txtposition" placeholder="Enter position here or NA" required>
		
	</div>
	<div class="form-group">
		<a href="javascript:void(0)" id="btnaddproponent" class="btn btn-default">+</a href="javascript:void();"> - add more proponent
	</div>


	<div class="form-inline">
	<input type="submit" class="btn btn-info" name="btnsubmitproponent" id="btnsubmitproponent" value="Next >>">
	<input  type="button" class="btn btn-warning" onclick="shownext(this.form,'frmcourse');" name="btnskipproponent" id="btnskipproponent" value="Skip >">
	<div class="loader"></div>
	</div>

</form>


<form class="form hidden" id="frmcourse" name="frmcourse" action="" method="post">

	<div class="form-group">

		<div class="response4"><label for="title"><h3></h3></label></div>
		<div class="hidden"><input type="hidden" name="savetitle" id="savetitle"></div>
		<div class="response5"></div>
	</div>

	<div class="form-group">
		<label for="Title">Select College</label><select class="form-control" name="selectcollege" id="selectcollege">
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
	<input type="submit" class="btn btn-info" name="btncourse" id="btncourse" value="Next >>">
	<input type="button" class="btn btn-warning" onclick="shownext(this.form,'frmcommittee');" name="btncourseskip" id="btncourseskip" value="Skip >">
	<div class="loader"></div>
	</div>

</form>


<form class="form hidden" id="frmcommittee" name="frmcommittee" action="" method="post">

	<div class="form-group">

		<div class="response4"><label for="title"><h3></h3></label></div>
		<div class="hidden"><input type="hidden" name="savetitle" id="savetitle"></div>
		<div class="response5"></div>
	</div>

	<div class="form-group" id="divproponent">
		<label for="Title">Committee name</label><input  type="text" class="form-control" name="txtcommittee[]" id="txtcommitteen" placeholder="Enter committee name here" required><label for="Title">Position</label><input type="text" class="form-control" name="txtcommitteeposition[]" id="txtcommitteeposition" placeholder="Enter position here or NA" required>
		
	</div>
	<div class="form-group">
		<a href="javascript:void(0)" id="btnaddcommittee" class="btn btn-default"><i class="fa">+</i></a href="javascript:void();"> - add more committee
	</div>


	<div class="form-inline">
	<input type="submit" class="btn btn-info" name="btncommittee" id="btncommittee" value="Next >>">
	<input type="button" class="btn btn-warning" onclick="shownext(this.form, 'frmpanel');"  name="btncommitteeskip" id="btncommitteeskip" value="Skip >">
	<div class="loader"></div>
	</div>

</form>

<form class="form hidden" id="frmpanel" name="frmpanel" action="" method="post">

	<div class="form-group">

		<div class="response4"><label for="title"><h3></h3></label></div>
		<div class="hidden"><input type="hidden" name="savetitle" id="savetitle"></div>
		<div class="response5"></div>
	</div>

	<div class="form-group" id="divproponent">
		<label for="Title">Panel name</label><input  type="text" class="form-control" name="txtexampanel[]" id="txtexampanel" placeholder="Enter committee name here" required><label for="Title">Position</label><input type="text" class="form-control" name="txtexampanelposition[]" id="txtexampanelposition" placeholder="Enter position here or NA" required>
		
	</div>
	<div class="form-group">
		<a href="javascript:void(0)" id="btnexampanel" class="btn btn-default"><i class="fa">+</i></a href="javascript:void();"> - add more examining panel
	</div>


	<div class="form-inline">
	<input type="submit" class="btn btn-info" name="btnpanel" id="btnpanel" value="Done">
	<input type="button" class="btn btn-warning" onclick="shownext(this.form,'end');" name="btnpanelskip" id="btnpanelskip" value="Skip >">
	<div class="loader"></div>
	</div>

</form>

</div>

<script>
  $(function () {
     // editor = new nicEditor({fullPanel : false}).panelInstance('postcontent');
    //editor =  new nicEditor({buttonList : ['left','center','right','justify','fontSize','bold','italic','underline','strikeThrough','subscript','superscript','html','image']}).panelInstance('postcontent');
  editor =  new nicEditor({buttonList : ['fontSize','bold','italic','underline','strikeThrough','subscript','superscript','html','image']}).panelInstance('postcontent');
  })

  $(window).resize(function() {
     editor.removeInstance('postcontent'); 
    // editor = new nicEditor({fullPanel : false}).panelInstance('postcontent');
     //new nicEditor({buttonList : ['left','fontSize','bold','italic','underline','strikeThrough','subscript','superscript','html','image']}).panelInstance('postcontent');
  editor =  new nicEditor({buttonList : ['fontSize','bold','italic','underline','strikeThrough','subscript','superscript','html','image']}).panelInstance('postcontent');
  
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
  	function shownext (formid,nextform) {
  		// body...
  		//alert(formid.id);
  		//alert('skip to >>'+nextform);
		var	 title = $('#posttitle').val();
		var slug = $('#frmclients #savetitle').val();
		if(nextform === 'end'){
							$('.create').html('<font color="green">Your post created successfully. Wait for a second...</font>')
							var delay = 1000; 
							setTimeout(function(){ window.location = '<?=site_url("post/create");?>'; }, delay);

		}

		$('#'+formid.id).delay(2000).addClass('hidden');
		$('#'+nextform).delay(2000).removeClass('hidden');

								$('#'+nextform+' .response4 label h3').html('Title: <font color="green">'+title+'</font>');
								$('#'+nextform+' #savetitle').val(slug);
								$('.subtitle h4').html('Add more information');


  	}
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
						dataType: 'json',
						url: '<?=site_url("post/save");?>',
						data: data,
						success: function(response){
							console.log(response);
							if(response.stats == true){
            					$('.loader').hide();//return false;
								$('.response').html('<p class="alert alert-info">Hurray! <font color="green">'+title+'</font> added successfully.</p>');
								$('#frmpost').delay(2000).hide('slow');
								$('#frmclients').delay(2000).removeClass('hidden');
								$('.response2 label h3').html('Title: <font color="green">'+title+'</font>');
								$('.response4 label h3').html('Title: <font color="green">'+title+'</font>');
								$('#savetitle').val(response.slug);
								$('.subtitle h4').html('THESIS CLIENT');


							}else{
            					$('.loader').hide();//return false;
								$('.response').html('<p class="alert alert-danger">Warning! '+response.error+'</p>');
							}


						},
						error: function(){
							console.log(error);
							alert('Unknown error occured!');
						}
					});


  		return false;
  	});

	$('#frmclients').on('submit',function(){

            var data = $('#frmclients').serialize();
			$('.response3').html('');

            $('#frmclients .loader').show();//return false;


            /*data = data + '&action='+'Great';
            alert(data);return false;*/
            //alert(data); return false;
					$.ajax({
						type: 'post',
						dataType: 'json',
						url: '<?=site_url("post/clients");?>',
						data: data,
						success: function(response){
							console.log(response);

							if(response.stats == true){
            					$('#frmclients .loader').hide();//return false;
								$('.response3').html('<div class="alert alert-success">'+response.msg+'</div>');
								$('#frmclients').delay(2000).addClass('hidden');
								$('#frmproponent').delay(2000).removeClass('hidden');
								$('.subtitle h4').html('THESIS PROPONENT');
								return false;

							}else{
            					$('#frmclients .loader').hide();//return false;
								$('#frmclients .response3').html('<div class="alert alert-warning">'+response.msg+'</div>');
								return false;
							}


						}
					});
		return false;
  	});

	$('#frmproponent').on('submit',function(){

            var data = $('#frmproponent').serialize();
			$('.response5').html('');

            $('#frmproponent .loader').show();//return false;
            //alert(data); return false;
					$.ajax({
						type: 'post',
						dataType: 'json',
						url: '<?=site_url("post/proponent");?>',
						data: data,
						success: function(response){
							console.log(response);

							if(response.stats == true){
            					$('#frmproponent .loader').hide();//return false;
								$('.response5').html('<div class="alert alert-success">'+response.msg+'</div>');

								$('#frmproponent').delay(2000).addClass('hidden');
								$('#frmcourse').delay(2000).removeClass('hidden');
								$('.subtitle h4').html('THESIS COURSE');
							/*var delay = 1000; 
							setTimeout(function(){ window.location = URL; }, delay);*/
							//var delay = 2000; 
							//setTimeout(function(){ window.location = '<?=site_url("post/create");?>'; }, delay);

							}else{
            					$('#frmproponent .loader').hide();//return false;
								$('.response5').html('<div class="alert alert-warning">'+response.msg+'</div>');
								return false;
							}


						}
					});
		return false;
  	});

	$('#frmcommittee').on('submit',function(){

            var data = $('#frmcommittee').serialize();
			$('.response5').html('');

            $('#frmcommittee .loader').show();//return false;
            //alert(data); return false;
					$.ajax({
						type: 'post',
						dataType: 'json',
						url: '<?=site_url("post/committee");?>',
						data: data,
						success: function(response){
							console.log(response);

							if(response.stats == true){
            					$('#frmcommittee .loader').hide();//return false;
								$('.response5').html('<div class="alert alert-success">'+response.msg+'</div>');

								$('#frmcommittee').delay(2000).addClass('hidden');
								$('#frmpanel').delay(2000).removeClass('hidden');
								$('.subtitle h4').html('THESIS EXAMINING PANEL');
							/*var delay = 1000; 
							setTimeout(function(){ window.location = URL; }, delay);*/
							//var delay = 2000; 
							//setTimeout(function(){ window.location = '<?=site_url("post/create");?>'; }, delay);

							}else{
            					$('#frmcommittee .loader').hide();//return false;
								$('.response5').html('<div class="alert alert-warning">'+response.msg+'</div>');
								return false;
							}


						}
					});
		return false;
  	});
	$('#frmcourse').on('submit',function(){

            var data = $('#frmcourse').serialize();
			$('.response5').html('');

            $('#frmcourse .loader').show();//return false;
            //alert(data); return false;
					$.ajax({
						type: 'post',
						dataType: 'json',
						url: '<?=site_url("post/course");?>',
						data: data,
						success: function(response){
							console.log(response);

							if(response.stats == true){
            					$('#frmcourse .loader').hide();//return false;
								$('.response5').html('<div class="alert alert-success">'+response.msg+'</div>');

								$('#frmcourse').delay(2000).addClass('hidden');
								$('#frmcommittee').delay(2000).removeClass('hidden');
								$('.subtitle h4').html('THESIS COMMITTEE');
							/*var delay = 1000; 
							setTimeout(function(){ window.location = URL; }, delay);*/
							//var delay = 2000; 
							//setTimeout(function(){ window.location = '<?=site_url("post/create");?>'; }, delay);

							}else{
            					$('#frmcourse .loader').hide();//return false;
								$('.response5').html('<div class="alert alert-warning">'+response.msg+'</div>');
								return false;
							}


						}
					});
		return false;
  	});
	$('#frmpanel').on('submit',function(){


            var data = $('#frmpanel').serialize();
			$('.response5').html('');

            $('#frmpanel .loader').show();//return false;
            //alert(data); return false;

            $.ajax({
            	url: '<?=site_url("post/panels");?>',
            	type: 'post',
            	data: data,
            	dataType: 'json',
				success: function(response){
						console.log(response);
            			$('#frmpanel .loader').hide();//return false;

            				if(response.stats == true){
								$('.response5').html('<div class="alert alert-success">'+response.msg+'</div>');

							$('#frmpanel').reset();
							//alert(this.form.id);return false;

							var delay = 2000; 
							setTimeout(function(){ window.location = '<?=site_url("post/create");?>'; }, delay);

							}else{
								$('.response5').html('<div class="alert alert-warning">'+response.msg+'</div>');
								return false;
							}
            	}


            })

		return false;


  	});
  	$('#btnaddproponent').on('click', function () {
  		// body...
  		/*if($('#txtproponent').val() === ''){
  			return false;
  		}*/
  		    var error = 0;
    $.each( $("input[name='txtproponent[]']"), function(index,value){
        if( value.value.length == 0){
            $(".response3").html("<i class='alert alert-warning'>Proponent field is empty!</i>");

            $('.alert').delay(10000).hide('slow');
            error = 1;
            return;
        }
    });
    if(!error){
        $("#response3").html(""); 
        $('#divproponent').append('<br><label for="Title">Proponent</label><input  type="text" class="form-control" name="txtproponent[]" id="txtproponent" placeholder="Enter proponent here" required><label for="Title">Position</label><input type="text" class="form-control" name="txtposition[]" id="txtposition" placeholder="Enter position here" required>');

    }


  		
  	})
  	function validate(){
    var error = 0;
    $.each( $("input[name='txtproponent[]']"), function(index,value){
        if( value.value.length == 0){
            $(".response3").html("Morate uneti vrednost!").css('color','red');   
            error = 1;
            return;
        }
    });
    if(!error){
        $("#response3").html(""); 
    }
	}
  });

</script>