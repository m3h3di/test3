<?php
/* Report Test cases generated on: 2010-08-10 09:08:16 : 1281431596*/
App::import('Model', 'Report');

class ReportTestCase extends CakeTestCase {
	var $fixtures = array('app.report');

	function startTest() {
		$this->Report =& ClassRegistry::init('Report');
	}

	function endTest() {
		unset($this->Report);
		ClassRegistry::flush();
	}

}
?>