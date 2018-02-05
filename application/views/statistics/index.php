<?php 

    $courses_v = '';
        $month = '';
        $months = '';
        $year = 0;
        $year2 = 0;


  if (isset($courses)) {
    
    if (is_array($courses)) {
      $i=0;
      foreach ($courses as $key) {
        if($i == 0){

        }else{
        $courses_v .= "<option value='$key->name'";
        if(!empty($is_course) && $is_course == $key->name){
           $courses_v .= " selected ";
        }
        $courses_v .= "  >$key->name </option>";

        }
        $i++;
      }
    }
  }
  

     for ($m=1; $m<=12; $m++) {
     $months[] = array('id'=>$m,'name'=>date('F', mktime(0,0,0,$m, 1, date('Y'))));     
     }

        $m = date('m');
        foreach ($months as $key) {
          # code...
            if($key['id'] == $m){$iscurrent = 'selected';}else{$iscurrent='';}
            $month .= "<option value='".$key['id']."' $iscurrent>".$key['name']."</option>";
        }

          $currentY = date('Y');
          for ($i=1912; $i <= $currentY; $i++) { 
            # code...
            if($start_year){

               if($i == $start_year){$iscurrent = 'selected';}else{$iscurrent='';}
               $year .= "<option value='$i' $iscurrent>$i</option>";

            }else{

               if($i == $currentY-5){$iscurrent = 'selected';}else{$iscurrent='';}
               $year .= "<option value='$i' $iscurrent>$i</option>";

            }
          }

          $currentY = date('Y');
          for ($i=1912; $i <= $currentY; $i++) { 
            # code...
          if($end_year){

               if($i == $end_year){$iscurrent = 'selected';}else{$iscurrent='';}
               $year2 .= "<option value='$i' $iscurrent>$i</option>";

            }else{

               if($i == $currentY-5){$iscurrent = 'selected';}else{$iscurrent='';}
               $year2 .= "<option value='$i' $iscurrent>$i</option>";

            }



          }

?>
<style type="text/css">
</style>
<div class="container-fluid">
        <div class="side-body">

        <div class="row create charts">
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
              <div class="panel-heading"><h3>UTILIZED</h3></div>
              <div class="panel-body">

              	<?php include 'yes.php'; ?>

              </div>
            </div>
          </div>


          <div id="a_authors" class="col-md-12 tab-pane fade">
            <div class="panel">
              <div class="panel-heading"><h3>UNUTILIZED</h3></div>
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
 <script type="text/javascript" src="<?=base_url('assets/plugin/chart/highcharts2018.js');?>"></script>
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

     function jsUcfirst(string) 
  {
      return string.charAt(0).toUpperCase() + string.slice(1);
  }

  $('.print').on('click',function(){
    window.print();
  });
</script>

