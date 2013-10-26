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
foreach($res_criteria as $key=>$survey){
	
	$survey_date = $survey['company_info_archives']['survey_date'];
      
    $percent = floatval($survey['company_info_archives']['cr']);
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


plot1 = $.jqplot('chart1', [line2], {
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
		//renderer: $.jqplot.LogAxisRenderer, 
		//tickOptions:{angle:-40},
    }
	
  }
});

  });
</script>




<h2>Single Facility Analysis (By Criteria)</h2>
<br/>
<div>



<form action="" method="post" name="section_list" >
<div class="welcome"><!--welcome start-->
	<div class="welcome_top"><!--welcome_top start--> </div><!--welcome_top end-->
    
    <div class="welcome_body"><!--welcome_body start--> 
    	<div class="welcome_text" style="float:left ; width:400px" ><!--date_combo start-->
		<b><?php echo $all_companies[0]['companies']['name']; ?></b>
        </div>
        <div class="welcome_text" style="float:right ; width:400px" >
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


	<input name="company" type="hidden" value="<?php echo $all_companies[0]['companies']['id']; ?>"  />

<center>
<table width="30%">
    <tr>
        <th width="10%">Select</th>
        <th>Criteria</th>
    </tr>

<?php
$all_criteria = array('actual_investment', 'actual_employee','actual_expatriate','male','female');
foreach($all_criteria as $key=>$sec){
	if( !empty($_POST['criteria']) ){
		if($_POST['criteria'] == $sec)	$chk = ' checked="checked" ' ;
		else $chk = '' ;
			
	}
	else $chk = '' ;
	
	?>
	<tr>
        <td><input <?php echo $chk; ?>  type="radio" name="criteria" value="<?php echo $sec ?>" /></td>
        <td><?php echo $sec ?></td>
    </tr>
<?php }
?>
</table>
</center>

<input type="submit" value="Go"  />
</form>



<center>
<?php
if(!empty($res_criteria)){
	?>
	<table width="80%" id="myTable" class="tablesorter" >
		<thead>
        <tr>
			<th>Survey Date</th>
			<th><?php echo $_POST['criteria'] ?></th>
			
		</tr>
		</thead>
        <tbody>
		<?php
		foreach($res_criteria as $key=>$survey){
			
			//$date = $val['company_ans_lists']['survey_date'];
			$rating =floatval($survey['company_info_archives']['cr']);
			$rating = round($rating,2);
			
			$date = $survey['company_info_archives']['survey_date'];
			?>
		<tr>
			
			<td><?php echo strftime("%B,%Y", strtotime($date)); ?></td>
            <td><?php echo $rating ?></td>
			
		
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