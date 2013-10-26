<?php
/* Grievance Fixture generated on: 2011-03-09 08:03:53 : 1299660713 */
class GrievanceFixture extends CakeTestFixture {
	var $name = 'Grievance';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'grievance' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 200, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'section' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 3),
		'status' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 3),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => 1,
			'grievance' => 'Lorem ipsum dolor sit amet',
			'section' => 1,
			'status' => 1
		),
	);
}
?>