<?php
/* Question Test cases generated on: 2010-12-02 08:12:53 : 1291278533*/
App::import('Model', 'Question');

class QuestionTestCase extends CakeTestCase {
	var $fixtures = array('app.question', 'app.section');

	function startTest() {
		$this->Question =& ClassRegistry::init('Question');
	}

	function endTest() {
		unset($this->Question);
		ClassRegistry::flush();
	}

}
?>