<?php  echo $javascript->link('jquery.min.js'); ?>
<?php  echo $javascript->link('jquery.tablesorter.min.js'); ?>

<!--code edited by rabi-->

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
                  chartArea:{top:100,width:"50%",height:"75%"},
				  colors:['#7b58a4','#88ab40','#c33d3a','#366cad','#dc3912','#ff9900','#b1639f','#d8d4a3'],
                  hAxis: {title: ""}}
            );
      }


      google.setOnLoadCallback(drawVisualization);
    </script>
<!--end edited by rabi-->
<?php
//echo '<pre style="text-align:left">';
//print_r($company_ans_list);
//echo '</pre>';

?>

<div class="breadcrumb"><!--breadcrumb start-->
    <div class="welcome_text"><!--date_combo start-->
		<font size="2">
			<?php echo $this->Html->link('Home', array('controller'=>'counselors','action'=>'home')); ?> >>
            <?php echo $this->Html->link('Enterprise Analysis', array('controller'=>'counselors','action'=>'enterprise_analysis')); ?> >>
            By Multiple Enterprise - By Enterprise
    	</font>          
    </div>   
    
    <div class="clear"></div>    
</div>

<br />




<div class="company" style="text-align:left;"><!--company start-->

<h2>All Enterprises <?php if(!empty($ezone)) echo "of $ezone"; ?></h2>
<br/>


<?php
/*echo $this->Html->link('Company X', array('controller'=>'cpanels','action' => 'facilitystatus',1)) . "<br/><br/>";
echo $this->Html->link('Company Y', array('controller'=>'cpanels','action' => 'facilitystatus',2)) . "<br/><br/>";
*/
?>


<div id="visualization" style="width: 1000px; height: 515px;"></div>




<br/><br/>
<center>
<table width="80%" id="myTable" class="tablesorter" cellpadding="0" cellspacing="0" >
	<thead>
	<tr>
    	<th>Name</th>
        <th title="Compliance percentage">CP(%)</th>
        <th>Last Survey</th>
        <th>Country</th>
        <th>Zone</th>
        <th>Group</th>
        <th title="Type of investment">Type</th>
        <th title="Proposed Investment">PI</th>
        <th title="Actual Investment">AI</th>
        <th title="Proposed Employee">PE</th>
        <th title="Actual Employee">AE</th>
        <th >Male</th>
        <th >Female</th>
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
    	<td><?php echo $this->Html->link($name, array('controller'=>'counselors','action' => 'mul_ent_by_ent_enterprise_info',$val["RESULT"]["company_id"]))	?></td>
        <td><?php echo round($val[0]['rating'],2) ?>%</td>
        <td><?php echo strftime("%B,%Y", strtotime($date)) ?></td>
        <td><?php echo $val['company']['country'] ?></td>
        <td><?php echo $val['company']['zone'] ?></td>
        <td><?php echo $val['company']['group_no'] ?></td>
        <td><?php echo $val['company']['type_of_investment'] ?></td>
        <td><?php echo $val['company']['proposed_investment'] ?></td>
        <td><?php echo $val['company']['actual_investment'] ?></td>
        <td><?php echo $val['company']['proposed_employee'] ?></td>
        <td><?php echo $val['company']['actual_employee'] ?></td>
        <td><?php echo $val['company']['male'] ?></td>
        <td><?php echo $val['company']['female'] ?></td>
        <td><?php echo $this->Html->link('Details', array('controller'=>'counselors','action' => 'mul_ent_by_ent_enterprise_ans',$company_id,$date)); ?></td>
    </tr>	
	
	<?php } ?>
	
    </tbody>
</table>




<br />



<table class="survey_table2">	
	<tr>
    	<td>CP (%) </td>
        <td>Compliance percentage</td>
    </tr>	
    
    <tr>
    	<td>Type</td>
        <td>Type of investment</td>
    </tr>
    
    <tr>
    	<td>PI</td>
        <td>Proposed Investment</td>
    </tr>
    
    <tr>
    	<td>AI</td>
        <td>Actual Investment</td>
    </tr>
    
    <tr>
    	<td>PE</td>
        <td>Proposed Employee</td>
    </tr>
    
    <tr>
    	<td>AE</td>
        <td>Actual Employee</td>
    </tr>
   	
</table>



</center>

</div>
<script type="text/javascript">
$(document).ready(function() 
    { 
        $("#myTable").tablesorter(); 
    } 
); 
</script>







             
