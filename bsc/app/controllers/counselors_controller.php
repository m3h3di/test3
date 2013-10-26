<?php
class CounselorsController extends AppController {

	var $name = 'Counselors';
	var $helpers = array('Html', 'Javascript'); 
	
	function beforeFilter() {
		
		//parent::beforeFilter(); 
		//$this->Auth->allow('*');
		//$this->Auth->allow('add');
		if( $this->Session->read('Auth.User.group_id') == 1 ) // group_id=1 means admin
				$this->redirect( array('controller'=>'admin', 'action'=>'cpanels') );
				
			
			
			
			
		//for new notice start 
		$date = date("Y_m_d");
		$notices=$this->Counselor->query("SELECT count(t1.id) as n FROM notice_boards as t1 
										  WHERE t1.valid_until >= '$date' AND '$date'  >= t1.published_date AND t1.id not in
										  (SELECT t2.notice_id FROM notice_status as t2) ");
			
			//print_r($notices);exit;
			foreach($notices as $key=>$notice)
			{
				 $new_notice=$notice['0']['n'];  
			}
			$this->set("new_notice",$new_notice);	
			//$this->Session->write('new_notice', $new_notice);
		//for new notice end 	
				
	}
	
	function home(){  $menu_item="counselor_home";$this->Session->write('menu_item', $menu_item);
		//echo '<pre style="text-align: left">';
		//print_r($this->Auth->User('group_id'));
		//echo '</pre>';

		
		//$user_id = $this->Auth->User('group_id');
		 $group_id = $this->Auth->User('group_id');
		//$this->set("companies", $this->Counselor->findById($group_id));
		$date = date("Y_m_d");
		//$this->set("notices", $this->Counselor->query("SELECT * FROM notice_boards WHERE valid_until >= '$date' AND '$date'  >= published_date "));
		
		$this->set("notices", $this->Counselor->query("
			SELECT t1.*,t2.status FROM notice_boards as t1 LEFT JOIN notice_status as t2
			ON t1.id=t2.notice_id 
			WHERE t1.valid_until >= '$date' AND '$date'  >= t1.published_date"
			
			));
		
		
		if(!empty($_POST['month']) & !empty($_POST['year'])){
				$survey_date = $_POST['year']."_".$_POST['month']."_15";
				$date_cond = " WHERE survey_date =  '$survey_date' ";
			}
			else {
				$survey_date = date('Y_m')."_15";
				//$survey_date = "2011_01_15";
				$date_cond = " WHERE survey_date =  '$survey_date' ";
			}
		
		$this->loadModel('Company');
		$company_status = $this->Company->query("SELECT DISTINCT t1.id,t1.name,t2.survey_date FROM companies AS t1
			LEFT JOIN (SELECT company_id,max(survey_date) as survey_date FROM `company_ans_lists` $date_cond GROUP BY company_id ) AS t2
			ON t1.id=t2.company_id
			WHERE t1.group_id= $group_id");
		$this->set("companies_status", $company_status);

		
		
		
		
		$ttt=$this->Session->read('session_company');
		if( empty($ttt) ){
			$this->Session->write('session_company', $company_status);
		}
		
		
		/*SELECT DISTINCT t1.id,t1.name,t2.created FROM companies AS t1
			LEFT JOIN (SELECT company_id,max(created) as created FROM `company_ans_lists` GROUP BY company_id ) AS t2
			ON t1.id=t2.company_id
			WHERE t1.group_id=$id
			
			SELECT DISTINCT t1.id,t1.name,t2.created FROM companies AS t1
			LEFT JOIN (SELECT DISTINCT company_id, created FROM `company_ans_lists` WHERE created LIKE '2011-01%' ) AS t2
			ON t1.id=t2.company_id
			WHERE t1.group_id=$id
		*/
	}
	
	function index(){
		//$id = $this->Auth->User('id');
		//$this->set("companies", $this->Counselor->findById($id));
		//$this->redirect( array('action'=>'home') );
	}
	
	function facility( $company_id = null ){ $menu_item="counselor_ent";$this->Session->write('menu_item', $menu_item);
		//Start checking the factory assigned to this user or not
		if( !empty($company_id)){
			$group_id = $this->Auth->User('group_id');
			$this->loadModel('Company');
			
			$res = $this->Company->query("SELECT * FROM companies WHERE id=$company_id") ;
			//print_r($res);
			$res_id = $res[0]['companies']['group_id'];
			$res_name = $res[0]['companies']['name'];
		
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
		
			
		$this->set('company_id', $company_id );
		
		$company_info = $this->Company->Query("SELECT *  FROM `companies` WHERE `id`=$company_id");
		$this->set('company_info', $company_info );
		
		$this->loadModel('CompanyAnsList');
		//$ans_lists = $this->CompanyAnsList->find('all', array('conditions' => array( 'CompanyAnsList.company_id'=> $company_id ) ));
		//$ans_lists = $this->CompanyAnsList->Query("SELECT `CompanyAnsList`.`id`, `CompanyAnsList`.`status`, `CompanyAnsList`.`created`, `CompanyAnsList`.`modified` FROM `company_ans_lists`  WHERE `CompanyAnsList`.`company_id` = $company_id AND `CompanyAnsList`.`section_id` != 12 ORDER BY `CompanyAnsList`.`created` GROUP BY `CompanyAnsList`.`created` ");	//without section D
				
		$ans_lists = $this->CompanyAnsList->Query("SELECT `company_id`,SUM( `status` ),SUM(`point`),`survey_date` FROM `company_ans_lists` WHERE `company_id`=$company_id AND `section_id` != 12 GROUP BY `survey_date` ORDER BY survey_date ASC");	//without section D
			
		$this->set('company_ans_list', $ans_lists );
		
		
	}
	
	
	
	
	
	//mini admin panel added by nandinee start
	function enterprise_analysis( $ezone = null) 
	{ 
		$menu_item="counselor_ent_analysis";$this->Session->write('menu_item', $menu_item);
		$this->layout = 'cake';
	}
	
	
	///single enterprise-by compliance issues
	function by_single_ent_comliance_issu() 
	{ //$menu_item="counselor_ent_analysis";$this->Session->write('menu_item', $menu_item);
		
		$group_id = $this->Auth->User('group_id');//for a particulr counselor/group
		
		$this->layout = 'entry';
		$this->loadModel('Section');
		$this->set('all_sections', $this->Section->Query("SELECT * from sections ORDER BY id ASC") );
		
		$this->loadModel('Company');
		$this->set('all_companies', $this->Company->query("SELECT DISTINCT name, id from companies WHERE group_id='{$group_id}' ") );
		
		
		
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
			//echo $qry_cond;exit;
			$ans_lists = $this->CompanyAnsList->Query("SELECT `company_id`,SUM( `point` )/SUM(`status`)*100 as rating,`survey_date` FROM `company_ans_lists` WHERE `company_id`=$company_id AND signoff=1 AND $qry_cond $range_cnd GROUP BY `survey_date` ORDER BY survey_date ASC
			");
			$this->set('company_ans_list', $ans_lists );
			
			
			//for overall graph
			$ans_lists = $this->CompanyAnsList->Query("SELECT `company_id`,SUM( `point` )/SUM(`status`)*100 as rating,`survey_date` FROM `company_ans_lists` WHERE `company_id`=$company_id AND signoff=1 $range_cnd GROUP BY `survey_date` ORDER BY survey_date ASC
			");
			$this->set('overall_company_ans_list', $ans_lists );
		}	
	}
	
	
	///single enterprise-by enterprise characteristics
	function by_single_ent_ent_char() 
	{//$menu_item="counselor_ent_analysis";$this->Session->write('menu_item', $menu_item);
		
		$this->layout = 'entry';
		
		$group_id = $this->Auth->User('group_id');//for a particulr counselor/group
		
		$this->loadModel('Company');
		$this->set('all_companies', $this->Company->query("SELECT DISTINCT name, id from companies WHERE group_id='{$group_id}' ") );
		
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
                        $this->set('criteria', $criteria );
			
		}
		
		
	}
	
	

	//multiple enterprise-by enterprise start
	function mul_ent_by_ent( $ezone = null) { 
		//$menu_item="multiple_enterprise";$this->Session->write('menu_item', $menu_item);
		
		$this->layout = 'cake';
		$this->loadModel('CompanyAnsList');
		
		/*$zone_cnd="";
		if( !empty($ezone) ){
			$zone_cnd = " AND company.zone='$ezone' ";
			$this->set('ezone', $ezone );
		}*/
		
		$group_id = $this->Auth->User('group_id');//for a particulr counselor/group
		
		
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
			WHERE RESULT.group_id='{$group_id}' AND RESULT.section_id != 12 $zone_cnd GROUP BY RESULT.company_id ORDER BY rating DESC
		
		");	
		
		
		//echo '<pre style="text-align:left">';
		//print_r($ans_lists);
		//echo '</pre>';
		$this->set('company_ans_list', $ans_lists );
		
		
		// to generate report start by zone and by product_category
		$this->loadModel('Company');
		
		//$this->set('all_zone', $this->Company->query("SELECT DISTINCT zone from companies") );
		//$this->set('all_product', $this->Company->query("SELECT * from product_categories") ); //instead of 'by product' it'll be 'by product category'
		
	}
	
	//multiple enterprise-by enterprise end
	
	
	
	function mul_ent_by_ent_enterprise_info( $company_id = null )
	{
		$group_id = $this->Auth->User('group_id');//for a particulr counselor/group
		
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
	
	function mul_ent_by_ent_enterprise_ans( $company_id = null, $survey_date = null )
	{
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
	
	
	
	
	
	//multiple enterprise-by compliance issues start
	function mul_ent_by_compliance_issue() 
	{
		$this->layout = 'entry';
		$this->loadModel('Section');
		$this->set('all_sections', $this->Section->Query("SELECT * from sections ORDER BY id ASC") );
		
		$this->loadModel('Company');
		//$this->set('all_zone', $this->Company->query("SELECT DISTINCT zone from companies") );
		
		
		$group_id = $this->Auth->User('group_id');//for a particulr counselor/group
		
		
		
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
				WHERE RESULT.group_id=$group_id AND
				$zone_cond $qry_cond GROUP BY RESULT.company_id ORDER BY rating DESC
			
			");
			$this->set('company_ans_list', $ans_lists );   //RESULT.group_id='{$group_id}'
		}
		
	}
	//multiple enterprise-by compliance issues end
	
	
	
	//multiple enterprise-by question start
	function mul_ent_by_question() 
	{
		$this->layout = 'entry';
		
		$this->loadModel('Company');
		//$this->set('all_zone', $this->Company->query("SELECT DISTINCT zone from companies") );
		
		$group_id = $this->Auth->User('group_id');//for a particulr counselor/group
		
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
					WHERE RESULT.group_id='{$group_id}' AND RESULT.section_id != 12 $zone_cond $qry_cond GROUP BY RESULT.company_id ORDER BY rating DESC
				
				");	
				$this->set('company_ans_list', $ans_lists );
			}
			
		}
		$this->loadModel('Section');
		$this->set('questions', $this->Section->find('all', array('order' => array('Section.order ASC')))  );
	}
	//multiple enterprise-by question end
	

        function status_bar($val=NULL)
        {

    
           $this->set('value',$val);

        }

	
	//multiple enterprise-by enterprise characteristics
	function mul_ent_by_ent_char() 
	{
		$this->layout = 'cake';
		$this->loadModel('CompanyAnsList');
		
		$group_id = $this->Auth->User('group_id');//for a particulr counselor/group
		
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
			WHERE RESULT.group_id='{$group_id}' AND 
			RESULT.section_id != 12 $qry_cond GROUP BY RESULT.company_id ORDER BY rating DESC
		
		");
		
		//echo '<pre style="text-align:left">';
		//print_r($ans_lists);
		//echo '</pre>';
		$this->set('company_ans_list', $ans_lists );
		
		
		$this->loadModel('Company');
		//$this->set('all_zone', $this->Company->query("SELECT DISTINCT zone from companies") );
		
		//$this->set('all_product', $this->Company->query("SELECT * from product_categories") ); //instead of 'by product' it'll be 'by product category'
		
		
	}
	
	
	
	//mini admin panel added by nandinee end
	
	
	
	
}
?>