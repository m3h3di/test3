<?php
/* Section Test cases generated on: 2010-12-02 08:12:34 : 1291278454*/
App::import('Model', 'Section');

class SectionTestCase extends CakeTestCase {
	var $fixtures = array('app.section', 'app.question');

	function startTest() {
		$this->Section =& ClassRegistry::init('Section');
	}

	function endTest() {
		unset($this->Section);
		ClassRegistry::flush();
	}

}
?>