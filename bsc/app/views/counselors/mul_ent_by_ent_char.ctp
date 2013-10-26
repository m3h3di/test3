<?php  echo $javascript->link('jquery.min.js'); ?>
<?php  echo $javascript->link('jquery.tablesorter.min.js'); ?>

<?php
//echo '<pre style="text-align:left">';
//print_r($company_ans_list);
//print_r($all_zone);
//print_r($all_country);
//print_r($_POST);
//print_r($all_product);
//echo '</pre>';

?>

<div class="breadcrumb"><!--breadcrumb start-->
    <div class="welcome_text">
		<font size="2">
            <?php echo $this->Html->link('Home', array('controller'=>'counselors','action'=>'home')); ?> >>
            <?php echo $this->Html->link('Enterprise Analysis', array('controller'=>'counselors','action'=>'enterprise_analysis')); ?> >> <br />
            By Multiple Enterprise - By Enterprise Characteristics
    	</font>          
    </div>   
    
    <div class="clear"></div>    
</div>

<br />


<div class="company" style="text-align:left;"> <!--company start-->
<h2>By Enterprise Characteristics</h2>
<br/>
<div>


<!--<form action="" method="post" >
<div class="welcome">-->
	
    <!--<font size="2">By Zone:</font>
	<font size="1">
	<select name="data[zone]" id="" rel="">
    <option value="0" >All zones</option>
	<?php 
	/*foreach($all_zone as $k=>$zone){
		$val = $zone['companies']['zone'];
		$select="";
		if( !empty($_POST) & $_POST['data']['zone'] == $val ) 
			$select = 'selected="selected"';
		else $select='';
		echo '<option '. $select .' value="' .$val. '">'.$val.'</option>';
	}*/
	?>

	</select>   </font> --> 
	
	
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	
    <!--<font size="2">By Product Category:</font>
    
	<font size="1">
    <select name="data[product_category]" id="" rel="">
    <option value="0">Please select</option>
	<?php 
	
	/*foreach($all_product as $k=>$zone){
		$val = $zone['product_categories']['id'];
		$product_category_name = $zone['product_categories']['name'];
		
		if( !empty($_POST) & $_POST['data']['product'] == $val ) 
			$select = 'selected="selected"';
		else $select='';
		echo '<option '. $select .' value="' .$val. '">'.$product_category_name.'</option>';
	}*/
	?>

	</select></font>-->
	
	<!--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

	<input type="submit" value="go"  />
</form>
</div>-->



<center>
<table width="80%" id="myTable" class="tablesorter" cellpadding="0" cellspacing="0">
	<thead>
	<tr>
    	<th>SN</th>
    	<th>Name</th>
        <th>Rating(%)</th>
        <th>Last Survey</th>
        <th>Country</th>
        <th>Zone</th>
        <!--<th>Product category</th>-->
        <th>Details</th>
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
    	<td><?php echo  $rank ?></td>
    	<td><?php echo $this->Html->link($name, array('controller'=>'counselors',
		'action' => 'mul_ent_by_ent_enterprise_info',$val["RESULT"]["company_id"]))	?></td>
        <td><?php echo round($val[0]['rating'],2) ?>%</td>
        <td><?php echo strftime("%B,%Y", strtotime($date)) ?></td>
        <td><?php echo $val['company']['country'] ?></td>
        <td><?php echo $val['company']['zone'] ?></td>
        <!--<td><?php //echo $val['company']['product_category'] ?></td>-->
        <td><?php echo $this->Html->link('Details', array('controller'=>'counselors',
		'action' => 'mul_ent_by_ent_enterprise_ans',$company_id,$date)); ?></td>
    </tr>	
	
	<?php }
	?>
    </tbody>
</table>
</center>

</div>


</div><!--company end-->


<script type="text/javascript">
$(document).ready(function() 
    { 
        $("#myTable").tablesorter(); 
    } 
); 
</script>