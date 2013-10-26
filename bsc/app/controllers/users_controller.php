<?php
class UsersController extends AppController {

	var $name = 'Users';
	var $helpers = array('Javascript');

	function beforeFilter() 
	{
		$this->layout = 'cake';
		$menu_item="survey_management";$this->Session->write('menu_item', $menu_item);	
	}
	
	function index()
	{
		$this->redirect('/', null, false);
		//$this->redirect( array('controller'=>'counselors','action'=>'home') );
	}
	function login() 
	{
		$this->layout = 'login';
		if ($this->Session->read('Auth.User')) {
			//$this->Session->setFlash('You are logged in!');
			if( $this->Session->read('Auth.User.status') == (1||2) ) // status=1 means admin
				$this->redirect( array('controller'=>'admin','action'=>'cpanels') );
				
			else $this->redirect('/', null, false);
			//else $this->redirect( array('controller'=>'counselors','action'=>'home') );
		}
	} 
	 
	function logout() 
	{
		$this->redirect($this->Auth->logout());
	}

	
	
	
	
	function admin_index() 
	{
		if( $this->Session->read('Auth.User.status') != (1||2) ) // status=1 means Admin
			$this->redirect( "/counselors/home" );
		
		/*$this->User->recursive = 0;
		$this->set('users', $this->paginate());*/
		
		$this->loadModel("Group");
		$this->set('all_groups', $this->Group->find("all"));
		
	}

	function admin_view($id = null) 
	{
		if( $this->Session->read('Auth.User.status') != (1||2) ) // status=1 means Admin
			$this->redirect( "/counselors/home" );
			
		if (!$id)
		{
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('user', $this->User->read(null, $id));
	}

	function admin_add() 
	{
		if( $this->Session->read('Auth.User.status') != (1||2) ) // status=1 means Admin
			$this->redirect( "/counselors/home" );
			
			
		if (!empty($this->data)) {
			$this->User->create();
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('The user has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.', true));
			}
		}
		$groups = $this->User->Group->find('list');
		$this->set(compact('groups'));
	}

	function admin_edit($id = null) 
	{
		if( $this->Session->read('Auth.User.status') != (1||2) ) // status=1 means Admin
			$this->redirect( "/counselors/home" );
			
			
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
		$groups = $this->User->Group->find('list');
		$this->set(compact('groups'));
	}

	function admin_delete($id = null) 
	{
		if( $this->Session->read('Auth.User.status') != (1||2) ) // status=1 means Admin
			$this->redirect( "/counselors/home" );
			
			
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