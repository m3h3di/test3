<?php
/* WeightFactors Test cases generated on: 2010-11-10 07:11:12 : 1289374332*/
App::import('Controller', 'WeightFactors');

class TestWeightFactorsController extends WeightFactorsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class WeightFactorsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.weight_factor');

	function startTest() {
		$this->WeightFactors =& new TestWeightFactorsController();
		$this->WeightFactors->constructClasses();
	}

	function endTest() {
		unset($this->WeightFactors);
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