<?php
class AdminsController extends AppController {
	
	var $name = 'Admin';
    //var $components = array('Auth');
	
	function beforeFilter() {
		//parent::beforeFilter(); 
		//$this->Auth->allow('*');
		if( $this->Session->read('Auth.User.status') == 0 ) // status means admin
			$this->redirect( array('controller'=>'pages') );
	}
	
	function index(){
		$this->loadModel('Factory');
		$this->set("factories", $this->Factory->query("SELECT id,factory_name,status FROM factories ORDER BY status DESC") );
		
		$this->loadModel('Report');
		$this->set("reports" , $this->Report->find("all") );
		
	}
	
	function ByFacility(){
		echo '<pre>';
		print_r($_POST);
		echo '</pre>';
		
		$this->loadModel('Factory');
		$this->set("cities", $this->Factory->query("SELECT DISTINCT city FROM factories as Factory ORDER BY city ASC") );
		$this->set("areas", $this->Factory->query("SELECT DISTINCT area FROM factories as Factory ORDER BY area ASC") );
		
		$this->loadModel("FactoryAnsTable");
		if( !empty($_POST['BGMEA']) ){
			$ans_id=$_POST['BGMEA'];
			$ans =  $this->FactoryAnsTable->find("all", array('conditions' => array('FactoryAnsTable.ans_id' => $ans_id,'FactoryAnsTable.type' => 'chk')));
		}
		
		if( !empty($_POST['BEOGWIOA']) ){
			$ans_id=$_POST['BEOGWIOA'];
			$ans =  $this->FactoryAnsTable->find("all", array('conditions' => array('FactoryAnsTable.ans_id' => $ans_id,'FactoryAnsTable.type' => 'chk')));
		}
		
		if( empty($ans) ) 
			$ans=$this->Factory->find("all", array('conditions' => array('Factory.status' => 1)));
		
		$this->set("factories" , $ans );
		
	}
	
	function BySection(){
		//$this->loadModel('Rating');
		//$res = $this->Rating->Find("all");
		
		//$this->set("search_result",$res);
		//$this->set("search_query",$_POST);
		
		$this->loadModel('Factory');
		$factories = $this->Factory->Find("all", array('conditions'=> array('Factory.status' => 1))  );
		$this->set("factories",$factories);
		
		/*
		echo '<pre style="text-align:left">';
			print_r($res);
		echo "</pre>";
		*/
		
	}
	
	function ByQuestion(){
			
		if(!empty($_POST['section']) ){
			$section = $_POST['section'];	
			$this->loadModel('Survey');
			$this->set('questions', $this->Survey->find('all', array('order' => array('survey.order ASC'), 'conditions' => array('Survey.section' => $section)) ) );
			//$this->set('questions', $this->Survey->find("all") );
		}
		if(!empty($_POST['q_ans_id']) ){
			$ans_id = $_POST['q_ans_id'];
			$question_id = $_POST['q_id'];
			$this->loadModel("FactoryAnsTable");
			
			$ans =  $this->FactoryAnsTable->findAllByAnsId($ans_id);
			//$ans =  $this->FactoryAnsTable->Query("SELECT * FROM factory_ans_tables AS FactoryAnsTable WHERE ans_id='$ans_id' ORDER BY question_id ASC");
			
			$this->set('factory_answers', $ans );
			//$this->set('questions', $this->Survey->find("all") );
		}
	}
	
	function SectionToSection(){
		$this->loadModel('Rating');
		$res = $this->Rating->Find("all");
		
		$this->set("search_result",$res);
		
	}
	
	function QuestionToQuestion( ) {
		if(!empty($_POST['section']) ){
			$section = $_POST['section'];	
			$this->loadModel('Survey');
			$this->set('questions', $this->Survey->find('all', array('order' => array('survey.order ASC'), 'conditions' => array('Survey.section' => $section)) ) );
			//$this->set('questions', $this->Survey->find("all") );
		}
		if(!empty($_POST['q_ans_id']) ){
			$ans_id = $_POST['q_ans_id'];
			$question_id = $_POST['q_id'];
			$this->loadModel("FactoryAnsTable");
			
			$ans =  $this->FactoryAnsTable->findAllByAnsId($ans_id);
			//$ans =  $this->FactoryAnsTable->Query("SELECT * FROM factory_ans_tables AS FactoryAnsTable WHERE ans_id='$ans_id' ORDER BY question_id ASC");
			
			$this->set('factory_answers', $ans );
			//$this->set('questions', $this->Survey->find("all") );
		}
	}
	
	function SectionToQuestion( ) {
	}
	
	function report( ) {
		
		//$this->loadModel('Report');
		//$this->set("reports" , $this->Report->find("all") );
		//$this->set("reports" , $this->Report->query("SELECT * from reports") );
		
		//$this->loadModel('FactoryAnsTable');
		//$this->set("list_ans_id", $this->FactoryAnsTable->query("SELECT factory_id,question_id,ans_id,text FROM factory_ans_tables WHERE type != 'text' ") );
		
	}


	
	function ReportByCriteria( $criteria_id ) {
		
		echo'<pre>';
		print_r($_POST);
		echo'</pre>';
		
		/*if( !empty($criteria_id)){
	
			$this->loadModel('Report');
			
			$this->set("reports" , $this->Report->findAllById($criteria_id) );
			$test = $this->Report->findAllById($criteria_id);
			
			$this->loadModel('FactoryAnsTable');
			$this->set("list_ans_id", $this->FactoryAnsTable->query("SELECT question_id,ans_id,text FROM factory_ans_tables WHERE type != 'text' ") );
			
			
			
		}
		else $this->redirect(array('controller' => 'admins', 'action' => 'index'));
		
		
		
		echo'<pre>';
		print_r($test);
		echo'</pre>';
		//$this->set("reports" , $this->Report->query("SELECT * from reports") );
		
		*/
		
	}
	
	function FacilityReport($factory_id = null) {
		/*
		echo '<pre>';
		print_r($_POST);
		echo '</pre>';
		*/
		if( isset($_POST['facility']) )	$factory_id = $_POST['facility'];
		
		if( !empty($factory_id)){
	
			$id = $this->Auth->User('id');
			$this->loadModel('Factory');
			
			$res = $this->Factory->findAllById($factory_id) ;
			$res_id = $res[0]['User']['id'];
			
			$this->set('factory', $res);
			
		}
		else $this->redirect(array('controller' => 'admins', 'action' => 'index'));
				
	}
	
	function SectionReport( $section = null , $factory_id = null ){
		
		$id = $this->Auth->User('id');
				
		//Start checking the factory assigned to this user or not
		if( empty($factory_id) || empty($section) )
			$this->redirect(array('controller' => 'admins', 'action' => 'index'));
		//End checking the factory assigned to this user or not
		
		
		//$question = $this->Survey->findAllBySection(1);
		//$this->set('questions', $question );
		
		$this->set('factory_id', $factory_id );
		$this->set('section', $section);
		
		$this->loadModel('Survey');
		$this->set('questions', $this->Survey->findAllBySection($section) );
		
		$this->loadModel("RatingRule");
		$this->set('rating_rules', $this->RatingRule->findAllBySection($section) );
		
		$this->loadModel("FactoryAnsTable");
		//$ans =  $this->FactoryAnsTable->findAllByFactoryId($factory_id);
		$ans =  $this->FactoryAnsTable->Query("SELECT * FROM factory_ans_tables AS FactoryAnsTable WHERE factory_id='$factory_id' ORDER BY question_id ASC");
		$this->set('factory_answers', $ans );
	}
	
	function CompleteView( $factory_id = null ){
		
		$id = $this->Auth->User('id');
				
		//Start checking the factory assigned to this user or not
		if( empty($factory_id) )
			$this->redirect(array('controller' => 'admins', 'action' => 'index'));
		//End checking the factory assigned to this user or not
		
		
		//$question = $this->Survey->findAllBySection(1);
		//$this->set('questions', $question );
		
		$this->set('factory_id', $factory_id );
		//$this->set('section', $section);
		
		$this->loadModel('Survey');
		$this->set('questions', $this->Survey->find("all") );
		
		
		$this->loadModel("FactoryAnsTable");
		//$ans =  $this->FactoryAnsTable->findAllByFactoryId($factory_id);
		$ans =  $this->FactoryAnsTable->Query("SELECT * FROM factory_ans_tables AS FactoryAnsTable WHERE factory_id='$factory_id' ORDER BY question_id ASC");
		$this->set('factory_answers', $ans );
	}
	
	
	function ajaxquestion(){
		$this->autoRender = false;
		$section= $_REQUEST['id'];
		
		$this->loadModel('Survey');
		$questions =  $this->Survey->find('all', array('order' => array('survey.order ASC'), 'conditions' => array('Survey.section' => $section)) ) ;
		/*
		echo '<pre>';
		print_r($questions);
		echo '</pre>';
		*/
		$res = "[";
		foreach($questions as $question){
			if( !empty($question['Answer']))
			{
			$q = $question['Survey']['question'];
			$q_id = $question['Survey']['id'];
			$q_50 = substr($question['Survey']['question'],0 ,20) ;
			
			$res.="{optionValue: ".$q_id.", optionDisplay: '".$q_50."', optionTitle: 'mehedi'}, ";
			}
		}
		$res.="]";
		
		echo $res;
	}
	
	function ajaxanswer(){
		$this->autoRender = false;
		$id = $_REQUEST['id'];
		
		$this->loadModel('Survey');
		$questions =  $this->Survey->find('all', array('order' => array('survey.order ASC'), 'conditions' => array('Survey.id' => $id)) ) ;
		
		/*echo '<pre>';
		print_r($questions);
		echo '</pre>';*/
		
		$res = "[";
		
		if( !empty($questions[0]['Answer'])){
			foreach($questions[0]['Answer'] as $answer){
				$q = $answer['answer'];
				$q_id = $answer['id'];
				$res.="{optionValue: ".$q_id.", optionDisplay: '".$q."'}, ";
			}
		}
		
		$res.="]";
		
		echo $res;
	}
	 function test(){
	 	$this->autoRender = false;
		
	 	$test= "[ 
			{optionValue: 0, optionDisplay: 'Mark'}, {optionValue:1, optionDisplay: 'Andy'},
		
		]";
		//echo $test;
		return($test);
	 }
}
?>