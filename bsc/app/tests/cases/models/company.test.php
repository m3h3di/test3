<?php
/* Company Test cases generated on: 2011-01-25 11:01:38 : 1295954918*/
App::import('Model', 'Company');

class CompanyTestCase extends CakeTestCase {
	var $fixtures = array('app.company', 'app.user', 'app.user2');

	function startTest() {
		$this->Company =& ClassRegistry::init('Company');
	}

	function endTest() {
		unset($this->Company);
		ClassRegistry::flush();
	}

}
?>