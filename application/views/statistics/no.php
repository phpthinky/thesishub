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
				text: jsUcfirst(chartype)+' Chart of '+$('#courses_no').val()+" "+$('#year_no').val()+"-"+$('#year2_no').val()
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

	<div class="col-md-6"><select class="form-control" id="courses_no" name="courses_no"><?=$courses_v;?></select></div>
	<div class="col-md-4"><div class="col-md-6"><select class="form-control" id="year_no" name="year_no"><?=$year;?></select></div> <div class="col-md-6"><select class="form-control" id="year2_no" name="year2_no"><?=$year2;?></select></div></div>
	<div class="col-md-2"><button class="btn btn-success">Load</button></div>


<div class="col-md-12"><br />
	<a href="javascript:void(0);" class="option_y btn alert-info" id="spline">Line Chart</a>
	<a href="javascript:void(0);" class="option_y btn alert-success" id="bar">Bar Chart</a>
	<a href="javascript:void(0);" class="option_y btn alert-warning" id="column">Column Chart</a>
	<br />
</div>
<div id="container_no" class="col-md-12"></div>
