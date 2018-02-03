<div class="container-fluid">
        <div class="side-body">

        <div class="row create">
        <div class="tab-heading">
        <h3>Add new post</h3>
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
              <div class="panel-heading"><h3>ABSTRACT</h3></div>
              <div class="panel-body">

              	<?php include 'abstract.php'; ?>

              </div>
            </div>
          </div>


          <div id="a_authors" class="col-md-12 tab-pane fade">
            <div class="panel">
              <div class="panel-heading"><h3>Author <button class="btn btn-default" onclick="show_approval()">Skip</button></h3></div>
              <div class="panel-body">
              	<i>Note: Click plus sign '+' to add new information.</i> <br/><br/>
                

              	<?php include 'author.php'; ?>


              </div>
            </div>
          </div>
          <div id="a_approval" class="col-md-12 tab-pane fade">
            <div class="panel">
              <div class="panel-heading"><h3>Approval <button class="btn btn-default" onclick="show_file()">Skip</button></h3></div>
              <div class="panel-body">
              	<i>Note: You can edit data inside the table. Click plus sign '+' to add new information.</i>  <br/><br/>
                


              	<?php include 'approval.php'; ?>

              </div>
            </div>
          </div>
          <div id="a_finish" class="col-md-12 tab-pane fade">
            <div class="panel">
              <div class="panel-heading"><h3>POST COMPLETE </h3></div>
              <div class="panel-body">
                <i>Note: Post added successfully.</i><br/>
                <button class="btn btn-default" onclick="show_others_menu(false)">Add new post</button><br/>
                
                <input type="hidden" name="post_id" id="post_id" />

              </div>
            </div>
          </div>
          <div id="a_file" class="col-md-12 tab-pane fade">
            <div class="panel">
              <div class="panel-heading"><h3>Files <button class="btn btn-default" onclick="show_finish()">Skip</button></h3></div>
              <div class="panel-body">
                

              	<?php include 'resources.php'; ?>


              </div>
            </div>
          </div>


        </div>
        </div>
    </div>
	</div>
</div>
<?php 
//$is_abstract = ($this->session->userdata('is_abstract')) ? $this->session->userdata('is_abstract') : 'false';
 ?>
<script type="text/javascript">
  var is_abstract = false;
  var targ;
  var loadurl;
  show_others_menu(false);
  function show_others_menu(b) {
    // body...
    is_abstract = b;
    if (is_abstract == true) {
      $('#li_author').show();
      $('#li_approval').show();
      $('#li_file').show();
      $('#li_finish').show();
    }else{

      $('#li_author').hide();
      $('#li_approval').hide();
      $('#li_file').hide();
      $('#li_finish').hide();

                $('#abstract > li.active').removeClass('active');
                $('#abstract > li a#li_abstract').addClass('active');
                $('#abstract > li a#li_abstract').tab('show');
                $('#abstract > li#s_abstract').removeClass('disabled');
    }
  }

$("#abstract li#s_abstract a[data-toggle=tab]").on("click", function(e) {
  if ($('#abstract li#s_abstract').hasClass("disabled")) {
    e.preventDefault();
    return false;
  }
});
  function show_finish() {
    // body...

                $('#abstract > li#s_abstract').addClass('disabled');
                $('#abstract > li.active').removeClass('active');
                $('#abstract > li a#li_finish').addClass('active');
                $('#abstract > li a#li_finish').tab('show');
  }
  function show_approval() {
    // body...
                $('#abstract > li#s_abstract').addClass('disabled');
                $('#abstract > li.active').removeClass('active');
                $('#abstract > li a#li_approval').addClass('active');
                $('#abstract > li a#li_approval').tab('show');
  }
  function show_file() {
    // body...

                $('#abstract > li#s_abstract').addClass('disabled');
                $('#abstract > li.active').removeClass('active');
                $('#abstract > li a#li_file').addClass('active');
                $('#abstract > li a#li_file').tab('show');
  }
  function show_author() {
    // body...

                $('#abstract > li#s_abstract').addClass('disabled');
                $('#abstract > li.active').removeClass('active');
                $('#abstract > li a#li_author').addClass('active');
                $('#abstract > li a#li_author').tab('show');
  }
</script>

