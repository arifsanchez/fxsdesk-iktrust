<?php
/**
 * VaultTransactionFixture
 *
 */
class VaultTransactionFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 15, 'key' => 'primary'),
		'vault_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 15),
		'jumlah' => array('type' => 'float', 'null' => false, 'default' => null, 'length' => '15,2'),
		'type' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 1),
		'status' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 1),
		'description' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 200, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
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
			'vault_id' => 1,
			'jumlah' => 1,
			'type' => 1,
			'status' => 1,
			'description' => 'Lorem ipsum dolor sit amet',
			'created' => '2013-08-26 11:13:18',
			'modified' => '2013-08-26 11:13:18'
		),
	);

}
