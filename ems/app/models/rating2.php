<?php
class Rating2 extends AppModel {
	var $name = 'Rating2';
	var $useTable='ratings_haz';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Factory' => array(
			'className' => 'Factory',
			'foreignKey' => 'factory_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
}
?>