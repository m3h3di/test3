<?php
class SurveysController extends AppController {

	var $name = 'Surveys';
	var $helpers = array('Html', 'Javascript'); 
	var $components = array('Companychk');
	function fullview(){
		
	}
	function grievance($company_id = null){
		$this->layout = 'entry';
		$this->set('company_id', $company_id  );
		//$this->set('all_questions', $this->Survey->find('all', array('order' => array('Survey.order ASC')))  );
		$res = $this->Survey->query("SELECT * FROM grievances");
		$this->set('all_grievances', $res  );
		$id = $this->Auth->User('id');
		
		
		if( !empty($_POST)){
			$survey_date = $_POST['date'];
			$submitted_data = $_POST;
			$qry_date = $submitted_data['date']['year']."-".$submitted_data['date']['month']."-15";
			$company_id = $_POST['company_id'];
			foreach($_POST['gr'] as $gr_id => $val ){
				foreach($val as $day=>$gr){
					$found = $gr['found'];
					if($found == 0) continue;
					$solved = $gr['solved'];
					$grievance_data[]= array("company_id"=>$company_id,"grievance_id"=>$gr_id,"user_id"=>$id,"day"=>$day,"found"=>$found,"solved"=>$solved,"comments"=>"test","survey_date"=>$survey_date);
				}
			}
			
			$this->loadModel("GrAnsList");
			if($this->GrAnsList->Query("DELETE FROM gr_ans_lists where company_id='$company_id' AND survey_date='$qry_date' ") ){
			
				$this->GrAnsList->create();
				if ($this->GrAnsList->saveAll($grievance_data) ) {
					$this->redirect(array('controller' => 'counselors', 'action' => 'facility',$company_id));
				}
				$this->redirect(array('controller' => 'counselors', 'action' => 'facility',$company_id));
			}
			else $this->redirect(array('controller' => 'counselors', 'action' => 'facility',$company_id));
			/**/
			//echo "<pre>";
			//print_r($grievance_data);
			//echo "</pre>";
		}
		
	}
	function showgrievance($company_id = null){
		$this->layout = 'entry';
		$this->loadModel("GrAnsList");
		$res = $this->GrAnsList->Query("SELECT *,SUM(found) as found,SUM(solved) as solved FROM gr_ans_lists WHERE company_id='$company_id' GROUP BY survey_date ");
		$this->set('gr', $res );
		//echo "<pre>";
		//print_r($res);
		//echo "</pre>";
	}
	function grievancedetails( $company_id = null, $survey_date = null  ){
		$this->layout = 'entry';
		$res = $this->Survey->query("SELECT * FROM grievances");
		$this->set('all_grievances', $res  );
		$this->loadModel("GrAnsList");
		$res = $this->GrAnsList->Query("SELECT gr_ans_lists.*,grievances.grievance FROM gr_ans_lists 
			left join grievances ON gr_ans_lists.grievance_id = grievances.id 
			WHERE gr_ans_lists.company_id='$company_id' AND  gr_ans_lists.survey_date='$survey_date'");
		
		//echo "<pre>";
		//print_r($res);
		//echo "</pre>";
		$this->set('gr', $res );
	}
	
	
	function index() {
		$this->redirect(array('controller' => 'counselors', 'action' => 'home'));
	}
	
	function entry( $company_id = null ) {
		$this->layout = 'entry';
		//Start checking the factory assigned to this user or not
		if( !empty($company_id)){
			$group_id = $this->Auth->User('group_id');
			$this->loadModel('Company');
			
			$res = $this->Company->findById($company_id) ;
			//print_r($res);
			$res_id = $res['Group']['id'];
			$res_name = $res['Company']['name'];
		
			if($group_id == $res_id){
				//$this->set('factory_id', $company_id );
				$this->set('company', $res );
				$this->set('company_name', $res_name );
			}
			//else echo $id;
			else $this->redirect(array('controller' => 'counselors', 'action' => 'home'));
		}
		else $this->redirect(array('controller' => 'counselors', 'action' => 'home'));
		//End checking the factory assigned to this user or not
		
		
				
		//$this->set('all_questions', $this->Survey->find('all', array('order' => array('Survey.order ASC'), 'conditions' => array('Survey.section' => $section)) ) );
		$this->set('all_questions', $this->Survey->find('all', array('order' => array('Survey.order ASC')))  );
		
		$this->loadModel('Company');
		$company_info = $this->Company->Query("SELECT *  FROM `companies` WHERE `id`=$company_id");
		$this->set('company_info', $company_info );
		
		
	}
	
	function showans( $company_id = null, $survey_date = null  ){
		$this->layout = 'cake';
		$id = $this->Auth->User('id');
				
		//Start checking the factory assigned to this user or not
		if( !empty($company_id)){
			$group_id = $this->Auth->User('group_id');
			$this->loadModel('Company');
			
			$res = $this->Company->findById($company_id) ;
			//print_r($res);
			$res_id = $res['Group']['id'];
			$res_name = $res['Company']['name'];
		
			if($group_id == $res_id){
				//$this->set('factory_id', $company_id );
				$this->set('company', $res );
				$this->set('company_name', $res_name );
			}
			//else echo $id;
			else $this->redirect(array('controller' => 'counselors', 'action' => 'home'));
		}
		else $this->redirect(array('controller' => 'counselors', 'action' => 'home'));
		//End checking the factory assigned to this user or not
		
		//$this->loadModel('Ans');
		
		/*$res = $this->Survey->query("SELECT questions.section_id, questions.status, questions.question, company_ans_lists.status, company_ans_lists.point FROM questions LEFT JOIN company_ans_lists ON questions.id=company_ans_lists.question_Id WHERE company_ans_lists.survey_date='$survey_date' AND company_ans_lists.company_id='$company_id' ORDER BY questions.section_id ASC, questions.order ASC ") ;*/ 
		
		//edited by nandinee 2011-04-02 start
		$res = $this->Survey->query("SELECT questions.section_id, questions.status, questions.question, company_ans_lists.status, 
		company_ans_lists.point, company_ans_lists.survey_date, company_ans_lists.signoff
		
		FROM questions LEFT JOIN company_ans_lists 
		ON questions.id=company_ans_lists.question_Id 
		
		WHERE company_ans_lists.survey_date='$survey_date' AND company_ans_lists.company_id='$company_id' ORDER BY questions.section_id ASC, questions.order ASC ") ;
		//edited by nandinee 2011-04-02 end
		
		$this->set('ans_list', $res  );
		
		
		$this->set('sec', $this->Survey->query("SELECT * From sections ORDER BY 'order' ") );
		
		$this->loadModel('Company');
		$company_info = $this->Company->Query("SELECT *  FROM `company_info_archives` as companies WHERE `company_id`=$company_id AND survey_date='$survey_date' ");
		$this->set('company_info', $company_info );
		$this->set('survey_date', $survey_date );
		
	}
	
	function survey_edit( $company_id = null, $survey_date = null  ){
		$this->layout = 'entry';
		$id = $this->Auth->User('id');
				
		//Start checking the factory assigned to this user or not
		if( !empty($company_id)){
			$group_id = $this->Auth->User('group_id');
			$this->loadModel('Company');
			
			$res = $this->Company->findById($company_id) ;
			//print_r($res);
			$res_id = $res['Group']['id'];
			$res_name = $res['Company']['name'];
		
			if($group_id == $res_id){
				//$this->set('factory_id', $company_id );
				$this->set('company', $res );
				$this->set('company_name', $res_name );
			}
			//else echo $id;
			else $this->redirect(array('controller' => 'counselors', 'action' => 'home'));
		}
		else $this->redirect(array('controller' => 'counselors', 'action' => 'home'));
		//End checking the factory assigned to this user or not
		
		//$this->loadModel('Ans');
		$res = $this->Survey->query("SELECT questions.section_id, questions.status, questions.question, company_ans_lists.status, company_ans_lists.point FROM questions LEFT JOIN company_ans_lists ON questions.id=company_ans_lists.question_Id AND company_ans_lists.created='$survey_date'  ORDER BY questions.section_id ASC, questions.order ASC ") ;
		$this->set('ans_list', $res  );
		
		
		
		//edited by nandinee 2011-04-02 start// for breadcrumb 
		$this->loadModel('Company');
		$company_info = $this->Company->Query("SELECT *  FROM `company_info_archives` as companies WHERE `company_id`=$company_id AND survey_date='$survey_date' ");
		$this->set('company_info', $company_info );
		$this->set('survey_date', $survey_date );
		//edited by nandinee 2011-04-02 start
	}
	
	function process(){
			
		//$test = $_POST;
		//$section = $_POST['section'];
		//$company_id = $_POST['factory_id'];
		//if( !empty($_POST['point']) ) $point = $_POST['point'];
		//else $point = 0;
				
		$submitted_data = $_POST;
		$user_id = $this->Auth->User('id');
		$group_id = $this->Auth->User('group_id');
		$company_id = $_POST['company_id'];
		$sdate = $submitted_data['date'];
		
		$submitted_data['company']['user_id'] = $user_id;
		$submitted_data['company']['group_id'] = $group_id;
		$submitted_data['company']['company_id'] = $company_id;
		$submitted_data['company']['status'] = 0;
		$submitted_data['company']['survey_date'] = $submitted_data['date'];
		
		$qry_date = $submitted_data['date']['year']."-".$submitted_data['date']['month']."-15";
		$this->loadModel('CompanyInfoArchive');
		$tmp = $this->CompanyInfoArchive->query("SELECT id FROM company_info_archives WHERE company_id=$company_id AND survey_date='$qry_date'");
		
		
		
		if( !empty($tmp) ) $this->redirect(array('controller' => 'counselors', 'action' => 'facility',$company_id));
		else {
		
			$this->loadModel('CompanyInfoArchive');
			$this->CompanyInfoArchive->create();
			$this->CompanyInfoArchive->save($submitted_data['company']) ;
			
			
			$submitted_data['company']['id'] = $company_id;
			
			
			foreach($submitted_data['data'] as $key => $val){
				$status = 1;
				if ( $val['point'] == "NA" || $val['point'] == ""){
					$val['point'] = 0 ;
					$status = 0;
				}
				$new = array("user_id"=>$user_id,"group_id"=>$group_id,"company_id"=>$company_id,"question_id"=>$key, "status" => $status , 'survey_date'=>$sdate);
				$final = array_merge($new,$val ) ;
				$data[]= $final;
			}
	
			//echo '<pre style="text-align:left">';
			//print_r($submitted_data);
			//print_r($data);
			//echo "</pre>";
		
			
			$this->loadModel('Company');
			$this->Company->save($submitted_data['company']) ;
		
		
			$this->loadModel('CompanyAnsList');
			$this->CompanyAnsList->create();
			if ($this->CompanyAnsList->saveAll($data) ) {
				$this->redirect(array('controller' => 'counselors', 'action' => 'facility',$company_id));
			}
			$this->redirect(array('controller' => 'counselors', 'action' => 'facility',$company_id));
			
		}
	}
	
	function SaveFacility($company_id =null){
		
		//Start checking the factory assigned to this user or not
		if( !empty($company_id)){
			$group_id = $this->Auth->User('group_id');
			$this->loadModel('Company');
			
			$res = $this->Company->findById($company_id) ;
			//print_r($res);
			$res_id = $res['Group']['id'];
			$res_name = $res['Company']['name'];
		
			if($group_id == $res_id){
				//$this->set('factory_id', $company_id );
				$this->set('company', $res );
				$this->set('company_name', $res_name );
			}
			//else echo $id;
			else $this->redirect(array('controller' => 'counselors', 'action' => 'home'));
		}
		else $this->redirect(array('controller' => 'counselors', 'action' => 'home'));
		//End checking the factory assigned to this user or not
		
		
		
	}
	
	function bysectionsingle($company_id = null) {
		
		if( !empty($company_id)){
						
			$this->layout = 'entry';
			$this->loadModel('Section');
			$this->set('all_sections', $this->Section->Query("SELECT * from sections ORDER BY id ASC") );
			
			$this->loadModel('Company');
			$this->set('all_companies', $this->Company->query("SELECT DISTINCT name, id from companies WHERE id=$company_id ") );
			
			if(!empty($_POST['data'])){
				
				//generating survey date
				$range_cnd='';
				$stt = 0;
				foreach($_POST['range'] as $k => $v){
					if(!empty($v)) $stt++;				
				}
				if($stt == 4){
					$from_date	=	$_POST['range']['fyear']."_".$_POST['range']['fmonth']."_15";
					$to_date= $_POST['range']['tyear']."_".$_POST['range']['tmonth']."_15";
					//echo $from_date." ".$to_date;
					$range_cnd = "AND '$to_date' >= survey_date AND survey_date >= '$from_date' ";
					//echo $range_cnd;
				}
				
				$company_id = $_POST['company'];
				
				if(!empty($_POST['zone'])){
					$zn=$_POST['zone'];
					$zone_cond = "  company.zone =  '$zn' AND";
				}
				else $zone_cond = '';
				
				
				//echo $survey_date;
				
				$all_data = $_POST['data'];
				$this->Session->write('sec_id_list', $all_data);
				
				
				
				$this->loadModel('CompanyAnsList');
				$qry_cond = "(";
				$i=0;
				foreach($_POST['data'] as $sec_id=>$val){
					if($i==0 ) $qry_cond .=  " section_id = $sec_id ";
					else $qry_cond .=  " OR section_id = $sec_id ";
					$i++;
				}
				$qry_cond .= ")";
				//echo $qry_cond;
				$ans_lists = $this->CompanyAnsList->Query("SELECT `company_id`,SUM( `point` )/SUM(`status`)*100 as rating,`survey_date` FROM `company_ans_lists` WHERE `company_id`=$company_id AND $qry_cond $range_cnd GROUP BY `survey_date` ORDER BY survey_date ASC
				");
				$this->set('company_ans_list', $ans_lists );
				
				//for overall graph
				$ans_lists = $this->CompanyAnsList->Query("SELECT `company_id`,SUM( `point` )/SUM(`status`)*100 as rating,`survey_date` FROM `company_ans_lists` WHERE `company_id`=$company_id  $range_cnd GROUP BY `survey_date` ORDER BY survey_date ASC
				");
				$this->set('overall_company_ans_list', $ans_lists );
			}
		}
		else $this->redirect(array('controller' => 'counselors', 'action' => 'home'));
		//End checking the factory assigned to this user or not	
	}
	
	function facilitysectionans( $company_id = null, $survey_date = null ){
		$session_sec = $this->Session->read('sec_id_list');
		if( empty($session_sec) ){
			$this->redirect(array('action' => 'index'));	
		}
		$this->set('sec_list', $session_sec  );
		
		
		$this->layout = 'cake';
		if( empty($company_id) ||  empty($survey_date) )
			$this->redirect(array('controller' => 'counselors', 'action' => 'home'));

		$this->loadModel('Survey');
		$res = $this->Survey->query("SELECT questions.id,questions.section_id, questions.status, questions.question, company_ans_lists.status, company_ans_lists.point FROM questions LEFT JOIN company_ans_lists ON questions.id=company_ans_lists.question_Id WHERE company_ans_lists.survey_date='$survey_date' AND company_ans_lists.company_id='$company_id' ORDER BY questions.section_id ASC, questions.order ASC ") ;
		$this->set('ans_list', $res  );
		$this->set('sec', $this->Survey->query("SELECT * From sections ORDER BY 'order' ") );
		
			
		$this->loadModel('Company');
		$company_info = $this->Company->Query("SELECT *  FROM `companies` WHERE `id`=$company_id");
		$this->set('company_info', $company_info );
		$this->set('survey_date', $survey_date );
		
	}	
	
	function bycriteriasingle($company_id = null) {
		if( !empty($company_id)){
		
			$this->layout = 'entry';
					
			$this->loadModel('Company');
			$this->set('all_companies', $this->Company->query("SELECT DISTINCT name, id from companies WHERE id=$company_id ") );
			
			if(!empty($_POST['criteria'])){
				
				//generating survey date
				$range_cnd='';
				$stt = 0;
				foreach($_POST['range'] as $k => $v){
					if(!empty($v)) $stt++;				
				}
				if($stt == 4){
					$from_date	=	$_POST['range']['fyear']."_".$_POST['range']['fmonth']."_15";
					$to_date= $_POST['range']['tyear']."_".$_POST['range']['tmonth']."_15";
					//echo $from_date." ".$to_date;
					$range_cnd = "AND '$to_date' >= survey_date AND survey_date >= '$from_date' ";
					//echo $range_cnd;
				}
				
				$company_id = $_POST['company'];
				$criteria = $_POST['criteria'];
				
						
				$this->loadModel('CompanyInfoArchive');
				$ans_lists = $this->CompanyInfoArchive->Query("SELECT survey_date, $criteria AS cr FROM company_info_archives WHERE `company_id`='$company_id' $range_cnd  ORDER BY survey_date ASC");
				$this->set('res_criteria', $ans_lists );
				
				$max = $this->CompanyInfoArchive->Query("SELECT max($criteria) AS max FROM company_info_archives WHERE `company_id`='$company_id'  ");
				$this->set('max', $max );
				
				$min = $this->CompanyInfoArchive->Query("SELECT min($criteria) AS min FROM company_info_archives WHERE `company_id`='$company_id'  ");
				$this->set('min', $min );
				
			}
		}
		else $this->redirect(array('controller' => 'counselors', 'action' => 'home'));
		//End checking the factory assigned to this user or not	
		
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