<?php
/* RatingRule Fixture generated on: 2010-07-29 07:07:18 : 1280389878 */
class RatingRuleFixture extends CakeTestFixture {
	var $name = 'RatingRule';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 4, 'key' => 'primary'),
		'rule' => array('type' => 'text', 'null' => false, 'default' => NULL),
		'section_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 2),
		'point' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 1),
		'status' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 4),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => 1,
			'rule' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'section_id' => 1,
			'point' => 1,
			'status' => 1
		),
	);
}
?>