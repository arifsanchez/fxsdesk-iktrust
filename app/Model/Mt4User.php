<?php
App::uses('AppModel', 'Model');
/**
 * Mt4User Model
 *
 */
class Mt4User extends AppModel {
	  // table information
	var $name = 'Mt4User';
	// define which database driver the model
	// needs to look upon
	var $useDbConfig = 'mt4';
	// Table Name
	var $useTable = 'MT4_USERS';
	var $primaryKey = 'LOGIN';
	
	public $hasMany = array(
        'Mt4Trade' => array(
            'className' => 'Mt4Trade',
            'foreignKey' => 'LOGIN'
        )
    );

	public $validate = array(
		'LOGIN' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'GROUP' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'ENABLE' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'ENABLE_CHANGE_PASS' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'ENABLE_READONLY' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'PASSWORD_PHONE' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'NAME' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'COUNTRY' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'CITY' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'STATE' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'ZIPCODE' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'ADDRESS' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'PHONE' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'EMAIL' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'COMMENT' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'ID' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'STATUS' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'REGDATE' => array(
			'datetime' => array(
				'rule' => array('datetime'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'LASTDATE' => array(
			'datetime' => array(
				'rule' => array('datetime'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'LEVERAGE' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'AGENT_ACCOUNT' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'TIMESTAMP' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'SEND_REPORTS' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'USER_COLOR' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'MODIFY_TIME' => array(
			'datetime' => array(
				'rule' => array('datetime'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
	
	/**
	 * List Trading Accounts bawah single user
	 *
	 * @access public
	*/
	function listTradeAcc($userEmail=null) {
		$result = '';
		if($userEmail) {
		$result = $this->find('all', array(
			'conditions' =>array(
				'Mt4User.EMAIL' => $userEmail,
				'Mt4User.GROUP LIKE' => '%IK%'
			)
		));
		return $result;
		}
		
	}

	/**
	 * List Partner Accounts bawah HQ dalam trading server
	 *
	 * @access public
	*/
	function listPartnerAcc($partnertag=null) {
		$result = '';
		if($partnertag) {
		$result = $this->find('first', array(
			'conditions' =>array(
				'Mt4User.LOGIN' => $partnertag,
				'Mt4User.GROUP LIKE' => '%manager%'
			)
		));
		return $result;
		}
		
	}

	/**
	 * Kira Total Trading Accounts bawah HQ
	 *
	 * @access public
	*/
	function kiraTotalAccs() {
		$total = 0;
		$total = $this->find('count', array(
			'conditions' => array('Mt4User.GROUP LIKE' => '%IK%')
		));
		return $total;
	}

	/**
	 * Kira Total Trading Accounts bawah HQ Inactive
	 *
	 * @access public
	*/
	function kiraTotalAccsInactive() {
		$total = 0;
		$total = $this->find('count', array(
			'conditions' => array('Mt4User.GROUP LIKE' => '%Z%')
		));
		return $total;
	}

	/**
	 * Kira Total Affilliate Account bawah HQ
	 *
	 * @access public
	*/
	function kiraTotalAffilliate() {
		$result ='';
		$result = $this->find('count', array(
			'conditions' =>array(
				'Mt4User.GROUP LIKE' => '%Aff%'
			)
		));
		return $result;
	}

	/**
	 * Kira Total Trading Account bawah partner group by email
	 *
	 * @access public
	*/
	function kiraTotalClient($partnertag=null) {
		$result ='';
		$headerTagAff = substr($partnertag, -2);
		$result = $this->find('count', array(
			'conditions' => array(
				'OR' => array(
					array(
						'AND' => array(
							'Mt4User.GROUP LIKE' => '%IK%',
							'Mt4User.AGENT_ACCOUNT LIKE' => '7'.$headerTagAff.'%',
						)
					),
					array(
						'AND' => array(
							'Mt4User.GROUP LIKE' => '%IK%',
							'Mt4User.AGENT_ACCOUNT' => "".$partnertag.""
						)
					)
				)
			),
			'group' => array('EMAIL')
		));
		return $result;
	}

	/**
	 * Kira Total Trading Account bawah satu email
	 *
	 * @access public
	*/
	function kiraAccBawahTracc($email=null) {
		$result ='';
		$result = $this->find('count', array(
			'conditions' =>array(
				'Mt4User.EMAIL' => $email,
				'Mt4User.GROUP LIKE' => '%IK%'
			)
		));
		return $result;
	}

	/**
	 * Kira Total Agent Account bawah satu email
	 *
	 * @access public
	*/
	function kiraAgentBawahTracc($email=null) {
		$result ='';
		$result = $this->find('count', array(
			'conditions' =>array(
				'Mt4User.EMAIL' => $email,
				'Mt4User.GROUP LIKE' => '%Aff%'
			)
		));
		return $result;
	}

	/**
	 * Kira Total Trading Account bawah partner
	 *
	 * @access public
	*/
	function kiraTotalDownline($partnertag=null) {
		$result ='';
		$headerTagAff = substr($partnertag, -2);
		$result = $this->find('count', array(
			'conditions' => array(
				'OR' => array(
					array(
						'AND' => array(
							'Mt4User.GROUP LIKE' => '%IK%',
							'Mt4User.AGENT_ACCOUNT LIKE' => '7'.$headerTagAff.'%',
						)
					),
					array(
						'AND' => array(
							'Mt4User.GROUP LIKE' => '%IK%',
							'Mt4User.AGENT_ACCOUNT' => "".$partnertag.""
						)
					)
				)
			)
		));
		return $result;
	}

	/**
	 * Kira Total Affilliate Account bawah partner
	 *
	 * @access public
	*/
	function kiraTotalAgent($partnertag=null) {
		$result ='';
		$result = $this->find('count', array(
			'conditions' =>array(
				'Mt4User.AGENT_ACCOUNT' => $partnertag,
				'Mt4User.GROUP LIKE' => '%Aff%'
			)
		));
		return $result;
	}

	/**
	 * Kira Total Trading Account Float
	 *
	 * @access public
	*/
	function kiraTotalTracc() {
		$total = 0;
		$total = $this->find('all', array(
			'conditions' => array(
				'Mt4User.GROUP LIKE' => '%IK%',
				'Mt4User.ENABLE' => '1'
			),
			'fields' => array('sum(BALANCE) AS total')
		));
		return $total;
	}

	/**
	 * Kira Total Trading Account Credit Float
	 *
	 * @access public
	*/
	function kiraTotalTraccCR() {
		$total = 0;
		$total = $this->find('all', array(
			'conditions' => array(
				'Mt4User.GROUP LIKE' => '%IK%',
				'Mt4User.ENABLE' => '1'
			),
			'fields' => array('sum(CREDIT) AS total')
		));
		return $total;
	}

	/**
	* STAFF : Listing Semua Downline Account Number
	***/
	public function listingDownline($affId=null){
		$listDownline = $this->find('all', array(
			'conditions' =>array(
				'Mt4User.AGENT_ACCOUNT LIKE' => $affId,
			)
		));
		return $listDownline;
	}

	/**
	* STAFF : Dapatkan total balance dalam account
	***/
	public function bakiAcc($login=null){
		$bakiAcc = $this->find('first', array(
			'conditions' =>array(
				'Mt4User.LOGIN LIKE' => $login,
			),
			'fields' => array(
				'Mt4User.BALANCE',
				'Mt4User.NAME',
				'Mt4User.EMAIL',
				'Mt4User.LEVERAGE',
				'Mt4User.CREDIT'
			)
		));
		return $bakiAcc;
	}


	/**
	* STAFF : Dapatkan info trader
	***/
	public function tentangDiri($login=null){
		$result = $this->find('first', array(
			'conditions' =>array(
				'Mt4User.LOGIN LIKE' => $login,
			),
			'fields' => array(
				'NAME',
				'EMAIL',
				'LEVERAGE',
				'CREDIT',
				'PREVBALANCE',
				'BALANCE',
				'MARGIN',
				'MARGIN_LEVEL',
				'MARGIN_FREE',
				'MODIFY_TIME'
			)
		));
		return $result;
	}

}
