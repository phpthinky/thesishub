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
				text: jsUcfirst(chartype)+' Chart of '+$('#courses').val()+" "+$('#year').val()+"-"+$('#year2').val()
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
<script type="text/javascript">
	$('#btn-remove').on('click',function () {

		chart.get('NAME').remove();
	})
</script>
	<?php include 'selection.php'; ?>


<div class="col-md-12"><br />
	<a href="javascript:void(0);" class="option_c btn alert-info" id="spline">Line Chart</a>
	<a href="javascript:void(0);" class="option_c btn alert-success" id="bar">Bar Chart</a>
	<a href="javascript:void(0);" class="option_c btn alert-warning" id="column">Column Chart</a>
	<a href="javascript:void(0);" class="print btn alert-danger" id="print"><i class="fa fa-print"></i></a>
	<br />
</div>
<button class="btn btn-danger hidden" id="btn-remove">Remove NA</button>
<div id="container_com" class="col-md-12 output"></div>
