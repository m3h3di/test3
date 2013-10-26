

<?php  //echo $javascript->link('jquery.min.js'); ?>
<?php  echo $javascript->link('jquery.tablesorter.min.js'); ?>
<pre>
<?php 
//print_r($cities); 
//print_r($factories);
//print_r($rating_rules);
//print_r($_POST);
?>
</pre>

<?php
$section_list = array("","General Facility Information","ETP/Wastewater Treatment Control","Wastewater Sludge","Air Emission","Noise/Sound","Solid/Hazardous Waste","Chemicals/Hazardous Materials","Sewage/Septic System","Spills/Site Contamination","Spill Prevention and Contingency Preparedness Plan","Emergency Response Plan","Environmental Awareness and Training","Cleaner Production","Environmental Management Systems (EMS)");


if(!empty($factories)){
	$total=0.0;
	foreach($section_avg_all_facilities as $sec_avg){
		$total += $sec_avg[0]['point'];
		$section = $sec_avg['ratings']['section'];
		$final_set[$section]['avg']=$sec_avg[0]['point'];
		foreach($section_avg_single_facilities as $sec_point){
			if($section == $sec_point['ratings']['section']){
				$final_set[$section]['point']=$sec_point['ratings']['points'];	
				break;
			}
		}
	}
	
	$fact_total=0.0;
	foreach($section_avg_single_facilities as $val){
		$fact_total+=$val['ratings']['points'];
	}
	
	//echo '<pre>';
	//print_r($final_set);
	//echo '</pre>';
	//$total/70;
	
	$all_fact_avg = round(100*$total/70,2);
	$fact_avg = round(100*$fact_total/70,2);
}
?>


		
<div style=" background-color:#EBEBEC;margin:5px;padding:40px; width:889px;border-radius:8px;-moz-border-radius:8px;-webkit-border-radius:8px;">
    <div style="margin:-30px 0 0 -27px;padding:0 0 20px;"><b>Please Select a Facility</b></div>
            
    <div style="border:1px solid #FFFFFF; width:870px; height:160px; padding:0px 0px 13px 10px; background:#FFF;border-radius:8px;-moz-border-radius:8px;-webkit-border-radius:8px; ">
        
        <form action="" method="post" name="facility_info" style="padding:20px;" >
        <select name="fact" size="6" style="width:700px">
        	        	
                        <?php
						foreach($factories as $factory){
							$bb= $factory['factories']['factory_name'];
							$bbi= $factory['factories']['id'];
							if(!empty($posted_id) and $posted_id== $bbi){
								$select = 'select="selected"';
								$select_fact_name = $bb;
							}
							else $select = "";
							
							echo '<option '.$select.' value="'.$bbi.'">'.$bb.'</option>';
							
							
						}
						?>
        
        </select>
        
        <br /><br />
        <input type="submit" value="Generate Report"  />
        </form>
                
    </div>
    
    
</div>


<span style="text-align:left; padding-left:20px"><h3>Result in Graph</h3></span>
<br />
<div id="chart_div" ></div>
<span style="text-align:left; padding-left:20px"><h3>Result in Graph (All Sections)</h3></span>
<br />
<div id="chart_div1" ></div>
<div style="clear:both"></div>


<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      
	  google.load("visualization", "1", {packages:["corechart"]});
      
		 function drawVisualization() {
			 // Some raw data (not necessarily accurate)
			 var data = google.visualization.arrayToDataTable([
			   ['Name', 'Rating', 'Average'],
			   <?php
			   		$name = $select_fact_name;
					echo "['".$name."', ".$fact_avg.", $all_fact_avg],
							";
							
			   ?>
			 ]);
	
			  var data_s = google.visualization.arrayToDataTable([
			   ['Name', 'Rating', 'Average'],
			   <?php

					foreach($final_set as $sec=>$param){
						$name = $section_list[$sec];
						$sec_av = round(100*$param['avg']/5,2);
						$sec_point= round(100*$param['point']/5,2);
						if($sec_point == 0) $sec_point=1;
								echo "['".$name."', ".$sec_point.", $sec_av],
								";					
					}
			   ?>
			 ]);
			 
			 // Create and draw the visualization.
			 var comboChart = new google.visualization.ComboChart(document.getElementById('chart_div'));
			 comboChart.draw(data, {width: 800, height: 300,
			   title : 'Compare facility Rating  with the avarage avareage Facility rating',
			   vAxis: {title: "Rating(%)", minValue: 0, maxValue: 100},
			   hAxis: {title: "Facility" },
			   seriesType: "bars",
			   series: {0: {type: "bars"}}
			 });
			 
			 var comboChart = new google.visualization.ComboChart(document.getElementById('chart_div1'));
			 comboChart.draw(data_s, {width: 800, height: 600,
			   title : 'Compare Rating of <?= $select_fact_name; ?> with the avarage rating',
			   vAxis: {title: "Rating(%)", minValue: 0, maxValue: 100},
			   hAxis: {title: "Facility",textPosition:'none', },
			   seriesType: "bars",
			   series: {0: {type: "bars"}}
			 });
		   }
		   google.setOnLoadCallback(drawVisualization);
 
	  
	  /*google.setOnLoadCallback(drawChart);*/
	  
    </script>
   <div>
   <?php
		$facility_link = $html->url("/admins/FacilityReport/".$posted_id);
	?>
   <a href="<?= $facility_link ?>">View Report</a>
   </div>
   <?php //print_r($sec_av) ?>