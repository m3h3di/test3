<?php 

//echo  '<pre style="text-align:left">';
//print_r($questions) ;		
//print_r($factory_answers) ;
//print_r($rating_rules) ;
//echo '</pre>';


//echo $factory_id;

$section_list =  array(" ","General Facility Information","Chemicals/Hazardous Materials Information","Spill Prevention","Spill Response/Emergency Response","Environmental Awareness Training and Training Records","Cleaner Production","Environmental Management Systems (EMS)","Preparation of Action Plan");
	

$new_num = "";
$old_num = "";


	
//echo "<h3>Complete View</h3>";

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




<!--<div class="print_page">-->


<div class="reports">
<br/><br/>
<div class="report_title"><font size="3" color="#333"><b>Complete View</b></font></div><br/>

<table width="950" class="tablesorter" cellpadding="10" cellspacing="10">

		<tr>
        	<td><b>No</b></td>
        	<td><b>Question</b></td>
        	<td><b>Baseline answers</b></td>
            <td><b>Followup answers</b></td>
        </tr>
        


<?php
foreach($questions as $question ){
	if($question['Survey']['type'] == 6)
		continue;
?>		
	<tr>
		<td >
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
		<td >
		</td>
		<td colspan="2">
			<table>
				<tr>
					<td ><b>Parameter (Unit)</b></td>
					<td ><b>Supplied</b></td>
					<td ><b>Standard</b></td>
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
					<td ><?php echo $splitted_text[0]; ?></td>
					<td ><?php echo $inside_table_ans_text ?></td>
					<td ><?php echo $splitted_text[1]; ?></td>
                    
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

		<td ><b>
			<?php echo $question['Survey']['question']; ?></b>
		</td>
		<td >
			<table>
			<?php
				$value= "";
				
				//start checking( with value retrieve) this question is in the factory answer list
				foreach($factory_answers as $factory_answer ){
					if( $question['Survey']['id'] == $factory_answer['FactoryAnsTable']['question_id'] and $factory_answer['FactoryAnsTable']['status']==0){
						$value =  $factory_answer['FactoryAnsTable']['text'];
					}
				}
				//End checking( with value retrieve) this question is in the factory answer list
								
			if($question['Survey']['type'] == "1" ){
				echo '<tr><td style="text-align: center; vertical-align: middle;">< '.$value.' ></tr>';
			}
			
			if($question['Survey']['type'] == "8"){
				$balt = explode("|", $value);
				echo '<tr><td style="text-align: center; vertical-align: middle;">(Name) - (Ave. Monthly Con)</tr>';
				$iii = 0;
				foreach($balt as $kkk => $vvv){
					if($iii == 0){
							$iii++;
							continue;
					}
					echo '<tr><td style="text-align: center; vertical-align: middle;">< '.$vvv.' ></tr>';
				}
			}
			
			if( is_array( $question['Answer']) & !empty($question['Answer']) ){
				$ans_of_a_quetion="";				
				foreach( $question['Answer'] as $ans){
					$ans_id = $question['Survey']['id']."_".$ans['id'];
					$name = "chk_".$ans_id;
					
					
					
					
					
					foreach($factory_answers as $factory_answer ){
						if( $ans['id'] == $factory_answer['FactoryAnsTable']['ans_id'] and $factory_answer['FactoryAnsTable']['status']==0 ){
											
							$ans_of_a_quetion.= '<tr><td >';
							if( $ans['type'] == 1 ){
								$ans_of_a_quetion.= $ans['answer'] ." ( ". $factory_answer['FactoryAnsTable']['text']. " ) ";
							}
							elseif( $ans['type'] == 2 ){
								$splitted_text = explode("|", $factory_answer['FactoryAnsTable']['text']);
								if( !empty($splitted_text[1])) $am = $splitted_text[1];
								else $am ="";
								
								if( !empty($splitted_text[2])) $wh = $splitted_text[2];
								else $wh ="";
								
								if( !empty($splitted_text[3])) $ms = "yes";
								else $ms ="no";
								$cccc = "<b>".$ans['answer']."</b>";
								$ans_of_a_quetion.=$cccc.'<br/> 
								<table style="width:100%; ">						
								
                                <tr>
                                    <td>amount</td>
                                    <td>where</td>
                                    <td>msds</td>
                                </tr>
                                <tr>
                                    <td>'. $am .'</td>
                                    <td>'. $wh .'</td>
                                    <td>'. $ms .'</td>
                                </tr>
                                </table>
							
								';
                            }
							else $ans_of_a_quetion.= "<b>".$ans['answer']."</b>" ;
							$ans_of_a_quetion.= "</td></tr>";
						}
					}
				}
				if( empty($ans_of_a_quetion)) $ans_of_a_quetion="< na1 >";
				echo $ans_of_a_quetion;
			}
			elseif($question['Survey']['type'] == "2" || $question['Survey']['type'] == "0" || $question['Survey']['type'] == "3"){
				//$name = "text_".$question['Survey']['id'];
				//echo '<input style="padding:0;width: 50%;" type="text" name="'.$name.'" />';
				$ans_radio_text = "";
				foreach($factory_answers as $factory_answer ){
					if( $question['Survey']['id'] == $factory_answer['FactoryAnsTable']['question_id'] and $factory_answer['FactoryAnsTable']['status']==0  ){
						if( $factory_answer['FactoryAnsTable']['type'] == "radio" )
							$ans_radio_text = " < ".$factory_answer['FactoryAnsTable']['text']." > ".$ans_radio_text;
						
						else $ans_radio_text .= $factory_answer['FactoryAnsTable']['text'];
					}
				}
				
				if( empty($ans_radio_text) ) $ans_radio_text="Not Applicable / Not Submitted";
				echo $ans_radio_text;
			}
						
			?>
			</table>
		</td>
        
        
        
        
        
        
        <!-- m3h3di-->
        <td >
			<table>
			<?php
				$value= "";
				
				//start checking( with value retrieve) this question is in the factory answer list
				foreach($factory_answers as $factory_answer ){
					if( $question['Survey']['id'] == $factory_answer['FactoryAnsTable']['question_id'] and $factory_answer['FactoryAnsTable']['status']==1){
						$value =  $factory_answer['FactoryAnsTable']['text'];
					}
				}
				//End checking( with value retrieve) this question is in the factory answer list
								
			if($question['Survey']['type'] == "1"){
				echo '<tr><td style="text-align: center; vertical-align: middle;">< '.$value.' ></tr>';
			}
			
			if($question['Survey']['type'] == "8"){
				$balt = explode("|", $value);
				echo '<tr><td style="text-align: center; vertical-align: middle;">(Name) - (Ave. Monthly Con)</tr>';
				$iii = 0;
				foreach($balt as $kkk => $vvv){
					if($iii == 0){
							$iii++;
							continue;
					}
					echo '<tr><td style="text-align: center; vertical-align: middle;">< '.$vvv.' ></tr>';
				}
			}
			
			if( is_array( $question['Answer']) & !empty($question['Answer']) ){
				$ans_of_a_quetion="";				
				foreach( $question['Answer'] as $ans){
					$ans_id = $question['Survey']['id']."_".$ans['id'];
					$name = "chk_".$ans_id;
					
					
					foreach($factory_answers as $factory_answer ){
						if( $ans['id'] == $factory_answer['FactoryAnsTable']['ans_id'] and $factory_answer['FactoryAnsTable']['status']==1 ){
											
							$ans_of_a_quetion.= '<tr><td >';
							if( $ans['type'] == 1 ){
								$ans_of_a_quetion.= $ans['answer'] ." ( ". $factory_answer['FactoryAnsTable']['text']. " ) ";
							}
							elseif( $ans['type'] == 2 ){
								$splitted_text = explode("|", $factory_answer['FactoryAnsTable']['text']);
								if( !empty($splitted_text[1])) $am = $splitted_text[1];
								else $am ="";
								
								if( !empty($splitted_text[2])) $wh = $splitted_text[2];
								else $wh ="";
								
								if( !empty($splitted_text[3])) $ms = "yes";
								else $ms ="no";
								$cccc = "<b>".$ans['answer']."</b>";
								$ans_of_a_quetion.=$cccc.'<br/> 
								<table style="width:100%; ">						
								
                                <tr>
                                    <td>amount</td>
                                    <td>where</td>
                                    <td>msds</td>
                                </tr>
                                <tr>
                                    <td>'. $am .'</td>
                                    <td>'. $wh .'</td>
                                    <td>'. $ms .'</td>
                                </tr>
                                </table>
							
								';
                            }
							else $ans_of_a_quetion.= "<b>".$ans['answer']."</b>" ;
							$ans_of_a_quetion.= "</td></tr>";
						}
					}
				}
				if( empty($ans_of_a_quetion)) $ans_of_a_quetion="< na1 >";
				echo $ans_of_a_quetion;
			}
			elseif($question['Survey']['type'] == "2" || $question['Survey']['type'] == "0" || $question['Survey']['type'] == "3"){
				//$name = "text_".$question['Survey']['id'];
				//echo '<input style="padding:0;width: 50%;" type="text" name="'.$name.'" />';
				$ans_radio_text = "";
				foreach($factory_answers as $factory_answer ){
					if( $question['Survey']['id'] == $factory_answer['FactoryAnsTable']['question_id'] and $factory_answer['FactoryAnsTable']['status']==1){
						if( $factory_answer['FactoryAnsTable']['type'] == "radio" )
							$ans_radio_text = " < ".$factory_answer['FactoryAnsTable']['text']." > ".$ans_radio_text;
						
						else $ans_radio_text .= $factory_answer['FactoryAnsTable']['text'];
					}
				}
				
				if( empty($ans_radio_text) ) $ans_radio_text="Not Applicable / Not Submitted";
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
    
</table>


<input type="button" value="Print"  onclick="javascript:window.print();" /> 


<!--<table >
	<tr> 
		<td style="text-align:right">
			<input type="button" value="Print"  onclick="javascript:window.print();" /> 

		</td>
	
	</tr>
</table>-->
</div>