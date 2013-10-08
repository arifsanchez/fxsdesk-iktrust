<?php
	#Traders Controller

	App::uses('AppController', 'Controller');

	class TraderAccountsController extends AppController {

		/**
		* Controller name
		*
		* @var string
		*/
		public $name = 'TraderAccounts';

		/**
		* This controller does not use a model
		*
		* @var array
		*/
		public $uses = array("Vault", "Mt4User","Usermgmt.User","Mt4Trade");

		/**
		* TRADER :: Accounts listing
		*
		* @param mixed What page to display
		* @return void
		*/
		public function listing() {
			//Layout
			$this->layout = "trader.dashboard";
			//Page title
			$page_title = array(
				'icon' => "icon-signal",
				'name' => "Trading Accounts Listing"
			);
			$this->set('page_title',$page_title);

			//Pull info trader
			$user = $this->UserAuth->getUser();
			$acc = $this->Mt4User->find('all', array(
				'conditions' =>array(
					'Mt4User.EMAIL' => $user['User']['email'],
					#'Mt4User.EMAIL' => "me@arif.my", //Test Account
					'Mt4User.GROUP LIKE' => '%IK%'
				)
			));
			$this->set('MT_ACC',$acc);
		}

		/**
		* TRADER :: Affilliate listing
		*
		* @param mixed What page to display
		* @return void
		*/
		public function affilliate() {
			//Layout
			$this->layout = "trader.dashboard";
			//Page title
			$page_title = array(
				'icon' => "icon-signal",
				'name' => "Affilliate Account Listing"
			);
			$this->set('page_title',$page_title);

			//Pull info trader
			$user = $this->UserAuth->getUser();
			$acc = $this->Mt4User->find('all', array(
				'conditions' =>array(
					'Mt4User.EMAIL' => $user['User']['email'],
					#'Mt4User.EMAIL' => "me@arif.my", //Test Account
					'Mt4User.GROUP LIKE' => '%Aff%'
				)
			));
			$this->set('MT_ACC',$acc);
		}

		/**
		* TRADER :: Account Details
		*
		* @param mixed What page to display
		* @return void
		*/
		public function overview() {
			$acc = $this->params['named']['acc'];
			//Layout
			$this->layout = "trader.dashboard";
			//Page title
			$page_title = array(
				'icon' => "icon-signal",
				'name' => "#".$acc.""
			);
			$this->set('page_title',$page_title);

				//Request balance from vault db
				$userId = $this->UserAuth->getUserId();
				$acc1 = $this->Vault->getAccBalance($userId);
				$this->set('acc1', $acc1['Vault']['acc_1']);

				//Pull info trader
				$user = $this->UserAuth->getUser();
				$result = $this->Mt4User->find('first', array(
					'conditions' =>array(
						'Mt4User.LOGIN' => $acc,
						'Mt4User.GROUP LIKE' => '%IK%'
					)
				));

				$bakiAcc = $this->Mt4User->tentangDiri($acc);
				$this->set('nama_trader',$bakiAcc['Mt4User']['NAME']);
				$this->set('email_trader',$bakiAcc['Mt4User']['EMAIL']);
				$this->set('bakiAcc',$bakiAcc['Mt4User']['BALANCE']);
				$this->set('bakiSemalam',$bakiAcc['Mt4User']['PREVBALANCE']);
				$this->set('leverage',$bakiAcc['Mt4User']['LEVERAGE']);
				$this->set('bakiCR',$bakiAcc['Mt4User']['CREDIT']);
				$this->set('equity',$bakiAcc['Mt4User']['MARGIN_FREE']+$bakiAcc['Mt4User']['MARGIN']);

				$traderOpenPost = $this->Mt4Trade->traderOpenPost($acc);
				$this->set('traderOpenPost', $traderOpenPost);

				$traderClosePost = $this->Mt4Trade->traderClosePost($acc);
				$this->set('traderClosePost', $traderClosePost);
				
				$traderTradeVol = $this->Mt4Trade->traderTradeVol($acc);
				$this->set('traderTradeVol', $traderTradeVol);

				if(empty($result)){
					$this->Session->setFlash(__('You are not authorized to acess trading account #'.$acc.' details.'), 'default', array('class' => 'error'));
					$this->redirect(array('action' => 'listing'));
				} else {
					if($result['Mt4User']['EMAIL'] == $user['User']['email']){
						$this->set('MT_ACC',$result);

						//Pull top 5 transactions
						$transact = $this->Mt4Trade->find('all', array(
							'conditions' =>array(
								'Mt4Trade.LOGIN' => $acc,

							),
							'limit' => 10,
							'order' => array('Mt4Trade.TICKET DESC'), 
						));
						$this->set('MT_TRANSACT',$transact);
					} else {
						$this->Session->setFlash(__('You are not authorized to acess trading account #'.$acc.' details.'), 'default', array('class' => 'error'));
						$this->redirect(array('action' => 'listing'));
					}
				}				
		}


		/**
		* TRADER :: Account History
		*
		* @param mixed What page to display
		* @return void
		*/
		public function history() {
			$acc = $this->params['named']['acc'];
			//Layout
			$this->layout = "trader.dashboard";
			//Page title
			$page_title = array(
				'icon' => "glyphicon-table",
				'name' => "All Transactions #".$acc.""
			);
			$this->set('page_title',$page_title);

			//Pull info trader
			$user = $this->UserAuth->getUser();
			$result = $this->Mt4User->find('first', array(
				'conditions' =>array(
					'Mt4User.LOGIN' => $acc,
				)
			));
			if($result['Mt4User']['EMAIL'] == $user['User']['email']){
				#debug($result);die();
				$this->set('MT_ACC',$result);

				//Paginate Trade history
				$this->paginate = array(
					'limit' => 10, 
					'order'=>'Mt4Trade.OPEN_TIME DESC', 
					'recursive'=>0,
					'conditions' =>array(
						'Mt4Trade.LOGIN' => $acc,
				));
				$trades = $this->paginate('Mt4Trade');
				$this->set('MT_TRANSACT',$trades);

				$bakiAcc = $this->Mt4User->tentangDiri($acc);
				$this->set('nama_trader',$bakiAcc['Mt4User']['NAME']);
				$this->set('email_trader',$bakiAcc['Mt4User']['EMAIL']);
				$this->set('bakiAcc',$bakiAcc['Mt4User']['BALANCE']);
				$this->set('bakiSemalam',$bakiAcc['Mt4User']['PREVBALANCE']);
				$this->set('leverage',$bakiAcc['Mt4User']['LEVERAGE']);
				$this->set('bakiCR',$bakiAcc['Mt4User']['CREDIT']);
				$this->set('equity',$bakiAcc['Mt4User']['MARGIN_FREE']+$bakiAcc['Mt4User']['MARGIN']);

				$traderOpenPost = $this->Mt4Trade->traderOpenPost($acc);
				$this->set('traderOpenPost', $traderOpenPost);

				$traderClosePost = $this->Mt4Trade->traderClosePost($acc);
				$this->set('traderClosePost', $traderClosePost);

				if($this->RequestHandler->isAjax()) {
					$this->layout = 'ajax';
					$this->render('history');
				}
			} else {
				$this->Session->setFlash(__('You are not authorized to access trading account #'.$acc.' details.'), 'default', array('class' => 'alert alert-error'));
				$this->redirect(array('action' => 'listing'));
			}
		}

		/**
		* TRADER :: Affilliate Account History
		*
		* @param mixed What page to display
		* @return void
		*/
		public function affilliate_history() {
			$acc = $this->params['named']['acc'];
			//Layout
			$this->layout = "trader.dashboard";
			//Page title
			$page_title = array(
				'icon' => "glyphicon-table",
				'name' => "History Acc ".$acc.""
			);
			$this->set('page_title',$page_title);

			//Pull info trader
			$user = $this->UserAuth->getUser();
			$result = $this->Mt4User->find('first', array(
				'conditions' =>array(
					'Mt4User.LOGIN' => $acc,
				)
			));

			//check jika email di mt4 sama dgn email dalam dashboard
			if($result['Mt4User']['EMAIL'] == $user['User']['email']){
				
				//Pull data reffered client
				//listing downline
				$downlines = $this->Mt4User->listingDownline($acc);
				$this->set('downlines', $downlines);

				//hantar to view , data mt4acc
				$this->set('MT_ACC',$result);

				//Paginate Trade history
				$this->paginate = array(
					'limit' => 10, 
					'order'=>'Mt4Trade.OPEN_TIME DESC', 
					'recursive'=>0,
					'conditions' =>array(
						'Mt4Trade.LOGIN' => $acc,
				));
				$trades = $this->paginate('Mt4Trade');
				$this->set('MT_TRANSACT',$trades);

				$bakiAcc = $this->Mt4User->tentangDiri($acc);
				$this->set('nama_trader',$bakiAcc['Mt4User']['NAME']);
				$this->set('email_trader',$bakiAcc['Mt4User']['EMAIL']);
				$this->set('bakiAcc',$bakiAcc['Mt4User']['BALANCE']);
				$this->set('bakiSemalam',$bakiAcc['Mt4User']['PREVBALANCE']);
				$this->set('leverage',$bakiAcc['Mt4User']['LEVERAGE']);
				$this->set('bakiCR',$bakiAcc['Mt4User']['CREDIT']);
				$this->set('equity',$bakiAcc['Mt4User']['MARGIN_FREE']+$bakiAcc['Mt4User']['MARGIN']);

				if($this->RequestHandler->isAjax()) {
					$this->layout = 'ajax';
					$this->render('history');
				}
			} else {
				$this->Session->setFlash(__('You are not authorized to access this account #'.$acc.' details.'), 'default', array('class' => 'alert alert-error'));
				$this->redirect(array('action' => 'listing'));
			}
		}

		/**
		* Staff Kira Total Trader Accounts
		*
		* @access public
		* @return array
		*/
		public function kiraTotalTraders() {
			$this->layout = "ajax";
			if($this->UserAuth->isLogged()){
				$total = $this->Mt4User->kiraTotalAccs();
				#debug($total['0']['0']['total']);die();
				#$total = $total['0']['0']['total'];
				if ($this->request->is('requested')) {
					return $total;
				} else {
					$this->set('TotalAccs', $total);
				}
			}
		}

		/**
		* Staff Kira Total Trader Accounts
		*
		* @access public
		* @return array
		*/
		public function kiraTotalTradersInactive() {
			$this->layout = "ajax";
			if($this->UserAuth->isLogged()){
				$total = $this->Mt4User->kiraTotalAccsInactive();
				#debug($total['0']['0']['total']);die();
				#$total = $total['0']['0']['total'];
				if ($this->request->is('requested')) {
					return $total;
				} else {
					$this->set('TotalAccsInactive', $total);
				}
			}
		}

		/**
		* Staff Kira Total Agent Accounts
		*
		* @access public
		* @return array
		*/
		public function kiraTotalAgent() {
			$this->layout = "ajax";
			if($this->UserAuth->isLogged()){
				$total = $this->Mt4User->kiraTotalAffilliate();
				#debug($total['0']['0']['total']);die();
				#$total = $total['0']['0']['total'];
				if ($this->request->is('requested')) {
					return $total;
				} else {
					$this->set('TotalAccs', $total);
				}
			}
		}
	}
?>