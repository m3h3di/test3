<?php
/* Followup Test cases generated on: 2011-10-24 21:10:41 : 1319491001*/
App::import('Model', 'Followup');

class FollowupTestCase extends CakeTestCase {
	var $fixtures = array('app.followup');

	function startTest() {
		$this->Followup =& ClassRegistry::init('Followup');
	}

	function endTest() {
		unset($this->Followup);
		ClassRegistry::flush();
	}

}
?>