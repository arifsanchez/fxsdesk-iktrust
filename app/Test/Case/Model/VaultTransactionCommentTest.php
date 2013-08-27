<?php
App::uses('VaultTransactionComment', 'Model');

/**
 * VaultTransactionComment Test Case
 *
 */
class VaultTransactionCommentTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.vault_transaction_comment',
		'app.vault_transaction',
		'app.vault',
		'app.user',
		'app.user_detail'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->VaultTransactionComment = ClassRegistry::init('VaultTransactionComment');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->VaultTransactionComment);

		parent::tearDown();
	}

}
