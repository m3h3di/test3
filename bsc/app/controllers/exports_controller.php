<?php
class ExportsController extends AppController {

	var $name = 'Exports';
	var $helpers = array('Html', 'Javascript'); 
	function beforeFilter() {
		//$this->layout = 'cake';
		//parent::beforeFilter(); 
		//$this->Auth->allow('*');
		//$this->Auth->allow('add');
		if( $this->Session->read('Auth.User.group_id') != 1 & ($this->Session->read('Auth.User.status') == (1||2) )  ) // status=1 means Admin
			$this->redirect( "/counselors/home" );
	}
	
	
	

	
	//multiple enterprise-by enterprise
	function enterprise_export( $ezone = null) { 
	$menu_item="multiple_enterprise";$this->Session->write('menu_item', $menu_item);
		
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
		
		$this->set('company_ans_list', $ans_lists );
		
		
	}
	
	
	
	
	
	
	
	
	
	
}
?>