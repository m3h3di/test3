<?php
class UsersController extends AppController {

	var $name = 'Users';
	var $helpers = array('Html', 'Javascript');
	function beforeFilter() {
		
		//parent::beforeFilter(); 
		//$this->Auth->allow('*');
		//$this->Auth->allow('add');
	}

	
	function login() 
	{
		$this->layout = 'login';	
		if ($this->Session->read('Auth.User')) {
			//$this->Session->setFlash('You are logged in!');
			if( $this->Session->read('Auth.User.status') == 1 ) // status=1 means admin
				$this->redirect( array('controller'=>'admin') );
			else $this->redirect('/', null, false);
		}
	} 
	 
	function logout() {
		//Leave empty for now.
		$this->Session->setFlash('Good-Bye');
		$this->redirect($this->Auth->logout());

	}
	
	function home() {
		if( $this->Session->read('Auth.User.status') == 1 ) // status=1 means admin
				$this->redirect( array('controller'=>'admin') );
		$id = $this->Auth->User('id');
		$this->set('factories', $this->User->findAllById($id) );	//seba/users/home
		
		
		
		
		$this->Session->write('session_factories', $this->User->findAllById($id));
	}
	
	function factory($factory_id) {
		if( !empty($factory_id)){
	
			$id = $this->Auth->User('id');
			$this->loadModel('Factory');
			//$this->set('factory', $this->Factory->findAllById($factory_id) );		//seba/users/factory/2
			
			$res = $this->Factory->findAllById($factory_id) ;
			$res_id = $res[0]['User']['id'];
			
			if($id == $res_id){
				if( $res[0]['Factory']['status'] != 0 )	$this->redirect(array('controller' => 'users', 'action' => 'ffactory',$factory_id));
				else $this->set('factory', $res);		//seba/users/factory/2
			}
			
			else $this->redirect(array('controller' => 'users', 'action' => 'home'));
		}
		else $this->redirect(array('controller' => 'users', 'action' => 'home'));
		
	}
	function ffactory($factory_id) {
		if( !empty($factory_id)){
	
			$id = $this->Auth->User('id');
			$this->loadModel('Factory');
			//$this->set('factory', $this->Factory->findAllById($factory_id) );		//seba/users/factory/2
			
			$res = $this->Factory->findAllById($factory_id) ;
			$res_id = $res[0]['User']['id'];
			
			if($id == $res_id){
				$this->set('factory', $res);		//seba/users/factory/2
			}
			
			else $this->redirect(array('controller' => 'users', 'action' => 'home'));
		}
		else $this->redirect(array('controller' => 'users', 'action' => 'home'));
		
	}
	
	
	function index() {
		if( $this->Session->read('Auth.User.status') != 1 ) // status=1 means admin
			$this->redirect( array('controller'=>'users','action'=>'home') );
		$this->layout = 'cake';
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}

	function view($id = null) {
		if( $this->Session->read('Auth.User.status') != 1 ) // status=1 means admin
			$this->redirect( array('controller'=>'users','action'=>'home') );
		$this->layout = 'cake';
		if (!$id) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('user', $this->User->read(null, $id));
	}

	function add() {
		if( $this->Session->read('Auth.User.status') != 1 ) // status=1 means admin
			$this->redirect( array('controller'=>'users','action'=>'home') );
		$this->layout = 'cake';
		if (!empty($this->data)) {
			$this->User->create();
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('The user has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if( $this->Session->read('Auth.User.status') != 1 ) // status=1 means admin
			$this->redirect( array('controller'=>'users','action'=>'home') );
		$this->layout = 'cake';
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('The user has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->User->read(null, $id);
		}
	}

	function delete($id = null) {
		if( $this->Session->read('Auth.User.status') != 1 ) // status=1 means admin
			$this->redirect( array('controller'=>'users','action'=>'home') );
		$this->layout = 'cake';
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for user', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->User->delete($id)) {
			$this->Session->setFlash(__('User deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('User was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	function admin_index() {
		$this->layout = 'cake';
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}

	function admin_view($id = null) {
		$this->layout = 'cake';
		if (!$id) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('user', $this->User->read(null, $id));
	}

	function admin_add() {
		$this->layout = 'cake';
		if (!empty($this->data)) {
			$this->User->create();
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('The user has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		$this->layout = 'cake';
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('The user has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->User->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		$this->layout = 'cake';
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for user', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->User->delete($id)) {
			$this->Session->setFlash(__('User deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('User was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}
?>