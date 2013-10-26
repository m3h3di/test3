<?php
// file name for download  
//$filename = "enterprise.xls"; 
//header("Content-Disposition: attachment; filename=\"$filename\""); 
//header("Content-Type: application/vnd.ms-excel"); 

?>

<?php
//echo '<pre style="text-align:left">';
//print_r($company_ans_list);
//echo '</pre>';exit;

?>





<table cellpadding="0" cellspacing="0" border="1" style="border-collapse:collapse;">
		<thead>
        <tr>
			<th>Name</th>
			<th>Rating(%)</th>
			<th>Survey Date</th>
            <th>Zone</th>
		</tr>
		</thead>
        <tbody>
		<?php
		foreach($company_ans_list as $key=>$val){
			$name = $val['company']['name'];
			$company_id= $val["RESULT"]["company_id"];
			$date = $val['RESULT']['survey_date'];
			?>
		<tr>
			<td><?php echo $name;	?></td>
			<td><?php echo round($val[0]['rating'],2) ?>%</td>
			<td><?php echo strftime("%B,%Y", strtotime($date)) ?></td>
            <td><?php echo $val['company']['zone'] ?></td>
		</tr>	
		
		<?php }
		?>
        </tbody>
</table>







