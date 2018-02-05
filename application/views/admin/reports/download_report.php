
    <!-- Main Content -->
    <div class="container-fluid">
        <div class="side-body">
        	<h4 style="display: inline-block;"><?php echo isset($title) ? $title : "Portal"; ?></h4>

        	
        	<div class="col-md-12">

        		<div class="panel">
        			<div class="panel-heading">
        				<form class="form form-horizontal no-print" method="GET" action="">
        					<div class="form-group">
        						<div class="col-md-3"><label>Limit by </label> <select  id="limit" name="limit" class="form-control" style="width: 40%; display: inline-block;min-width: 75px;">
        							<?php $limit = $this->input->get('limit');
        							 $selection = $this->input->get('selection');
        							 ?>
        							<option value="10" <?php if($limit == 10){echo 'selected';}?> >10</option>
        							<option value="25" <?php if($limit == 25){echo 'selected';}?> >25</option>
        							<option value="50" <?php if($limit == 50){echo 'selected';}?>>50</option>
        							<option value="100" <?php if($limit == 100){echo 'selected';}?>>100</option>
        							<option value="250" <?php if($limit == 250){echo 'selected';}?>>250</option>
        							<option value="500" <?php if($limit == 500){echo 'selected';}?>>500</option>

        						</select></div>
        						<div class="col-md-7"><label>Filter by </label> <select  id="selection" name="selection" class="form-control" style="width: 75%; display: inline-block;">
        							<option value="most"  <?php if($selection == 'most'){echo 'selected';}?> >Most downloaded</option>
        							<option value="less"  <?php if($selection == 'less'){echo 'selected';}?> >Less downloaded</option>
        							<option value="random"  <?php if($selection == 'random'){echo 'selected';}?> >Recents download</option>
        						</select>
        						<button class="btn btn-default"><i class="fa fa-search"></i></button>
</div>
        						<div class="col-md-2">
        						 <button class="btn btn-default" onclick="callprint();"><i class="fa fa-print"></i></button>
        						<a href="<?=site_url('reports/printexcel');?>" target="_blank" class="btn btn-default">Export</a></div>
        						

        						
        					</div>
        				</form>
        			</div>
        			<div class="panel-body">
							        				
							    <?php if(isset($content)){
							        echo "<table class='table table-bordered'>
							        <thead>
							            <tr><th></th><th>Title</th><th>Last downloaded on</th><th>Download</th></tr>
							        </thead>
							        <tbody>";
							        $i=1;
							        if (is_array($content)) {
							            # code...
							            
							        foreach ($content as $key) {
							            # code...
							            echo "<tr id='tr-$key->post_id'><td></td><td>$key->title</td><td>$key->d_date</td><td>$key->visita</td></tr>";
							            $i++;
							        }

							        }

							        echo "</tbody'></table>";
							    }else{
							        echo "Nothing to display here.";
							    } 
							    ?>
        			</div>
        		</div>
           
         
        </div>
    </div>

</div>

<script type="text/javascript">
	var isvisible = false;
	function showform() {
		// body...

		if (isvisible == false) {

	$('#frminfo').show('slow');
	isvisible =true;
		}else{

	$('#frminfo').hide();
	isvisible =false;
		}

	}
	$('#frminfo').on('submit',function () {
		// body...
		var frmdata;
		var	username = $('#username').val();
		var	email = $('#email').val();
		var	pass = $('#pass').val();
		var	firstname = $('#firstname').val();
		var	middlename = $('#middlename').val();
		var	lastname = $('#lastname').val();
		var	idno = $('#idno').val();
    				$('.result').html('');

		frmdata = 'username='+username+'&email='+email+'&pass='+pass+'&firstname='+firstname+'&middlename='+middlename+'&lastname='+lastname+'&idno='+idno;
			$.ajax({
    			type: 'post',
    			url: '<?=site_url("accounts/add_staff");?>',
    			data: frmdata,
    			dataType:'json',
    			success: function (resp) {
    				console.log(resp);
    				if (resp.stats == true) {

    				$('.result').html('<div class="alert alert-success">User added successfully!</div>');

    				setTimeout(function(){

    				$('.result').html('');
    				clearform('frminfo');
    			},3000);

    				}else{

    				$('.result').html('<div class="alert alert-danger"> Error! '+resp.msg+'</div>');
    				}

    			}
    		});
		return false;
	})

		function clearform (frm) {
		// body...

		$('#username').val('');
		$('#email').val('');
		$('#pass').val('');
		$('#firstname').val('');
		$('#middlename').val('');
		$('#lastname').val('');
		$('#idno').val('');
    				$('.result').html('');


		showform();

		return;
	}

</script>