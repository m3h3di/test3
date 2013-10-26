<?php
/* Section Fixture generated on: 2010-12-02 08:12:34 : 1291278454 */
class SectionFixture extends CakeTestFixture {
	var $name = 'Section';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 300),
		'order' => array('type' => 'float', 'null' => false, 'default' => NULL),
		'type' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 2),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => 1,
			'name' => 'Lorem ipsum dolor sit amet',
			'order' => 1,
			'type' => 1
		),
	);
}
?>