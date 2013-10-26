<?php
class AnswersController extends AppController {

	var $name = 'Answers';
	var $scaffold;
	
	function beforeFilter() {
		if ($this->Auth->user('status') == 0 ) {
    		//$this->redirect(array('controller'=>'questions','action' => 'entry'));
		}
	}
	
	function entry() {
		$this->Question->recursive = 0;
		$this->set('answers', $this->paginate());
	}
}
?>