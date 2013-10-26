<?php
class FactoriesController extends AppController {

	var $name = 'Factories';

	function beforeFilter() {
		$this->layout = 'cake';
		if( $this->Session->read('Auth.User.status') != 1 ) // status=1 means admin
			$this->redirect( array('controller'=>'users','action'=>'home') );
		
	}
	function index() {
		$this->Factory->recursive = 0;
		$this->set('factories', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid factory', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('factory', $this->Factory->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Factory->create();
			if ($this->Factory->save($this->data)) {
				$this->Session->setFlash(__('The factory has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The factory could not be saved. Please, try again.', true));
			}
		}
		$users = $this->Factory->User->find('list');
		$this->set(compact('users'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid factory', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Factory->save($this->data)) {
				$this->Session->setFlash(__('The factory has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The factory could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Factory->read(null, $id);
		}
		$users = $this->Factory->User->find('list');
		$this->set(compact('users'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for factory', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Factory->delete($id)) {
			$this->Session->setFlash(__('Factory deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Factory was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	function admin_index() {
		$this->Factory->recursive = 0;
		$this->set('factories', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid factory', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('factory', $this->Factory->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Factory->create();
			if ($this->Factory->save($this->data)) {
				$this->Session->setFlash(__('The factory has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The factory could not be saved. Please, try again.', true));
			}
		}
		$users = $this->Factory->User->find('list');
		$this->set(compact('users'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid factory', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Factory->save($this->data)) {
				$this->Session->setFlash(__('The factory has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The factory could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Factory->read(null, $id);
		}
		$users = $this->Factory->User->find('list');
		$this->set(compact('users'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for factory', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Factory->delete($id)) {
			$this->Session->setFlash(__('Factory deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Factory was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>