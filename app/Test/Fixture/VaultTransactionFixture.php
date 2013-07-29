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
			'created' => '2013-07-29 19:40:20',
			'modified' => '2013-07-29 19:40:20'
		),
	);

}
