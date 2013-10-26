<?php



/* to make the looping easier make the array simple start*/
function reArrange($source)
{
	
	$i = 0;
			
	foreach($source as $key=>$val)
	{
		if( intval($val['a']['status']) == 0 ) 
		{
			$fact_id = $val['a']['factory_id'];
			
			$res[$i]['base_fact_id'] = $val['a']['factory_id'];
			$res[$i]['base_fact_name'] = $val['b']['factory_name'];
			
			$res[$i]['follow_fact_id'] = "";
		}
			
		elseif( intval($val['a']['status']) != 0 ) 
		{
			if($val['a']['factory_id'] == $fact_id)
			{
				$res[$i-1]['follow_fact_id'] = $val['a']['factory_id'];
			}
			else
			{
				$res[$i]['base_fact_id'] = "";
				$res[$i]['follow_fact_id'] = $val['a']['factory_id'];
				$res[$i]['follow_fact_name'] = $val['b']['factory_name'];
			}
		}
		
		$i++;
	}
	
	return $res;		
}
/* to make the looping easier make the array simple end*/




//echo '<pre>';
//print_r($total_company);

$test = reArrange($total_company);
//print_r($test);

//echo '</pre>';
?>
<style>
table tr td{
	text-align:center;
}
</style>

<div class="reports">

<h3><?php //echo $question_val; ?></h3>


<div class="report_title">
        	<font size="4" color="#333333"><b><?php echo $question_val; ?></b></font>
</div>

<br />

<div class="report_title">
     <font size="2" color="#333333">Number of factories responded 'YES' in baseline survey<b> <?php echo $no_in_baseline; ?></b></font><br />
	 <font size="2" color="#333333">Number of factories responded 'YES' in followup survey<b> <?php echo $no_in_followup; ?></b></font>
</div>

<br /><br />





<table width="950" class="tablesorter" cellpadding="5" cellspacing="5">
	<tr>
    	<td><b>Factory Name</b></td>
        <td><b>'YES' In Baseline Survey</b></td>
        <td><b>'YES' In Followup Survey</b></td>
        <td><b>Complete View</b></td>
    </tr>
<?php

/*
$status_baseline="";
$status_followup="";
$factory_id="";

	
foreach($total_company as $key=>$val)
{
	
	/*if($factory_id == $val['a']['factory_id'])
	{
		if($val['a']['status']==0)
		{
			$status_baseline = 'Yes';
			$img_baseline = "tick.png";
		}
		if($val['a']['status']==1)
		{
			$status_followup = 'Yes';
			$img_followup = "tick.png";
		}
		
	}
	
	else
	{
		if($val['a']['status']==0)
		{
			$status_baseline = 'Yes';
			$status_followup = 'No';
			
			$img_baseline = "tick.png";
			$img_followup = "cross.png";
		}
		if($val['a']['status']==1)
		{
			$status_baseline = 'No';
			$status_followup = 'Yes';
			
			$img_baseline = "cross.png";
			$img_followup = "tick.png";
		}
		
	}/////////////////
	
	
	$factory_name = $val['b']['factory_name'];
	
	if($val['a']['status']==0)
	{
			$status_baseline = 'Yes';
			$img_baseline = "tick.png";
			
			
			if($factory_id == $val['a']['factory_id'])
			{
				$factory_name="";
				
				$status_followup = 'Yes';
				$img_followup = "tick.png";
			}
			else
			{
				$status_followup = 'No';
				$img_followup = "cross.png";
			}
	}
	
	else if($val['a']['status']==1)
	{
			$status_followup = 'Yes';
			$img_followup = "tick.png";
			
			if($factory_id == $val['a']['factory_id'])
			{
				$factory_name="";
				
				$status_baseline = 'Yes';
				$img_baseline = "tick.png";
			}
			else
			{
				$status_baseline = 'No';
				$img_baseline = "cross.png";
			}
	}
	
	
	
	echo "<tr><td>";
		echo $factory_name;
		echo "</td><td>";
		
		echo $html->image($img_baseline, array('alt' => 'status'));
		echo "</td><td>";
		echo $html->image($img_followup, array('alt' => 'status'));			
		
		echo "</td></tr>";	
		
		
	/*echo "<tr>
				<td>".$val['b']['factory_name']."</td>
				<td>".$status_baseline."</td>
				<td>".$status_followup."</td>
			</tr>";/////////////
			
		
		
			
			
		
	$factory_id = $val['a']['factory_id'];
}*/





$status_baseline="";
$status_followup="";

	
foreach($test as $key=>$val)
{//echo "----".$key['follow_fact_id'];exit;
	
	
	if($val['base_fact_id']==$val['follow_fact_id'])
	{
		$factory_id = $val['base_fact_id'];
		$factory_name = $val['base_fact_name'];
		
		$status_baseline = 'Yes';
		$img_baseline = "tick.png";
			
		$status_followup = 'Yes';
		$img_followup = "tick.png";
			
	}
	
	else
	{
		if($val['base_fact_id']=="")
		{
			$factory_id = $val['follow_fact_id'];
			$factory_name = $val['follow_fact_name'];
			
			$status_baseline = 'No';
			$img_baseline = "cross.png";
			
			$status_followup = 'Yes';
			$img_followup = "tick.png";
		}
		
		else if($val['follow_fact_id']=="")
		{
			$factory_id = $val['base_fact_id'];
			$factory_name = $val['base_fact_name'];
			
			$status_followup = 'No';
			$img_followup = "cross.png";
			
			$status_baseline = 'Yes';
			$img_baseline = "tick.png";
		}
			
	}
	
	
	
	echo "<tr><td>";
		//echo $factory_name;
		echo $this->Html->link($factory_name, array('controller'=>'admins','action' => 'FacilityReport',$factory_id));
		echo "</td><td>";
		
		echo $html->image($img_baseline, array('alt' => 'status'));
		echo "</td><td>";
		echo $html->image($img_followup, array('alt' => 'status'));			
		echo "</td><td>";	
		
		echo $this->Html->link("Details", array('controller'=>'admins','action' => 'CompleteView',$factory_id));
		
		echo "</td></tr>";	
		
		
}




?>
</table><br /><br />
</div>