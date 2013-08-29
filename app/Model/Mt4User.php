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
				'EMAIL' => $userEmail,
				'GROUP LIKE' => '%IK%'
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
				'LOGIN' => $partnertag,
				'GROUP LIKE' => '%manager%'
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
			'conditions' => array('GROUP LIKE' => '%IK%')
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
				'GROUP LIKE' => '%Aff%'
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
		$result = $this->find('count', array(
			'conditions' =>array(
				'AGENT_ACCOUNT' => $partnertag,
				'GROUP LIKE' => '%IK%'
			),
			'group' => array('EMAIL')
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
		$result = $this->find('count', array(
			'conditions' =>array(
				'AGENT_ACCOUNT' => $partnertag,
				'GROUP LIKE' => '%IK%'
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
				'AGENT_ACCOUNT' => $partnertag,
				'GROUP LIKE' => '%Aff%'
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
			'conditions' => array('GROUP LIKE' => '%IK%'),
			'fields' => array('sum(BALANCE) AS total')
		));
		return $total;
	}

	/**
	* STAFF : Listing Semua Downline Account Number
	***/
	public function listingDownline($affId=null){
		$listDownline = $this->find('all', array(
			'conditions' =>array(
				'AGENT_ACCOUNT LIKE' => $affId,
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
				'LOGIN LIKE' => $login,
			),
			'fields' => array(
				'BALANCE'
			)
		));
		return $bakiAcc;
	}

}
