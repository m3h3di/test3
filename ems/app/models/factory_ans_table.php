<?php
class FactoryAnsTable extends AppModel {
	var $name = 'FactoryAnsTable';
	
	var $belongsTo = array(
		'Factory' => array(
			'className' => 'Factory',
			'foreignKey' => 'factory_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	/*
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