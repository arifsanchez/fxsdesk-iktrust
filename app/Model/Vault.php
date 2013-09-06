<?php
App::uses('AppModel', 'Model');
/**
 * Vault Model
 *
 * @property User $User
 * @property VaultTransaction $VaultTransaction
 */
class Vault extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'id';

/**
	 * Use component object
	 *
	 * @var object
	 */
	var $userAuth;
	//The Associations below have been created with all possible keys, those that are not needed can be removed

/** Validate user_id **/
public $validate = array(
    'user_id' => array(
        'rule'    => 'isUnique',
        'message' => 'This user wallet has already created.'
    )
);

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'Usermgmt.User',
			'foreignKey' => 'user_id',
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
		'VaultTransaction' => array(
			'className' => 'VaultTransaction',
			'foreignKey' => 'vault_id',
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
	 * Get Trader Wallet Account Balance
	 *
	 * @access public
	 * @param array $userIds user ids
	 * @return boolean
	*/
	function getAccBalance($userId=null) {
		$balance = 0;
		if($userId) {
			$balance = $this->find('first', array(
				'conditions' =>array(
					'user_id' => $userId,
				),
				'recursive' => -1
			));
		return $balance;
		}
	}

	/**
	 * Initial Check If Vault Account Exist
	 *
	 * @access public
	 * @param array $userIds user ids
	 * @return boolean
	*/
	function checkVaultAccount($userId=null) {
		$checkid = $this->find('first', array(
			'conditions' =>array(
				'user_id' => $userId,
			)
		));
		if(empty($checkid)){
			$this->create();
			$new['user_id'] = $userId;
			$this->save($new);

			return true;
		}

		return true;
	}

	/**
	 * STAFF :: Kira Total Wallet
	 *
	 * @access public
	*/
	function kiraTotalWallet() {
		$total = 0;
		$total = $this->find('all', array(
			'conditions' => array('Vault.partner' => 0),
			'fields' => array('sum(Vault.acc_1) AS total')
		));
		return $total;
	}

	/**
	 * STAFF :: Kira Total Wallet Partner
	 *
	 * @access public
	*/
	function kiraTotalWalletPartner() {
		$total = 0;
		$total = $this->find('all', array(
			'conditions' => array('Vault.partner' => 1),
			'fields' => array('sum(Vault.acc_1) AS total')
		));
		return $total;
	}

}
