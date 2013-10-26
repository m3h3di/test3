<?php  echo $javascript->link('jquery.min.js'); ?>
<script type="text/javascript">
	$(document).ready(function(){
		
		$("#Reports").click(function () {
			$("#result_factory_table").slideToggle("slow");
		});
		
		$("#Common_criteria").click(function () {
			$("#result_common_criteria").slideToggle("slow");
		});
	});

</script>
<pre>
<?php 
//print_r($factories);
//print_r($rating_rules);
//print_r($_POST);
?>
</pre>

<?php
$section_list = array("","General Facility Information","ETP/Wastewater Treatment Control","Wastewater Sludge","Air Emission","Noise/Sound","Solid/Hazardous Waste","Chemicals/Hazardous Materials","Sewage/Septic System","Spills/Site Contamination","Spill Prevention and Contingency Preparedness Plan","Emergency Response Plan","Environmental Awareness and Training","Cleaner Production","Environmental Management Systems (EMS)");



//Start weight factor find for a section 
function weight_factor($section, $rating_rules){
	$weight_fact = 1 ;
	foreach($rating_rules as $kew=> $val){
		if(!empty($section) & $val['RatingRule']['section'] == $section){
			$weight_fact=$val['RatingRule']['Weight_factor'];
			break;
		}
	}
	return ($weight_fact);
}
//End weight factor find for a section 

?>

<div class="header_title"></div>
		
	<div style=" background-color:#D8D2C3;margin:5px;padding:40px; width:889px">
		<div style="margin:-30px 0 0 -27px;padding:0 0 20px;"><b>Comparison Analysis</b></div>
				
		<div style="border:1px solid #FFFFFF; width:800px; height:160px; padding:0px 0px 13px 10px ">
			
			<form action="" method="post" name="facility_info" >
			
			<div style=" padding:20px 50px 20px 27px">
			Catagories Of Facility <br />
			<?php $chk = ''; if( !empty($_POST['High']) ) $chk='checked="checked"';?>
			<input type="checkbox" <?php echo $chk;?> value="on" name="High"  />High <br/>
			<?php $chk = ''; if( !empty($_POST['Medium'])) $chk='checked="checked"';?>
			<input type="checkbox" <?php echo $chk;?> value="on" name="Medium"  />Medium <br/>
			<?php $chk = ''; if( !empty($_POST['Low'])) $chk='checked="checked"';?>
			<input type="checkbox" <?php echo $chk;?> value="on" name="Low"  />Low 
			</div>
			
			
			
			<input type="submit" value="Generate Report"  />
			</form>
					
		</div>
		
		
	</div>

<div class="header_title"></div>

<div id="target_div" name="target_div">
	
	<?php 
	if(!empty($factories)){
		
		?>
		<center>
		<h3 ><span class="Reports" style="cursor:pointer" id="Reports">Reports</span></h3>
		<div class="result_factory_table" id="result_factory_table">
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
			$factory_id_for_comparison_analysis = '';
			
			foreach($factories as $factory){
				
				if( empty($factory['FactoryAnsTable']) & !empty($_POST['reg'])) continue;
				
				
				if( empty($factory_id_for_comparison_analysis) )
					$factory_id_for_comparison_analysis = $factory['AdminFactory']['id'];
				else	$factory_id_for_comparison_analysis .= ",".$factory['AdminFactory']['id'];
				
				
				if(!empty($factory['Rating']) ){
						
					// Start rating in percentage genration
					$total_posible_point=0;
					$total_factory_point=0;
					$i=1;
					foreach($weight_factor  as $id=>$wf){
						$section_wf = $wf['WeightFactor']['weight_factor'];
						
						$point=0;
						foreach($factory['Rating'] as $rate_info){
							if($rate_info['section'] == $i & $rate_info['status'] == 1){
								if( !empty($rate_info['points']) ) $point= $rate_info['points'];
								else $point=0;
								break;
							}							
						}
						$total_posible_point += ( floatval($section_wf)* 5.0 );
						$total_factory_point += ( floatval($section_wf)* floatval($point) );
						$i++;
					}
					$res = ($total_factory_point/$total_posible_point)*100 ;
					$res = number_format($res, 2, '.', '');
					// End rating in percentage genration
						
					if( $res<=50) $img='highrisk.png';
					elseif($res>80) $img='lowrisk.png';
					else $img='medrisk.png';
				}
					
				if(!empty($_POST['High']) || !empty($_POST['Medium']) || !empty($_POST['Low']) ){
					if( empty($_POST['High']) & $res<=50 ) continue; 
					if( empty($_POST['Low']) & $res>80) continue; 
					if( empty($_POST['Medium']) & $res>50 & $res<=80 ) continue; 				
				}
				
				echo'<tr><td style=" border:0; padding: 10px;  text-align:center">';
				$name = $factory['AdminFactory']['factory_name'];
				$id = $factory['AdminFactory']['id'];
				//echo $name;
					
				echo $this->Html->link($name, array('controller'=>'admins','action' => 'FacilityReport',$id));
				echo'</td><td style=" border:0; padding: 10px; text-align:center; vertical-align:middle">';
				echo $res."%";
				echo '</td><td style=" border:0; text-align:center; vertical-align:middle">';
				echo $html->image($img, array('alt' => 'catagory','border'=>'0') );
				echo '</td><td style=" border:0; padding: 10px; text-align:center; vertical-align:middle">';
				echo $factory['AdminFactory']['city'];
				echo '</td><td style=" border:0; padding: 10px; text-align:center; vertical-align:middle">';
				echo $factory['AdminFactory']['area'];
				echo '</td><td style=" border:0; padding: 10px; text-align:center; vertical-align:middle">';
				echo $this->Html->link("Details", array('controller'=>'admins','action' => 'FacilityReport',$id));
				echo '</td></tr>';
			

			}
			
		?>
		</table>
		</div>
		
		</center>
		<?php
	}
	?>
	<center>
	<h3><span  class="Common_criteria" id="Common_criteria" style="cursor:pointer">Common criteria</span></h3>
	<div id="result_common_criteria" class="result_common_criteria" style="padding-left:20px; width:700px; text-align:left">
		<?php
		if(!empty($ans) ){
				foreach($ans as $m_ans){
					$number = $m_ans['Question']['section'].".".intval($m_ans['Question']['order']);
					echo "<b>QUESTION (".$number."): </b> ".$m_ans['Question']['question']."<br/>";
					echo "<b>ANSWER : </b> ".$m_ans['Answer']['answer']."<br/><br/>";
				}
				/*$number = $ans[0]['Question']['section'].".".$ans[0]['Question']['order'];
				echo "<b>QUESTION (".$number."): </b> ".$ans[0]['Question']['question']."<br/>";
				echo "<b>ANSWER : </b> ".$ans[0]['Answer']['answer'];*/
			}
		?>
	
	</div>
	</center>
</div>

