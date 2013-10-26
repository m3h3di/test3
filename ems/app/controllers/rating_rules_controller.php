<?php
class RatingRulesController extends AppController {

	var $name = 'RatingRules';
	var $paginate = array('order'=>array('section' => 'asc'));

	
	
	function beforeFilter() {
		$this->layout = 'cake';
		if( $this->Session->read('Auth.User.status') != 1 ) // status=1 means admin
			$this->redirect( array('controller'=>'users','action'=>'home') );
		
	}
	
	function index() {
		$this->RatingRule->recursive = 0;
		$this->set('ratingRules', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->flash(__('Invalid rating rule', true), array('action' => 'index'));
		}
		$this->set('ratingRule', $this->RatingRule->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->RatingRule->create();
			if ($this->RatingRule->save($this->data)) {
				//$this->flash(__('Ratingrule saved.', true), array('action' => 'index'));
				$this->redirect( array('controller'=>'rating_rules','action'=>'index') );
			} else {
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->flash(sprintf(__('Invalid rating rule', true)), array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->RatingRule->save($this->data)) {
				//$this->flash(__('The rating rule has been saved.', true), array('action' => 'index'));
				$this->redirect( array('controller'=>'rating_rules','action'=>'index') );
			} else {
			}
		}
		if (empty($this->data)) {
			$this->data = $this->RatingRule->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->flash(sprintf(__('Invalid rating rule', true)), array('action' => 'index'));
		}
		if ($this->RatingRule->delete($id)) {
			//$this->flash(__('Rating rule deleted', true), array('action' => 'index'));
			$this->redirect( array('controller'=>'rating_rules','action'=>'index') );
		}
		$this->flash(__('Rating rule was not deleted', true), array('action' => 'index'));
		$this->redirect(array('action' => 'index'));
	}
}
?>