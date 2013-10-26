<?php
/* CompanyAnsList Test cases generated on: 2010-12-04 10:12:56 : 1291457096*/
App::import('Model', 'CompanyAnsList');

class CompanyAnsListTestCase extends CakeTestCase {
	var $fixtures = array('app.company_ans_list', 'app.company');

	function startTest() {
		$this->CompanyAnsList =& ClassRegistry::init('CompanyAnsList');
	}

	function endTest() {
		unset($this->CompanyAnsList);
		ClassRegistry::flush();
	}

}
?>