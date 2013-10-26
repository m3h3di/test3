<style>
.singleQuestionWrapper{padding:5px;margin:0 0 10px 0}
.singleQuestionWrapper:hover{background:RGB(203,232,246)}
.singleQuestion{background:#ffffff;margin:5px;border:1px solid #999;border-radius:8px;-moz-border-radius:8px;-webkit-border-radius:8px;padding:10px}

.mainQuestion{color:#333;font-weight:bold;font-size:12px;padding:5px 0 0 0;}
.singleQuestionLeft{margin:10px 0 0 0;float:left;width:45%}
.qFindings{width:100%;margin:10px 0 0 0;height:122px}
.qFindings.support{height:82px}
fieldset{width:90%;}
input{margin-top:3px}
.popupHelp{position:fixed; width:800px;display:none;top:20px;left:300px;background:#fff;border:2px solid #000;text-align:left}
.helpNote{white-space:pre-line;padding:20px}
.closePopup{text-align:right;margin-right:5px;cursor:pointer}
h3{padding:0;margin:10px 20px}
.helpButton{cursor:pointer}
.indication{color: #000000;font-weight: bold;padding: 6px 11px;cursor:pointer}
</style>
<?php  echo $javascript->link('jquery.min.js'); 
$webRoot = $this->webroot;
?>

<script type="text/javascript">
function autoPing(){
	//var beshtoUrl = "<?= $webRoot?>surveys/ping";			
	var beshtoUrl = "<?= $webRoot?>users/home";			
	$.ajax({
	 	type: "POST",		 	
		url: beshtoUrl,			 
		data: {security:"m3h3di"},

		cache: false,
		//dataType: "json",			  
		success: function(data) {		
			
		},
		error: function () {
			//window.location.reload();
        }
  	});
	
}

function autoPingFront(){
	setInterval(function() { 
		autoPing();
	}, 30000);
}




$(function() {
	//autoPing so that system does kick user out
	setTimeout(function(){
		autoPingFront();
	}, 30000);
	
	
	
	$('#SurveyNewdataForm').submit(function(){
		//alert('Handler for .submit() called.');
		//$('input.inputRadio').each(function() { // find unique names
			  //alert($(this).attr('checked'));
			  
			  //alert($(this).attr('name'));
		//});
		//var rGroup = "data[1][AnswerYesNo]";
		//alert($("input[name="+rGroup+"]:checked").val());
		
		var surveyDate = $(".surveydate").val();
		$("input.singleSD").val(surveyDate);
		
		var conf = confirm("Are you sure about surveyDate "+surveyDate+"?");
		if(conf == true){
			//alert("OK... you chose to proceed with deletion of "+x);
			return true;
		}
		else return false;
	
	});
	
});

function psq(){
	$(".factGathering").slideToggle();
}

function changeColor(id,yes){
	if(yes)	$("#q"+id).css("backgroundColor","RGB(209,236,201)");
	else $("#q"+id).css("backgroundColor","RGB(245,204,202)");
}

function writeTa(obj,qId,ans){
	var taId =  "#ta"+qId;
	var taDisplayId =  "#taDisplay"+qId;
	if( $(obj).is(':checked') ){
		//$(taId).append('['+ans+']');
		
		var tmp = '['+ans+']';
		if($(taId).val()) tmp = ',['+ans+']';
		
		var newValue = $(taId).val()+tmp;
		$(taId).text( newValue );
		$(taDisplayId).text( newValue );
		
	}
	else{
		var oldValue = $(taId).val();
	
		var tmp = ',['+ans+']';
		var oldValue = oldValue.replace(tmp, '');
		
		var tmp = '['+ans+'],';
		var oldValue = oldValue.replace(tmp, '');
		
		var tmp = '['+ans+']';
		var newValue = oldValue.replace(tmp, '');
		
		$(taId).text( newValue );
		$(taDisplayId).text( newValue );

	}
}

function popupHelp(id){
	$("div.popupHelp").hide();
	var pupupId = "#"+id;
	$(pupupId).slideDown();
}
$(function() {
	$("div.closePopup").click(function() {
		$("div.popupHelp").hide();
	});
});
</script>





<?php
$sections = array("General Facility Information","ETP/Wastewater Treatment Control","Wastewater Sludge","Air Emission","Noise/Sound","Solid/Hazardous Waste","Chemicals/Hazardous Materials","Sewage/Septic System","Spills/Site Contamination","Spill Prevention and Contingency Preparedness Plan","Emergency Response Plan","Environmental Awareness and Training","Cleaner Production","Environmental Management Systems (EMS)");

echo '<pre style="text-align:left">';
//print_r($clusters);
//print_r($questions);
echo "</pre>";

echo $form->create('Survey', array('action' => 'newdata','name'=>'data'));
?>

<h2>Mendatory Field</h2>
<div class="singleQuestionWrapper">
	<div class="singleQuestion">
		<div class="mainQuestion">Survey Information</div>
		<div class="singleQuestionLeft">
			<fieldset>
			<legend>Servey Date</legend>
			<input type="text" class="surveydate" value="dd/mm/yy" style="width:100%;margin-top:10px;padding:5px" />
			
			</fieldset>
		</div>
		<div class="singleQuestionLeft">
			<fieldset>
			<legend>Servey Number</legend>
			<select name="surveyNo" style="width:100%;margin-top:10px">
				<option value="<?= $surveyNo?>">Survey-<?= $surveyNo?></option>
				
			</select>
			</fieldset>
		</div>
		<div style="clear:both"></div>
	</div>
</div>

<h2>Data Entry</h2>

<div class="indication">
	<span onclick="javascript:psq()">Pre-Assessment Questionaire</span>
</div>
<div class="factGathering" style="">
<?php

$i = 1;
foreach($questions as $key=>$val){
	$cluster= $val['Cluster'];
	if($cluster['id']!=10) continue;
	$question= $val['Question'];
	$mc=$val['Answer'];
		?>
		<div class="singleQuestionWrapper">
			<input type="hidden" name="data[<?= $question['id'] ?>][factory_id]" value="<?= $factory_id ?>" />
			<input type="hidden" name="data[<?= $question['id'] ?>][question_id]" value="<?= $question['id'] ?>" />
			<input type="hidden" name="data[<?= $question['id'] ?>][cluster_id]" value="<?= $cluster['id'] ?>" />
			<input type="hidden" name="data[<?= $question['id'] ?>][status]" value="<?=$surveyNo ?>" />
			<input type="hidden" name="data[<?= $question['id'] ?>][survey_date]" class="singleSD" />
			
		
			<div class="singleQuestion" id="q<?= $question['id']?>">
				<div><?= $cluster['name'] ?></div>
				<div class="mainQuestion"><?= $i++ .". ". $question['text'] ?></div>
				<div class="singleQuestionLeft">
					<fieldset>
						<legend>Findings</legend>
						<?php
						//print_r($question);
						if($question['question_type'] == "Fact-Gathering"){ ?>
							<input type="hidden" name="data[<?= $question['id'] ?>][QuestionType]" value="FactGathering" />	<?php
							if(!empty($mc)){
							?>
								<div style="float:left;padding-top:10px;width:50%">
									<?php foreach($mc as $k=>$v){
									$mcAns = $v['answer'];
									$mcAnsId = $v['id'];
									?>
									<input onclick="javascript:writeTa(this,<?= $question['id'] ?>,'<?=$mcAns ?>')" type="checkbox" value="true"> <?=$mcAns?> <br/>
									<?php
									}
									?>
									
								</div>
								<div style="float:right">
									<textarea disabled id="taDisplay<?=$question['id'] ?>" class="qFindings"></textarea>
									<textarea style="display:none" id="ta<?=$question['id'] ?>" name="data[<?= $question['id'] ?>][AnswerText]" class="qFindings"></textarea>
								</div>
								<div style="clear:both"></div>
							<?
							}
							else if($question['type'] == 1){
							?>
								<div style="float:left;padding-top:10px;width:50%">
									
									<input onclick="javascript:writeTa(this,<?= $question['id'] ?>,'yes')" type="checkbox" value="yes"> yes <br/>
									<input onclick="javascript:writeTa(this,<?= $question['id'] ?>,'no')" type="checkbox" value="no"> no <br/>
									<input onclick="javascript:writeTa(this,<?= $question['id'] ?>,'NA')" type="checkbox" value="NA"> NA <br/>
									
								</div>
								<div style="float:right">
									<textarea disabled id="taDisplay<?=$question['id'] ?>" class="qFindings"></textarea>
									<textarea style="display:none" id="ta<?=$question['id'] ?>" name="data[<?= $question['id'] ?>][AnswerText]" class="qFindings"></textarea>
								</div>
								<div style="clear:both"></div>
							<?
							}
							else{
							?>
								<textarea name="data[<?= $question['id'] ?>][AnswerText]" class="qFindings"></textarea>
							<?
							}
						}
						else{
						?>
							<input type="hidden" name="data[<?= $question['id'] ?>][QuestionType]" value="Compliance" />
							<div style="padding:10px 0 0 0;text-align:center;height:145px">
								<?php
								if($question['non-Compliance']){ ?>
									<input type="hidden" name="data[<?= $question['id'] ?>][CompliantAnswer]" value="false" />
									<input class="inputRadio" type="radio" name="data[<?= $question['id'] ?>][AnswerYesNo]" onclick="javascript:changeColor(<?= $question['id'] ?>,0)" value="true"> yes
									<input class="inputRadio" type="radio" name="data[<?= $question['id'] ?>][AnswerYesNo]" onclick="javascript:changeColor(<?= $question['id'] ?>,1)" value="false"> No
									<br/><br/>
									NC=Y
								<?php
								}
								else { ?>
									<input type="hidden" name="data[<?= $question['id'] ?>][CompliantAnswer]" value="true" />
									<input class="inputRadio" type="radio" name="data[<?= $question['id'] ?>][AnswerYesNo]" onclick="javascript:changeColor(<?= $question['id'] ?>,1)"  value="true"> yes
									<input class="inputRadio" type="radio" name="data[<?= $question['id'] ?>][AnswerYesNo]" onclick="javascript:changeColor(<?= $question['id'] ?>,0)" value="false"> No
									<br/><br/>
									NC=N
								<? } ?>								
								<textarea class="qFindings support" style="" name="data[<?= $question['id'] ?>][AnswerText]"></textarea>
							</div>
							
						<?php
						}
						?>
						
						
					</fieldset>
				</div>
				
				<?php
				if($question['question_type'] != "Fact-Gathering"){ ?>
				<div style="width:10%;margin:20px 0 0 0;float:left;text-align:center">
					<div>
						<span class="helpButton" onclick="javascript:popupHelp('guide<?=$question['id']?>')">
						<?php
						echo $html->image('guide.png', array('alt' => 'catagory','border'=>'0') );
						?>
						</span>
					</div>
					<div id="guide<?=$question['id']?>" class="popupHelp" style="">
							<div class="closePopup">x</div>
							<h3>Guidance Note For Question-<?=$question['id'];?></h3>
							<div class="helpNote">
							<?= $question['guidance_note']; ?>
							</div>
					</div>
					
					<div style="margin:20px 0" class="helpButton">
						<span onclick="javascript:popupHelp('issue<?=$question['id']?>')">
						<?php
						echo $html->image('issue.png', array('alt' => 'catagory','border'=>'0') );
						?>
						</span>
					</div>
					<div id="issue<?=$question['id']?>" class="popupHelp" style="">
							<div class="closePopup">x</div>
							<h3>Issue  For Question-<?=$question['id'];?></h3>
							<div  class="helpNote" style="">
							<?= $question['issue']; ?>
							</div>
							<h3>Outcome</h3>
							<div  class="helpNote">
							<?= $question['outcome']; ?>
							</div>
					</div>
					
					<div class="helpButton">
						<span onclick="javascript:popupHelp('citation<?=$question['id']?>')">
						<?php
						echo $html->image('citation.png', array('alt' => 'catagory','border'=>'0') );
						?>
						</span>
					</div>
					<div id="citation<?=$question['id']?>" class="popupHelp" style="">
							<div class="closePopup">x</div>
							<h3>Citation from Vietnamese Laws / Regulations  For Question-<?=$question['id'];?></h3>
							<div class="helpNote">
							<?= $question['citation']; ?>
							</div>
							<h3>Citation from IFC Regulations</h3>
							<div  class="helpNote">
							<?= $question['ifc_guidline']; ?>
							</div>
					</div>
					
				</div>
				<?php
				}
				?>
				<div class="singleQuestionLeft">
					<fieldset>
						
						
						
						
						<legend>Supporting Information</legend>
						<textarea class="qFindings support" name="data[<?= $question['id'] ?>][PersonalNotes]"></textarea>
						<?php
						if($question['question_type'] != "Fact-Gathering"){ ?>
						<div style="padding:5px 0 0 0">Level of difficulty: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="radio" name="data[<?= $question['id'] ?>][lod]" value="low"> low
							<input type="radio" name="data[<?= $question['id'] ?>][lod]" value="medium"> medium
							<input type="radio" name="data[<?= $question['id'] ?>][lod]" value="high"> high
						</div>
						<?php
						}
						?>
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
</div>

<!-- ################################################################## -->
<div class="indication">Compliance Questionaire</div>
<?php

$i = 1;
foreach($questions as $key=>$val){
	$cluster= $val['Cluster'];
	if($cluster['id'] == 10) continue;
	$question= $val['Question'];
	$mc=$val['Answer'];
		?>
		<div class="singleQuestionWrapper">
			<input type="hidden" name="data[<?= $question['id'] ?>][factory_id]" value="<?= $factory_id ?>" />
			<input type="hidden" name="data[<?= $question['id'] ?>][question_id]" value="<?= $question['id'] ?>" />
			<input type="hidden" name="data[<?= $question['id'] ?>][cluster_id]" value="<?= $cluster['id'] ?>" />
			<input type="hidden" name="data[<?= $question['id'] ?>][status]" value="<?=$surveyNo ?>" />
			<input type="hidden" name="data[<?= $question['id'] ?>][survey_date]" class="singleSD" />
		
			<div class="singleQuestion" id="q<?= $question['id']?>">
				<div><?= $cluster['name'] ?></div>
				<div class="mainQuestion"><?= $i++ .". ". $question['text'] ?></div>
				<div class="singleQuestionLeft">
					<fieldset>
						<legend>Findings</legend>
						<?php
						//print_r($question);
						if($question['question_type'] == "Fact-Gathering"){ ?>
							<input type="hidden" name="data[<?= $question['id'] ?>][QuestionType]" value="FactGathering" />	<?php
							if(!empty($mc)){
							?>
								<div style="float:left;padding-top:10px;width:50%">
									<?php foreach($mc as $k=>$v){
									$mcAns = $v['answer'];
									$mcAnsId = $v['id'];
									?>
									<input onclick="javascript:writeTa(this,<?= $question['id'] ?>,'<?=$mcAns ?>')" type="checkbox" value="true"> <?=$mcAns?> <br/>
									<?php
									}
									?>
									
								</div>
								<div style="float:right">
									<textarea disabled id="taDisplay<?=$question['id'] ?>" class="qFindings"></textarea>
									<textarea style="display:none" id="ta<?=$question['id'] ?>" name="data[<?= $question['id'] ?>][AnswerText]" class="qFindings"></textarea>
								</div>
								<div style="clear:both"></div>
							<?
							}
							else if($question['type'] == 1){
							?>
								<div style="float:left;padding-top:10px;width:50%">
									
									<input onclick="javascript:writeTa(this,<?= $question['id'] ?>,'yes')" type="checkbox" value="yes"> yes <br/>
									<input onclick="javascript:writeTa(this,<?= $question['id'] ?>,'no')" type="checkbox" value="no"> no <br/>
									<input onclick="javascript:writeTa(this,<?= $question['id'] ?>,'NA')" type="checkbox" value="NA"> NA <br/> 
									
								</div>
								<div style="float:right">
									<textarea disabled id="taDisplay<?=$question['id'] ?>" class="qFindings"></textarea>
									<textarea style="display:none" id="ta<?=$question['id'] ?>" name="data[<?= $question['id'] ?>][AnswerText]" class="qFindings"></textarea>
								</div>
								<div style="clear:both"></div>
							<?
							}
							else{
							?>
								<textarea name="data[<?= $question['id'] ?>][AnswerText]" class="qFindings"></textarea>
							<?
							}
						}
						else{
						?>
							<input type="hidden" name="data[<?= $question['id'] ?>][QuestionType]" value="Compliance" />
							<div style="padding:10px 0 0 0;text-align:center;height:145px">
								<?php
								if($question['non-Compliance']){ ?>
									<input type="hidden" name="data[<?= $question['id'] ?>][CompliantAnswer]" value="false" />
									<input class="inputRadio" type="radio" name="data[<?= $question['id'] ?>][AnswerYesNo]" onclick="javascript:changeColor(<?= $question['id'] ?>,0)" value="true"> yes
									<input class="inputRadio" type="radio" name="data[<?= $question['id'] ?>][AnswerYesNo]" onclick="javascript:changeColor(<?= $question['id'] ?>,1)" value="false"> No
									<input class="inputRadio" type="radio" name="data[<?= $question['id'] ?>][AnswerYesNo]"  value="NA"> NA
									<br/><br/>
									NC=Y
								<?php
								}
								else { ?>
									<input type="hidden" name="data[<?= $question['id'] ?>][CompliantAnswer]" value="true" />
									<input class="inputRadio" type="radio" name="data[<?= $question['id'] ?>][AnswerYesNo]" onclick="javascript:changeColor(<?= $question['id'] ?>,1)"  value="true"> yes
									<input class="inputRadio" type="radio" name="data[<?= $question['id'] ?>][AnswerYesNo]" onclick="javascript:changeColor(<?= $question['id'] ?>,0)" value="false"> No
									<input class="inputRadio" type="radio" name="data[<?= $question['id'] ?>][AnswerYesNo]"  value="NA"> NA
									<br/><br/>
									NC=N
								<? } ?>								
								<textarea class="qFindings support" style="" name="data[<?= $question['id'] ?>][AnswerText]"></textarea>
							</div>
							
						<?php
						}
						?>
						
						
					</fieldset>
				</div>
				
				<?php
				if($question['question_type'] != "Fact-Gathering"){ ?>
				<div style="width:10%;margin:20px 0 0 0;float:left;text-align:center">
					<div>
						<span class="helpButton" onclick="javascript:popupHelp('guide<?=$question['id']?>')">
						<?php
						echo $html->image('guide.png', array('alt' => 'catagory','border'=>'0') );
						?>
						</span>
					</div>
					<div id="guide<?=$question['id']?>" class="popupHelp" style="">
							<div class="closePopup">x</div>
							<h3>Guidance Note For Question-<?=$question['id'];?></h3>
							<div class="helpNote">
							<?= $question['guidance_note']; ?>
							</div>
					</div>
					
					<div style="margin:20px 0" class="helpButton">
						<span onclick="javascript:popupHelp('issue<?=$question['id']?>')">
						<?php
						echo $html->image('issue.png', array('alt' => 'catagory','border'=>'0') );
						?>
						</span>
					</div>
					<div id="issue<?=$question['id']?>" class="popupHelp" style="">
							<div class="closePopup">x</div>
							<h3>Issue  For Question-<?=$question['id'];?></h3>
							<div  class="helpNote" style="">
							<?= $question['issue']; ?>
							</div>
							<h3>Outcome</h3>
							<div  class="helpNote">
							<?= $question['outcome']; ?>
							</div>
					</div>
					
					<div class="helpButton">
						<span onclick="javascript:popupHelp('citation<?=$question['id']?>')">
						<?php
						echo $html->image('citation.png', array('alt' => 'catagory','border'=>'0') );
						?>
						</span>
					</div>
					<div id="citation<?=$question['id']?>" class="popupHelp" style="">
							<div class="closePopup">x</div>
							<h3>Citation from Vietnamese Laws / Regulations  For Question-<?=$question['id'];?></h3>
							<div class="helpNote">
							<?= $question['citation']; ?>
							</div>
							<h3>Citation from IFC Regulations</h3>
							<div  class="helpNote">
							<?= $question['ifc_guidline']; ?>
							</div>
					</div>
					
				</div>
				<?php
				}
				?>
				<div class="singleQuestionLeft">
					<fieldset>
						<div>
							<div style="float:left;padding:10px 0 0 0">
								<input type="checkbox" name="data[<?= $question['id'] ?>][Observation]" value="true"> Observation
								<input type="checkbox" name="data[<?= $question['id'] ?>][Documentation]" value="true"> Document
								<input type="checkbox" name="data[<?= $question['id'] ?>][Interview]" value="true"> Interview
							</div>
							
							<div style="float:right">
								<input type="checkbox" name="data[<?= $question['id'] ?>][InterviewWithUnion]" value="true"> Union <br/>
								<input type="checkbox" name="data[<?= $question['id'] ?>][InterviewWithOther]" value="true"> Other
							</div>
							<div style="float:right;margin-right:10px">
								<input type="checkbox" name="data[<?= $question['id'] ?>][InterviewWithManagement]" value="true"> Management<br/>
								<input type="checkbox" name="data[<?= $question['id'] ?>][InterviewWithWorker]" value="true"> Worker 
							</div>
							
							
							<div style="clear:both"></div>
						</div>
						
						
						
						<legend>Supporting Information</legend>
						<textarea class="qFindings support" name="data[<?= $question['id'] ?>][PersonalNotes]"></textarea>
						<?php
						if($question['question_type'] != "Fact-Gathering"){ ?>
						<div style="padding:5px 0 0 0">Level of difficulty: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="radio" name="data[<?= $question['id'] ?>][lod]" value="low"> low
							<input type="radio" name="data[<?= $question['id'] ?>][lod]" value="medium"> medium
							<input type="radio" name="data[<?= $question['id'] ?>][lod]" value="high"> high
						</div>
						<?php
						}
						?>
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