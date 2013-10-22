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
	public $primaryKey = 'id';
	public $displayField = 'user_id';
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
        'message' => 'This Wallet Account has already been created.'
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
	 * Get Trader Wallet Account ID
	 *
	 * @access public
	 * @param array $userIds user ids
	 * @return boolean
	*/
	function getID($userId=null) {
		if($userId) {
			$result = $this->find('first', array(
				'conditions' =>array(
					'user_id' => $userId,
				),
				'fields' => array('id'),
				'recursive' => -1
			));
		return $result;
		}
	}

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

	/**
	 * SYSTEM : send email notification to HQ
	 *
	 * @access public
	 * @param array $data email input details
	 * @return void
	 */
	public function notifyHQtransferRequest($data) {
		
		#data array
		$senderName = $data['name'];
		$senderEmail = $data['emailNtfy'];
		$senderUsername = $data['usern4me'];
		$transactid = $data['transactid'];
		$jumlah = $data['jumlah'];
		$jenis = $data['jenis'];
		#sending email
		App::uses('CakeEmail', 'Network/Email');
		$email = new CakeEmail();
		$email->config('default');
		$email->template('default', 'default');
		$email->emailFormat('both');
		$email->viewVars(array('name' => $senderName));
		$email->from(array('fxsdesk@iktrust.com' => 'FXSdesk IK Trust'));
		$email->replyTo(array($senderEmail => $senderName));
		$email->sender(array($senderEmail => $senderName));
		$email->to(array('finance@iktrust.my' => 'IK Trust Finance'));
		$email->bcc(array('ttarmizi@gmail.com' => 'Mr. Tarmizi', 'anuarinvestor@gmail.com' => 'Mr. Anuar', 'salleh.iktrust@gmail.com' => 'Mr. Salleh', 'arifsanchez@gmail.com' => 'Mr. Arif'));
		$email->subject('[NEW] '.$jenis.' Transfer Request #'.$transactid);
		$email->addHeaders(array('Tag' => 'Transfer'));

		$body=__('NEW TRANSFER NOTICE: <br/><br/>Request From: %s<br/>Amount: IK$ %s<br/><br/>Please check and process @ IK Trust FXSdesk,<br/>%s', SITE_URL.''.$senderUsername, $jumlah, SITE_URL."/Staffs/transfer_detail/process:".$transactid."?from:email<br/><br/>Reminder From,<br/>IK Trust FXSdesk");
		try{
			$result = $email->send($body);
			$this->log($result, 'debug');
			$this->log(''.$jenis.' Request by '.$senderEmail.', TransID #'.$transactid, 'notify_email');
		} catch (Exception $ex){
			// we could not send the email, ignore it
			$result="Could not send email , request by ".$senderEmail.", TransID #".$transactid;
			$this->log($result, 'notify_email');
		}
	}

}
