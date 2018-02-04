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
				$courses_v .= "<option value='$key->name'>$key->name </option>";

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
            if($i == $currentY-5){$iscurrent = 'selected';}else{$iscurrent='';}
            $year .= "<option value='$i' $iscurrent>$i</option>";

          }

          $currentY = date('Y');
          for ($i=1912; $i <= $currentY; $i++) { 
            # code...
            if($i == $currentY){$iscurrent = 'selected';}else{$iscurrent='';}
            $year2 .= "<option value='$i' $iscurrent>$i</option>";

          }

?>
<script>
$(function () {
 
	//create a variable so we can pass the value dynamically
	var chartype = 'line';
 
	//On page load call the function setDynamicChart
	setDynamicChart(chartype,'container');
 
	//jQuery part - On Click call the function setDynamicChart(dynval) and pass the chart type
	$('.option').click(function(){
		//get the value from 'a' tag
		var chartype = $(this).attr('name');
		setDynamicChart(chartype,'container');
	});
 
	//function is created so we pass the value dynamically and be able to refresh the HighCharts on every click
 
	function setDynamicChart(chartype,id){
		$('#'+id).highcharts({
			chart: {
				type: chartype
			},
			title: {
				text: 'Change Chart type dynamically with jQuery'
			},
			xAxis: {
				categories: <?=$years_na;?>,
		        crosshair: true
			},
			yAxis: {
				min: 0,
				title: {
					text: 'Counter'
				}
			},
			series: [{
				name: 'Years',
				data: [<?=$counters_na;?>
				]
			}]
		});
	}
    });
</script>
	<div class="col-md-6"><select class="form-control" id="courses" name="courses"><?=$courses_v;?></select></div>
	<div class="col-md-4"><div class="col-md-6"><select class="form-control" id="year" name="year"><?=$year;?></select></div> <div class="col-md-6"><select class="form-control" id="year2" name="year2"><?=$year2;?></select></div></div>
	<div class="col-md-2"><button class="btn btn-success">Load</button></div>


<div class="col-md-12"><br />
	<a href="javascript:void(0);" class="option btn alert-info" name="line">Line Chart</a>
	<a href="javascript:void(0);" class="option btn alert-success" name="bar">Bar Chart</a>
	<a href="javascript:void(0);" class="option btn alert-warning" name="column">Column Chart</a>
	<br />
</div>
<div id="container" class="col-md-12"></div>
