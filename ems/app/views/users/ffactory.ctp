<?php
 $sections = array("General Facility Information","Chemicals/Hazardous Materials Information","Spill Prevention","Spill Response/Emergency Response","Environmental Awareness Training and Training Records","Cleaner Production","Environmental Management Systems (EMS)","Preparation of Action Plan");



echo '<pre style="text-align:left">';
//print_r($factory);
//print_r($sections);
echo "</pre>";

$numberOfFollowUp = $factory[0]['Factory']['status'];
//echo $numberOfFollowUp;
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

<?php
	for($j=1;$j<= $numberOfFollowUp; $j++){
?>
<div class="report_title">
    <font size="2" color="#333">
        <b>FollowUp - <?= $j ?></b>
    </font>
</div>       			
	
    
    
			<table width="950" class="tablesorter" cellpadding="5" cellspacing="5">
				<tr>
					<td style="text-align:center "><b>Section</b></td>
					<td style="text-align:center "><b>Name</b></td>	
					
					
                    <td style="text-align:center"><b>Follow-Up Survey No - <?= $j ?></b></td>
												
				</tr>
				<?php
				$i=1;
				$factory_id= $factory[0]['Factory']['id'];
				$img = "cross.png";
				$f_img = "cross.png";
				//$action = "fentry";
				//$faction = "fentry";
				
				foreach($sections  as $id=>$name){
					$action = "fentry";
					$point="";
					echo '<tr><td style="text-align:center ">'.$i.'</td><td>';
								
					foreach($factory[0]['Rating'] as $rate_info){
						if($rate_info['section'] == $i & $rate_info['status'] == $j){
							$f_img = "tick.png";
							//$action = "showans";
							$action = "fshowans";
							if( !empty($rate_info['points']) )$point= $rate_info['points'];
							break;
						}
						else {
							$f_img = "cross.png";
							//$action = "entry";
							$point = "--";
						}						
					}
					
					
					
					//echo $html->link($name, array('controller' => 'surveys','action' => $action, $i, $factory_id,$j ));
					echo "<b>".$name."</b>";
					
					
					
					
					
					echo '</td><td style="text-align:center ">';
					echo $html->image($f_img, array('alt' => 'tick'));
					echo " ".$html->link('view', array('controller' => 'surveys','action' => $action, $i, $factory_id ,$j));
					
					echo '</td></tr>';
																				
					$i++;
				}
				?>
			</table>
			<div style="text-align:right;padding-right:40px">
				<?php 
				if($j == $numberOfFollowUp)
					echo $html->link('Done', array('controller' => 'surveys','action' => 'SaveFacility', $factory_id,$j )); 
				?>
			</div>
			<br /><br /><br />

<?php
	}
?>		
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
			