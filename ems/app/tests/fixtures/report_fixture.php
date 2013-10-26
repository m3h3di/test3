<?php
/* Report Fixture generated on: 2010-08-10 09:08:16 : 1281431596 */
class ReportFixture extends CakeTestFixture {
	var $name = 'Report';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'section' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 2),
		'criteria' => array('type' => 'text', 'null' => false, 'default' => NULL),
		'answer_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'status' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 4),
		'order' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => 1,
			'section' => 1,
			'criteria' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'answer_id' => 1,
			'status' => 1,
			'order' => 1
		),
	);
}
?>