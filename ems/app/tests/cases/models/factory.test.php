<?php
/* Factory Test cases generated on: 2010-07-27 09:07:16 : 1280221456*/
App::import('Model', 'Factory');

class FactoryTestCase extends CakeTestCase {
	var $fixtures = array('app.factory', 'app.user');

	function startTest() {
		$this->Factory =& ClassRegistry::init('Factory');
	}

	function endTest() {
		unset($this->Factory);
		ClassRegistry::flush();
	}

}
?>