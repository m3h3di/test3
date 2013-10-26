<?php
//$sections = array("","General Facility Information","ETP/Wastewater Treatment Control","Wastewater Sludge","Air Emission","Noise/Sound","Solid/Hazardous Waste","Chemicals/Hazardous Materials","Sewage/Septic System","Spills/Site Contamination","Spill Prevention and Contingency Preparedness Plan","Emergency Response Plan","Environmental Awareness and Training","Cleaner Production","Environmental Management Systems (EMS)");

echo '<pre style="text-align:left">';
//print_r($this->Session->read('custom_weight_factor'));
//print_r($ordered_sorted_factory);
//print_r($newSections);
echo "</pre>";
$sections[]="";
foreach($newSections as $k=>$v){
	$sections[]=$v['Cluster']['name'];
}


// Start rating is calculated for all the factories and then ordered ASC
function mysortrule($a, $b){
	if ($a['rating'] == $b['rating']) {
		return 0;
	}
	return ($a['rating'] < $b['rating']) ? 1 : -1;
}

usort($ordered_sorted_factory, "mysortrule");
// End rating is calculated for all the factories and then ordered ASC


?>			






<script type="text/javascript">
function set_value(src){

	var dest_id = "chk_"+src.id;
	var dest = document.getElementById(dest_id);
	dest.value = src.value;
	//alert(dest.value);	
	
}
</script>


<div >
					
	<div style=" background-color:#EBEBEC;float:left;margin:5px;padding:30px; width:460px;border-radius:8px;-moz-border-radius:8px;-webkit-border-radius:8px;">
		<div style="padding:0 0 20px;"><b>Survey Sections</b></div>
			<form method="post" action="" >
			<table width="100%">
				<tr>
					<td style="text-align:center "><b></b></td>
					<td style="text-align:center "><b>Name</b></td>
					<td style="text-align:center "><b>Weight</b></td>																	
				</tr>
				<?php
				foreach($sections as $sec_num => $sec_name){
					$name = "chk_".$sec_num;
					if($sec_num != 0 & empty($_POST[$name]) ){
						echo '<tr><td><input type="checkbox" id="'.$name.'" name="'.$name.'" value="1" /></td><td>';
						echo $sec_name.'</td><td style="text-align:center ">';
						echo '<input onkeyup="javascript: set_value(this)" type="text" id="'.$sec_num.'" value="1"  style="width:30px; text-align:center;" /></td></tr>';
					}
					elseif($sec_num != 0 & !empty($_POST[$name]) ){
						$weight_factor = floatval($_POST[$name]);
						echo '<tr><td><input checked="checked" type="checkbox" id="'.$name.'" name="'.$name.'" value="1" /></td><td>';
						echo $sec_name.'</td><td style="text-align:center ">';
						echo '<input onkeyup="javascript: set_value(this)" type="text" id="'.$sec_num.'" value="'.$weight_factor.'"  style="width:30px; text-align:center;" /></td></tr>';
					}
				}
				?>

			</table>
			<table width="100%">
			<tr><td style="text-align:right">
				<input  type="submit" value="Go"  />
			</td></tr>
			</table>
			</form>
		</div>

		<div style=" background-color:#EBEBEC;float:left;margin:5px 5px 5px 0px;padding:30px ; width:373px;border-radius:8px;-moz-border-radius:8px;-webkit-border-radius:8px;">
			<div style="padding:0 0 20px;"><b>Rating Calculation</b></div>
			<p style="border-radius:8px;-moz-border-radius:8px;-webkit-border-radius:8px; background:#FFF; padding:5px">
				<img src="/sedf-ecp/img/total_point.png" alt="Total Points" /><br/><br/>
				
				<b>WeightFactor </b>= Value of weight factor of selected Section<br/>
				<b>Point</b> = Rating point of selected section
			</p>
		</div>
				
		<div class="clr"></div>
				
	</div>
	<div style="clear:both" ></div>
			<div class="body_footer">
				<div class="clr" ></div>
			</div>
	
   
	
<?php 
if( !empty($_POST) ){
?>
	 <br />
    <span style="text-align:left; padding-left:20px"><h3>Graphical Result</h3></span>
    <br />		
	<div id="chart_div"></div>
    
    <center>
	<br />
    <span style="text-align:left; padding-left:20px"><h3>Result</h3></span>
    <br />

	<?php 
	if(!empty($ordered_sorted_factory)){
	
		?>
		<table style=" width:97%" >
			<tr>
            	<td style=" text-align:center; vertical-align:middle"><b>No</b></td>
				<td style=" text-align:center; vertical-align:middle"><b>Name</b></td>
				<td style="  text-align:center; vertical-align:middle"><b>Rating(%)</b></td>
				<td style="  text-align:center; vertical-align:middle"><b>Catagory</b></td>
				<td style=" text-align:center; vertical-align:middle"><b>City</b></td>
				<td style="  text-align:center; vertical-align:middle"><b>Area</b></td>
				<td style=" text-align:center; vertical-align:middle"><b>Details</b></td>
			</tr>
			<?php 
			$temp_total_point=0;
			$temp_factory_num = 1;
			foreach($ordered_sorted_factory as $factory){
				
				$rating = floatval($factory['rating']);
				
				if( $rating < 50) $img='highrisk.png';
				elseif($rating >= 80) $img='lowrisk.png';
				else $img='medrisk.png';
				
				echo'<tr><td style=" border:0; padding: 10px;  text-align:center">';
				$name = $factory['factory_name'];
				$id = $factory['id'];
				
				echo $temp_factory_num;
				echo'</td><td style=" border:0; padding: 10px; text-align:center; vertical-align:middle">';
					
				echo $this->Html->link($name, array('controller'=>'admins','action' => 'FacilityCustomReport',$id));
				echo'</td><td style=" border:0; padding: 10px; text-align:center; vertical-align:middle">';
				echo $rating."%";
				echo '</td><td style=" border:0; text-align:center; vertical-align:middle">';
				echo $html->image($img, array('alt' => 'catagory','border'=>'0') );
				echo '</td><td style=" border:0; padding: 10px; text-align:center; vertical-align:middle">';
				echo $factory['city'];
				echo '</td><td style=" border:0; padding: 10px; text-align:center; vertical-align:middle">';
				echo $factory['area'];
				echo '</td><td style=" border:0; padding: 10px; text-align:center; vertical-align:middle">';
				echo $this->Html->link("Details", array('controller'=>'admins','action' => 'FacilityCustomReport',$id));
				echo '</td></tr>';
				
				$temp_total_point+=$rating;
				$temp_factory_num++;
			}
			$temp_avarage= round($temp_total_point/($temp_factory_num-1),2);
		?>
		</table>
		
		
		<?php
	}
	?>
	
	</center>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      
	  google.load("visualization", "1", {packages:["corechart"]});
      
		 function drawVisualization() {
			 // Some raw data (not necessarily accurate)
			 var data = google.visualization.arrayToDataTable([
			   ['Name', 'Rating', 'Average','Mid Risk','Low Risk'],
			   <?php
					$num=1;
					foreach($ordered_sorted_factory as $factory){
				
						$rating = floatval($factory['rating']);
						if($rating == 0) $rating+=1;
						$name = $num.". ".$factory['factory_name'];
						//if(empty($rating)) $rating=0.01;
						echo "['".$name."', ".$rating.", $temp_avarage , 50 , 80],
						";
						$num++;
					}
			   ?>
			 ]);
	
			 // Create and draw the visualization.
			 var comboChart = new google.visualization.ComboChart(document.getElementById('chart_div'));
			 comboChart.draw(data, {width: 950, height: 300,
			   title : 'Compare Rating(%) of selected Sections of Different Companies',
			   vAxis: {title: "Rating of Selected Sections(%)", minValue: 0, maxValue: 100},
			   hAxis: {title: "Company",textPosition:'none', },
			   seriesType: "bars",
			    series: {0: {color: 'blue'},1: {type: "line", color: 'red'},2: {type: "line",color: 'yellow'},3: {type: "line",color: 'green'}}
			 });
		   }
		   google.setOnLoadCallback(drawVisualization);
 
	  
	  /*google.setOnLoadCallback(drawChart);*/
	  
    </script>
    
<?php
}

?>