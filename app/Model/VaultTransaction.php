<?php
App::uses('AppModel', 'Model');
/**
 * VaultTransaction Model
 *
 * @property Vault $Vault
 */
class VaultTransaction extends AppModel {

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
		'Vault' => array(
			'className' => 'Vault',
			'foreignKey' => 'vault_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'VaultTransactionComment' => array(
			'className' => 'VaultTransactionComment',
			'foreignKey' => 'vault_transaction_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

	/**
	 * Kira Total Approved Transaction
	 *
	*/
	function kiraTotalApproveTransaction($userId=null) {

	}

	/**
	 * Kira Total Transfer to TradAcc Transaction
	 *
	*/
	function kiraTotalNewTRW_TRACC() {
		$result ='';
		$result = $this->find('count', array(
			'conditions' =>array(
				'status' => 1
			),
		));
		return $result;
	}

	/**
	 * Kira Total Transfer to TradAcc Transaction
	 *
	*/
	function kiraTotalNewTRW_TRACC_code2() {
		$result ='';
		$result = $this->find('count', array(
			'conditions' =>array(
				'status' => 2
			),
		));
		return $result;
	}

	/**
	 * Kira Total Transfer to TradAcc Transaction
	 *
	*/
	function kiraTotalNewTRW_TRACC_code3() {
		$result ='';
		$result = $this->find('count', array(
			'conditions' =>array(
				'status' => 3
			),
		));
		return $result;
	}

	/**
	 * TRADER :: List down latest transactions for $user_id
	 *
	*/
	function listAllLatest($vaultId=null){
		$result ='';
		$result = $this->find('all', array(
			'conditions' =>array(
				'vault_id' => $vaultId,
			),
			'order' => 'VaultTransaction.created DESC',
			'recursive' => -1,
			'limit' => 10
		));
		return $result;
	}

	/**
	 * TRADER :: List down new transactions for $user_id
	 *
	*/
	function listAllNew($vaultId=null){
		$result ='';
		$result = $this->find('all', array(
			'conditions' =>array(
				'vault_id' => $vaultId,
				'status' => 1
			),
			'order' => 'VaultTransaction.created DESC',
			'recursive' => -1,
			'limit' => 5
		));
		return $result;
	}

	/**
	 * TRADER :: List down pending transactions for $user_id
	 *
	*/
	function listAllPending($vaultId=null){
		$result ='';
		$result = $this->find('all', array(
			'conditions' =>array(
				'vault_id' => $vaultId,
				'status' => 2
			),
			'order' => 'VaultTransaction.created DESC',
			'recursive' => -1,
			'limit' => 5
		));
		return $result;
	}

	/**
	 * TRADER :: List down approve transactions for $user_id
	 *
	*/
	function listAllApprove($vaultId=null){
		$result ='';
		$result = $this->find('all', array(
			'conditions' =>array(
				'vault_id' => $vaultId,
				'status' => 3
			),
			'order' => 'VaultTransaction.created DESC',
			'recursive' => -1,
			'limit' => 5
		));
		return $result;
	}

	/**
	 * TRADER :: List down approve transactions for $user_id
	 *
	*/
	function listAllDecline($vaultId=null){
		$result ='';
		$result = $this->find('all', array(
			'conditions' =>array(
				'vault_id' => $vaultId,
				'status' => 4
			),
			'order' => 'VaultTransaction.created DESC',
			'recursive' => -1,
			'limit' => 5
		));
		return $result;
	}

}
