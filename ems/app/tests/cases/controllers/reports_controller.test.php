<?php
/* Reports Test cases generated on: 2010-08-10 09:08:28 : 1281431728*/
App::import('Controller', 'Reports');

class TestReportsController extends ReportsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class ReportsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.report');

	function startTest() {
		$this->Reports =& new TestReportsController();
		$this->Reports->constructClasses();
	}

	function endTest() {
		unset($this->Reports);
		ClassRegistry::flush();
	}

}
?>