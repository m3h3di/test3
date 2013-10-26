<?php 
//echo  '<pre style="text-align:left">';
//print_r($sec_list) ;
//print_r($sec) ;
//print_r($ans_list) ;
$company_info= $company_info[0]['companies'];
//print_r($company_info) ;

//echo '</pre>';
//echo $factory_id;

?>

<div class="breadcrumb"><!--breadcrumb start-->
    <div class="welcome_text" style="float:left ; width:400px" ><!--date_combo start-->
		<font size="2">
			<?php echo $this->Html->link('Home', array('controller'=>'counselors','action'=>'home')); ?> >>
            <?php echo $this->Html->link('Enterprise Analysis', array('controller'=>'counselors','action'=>'enterprise_analysis')); ?> >>
            By Single Enterprise - <br />
            
            <?php echo $this->Html->link('By Compliance Issues', array('controller'=>'counselors','action'=>'by_single_ent_comliance_issu')); ?>
            
    	</font>          
    </div>   
    
    <div class="clear"></div>    
</div>

<br />



<div class="company" style="text-align:left;"><!--company start-->

<div class="welcome"><!--welcome start-->
	<div class="welcome_top"><!--welcome_top start--> </div><!--welcome_top end-->
    
    <div class="welcome_body"><!--welcome_body start--> 
    	<div class="welcome_text"><!--welcome_text start-->
        	<b><?php echo $company_info['name'] ?></b> | Survey Date:  <b><?php echo strftime("%B,%Y", strtotime($survey_date)) ?></b>
        </div><!--welcome_text end -->
     	<div class="clear"></div>   
    </div><!--welcome_body end-->
    <div class="welcome_bottom"><!--welcome_bottom start--> </div><!--welcome_bottom end-->
</div><!--welcome end-->

<br /><br />



<h2>Compliance Percentage</h2>
<center>
<table width="100%">
	<tr>
    	<th>Compliance Issues</th>
        <th>Compliance Percentage</th>
      
    </tr>
<?php

$ttp=0.0;
$tp=0.0;
foreach($sec as $sec_key=>$sec_val){
	$criteria  = 	$sec_val['sections']['id'];
	if (!array_key_exists($criteria,$sec_list)) continue;
	
	if($criteria == 3 || $criteria == 12) continue;
	
	$criteria  = 	$sec_val['sections']['id'];
	if($criteria == 3 || $criteria == 12) continue;
	$criteria_name = $sec_val['sections']['name'];
	$number_1=0;
	$number_5=0;
	$number_0=0;
	$number_na=0;
	

	foreach($ans_list as $key=>$ans){
		if ($ans['questions']['section_id'] == $criteria ){
			if( $ans['company_ans_lists']['status'] == 1 ){
				
				if( $ans['company_ans_lists']['point'] == 1)	$number_1++;
				elseif( $ans['company_ans_lists']['point'] == 0)	$number_0++;
				else $number_5++;
			}
			else $number_na++;
	
		}
	}
	$ttp+= $number_1+$number_5+$number_0;
	$tp+= $number_1 + $number_5 * 0.5 + $number_0 * 0;
		?>
		<tr>
			<td><?php echo $criteria_name; ?></td>
			<td> 
			<?php 
				$sec_perc = ($number_1 + $number_5 * 0.5 + $number_0 * 0.0)/($number_1+$number_5+$number_0)*100; 
				$sec_perc = round($sec_perc,2);
				echo $sec_perc."%";
			?> 
            </td>

		</tr>
		<?php

}
?>   
    <tr>
        <td>TOTAL</td>
        <td><b><?php echo round($tp/$ttp*100,2);  ?>%</b></td>

    </tr>
</table>
</center>
<br />
<br />

<h2>Details</h2>

<center>
<table width="100%">
	<tr>
    	<th>Compliance Issues</th>
        <th> Total question(s) </th>
        <th> 1(s) </th>
        <th> 0.5(s) </th>
        <th> 0(s) </th>
        <th> NA(s) </th>
        <th title="Total Possible Point"> TPP </th>
        <th title="Total Point"> TP </th>
    </tr>
<?php
$ttp=0.0;
$tp=0.0;
foreach($sec as $sec_key=>$sec_val){
		
	$criteria  = 	$sec_val['sections']['id'];
	
	if (!array_key_exists($criteria,$sec_list)) continue;
	
	if($criteria == 3 || $criteria == 12) continue;
	$criteria_name = $sec_val['sections']['name'];
	$number_1=0;
	$number_5=0;
	$number_0=0;
	$number_na=0;
	

	foreach($ans_list as $key=>$ans){
		if ($ans['questions']['section_id'] == $criteria ){
			if( $ans['company_ans_lists']['status'] == 1 ){
				
				if( $ans['company_ans_lists']['point'] == 1)	$number_1++;
				elseif( $ans['company_ans_lists']['point'] == 0)	$number_0++;
				else $number_5++;
			}
			else $number_na++;
	
		}
	}
	$ttp+= $number_1+$number_5+$number_0;
	$tp+= $number_1 + $number_5 * 0.5 + $number_0 * 0;
		?>
		<tr>
			<td><?php echo $criteria_name; ?></td>
			<td> <?php echo $number_1+$number_5+$number_0+$number_na ; ?> </td>
			<td> <?php echo $number_1; ?> </td>
			<td> <?php echo $number_5; ?> </td>
			<td> <?php echo $number_0; ?> </td>
			<td> <?php echo $number_na; ?> </td>
            <td> <?php echo $number_1+$number_5+$number_0; ?> </td>
            <td> <?php echo $number_1 + $number_5 * 0.5 + $number_0 * 0.0 ;?> </td>
		</tr>
		<?php

}
?>   
    <tr>
        <td>TOTAL</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td><?php echo $ttp; ?></td>
        <td><?php echo $tp; ?></td>
    </tr>
</table>
</center>
<br/><br/><br/>
<h2>Calculation</h2>
<div style="padding:10px" class="company_box">
	<b>TTP</b> = Total Possible Point = <?php echo $ttp ?><br/><br/>
    <b>TTP</b> = Total Point = <?php echo $tp ?><br/><br/>
    <b>Result</b> = (Total Point / Total Possible Point) * 100% = ( <?php echo $tp." / ".$ttp ?> ) * 100 % 
    = <?php echo round(100*$tp/$ttp,2); ?>%
    
</div>
<br/><br/><br/>
<h2>Answer Sheet </h2>
<br/>
<?php
$i=1;
?>
<table width="100%">
	<tr>
		<th width=3% title="Question Number" >Q/N</th>
		<th width=50% style="text-align:center">Compliance Issues</th>
		<th width="5%">Status</th>
		<th width="14%" style="text-align:center">Irregularities</th>
		<th width="14%" style="text-align:center">Suggestions</th>
		<th width="14%" style="text-align:center">Remarks</th>
	</tr>

	<?php
	foreach($ans_list as $key=>$ans){
		$criteria = $ans['questions']['section_id'];
		if (!array_key_exists($criteria,$sec_list)) continue;
		?>
	
    <tr>
    	<!--<td width=3% ><?php echo $i; ?></td>-->
        <td width=3% ><?php echo $ans['questions']['id']; ?></td>
		<td width=50% style="text-align:center"><?php echo $ans['questions']['question']; ?></td>
		<td width="5%">
		<?php 
			if( $ans['company_ans_lists']['status'] == 1 ){
				if($ans['questions']['status'] == 3){
					if($ans['company_ans_lists']['point'] == 1 ) echo 'Excellent';
					elseif($ans['company_ans_lists']['point'] == 0 ) echo 'Bad';
					else echo "Good";
					
				}
				else{
					if($ans['company_ans_lists']['point'] == 1 ) echo 'Yes';
					else echo 'No';
				}
			}
			else echo "NA";
		?>
        </td>
		<td width="14%" style="text-align:center"></td>
		<td width="14%" style="text-align:center"></td>
		<td width="14%" style="text-align:center"></td>
     </tr>   
		
		<?php
    	$i++;
	}
	?>
</table>

</div><!--company end-->

