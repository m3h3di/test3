<?php
/* WeightFactor Fixture generated on: 2010-11-10 07:11:14 : 1289374274 */
class WeightFactorFixture extends CakeTestFixture {
	var $name = 'WeightFactor';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'section_no' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 2),
		'section_name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 300),
		'weight_factor' => array('type' => 'float', 'null' => false, 'default' => NULL),
		'indexes' => array(),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => 1,
			'section_no' => 1,
			'section_name' => 'Lorem ipsum dolor sit amet',
			'weight_factor' => 1
		),
	);
}
?>