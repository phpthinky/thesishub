
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
				text: jsUcfirst(chartype)+' Chart of '+$('#courses').val()+" "+$('#year').val()+"-"+$('#year2').val()
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

	<?php include 'selection.php'; ?>


<div class="col-md-12"><br />
	<a href="javascript:void(0);" class="option btn alert-info" name="spline">Line Chart</a>
	<a href="javascript:void(0);" class="option btn alert-success" name="bar">Bar Chart</a>
	<a href="javascript:void(0);" class="option btn alert-warning" name="column">Column Chart</a>
	<a href="javascript:void(0);" class="print btn alert-danger" id="print"><i class="fa fa-print"></i></a>
	<br />
</div>
<div id="container" class="col-md-12 output"></div>
