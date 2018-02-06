<div class="container-fluid">
        <div class="side-body">

        <div class="row create">
        <div class="tab-heading">
        <h3>Edit post</h3>
        <br />

        <div class="col-md-12">
          <div class="response"></div>
          
        <ul class="nav nav-tabs" id="abstract">
          <li class=" active" id="s_abstract"><a data-toggle="tab" href="#a_abstract" id="li_abstract">ABSTRACT</a></li>
          <li><a data-toggle="tab" href="#a_authors" id="li_author">AUTHOR</a></li>
          <li><a data-toggle="tab" href="#a_approval" id="li_approval">APPROVAL</a></li>
          <li><a data-toggle="tab" href="#a_file" id="li_file">FILE</a></li>
          <li><a data-toggle="tab" href="#a_finish" id="li_finish">COMPLETE</a></li>
        </ul>
      </div>
      </div>

        <div class="col-md-12">



        <div class="tab-content">

          <div id="a_abstract" class="col-md-12 tab-pane fade in active">
            <div class="panel">
              <div class="panel-heading"><h3>EDIT ABSTARCT</h3></div>
              <div class="panel-body">

              	<?php include 'e_abstract.php'; ?>

              </div>
            </div>
          </div>


          <div id="a_authors" class="col-md-12 tab-pane fade">
            <div class="panel">
              <div class="panel-heading"><h3>Author</h3></div>
              <div class="panel-body">
              	<i>Note: You can edit data inside the table. Click plus sign '+' to add new information.</i><br/><br/>
                

              	<?php include 'e_author.php'; ?>


              </div>
            </div>
          </div>
          <div id="a_approval" class="col-md-12 tab-pane fade">
            <div class="panel">
              <div class="panel-heading"><h3>Approval</h3></div>
              <div class="panel-body">
              	<i>Note: You can edit data inside the table. Click plus sign '+' to add new information.</i><br/><br/>
                


              	<?php include 'e_approval.php'; ?>

              </div>
            </div>
          </div>
          <div id="a_finish" class="col-md-12 tab-pane fade">
            <div class="panel">
              <div class="panel-heading"><h3>COMPLETE </h3></div>
              <div class="panel-body">
                <i>.</i><br/>
                <a href="<?=site_url('post');?>" class="btn btn-default" onclick="show_others_menu(false)">View all post</a> <a href="<?=site_url('post/add');?>" class="btn btn-default" onclick="show_others_menu(false)">Add new post</a> <br/>
                
                <input type="hidden" name="post_id" id="post_id" />

              </div>
            </div>
          </div>
          <div id="a_file" class="col-md-12 tab-pane fade">
            <div class="panel">
              <div class="panel-heading"><h3>Files <a href="javascript:void(0)" class="btn btn-default btn-more" title="Add Add more..." onclick="add_file(this.id)"><i class="fa fa-plus"></i></a></h3></div>
              <div class="panel-body">
                

              	<?php include 'e_file.php'; ?>


              </div>
            </div>
          </div>



        </div>
        </div>
    </div>
	</div>
</div>

