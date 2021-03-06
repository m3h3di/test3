<?php
class CpanelsController extends AppController {

	var $name = 'Cpanels';
	var $helpers = array('Html', 'Javascript'); 
	function beforeFilter() {
		//$this->layout = 'cake';
		//parent::beforeFilter(); 
		//$this->Auth->allow('*');
		//$this->Auth->allow('add');
		if( $this->Session->read('Auth.User.status') != 1 ) // status=1 means Admin
			$this->redirect( "/counselors/home" );
	}
	
	function admin_index() {
		
	}
	function admin_notice_board()	{
	
	}
	function admin_signoff()	{
		$this->layout = 'cake';
		$this->loadModel('CompanyAnsList');
		$zone_cnd="";
		if( !empty($ezone) ){
			$zone_cnd = " AND company.zone='$ezone' ";
			$this->set('ezone', $ezone );
		}
		$ans_lists = $this->CompanyAnsList->Query("
			
			SELECT RESULT.company_id, company.*,
			SUM(RESULT.point)/SUM(RESULT.status)*100 AS rating, RESULT.`survey_date` FROM 
			(
				SELECT t2.* FROM 
				(SELECT company_id,max(survey_date) as survey_date FROM `company_ans_lists` GROUP BY company_id  ) 
				AS t1
				LEFT JOIN `company_ans_lists` AS t2
				ON t1.company_id=t2.company_id WHERE t1.survey_date=t2.survey_date AND t2.signoff=0
			) AS RESULT

			LEFT JOIN companies AS company ON RESULT.company_id = company.id
			WHERE RESULT.section_id != 12 $zone_cnd GROUP BY RESULT.company_id ORDER BY rating DESC
		
		");	
		
		//echo '<pre style="text-align:left">';
		//print_r($ans_lists);
		//echo '</pre>';
		$this->set('company_ans_list', $ans_lists );
		
		
	}
	function admin_process(){
		if( !empty($_POST)){
			
			$this->loadModel('CompanyAnsList');
			foreach($_POST['so'] as $company_id=> $survey_date){
				//$signoff[] = array('company_id'=>$company_id, "survey_date"=>$survey_date, "signoff"=>1);
				$this->CompanyAnsList->query("UPDATE `company_ans_lists` SET `signoff` = 1 WHERE company_id=$company_id AND survey_date='$survey_date'");
			}
			
			echo "<pre>";
			//print_r($signoff);
			echo "</pre>";
			
				
			
		}
	}
	
	function admin_byzone()	{
		$this->layout = 'cake';
		$this->loadModel('CompanyAnsList');
		$ans_lists = $this->CompanyAnsList->Query("
			
			SELECT company.zone,
			SUM(RESULT.point)/SUM(RESULT.status)*100 AS rating, RESULT.`survey_date` FROM 
			(
				SELECT t2.* FROM 
				(SELECT company_id,max(survey_date) as survey_date FROM `company_ans_lists` GROUP BY company_id ) 
				AS t1
				LEFT JOIN `company_ans_lists` AS t2
				ON t1.company_id=t2.company_id WHERE t1.survey_date=t2.survey_date AND t2.signoff=1
			) AS RESULT

			LEFT JOIN companies AS company ON RESULT.company_id = company.id
			WHERE RESULT.section_id != 12 GROUP BY company.zone ORDER BY company.zone DESC
		
		");	
		//echo '<pre style="text-align:left">';
		//print_r($ans_lists);
		//echo '</pre>';
		$this->set('company_ans_list', $ans_lists );
	}
	function admin_bysection() {
		$this->layout = 'entry';
		$this->loadModel('Section');
		$this->set('all_sections', $this->Section->Query("SELECT * from sections ORDER BY id ASC") );
		
		$this->loadModel('Company');
		$this->set('all_zone', $this->Company->query("SELECT DISTINCT zone from companies") );
		
		if(!empty($_POST['data'])){
			
			//generating survey date
			
			
			if(!empty($_POST['month']) & !empty($_POST['year'])){
				$survey_date = $_POST['year']."_".$_POST['month']."_15";
				$date_cond = " WHERE survey_date =  '$survey_date' ";
			}
			else $date_cond = '';
			
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
				if($i==0 ) $qry_cond .=  " RESULT.section_id = $sec_id ";
				else $qry_cond .=  " OR RESULT.section_id = $sec_id ";
				$i++;
			}
			$qry_cond .= ")";
			//echo $qry_cond;
			$ans_lists = $this->CompanyAnsList->Query("
					
				SELECT RESULT.company_id, company.name,company.zone, SUM(RESULT.point)/SUM(RESULT.status)*100 AS rating, RESULT.`survey_date` FROM 
				(
					SELECT t2.* FROM 
					(SELECT company_id,max(survey_date) as survey_date FROM `company_ans_lists` $date_cond GROUP BY company_id ) 
					AS t1
					LEFT JOIN `company_ans_lists` AS t2
					ON t1.company_id=t2.company_id WHERE t1.survey_date=t2.survey_date AND t2.signoff=1
				) AS RESULT
	
				LEFT JOIN companies AS company ON RESULT.company_id = company.id
				WHERE $zone_cond $qry_cond GROUP BY RESULT.company_id ORDER BY rating DESC
			
			");
			$this->set('company_ans_list', $ans_lists );
		}
		
	}
	
	function admin_showlist( $ezone = null) {
		$this->layout = 'cake';
		$this->loadModel('CompanyAnsList');
		$zone_cnd="";
		if( !empty($ezone) ){
			$zone_cnd = " AND company.zone='$ezone' ";
			$this->set('ezone', $ezone );
		}
		$ans_lists = $this->CompanyAnsList->Query("
			
			SELECT RESULT.company_id, company.*,
			SUM(RESULT.point)/SUM(RESULT.status)*100 AS rating, RESULT.`survey_date` FROM 
			(
				SELECT t2.* FROM 
				(SELECT company_id,max(survey_date) as survey_date FROM `company_ans_lists` GROUP BY company_id ) 
				AS t1
				LEFT JOIN `company_ans_lists` AS t2
				ON t1.company_id=t2.company_id WHERE t1.survey_date=t2.survey_date AND t2.signoff=1
			) AS RESULT

			LEFT JOIN companies AS company ON RESULT.company_id = company.id
			WHERE RESULT.section_id != 12 $zone_cnd GROUP BY RESULT.company_id ORDER BY rating DESC
		
		");	
		
		//echo '<pre style="text-align:left">';
		//print_r($ans_lists);
		//echo '</pre>';
		$this->set('company_ans_list', $ans_lists );
	}
	function admin_showlist_back() {
		$this->layout = 'cake';
		$this->loadModel('CompanyAnsList');
		$ans_lists = $this->CompanyAnsList->Query("
			
			SELECT RESULT.company_id, company.*,
			SUM(RESULT.point)/SUM(RESULT.status)*100 AS rating, RESULT.`survey_date` FROM 
			(
				SELECT t2.* FROM 
				(SELECT company_id,max(survey_date) as survey_date FROM `company_ans_lists` GROUP BY company_id ) 
				AS t1
				LEFT JOIN `company_ans_lists` AS t2
				ON t1.company_id=t2.company_id WHERE t1.survey_date=t2.survey_date
			) AS RESULT

			LEFT JOIN companies AS company ON RESULT.company_id = company.id
			WHERE RESULT.section_id != 12 GROUP BY RESULT.company_id ORDER BY rating DESC
		
		");	
		//echo '<pre style="text-align:left">';
		//print_r($ans_lists);
		//echo '</pre>';
		$this->set('company_ans_list', $ans_lists );
	}
	
	function admin_byquestion() {
		$this->layout = 'entry';
		
		$this->loadModel('Company');
		$this->set('all_zone', $this->Company->query("SELECT DISTINCT zone from companies") );
		
		if( !empty($_POST['data']) ){
			//$qry_cond ='AND ( ';
			
			if(!empty($_POST['month']) & !empty($_POST['year'])){
				$survey_date = $_POST['year']."_".$_POST['month']."_15";
				$date_cond = " WHERE survey_date =  '$survey_date' ";
			}
			else $date_cond = '';
			
			if(!empty($_POST['zone'])){
				$zn=$_POST['zone'];
				$zone_cond = " AND company.zone =  '$zn'";
			}
			else $zone_cond = '';
			
			
			
			$i=0;
			$temp= "";
			foreach($_POST['data'] as $q_id => $value){
				if( $value=='SELECT' ) continue;
				if($i == 0) $temp .=  " (RESULT.question_id = $q_id  AND RESULT.point = $value)";
				else $temp .=  " OR (RESULT.question_id = $q_id  AND RESULT.point = $value ) ";
				
				$i++;
			}
			$qry_cond =' AND ('.$temp.' )';
			//echo $qry_cond;
			if( !empty($temp) ){
			
				$this->loadModel('CompanyAnsList');
				$ans_lists = $this->CompanyAnsList->Query("
					
					SELECT RESULT.company_id, company.name,company.country ,company.zone, SUM(RESULT.point)/SUM(RESULT.status)*100 AS rating, RESULT.`survey_date` FROM 
					(
						SELECT t2.* FROM 
						(SELECT company_id,max(survey_date) as survey_date FROM `company_ans_lists` $date_cond GROUP BY company_id ) 
						AS t1
						LEFT JOIN `company_ans_lists` AS t2
						ON t1.company_id=t2.company_id WHERE t1.survey_date=t2.survey_date AND t2.signoff=1
					) AS RESULT
		
					LEFT JOIN companies AS company ON RESULT.company_id = company.id
					WHERE RESULT.section_id != 12 $zone_cond $qry_cond GROUP BY RESULT.company_id ORDER BY rating DESC
				
				");	
				$this->set('company_ans_list', $ans_lists );
			}
			
		}
		$this->loadModel('Section');
		$this->set('questions', $this->Section->find('all', array('order' => array('Section.order ASC')))  );
	}
	
	function admin_bycriteria() {
		$this->layout = 'cake';
		$this->loadModel('CompanyAnsList');
		
		$qry_cond= "";
		if(!empty($_POST)){
			$i=0;
			foreach($_POST['data'] as $criteria => $value){
				if( empty($value) ) continue;
				if($i==0 ) $qry_cond .=  " AND company.$criteria = '$value' ";
				else $qry_cond .=  " AND company.$criteria = '$value' ";
				$i++;
			}
		}
		//echo $qry_cond;
		
		$ans_lists = $this->CompanyAnsList->Query("
			
			SELECT RESULT.company_id, company.name,company.country ,company.zone, SUM(RESULT.point)/SUM(RESULT.status)*100 AS rating, RESULT.`survey_date` FROM 
			(
				SELECT t2.* FROM 
				(SELECT company_id,max(survey_date) as survey_date FROM `company_ans_lists` GROUP BY company_id ) 
				AS t1
				LEFT JOIN `company_ans_lists` AS t2
				ON t1.company_id=t2.company_id WHERE t1.survey_date=t2.survey_date AND t2.signoff=1
			) AS RESULT

			LEFT JOIN companies AS company ON RESULT.company_id = company.id
			WHERE RESULT.section_id != 12 $qry_cond  GROUP BY RESULT.company_id ORDER BY rating DESC
		
		");
		
		//echo '<pre style="text-align:left">';
		//print_r($ans_lists);
		//echo '</pre>';
		$this->set('company_ans_list', $ans_lists );
		$this->loadModel('Company');
		$this->set('all_zone', $this->Company->query("SELECT DISTINCT zone from companies") );
		$this->set('all_country', $this->Company->query("SELECT DISTINCT country from companies") );
		$this->set('all_product', $this->Company->query("SELECT DISTINCT product from companies") );
		
		
	}
	
	
	function admin_facilitystatus( $company_id = null ){
		if( empty($company_id) )
			$this->redirect(array('controller' => 'counselors', 'action' => 'home'));
		
		$this->set('company_id', $company_id );
		
		$this->loadModel('Company');
		$company_info = $this->Company->Query("SELECT *  FROM `companies` WHERE `id`=$company_id");
		$this->set('company_info', $company_info );
		
		
		$this->loadModel('CompanyAnsList');
		$ans_lists = $this->CompanyAnsList->Query("SELECT `company_id`,SUM( `status` ),SUM(`point`),`survey_date` FROM `company_ans_lists` WHERE `company_id`=$company_id AND `section_id` != 12 GROUP BY `survey_date` ");	//without section D
		$this->set('company_ans_list', $ans_lists );
		
				
	}
	
	function admin_facilityans( $company_id = null, $survey_date = null ){
		$this->layout = 'cake';
		if( empty($company_id) ||  empty($survey_date) )
			$this->redirect(array('controller' => 'counselors', 'action' => 'home'));

		$this->loadModel('Survey');
		$res = $this->Survey->query("SELECT questions.section_id, questions.status, questions.question, company_ans_lists.status, company_ans_lists.point FROM questions LEFT JOIN company_ans_lists ON questions.id=company_ans_lists.question_Id WHERE company_ans_lists.survey_date='$survey_date' AND company_ans_lists.company_id='$company_id' ORDER BY questions.section_id ASC, questions.order ASC ") ;
		$this->set('ans_list', $res  );
		$this->set('sec', $this->Survey->query("SELECT * From sections ORDER BY 'order' ") );
		
		$this->loadModel('Company');
		$company_info = $this->Company->Query("SELECT *  FROM `company_info_archives` as companies WHERE `company_id`=$company_id AND survey_date='$survey_date' ");
		$this->set('company_info', $company_info );
		$this->set('survey_date', $survey_date );
		
	}
	
	function admin_facilitysectionans( $company_id = null, $survey_date = null ){
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
	
	
	function admin_bysectionsingle() {
		
		$this->layout = 'entry';
		$this->loadModel('Section');
		$this->set('all_sections', $this->Section->Query("SELECT * from sections ORDER BY id ASC") );
		
		$this->loadModel('Company');
		$this->set('all_companies', $this->Company->query("SELECT DISTINCT name, id from companies") );
		
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
			$ans_lists = $this->CompanyAnsList->Query("SELECT `company_id`,SUM( `point` )/SUM(`status`)*100 as rating,`survey_date` FROM `company_ans_lists` WHERE `company_id`=$company_id AND signoff=1 AND $qry_cond $range_cnd GROUP BY `survey_date` ORDER BY survey_date ASC
			");
			$this->set('company_ans_list', $ans_lists );
			
			
			//for overall graph
			$ans_lists = $this->CompanyAnsList->Query("SELECT `company_id`,SUM( `point` )/SUM(`status`)*100 as rating,`survey_date` FROM `company_ans_lists` WHERE `company_id`=$company_id $range_cnd GROUP BY `survey_date` ORDER BY survey_date ASC
			");
			$this->set('overall_company_ans_list', $ans_lists );
		}	
	}
	
	function admin_bycriteriasingle() {
		
		$this->layout = 'entry';
		
		
		$this->loadModel('Company');
		$this->set('all_companies', $this->Company->query("SELECT DISTINCT name, id from companies") );
		
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
	
	
	
}
?>