<?php
$zone =  array("DEPZ","CHEPZ","CEPZ","MEPZ","IEPZ","AEPZ","UEPZ","KEPZ");
//echo '<pre>';
//print_r($gen_info);
//print_r($gen_ans);
//echo '</pre>';
?>



<script type="text/javascript">
	function a()
	{
		var answers = document.getElementById('answers').value;	
		var range = document.getElementById('range').value;	
		
		if(range!=0 && answers==0)
		{
			alert("Please select Type of chemicals.");
			document.getElementById('range').value=0;	
		}
	
		
	}

</script>


<div class="reports">


<br /><br />
<div class="report_title">
    <font size="2" color="#333">
        <b>Store/Uses/Handling of chemical and hazmat at  the enterprises</b>
    </font>
<br /><br />


<form action="" method="post" name="section_list" >

<!--select answers from drop down start-->
<font size="2" color="#333">Type of chemicals</font>
       <select name="answers" id="answers" rel="">
            <option value="0" >Select All</option>
            <?php 
				foreach($gen_ans as $key=>$val)
				{	
					$ans_id = $val['answers']['id'];
					$ans_val = $val['answers']['answer'];
					
					$select="";
					if( !empty($_POST) & $_POST['answers'] == $ans_id ) 
						$select = 'selected="selected"';
					else $select='';
					echo '<option '. $select .' value="' .$ans_id. '">'.$ans_val.'</option>';
				}
            ?>
        </select>
<!--select answers from drop down end-->

<br /><br />

<!--select range from drop down start-->
<font size="2" color="#333">Range of amount</font>
       <select name="range" id="range" rel="">
            <option value="0" >Select range</option>
            <?php 
				for($i=0;$i<15000;$i=$i+50)
				{	
					$val1=$i+50;
					
					//$v=$i."-".$val1;
					
					//if($i==0)
						//$v="<".$val1;
					//else
						$v=">".$i;
					
					$select="";
					if( !empty($_POST) & $_POST['range'] == $val1 ) 
						$select = 'selected="selected"';
					else $select='';
					//echo '<option '. $select .' value="' .$i. '">'.$v.'</option>';
					echo '<option '. $select .' value="' .$val1. '">'.$v.'</option>';
				}
            ?>
        </select>
<!--select range from drop down end-->
&nbsp;&nbsp;&nbsp;
<font size="2" color="#333">Zone</font>
	<select name="zone" id="zone" >
		<option value="0" >Select range</option>
		<?php 
		foreach($zone_list as $zone){	
			$zone_name = $zone['factories']['Zone'];
			$select="";
			if( !empty($_POST) & $_POST['zone'] == $zone_name ) 
				$select = 'selected="selected"';
			else $select='';
			
			echo '<option '. $select .' value="' .$zone_name. '">'.$zone_name.'</option>';
		}
		?>
	</select>
	<br /><br />
	<input type="submit" name="go" id="go" onclick="a()" value="Go" /><!--class="go_button"--> 

</form>

</div>







<br /><br />

<div class="excellExport" style="padding:0 40px 10px 0;text-align:right">
<a href="" onclick="javascript:x()">Excel Export</a>
</div>

<div class="targetTable">
<table width="950" class="tablesorter" cellpadding="5" cellspacing="5">
	<tr>
    	<td><b>Name</b></td>
		<td><b>Zone</b></td>
        <td><b>Type Of Chemicals</b></td>
        <td><b>Amount</b></td>
        <td><b>Where Stored</b></td>
        <td><b>MSDS</b></td>
    </tr>
<?php


/////////////edited by nandinee start






if(!empty($_POST['range'])){  // if($amount==){  start
$id=0;
//echo $_POST['range'];
foreach($gen_info as $key=>$val)
{
	
	$factory_id = $val['factory']['id'];
	$type = $val['ANS']['answer'];
	$name = $val['factory']['factory_name'];
	$zone = $val['factory']['Zone'];
	
	
	$cmplx =$val['ANS']['text'];
	if( $id == $factory_id){
		$name ="";
		$zone="";
	}
	
	$data = explode('|',$cmplx);

	$where = $data[2];
	
	if($data[3] == 0) $msds = "NO";
	else $msds = "Yes";
		
			
	
	///to match with the posted amount start
		 $length = strpos($data[1]," ");
		 $post_amount= round(substr($data[1],0,$length));
	///to match with the posted amount end
	
	
	//if($post_amount >= $_POST['range'] && $post_amount < ($_POST['range']+50))
	
	if($post_amount > ($_POST['range']-50)){
		
		
		echo "<tr>
			<td>".$this->Html->link($name, array('controller'=>'admins','action' => 'FacilityReport',$id))."</td>
			<td>".$zone."</td>
			<td>".$type."</td>
			<td>".$data[1]."</td>
			<td>".$where."</td>
			<td>".$msds."</td>
		</tr>";
	}
	
	$id =$factory_id;
	
}


}/// if($amount==){  end
/////////////edited by nandinee end





else {
$id=0;	
foreach($gen_info as $key=>$val)
{
	
	$factory_id = $val['factory']['id'];
	
	$type = $val['ANS']['answer'];
	$name = $val['factory']['factory_name'];
	$zone = $val['factory']['Zone'];
	
	$cmplx =$val['ANS']['text'];
	if( $id == $factory_id)
	{
		$name ="";
		$zone = "";
	}
	
	
	$data = explode('|',$cmplx);
	//print_r($data);
	$amount  = $data[1];
	$where = $data[2];
	if($data[3] == 0) $msds = "NO";
	else $msds = "Yes";

	echo "<tr>
		<td>".$this->Html->link($name, array('controller'=>'admins','action' => 'FacilityReport',$factory_id))."</td>
		<td>".$zone."</td>
		<td>".$type."</td>
		<td>".$amount."</td>
		<td>".$where."</td>
		<td>".$msds."</td>
	</tr>";

	
	$id =$factory_id;
}



}






?>
</table>
</div>
<br /><br />
</div>