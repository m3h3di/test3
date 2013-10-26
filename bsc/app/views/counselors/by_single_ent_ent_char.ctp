<?php  echo $javascript->link('jquery.min.js'); ?>

<?php
//echo '<pre style="text-align:left">';
//print_r($all_sections);
//print_r($company_ans_list);
//print_r($_POST);
//print($criteria);
if(isset($max)) $max = intval($max[0][0]['max']);
else $max=100;
if(isset($min)) $min = intval($min[0][0]['min']);
else $min = 0;


//print_r($max);
//echo '</pre>';

$list_month = array('01'=>'January','02'=>'February','03'=>'March','04'=>'April','05'=>'May','06'=>'June','07'=>'July','08'=>'August','09'=>'September','10'=>'October','11'=>'November','12'=>'December');
?>



<?php
$i = 0;
$date=array();
$percentage=array();
$index=0;
if(!empty($res_criteria)){
foreach($res_criteria as $key=>$survey){

	$survey_date = $survey['company_info_archives']['survey_date'];

    $percent = floatval($survey['company_info_archives']['cr']);
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






if(!empty($_POST['criteria']))
{
	if($criteria=='male')
	{
		$criteria_modified='number of male workers';
	}else if($criteria=='female')
	{
		 $criteria_modified='number of female workers';
	}else if($criteria=='actual_investment')
	{
	 $criteria_modified='Actual Investment';
	}else if($criteria=='actual_employee')
	{
	  $criteria_modified='Actual Employee';
	}else if($criteria=='actual_expatriate')
	{
	 $criteria_modified='Actual Expatriate';
	}
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
          data.addColumn('number', '<?php echo $criteria_modified;?>');



       <?php
       $array_len=count($date);

       for($j=0;$j<$array_len;$j++){
       ?>
         data.addRow(["<?php echo $date[$j];?>",<?php echo $percentage[$j];?>]);

        <?php }?>



        // Create and draw the visualization.
        new google.visualization.LineChart(document.getElementById('visualization')).
            draw(data, {curveType: "function",
                        width: 830, height: 600,
                        backgroundColor:'#FBFBFB',
                        colors:['#1E90FF','#004411'],
                        gridlineColor:'#829595',
                        vAxis:{title: 'Number', titleTextStyle: {color: '#000000'}},
                        pointSize:8
                    
                   }
                );
      }


      google.setOnLoadCallback(drawVisualization);
    </script>
<!--end code added by rabi-->


<div class="breadcrumb"><!--breadcrumb start-->
    <div class="welcome_text"><!--date_combo start-->
		<font size="2">
			<?php echo $this->Html->link('Home', array('controller'=>'counselors','action'=>'home')); ?> >>
            <?php echo $this->Html->link('Enterprise Analysis', array('controller'=>'counselors','action'=>'enterprise_analysis')); ?> >><br />
            By Single Enterprise - By Enterprise Characteristics
    	</font>          
    </div>   
    
    <div class="clear"></div>    
</div>

<br />




<div class="company" style="text-align:left;"><!--company start-->

<h2>By Enterprise Characteristics</h2>
<br/>
<div>



<div class="welcome"><!--welcome start-->
    	
        <div class="welcome_text"><!--date_combo start-->
       <form action="" method="post" name="section_list" >
        	Please select an Enterprise: 
            <select name="company" id="" rel="">
            <?php 
            foreach($all_companies as $k=>$zone){
                $val = $zone['companies']['id'];
				$display_val = $zone['companies']['name'];
				//$com_id = $zone['companies']['id'];
                $select="";
                if( !empty($_POST) & $_POST['company'] == $val ) 
                    $select = 'selected="selected"';
                else $select='';
                echo '<option '. $select .' value="' .$val. '">'.$display_val.'</option>';
            }
            ?>
        
            </select>
        </div>
		
        <div class="date_combo">
        	 <font size="2">From:</font>
             
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
            
            <font size="2">To:</font>
            
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
</div><!--welcome end-->
<br /><br />



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
	<table width="80%" id="myTable" class="tablesorter" cellpadding="0" cellspacing="0">
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
<!--<div id="chart1" style=" width:586px; height:343px;">  </div>-->
<div id="visualization" style="width: 800px; height: 600px;"></div>
<br />




</div><!--company end-->




