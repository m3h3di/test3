<?php


$clusterData = "";
$FGQuestion = "";
$ComQuestion = "";

echo '<pre style="text-align:left">';
//print_r($clusters) ;
echo "</pre>";

$i = 1 ; 
foreach($clusters as $key=>$value){
	$cluster = $value['Cluster'];
	if($cluster['id'] !=1) continue;
	$questions = $value['Question'];

	$FGQuestion = "";
	$ComQuestion = "";
	foreach($questions as $qKey => $question){
		$txt = strip_tags(str_replace("&", "And", $question['text']));

		if($question['question_type']=="Fact-Gathering"){
			$FGQuestion.='
     <FactGatheringQuestions>
      <QuestionID>'.$question["id"].'</QuestionID>
      <OrderNo>'.$i++.'</OrderNo>
      <QuestionType>FactGathering</QuestionType>
      <CompliantAnswer xsi:nil="true" />
      <IsSeverityIndex>false</IsSeverityIndex>
      <IsBookmarked>false</IsBookmarked>
      <Documentation>false</Documentation>
      <InterviewWithWorker>true</InterviewWithWorker>
      <InterviewWithUnion>false</InterviewWithUnion>
      <InterviewWithOther>false</InterviewWithOther>
      <InterviewWithManagement>false</InterviewWithManagement>
      <Interview>false</Interview>
      <Observation>true</Observation>
      <QuestionTranslations>
        <LanguageText>English</LanguageText>
        <LanguageID>2</LanguageID>
        <Text>'.$txt.'</Text>
        <Finding>test '.$question["finding"].'</Finding>
		<GuidanceNote>test '.$question["guidance_note"].'</GuidanceNote>
      </QuestionTranslations>
    </FactGatheringQuestions>';
		}
		else{
			$nc = "true";
			if($question["non-Compliance"]) $nc= "false";
			 $ComQuestion.='
       <Questions>
        <QuestionID>'.$question["id"].'</QuestionID>
        <OrderNo>'.$i++.'</OrderNo>
        <QuestionType>Compliance</QuestionType>
        <CompliantAnswer>'.$nc.'</CompliantAnswer>
        <IsSeverityIndex>false</IsSeverityIndex>
        <IsBookmarked>false</IsBookmarked>
        <Documentation>false</Documentation>
        <InterviewWithWorker>false</InterviewWithWorker>
        <InterviewWithUnion>false</InterviewWithUnion>
        <InterviewWithOther>false</InterviewWithOther>
        <InterviewWithManagement>false</InterviewWithManagement>
        <Interview>false</Interview>
        <Observation>false</Observation>
        <QuestionTranslations>
          <LanguageText>English</LanguageText>
          <LanguageID>2</LanguageID>
          <Text>'.$txt.'</Text>
          <Finding>test '.$question["finding"].'</Finding>
          <GuidanceNote>test '.$question["guidance_note"].'</GuidanceNote>
          <ReferenceNote>test '.$question["legal_basis"].'</ReferenceNote>
        </QuestionTranslations>
      </Questions>';
		}
	}
	if(!empty($ComQuestion) ){
		$ComQuestion = '
	<CompliancePoints>
      <CompliancePointID>'.$cluster["id"].'</CompliancePointID>'.$ComQuestion.'      
      <CompliancePointTranslations>
        <LanguageID>2</LanguageID>
        <CompliancePointName>'.$cluster["name"].$cluster["id"].'</CompliancePointName>
      </CompliancePointTranslations>
    </CompliancePoints>';
	}
	
	$clusterData .='
   <Clusters>
    <ClusterID>'.$cluster["id"].'</ClusterID>
    <ClusterTranslations>
      <LanguageID>2</LanguageID>
      <ClusterName>'.$cluster["name"].'</ClusterName>
    </ClusterTranslations>
    <IsFundamentalPrinciple>false</IsFundamentalPrinciple>'.$FGQuestion.$ComQuestion.'
   </Clusters>';
}


$xmlData = '<?xml version="1.0" encoding="utf-16"?>
<Questionnaire xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">
  <FormatVersion>1</FormatVersion>
  <AssessmentDate>0001-01-01</AssessmentDate>
  <TemplateQuestionnaireID>141</TemplateQuestionnaireID>
  <GeneratedQuestionnaireID>1407</GeneratedQuestionnaireID>
  <ReferenceNo>VNCATMAR2012V1</ReferenceNo>
  <RevisionNo>1</RevisionNo>
  <TemplateName>VN CAT MAR 2012 V1</TemplateName>
  <IsicCode>
    <IsicCodeID>15</IsicCodeID>
    <IsicCategory>C</IsicCategory>
    <IsicCodeNumber>0</IsicCodeNumber>
    <IsicCodeTranslations>
      <LanguageID>2</LanguageID>
      <IsicCategoryDescription>Manufacturing</IsicCategoryDescription>
      <IsicCodeDescription>Manufacture of wearing apparel</IsicCodeDescription>
    </IsicCodeTranslations>
  </IsicCode>
  <Organization>
    <OrganizationID>16</OrganizationID>
    <OrganizationName>VN09002USV - United Sweetheart</OrganizationName>
    <Address>Road No. 10, Nhon Trach 1 Industrial Zone, Nhon Trach district</Address>
    <City>Dong Nai province</City>
    <ContactName>Chua Bee Leng</ContactName>
    <Country>
      <CountryID>485</CountryID>
      <CountryName>Vietnam</CountryName>
    </Country>
    <Email>agneschua@mweusg.com</Email>
    <OfficeNumber>061 3560 706</OfficeNumber>
    <FaxNumber>061 3560 709</FaxNumber>
    <CoordinatesX>0.000000</CoordinatesX>
    <CoordinatesY>0.000000</CoordinatesY>
  </Organization>
  <FirstAdvisorUserProfile>
    <UserProfileID>454</UserProfileID>
    <Title>Mr</Title>
    <FirstName>Alan</FirstName>
    <LastName>Mc Kernan</LastName>
    <Email>alan.mckernan@ctp-consulting.com</Email>
  </FirstAdvisorUserProfile>
  <SecondAdvisorUserProfile>
    <UserProfileID>470</UserProfileID>
    <Title>Ms</Title>
    <FirstName>Diep</FirstName>
    <LastName>Doan</LastName>
    <Email>diepdoan@betterwork.org</Email>
  </SecondAdvisorUserProfile>
  <GeneratedAtDate>2013-03-13</GeneratedAtDate>
  <StartDate>0001-01-01</StartDate>
  <EndDate>0001-01-01</EndDate>
  <Country>
    <CountryID>485</CountryID>
    <CountryName>Vietnam</CountryName>
  </Country>
  <Status>Active</Status>
  <ModifiedDate>2012-03-23</ModifiedDate>
  <ApproveDate>2012-03-23</ApproveDate>
  <ApproverUserProfile>
    <UserProfileID>4</UserProfileID>
    <Title>Ms</Title>
    <FirstName>Tara</FirstName>
    <LastName>Tangarajan</LastName>
    <Email>rangarajan@betterwork.org</Email>
  </ApproverUserProfile>'.$clusterData.'
  <QuestionnaireTranslations>
    <LanguageID>2</LanguageID>
  </QuestionnaireTranslations>
  <Languages>
    <LanguageID>2</LanguageID>
    <LanguageName>English</LanguageName>
    <CultureCode>en-US</CultureCode>
  </Languages>
</Questionnaire>
';

$ourFileName = "betterWork.star";
//$ourFileHandle = fopen($ourFileName, 'w') or die("can't open file");
file_put_contents($ourFileName, $xmlData);
//fclose($ourFileHandle);

?>

<h2>Download Questionnaire</h2>
<?php if($_POST){ ?>
<a href="/bw/betterWork.star">download</a>
<?php } ?>
<script src="/Scripts/jquery.validate.min.js" type="text/javascript"></script>
<script src="/Scripts/jquery.validate.unobtrusive.min.js" type="text/javascript"></script>



<form action="<?= $html->url('/') ?>users/download" method="post">
	<fieldset>
        <legend><span style="color: red; margin-left: -5px; margin-right: 5px; vertical-align: top;font-weight: bold">*</span> indicates a required field</legend>



        <div class="editor-label">
            <label for="SupplierID">Factory Name</label>
            <label class="required-mark">&#160;*</label>
        </div>
        <div class="editor-field">
            <select data-val="true" data-val-number="The field Factory ID Number must be a number." data-val-required="The Factory ID Number field is required." id="SupplierID" name="SupplierID" onchange="this.form.submit();">
				<option value="">Please select...</option>
				<?php
				foreach($factories[0]['Factory'] as $factory){
					echo '<option value="'.$factory["id"].'">'.$factory["factory_name"].'</option>';
				}
				?>
			</select>
            <span class="field-validation-valid" data-valmsg-for="SupplierID" data-valmsg-replace="true"></span>
        </div>


        <p>
            <input type="submit" name="btnSubmit" value="Save" />
            <input type="submit" name="btnCancel" class="cancel" value="Cancel" />
        </p>
    </fieldset>
</form>

