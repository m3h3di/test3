<?php
echo $javascript->link('jquery.min.js');


//echo "<pre>";
//print_r($company_ans_list);
//echo "</pre>";

?>



<?php
$i = 0;
$date=array();
$percentage=array();
$index=0;
if(!empty($company_ans_list)){
foreach($company_ans_list as $key=>$survey){

    $survey_date = $survey['company_ans_lists']['survey_date'];
    $total_point = floatval($survey[0]['rating']);

    $percent = round($total_point,2) ;
    //$percent_r=round($percent,2);
	if($i == 0){
		
                $survey_date_human_readable=strftime("%b %Y", strtotime($survey_date));
                $date[$index]=$survey_date_human_readable;
                $percentage[$index]=$percent;
                $index++;
	}
	else {
		

                $survey_date_human_readable=strftime("%b %Y", strtotime($survey_date));
                $date[$index]=$survey_date_human_readable;
                $percentage[$index]=$percent;
                $index++;
	}
	$i++;
}
}
?>




<?php

$i = 0;
$date1=array();
$percentage1=array();
$index1=0;
if(!empty($overall_company_ans_list)){
foreach($overall_company_ans_list as $key=>$survey){

	$survey_date = $survey['company_ans_lists']['survey_date'];
    $total_point = floatval($survey[0]['rating']);

    $percent = round($total_point , 2) ;
    //$percent_r=round($percent,2);
	if($i == 0){
		

                $survey_date_human_readable=strftime("%d %b %Y", strtotime($survey_date));
                $date1[$index1]=$survey_date_human_readable;
                $percentage1[$index1]=$percent;
                $index1++;
	}
	else {
		
                 $survey_date_human_readable=strftime("%d %b %Y", strtotime($survey_date));
                $date1[$index1]=$survey_date_human_readable;
                $percentage1[$index1]=$percent;
                $index1++;
	}
	$i++;
}



        //code for calculating max avg min
       // print_r($percentage);
        $min=100000;
        $max=0;
        $avg=0;
        $sum=0;
        $count=0;

        foreach($percentage as $key=>$val)
        {
            if($val<$min)
            {
                $min=$val;
            }

            if($val>$max)
            {
                $max=$val;
            }
            $sum+=$val;
            $count++;
        }
        $avg=$sum/$count;
        //echo "AVG".$avg;
        //echo "Max".$max;
        //echo "Min".$min;
        //echo "Count".$count;
        //end code for calculating max avg min



}
?>



<!--code added by rabi-->

<script type="text/javascript" src="http://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load('visualization', '1', {packages: ['corechart']});
    </script>
    <script type="text/javascript">
      function drawVisualization() {
        // Create and populate the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'x');
          data.addColumn('number', 'Selected');
          data.addColumn('number', 'Overall');


       <?php
       $array_len=count($date);

       for($j=0;$j<$array_len;$j++){
       ?>
         data.addRow(["<?php echo $date[$j];?>", <?php echo $percentage[$j];?>,<?php echo $percentage1[$j];?>]);

        <?php }?>



        // Create and draw the visualization.
        new google.visualization.LineChart(document.getElementById('visualization')).
            draw(data, {curveType: "function",
                        width: 800, height: 600,
                        backgroundColor:'#FBFBFB',
                        colors:['#1E90FF','#004411'],
                        gridlineColor:'#829595',
                        vAxis: {maxValue: 10},
                        pointSize:8}
                );
      }


      google.setOnLoadCallback(drawVisualization);
    </script>
<!--end code added by rabi-->


<style  type="text/css">
 .jqplot-legend{

	width:200px;
	top:180px !important;
 }
</style>

<div class="breadcrumb"><!--breadcrumb start-->
    <div class="welcome_text" style="float:left ; width:400px" ><!--date_combo start-->
		<font size="2">
			<?php echo $this->Html->link('Admin panel', array('controller'=>'cpanels','action'=>'index')); ?> >>
            By Single Enterprise - By Compliance Issues
    	</font>
    </div>

    <div class="clear"></div>
</div>

<br />




<div class="company" style="text-align:left;"><!--company start-->

<h2>By Compliance Issues</h2>

<div class="welcome"><!--breadcrumb start-->

        <div class="welcome_text" style="float:left ; width:400px" ><!--date_combo start-->
        <form action="" method="post" name="section_list" >
        	<font size="1">Please select an Enterprise: </font>
            <select name="company" id="" rel="">
            <?php
            foreach($all_companies as $k=>$zone){
                $val = $zone['companies']['name'];
				$com_id = $zone['companies']['id'];
                $select="";
                if( !empty($_POST) & $_POST['company'] == $com_id )
                    $select = 'selected="selected"';
                else $select='';
                echo '<option '. $select .' value="' .$com_id. '">'.$val.'</option>';
            }
            ?>

            </select>

        </div>
        <div class="date_combo" style="float:right ; width:400px" >
        	 <font size="1"><b>From:</b></font>
             <font size="1">Month:</font>
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

           <font size="1">Year:</font>
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


            </select><br />

            <font size="1"><b>To:</b></font>
            <font size="1">Month:</font>
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

            <font size="1">Year:</font>
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
</div><!--breadcrumb end-->
<br /><br />

<div>


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
<br/><br/>


<center>
<?php
if(!empty($company_ans_list)){ ?>


<div align="left">Average rating percentage of the enterprise for selected compliance issues</div>


<!--to export table start-->
<?php
	
	 /*echo $company=$_POST['company'];
	
	 echo $fyear=$_POST['range']['fyear'];
	 echo $fmonth=$_POST['range']['fmonth'];	
	 
	 echo $tyear=$_POST['range']['tyear'];
	 echo $tmonth=$_POST['range']['tmonth'];	
	
	
	 $section=$_POST['data'];
	 
	 $sec="";
	 foreach($section as $key=>$val)
	 {
		$sec.=$key."-";
	 }
	 echo $sec;*/
	 
?>
<!--<div align="right">Please 
	<?php //echo $this->Html->link('Click', array('controller'=>'cpanels','action' => 'sing_ent_com_issue_export',
	//$company,$fyear,$fmonth,$tyear,$tmonth,$sec));	
	?>
	to export
</div>-->
<!--to export table end-->







	<table width="80%" id="myTable" class="tablesorter" cellpadding="0" cellspacing="0">
		<thead>
        <tr>
			<th>Survey Date</th>
			<th>Compliance Percentage</th>
            
            <th>Surveyor</th>
            
			<th>Survey Details</th>
		</tr>
		</thead>
        <tbody>
		<?php
		foreach($company_ans_list as $key=>$val){
			$company_id= $val["company_ans_lists"]["company_id"];
			$date = $val['company_ans_lists']['survey_date'];
			$rating =$val[0]['rating'];
			$rating = round($rating,2);
			?>
		<tr>

			<td><?php echo strftime("%B,%Y", strtotime($date)); ?></td>
            <td><?php echo $rating ?>%</td>
            
             <td><?php echo $val['users']['user_name']; ?></td>
            
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

</div>
<br /><br />
<?php if(!empty($company_ans_list)){?>
<fieldset><legend>Compliance Percentage</legend>
<div style="padding: 20px">

    Maximum : <?php echo $max; ?>% &nbsp;&nbsp;&nbsp;Minimum : <?php echo $min; ?>%&nbsp;&nbsp;&nbsp;Average : <?php echo round($avg,2);?>%

</div>
 </fieldset>
<?php } ?>
<!--<div id="chart1" style=" width:586px; height:343px;">  </div>-->
  <div id="visualization" style="width: 800px; height: 600px;"></div>
<br />






</div><!--company end-->



