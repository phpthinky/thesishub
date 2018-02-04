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
	var chartype_c = 'line';
 
	//On page load call the function setDynamicChart
	setDynamicChart_c(chartype_c,'container_com');
 
	//jQuery part - On Click call the function setDynamicChart(dynval) and pass the chart type
	$('.option_c').click(function(){
		//get the value from 'a' tag
		var chartype_c = $(this).attr('id');
		setDynamicChart_c(chartype_c,'container_com');
	});
 
	//function is created so we pass the value dynamically and be able to refresh the HighCharts on every click
 
	function setDynamicChart_c(chartype,id){
		$('#'+id).highcharts({
			chart: {
				type: chartype
			},
			title: {
				text: 'Change Chart type dynamically with jQuery'
			},
			xAxis: {
				categories: <?=$years;?>,
		        crosshair: true,
				title: {
					text: 'Year of study'
				}
			},
			yAxis: {
				min: 0,
				title: {
					text: 'Counter'
				}
			},
			series: [{
				name: 'YES',
				data: [<?=$counters;?>
				]
			},{
				name: 'NO',
				data: [<?=$counters_n;?>
				]
			},{
				name: 'NA',
				data: [<?=$counters_na;?>
				]
			}
			]
		});
	}
    });
</script>

	<div class="col-md-6"><select class="form-control" id="courses" name="courses"><?=$courses_v;?></select></div>
	<div class="col-md-4"><div class="col-md-6"><select class="form-control" id="year" name="year"><?=$year;?></select></div> <div class="col-md-6"><select class="form-control" id="year2" name="year2"><?=$year2;?></select></div></div>
	<div class="col-md-2"><button class="btn btn-success">Load</button></div>


<div class="col-md-12"><br />
	<a href="javascript:void(0);" class="option_c btn alert-info" id="line">Line Chart</a>
	<a href="javascript:void(0);" class="option_c btn alert-success" id="bar">Bar Chart</a>
	<a href="javascript:void(0);" class="option_c btn alert-warning" id="column">Column Chart</a>
	<br />
</div>
<div id="container_com" class="col-md-12"></div>
