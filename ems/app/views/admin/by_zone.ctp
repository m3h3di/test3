<?php  
echo $javascript->link('jquery.min.js');
echo $javascript->link('jquery.tablesorter.min.js'); 


//echo '<pre style="text-align:left">';
//print_r($company_ans_list_by_com_issues);
//echo '</pre>';

$all_rate = " ";
$rate=array();
$j=20;
for($i = 0; $i<=7;$i++){
	if(isset($company_ans_list[$i])) {$all_rate.=	round($company_ans_list[$i][0]['rating'],2). ", ";
        $rate[$i]=round($company_ans_list[$i][0]['rating'],2);

        }
	else {$all_rate.=	"0, ";
        
        $rate[$i]=$j;
        $j+=5;
        }
}


$zone=array('DEPZ', 'ComEPZ', 'ChitEPZ', 'MongEPZ','IshwEPZ', 'KarnaEPZ', 'UttaraEPZ', 'AdamEPZ');
echo "<pre>";
//print_r($rate);
echo "</pre>";
?>

<style type="text/css" media="screen">
	table.jqplot-legend {
		visibility:hidden;
}
  </style>

<!--code added by rabi-->
<script type="text/javascript" src="http://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load('visualization', '1', {packages: ['corechart']});
    </script>
    <script type="text/javascript">
      function drawVisualization() {
        // Create and populate the data table.
        var data = new google.visualization.DataTable();

       var raw_data = [['<?php echo $zone['0'];?>', <?php echo $rate['0'];?>],
                        ['<?php echo $zone['1'];?>', <?php echo $rate['1'];?>],
                        ['<?php echo $zone['2'];?>', <?php echo $rate['2'];?>],
                        ['<?php echo $zone['3'];?>', <?php echo $rate['3'];?>],
                        ['<?php echo $zone['4'];?>', <?php echo $rate['4'];?>],
                        ['<?php echo $zone['5'];?>', <?php echo $rate['5'];?>],
                        ['<?php echo $zone['6'];?>', <?php echo $rate['6'];?>],
                        ['<?php echo $zone['7'];?>', <?php echo $rate['7'];?>]];

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
                 {title:"OverAll Zone Compliance Percentage",
                 colors:['#7b58a4','#88ab40','#c33d3a','#366cad','#dc3912','#ff9900','#b1639f','#d8d4a3'],
                  
                  hAxis: {title: ""}}
            );
      }


      google.setOnLoadCallback(drawVisualization);
    </script>
<!--end edited by rabi-->


<!--colors:['#31c6a4','#007f50','#143900','#458c20','#8cbf3f','#759fb2','#3054e6','#049dd9']-->


<div class="company" style="text-align:left;"><!--company start-->
<h2>By Zone Analysis</h2>
<br/>



<center>

<div align="left"><h2>Compliance percentage for all compliance issues</h2></div>

<div class="excellExport" style="padding:0 40px 10px 0;text-align:right">
<a href="" onclick="javascript:x()">Excel Export</a>
</div>

<div class="targetTable">
<table width="80%" id="myTable" class="tablesorter" cellpadding="0" cellspacing="0" >
	<thead>
	<tr>
    	<th>Zone</th>
        <th>Compliance percentage</th>
        
    </tr>
    </thead>
    <tbody>
	<?php
	foreach($company_ans_list as $key=>$val){
		$ezone = $val['company']['zone'];
		$company_id= 0;
		$date = 0;
		?>
	<tr>
    	<td><?php echo $val['company']['zone'] ?></td>
        <td><?php echo round($val[0]['rating'],2) ?>%</td>
       
       
        
    </tr>	
	
	<?php }
	?>
    </tbody>
</table>
</div>
</center>
<br /><br />

<!--<div id="chart2" style="margin-top:20px; margin-left:20px; width:800px; height:400px;"></div>-->

<div id="visualization" style="width: 800px; height: 500px;"></div>


<script type="text/javascript">
$(document).ready(function() 
    { 
        $("#myTable").tablesorter(); 
		$("#myTable1").tablesorter(); 
    } 
); 
</script>







<br /><br /><br /><br />


<h2>Zone Analysis by compliance issues</h2>

<center>
<form action="" method="post" name="section_list" >
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

<br />

<center>

<?php if(!empty($company_ans_list_by_com_issues)){ ?>
<div align="left"><h2>Compliance percentage for selected compliance issues</h2></div>





<table width="80%" id="myTable1" class="tablesorter" cellpadding="0" cellspacing="0" >
	<thead>
	<tr>
    	<th>Zone</th>
        <th>Compliance percentage</th>
        <th>Details</th>
    </tr>
    </thead>
    <tbody>
	<?php
	foreach($company_ans_list_by_com_issues as $key=>$val){
		$ezone = $val['company']['zone'];
		$company_id= 0;
		$date = 0;
		?>
	<tr>
    	<td><?php echo $val['company']['zone'] ?></td>
        <td><?php echo round($val[0]['rating'],2) ?>%</td>
       
       
        <td><?php echo $this->Html->link('Details', array('controller'=>'cpanels','action' => 'admin_byzone_details',$ezone)); ?></td>
    </tr>	
	
	<?php } ?>
	
    </tbody>
	
</table>

<?php } ?>

</center>



<br />

</div><!--company end-->
