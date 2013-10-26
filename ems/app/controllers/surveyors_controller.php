<?php
class SurveyorsController extends AppController {

	var $name = 'Surveyors';
	//var $scaffold;
	
	/*function beforeFilter() {
		parent::beforeFilter(); 
		$this->Auth->allow('*');
	}

	
	function login() {
		if ($this->Session->read('Auth.Surveyor')) {
			$this->Session->setFlash('You are logged in!');
			$this->redirect('/', null, false);
		}
	} 
	 
	function logout() {
		//Leave empty for now.
	}*/
	
	function entry( $section = 1) {
		//$this->Survey->recursive = 0;
		//$this->set('questions', $this->Survey->find('all') );
		$this->set('section', $section);
		$this->set('questions', $this->Survey->findAllBySection($section) );
	}


}
?>