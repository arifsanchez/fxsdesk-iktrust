<?php
App::uses('AppModel', 'Model');
/**
 * Mt4Trade Model
 *
 */
class Mt4Trade extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */	
	//table information
	var $name = 'Mt4Trade';
	// define which database driver the model
	// needs to look upon
	var $useDbConfig = 'mt4';
	// Table Name
	var $useTable = 'MT4_TRADES';
	 var $primaryKey = 'TICKET';
 
	public $validate = array(
		'TICKET' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
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
		'SYMBOL' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'DIGITS' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'CMD' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'VOLUME' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'OPEN_TIME' => array(
			'datetime' => array(
				'rule' => array('datetime'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'CLOSE_TIME' => array(
			'datetime' => array(
				'rule' => array('datetime'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'EXPIRATION' => array(
			'datetime' => array(
				'rule' => array('datetime'),
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
		'INTERNAL_ID' => array(
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
	
	/****
	*	STAFF :: Data berapa close position
	*****/
	public function jumlahCloseOrder($bila=null){
		App::uses('CakeTime', 'Utility');
		$date = strtotime($bila);
		$tempoh = CakeTime::daysAsSql($date,$date, 'CLOSE_TIME');

		$jumlah = $this->find('all', array(
			'conditions' => array(
        		$tempoh,
        		'SYMBOL NOT' => ''
	        ),
			'fields' => array('sum(PROFIT) AS total')
		));
		return $jumlah[0][0];
	}

	/**
	*	STAFF : Dapatkan total open post
	***/
	public function traderOpenPost($login=null){
		$time = "1970-01-01 00:00:00";
		$total = $this->find('count', array(
			'conditions' => array(
        		'CLOSE_TIME' => $time,
        		'LOGIN' => $login,
        		'SYMBOL NOT' => ''
	        ),
		));
		return $total;
	}

	/**
	*	STAFF : Dapatkan total close post
	***/
	public function traderClosePost($login=null){
		App::uses('CakeTime', 'Utility');
		$date = strtotime('today');
		$time = "1970-01-01 00:00:00";
		$tempoh = CakeTime::daysAsSql($time,$date, 'CLOSE_TIME');
		$total = $this->find('count', array(
			'conditions' => array(
        		$tempoh,
        		'LOGIN' => $login,
        		'SYMBOL NOT' => ''
	        ),
		));
		return $total;
	}

	/**
	*	STAFF : Dapatkan total volume
	***/
	public function traderTradeVol($login=null){
		$total = $this->find('all', array(
			'conditions' => array(
        		'LOGIN' => $login,
        		'SYMBOL NOT' => ''
	        ),
	        'fields' => array('sum(VOLUME) AS total')
		));
		return $total[0][0]['total']/100;
	}
}
