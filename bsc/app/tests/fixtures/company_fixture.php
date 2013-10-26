<?php
/* Company Fixture generated on: 2011-01-25 11:01:36 : 1295954916 */
class CompanyFixture extends CakeTestFixture {
	var $name = 'Company';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'user2_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 100, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'plot_no' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 50, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'zone' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 50, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'country' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 30, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'product' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 50, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'group_no' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 20, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'type_of_investment' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 20, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'actual_investment' => array('type' => 'float', 'null' => false, 'default' => NULL),
		'proposed_investment' => array('type' => 'float', 'null' => false, 'default' => NULL),
		'actual_employee' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10),
		'proposed_employee' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10),
		'male' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10),
		'female' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10),
		'actual_expatriate' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10),
		'proposed_expatriate' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10),
		'commercial_operation' => array('type' => 'date', 'null' => false, 'default' => NULL),
		'status' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => 1,
			'user_id' => 1,
			'user2_id' => 1,
			'name' => 'Lorem ipsum dolor sit amet',
			'plot_no' => 'Lorem ipsum dolor sit amet',
			'zone' => 'Lorem ipsum dolor sit amet',
			'country' => 'Lorem ipsum dolor sit amet',
			'product' => 'Lorem ipsum dolor sit amet',
			'group_no' => 'Lorem ipsum dolor ',
			'type_of_investment' => 'Lorem ipsum dolor ',
			'actual_investment' => 1,
			'proposed_investment' => 1,
			'actual_employee' => 1,
			'proposed_employee' => 1,
			'male' => 1,
			'female' => 1,
			'actual_expatriate' => 1,
			'proposed_expatriate' => 1,
			'commercial_operation' => '2011-01-25',
			'status' => 1
		),
	);
}
?>