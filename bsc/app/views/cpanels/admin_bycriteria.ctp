<?php  echo $javascript->link('jquery.min.js'); ?>
<?php  echo $javascript->link('jquery.tablesorter.min.js'); ?>

<?php
//echo '<pre style="text-align:left">';
//print_r($company_ans_list);
//print_r($all_zone);
//print_r($all_country);
//print_r($_POST);
//print_r($all_product);
//echo '</pre>';

?>

<div class="breadcrumb"><!--breadcrumb start-->
    <div class="welcome_text">
		<font size="2">
			<?php echo $this->Html->link('Admin panel', array('controller'=>'cpanels','action'=>'index')); ?> >>
            By Multiple Enterprise - By Enterprise Characteristics
    	</font>          
    </div>   
    
    <div class="clear"></div>    
</div>

<br />



<div class="company" style="text-align:left;"><!--company start-->

<h2>By Enterprise Characteristics</h2>
<br/>


<style>
ul.filterboxes li {
float:left;
padding-right:1em;
width:29%;
color:#333333;
font-size:12px;
line-height:1.5;
padding-bottom:6px;
margin:0 2px;
}

</style>



<form action="" method="post" >
<div class="welcome">
	
    <font size="2">By Zone:</font>
	<font size="1">
	<select name="data[zone]" id="" rel="">
    <option value="0" >All zones</option>
	<?php 
	foreach($all_zone as $k=>$zone){
		$val = $zone['companies']['zone'];
		$select="";
		if( !empty($_POST) & $_POST['data']['zone'] == $val ) 
			$select = 'selected="selected"';
		else $select='';
		echo '<option '. $select .' value="' .$val. '">'.$val.'</option>';
	}
	?>

	</select>   </font>  
	
	
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	
    <font size="2">By Product Category:</font>
	<!--<select name="data[product]" id="" rel="">-->
    
	<font size="1">
    <select name="data[product_category]" id="" rel="">
    <option value="0">All product categories</option>
	<?php 
	/*foreach($all_product as $k=>$zone){
		$val = $zone['companies']['product'];
		if( !empty($_POST) & $_POST['data']['product'] == $val ) 
			$select = 'selected="selected"';
		else $select='';
		echo '<option '. $select .' value="' .$val. '">'.$val.'</option>';
	}*/
	
	foreach($all_product as $k=>$zone){
		$val = $zone['product_categories']['id'];
		$product_category_name = $zone['product_categories']['name'];
		
		if( !empty($_POST) & $_POST['data']['product_category'] == $val ) 
			$select = 'selected="selected"';
		else $select='';
		echo '<option '. $select .' value="' .$val. '">'.$product_category_name.'</option>';
	}
	?>

	</select></font>
	
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

	<input type="submit" value="go"  />
</form>
</div>

<br/>




<center>

<!--to export table start-->
<?php
	 //echo $zone=$_POST['data']['zone'];
	 //echo $product=$_POST['data']['product_category'];
	 
	 
	 if( !empty($_POST['data']['product_category']) && !empty($_POST['data']['zone'])) 
	 {	
		 $product=$_POST['data']['product_category'];
		 $zone=$_POST['data']['zone'];
	 }
	 else 
	 {
		 $product= NULL;
		 $zone= NULL;
	 }
	 
	 
?>
<div align="right">Please 
	<?php echo $this->Html->link('Click', array('controller'=>'cpanels','action' => 'ent_char_export',$zone,$product));	?>
	to export
</div>
<!--to export table end-->




<table width="80%" id="myTable" class="tablesorter" cellpadding="0" cellspacing="0">
	<thead>
	<tr>
    	<th>SN</th>
    	<th>Name</th>
        <th>Rating(%)</th>
        <th>Last Survey</th>
        <th>Country</th>
        <th>Zone</th>
        <!--<th>Product category</th>-->
        <th>Details</th>
    </tr>
    </thead>
    <tbody>
	<?php
	$rank =0;
        $pie_titles=array('Rating 91-100 %','Rating 81-90 %','Rating 71-80 %','Rating 61-70 %','Rating 51-60 %','Rating 41-50 %','Rating 31-40 %','Rating 21-30 %','Rating 11-20 %','Rating 0-10 %');
        $data_91_100=0;
        $data_81_90=0;
        $data_71_80=0;
        $data_61_70=0;
        $data_51_60=0;
        $data_41_50=0;
        $data_31_40=0;
        $data_21_30=0;
        $data_11_20=0;
        $data_0_10=0;


	foreach($company_ans_list as $key=>$val){
		$rank++;
		$name = $val['company']['name'];
		$company_id= $val["RESULT"]["company_id"];
		$date = $val['RESULT']['survey_date'];

                // code for generating piechart data
                $rat=round($val[0]['rating'],2);
                if($rat > 90 && $rat <=100 )
                {$data_91_100++;}else if($rat > 80 && $rat <=90)
                {$data_81_90++;}else if($rat > 70 && $rat <=80)
                {$data_71_80++;}else if($rat > 60 && $rat <=70)
                {$data_61_70++;}else if($rat > 50 && $rat <=60)
                {$data_51_60++;}else if($rat > 40 && $rat <=50)
                {$data_41_50++;}else if($rat > 30 && $rat <=40)
                {$data_31_40++;}else if($rat > 20 && $rat <=30)
                {$data_21_30++;}else if($rat > 11 && $rat <=20)
                {$data_11_20++;}else{$data_0_10++;}
                 


                // end code for generating piechart data



		?>
	<tr>
    	<td><?php echo  $rank ?></td>
    	<td><?php echo $this->Html->link($name, array('controller'=>'cpanels','action' => 'facilitystatus',$val["RESULT"]["company_id"]))	?></td>
        <td><?php echo round($val[0]['rating'],2) ?></td>
        <td><?php echo strftime("%B,%Y", strtotime($date)) ?></td>
        <td><?php echo $val['company']['country'] ?></td>
        <td><?php echo $val['company']['zone'] ?></td>
        <!--<td><?php //echo $val['company']['product_category'] ?></td>-->
        <td><?php echo $this->Html->link('Details', array('controller'=>'cpanels','action' => 'facilityans',$company_id,$date)); ?></td>
    </tr>	
	
	<?php }

         $pie_data=array();
         $pie_data['0']=$data_91_100;
         $pie_data['1']=$data_81_90;
         $pie_data['2']=$data_71_80;
         $pie_data['3']=$data_61_70;
         $pie_data['4']=$data_51_60;
         $pie_data['5']=$data_41_50;
         $pie_data['6']=$data_31_40;
         $pie_data['7']=$data_21_30;
         $pie_data['8']=$data_11_20;
         $pie_data['9']=$data_0_10;


	?>
    </tbody>
</table>
</center>



</div><!--company end-->

<script type="text/javascript">
$(document).ready(function() 
    { 
        $("#myTable").tablesorter(); 
    } 
); 
</script>

<script type="text/javascript" src="http://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load('visualization', '1', {packages: ['corechart']});
    </script>
    <script type="text/javascript">
      function drawVisualization() {
        // Create and populate the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Task');
        data.addColumn('number', 'Hours per Day');
        data.addRows(10);
        <?php for($i=0;$i<10;$i++) {?>
        data.setValue(<?php echo $i;?>, 0, "<?php echo $pie_titles[$i];?>");
        data.setValue(<?php echo $i;?>, 1, <?php echo $pie_data[$i];?>);
        <?php }?>
        

        // Create and draw the visualization.
        new google.visualization.PieChart(document.getElementById('visualization')).
            draw(data, {title:"By Enterprise Characterstics"});
      }


      google.setOnLoadCallback(drawVisualization);
    </script>

 <div id="visualization" style="width: 900px; height: 600px;"></div>