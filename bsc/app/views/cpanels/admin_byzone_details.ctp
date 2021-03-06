<?php  echo $javascript->link('jquery.min.js'); ?>
<?php  echo $javascript->link('jquery.tablesorter.min.js'); ?>

<?php
//echo '<pre style="text-align:left">';
//print_r($company_ans_list);
//echo '</pre>';

?>

<div class="breadcrumb"><!--breadcrumb start-->
    <div class="welcome_text">
		<font size="2">
			<?php echo $this->Html->link('Admin panel', array('controller'=>'cpanels','action'=>'index')); ?> >>
            By Multiple Enterprise - By Enterprise
    	</font>          
    </div>   
    
    <div class="clear"></div>    
</div>

<br />


<div class="company" style="text-align:left;"><!--company start-->

<h2>By Zone Analysis - Details of a zone <?php if(!empty($ezone)) echo "of $ezone"; ?></h2>




<center>
<table width="80%" id="myTable" class="tablesorter" cellpadding="0" cellspacing="0" >
	<thead>
	<tr>
    	<th>Name</th>
        <th title="Compliance percentage">CP(%)</th>
        <th>Last Survey</th>
        <th>Country</th>
        <th>Zone</th>
        <th>Group</th>
        <th title="Type of investment">Type</th>
        <th title="Proposed Investment">PI</th>
        <th title="Actual Investment">AI</th>
        <th title="Proposed Employee">PE</th>
        <th title="Actual Employee">AE</th>
        <th >Male</th>
        <th >Female</th>
        <th>Details</th>
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
    	<td><?php echo $this->Html->link($name, array('controller'=>'cpanels','action' => 'facilitystatus',$val["RESULT"]["company_id"]))	?></td>
        <td><?php echo round($val[0]['rating'],2) ?>%</td>
        <td><?php echo strftime("%B,%Y", strtotime($date)) ?></td>
        <td><?php echo $val['company']['country'] ?></td>
        <td><?php echo $val['company']['zone'] ?></td>
        <td><?php echo $val['company']['group_no'] ?></td>
        <td><?php echo $val['company']['type_of_investment'] ?></td>
        <td><?php echo $val['company']['proposed_investment'] ?></td>
        <td><?php echo $val['company']['actual_investment'] ?></td>
        <td><?php echo $val['company']['proposed_employee'] ?></td>
        <td><?php echo $val['company']['actual_employee'] ?></td>
        <td><?php echo $val['company']['male'] ?></td>
        <td><?php echo $val['company']['female'] ?></td>
        <td><?php echo $this->Html->link('Details', array('controller'=>'cpanels','action' => 'facilityans',$company_id,$date)); ?></td>
    </tr>	
	
	<?php } ?>
	
    </tbody>
</table>




<br />



<table class="survey_table2">	
	<tr>
    	<td>CP (%) </td>
        <td>Compliance percentage</td>
    </tr>	
    
    <tr>
    	<td>Type</td>
        <td>Type of investment</td>
    </tr>
    
    <tr>
    	<td>PI</td>
        <td>Proposed Investment</td>
    </tr>
    
    <tr>
    	<td>AI</td>
        <td>Actual Investment</td>
    </tr>
    
    <tr>
    	<td>PE</td>
        <td>Proposed Employee</td>
    </tr>
    
    <tr>
    	<td>AE</td>
        <td>Actual Employee</td>
    </tr>
   	
</table>



</center>


</div><!--company end-->




<script type="text/javascript">
$(document).ready(function() 
    { 
        $("#myTable").tablesorter(); 
    } 
); 
</script>