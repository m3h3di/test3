<?php
class WeightFactor extends AppModel {
	var $name = 'WeightFactor';
	
	var $hasMany = array(
		'RatingRules' => array(
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
		)
	);
}
?>