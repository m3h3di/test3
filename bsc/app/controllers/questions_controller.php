<?php
class QuestionsController extends AppController {

	var $name = 'Questions';
	var $helpers = array('Html', 'Javascript'); 
	
	function beforeFilter() {
		$this->layout = 'cake';
		if( $this->Session->read('Auth.User.status') != (1||2) ) // status=1 means Admin
			$this->redirect( "/counselors/home" );
			
			
		$menu_item="survey_management";$this->Session->write('menu_item', $menu_item);
			
	}
	
	
	function admin_index() {
		//$this->Question->recursive = 0;
		//$this->set('questions', $this->paginate());
		$this->loadModel('Section');
		$this->set('questions', $this->Section->find('all', array('order' => array('Section.order ASC')))  );
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid question', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('question', $this->Question->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Question->create();
			if ($this->Question->save($this->data)) {
				$this->Session->setFlash(__('The question has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The question could not be saved. Please, try again.', true));
			}
		}
		$sections = $this->Question->Section->find('list');
		$this->set(compact('sections'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid question', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Question->save($this->data)) {
				$this->Session->setFlash(__('The question has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The question could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Question->read(null, $id);
		}
		$sections = $this->Question->Section->find('list');
		$this->set(compact('sections'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for question', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Question->delete($id)) {
			$this->Session->setFlash(__('Question deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Question was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>