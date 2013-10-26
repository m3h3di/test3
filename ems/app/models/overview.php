<?php
class Overview extends AppModel {
	var $name = 'Overview';
	var $useTable='weight_factors';
	
	
	var $hasMany = array(
		'RatingRule' => array(
			'className' => 'RatingRule',
			'foreignKey' => 'section',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Question' => array(
			'className' => 'Question',
			'foreignKey' => 'section',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
	
	
}
?>