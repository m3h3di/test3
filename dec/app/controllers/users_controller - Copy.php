<?php
class UsersController extends AppController {
	
	var $name = 'Users';
    //var $components = array('Auth');
	var $scaffold;
	function beforeFilter() {
		//parent::beforeFilter(); 
		//$this->Auth->allow('*');
		$this->Auth->allow('add');
	}

	
	function login() {
		if ($this->Session->read('Auth.User')) {
			$this->Session->setFlash('You are logged in!');
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
	
	function controlpanel(){
	
	
	}
	
	function home() {
		$id = $this->Auth->User('id');
		$this->set('factories', $this->User->findAllById($id) );	//seba/users/home
	}
	
	function factory($factory_id) {
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
	
	
	
}
?>