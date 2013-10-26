<?php
class Question extends AppModel {
	var $name = 'Question';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

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
	
	var $belongsTo = array(
		'Cluster' => array(
			'className' => 'Cluster',
			'foreignKey' => 'cluster_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

}
?>