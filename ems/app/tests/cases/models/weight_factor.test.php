<?php
/* WeightFactor Test cases generated on: 2010-11-10 07:11:14 : 1289374274*/
App::import('Model', 'WeightFactor');

class WeightFactorTestCase extends CakeTestCase {
	var $fixtures = array('app.weight_factor');

	function startTest() {
		$this->WeightFactor =& ClassRegistry::init('WeightFactor');
	}

	function endTest() {
		unset($this->WeightFactor);
		ClassRegistry::flush();
	}

}
?>