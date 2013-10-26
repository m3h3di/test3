
<?php  echo $javascript->link('jquery.min.js'); 

$section_list =  array(" ","General Facility Information","Chemicals/Hazardous Materials Information","Spill Prevention","Spill Response/Emergency Response","Environmental Awareness Training and Training Records","Cleaner Production","Environmental Management Systems (EMS)","Preparation of Action Plan");




/* to make the looping easier make the array simple start*/
function reArrange($source)
{
	
	$i = 0;
	$fact_id="";
			
	foreach($source as $key=>$val)
	{	
		$res[$i]['Zone'] = $val['factories']['Zone'];
		
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

//$test = reArrange( $rule_overview);
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


<div class="reports">

<form action="" method="post">
	<?php
	foreach($overview as $key=>$val){
		$op_name = "op_".$val['Overview']['id'];
		$id_name = "q_".$val['Overview']['id'];
		
		echo '<span style=";cursor:pointer" id="'.$op_name.'" >';//onclick="my_toggle(\''.$id_name.'\')"
		echo "&nbsp;" .$val['Overview']['section_name'];
		echo "</b></span><br/><br/>";	
				
		
		if( !empty($val['RatingRule']) ){?>
			<div id="<?php echo $id_name; ?>"> <!--style=" display:none;"-->
			<table width="950" class="tablesorter" cellpadding="5" cellspacing="5">
				   <tr >
                        <td ><b>Select</b></td>
                        <td ><b>Minimum point</b></td>
                        <td ><b>Maximum Point</b></td>
						<td ><b>Rating Criteria</b></td>
					</tr>
               
               
                       
                <?php
				foreach($val['RatingRule'] as $key1=>$RatingRule){
					
                    $rule_id= $RatingRule['id'];
					
					$point= $RatingRule['point'];
					
						if(!empty($_POST) & $_POST['rule'] == $rule_id)	$chk = 'checked="checked"';
						else $chk = ''; 
				?>
                    
					<tr >
                        <td ><input <?php echo $chk; ?> type="radio" 
                        value="<?php echo $rule_id; ?>" name="rule"  /></td>
                        
                        
                        <td >
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
                        
                        <td >
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
                        
                        
						<td ><?php echo $RatingRule['rule']; ?></td>
					</tr>
					
					
					<?php 
				}?>
				
				
				<tr><td colspan="4"><input type="submit" value="go"  /></td></tr>
				
				
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
    
 <br />
  
  
 <?php  
 //$section_id=$rule_overview['RESULT']['section'];
 echo $section_list[$selected_section];
 ?>
  
 :<b> <?php echo $selected_rule; ?> </b>

 <br /><br />
 
 
 Result for points <b> <?php echo $selected_min_point; ?> </b> to <b><?php echo $selected_max_point; ?></b>
 
	<?php 
	if(!empty($finalSet)){
			
			//$baseline=0;
			//$followup=0;
		?>
		<div class="excellExport" style="padding:0 40px 10px 0;text-align:right">
		<a href="" onclick="javascript:x()">Excel Export</a>
		</div>

		<div class="targetTable">
		<table width="950" class="tablesorter" cellpadding="5" cellspacing="5">
			<tr>
				<td style="text-align:center; vertical-align:middle"><b>Factory Name</b></td>
				<td style="text-align:center; vertical-align:middle"><b>Zone</b></td>
                <td style="text-align:center; vertical-align:middle"><b>Highest Possible Point</b></td>
                <td style="text-align:center; vertical-align:middle"><b>Baseline Point</b></td>
                <td style="text-align:center; vertical-align:middle"><b>Followup Point</b></td>
                <td style="text-align:center; vertical-align:middle"><b>Change (%) </b></td>
                
                <td style="text-align:center; vertical-align:middle"><b>Complete View</b></td>
			</tr>
			<?php 
			
			
$status_baseline="";
$status_followup="";

	
foreach($finalSet as $key=>$val){
	$factory_id = $key;
	
	$baseline = intval($val[0]['RESULT']['points']);
	//$lastFollow = sizeof($val) -1 ;
	foreach($val as $k=>$v){
		$lastFollow = $k;
	}	
	$followup = intval($val[$lastFollow]['RESULT']['points']);
	
	$factory_name = $val[$lastFollow]['factories']['factory_name'];
	$factory_zone = $val[$lastFollow]['factories']['Zone'];
	
	
	$change =  ( intval($followup) -intval($baseline) )/ intval($hpp);
	$change = round($change,2)*100;
	
	echo "<tr><td>";
		//echo $factory_name;
		echo $this->Html->link($factory_name, array('controller'=>'admins','action' => 'FacilityReport',$factory_id));
		
		echo "</td><td>";
		echo $factory_zone;
		
		echo "</td><td>";		
		echo $hpp;
		
		echo "</td><td>";		
		echo $baseline;	
			
		echo "</td><td>";		
		echo $followup;
		
		echo "</td><td>";
		echo $change;			
		 	
		echo "</td><td>";
		echo $this->Html->link("Details", array('controller'=>'admins','action' => 'CompleteView',$factory_id));
		//echo $html->link('Complete View', array('controller' => 'admins','action' => 'CompleteView', $factory_id ));
		
		echo "</td></tr>";	
		
		
}
			
			
?>

</table>
</div>		
		
<?php } ?>

 
  
  
  <br /><br />
  <!--<div align="left">
 	<font size="2">
    	&nbsp;&nbsp;&nbsp;
        Please note, <?php echo $html->image("cross.png", array('alt' => 'status')); ?> = <b>Data not available</b>
    
    
    </font>
 </div>	-->
      
 <?php } ?>   
  
  <br /><br />
  
  
</div>  
  
  
  
  
  
  
  
  
    
    
