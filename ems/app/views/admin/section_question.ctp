<?php
$sections =  array("","General Facility Information","Chemicals/Hazardous Materials Information","Spill Prevention","Spill Response/Emergency Response","Environmental Awareness Training and Training Records","Cleaner Production","Environmental Management Systems (EMS)","Preparation of Action Plan");


//$sections =  array("Chemicals/Hazardous Materials Information"=>2,"Spill Prevention"=>3,"Spill Response/Emergency Response"=>4,"Environmental Awareness Training and Training Records"=>5,"Preparation of Action Plan"=>8);




///////arranging two arrays baseline and followup start
function arrange($baseline,$followup)
{
	
	for ( $i = 0; $i < count($baseline); $i++) 
	{	
		$res[$i]['Zone'] = $baseline[$i]['factories']['Zone'];
		if($baseline[$i]['factories']['id']==$followup[$i]['factories']['id'])
		{
			$res[$i]['id'] = $baseline[$i]['factories']['id'];
			$res[$i]['factory_name'] = $baseline[$i]['factories']['factory_name'];
			
			$res[$i]['baseline'] = $baseline[$i]['RESULT']['Baseline'];
			$res[$i]['followup'] = $followup[$i]['RESULT']['followup'];
		}
	}
	
	return $res;	
}

///////arranging two arrays baseline and followup end






//echo "<pre>";
//print_r($standard_weight_factor);

//print_r($baseline);
//print_r($followup);


//print_r($full);

//echo "</pre>";









/* to fetch the section id of posted sections start*/

$selected_section ="";

if(!empty($_POST))
{
	$op = 0;
		
	for($i=1;$i<=8;$i++)
	{
		$chk = "chk_".$i;
		
		if(!empty($_POST[$chk]) )
		{
			if($op == 0)
			{
				$selected_section = $i;
			}	
			else
			{
				$selected_section.= ",".$i;
			}	
			$op++;
		}
	}

}

//echo $selected_section;
/* to fetch the section id of posted sections start*/
?>			





<div class="reports">
					
<br/><br/>

<div class="report_title">
    <font size="2" color="#333">
        <b>Survey Sections</b>
    </font>
</div>
			
<br/><br/>

<div class="facility_box">    
			<form method="post" action="" >
			<table width="400">
				<tr>
					<td ><b>Select</b></td>
					<td ><b>Name</b></td>
					
				</tr>
				<?php
				/*foreach($sections as $sec_num => $sec_name){
					$name = "chk_".$sec_num;
					if($sec_num != 0 & empty($_POST[$name]) ){
						echo '<tr><td><input type="checkbox" id="'.$name.'" name="'.$name.'" value="1" /></td><td>';
						echo $sec_name.'</td></tr>';
					}
					elseif($sec_num != 0 & !empty($_POST[$name]) ){
						$weight_factor = floatval($_POST[$name]);
						echo '<tr><td><input checked="checked" type="checkbox" id="'.$name.'" name="'.$name.'" value="1" /></td><td>';
						echo $sec_name.'</td></tr>';
					}
				}*/
				
				
				foreach($standard_weight_factor as $sec_num => $sec_name)
				{
					$name = "chk_".$sec_name['WeightFactor']['section_no'];
					
					if($sec_name['WeightFactor']['section_no'] != 0 & empty($_POST[$name]) ){
						echo '<tr><td><input type="checkbox" id="'.$name.'" name="'.$name.'" value="1" /></td><td>';
						echo $sec_name['WeightFactor']['section_name'].'</td></tr>';
					}
					elseif($sec_name['WeightFactor']['section_no'] != 0 & !empty($_POST[$name]) ){
						$weight_factor = floatval($_POST[$name]);
						echo '<tr><td><input checked="checked" type="checkbox" id="'.$name.'" name="'.$name.'" value="1" /></td><td>';
						echo $sec_name['WeightFactor']['section_name'].'</td></tr>';
					}
				}
				
				
				
				?>

			</table>
			<table >
			<tr><td >
				<input type="submit" value="Go"  />
			</td></tr>
			</table>
			</form>
		
</div>

<div class="facility_box">
					<b>Change Calculation</b>
					<p>
						
                        <b>Change (%) </b>= (Responded YES in Last Follow-up - Responded YES in Baseline)/Total Questions asked*100
					</p>
			</div>	
				
				
				
<div class="clear"></div>


			

	
<?php 
if( !empty($_POST) ){
	
$full = arrange($baseline,$followup);
	
?>
	<center>
	<h3>Reports</h3>

	<?php 
	if(!empty($finalSet)){
	
		?>
		<div class="excellExport" style="padding:0 40px 10px 0;text-align:right">
		<a href="" onclick="javascript:x()">Excel Export</a>
		</div>

		<div class="targetTable">
		<table width="950" class="tablesorter" cellpadding="5" cellspacing="5">
			<tr>
				<td ><b>Name</b></td>
				<td ><b>Zone</b></td>
				<td ><b>Total Questions asked</b></td>
				<td ><b>Responded YES in Baseline</b></td>
				<td ><b>Responded YES in Last Follow-up</b></td>
				<td ><b>Change(%)</b></td>
				<td ><b>Details</b></td>
			</tr>
			<?php 
			
			foreach($finalSet as $key=>$val){
				$name = $val[0]['factories']['factory_name'];
				$zone = $val[0]['factories']['Zone'];
				$id = $key;
				$baseline = intval($val[0]['RESULT']['followup']);
				

				$lastFollow = sizeof($val) -1 ;
				$followup = intval($val[$lastFollow]['RESULT']['followup']);

				//$followup = intval($val['followup']);
				$change =  ( intval($followup) -intval($baseline) )/ intval($highest_value);
				$change = round($change,2)*100;
								
				echo'<tr><td >';
									
				echo $this->Html->link($name, array('controller'=>'admins','action' => 'FacilityCustomReport',$id));
				echo'</td><td >';
				echo $zone;
				echo '</td><td >';
				echo $highest_value;
				echo '</td><td >';
				echo $baseline;
				echo '</td><td >';
				echo $followup;
				echo '</td><td >';
				echo '<b>'.$change.'</b>';
				echo '</td><td >';
				
				
				echo $this->Html->link("Details", array('controller'=>'admins','action' => 'CustomCompleteView',$id,$selected_section));
				
				echo '</td></tr>';
			

			}
			///////edited by nandinee 2011-08-06 end
			
		?>
		</table>
		</div>
		
		
<?php
	}
}

?>

</div>
