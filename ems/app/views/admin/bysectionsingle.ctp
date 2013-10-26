<?php
$sections =  array("Chemicals/Hazardous Materials Information"=>2,"Spill Prevention"=>3,"Spill Response/Emergency Response"=>4,"Environmental Awareness Training and Training Records"=>5,"Preparation of Action Plan"=>8);



//echo '<pre>';
//print_r($section_overview);
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






<script type="text/javascript">
function set_value(src){

	var dest_id = "chk_"+src.id;
	var dest = document.getElementById(dest_id);
	dest.value = src.value;
	//alert(dest.value);	
	
}
</script>


<div class="reports">
<br /><br />					
		
        
 <div class="report_title">
    <font size="2" color="#333">
       <b>Survey Sections</b>
    </font>
</div>
        
     
    
    <div class="facility_box">    
			<form method="post" action="" >
			<table width="400">
				<tr>
					<td style="text-align:center "><b>Select</b></td>
					<td style="text-align:center "><b>Name</b></td>
                    
                    
					<!--<td style="text-align:center "><b>Weight</b></td>	-->																
				</tr>
				<?php
				foreach($sections as $sec_name => $sec_num){
					$name = "chk_".$sec_num;
					if($sec_num != 0 & empty($_POST[$name]) ){
						echo '<tr><td><input type="checkbox" id="'.$name.'" name="'.$name.'" value="1" /></td><td>';
						
						//echo $sec_name.'</td><td style="text-align:center ">';
						echo $sec_name;
						
						//echo '<input onkeyup="javascript: set_value(this)" type="text" id="'.$sec_num.'" value="1"  style="width:30px; text-align:center;" /></td></tr>';
					}
					elseif($sec_num != 0 & !empty($_POST[$name]) ){
						$weight_factor = floatval($_POST[$name]);
						echo '<tr><td><input checked="checked" type="checkbox" id="'.$name.'" name="'.$name.'" value="1" /></td><td>';
						
						//echo $sec_name.'</td><td style="text-align:center ">';
						echo $sec_name;
						
						//echo '<input onkeyup="javascript: set_value(this)" type="text" id="'.$sec_num.'" value="'.$weight_factor.'"  style="width:30px; text-align:center;" /></td></tr>';
					}
				}
				?>



			<tr><td colspan="2" ><input  type="submit" value="Go"  /></td></tr>
            
			</table>
			
			
            </div>	
            
            


			<div class="facility_box">
					<b>Select Facility</b>
					<select name="factory" size="10" >
                    	<?php
						$status=0;
						foreach($Factories as $fact){
							$value = $fact["factories"]["id"];
							$name = $fact["factories"]["factory_name"];
							
							if($_POST['factory']){
								if($value == $_POST['factory']) 
									$select = 'selected="selected"';
								else $select = '';
							}
							else{
								if($status == 0){
									$select = 'selected="selected"';
									$status = 1;
								}
								else $select = '';
							}
							
							
							
							echo '<option '.$select.' value="'.$value.'">'.$name.'</option>';
						}
						?>
                    </select>

			</div>

				
			</form>	
				
<div class="clear"></div>





	
<?php if( !empty($_POST) ){ ?>


<div class="report_title">
    <font size="2" color="#333">
       <b>Generated report for selected sections</b>
    </font>
</div>

<br />

	<?php 
	if(!empty($sfactory)){
	
		?>
		<div class="excellExport" style="padding:0 40px 10px 0;text-align:right">
		<a href="" onclick="javascript:x()">Excel Export</a>
		</div>

		<div class="targetTable">
		<table width="950" class="tablesorter" cellpadding="5" cellspacing="5">
			<tr>
				<td><b>Name</b></td>
				<td><b>Zone</b></td>				
				<td><b>Survey</b></td>
                <td><b>Highest Possible Value</b></td>
                <td><b>Points</b></td>
                <td><b>Rating(%)</b></td>	

			</tr>
			<?php 
			foreach($sfactory as $key=>$val){
				
				$Points = intval($val['RESULT']['point']);
				$name = $val['factories']['factory_name'];
				$zone = $val['factories']['Zone'];
				$id = $val['factories']['id'];
				
				$rating = intval($Points)/ intval($highest_value);
				$rating = round($rating,2)*100;
				
				if($val['RESULT']['status'] == 0) $survey = "Baseline";
				else $survey = "follow Up -".$val['RESULT']['status'];
				
								
				echo'<tr><td>';
									
				echo $this->Html->link($name, array('controller'=>'admins','action' => 'FacilityCustomReport',$id));
				echo'</td><td>';
				echo $zone."";
				
				echo'</td><td>';
				echo $survey;
				
				echo '</td><td>';
				echo $highest_value;
				
				echo '</td><td>';
				echo $Points;
				
				echo '</td><td>';
				echo $rating."%";
				echo '</td></tr>';
			

			}
			
		?>
		</table>
		</div>
		<br /><br />
		
<?php }
	
}
?>


</div>
