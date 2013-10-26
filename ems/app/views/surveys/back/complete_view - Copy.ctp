
<?php 


//echo  '<pre style="text-align:left">';
//print_r($questions) ;		
//print_r($factory_answers) ;
//print_r($rating_rules) ;
//echo '</pre>';
//echo $factory_id;


$section_list = array(" ","General Facility Information","ETP/Wastewater Treatment Control","Wastewater Sludge","Air Emission","Noise/Sound","Solid/Hazardous Waste","Chemicals/Hazardous Materials","Sewage/Septic System","Spills/Site Contamination","Spill Prevention and Contingency Preparedness Plan","Emergency Response Plan","Environmental Awareness and Training","Cleaner Production","Environmental Management Systems (EMS)");	
	

$new_num = "";
$old_num = "";


	echo '<div class="header_title">';
		echo $this->Html->link('Home', array('controller'=>'users' ,'action' => 'home'))." >> ";
		$factory_name = trim($factory_name);
		echo $this->Html->link($factory_name, array('controller'=>'users' ,'action' => 'factory' , $factory_id)) . " >> ";
		echo "All Sections";

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
	if($question['Survey']['type'] == 6)
		continue;
?>		
	<tr>
		<td width="10%" style=" border:0; background:#CFE0E8; padding: 10px;">
			<b>
			<?php 
			
			//This portion is for generate the number of the question
			
			$new_num = $question['Survey']['section'].".".intval($question['Survey']['order']);
			if( $new_num != $old_num )
				echo $new_num;
			
			$old_num = $new_num;
			
			?>
			</b>
		</td>
		<?php
	//========= start inside table
	if($question['Survey']['type'] == 5){ ?>
		<td colspan="2">
			<?php echo $question['Survey']['question']; ?>
		</td>
	</tr>
	<tr>
		<td width="10%" style=" border:0; background:#CFE0E8; padding: 10px;">
		</td>
		<td colspan="2">
			<table>
				<tr>
					<td  style="text-align:center" width="50%"><b>Parameter (Unit)</b></td>
					<td  style="text-align:center"><b>Supplied</b></td>
					<td  style="text-align:center" width="25%"><b>Standard</b></td>
				</tr>
				<?php
				foreach($questions as $inside_table_ques ){
					if($inside_table_ques['Survey']['type'] != 6 || $inside_table_ques['Survey']['status'] != $question['Survey']['status'] || $inside_table_ques['Survey']['section'] != $question['Survey']['section'] )
						continue;
					
					$inside_table_ans_text = "";
					foreach($factory_answers as $factory_answer ){
						if( $inside_table_ques['Survey']['id'] == $factory_answer['FactoryAnsTable']['question_id'] ){
							$inside_table_ans_text = $factory_answer['FactoryAnsTable']['text'];
						}
					}
					
					
					$ques2split = $inside_table_ques['Survey']['question'] ;
					$splitted_text = explode(":", $ques2split) ;
					$name = "text_".$inside_table_ques['Survey']['id'];
					?>
				
				<tr>
					<td style="text-align:center"><?php echo $splitted_text[0]; ?></td>
					<td style="text-align:center" ><?php echo $inside_table_ans_text ?></td>
					<td style="text-align:center"><?php echo $splitted_text[1]; ?></td>
				</tr>
				
					<?php 
				}
				?>
			</table>
		</td>
	</tr>
	<?php 
	} 	//========== End inside table
	else{ 
	?>
		<td width="40%" style=" border:0; background:#CADBE3; padding: 10px;"><b>
			<?php echo $question['Survey']['question']; ?></b>
		</td>
		<td style="background:#CFE0E8; text-align:center; vertical-align:middle;" >
			<table width="100px">
			<?php
			
			if( is_array( $question['Answer']) & !empty($question['Answer']) ){
								
				foreach( $question['Answer'] as $ans){
					$ans_id = $question['Survey']['id']."_".$ans['id'];
					$name = "chk_".$ans_id;
					
					foreach($factory_answers as $factory_answer ){
						if( $ans['id'] == $factory_answer['FactoryAnsTable']['ans_id'] ){
											
							echo "<tr><td>";
							if( $ans['type'] == 1 ){
								echo $ans['answer'] ." ( ". $factory_answer['FactoryAnsTable']['text']. " ) ";
							}
							else echo $ans['answer'] ;
							echo "</tr></td>";
						}
					}
				}
			}
			else{ 
				//$name = "text_".$question['Survey']['id'];
				//echo '<input style="padding:0;width: 50%;" type="text" name="'.$name.'" />';
				$ans_radio_text = "";
				foreach($factory_answers as $factory_answer ){
					if( $question['Survey']['id'] == $factory_answer['FactoryAnsTable']['question_id'] ){
						if( $factory_answer['FactoryAnsTable']['type'] == "radio" )
							$ans_radio_text = " < ".$factory_answer['FactoryAnsTable']['text']." > ".$ans_radio_text;
						
						else $ans_radio_text .= $factory_answer['FactoryAnsTable']['text'];
					}
				}
				echo $ans_radio_text;
			}
			
			?>
			</table>
		</td>
	<?php 
	}
	?>
	</tr>
	

	
<?php
}
?>
</table>
<table style=" width:817px;" class="button_table">
	<tr> 
		<td style="text-align:right">
			<input type="button" value="Print"  onclick="javascript:window.print();" /> 

		</td>
	
	</tr>
</table>
</center>
</div>