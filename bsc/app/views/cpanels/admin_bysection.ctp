<?php  echo $javascript->link('jquery.min.js'); ?>
<?php  echo $javascript->link('jquery.tablesorter.min.js'); ?>
<?php

//echo '<pre style="text-align:left">';
//print_r($all_sections);
//print_r($company_ans_list);
//print_r($_POST);
//echo '</pre>';

$list_month = array('01'=>'January','02'=>'February','03'=>'March','04'=>'April','05'=>'May','06'=>'June','07'=>'July','08'=>'August','09'=>'September','10'=>'October','11'=>'November','12'=>'December');
?>


<div class="breadcrumb"><!--breadcrumb start-->
    <div class="welcome_text">
		<font size="2">
			<?php echo $this->Html->link('Admin panel', array('controller'=>'cpanels','action'=>'index')); ?> >>
            By Multiple Enterprise - By Compliance Issues
    	</font>          
    </div>   
    
    <div class="clear"></div>    
</div>

<br />


<div class="company" style="text-align:left;"><!--company start-->
<h2>By Compliance Issues</h2>
<br/>

<div class="welcome"><!--welcome start-->
    
        <div class="welcome_text"><!--date_combo start-->
       <form action="" method="post" name="section_list" >
        	<font size="1">Zone: </font>
            <select name="zone" id="" rel="">
            <option value="0" >All zones</option>
            <?php 
            foreach($all_zone as $k=>$zone){
                $val = $zone['companies']['zone'];
                $select="";
                if( !empty($_POST) & $_POST['zone'] == $val ) 
                    $select = 'selected="selected"';
                else $select='';
                echo '<option '. $select .' value="' .$val. '">'.$val.'</option>';
            }
            ?>
        
            </select>
            | <font size="1">Month: </font>
            <select name="month">
            <option value="0">Select</option>

            	<?php
				
				//print_r($list_month);
				foreach( $list_month as $num => $mon) {
					//$num = intval($num)+1;
					if (!empty($_POST['month']) & ($_POST['month'] == $num) )
						$chk = ' selected="selected" ';
					else $chk ='';
					
					echo '<option ' . $chk . ' value="'. $num .'" >' .$mon. '</option>';
				}
				?>
            </select>
            
            
            <font size="1">Year: </font>
            <select name="year">
            	<option value="0">Select</option>
				<?php
                	for($num=2008;$num<=2015;$num++ ){
						if (!empty($_POST['year']) & ($_POST['year'] == $num) )
						$chk = ' selected="selected" ';
					else $chk ='';
					
					echo '<option ' . $chk . ' value="'. $num .'" >' .$num. '</option>';
					}
				?>
            	
                
            </select>
        	<input type="submit" name="go" id="go" onclick="" value="Go" /><!--class="go_button"-->
		
        </div><!--date_combo end -->
        
     	<div class="clear"></div>   
</div><!--welcome end-->

<br/><br/>

<center>
<table width="50%">
    <tr>
        <th>Select</th>
        <th>Compliance issues</th>
    </tr>

<?php

foreach($all_sections as $key=>$sec){
	$sec_id = $sec['sections']['id'];
	if( $sec_id == 3) continue;
	if( !empty($_POST['data'][$sec_id] )) 
		$chk='checked="checked"';
	else $chk='';
	?>
	
	<tr>
        <td><input  <?php echo $chk ?> type="checkbox" name="data[<?php echo $sec_id ?>]"  /></td>
        <td><?php echo $sec['sections']['name'] ?></td>
    </tr>
	<?php
}
?>
</table>
</center>

<input type="submit" value="Go"  />
</form>



<center>
<?php if(!empty($company_ans_list)){ ?>




<div align="left">
Average rating percentage of the enterprises for selected compliance issues <b>
<?php 
	
	if(!empty($_POST['month']) && !empty($_POST['year']))
		//echo $_POST['month']." ".$_POST['year']; 
	{
		foreach( $list_month as $num => $mon) 
		{
			if (($_POST['month'] == $num) )
					echo $mon;
		}	echo ",".$_POST['year']; 
	}
		
		
	else 
		echo "available latest data";
		

?></b>
</div>








<!--to export table start-->
<?php
	
	 $zone=$_POST['zone'];
	 $year=$_POST['year'];
	 $month=$_POST['month'];	
	
	
	 $section=$_POST['data'];
	 
	 $sec="";
	 foreach($section as $key=>$val)
	 {
		$sec.=$key."-";
	 }
	 //echo $sec;
	 
?>
<div align="right">Please 
	<?php echo $this->Html->link('Click', array('controller'=>'cpanels','action' => 'by_compliance_issue_export',
	$zone,$year,$month,$sec));	
	?>
	to export
</div>
<!--to export table end-->





	<table width="80%" id="myTable" class="tablesorter" cellpadding="0" cellspacing="0">
		<thead>
        <tr>
			<th>Name</th>
			<th>Rating(%)</th>
			<th>Survey Date</th>
            <th>Zone</th>
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
            <td><?php echo $val['company']['zone'] ?></td>
			<td><?php echo $this->Html->link('Details', array('controller'=>'cpanels','action' => 'facilitysectionans',$company_id,$date)); ?></td>
		</tr>	
		
		<?php }
		?>
        </tbody>
	</table>
	<?php
}
?>
</center>



</div><!--company end-->


<script type="text/javascript">
$(document).ready(function() 
    { 
        $("#myTable").tablesorter(); 
    } 
); 
</script>
<br />