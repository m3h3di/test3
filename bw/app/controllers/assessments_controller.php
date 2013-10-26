<?php
class AssessmentsController extends AppController {

	var $name = 'Assessments';
	var $helpers = array('Html', 'Javascript'); 
	function beforeFilter() {
		$this->layout = 'betterWork';
		//parent::beforeFilter(); 
		//$this->Auth->allow('*');
		//$this->Auth->allow('add');
	}
	
	function home() {
		$this->loadModel("User");
		if( $this->Session->read('Auth.User.status') == 1 ) // status=1 means admin
				$this->redirect( array('controller'=>'admin') );
		$id = $this->Auth->User('id');
		$this->set('factories', $this->User->findAllById($id) );	//seba/users/home
	}
	function upload() {
		$this->loadModel("User");
		if( $this->Session->read('Auth.User.status') == 1 ) // status=1 means admin
				$this->redirect( array('controller'=>'admin') );
		$id = $this->Auth->User('id');
		$this->set('factories', $this->User->findAllById($id) );	//seba/users/home
	}
	
}
?>
