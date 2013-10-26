<?php  echo $javascript->link('jquery.min.js'); ?>
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
//$section_list = array("","General Facility Information","ETP/Wastewater Treatment Control","Wastewater Sludge","Air Emission","Noise/Sound","Solid/Hazardous Waste","Chemicals/Hazardous Materials","Sewage/Septic System","Spills/Site Contamination","Spill Prevention and Contingency Preparedness Plan","Emergency Response Plan","Environmental Awareness and Training","Cleaner Production","Environmental Management Systems (EMS)");



?>


<div class="admin_home"><!--admin_home start-->


	<div class="reports"><!--reports start--><br/>
    	<div class="report_title">
        	<font size="4" color="#333333"><b>By Facility</b></font>
    	</div>
        <br/><br/>
        
        <table width="900" border="0" cellpadding="0" cellspacing="0">
            <form action="" method="post" name="facility_info" >
            <tr>
                <td>
                	<font size="2" color="#333"><b>Categories Of Facility (By rating)</b></font><br/><br/>
                
                
					<?php $chk = ''; if( !empty($_POST['High']) ) $chk='checked="checked"';?>
                    <input type="checkbox" <?php echo $chk;?> value="on" name="High"  /> 81-100<br/>
                    
                    <?php $chk = ''; if( !empty($_POST['Medium'])) $chk='checked="checked"';?>
                    <input type="checkbox" <?php echo $chk;?> value="on" name="Medium"  /> 51-80 <br/>
                    
                    
                    <?php $chk = ''; if( !empty($_POST['Low'])) $chk='checked="checked"';?>
                    <input type="checkbox" <?php echo $chk;?> value="on" name="Low"  /> 0-50
                
                </td>
                
                <td valign="bottom">
                	
                    <font size="2" color="#333"><b>EPZ</b></font><br/><br/>
                
                    <select name="area" >
                    <option  selected="selected" value="" >Please Select</option>
                    <?php 
                        foreach($areas as $factory ){
                            $select= "";					
                            if(!empty($_POST['area']) & $_POST['area']==$factory['Factory']['area'] )	$select='selected="selected"';
                            $factory_area = $factory['Factory']['area'];
                            //$factory_area = $factory['Factory']['area'];
                            
                                echo '<option '.$select.' value="'.$factory_area.'" title="" >'.$factory_area.'</option>' ;
                        }
                    ?>								
                    </select>
                
                </td>
                
                <td valign="bottom"><input type="submit" value="Generate Report"  /></td>
                
            </tr>
    		</form>
    
    
    	</table>
        
        
    <br/><br/>
    
    <div id="chart_div" ></div>
    
    <br/><br/>
    
    
    
    <?php 
	if(!empty($factories)){
		
		?>
		
		<div class="report_title"><font size="2" color="#333"><b>Generated Report for selected ratings</b></font></div><br/><br/>
        
		<table id="myTable" class="tablesorter" cellpadding="5" cellspacing="5" width="950" >
			<thead>
			<tr >
				<th><b>Name</b></th>
				<th><b>Rating(%)</b></th>
				<th><b>Category</b></th>
				<!--<th><b>City</b></th>-->
				<th><b>EPZ</b></th>
				<th><b>Details</b></th>
			</tr>
			</thead>
			<!--<tbody>-->
			<?php 
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
						$total_posible_point += ( floatval($section_wf)* 20.0 );
						$total_factory_point += ( floatval($section_wf)* floatval($point) );
						$i++;
					}
					$res = ($total_factory_point/$total_posible_point)*100 ;
					$res = number_format($res, 2, '.', '');
					// End rating in percentage genration
					
					
						
					if( $res<=50) 
						//$img='highrisk.png' ;
						$status = "0-50";
					elseif($res>80) 
						//$img='lowrisk.png';
						$status = "81-100";
					else 
						//$img='medrisk.png';
						$status = "51-80";
				}
					
				if(!empty($_POST['High']) || !empty($_POST['Medium']) || !empty($_POST['Low']) ){
					/*if( empty($_POST['High']) & $res<=50 ) continue; 
					if( empty($_POST['Low']) & $res>80) continue; 
					if( empty($_POST['Medium']) & $res>50 & $res<=80 ) continue; */	
					
					if( empty($_POST['Low']) & $res<=50 ) continue; 
					if( empty($_POST['High']) & $res>80) continue; 
					if( empty($_POST['Medium']) & $res>50 & $res<=80 ) continue; 				
				}
				
				echo'<tr><td>';
				$name = $factory['AdminFactory']['factory_name'];
				$id = $factory['AdminFactory']['id'];
				//echo $name;
					
				echo $this->Html->link($name, array('controller'=>'admins','action' => 'FacilityReport',$id));
				echo'</td><td>';
				
				//echo $res."%";
				echo $res;
				$final_result[]= array($name,$res);
				
				echo '</td><td>';
				//echo $html->image($img, array('alt' => 'catagory','border'=>'0') );
				echo $status;
				
				/*echo '</td><td style=" border:0; padding: 10px; text-align:center; vertical-align:middle">';
				echo $factory['AdminFactory']['city'];*/
				
				echo '</td><td>';
				echo $factory['AdminFactory']['area'];
				
				echo '</td><td>';
				echo $this->Html->link("Details", array('controller'=>'admins','action' => 'FacilityReport',$id));
				echo '</td></tr>';
			

			}
			
			?>
			<!--</tbody>-->
		</table>
		
        <br/><br/>
		
<?php } ?>
    
    
    </div><!--reports end-->
    
</div><!--admin_home end-->
	




<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      
	  google.load("visualization", "1", {packages:["corechart"]});
      
		 function drawVisualization() {
			 // Some raw data (not necessarily accurate)
			 var data = google.visualization.arrayToDataTable([
			   ['Name', 'Rating','Mid Risk','Low Risk'],
			   <?php
					$num=1;
					foreach($final_result as $val){
							
							$name = $val[0];
							$res=$val[1];
							$name = trim($name,"'");
							echo "['".$name."', ".$res.",50,80 ],
							";
							$num++;
					
					}
			   ?>
			 ]);
	
			 // Create and draw the visualization.
			 var comboChart = new google.visualization.ComboChart(document.getElementById('chart_div'));
			 comboChart.draw(data, {width: 950, height: 500,
			   title : 'Compare Rating of Different Facilities',
			   vAxis: {title: "Rating(%)", minValue: 0, maxValue: 90},
			   hAxis: {title: "Facility",textPosition:'none', },
				/*chartArea:{left:0,top:0,width:"90%",height:"90%"},*/
			   seriesType: "bars",
			   series: {0: {color: 'blue'},1: {type: "line",color: 'yellow'},2: {type: "line",color: 'green'}}
			   
			 });
		   }
		   google.setOnLoadCallback(drawVisualization);
 
	  
	  /*google.setOnLoadCallback(drawChart);*/
	  
    </script>
	
	
<script type="text/javascript">
$(document).ready(function() 
    { 
        $("#myTable").tablesorter(); 
    } 
); 
</script>
