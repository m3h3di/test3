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
        <th>Compliance percentage(%)</th>
        <th>Last Survey</th>
        <th>Country</th>
        <th>Zone</th>
        <th>Group</th>
        <th>Type of investment</th>
        <th>Proposed Investment</th>
        <th>Actual Investment</th>
        <th>Proposed Employee</th>
        <th>Actual Employee</th>
        <th>Male</th>
        <th>Female</th>
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
        <td><?php echo round($val[0]['rating'],2) ?></td>
        <td><?php echo strftime("%B,%Y", strtotime($date)) ?></td>
        <td><?php echo $val['company']['country'] ?></td>
        <td><?php echo $val['company']['zone'] ?></td>
        <td><?php echo $val['company']['group_no'] ?></td>
        
       
        
        <td>
		<?php 
			echo number_format(round($val['company']['type_of_investment'])); 
		
		?></td>
        <td><?php echo number_format(round($val['company']['proposed_investment']));  ?></td>
        
        
        <td><?php echo $val['company']['actual_investment'] ?></td>
        <td><?php echo $val['company']['proposed_employee'] ?></td>
        <td><?php echo $val['company']['actual_employee'] ?></td>
        <td><?php echo $val['company']['male'] ?></td>
        <td><?php echo $val['company']['female'] ?></td>
    </tr>	
	
	<?php } ?>
	
    </tbody>
</table>


