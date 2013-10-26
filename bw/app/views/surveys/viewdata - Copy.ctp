<style>
.singleQuestionWrapper{padding:5px;margin:0 0 10px 0}
.singleQuestionWrapper:hover{background:RGB(203,232,246)}
.singleQuestion{background:#ffffff;margin:5px;border:1px solid #999;border-radius:8px;-moz-border-radius:8px;-webkit-border-radius:8px;padding:10px}

.mainQuestion{color:#333;font-weight:bold;font-size:12px;padding:5px 0 0 0;}
.singleQuestionLeft{margin:10px 0 0 0;float:left;width:50%}
.qFindings{width:100%;margin:10px 0 0 0;height:145px}
.qFindings.support{height:100px}
fieldset{width:90%;}
input{margin-top:3px}
</style>
<?php  echo $javascript->link('jquery.min.js'); ?>
<script type="text/javascript">
function changeColor(id,yes){
	if(yes)	$("#q"+id).css("backgroundColor","RGB(209,236,201)");
	else $("#q"+id).css("backgroundColor","RGB(245,204,202)");
}
</script>


<?php
$sections = array("General Facility Information","ETP/Wastewater Treatment Control","Wastewater Sludge","Air Emission","Noise/Sound","Solid/Hazardous Waste","Chemicals/Hazardous Materials","Sewage/Septic System","Spills/Site Contamination","Spill Prevention and Contingency Preparedness Plan","Emergency Response Plan","Environmental Awareness and Training","Cleaner Production","Environmental Management Systems (EMS)");

echo '<pre style="text-align:left">';
//print_r($clusters);
echo "</pre>";

echo $form->create('Survey', array('action' => 'newdata','name'=>'data'));
?>

<h2>Survey Data</h2>
<?php

$i = 1;
foreach($surveyData as $key=>$val){
	$cluster= $val['Cluster'];
	$question = $val['Question'];
	$ans = $val['SurveyData'];
		?>
		<div class="singleQuestionWrapper">
			<input type="hidden" name="data[<?= $question['id'] ?>][factory_id]" value="<?= $factory_id ?>" />
			<input type="hidden" name="data[<?= $question['id'] ?>][question_id]" value="<?= $question['id'] ?>" />
			<input type="hidden" name="data[<?= $question['id'] ?>][cluster_id]" value="<?= $cluster['id'] ?>" />
		
			<div class="singleQuestion" id="q<?= $question['id']?>">
				<div><?= $cluster['name'] ?></div>
				<div class="mainQuestion"><?= $i++ .". ". $question['text'] ?></div>
				<div class="singleQuestionLeft">
					<fieldset>
						<legend>Findings</legend>
						<?php
						if($question['question_type'] == "Fact-Gathering"){ ?>
							<input type="hidden" name="data[<?= $question['id'] ?>][QuestionType]" value="FactGathering" />
							<textarea disabled name="data[<?= $question['id'] ?>][AnswerText]" class="qFindings"><?= $ans['AnswerText']?></textarea>
						<?
						}
						else{
						?>
							<input type="hidden" name="data[<?= $question['id'] ?>][QuestionType]" value="Compliance" />
							<div style="padding:10px 0 0 0;text-align:center;height:145px">
								<?php
								if($question['non-Compliance']){ ?>
									<input  type="hidden" name="data[<?= $question['id'] ?>][CompliantAnswer]" value="false" />
									<input <? if($ans['AnswerYesNo'] == 'true') echo 'checked'; ?> disabled type="radio" name="data[<?= $question['id'] ?>][AnswerYesNo]" onclick="javascript:changeColor(<?= $question['id'] ?>,0)" value="true"> yes
									<input <? if($ans['AnswerYesNo'] == 'false') echo 'checked'; ?> disabled type="radio" name="data[<?= $question['id'] ?>][AnswerYesNo]" onclick="javascript:changeColor(<?= $question['id'] ?>,1)" value="false"> No
									<br/><br/><br/>
									NC=Y
								<?php
								}
								else { ?>
									<input type="hidden" name="data[<?= $question['id'] ?>][CompliantAnswer]" value="true" />
									<input <? if($ans['AnswerYesNo'] == 'true') echo 'checked'; ?> disabled type="radio" name="data[<?= $question['id'] ?>][AnswerYesNo]" onclick="javascript:changeColor(<?= $question['id'] ?>,1)"  value="true"> yes
									<input <? if($ans['AnswerYesNo'] == 'false') echo 'checked'; ?> disabled type="radio" name="data[<?= $question['id'] ?>][AnswerYesNo]" onclick="javascript:changeColor(<?= $question['id'] ?>,0)" value="false"> No
									<br/><br/><br/>
									NC=N
								<? } ?>								
								
							</div>
						<?php
						}
						?>
						
						
					</fieldset>
				</div>
				<div class="singleQuestionLeft">
					<fieldset>
						<div>
							<div style="float:left;padding:10px 0 0 0">
								<input <? if($ans['Observation']=='true') echo 'checked'?> disabled type="checkbox" name="data[<?= $question['id'] ?>][Observation]" value="true"> Observation
								<input <? if($ans['Documentation']=='true') echo 'checked'?> disabled type="checkbox" name="data[<?= $question['id'] ?>][Documentation]" value="true"> Document
								<input <? if($ans['Interview']=='true') echo 'checked'?> disabled type="checkbox" name="data[<?= $question['id'] ?>][Interview]" value="true"> Interview
							</div>
							
							<div style="float:right">
								<input <? if($ans['InterviewWithUnion']=='true') echo 'checked'?> disabled type="checkbox" name="data[<?= $question['id'] ?>][InterviewWithUnion]" value="true"> Union <br/>
								<input <? if($ans['InterviewWithOther']=='true') echo 'checked'?> disabled type="checkbox" name="data[<?= $question['id'] ?>][InterviewWithOther]" value="true"> Other
							</div>
							<div style="float:right;margin-right:10px">
								<input <? if($ans['InterviewWithManagement']=='true') echo 'checked'?> disabled type="checkbox" name="data[<?= $question['id'] ?>][InterviewWithManagement]" value="true"> Management<br/>
								<input <? if($ans['InterviewWithWorker']=='true') echo 'checked'?> disabled type="checkbox" name="data[<?= $question['id'] ?>][InterviewWithWorker]" value="true"> Worker 
							</div>
							
							
							<div style="clear:both"></div>
						</div>
						
						<legend>Supporting Information</legend>
						<textarea disabled class="qFindings support" name="data[<?= $question['id'] ?>][PersonalNotes]"><?=$ans['PersonalNotes']?></textarea>
					</fieldset>
				</div>
				<div style="clear:both"></div>
			</div>
		</div>
		<?php
		if($question['question_type'] == "Fact-Gathering"){
		}
		else{
		}
	
	
	
}
?>
<input type="submit" value="Save" />
</form>