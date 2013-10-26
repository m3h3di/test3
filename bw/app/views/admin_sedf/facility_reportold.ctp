<?php
//$sections = array("General Facility Information","ETP/Wastewater Treatment Control","Wastewater Sludge","Air Emission","Noise/Sound","Solid/Hazardous Waste","Chemicals/Hazardous Materials","Sewage/Septic System","Spills/Site Contamination","Spill Prevention and Contingency Preparedness Plan","Emergency Response Plan","Environmental Awareness and Training","Cleaner Production","Environmental Management Systems (EMS)");



echo '<pre style="text-align:left">';
//print_r($factory);
//print_r($weight_factor);
//print_r($sections);
echo "</pre>";

?>			

<div class="header_title">
<b><?php echo $factory[0]['Factory']['factory_name'] ?></b> surveyed by <b><?php echo $factory[0]['User']['name'] ?></b>
</div>

<div >
					
	<div style=" background-color:#EBEBEC;float:left;margin:5px;padding:30px; width:535px;border-radius:8px;-moz-border-radius:8px;-webkit-border-radius:8px;">
		<div style=";padding:0 0 20px;"><b>View Report By Section</b></div>
			<table width="100%">
				<tr>
					<td style="text-align:center "><b>Section</b></td>
					<td style="text-align:center "><b>Name</b></td>	
					<td style="text-align:center "><b>Rating</b></td>
					<td style="text-align:center" title="Weight Factor"><b>WF</b></td>
					<td style="text-align:center" title="Factory Point"><b>FP</b></td>	
					<td style="text-align:center " title="Highest Posible Point"><b>HPP</b></td>	
					<td style="text-align:center"><b>Status</b></td>
												
				</tr>
				<?php
				$i=1;
				$factory_id= $factory[0]['Factory']['id'];
				$img = "cross.png";
				$action = "entry";
				$total_posible_point=0.0;
				$total_factory_point=0.0;
				
				
				foreach($weight_factor  as $id=>$wf){
					$section_name = $wf['WeightFactor']['section_name'];
					$section_wf = $wf['WeightFactor']['weight_factor'];
					
					$point="";
					echo '<tr><td style="text-align:center ">'.$i.'</td><td>';
								
					foreach($factory[0]['Rating'] as $rate_info){
						if($rate_info['section'] == $i & $rate_info['status'] == 1){
							$img = "tick.png";
							$action = "SectionReport";
							if( !empty($rate_info['points']) )$point= $rate_info['points'];
							else $point=0;
							break;
						}
						else {
							$img = "cross.png";
							$action = "entry";
							//$point = "N/A";
						}
					}
					
					echo $html->link($section_name, array('controller' => 'admins','action' => $action, $i, $factory_id ));
					echo '</td><td style="text-align:center ">';
					echo $point;
					
					
					echo '</td><td style="text-align:center ">';
					echo $section_wf;
					
					echo '<td style="text-align:center ">';
					echo floatval($section_wf)* floatval($point);
					
					echo '</td><td style="text-align:center ">';
					echo floatval($section_wf)* 5.0;
					
					echo '</td>	</td><td style="text-align:center ">';
					echo $html->image($img, array('alt' => 'tick'));
					echo '</td></tr>';
																				
					$i++;
					$total_posible_point += ( floatval($section_wf)* 5.0 );
					$total_factory_point += ( floatval($section_wf)* floatval($point) );
				}
				
				
				
				?>
						
			
			<tr >
				<td colspan="4" style="text-align: center;">
					<b>Total</b>
				</td>
				<td style="text-align: center">
					<?php echo $total_factory_point ?>					
				</td>
				<td style="text-align:right">
					<?php echo $total_posible_point ?>
				</td>
				<td style=" width:39px">
					
				</td>
			</tr>
			</table>
			
			<table width="100%">
			<tr><td style="text-align:right">
				<?php echo $html->link('Follow Up', array('controller' => 'admins','action' => 'followup', $factory_id )); ?>
                &nbsp;&nbsp;
				<?php echo $html->link('Complete View', array('controller' => 'admins','action' => 'CompleteView', $factory_id )); ?>
			</td></tr>
			</table>
					
				</div>

			  <div style=" background-color:#EBEBEC;float:left;margin:5px 5px 5px 0px;padding:30px ; width:300px;border-radius:8px;-moz-border-radius:8px;-webkit-border-radius:8px;">
					<div style="padding:0 0 20px;"><b>Calculation</b></div>
					<p style="border-radius:8px;-moz-border-radius:8px;-webkit-border-radius:8px; background:#FFF; padding:20px; font-size:12px">
						<b>WF</b> = weight Factor<br/>
						<b>HPP</b> = Highest Posible Point <br/>
						<b>FP</b> = Factory Point<br/>
						Total Posible Point = <?php echo $total_posible_point ?> <br/>
						Total Factory Point = <?php echo $total_factory_point ?><br/>
						Rating (in Percentage) = (<?php echo $total_factory_point ?>/<?php echo $total_posible_point ?>)*100 % <br/>
						= <b><?php	
							$res = ($total_factory_point/$total_posible_point)*100 ;
							$res = number_format($res, 2, '.', '');
							echo $res."%";
						?></b>
						
						
					</p>
					<div style=";padding:0 0 20px;"><b>Facility Information</b></div>
					<p style="border-radius:8px;-moz-border-radius:8px;-webkit-border-radius:8px; background:#FFF; padding:20px; font-size:12px">
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
				

				<div><a href="/sedf-ecp/admins/SingleFacilityAnalysis/<?= $factory_id?>">View Analytics</a></div>
				<div class="clr"></div>
				
			</div>
			<div class="body_footer">
				<div class="clr"></div>
			</div>