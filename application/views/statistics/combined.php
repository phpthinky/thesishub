<script>
$(function () {
 
	//create a variable so we can pass the value dynamically
	var chartype_c = 'spline';
 
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
		var chart=null;

		$('#'+id).highcharts({

			chart: {
				type: chartype
			},
			title: {
				text: jsUcfirst(chartype)+' Chart of '+$('#courses_c').val()+" "+$('#year_c').val()+"-"+$('#year2_c').val()
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

	<div class="col-md-6"><select class="form-control" id="courses_c" name="courses_c"><?=$courses_v;?></select></div>
	<div class="col-md-4"><div class="col-md-6"><select class="form-control" id="year_c" name="year2_c"><?=$year;?></select></div> <div class="col-md-6"><select class="form-control" id="year2_c" name="year2_c"><?=$year2;?></select></div></div>
	<div class="col-md-2"><button class="btn btn-success">Load</button></div>


<div class="col-md-12"><br />
	<a href="javascript:void(0);" class="option_c btn alert-info" id="spline">Line Chart</a>
	<a href="javascript:void(0);" class="option_c btn alert-success" id="bar">Bar Chart</a>
	<a href="javascript:void(0);" class="option_c btn alert-warning" id="column">Column Chart</a>
	<br />
</div>
<div id="container_com" class="col-md-12"></div>
