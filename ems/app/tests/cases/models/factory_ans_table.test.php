<?php
/* FactoryAnsTable Test cases generated on: 2010-07-29 10:07:03 : 1280398623*/
App::import('Model', 'FactoryAnsTable');

class FactoryAnsTableTestCase extends CakeTestCase {
	var $fixtures = array('app.factory_ans_table');

	function startTest() {
		$this->FactoryAnsTable =& ClassRegistry::init('FactoryAnsTable');
	}

	function endTest() {
		unset($this->FactoryAnsTable);
		ClassRegistry::flush();
	}

}
?>