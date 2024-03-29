<?php
/**
 * VaultFixture
 *
 */
class VaultFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 15, 'key' => 'primary'),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 15),
		'acc_1' => array('type' => 'float', 'null' => false, 'default' => '0.00', 'length' => '15,2'),
		'acc_2' => array('type' => 'float', 'null' => false, 'default' => '0.00', 'length' => '15,2'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'user_id' => 1,
			'acc_1' => 1,
			'acc_2' => 1,
			'created' => '2013-07-29 19:39:44',
			'modified' => '2013-07-29 19:39:44'
		),
	);

}
