<?php
/* Comment Fixture generated on: 2011-02-03 00:02:00 : 1296692160 */
class CommentFixture extends CakeTestFixture {
	var $name = 'Comment';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'Title' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 200, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'Comment' => array('type' => 'text', 'null' => false, 'default' => NULL, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'created' => array('type' => 'date', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => 1,
			'Title' => 'Lorem ipsum dolor sit amet',
			'Comment' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'user_id' => 1,
			'created' => '2011-02-03'
		),
	);
}
?>