<?php

	echo "<pre>";
	//print_r($factory_info);
	//print_r($factories);
	//print_r($_FILES);

	echo "</pre>";

$section_list = array("","ECC Status","ETP/Wastewater Treatment Control","Wastewater Sludge","Air Emission","Noise/Sound","Solid/Hazardous Waste","Chemicals/Hazardous Materials","Sewage/Septic System","Spills/Site Contamination","Spill Prevention and Contingency Preparedness Plan","Emergency Response Plan","Environmental Awareness and Training","Cleaner Production","Environmental Management Systems (EMS)","Do you need any support in this regards? if yes, what types of support services you would require?");
//echo $factory_id;
?>
<div class="header_title">
	<?php
	/*
	
		echo $this->Html->link('Home', array('controller'=>'users' ,'action' => 'home'))." >> ";
		$factory_name = trim($factory_name);
		echo $this->Html->link($factory_name, array('controller'=>'users' ,'action' => 'factory' , $factory_id)) . " >> ";
		echo "Follow Up Survey";
	*/
	?>
</div>

<div >


    <div style=" background-color:#EBEBEC;margin:5px;padding:40px; width:889px;border-radius:8px;-moz-border-radius:8px;-webkit-border-radius:8px;">
        <div style="margin:-30px 0 0 -27px;padding:0 0 20px;"><b>Basic info</b></div>
                
       
            <!--
            <b>Facility Name: </b>
			<?php
			echo $factory_info['factory_name']."<br/>";
			echo "<b>Address:</b> ".$factory_info['address'].",";
			echo "Phone: ".$factory_info['telephone'].",";
			echo "Fax: ".$factory_info['fax'].",";
			echo "Email: ".$factory_info['email']."<br/>";
			echo "<b>Contact Person:</b> ".$factory_info['contact_person'];
			
			 ?>
             <br/>
            <b>INITIAL VISIT DATE:</b> 12.02.2011 <br/>
            
            <b>FOLLOW-UP VISIT DATE:</b> 19.04.2011                                                           
             -->
             <table width="100%">
             	<tr>
                	<td style="text-align:left; font-weight:bold; width:30%">Facility Name</td>
                	<td style="text-align:left">
                    <?php
					echo $factory_info['factory_name'];
					?>
                    </td>
                </tr>
                <tr>
                	<td style="text-align:left; font-weight:bold">Address</td>
                	<td style="text-align:left">
                    <?php
					echo $factory_info['address'].",";
					echo "Phone: ".$factory_info['telephone'].",";
					echo "Fax: ".$factory_info['fax'].",";
					echo "Email: ".$factory_info['email'];
					?>
                    </td>
                    </td>
                </tr>
                <tr>
                	<td style="text-align:left; font-weight:bold">Contact Person</td>
                	<td style="text-align:left"><?= $factory_info['contact_person'] ?></td>
                </tr>
                <tr>
                	<td style="text-align:left; font-weight:bold">Initial Visit Date</td>
                	<td style="text-align:left"><?= $factories[0]['followups']['iv_date'] ?></td>
                </tr>
                <tr>
                	<td style="text-align:left; font-weight:bold">Follow-visit Date</td>
                	<td style="text-align:left"><?= $factories[0]['followups']['fw_date'] ?></td>
                </tr>
                <tr>
                	<td style="text-align:left; font-weight:bold">Corresponding File</td>
                	<td style="text-align:left"><a target="_blank" href="/sedf-ecp/files/<?= $factories[0]['followups']['doc'] ?>">document</a></td>
                </tr>
             </table>       
     
    </div>
    
    <div>
    <table style="width:980px">
        <tr>
            <td style="text-align:center; font-weight:bold">PROVISION
            </td>
     
            <td style="text-align:center; font-weight:bold">NOTES & SUGGESTIONS
            </td>
      
            <td style="text-align:center; font-weight:bold"> FACILITY REMARKS
            </td>
      
            <td style="text-align:center; font-weight:bold"> REMARKS / NOTES
            </td>
        </tr>
        <?php
        foreach($factories as $factory){
            $fact = $factory['followups'];
            $section = $fact['section'];
            $ans = "ans"."[".$fact['section']."][arg]";

            ?>
            <tr><td><?= $section_list[$section] ?></td>
                <td width="50%"><?= $fact['text'] ?></td>
                <td width="20%" style="text-align:center">
                    <?
					if($section != 15){
						if($fact['arg'] == 1 ) echo $html->image("tick.png", array('alt' => 'tick'))." Agreed";
						else echo $html->image("cross.png", array('alt' => 'tick'))." Not Agreed";
					}
					?>      
                </td>
                <td>
                    <?= $fact['remark'] ?>
                    

                    
                </td>
                
            </tr>
            <?php
        }
        ?>
        
        
    </table>
    

    </div>

 <div class="clr"></div>

</div>
<div class="body_footer">
        <div class="clr"></div>
</div>