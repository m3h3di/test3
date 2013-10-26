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

<h2>By Enterprise <?php if(!empty($ezone)) echo "of $ezone"; ?></h2>
<br/>



<style>
ul.filterboxes li {
float:left;
padding-right:1em;
width:20%;
color:#333333;
font-size:12px;
line-height:1.5;
padding-bottom:6px;
margin:0 2px;
}

</style>






<center>
<form action="" method="post" >
<ul class="filterboxes" style="float:left;width:100%;list-style:none outside none;padding-bottom:20px;">
	
    
    <li>By Zone:<br />
	<select name="data[zone]" id="" rel="">
    <option value="0" >All zones</option>
	<?php 
	foreach($all_zone as $k=>$zone){
		$val = $zone['companies']['zone'];
		$select="";
		if( !empty($_POST) & $_POST['data']['zone'] == $val ) 
			$select = 'selected="selected"';
		else $select='';
		echo '<option '. $select .' value="' .$val. '">'.$val.'</option>';
	}
	?>

	</select> or
	</li>
	
    <li>By Product Category:
    
    <select name="data[product_category]" id="" rel="">
    <option value="0">All product categories</option>
	<?php 
	
	foreach($all_product as $k=>$zone){
		$val = $zone['product_categories']['id'];
		$product_category_name = $zone['product_categories']['name'];
		
		if( !empty($_POST) & $_POST['data']['product_category'] == $val ) 
			$select = 'selected="selected"';
		else $select='';
		echo '<option '. $select .' value="' .$val. '">'.$product_category_name.'</option>';
	}
	?>

	</select>
	</li>
    
    <li><br /><input type="submit" value="go" align="left"  /></li>
    
</ul>
	



</form>



<!--to export table start-->
<?php
	 
	 if( !empty($_POST['data']['product_category']) && !empty($_POST['data']['zone'])) 
	 {	
		 $product=$_POST['data']['product_category'];
		 $zone=$_POST['data']['zone'];
	 }
	 else 
	 {
		 $product= NULL;
		 $zone= NULL;
	 }
?>
<div align="right">Please 
	<?php echo $this->Html->link('Click', array('controller'=>'cpanels','action' => 'enterprise_export',$zone,$product));	?>
	to export
</div>
<!--to export table end-->



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
        <td><?php echo round($val[0]['rating'],2) ?></td>
        <td><?php echo strftime("%B,%Y", strtotime($date)) ?></td>
        <td><?php echo $val['company']['country'] ?></td>
        <td><?php echo $val['company']['zone'] ?></td>
        <td><?php echo $val['company']['group_no'] ?></td>
        
       <!-- <td><?php //echo $val['company']['type_of_investment'] ?></td>
        <td><?php //echo $val['company']['proposed_investment'] ?></td>-->
        
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