<?php
$sections = array("","General Facility Information","ETP/Wastewater Treatment Control","Wastewater Sludge","Air Emission","Noise/Sound","Solid/Hazardous Waste","Chemicals/Hazardous Materials","Sewage/Septic System","Spills/Site Contamination","Spill Prevention and Contingency Preparedness Plan","Emergency Response Plan","Environmental Awareness and Training","Cleaner Production","Environmental Management Systems (EMS)");



//echo '<pre style="text-align:left">';
//print_r($factory);
//print_r($weight_factor);
//print_r($sections);
//echo "</pre>";

?>			

<div class="header_title">
<b><?php echo $factory[0]['factories']['factory_name'] ?></b> <!--surveyed by <b><?php echo $factory[0]['User']['name'] ?>--></b>
</div>

<div >
					
	<div style=" background-color:#EBEBEC;float:left;margin:5px;padding:30px; width:535px;border-radius:8px;-moz-border-radius:8px;-webkit-border-radius:8px;">
		<div style=";padding:0 0 20px;"><b>View Report By Section</b></div>
			<table width="100%">
				<tr>
					<td style="text-align:center "><b>Section</b></td>
					<td style="text-align:center "><b>Name</b></td>	
					<td style="text-align:center" title="Weight Factor"><b>WF</b></td>
					<td style="text-align:center" title="Heighest Possible Point"><b>HPP</b></td>
                    <td style="text-align:center" title="Factory Point Due to Local Standard"><b>FP</b></td>
                    <td style="text-align:center" title="Point Due to H&M Standard"><b>H&M</b></td>
					<td style="text-align:center " title="Point Due to WRAP Standard"><b>WRAP</b></td>	

												
				</tr>
				<?php
				$i=1;
				$factory_id= $factory[0]['factories']['id'];
				$img = "cross.png";
				$action = "entry";
				$total_posible_point=0.0;
				$total_factory_point=0.0;
				$total_hnm_point=0.0;
				$total_wrap_point=0.0;
				
				
				foreach($factory  as $key=>$fact){
					$section_no = $fact['rating_rules']['section'];
					$section_name = $sections[$section_no];
					
					echo '<tr><td style="text-align:center ">'.$section_no.'</td><td>';
					echo $html->link($section_name, array('controller' => 'admins','action' => 'SectionReport', $section_no, $factory_id ));
					echo '</td><td style="text-align:center ">';
					echo 1;
					
					
					echo '</td><td style="text-align:center ">';
					echo 5;
					
					echo '<td style="text-align:center ">';
					//echo floatval($section_wf)* floatval($point);
					echo $fact['rating_rules']['point'];
					
					echo '</td><td style="text-align:center ">';
					//echo floatval($section_wf)* 5.0;
					echo $fact['rating_rules']['point_hnm'];
					
					echo '</td>	</td><td style="text-align:center ">';
					echo $fact['rating_rules']['point_wrap'];
					
					echo '</td></tr>';
																				
					$i++;
					
					//$total_posible_point += ( floatval($section_wf)* 5.0 );
					//$total_factory_point += ( floatval($section_wf)* floatval($point) );
					
					$total_posible_point += 5.0;
					$total_factory_point += ( $fact['rating_rules']['point'] );
					$total_hnm_point += $fact['rating_rules']['point_hnm'];
					$total_wrap_point += $fact['rating_rules']['point_wrap'];
				}
				
				
				
				?>
						
			
			<tr >
				<td colspan="3" style="text-align: center;">
					<b>Total</b>
				</td>
				<td style="text-align: center">
					<?php echo $total_posible_point ?>					
				</td>
				<td style="text-align:center">
					<?php echo $total_factory_point ?>
				</td>
                <td style="text-align:center">
					<?php echo $total_hnm_point ?>
				</td>
                <td style="text-align:center">
					<?php echo $total_wrap_point ?>
				</td>
				
			</tr>
			</table>
			
			<table width="100%">
			<tr><td style="text-align:right">
				<?php //echo $html->link('Follow Up', array('controller' => 'admins','action' => 'followup', $factory_id )); ?>
                <?php
					$analytivs_link = $html->url("/admins/SingleFacilityAnalysis/".$factory_id);
				?>
				<a href="<?= $analytivs_link ?>">View Analytics</a>
                    
                &nbsp;&nbsp;
				<?php echo $html->link('Complete View', array('controller' => 'admins','action' => 'CompleteView', $factory_id )); ?>
			</td></tr>
			</table>
			<?php 
					if( !empty($followups) ){
						?>
						<table width="100%">
						<tr>
							<td style="text-align:center; font-weight:bold">Follow Up</td>
                            <td style="text-align:center; font-weight:bold">Date</td>
							<td style="text-align:center; font-weight:bold">Status</td>
							<td style="text-align:center; font-weight:bold " >Entry</td>
							<td style="text-align:center; font-weight:bold " >Doc</td>
						</tr>
						<?php
						$i=1;
						foreach($followups as $followup){?>
							<tr>
								<td style="text-align:center;">No. <?= $i; ?></td>
                                <td style="text-align:center;"><?= $followup['followups']['fw_date'] ?></td>
								<td style="text-align:center;"><?= $html->image("tick.png", array('alt' => 'tick')); ?></td>
								<td style="text-align:center;"><? echo $html->link('view', array('controller' => 'admins','action' => 'FollowupView',$factory_id,1 ));?></td>
								<td style="text-align:center;"><a target="_blank" href="/sedf-ecp/files/<?= $followup['followups']['doc'] ?>">doc</a></td>
							</tr>
						
						
							<?
							$i++;
						}
						?>
						</table>
						<?php
					}
					?>
            		
				</div>

			  <div style=" background-color:#EBEBEC;float:left;margin:5px 5px 5px 0px;padding:30px ; width:300px;border-radius:8px;-moz-border-radius:8px;-webkit-border-radius:8px;">
					<div style="padding:0 0 20px;"><b>Calculation</b></div>
					<p style="border-radius:8px;-moz-border-radius:8px;-webkit-border-radius:8px; background:#FFF; padding:20px; font-size:12px">
						<b>WF</b> = weight Factor<br/>
						<b>HPP</b> = Highest Posible Point <br/>
						<b>FP</b> = Factory Point (Due to local standard)<br/>
                        <b>H&M</b> = Factory Point (Due to H&M standard)<br/>
                        <b>WRAP</b> = Factory Point (Due to WRAP standard)<br/><br/>
						
						Rating (local standard in Percentage) <br />= (<?php echo $total_factory_point ?>/<?php echo $total_posible_point ?>)*100 % <br/>
						= <b><?php	
							$res = ($total_factory_point/$total_posible_point)*100 ;
							$res = number_format($res, 2, '.', '');
							echo $res."%";
						?></b><br /><br />
						Rating (H&M standard in Percentage) <br/>= (<?php echo $total_hnm_point ?>/<?php echo $total_posible_point ?>)*100 % <br/>
						= <b><?php	
							$res = ($total_hnm_point/$total_posible_point)*100 ;
							$res = number_format($res, 2, '.', '');
							echo $res."%";
						?></b> <br /><br />
                        Rating (WRAP standard in Percentage) <br />= (<?php echo $total_wrap_point ?>/<?php echo $total_posible_point ?>)*100 % <br/>
						= <b><?php	
							$res = ($total_wrap_point/$total_posible_point)*100 ;
							$res = number_format($res, 2, '.', '');
							echo $res."%";
						?></b>
						
					</p>
					<div style=";padding:0 0 20px;"><b>Facility Information</b></div>
					<p style="border-radius:8px;-moz-border-radius:8px;-webkit-border-radius:8px; background:#FFF; padding:20px; font-size:12px">
						<?php 
						echo "<b>".$factory[0]['factories']['factory_name']."</b><br/>";
						echo $factory[0]['factories']['address']."<br/>";
						echo "Phone: ".$factory[0]['factories']['telephone']."<br/>";
						echo "Fax: ".$factory[0]['factories']['fax']."<br/>";
						echo "Contact Person: ".$factory[0]['factories']['contact_person']."<br/>";
						echo "Email: ".$factory[0]['factories']['email']."<br/>";

						?>
						
					</p>
					
					
				</div>
				
				<!--
				<div>
					<?php
					$analytivs_link = $html->url("/admins/SingleFacilityAnalysis/".$factory_id);
					?>
					<a href="<?= $analytivs_link ?>">View Analytics</a>
				</div>
                -->
				<div class="clr"></div>
				
			</div>
			<div class="body_footer">
				<div class="clr"></div>
			</div>