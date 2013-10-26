 



    

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
//$section_list = array("","General Facility Information","ETP/Wastewater Treatment Control","Wastewater Sludge","Air Emission","Noise/Sound","Solid/Hazardous Waste","Chemicals/Hazardous Materials","Sewage/Septic System","Spills/Site Contamination","Spill Prevention and Contingency Preparedness Plan","Emergency Response Plan","Environmental Awareness and Training","Cleaner Production","Environmental Management Systems (EMS)");



?>


		
<div style=" background-color:#EBEBEC;margin:5px;padding:40px; width:889px;border-radius:8px;-moz-border-radius:8px;-webkit-border-radius:8px;">
    <div style="margin:-30px 0 0 -27px;padding:0 0 20px;"><b>By Facility</b></div>
            
    <div style="border:1px solid #FFFFFF; width:870px; height:160px; padding:0px 0px 13px 10px; background:#FFF;border-radius:8px;-moz-border-radius:8px;-webkit-border-radius:8px; ">
        
        <form action="" method="post" name="facility_info" >
        
        <div style="float:left; padding:20px 50px 20px 27px">
        Catagories Of Facility ( By rating) <br />
        <?php $chk = ''; if( !empty($_POST['High']) ) $chk='checked="checked"';?>
        <input type="checkbox" <?php echo $chk;?> value="on" name="High"  />High <br/>
        <?php $chk = ''; if( !empty($_POST['Medium'])) $chk='checked="checked"';?>
        <input type="checkbox" <?php echo $chk;?> value="on" name="Medium"  />Medium <br/>
        <?php $chk = ''; if( !empty($_POST['Low'])) $chk='checked="checked"';?>
        <input type="checkbox" <?php echo $chk;?> value="on" name="Low"  />Low 
        </div>
        
        <div style="float:left; padding:20px">
        Select Registered Business name <br />
        <?php
        $bgmea ="";
        $beogwioa="";
        if(!empty($_POST['reg']) ){
             if($_POST['reg']=="BGMEA")	$bgmea='checked="checked"';
            elseif($_POST['reg']=="BEOGWIOA")	$beogwioa='checked="checked"';
        }
        ?>
        <input <?php echo $bgmea; ?> type="radio" value="BGMEA" name="reg"  />BGMEA <br/>
        <input <?php echo $beogwioa; ?> type="radio" value="BEOGWIOA" name="reg" />BEOGWIOA 
        </div>
        
        <div style="float:left; padding:20px 0px 20px 50px">
        City <br />
        
        <select style="width:152px" name="city" >
        <option  selected="selected" value="" >Please Select</option>
        <?php 
            foreach($cities as $factory ){
                $select= "";					
                if(!empty($_POST['city']) & $_POST['city']==$factory['Factory']['city'] )	$select='selected="selected"';
                $factory_id= 0;
                $factory_city = $factory['Factory']['city'];
                //$factory_area = $factory['Factory']['area'];
                
                    echo '<option '.$select.' value="'.$factory_city.'" title="" >'.$factory_city.'</option>' ;
            }
        ?>								
        </select>
        <br/>Area<br />
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
        </div>
        
        <br/><br/><br/><br/><br/><br/>
        <input type="submit" value="Generate Report"  />
        </form>
                
    </div>
    
    
</div>


<span style="text-align:left; padding-left:20px"><h3>Result in Graph</h3></span>
<br />
<div id="chart_div" style="float:left"></div>
<div id="chart_div1" style="float:right"</div>
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
				<td style=" border:0; padding: 10px;  text-align:center"><b>Rating(%)</b></td>
				<td style=" border:0; padding: 10px;  text-align:center"><b>Catagory</b></td>
				<td style=" border:0; padding: 10px;  text-align:center"><b>City</b></td>
				<td style=" border:0; padding: 10px;  text-align:center"><b>Area</b></td>
				<td style=" border:0; padding: 10px;  text-align:center"><b>Details</b></td>
			</tr>
			</thead>
			<tbody>
			<?php 
			$factory_num = 1;
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
						$i++;
					}
					$res = ($total_factory_point/$total_posible_point)*100 ;
					$res = number_format($res, 2, '.', '');
					// End rating in percentage genration
					
					
						
					if( $res<=50) $img='highrisk.png';
					elseif($res>80) $img='lowrisk.png';
					else $img='medrisk.png';
				}
					
				if(!empty($_POST['High']) || !empty($_POST['Medium']) || !empty($_POST['Low']) ){
					if( empty($_POST['High']) & $res<=50 ) continue; 
					if( empty($_POST['Low']) & $res>80) continue; 
					if( empty($_POST['Medium']) & $res>50 & $res<=80 ) continue; 				
				}
				
				echo'<tr><td style=" border:0; padding: 10px;  text-align:center">';
				$name = $factory['AdminFactory']['factory_name'];
				$id = $factory['AdminFactory']['id'];
				//echo $name;
				echo $factory_num.'</td><td style=" border:0; padding: 10px; text-align:center; vertical-align:middle">';	
				echo $this->Html->link($name, array('controller'=>'admins','action' => 'FacilityReport',$id));
				echo'</td><td style=" border:0; padding: 10px; text-align:center; vertical-align:middle">';
				echo $res."%";
				echo '</td><td style=" border:0; text-align:center; vertical-align:middle">';
				echo $html->image($img, array('alt' => 'catagory','border'=>'0') );
				echo '</td><td style=" border:0; padding: 10px; text-align:center; vertical-align:middle">';
				echo $factory['AdminFactory']['city'];
				echo '</td><td style=" border:0; padding: 10px; text-align:center; vertical-align:middle">';
				echo $factory['AdminFactory']['area'];
				echo '</td><td style=" border:0; padding: 10px; text-align:center; vertical-align:middle">';
				echo $this->Html->link("Details", array('controller'=>'admins','action' => 'FacilityReport',$id));
				echo '</td></tr>';
			
				$factory_num++;
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
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('number', 'Rating(%)');
        data.addColumn('number', 'Factory No');
        data.addRows(150);
 
		<?php
			$numb = 1; 
			foreach($factories as $factory){
				
				if( empty($factory['FactoryAnsTable']) & !empty($_POST['reg'])) continue;
				
				

				if(!empty($factory['Rating']) ){
						
					
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
					
					
					if(!empty($_POST['High']) || !empty($_POST['Medium']) || !empty($_POST['Low']) ){
						if( empty($_POST['High']) & $res<=50 ) continue; 
						if( empty($_POST['Low']) & $res>80) continue; 
						if( empty($_POST['Medium']) & $res>50 & $res<=80 ) continue; 				
					}
					
					echo 'data.setValue('.$numb.', 0, '.$numb.'); 
					';
					echo 'data.setValue('.$numb.', 1, '.$res.'); 
					';
					
					$numb++;	
				}
			}
			
			?>
		
			
    

        var chart = new google.visualization.ScatterChart(document.getElementById('chart_div'));
        chart.draw(data, {width: 450, height: 300,
                          title: 'factory num vs. corresponding rating',
                          hAxis: {title: 'factory no', minValue: 0, maxValue: <?= $factory_num+1 ?>, textPosition:'none'},
                          vAxis: {title: 'rating', minValue: 0, maxValue: 100},
                          legend: 'none'
                         });
		
		var chart1 = new google.visualization.LineChart(document.getElementById('chart_div1'));
        chart1.draw(data, {width: 450, height: 300,
                          title: 'factory num vs. corresponding rating',
                          hAxis: {title: 'factory no', minValue: 0, maxValue: 200, textPosition:'none'},
                          vAxis: {title: 'rating', minValue: 0, maxValue: 100},
                          legend: 'none'
                         });
      }
    </script>