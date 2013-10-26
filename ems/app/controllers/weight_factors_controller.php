<?php
class WeightFactorsController extends AppController {

	var $name = 'WeightFactors';
	var $helpers = array('Javascript');
	
	function beforeFilter() {
		$this->layout = 'cake';
		if( $this->Session->read('Auth.User.status') != 1 ) // status=1 means admin
			$this->redirect( array('controller'=>'users','action'=>'home') );
		
	}
	
	function index() {
		$this->WeightFactor->recursive = 0;
		$this->set('weightFactors', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			//$this->flash(__('Invalid weight factor', true), array('action' => 'index'));
			$this->redirect( array('controller'=>'weight_factors','action'=>'index') );
		}
		$this->set('weightFactor', $this->WeightFactor->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->WeightFactor->create();
			if ($this->WeightFactor->save($this->data)) {
				//$this->flash(__('Weightfactor saved.', true), array('action' => 'index'));
				$this->redirect( array('controller'=>'weight_factors','action'=>'index') );
			} else {
				$this->redirect( array('controller'=>'weight_factors','action'=>'index') );
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			//$this->flash(sprintf(__('Invalid weight factor', true)), array('action' => 'index'));
			$this->redirect( array('controller'=>'weight_factors','action'=>'index') );
		}
		if (!empty($this->data)) {
			if ($this->WeightFactor->save($this->data)) {
				//	$this->flash(__('The weight factor has been saved.', true), array('action' => 'index'));
				$this->redirect( array('controller'=>'weight_factors','action'=>'index') );
			} else {
				//$this->redirect( array('controller'=>'weight_factors','action'=>'index') );
			}
		}
		if (empty($this->data)) {
			$this->data = $this->WeightFactor->read(null, $id);
		}
	}

	/*function delete($id = null) {
		if (!$id) {
			$this->flash(sprintf(__('Invalid weight factor', true)), array('action' => 'index'));
		}
		if ($this->WeightFactor->delete($id)) {
			$this->flash(__('Weight factor deleted', true), array('action' => 'index'));
		}
		$this->flash(__('Weight factor was not deleted', true), array('action' => 'index'));
		$this->redirect(array('action' => 'index'));
	}*/
	function admin_index() {
		$this->WeightFactor->recursive = 0;
		$this->set('weightFactors', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->flash(__('Invalid weight factor', true), array('action' => 'index'));
		}
		$this->set('weightFactor', $this->WeightFactor->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->WeightFactor->create();
			if ($this->WeightFactor->save($this->data)) {
				$this->flash(__('Weightfactor saved.', true), array('action' => 'index'));
			} else {
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->flash(sprintf(__('Invalid weight factor', true)), array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->WeightFactor->save($this->data)) {
				$this->flash(__('The weight factor has been saved.', true), array('action' => 'index'));
			} else {
			}
		}
		if (empty($this->data)) {
			$this->data = $this->WeightFactor->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->flash(sprintf(__('Invalid weight factor', true)), array('action' => 'index'));
		}
		if ($this->WeightFactor->delete($id)) {
			$this->flash(__('Weight factor deleted', true), array('action' => 'index'));
		}
		$this->flash(__('Weight factor was not deleted', true), array('action' => 'index'));
		$this->redirect(array('action' => 'index'));
	}
}
?>