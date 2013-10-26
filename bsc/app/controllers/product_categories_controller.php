<?php
class ProductCategoriesController extends AppController {

	var $name = 'ProductCategories';
	var $helpers = array('Javascript');
	
	function beforeFilter() {
		$this->layout = 'cake';
		//parent::beforeFilter(); 
		//$this->Auth->allow('*');
		//$this->Auth->allow('add');
		if( $this->Session->read('Auth.User.status') != (1||2) ) // status=1 means Admin
			$this->redirect( "/counselors/home" );
	}
	
	function index() {
		$this->ProductCategories->recursive = 0;
		$this->set('productCategories', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid product category', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('productCategories', $this->ProductCategory->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->ProductCategory->create();
			if ($this->ProductCategory->save($this->data)) {
				$this->Session->setFlash(__('The product category has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product category could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid product category', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->ProductCategory->save($this->data)) {
				$this->Session->setFlash(__('The product category has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product category could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->ProductCategory->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for product category', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->ProductCategory->delete($id)) {
			$this->Session->setFlash(__('Product category deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Product category was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	
	function admin_index() {
		$this->ProductCategories->recursive = 0;
		$this->set('productCategories', $this->paginate());
	}



	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid product category', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('productCategory', $this->ProductCategory->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->ProductCategory->create();
			if ($this->ProductCategory->save($this->data)) {
				$this->Session->setFlash(__('The product category has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product category could not be saved. Please, try again.', true));
			}
		}
		
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid product category', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->ProductCategory->save($this->data)) {
				$this->Session->setFlash(__('The product category has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product category could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->ProductCategory->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for product category', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->ProductCategory->delete($id)) {
			$this->Session->setFlash(__('Product category deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Product category was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>