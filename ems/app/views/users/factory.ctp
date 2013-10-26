<?php
 $sections = array("General Facility Information","Chemicals/Hazardous Materials Information","Spill Prevention","Spill Response/Emergency Response","Environmental Awareness Training and Training Records","Cleaner Production","Environmental Management Systems (EMS)","Preparation of Action Plan");



//echo '<pre style="text-align:left">';
//print_r($factory);
//print_r($sections);
//echo "</pre>";

?>			
<div class="header_title">
	<?php
		
		echo $this->Html->link('Home', array('controller'=>'users' ,'action' => 'home'))." >> ";
		//echo $factory[0]['Factory']['factory_name'];
		echo $factory[0]['Factory']['factory_name'];
	?>
</div>

<div >
					
	<div style="float:left;margin:5px;padding:40px; width:400px">
		<div style="margin:-30px 0 0 -27px;padding:0 0 20px;"><b>Survey Sections</b></div>
			<table width="100%" class="tablesorter">
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
						if($rate_info['section'] == $i & $rate_info['status'] == 0){
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
				
				?> 
				<?php echo $html->link('Full View', array('controller' => 'surveys','action' => 'CompleteView', $factory_id )); ?>
			</td></tr>
			</table>
				</div>

				<div style="float:left;margin:5px 5px 5px 0px;padding-top:40px ; width:400px">
					
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
				
				<div class="clr"></div>
				
			</div>
			<div class="body_footer">
				<div class="clr"></div>
			</div>