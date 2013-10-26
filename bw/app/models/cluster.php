<?php
class Cluster extends AppModel {
	var $name = 'Cluster';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasMany = array(
		'Question' => array(
			'className' => 'Question',
			'foreignKey' => 'cluster_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => array('Question.question_type DESC','Question.order'),
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
?>
