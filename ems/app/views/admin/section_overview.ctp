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
			
			</form>
            </div>	
            
            

			
			<div class="facility_box">
					<b>Change Calculation</b>
					<p>
						
                        <b>Change (%) </b>= (Last Followup Rating - Baseline Rating)/Highest Possible Value*100
					</p>
			</div>	
				
				
				
<div class="clear"></div>





	
<?php if( !empty($_POST) ){ ?>


<div class="report_title">
    <font size="2" color="#333">
       <b>Generated report for selected sections</b>
    </font>
</div>

<br />

	<?php 
	if(!empty($finalSet)){
	
		?>
		<div class="excellExport" style="padding:0 40px 10px 0;text-align:right">
		<a href="" onclick="javascript:x()">Excel Export</a>
		</div>

		<div class="targetTable">
		<table width="950" class="tablesorter" cellpadding="5" cellspacing="5">
			<tr>
				<td><b>Name</b></td>
				<td><b>Zone</b></td>
				<td><b>Highest Possible Value</b></td>
				<td><b>Baseline Rating</b></td>
				<td><b>Last Followup Rating</b></td>
				<td><b>Change (%) </b></td>
				<td><b>Details</b></td>
			</tr>
			<?php 
			foreach($finalSet as $key=>$val){
				
				$baseline = intval($val[0]['RESULT']['point']);
				foreach($val as $k=>$v){
					$lastFollow = $k;
				}	
				$followup = intval($val[$lastFollow]['RESULT']['point']);
				
				$name = $val[$lastFollow]['factories']['factory_name'];
				$zone = $val[$lastFollow]['factories']['Zone'];
				$id = $val[$lastFollow]['factories']['id'];
				
				
				$change =  ( intval($followup) -intval($baseline) )/ intval($highest_value);
				$change = round($change,2)*100;
								
				echo'<tr><td>';
									
				echo $this->Html->link($name, array('controller'=>'admins','action' => 'FacilityCustomReport',$id));
				echo'</td><td>';
				echo $zone."";
				echo'</td><td>';
				echo $highest_value;
				echo '</td><td>';
				echo $baseline;
				echo '</td><td>';
				echo $followup;
				echo '</td><td>';
				echo '<b>'.$change.'</b>';
				echo '</td><td>';
				
				
				//echo $this->Html->link("Details", array('controller'=>'admins','action' => 'FacilityCustomReport',$id));
				
				
				
				//echo $this->Html->link("Details", array('controller'=>'admins','action' => 'CompleteView',$id));
				
				
				echo $this->Html->link("Details", array('controller'=>'admins','action' => 'CustomCompleteView',$id,$selected_section));
				
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
