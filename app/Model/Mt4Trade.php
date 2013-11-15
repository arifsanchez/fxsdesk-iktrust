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
 	
 	public $belongsTo = array(
        'Mt4User' => array(
            'className' => 'Mt4User',
            'foreignKey' => 'LOGIN'
        )
    );

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
        		'SYMBOL NOT' => '',
        		'Mt4User.GROUP LIKE' => '%IK%'

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
        		'SYMBOL NOT' => '',
        		
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

	/**
	*	PARTNER : Dapatkan overall commission from day 1
	***/
	public function OverallComm($acc=null){
		if(!empty($acc)){
			$total = $this->find('all', array(
				'conditions' => array(
					'Mt4Trade.LOGIN' => $acc,
					'Mt4Trade.COMMENT LIKE' => '%agent%'
				),
				'fields' => array(
					'sum(PROFIT) AS total'
				)

			));
		} else {
			$total = $this->find('all', array(
				'conditions' => array(
					'Mt4Trade.COMMENT LIKE' => '%agent%'
				),
				'fields' => array(
					'sum(PROFIT) AS total'
				)

			));
		}
		return $total[0][0]['total'];
	}

	/**
	*	PARTNER : Dapatkan overall commission from last month
	***/
	public function LastMonthComm($acc=null){
		App::uses('CakeTime', 'Utility');
		$date1 = strtotime('first day of last month');
		$date2 = strtotime('last day of last month');
		$tempoh = CakeTime::daysAsSql($date1,$date2, 'OPEN_TIME');
		#debug($tempoh); die();
		if(!empty($acc)){
			$total = $this->find('all', array(
				'conditions' => array(
					$tempoh,
					'Mt4Trade.LOGIN' => $acc,
					'Mt4Trade.COMMENT LIKE' => '%agent%'
				),
				'fields' => array(
					'sum(PROFIT) AS total'
				)

			));
		} else {
			$total = $this->find('all', array(
				'conditions' => array(
					$tempoh,
					'Mt4Trade.COMMENT LIKE' => '%agent%'
				),
				'fields' => array(
					'sum(PROFIT) AS total'
				)

			));
		}
		return $total[0][0]['total'];
	}

	/**
	*	PARTNER : Dapatkan overall commission from last week
	***/
	public function LastWeekComm($acc=null){
		App::uses('CakeTime', 'Utility');
		$date1 = strtotime('last week Monday');
		$date2 = strtotime('last week Friday');
		$tempoh = CakeTime::daysAsSql($date1,$date2, 'OPEN_TIME');
		#debug($tempoh); die();
		if(!empty($acc)){
			$total = $this->find('all', array(
				'conditions' => array(
					$tempoh,
					'Mt4Trade.LOGIN' => $acc,
					'Mt4Trade.COMMENT LIKE' => '%agent%'
				),
				'fields' => array(
					'sum(PROFIT) AS total'
				)

			));
		} else {
			$total = $this->find('all', array(
				'conditions' => array(
					$tempoh,
					'Mt4Trade.COMMENT LIKE' => '%agent%'
				),
				'fields' => array(
					'sum(PROFIT) AS total'
				)

			));
		}
		return $total[0][0]['total'];
	}

	/**
	*	PARTNER : Dapatkan overall commission from yesterday
	***/
	public function YesterdayComm($acc=null){
		App::uses('CakeTime', 'Utility');
		$date1 = strtotime('yesterday');
		$date2 = strtotime('yesterday');
		$tempoh = CakeTime::daysAsSql($date1,$date2, 'OPEN_TIME');
		#debug($tempoh); die();
		if(!empty($acc)){
			$total = $this->find('all', array(
				'conditions' => array(
					$tempoh,
					'Mt4Trade.LOGIN' => $acc,
					'Mt4Trade.COMMENT LIKE' => '%agent%'
				),
				'fields' => array(
					'sum(PROFIT) AS total'
				)

			));
		} else {
			$total = $this->find('all', array(
				'conditions' => array(
					$tempoh,
					'Mt4Trade.COMMENT LIKE' => '%agent%'
				),
				'fields' => array(
					'sum(PROFIT) AS total'
				)

			));
		}
		return $total[0][0]['total'];
	}

	/**
	*	PARTNER : Dapatkan overall commission from today
	***/
	public function TodayComm($acc=null){
		App::uses('CakeTime', 'Utility');
		$date1 = strtotime('today');
		$date2 = strtotime('today');
		$tempoh = CakeTime::daysAsSql($date1,$date2, 'OPEN_TIME');
		#debug($tempoh); die();
		if(!empty($acc)){
			$total = $this->find('all', array(
				'conditions' => array(
					$tempoh,
					'Mt4Trade.LOGIN' => $acc,
					'Mt4Trade.COMMENT LIKE' => '%agent%'
				),
				'fields' => array(
					'sum(PROFIT) AS total'
				)

			));
		} else {
			$total = $this->find('all', array(
				'conditions' => array(
					$tempoh,
					'Mt4Trade.COMMENT LIKE' => '%agent%'
				),
				'fields' => array(
					'sum(PROFIT) AS total'
				)

			));
		}
		return $total[0][0]['total'];
	}

	/**
	*	PARTNER : Dapatkan overall commission from day 1
	***/
	public function OverallCommPartner($acc=null){
		if(!empty($acc)){
			$total = $this->find('all', array(
				'conditions' => array(
					'Mt4Trade.LOGIN' => $acc,
					'Mt4Trade.COMMENT LIKE' => '%comm%'
				),
				'fields' => array(
					'sum(PROFIT) AS total'
				)

			));
		} else {
			$total = $this->find('all', array(
				'conditions' => array(
					'Mt4Trade.COMMENT LIKE' => '%comm%'
				),
				'fields' => array(
					'sum(PROFIT) AS total'
				)

			));
		}
		return $total[0][0]['total'];
	}

	/**
	*	PARTNER : Dapatkan overall commission from last month
	***/
	public function LastMonthCommPartner($acc=null){
		App::uses('CakeTime', 'Utility');
		$date1 = strtotime('first day of last month');
		$date2 = strtotime('last day of last month');
		$tempoh = CakeTime::daysAsSql($date1,$date2, 'OPEN_TIME');
		#debug($tempoh); die();
		if(!empty($acc)){
			$total = $this->find('all', array(
				'conditions' => array(
					$tempoh,
					'Mt4Trade.LOGIN' => $acc,
					'Mt4Trade.COMMENT LIKE' => '%comm%'
				),
				'fields' => array(
					'sum(PROFIT) AS total'
				)

			));
		} else {
			$total = $this->find('all', array(
				'conditions' => array(
					$tempoh,
					'Mt4Trade.COMMENT LIKE' => '%comm%'
				),
				'fields' => array(
					'sum(PROFIT) AS total'
				)

			));
		}
		return $total[0][0]['total'];
	}

	/**
	*	PARTNER : Dapatkan overall commission from last week
	***/
	public function LastWeekCommPartner($acc=null){
		App::uses('CakeTime', 'Utility');
		$date1 = strtotime('last week Monday');
		$date2 = strtotime('last week Friday');
		$tempoh = CakeTime::daysAsSql($date1,$date2, 'OPEN_TIME');
		#debug($tempoh); die();
		if(!empty($acc)){
			$total = $this->find('all', array(
				'conditions' => array(
					$tempoh,
					'Mt4Trade.LOGIN' => $acc,
					'Mt4Trade.COMMENT LIKE' => '%comm%'
				),
				'fields' => array(
					'sum(PROFIT) AS total'
				)

			));
		} else {
			$total = $this->find('all', array(
				'conditions' => array(
					$tempoh,
					'Mt4Trade.COMMENT LIKE' => '%comm%'
				),
				'fields' => array(
					'sum(PROFIT) AS total'
				)

			));
		}
		return $total[0][0]['total'];
	}

	/**
	*	PARTNER : Dapatkan overall commission from yesterday
	***/
	public function YesterdayCommPartner($acc=null){
		App::uses('CakeTime', 'Utility');
		$date1 = strtotime('yesterday');
		$date2 = strtotime('yesterday');
		$tempoh = CakeTime::daysAsSql($date1,$date2, 'OPEN_TIME');
		#debug($tempoh); die();
		if(!empty($acc)){
			$total = $this->find('all', array(
				'conditions' => array(
					$tempoh,
					'Mt4Trade.LOGIN' => $acc,
					'Mt4Trade.COMMENT LIKE' => '%comm%'
				),
				'fields' => array(
					'sum(PROFIT) AS total'
				)

			));
		} else {
			$total = $this->find('all', array(
				'conditions' => array(
					$tempoh,
					'Mt4Trade.COMMENT LIKE' => '%comm%'
				),
				'fields' => array(
					'sum(PROFIT) AS total'
				)

			));
		}
		return $total[0][0]['total'];
	}

	/**
	*	PARTNER : Dapatkan overall commission from today
	***/
	public function TodayCommPartner($acc=null){
		App::uses('CakeTime', 'Utility');
		$date1 = strtotime('today');
		$date2 = strtotime('today');
		$tempoh = CakeTime::daysAsSql($date1,$date2, 'OPEN_TIME');
		#debug($tempoh); die();
		if(!empty($acc)){
			$total = $this->find('all', array(
				'conditions' => array(
					$tempoh,
					'Mt4Trade.LOGIN' => $acc,
					'Mt4Trade.COMMENT LIKE' => '%comm%'
				),
				'fields' => array(
					'sum(PROFIT) AS total'
				)

			));
		} else {
			$total = $this->find('all', array(
				'conditions' => array(
					$tempoh,
					'Mt4Trade.COMMENT LIKE' => '%comm%'
				),
				'fields' => array(
					'sum(PROFIT) AS total'
				)

			));
		}
		return $total[0][0]['total'];
	}

	/**
	*	STAFF : Dapatkan overall deposit from day 1
	***/
	public function OverallDepo(){
		$total = $this->find('all', array(
			'conditions' => array(
				'Mt4Trade.COMMENT LIKE' => '%DP%',
				'Mt4Trade.CMD' => '6',
				'Mt4Trade.LOGIN NOT LIKE' => '88%',
				'Mt4Trade.PROFIT NOT LIKE' => '%-%',
				'Mt4User.GROUP LIKE' => '%IK%'
			),
			'fields' => array(
				'sum(PROFIT) AS total'
			)

		));
		return $total[0][0]['total'];
	}

	/**
	*	STAFF : Dapatkan overall deposit from last month
	***/
	public function LastMonthDepo(){
		App::uses('CakeTime', 'Utility');
		$date1 = strtotime('first day of last month');
		$date2 = strtotime('last day of last month');
		$tempoh = CakeTime::daysAsSql($date1,$date2, 'OPEN_TIME');
		#debug($tempoh); die();
		$total = $this->find('all', array(
			'conditions' => array(
				$tempoh,
				'Mt4Trade.COMMENT LIKE' => '%DP%',
				'Mt4Trade.CMD' => '6',
				'Mt4Trade.LOGIN NOT LIKE' => '88%',
				'Mt4Trade.PROFIT NOT LIKE' => '%-%',
				'Mt4User.GROUP LIKE' => '%IK%'
			),
			'fields' => array(
				'sum(PROFIT) AS total'
			)

		));
		return $total[0][0]['total'];
	}

	/**
	*	STAFF : Dapatkan overall deposit from last week
	***/
	public function LastWeekDepo(){
		App::uses('CakeTime', 'Utility');
		$date1 = strtotime('last week Monday');
		$date2 = strtotime('last week Friday');
		$tempoh = CakeTime::daysAsSql($date1,$date2, 'OPEN_TIME');
		#debug($tempoh); die();
		$total = $this->find('all', array(
			'conditions' => array(
				$tempoh,
				'Mt4Trade.COMMENT LIKE' => '%DP%',
				'Mt4Trade.CMD' => '6',
				'Mt4Trade.LOGIN NOT LIKE' => '88%',
				'Mt4Trade.PROFIT NOT LIKE' => '%-%',
				'Mt4User.GROUP LIKE' => '%IK%'
			),
			'fields' => array(
				'sum(PROFIT) AS total'
			)

		));
		return $total[0][0]['total'];
	}

	/**
	*	Staff : Dapatkan overall deposit from yesterday
	***/
	public function YesterdayDepo(){
		App::uses('CakeTime', 'Utility');
		$date1 = strtotime('yesterday');
		$date2 = strtotime('yesterday');
		$tempoh = CakeTime::daysAsSql($date1,$date2, 'OPEN_TIME');
		#debug($tempoh); die();
		$total = $this->find('all', array(
			'conditions' => array(
				$tempoh,
				'Mt4Trade.COMMENT LIKE' => '%DP%',
				'Mt4Trade.CMD' => '6',
				'Mt4Trade.LOGIN NOT LIKE' => '88%',
				'Mt4Trade.PROFIT NOT LIKE' => '%-%',
				'Mt4User.GROUP LIKE' => '%IK%'
			),
			'fields' => array(
				'sum(PROFIT) AS total'
			)

		));
		return $total[0][0]['total'];
	}

	/**
	*	Staff : Dapatkan overall deposit from today
	***/
	public function TodayDepo(){
		App::uses('CakeTime', 'Utility');
		$date1 = strtotime('today');
		$date2 = strtotime('today');
		$tempoh = CakeTime::daysAsSql($date1,$date2, 'OPEN_TIME');
		#debug($tempoh); die();
		$total = $this->find('all', array(
			'conditions' => array(
				$tempoh,
				'Mt4Trade.COMMENT LIKE' => '%DP%',
				'Mt4Trade.CMD' => '6',
				'Mt4Trade.LOGIN NOT LIKE' => '88%',
				'Mt4Trade.PROFIT NOT LIKE' => '%-%',
				'Mt4User.GROUP LIKE' => '%IK%'
			),
			'fields' => array(
				'sum(PROFIT) AS total'
			)

		));
		return $total[0][0]['total'];
	}

	/**
	*	STAFF : Dapatkan overall withdrawal from day 1
	***/
	public function OverallWdrw(){
		$total = $this->find('all', array(
			'conditions' => array(
				'Mt4Trade.COMMENT LIKE' => '%WD%',
				'Mt4Trade.CMD' => '6',
				'Mt4Trade.LOGIN NOT LIKE' => '88%',
				'Mt4Trade.PROFIT LIKE' => '%-%',
				'Mt4User.GROUP LIKE' => '%IK%'
			),
			'fields' => array(
				'sum(PROFIT) AS total'
			)

		));
		return $total[0][0]['total'];
	}

	/**
	*	STAFF : Dapatkan overall withdrawal from last month
	***/
	public function LastMonthWdrw(){
		App::uses('CakeTime', 'Utility');
		$date1 = strtotime('first day of last month');
		$date2 = strtotime('last day of last month');
		$tempoh = CakeTime::daysAsSql($date1,$date2, 'OPEN_TIME');
		#debug($tempoh); die();
		$total = $this->find('all', array(
			'conditions' => array(
				$tempoh,
				'Mt4Trade.COMMENT LIKE' => '%WD%',
				'Mt4Trade.CMD' => '6',
				'Mt4Trade.LOGIN NOT LIKE' => '88%',
				'Mt4Trade.PROFIT LIKE' => '%-%',
				'Mt4User.GROUP LIKE' => '%IK%'
			),
			'fields' => array(
				'sum(PROFIT) AS total'
			)

		));
		return $total[0][0]['total'];
	}

	/**
	*	STAFF : Dapatkan overall withdrawal from last week
	***/
	public function LastWeekWdrw(){
		App::uses('CakeTime', 'Utility');
		$date1 = strtotime('last week Monday');
		$date2 = strtotime('last week Friday');
		$tempoh = CakeTime::daysAsSql($date1,$date2, 'OPEN_TIME');
		#debug($tempoh); die();
		$total = $this->find('all', array(
			'conditions' => array(
				$tempoh,
				'Mt4Trade.COMMENT LIKE' => '%WD%',
				'Mt4Trade.CMD' => '6',
				'Mt4Trade.LOGIN NOT LIKE' => '88%',
				'Mt4Trade.PROFIT LIKE' => '%-%',
				'Mt4User.GROUP LIKE' => '%IK%'
			),
			'fields' => array(
				'sum(PROFIT) AS total'
			)

		));
		return $total[0][0]['total'];
	}

	/**
	*	Staff : Dapatkan overall withdrawal from yesterday
	***/
	public function YesterdayWdrw(){
		App::uses('CakeTime', 'Utility');
		$date1 = strtotime('yesterday');
		$date2 = strtotime('yesterday');
		$tempoh = CakeTime::daysAsSql($date1,$date2, 'OPEN_TIME');
		#debug($tempoh); die();
		$total = $this->find('all', array(
			'conditions' => array(
				$tempoh,
				'Mt4Trade.COMMENT LIKE' => '%WD%',
				'Mt4Trade.CMD' => '6',
				'Mt4Trade.LOGIN NOT LIKE' => '88%',
				'Mt4Trade.PROFIT LIKE' => '%-%',
				'Mt4User.GROUP LIKE' => '%IK%'
			),
			'fields' => array(
				'sum(PROFIT) AS total'
			)

		));
		return $total[0][0]['total'];
	}

	/**
	*	Staff : Dapatkan overall withdrawal from today
	***/
	public function TodayWdrw(){
		App::uses('CakeTime', 'Utility');
		$date1 = strtotime('today');
		$date2 = strtotime('today');
		$tempoh = CakeTime::daysAsSql($date1,$date2, 'OPEN_TIME');
		#debug($tempoh); die();
		$total = $this->find('all', array(
			'conditions' => array(
				$tempoh,
				'Mt4Trade.COMMENT LIKE' => '%WD%',
				'Mt4Trade.CMD' => '6',
				'Mt4Trade.LOGIN NOT LIKE' => '88%',
				'Mt4Trade.PROFIT LIKE' => '%-%',
				'Mt4User.GROUP LIKE' => '%IK%'

			),
			'fields' => array(
				'sum(PROFIT) AS total'
			)

		));
		return $total[0][0]['total'];
	}

	/**
	*	STAFF : Dapatkan overall rebate loss from day 1
	***/
	public function OverallRebloss(){
		$total = $this->find('all', array(
			'conditions' => array(
				'Mt4Trade.COMMENT LIKE' => '%Rebate #Loss%',
			),
			'fields' => array(
				'sum(PROFIT) AS total'
			)

		));
		return $total[0][0]['total'];
	}

	/**
	*	STAFF : Dapatkan overall rebate loss from last month
	***/
	public function LastMonthRebloss(){
		App::uses('CakeTime', 'Utility');
		$date1 = strtotime('first day of last month');
		$date2 = strtotime('last day of last month');
		$tempoh = CakeTime::daysAsSql($date1,$date2, 'OPEN_TIME');
		#debug($tempoh); die();
		$total = $this->find('all', array(
			'conditions' => array(
				$tempoh,
				'Mt4Trade.COMMENT LIKE' => '%Rebate #Loss%',
			),
			'fields' => array(
				'sum(PROFIT) AS total'
			)

		));
		return $total[0][0]['total'];
	}

	/**
	*	STAFF : Dapatkan overall rebate loss from last week
	***/
	public function LastWeekRebloss(){
		App::uses('CakeTime', 'Utility');
		$date1 = strtotime('last week Monday');
		$date2 = strtotime('last week Friday');
		$tempoh = CakeTime::daysAsSql($date1,$date2, 'OPEN_TIME');
		#debug($tempoh); die();
		$total = $this->find('all', array(
			'conditions' => array(
				$tempoh,
				'Mt4Trade.COMMENT LIKE' => '%Rebate #Loss%',
			),
			'fields' => array(
				'sum(PROFIT) AS total'
			)

		));
		return $total[0][0]['total'];
	}

	/**
	*	Staff : Dapatkan overall rebate loss from yesterday
	***/
	public function YesterdayRebloss(){
		App::uses('CakeTime', 'Utility');
		$date1 = strtotime('yesterday');
		$date2 = strtotime('yesterday');
		$tempoh = CakeTime::daysAsSql($date1,$date2, 'OPEN_TIME');
		#debug($tempoh); die();
		$total = $this->find('all', array(
			'conditions' => array(
				$tempoh,
				'Mt4Trade.COMMENT LIKE' => '%Rebate #Loss%',
			),
			'fields' => array(
				'sum(PROFIT) AS total'
			)

		));
		return $total[0][0]['total'];
	}

	/**
	*	Staff : Dapatkan overall rebate loss from today
	***/
	public function TodayRebloss(){
		App::uses('CakeTime', 'Utility');
		$date1 = strtotime('today');
		$date2 = strtotime('today');
		$tempoh = CakeTime::daysAsSql($date1,$date2, 'OPEN_TIME');
		#debug($tempoh); die();
		$total = $this->find('all', array(
			'conditions' => array(
				$tempoh,
				'Mt4Trade.COMMENT LIKE' => '%Rebate #Loss%',
			),
			'fields' => array(
				'sum(PROFIT) AS total'
			)

		));
		return $total[0][0]['total'];
	}

	/**
	*	STAFF : Dapatkan overall rebate prof from day 1
	***/
	public function OverallRebprof(){
		$total = $this->find('all', array(
			'conditions' => array(
				'Mt4Trade.COMMENT LIKE' => '%Rebate #Profit%',
			),
			'fields' => array(
				'sum(PROFIT) AS total'
			)

		));
		return $total[0][0]['total'];
	}

	/**
	*	STAFF : Dapatkan overall rebate prof from last month
	***/
	public function LastMonthRebprof(){
		App::uses('CakeTime', 'Utility');
		$date1 = strtotime('first day of last month');
		$date2 = strtotime('last day of last month');
		$tempoh = CakeTime::daysAsSql($date1,$date2, 'OPEN_TIME');
		#debug($tempoh); die();
		$total = $this->find('all', array(
			'conditions' => array(
				$tempoh,
				'Mt4Trade.COMMENT LIKE' => '%Rebate #Profit%',
			),
			'fields' => array(
				'sum(PROFIT) AS total'
			)

		));
		return $total[0][0]['total'];
	}

	/**
	*	STAFF : Dapatkan overall rebate prof from last week
	***/
	public function LastWeekRebprof(){
		App::uses('CakeTime', 'Utility');
		$date1 = strtotime('last week Monday');
		$date2 = strtotime('last week Friday');
		$tempoh = CakeTime::daysAsSql($date1,$date2, 'OPEN_TIME');
		#debug($tempoh); die();
		$total = $this->find('all', array(
			'conditions' => array(
				$tempoh,
				'Mt4Trade.COMMENT LIKE' => '%Rebate #Profit%',
			),
			'fields' => array(
				'sum(PROFIT) AS total'
			)

		));
		return $total[0][0]['total'];
	}

	/**
	*	Staff : Dapatkan overall rebate prof from yesterday
	***/
	public function YesterdayRebprof(){
		App::uses('CakeTime', 'Utility');
		$date1 = strtotime('yesterday');
		$date2 = strtotime('yesterday');
		$tempoh = CakeTime::daysAsSql($date1,$date2, 'OPEN_TIME');
		#debug($tempoh); die();
		$total = $this->find('all', array(
			'conditions' => array(
				$tempoh,
				'Mt4Trade.COMMENT LIKE' => '%Rebate #Profit%',
			),
			'fields' => array(
				'sum(PROFIT) AS total'
			)

		));
		return $total[0][0]['total'];
	}

	/**
	*	Staff : Dapatkan overall rebate prof from today
	***/
	public function TodayRebprof(){
		App::uses('CakeTime', 'Utility');
		$date1 = strtotime('today');
		$date2 = strtotime('today');
		$tempoh = CakeTime::daysAsSql($date1,$date2, 'OPEN_TIME');
		#debug($tempoh); die();
		$total = $this->find('all', array(
			'conditions' => array(
				$tempoh,
				'Mt4Trade.COMMENT LIKE' => '%Rebate #Profit%',
			),
			'fields' => array(
				'sum(PROFIT) AS total'
			)

		));
		return $total[0][0]['total'];
	}

	/**
	*	STAFF : Dapatkan overall close trade (PROFIT)
	***/
	public function OverallPROFIT(){
		$total = $this->find('all', array(
			'conditions' => array(
        		'Mt4Trade.SYMBOL NOT' => '',
        		'Mt4Trade.PROFIT NOT LIKE' => '%-%',
        		'Mt4User.GROUP LIKE' => '%IK%'
	        ),
			'fields' => array(
				'sum(PROFIT) AS total'
			)

		));
		return $total[0][0]['total'];
	}

	/**
	*	STAFF : Dapatkan overall close trade (LOSS)
	***/
	public function OverallLOSS(){
		$total = $this->find('all', array(
			'conditions' => array(
        		'Mt4Trade.SYMBOL NOT' => '',
        		'Mt4Trade.PROFIT LIKE' => '%-%',
        		'Mt4User.GROUP LIKE' => '%IK%'
	        ),
			'fields' => array(
				'sum(PROFIT) AS total'
			)

		));
		return $total[0][0]['total'];
	}

	/**
	*	STAFF : Dapatkan overall close trade (PROFIT)
	***/
	public function OverallLastMonthPROFIT(){
		App::uses('CakeTime', 'Utility');
		$date1 = strtotime('first day of last month');
		$date2 = strtotime('last day of last month');
		$tempoh = CakeTime::daysAsSql($date1,$date2, 'OPEN_TIME');
		$total = $this->find('all', array(
			'conditions' => array(
				$tempoh,
        		'Mt4Trade.SYMBOL NOT' => '',
        		'Mt4Trade.PROFIT NOT LIKE' => '%-%',
        		'Mt4User.GROUP LIKE' => '%IK%'
	        ),
			'fields' => array(
				'sum(PROFIT) AS total'
			)

		));
		return $total[0][0]['total'];
	}

	/**
	*	STAFF : Dapatkan overall close trade (LOSS)
	***/
	public function OverallLastMonthLOSS(){
		App::uses('CakeTime', 'Utility');
		$date1 = strtotime('first day of last month');
		$date2 = strtotime('last day of last month');
		$tempoh = CakeTime::daysAsSql($date1,$date2, 'OPEN_TIME');
		$total = $this->find('all', array(
			'conditions' => array(
				$tempoh,
        		'Mt4Trade.SYMBOL NOT' => '',
        		'Mt4Trade.PROFIT LIKE' => '%-%',
        		'Mt4User.GROUP LIKE' => '%IK%'
	        ),
			'fields' => array(
				'sum(PROFIT) AS total'
			)

		));
		return $total[0][0]['total'];
	}
}
