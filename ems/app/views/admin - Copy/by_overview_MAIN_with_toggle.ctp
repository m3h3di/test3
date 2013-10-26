<style>
.block_box  {
	background:none;
}
</style>

<?php  echo $javascript->link('jquery.min.js'); 

$section_list =  array(" ","General Facility Information","Chemicals/Hazardous Materials Information","Spill Prevention","Spill Response/Emergency Response","Environmental Awareness Training and Training Records","Cleaner Production","Environmental Management Systems (EMS)","Preparation of Action Plan");




/* to make the looping easier make the array simple start*/
function reArrange($source)
{
	
	$i = 0;
	$fact_id="";
			
	foreach($source as $key=>$val)
	{	
		
		if( intval($val['RESULT']['status']) == 0 ) 
		{
			$fact_id = $val['RESULT']['factory_id'];
			
			$res[$i]['base_fact_id'] = $val['RESULT']['factory_id'];
			$res[$i]['base_fact_name'] = $val['factories']['factory_name'];
			$res[$i]['base_point'] = $val['RESULT']['points'];
			
			$res[$i]['follow_fact_id'] = "";
			$res[$i]['follow_point'] = "";
		}
			
		elseif( intval($val['RESULT']['status']) != 0 ) 
		{
			if($val['RESULT']['factory_id'] == $fact_id)
			{
				$res[$i-1]['follow_fact_id'] = $val['RESULT']['factory_id'];
				$res[$i-1]['follow_point'] = $val['RESULT']['points'];
			}
			else
			{
				$res[$i]['base_fact_id'] = "";
				$res[$i]['base_point'] = "";
				
				$res[$i]['follow_fact_id'] = $val['RESULT']['factory_id'];
				$res[$i]['follow_fact_name'] = $val['factories']['factory_name'];
				$res[$i]['follow_point'] = $val['RESULT']['points'];
			}
		}
		
		$i++;
	}
	
	return $res;		
}
/* to make the looping easier make the array simple end*/





echo "<pre>";
//print_r($rule_overview);

$test = reArrange( $rule_overview);
//print_r($test);

echo "</pre>";
?>


<script type="text/javascript">
$(document).ready(function(){
		$("#q_1").slideToggle("slow");
});
	
function my_toggle(qq)
{
	var r="#"+qq;
	$(r).slideToggle("fast");
}
</script>




<form action="" method="post">
	<?php
	foreach($overview as $key=>$val){
		$op_name = "op_".$val['Overview']['id'];
		$id_name = "q_".$val['Overview']['id'];
		
		echo '<span style=";cursor:pointer" id="'.$op_name.'" onclick="my_toggle(\''.$id_name.'\')">';//onclick="my_toggle(\''.$id_name.'\')"
		echo "&nbsp;" .$val['Overview']['section_name'];
		echo "</b></span><br/><br/>";	
				
		
		if( !empty($val['RatingRule']) ){?>
			<div id="<?php echo $id_name; ?>" style=" display:none;"> <!--style=" display:none;"-->
			<table width="100%" >
				   <tr style="background-color:#CCC">
                        <td style="background-color: #FFC"><b>Select</b></td>
                        <td style="background-color: #FFC"><b>Minimum point</b></td>
                        <td style="background-color: #FFC"><b>Maximum Point</b></td>
						<td style="background-color: #FFC"><b>Rating Criteria</b></td>
					</tr>
               
               
                       
                <?php
				foreach($val['RatingRule'] as $key1=>$RatingRule){
					
                    $rule_id= $RatingRule['id'];
					
					$point= $RatingRule['point'];
					
						if(!empty($_POST) & $_POST['rule'] == $rule_id)	$chk = 'checked="checked"';
						else $chk = ''; 
				?>
                    
					<tr style="background-color:#CCC">
                        <td style="background-color: #FFC"><input <?php echo $chk; ?> type="radio" 
                        value="<?php echo $rule_id; ?>" name="rule"  /></td>
                        
                        
                        <td style="background-color: #FFC">
                            <select name="min_point[<?php echo $rule_id ?>]" id="" rel="">
                            	
                            <?php 
                                for($i=0;$i<=$point;$i++)
								{	
                                    /*$select="";
                                    if( !empty($_POST) & $_POST['min_point'] == $i) 
                                        $select = 'selected="selected"';
                                    else $select='';*/
                                    echo '<option '. $select .' value="' .$i. '">'.$i.'</option>';
                                }
								
                            ?>
                        	</select>
                        </td>
                        
                        <td style="background-color: #FFC">
                            <select name="max_point[<?php echo $rule_id ?>]" id="" rel="">
                            	
                            <?php 
                                for($j=$point;$j>=0;$j--)
								{	
                                    /*$select="";
                                    if( !empty($_POST) & $_POST['max_point'] == $j) 
                                        $select = 'selected="selected"';
                                    else $select='';*/
                                    echo '<option '. $select .' value="' .$j. '">'.$j.'</option>';
                                }
                            ?>
                        	</select>
                        </td>
                        
                        
						<td style="background-color: #FFC"><?php echo $RatingRule['rule']; ?></td>
					</tr>
					
					
					<?php 
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
    
 <br />
  
  
 <?php  
 //$section_id=$rule_overview['RESULT']['section'];
 echo $section_list[$selected_section];
 ?>
  
 :<b> <?php echo $selected_rule; ?> </b>

 <br /><br />
 
 
 Result for points <b> <?php echo $selected_min_point; ?> </b> to <b><?php echo $selected_max_point; ?></b>
 
	<?php 
	if(!empty($rule_overview)){
			
			//$baseline=0;
			//$followup=0;
		?>
		<table width="700">
			<tr>
				<td style="text-align:center; vertical-align:middle"><b>Factory Name</b></td>
                <td style="text-align:center; vertical-align:middle"><b>Highest Possible Point</b></td>
                <td style="text-align:center; vertical-align:middle"><b>Baseline Point</b></td>
                <td style="text-align:center; vertical-align:middle"><b>Followup Point</b></td>
                <td style="text-align:center; vertical-align:middle"><b>Change (%) </b></td>
                
                <td style="text-align:center; vertical-align:middle"><b>Complete View</b></td>
			</tr>
			<?php 
			/*foreach($rule_overview as $key=>$val){
				
				/*if( intval($val['factory_ans_tables']['status'])%2 == 0 ) 
						$baseline = intval($val['0']['number']);
						
				elseif( intval($val['factory_ans_tables']['status'])%2 == 1 ) {
						$followup = intval($val['0']['number']);/////
				
					
					
					//$id = $val['factory_ans_tables']['question_id'];
									
					echo'<tr><td style=" text-align:center">';
					echo $val['factories']['factory_name'];
					
					
					echo '</td><td style=" text-align:center;">';
					echo $val['ratings_haz']['points'];
					
					
					echo '</td><td style=" text-align:center;">';
					//echo $val['ratings_haz']['status'];
					
					if($val['ratings_haz']['status']==0)
					{
						echo "Baseline";
					}
					else if($val['ratings_haz']['status']==1)
					{
						echo "Follow up";
					}
						
					echo '</td></tr>';
					
					/*echo '</td><td style=" border:0; text-align:center; vertical-align:middle">';
					echo $baseline;
					echo '</td><td style=" border:0; padding: 10px; text-align:center; vertical-align:middle">';
					echo $followup;
					echo '</td><td style=" border:0; padding: 10px; text-align:center; vertical-align:middle">';
					echo '<b>'.$change.'</b>';
					echo '</td><td style=" border:0; padding: 10px; text-align:center; vertical-align:middle">';
					
					echo $this->Html->link("Details", array('controller'=>'admins','action' => 'BySingleQuestionReport',$id));
					echo '</td></tr>';///////
			
				//}
			}*/
			
			
			
			
$status_baseline="";
$status_followup="";

	
foreach($test as $key=>$val)
{
	
	if($val['base_fact_id']==$val['follow_fact_id'])
	{
		$factory_id = $val['base_fact_id'];
		$factory_name = $val['base_fact_name'];
		
		$status_baseline = 'Yes';
		$img_baseline = "tick.png";
			
		$status_followup = 'Yes';
		$img_followup = "tick.png";
			
	}
	
	else
	{
		if($val['base_fact_id']=="")
		{
			$factory_id = $val['follow_fact_id'];
			$factory_name = $val['follow_fact_name'];
			
			//$status_baseline = 'No';
			//$img_baseline = "cross.png";
			
			//$status_followup = 'Yes';
			//$img_followup = "tick.png";
		}
		
		else if($val['follow_fact_id']=="")
		{
			$factory_id = $val['base_fact_id'];
			$factory_name = $val['base_fact_name'];
			
			//$status_followup = 'No';
			//$img_followup = "cross.png";
			
			//$status_baseline = 'Yes';
			//$img_baseline = "tick.png";
		}
			
	}
	
	
	
	echo "<tr><td>";
		//echo $factory_name;
		echo $this->Html->link($factory_name, array('controller'=>'admins','action' => 'FacilityReport',$factory_id));
		echo "</td><td>";
		
		echo $hpp;
		echo "</td><td>";
		
		
		if($val['base_point']=="")
			echo $html->image("cross.png", array('alt' => 'status'));
		else 
			echo $val['base_point'];
		
			
		echo "</td><td>";
			if($val['follow_point']=="")
				echo $html->image("cross.png", array('alt' => 'status'));
			else 
				echo $val['follow_point'];
		echo "</td>";
		
		
		
		echo "<td>";
		 if($val['base_point']!="" && $val['follow_point']!="")
			//echo $change = $val['follow_point']-$val['base_point'];
			echo $change = ($val['follow_point']-$val['base_point'])/$hpp*100;
			
		 elseif($val['base_point']=="")
		 	echo round($val['follow_point']/$hpp*100,2);
			
		 elseif($val['follow_point']=="")
		 	echo round($val['base_point']/$hpp*100,2);
		 	
		echo "</td><td>";
		
		echo $this->Html->link("Details", array('controller'=>'admins','action' => 'CompleteView',$factory_id));
		//echo $html->link('Complete View', array('controller' => 'admins','action' => 'CompleteView', $factory_id ));
		
		echo "</td></tr>";	
		
		
}
			
			
?>

</table>
		
		
<?php } ?>
	
</center>


<?php } ?>  
  
  
  
  
    
    
