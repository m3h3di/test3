<?php
class CpanelsController extends AppController {

	var $name = 'Cpanels';
	var $helpers = array('Html', 'Javascript'); 
	function beforeFilter() {
		//$this->layout = 'cake';
		//parent::beforeFilter(); 
		//$this->Auth->allow('*');
		//$this->Auth->allow('add');
		
		
		
		
		if( $this->Session->read('Auth.User.group_id') != 1 && ($this->Session->read('Auth.User.status') != (1||2) )  ) // status=1 means Admin
			$this->redirect( "/counselors/home" );
			
			
	
			
			
	}
	
	function admin_index() {  
		$menu_item="admin_home";$this->Session->write('menu_item', $menu_item);
		
		if( $this->Session->read('Auth.User.status') == "2" )
		{
			/////to count the pending survey start
			$this->loadModel('CompanyAnsList');
			$signoff_num = $this->CompanyAnsList->Query("SELECT COUNT(DISTINCT company_id) AS n 
						 FROM `company_ans_lists` WHERE signoff=0" );	
			
			foreach($signoff_num as $key=>$signoff)
			{
				 $signoff=$signoff['0']['n'];  
			}
			$this->set("signoff",$signoff);	
			/////to count the pending survey end
					
					
			$this->set('so', 'so' );
		}
	}
	
	function admin_signoff()	
	{
		//echo $_POST['year'];echo $_POST['month'];exit;
		
		if( $this->Session->read('Auth.User.status') != 2 ) // status=1 means Admin
			$this->redirect( "/counselors/home" );
		
		$this->layout = 'cake';
		$this->loadModel('CompanyAnsList');
		
		
		if(!empty($_POST['month']) & !empty($_POST['year']))
		{
				$survey_date = $_POST['year']."_".$_POST['month']."_15";
				$date_cond = " AND survey_date =  '$survey_date' ";
		}
		else 
		{
			$date_cond = "";
		}
		
		//echo $date_cond;exit;
		
		
		$zone_cnd="";
		if( !empty($ezone) )
		{
			$zone_cnd = " AND company.zone='$ezone' ";
			$this->set('ezone', $ezone );
		}
		
		$ans_lists = $this->CompanyAnsList->Query("
			SELECT company.id,company.name,company.zone,RESULT.* FROM
			(SELECT company_id,survey_date,sum(point)/sum(status)*100 as rating FROM `company_ans_lists`  
			WHERE section_id != 12 AND signoff=0 $date_cond GROUP BY Survey_date,company_id) as RESULT
			
			LEFT JOIN companies AS company ON RESULT.company_id = company.id 
			ORDER BY RESULT.company_id,RESULT.Survey_date ");	
		
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
			
			//echo "<pre>";
			//print_r($signoff);
			//echo "</pre>";
			$this->redirect(array('controller' => 'cpanels', 'action' => 'signoff'));
				
			
		}
	}
	
	
	//multiple enterprise-by zone
	function admin_byzone()	{ $menu_item="multiple_enterprise";$this->Session->write('menu_item', $menu_item);
		$this->layout = 'cake';
		$this->loadModel('CompanyAnsList');
		$ans_lists = $this->CompanyAnsList->Query("
			
			SELECT company.zone,
			SUM(RESULT.point)/SUM(RESULT.status)*100 AS rating, RESULT.`survey_date` FROM 
			(
				SELECT t2.* FROM 
				(SELECT company_id,max(survey_date) as survey_date FROM `company_ans_lists` WHERE signoff=1 GROUP BY company_id ) 
				AS t1
				LEFT JOIN `company_ans_lists` AS t2
				ON t1.company_id=t2.company_id WHERE t1.survey_date=t2.survey_date 
			) AS RESULT

			LEFT JOIN companies AS company ON RESULT.company_id = company.id
			WHERE RESULT.section_id != 12 GROUP BY company.zone ORDER BY company.zone DESC
		
		");	
		
		$this->set('company_ans_list', $ans_lists );
		
		
		
		//for compliance issues
		
		$this->layout = 'entry';
		$this->loadModel('Section');
		$this->set('all_sections', $this->Section->Query("SELECT * from sections ORDER BY id ASC") );
		
		$this->loadModel('Company');
		$this->set('all_zone', $this->Company->query("SELECT DISTINCT zone from companies") );
		

		
		if(!empty($_POST['data'])){
					//generating survey date
			
			/*if(!empty($_POST['month']) & !empty($_POST['year'])){				$survey_date =  $_POST['year']."_".$_POST['month']."_15";
				$date_cond = " AND survey_date =  '$survey_date' ";

			}
			else $date_cond = '';
			
			if(!empty($_POST['zone'])){
				$zn=$_POST['zone'];
				$zone_cond = "  company.zone =  '$zn' AND";
			}
			else $zone_cond = '';*/
			
			
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
			
			//echo $qry_cond;exit;
			
			$ans_lists_by_com_issues = $this->CompanyAnsList->Query("
					
				SELECT RESULT.company_id, company.name,company.zone, SUM(RESULT.point)/SUM(RESULT.status)*100 AS rating, RESULT.`survey_date` FROM 
				(
					SELECT t2.* FROM 
					(SELECT company_id,max(survey_date) as survey_date FROM `company_ans_lists`  WHERE signoff=1 GROUP BY company_id ) 
					AS t1
					LEFT JOIN `company_ans_lists` AS t2
					ON t1.company_id=t2.company_id WHERE t1.survey_date=t2.survey_date
				) AS RESULT
	
				LEFT JOIN companies AS company ON RESULT.company_id = company.id
				GROUP BY company.zone ORDER BY company.zone DESC
			
			"); 
			
						
			$this->set('company_ans_list_by_com_issues', $ans_lists_by_com_issues );
			
			
			
			//echo '<pre style="text-align:left">';
//print_r($ans_lists_by_com_issues);
//echo '</pre>';exit;
			
		}
		
		
		
		
		
		//echo '<pre style="text-align:left">';
		//print_r($ans_lists);
		//echo '</pre>';
		
	}
	
	
	
	//multiple enterprise-by compliance issues
	function admin_bysection() {$menu_item="multiple_enterprise";$this->Session->write('menu_item', $menu_item);
		$this->layout = 'entry';
		$this->loadModel('Section');
		$this->set('all_sections', $this->Section->Query("SELECT * from sections ORDER BY id ASC") );
		
		$this->loadModel('Company');
		$this->set('all_zone', $this->Company->query("SELECT DISTINCT zone from companies") );
		

		
		if(!empty($_POST['data'])){
			
			//generating survey date
			
			
			if(!empty($_POST['month']) & !empty($_POST['year'])){
				$survey_date = $_POST['year']."_".$_POST['month']."_15";
				$date_cond = " AND survey_date =  '$survey_date' ";
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
					(SELECT company_id,max(survey_date) as survey_date FROM `company_ans_lists`  WHERE signoff=1  $date_cond GROUP BY company_id ) 
					AS t1
					LEFT JOIN `company_ans_lists` AS t2
					ON t1.company_id=t2.company_id WHERE t1.survey_date=t2.survey_date
				) AS RESULT
	
				LEFT JOIN companies AS company ON RESULT.company_id = company.id
				WHERE $zone_cond $qry_cond GROUP BY RESULT.company_id ORDER BY rating DESC
			
			");
			$this->set('company_ans_list', $ans_lists );
		}
		
	}
	
	//multiple enterprise-by enterprise
	function admin_showlist( $ezone = null) { $menu_item="multiple_enterprise";$this->Session->write('menu_item', $menu_item);
		$this->layout = 'cake';
		$this->loadModel('CompanyAnsList');
		
		
		
		$zone_cnd= "";
		if(!empty($_POST)){
			$i=0;
			foreach($_POST['data'] as $criteria => $value){
				if( empty($value) ) continue;
				if($i==0 ) $zone_cnd .=  " AND company.$criteria = '$value' ";
				else $zone_cnd .=  " AND company.$criteria = '$value' ";
				$i++;
			}
		}
		//echo $zone_cnd;exit;
		
		
		$ans_lists = $this->CompanyAnsList->Query("
			
			SELECT RESULT.company_id, company.*,
			SUM(RESULT.point)/SUM(RESULT.status)*100 AS rating, RESULT.`survey_date` FROM 
			(
				SELECT t2.* FROM 
				(SELECT company_id,max(survey_date) as survey_date FROM `company_ans_lists`  WHERE signoff=1  GROUP BY company_id ) 
				AS t1
				LEFT JOIN `company_ans_lists` AS t2
				ON t1.company_id=t2.company_id WHERE t1.survey_date=t2.survey_date 
			) AS RESULT

			LEFT JOIN companies AS company ON RESULT.company_id = company.id
			WHERE RESULT.section_id != 12 $zone_cnd GROUP BY RESULT.company_id ORDER BY rating DESC
		
		");	
		
		//echo '<pre style="text-align:left">';
		//print_r($ans_lists);
		//echo '</pre>';
		$this->set('company_ans_list', $ans_lists );
		
		
		// to generate report start by zone and by product_category
		$this->loadModel('Company');
		$this->set('all_zone', $this->Company->query("SELECT DISTINCT zone from companies") );
		$this->set('all_product', $this->Company->query("SELECT * from product_categories") ); //instead of 'by product' it'll be 'by product category'
		
		
		
		//print_r($ans_lists);
		
		//echo var_dump($this->params['form']['export']);
		/*if($this->params['form']['export'] == 'export')
		{
			$this->redirect(array('action'=>'admin_enterprise_export',$ans_lists)); 
		}*/
		
		
		
		
	}
	
	
	
	function admin_byzone_details( $ezone = null) 
	{ $menu_item="multiple_enterprise";$this->Session->write('menu_item', $menu_item);
		$this->layout = 'cake';
		$this->loadModel('CompanyAnsList');
		
		
		$zone_cnd= "";
		if(!empty($_POST)){
			$i=0;
			foreach($_POST['data'] as $criteria => $value){
				if( empty($value) ) continue;
				if($i==0 ) $zone_cnd .=  " AND company.$criteria = '$value' ";
				else $zone_cnd .=  " AND company.$criteria = '$value' ";
				$i++;
			}
		}
		//echo $zone_cnd;exit;
		
		
		$ans_lists = $this->CompanyAnsList->Query("
			
			SELECT RESULT.company_id, company.*,
			SUM(RESULT.point)/SUM(RESULT.status)*100 AS rating, RESULT.`survey_date` FROM 
			(
				SELECT t2.* FROM 
				(SELECT company_id,max(survey_date) as survey_date FROM `company_ans_lists`  WHERE signoff=1  GROUP BY company_id ) 
				AS t1
				LEFT JOIN `company_ans_lists` AS t2
				ON t1.company_id=t2.company_id WHERE t1.survey_date=t2.survey_date 
			) AS RESULT

			LEFT JOIN companies AS company ON RESULT.company_id = company.id
			WHERE RESULT.section_id != 12 $zone_cnd GROUP BY RESULT.company_id ORDER BY rating DESC
		
		");	
		
		//echo '<pre style="text-align:left">';
		//print_r($ans_lists);
		//echo '</pre>';
		$this->set('company_ans_list', $ans_lists );
		
		
		// to generate report start by zone and by product_category
		$this->loadModel('Company');
		$this->set('all_zone', $this->Company->query("SELECT DISTINCT zone from companies") );
		$this->set('all_product', $this->Company->query("SELECT * from product_categories") ); //instead of 'by product' it'll be 'by product category'
		
	}
	
	
	
	
	
	
	//multiple enterprise-by question
	function admin_byquestion() {$menu_item="multiple_enterprise";$this->Session->write('menu_item', $menu_item);
		$this->layout = 'entry';
		
		$this->loadModel('Company');
		$this->set('all_zone', $this->Company->query("SELECT DISTINCT zone from companies") );
		
		
		//print_r($_POST['data']);exit;
		
		if( !empty($_POST['data']) ){
			//$qry_cond ='AND ( ';
			
			if(!empty($_POST['month']) & !empty($_POST['year'])){
				$survey_date = $_POST['year']."_".$_POST['month']."_15";
				$date_cond = " AND survey_date =  '$survey_date' ";
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
			//echo $qry_cond;exit;
			if( !empty($temp) ){
			
				$this->loadModel('CompanyAnsList');
				$ans_lists = $this->CompanyAnsList->Query("
					
					SELECT RESULT.company_id, company.name,company.country ,company.zone, SUM(RESULT.point)/SUM(RESULT.status)*100 AS rating, RESULT.`survey_date` FROM 
					(
						SELECT t2.* FROM 
						(SELECT company_id,max(survey_date) as survey_date FROM `company_ans_lists`  WHERE signoff=1 $date_cond GROUP BY company_id ) 
						AS t1
						LEFT JOIN `company_ans_lists` AS t2
						ON t1.company_id=t2.company_id WHERE t1.survey_date=t2.survey_date 
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
	
	
	//multiple enterprise-by enterprise characteristics
	function admin_bycriteria() { $menu_item="multiple_enterprise";$this->Session->write('menu_item', $menu_item);
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
		//echo $qry_cond;exit; ////////////company.product_category
		
		$ans_lists = $this->CompanyAnsList->Query("
			
			SELECT RESULT.company_id, company.name,company.country ,company.zone,
			 SUM(RESULT.point)/SUM(RESULT.status)*100 AS rating, RESULT.`survey_date` FROM 
			(
				SELECT t2.* FROM 
				(SELECT company_id,max(survey_date) as survey_date FROM `company_ans_lists`  WHERE signoff=1 GROUP BY company_id ) 
				AS t1
				LEFT JOIN `company_ans_lists` AS t2
				ON t1.company_id=t2.company_id WHERE t1.survey_date=t2.survey_date 
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
		
		//$this->set('all_country', $this->Company->query("SELECT DISTINCT country from companies") );
		//$this->set('all_product', $this->Company->query("SELECT DISTINCT product from companies") );
		
		$this->set('all_product', $this->Company->query("SELECT * from product_categories") ); //instead of 'by product' it'll be 'by product category'
		
		
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
	
	
	///single enterprise-by compliance issues
	function admin_bysectionsingle() { $menu_item="single_enterprise";$this->Session->write('menu_item', $menu_item);
		
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
			
			/*$ans_lists = $this->CompanyAnsList->Query("SELECT `company_id`,SUM( `point` )/SUM(`status`)*100 as rating,`survey_date` FROM `company_ans_lists` WHERE `company_id`=$company_id AND signoff=1 AND $qry_cond $range_cnd GROUP BY `survey_date` ORDER BY survey_date ASC
			");*///////without surveyor
			
			
			
			
			$ans_lists = $this->CompanyAnsList->Query("SELECT company_ans_lists.company_id as company_id,
			SUM(company_ans_lists.point)/SUM(company_ans_lists.status)*100 as rating,
			
			company_ans_lists.survey_date as survey_date,users.id as user_id,users.name as user_name 
			
			FROM `company_ans_lists`, `users` 
			
			WHERE company_ans_lists.user_id=users.id AND 
			company_ans_lists.company_id=$company_id AND 
			company_ans_lists.signoff=1 AND $qry_cond $range_cnd GROUP BY company_ans_lists.survey_date ORDER BY company_ans_lists.survey_date ASC");
			
			$this->set('company_ans_list', $ans_lists );
			
			
			
			
			
			//for overall graph
			$ans_lists = $this->CompanyAnsList->Query("SELECT `company_id`,SUM( `point` )/SUM(`status`)*100 as rating,`survey_date` FROM `company_ans_lists` WHERE `company_id`=$company_id AND signoff=1 $range_cnd GROUP BY `survey_date` ORDER BY survey_date ASC
			");
			$this->set('overall_company_ans_list', $ans_lists );
		}	
	}
	
	///single enterprise-by enterprise characteristics
	function admin_bycriteriasingle() {$menu_item="single_enterprise";$this->Session->write('menu_item', $menu_item);
		
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
			
			/*$ans_lists = $this->CompanyInfoArchive->Query("SELECT survey_date, $criteria AS cr FROM company_info_archives 
								WHERE `company_id`='$company_id' $range_cnd  ORDER BY survey_date ASC");*/
			
			$ans_lists = $this->CompanyInfoArchive->Query("SELECT survey_date, zone,$criteria AS cr FROM company_info_archives 
								WHERE `company_id`='$company_id' $range_cnd  ORDER BY survey_date ASC");					
								
			$this->set('res_criteria', $ans_lists );
			
			$max = $this->CompanyInfoArchive->Query("SELECT max($criteria) AS max FROM company_info_archives WHERE `company_id`='$company_id'  ");
			$this->set('max', $max );
			
			$min = $this->CompanyInfoArchive->Query("SELECT min($criteria) AS min FROM company_info_archives WHERE `company_id`='$company_id'  ");
			$this->set('min', $min );
                         $this->set('criteria', $criteria );
			
		}
		
		
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	//admin_showlist export table start (By multiple enterprise/By enterprise)
	function admin_enterprise_export($zone = null,$product = null) 
	{ 
		$this->layout = 'export_xls';
		
		//echo $zone;echo $product;
		
		$zone_cnd= "";
		$this->loadModel('CompanyAnsList');
		
		if($zone!=NULL || $product!=NULL)
		{
			$zone_cnd .=  " AND company.zone = '{$zone}' AND company.product_category = '{$product}' ";
		}
		else 
		{
			$zone_cnd= "";
		}
		
		/*if($product!=NULL)
		{
			$zone_cnd .=  " AND company.product_category = '$product' ";
		}*/
		
		//echo $zone_cnd;
		
			
		
		$ans_lists = $this->CompanyAnsList->Query("
			
			SELECT RESULT.company_id, company.*,
			SUM(RESULT.point)/SUM(RESULT.status)*100 AS rating, RESULT.`survey_date` FROM 
			(
				SELECT t2.* FROM 
				(SELECT company_id,max(survey_date) as survey_date FROM `company_ans_lists`  WHERE signoff=1  GROUP BY company_id ) 
				AS t1
				LEFT JOIN `company_ans_lists` AS t2
				ON t1.company_id=t2.company_id WHERE t1.survey_date=t2.survey_date 
			) AS RESULT

			LEFT JOIN companies AS company ON RESULT.company_id = company.id
			
			WHERE RESULT.section_id != 12 
			
			$zone_cnd 
			
			GROUP BY RESULT.company_id ORDER BY rating DESC
		
		");	 //print_r($ans_lists);exit;
		
		$this->set('company_ans_list', $ans_lists );
		
		
	}	
	//admin_showlist export table end
	
	
	
	
	
	
	
	//multiple enterprise-by zone
	function admin_zone_export($section)	
	{ 
		$this->layout = 'export_xls';
		$this->loadModel('CompanyAnsList');
		
		
		if($section!=NULL)
		{
			$pieces = explode("-", $section);
		}
		else{
			$pieces=NULL;
		}
		
		//for compliance issues
		//echo $pieces;
		
	
		if(!empty($pieces))
		{
			//$all_data = $pieces;
			//$this->Session->write('sec_id_list', $all_data);
			
			$this->loadModel('CompanyAnsList');
			$qry_cond = "(";
			$i=0;
			
			foreach($pieces as $sec_id=>$val)
			{
				if($i==0 ) $qry_cond .=  " RESULT.section_id = $val ";
				else $qry_cond .=  " OR RESULT.section_id = $val ";
				$i++;
			}
			
			$qry_cond .= ")";
			
			//echo $qry_cond;exit;
			
			$ans_lists_by_com_issues = $this->CompanyAnsList->Query("
					
				SELECT RESULT.company_id, company.name,company.zone, SUM(RESULT.point)/SUM(RESULT.status)*100 AS rating, RESULT.`survey_date` FROM 
				(
					SELECT t2.* FROM 
					(SELECT company_id,max(survey_date) as survey_date FROM `company_ans_lists`  WHERE signoff=1 GROUP BY company_id ) 
					AS t1
					LEFT JOIN `company_ans_lists` AS t2
					ON t1.company_id=t2.company_id WHERE t1.survey_date=t2.survey_date
				) AS RESULT
	
				LEFT JOIN companies AS company ON RESULT.company_id = company.id
				GROUP BY company.zone ORDER BY company.zone DESC
			
			"); 
			
						
			$this->set('company_ans_list', $ans_lists_by_com_issues );
			
		
		}
		
		
		else 
		{
				$ans_lists = $this->CompanyAnsList->Query("
				
				SELECT company.zone,
				SUM(RESULT.point)/SUM(RESULT.status)*100 AS rating, RESULT.`survey_date` FROM 
				(
					SELECT t2.* FROM 
					(SELECT company_id,max(survey_date) as survey_date FROM `company_ans_lists` 
					WHERE signoff=1 GROUP BY company_id ) 
					AS t1
					LEFT JOIN `company_ans_lists` AS t2
					ON t1.company_id=t2.company_id WHERE t1.survey_date=t2.survey_date 
				) AS RESULT
	
				LEFT JOIN companies AS company ON RESULT.company_id = company.id
				WHERE RESULT.section_id != 12 GROUP BY company.zone ORDER BY company.zone DESC
			
			");	
			
			$this->set('company_ans_list', $ans_lists );	
			
		}
		
	
	}
	
	
	//multiple enterprise-by compliance issues
	function admin_by_compliance_issue_export($zone,$year,$month,$section) {
		$this->layout = 'export_xls';
		
		
		//if(!empty($_POST['data'])){
			
			if(!empty($zone)){
				$zn=$zone;
				$zone_cond = "  company.zone =  '$zn' AND";
			}
			else $zone_cond = '';
			
			if(!empty($month) & !empty($year)){
				$survey_date = $year."_".$month."_15";
				$date_cond = " AND survey_date =  '$survey_date' ";
			}
			else $date_cond = '';
						
			
			//$all_data = $_POST['data'];
			//$this->Session->write('sec_id_list', $all_data);
			
			$pieces = explode("-", $section);
			
			$this->loadModel('CompanyAnsList');
			$qry_cond = "(";
			$i=0;
			
			
			foreach($pieces as $sec_id=>$val)
			{
				if($val!=NULL)
				{
					if($i==0 ) $qry_cond .=  " RESULT.section_id = $val ";
					else $qry_cond .=  " OR RESULT.section_id = $val ";
					$i++;
				}
			}
			
			$qry_cond .= ")";
			
			
			/*echo $survey_date;
			echo $zone_cond;
			echo $qry_cond;exit;*/
			
			
			$ans_lists = $this->CompanyAnsList->Query("
					
				SELECT RESULT.company_id, company.name,company.zone, SUM(RESULT.point)/SUM(RESULT.status)*100 AS rating, RESULT.`survey_date` FROM 
				(
					SELECT t2.* FROM 
					(SELECT company_id,max(survey_date) as survey_date FROM `company_ans_lists`  WHERE signoff=1  $date_cond GROUP BY company_id ) 
					AS t1
					LEFT JOIN `company_ans_lists` AS t2
					ON t1.company_id=t2.company_id WHERE t1.survey_date=t2.survey_date
				) AS RESULT
	
				LEFT JOIN companies AS company ON RESULT.company_id = company.id
				WHERE $zone_cond $qry_cond GROUP BY RESULT.company_id ORDER BY rating DESC
			
			"); //print_r($ans_lists);exit;
			$this->set('company_ans_list', $ans_lists );
		//}
		
	}
	
	
	
	
	//multiple enterprise-by question
	/*function admin_by_question_export() 
	{
		$this->layout = 'export_xls';
		
		
		//if( !empty($_POST['data']) ){
			//$qry_cond ='AND ( ';
			
			if(!empty($_POST['month']) & !empty($_POST['year'])){
				$survey_date = $_POST['year']."_".$_POST['month']."_15";
				$date_cond = " AND survey_date =  '$survey_date' ";
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
			//echo $qry_cond;exit;
			if( !empty($temp) ){
			
				$this->loadModel('CompanyAnsList');
				$ans_lists = $this->CompanyAnsList->Query("
					
					SELECT RESULT.company_id, company.name,company.country ,company.zone, SUM(RESULT.point)/SUM(RESULT.status)*100 AS rating, RESULT.`survey_date` FROM 
					(
						SELECT t2.* FROM 
						(SELECT company_id,max(survey_date) as survey_date FROM `company_ans_lists`  WHERE signoff=1 $date_cond GROUP BY company_id ) 
						AS t1
						LEFT JOIN `company_ans_lists` AS t2
						ON t1.company_id=t2.company_id WHERE t1.survey_date=t2.survey_date 
					) AS RESULT
		
					LEFT JOIN companies AS company ON RESULT.company_id = company.id
					WHERE RESULT.section_id != 12 $zone_cond $qry_cond GROUP BY RESULT.company_id ORDER BY rating DESC
				
				");	
				$this->set('company_ans_list', $ans_lists );
			}
			
		//}
		
	}*/
	
	
	
	
	
	
	
	
	//multiple enterprise-by enterprise characteristics
	function admin_ent_char_export($zone = null,$product = null) {
		$this->layout = 'export_xls';
		$this->loadModel('CompanyAnsList');
		
		
		$qry_cond= "";
		
		/*if(!empty($_POST)){
			$i=0;
			foreach($_POST['data'] as $criteria => $value){
				if( empty($value) ) continue;
				if($i==0 ) $qry_cond .=  " AND company.$criteria = '$value' ";
				else $qry_cond .=  " AND company.$criteria = '$value' ";
				$i++;
			}
		}*/
		
		if($zone!=NULL || $product!=NULL)
		{
			$qry_cond .=  " AND company.zone = '{$zone}' AND company.product_category = '{$product}' ";
		}
		else 
		{
			$qry_cond= "";
		}
		//echo $qry_cond;exit;
		
		$ans_lists = $this->CompanyAnsList->Query("
			
			SELECT RESULT.company_id, company.name,company.country ,company.zone,
			 SUM(RESULT.point)/SUM(RESULT.status)*100 AS rating, RESULT.`survey_date` FROM 
			(
				SELECT t2.* FROM 
				(SELECT company_id,max(survey_date) as survey_date FROM `company_ans_lists`  WHERE signoff=1 GROUP BY company_id ) 
				AS t1
				LEFT JOIN `company_ans_lists` AS t2
				ON t1.company_id=t2.company_id WHERE t1.survey_date=t2.survey_date 
			) AS RESULT

			LEFT JOIN companies AS company ON RESULT.company_id = company.id
			WHERE RESULT.section_id != 12 $qry_cond  GROUP BY RESULT.company_id ORDER BY rating DESC
		
		");
		
		//echo '<pre style="text-align:left">';
		//print_r($ans_lists);exit;
		//echo '</pre>';exit;
		
		$this->set('company_ans_list', $ans_lists );
		
		
		
	}
	
	
	
	
	
	
	
	
	///single enterprise-by compliance issues
	/*function admin_sing_ent_com_issue_export($company,$fyear,$fmonth,$tyear,$tmonth,$sec) 
	{
		$this->layout = 'entry';
		
		//if(!empty($_POST['data'])){
			
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
			$ans_lists = $this->CompanyAnsList->Query("SELECT `company_id`,SUM( `point` )/SUM(`status`)*100 as rating,`survey_date` FROM `company_ans_lists` WHERE `company_id`=$company_id AND signoff=1 $range_cnd GROUP BY `survey_date` ORDER BY survey_date ASC
			");
			$this->set('overall_company_ans_list', $ans_lists );
			
		//}	
		
	}*/
	
	
	
	
	
	
}
?>