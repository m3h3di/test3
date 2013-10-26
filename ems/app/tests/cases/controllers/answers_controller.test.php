<?php
/* Answers Test cases generated on: 2010-07-24 03:07:47 : 1279941167*/
App::import('Controller', 'Answers');

class TestAnswersController extends AnswersController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class AnswersControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.answer', 'app.question');

	function startTest() {
		$this->Answers =& new TestAnswersController();
		$this->Answers->constructClasses();
	}

	function endTest() {
		unset($this->Answers);
		ClassRegistry::flush();
	}

}
?>