<?php

echo "<pre>";
//print_r($reports);
//print_r($list_ans_id);
echo "</pre>";

function tot_ans($list_ans, $ques , $ans){
	$tot = 0;
	if( !empty($ans) )
	{
		foreach($list_ans as $single_ans){
			if($single_ans['factory_ans_tables']['ans_id'] == $ans) $tot++;
		}
	}
	else{
		foreach($list_ans as $single_ans){
			if($single_ans['factory_ans_tables']['question_id'] == $ques & $single_ans['factory_ans_tables']['text'] == "yes") $tot++;
		}	
	}
	return $tot;
}

function arr_factory_id($list_ans, $ques , $ans){
	$i = 0;
	$arr = '';
	if( !empty($ans) )
	{
		foreach($list_ans as $single_ans){
			if($single_ans['factory_ans_tables']['ans_id'] == $ans){
				$arr[$i]= $single_ans['factory_ans_tables']['factory_id'] ;
				$i++;
			}
		}
	}
	else{
		foreach($list_ans as $single_ans){
			if($single_ans['factory_ans_tables']['question_id'] == $ques & $single_ans['factory_ans_tables']['text'] == "yes") {
				$arr[$i]=$single_ans['factory_ans_tables']['factory_id'] ;
				$i++;
			}
		}	
	}
	return $arr;
}
//echo "<b>".tot_ans($list_ans_id, 87)."</b>";

?>
<center>
<h3>Reports</h3>
<table style=" width:817px; ">
	<tr>
	<td width="5%" style=" border:0; padding: 10px; ">
		<b>Section</b>
	</td>
	<td style="text-align:center; border:0;  padding: 10px;">
	<b>	Criteria </b>
	</td>
	<td style=" border:0; padding: 10px;">
		<b>Number</b>
	</td>
	</tr>
<?php 
foreach($reports as $report ){ 
	$qry_ques_id = $report['Report']['question_id'];
	$qry_ans_id = $report['Report']['answer_id'];
	?>
	
	<tr>
	<td width="5%" style=" border:0;  padding: 10px; text-align:center; ">
		<b><?php echo $report['Report']['section']; ?></b>
		
	</td>
	<td style="border:0; padding: 10px;">
		<form name="data" action="/seba/admins/ReportByCriteria" method="post">
		<?php
			 $criteria = $report['Report']['criteria'];
			 $factory_id_list = arr_factory_id($list_ans_id, $qry_ques_id, $qry_ans_id);
		
		?>
		<input type="hidden" value="<?php print_r($factory_id_list); ?>" name="factory_id_list"  />
		<a href="#" onclick="javascript:this.submit()" ><?php echo $criteria; ?></a>
		
		</form>
	</td>
	<td width:"10%" style="text-align:center; border:0; padding: 10px;">
		<?php 
			
			if(!empty($qry_ques_id) ||  !empty($qry_ans_id)) {
				echo tot_ans($list_ans_id, $qry_ques_id, $qry_ans_id);
				//$factory_id_list = arr_factory_id($list_ans_id, $qry_ques_id, $qry_ans_id);
				//print_r($test);
			}
			else echo "Empty";
		
		?>
		
	</td>
	</tr>

<?php } ?>
</table>

</center>