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
    	<th>SN</th>
    	<th>Name</th>
        <th>Rating(%)</th>
        <th>Last Survey</th>
        <th>Country</th>
        <th>Zone</th>
        <!--<th>Product category</th>-->
    </tr>
    </thead>
    <tbody>
	<?php
	$rank =0;
	foreach($company_ans_list as $key=>$val){
		$rank++;
		$name = $val['company']['name'];
		$company_id= $val["RESULT"]["company_id"];
		$date = $val['RESULT']['survey_date'];
		?>
	<tr>
    	<td><?php echo $rank ?></td>
    	<td><?php echo $name; ?></td>
        <td><?php echo round($val[0]['rating'],2) ?></td>
        <td><?php echo strftime("%B,%Y", strtotime($date)) ?></td>
        <td><?php echo $val['company']['country'] ?></td>
        <td><?php echo $val['company']['zone'] ?></td>
        <!--<td><?php //echo $val['company']['product_category'] ?></td>-->
    </tr>	
	
	<?php }
	?>
    </tbody>
</table>




