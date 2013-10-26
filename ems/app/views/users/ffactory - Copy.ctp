<?php
 $sections = array("General Facility Information","Chemicals/Hazardous Materials Information","Spill Prevention","Spill Response/Emergency Response","Environmental Awareness Training and Training Records","Cleaner Production","Environmental Management Systems (EMS)","Preparation of Action Plan");



//echo '<pre style="text-align:left">';
//print_r($factory);
//print_r($sections);
//echo "</pre>";

?>	
<div class="reports">

		


<br/><br/>

<div class="report_title">
    <font size="2" color="#333">
        <b>
        <?php
		
		echo $this->Html->link('Home', array('controller'=>'users' ,'action' => 'home'))." >> ";
		//echo $factory[0]['Factory']['factory_name'];
		echo $factory[0]['Factory']['factory_name'];
	?>
        </b>
    </font>
</div>
			
   <br/><br/>


		
 <div class="report_title">
    <font size="2" color="#333">
        <b>Survey Sections</b>
    </font>
</div>       			
	
    
    
			<table width="950" class="tablesorter" cellpadding="5" cellspacing="5">
				<tr>
					<td style="text-align:center "><b>Section</b></td>
					<td style="text-align:center "><b>Name</b></td>	
					<!--<td style="text-align:center "><b>Rating</b></td>	-->
					<td style="text-align:center"><b>BaseLine Survey</b></td>
                    <td style="text-align:center"><b>Follow-Up Survey</b></td>
												
				</tr>
				<?php
				$i=1;
				$factory_id= $factory[0]['Factory']['id'];
				$img = "cross.png";
				$f_img = "cross.png";
				$action = "fentry";
				//$faction = "fentry";
				
				foreach($sections  as $id=>$name){
					$point="";
					echo '<tr><td style="text-align:center ">'.$i.'</td><td>';
								
					foreach($factory[0]['Rating'] as $rate_info){
						if($rate_info['section'] == $i & $rate_info['status'] == 0){
							$img = "tick.png";
							//$action = "showans";
							if( !empty($rate_info['points']) )$point= $rate_info['points'];
							break;
						}
						else {
							$img = "cross.png";
							//$action = "entry";
							$point = "--";
						}						
					}
					
					foreach($factory[0]['Rating'] as $rate_info){
						if($rate_info['section'] == $i & $rate_info['status'] == 1){
							$f_img = "tick.png";
							$action = "fshowans";
							if( !empty($rate_info['points']) )$point= $rate_info['points'];
							break;
						}
						else {
							$f_img = "cross.png";
							$action = "fentry";
							$point = "--";
						}			
					}
					
					//echo $html->link($name, array('controller' => 'surveys','action' => $action, $i, $factory_id ));
					echo "<b>".$name."</b>";
					
					
					echo '</td><td style="text-align:center ">';
					echo $html->image($img, array('alt' => 'tick'));
					echo " ".$html->link('view', array('controller' => 'surveys','action' => 'showans', $i, $factory_id ));
					
					
					echo '</td><td style="text-align:center ">';
					echo $html->image($f_img, array('alt' => 'tick'));
					echo " ".$html->link('view', array('controller' => 'surveys','action' => $action, $i, $factory_id ));
					
					echo '</td></tr>';
																				
					$i++;
				}
				?>
            
            
            <tr><td style="text-align:right" colspan="4">
				<?php 
				if( $factory[0]['Factory']['status'] == 0 )
				echo $html->link('Done', array('controller' => 'surveys','action' => 'SaveFacility', $factory_id )); 
				
				?> 
				<?php echo $html->link('Full View', array('controller' => 'surveys','action' => 'CompleteView', $factory_id )); ?>
			</td></tr>   
						
			</table>
            
          
				



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
			