<?php  echo $javascript->link('jquery.min.js'); ?>
<?php  echo $javascript->link('jquery.tablesorter.min.js'); ?>

<?php
//echo '<pre style="text-align:left">';
//print_r($company_ans_list);
//echo '</pre>';

$list_month = array('01'=>'January','02'=>'February','03'=>'March','04'=>'April','05'=>'May','06'=>'June','07'=>'July','08'=>'August','09'=>'September','10'=>'October','11'=>'November','12'=>'December');

?>


<div class="breadcrumb"><!--breadcrumb start-->
    <div class="welcome_text">
		<font size="2">
			<?php echo $this->Html->link('Admin panel', array('controller'=>'cpanels','action'=>'index')); ?> >>
            Sign off
    	</font>          
    </div>   
    
    <div class="clear"></div>    
</div>

<br />





<div class="welcome_text">
	<h2>Not yet Signed Off <?php if(!empty($ezone)) echo "of $ezone"; ?></h2>
</div>



<div class="date_combo" ><!--date_combo start-->
        <form action="" method="post">
            <font size="2">Month</font>
        	<select name="month" >
            <option value="0">Select</option>
            	<opt
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
            
            <font size="2">Year</font>
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
        	<input type="submit" name="go" id="go" onclick="" value="Go" />
		</form>
 </div><!--date_combo end -->
   






<?php echo $form->create('cpanel', array('action' => 'process','name'=>'test')); // crating form ?>

<center>
<table width="80%" id="myTable" class="tablesorter" >
	<thead>
	<tr>
    	<th id="sa" >Select All</th>
    	<th>Zone</th>
    	<th>Name</th>
        <th  title="Compliance percentage">Compliance Percentage(%)</th>
        <th>Survey Date</th>
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
    	<td><input checked="checked" type="checkbox" name="so[<?php echo $company_id; ?>]" value="<?php echo $date; ?>"  /></td>
        
    	<td><?php echo $val['company']['zone'] ?></td>
        <td><?php echo $this->Html->link($name, array('controller'=>'cpanels','action' => 'facilitystatus',$val["RESULT"]["company_id"]))	?></td>
        <td><?php echo round($val['RESULT']['rating'],2) ?>%</td>
        <td><?php echo strftime("%B,%Y", strtotime($date)) ?></td>
        <td><?php echo $this->Html->link('Details', array('controller'=>'cpanels','action' => 'facilityans',$company_id,$date)); ?></td>
    </tr>	
	
	<?php }
	?>
    </tbody>
</table>
</center>

<input type="submit" value="Sign Off"  />

</div>
<script type="text/javascript">
$(document).ready(function() 
    { 
        $("#myTable").tablesorter(); 
    } 
); 
</script>