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
		
	}
	function ByEc(){
		$overall = $this->Admin->query("SELECT ratings.status, SUM(ratings.points) AS sum, COUNT( distinct(ratings.factory_id) ) as num FROM ratings GROUP BY  ratings.status");
		$this->set("overall" , $overall );
		
		$msds = $this->Admin->query("SELECT ratings_haz.status, SUM(ratings_haz.points) AS sum, COUNT(*) as num FROM ratings_haz WHERE ratings_haz.rating_rule_id=2 GROUP BY   ratings_haz.status");
		$this->set("msds" , $msds );
		
		$ppe = $this->Admin->query("SELECT ratings_haz.status, SUM(ratings_haz.points) AS sum, COUNT(*) as num FROM ratings_haz WHERE ratings_haz.rating_rule_id=4 GROUP BY   ratings_haz.status");
		$this->set("ppe" , $ppe );
		
		$storage = $this->Admin->query("SELECT ratings_haz.status, SUM(ratings_haz.points) AS sum, COUNT(*) as num FROM ratings_haz WHERE ratings_haz.rating_rule_id=6 GROUP BY   ratings_haz.status");
		$this->set("storage" , $storage );
		
		$spill = $this->Admin->query("SELECT ratings_haz.status, SUM(ratings_haz.points) AS sum, COUNT(*) as num FROM ratings_haz WHERE ratings_haz.rating_rule_id=2 GROUP BY   ratings_haz.status");
		$this->set("spill" , $spill );		
	}
	
	
	function GeneralInfo(){
		$this->loadModel('Factory');
		
		$res  = $this->Factory->query("SELECT factory.id,factory.factory_name,factory.Zone,ANS.question_id,ANS.text,GROUP_CONCAT(ANS.answer) AS p FROM factories AS factory LEFT JOIN
(SELECT t1.*,t2.answer FROM `factory_ans_tables` AS t1 LEFT JOIN
answers as t2 ON t1.ans_id=t2.id
WHERE t1.`question_id` IN (12,15,16) AND t1.status=0 ORDER BY t1.factory_id , t1.question_id) AS ANS
ON factory.id=ANS.factory_id GROUP BY factory.id,ANS.question_id") ;
		
		$this->set("gen_info" , $res );
		//echo '<pre>';
		//print_r($res);
		//echo '</pre>';
		
	}
	
	function ByZone(){ 
		//print_r($_POST);
		
		$ans_lists = $this->Admin->Query("			
			SELECT company.zone,
			SUM(RESULT.points)/COUNT(DISTINCT RESULT.factory_id) AS rating, RESULT.`status` FROM 
			(
				SELECT t2.* FROM 
				(SELECT factory_id,max(status) as survey_date FROM `ratings` GROUP BY factory_id ) 
				AS t1
				LEFT JOIN `ratings` AS t2
				ON t1.factory_id=t2.factory_id WHERE t1.survey_date=t2.status
			) AS RESULT

			LEFT JOIN factories AS company ON RESULT.factory_id = company.id
			GROUP BY company.zone ORDER BY company.zone DESC
		
		");			
		$this->set('company_ans_list', $ans_lists );
		
		$this->loadModel('Section');
		$this->set('all_sections', $this->Section->Query("SELECT * from sections ORDER BY id ASC") );
		
		if(!empty($_POST['data'])){			
			$all_data = $_POST['data'];			
			$qry_cond = "";
			$i=0;
			foreach($_POST['data'] as $sec_id=>$val){
				if($i==0 ) $qry_cond .=  "WHERE RESULT.section = $sec_id ";
				else $qry_cond .=  " OR RESULT.section = $sec_id ";
				$i++;
			}
			$qry_cond .= "";
			
			//echo $qry_cond;exit;
			
			$ans_lists_by_com_issues = $this->Admin->Query("
			SELECT company.zone,
			SUM(RESULT.points)/COUNT(DISTINCT RESULT.factory_id)*(100/$i/20)  AS rating, RESULT.`status` FROM 
			(
				SELECT t2.* FROM 
				(SELECT factory_id,max(status) as survey_date FROM `ratings` GROUP BY factory_id ) 
				AS t1
				LEFT JOIN `ratings` AS t2
				ON t1.factory_id=t2.factory_id WHERE t1.survey_date=t2.status
			) AS RESULT
			LEFT JOIN factories AS company ON RESULT.factory_id = company.id $qry_cond
			GROUP BY company.zone ORDER BY company.zone DESC			
			"); 
			
			$this->set('company_ans_list_by_com_issues', $ans_lists_by_com_issues );
		}
	}
	
	function SectionOverview(){ //print_r($_POST);
		if( !empty($_POST) )	$this->Session->write('custom_weight_factor', $_POST);
		
		$this->loadModel('WeightFactor');
		$weight_factor = $this->WeightFactor->Find("all");
		$this->set('standard_weight_factor', $weight_factor);
		
		//echo '<pre>';
		//print_r($_POST);
		//echo '</pre>';
		
		
		if(!empty($_POST)){
			$qry1="AND (";
			$qry2="AND (";
			$qry ="WHERE (";
			$op = 0;
			$highest_value = 0;
			for($i=1;$i<=8;$i++){
				$chk = "chk_".$i;
				if(!empty($_POST[$chk]) ){
					if($op == 0){
						$qry.= "t1.section = $i ";
						$qry1.= "t1.section = $i ";
						$qry2.= "t2.section = $i ";
						
						$op++;
					}
					else {
						$qry.= "OR t1.section = $i ";
						$qry1.= "OR t1.section = $i ";
						$qry2.= "OR t2.section = $i ";
					}
					
					$highest_value += 20;
				}
			}
			$qry .=")";
			$qry1 = $qry1.")";
			$qry2 = $qry2.")";
			
			
			//echo $qry1;
			//echo $qry2;
			
			
			$this->loadModel('Factory');
			
			/*$res  = $this->Factory->query("SELECT factories.id,factories.factory_name,factories.Zone,factories.area, RESULT.Baseline,RESULT.Followup FROM factories  LEFT JOIN 
(SELECT t1.factory_id , SUM(t1.points) AS Baseline,t3.followup FROM ratings as t1 
LEFT JOIN (SELECT t2.factory_id , SUM(t2.points) AS followup FROM ratings as t2 WHERE t2.status = 1 $qry2 GROUP BY t2.factory_id) AS t3
ON t1.factory_id=t3.factory_id WHERE t1.status = 0 $qry1  GROUP BY t1.factory_id) AS RESULT
ON factories.id=RESULT.factory_id WHERE factories.status!=0") ;			
			$this->set("section_overview" , $res );*/
			$this->set("highest_value" , $highest_value );
			
			
			
			$newRes=$this->Factory->query("SELECT factories.id,factories.factory_name,factories.Zone,factories.area, RESULT.point,RESULT.status FROM factories LEFT JOIN (
SELECT t1.factory_id , SUM(t1.points) as point,t1.status FROM ratings as t1 $qry GROUP BY  t1.factory_id,t1.status
) AS RESULT ON factories.id=RESULT.factory_id WHERE factories.status!=0 ") ;
			
			foreach($newRes as $val){
				$id=  intval($val['factories']['id']);
				$status =  intval($val['RESULT']['status']);
				$finalSet[$id][$status] = $val;
			}
			$this->set("finalSet" , $finalSet );
			
			/*echo '<pre>';
			print_r($finalSet);
			echo '</pre>';*/
			
		}
		
		
	}
	
	function ByOverviewViewSection(){
		$this->loadModel("Overview");
		//$res = $this->Overview->find("all");
		$res = $this->Overview->find('all', array('conditions' => array('weight_factor' => 1)));
		$this->set('overview', $res );
	}
	
	function ByOverview($id = NULL){
		$this->loadModel("Overview");
		//$res = $this->Overview->find("all");
		
		$query = "weight_factor='1' AND section_no='$id' ";
		
		$res = $this->Overview->find('all', array('conditions' => $query));
		$this->set('overview', $res );
		
		
		
		$min_point="";
		$max_point="";
		
		
		if(!empty($_POST)){
		     $rule_id= $_POST['rule'];
			
			
			 $min_point=$_POST['min_point'][$rule_id];
			 $max_point=$_POST['max_point'][$rule_id];
			
			$sub_query = " AND RESULT.rating_rule_id =  '$rule_id' AND 
			(RESULT.points >= '$min_point' AND RESULT.points <= '$max_point') ";
		}
		else{
			$sub_query="";
		}
		
		
		$this->loadModel('Factory');
		
		$rule_query  = $this->Factory->query("SELECT RESULT.*, factories.factory_name, factories.Zone,factories.area			
			FROM factories LEFT JOIN 			
			(SELECT ratings_haz.*,rating_rules.rule,rating_rules.point FROM ratings_haz LEFT JOIN rating_rules
			 ON ratings_haz.rating_rule_id = rating_rules.id) AS RESULT
   			ON RESULT.factory_id=factories.id WHERE factories.status !=0 $sub_query ORDER BY RESULT.factory_id ") ;
		
		foreach($rule_query as $val){
			$id=  intval($val['RESULT']['factory_id']);
			$status =  intval($val['RESULT']['status']);
			$finalSet[$id][$status] = $val;
		}
		$this->set("finalSet" , $finalSet );
		
		/*echo '<pre>';
		print_r($finalSet);
		echo '</pre>';*/
		
		
		//$this->set("rule_overview" , $rule_query );
		
		
		
		
		
		///to print the rule and hpp start
			
			/*echo '<pre>';
			print_r($rule_query);
			echo '</pre>';exit;*/
			
			foreach($rule_query as $key=>$val)
			{
				$selected_rule = $val['RESULT']['rule'];
				$hpp = $val['RESULT']['point'];
				
				$selected_section = $val['RESULT']['section'];
				
				break;
			}
			
			$this->set("selected_rule" , $selected_rule );
			$this->set("hpp" , $hpp );
			$this->set("selected_section" , $selected_section );
			
			
			
			$this->set("selected_min_point" , $min_point );
			$this->set("selected_max_point" , $max_point );
		///to print the rule and hpp start
		
		
	}
	
	
	
	function SectionQuestion(){
		if( !empty($_POST) )	$this->Session->write('custom_weight_factor', $_POST);
		
		$this->loadModel('WeightFactor');
		//$weight_factor = $this->WeightFactor->Find("all");
		$weight_factor = $this->WeightFactor->find('all', array('conditions' => array('weight_factor' => 1)));
		$this->set('standard_weight_factor', $weight_factor);
		
		echo '<pre>';
		//print_r($_POST);
		echo '</pre>';
		
		
		if(!empty($_POST)){
			$qry1="AND (";
			$qry2="AND (";
			$op = 0;
			$highest_value = 0;
			for($i=1;$i<=8;$i++){
				$chk = "chk_".$i;
				if(!empty($_POST[$chk]) ){
					if($op == 0){
						$qry1.= "t1.section = $i ";
						$qry2.= "t2.section = $i ";
						$op++;
					}
					else {
						$qry1.= "OR t1.section = $i ";
						$qry2.= "OR t2.section = $i ";
					}
					
					//$highest_value += 20;
				}
			}
			$qry1 = $qry1.")";
			$qry2 = $qry2.")";
			
			$this->loadModel('Factory');
			
			
			/*/////two different queries for baseline and followup start
			$baseline  = $this->Factory->query("SELECT factories.id,factories.factory_name,factories.Zone, RESULT.Baseline FROM factories  LEFT JOIN (SELECT t1.factory_id , count(*) AS Baseline FROM factory_ans_tables as t1 
 WHERE t1.type='radio' AND LCASE(SUBSTR( t1.text, 1, 3 ))='yes' AND t1.status = 0 $qry1  GROUP BY t1.factory_id) AS RESULT
ON factories.id=RESULT.factory_id WHERE factories.status!=0") ;			
			$this->set("baseline" , $baseline );			
			
			
			$followup  = $this->Factory->query("SELECT factories.id,factories.factory_name,factories.Zone, RESULT.followup FROM factories  LEFT JOIN (SELECT t1.factory_id , count(*) AS followup FROM factory_ans_tables as t1 
 WHERE t1.type='radio' AND LCASE(SUBSTR( t1.text, 1, 3 ))='yes' AND t1.status = 1 $qry1  GROUP BY t1.factory_id) AS RESULT 
ON factories.id=RESULT.factory_id WHERE factories.status!=0") ;
			$this->set("followup" , $followup );	*/	
			
			
			$res  = $this->Factory->query("SELECT factories.id,factories.factory_name,factories.Zone, RESULT.followup,RESULT.status FROM factories  LEFT JOIN (SELECT t1.factory_id ,t1.status, count(*) AS followup FROM factory_ans_tables as t1 
 WHERE t1.type='radio' AND LCASE(SUBSTR( t1.text, 1, 3 ))='yes'  $qry1  GROUP BY t1.factory_id,t1.status) AS RESULT 
ON factories.id=RESULT.factory_id WHERE factories.status!=0") ;

			foreach($res as $val){
				$id=  intval($val['factories']['id']);
				$status =  intval($val['RESULT']['status']);
				$finalSet[$id][$status] = $val;
			}
			$this->set("finalSet" , $finalSet );
			/*echo "<pre>";
			print_r($finalSet);
			echo "</pre>";*/
			
			
			$highest_value = $this->Factory->query("SELECT COUNT(*) AS HV FROM questions as t1 WHERE (t1.type=1 OR t1.type=2) $qry1 ") ;
			$this->set("highest_value" , $highest_value[0][0]['HV'] );			
		}
	}
	
	function BySingleQuestionViewSection(){
		$this->loadModel("Overview");
		//$res = $this->Overview->find("all");
		$res = $this->Overview->find('all', array('conditions' => array('weight_factor' => 1)));
		$this->set('overview', $res );
	}
	
	//edited by nandinee start 2011-06-15
	
	
	
	
	
	function ByQuestiony($id = NULL)
	{
		/*$this->loadModel("Overview");
		//$res = $this->Overview->find("all");
		$res = $this->Overview->find('all', array('conditions' => array('weight_factor' => 1)));
		
		$this->set('overview', $res );*/
		
		
		$this->loadModel("Overview");
		$query = "weight_factor='1' AND section_no='$id' ";
		
		$res = $this->Overview->find('all', array('conditions' => $query));
		$this->set('overview', $res );
		
		
		
		
		if(!empty($_POST))
		{
		   ////to get the total number of questions start
			$this->loadModel("Question");
			$get_no_of_question  = $this->Question->query("SELECT MAX(id) AS max_ques_id FROM questions ") ;
			
			$no_of_question = $get_no_of_question[0][0]['max_ques_id'];
		   ////to get the total number of questions end
			
			
			
			////edited at 2011-07-03 start (for multiple selection of question)
			$qry1="AND (";
			$qry2="";
			
			$op = 0;
			for($i=1;$i<=$no_of_question;$i++)
			{
				$chk = "chk_".$i;
				if(!empty($_POST[$chk]) )
				{
					if($op == 0)
					{
						$qry1.= "factory_ans_tables.question_id = $i ";
						
						$qry2.= "questions.id = $i ";
						$op++;
					}
					else 
					{
						$qry1.= "OR factory_ans_tables.question_id = $i ";
						
						$qry2.= "OR questions.id = $i ";
					}
					
				}
			}
			 $qry1 = $qry1.")";
			
			
			$this->loadModel('Factory');
			
			
			$res  = $this->Factory->query("SELECT factory_ans_tables.status,
			count(DISTINCT factory_ans_tables.factory_id) as number,
			factory_ans_tables.question_id,factory_ans_tables.section, RESULT.* 			
			FROM factory_ans_tables LEFT JOIN ( SELECT questions.id as ques_id,questions.section,questions.question,sections.id as section_id,sections.name FROM questions LEFT JOIN sections ON questions.section = sections.id WHERE $qry2 ) AS RESULT
			ON (factory_ans_tables.question_id=RESULT.ques_id AND factory_ans_tables.section=RESULT.section_id)
			WHERE factory_ans_tables.type='radio' AND LCASE(SUBSTR( factory_ans_tables.text, 1, 3 )) ='yes' 
			$qry1 GROUP BY factory_ans_tables.question_id,factory_ans_tables.status ") ;
			
			
			
			$this->set("tot_company" , $res );
			
			
			//echo '<pre>';
			//print_r($res);
			//echo '</pre>';
			
		}
		
		
	}
	
	
	function BySingleQuestionReport($question_id=null)
	{//echo $question_id;
	
			$no_in_baseline=0;
			$no_in_followup=0;
	
	
			$this->loadModel('Factory');
			
			$res  = $this->Factory->query("SELECT a.status,a.factory_id,b.factory_name
			
			FROM factory_ans_tables a LEFT JOIN factories b 
			
			ON a.factory_id = b.id  
			
			WHERE a.type='radio' AND LCASE(SUBSTR( a.text, 1, 3 )) ='yes' AND a.question_id=$question_id
			ORDER BY a.factory_id ") ;
			
			
			
			
			
			$this->set("total_company" , $res );
			
		
		
			///to print the question start
			$this->loadModel('Question');
			$ques_res = $this->Factory->query("SELECT id,question FROM questions WHERE id=$question_id");
			
			/*echo '<pre>';
			print_r($ques_res);
			echo '</pre>';exit;*/
			
			foreach($ques_res as $key=>$val)
			{
				$ques_val = $val['questions']['question'];
			}
			
			$this->set("question_val" , $ques_val );
			///to print the question end
			
			
			
			//to print the number of factories in baseline and followup survey start
			$count_factory  = $this->Factory->query("SELECT status,count(DISTINCT factory_id) as number FROM factory_ans_tables WHERE type='radio' AND LCASE(SUBSTR( text, 1, 3 )) ='yes' AND question_id=$question_id GROUP By status") ;
			
			/*echo '<pre>';
			print_r($count_factory);
			echo '</pre>';exit;*/
			
			foreach($count_factory as $key=>$val)
			{
				if( intval($val['factory_ans_tables']['status'])%2 == 0 ) 
						 $no_in_baseline = intval($val['0']['number']);
						
				elseif( intval($val['factory_ans_tables']['status'])%2 == 1 )
						 $no_in_followup = intval($val['0']['number']);
			}
			
			$this->set("no_in_baseline" , $no_in_baseline );
			$this->set("no_in_followup" , $no_in_followup );
			
			//to print the number of factories in baseline and followup survey end
	}
	
	
	//edited by nandinee end 2011-06-15
	
	
	
	
	
	
	
	
	function ChemicalHazmat()
	{
		//echo $_POST['answers'];
		//echo $_POST['range'];
		
		$ans_range = "";
		if(!empty($_POST['answers']) ){
			$ans = $_POST['answers'];			
			$ans_range = " AND t1.ans_id =  '$ans' ";			
		}
		
		$zonecond="";
		if(!empty($_POST['zone']) ){
			$zone = $_POST['zone'];			
			$zonecond = " WHERE  factory.Zone =  '$zone' ";			
		}
		
		
		
		$this->loadModel('Factory');
		$res  = $this->Factory->query("SELECT factory.id,factory.factory_name,factory.Zone, ANS.text, ANS.answer, ANS.ans_id
				FROM factories AS factory INNER JOIN
				
				(SELECT t1.*,t2.answer FROM `factory_ans_tables` AS t1 LEFT JOIN
				answers as t2 ON t1.ans_id=t2.id				
				WHERE t1.`question_id`=17 AND t1.status=0 $ans_range ORDER BY t1.factory_id , t1.question_id) 
				
				AS ANS ON factory.id=ANS.factory_id $zonecond ") ;		
		$this->set("gen_info" , $res );
		
		
		echo
		
		
		/////for the drop down of selecting answers start
		$this->loadModel('Answer');
		$res_ans  = $this->Factory->query("SELECT * FROM answers WHERE `question_id`=17 ") ;
		$this->set("gen_ans" , $res_ans );
		
		$zone_list  = $this->Factory->query("SELECT DISTINCT(Zone) FROM factories") ;
		$this->set("zone_list" , $zone_list );
		
		//print_r($zone_list);
		/////for the drop down of selecting answers end
		
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
			//$condition = array('AdminFactory.status' => 1, 'AdminFactory.city' => $city );
			$condition = array('AdminFactory.city' => $city );
		}
		elseif( empty($_POST['city']) & !empty($_POST['area']) ){
			$area = $_POST['area'];
			//$condition = array('AdminFactory.status' => 1, 'AdminFactory.area' => $area );
			$condition = array( 'AdminFactory.area' => $area );
		}
		elseif( !empty($_POST['city']) & !empty($_POST['area']) ){
			$city = $_POST['city'];
			$area = $_POST['area'];
			//$condition = array('AdminFactory.status' => 1, 'AdminFactory.city' => $city , 'AdminFactory.area' => $area );
			$condition = array('AdminFactory.city' => $city , 'AdminFactory.area' => $area );
		}
		else $condition = "";
		//else  $condition = array('AdminFactory.status' => 1 );
		
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
		
	
	}
	
	function BySection(){
		if( !empty($_POST) )	$this->Session->write('custom_weight_factor', $_POST);
		
		$this->loadModel('WeightFactor');
		$weight_factor = $this->WeightFactor->Find("all");
		$this->set('standard_weight_factor', $weight_factor);
		
		$this->loadModel('Factory');
		$factories = $this->Factory->Find("all", array('conditions'=> array('Factory.status' => 1))  );
	
		$res = 0;
		foreach($factories as $factory){
			if(!empty($factory['Rating']) ){
				$point=0;
				$total_posible_point=0.0;
				$total_factory_point=0.0;
				foreach($factory['Rating'] as $rate_info){
					$chk_name = "chk_".$rate_info['section'];
					$section_wf = !empty($_POST[$chk_name]) ? floatval($_POST[$chk_name]) : 0;
								
					$total_posible_point += ( floatval($section_wf)* 20.0 );
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
	function bysectionsingle(){
		$this->loadModel('Factory');
		if( !empty($_POST['factory']) ){

			$qry="WHERE (";
			
			$op = 0;
			$highest_value = 0;
			for($i=1;$i<=8;$i++){
				$chk = "chk_".$i;
				if(!empty($_POST[$chk]) ){
					if($op == 0){
						$qry.= "t1.section = $i ";
						
						$op++;
					}
					else {
						$qry.= "OR t1.section = $i ";
					}
					
					$highest_value += 20;
				}
			}
			$qry .=")";
			$factory_id = $_POST['factory'];
			
			
			$newRes=$this->Factory->query("SELECT factories.id,factories.factory_name,factories.Zone,factories.area, RESULT.point,RESULT.status FROM factories LEFT JOIN (
SELECT t1.factory_id , SUM(t1.points) as point,t1.status FROM ratings as t1 $qry GROUP BY  t1.factory_id,t1.status
) AS RESULT ON factories.id=RESULT.factory_id WHERE factories.id=$factory_id ") ;
			
		
			
			
			/*echo '<pre>';
			print_r($newRes);
			echo '</pre>';*/
			$this->set("sfactory",$newRes);
			$this->set("highest_value",$highest_value);
		}
		
		$Factories  = $this->Factory->query("SELECT factories.id,factories.factory_name,factories.Zone,factories.area FROM factories WHERE factories.status!=0") ;
		$this->set("Factories",$Factories);
		/*echo '<pre>';
		print_r($Factories);
		echo '</pre>';*/
		
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
			
			/*echo '<pre>';
			print_r($res);
			echo '</pre>';*/
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
	
	}


	

	
	function FacilityReport($factory_id = null) 
	{
		/*
		echo '<pre>';
		print_r($_POST);
		echo '</pre>';
		*/
		if( isset($_POST['facility']) )	$factory_id = $_POST['facility'];
		
		if( !empty($factory_id))
		{
	
			$id = $this->Auth->User('id');
			$this->loadModel('Factory');
			
			$res = $this->Factory->findAllById($factory_id) ;
			$res_id = $res[0]['User']['id'];
			
			$this->set('factory', $res);
			
			$this->loadModel('WeightFactor');
			
			//edited by nandinee 2011-06-26 start
	$weight_factor = $this->WeightFactor->find('all', array('conditions' => array('WeightFactor.weight_factor' => 1)));
			//$this->set('weight_factor', $this->WeightFactor->Find("all") );
			$this->set('weight_factor', $weight_factor );
			//edited by nandinee 2011-06-26 end
			
		}
		else $this->redirect(array('controller' => 'admins', 'action' => 'index'));			
	}
	
	
	
	
	function FacilityCustomReport($factory_id = null)
	{
		////////NEED TO MODIFY LATER FOR SELECTED SECTIONS///////////////
		if( isset($_POST['facility']) )	$factory_id = $_POST['facility'];
		
		if( !empty($factory_id)){
	
			$id = $this->Auth->User('id');
			$this->loadModel('Factory');
			
			$res = $this->Factory->findAllById($factory_id) ;
			$res_id = $res[0]['User']['id'];
			
			$this->set('factory', $res);
			
			
			$this->loadModel('WeightFactor');
			
			//edited by nandinee 2011-06-26 start
	$weight_factor = $this->WeightFactor->find('all', array('conditions' => array('WeightFactor.weight_factor' => 1)));
			//$this->set('weight_factor', $this->WeightFactor->Find("all") );
			$this->set('weight_factor', $weight_factor );
			//edited by nandinee 2011-06-26 end
			
		}
		else $this->redirect(array('controller' => 'admins', 'action' => 'index'));	
		
		
				
	}
	
	
	
	
	function SectionReport( $section = null , $factory_id = null )
	{
		
		$id = $this->Auth->User('id');
				
		//Start checking the factory assigned to this user or not
		if( empty($factory_id) || empty($section) )
			$this->redirect(array('controller' => 'admins', 'action' => 'index'));
		//End checking the factory assigned to this user or not
		
		
		//$question = $this->Survey->findAllBySection(1);
		//$this->set('questions', $question );
		
		$this->set('factory_id', $factory_id );
		$this->set('section', $section);
		
		$this->loadModel("RatingRule");
		$this->set('rating_rules', $this->RatingRule->findAllBySection($section) );
		
		
		
		
		
		
		$this->loadModel('Survey');
		/*if($section==1)
		{
			$query = "survey.section='$section' AND survey.id > 3 ";
			$this->set('questions', $this->Survey->find('all', array('conditions' => $query)) );
		}//edited to skip 3 ques
		else*/
		
			$this->set('questions', $this->Survey->findAllBySection($section) ); 
		
		
		
		
		$this->loadModel("FactoryAnsTable");
		$ans =  $this->FactoryAnsTable->Query("SELECT * FROM factory_ans_tables AS FactoryAnsTable WHERE factory_id='$factory_id' ORDER BY question_id ASC");
		
		$this->set('factory_answers', $ans );
		
		
		
		////???? getting 3 questions starts
			$dates =  $this->FactoryAnsTable->Query("SELECT question_id,ans_id,text,status
			FROM factory_ans_tables WHERE 
			factory_id='$factory_id' AND section='$section' AND question_id < 4 ");
			
			foreach($dates as $key=>$val)
			{
				if($val['factory_ans_tables']['question_id']==1 && $val['factory_ans_tables']['status']==0)
					 $baseline_date = $val['factory_ans_tables']['text'];
				else if($val['factory_ans_tables']['question_id']==2 && $val['factory_ans_tables']['status']==1)
					 $followup_date = $val['factory_ans_tables']['text'];
			}
			
			$this->set('baseline_date', $baseline_date );
			$this->set('followup_date', $followup_date );
			
			/*echo "<pre>";
			print_r($dates);
			echo "</pre>";*/
		////????? getting 3 questions end
		
		
		
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
	
	
	
	
	
	
	function CompleteView( $factory_id = null )
	{
		
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
	
	
	
	
	
	//////////complete view for selected sections starts
	function CustomCompleteView( $factory_id = null, $selected_section=null)
	{
		
		$sections = explode(",",$selected_section);
			//print_r($sections);
		$this->set('selected_sections', $sections );
		
		
		$query="";
		$query_ques="";
		
		
		$op=0;
		foreach($sections as $key=>$val)
		{
			if($op == 0)
			{
				$query.= "section = $val ";
				//$query_ques.= "questions.section = $val ";
				$op++;
			}
			else 
			{
				$query.= "OR section = $val ";
				//$query_ques.= "OR questions.section = $val ";
			}
			
		}
		
		
		
		$id = $this->Auth->User('id');
				
		//Start checking the factory assigned to this user or not
		if( empty($factory_id) )
			$this->redirect(array('controller' => 'admins', 'action' => 'index'));
		//End checking the factory assigned to this user or not
		
		
		//$question = $this->Survey->findAllBySection(1);
		//$this->set('questions', $question );
		
		$this->set('factory_id', $factory_id );
		//$this->set('section', $section);
		
		
		
		
		//edited by nandinee for complete view of selected section start
		
		$this->loadModel('Survey');
		//$this->set('questions', $this->Survey->find("all") );
		//$questions = $this->Survey->find('all', array('conditions' => array('weight_factor' => 1)));
		
		$questions = $this->Survey->find('all', array('conditions' => $query));
		
		$this->set('questions', $questions);
			
			/*echo "<pre>";
			print_r($questions);
			echo "</pre>";*/
			
			
		//edited by nandinee for complete view of selected section end
		
		
		
		
		$this->loadModel("FactoryAnsTable");
		
		//edited by nandinee for complete view of selected section start
		$ans =  $this->FactoryAnsTable->Query("SELECT * FROM factory_ans_tables AS FactoryAnsTable WHERE 
							factory_id='$factory_id' AND ($query) ORDER BY question_id ASC");
		//edited by nandinee for complete view of selected section end
		
		$this->set('factory_answers', $ans );
	}
	
	//////////complete view for selected sections end
	
	
	////TRY START
	/*function CustomCompleteView( $factory_id = null, $selected_section=null)
	{
		
			//echo $selected_section;
		$sections = explode(",",$selected_section);
			//print_r($sections);
		
		$query="";
		$query_ques="";
		
		$op=0;
		foreach($sections as $key=>$val)
		{
			if($op == 0)
			{
				$query.= "FactoryAnsTable.section = $val ";
				$query_ques.= "questions.section = $val ";
				$op++;
			}
			else 
			{
				$query.= "OR FactoryAnsTable.section = $val ";
				$query_ques.= "OR questions.section = $val ";
			}
			
		}
		
		//echo $query;
		
		$id = $this->Auth->User('id');
				
		//Start checking the factory assigned to this user or not
		if( empty($factory_id) )
			$this->redirect(array('controller' => 'admins', 'action' => 'index'));
		//End checking the factory assigned to this user or not
		
	
		$this->set('factory_id', $factory_id );
		
		
		
		$this->loadModel("FactoryAnsTable");
		
		/*$ans =  $this->FactoryAnsTable->Query("SELECT * FROM factory_ans_tables AS FactoryAnsTable WHERE 
							factory_id='$factory_id' AND ($query) ORDER BY question_id ASC");*/
		
		
		/*echo "SELECT * FROM factory_ans_tables AS FactoryAnsTable WHERE 
							factory_id='$factory_id' AND ($query) ORDER BY question_id ASC";/////
		
		echo "SELECT * FROM factory_ans_tables AS FactoryAnsTable INNER JOIN
					
					(SELECT questions.id AS ques_id,questions.question,questions.order,questions.type AS question_type,
					answers.id AS a_ans_id,answers.answer,answers.type AS answer_type
					
					FROM questions,answers WHERE ($query_ques) AND 
					questions.id = answers.question_id) AS RESULT
					
					WHERE FactoryAnsTable.question_id = RESULT.ques_id 
					
					AND FactoryAnsTable.factory_id='$factory_id' AND ($query)
					ORDER BY FactoryAnsTable.question_id ASC";
		
		
		
		
		$ans =  $this->FactoryAnsTable->Query("SELECT * FROM factory_ans_tables AS FactoryAnsTable INNER JOIN
					
					(SELECT questions.id AS ques_id,questions.question,questions.order,questions.type AS question_type,
					answers.id AS a_ans_id,answers.answer,answers.type AS answer_type
					
					FROM questions,answers WHERE ($query_ques) AND 
					questions.id = answers.question_id) AS RESULT
					
					WHERE FactoryAnsTable.question_id = RESULT.ques_id 
					
					AND FactoryAnsTable.factory_id='$factory_id' AND ($query)
					ORDER BY FactoryAnsTable.question_id ASC");
		
	
		
		$this->set('factory_answers', $ans );
	}*/
	////TRY END
	
	//////////complete view for selected sections end
	
	
	
	
	function ComparisonAnalysis(){
		$this->loadModel('WeightFactor');
		$weight_factor = $this->WeightFactor->Find("all");
		$this->set('weight_factor', $weight_factor);
		
		$this->loadModel('AdminFactory');
		$condition = array('AdminFactory.status' => 1 );
		$AdminFactory_res =  $this->AdminFactory->find("all", array('conditions' => $condition));
		$this->set("factories" , $AdminFactory_res );
		
		
		$i=0;
		foreach($AdminFactory_res as $factory){
				
			if( empty($factory['FactoryAnsTable']) & !empty($_POST['reg'])) continue;	// if rating is not exist ignor the facility
				
			if(!empty($factory['Rating']) ){
				
				// Start rating in percentage genration
					$total_posible_point=0;
					$total_factory_point=0;
					$j=1;
					foreach($weight_factor  as $id=>$wf){
						$section_wf = $wf['WeightFactor']['weight_factor'];
						
						$point=0;
						foreach($factory['Rating'] as $rate_info){
							if($rate_info['section'] == $j & $rate_info['status'] == 1){
								if( !empty($rate_info['points']) ) $point= $rate_info['points'];
								else $point=0;
								break;
							}							
						}
						$total_posible_point += ( floatval($section_wf)* 20.0 );
						$total_factory_point += ( floatval($section_wf)* floatval($point) );
						$j++;
					}
					$res = ($total_factory_point/$total_posible_point)*100 ;
					$res = number_format($res, 2, '.', '');
				// End rating in percentage genration
					
				if( $res<=50) $img='highrisk.png';
				elseif($res>80) $img='lowrisk.png';
				else $img='medrisk.png';
			}
			// if rating is dose not satisfy the criteria ignor the facility
			if(!empty($_POST['High']) || !empty($_POST['Medium']) || !empty($_POST['Low']) ){
				if( empty($_POST['High']) & $res<=50 ) continue; 
				if( empty($_POST['Low']) & $res>80) continue; 
				if( empty($_POST['Medium']) & $res>50 & $res<=80 ) continue; 				
			}
			
			
			// this is the filtered factory/facility .. we here start the question comparison analysis 
			if( !empty($factory['FactoryAnsTable']) ){
				foreach($factory['FactoryAnsTable'] as $key1=>$ans_id1 ){
					if( !empty($ans_id1['ans_id']) )	$set[$i][] = $ans_id1['ans_id'];
				}
				$i++;
			}	
		}
					
		
		
		if(!empty($set) ){
			$start_res = $set[0];
			for($j=1 ; $j<$i ; $j++ ){
				$tmp = $set[$j];
				$start_res = array_intersect($start_res,$tmp);
			}
			
			//echo '<pre>';
			//print_r($start_res);
			//echo '</pre>';
			
			
			foreach($start_res as $key => $val){
				//echo $val." ";
				$cond[]['Answer.id'] = $val;
			}
				
			$this->loadModel('Answer');
			$condition= array( 'OR' => $cond);
			$Answer_res =  $this->Answer->find("all", array('conditions' => $condition));
			$this->set("ans" , $Answer_res );
		
		}
		
		//============== End this part is for comparisos analysis ====================
		
		
		
		
		
		$this->loadModel("RatingRule");
		$res =  $this->RatingRule->find("all");
		$this->set("rating_rules" , $res ); 
		
		
		
	 }
}
?>
