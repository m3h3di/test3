<?php
class Company extends AppModel {
	var $name = 'Company';
	var $displayField = 'name';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Group' => array(
			'className' => 'Group',
			'foreignKey' => 'group_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'ProductCategory' => array(
			'className' => 'ProductCategory',
			'foreignKey' => 'product_category',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
?>