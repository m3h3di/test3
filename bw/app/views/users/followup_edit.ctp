<?php

	echo "<pre>";
	//print_r($factories);
	//print_r($_POST);
	//print_r($_FILES);

	echo "</pre>";

$section_list = array("","ECC Status","ETP/Wastewater Treatment Control","Wastewater Sludge","Air Emission","Noise/Sound","Solid/Hazardous Waste","Chemicals/Hazardous Materials","Sewage/Septic System","Spills/Site Contamination","Spill Prevention and Contingency Preparedness Plan","Emergency Response Plan","Environmental Awareness and Training","Cleaner Production","Environmental Management Systems (EMS)","Do you need any support in this regards? if yes, what types of support services you would require?");
//echo $factory_id;
?>
<div class="header_title">
	<?php
	
		echo $this->Html->link('Home', array('controller'=>'users' ,'action' => 'home'))." >> ";
		$factory_name = trim($factory_name);
		echo $this->Html->link($factory_name, array('controller'=>'users' ,'action' => 'factory' , $factory_id)) . " >> ";
		echo "Follow Up Survey";
	?>
</div>

<div >

<form action="" method="post" name="facility_info"  enctype="multipart/form-data" >
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
                	<td style="text-align:left"><input type="text" name="ivd" value="<?= $factories[0]['factory_ans_tables']['iv_date'] ?>"  /></td>
                </tr>
                <tr>
                	<td style="text-align:left; font-weight:bold">Follow-visit Date</td>
                	<td style="text-align:left"><input type="text" name="fwd"  value="<?= $factories[0]['factory_ans_tables']['fw_date'] ?>" /></td>
                </tr>
                <tr>
                	<td style="text-align:left; font-weight:bold">Corresponding File</td>
                	<td style="text-align:left"><input type="file" name="file"  /></td>
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
            
			
			$fact = $factory['factory_ans_tables'];
            $section = $fact['section'];
            $ans = "ans"."[".$fact['section']."][arg]";
			
			
            ?>
            <tr><td><?= $section_list[$section] ?></td>
                <td width="50%"><textarea name="ans[<?= $fact['section']?>][text]" style=" width:100%; height:150px"><?= $fact['text'] ?></textarea></td>
                <td width="20%">
					<?php
					if($fact['arg'] == 1){?>
						<input checked="checked" type="radio" name="<?= $ans ?>" value="1"> Agreed <br />
	                    <input type="radio" name="<?= $ans ?>" value="0"> Not Agreed            
						<?php
					}
					else{ ?>
						<input  type="radio" name="<?= $ans ?>" value="1"> Agreed <br />
	                    <input checked="checked" type="radio" name="<?= $ans ?>" value="0"> Not Agreed   
						<?php
					}
                    ?>
                </td>
                <td>
                    <textarea name="ans[<?= $fact['section']?>][remark]" style="width:200px"><?= $fact['remark']?></textarea>
                    <input type="hidden" value="<?= $fact['factory_id'] ?>" name="ans[<?= $fact['section']?>][factory_id]"  />
                    <input type="hidden" value="<?= $fact['section']?>" name="ans[<?= $fact['section']?>][section]" />
                    <input type="hidden" value="<?= 1 ;?>" name="ans[<?= $fact['section']?>][status]" />

                    
                </td>
                
            </tr>
            
            <?php
			
        }
        ?>
        
        
    </table>
    
    <input type="submit" name="go" value="go">
    </div>

 <div class="clr"></div>
</form>
</div>
<div class="body_footer">
        <div class="clr"></div>
</div>