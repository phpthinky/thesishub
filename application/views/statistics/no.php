<script>
$(function () {
 
	//create a variable so we can pass the value dynamically
	var chartype_n = 'spline';
 
	//On page load call the function setDynamicChart
	setDynamicChart_n(chartype_n,'container_no');
 
	//jQuery part - On Click call the function setDynamicChart(dynval) and pass the chart type
	$('.option_y').click(function(){
		//get the value from 'a' tag
		var chartype_n = $(this).attr('id');
		setDynamicChart_n(chartype_n,'container_no');
	});
 
	//function is created so we pass the value dynamically and be able to refresh the HighCharts on every click
 
	function setDynamicChart_n(chartype,id){
		var chart=null;

		$('#'+id).highcharts({
			chart: {
				type: chartype
			},
			title: {
				text: jsUcfirst(chartype)+' Chart of '+$('#courses').val()+" "+$('#year').val()+"-"+$('#year2').val()
			},
			xAxis: {
				categories: <?=$years_n;?>,
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
				data: [<?=$counters_n;?>
				]
			}]
		});
	}
    });
</script>

	<?php include 'selection.php'; ?>


<div class="col-md-12"><br />
	<a href="javascript:void(0);" class="option_y btn alert-info" id="spline">Line Chart</a>
	<a href="javascript:void(0);" class="option_y btn alert-success" id="bar">Bar Chart</a>
	<a href="javascript:void(0);" class="option_y btn alert-warning" id="column">Column Chart</a>
	<a href="javascript:void(0);" class="print btn alert-danger" id="print"><i class="fa fa-print"></i></a>
	<br />
</div>
<div id="container_no" class="col-md-12 output"></div>
