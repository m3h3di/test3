<?php
/* Grievance Test cases generated on: 2011-03-09 08:03:53 : 1299660713*/
App::import('Model', 'Grievance');

class GrievanceTestCase extends CakeTestCase {
	var $fixtures = array('app.grievance');

	function startTest() {
		$this->Grievance =& ClassRegistry::init('Grievance');
	}

	function endTest() {
		unset($this->Grievance);
		ClassRegistry::flush();
	}

}
?>