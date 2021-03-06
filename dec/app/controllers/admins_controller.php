<?php
class AdminsController extends AppController {
	
	var $name = 'Admin';
    //var $components = array('Auth');
	var $helpers = array('Html', 'Javascript'); 
	
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
		/*echo '<pre>';
		print_r($_POST);
		echo '</pre>';
		*/
		$this->loadModel('Factory');
		$this->set("cities", $this->Factory->query("SELECT DISTINCT city FROM factories as Factory ORDER BY city ASC") );
		$this->set("areas", $this->Factory->query("SELECT DISTINCT area FROM factories as Factory ORDER BY area ASC") );
		
		$this->loadModel("AdminFactory");
		//$res =  $this->AdminFactory->find("all", array('conditions' => array('AdminFactory.status' => 1,'FactoryAnsTable.type' => 'chk')));
		
		if( !empty($_POST['reg']) ){ 
			if($_POST['reg'] == "BGMEA")	$this->AdminFactory->contain('Rating','FactoryAnsTable.ans_id = "177" ');
			elseif($_POST['reg'] == "BEOGWIOA")	$this->AdminFactory->contain('Rating','FactoryAnsTable.ans_id = "178"');
		}
		else $this->AdminFactory->contain('Rating');
		
		
				
		if( !empty($_POST['city']) & empty($_POST['area']) ){
			$city = $_POST['city'];
			$condition = array('AdminFactory.status' => 1, 'AdminFactory.city' => $city );
		}
		elseif( empty($_POST['city']) & !empty($_POST['area']) ){
			$area = $_POST['area'];
			$condition = array('AdminFactory.status' => 1, 'AdminFactory.area' => $area );
		}
		elseif( !empty($_POST['city']) & !empty($_POST['area']) ){
			$city = $_POST['city'];
			$area = $_POST['area'];
			$condition = array('AdminFactory.status' => 1, 'AdminFactory.city' => $city , 'AdminFactory.area' => $area );
		}
		else  $condition = array('AdminFactory.status' => 1 );
		
		$res =  $this->AdminFactory->find("all", array('conditions' => $condition));
		$this->set("factories" , $res );
		
		//$this->set("factories_all" , $this->AdminFactory->find("all", array('conditions' => array('AdminFactory.status' => 1 ))) );
						
		/*echo '<pre>';
		print_r($res);
		echo '</pre>';*/
		
		
		$this->loadModel("RatingRule");
		$res =  $this->RatingRule->find("all");
		$this->set("rating_rules" , $res );
		
		
		$this->loadModel('WeightFactor');
		$this->set('weight_factor', $this->WeightFactor->Find("all") );
		
		/*$this->loadModel("FactoryAnsTable");
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
		*/
	}
	function ByStandard(){
		
		$res =  $this->Admin->query("SELECT factories.id, factories.factory_name, SUM(rating_rules.point)*100/70 AS local, SUM(rating_rules.point_hnm)*100/70 AS HNM, SUM(rating_rules.point_wrap)*100/70 AS WRAP
FROM factories 
LEFT JOIN ratings ON factories.id=ratings.factory_id 
LEFT JOIN rating_rules ON ratings.section=rating_rules.section 
WHERE ratings.points=rating_rules.point AND factories.status=1
GROUP BY factories.factory_name");
		
		$this->set("factories" , $res );
		
	}
	function ByFacilityg(){
		/*echo '<pre>';
		print_r($_POST);
		echo '</pre>';
		*/
		$this->loadModel('Factory');
		$this->set("cities", $this->Factory->query("SELECT DISTINCT city FROM factories as Factory ORDER BY city ASC") );
		$this->set("areas", $this->Factory->query("SELECT DISTINCT area FROM factories as Factory ORDER BY area ASC") );
		
		$this->loadModel("AdminFactory");
		//$res =  $this->AdminFactory->find("all", array('conditions' => array('AdminFactory.status' => 1,'FactoryAnsTable.type' => 'chk')));
		
		if( !empty($_POST['reg']) ){ 
			if($_POST['reg'] == "BGMEA")	$this->AdminFactory->contain('Rating','FactoryAnsTable.ans_id = "177" ');
			elseif($_POST['reg'] == "BEOGWIOA")	$this->AdminFactory->contain('Rating','FactoryAnsTable.ans_id = "178"');
		}
		else $this->AdminFactory->contain('Rating');
		
		
				
		if( !empty($_POST['city']) & empty($_POST['area']) ){
			$city = $_POST['city'];
			$condition = array('AdminFactory.status' => 1, 'AdminFactory.city' => $city );
		}
		elseif( empty($_POST['city']) & !empty($_POST['area']) ){
			$area = $_POST['area'];
			$condition = array('AdminFactory.status' => 1, 'AdminFactory.area' => $area );
		}
		elseif( !empty($_POST['city']) & !empty($_POST['area']) ){
			$city = $_POST['city'];
			$area = $_POST['area'];
			$condition = array('AdminFactory.status' => 1, 'AdminFactory.city' => $city , 'AdminFactory.area' => $area );
		}
		else  $condition = array('AdminFactory.status' => 1 );
		
		$res =  $this->AdminFactory->find("all", array('conditions' => $condition));
		$this->set("factories" , $res );
						
		/*echo '<pre>';
		print_r($res);
		echo '</pre>';*/
		
		
		$this->loadModel("RatingRule");
		$res =  $this->RatingRule->find("all");
		$this->set("rating_rules" , $res );
		
		
		$this->loadModel('WeightFactor');
		$this->set('weight_factor', $this->WeightFactor->Find("all") );
		
		/*$this->loadModel("FactoryAnsTable");
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
		*/
	}
	function ByOverview($section=null, $point=null){
		$this->loadModel('WeightFactor');
		$res = $this->WeightFactor->find("all");
		$this->set('all_rules',$res );
		
		if( isset($section) and isset($point)){
			$facility_number = $this->Admin->query("SELECT COUNT(*) AS tot FROM factories WHERE factories.status=1");
			
			$result_number = $this->Admin->query("SELECT COUNT(factories.id) AS res FROM factories 
	LEFT JOIN ratings ON factories.id=ratings.factory_id
	WHERE factories.status=1 AND ratings.section=$section AND ratings.points=$point");
			
			$result_query = $this->Admin->query("SELECT rating_rules.rule FROM rating_rules WHERE rating_rules.section=$section AND rating_rules.point=$point");
	
			$result[]=$facility_number[0][0]['tot'];
			$result[]=$result_number[0][0]['res'];
			$result[]=$result_query[0]['rating_rules']['rule'];
			$this->set('result',$result );
			$this->set('section',$section );
			$this->set('point',$point );
			
		}
		//echo "<pre>";
		//print_r($result);
		//echo "</pre>";
		
	}
	function ByOverviewtable($section=null, $point=null){		
		
		if( isset($section) and isset($point)){
			
			
			$result = $this->Admin->query("SELECT factories.id,factories.factory_name  FROM factories 
LEFT JOIN ratings ON factories.id=ratings.factory_id
WHERE factories.status=1 AND ratings.section=$section AND ratings.points=$point");
			
			
			$this->set('tables',$result );
		}
		//echo "<pre>";
		//print_r($result);
		//echo "</pre>";
		
	}
	function ByBuyer($section=null, $point=null){
		
		if( !empty($_POST) ){
			
			$buyer = $_POST['buyer'];
			$result = $this->Admin->query("SELECT factories.id,factories.factory_name,fat.text ,SUM(rating_rules.point)*100/70 as rating FROM `factory_ans_tables` AS fat 
LEFT JOIN factories ON fat.factory_id = factories.id
LEFT JOIN ratings ON factories.id=ratings.factory_id 
LEFT JOIN rating_rules ON ratings.section=rating_rules.section 
WHERE ratings.points=rating_rules.point AND factories.status=1 AND fat.question_id=214 AND fat.text LIKE '%$buyer%' 
GROUP BY factories.factory_name");
	
			
			
			$this->set('result',$result );
			//echo "<pre>";
			//print_r($result);
			//echo "</pre>";
			
		}
		
	}
	function BySection(){
		if( !empty($_POST) )	$this->Session->write('custom_weight_factor', $_POST);
		
		$this->loadModel('WeightFactor');
		$weight_factor = $this->WeightFactor->Find("all");
		$this->set('standard_weight_factor', $weight_factor);
		
		$this->loadModel('Factory');
		$factories = $this->Factory->Find("all", array('conditions'=> array('Factory.status' => 1))  );
		//$this->set("factories",$factories);
		
		/*
		echo '<pre style="text-align:left">';
			print_r($factories);
		echo "</pre>";
		*/
		
		
		// Start rating is calculated for all the factories and then ordered ASC		
		$res = 0;
		foreach($factories as $factory){
			if(!empty($factory['Rating']) ){
				$point=0;
				$total_posible_point=0.0;
				$total_factory_point=0.0;
				foreach($factory['Rating'] as $rate_info){
					$chk_name = "chk_".$rate_info['section'];
					$section_wf = !empty($_POST[$chk_name]) ? floatval($_POST[$chk_name]) : 0;
								
					$total_posible_point += ( floatval($section_wf)* 5.0 );
					$total_factory_point += ( floatval($section_wf)* floatval($rate_info['points']) );
				}
				//echo $total_factory_point." ".$total_posible_point. " "; 
				
				if(! empty($total_posible_point) ){
					$res = ($total_factory_point/$total_posible_point)*100 ;
					
					$res = number_format($res, 2, '.', '');
				}
				// End rating in percentage genration
				
				$ordered_sorted_factory[] = array("id"=>$factory['Factory']['id'], "factory_name"=>$factory['Factory']['factory_name'], "rating"=>$res, "city"=> $factory['Factory']['city'], "area"=>$factory['Factory']['area'] );
				
			}
		}		
		// End rating is calculated for all the factories and then ordered ASC
		
		$this->set("ordered_sorted_factory",$ordered_sorted_factory);
		
		
		
	}
	function SingleFacilityAnalysis($posted_id =1){
		if(!empty($_POST)) $posted_id = $_POST['fact'];
		if(empty($posted_id)) $posted_id=1;
		$this->set("posted_id",$posted_id);
		
		$all_facilities = $this->Admin->query("SELECT factories.id,factories.factory_name FROM factories WHERE factories.status!=0");
		$this->set('factories', $all_facilities );
		
		$section_avg_all_facilities = $this->Admin->query("SELECT ratings.section,SUM(ratings.points)/COUNT(*) AS point  FROM factories 
LEFT JOIN ratings ON factories.id=ratings.factory_id WHERE
factories.status != 0 GROUP BY ratings.section");
		$this->set('section_avg_all_facilities', $section_avg_all_facilities );
		
		$section_avg_single_facilities = $this->Admin->query("SELECT ratings.section,ratings.points FROM factories 
LEFT JOIN ratings ON factories.id=ratings.factory_id WHERE
factories.id =$posted_id");
		$this->set('section_avg_single_facilities', $section_avg_single_facilities );
		
		
		//echo "<pre>";
		//print_r($section_avg_single_facilities);
		//echo "</pre>";
	}
	
	function ByQuestion(){
		if(!empty($_POST['q_ans_id']) ){
			$ans_id = $_POST['q_ans_id'];
			
			//===== Start store ans in session
			$session_ans_id = $this->Session->read('ans_id_list');
			if( empty($session_ans_id) ){
				$this->Session->write('ans_id_list', $ans_id);
				$session_ans_id = $ans_id;
			}
			else {
				$i=0;
				$session_splitted_ans_id = explode(",", $session_ans_id);
				foreach($session_splitted_ans_id as $key => $val){
					if($ans_id == $val) $i=1;
				}
				if( $i == 0 ){
					$session_ans_id = $session_ans_id.",".$ans_id;
					$this->Session->write('ans_id_list', $session_ans_id);
				}
			}
			//===== End store ans in session
			
			
			$session_splitted_ans_id = explode(",", $this->Session->read('ans_id_list'));
			foreach($session_splitted_ans_id as $key => $val){
				//echo $val." ";
				$cond[]['Answer.id'] = $val;
			}
			
			$this->loadModel('Answer');
			//$condition = array('Answer.id' => $session_ans_id ) ;
			$condition= array( 'OR' => $cond);
			$res =  $this->Answer->find("all", array('conditions' => $condition));
			$this->set("ans" , $res );
			//echo '<pre>';
			//print_r($res);
			//echo '</pre>';
		
			
			$this->loadModel("AdminFactory");
			//$condition = array('AdminFactory.status' => 1 );
			$condition = array('AdminFactory.status' => 1);
			//$this->AdminFactory->contain("Rating","FactoryAnsTable.ans_id = $ans_id");
			$this->AdminFactory->contain("Rating","FactoryAnsTable.ans_id");
			$res =  $this->AdminFactory->find("all", array('conditions' => $condition));
			$this->set("factories" , $res );
			
			//echo '<pre>';
			//print_r($res);
			//echo '</pre>';
			$this->loadModel('WeightFactor');
			$this->set('weight_factor', $this->WeightFactor->Find("all") );
		}
		
		elseif(!empty($_POST['section']) ){
			$section = $_POST['section'];	
			$this->loadModel('Survey');
			$this->set('questions', $this->Survey->find('all', array('order' => array('order ASC'), 'conditions' => array('Survey.section' => $section)) ) );
			//$this->set('questions', $this->Survey->find("all") );
		}

		elseif(!empty($_POST['clear']) ){
			//Start erase last ans id from session ans id list
			$session_splitted_ans_id = explode(",", $this->Session->read('ans_id_list'));
			$array_size  = sizeof($session_splitted_ans_id);
			$new_session_id_list ="";
			for($i=0 ; $i < $array_size-1 ; $i++){
				if( empty($new_session_id_list) )	$new_session_id_list = $session_splitted_ans_id[$i] ;
				else	$new_session_id_list = $new_session_id_list.",".$session_splitted_ans_id[$i] ;
			}
			$this->Session->write('ans_id_list', $new_session_id_list);
			//End erase last ans id from session ans id list
			
			
			
			$session_splitted_ans_id = explode(",", $this->Session->read('ans_id_list'));
			foreach($session_splitted_ans_id as $key => $val){
				echo $val." ";
				$cond[]['Answer.id'] = $val;
			}
			$this->loadModel('Answer');
			$condition= array( 'OR' => $cond);
			$res =  $this->Answer->find("all", array('conditions' => $condition));
			$this->set("ans" , $res );
			
			
			$this->loadModel("AdminFactory");
			$condition = array('AdminFactory.status' => 1);
			$this->AdminFactory->contain("Rating","FactoryAnsTable.ans_id");
			$res =  $this->AdminFactory->find("all", array('conditions' => $condition));
			$this->set("factories" , $res );
			
			//echo '<pre>';
			//print_r($res);
			//echo '</pre>';
		}
		
		else{
			$this->Session->delete('ans_id_list');
		}
		
		
	}
	
	function SectionToSection(){
		$this->loadModel('Rating');
		$res = $this->Rating->Find("all");
		
		$this->set("search_result",$res);
		
	}
	
	function QuestionToQuestion( ) {
		/*if(!empty($_POST['section']) ){
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
		}*/
	}
	
	function SectionToQuestion( ) {
		
		if(!empty($_POST['q_ans_id']) ){
			$ans_id = $_POST['q_ans_id'];
			
			//===== Start store ans in session
			$session_ans_id = $this->Session->read('ans_id_list');
			if( empty($session_ans_id) ){
				$this->Session->write('ans_id_list', $ans_id);
				$session_ans_id = $ans_id;
			}
			else {
				$i=0;
				$session_splitted_ans_id = explode(",", $session_ans_id);
				foreach($session_splitted_ans_id as $key => $val){
					if($ans_id == $val) $i=1;
				}
				if( $i == 0 ){
					$session_ans_id = $session_ans_id.",".$ans_id;
					$this->Session->write('ans_id_list', $session_ans_id);
				}
			}
			//===== End store ans in session
			
			
			$session_splitted_ans_id = explode(",", $this->Session->read('ans_id_list'));
			foreach($session_splitted_ans_id as $key => $val){
				echo $val." ";
				$cond[]['Answer.id'] = $val;
			}
			
			$this->loadModel('Answer');
			//$condition = array('Answer.id' => $session_ans_id ) ;
			$condition= array( 'OR' => $cond);
			$res =  $this->Answer->find("all", array('conditions' => $condition));
			$this->set("ans" , $res );
			/*echo '<pre>';
			print_r($res);
			echo '</pre>';*/
		
			
			$this->loadModel("AdminFactory");
			//$condition = array('AdminFactory.status' => 1 );
			$condition = array('AdminFactory.status' => 1);
			//$this->AdminFactory->contain("Rating","FactoryAnsTable.ans_id = $ans_id");
			$this->AdminFactory->contain("Rating","FactoryAnsTable.ans_id");
			$res =  $this->AdminFactory->find("all", array('conditions' => $condition));
			$this->set("factories" , $res );
			
			/*echo '<pre>';
			print_r($res);
			echo '</pre>';*/
		}
		
		elseif(!empty($_POST['section']) ){
			$section = $_POST['section'];	
			$this->loadModel('Survey');
			$this->set('questions', $this->Survey->find('all', array('order' => array('survey.order ASC'), 'conditions' => array('Survey.section' => $section)) ) );
			//$this->set('questions', $this->Survey->find("all") );
		}

		elseif(!empty($_POST['clear']) ){
			//Start erase last ans id from session ans id list
			$session_splitted_ans_id = explode(",", $this->Session->read('ans_id_list'));
			$array_size  = sizeof($session_splitted_ans_id);
			$new_session_id_list ="";
			for($i=0 ; $i < $array_size-1 ; $i++){
				if( empty($new_session_id_list) )	$new_session_id_list = $session_splitted_ans_id[$i] ;
				else	$new_session_id_list = $new_session_id_list.",".$session_splitted_ans_id[$i] ;
			}
			$this->Session->write('ans_id_list', $new_session_id_list);
			//End erase last ans id from session ans id list
			
			
			
			$session_splitted_ans_id = explode(",", $this->Session->read('ans_id_list'));
			foreach($session_splitted_ans_id as $key => $val){
				echo $val." ";
				$cond[]['Answer.id'] = $val;
			}
			$this->loadModel('Answer');
			$condition= array( 'OR' => $cond);
			$res =  $this->Answer->find("all", array('conditions' => $condition));
			$this->set("ans" , $res );
			
			
			$this->loadModel("AdminFactory");
			$condition = array('AdminFactory.status' => 1);
			$this->AdminFactory->contain("Rating","FactoryAnsTable.ans_id");
			$res =  $this->AdminFactory->find("all", array('conditions' => $condition));
			$this->set("factories" , $res );
			
			/*echo '<pre>';
			print_r($res);
			echo '</pre>';*/
		}
		
		else{
			$this->Session->delete('ans_id_list');
		}
		
		
	}
	
	function report( ) {
		
		//$this->loadModel('Report');
		//$this->set("reports" , $this->Report->find("all") );
		//$this->set("reports" , $this->Report->query("SELECT * from reports") );
		
		//$this->loadModel('FactoryAnsTable');
		//$this->set("list_ans_id", $this->FactoryAnsTable->query("SELECT factory_id,question_id,ans_id,text FROM factory_ans_tables WHERE type != 'text' ") );
		
	}


	

	
	function FacilityReportold($factory_id = null) {
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
			
			$this->loadModel('WeightFactor');
			$this->set('weight_factor', $this->WeightFactor->Find("all") );
			
		}
		else $this->redirect(array('controller' => 'admins', 'action' => 'index'));			
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
			
			$res = $this->Admin->query("SELECT factories.*, rating_rules.section, rating_rules.point, rating_rules.point_hnm, rating_rules.point_wrap
				FROM factories 
				LEFT JOIN ratings ON factories.id=ratings.factory_id 
				LEFT JOIN rating_rules ON ratings.section=rating_rules.section 
				WHERE ratings.points=rating_rules.point AND factories.status=1 AND factories.id = $factory_id
				ORDER BY rating_rules.section ASC");
			$this->set('factory', $res);
			
			$this->set('followups',$this->Admin->query("SELECT DISTINCT(created),doc,fw_date FROM `followups` WHERE factory_id = $factory_id") );
			
		}
		else $this->redirect(array('controller' => 'admins', 'action' => 'index'));			
	}
	
	function FacilityCustomReport($factory_id = null){
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
			
			$this->loadModel('WeightFactor');
			$this->set('weight_factor', $this->WeightFactor->Find("all") );
			
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
	
	
	
	function SectionEdit($section = null,$factory_id = null){
	
		//Start checking the factory assigned to this user or not
		if( !empty($factory_id) & !empty($section)){
		$id = $this->Auth->User('id');
			$this->loadModel('Factory');
			$res = $this->Factory->findAllById($factory_id) ;
			$factory_name = $res[0]['Factory']['factory_name'];
						
			
			if( !empty($factory_name) ){
				$this->set('factory_name', $factory_name );
				$this->set('factory_id', $factory_id );
			}
			
			else $this->redirect(array('controller' => 'admins', 'action' => 'index'));
		}
		else $this->redirect(array('controller' => 'admins', 'action' => 'index'));
		//End checking the factory assigned to this user or not
		
		
		$this->set('section', $section);
		//$this->set('questions', $this->Survey->findAllBySection($section) );
		
		$this->loadModel('Survey');
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
				$this->redirect(array('controller' => 'admins', 'action' => 'FacilityReport', $factory_id));
			}
			else{
				//echo "rate saving problem";
				$this->redirect(array('controller' => 'admins', 'action' => 'FacilityReport',$factory_id));
			}
		} 
		else {
			//echo "Anwer saving problem";
			$this->redirect(array('controller' => 'admins', 'action' => 'FacilityReport',$factory_id));
		}
		
		//$this->set('factory_ans', $test);
		
		/*echo '<pre style="text-align:left">';
		print_r($data_set);
		echo "</pre>";*/
		
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
		//$this->set('questions', $this->Survey->find("all") );
		$this->set('questions', $this->Survey->find("all", array('order' => array('Survey.section ASC','Survey.order ASC' ))) );
		
		
		$this->loadModel("FactoryAnsTable");
		//$ans =  $this->FactoryAnsTable->findAllByFactoryId($factory_id);
		$ans =  $this->FactoryAnsTable->Query("SELECT * FROM factory_ans_tables AS FactoryAnsTable WHERE factory_id='$factory_id' ORDER BY question_id ASC");
		$this->set('factory_answers', $ans );
	}
	
	function ComparisonAnalysis(){
		$qry="";
		//print_r($_POST);
		if(!empty($_POST['criteria'])){
			if($_POST['criteria']=="high")
				$qry = " HAVING SUM(ratings.points)*100/70 < 50 ";
			elseif($_POST['criteria']=="mid")
				$qry = " HAVING SUM(ratings.points)*100/70 > 50 ";
			elseif($_POST['criteria']=="low")
				$qry = " HAVING SUM(ratings.points)*100/70 > 80 ";
		
		}
		
		$res = $this->Admin->query("SELECT count( fat.factory_id ) as common,questions.section,questions.question, answers.answer FROM `factory_ans_tables` AS fat
INNER JOIN (SELECT factories.id FROM factories
LEFT JOIN ratings ON ratings.factory_id=factories.id WHERE factories.status != 0
GROUP BY factories.id   $qry) as res 
on res.id=fat.factory_id

LEFT JOIN answers ON answers.id=fat.ans_id
LEFT JOIN questions on questions.id=answers.question_id
WHERE fat.ans_id !=0 
GROUP BY fat.ans_id
ORDER BY common DESC
limit 0,20
");
		$count = sizeof($this->Admin->query("SELECT factories.id FROM factories
LEFT JOIN ratings ON ratings.factory_id=factories.id WHERE factories.status != 0
GROUP BY factories.id $qry"));
		
		
		$this->set('results', $res );
		$this->set('count', $count );

	 }
	 function followup($factory_id = null){
		
		$this->loadModel('Factory');
		$res = $this->Factory->findAllById($factory_id) ;
		$factory_name = $res[0]['Factory']['factory_name'];
		$this->set('factory_name', $factory_name );
		$this->set('factory_id', $factory_id );
		
	 }
	 
	 
	 function FollowupView($factory_id= null , $version= 1){
		//$this->set('factory_id',$factory_id);
			 
		//Start checking the factory assigned to this user or not
		if( !empty($factory_id) and !empty($version)){
	
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
			
			//else $this->redirect(array('controller' => 'users', 'action' => 'home'));
			
			
			$factories = $this->Factory->query("SELECT * FROM `followups` WHERE factory_id = $factory_id AND status=$version ORDER BY `section` ASC") ;
			
			$this->set('factory_info', $res[0]['Factory'] );
			$this->set('factories', $factories );		
			
		}
		else $this->redirect(array('controller' => 'users', 'action' => 'home'));
		//End checking the factory assigned to this user or not
		
		
	}
	function caps( $cap_id = null){
		if(!empty($cap_id)){
			//$cap_id = $_POST['cap'];
			$res = $this->Admin->query("SELECT factories.id,factories.factory_name,fat.text FROM factory_ans_tables as fat LEFT JOIN factories ON factories.id=fat.factory_id
WHERE question_id=$cap_id AND factories.status!=0");
			$this->set('res', $res );		
		}
	}
	function cquery(){
		
		for($a=1;$a<15;$a++){
			$this->Admin->query("UPDATE `m3h3di_sedf`.`ratings` SET `points` =  5 WHERE factory_id = $a");
			//$this->Admin->query("UPDATE `m3h3di_sedf`.`ratings` SET `points` =  5 WHERE factory_id = ROUND( (284+1)*RAND(),0) and section!=11");
			//$this->Admin->query("UPDATE `m3h3di_sedf`.`ratings` SET `points` =  0 WHERE factory_id = ROUND( (284+1)*RAND(),0) and section!=2 and section!=2");
		}
		/*for($i=1;$i<=14;$i++){
			$res = $this->Admin->query("SELECT * FROM `rating_rules` WHERE section=$i order by point asc");
			
			$rnd= rand(0,sizeof($res)-1);
						
			//echo $rnd;
			
			for($fact=1;$fact<=284;$fact++){
				$rnd= rand(0,sizeof($res)-1);
				$point = $res[$rnd]['rating_rules']['point'];		
				echo $point;
				$this->Admin->query("UPDATE `m3h3di_sedf`.`ratings` SET `points` =  $point where factory_id=  $fact and section=$i");
				//exit();
			}
			echo "<pre>";
			//print_r($res);
			echo "</pre>";
			
			
		}
		exit();*/
	}
}
?>