
<style type="text/css">
</style>
<div class="container-fluid">
        <div class="side-body">

        <div class="row create">
        <div class="tab-heading">
        <h3>Statistics</h3>
        <br />

        <div class="col-md-12">
          <div class="response"></div>
        	
        <ul class="nav nav-tabs" id="abstract">
          <li class=" active" id="s_abstract"><a data-toggle="tab" href="#a_abstract" id="li_abstract">UTILIZED</a></li>
          <li><a data-toggle="tab" href="#a_authors" id="li_author">UNUTILIZED</a></li>
          <li><a data-toggle="tab" href="#a_approval" id="li_approval">NOT APPLIED</a></li>
          <li><a data-toggle="tab" href="#a_finish" id="li_finish">COMBINED</a></li>
        </ul>
      </div>
      </div>

        <div class="col-md-12">

        <div class="tab-content">

          <div id="a_abstract" class="col-md-12 tab-pane fade in active">
            <div class="panel">
              <div class="panel-heading"><h3>UTILIZATION</h3></div>
              <div class="panel-body">

              	<?php include 'yes.php'; ?>

              </div>
            </div>
          </div>


          <div id="a_authors" class="col-md-12 tab-pane fade">
            <div class="panel">
              <div class="panel-heading"><h3>UNTILIZED</h3></div>
              <div class="panel-body">
              	
                <?php include 'no.php'; ?>
              </div>
            </div>
          </div>
          <div id="a_approval" class="col-md-12 tab-pane fade">
            <div class="panel">
              <div class="panel-heading"><h3>NOT APPLIED</h3></div>
              <div class="panel-body">
              	
                <?php include 'na.php'; ?>


              </div>
            </div>
          </div>
          <div id="a_finish" class="col-md-12 tab-pane fade">
            <div class="panel">
              <div class="panel-heading"><h3>COMPARISON </h3></div>
              <div class="panel-body">

                <?php include 'combined.php'; ?>

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

 <script type="text/javascript" src="<?=base_url('assets/plugin/chart/exporting.js');?>"></script>
 <script type="text/javascript" src="<?=base_url('assets/plugin/chart/highcharts.js');?>"></script>
<script type="text/javascript">
  var is_abstract = false;
  var targ;
  var loadurl;
  show_others_menu(true);
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

