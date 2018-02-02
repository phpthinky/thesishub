<div class="container-fluid">
        <div class="side-body">

        <div class="row create">

        <h3>Add new post</h3>
        <br />

        <div class="col-md-12">
        	
        <ul class="nav nav-tabs">
          <li class="active"><a data-toggle="tab" href="#a_abstract" id="li_abstract">ABSTRACT</a></li>
          <li><a data-toggle="tab" href="#a_authors" id="li_author">AUTHOR</a></li>
          <li><a data-toggle="tab" href="#a_approval" id="li_approval">APPROVAL SHEET</a></li>
          <li><a data-toggle="tab" href="#a_file" id="li_file">FILE</a></li>
        </ul>




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

