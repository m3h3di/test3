<?php 
$section_list =  array("","General Facility Information","Chemicals/Hazardous Materials Information","Spill Prevention","Spill Response/Emergency Response","Environmental Awareness Training and Training Records","Cleaner Production","Environmental Management Systems (EMS)","Preparation of Action Plan");

	//echo  '<pre style="text-align:left">';
	//print_r($questions) ;		
	//print_r($factory_answers) ;
	//print_r($rating_rules) ;
	//print_r($rating) ;
	//echo '</pre>';
	//echo $factory_id;
	
//	echo array_search("61",$question);

$new_num = "";
$old_num = "";
//$section = intval($section) - 1 ;

?>

<div class="header_title">
	<?php
	
		echo $this->Html->link('Home', array('controller'=>'users' ,'action' => 'home'))." >> ";
		$factory_name = trim($factory_name);
		echo $this->Html->link($factory_name, array('controller'=>'users' ,'action' => 'factory' , $factory_id)) . " >> ";
		echo "Edit Section - ". ($section);
	?>
</div>


<!-- start of the entry page -->

<center>
<?php echo "<h3>". $section_list[$section] ."</h3>"; ?>

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
	
	function showType2(dest , ref){
		
		if( dest.value == "yes"  ){
			document.getElementById(ref).style.display = "block";
			//alert(dest.value);
		}
		else{
			//alert(dest.value);
			document.getElementById(ref).style.display = "none";
			document.getElementById(ref).value = "";
		}
	}
	
</script>
<?php echo $form->create('Survey', array('action' => 'process1','name'=>'test')); ?>

<input type="hidden" value="<?php echo $section; ?>" name="section"  />
<input type="hidden" value="<?php echo $factory_id; ?>" name="factory_id"  />

<table style=" width:817px;">

<?php

// Object is to place the factory answer information to the the question-answer lists


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
					if($inside_table_ques['Survey']['type'] != 6 || $inside_table_ques['Survey']['status'] != $question['Survey']['status'] )
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
					<td style="text-align:center"><input style="padding:0;width: 50%;" value="<?php echo $inside_table_ans_text ?>" type="text" name="<?php echo $name; ?>" /></td>
					<td style="text-align:center"><?php echo $splitted_text[1]; ?></td>
				</tr>
				
					<?php 
				}
				?>
			</table>
		</td>
	</tr>
	<?php 
	}	//========= End inside table
	
	else{ 
	?>
		<td width="40%" style=" border:0; background:#CADBE3; padding: 10px;"><b>
			<?php echo $question['Survey']['question']; ?></b>
		</td>
		<td style="background:#CFE0E8; text-align:center; vertical-align:middle;" >
			<table width="100px">
			<?php
				$name = "radio_".$question['Survey']['id'];
				$chk_radio_yes = "";
				$chk_radio_no = "";
				$chk_radio_na = "";
				$value= "";
				$text_value ="";		
				//start checking( with value retrieve) this question is in the factory answer list
				foreach($factory_answers as $factory_answer ){
					if( $question['Survey']['id'] == $factory_answer['FactoryAnsTable']['question_id'] ){
						$value =  $factory_answer['FactoryAnsTable']['text'];
						if($value == "yes")	$chk_radio_yes = "checked";
						elseif($value == "no")	$chk_radio_no = "checked";
						elseif($value == "na")	$chk_radio_na = "checked";
						
						if( $question['Survey']['type'] == "2" & $factory_answer['FactoryAnsTable']['type'] =="text" )
							$text_value = $factory_answer['FactoryAnsTable']['text'];
						
					}
				}
				//End checking( with value retrieve) this question is in the factory answer list
								
				if($question['Survey']['type'] == "1"){
					
					
					echo '<tr><td></td><td>
							<div style="float:left; padding:0px 40px 0px 20px;"><input '.$chk_radio_yes.' name="'.$name.'" type="radio" value="yes" /> Yes </div>   
							<div  style="float:left; padding-right:40px;" ><input '.$chk_radio_no.' name="'.$name.'" type="radio" value="no" /> No </div>
							<div  style="float:left;" ><input '.$chk_radio_na.' name="'.$name.'" type="radio" value="na" /> N/A </div>
						</td></tr>';
				}
				
				if($question['Survey']['type'] == "2"){
					$detect_id = $question['Survey']['id'];
					$name = "radio_".$question['Survey']['id'];
					
					?>
					<tr>
						<td></td>
						<td>
							<div style="float:left; padding:0px 40px 0px 20px;">
								<input <?php echo $chk_radio_yes; ?> onclick="javascript: showType2(this,<?php echo $detect_id ;?>);" name="<?php echo $name; ?>" type="radio" value="yes" /> Yes 
							</div>
							<div  style="float:left; padding-right:40px;" >
								<input <?php echo $chk_radio_no; ?> onclick="javascript: showType2(this,<?php echo $detect_id ;?>);" name="<?php echo $name; ?>" type="radio" value="no" /> No 
							</div>
							<div  style="float:left;" >
								<input <?php echo $chk_radio_na; ?> onclick="javascript: showType2(this,<?php echo $detect_id ;?>);" name="<?php echo $name; ?>" type="radio" value="na" /> N/A 
							</div>
						</td>
					</tr>
						
					<tr>
						<td></td>
						<td style="text-align:center">
							<?php 	
							$name = "text_".$question['Survey']['id'];
							?>
							<div >
							<textarea id="<?php echo $detect_id ;?>" style="display:block;width:90%; height:50px" name="<?php echo $name; ?>"><?php echo trim($text_value); ?></textarea>
							</div>
						</td>
					</tr>
					<?php
				}
				
				
				if( is_array( $question['Answer']) & !empty($question['Answer']) ){
					
					foreach( $question['Answer'] as $ans){
						$ans_id = $question['Survey']['id']."_".$ans['id'];
						$name = "chk_".$ans_id;
						
						$text_value="";
						$chk_checkbox = "";
						//start checking( with value retrieve) this answer is in the factory answer list						
						foreach($factory_answers as $factory_answer ){
							if( $ans['id'] == $factory_answer['FactoryAnsTable']['ans_id'] ){
								$chk_checkbox = "checked";
								if($factory_answer['FactoryAnsTable']['type'] =="text")
									$text_value = trim($factory_answer['FactoryAnsTable']['text']);
							}
						}
						//start checking( with value retrieve) this question is in the factory answer list						
						?>
							
						<tr>
							<td width="10%"> <input <?php echo $chk_checkbox; ?> name="<?php echo $name ;?>" id="<?php echo $name ;?>" style="padding:0;width: 50%;" type="checkbox" onclick="javascript: showfield('<?php echo $ans_id ;?>');"/> </td>
							<td >
								<?php 
									echo $ans['answer']; 
									if( trim( strtolower($ans['type']) ) == 1 ){
										$name="text_".$ans_id;
										echo '<br/><span id="'.$ans_id.'" style="block"><input value="'.$text_value.'" name="'.$name.'" style="padding:0; width: 90%;" type="text"  /></span>';
									}
								?>						
							</td>
							
						</tr>
						<?php 
					}
				}
						
			
				if($question['Survey']['type'] != "1" & $question['Survey']['type'] != "2" & empty($question['Answer'])){ 
					$name = "text_".$question['Survey']['id'];
					$value = "";
					
					foreach($factory_answers as $factory_answer ){
						if( $question['Survey']['id'] == $factory_answer['FactoryAnsTable']['question_id'] ){
							$value =  trim($factory_answer['FactoryAnsTable']['text']);
							break;
						}
					}
					
					if($question['Survey']['type'] == "3")
						echo '<textarea style="width:90%; height:100px" name="'.$name.'">'.$value.'</textarea>';
					else
						//echo '<input value="'.$value.'" style="padding:0;width: 50%;" type="text" name="'.$name.'" />';
						echo '<textarea style="width:90%; height:40px" name="'.$name.'">'.$value.'</textarea>';
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

<h3>Rating</h3>
<table style=" width:817px; ">
	<tr>
	
	<td style="text-align:center; border:0; background:#CADBE3; padding: 10px;">
	<b>	Rules </b>
	</td>
	<td width="" style=" border:0; background:#CFE0E8; padding: 10px; text-align:center; ">
    <b> select point </b>
	</td>
    
    
	</tr>
<?php 


foreach($rating_rules as $rule ){ ?>
	
	<tr>
	
        
	<td style="border:0; background:#CADBE3; padding: 10px;"><?php echo $rule['RatingRule']['rule'];	?>
	</td>
	
    <td width="" style=" border:0; background:#CFE0E8; padding: 10px; text-align:center; ">
	<?php 
		$criteria_point = intval($rule['RatingRule']['point']);
		if( !empty($criteria_point) ){ 
			$rating_rule_id = intval($rule['RatingRule']['id']) ;
			?>
			<select name="data[<?php echo $rating_rule_id; ?>]">
				<?php
				$gggg =0;
				foreach($rating as $rr => $vv){
					if( intval($vv['Rating']['rating_rule_id']) == $rating_rule_id ){
						 $gggg = & intval($vv['Rating']['points']) ;
						break;	
					}
				}
				
				
				for($loop=0; $loop <= $criteria_point ; $loop++){
						if($loop == $gggg) $chk='selected="selected"';
						else $chk = '';
								
            		echo '<option '.$chk.' value="'.$loop.'">'.$loop.'</option>';
				}
			?>

			</select>
            
		<?php
        }
		else{
			$rating_rule_id = $rule['RatingRule']['id'] ;
			?>
			<select name="data[<?php echo $rating_rule_id; ?>]">
				<option value="1">Yes</option>
                <option value="0">No</option>
                <option value="2">NA</option>
			</select>
            <?php
		}
	?>
	</td>
    
	</tr>

<?php } ?>


</table>

<table style=" width:817px; v">
	
	<tr> <td style="text-align:right"><input type="submit" value="Save" /> </td></tr>
</table>

</form>
</center>