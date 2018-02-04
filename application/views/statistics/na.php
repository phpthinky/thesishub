
<script>
$(function () {
 
	//create a variable so we can pass the value dynamically
	var chartype = 'spline';

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
		var chart=null;

		$('#'+id).highcharts({
			chart: {
				type: chartype
			},
			title: {
				text: jsUcfirst(chartype)+' Chart of '+$('#courses_na').val()+" "+$('#year_na').val()+"-"+$('#year2_na').val()
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
	<div class="col-md-6"><select class="form-control" id="courses_na" name="courses_na"><?=$courses_v;?></select></div>
	<div class="col-md-4"><div class="col-md-6"><select class="form-control" id="year_na" name="year_na"><?=$year;?></select></div> <div class="col-md-6"><select class="form-control" id="year2_na" name="year2_na"><?=$year2;?></select></div></div>
	<div class="col-md-2"><button class="btn btn-success">Load</button></div>


<div class="col-md-12"><br />
	<a href="javascript:void(0);" class="option btn alert-info" name="spline">Line Chart</a>
	<a href="javascript:void(0);" class="option btn alert-success" name="bar">Bar Chart</a>
	<a href="javascript:void(0);" class="option btn alert-warning" name="column">Column Chart</a>
	<br />
</div>
<div id="container" class="col-md-12"></div>
