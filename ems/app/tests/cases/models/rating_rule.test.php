<?php
/* RatingRule Test cases generated on: 2010-07-29 07:07:18 : 1280389878*/
App::import('Model', 'RatingRule');

class RatingRuleTestCase extends CakeTestCase {
	var $fixtures = array('app.rating_rule');

	function startTest() {
		$this->RatingRule =& ClassRegistry::init('RatingRule');
	}

	function endTest() {
		unset($this->RatingRule);
		ClassRegistry::flush();
	}

}
?>