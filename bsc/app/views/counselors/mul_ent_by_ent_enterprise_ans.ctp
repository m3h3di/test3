<?php 
//echo  '<pre style="text-align:left">';
//print_r($sec) ;
//print_r($ans_list) ;
$company_info= $company_info[0]['companies'];
//print_r($company_info) ;

//echo '</pre>';
//echo $factory_id;

?>


<div class="breadcrumb"><!--breadcrumb start-->
    <div class="welcome_text"><!--date_combo start-->
		<font size="2">
			<?php echo $this->Html->link('Home', array('controller'=>'counselors','action'=>'home')); ?> >>
            <?php echo $this->Html->link('Enterprise Analysis', array('controller'=>'counselors','action'=>'enterprise_analysis')); ?> >>
            By Multiple Enterprise
    	</font>          
    </div>   
    
    <div class="clear"></div>    
</div>

<br />


<div class="company" style="text-align:left">
<h2>Compliance Percentage</h2>
<center>
<table width="100%">
	<tr>
    	<th>Compliance issues</th>
        <th>Compliance Percentage</th>
    </tr>
<?php

$ttp=0.0;
$tp=0.0;
foreach($sec as $sec_key=>$sec_val){
	$criteria  = 	$sec_val['sections']['id'];
	if($criteria == 3 || $criteria == 12) continue;
	$criteria_name = $sec_val['sections']['name'];
	
	// to count the number of questions of a specific number
	$number_1=0; //100%
	$number_5=0; //50%
	$number_0=0; //0%
	$number_na=0; //na
	
	/*$number_9=0; //90%
	$number_8=0; //80%
	$number_75=0; //75%
	$number_3=0; //30%
	$number_25=0; //25%
	$number_10=0; //10%*/
	

	foreach($ans_list as $key=>$ans)
	{
		if ($ans['questions']['section_id'] == $criteria )
		{
			if( $ans['company_ans_lists']['status'] == 1 )
			{
				if( $ans['company_ans_lists']['point'] == 1)	$number_1++;
				elseif( $ans['company_ans_lists']['point'] == 0)	$number_0++;
				else $number_5++;
				
				/*if( $ans['company_ans_lists']['point'] == 1)			$number_1++;
				else if( $ans['company_ans_lists']['point'] == 0.9)		$number_9++;
				else if( $ans['company_ans_lists']['point'] == 0.8)		$number_8++;
				else if( $ans['company_ans_lists']['point'] == 0.75)	$number_75++;
				else if( $ans['company_ans_lists']['point'] == 0.5)		$number_5++;
				else if( $ans['company_ans_lists']['point'] == 0.3)		$number_3++;
				else if( $ans['company_ans_lists']['point'] == 0.25)	$number_25++;
				else if( $ans['company_ans_lists']['point'] == 0.10)	$number_10++;
				else if( $ans['company_ans_lists']['point'] == 0)		$number_0++;*/
			}
			else $number_na++;
	
		}
	}
	
	$ttp+= $number_1+$number_5+$number_0;
	$tp+= $number_1 + $number_5 * 0.5 + $number_0 * 0;
	
	/*$ttp+= $number_1+$number_9+$number_8+$number_75+$number_5+$number_3+$number_25+$number_10+$number_0;
	$tp+= $number_1+$number_9 * 0.9+$number_8 * 0.8+$number_75 * 0.75+$number_5 * 0.5+$number_3 * 0.3+$number_25 * 0.25+$number_10 * 0.1+$number_0 * 0;*/
		?>
		<tr>
			<td><?php echo $criteria_name; ?></td>
			<td> 
			<?php 
				$sec_perc = ($number_1 + $number_5 * 0.5 + $number_0 * 0.0)/($number_1+$number_5+$number_0)*100; 
	
	/*$sec_perc = ($number_1+$number_9 * 0.9+$number_8 * 0.8+$number_75 * 0.75+$number_5 * 0.5+$number_3 * 0.3+$number_25 * 0.25+$number_10 * 0.1+$number_0 * 0)/
			($number_1+$number_9+$number_8+$number_75+$number_5+$number_3+$number_25+$number_10+$number_0)*100; */			
				
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
    	<th>Compliance issues</th>
        <th> Total question(s) </th>
        <th> 1(s) </th>
        <th> 0.50(s) </th>
       <!-- <th> 0.9(s) </th>
        <th> 0.8(s) </th>
        <th> 0.75(s) </th>
        <th> 0.50(s) </th>
        <th> 0.30(s) </th>
        <th> 0.25(s) </th>
        <th> 0.10(s) </th>-->
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
	if($criteria == 3 || $criteria == 12) continue;
	$criteria_name = $sec_val['sections']['name'];
	
	$number_1=0; //100%
	$number_5=0; //50%
	$number_0=0; //0%
	$number_na=0; //na
	
	/*$number_9=0; //90%
	$number_8=0; //80%
	$number_75=0; //75%
	$number_3=0; //30%
	$number_25=0; //25%
	$number_10=0; //10%*/
	

	foreach($ans_list as $key=>$ans){
		if ($ans['questions']['section_id'] == $criteria ){
			if( $ans['company_ans_lists']['status'] == 1 ){
				
				if( $ans['company_ans_lists']['point'] == 1)	$number_1++;
				elseif( $ans['company_ans_lists']['point'] == 0)	$number_0++;
				else $number_5++;
				
				
				/*if( $ans['company_ans_lists']['point'] == 1)			$number_1++;
				else if( $ans['company_ans_lists']['point'] == 0.9)		$number_9++;
				else if( $ans['company_ans_lists']['point'] == 0.8)		$number_8++;
				else if( $ans['company_ans_lists']['point'] == 0.75)	$number_75++;
				else if( $ans['company_ans_lists']['point'] == 0.5)		$number_5++;
				else if( $ans['company_ans_lists']['point'] == 0.3)		$number_3++;
				else if( $ans['company_ans_lists']['point'] == 0.25)	$number_25++;
				else if( $ans['company_ans_lists']['point'] == 0.10)	$number_10++;
				else if( $ans['company_ans_lists']['point'] == 0)		$number_0++;*/
				
			}
			else $number_na++;
	
		}
	}
	
	$ttp+= $number_1+$number_5+$number_0;
	$tp+= $number_1 + $number_5 * 0.5 + $number_0 * 0;
	
	/*$ttp+= $number_1+$number_9+$number_8+$number_75+$number_5+$number_3+$number_25+$number_10+$number_0;
	$tp+= $number_1+$number_9 * 0.9+$number_8 * 0.8+$number_75 * 0.75+$number_5 * 0.5+$number_3 * 0.3+$number_25 * 0.25+$number_10 * 0.1+$number_0 * 0;*/
	
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
            
            <!--<td><?php //echo $criteria_name; ?></td>
			<td> <?php //echo $number_1+$number_9+$number_8+$number_75+$number_5+$number_3+$number_25+$number_10+$number_0+$number_na; ?> </td>
			<td> <?php //echo $number_1; ?> </td>
            <td> <?php //echo $number_9; ?> </td>
            <td> <?php //echo $number_8; ?> </td>
            <td> <?php //echo $number_75; ?> </td>
			<td> <?php //echo $number_5; ?> </td>
            <td> <?php //echo $number_3; ?> </td>
            <td> <?php //echo $number_25; ?> </td>
            <td> <?php //echo $number_10; ?> </td>
			<td> <?php //echo $number_0; ?> </td>
			<td> <?php //echo $number_na; ?> </td>
            <td> <?php //echo $number_1+$number_9+$number_8+$number_75+$number_5+$number_3+$number_25+$number_10+$number_0; ?> </td>
            
            <td> 
			<?php //echo $number_1+$number_9 * 0.9+$number_8 * 0.8+$number_75 * 0.75+$number_5 * 0.5+$number_3 * 0.3+$number_25 * 0.25+$number_10 * 0.1+$number_0 * 0;?> 
            </td>-->
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

<div style="padding:5px" class="company_box">
	<b>TPP</b> = Total Points Possible = <?php echo $ttp ?><br/><br/>
    <b>TPR</b> = Total Point Received = <?php echo $tp ?><br/><br/>
    <b>Result</b> = (Total Point Received / Total Points Possible) * 100 = ( <?php echo $tp." / ".$ttp ?> ) * 100
    = <?php echo round(100*$tp/$ttp,2); ?>%
</div>

<br/><br/><br/>
<h2>Enterprise Information</h2>
<div class="company_box"><!--company_box start-->
	<div class="company_box_body"><!--company_box_body start-->
    <?php
    	//echo  '<pre style="text-align:left">';
		//print_r($company_info) ;
		//echo '</pre>';
	?>
    
    <div class="company_box_info"><!--company_box_info start-->
		
            Name : <font color="#58595b"><b><?php echo $company_info['name']; ?></b></font>
           <div class="line"></div>
            
            Zone : <font color="#58595b"><b><?php echo $company_info['zone']; ?></b></font>
             <div class="line"></div>
                        
            Country : <font color="#58595b"><b><?php echo $company_info['country']; ?></b></font>
           <div class="line"></div>
            
            Plot No : <font color="#58595b"><b><?php echo $company_info['plot_no']; ?></b></font>
            <div class="line"></div>
            
            Proposed Investment: <font color="#58595b">
            <b><?php echo number_format($company_info['proposed_investment']);//echo $company_info['proposed_investment']; ?></b></font>
             <div class="line"></div>
            
            Local Employee-proposed : <font color="#58595b">
            <b><?php echo number_format($company_info['proposed_employee']);//echo $company_info['proposed_employee']; ?></b></font>
            <div class="line"></div>
            
            Local employee-actual : <font color="#58595b">
            <b><?php echo number_format($company_info['actual_employee']);//echo $company_info['actual_employee']; ?></b></font>
             <div class="line"></div>
            
            Expatriate-proposed : <font color="#58595b">
            <b><?php echo number_format($company_info['proposed_expatriate']);//echo $company_info['proposed_expatriate']; ?></b></font>
            
                     
    </div><!--company_box_info end-->
    
    <div class="company_box_info" style=""><!--company_box_info start-->
		
            Type of investment : <font color="#58595b"><b><?php echo $company_info['type_of_investment']; ?></b></font>
           <div class="line"></div>
            
			Product : <font color="#58595b"><b><?php echo $company_info['product']; ?></b></font>
             <div class="line"></div>
            
             Actual Investment:<font color="#58595b">
             <b><?php echo number_format($company_info['actual_investment']);//echo $company_info['actual_investment']; ?></b></font>
            <div class="line"></div>
            
            Date of Commercial Operation : <font color="#58595b">
            <b><?php echo strftime("%b %d, %Y", strtotime($company_info['commercial_operation']));//echo $company_info['commercial_operation']; ?></b></font>
            <div class="line"></div>
            
            Male : <font color="#58595b">
            <b><?php echo number_format($company_info['male']);//echo $company_info['male']; ?></b></font>
            <div class="line"></div>
            
            Female : <font color="#58595b">
            <b><?php echo number_format($company_info['female']);//echo $company_info['female']; ?></b></font>
             <div class="small_line"><!--small_line start-->
        		<?php echo $html->image('small_dot_line.gif', array('alt' => 'bottom','border'=>'0') );?>
        	</div>
            
            Expatriate-Actual : <font color="#58595b">
            <b><?php echo number_format($company_info['actual_expatriate']);//echo $company_info['actual_expatriate']; ?></b></font>
            
    </div><!--company_box_info end-->
 <div class="clear"></div>    
</div><!--company_box_body end-->
 
<div class="clear"></div>    
</div><!--company_box end-->
<br/><br/>

<h2>Answer Sheet </h2>
<br/>
<?php
$i=1;
?>
<table width="100%">
	<tr>
		<th width=3% >S/N</th>
		<th width=50% style="text-align:center">Compliance Issues</th>
		<th width="5%">Status</th>
		<th width="14%" style="text-align:center">Irregularities</th>
		<th width="14%" style="text-align:center">Suggestions</th>
		<th width="14%" style="text-align:center">Remarks</th>
	</tr>

	<?php
	foreach($ans_list as $key=>$ans){?>
	
    <tr>
    	<td width=3% ><?php echo $i; ?></td>
		<td width=50% style="text-align:center"><?php echo $ans['questions']['question']; ?></td>
		<td width="5%">
		<?php 
			if( $ans['company_ans_lists']['status'] == 1 )
			{
				if($ans['questions']['status'] == 3)
				{
					if($ans['company_ans_lists']['point'] == 1 ) echo 'Excellent';
					elseif($ans['company_ans_lists']['point'] == 0 ) echo 'Bad';
					else echo "Good";
					
				}
				// added for 1st question (100%,90%,80%.....type ans) start
				else if($ans['questions']['status'] == 4)
				{
					/*if($ans['company_ans_lists']['point'] == 1 ) echo '100%';
					else if($ans['company_ans_lists']['point'] == 0.9 ) echo '90%';
					else if($ans['company_ans_lists']['point'] == 0.8 ) echo '80%';
					else if($ans['company_ans_lists']['point'] == 0.75 ) echo '75%';
					else if($ans['company_ans_lists']['point'] == 0.5 ) echo '50%';
					else if($ans['company_ans_lists']['point'] == 0.3 ) echo '30%';
					else if($ans['company_ans_lists']['point'] == 0.25 ) echo '25%';
					else if($ans['company_ans_lists']['point'] == 0.1 ) echo '10%';
					else if($ans['company_ans_lists']['point'] == 0 ) echo '0%';*/
					
					
					for($i=1;$i>=0;$i=$i-0.05) 
					{ 
                          if($ans['company_ans_lists']['point'] == $i ) echo ($i*100).'%';      	
                    } 
					
				}// added for 1st question (100%,90%,80%.....type ans) end
				else
				{
					if($ans['company_ans_lists']['point'] == 1 ) echo 'Yes';
					else echo 'No';
				}
			}
			else echo "NA";
			
			
			/*if( $ans['company_ans_lists']['status'] == 1 ){
				if($ans['questions']['status'] == 3){
					if($ans['company_ans_lists']['point'] == 1 ) echo '100%';
					else if($ans['company_ans_lists']['point'] == 0.9 ) echo '90%';
					else if($ans['company_ans_lists']['point'] == 0.8 ) echo '80%';
					else if($ans['company_ans_lists']['point'] == 0.75 ) echo '75%';
					else if($ans['company_ans_lists']['point'] == 0.5 ) echo '50%';
					else if($ans['company_ans_lists']['point'] == 0.3 ) echo '30%';
					else if($ans['company_ans_lists']['point'] == 0.25 ) echo '25%';
					else if($ans['company_ans_lists']['point'] == 0.1 ) echo '10%';
					
					else if($ans['company_ans_lists']['point'] == 0 ) echo '0%';
					
				}
				else
				{
					if($ans['company_ans_lists']['point'] == 1 ) echo '100%';
					else echo '0%';
				}
			}
			else echo "NA";*/
			
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

</div>
