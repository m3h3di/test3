<?php
/* Companies Test cases generated on: 2011-02-07 19:02:42 : 1297106442*/
App::import('Controller', 'Companies');

class TestCompaniesController extends CompaniesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class CompaniesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.company', 'app.group');

	function startTest() {
		$this->Companies =& new TestCompaniesController();
		$this->Companies->constructClasses();
	}

	function endTest() {
		unset($this->Companies);
		ClassRegistry::flush();
	}

	function testIndex() {

	}

	function testView() {

	}

	function testAdd() {

	}

	function testEdit() {

	}

	function testDelete() {

	}

	function testAdminIndex() {

	}

	function testAdminView() {

	}

	function testAdminAdd() {

	}

	function testAdminEdit() {

	}

	function testAdminDelete() {

	}

}
?>