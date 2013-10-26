<?php
class Survey extends AppModel {

	var $name = 'Servey';
	var $useTable = 'questions'; 
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	
	
	var $belongsTo = array(
		'WeightFactor' => array(
			'className' => 'WeightFactor',
			'foreignKey' => 'section',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	var $hasMany = array(
		'Answer' => array(
			'className' => 'Answer',
			'foreignKey' => 'question_id',
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