<?php
/* Surveyor Test cases generated on: 2010-07-24 00:07:53 : 1279932413*/
App::import('Model', 'Surveyor');

class SurveyorTestCase extends CakeTestCase {
	var $fixtures = array('app.surveyor', 'app.facility');

	function startTest() {
		$this->Surveyor =& ClassRegistry::init('Surveyor');
	}

	function endTest() {
		unset($this->Surveyor);
		ClassRegistry::flush();
	}

}
?>