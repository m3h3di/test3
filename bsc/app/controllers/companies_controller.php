<?php
class CompaniesController extends AppController {

	var $name = 'Companies';
	var $helpers = array('Javascript');
	
	function beforeFilter() {
		$this->layout = 'cake';
		if( $this->Session->read('Auth.User.status') != (1||2) ) // status=1 means Admin 
			$this->redirect( "/counselors/home" );
			
			
		$menu_item="survey_management";$this->Session->write('menu_item', $menu_item);	
			
	}
	function admin_index() {
		//$this->Company->recursive = 0;
		//$this->set('companies', $this->paginate());
		//$this->User->recursive = 0;
		//$this->set('users', $this->paginate());
		$this->loadModel("Group");
		//$res = $this->Group->query("SELECT users.*, groups.* FROM groups LEFT JOIN users ON groups.id=users.group_id");
		$this->set('all_groups', $this->Group->find("all"));
		
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid company', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('company', $this->Company->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Company->create();
			if ($this->Company->save($this->data)) {
				$this->Session->setFlash(__('The company has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The company could not be saved. Please, try again.', true));
			}
		}
		//$groups = $this->Company->Group->find('list');
		$groups = $this->Company->Group->find('list',array('conditions' => array('Group.id !=' => 1)) );
			$this->set(compact('groups'));
		
		$productCategories = $this->Company->ProductCategory->find('list',
		array('conditions' => array('ProductCategory.id !=' => 1)) );
			$this->set(compact('productCategories'));
			
			//print_r($productCategories);exit;
			
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid company', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Company->save($this->data)) {
				$this->Session->setFlash(__('The company has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The company could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Company->read(null, $id);
		}
		//$groups = $this->Company->Group->find('list');
		$groups = $this->Company->Group->find('list',array('conditions' => array('Group.id !=' => 1)) );
		$this->set(compact('groups'));
		
		$productCategories = $this->Company->ProductCategory->find('list',
		array('conditions' => array('ProductCategory.id !=' => 1)) );
			$this->set(compact('productCategories'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for company', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Company->delete($id)) {
			$this->Session->setFlash(__('Company deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Company was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>