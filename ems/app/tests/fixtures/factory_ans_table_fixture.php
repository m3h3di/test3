<?php
/* FactoryAnsTable Fixture generated on: 2010-07-29 10:07:03 : 1280398623 */
class FactoryAnsTableFixture extends CakeTestFixture {
	var $name = 'FactoryAnsTable';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'factory_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'question_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'ans_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'type' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 1),
		'text' => array('type' => 'text', 'null' => false, 'default' => NULL),
		'section' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 2),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => 1,
			'factory_id' => 1,
			'question_id' => 1,
			'ans_id' => 1,
			'type' => 1,
			'text' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'section' => 1
		),
	);
}
?>