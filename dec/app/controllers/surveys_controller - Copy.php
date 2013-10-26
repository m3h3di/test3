<?php
class SurveysController extends AppController {

	var $name = 'Surveys';
	var $helpers = array('Html', 'Javascript'); 
	
	function entry( $section = 1,$factory_id = null ) {
		
		//Start checking the factory assigned to this user or not
		if( !empty($factory_id)){
	
			$id = $this->Auth->User('id');
			$this->loadModel('Factory');
			//$this->set('factory', $this->Factory->findAllById($factory_id) );		//seba/users/factory/2
			
			$res = $this->Factory->findAllById($factory_id) ;
			$res_id = $res[0]['User']['id'];
			$factory_name = $res[0]['Factory']['factory_name'];
			
			if($id == $res_id){
				$this->set('factory_id', $factory_id );
				$this->set('factory_name', $factory_name );
			}
			
			else $this->redirect(array('controller' => 'users', 'action' => 'home'));
		}
		else $this->redirect(array('controller' => 'users', 'action' => 'home'));
		//End checking the factory assigned to this user or not
		
		
		/*$this->loadModel("Factory");
		$res =  $this->Factory->Query("SELECT factory_name FROM factories WHERE id='$factory_id' ");
		$factory_name = $res[0]['factories']['factory_name'];
		$this->set('factory_name', $factory_name );
		*/
		
		$this->set('section', $section);
		//$this->set('questions', $this->Survey->findAllBySection($section) );
		$this->set('questions', $this->Survey->find('all', array('order' => array('Survey.order ASC'), 'conditions' => array('Survey.section' => $section)) ) );
		
		//$this->set('inside_table_questions', $this->Survey->find('all', array('order' => array('survey.order ASC','survey.question ASC'), 'conditions' => array('Survey.section' => $section)) ) );
		
		$this->loadModel("RatingRule");
		$this->set('rating_rules', $this->RatingRule->findAllBySection($section) );
		
		/*$this->loadModel("FactoryAnsTable");
		$ans =  $this->FactoryAnsTable->Query("SELECT * FROM factory_ans_tables AS FactoryAnsTable WHERE factory_id='$factory_id' ");
		$this->set('answers', $ans );*/
	}
	
	function SurveyEdit($section = null,$factory_id = null){
	
		//Start checking the factory assigned to this user or not
		if( !empty($factory_id) & !empty($section)){
		$id = $this->Auth->User('id');
			$this->loadModel('Factory');
			//$this->set('factory', $this->Factory->findAllById($factory_id) );		//seba/users/factory/2
			
			$res = $this->Factory->findAllById($factory_id) ;
			$res_id = $res[0]['User']['id'];
			$factory_name = $res[0]['Factory']['factory_name'];
			
			if($id == $res_id){
				$this->set('factory_id', $factory_id );
				$this->set('factory_name', $factory_name );
			}
			
			else $this->redirect(array('controller' => 'users', 'action' => 'home'));
		}
		else $this->redirect(array('controller' => 'users', 'action' => 'home'));
		//End checking the factory assigned to this user or not
		
		
		$this->set('section', $section);
		//$this->set('questions', $this->Survey->findAllBySection($section) );
		$this->set('questions', $this->Survey->find('all', array('order' => array('Survey.order ASC'), 'conditions' => array('Survey.section' => $section)) ) );
		
		
		
		//$this->set('inside_table_questions', $this->Survey->find('all', array('order' => array('survey.order ASC','survey.question ASC'), 'conditions' => array('Survey.section' => $section)) ) );
		
		
		
		$this->loadModel("RatingRule");
		$this->set('rating_rules', $this->RatingRule->findAllBySection($section) );
		
		
		$this->loadModel("Rating");
		$rating =  $this->Rating->Query("SELECT * FROM ratings AS Rating WHERE factory_id='$factory_id' AND section='$section' ");
		$this->set('rating', $rating );
		
		
		$this->loadModel("FactoryAnsTable");
		//$ans =  $this->FactoryAnsTable->findAllByFactoryId($factory_id);
		$ans =  $this->FactoryAnsTable->Query("SELECT * FROM factory_ans_tables AS FactoryAnsTable WHERE factory_id='$factory_id' AND section='$section' ");
		$this->set('factory_answers', $ans );	
		

	}
	

	function process(){
		$test = $_POST;
		$section = $_POST['section'];
		$factory_id = $_POST['factory_id'];
		if( !empty($_POST['point']) ) $point = $_POST['point'];
		else $point = 0;
		
		/*echo '<pre style="text-align:left">';
		print_r($test);
		echo "</pre>";*/
		
		
		$i = 0;
		$old_ans_id="";
		
		//setting the array for factory_ans_table
		foreach($test as $name=>$val){
			if($name != "point" & $name != "section" & $name != "factory_id"){
				$splitted_text = explode("_", $name);
				
				if( $splitted_text[0] == "text" & empty($val) ) continue ; // checking an empty text field
				
				//Start checkin if ans_id exist
				if( $splitted_text[0] == "chk" ){
					$correspondin_text_key = "text_".$splitted_text[1]."_".$splitted_text[2];
					if (!empty($_POST[$correspondin_text_key]) ) continue;
				}
				//End checkin if ans_id exist 			
				
				$data_set[$i]['factory_id'] = $factory_id;  
				$data_set[$i]['question_id'] = $splitted_text[1];
				if(!empty($splitted_text[2]) )	$data_set[$i]['ans_id'] = $splitted_text[2];
				else $data_set[$i]['ans_id'] = 0;
				
				$data_set[$i]['type'] = $splitted_text[0];
				if( $splitted_text[0] == "text" || $splitted_text[0] == "radio" ) $data_set[$i]['text'] = $val;
				$data_set[$i]['section'] = $section;
				
				
				$old_ans_id = $splitted_text[1];
				$i++;
			}
		}
		
		//setting the array for rating table
		$rate_data['factory_id'] = $factory_id;
		$rate_data['section'] = $section;
		$rate_data['points'] = $point;
		$rate_data['status'] = 1;
		

		$this->loadModel("FactoryAnsTable");
		$this->FactoryAnsTable->Query("DELETE FROM factory_ans_tables where factory_id='$factory_id' AND section='$section' ");
		$this->FactoryAnsTable->create();
		if ($this->FactoryAnsTable->saveAll($data_set)) {
			//$this->flash(__('saved.', true), array('action' => 'entry'));
			$this->loadModel("Rating");
			$this->Rating->Query("DELETE FROM ratings where factory_id='$factory_id' AND section='$section' ");
			
			$this->Rating->create();
			if ($this->Rating->save($rate_data)){
				//echo "saved ratings & answers";
				$this->redirect(array('controller' => 'users', 'action' => 'factory', $factory_id));
			}
			else{
				//echo "rate saving problem";
				$this->redirect(array('controller' => 'users', 'action' => 'factory',$factory_id));
			}
		} 
		else {
			//echo "Anwer saving problem";
			$this->redirect(array('controller' => 'users', 'action' => 'factory',$factory_id));
		}
		
		//$this->set('factory_ans', $test);
		
		/*echo '<pre style="text-align:left">';
		print_r($data_set);
		echo "</pre>";*/
		
	}
	
	function SaveFacility($factory_id =null){
		
		//Start checking the factory assigned to this user or not
		if( !empty($factory_id)){
	
			$id = $this->Auth->User('id');
			$this->loadModel('Factory');
			//$this->set('factory', $this->Factory->findAllById($factory_id) );		//seba/users/factory/2
			
			$res = $this->Factory->findAllById($factory_id) ;
			$res_id = $res[0]['User']['id'];
			
			if($id == $res_id){
				
				$status = 1;
				$qry = "UPDATE factories SET status = '1' WHERE id = '$factory_id'";
				if ($this->Factory->query($qry)){
					$this->redirect(array('controller' => 'users', 'action' => 'factory',$factory_id));	
				} 
				else {
					$this->redirect(array('controller' => 'users', 'action' => 'home'));
				}
				
			}
			
			else $this->redirect(array('controller' => 'users', 'action' => 'home'));
		}
		else $this->redirect(array('controller' => 'users', 'action' => 'home'));
		
		
		
	}
	
	function showans( $section = null , $factory_id = null ){
		
		$id = $this->Auth->User('id');
				
		//Start checking the factory assigned to this user or not
		if( !empty($factory_id)){
	
			$id = $this->Auth->User('id');
			$this->loadModel('Factory');
			//$this->set('factory', $this->Factory->findAllById($factory_id) );		//seba/users/factory/2
			
			$res = $this->Factory->findAllById($factory_id) ;
			$res_id = $res[0]['User']['id'];
			$factory_name = $res[0]['Factory']['factory_name'];
			
			if($id == $res_id){
				$this->set('factory_id', $factory_id );
				$this->set('factory_name', $factory_name );
			}
			
			else $this->redirect(array('controller' => 'users', 'action' => 'home'));
		}
		else $this->redirect(array('controller' => 'users', 'action' => 'home'));
		//End checking the factory assigned to this user or not
		
		
		$this->loadModel("Factory");
		$res =  $this->Factory->Query("SELECT factory_name FROM factories WHERE id='$factory_id' ");
		$factory_name = $res[0]['factories']['factory_name'];
		$this->set('factory_name', $factory_name );
		
		
		$this->set('section', $section);
		$question_sec = $this->Survey->find('all', array('order' => array('Survey.order ASC'), 'conditions' => array('Survey.section' => $section)) ) ;
		//$this->set('questions', $this->Survey->findAllBySection($section) );
		$this->set('questions', $question_sec );
		
		
		//$this->set('inside_table_questions', $this->Survey->find('all', array('order' => array('survey.order ASC','survey.question ASC'), 'conditions' => array('Survey.section' => $section)) ) );
		
		
		$this->loadModel("RatingRule");
		$this->set('rating_rules', $this->RatingRule->findAllBySection($section) );
		
		
		$this->loadModel("FactoryAnsTable");
		//$ans =  $this->FactoryAnsTable->findAllByFactoryId($factory_id);
		$ans =  $this->FactoryAnsTable->Query("SELECT * FROM factory_ans_tables AS FactoryAnsTable WHERE factory_id='$factory_id' AND section='$section' ");
		$this->set('factory_answers', $ans );
	}
	
	
	
	function CompleteView($factory_id = null ){
		
		$id = $this->Auth->User('id');
				
		//Start checking the factory assigned to this user or not
		if( !empty($factory_id)){
	
			$id = $this->Auth->User('id');
			$this->loadModel('Factory');
			//$this->set('factory', $this->Factory->findAllById($factory_id) );		//seba/users/factory/2
			
			$res = $this->Factory->findAllById($factory_id) ;
			$res_id = $res[0]['User']['id'];
			$factory_name = $res[0]['Factory']['factory_name'];
			
			if($id == $res_id){
				$this->set('factory_id', $factory_id );
				$this->set('factory_name', $factory_name );
			}
			
			else $this->redirect(array('controller' => 'users', 'action' => 'home'));
		}
		else $this->redirect(array('controller' => 'users', 'action' => 'home'));
		//End checking the factory assigned to this user or not
		
		$this->loadModel("Factory");
		$res =  $this->Factory->Query("SELECT factory_name FROM factories WHERE id='$factory_id' ");
		$factory_name = $res[0]['factories']['factory_name'];
		$this->set('factory_name', $factory_name );
		
		
		//$this->set('section', $section);
		$this->set('questions', $this->Survey->find("all", array('order' => array('Survey.section ASC','Survey.order ASC' ))) );
		//$this->set('questions', $this->Survey->Query("SELECT * FROM questions AS Survey ORDER BY section ASC") );
		
			
		
		$this->loadModel("FactoryAnsTable");
		//$ans =  $this->FactoryAnsTable->findAllByFactoryId($factory_id);
		$ans =  $this->FactoryAnsTable->Query("SELECT * FROM factory_ans_tables AS FactoryAnsTable WHERE factory_id='$factory_id' ORDER BY question_id ASC");
		$this->set('factory_answers', $ans );
	}
	
		
		
		
		
	function index() {
		$this->Survey->recursive = 0;
		$this->set('questions', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->flash(__('Invalid question', true), array('action' => 'index'));
		}
		$this->set('question', $this->Survey->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Survey->create();
			if ($this->Survey->save($this->data)) {
				$this->flash(__('Question saved.', true), array('action' => 'index'));
			} else {
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->flash(sprintf(__('Invalid question', true)), array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Survey->save($this->data)) {
				$this->flash(__('The question has been saved.', true), array('action' => 'index'));
			} else {
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Survey->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->flash(sprintf(__('Invalid question', true)), array('action' => 'index'));
		}
		if ($this->Survey->delete($id)) {
			$this->flash(__('Question deleted', true), array('action' => 'index'));
		}
		$this->flash(__('Question was not deleted', true), array('action' => 'index'));
		$this->redirect(array('action' => 'index'));
	}
	function admin_index() {
		$this->Survey->recursive = 0;
		$this->set('questions', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->flash(__('Invalid question', true), array('action' => 'index'));
		}
		$this->set('question', $this->Survey->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Survey->create();
			if ($this->Survey->save($this->data)) {
				$this->flash(__('Question saved.', true), array('action' => 'index'));
			} else {
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->flash(sprintf(__('Invalid question', true)), array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Survey->save($this->data)) {
				$this->flash(__('The question has been saved.', true), array('action' => 'index'));
			} else {
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Survey->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->flash(sprintf(__('Invalid question', true)), array('action' => 'index'));
		}
		if ($this->Survey->delete($id)) {
			$this->flash(__('Question deleted', true), array('action' => 'index'));
		}
		$this->flash(__('Question was not deleted', true), array('action' => 'index'));
		$this->redirect(array('action' => 'index'));
	}
}
?>