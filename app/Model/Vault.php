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
	 * Get Account 1 Balance
	 *
	 * @access public
	 * @param array $userIds user ids
	 * @return boolean
	*/
	function getAcc1Balance($userId=null) {
		if($userId) {
		$result = $this->find('first', array(
			'conditions' =>array(
				'user_id' => $userId,
			)
		));
		$balance = $result['Vault']['acc_1'];
		}
		return $balance;
	}

}
