
<?php 

/*
echo  '<pre style="text-align:left">';
print_r($questions) ;		
print_r($questions) ;
print_r($factory_answers) ;
print_r($rating_rules) ;
echo '</pre>';
echo $factory_id;
*/
$section = 5;

$section_list = array(" ","General Facility Information","ETP/Wastewater Treatment Control","Wastewater Sludge","Air Emission","Noise/Sound","Solid/Hazardous Waste","Chemicals/Hazardous Materials","Sewage/Septic System","Spills/Site Contamination","Spill Prevention and Contingency Preparedness Plan","Emergency Response Plan","Environmental Awareness and Training","Cleaner Production","Environmental Management Systems (EMS)");	
	

$new_num = "";
$old_num = "";


	echo '<div class="header_title">';
		echo $this->Html->link('Facility', array('controller'=>'admins' ,'action' => 'FacilityReport' , $factory_id)) . " >> ";
		echo "Section - ". ($section);

	echo '</div>';
echo "<center>";
echo "<h3>Complete View</h3>";

?>


<script type="text/javascript">
	
	function showfield(ref){
		
		var dest= "chk_"+ref;
		if( document.getElementById(dest).checked ){
			//alert("cheked");
			document.getElementById(ref).style.display = "block";
		}
		else{
			//alert("Not Check");
			document.getElementById(ref).style.display = "none";
		}
	}
	
</script>

<div class="print_page">
<table style=" width:817px;">

<?php
foreach($questions as $question ){
?>		
	<tr>
		<td width="10%" style=" border:0;  padding: 10px;">
			<b>
			<?php 
			
			//This portion is for generate the number of the question
			
			$new_num = $question['Survey']['section'].".".$question['Survey']['order'];
			if( $new_num != $old_num )
				echo $new_num;
			
			$old_num = $new_num;
			
			?>
			</b>
		</td>
		<td width="40%" style=" border:0;  padding: 10px;"><b>
			<?php echo $question['Survey']['question']; ?></b>
		</td>
		<td style=" text-align:center; vertical-align:middle;" >
			<table width="100%">
			<?php
			
			if( is_array( $question['Answer']) & !empty($question['Answer']) ){
				/*if($question['Survey']['type'] == "1"){
					echo '<tr><td></td><td>
							<div style="float:left; padding:0px 40px 0px 20px;"><input name="'.$new_num.'" type="radio"  /> Yes </div>   
							<div  style="float:left; padding-right:40px;" ><input name="'.$new_num.'" type="radio" /> No </div>
							<div  style="float:left;" ><input name="'.$new_num.'" type="radio" /> N/A </div>
						</td></tr>';
				}*/
				
				foreach( $question['Answer'] as $ans){
					$ans_id = $question['Survey']['id']."_".$ans['id'];
					$name = "chk_".$ans_id;
					
					foreach($factory_answers as $factory_answer ){
						if( $ans['id'] == $factory_answer['FactoryAnsTable']['ans_id'] ){
							echo "<tr><td>";
							echo $ans['answer'];
							echo "</tr></td>";
						}
					}
				}
			}
			else{ 
				//$name = "text_".$question['Survey']['id'];
				//echo '<input style="padding:0;width: 50%;" type="text" name="'.$name.'" />';
				
				foreach($factory_answers as $factory_answer ){
					if( $question['Survey']['id'] == $factory_answer['FactoryAnsTable']['question_id'] ){
						echo $factory_answer['FactoryAnsTable']['text'];
					}
				}
			}
			
			?>
			</table>
		</td>
	</tr>
	

	
<?php
}
?>
</table>
<table style=" width:817px;" class="button_table">
	<tr> 
		<td style="text-align:right">
			<input type="button" value="Print"  onclick="javascript:window.print();" /> 
			<input type="submit" value="Edit" /> 
		</td>
	
	</tr>
</table>
</center>
</div>