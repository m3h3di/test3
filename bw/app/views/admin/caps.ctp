<?php
//$section_list = array("","General Facility Information","ETP/Wastewater Treatment Control","Wastewater Sludge","Air Emission","Noise/Sound","Solid/Hazardous Waste","Chemicals/Hazardous Materials","Sewage/Septic System","Spills/Site Contamination","Spill Prevention and Contingency Preparedness Plan","Emergency Response Plan","Environmental Awareness and Training","Cleaner Production","Environmental Management Systems (EMS)");

$section_list = array(23=>"General Facility Information",54=>"ETP/Wastewater Treatment Control",36=>"Wastewater Sludge",133=>"Air Emission",61=>"Noise/Sound",74=>"Solid/Hazardous Waste", 82=>"Chemicals/Hazardous Materials", 91=>"Sewage/Septic System", 102=>"Spills/Site Contamination", 107=>"Spill Prevention and Contingency Preparedness Plan",115=>"Emergency Response Plan",127=>"Environmental Awareness and Training",131=>"Cleaner Production");

//23, 54, 36, 133, 61, 74, 82, 91, 97, 102, 107, 115, 127, 131
//echo "<pre>";
//print_r($res);
//echo "</pre>";
?>
<div style="padding:0px 20px">
<form method="post" action="">
<table>
	<tr>
    	<td>Please Select</td>
        <td>Name</td>
    </tr>
    <?php
	foreach($section_list as $key=>$val){ 
		$link = $html->url("/admins/caps/".$key);
		?>
		<tr>
            <td><input onclick="location.href='<?= $link?>'" value="<?= $key ?>" name="cap" type="radio"  /></td>
            <td><?= $val?></td>
        </tr>
	<?php
    }
	?>

</table>


<div>
<?php
if(!empty($res)){
	
	?>
<span style="text-align:left; padding-left:20px"><h3>Result</h3></span>
<br />
	<table width="100%">
    <tr>
    	<td style="text-align:center"><b>Name</b></td>
        <td style="text-align:center"><b>Overview</b></td>
        
    </tr>
    <?php 
	foreach( $res as $val) {?>
        <tr>
            <td style="text-align:center"><?= $val['factories']['factory_name']?></td>
            <td style="text-align:center"><?= $val['fat']['text'] ?></td>
        
            
        </tr>
    	<?php
	}
	?>
    
    </table>
    <br  /><br  />
	<?php
}
?>
</div>

