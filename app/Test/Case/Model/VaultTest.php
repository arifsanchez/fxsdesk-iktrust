<?php
App::uses('Vault', 'Model');

/**
 * Vault Test Case
 *
 */
class VaultTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.vault',
		'app.user',
		'app.vault_transaction'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Vault = ClassRegistry::init('Vault');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Vault);

		parent::tearDown();
	}

}
