<?php
/* GrAnsList Test cases generated on: 2011-03-09 09:03:24 : 1299664524*/
App::import('Model', 'GrAnsList');

class GrAnsListTestCase extends CakeTestCase {
	var $fixtures = array('app.gr_ans_list');

	function startTest() {
		$this->GrAnsList =& ClassRegistry::init('GrAnsList');
	}

	function endTest() {
		unset($this->GrAnsList);
		ClassRegistry::flush();
	}

}
?>