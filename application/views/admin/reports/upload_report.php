
    <!-- Main Content -->
    <div class="container-fluid">
        <div class="side-body">
        	<h4 style="display: inline-block;"><?php echo isset($title) ? $title : "Portal"; ?></h4>

        	
        	<div class="col-md-12">

        		<div class="panel">
        			<div class="panel-heading">
        				<form class="form form-horizontal no-print" method="GET" action="upload">
        					<div class="form-group">
        						<div class="col-md-2"><label>Limit </label> <select  id="limit" name="limit" class="form-control" style="width: 40%; display: inline-block;min-width:70px;">
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
        						<div class="col-md-8">
        							<label>Filter by </label> 
        							<select  id="selection" name="selection" class="form-control" style="width: 150px; display: inline-block;">
        							<option value="recent"  <?php if($selection == 'recent'){echo 'selected';}?> >Recent upload</option>
        							
        							</select>
        							<label>User </label> 
        							<select  id="users" name="users" class="form-control" style="width: 150px; display: inline-block;">
        							<option value="0"  <?php if($selection == '0'){echo 'selected';}?> >All</option> 
        							<?php if (isset($listusers)): ?>
        								<?php if (is_array($listusers)): ?>
        									<?php foreach ($listusers as $key): ?>
        										<option value="<?php echo $key->id;?>" <?php if($selection == $key->id){echo 'selected';} ?> ><?php echo $key->name;?></option>
        									<?php endforeach ?>
        								<?php endif ?>
        							<?php endif ?>


        							</select>
        						<button class="btn btn-default"><i class="fa fa-search"></i></button>
</div>
        						<div class="col-md-2">
        						 <button class="btn btn-default" onclick="callprint();"><i class="fa fa-print"></i></button>
        						<a href="<?=site_url('reports/uploadprintexcel');?>" target="_blank" class="btn btn-default">Export</a></div>
        						

        						
        					</div>
        				</form>
        			</div>
        			<div class="panel-body">
							        				
							    <?php if(isset($content)){
							        echo "<table class='table table-bordered'>
							        <thead>
							            <tr><th></th><th>Title</th><th>Date of upload</th><th>User</th></tr>
							        </thead>
							        <tbody>";
							        $i=1;
							        if (is_array($content)) {
							            # code...
							            
							        foreach ($content as $key) {
							            # code...
							        	if ($key->posted_by == 1) {
							        		# code...
							        		if ($this->aauth->is_admin()) {
							        			# code...
							            echo "<tr id='tr-$key->post_id'><td></td><td>$key->title</td><td>$key->d_date</td><td>$key->name</td></tr>";
							        		}

							        	}else{

							            echo "<tr id='tr-$key->post_id'><td></td><td>$key->title</td><td>$key->d_date</td><td>$key->name</td></tr>";
							        	}
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

