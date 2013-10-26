
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



<div class="reports">
<br/><br/>




<div class="report_title">
    <font size="2" color="#333">
        <b>
	<?php 
		echo $this->Html->link('Facility', array('controller'=>'admins' ,'action' => 'FacilityReport' , $factory_id)) . " >> ";
		echo "Section - ". ($section);
	?>
         </b>
    </font>
</div>

<br/>

<div class="report_title">
    <font size="2" color="#333">
        <b><?php echo $section_list[$section]; ?></b>
    </font>
</div>
			
   <br/><br/>

<table width="950" class="tablesorter" cellpadding="5" cellspacing="5">

	
    <tr>
        	<td><b>No</b></td>
        	<td><b>Question</b></td>
        	<td><b>Baseline answers</b> <?php if(!empty($baseline_date)) echo "(".$baseline_date.")";?></td>
            <td><b>Followup answers</b> <?php if(!empty($followup_date)) echo "(".$followup_date.")";?></td>
        </tr>
    
<?php
foreach($questions as $question ){
	if($question['Survey']['id'] > 3) {
?>		
	<tr>
		<td>
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
        
        
        <!-- for baseline start-->
		<td><b><?php echo $question['Survey']['question']; ?></b></td>
        
		<td>
			<table>
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
					
					//$ans_radio_text = "";
					foreach($factory_answers as $factory_answer ){
						if( $ans['id'] == $factory_answer['FactoryAnsTable']['ans_id'] and $factory_answer['FactoryAnsTable']['status']==0){
							echo "<tr><td>";
							echo $ans['answer'];
							echo "</tr></td>";
						}
					}
					
					
					/*if( empty($ans['answer']) ) $ans_radio_text="Not Applicable / Not Submitted";
						echo $ans_radio_text;*/
					
					
				}
			}
			else{ 
				//$name = "text_".$question['Survey']['id'];
				//echo '<input style="padding:0;width: 50%;" type="text" name="'.$name.'" />';
				
				foreach($factory_answers as $factory_answer  ){
					if( $question['Survey']['id'] == $factory_answer['FactoryAnsTable']['question_id'] and $factory_answer['FactoryAnsTable']['status']==0){
						echo $factory_answer['FactoryAnsTable']['text'];
					}
				}
			}
			
			?>
			</table>
		</td>
         <!-- for baseline end-->
        
        
        
       <!-- for follow up start-->
        
        <td>
			<table>
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
					
					//$ans_radio_text = "";
					foreach($factory_answers as $factory_answer ){
						if( $ans['id'] == $factory_answer['FactoryAnsTable']['ans_id'] and $factory_answer['FactoryAnsTable']['status']==1){
							echo "<tr><td>";
							echo $ans['answer'];
							echo "</tr></td>";
						}
					}
					
					
					/*if( empty($ans['answer']) ) $ans_radio_text="Not Applicable / Not Submitted";
						echo $ans_radio_text;*/
					
					
				}
			}
			else{ 
				//$name = "text_".$question['Survey']['id'];
				//echo '<input style="padding:0;width: 50%;" type="text" name="'.$name.'" />';
				
				foreach($factory_answers as $factory_answer ){
					if( $question['Survey']['id'] == $factory_answer['FactoryAnsTable']['question_id'] and $factory_answer['FactoryAnsTable']['status']==1 ){
						echo $factory_answer['FactoryAnsTable']['text'];
					}
				}
			}
			
			?>
			</table>
		</td>
        
        <!-- for follow up end-->
        
        
        
        
        
	</tr>
	

	
<?php
}  }
?>
</table>


<table>
	<tr> 
		<td style="text-align:right">
			<input type="button" value="Print"  onclick="javascript:window.print();" /> 
			<?php $param = $section."/".$factory_id; ?>
        
        
        <!--later needed-->    
<!--<input type="button" value="Edit" onclick="location.href='/hazmat/admins/SectionEdit/<?php //echo $param; ?>'" />--> 

		</td>
	
	</tr>
</table>
</div>