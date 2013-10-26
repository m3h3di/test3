<div style="text-align:left;padding:0px;margin: 0 auto; ">

	<?php
	//echo '<pre style="text-align:left">';
	//print_r($surveyData);
	//echo "</pre>";

	?>
	<!--
	thank you 
	<br clear=all style='mso-special-character:line-break;page-break-before:always'>
	-->

	<?php
	if($surveyData){ ?>
	<div style="width:800px;margin:40px auto" >
		<b>Environmental Compliance Assessment Report</b> <br/><br/>
		<b>Supplier Name:</b> <?= $surveyData[42]['SurveyData']['AnswerText']; ?>  <br>
		<b>Supplier Address:</b> <?= $surveyData[43]['SurveyData']['AnswerText']; ?> <br>
		<b>GPS Coordinates:</b> <?= $surveyData[81]['SurveyData']['AnswerText']; ?> <br>
		<b>Assessment date:</b> <?= $surveyData[42]['SurveyData']['survey_date']; ?> <br>
		<b>Total number of assessment reports (including this one):</b> 
		
		<br/><br/><br/>
		This compliance report includes information about this factory's compliance performance at the time of the assessment. The key compliance results are explained in more detail on the following pages.
		<br/><br/>
		The objective of the environmental compliance assessment is to determine the factory's compliance with all applicable environmental legal requirements of Vietnam and IFC's Performance Standards on Environmental Protection. 
		<br/><br/><br/>
		<b style="color:rgb(193, 0, 0)">Table of Contents</b>
		<br/><br/><br/>
		<div style="margin-left:20px">
			1.	Factory and Visit Information<br/><br/>
			2.	Summary of Findings
			<br/><br/>
			3.	Detailed findings
			<br/><br/>
			4.	Annex 1 - Photos
			<br/><br/>
			5.	Annex 2 - Graphs
		</div>
	</div>
	<br/><br/><br/>
	
		<div style="" class="reportTitle">1. Factory and Visit Information<br/><br/></div>
		<table class="FG" width="800" style="text-align:left;padding:0px;border-collapse:collapse; margin:0px auto" >
			
					<tr>
						<td colspan="4" style="background:rgb(57, 40, 100);color:#FFF;font-weight:bold;border: 1px solid #c1c1c1;">GENERAL INFORMATION</td>
					</tr>
			<?php
			$i = 0;
			$number = 0;
			foreach($surveyData as $key=>$val){		
				if($val['SurveyData']['cluster_id'] != 10) continue;
				$i++;
				$number++;
				$cluster= $val['Cluster'];
				$question = $val['Question'];
				$ans = $val['SurveyData'];
				
				//echo '<pre style="text-align:left">';
				//print_r($val);
				//echo "</pre>";
				
				if( ($i==15 && $i==$number) || ($i==18 && $i==$number) || ($i==22 && $i==$number) || ($i==1 && $i!=$number) || ($i==19 && $i!=$number) ){
					?>
					</table>	
					<br/>
					<table class="FG" width="800" style="text-align:left;padding:0px;border-collapse:collapse; margin:0px auto" >
						<tr>
							<td colspan="4" style="background:rgb(57, 40, 100);color:#FFF;font-weight:bold">
								<?php
								if($i == 15 and $i==$number) echo "ORGANISATION";
								else if($i == 18 and $i==$number )	echo "COMPLIANCE";
								else if($i == 22 and $i==$number){
									echo "ENVIRONMENTAL";
									$i=1;
								}
								else if($i == 1 and $i!=$number){
									echo "ENVIRONMENTAL";
									$i=1;
								}
								else if($i == 19 and $i!=$number) echo "GEOGRAPHIC  SITE";
								
								?>
								
							</td>
						</tr>
					<?php
				}
				
				
				
				if($question['type'] == 1){
					?>
					<tr>
						<td rowspan="2" width="2%" style="border-right:0"><?=$i?>. </td>
						<td rowspan="2" style="border-left:0"><?=$question['text']?></td>
						<td class="boldBg" width="25%" >Response</td>
						<td class="boldBg" width="25%">Comments/Details</td>				
					</tr>
					<tr>				
						<td >
							<?php 
							$tmpAns = " ".$ans['AnswerText'];
							if($ans['AnswerText'] == "[yes]") echo "Yes";
							else if($ans['AnswerText'] == "[no]") echo "No";
							else if($ans['AnswerText'] == "[na]") echo "NA";
							?>
							<!--
							<input <? if(strpos($tmpAns,"[yes]")) echo 'checked'?> onclick="javascript:writeTa(this,<?= $question['id'] ?>,'yes')" type="checkbox" value="yes"> yes 
							<input <? if(strpos($tmpAns,"[no]")) echo 'checked'?> onclick="javascript:writeTa(this,<?= $question['id'] ?>,'no')" type="checkbox" value="no"> no <br/>
							<input <? if(strpos($tmpAns,"[NA]")) echo 'checked'?> onclick="javascript:writeTa(this,<?= $question['id'] ?>,'NA')" type="checkbox" value="NA"> NA <br/>
							-->
							<?php
							?>					
						</td>
						<td style="white-space:pre-line"><?php
							$pn = $ans['PersonalNotes'];
							echo str_replace("\n", "<br />",$pn);
						?>
						</td>		
					</tr>
					<?
				}
				else{
					?>
					<tr>
						<td style="border-right:0"><?=$i?>. </td>
						<td style="border-left:0"><?=$question['text']?></td>
						<td colspan="2" style="white-space:pre-line" width="50%">
							<?php
							if($question['id'] == 56 || $question['id'] == 65){
								foreach($answers as $k=>$v){
										$v = $v['Answer'];
										if($v['question_id'] != $question['id']) continue;
										$mcAns = $v['answer'];
										$mcAnsId = $v['id'];
										
										$tmpAns = " ".$ans['AnswerText'];	//only for edit
										$tmpMcAns = "[".$mcAns."]";
										if(strpos($tmpAns,$tmpMcAns)) echo $mcAns."<br/>";										
									}
							}
							else{
								//echo $ans['AnswerText'];
								$at = $ans['AnswerText'];
								echo str_replace("\n", "<br />",$at);
							}
							?>
						
						</td>
									
					</tr>				
					<?
				}
			}
			?>
		</table>
		<br/><br/><br/>
		
		<!---=====================- Summary Of findings =====================-->
		<div style="margin-left:20px;color:rgb(193, 0, 0)" class="reportTitle">2.	Summary of Findings<br/><br/></div>
		<table width="800" style="text-align:left;padding:0px;border-collapse:collapse;margin:0px auto" >
				<tr >
					<td  class="boldBg" width="20%">Compliance Cluster</td>
					<td  class="boldBg" width="35%">Compliance Point</td>
					<td  class="boldBg" width="35%" >Issue</td>
				</tr>
		
			<?php
			$oldCluster = '';
			$tmpEnv = 'Environmental';
			foreach($surveyData as $key=>$val){	
				if($val['SurveyData']['QuestionType'] != "Compliance") continue;
				$cluster= $val['Cluster'];
				$question = $val['Question'];
				$ans = $val['SurveyData']; 
				if($ans['AnswerYesNo'] != "false") continue;
				
				
				$displayCluster = $cluster['name']; 
				if($oldCluster == $cluster['name']){
					$displayCluster = '';
					
				}
				?>
					
				<tr >
					<td style="border-top:0;border-bottom:0;"><?=$tmpEnv?></td>		
					<?php
					if($displayCluster != ""){
						?>
						<td style="border-bottom:0;"><?=$displayCluster?></td>
						<?php
					}
					else{
						?>
						<td style="border-top:0;border-bottom:0;"><?=$displayCluster?></td>
						<?php
					}
					?>
					<td style=""><?=$question['issue']?></td>
				</tr>
				<?php
				if($tmpEnv == 'Environmental') $tmpEnv ='';
				$oldCluster=$cluster['name'];
			}
			?>
			<tr >
				<td  colspan="3" style="border-right:0;border-left:0;border-bottom:0"></td>
				
			</tr>
		</table>
		
		
		<br/><br/><br/>
		<div style="margin-left:20px;color:rgb(193, 0, 0)" class="reportTitle">3.	Detailed findings<br/><br/></div>
		<?php
		//======================Finding Compliace ========================
		foreach($surveyData as $key=>$val){		
			if($val['SurveyData']['QuestionType'] != "Compliance") continue;
			
			$cluster= $val['Cluster'];
			$question = $val['Question'];
			$ans = $val['SurveyData'];
			
			
			//Level of Difficulty
			$lowBg = '';
			$midBg ='';
			$highBg ='';
			if($ans['lod'] == "low") $lowBg = 'background:#6495ED';
			if($ans['lod'] == "medium") $midBg ='background:#6495ED';
			if($ans['lod'] == "high") $highBg ='background:#6495ED';
			
			//InterView
			$o = ' '; 
			if($ans['Observation'] == "true") $o='x';
			$d = ' '; 
			if($ans['Documentation'] == "true") $d='x';
			$m = ' '; 
			if($ans['InterviewWithManagement'] == "true") $m='x';
			$u = ' '; 
			if($ans['InterviewWithUnion'] == "true") $u='x';
			$w = ' '; 
			if($ans['InterviewWithWorker'] == "true") $w='x';
			$ot = ' '; 
			if($ans['InterviewWithOther'] == "true") $ot='x';
			
			
			
			if($ans['AnswerYesNo'] == "false"){
				//echo '<pre style="text-align:left">';
				//print_r($val);
				//echo "</pre>";
				?>
				<table width="800" style="text-align:left;padding:0px;border-collapse:collapse;margin:0px auto" >
					<tr >
						<td class="boldText" width="20%">Compliance Point</td>
						<td width="45%"><?=$cluster['name']?></td>
						<td width="35%" colspan="6" >Q<?=$question['id']?></td>
					</tr>
					<tr>
						<td class="boldText">Issue</td>
						<td ><?=$question['issue']?></td>
						<td  class="boldText" colspan="6">Supporting Information</td>
					</tr>
					<tr>
						<td rowspan="2" class="boldText">Question</td>
						<td rowspan="2"><?=$question['question']?></td>
						<td colspan="6"  class="boldText" style="text-align:center">Interview</td>
					</tr>		
					<tr>
						
						<td rowspan="4" class="verticalText" >Observation</td>
						<td rowspan="4" class="verticalText">Documentation</td>
						<td rowspan="4" class="verticalText">Management</td>
						<td rowspan="4" class="verticalText">Union</td>
						<td rowspan="4" class="verticalText">Worker</td>
						<td rowspan="4" class="verticalText">Other</td>
						<!--
						<td rowspan="4" class="verticalText">Ob</td>
						<td rowspan="4" class="verticalText">Do</td>
						<td rowspan="4" class="verticalText">Ma</td>
						<td rowspan="4" class="verticalText">Un</td>
						<td rowspan="4" class="verticalText">Wo</td>
						<td rowspan="4" class="verticalText">Ot</td>
						
						-->
					
					</tr>
					<tr>
						<td rowspan="3" class="boldText">Finding</td>
						<td rowspan="3" ><?=$ans['AnswerText']?></td>
						
					</tr>
					<tr>			
					</tr>
					<tr>
					</tr>
					<tr>
						<td style="broder-top:0"></td>
						<td style="broder-top:0"></td>
						<td title="<?=$o?>" ><?=$o?></td>
						<td  ><?=$d?></td>
						<td ><?=$m?></td>
						<td ><?=$u?></td>
						<td ><?=$w?></td>
						<td ><?=$ot?></td>
					</tr>
								
					<tr>
						<td class="boldText">Citation</td>
						<td colspan="7"><?=$question['citation']?></td>
					</tr>
					
				</table>
				<br/><br/>
				
				<?
				
			}
		}
	}
	?>
	<div style="margin-left:20px;color:rgb(193, 0, 0)" class="reportTitle">4.	Annex 1 - Photos<br/><br/></div>
	<div style="margin-left:20px;color:rgb(193, 0, 0)" class="reportTitle">5.	Annex 1 - Graphs<br/><br/></div>
</div>