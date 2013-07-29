<?php
App::uses('VaultTransaction', 'Model');

/**
 * VaultTransaction Test Case
 *
 */
class VaultTransactionTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.vault_transaction',
		'app.vault',
		'app.user'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->VaultTransaction = ClassRegistry::init('VaultTransaction');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->VaultTransaction);

		parent::tearDown();
	}

}
