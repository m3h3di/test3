<?php
$custom_weight_factor = $this->Session->read('custom_weight_factor');

//echo '<pre style="text-align:left">';
//print_r($custom_weight_factor);
//print_r($factory);
//print_r($weight_factor);

//echo "</pre>";


/*function ReArrange($source)
{
	for($i=1;$i<=8;$i++){
			
			
		foreach($source as $key=>$val){
			if( intval($val['section']) == $i and intval($val['status']) == 0 ) $res[$i]['base'] = $val['points'];
			elseif( intval($val['section']) == $i and intval($val['status']) != 0 ) $res[$i]['follow'] = $val['points'];
		}
	}
	return $res;		
}*/


//edited by nandinee 2011-06-26 to view only sections those have weight factor = 1
function ReArrange($source,$weight_factor)
{
	//print_r( $weight_factor);
	foreach($weight_factor as $key1=>$val1)
	{
		$i = $val1['WeightFactor']['section_no'];
	
		foreach($source as $key=>$val)
		{
			if( intval($val['section']) == $i and intval($val['status']) == 0 ) $res[$i]['base'] = $val['points'];
			elseif( intval($val['section']) == $i and intval($val['status']) != 0 ) $res[$i]['follow'] = $val['points'];
		
		}
	
	}

	return $res;		
}
//edited by nandinee 2011-06-26 to view only sections those have weight factor =1



echo '<pre style="text-align:left">';
//print_r($sections);
$test = ReArrange( $factory[0]['Rating'],$weight_factor);
//print_r($test);
echo "</pre>";

?>			







<div class="reports">
<br/><br/>

<div class="report_title">
    <font size="2" color="#333">
        <b><?php echo $factory[0]['Factory']['factory_name'] ?></b> surveyed by <b><?php echo $factory[0]['User']['name'] ?></b>
    </font>
</div>
			
   
   <br/><br/>
            
<div class="report_title"><font size="2" color="#333"><b>Report By Selected Section</b></font></div>
            
 
<div class="report_list">   
<table width="400" class="tablesorter" cellpadding="5" cellspacing="5">


				<tr>
					
                    <td ><b>Section</b></td>
					<td ><b>Name</b></td>	
					
					<td title="Highest Posible Point"><b>HPP</b></td>	
                    
                    
                    <td title="Factory Point"><b>Baseline Status</b></td>	
                    <td title="Factory Point"><b>Baseline Rating</b></td>	
                    
                    
                    <td title="Factory Point"><b>Follow Up Status</b></td>
                    <td title="Factory Point"><b>Follow Up Rating</b></td>	
												
				</tr>
				<?php
				//$i=1;

				$factory_id= $factory[0]['Factory']['id'];
				$img = "cross.png";
				$action = "entry";
				$total_posible_point=0.0;
				
				$total_factory_point_baseline=0.0;
				$total_factory_point=0.0;
				
				
				foreach($weight_factor  as $id=>$wf){
					
					$i = $wf['WeightFactor']['section_no'];
					//edited by nandinee 2011-06-26 to view only sections those have weight factor =1
					
					$section_name = $wf['WeightFactor']['section_name'];
					
					$post_array_name = "chk_".$wf['WeightFactor']['section_no'];
					if( empty($custom_weight_factor[$post_array_name]) ){
						//$i++;
						continue;
					}
					else $section_wf = $custom_weight_factor[$post_array_name];
					
					$point="";
					echo '<tr><td >'.$i.'</td><td>';
						
						
					
					// edited by nandinee 2011-06-09 end (for baseline and follow up survey)
					
					//echo $html->link($section_name, array('controller' => 'admins','action' => $action, $i, $factory_id ));
					echo $section_name;
					echo '</td><td>';
					 
					
					echo floatval($section_wf)* 20.0;
					echo '</td>';
					
					
					
						foreach($test as $stage=>$base_follow)
						{	
							if($stage == $i)
							{
								$img_baseline = "tick.png";
								$action = "SectionReport";
								
								if(isset($base_follow['base']))
								//echo $base_follow['base'].",";
									$point_baseline= $base_follow['base'];
								else
									$point_baseline= 0;
									
									break;
							}
							
							else 
							{
								$img_baseline = "cross.png";
								$action = "entry";
							}
							
						}
						
						
						
						
						foreach($test  as $stage=>$base_follow)
						{
							if($stage == $i)
							{
								$img = "tick.png";
								$action = "SectionReport";
								
								if(isset($base_follow['follow']))
								//echo $base_follow['base'].",";
									$point= $base_follow['follow'];
								else
									$point= 0;
									
								break;
							}
							
							else 
							{
								$img = "cross.png";
								$action = "entry";
							}
							
						}
					
					// edited by nandinee 2011-06-09 end (for baseline and follow up survey)
					
					
					//  baseline status start
					echo '<td >';
					echo $html->image($img_baseline, array('alt' => 'tick'));
					echo '</td>';
					//  baseline status end
					
					
					
					//  baseline point start
					echo '<td >';
						echo floatval($section_wf)* floatval($point_baseline);
					echo '</td>';
					//  baseline point end
					
					
					
					//  follow up status start
					echo '<td >';
					echo $html->image($img, array('alt' => 'tick'));
					echo '</td>';
					//  follow up status end	
					
					
					//  follow up point start
					echo '<td >';
						echo floatval($section_wf)* floatval($point);
					echo '</td></tr>';
					//  follow up point end	
						
					
					
																				
					//$i++;
					$total_posible_point += ( floatval($section_wf)* 20.0 );
					
					
					$total_factory_point_baseline += ( floatval($section_wf)* floatval($point_baseline) );
					
					$total_factory_point += ( floatval($section_wf)* floatval($point) );
					
				}
				
				
				
				?>
						
            <tr >
				<td colspan="2" style="text-align: center;">
					<b>Total</b>
				</td>
                
                                
				<td >
					<?php echo $total_posible_point ?>
				</td>
                
                                
                <td ></td>
                <td >
					<?php echo $total_factory_point_baseline ?>					
				</td>
                
                
                <td ></td>
                <td >
					<?php echo $total_factory_point ?>					
				</td>
				
			</tr>
            
		</table>
			
</div>


<div class="report_list">
	<!--for baseline survey start-->
    			<div class="facility_box">
					<b>Baseline survey Calculation</b><br/>
					
						<b>HPP</b> = Highest Posible Point <br/>
						<b>FP</b> = Factory Point<br/>
						Total Posible Point = <?php echo $total_posible_point ?> <br/>
						Total Factory Point = <?php echo $total_factory_point_baseline ?><br/>
						Rating (in Percentage) = (<?php echo $total_factory_point_baseline ?>/<?php echo $total_posible_point ?>)*100 
						= <b><?php	
							$res = ($total_factory_point_baseline/$total_posible_point)*100 ;
							$res = number_format($res, 2, '.', '');
							echo $res."%";
						?></b>
                </div>
         <!--for baseline survey end-->       
                      
                   
                    
               <!--for follow up survey start-->     
                    <div class="facility_box">  
                    <b>Follow up survey Calculation</b><br/>
					
						<!-- <b>WF</b> = weight Factor<br/> -->
						<b>HPP</b> = Highest Posible Point <br/>
						<b>FP</b> = Factory Point<br/>
						Total Posible Point = <?php echo $total_posible_point ?> <br/>
						Total Factory Point = <?php echo $total_factory_point ?><br/>
						Rating (in Percentage) = (<?php echo $total_factory_point ?>/<?php echo $total_posible_point ?>)*100 
						= <b><?php	
							$res = ($total_factory_point/$total_posible_point)*100 ;
							$res = number_format($res, 2, '.', '');
							echo $res."%";
						?></b>
					</div>	
				 <!--for follow up survey end-->     		
                 
                 
                 
                  <div class="facility_box">  
                    <b>Facility Information</b>
					
						<?php 
						echo "<b>".$factory[0]['Factory']['factory_name']."</b><br/>";
						echo $factory[0]['Factory']['address']."<br/>";
						echo "Phone: ".$factory[0]['Factory']['telephone']."<br/>";
						echo "Fax: ".$factory[0]['Factory']['fax']."<br/>";
						echo "Contact Person: ".$factory[0]['Factory']['contact_person']."<br/>";
						echo "Email: ".$factory[0]['Factory']['email']."<br/>";

						?>
					</div>
				
		<div class="clear"></div>

</div>

<div class="clear"></div>




<div class="report_title"><font size="2" color="#333"><b>Full Details</b></font></div>
<div class="report_list">					
		<table width="420" class="tablesorter" >
				<tr>
					
                    <td ><b>Section</b></td>
					<td ><b>Name</b></td>	
					
					<td title="Highest Posible Point"><b>HPP</b></td>	
                    
                    
                    <td title="Factory Point"><b>Baseline Status</b></td>	
                    <td title="Factory Point"><b>Baseline FP</b></td>	
                    
                    
                    <td title="Factory Point"><b>Follow Up Status</b></td>
                    <td title="Factory Point"><b>Follow Up FP</b></td>	
                    
                    
                    
												
				</tr>
				<?php
				//$i=1;
				$factory_id= $factory[0]['Factory']['id'];
				$img = "cross.png";
				$action = "entry";
				$total_posible_point1=0.0;
				
				$total_factory_point_baseline1=0.0;
				$total_factory_point1=0.0;
				
				
				
				foreach($weight_factor  as $id=>$wf){
					$i = $wf['WeightFactor']['section_no'];
					
					$section_name = $wf['WeightFactor']['section_name'];
					$section_wf = $wf['WeightFactor']['weight_factor'];
					
					$point="";
					echo '<tr><td >'.$i.'</td><td>';
								
					
					
					//echo $html->link($section_name, array('controller' => 'admins','action' => $action, $i, $factory_id ));
					echo $section_name;
					echo '</td><td >';
					 
					
					echo floatval($section_wf)* 20.0;
					echo '</td>';
					
					
					// edited by nandinee 2011-06-09 start (for baseline and follow up survey)	
					
						foreach($test as $stage=>$base_follow)
						{	
							if($stage == $i)
							{
								$img_baseline = "tick.png";
								$action = "SectionReport";
								
								if(isset($base_follow['base']))
								//echo $base_follow['base'].",";
									$point_baseline= $base_follow['base'];
								else
									$point_baseline= 0;
									
									break;
							}
							
							else 
							{
								$img_baseline = "cross.png";
								$action = "entry";
							}
							
						}
						
						
						
						
						foreach($test  as $stage=>$base_follow)
						{
							if($stage == $i)
							{
								$img = "tick.png";
								$action = "SectionReport";
								
								if(isset($base_follow['follow']))
								//echo $base_follow['base'].",";
									$point= $base_follow['follow'];
								else
									$point= 0;
									
								break;
							}
							
							else 
							{
								$img = "cross.png";
								$action = "entry";
							}
							
						}
					
					// edited by nandinee 2011-06-09 end (for baseline and follow up survey)
					
					
					
					//  baseline status start
					echo '<td >';
					echo $html->image($img_baseline, array('alt' => 'tick'));
					echo '</td>';
					//  baseline status end
					
					//  baseline point start
					echo '<td >';
						echo floatval($section_wf)* floatval($point_baseline);
					echo '</td>';
					//  baseline point end
					
					
					
						
					//  follow up status start
					echo '<td >';
					echo $html->image($img, array('alt' => 'tick'));
					echo '</td>';
					//  follow up status end	
					
					//  follow up point start
					echo '<td >';
						echo floatval($section_wf)* floatval($point);
					echo '</td></tr>';
					//  follow up point end	
					
																				
					//$i++;
					$total_posible_point1 += ( floatval($section_wf)* 20.0 );
					
					
					$total_factory_point_baseline1 += ( floatval($section_wf)* floatval($point_baseline) );
					
					$total_factory_point1 += ( floatval($section_wf)* floatval($point) );
					
					
					
					
					
				}
				
				
				
				?>
						
            
            <tr >
				<td colspan="2">
					<b>Total</b>
				</td>
                
                                
				<td >
					<?php echo $total_posible_point1 ?>
				</td>
                
                                
                <td ></td>
                <td >
					<?php echo $total_factory_point_baseline1 ?>					
				</td>
                
                
                <td ></td>
				<td >
					<?php echo $total_factory_point1 ?>					
				</td>
                
			</tr>
            
            
         
         <tr>
         	<td colspan="7" align="right"><b>
            <?php echo $html->link('Complete View', array('controller' => 'admins','action' => 'CompleteView', $factory_id )); ?></b>
            </td>
         </tr>  
            
		</table>
			
            
            
       

				
			
	</div>
    
    
    
<div class="report_list">
				<div class="facility_box">    
					<b>Baseline Calculation</b><br/>
					
						<b>WF</b> = weight Factor<br/>
						<b>HPP</b> = Highest Posible Point <br/>
						<b>FP</b> = Factory Point<br/>
						Total Posible Point = <?php echo $total_posible_point1 ?> <br/>
						Total Factory Point = <?php echo $total_factory_point_baseline1 ?><br/>
						Rating (in Percentage) = (<?php echo $total_factory_point_baseline1 ?>/<?php echo $total_posible_point1 ?>)*100 
						= <b><?php	
							$res = ($total_factory_point_baseline1/$total_posible_point1)*100 ;
							$res = number_format($res, 2, '.', '');
							echo $res."%";
						?></b>
                  </div>    
                        
                        
                    
                 <div class="facility_box">    
                    <b>Follow up Calculation</b><br/>
					
						<b>WF</b> = weight Factor<br/>
						<b>HPP</b> = Highest Posible Point <br/>
						<b>FP</b> = Factory Point<br/>
						Total Posible Point = <?php echo $total_posible_point1 ?> <br/>
						Total Factory Point = <?php echo $total_factory_point1 ?><br/>
						Rating (in Percentage) = (<?php echo $total_factory_point1 ?>/<?php echo $total_posible_point1 ?>)*100 
						= <b><?php	
							$res = ($total_factory_point1/$total_posible_point1)*100 ;
							$res = number_format($res, 2, '.', '');
							echo $res."%";
						?></b>
						
				</div>


			<div class="clear"></div>
				
</div>

			
<div class="clear"></div>
</div>

