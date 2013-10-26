<?php
class SurveyData extends AppModel {
	var $name = 'SurveyData';
	var $order = "SurveyData.question_id ASC";
	var $belongsTo = array(
		'Question' => array(
			'className' => 'Question',
			'foreignKey' => 'question_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Cluster' => array(
			'className' => 'Cluster',
			'foreignKey' => 'cluster_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	/*
	var $belongsTo = array(
		'Factory' => array(
			'className' => 'Factory',
			'foreignKey' => 'factory_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	var $hasAndBelongsToMany = array(
        'Rating' =>
            array(
                'className'              => 'Rating',
                'joinTable'              => 'recipes_tags',
                'foreignKey'             => 'recipe_id',
                'associationForeignKey'  => 'tag_id',
                'unique'                 => true,
                'conditions'             => '',
                'fields'                 => '',
                'order'                  => '',
                'limit'                  => '',
                'offset'                 => '',
                'finderQuery'            => '',
                'deleteQuery'            => '',
                'insertQuery'            => ''
            )
    );
	*/
}
?>