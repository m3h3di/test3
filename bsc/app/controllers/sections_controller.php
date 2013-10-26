<?php
class SectionsController extends AppController {

	var $name = 'Sections';
	var $paginate = array(
        'order' => array('Section.order ASC'),
        
    );
	
	function beforeFilter() {
		$this->layout = 'cake';
		if( $this->Session->read('Auth.User.status') != (1||2) ) // status=1 means Admin
			$this->redirect( "/counselors/home" );
			
	}
	
	
	function index() {
		$this->Section->recursive = 0;
		$this->set('sections', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->flash(__('Invalid section', true), array('action' => 'index'));
		}
		$this->set('section', $this->Section->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Section->create();
			if ($this->Section->save($this->data)) {
				$this->flash(__('Section saved.', true), array('action' => 'index'));
			} else {
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->flash(sprintf(__('Invalid section', true)), array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Section->save($this->data)) {
				$this->flash(__('The section has been saved.', true), array('action' => 'index'));
			} else {
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Section->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->flash(sprintf(__('Invalid section', true)), array('action' => 'index'));
		}
		if ($this->Section->delete($id)) {
			$this->flash(__('Section deleted', true), array('action' => 'index'));
		}
		$this->flash(__('Section was not deleted', true), array('action' => 'index'));
		$this->redirect(array('action' => 'index'));
	}
	function admin_index() {
		$this->Section->recursive = 0;
		$this->set('sections', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->flash(__('Invalid section', true), array('action' => 'index'));
		}
		$this->set('section', $this->Section->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Section->create();
			if ($this->Section->save($this->data)) {
				$this->flash(__('Section saved.', true), array('action' => 'index'));
			} else {
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->flash(sprintf(__('Invalid section', true)), array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Section->save($this->data)) {
				$this->flash(__('The section has been saved.', true), array('action' => 'index'));
			} else {
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Section->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->flash(sprintf(__('Invalid section', true)), array('action' => 'index'));
		}
		if ($this->Section->delete($id)) {
			$this->flash(__('Section deleted', true), array('action' => 'index'));
		}
		$this->flash(__('Section was not deleted', true), array('action' => 'index'));
		$this->redirect(array('action' => 'index'));
	}
}
?>