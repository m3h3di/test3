<?php
class SurveysController extends AppController {

	var $name = 'Surveys';
	var $helpers = array('Html', 'Javascript'); 
	
	function newdata($factory_id = null,$surveyNo = null){
		//$this->layout = 'betterWork';
		
		if(!empty($factory_id) and !empty($surveyNo)){
			//authenticating start
			$id = $this->Auth->User('id');
			$this->loadModel('Factory');
			$fact = $this->Factory->findAllById($factory_id);
			$assignedUserId = $fact[0]['User']['id'];
			$loggedInUserId =$this->Auth->User('id');
			
			if($loggedInUserId == $assignedUserId){
				$this->set('factory', $fact);
			}
			else $this->redirect(array('controller' => 'users', 'action' => 'home'));
			
			foreach($fact[0]['ComplianceRating'] as $k=>$v){
				if($v['status'] == $surveyNo) $this->redirect(array('controller' => 'users', 'action' => 'home'));
				//exit;
			}
			//authenticating end
			
		
		
			$this->set('factory_id', $factory_id );
			$this->set('surveyNo', $surveyNo );
			
			$this->loadModel('Cluster');
			$this->set('clusters', $this->Cluster->find('all') );
			
			$this->loadModel('Question');
			$questions = $this->Question->find('all', array('order' => array('Question.cluster_id ASC') ));
			$this->set('questions', $questions );
		}
		elseif($_POST){
			$data_set = $_POST['data'];
			$status = $_POST['surveyNo'];
			
			//start total rating variable intialized (percentage)
			$totalRatings["factory_id"] = 0;
			$totalRatings["total"]=0;
			$totalRatings["found"]=0;
			$totalRatings["noAns"]=0;
			$totalRatings["status"]=$status;
			$totalRatings["survey_date"]="";	//suveyDate
			//End total rating variable intialized (percentage)
			
			foreach($data_set as $data){
				$i = $data["cluster_id"];
				$totalRatings["factory_id"] = $factory_id;
				$totalRatings["survey_date"]=$data["survey_date"];
				
				
				if(!isset($ratings[$i]["total"])){
					$factory_id=$data["factory_id"];
					$ratings[$i]["factory_id"] = $factory_id;
					$ratings[$i]["section"] = $i;
					$ratings[$i]["total"]=0;
					$ratings[$i]["found"]=0;
					$ratings[$i]["noAns"]=0;
					$ratings[$i]["status"]=$status;
					$ratings[$i]["survey_date"]=$data["survey_date"];
				}
				if($data['QuestionType'] == "Compliance"){
					$ratings[$i]["total"]++;
					$totalRatings["total"]++;
					
					if(empty($data['AnswerYesNo'])){
						$ratings[$i]["noAns"]++;
						$totalRatings["noAns"]++;
					}
					elseif( ($data['CompliantAnswer'] == "true" and $data['AnswerYesNo']== "true") or ($data['CompliantAnswer'] == "false" and $data['AnswerYesNo']== "false") ){
						$ratings[$i]["found"]++;
						$totalRatings["found"]++;
					}
				}
			}
			
			//preCheck
			$this->loadModel('Compliance');
			$isExist = $this->Compliance->findAllByFactoryIdAndStatus($factory_id,$status);			
			if( empty($isExist) ){
				//$this->loadModel("SurveyDataArchive");
				//$this->SurveyDataArchive->create();
				//if($this->SurveyDataArchive->saveAll($data_set)){
					$this->loadModel("SurveyData");
					$this->SurveyData->create();
					if($this->SurveyData->saveAll($data_set)){						
						$this->Compliance->create();
						if($this->Compliance->saveAll($ratings)){
							$this->loadModel("ComplianceRating");
							$this->ComplianceRating->create();
							if($this->ComplianceRating->save($totalRatings)){
								//echo "great";
								$this->redirect(array('controller' => 'users', 'action' => 'factory',$factory_id));
							}
							else{
								$this->redirect(array('controller' => 'users', 'action' => 'home'));
								//"problem Total Rating(percentage)";
							}
						}
						else {
								$this->redirect(array('controller' => 'users', 'action' => 'home'));
						}
					}
					else echo "Problem Trending data";
					
					
					
				//}
				//else echo "problem Archive";
			}	
			else	$this->redirect(array('controller' => 'users', 'action' => 'home'));	
				
				
			//echo "<pre><br>";
			//print_r($ratings);
			//print_r($data_set);
			//print_r($_POST);
			//echo "</pre>";
			
			/* //data entry test 
			$this->set('factory_id', $factory_id );
			$this->loadModel('Cluster');
			$this->set('clusters', $this->Cluster->find('all') );
			*/
			
		}
		else{
			$this->redirect(array('controller' => 'users', 'action' => 'home'));
		}
	}
	function editdata($factory_id = null,$surveyNo = null){
		$this->layout = 'betterWork';
		if(!empty($factory_id) and !empty($surveyNo)){
			//authenticating start
			$id = $this->Auth->User('id');
			$this->loadModel('Factory');
			$fact = $this->Factory->findAllById($factory_id);
			$assignedUserId = $fact[0]['User']['id'];
			$loggedInUserId =$this->Auth->User('id');
			
			if($loggedInUserId == $assignedUserId){
				$this->set('factory', $fact);
			}
			else $this->redirect(array('controller' => 'users', 'action' => 'home'));
			//authenticating end
			
			$this->set('factory_id', $factory_id );
			$this->set('surveyNo', $surveyNo );
			
			$this->loadModel('Compliance');
			$details = $this->Compliance->findAllByFactoryIdAndStatus($factory_id,$surveyNo);
			$this->set('surveys', $details );
			
			$this->loadModel('SurveyData');
			$surveyData = $this->SurveyData->findAllByFactoryIdAndStatus($factory_id,$surveyNo);
			$this->set('surveyData', $surveyData );
			
			$this->loadModel('Answer');
			$answers = $this->Answer->find("all");
			$this->set('answers', $answers );
			
			//echo "<pre><br>";
			//print_r($answers);
			//echo "</pre>";			
		}		
		else if($_POST){ //========================   Start Edited data insert    =============================
			$data_set = $_POST['data'];
			$status = $_POST['surveyNo'];
			
			//start total rating variable intialized (percentage)
			$totalRatings["factory_id"] = 0;
			$totalRatings["total"]=0;
			$totalRatings["found"]=0;
			$totalRatings["noAns"]=0;
			$totalRatings["status"]=$status;
			$totalRatings["survey_date"]="";	//suveyDate
			//End total rating variable intialized (percentage)
			
			foreach($data_set as $data){
				$i = $data["cluster_id"];
				$totalRatings["factory_id"] = $factory_id;
				$totalRatings["survey_date"]=$data["survey_date"];
				
				
				if(!isset($ratings[$i]["total"])){
					$factory_id=$data["factory_id"];
					$ratings[$i]["factory_id"] = $factory_id;
					$ratings[$i]["section"] = $i;
					$ratings[$i]["total"]=0;
					$ratings[$i]["found"]=0;
					$ratings[$i]["noAns"]=0;
					$ratings[$i]["status"]=$status;
					$ratings[$i]["survey_date"]=$data["survey_date"];
				}
				if($data['QuestionType'] == "Compliance"){
					$ratings[$i]["total"]++;
					$totalRatings["total"]++;
					
					if(empty($data['AnswerYesNo'])){
						$ratings[$i]["noAns"]++;
						$totalRatings["noAns"]++;
					}
					elseif( ($data['CompliantAnswer'] == "true" and $data['AnswerYesNo']== "true") or ($data['CompliantAnswer'] == "false" and $data['AnswerYesNo']== "false") ){
						$ratings[$i]["found"]++;
						$totalRatings["found"]++;
					}
				}
			}
			
			//preCheck
			$this->loadModel('Compliance');
			$isExist = $this->Compliance->findAllByFactoryIdAndStatus($factory_id,$status);			
			if( $isExist ){
				//$this->FactoryAnsTable->Query("DELETE FROM factory_ans_tables where factory_id='$factory_id' AND section='$section' ");
				//$this->FactoryAnsTable->create();
			
				//$this->loadModel("SurveyDataArchive");
				//$this->SurveyDataArchive->create();
				//if($this->SurveyDataArchive->saveAll($data_set)){
					$this->loadModel("SurveyData");
					$this->SurveyData->Query("DELETE FROM survey_datas where factory_id='$factory_id' AND status='$status' ");	//only for edit
					$this->SurveyData->create();
					if($this->SurveyData->saveAll($data_set)){
						$this->Compliance->Query("DELETE FROM compliances where factory_id='$factory_id' AND status='$status' ");	//only for edit
						$this->Compliance->create();
						if($this->Compliance->saveAll($ratings)){
							$this->loadModel("ComplianceRating");
							$this->ComplianceRating->Query("DELETE FROM compliance_ratings where factory_id='$factory_id' AND status='$status' ");	//only for edit
							$this->ComplianceRating->create();
							if($this->ComplianceRating->save($totalRatings)){
								//echo "great";
								$this->redirect(array('controller' => 'users', 'action' => 'factory',$factory_id));
							}
							else{
								$this->redirect(array('controller' => 'users', 'action' => 'home'));
								//"problem Total Rating(percentage)";
							}
						}
						else {
								$this->redirect(array('controller' => 'users', 'action' => 'home'));
						}
					}
					else echo "Problem Trending data";
					
					
					
				//}
				//else echo "problem Archive";
			}	
			else	$this->redirect(array('controller' => 'users', 'action' => 'home'));	
				
				
			//echo "<pre><br>";
			//print_r($ratings);
			//print_r($data_set);
			//print_r($_POST);
			//echo "</pre>";
			
			/* //data entry test 
			$this->set('factory_id', $factory_id );
			$this->loadModel('Cluster');
			$this->set('clusters', $this->Cluster->find('all') );
			*/
		//========================End Edited data insert=============================	
		}
		else{
			$this->redirect(array('controller' => 'users', 'action' => 'home'));
		}
	}
	
	function details($factory_id = null,$surveyNo = null){
		$this->layout = 'betterWork';
		if(!empty($factory_id) and !empty($surveyNo)){
			// authentication starts
			$id = $this->Auth->User('id');
			$this->loadModel('Factory');
			$res = $this->Factory->findAllById($factory_id);
			$res_id = $res[0]['User']['id'];
			if($id == $res_id){
				$this->set('factory', $res);
			}
            else $this->redirect(array('controller' => 'users', 'action' => 'home'));
			// authentication Ends
			
			$this->set('factory_id', $factory_id );
			$this->set('surveyNo', $surveyNo );
			
			$this->loadModel('Compliance');
			$details = $this->Compliance->findAllByFactoryIdAndStatus($factory_id,$surveyNo);
			$this->set('surveys', $details );
			
			$this->loadModel('SurveyData');
			$surveyData = $this->SurveyData->findAllByFactoryIdAndStatus($factory_id,$surveyNo);
			$this->set('surveyData', $surveyData );
			
			//echo "<pre><br>";
			//print_r($details);
			//echo "</pre>";
		}
		else{
			$this->redirect(array('controller' => 'users', 'action' => 'home'));
		}
	}
	
	
	
	function viewdata($factory_id = null,$surveyNo = null){
		$this->layout = 'betterWork';
		if(!empty($factory_id) and !empty($surveyNo)){
			$this->set('factory_id', $factory_id );
			$this->set('surveyNo', $surveyNo );
			
			$this->loadModel('SurveyData');
			$surveyData = $this->SurveyData->findAllByFactoryId($factory_id);
			$this->set('surveyData', $surveyData );
			
			//echo "<pre><br>";
			//print_r($surveyData);
			//echo "</pre>";
		}else{
			$this->redirect(array('controller' => 'users', 'action' => 'home'));
		}
	}
	
	
	function ping(){	// very important function.. make Entry and edit page alive.
		//render ""
		$this->autoRender = false;
	}
	function doc($factory_id = null,$surveyNo = null){
		$this->layout = 'doc';
		if(!empty($factory_id) and !empty($surveyNo)){
			// authentication starts
			$id = $this->Auth->User('id');
			$this->loadModel('Factory');
			$res = $this->Factory->findAllById($factory_id);
			$res_id = $res[0]['User']['id'];
			if($id == $res_id){
				$this->set('factory', $res);
			}
            else $this->redirect(array('controller' => 'users', 'action' => 'home'));
			// authentication Ends
			
			$this->set('factory_id', $factory_id );
			$this->set('surveyNo', $surveyNo );
			
			$this->loadModel('Compliance');
			$details = $this->Compliance->findAllByFactoryIdAndStatus($factory_id,$surveyNo);
			$this->set('surveys', $details );
			
			$this->loadModel('SurveyData');
			$surveyData = $this->SurveyData->findAllByFactoryIdAndStatus($factory_id,$surveyNo);
			$this->set('surveyData', $surveyData );
			
			$this->loadModel('Answer');
			$answers = $this->Answer->find("all");
			$this->set('answers', $answers );
			
			//echo "<pre><br>";
			//print_r($details);
			//echo "</pre>";
		}
		else{
			$this->redirect(array('controller' => 'users', 'action' => 'home'));
		}
	}
}
?>
