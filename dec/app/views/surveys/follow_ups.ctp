<?php
echo $factory_id;
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
    foreach($questions as $question ){
		
		?>
    <tr>
        <td>
            
            ECC Status
            
        </td>
        <td>
        	<table>
				<tr>
					<td width="50%">
						ECC Status	Observation: Facility has a Valid ECC.</td>

					<td>
						<textarea style=" width:100%; height:auto">Suggestion: Facility should renew on time ECC. Refer to ECA-95, Section-12 & ECR-97 Section-08, Refer to ECR -97, Section8(1)(2)]</textarea>
					</td>
				<tr>
			</table
	


            
        </td>
        <td width="130">
            <input type="radio" name="Agreed1" value="Agreed"> Agreed <br />
             <input type="radio" name="Agreed1" value="Not Agreed"> Not Agreed
            
        </td>
        <td>
            <textarea style="width:200px"></textarea>
            
        </td>
        
    </tr><?php
	}
	?>

   
</table>

<input type="submit" name="Back" value="Back">
</div>

 <div class="clr"></div>

</div>
<div class="body_footer">
        <div class="clr"></div>
</div>