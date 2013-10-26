<?php
class CompanychkComponent extends Object {
	function ComCheck($group_id,$company_id) {
		
		$this->loadModel('Company');
		$res = $this->Company->findById($company_id) ;
		//print_r($res);
		$res_id = $res['Group']['id'];
		$res_name = $res['Company']['name'];
		
		if($group_id == $res_id){
			return true;
		}
		else return false;
	}
}
?>
