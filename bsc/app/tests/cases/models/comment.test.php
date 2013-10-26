<?php
/* Comment Test cases generated on: 2011-02-03 00:02:00 : 1296692160*/
App::import('Model', 'Comment');

class CommentTestCase extends CakeTestCase {
	var $fixtures = array('app.comment');

	function startTest() {
		$this->Comment =& ClassRegistry::init('Comment');
	}

	function endTest() {
		unset($this->Comment);
		ClassRegistry::flush();
	}

}
?>