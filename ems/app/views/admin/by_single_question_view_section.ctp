<style>
.block_box  {
	background:none;
}
</style>

<?php  echo $javascript->link('jquery.min.js'); 

$section_list =  array(" ","General Facility Information","Chemicals/Hazardous Materials Information","Spill Prevention","Spill Response/Emergency Response","Environmental Awareness Training and Training Records","Cleaner Production","Environmental Management Systems (EMS)","Preparation of Action Plan");






echo "<pre>";
//print_r($rule_overview);

echo "</pre>";
?>



<div class="reports">
<br/><br/>

<div class="report_title">
    <font size="2" color="#333">
        <b>Please select section</b>
    </font>
</div>
			
   <br/><br/>
	
    <div class="facility_box">



	<?php
	foreach($overview as $key=>$val)
	{
		$id = $val['Overview']['id'];
		
		//echo "&nbsp;" .$val['Overview']['section_name'];
		
		echo $this->Html->link($val['Overview']['section_name'], array('controller'=>'admins','action' => 'ByQuestiony',$id));
		
		echo "<br/><br/>";	
				
	}
	
	?>
    
  </div>
    <div class="clear"></div>
</div>   
  
  





<?php /*
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
			}///////////////
			
			
			
			
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


<?php } */ ?>  
  
  
  
  
    
    
