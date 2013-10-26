
<?php  echo $javascript->link('jquery.min.js'); 
	
	
	
	
	//echo "<pre>";
	//print_r($overview);
	//print_r($tot_company);
	
	//print_r($test);
	
	//echo "</pre>";
	
	
	
?>
	
    
    
 <div class="reports">   
<form action="" method="post">
	<?php
	foreach($overview as $key=>$val){
		$op_name = "op_".$val['Overview']['id'];
		$id_name = "q_".$val['Overview']['id'];
		
		echo '<span style=";cursor:pointer" id="'.$op_name.'" >'; //onclick="my_toggle(\''.$id_name.'\')"
		echo "<b>" .$val['Overview']['section_name']."</b>" ;
		echo "</b></span><br/><br/>";	
				
		
		if( !empty($val['Question']) ){?>
			<div id="<?php echo $id_name; ?>" ><!--style=" display:none;"-->
			<table width="950" class="tablesorter" cellspacing="5" cellpadding="5">
				<?php
				foreach($val['Question'] as $key1=>$Question)
				{
					if( intval($Question['type']) == 1 || intval($Question['type']) == 2 )
					{
						$question_id= "chk_".$Question['id'];
						
						
						if(!empty($_POST) & $_POST[$question_id])	$chk = 'checked="checked"';
						else $chk = '';
						?>
						
				<tr>
					<td>
                    <!--<input <?php //echo $chk; ?> type="radio" value="<?php //echo $question_id; ?>" name="question"  />-->
                    
                    <input <?php echo $chk; ?> type="checkbox" id="<?php echo $question_id; ?>" 
                    name="<?php echo $question_id; ?>" value="1" />
                    </td>
					
                    <td><?php echo $Question['question']; ?></td>
							
				</tr>
						
						
			<?php 
					}
					else{
						?>
						<tr >
						<td ></td>
						<td ><?php echo $Question['question']; ?></td>
						
					</tr>
                    <?php
					}
				}?>
				
			
			<tr><td colspan="2"><input type="submit" value="go"  /></td></tr>	
				
			</table>
			</div>
			<?php	
		}
	}
	
	?>
    <!--<input type="submit" value="go"  />-->
</form>


<?php 
if( !empty($_POST) ){
?>
	<br /><br />
    <center>
	<h3>Reports</h3>

	<?php 
	if(!empty($tot_company)){
			
			$baseline=0;
			$followup=0;
			
			$baseline1=0;
			$followup1=0;
			
		?>
		<table width="950" class="tablesorter" cellpadding="5" cellspacing="5">
			<tr>
            	<!--<td ><b>Section</b></td>-->
            
				<td ><b>Question</b></td>
				<td ><b>No of Facilities responded YES in Baseline</b></td>
				<td ><b>No of Facilities responded YES in Last Followup</b></td>
				<td ><b>Change (No of Facilities responded YES in Last Followup - No of Facilities responded YES in Baseline) </b></td>
				<td style=" text-align:center; vertical-align:middle"><b>Details</b></td>
			</tr>
			<?php 
			foreach($tot_company as $key=>$val)
			{
				 		
				if( intval($val['factory_ans_tables']['status'])%2 == 0 ) 
						$baseline = $val[0]['number'];
						
								
										
								
						elseif( intval($val['factory_ans_tables']['status'])%2 == 1 ) 
						{
							
							$id = $val['factory_ans_tables']['question_id'];
							
							
							$followup = $val[0]['number'];
							$change =  ( intval($followup) - intval($baseline) );
						 
							
							
							if( $id == $qid ) 
							{
								$baseline1 = 0;
							}
							$change1 =  ( intval($followup) - intval($baseline1) );
							
								
								
											
							echo'<tr>';
							//echo $this->Html->link($name, array('controller'=>'admins','action' => 'FacilityCustomReport',$id));
							//echo $val['RESULT']['name'];
							
							
							echo '<td >';
							echo $val['RESULT']['question'];
							
							
							echo '</td><td>';
							
							if( $id == $qid ) 
								echo $baseline;
							else
								echo $baseline1;
							
							echo '</td><td>';
							
							echo $followup;
							
							echo '</td><td>';
							
							
							if( $id == $qid ) 
								echo '<b>'.$change.'</b>';
							else
								echo '<b>'.$change1.'</b>';
							
							echo '</td><td>';
							
							//echo $this->Html->link("Details", array('controller'=>'admins','action' => 'FacilityCustomReport',$id));
							
							echo $this->Html->link("Details", array('controller'=>'admins','action' => 'BySingleQuestionReport',$id));
							echo '</td></tr>';
					
						}
						
					$qid = $val['factory_ans_tables']['question_id'];
			}
			
		?>
		</table> </br></br>
		
		
		<?php
	}
	
}

?>


</div>
