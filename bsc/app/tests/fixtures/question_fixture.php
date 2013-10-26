<?php
/* Question Fixture generated on: 2010-12-02 08:12:53 : 1291278533 */
class QuestionFixture extends CakeTestFixture {
	var $name = 'Question';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'section_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'question' => array('type' => 'text', 'null' => false, 'default' => NULL),
		'order' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'status' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 2),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => 1,
			'section_id' => 1,
			'question' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'order' => 1,
			'status' => 1
		),
	);
}
?>