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
        
    </tr>

    <tr>
        <td>
            
            ETP/WASTE WATER TREATMENT CONTROL
            
        </td>
        <td>
          	<table>
				<tr>
<td width="50%">ECC Status	Observation: The operating status & treatment process of the existing ETP is quite well and satisfactory.</td>

<td><textarea style=" width:100%">Suggestion: ETP needs to function in a fulltime basis.  (refer to ECA-95 , section 20-Sub section-2(d)</textarea></td>
</tr><tr>

<td width="50%">Observation: Facility respective person (ETP manager, operator, helper, compliance persons) are not aware about EMP.

<td><textarea style=" width:100%">Suggestion: All respective persons (ETP
manager, operator, helper, compliance persons) need to know the EMP process as per rules.  ECR-97-rule-7,sub-rule-6(c)(,d)</textarea></td>
</tr><tr>
<td>Observation: Facilities respective persons (ETP manager, operator, helper, compliance persons) are not trained to maintain ETP/Waste water treatment control and record system update.</td>

<td><textarea style=" width:100%">Suggestion: Facilities respective persons (ETP manager, operator, helper, compliance persons) need training on ETP/Waste water treatment control management and record system update.</textarea></td>
				</tr>
			</table>

            
        </td>
        <td width="130">
            <input type="radio" name="Agreed2" value="Agreed"> Agreed <br />
             <input type="radio" name="Agreed2" value="Not Agreed"> Not Agreed

        </td>
        <td>
            <textarea style="width:200px"></textarea>
            
        </td>
        
    </tr>
    <tr>
        <td>
            
           WASTE WATER SLUDGE
            
        </td>
        <td>
            <table>
				<tr>
<td width="50%">Observation: The facility sludge drying bed is not cover the entire area.</td>

<td><textarea style=" width:100%">Suggestion: The facility is suggested to cover the entire sludge drying bed area with shed to avoid contacts with rain & therefore to reduce the adverse effects on the environment.</textarea></td>
</tr><tr>
<td>Observation: The facility does not maintain the sludge disposal register regularly.</td>

<td><textarea style=" width:100%">Suggestion: The facility is suggested to maintain the sludge disposal register regularly.</textarea></td>
</tr><tr>
<td>Observation: The facility does not manage proper sludge handling/processing, storage and dispose.</td>

<td><textarea style=" width:100%">Suggestion: The facility is suggested to establish proper sludge handling/processing, storage and disposal measures to make the sludge management system more effective.</textarea></td>
			</tr>
			</table>


            
        </td>
       <td width="130">
            <input type="radio" name="Agreed3" value="Agreed"> Agreed <br />
             <input type="radio" name="Agreed3" value="Not Agreed"> Not Agreed

        </td>
        <td>
            <textarea style="width:200px"></textarea>
            
        </td>
        
    </tr>
    <tr>
        <td>
            
            AIR EMISSION
            
        </td>
        <td>
            <table>
				<tr>
<td width="50%">Observation: Though the facility produces air emission, no emission control system in place.</td>
<td><textarea style=" width:100%">Suggestion: Though the facility produces air emission, no emission control system in place. The facility is suggested to install air emission control system to reduce the adverse effect on the environment. [ ECR-97, rule-13, schedule-12 (E)]</textarea></td>
</tr><tr>
<td>Observation: The facility does not collect the samples of air emission.</td>

<td><textarea style=" width:100%">Suggestion: The facility is suggested to collect the samples of air emission and thus check it from the DOE/BUET/other recognized labs or institutes, to check whether the emitted air meets with the ECR 97 prescribed parameters.</textarea></td>
				</tr>
			</table>


            
        </td>
        <td width="130">
            <input type="radio" name="Agreed4" value="Agreed"> Agreed <br />
             <input type="radio" name="Agreed4" value="Not Agreed"> Not Agreed

        </td>
        <td>
            <textarea style="width:200px"></textarea>
            
        </td>
       
    </tr>
    <tr>
        <td>
            
           NOISE / SOUND
            
        </td>
        <td>
            <table>
				<tr>
 <td width="50%">Observation: The facility does not take control measures regarding sound/noise pollution in Generator & Washing area.</td>

 <td><textarea style=" width:100%">Suggestion: The facility is suggested to take control measures regarding sound/noise pollution in Generator & Washing area in order to comply with ECR 97 & Building Code 06 prescribed parameters. (5.3, 5.4, 5.5)</textarea></td>
				</tr>
			</table>

            
        </td>
       <td width="130">
            <input type="radio" name="Agreed5" value="Agreed"> Agreed <br />
             <input type="radio" name="Agreed5" value="Not Agreed"> Not Agreed

        </td>
        <td>
            <textarea style="width:200px"></textarea>
            
        </td>
      
    </tr>
     <tr>
        <td>
            
           SOLID / HAZARDOUS WASTE
            
        </td>
        <td>
            <table>
				<tr>
<td width="50%">Observation: The facility does not keep the waste at on-site dumping area without segregated based on the hardlines. softlines, nature of waste, etc.</td>
<td><textarea style=" width:100%">Suggestion: The facility is suggested to keep the waste at on-site dumping area segregated based on the hardlines. softlines, nature of waste, etc. (6.2)</textarea></td>
</tr><tr>
<td>Observation: The facility does not make provision of shed cover at the entire on-site dumping area.</td>

<td><textarea style=" width:100%">Suggestion: The facility is suggested to make provision of shed cover at the entire on-site dumping area protecting the possible release to the environment.</textarea></td>
</tr><tr>
<td>Observation: The facility people are not trained on handling, disposal and management of hazardous waste.</td>

<td><textarea style=" width:100%">Suggestion: The facility is suggested to train staffs/peoples on handling, disposal and management of hazardous waste.
 ECA-95, Section-20,sub-section 2(g)</textarea></td>
</tr><tr>
<td>Observation: The facility has not posted management and handling instructions of
hazardous waste, visible on the storage container, store.</td>
<td><textarea style=" width:100%">Suggestion: The facility is suggested to post management and handling instructions of hazardous waste, visible on the storage container, store.</textarea></td>
				</tr>
			</table>
            
        </td>
        
       <td width="130">
            <input type="radio" name="Agreed6" value="Agreed"> Agreed <br />
             <input type="radio" name="Agreed6" value="Not Agreed"> Not Agreed

        </td>
        <td>
            <textarea style="width:200px"></textarea>
            
        </td>
    </tr>
     <tr>
        <td>
            
          CHEMICAL / HAZARDOUS MATERIALS
            
        </td>
        <td>
            <table>
				<tr>
<td width="50%">Observation: At the ETP dosing room, surveyor observed that Sulfuric Acid was kept on Acetic Acid container without having proper label.  95% chemical drums and containers found with proper labels.</td>
<td><textarea style=" width:100%">Suggestion: All chemical drums & containers should be properly labeled and only trained person will be handling the chemicals. ECA-95 section 20, sub-section 2(g), ECR-97,Rules-7,sub-rule 6(c)(d)</textarea></td>
</tr><tr>
<td>Observation: The facility does not have emergency response procedures in place, to address any accident due to improper handling of chemicals/hazardous materials.</td>
<td><textarea style=" width:100%">Suggestion: The facility is suggested to develop emergency response procedures, to address any accident due to improper handling of chemicals/hazardous materials. ECR-97-Rules-7-subrule 6(c)(d)</textarea></td>
				</tr>
			</table>
            
        </td>
       <td width="130">
            <input type="radio" name="Agreed7" value="Agreed"> Agreed <br />
             <input type="radio" name="Agreed7" value="Not Agreed"> Not Agreed

        </td>
        <td>
            <textarea style="width:200px"></textarea>
            
        </td>
       
    </tr>
     <tr>
        <td>
            
          SEWAGE / SEPTIC SYSTEM
            
        </td>
        <td>
            <table>
				<tr>
<td width="50%">Observation: As the facility finally disposes the sewage through municipal sewage line without treat sewage.</td>
<td><textarea style=" width:100%">Suggestion: As the facility finally disposes the sewage through municipal sewage line, the facility is suggested to chlorinate/treat sewage before disposal.</textarea></td>
</tr><tr>
<td>Observation: The facility does not keep records on sewage and septic system management.</td>
<td><textarea style=" width:100%">Suggestion: The facility is suggested to keep records of sewage and septic system management.</textarea></td>


            	</tr>
			</table>
        </td>
       <td width="130">
            <input type="radio" name="Agreed8" value="Agreed"> Agreed <br />
             <input type="radio" name="Agreed8" value="Not Agreed"> Not Agreed

        </td>
        <td>
            <textarea style="width:200px"></textarea>
            
        </td>
      
    </tr>
     <tr>
        <td>
            
           NOISE / SOUND
            
        </td>
        <td>
            <table>
				<tr>
<td width="50%">Observation: The facility does not take control measures regarding sound/noise pollution in Generator & Washing area.</td>

<td><textarea style=" width:100%">Suggestion: The facility is suggested to take control measures regarding sound/noise pollution in Generator & Washing area in order to comply with ECR 97 & Building Code 06 prescribed parameters. (5.3, 5.4, 5.5)</textarea></td>

				</tr>
			</table>
            
        </td>
       <td width="130">
            <input type="radio" name="Agreed9" value="Agreed"> Agreed <br />
             <input type="radio" name="Agreed9" value="Not Agreed"> Not Agreed

        </td>
        <td>
            <textarea style="width:200px"></textarea>
            
        </td>
       
    </tr>
     <tr>
        <td>
            
          SPILLS / SITE CONTAMINATION
            
        </td>
        <td>
            <table>
				<tr>
<td width="50%">Observation: The facility does not have any record keeping system for the purpose of any unexpected spills or release accidents record keeping.</td>
<td><textarea style=" width:100%">Suggestion: The facility is suggested to develop a record keeping system for the purpose of any unexpected spills or release accidents record keeping in future. ECA 95, Section 4-Sub section 2 (b)</textarea></td>
</tr><tr>

<td>Observation: The facility does not have a formal or written procedures to address the clean-up or remediation measures for any unexpected possible contamination from harmful substances or spills. Facility do not provide training for the employees responsible for handling site contamination issues.</td>
<td><textarea style=" width:100%">Suggestion: The facility is suggested to develop formal or written procedures to address the clean-up or remediation measures for any unexpected possible contamination from harmful substances or spills in future. The facility is suggested to provide more training for the employees responsible for handling site contamination issues.</textarea></td>

            	</tr>
			</table>
        </td>
       <td width="130">
            <input type="radio" name="Agreed10" value="Agreed"> Agreed <br />
             <input type="radio" name="Agreed10" value="Not Agreed"> Not Agreed

        </td>
        <td>
            <textarea style="width:200px"></textarea>
            
        </td>
       
    </tr>
     <tr>
        <td>
            
           SPILL PREVENTION AND CONTINGENCY PREPAREDNESS PLAN
            
        </td>
        <td>
            <table>
				<tr>
<td width="50%">Observation: The facility management does not have any spill prevention and contingency preparedness plan.</td>
 <td><textarea style=" width:100%">Suggestion: The facility is suggested that the facility management to develop a formal spill prevention and contingency plan. [ECA 95, Section 4-Sub section 2 (b)]</textarea></td>
 </tr><tr>
<td>Observation: The facility management does not organize training for the staff and worker on spill prevention and contingency preparation plan and train them accordingly.</td>
<td><textarea style=" width:100%">Suggestion: The facility management is suggested to organize training for the staff and worker on spill prevention and contingency preparation plan and train them accordingly.  [ECA 95, Section 4-Sub section 2 (b)]</textarea></td>
				</tr>
			</table>
            
        </td>
       <td width="130">
            <input type="radio" name="Agreed11" value="Agreed"> Agreed <br />
             <input type="radio" name="Agreed11" value="Not Agreed"> Not Agreed

        </td>
        <td>
            <textarea style="width:200px"></textarea>
            
        </td>
        
    </tr>

    <tr>
        <td>
            
           EMERGENCY RESPONSE PLAN
            
        </td>
        <td>
            	<table>
				<tr>
<td width="50%">Observation: The facility management conducted fire fighting training for the workers and also they documented the training accordingly. The facility did not have any emergency response plan.</td>
<td><textarea style=" width:100%">Suggestion: The facility did not have any emergency response plan. So the facility is suggested to develop an emergency response plan, train the employees on it, maintain the training records accordingly and keep the EMP up to date. ECR-97, Rules-7, sub-rules 6 (c)(d)</textarea></td>
</tr><tr>
<td>Observation: The facility does not post fire exit map/evacuation plan at the washing unit.</td>
<td><textarea style=" width:100%">Suggestion: The facility is suggested to post fire exit map/evacuation plan at the washing unit.</textarea></td>

				</tr>
			</table>
            
        </td>
      <td width="130">
            <input type="radio" name="Agreed12" value="Agreed"> Agreed <br />
             <input type="radio" name="Agreed12" value="Not Agreed"> Not Agreed

        </td>
        <td>
            <textarea style="width:200px"></textarea>
            
        </td>
       
    </tr>
    <tr>
        <td>
            
           ENVIRONMENTAL AWARENESS AND TRAINING
            
        </td>
        <td>
            <table>
				<tr>
<td width="50%">Observation: The facility management did not conduct any environmental awareness training for its staffs and workers. Facility management does have written environmental policy but staff and workers are not aware of this policy.</td>

<td><textarea style=" width:100%">Suggestion: The facility is suggested to organize training for worker on environmental awareness issues and they also need to maintain the training records accordingly.</textarea></td>


				</tr>
			</table>
            
        </td>
       <td width="130">
            <input type="radio" name="Agreed13" value="Agreed"> Agreed <br />
             <input type="radio" name="Agreed13" value="Not Agreed"> Not Agreed

        </td>
        <td>
            <textarea style="width:200px"></textarea>
            
        </td>
        
    </tr>
    <tr>
        <td>
            
           CLEANER PRODUCTION
            
        </td>
        <td>
            <table>
				<tr>
<td width="50%">Observation: The facility does not maintain proper records on Cleaner Production Plan or track the amounts of wastes or emissions.</td>
<td><textarea style=" width:100%">Suggestion: The facility is suggested to maintain proper records on Cleaner Production Plan or track the amounts of wastes or emissions reduced and amounts of energy saved through implementation of Cleaner Production Plans.</textarea></td>


				</tr>
			</table>
            
        </td>
       <td width="130">
            <input type="radio" name="Agreed14" value="Agreed"> Agreed <br />
             <input type="radio" name="Agreed14" value="Not Agreed"> Not Agreed

        </td>
        <td>
            <textarea style="width:200px"></textarea>
            
        </td>
        
    </tr>
    <tr>
        <td>
            
          ENVIRONMENTAL MANAGEMENT SYSTEM (EMS)
            
        </td>
        <td>
            <table>
				<tr>
<td width="50%">Observation: Facility does not maintain Environmental Management System in place, properly documented and updated.</td>
<td><textarea style=" width:100%">Suggestion: Facility needs to maintain Environmental Management System in place, properly document and update it.</textarea></td>

				</tr>
			</table>
            
        </td>
       <td width="130">
            <input type="radio" name="Agreed15" value="Agreed"> Agreed <br />
             <input type="radio" name="Agreed15" value="Not Agreed"> Not Agreed

        </td>
        <td>
            <textarea style="width:200px"></textarea>
            
        </td>
       
    </tr>
</table>

<input type="submit" name="Back" value="Back">
</div>

 <div class="clr"></div>

</div>
<div class="body_footer">
        <div class="clr"></div>
</div>