<?php
$section_list = array("","General Facility Information","ETP/Wastewater Treatment Control","Wastewater Sludge","Air Emission","Noise/Sound","Solid/Hazardous Waste","Chemicals/Hazardous Materials","Sewage/Septic System","Spills/Site Contamination","Spill Prevention and Contingency Preparedness Plan","Emergency Response Plan","Environmental Awareness and Training","Cleaner Production","Environmental Management Systems (EMS)");
?>
<div style="padding:0px 20px">


<div>
<?php
if(!empty($result)){
	$perc = round( 100* $result[1] /$result[0] ,2);
	?>
<span style="text-align:left; padding-left:20px"><h3>Result</h3></span>
<br />
	<table width="100%">
    <tr>
    	<td style="text-align:center"><b>Section</b></td>
        <td style="text-align:center"><b>Overview</b></td>
        <td style="text-align:center" title="Total number of facilities with Full Baseline survey"><b>Number Of factories</b></td>
        <td style="text-align:center" title="Total number of facilities satisfy this criteria"><b>Found</b></td>
        <td style="text-align:center" title=""><b>Percentage(%)</b></td>
        <td style="text-align:center" title="">Details</td>
        
    </tr>
    <tr>
    	<td style="text-align:center"><?= $section_list[$section]?></td>
        <td style="text-align:center"><?= $result[2]?></td>
        <td style="text-align:center" title="Total number of facilities with Full Baseline survey"><?= $result[0] ?></td>
        <td style="text-align:center" title="Total number of facilities satisfy this criteria"><?= $result[1] ?></td>
        <td style="text-align:center" title=""><?= $perc ?>%</td>
        <td style="text-align:center" title=""><? echo $html->link('Details', array('controller' => 'admins','action' => 'ByOverviewtable',$section,$point ),array('target' => '_blank'));?></td>
        
    </tr>
    
    </table>
    <br  /><br  />
	<?php
}
?>
</div>


<span style="text-align:left; padding-left:20px"><h2>Select an Overview</h2></span>
<br />
<div class="company" style="text-align:left;"><!--company start-->
<div class="users index">
	<?php  echo $javascript->link('jquery.min.js'); 
	//echo "<pre>";
	//print_r($all_groups);
	//echo "</pre>";
	?>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#q_1").slideToggle("slow");
			$("#q_2").slideToggle("slow");
			
			
		});
	
		function my_toggle(qq){
			var r="#"+qq;
			
				$(r).slideToggle("fast");
			
		}
	</script>


	
	
    <?php
	foreach($all_rules as $key=>$group){
		$op_name = "op_".$group['WeightFactor']['id'];
		$id_name = "q_".$group['WeightFactor']['id'];
		
		echo '<span style=";cursor:pointer" id="'.$op_name.'" onclick="my_toggle(\''.$id_name.'\')" >';
		echo $group['WeightFactor']['id'].". &nbsp;&nbsp;".$group['WeightFactor']['section_name'];
		echo "</span><br/><br/>";	
		
		
		if( !empty($group['RatingRules']) ){?>
			<div id="<?php echo $id_name; ?>" style=" display:none;" >
			<table   width="100%" >
				<tr>
                    <th width=10% style="text-align:center">Select</th>
                    
                    <th width=60% style="text-align:center">Overview</th>
                    
                    
                </tr>
				<?php
				foreach($group['RatingRules'] as $key1=>$rule){
					//$value = [""][$rule['point']]
					$link = $html->url("/admins/ByOverview/".$rule['section']."/".$rule['point']);
					
					
					?>
					
					<tr>
						<td width=10% style="text-align:center">
                        	<input onclick="location.href='<?= $link?>'" type="radio" name="overview" value="overview[<?= $rule['section']?>][<?= $rule['point']?>]" />
                        </td>

						<td width=60%><?php echo $rule['rule']; ?></td>

					</tr>
					
					
					<?php 
				}?>
			</table>
            <br />
			</div>
            
			<?php	
		}
	}
	
	?>
    
    
</div>

</div><!--company end-->
</div>