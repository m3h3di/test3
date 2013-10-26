<?php
class ReportsController extends AppController {

	var $name = 'Reports';
	var $scaffold;
	
	/*function index() {
		$this->Report->recursive = 0;
		$this->set('reports', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->flash(__('Invalid report', true), array('action' => 'index'));
		}
		$this->set('report', $this->Report->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Report->create();
			if ($this->Report->save($this->data)) {
				$this->flash(__('Report saved.', true), array('action' => 'index'));
			} else {
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->flash(sprintf(__('Invalid report', true)), array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Report->save($this->data)) {
				$this->flash(__('The report has been saved.', true), array('action' => 'index'));
			} else {
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Report->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->flash(sprintf(__('Invalid report', true)), array('action' => 'index'));
		}
		if ($this->Report->delete($id)) {
			$this->flash(__('Report deleted', true), array('action' => 'index'));
		}
		$this->flash(__('Report was not deleted', true), array('action' => 'index'));
		$this->redirect(array('action' => 'index'));
	}
	function admin_index() {
		$this->Report->recursive = 0;
		$this->set('reports', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->flash(__('Invalid report', true), array('action' => 'index'));
		}
		$this->set('report', $this->Report->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Report->create();
			if ($this->Report->save($this->data)) {
				$this->flash(__('Report saved.', true), array('action' => 'index'));
			} else {
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->flash(sprintf(__('Invalid report', true)), array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Report->save($this->data)) {
				$this->flash(__('The report has been saved.', true), array('action' => 'index'));
			} else {
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Report->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->flash(sprintf(__('Invalid report', true)), array('action' => 'index'));
		}
		if ($this->Report->delete($id)) {
			$this->flash(__('Report deleted', true), array('action' => 'index'));
		}
		$this->flash(__('Report was not deleted', true), array('action' => 'index'));
		$this->redirect(array('action' => 'index'));
	}*/
}
?>