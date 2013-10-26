<?php
class SurveysController extends AppController {

	var $name = 'Surveys';
	var $helpers = array('Html', 'Javascript'); 
	
	
	function index() {
		$this->redirect(array('controller' => 'users', 'action' => 'home'));
	}
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
			
			$factory_status = $res[0]['Factory']['status'];	// From where one can know is it baseline survey or not.
			if( $factory_status != 0) $this->redirect(array('controller' => 'users', 'action' => 'home'));
			
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
		$rating =  $this->Rating->Query("SELECT * FROM ratings_haz AS Rating WHERE factory_id='$factory_id' AND section='$section' ");
		$this->set('rating', $rating );
		
		
		$this->loadModel("FactoryAnsTable");
		//$ans =  $this->FactoryAnsTable->findAllByFactoryId($factory_id);
		$ans =  $this->FactoryAnsTable->Query("SELECT * FROM factory_ans_tables AS FactoryAnsTable WHERE factory_id='$factory_id' AND section='$section' AND status=0 ");
		$this->set('factory_answers', $ans );	
		

	}
	

	function process(){
		$test = $_POST;
		$section = $_POST['section'];
		$factory_id = $_POST['factory_id'];
		if( !empty($_POST['point']) ) $point = $_POST['point'];
		else $point = 0;
		
		//echo '<pre style="text-align:left">';
		//print_r($test);
		//echo "</pre>";
		
		
		$i = 0;
		$old_ans_id="";
		
		//setting the array for factory_ans_table
		foreach($test['ansdata'] as $q_id=>$val){
			if( isset($val['chk']) ) {
				foreach($val['chk'] as $ans_id => $ans_val){
					if( empty($ans_val['value'])) continue;
					
					if( empty($ans_val['text']) ) $txt = "";
					elseif(  is_array($ans_val['text']) ){
						$final_val = "type2";
						foreach($ans_val['text'] as $keyyy => $valll){
							if($keyyy == 'amount') $final_val.="|".$valll;
							elseif($keyyy == 'where') $final_val.="|".$valll;
													
						}
						
						if( empty($ans_val['text']['msds']) ) $final_val.="|0";
						else $final_val.="|1";
						
						$txt = $final_val;
					}
					else $txt = $ans_val['text'];
					
					//$txt = !empty($val['radio']['text'])?$val['radio']['text']:"";
					
					$data_set[]= array('factory_id'=>$factory_id,'question_id'=>$q_id,'ans_id'=>$ans_id,'type'=> "chk" , 'text'=>$txt,'section'=>$section);
					
				}
			}
			elseif( isset($val['radio']) ){
				if( is_array($val['radio']) ){
					$txt = !empty($val['radio']['text'])? " ( ".$val['radio']['text']." )" :"";				
					//$txt = "( ".$val['radio']['text']." )";
					$txt = $val['radio']['value'].$txt;
				}
				else $txt = $val['radio'];
				$data_set[]= array('factory_id'=>$factory_id,'question_id'=>$q_id,'ans_id'=>0,'type'=> "radio" , 'text'=> $txt,'section'=>$section);
			}
			
			
			elseif( isset($val['text']) ){
				if( is_array($val['text']) ){
					$all_val = "type3";
					foreach($val['text'] as $kadf => $txtxt){
						if( empty($txtxt['name']) & empty($txtxt['value']) ) continue;
						else{
							$all_val.="|". $txtxt['name'] . "-". $txtxt['value'];
						}
					}
					
					$txt = $all_val;
				}
				else	$txt = $val['text'];				
				$data_set[]= array('factory_id'=>$factory_id,'question_id'=>$q_id,'ans_id'=>0,'type'=>"text", 'text'=>$txt,'section'=>$section);
			}
			
		}
		
		//setting the array for rating table
		
		//$rate_data['factory_id'] = $factory_id;
		//$rate_data['section'] = $section;
		//$rate_data['points'] = $point;
		//$rate_data['status'] = 1;
		$tot_p =0;
		foreach($test['data'] as $rating_rule_id => $point){
			if(empty($point)) continue;
			$rate_data2[] = array('factory_id'=>$factory_id,'rating_rule_id'=>$rating_rule_id,'section'=>$section, 'points'=>$point);
			
			$tot_p += $point;
		}
		
		$rate_data['factory_id'] = $factory_id;
		$rate_data['section'] = $section;
		if($rate_data['section'] == (6 ||7)) $rate_data['points'] = 0;
		else	$rate_data['points'] = $tot_p;
		//$rate_data['status'] = 1;
		
		//echo '<pre style="text-align:left">';
		//print_r($_POST);
		//print_r($data_set);
		//print_r($rate_data2);
		//echo "</pre>";
		
		
		$this->loadModel("FactoryAnsTable");
		$this->FactoryAnsTable->Query("DELETE FROM factory_ans_tables where factory_id='$factory_id' AND section='$section' AND status=0");
		$this->FactoryAnsTable->create();
		if ($this->FactoryAnsTable->saveAll($data_set)) {
			//$this->flash(__('saved.', true), array('action' => 'entry'));
			//if(empty($rate_data) ) $this->redirect(array('controller' => 'users', 'action' => 'factory',$factory_id));
			$this->loadModel("Rating2");
			$this->Rating2->Query("DELETE FROM ratings_haz where factory_id='$factory_id' AND section='$section' AND status=0");
			
			$this->Rating2->create();
			if ($this->Rating2->saveAll($rate_data2)){
				//echo "saved ratings & answers";
				$this->loadModel("Rating");
				$this->Rating->Query("DELETE FROM ratings where factory_id='$factory_id' AND section='$section' AND status=0");
				$this->Rating->create();
				$this->Rating->save($rate_data) ;
				
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
		/*
		echo '<pre style="text-align:left">';
		//print_r($data_set);
		//print_r($rate_data2);
		print_r($test);
		echo "</pre>";
		*/
	}
	
	function SaveFacility($factory_id =null,$status =1){
		
		//Start checking the factory assigned to this user or not
		if( !empty($factory_id)){
	
			$id = $this->Auth->User('id');
			$this->loadModel('Factory');
			//$this->set('factory', $this->Factory->findAllById($factory_id) );		//seba/users/factory/2
			
			$res = $this->Factory->findAllById($factory_id) ;
			$res_id = $res[0]['User']['id'];
			
			if($id == $res_id){
				
				
				$is_it_compete = $this->Factory->query("SELECT count(id) as num FROM ratings WHERE status=$status
				AND factory_id='$factory_id'");
				$status = $status+1;
				//print_r( $is_it_compete[0][0]['num']);
				
				if( !empty($is_it_compete) &  $is_it_compete[0][0]['num'] == 8 ){
					$qry = "UPDATE factories SET status = '$status' WHERE id = '$factory_id'";
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
			$factory_status = $res[0]['Factory']['status'];	// From where one can know is it baseline survey or not.
			
			if($id == $res_id){
				$this->set('factory_id', $factory_id );
				$this->set('factory_name', $factory_name );
				$this->set('status', $factory_status );
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
		$ans =  $this->FactoryAnsTable->Query("SELECT * FROM factory_ans_tables AS FactoryAnsTable WHERE factory_id='$factory_id' AND section='$section' AND status=0 ");
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
		$ans =  $this->FactoryAnsTable->Query("SELECT * FROM factory_ans_tables AS FactoryAnsTable WHERE factory_id='$factory_id' AND status=0 ORDER BY question_id ASC");
		$this->set('factory_answers', $ans );
	}
	function fview($factory_id = null ){
		
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
		$ans =  $this->FactoryAnsTable->Query("SELECT * FROM factory_ans_tables AS FactoryAnsTable WHERE factory_id='$factory_id' AND status=1 ORDER BY question_id ASC");
		$this->set('factory_answers', $ans );
	}
	
	function fentry($section = null,$factory_id = null,$followUpNumber = null){
		if( !empty($followUpNumber)){
			
			$status = intval($followUpNumber);
			if($status < 1) exit;
			$prevStatus = $status -1;
			//echo $prevStatus;
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
			$rating =  $this->Rating->Query("SELECT * FROM ratings_haz AS Rating WHERE factory_id='$factory_id' AND section='$section' AND status='$prevStatus'");
			$this->set('rating', $rating );
			
			
			$this->loadModel("FactoryAnsTable");
			//$ans =  $this->FactoryAnsTable->findAllByFactoryId($factory_id);
			$ans =  $this->FactoryAnsTable->Query("SELECT * FROM factory_ans_tables AS FactoryAnsTable WHERE factory_id='$factory_id' AND section='$section' AND status='$prevStatus' ");
			$this->set('factory_answers', $ans );	
			
			$this->set('followUpNumber', $followUpNumber);	
			//echo $followUpNumber;
		}
		else $this->redirect(array('controller' => 'users', 'action' => 'home'));
	}
	function fprocess(){
		//echo '<pre style="text-align:left">';
		//print_r($_POST);
		//echo "</pre>";
		
		//exit;
		if(!empty($_POST['followUpNumber']) ){
			$followUpNumber = intval($_POST['followUpNumber']);
			if($followUpNumber < 1) exit;
			
			$test = $_POST;
			$section = $_POST['section'];
			$factory_id = $_POST['factory_id'];
			if( !empty($_POST['point']) ) $point = $_POST['point'];
			else $point = 0;
			
			//echo '<pre style="text-align:left">';
			//print_r($test);
			//echo "</pre>";
			
			
			$i = 0;
			$old_ans_id="";
			
			//setting the array for factory_ans_table
			foreach($test['ansdata'] as $q_id=>$val){
				if( isset($val['chk']) ) {
					foreach($val['chk'] as $ans_id => $ans_val){
						if( empty($ans_val['value'])) continue;
						
						if( empty($ans_val['text']) ) $txt = "";
						elseif(  is_array($ans_val['text']) ){
							$final_val = "type2";
							foreach($ans_val['text'] as $keyyy => $valll){
								if($keyyy == 'amount') $final_val.="|".$valll;
								elseif($keyyy == 'where') $final_val.="|".$valll;
														
							}
							
							if( empty($ans_val['text']['msds']) ) $final_val.="|0";
							else $final_val.="|1";
							
							$txt = $final_val;
						}
						else $txt = $ans_val['text'];
						
						//$txt = !empty($val['radio']['text'])?$val['radio']['text']:"";
						
						$data_set[]= array('factory_id'=>$factory_id,'question_id'=>$q_id,'ans_id'=>$ans_id,'type'=> "chk" , 'text'=>$txt,'section'=>$section,'status'=>$followUpNumber);
						
					}
				}
				elseif( isset($val['radio']) ){
					if( is_array($val['radio']) ){
						$txt = !empty($val['radio']['text'])? " ( ".$val['radio']['text']." )" :"";				
						//$txt = "( ".$val['radio']['text']." )";
						$txt = $val['radio']['value'].$txt;
					}
					else $txt = $val['radio'];
					$data_set[]= array('factory_id'=>$factory_id,'question_id'=>$q_id,'ans_id'=>0,'type'=> "radio" , 'text'=> $txt,'section'=>$section,'status'=>$followUpNumber);
				}
				
				
				elseif( isset($val['text']) ){
					if( is_array($val['text']) ){
						$all_val = "type3";
						foreach($val['text'] as $kadf => $txtxt){
							if( empty($txtxt['name']) & empty($txtxt['value']) ) continue;
							else{
								$all_val.="|". $txtxt['name'] . "-". $txtxt['value'];
							}
						}
						
						$txt = $all_val;
					}
					else	$txt = $val['text'];				
					$data_set[]= array('factory_id'=>$factory_id,'question_id'=>$q_id,'ans_id'=>0,'type'=>"text", 'text'=>$txt,'section'=>$section,'status'=>$followUpNumber);
				}
				
			}
			
			//setting the array for rating table
			
			//$rate_data['factory_id'] = $factory_id;
			//$rate_data['section'] = $section;
			//$rate_data['points'] = $point;
			//$rate_data['status'] = 1;
			$tot_p =0;
			foreach($test['data'] as $rating_rule_id => $point){
				if(empty($point)) continue;
				$rate_data2[] = array('factory_id'=>$factory_id,'rating_rule_id'=>$rating_rule_id,'section'=>$section, 'points'=>$point, 'status'=>$followUpNumber);
				
				$tot_p += $point;
			}
			
			$rate_data['factory_id'] = $factory_id;
			$rate_data['section'] = $section;
			if($rate_data['section'] == (6 ||7)) $rate_data['points'] = 0;
			else	$rate_data['points'] = $tot_p;
	
			$rate_data['status'] = $followUpNumber;
			
			//echo '<pre style="text-align:left">';
			//print_r($_POST);
			//print_r($data_set);
			//print_r($rate_data2);
			//echo "</pre>";
			
			
			$this->loadModel("FactoryAnsTable");
			$this->FactoryAnsTable->Query("DELETE FROM factory_ans_tables where factory_id='$factory_id' AND section='$section' AND status='$followUpNumber' ");
			//$dataExistChk = 
			
			$this->FactoryAnsTable->create();
			if ($this->FactoryAnsTable->saveAll($data_set)) {
				//$this->flash(__('saved.', true), array('action' => 'entry'));
				//if(empty($rate_data) ) $this->redirect(array('controller' => 'users', 'action' => 'factory',$factory_id));
				$this->loadModel("Rating2");
				$this->Rating2->Query("DELETE FROM ratings_haz where factory_id='$factory_id' AND section='$section' AND status='$followUpNumber'");
				
				$this->Rating2->create();
				if ($this->Rating2->saveAll($rate_data2)){
					//echo "saved ratings & answers";
					$this->loadModel("Rating");
					$this->Rating->Query("DELETE FROM ratings where factory_id='$factory_id' AND section='$section' AND status='$followUpNumber'");
					$this->Rating->create();
					$this->Rating->save($rate_data) ;
					
					$this->redirect(array('controller' => 'users', 'action' => 'ffactory', $factory_id));
				}
				else{
					//echo "rate saving problem";
					$this->redirect(array('controller' => 'users', 'action' => 'ffactory',$factory_id));
				}
			} 
			else {
				//echo "Anwer saving problem";
				$this->redirect(array('controller' => 'users', 'action' => 'ffactory',$factory_id));
			}
			
			//$this->set('factory_ans', $test);
			/*
			echo '<pre style="text-align:left">';
			//print_r($data_set);
			//print_r($rate_data2);
			print_r($test);
			echo "</pre>";
			*/
		}
		else $this->redirect(array('controller' => 'users', 'action' => 'home'));
	}
	function fshowans( $section = null , $factory_id = null,$followUpNumber = null ){
		
		if(!empty($followUpNumber)){
			$status = intval($followUpNumber);
			
			$id = $this->Auth->User('id');
					
			//Start checking the factory assigned to this user or not
			if( !empty($factory_id)){
		
				$id = $this->Auth->User('id');
				$this->loadModel('Factory');
				//$this->set('factory', $this->Factory->findAllById($factory_id) );		//seba/users/factory/2
				
				$res = $this->Factory->findAllById($factory_id) ;
				$res_id = $res[0]['User']['id'];
				$factory_name = $res[0]['Factory']['factory_name'];
				$factory_status = $res[0]['Factory']['status'];	// From where one can know is it baseline survey or not.
				
				if($id == $res_id){
					$this->set('factory_id', $factory_id );
					$this->set('factory_name', $factory_name );
					$this->set('status', $factory_status );
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
			$ans =  $this->FactoryAnsTable->Query("SELECT * FROM factory_ans_tables AS FactoryAnsTable WHERE factory_id='$factory_id' AND section='$section' AND status='$status' ");
			$this->set('factory_answers', $ans );
			
			$this->set('followUpNumber', $followUpNumber);	
		}
		else $this->redirect(array('controller' => 'users', 'action' => 'home'));
	}
	
	function fedit($section = null,$factory_id = null,$followUpNumber = null ){
		if( !empty($followUpNumber)){
			
			$status = intval($followUpNumber);
			if($status < 1) exit;
			$prevStatus = $status;
			//echo $prevStatus;
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
			$rating =  $this->Rating->Query("SELECT * FROM ratings_haz AS Rating WHERE factory_id='$factory_id' AND section='$section' AND status='$prevStatus'");
			$this->set('rating', $rating );
			
			
			$this->loadModel("FactoryAnsTable");
			//$ans =  $this->FactoryAnsTable->findAllByFactoryId($factory_id);
			$ans =  $this->FactoryAnsTable->Query("SELECT * FROM factory_ans_tables AS FactoryAnsTable WHERE factory_id='$factory_id' AND section='$section' AND status='$prevStatus' ");
			$this->set('factory_answers', $ans );	
			
			$this->set('followUpNumber', $followUpNumber);	
			//echo $followUpNumber;
		}
		else $this->redirect(array('controller' => 'users', 'action' => 'home'));

	}
}
?>