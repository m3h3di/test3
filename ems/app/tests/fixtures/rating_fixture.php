<?php
/* Rating Fixture generated on: 2010-07-27 10:07:00 : 1280225640 */
class RatingFixture extends CakeTestFixture {
	var $name = 'Rating';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'factory_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'section' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 2),
		'points' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 1),
		'status' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 4),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => 1,
			'factory_id' => 1,
			'section' => 1,
			'points' => 1,
			'status' => 1
		),
	);
}
?>