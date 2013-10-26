<?php
//$sections = array("General Facility Information","ETP/Wastewater Treatment Control","Wastewater Sludge","Air Emission","Noise/Sound","Solid/Hazardous Waste","Chemicals/Hazardous Materials","Sewage/Septic System","Spills/Site Contamination","Spill Prevention and Contingency Preparedness Plan","Emergency Response Plan","Environmental Awareness and Training","Cleaner Production","Environmental Management Systems (EMS)");

/*function ReArrange($source)
{
	for($i=1;$i<=8;$i++)
	{
		foreach($source as $key=>$val)
		{echo $i."-".$val['section']."/";
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


//echo '<pre style="text-align:left">';
//print_r($factory);
$test = ReArrange( $factory[0]['Rating'],$weight_factor);
//print_r($test);

//print_r($weight_factor);

//echo "</pre>";

?>			










<div class="reports">
<br/><br/>

<div class="report_title">
    <font size="2" color="#333">
        <b><?php echo $factory[0]['Factory']['factory_name'] ?></b> surveyed by <b><?php echo $factory[0]['User']['name'] ?></b>
    </font>
</div>
			
   <br/><br/>
            
            <div class="report_title"><font size="2" color="#333"><b>Report By Section</b></font></div><br/><br/>
            
            
			<table width="950" class="tablesorter" cellpadding="5" cellspacing="5">
				<tr>
					<td style="text-align:center "><b>Section No</b></td>
					<td style="text-align:center "><b>Name</b></td>	
					
					<td style="text-align:center " title="Highest Posible Point"><b>HPP</b></td>	
                    
                    <td style="text-align:center" title="Factory Point"><b>Baseline Status</b></td>	
                    <td style="text-align:center" title="Factory Point"><b>Baseline Rating</b></td>	
                    
                    <td style="text-align:center" title="Factory Point"><b>Follow Up Status</b></td>
                    <td style="text-align:center" title="Factory Point"><b>Follow Up Rating</b></td>	
                    
                    
					<!--<td style="text-align:center"><b>Status</b></td>-->
												
				</tr>
				<?php
				//$i=1;
				$factory_id= $factory[0]['Factory']['id'];
				
				$img = "cross.png";
				$img_baseline = "cross.png";
				$action = "entry";
				
				
				$total_posible_point=0.0;
				
				$total_factory_point_baseline=0.0;
				$total_factory_point=0.0;
				
				
				foreach($weight_factor  as $id=>$wf)
				{
					$i = $wf['WeightFactor']['section_no'];
					//edited by nandinee 2011-06-26 to view only sections those have weight factor =1
					
					$section_name = $wf['WeightFactor']['section_name'];
					$section_wf = $wf['WeightFactor']['weight_factor'];
					
					$point="";
					echo '<tr><td style="text-align:center ">'.$i.'</td><td>';
					
					
					
					//echo $html->link($section_name, array('controller' => 'admins','action' => $action, $i, $factory_id ));
					echo $section_name;
					echo '</td><td style="text-align:center ">';
					 
					
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
					echo '<td style="text-align:center ">';
					echo $html->image($img_baseline, array('alt' => 'tick'));
					echo '</td>';
					//  baseline status end
					
					
					//  baseline point start
					echo '<td style="text-align:center ">';
						echo floatval($section_wf)* floatval($point_baseline);
					echo '</td>';
					//  baseline point end
					
					
					
						
					//  follow up status start
					echo '<td style="text-align:center ">';
					echo $html->image($img, array('alt' => 'tick'));
					echo '</td>';
					//  follow up status end	
					
					
					//  follow up point start
					echo '<td style="text-align:center ">';
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
                
                                
				<td style="text-align:right">
					<?php echo $total_posible_point ?>
				</td>
                
                
                <td style="text-align: center"></td>
                
                
                <td style="text-align: center">
					<?php echo $total_factory_point_baseline ?>					
				</td>
                
                
                <td style="text-align: center"></td>
				
                <td style="text-align: center">
					<?php echo $total_factory_point ?>					
				</td>
                
                
			</tr>
            
            
            <tr>
            <td colspan="7" align="right">
				<?php echo $html->link('Complete View', array('controller' => 'admins','action' => 'CompleteView', $factory_id )); ?>
            </td></tr>
            
            
			</table>
			
				






		
			
            <!--for baseline survey start-->
            <div class="facility_box">
			  <b>Baseline survey Calculation</b>
					<p>
						<b>HPP</b> = Highest Posible Point <br/>
						<!--<b>FP</b> = Factory Point<br/>-->
						Total Posible Point = <?php echo $total_posible_point ?> <br/>
						Total Rating = <?php echo $total_factory_point_baseline ?><br/>
						Rating (in Percentage) = (<?php echo $total_factory_point_baseline ?>/<?php echo $total_posible_point ?>)*100 % 
						= <b><?php	
							$res = ($total_factory_point_baseline/$total_posible_point)*100 ;
							$res = number_format($res, 2, '.', '');
							echo $res."%";
						?></b>
                        
                      </p>
           </div>
           <!--for baseline survey end-->
                      
                     
                      
               
               <!--for follow up survey start-->       
                      
             <div class="facility_box">          
                      
                   <b>Follow up survey Calculation</b>
					<p>
						<!-- <b>WF</b> = weight Factor<br/> -->
						<b>HPP</b> = Highest Posible Point <br/>
						<!--<b>FP</b> = Factory Point<br/>-->
						Total Posible Point = <?php echo $total_posible_point ?> <br/>
						Total Rating = <?php echo $total_factory_point ?><br/>
						Rating (in Percentage) = (<?php echo $total_factory_point ?>/<?php echo $total_posible_point ?>)*100 % 
						= <b><?php	
							$res = ($total_factory_point/$total_posible_point)*100 ;
							$res = number_format($res, 2, '.', '');
							echo $res."%";
						?></b>
						
						
					</p>
						
			</div>
				<!--for follow up survey end-->



			
            <div class="facility_box">     
					
					<b>Facility Information</b>
					<p>
						<?php 
						echo "<b>".$factory[0]['Factory']['factory_name']."</b><br/>";
						echo $factory[0]['Factory']['address']."<br/>";
						echo "Phone: ".$factory[0]['Factory']['telephone']."<br/>";
						echo "Fax: ".$factory[0]['Factory']['fax']."<br/>";
						echo "Contact Person: ".$factory[0]['Factory']['contact_person']."<br/>";
						echo "Email: ".$factory[0]['Factory']['email']."<br/>";

						?>
						
					</p>
				</div>
				<!--for follow up survey end-->
				
<div class="clear"></div>

</div><!--report end-->


				
				
		