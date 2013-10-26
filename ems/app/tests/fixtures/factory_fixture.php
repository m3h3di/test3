<?php
/* Factory Fixture generated on: 2010-07-27 09:07:16 : 1280221456 */
class FactoryFixture extends CakeTestFixture {
	var $name = 'Factory';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'factory_name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 100),
		'address' => array('type' => 'text', 'null' => false, 'default' => NULL),
		'contact_person' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 100),
		'area' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 30),
		'city' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 30),
		'telephone' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 100),
		'fax' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 50),
		'email' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 50),
		'staus' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 4),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => 1,
			'user_id' => 1,
			'factory_name' => 'Lorem ipsum dolor sit amet',
			'address' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'contact_person' => 'Lorem ipsum dolor sit amet',
			'area' => 'Lorem ipsum dolor sit amet',
			'city' => 'Lorem ipsum dolor sit amet',
			'telephone' => 'Lorem ipsum dolor sit amet',
			'fax' => 'Lorem ipsum dolor sit amet',
			'email' => 'Lorem ipsum dolor sit amet',
			'staus' => 1
		),
	);
}
?>