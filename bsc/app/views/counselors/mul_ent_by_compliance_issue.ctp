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
    <div class="welcome_text"><!--date_combo start-->
		<font size="2">
			<?php echo $this->Html->link('Home', array('controller'=>'counselors','action'=>'home')); ?> >>
            <?php echo $this->Html->link('Enterprise Analysis', array('controller'=>'counselors','action'=>'enterprise_analysis')); ?> >>
            By Multiple Enterprise - By Compliance Issues
    	</font>          
    </div>   
    
    <div class="clear"></div>    
</div>

<br />


<div class="company" style="text-align:left">

<div class="welcome"><!--welcome start-->
    
        <div class="welcome_text"><!--date_combo start-->
       <form action="" method="post" name="section_list" >
        	<!--<font size="1">Zone: </font>
            <select name="zone" id="" rel="">
            <option value="0" >Please select a zone</option>
            <?php 
            /*foreach($all_zone as $k=>$zone){
                $val = $zone['companies']['zone'];
                $select="";
                if( !empty($_POST) & $_POST['zone'] == $val ) 
                    $select = 'selected="selected"';
                else $select='';
                echo '<option '. $select .' value="' .$val. '">'.$val.'</option>';
            }*/
            ?>
        
            </select>-->
            
            
            
            <font size="1">Month: </font>
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


<br /><br />
<h2>By Compliance Issues</h2>
<br/>


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
			<td>
			<?php echo $this->Html->link($name, array('controller'=>'counselors','action' => 'mul_ent_by_ent_enterprise_info',$val["RESULT"]["company_id"]))	?></td>
			
            <td><?php echo round($val[0]['rating'],2) ?>%</td>
			<td><?php echo strftime("%B,%Y", strtotime($date)) ?></td>
            <td><?php echo $val['company']['zone'] ?></td>
			<td><?php echo $this->Html->link('Details', array('controller'=>'counselors','action' => 'mul_ent_by_ent_enterprise_ans',$company_id,$date)); ?></td>
		</tr>	
		
		<?php }
		?>
        </tbody>
	</table>
	<?php
}
?>



</center>

<center> <!--   code for map generation-->
<?php if(!empty($company_ans_list)){ ?>
<?php

               // code for generating map//
              $var_raw='[';
              $company_count=count($company_ans_list)-1;
              $var_bottom='[';
              $index=0;

              foreach($company_ans_list as $key=>$val){
                 $val_company_name=$val['company']['name'];
                 $val_percentage=round($val[0]['rating'],2);
                 $var_raw.='['."'".$val_company_name."'".',';


                 if($index==$company_count) {
                      $var_raw.=$val_percentage.']';
                      $var_bottom.="'"."'";
                  }else{
                       $var_raw.=$val_percentage.']'.',';
                       $var_bottom.="'"."'".',';
                  }

                  $index++;

              }

             $var_raw.=']';
             $var_bottom.=']';
             
              //echo "<pre style='text-align:left'>";
              //print_r($var_bottom);
            //  echo "</pre>";
              
		?>

<script type="text/javascript" src="http://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load('visualization', '1', {packages: ['corechart']});
    </script>
    <script type="text/javascript">
      function drawVisualization() {
        // Create and populate the data table.
        var data = new google.visualization.DataTable();

        var raw_data = <?php echo $var_raw;?>;
        
        var years = [''];

        data.addColumn('string', 'Year');
        for (var i = 0; i  < raw_data.length; ++i) {
          data.addColumn('number', raw_data[i][0]);
        }

        data.addRows(years.length);

        for (var j = 0; j < years.length; ++j) {
          data.setValue(j, 0, years[j].toString());
        }
        for (var i = 0; i  < raw_data.length; ++i) {
          for (var j = 1; j  < raw_data[i].length; ++j) {
            data.setValue(j-1, i+1, raw_data[i][j]);
          }
        }

        // Create and draw the visualization.
        new google.visualization.ColumnChart(document.getElementById('visualization')).
            draw(data,
                 {title:"Compliance percentage for different enterprise(s)",
                  width:920, height:500,
                  backgroundColor:'#F9F9F9',
                  chartArea:{left:60,top:100,width:"60%",height:"75%"},
                  /*colors:['red','#004411','#480000','#606060','#009966','#20B2AA','#40E0D0','#E80000'],*/
				  /*colors:['#31c6a4','#007f50','#143900','#458c20','#8cbf3f','#759fb2','#3054e6','#049dd9'],*/
				  colors:['#7b58a4','#88ab40','#c33d3a','#366cad','#dc3912','#ff9900','#b1639f','#d8d4a3'],
                  hAxis: {title: ""}}
            );
      }


      google.setOnLoadCallback(drawVisualization);
    </script>
<!--end edited by rabi-->


<?php } ?>
</center>

<div id="visualization" style="width: 1000px; height: 400px;"></div>

</div><!--company end-->
<script type="text/javascript">
$(document).ready(function() 
    { 
        $("#myTable").tablesorter(); 
    } 
); 
</script>
<br />