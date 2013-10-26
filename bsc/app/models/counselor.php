<?php
class Counselor extends AppModel {
	var $name = 'Counselor';
	var $useTable = 'users';
	
	var $belongsTo = array(
		'Group' => array(
			'className' => 'Company',
			'foreignKey' => 'group_id',
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