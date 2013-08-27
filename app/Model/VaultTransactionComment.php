<?php
App::uses('AppModel', 'Model');
/**
 * VaultTransactionComment Model
 *
 * @property VaultTransaction $VaultTransaction
 */
class VaultTransactionComment extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'id';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'VaultTransaction' => array(
			'className' => 'VaultTransaction',
			'foreignKey' => 'vault_transaction_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
