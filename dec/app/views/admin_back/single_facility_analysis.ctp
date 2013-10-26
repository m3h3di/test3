 



    

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



?>


		
<div style=" background-color:#EBEBEC;margin:5px;padding:40px; width:889px;border-radius:8px;-moz-border-radius:8px;-webkit-border-radius:8px;">
    <div style="margin:-30px 0 0 -27px;padding:0 0 20px;"><b>Please Select a Facility</b></div>
            
    <div style="border:1px solid #FFFFFF; width:870px; height:160px; padding:0px 0px 13px 10px; background:#FFF;border-radius:8px;-moz-border-radius:8px;-webkit-border-radius:8px; ">
        
        <form action="" method="post" name="facility_info" style="padding:20px;" >
        <select name="fact" size="6" style="width:700px">
        	        	
                        <?php
						foreach($factories as $factory){
							$bb= $factory['AdminFactory']['factory_name'];
							$bbi= $factory['AdminFactory']['id'];
							echo '<option value="'.$bbi.'">'.$bb.'</option>';
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

<div id="target_div"  name="target_div">
	
	<?php 
	if(!empty($factories)){
		
		?>
        
		<center>
        <br />
		
        <br />
		<table id="myTable" class="tablesorter" style=" width:97%" >
			<thead>
			<tr>
				
			</tr>
			</thead>
			<tbody>
			<?php 
			$factory_num = 1;
			$actual_factory_num = 1;
			$actual_total_point = 0;
			$temp_total_point = 0;
			for($x=1; $x<= 14; $x++){
				$sec[$x] = 0 ;
			}
			foreach($factories as $factory){
				
				if( empty($factory['FactoryAnsTable']) & !empty($_POST['reg'])) continue;
				
				

				if(!empty($factory['Rating']) ){
						
					//$sum = 0;
					/*foreach($factory['Rating'] as $pnt){
						$sum += intval($pnt['points']);
					}
					$res=$sum/70*100;*/
					
					// Start rating in percentage genration
					$total_posible_point=0;
					$total_factory_point=0;
					$i=1;
					foreach($weight_factor  as $id=>$wf){
						$section_wf = $wf['WeightFactor']['weight_factor'];
						
						$point=0;
						foreach($factory['Rating'] as $rate_info){
							if($rate_info['section'] == $i & $rate_info['status'] == 1){
								if( !empty($rate_info['points']) ) $point= $rate_info['points'];
								else $point=0;
								break;
							}							
						}
						
						$total_posible_point += ( floatval($section_wf)* 5.0 );
						$total_factory_point += ( floatval($section_wf)* floatval($point) );
						$sec[$i] += $total_factory_point ;
						$i++;
					}
					$res = ($total_factory_point/$total_posible_point)*100 ;
					$res = number_format($res, 2, '.', '');
					// End rating in percentage genration
					
					
						
					if( $res<=50) $img='highrisk.png';
					elseif($res>80) $img='lowrisk.png';
					else $img='medrisk.png';
				}
					
								
				
				$name = $factory['AdminFactory']['factory_name'];
				$id = $factory['AdminFactory']['id'];
				
				$temp_total_point+=$res;
				$factory_num++;
			}
			$temp_avarage= round($temp_total_point/($factory_num-1),2);
			
			for($x=1;$x<=14;$x++){
				$sec_av[$x]= round($sec[$x]/($factory_num-1),2);
			}
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
			   ['Name', 'Rating', 'Average'],
			   <?php
			   		
					$num=1;
					foreach($factories as $factory){
						
						if( empty($factory['FactoryAnsTable']) & !empty($_POST['reg'])) continue;
						
						
						
						if(!empty($factory['Rating']) ){
							if($factory['AdminFactory']['id'] != $posted_id) continue;
							
							// Start rating in percentage genration
							$total_posible_point=0;
							$total_factory_point=0;
							$i=1;
							foreach($weight_factor  as $id=>$wf){
								$section_wf = $wf['WeightFactor']['weight_factor'];
								
								$point=0;
								foreach($factory['Rating'] as $rate_info){
									if($rate_info['section'] == $i & $rate_info['status'] == 1){
										if( !empty($rate_info['points']) ) $point= $rate_info['points'];
										else $point=0;
										break;
									}							
								}
								$total_posible_point += ( floatval($section_wf)* 5.0 );
								$total_factory_point += ( floatval($section_wf)* floatval($point) );
								$i++;
							}
							$res = ($total_factory_point/$total_posible_point)*100 ;
							//$res = ($total_factory_point/$total_posible_point) ;
							$res = number_format($res, 2, '.', '');
							// End rating in percentage genration
							
							
							
							
							$name = $factory['AdminFactory']['factory_name'];
							
							echo "['".$name."', ".$res.", $temp_avarage],
							";
							$num++;
							
								
						}
					}
			   ?>
			 ]);
	
			  var data_s = google.visualization.arrayToDataTable([
			   ['Name', 'Rating', 'Average'],
			   <?php
					$num=1;
					foreach($factories as $factory){
						
						if( empty($factory['FactoryAnsTable']) & !empty($_POST['reg'])) continue;
						
						
						
						if(!empty($factory['Rating']) ){
							if($factory['AdminFactory']['id'] != $posted_id) continue;
							
							// Start rating in percentage genration
							$total_posible_point=0;
							$total_factory_point=0;
							$i=1;
							foreach($weight_factor  as $id=>$wf){
								$section_wf = $wf['WeightFactor']['weight_factor'];
								
								$point=0;
								foreach($factory['Rating'] as $rate_info){
									if($rate_info['section'] == $i & $rate_info['status'] == 1){
										if( !empty($rate_info['points']) ) $point= $rate_info['points'];
										else $point=0;
										break;
									}							
								}
								
								
								$total_posible_point += ( floatval($section_wf)* 5.0 );
								$total_factory_point += ( floatval($section_wf)* floatval($point) );
								
								$name =$section_list[$i];
								
								$av = $sec_av[$i];
								echo "['".$name."', ".$total_factory_point.", $av],
								";
								
								$i++;
								
							}
												
								
						}
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
			 comboChart.draw(data_s, {width: 800, height: 300,
			   title : 'Compare Rating of <?= $name; ?> with the avarage rating',
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