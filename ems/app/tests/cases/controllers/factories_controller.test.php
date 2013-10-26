<?php
/* Factories Test cases generated on: 2010-09-28 21:09:42 : 1285709682*/
App::import('Controller', 'Factories');

class TestFactoriesController extends FactoriesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class FactoriesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.factory', 'app.user', 'app.rating');

	function startTest() {
		$this->Factories =& new TestFactoriesController();
		$this->Factories->constructClasses();
	}

	function endTest() {
		unset($this->Factories);
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