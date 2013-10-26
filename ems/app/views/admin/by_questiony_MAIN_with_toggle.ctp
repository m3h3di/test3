<style>
.block_box  {
	background:none;
}
</style>

<?php  echo $javascript->link('jquery.min.js'); 
	
	//echo "<pre>";
	//print_r($overview);
	//print_r($tot_company);
	//echo "</pre>";
	
?>
	<script type="text/javascript">
		$(document).ready(function(){
			
			$("#q_1").slideToggle("fast");
			/*$("#q_2").slideToggle("fast");
			$("#q_3").slideToggle("fast");
			$("#q_4").slideToggle("fast");
			$("#q_5").slideToggle("fast");
			$("#q_6").slideToggle("fast");
			$("#q_7").slideToggle("fast");
			$("#q_8").slideToggle("fast");*/
			
			
		});
	
		function my_toggle(qq){
			var r="#"+qq;
			
				$(r).slideToggle("fast");
			
		}
	</script>
<form action="" method="post">
	<?php
	foreach($overview as $key=>$val){
		$op_name = "op_".$val['Overview']['id'];
		$id_name = "q_".$val['Overview']['id'];
		
		echo '<span style=";cursor:pointer" id="'.$op_name.'" onclick="my_toggle(\''.$id_name.'\')" >';
		echo "&nbsp;" .$val['Overview']['section_name'];
		echo "</b></span><br/><br/>";	
				
		
		if( !empty($val['Question']) ){?>
			<div id="<?php echo $id_name; ?>" style=" display:none;" >
			<table   width="100%">
				<?php
				foreach($val['Question'] as $key1=>$Question){
					if( intval($Question['type']) == 1 || intval($Question['type']) == 2 ){
						$question_id= $Question['id'];
						if(!empty($_POST) & $_POST['question'] == $question_id)	$chk = 'checked="checked"';
						else $chk = '';
						?>
						
						<tr style="background-color:#CCC">
							<td width="3%" style="background-color: #FFC"><input <?php echo $chk; ?> type="radio" value="<?php echo $question_id; ?>" name="question"  /></td>
							<td width=60% style="background-color: #FFC"><?php echo $Question['question']; ?></td>
							
						</tr>
						
						
						<?php 
					}
					else{
						?>
						<tr style="background-color:#CCC">
						<td width="3%" style="background-color: #FFC"></td>
						<td width=60% style="background-color: #FFC"><?php echo $Question['question']; ?></td>
						
					</tr>
                    <?php
					}
				}?>
			</table>
			</div>
			<?php	
		}
	}
	
	?>
    <input type="submit" value="go"  />
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
		?>
		<table style=" width:97%" >
			<tr>
            	<td style=" text-align:center; vertical-align:middle"><b>Section</b></td>
            
				<td style=" text-align:center; vertical-align:middle"><b>Question</b></td>
				<td style="  text-align:center; vertical-align:middle"><b>Facility respond YES in Baseline</b></td>
				<td style="  text-align:center; vertical-align:middle"><b>Facility respond YES in Last FollowUp</b></td>
				<td style="  text-align:center; vertical-align:middle"><b>change</b></td>
				<td style=" text-align:center; vertical-align:middle"><b>Details</b></td>
			</tr>
			<?php 
			foreach($tot_company as $key=>$val){
				
				if( intval($val['factory_ans_tables']['status'])%2 == 0 ) 
						$baseline = intval($val['0']['number']);
						
				elseif( intval($val['factory_ans_tables']['status'])%2 == 1 ) {
						$followup = intval($val['0']['number']);
				
				
				 $change =  ( intval($followup) -intval($baseline) );
				 
					
					//$change = round($change,2)*100;
					
					
					$id = $val['factory_ans_tables']['question_id'];
									
					echo'<tr><td style=" border:0; padding: 10px;  text-align:center">';
					//echo $this->Html->link($name, array('controller'=>'admins','action' => 'FacilityCustomReport',$id));
					echo $val['RESULT']['name'];
					
					
					echo '</td><td style=" border:0; text-align:center; vertical-align:middle">';
					echo $val['RESULT']['question'];
					
					
					echo '</td><td style=" border:0; text-align:center; vertical-align:middle">';
					echo $baseline;
					echo '</td><td style=" border:0; padding: 10px; text-align:center; vertical-align:middle">';
					echo $followup;
					echo '</td><td style=" border:0; padding: 10px; text-align:center; vertical-align:middle">';
					echo '<b>'.$change.'</b>';
					echo '</td><td style=" border:0; padding: 10px; text-align:center; vertical-align:middle">';
					
					//echo $this->Html->link("Details", array('controller'=>'admins','action' => 'FacilityCustomReport',$id));
					
					echo $this->Html->link("Details", array('controller'=>'admins','action' => 'BySingleQuestionReport',$id));
					echo '</td></tr>';
			
				}
			}
			
		?>
		</table>
		
		
		<?php
	}
	?>
	
	</center>
<?php
}

?>