<?php
/* Surveyors Test cases generated on: 2010-07-24 00:07:17 : 1279932497*/
App::import('Controller', 'Surveyors');

class TestSurveyorsController extends SurveyorsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class SurveyorsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.surveyor', 'app.facility');

	function startTest() {
		$this->Surveyors =& new TestSurveyorsController();
		$this->Surveyors->constructClasses();
	}

	function endTest() {
		unset($this->Surveyors);
		ClassRegistry::flush();
	}

}
?>