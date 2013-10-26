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
    	<th>Zone</th>
        <th>Compliance percentage</th>
    </tr>
    </thead>
    <tbody>
	<?php
	foreach($company_ans_list as $key=>$val){
		$ezone = $val['company']['zone'];
		$company_id= 0;
		$date = 0;
		?>
	<tr>
    	<td><?php echo $val['company']['zone'] ?></td>
        <td><?php echo round($val[0]['rating'],2) ?>%</td>
       
       
    </tr>	
	
	<?php }
	?>
    </tbody>
</table>







