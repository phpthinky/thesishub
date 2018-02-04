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

<div class="col-md-12">
	<div class="col-md-6"><select class="form-control" id="courses" name="courses"><?=$courses_v;?></select></div>
	<div class="col-md-4"><div class="col-md-6"><select class="form-control" id="year" name="year"><?=$year;?></select></div> <div class="col-md-6"><select class="form-control" id="year2" name="year2"><?=$year2;?></select></div></div>
	<div class="col-md-2"><button class="btn btn-success">Load</button></div>
</div>




<div class="col-md-12">
	
	<div class="panel chart">
		<div class="panel-heading"><h4>Graphical View</h4></div>
	
	<div class="panel-body">
	<div class="col-md-12">
		<div class="alert alert-success hidden">
		UTILIZED THESIS</div>
		<div class="sub-chart" id="yes"></div>
		
	</div>
	</div>

	</div>

</div>



	<script>
		$(function () {

	$('#container-chart').highcharts({
    chart: {
      renderTo: 'container'
    },
    title: {
        text: 'Bar Chart of '+$('#courses').html() + ' ' +$('#year').val()
    },
    subtitle: {
        text: 'Source: Thesis Hub'
    },
    plotOptions: {
      series: {
        pointStart: Date.UTC(2016, 1, 22),
        pointInterval: 24 * 3600 * 1000 // one day
      }
    },
    tooltip: {
      shared: true,
      crosshairs: true,
      dateTimeLabelFormats : {
        day:"%b %e"
      }
    },
    xAxis: {
      type: 'datetime'
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Total count'
        }
    },
    series: [{
      name: '2015',
      data: [176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4, null, 71.5, 106.4, 129.2, 144.0],
    },{
      name:'2016',
      data: [29.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4],
    }]
  });
		    $('#yes').highcharts({
		        chart: {
		            type: 'column'
		        },
		        plotOptions: {
				    column: {
				        pointPadding: 0,
				        borderWidth: 5,
				        groupPadding: 0,
				        shadow: false
				    }
				},
				title: {
				text: 'Utilized study of '+$('#courses').html()  +' ' + $('#year').val() +' - ' + $('#year2').val()
				},
				subtitle: {
				text: 'Source: Thesis Hub'
				},
		        xAxis: {
		            categories: <?php echo $years; ?>,
		            crosshair: true
		        },
		        series: [{
					name: 'COUNT' ,
					data: [<?=$counters;?>]
				}

			]
		    });

		    $('#downloadchart').highcharts({
		        chart: {
		            type: 'column'
		        },
		        title: {
		            text: 'Coloftech weekly download'
		        },
		        subtitle: {
		            text: 'Source: www.coloftech.com'
		        },
		        xAxis: {
		            categories: <?php echo json_encode(array('Mon','Tue','Wed','Thur','Fri','Sat','Sun')) ?>,
		            crosshair: true
		        },
		        yAxis: {
		            min: 0,
		            title: {
		                text: 'Total download'
		            }
		        },
		        plotOptions: {
		            column: {
		                pointPadding: 0.2,
		                borderWidth: 0
		            }
		        },
		        series: [{
		            name: 'Download',
		            data: <?php echo json_encode(array(1,3,5,1,6,6,3)) ?>
		        }]
		    });
		});
	</script>