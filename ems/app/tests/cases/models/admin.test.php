<?php
/* admin Test cases generated on: 2010-08-09 13:08:26 : 1281360506*/
App::import('Model', 'admin');

class adminTestCase extends CakeTestCase {
	var $fixtures = array('app.admin');

	function startTest() {
		$this->admin =& ClassRegistry::init('admin');
	}

	function endTest() {
		unset($this->admin);
		ClassRegistry::flush();
	}

}
?>