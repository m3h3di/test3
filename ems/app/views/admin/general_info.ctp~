
<?php
echo '<pre>';
//print_r($gen_info);
echo '</pre>';
?>
<style>
table tr td{
	text-align:center;
}
</style>


<div class="reports">
<br/><br/>

<div class="report_title">
    <font size="2" color="#333">
        <b>General Information</b>
    </font>
</div>
			
   <br/><br/>

<div class="excellExport" style="padding:0 40px 10px 0;text-align:right">
<a href="" onclick="javascript:x()">Excel Export</a>
</div>

<div class="targetTable">
<table width="950" class="tablesorter" cellpadding="5" cellspacing="5">
	<tr>
    	<td><b>Name</b></td>
		<td><b>Zone</b></td>
        <td><b>Industry Type</b></td>
        <td><b>Products</b></td>
        <td><b>Raw Material Used</b></td>
        <td><b>Details</b></td>
    </tr>
<?php


$id=0;
$name="";
$zone="";
$type="";
$product="";
$mat="";
foreach($gen_info as $key=>$val){
	$factory_id = $val['factory']['id'];
	if($id == $factory_id ){
		
		$q_id = $val['ANS']['question_id'];
		if(intval($q_id) == 15 ) {
			$product = $val[0]['p'];
			if(trim($product) == "Other") $product = $val['ANS']['text'];
		}
		elseif(intval($q_id) == 16 ) $mat = $val[0]['p'];
		
	}
	
	elseif($id != $factory_id ){
		if(empty($val['ANS']['question_id'])) continue;
		
		if($id !=0){
			echo "<tr>
				<td>".$this->Html->link($name, array('controller'=>'admins','action' => 'FacilityReport',$id))."</td>
				<td>".$zone."</td>
				<td>".$type."</td>
				<td>".$product."</td>
				<td>".$mat."</td>
				<td>".$this->Html->link('Details', array('controller'=>'admins','action' => 'SectionReport',1 ,$id))."</td>
			</tr>";
		}
		
		
		$id = $factory_id;
		$q_id = $val['ANS']['question_id'];
		if(intval($q_id) == 12 ){ 
			$type = $val['ANS']['text'];
			$name = $val['factory']['factory_name'];
			$zone = $val['factory']['Zone'];	
			
		}
		
		
		
		$product="";
		$mat="";
		
	}
	
	
}

?>
</table>
</div>
</div>