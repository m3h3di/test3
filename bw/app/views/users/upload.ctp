<?php
//$xml = simplexml_load_string($xmlstring);
//$json = json_encode($xml);
//$array = json_decode($json,TRUE);
?>













<h2>Upload Questionnaire</h2>
<script src="/Scripts/jquery.validate.min.js" type="text/javascript"></script>
<script src="/Scripts/jquery.validate.unobtrusive.min.js" type="text/javascript"></script>


<form action="<?= $html->url('/') ?>users/upload" method="post">
	<fieldset>
        <legend><span style="color: red; margin-left: -5px; margin-right: 5px; vertical-align: top;font-weight: bold">*</span> indicates a required field</legend>

        <div class="editor-label"><label for="StarFile">Completed Questionnaire</label> <label class="required-mark">&#160;*</label></div><div class="editor-field"><input type="file" name="StarFile" id="StarFile" /> <span class="field-validation-valid" data-valmsg-for="StarFile" data-valmsg-replace="true"></span></div>
        <div class="editor-label"><label for="StartDate">Assessment Start Date</label> <label class="required-mark">&#160;*</label></div><div class="editor-field">
<input class="k-input" data-val="true" data-val-required="The Assessment Start Date field is required." id="StartDate" name="StartDate" type="date" value="13-03-2013" /><script>
	jQuery(function(){jQuery("#StartDate").kendoDatePicker({"format":"dd-MM-yyyy","min":new Date(1900,0,1,0,0,0,0),"max":new Date(2099,11,31,0,0,0,0)});});
</script> <span class="field-validation-valid" data-valmsg-for="StartDate" data-valmsg-replace="true"></span></div>
        <div class="editor-label"><label for="EndDate">Assessment End Date</label> <label class="required-mark">&#160;*</label></div><div class="editor-field">
<input class="k-input" data-val="true" data-val-required="The Assessment End Date field is required." id="EndDate" name="EndDate" type="date" value="13-03-2013" /><script>
	jQuery(function(){jQuery("#EndDate").kendoDatePicker({"format":"dd-MM-yyyy","min":new Date(1900,0,1,0,0,0,0),"max":new Date(2099,11,31,0,0,0,0)});});
</script> <span class="field-validation-valid" data-valmsg-for="EndDate" data-valmsg-replace="true"></span></div>

        <p>
            <input name="btnSubmit" type="submit" value="Completion Check"></input>
            <input class="cancel" name="btnCancel" type="submit" value="Cancel"></input>
            <input class="cancel" name="btnClearForm" type="submit" value="Clear Form"></input>
        </p>
    </fieldset>
</form>

