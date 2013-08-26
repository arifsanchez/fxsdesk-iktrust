<?php
/**
 * VaultTransactionCommentFixture
 *
 */
class VaultTransactionCommentFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 12, 'key' => 'primary'),
		'vault_transaction_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 12),
		'comment' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 12),
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
			'vault_transaction_id' => 1,
			'comment' => 'Lorem ipsum dolor sit amet',
			'user_id' => 1,
			'created' => '2013-08-26 11:14:16',
			'modified' => '2013-08-26 11:14:16'
		),
	);

}
