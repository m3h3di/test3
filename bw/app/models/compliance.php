<?php
class Compliance extends AppModel {
	var $name = 'Compliance';
	var $order = "Compliance.id ASC";
	var $belongsTo = array(
		'Cluster' => array(
			'className' => 'Cluster',
			'foreignKey' => 'section',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	/*
	var $displayField = 'section';
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
	*/
}
?>