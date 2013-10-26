<style>
h3{
	padding-left:20px;
}
</style>
<?php  //echo $javascript->link('jquery.min.js'); ?>
<?php  echo $javascript->link('jquery.tablesorter.min.js'); ?>
<pre>
<?php 
//print_r($factories);
?>
</pre>

<?php
//$section_list = array("","General Facility Information","ETP/Wastewater Treatment Control","Wastewater Sludge","Air Emission","Noise/Sound","Solid/Hazardous Waste","Chemicals/Hazardous Materials","Sewage/Septic System","Spills/Site Contamination","Spill Prevention and Contingency Preparedness Plan","Emergency Response Plan","Environmental Awareness and Training","Cleaner Production","Environmental Management Systems (EMS)");



?>


<span style="text-align:left; padding-left:20px"><h3>Local Standard Rating of different facilities</h3></span>
<br />
<div id="chart_div" ></div>

<span style="text-align:left; padding-left:20px"><h3>X Standard Rating of different facilities</h3></span>
<br />
<div id="chart_div1" ></div>

<span style="text-align:left; padding-left:20px"><h3>Y Standard Rating of different facilities</h3></span>
<br />
<div id="chart_div2" ></div>

<div style="clear:both"></div>

<div id="target_div"  name="target_div">
	
	<?php 
	if(!empty($factories)){
		
		?>
		<center>
        <br />
		<span style="text-align:left; padding-left:20px"><h3>Reports</h3></span>
        <br />
		<table id="myTable" class="tablesorter" style=" width:97%" >
			<thead>
			<tr>
				<td style=" border:0; padding: 10px;  text-align:center"><b>number</b></td>
                <td style=" border:0; padding: 10px;  text-align:center"><b>Name</b></td>
				<td style=" border:0; padding: 10px;  text-align:center"><b>Rating Local Standard(%)</b></td>
				<td style=" border:0; padding: 10px;  text-align:center"><b>Rating X Standard(%)</b></td>
				<td style=" border:0; padding: 10px;  text-align:center"><b>Rating Y Standard(%)</b></td>
				<td style=" border:0; padding: 10px;  text-align:center"><b>Details</b></td>
			</tr>
			</thead>
			<tbody>
			<?php 
			$factory_num = 1;
			$actual_factory_num = 1;
			$local_total_point = 0.0;
			$hnm_total_point = 0.0;
			$wrap_total_point = 0.0;
			foreach($factories as $factory){

				
				echo'<tr><td style=" border:0; padding: 10px;  text-align:center">';
				$name = $factory['factories']['factory_name'];
				$id = $factory['factories']['id'];
				//echo $name;
				echo $factory_num.'</td><td style=" border:0; padding: 10px; text-align:center; vertical-align:middle">';	
				echo $this->Html->link($name, array('controller'=>'admins','action' => 'FacilityReport',$id));
				echo'</td><td style=" border:0; padding: 10px; text-align:center; vertical-align:middle">';
				
				$rating = $factory[0]['local'];
				if( $rating < 50) $img='highrisk.png';
				elseif($rating >= 80) $img='lowrisk.png';
				else $img='medrisk.png';
				echo $html->image($img, array('alt' => 'catagory','border'=>'0') );
				//echo $factory[0]['local']."%";
				
				
				echo '</td><td style=" border:0; text-align:center; vertical-align:middle">';
				$rating = $factory[0]['HNM'];
				if( $rating < 50) $img='highrisk.png';
				elseif($rating >= 80) $img='lowrisk.png';
				else $img='medrisk.png';
				//echo $factory[0]['HNM']."%";
				echo $html->image($img, array('alt' => 'catagory','border'=>'0') );
				
				
				echo '</td><td style=" border:0; padding: 10px; text-align:center; vertical-align:middle">';
				$rating = $factory[0]['WRAP'];
				if( $rating < 50) $img='highrisk.png';
				elseif($rating >= 80) $img='lowrisk.png';
				else $img='medrisk.png';
				//echo $factory[0]['WRAP']."%";				
				echo $html->image($img, array('alt' => 'catagory','border'=>'0') );
				
				
				echo '</td><td style=" border:0; padding: 10px; text-align:center; vertical-align:middle">';
				echo $this->Html->link("Details", array('controller'=>'admins','action' => 'FacilityReport',$id));
				echo '</td></tr>';
			
				
				$factory_num++;
				
				$local_total_point += $factory[0]['local'];
				$hnm_total_point += $factory[0]['HNM'];
				$wrap_total_point += $factory[0]['WRAP'];
			}
			$local_avarage= round($local_total_point/($factory_num-1),2);
			$hnm_avarage= round($hnm_total_point/($factory_num-1),2);
			$wrap_avarage= round($wrap_total_point/($factory_num-1),2);
			?>
			</tbody>
		</table>
		
		</center>
		<?php 
	}
	?>
</div>
	
<script type="text/javascript">
/*
$(document).ready(function() 
    { 
        $("#myTable").tablesorter(); 
    } 
);
*/ 
</script>

<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      
	  google.load("visualization", "1", {packages:["corechart"]});
      
		 function drawVisualization() {
			 // Some raw data (not necessarily accurate)
			 var data = google.visualization.arrayToDataTable([
			   ['Name', 'Rating', 'Average','Mid Risk','Low Risk'],
			   <?php
					$num=1;					
					foreach($factories as $factory){				
						$name = $num.". ".$factory['factories']['factory_name'];
						$res = round($factory[0]['local'],2);						
						echo "['".$name."', ".$res.", $local_avarage ,50,80 ],
						";
						$num++;
					}
					//echo $LOCAL_rate;
			   ?>
			 ]);
			  var data_hnm = google.visualization.arrayToDataTable([
			   ['Name', 'Rating', 'Average','Mid Risk','Low Risk'],
			   <?php
					$num=1;					
					foreach($factories as $factory){				
						$name = $num.". ".$factory['factories']['factory_name'];
						$res = round($factory[0]['HNM'],2);						
						echo "['".$name."', ".$res.", $hnm_avarage ,50,80 ],
						";
						$num++;
					}
					//echo $LOCAL_rate;
			   ?>
			 ]);
			  var data_wrap = google.visualization.arrayToDataTable([
			   ['Name', 'Rating', 'Average','Mid Risk','Low Risk'],
			    <?php
					$num=1;					
					foreach($factories as $factory){				
						$name = $num.". ".$factory['factories']['factory_name'];
						$res = round($factory[0]['WRAP'],2);						
						echo "['".$name."', ".$res.", $wrap_avarage ,50,80 ],
						";
						$num++;
					}
					//echo $LOCAL_rate;
			   ?>
			 ]);
	
			 // Create and draw the visualization.
			 var comboChart = new google.visualization.ComboChart(document.getElementById('chart_div'));
			 comboChart.draw(data, {width: 950, height: 500,
			   title : 'Compare Rating of Different Facilities (Local Standard)',
			   vAxis: {title: "Rating(%)", minValue: 0, maxValue: 90},
			   hAxis: {title: "Facility",textPosition:'none', },
				/*chartArea:{left:0,top:0,width:"90%",height:"90%"},*/
			   seriesType: "bars",
			   series: {0: {color: 'blue'},1: {type: "line", color: 'red'},2: {type: "line",color: 'yellow'},3: {type: "line",color: 'green'}}
			   
			 });
			 var comboChart = new google.visualization.ComboChart(document.getElementById('chart_div1'));
			 comboChart.draw(data_hnm, {width: 950, height: 500,
			   title : 'Compare Rating of Different Facilities (Y Standard)',
			   vAxis: {title: "Rating(%)", minValue: 0, maxValue: 90},
			   hAxis: {title: "Facility",textPosition:'none', },
				/*chartArea:{left:0,top:0,width:"90%",height:"90%"},*/
			   seriesType: "bars",
			   series: {0: {color: 'blue'},1: {type: "line", color: 'red'},2: {type: "line",color: 'yellow'},3: {type: "line",color: 'green'}}
			   
			 });
			 var comboChart = new google.visualization.ComboChart(document.getElementById('chart_div2'));
			 comboChart.draw(data_wrap, {width: 950, height: 500,
			   title : 'Compare Rating of Different Facilities (X Standard)',
			   vAxis: {title: "Rating(%)", minValue: 0, maxValue: 90},
			   hAxis: {title: "Facility",textPosition:'none', },
				/*chartArea:{left:0,top:0,width:"90%",height:"90%"},*/
			   seriesType: "bars",
			   series: {0: {color: 'blue'},1: {type: "line", color: 'red'},2: {type: "line",color: 'yellow'},3: {type: "line",color: 'green'}}
			   
			 });
		   }
		   google.setOnLoadCallback(drawVisualization);
 
	  
	  /*google.setOnLoadCallback(drawChart);*/
	  
    </script>