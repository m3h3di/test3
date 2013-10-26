<?php  echo $javascript->link('jquery.min.js'); ?>
<?php  echo $javascript->link('jquery.jqplot.min.js'); ?>
<?php  echo $javascript->link('jqplot.canvasTextRenderer.min.js'); ?>
<?php  echo $javascript->link('jqplot.canvasAxisTickRenderer.min.js'); ?>
<?php  echo $javascript->link('jqplot.dateAxisRenderer.min.js'); ?>
<?php
//echo '<pre style="text-align:left">';
//print_r($all_sections);
//print_r($company_ans_list);
//print_r($_POST);
//print_r($res_criteria);
if(isset($max)) $max = intval($max[0][0]['max']);
else $max=100;
if(isset($min)) $min = intval($min[0][0]['min']);
else $min = 0;


//print_r($max);
//echo '</pre>';

$list_month = array('01'=>'January','02'=>'February','03'=>'March','04'=>'April','05'=>'May','06'=>'June','07'=>'July','08'=>'August','09'=>'September','10'=>'October','11'=>'November','12'=>'December');
?>


<script type="text/javascript" language="javascript">
$(document).ready(function(){


line1 = [['1/1/2006', 5], ['2/1/2006', 1], ['3/1/2006', 3], ['4/1/2006', 8], ['5/1/2006', 12], ['6/1/2006', 13], ['7/1/2006', 5.9],['8/1/2006', 8], ['9/1/2006', 12], ['10/1/2006', 13], ['11/1/2006', 5.9]];

<?php  
$line = "[";
$tricks ="[";
$i = 0;
foreach($gr as $key=>$v){
	
	$survey_date = $v['gr_ans_lists']['survey_date'];
      
    $percent = floatval($v[0]['found']);
    //$percent_r=round($percent,2);
	if($i == 0){
		$line.= "['".$survey_date."',". $percent ."]";
		$tricks.= "'".$survey_date."' ";
	}
	else {
		$line.= ", ['".$survey_date."',". $percent ."]";
		$tricks.= " ,'".$survey_date."'";
	}
	$i++;
}
$line.="]";
$tricks.="]";
?>
line2 = <?php echo $line ?>;

<?php  
$line = "[";
$tricks ="[";
$i = 0;
foreach($gr as $key=>$v){
	
	$survey_date = $v['gr_ans_lists']['survey_date'];
      
    $percent = floatval($v[0]['solved']);
    //$percent_r=round($percent,2);
	if($i == 0){
		$line.= "['".$survey_date."',". $percent ."]";
		$tricks.= "'".$survey_date."' ";
	}
	else {
		$line.= ", ['".$survey_date."',". $percent ."]";
		$tricks.= " ,'".$survey_date."'";
	}
	$i++;
}
$line.="]";
$tricks.="]";
?>

line1 = <?php echo $line ?>;

plot1 = $.jqplot('chart1', [line2,line1], {
  legend: {show:false, location: 'nw', yoffset: 6},
  axes:{
     xaxis:{
      renderer:$.jqplot.DateAxisRenderer, min:'August 1, 2010', tickInterval: "1 months",
	  rendererOptions:{tickRenderer:$.jqplot.CanvasAxisTickRenderer},
      tickOptions:{formatString:'%b,%Y', fontSize:'10pt', fontFamily:'Tahoma', angle:-40, fontWeight:'normal', fontStretch:1}, 
      //ticks:['12/1/2005', '1/1/2006', '2/1/2006', '3/1/2006', '4/1/2006', '5/1/2006', '6/1/2006', '7/1/2006', '8/1/2006', '9/1/2006', '10/1/2006']
	  ticks:<?php echo $tricks ?>
    },
	yaxis:{
		min:0, max:20, numberTicks:6
    }
	
  }
});

  });
</script>




<h2>Grievances</h2>
<br/>
<div>




<div class="welcome"><!--welcome start-->
	<div class="welcome_top"><!--welcome_top start--> </div><!--welcome_top end-->
    
    <div class="welcome_body"><!--welcome_body start--> 
    	      
       <div class="welcome_text" style="float:none ; width:500px" >
        <form action="" method="post" name="section_list" >
        	 From:
            <select name="range[fmonth]">
            <option value="0">Select</option>
            	
            	<?php
				
				//print_r($list_month);
				foreach( $list_month as $num => $mon) {
					//$num = intval($num)+1;
					if (!empty($_POST['range']['fmonth']) & ($_POST['range']['fmonth'] == $num) )
						$chk = ' selected="selected" ';
					else $chk ='';
					
					echo '<option ' . $chk . ' value="'. $num .'" >' .$mon. '</option>';
				}
				?>
            </select>
            
            <select name="range[fyear]">
            	<option value="0">Select</option>
				<?php
                	for($num=2008;$num<=2015;$num++ ){
						if (!empty($_POST['range']['fyear']) & ($_POST['range']['fyear'] == $num) )
						$chk = ' selected="selected" ';
					else $chk ='';
					
					echo '<option ' . $chk . ' value="'. $num .'" >' .$num. '</option>';
					}
				?>
            	
                
            </select>
            To:
            <select name="range[tmonth]">
            <option value="0">Select</option>
            	
            	<?php
				
				//print_r($list_month);
				foreach( $list_month as $num => $mon) {
					//$num = intval($num)+1;
					if (!empty($_POST['range']['tmonth']) & ($_POST['range']['tmonth'] == $num) )
						$chk = ' selected="selected" ';
					else $chk ='';
					
					echo '<option ' . $chk . ' value="'. $num .'" >' .$mon. '</option>';
				}
				?>
            </select>
            
            <select name="range[tyear]">
            	<option value="0">Select</option>
				<?php
                	for($num=2008;$num<=2015;$num++ ){
						if (!empty($_POST['range']['tyear']) & ($_POST['range']['tyear'] == $num) )
						$chk = ' selected="selected" ';
					else $chk ='';
					
					echo '<option ' . $chk . ' value="'. $num .'" >' .$num. '</option>';
					}
				?>                
            </select>
            
        </div>
     	<div class="clear"></div>   
    </div><!--welcome_body end-->
    <div class="welcome_bottom"><!--welcome_bottom start--> </div><!--welcome_bottom end-->
</div><!--welcome end-->
<br /><br />



<input type="submit" value="Go"  />
</form>



<center>
<?php
if(!empty($gr)){
	?>
	<table width="80%" id="myTable" class="tablesorter" >
		<thead>
        <tr>
			<th>Survey Date</th>
			<th>Grievance (Found)</th>
            <th>Grievance (Solved)</th>
			<th>Details</th>
		</tr>
		</thead>
        <tbody>
		<?php
		foreach($gr as $key=>$v){
			$company_id= $v['gr_ans_lists']["company_id"];
			$date = $v['gr_ans_lists']['survey_date'];
			$rating =$v[0]['found'];
			$rating1 =$v[0]['solved'];
			$rating = round($rating,2);
			?>
		<tr>
			
			<td><?php echo strftime("%B,%Y", strtotime($date)); ?></td>
            <td><?php echo $rating ?></td>
            <td><?php echo $rating1 ?></td>
			<td><?php echo $this->Html->link('Details', array('action' => 'grievancedetails',$company_id,$date)); ?></td>
		</tr>	
		
		<?php }
		?>
        </tbody>
	</table>
	<?php
}
?>
</center>

</div>
<br/><br/><br/>
<div id="chart1" style=" width:586px; height:343px;">  </div>
<br />