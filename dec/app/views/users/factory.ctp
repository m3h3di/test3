<?php
$sections = array("General Facility Information","ETP/Wastewater Treatment Control","Wastewater Sludge","Air Emission","Noise/Sound","Solid/Hazardous Waste","Chemicals/Hazardous Materials","Sewage/Septic System","Spills/Site Contamination","Spill Prevention and Contingency Preparedness Plan","Emergency Response Plan","Environmental Awareness and Training","Cleaner Production","Environmental Management Systems (EMS)");



echo '<pre style="text-align:left">';
//print_r($factory);
//print_r($sections);
	//print_r($followups);
echo "</pre>";

?>			
<div class="header_title">
	<?php
		
		echo $this->Html->link('Home', array('controller'=>'users' ,'action' => 'home'))." >> ";
		//echo $factory[0]['Factory']['factory_name'];
		echo $factory[0]['Factory']['factory_name'];
	?>
</div>

<div >
					
	<div style=" background-color:#EBEBEC;float:left;margin:5px;padding:30px; width:450px;border-radius:8px;-moz-border-radius:8px;-webkit-border-radius:8px;">
		<div style="padding:0 0 20px;"><b>Survey Sections</b></div>
			<table width="100%">
				<tr>
					<td style="text-align:center "><b>Section</b></td>
					<td style="text-align:center "><b>Name</b></td>	
					<!--<td style="text-align:center "><b>Rating</b></td>	-->
					<td style="text-align:center"><b>Status</b></td>
												
				</tr>
				<?php
				$i=1;
				$factory_id= $factory[0]['Factory']['id'];
				$img = "cross.png";
				$action = "entry";
				
				foreach($sections  as $id=>$name){
					$point="";
					echo '<tr><td style="text-align:center ">'.$i.'</td><td>';
								
					foreach($factory[0]['Rating'] as $rate_info){
						if($rate_info['section'] == $i & $rate_info['status'] == 1){
							$img = "tick.png";
							$action = "showans";
							if( !empty($rate_info['points']) )$point= $rate_info['points'];
							break;
						}
						else {
							$img = "cross.png";
							$action = "entry";
							$point = "--";
						}
					}
					
					echo $html->link($name, array('controller' => 'surveys','action' => $action, $i, $factory_id ));
					//echo '</td><td style="text-align:center ">';
					//echo $point;
					echo '</td><td style="text-align:center ">';
					echo $html->image($img, array('alt' => 'tick'));
					
					echo '</td></tr>';
																				
					$i++;
				}
				?>
						
			</table>
			<table width="100%">
			<tr><td style="text-align:right">
				<?php 
				if( $factory[0]['Factory']['status'] == 0 )
					echo $html->link('Done', array('controller' => 'surveys','action' => 'SaveFacility', $factory_id )); 
				//else echo $html->link('Follow Up', array('controller' => 'users','action' => 'followup',$factory_id )); 
				?> 
				<?php echo $html->link('Full View', array('controller' => 'surveys','action' => 'CompleteView', $factory_id )); ?>
			</td></tr>
			</table>
				</div>

			  <div style=" background-color:#EBEBEC;float:left;margin:5px;padding:30px; width:350px;border-radius:8px;-moz-border-radius:8px;-webkit-border-radius:8px;">
					<div style="padding:0 0 20px;"><b>Facility Information</b></div>
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
                    <?php 
					if( $factory[0]['Factory']['status'] != 0 ){
						?>
						<table width="100%">
						<tr>
							<td style="text-align:center; font-weight:bold">Follow Up</td>
							<td style="text-align:center; font-weight:bold">status</td>
							<td style="text-align:center; font-weight:bold " >Entry</td>
							<td style="text-align:center; font-weight:bold " >Doc</td>
						</tr>
						<?php
						$i=1;
						foreach($followups as $followup){?>
							<tr>
								<td style="text-align:center;">Follow up No. <?= $i; ?></td>
								<td style="text-align:center;"><?= $html->image("tick.png", array('alt' => 'tick')); ?></td>
								<td style="text-align:center;"><? echo $html->link('view', array('controller' => 'users','action' => 'FollowupView',$factory_id,1 ));?></td>
								<td style="text-align:center;"><a target="_blank" href="/sedf-ecp/files/<?= $followup['followups']['doc'] ?>">doc</a></td>
							</tr>
						
						
							<?
							$i++;
						}
						?>
						<tr>
							 <td style="text-align:center;">Follow up No. <?= $i; ?></td>
							 <td style="text-align:center;"><?= $html->image("cross.png", array('alt' => 'tick')); ?></td>
							 <td  style="text-align:center;"><? echo $html->link('Add', array('controller' => 'users','action' => 'followup',$factory_id,$i ));?></td>
							 <td style="text-align:center;">--</td>
						</tr>
						</table>
						<?php
					}
					?>
				</div>
				
				
				
				<div class="clr"></div>
				
			</div>
			<div class="body_footer">
				<div class="clr"></div>
			</div>