<?php
/* Rating Test cases generated on: 2010-07-27 10:07:00 : 1280225640*/
App::import('Model', 'Rating');

class RatingTestCase extends CakeTestCase {
	var $fixtures = array('app.rating', 'app.factory', 'app.user');

	function startTest() {
		$this->Rating =& ClassRegistry::init('Rating');
	}

	function endTest() {
		unset($this->Rating);
		ClassRegistry::flush();
	}

}
?>