<?php
/* RatingRules Test cases generated on: 2010-09-28 21:09:26 : 1285708586*/
App::import('Controller', 'RatingRules');

class TestRatingRulesController extends RatingRulesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class RatingRulesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.rating_rule');

	function startTest() {
		$this->RatingRules =& new TestRatingRulesController();
		$this->RatingRules->constructClasses();
	}

	function endTest() {
		unset($this->RatingRules);
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

}
?>