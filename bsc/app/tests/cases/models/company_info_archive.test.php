<?php
/* CompanyInfoArchive Test cases generated on: 2011-02-02 16:02:20 : 1296664100*/
App::import('Model', 'CompanyInfoArchive');

class CompanyInfoArchiveTestCase extends CakeTestCase {
	var $fixtures = array('app.company_info_archive');

	function startTest() {
		$this->CompanyInfoArchive =& ClassRegistry::init('CompanyInfoArchive');
	}

	function endTest() {
		unset($this->CompanyInfoArchive);
		ClassRegistry::flush();
	}

}
?>