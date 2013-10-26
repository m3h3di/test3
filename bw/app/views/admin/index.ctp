<?php
$section_list = array("","General Facility Information","ETP/Wastewater Treatment Control","Wastewater Sludge","Air Emission","Noise/Sound","Solid/Hazardous Waste","Chemicals/Hazardous Materials","Sewage/Septic System","Spills/Site Contamination","Spill Prevention and Contingency Preparedness Plan","Emergency Response Plan","Environmental Awareness and Training","Cleaner Production","Environmental Management Systems (EMS)");

echo $this->Html->script('function');
/*
echo '<pre>';
print_r($factories);
echo '</pre>';
*/
?>
<style>
p {
	margin:0;
	padding:4px;
}
</style>
					

	
<div class="admin_content" style=" background-color:#FFFFFF;margin:5px;padding:40px; width:889px; border-radius:8px;-moz-border-radius:8px;-webkit-border-radius:8px;">
    <div style="margin:-30px 0 0 -27px;padding:0 0 20px;"><b>Reports</b></div>
    <div style=" background-color:#FFFFFF; border:1px solid #999999; width:400px; padding:0px 0px 13px 10px ">
        <p>
            <?php echo $this->Html->link('All Facilities', array('controller'=>'admins','action' => 'ByFacility')); ?>
            <br/>[Rating, Area, BGMEA / BEOGWIOA]
        </p>	
    </div><br/>
    <div style=" background-color:#FFFFFF; border:1px solid #999999; width:400px; padding:0px 0px 13px 10px ">
        <p>
            <?php echo $this->Html->link('Different Standard', array('controller'=>'admins','action' => 'ByStandard')); ?>
            <br/>[Local, customized standard]
        </p>	
    </div><br/>
	<!--
    <div style=" background-color:#FFFFFF; border:1px solid #999999; width:400px; padding:0px 0px 13px 10px ">
        <p>
            <?php echo $this->Html->link('By Overview', array('controller'=>'admins','action' => 'ByOverview')); ?>
            <br/>[Number of facilities that have selected overview]
        </p>	
    </div><br/>
    -->
	
	<div style=" background-color:#FFFFFF; border:1px solid #999999; width:400px; padding:0px 0px 13px 10px ">
        <p>
            <?php echo $this->Html->link('By Buyer', array('controller'=>'admins','action' => 'ByBuyer')); ?>
            <br/>[analyse the factories of a selected Buyer]
        </p>	
    </div><br/>
    <div style=" background-color:#FFFFFF; border:1px solid #999999; width:400px; padding:0px 0px 13px 10px ">
        <p>
            <?php echo $this->Html->link('Section(s) Analysis', array('controller'=>'admins','action' => 'BySection')); ?>
            <br />[by specific or multiple sections, with 'custom' weight factor]
        
        </p>	
    </div><br/>
    <div style=" background-color:#FFFFFF; border:1px solid #999999; width:400px; padding:0px 0px 13px 10px ">
        <p>
            <?php echo $this->Html->link('Single Facility Analysis', array('controller'=>'admins','action' => 'SingleFacilityAnalysis')); ?>
            <br />[Compare a selected Facility to all Other Facility]
        </p>	
    </div><br/>
    
    <div style=" background-color:#FFFFFF; border:1px solid #999999; width:400px; padding:0px 0px 13px 10px ">
        <p>
            <?php echo $this->Html->link('By Specific Question', array('controller'=>'admins','action' => 'ByQuestion')); ?>
            <br />[specific or multiple questions, with defined answers]
        </p>	
    </div><br/>
    <!--
    <div style=" background-color:#FFFFFF; border:1px solid #999999; width:400px; padding:0px 0px 13px 10px ">
        <p>
            <?php echo $this->Html->link('Comparison Analysis', array('controller'=>'admins','action' => 'ComparisonAnalysis')); ?>
            <br/>[between Sections & Questions - by defining rating for Section & Answer for Questions]
        </p>	
    </div><br/>
	-->
	<div style=" background-color:#FFFFFF; border:1px solid #999999; width:400px; padding:0px 0px 13px 10px ">
        <p>
            <a target="_blank" href="http://www.betterwork.org">Resource</a>
            
        </p>	
    </div>
    
    <div class="clr"></div>
    <br /><br />
    
    
    
</div>
    
    