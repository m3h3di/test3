<?php
$sections =  array("","General Facility Information","Chemicals/Hazardous Materials Information","Spill Prevention","Spill Response/Emergency Response","Environmental Awareness Training and Training Records","Cleaner Production","Environmental Management Systems (EMS)","Preparation of Action Plan");
//echo '<pre style="text-align:left">';
//print_r($this->Session->read('custom_weight_factor'));
//print_r($ordered_sorted_factory);
//echo "</pre>";



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
					
	<div style=" background-color:#D8D2C3;float:left;margin:5px;padding:40px; width:467px">
		<div style="margin:-30px 0 0 -27px;padding:0 0 20px;"><b>Survey Sections</b></div>
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

			  <div style=" background-color:#D8D2C3;float:left;margin:5px 5px 5px 0px;padding:40px ; width:333px">
					<div style="margin:-30px 0 0 -27px;padding:0 0 20px;"><b>Rating Calculation</b></div>
					<p>
						<img src="/sedf-ecp/img/total_point.png" alt="Total Points" /><br/><br/>
						
						<b>WeightFactor </b>= Value of weight factor of selected Section<br/>
						<b>Point</b> = Rating point of selected section
					</p>
				</div>
				
				
				
				<div class="clr"></div>
				
			</div>
			<div class="body_footer">
				<div class="clr"></div>
			</div>
			

	
<?php 
if( !empty($_POST) ){
?>
	<center>
	<h3>Reports</h3>

	<?php 
	if(!empty($ordered_sorted_factory)){
	
		?>
		<table style=" width:97%" >
			<tr>
				<td style=" text-align:center; vertical-align:middle"><b>Name</b></td>
				<td style="  text-align:center; vertical-align:middle"><b>Rating(%)</b></td>
				<td style="  text-align:center; vertical-align:middle"><b>Catagory</b></td>
				<td style=" text-align:center; vertical-align:middle"><b>City</b></td>
				<td style="  text-align:center; vertical-align:middle"><b>Area</b></td>
				<td style=" text-align:center; vertical-align:middle"><b>Details</b></td>
			</tr>
			<?php 
			foreach($ordered_sorted_factory as $factory){
				
				$rating = floatval($factory['rating']);
				
				if( $rating < 50) $img='highrisk.png';
				elseif($rating >= 80) $img='lowrisk.png';
				else $img='medrisk.png';
				
				echo'<tr><td style=" border:0; padding: 10px;  text-align:center">';
				$name = $factory['factory_name'];
				$id = $factory['id'];
				//echo $name;
					
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
			

			}
			
		?>
		</table>
		
		
		<?php
	}
	?>
	
	</center>
<?php
}

?>