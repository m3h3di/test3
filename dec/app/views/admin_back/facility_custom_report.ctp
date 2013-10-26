<?php
$custom_weight_factor = $this->Session->read('custom_weight_factor');

//echo '<pre style="text-align:left">';
//print_r($custom_weight_factor);
//print_r($factory);
//print_r($weight_factor);
//echo "</pre>";

?>			

<div class="header_title">
<b><?php echo $factory[0]['Factory']['factory_name'] ?></b> surveyed by <b><?php echo $factory[0]['User']['name'] ?></b>
</div>

<div >
					
	<div style=" background-color:#D8D2C3;float:left;margin:5px;padding:40px; width:550px">
		<div style="margin:-30px 0 0 -27px;padding:0 0 20px;">
		<b>Details</b>
		</div>
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
					
					$post_array_name = "chk_".$wf['WeightFactor']['section_no'];
					if( empty($custom_weight_factor[$post_array_name]) ){
						$i++;
						continue;
					}
					else $section_wf = $custom_weight_factor[$post_array_name];
					
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
			

					
	</div>

	<div style=" background-color:#D8D2C3;float:left;margin:5px 5px 5px 0px;padding:40px ; width:250px">
					<div style="margin:-30px 0 0 -27px;padding:0 0 20px;"><b>Calculation</b>
					</div>
					<p>
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
						
						<br/><br/><br/>
					</p>
										
	</div>
				
			<div class="clr">
			</div>

</div>










<div >
					
	<div style=" background-color:#D8D2C3;float:left;margin:5px;padding:40px; width:550px">
		<div style="margin:-30px 0 0 -27px;padding:0 0 20px;">
		<b>Full Details</b>
		</div>
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

				<?php echo $html->link('Complete View', array('controller' => 'admins','action' => 'CompleteView', $factory_id )); ?>
			</td></tr>
		</table>
					
	</div>

	<div style=" background-color:#D8D2C3;float:left;margin:5px 5px 5px 0px;padding:40px ; width:250px">
					<div style="margin:-30px 0 0 -27px;padding:0 0 20px;"><b>Calculation</b>
					</div>
					<p>
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
						
						<br/><br/><br/>
					</p>
					<div style="margin:-30px 0 0 -27px;padding:0 0 20px;"><b>Facility Information</b>
					</div>
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
				
			<div class="clr">
			</div>

</div>
<div class="body_footer">
	<div class="clr"></div>
</div>
