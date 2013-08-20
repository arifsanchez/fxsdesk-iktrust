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
				'type' => 1,
				'status' => 1
			),
		));
		return $result;
	}
}
