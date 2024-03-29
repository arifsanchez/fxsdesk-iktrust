<?php
	#Staff Controller

	App::uses('AppController', 'Controller');

	class StaffsController extends AppController {

		/**
		* Controller name
		*
		* @var string
		*/
		public $name = 'Staffs';

		/**
		* This controller does not use a model
		*
		* @var array
		*/
		public $uses = array("Vault","VaultTransaction","VaultTransactionComment","Mt4User","Usermgmt.User","Usermgmt.UserGroup","Mt4Trade");

		/**
		* Staff Dashboard
		*
		* @param mixed What page to display
		* @return void
		*/
		public function backoffice() {

			//Layout
			$this->layout = "staff.dashboard";
			//Page title
			$page_title = array(
				'icon' => "icon-dashboard",
				'name' => "Staff Dashboard"
			);
			$this->set('page_title',$page_title);
		}


		/**
		* STAFF :: Registered Client listing
		*/
		public function admin_listing() {
			//Layout
			$this->layout = "staff.dashboard";
			//Page title
			$page_title = array(
				'icon' => "icon-signal",
				'name' => "All Staffs"
			);
			$this->set('page_title',$page_title);

			$this->paginate = array(
				'limit' => 15, 
				'order'=>'User.last_login desc', 
				'recursive'=>1, 
				'conditions' => array(
					'User.user_group_id' => 1
				)
			);
			$users = $this->paginate('User');
			$this->set('users', $users);
			
			if($this->RequestHandler->isAjax()) {
				$this->layout = 'ajax';
				$this->render('admin_listing');
			}
		}

		/**
		* STAFF :: Registered Client listing
		*/
		public function client_listing() {
			//Layout
			$this->layout = "staff.dashboard";
			//Page title
			$page_title = array(
				'icon' => "icon-signal",
				'name' => "All Client"
			);
			$this->set('page_title',$page_title);

			$this->paginate = array(
				'limit' => 15, 
				'order'=>'User.last_login desc', 
				'recursive'=>1, 
				'conditions' => array(
					'User.user_group_id' => 2
				)
			);
			$users = $this->paginate('User');
			$this->set('users', $users);
			
			if($this->RequestHandler->isAjax()) {
				$this->layout = 'ajax';
				$this->render('client_listing');
			}
		}

		/**
		* STAFF :: Registered Client listing
		*/
		public function client_profile() {
			//Layout
			$this->layout = "staff.dashboard";
			//Page title
			$page_title = array(
				'icon' => "icon-signal",
				'name' => "Client Profile"
			);
			$this->set('page_title',$page_title);


			//Dapatkan info tentang registered info
			if(!empty($this->request->params['named']['name'])){
				$username = $this->request->params['named']['name'];
				$user = $this->User->findByUsername($username);
				$this->set('user', $user);
			} else if(!empty($this->request->params['named']['email'])){
				$email = $this->request->params['named']['email'];
				$user = $this->User->findByEmail($email);
				$this->set('user', $user);
			}

			//Dapatkan info wallet client
			$vacc = $this->Vault->getAccBalance($user['User']['id']);
			$this->set('acc1', $vacc['Vault']['acc_1']);
			$this->set('acc2', $vacc['Vault']['acc_2']);

			//Dapatkan senarai trading account
			$tradeAcc = $this->Mt4User->listTradeAcc($user['User']['email']);
			$this->set('tradeTracc', $tradeAcc);

			//Dapatkan senarai affilliate jika ada
			$acc = $this->Mt4User->find('all', array(
				'conditions' =>array(
					'Mt4User.EMAIL' => $user['User']['email'],
					#'Mt4User.EMAIL' => "me@arif.my", //Test Account
					'Mt4User.GROUP LIKE' => '%Aff%'
				)
			));
			$this->set('tradeAgacc',$acc);

			
			//list with paginate all transaction history
			$this->paginate = array(
				'order' => 'VaultTransaction.created DESC',
				'limit' => 10,
				'conditions' =>array(
					'VaultTransaction.vault_id' => $vacc['Vault']['id'],
			));
			$Wtransact = $this->paginate('VaultTransaction');
			#debug($Wtransact); die();
			$this->set('Wtransact',$Wtransact);
			if($this->RequestHandler->isAjax()) {
				$this->layout = 'ajax';
				$this->render('client_profile');
			}
			
		}

		/**
		* STAFF :: Accounts listing
		*/
		public function search_tracc() {
			//Layout
			$this->layout = "staff.dashboard";
			//Page title
			$page_title = array(
				'icon' => "icon-signal",
				'name' => "Search Trading Accounts"
			);
			$this->set('page_title',$page_title);
		}

		/**
		* STAFF :: Accounts listing
		*/
		public function tracc_listing() {
			//Layout
			$this->layout = "staff.dashboard";
			//Page title
			$page_title = array(
				'icon' => "icon-signal",
				'name' => "All Trading Accounts"
			);
			$this->set('page_title',$page_title);

			//Paginate Trader Accounts Listing
			$this->paginate = array(
				'limit' => 35, 
				'order'=> 'Mt4User.REGDATE DESC',
				'recursive'=>0,
				'conditions' =>array(
					'Mt4User.GROUP LIKE' => '%IK%',
				)
			);
			$trades = $this->paginate('Mt4User');
			$this->set('MT_ACC',$trades);

			if($this->RequestHandler->isAjax()) {
				$this->layout = 'ajax';
				$this->render('tracc_listing');
			}
		}

		/**
		* STAFF :: Inactive
		*/
		public function tracc_inactive_listing() {
			//Layout
			$this->layout = "staff.dashboard";
			//Page title
			$page_title = array(
				'icon' => "icon-signal",
				'name' => "All Inactive Accounts"
			);
			$this->set('page_title',$page_title);

			//Paginate Trader Accounts Listing
			$this->paginate = array(
				'limit' => 35, 
				'order'=> 'Mt4User.MODIFY_TIME DESC',
				'recursive'=>0,
				'conditions' =>array(
					'Mt4User.GROUP LIKE' => '%Z-%',
				)
			);
			$trades = $this->paginate('Mt4User');
			$this->set('MT_ACC',$trades);

			if($this->RequestHandler->isAjax()) {
				$this->layout = 'ajax';
				$this->render('tracc_inactive_listing');
			}
		}

		/***
		* Staff :: carian untuk Tracc History
		***/

		public function cariTracc(){
			$cari = $this->request->data['Staff']['tracc_no'];
			if($cari){
				//check if this is a valid trading account
				$traccNo = $this->Mt4User->find('first', 
					array(
						'recursive'=>-1,
						'conditions' =>array(
							'Mt4User.LOGIN LIKE' => $cari,
							'Mt4User.GROUP LIKE' => '%IK%'
						),
						'fields' => array('Mt4User.LOGIN')
					));
				if(empty($traccNo)){
					$this->Session->setFlash(__('Trading Account Number search return empty result .'),'default',array('class' => 'error'));
					$this->redirect('tracc_listing');
				} else {
					$this->redirect('tracc_history/process:'.$cari);
				}
			} else {
				$this->redirect($this->referer());
			}
		}

		/***
		* Staff :: carian untuk Inactive Account
		***/

		public function cariTraccInactive(){
			$cari = $this->request->data['Staff']['tracc_no'];
			if($cari){
				//check if this is a valid trading account
				$traccNo = $this->Mt4User->find('first', 
					array(
						'recursive'=>-1,
						'conditions' =>array(
							'Mt4User.LOGIN LIKE' => $cari,
							'Mt4User.GROUP LIKE' => '%Z-%'
						),
						'fields' => array('Mt4User.LOGIN')
					));
				if(empty($traccNo)){
					$this->Session->setFlash(__('Trading Account Number search return empty result .'),'default',array('class' => 'error'));
					$this->redirect('tracc_listing');
				} else {
					$this->redirect('tracc_history/process:'.$cari);
				}
			} else {
				$this->redirect($this->referer());
			}
		}

		/***
		* Staff :: carian untuk Agacc History
		***/

		public function cariAgacc(){
			$cari = $this->request->data['Staff']['tracc_no'];
			if($cari){
				//check if this is a valid trading account
				$traccNo = $this->Mt4User->find('first', 
					array(
						'recursive'=>-1,
						'conditions' =>array(
							'Mt4User.LOGIN LIKE' => $cari,
							'Mt4User.GROUP LIKE' => '%Aff%'
						),
						'fields' => array('Mt4User.LOGIN')
					));
				if(empty($traccNo)){
					$this->Session->setFlash(__('Agent Account Number search return empty result .'),'default',array('class' => 'error'));
					$this->redirect('agent_listing');
				} else {
					$this->redirect('agent_history/process:'.$cari);
				}
			} else {
				$this->redirect($this->referer());
			}
		}

		/***
		* Staff :: carian untuk Tracc History
		***/

		public function cariClient(){
			$cari = $this->request->data['Staff']['email'];
			if($cari){
				//check if this is a valid trading account
				$email = $this->User->findByEmail($cari);
				if(empty($email)){
					$this->Session->setFlash(__('Email address search return empty result .'),'default',array('class' => 'error'));
					$this->redirect('client_listing');
				} else {
					$this->redirect('client_profile/email:'.$cari);
				}
				
			} else {
				$this->redirect($this->referer());
			}
		}

		/***
		* Partner :: request kira total trading account bawah satu email
		***/

		public function kiraAccBawahTracc(){
			$this->layout = "ajax";
			$email = $this->request->params['named']['siapa'];
			$TotalTraccship = $this->Mt4User->kiraAccBawahTracc($email);
			if ($this->request->is('requested')) {
				return $TotalTraccship;
			} else {
				$this->set('TotalTraccship', $TotalTraccship);
			}
		}

		/***
		* Partner :: request kira total agent account bawah satu email
		***/

		public function kiraAgentBawahTracc(){
			$this->layout = "ajax";
			$email = $this->request->params['named']['siapa'];
			$TotalAgentship = $this->Mt4User->kiraAgentBawahTracc($email);
			if ($this->request->is('requested')) {
				return $TotalAgentship;
			} else {
				$this->set('TotalAgentship', $TotalAgentship);
			}
		}

		/******
		* STAFF :: Tracc History
		******/
		public function tracc_history(){
			//start cari agent ID
			$tracc_id = $this->request->params['named']['process'];

			//Layout
			$this->layout = "staff.dashboard";
			//Page title
			$page_title = array(
				'icon' => "icon-group",
				'name' => "Accounts #".$tracc_id." History"
			);
			$this->set('page_title',$page_title);

			//dapatkan details traders
			if(!empty($tracc_id)){
				$result = $this->Mt4User->tentangDiri($tracc_id);
				$this->set('userDetail', $result);

				$traderOpenPost = $this->Mt4Trade->traderOpenPost($tracc_id);
				$this->set('traderOpenPost', $traderOpenPost);

				$traderClosePost = $this->Mt4Trade->traderClosePost($tracc_id);
				$this->set('traderClosePost', $traderClosePost);

				$traderTradeVol = $this->Mt4Trade->traderTradeVol($tracc_id);
				$this->set('traderTradeVol', $traderTradeVol);
			}

			//listing downline
			$downlines = $this->Mt4User->listingDownline($tracc_id);
			$this->set('downlines', $downlines);

			//Paginate Trader Accounts Listing
			$this->paginate = array(
				'limit' => 35, 
				'order'=> 'Mt4Trade.MODIFY_TIME DESC',
				'recursive'=>0,
				'conditions' =>array(
					'Mt4Trade.LOGIN LIKE' => $tracc_id,
				)
			);
			$trades = $this->paginate('Mt4Trade');

			if(!empty($trades)){
				$this->set('agentPost',$trades);	
			} else {
				$this->Session->setFlash(__($tracc_id.' Trading Account History need some transactions to display beautifully !'),'default',array('class' => 'error'));
				$this->redirect('tracc_listing');
			}
			

			if($this->RequestHandler->isAjax()) {
				$this->layout = 'ajax';
				$this->render('tracc_history');
			}
		}

		/**
		* STAFF :: Partner Accounts listing
		*/
		public function partner_listing() {
			//Layout
			$this->layout = "staff.dashboard";
			//Page title
			$page_title = array(
				'icon' => "icon-signal",
				'name' => "All Partner Accounts"
			);
			$this->set('page_title',$page_title);

			//Paginate Trader Accounts Listing
			$this->paginate = array(
				'limit' => 10, 
				'order'=> 'Mt4User.BALANCE DESC',
				'recursive'=>0,
				'conditions' =>array(
					'Mt4User.COMMENT LIKE' => '%ML%',
					'Mt4User.LOGIN LIKE' => '88%',
				)
			);
			$trades = $this->paginate('Mt4User');
			#debug($trades); die();
			$this->set('MT_ACC',$trades);

			if($this->RequestHandler->isAjax()) {
				$this->layout = 'ajax';
				$this->render('partner_listing');
			}
		}

		/**
		* STAFF :: Partner Accounts history
		*/
		public function partner_history() {
			//start cari agent ID
			$tracc_id = $this->request->params['named']['process'];

			//Layout
			$this->layout = "staff.dashboard";
			//Page title
			$page_title = array(
				'icon' => "icon-group",
				'name' => "Agent #".$tracc_id." History"
			);
			$this->set('page_title',$page_title);

			$bakiAcc = $this->Mt4User->bakiAcc($tracc_id);
			$this->set('nama_agent',$bakiAcc['Mt4User']['NAME']);
			$this->set('bakiAcc',$bakiAcc['Mt4User']['BALANCE']);

			//listing downline
			$downlines = $this->Mt4User->listingDownline($tracc_id);
			#debug($downlines); die();
			$this->set('downlines', $downlines);

			//Paginate Trader Accounts Listing
			$this->paginate = array(
				'limit' => 35, 
				'order'=> 'Mt4Trade.MODIFY_TIME DESC',
				'recursive'=>0,
				'conditions' =>array(
					'Mt4Trade.LOGIN LIKE' => $tracc_id,
				)
			);
			$trades = $this->paginate('Mt4Trade');
			$this->set('agentPost',$trades);

			if($this->RequestHandler->isAjax()) {
				$this->layout = 'ajax';
				$this->render('partner_history');
			}
		}

		/**
		* STAFF :: Agent Accounts listing
		*/
		public function agent_listing() {
			//Layout
			$this->layout = "staff.dashboard";
			//Page title
			$page_title = array(
				'icon' => "icon-signal",
				'name' => "All Agent Accounts"
			);
			$this->set('page_title',$page_title);

			//Paginate Trader Accounts Listing
			$this->paginate = array(
				'limit' => 15, 
				'order'=> 'Mt4User.BALANCE DESC',
				'recursive'=>0,
				'conditions' =>array(
					'Mt4User.GROUP LIKE' => '%Aff%',
				)
			);
			$trades = $this->paginate('Mt4User');
			$this->set('MT_ACC',$trades);

			if($this->RequestHandler->isAjax()) {
				$this->layout = 'ajax';
				$this->render('agent_listing');
			}
		}

		/**
		* STAFF :: Agent Accounts history
		*/
		public function agent_history() {
			//start cari agent ID
			$tracc_id = $this->request->params['named']['process'];

			//Layout
			$this->layout = "staff.dashboard";
			//Page title
			$page_title = array(
				'icon' => "icon-group",
				'name' => "Agent #".$tracc_id." History"
			);
			$this->set('page_title',$page_title);

			$bakiAcc = $this->Mt4User->bakiAcc($tracc_id);
			$this->set('nama_agent',$bakiAcc['Mt4User']['NAME']);
			$this->set('email_agent',$bakiAcc['Mt4User']['EMAIL']);
			$this->set('bakiAcc',$bakiAcc['Mt4User']['BALANCE']);

			//listing downline
			$downlines = $this->Mt4User->listingDownline($tracc_id);
			#debug($downlines); die();
			$this->set('downlines', $downlines);

			//Paginate Trader Accounts Listing
			$this->paginate = array(
				'limit' => 35, 
				'order'=> 'Mt4Trade.MODIFY_TIME DESC',
				'recursive'=>0,
				'conditions' =>array(
					'Mt4Trade.LOGIN LIKE' => $tracc_id,
				)
			);
			$trades = $this->paginate('Mt4Trade');
			$this->set('agentPost',$trades);

			if($this->RequestHandler->isAjax()) {
				$this->layout = 'ajax';
				$this->render('agent_history');
			}
		}

		/**
		* STAFF : Listing Semua Open Position
		***/
		public function semua_open_post(){
			
			//Layout
			$this->layout = "staff.dashboard";
			//Page title
			$page_title = array(
				'icon' => "icon-spinner",
				'name' => "All Open Posts"
			);
			$this->set('page_title',$page_title);

			$time = "1970-01-01 00:00:00";
			#debug($time);die();
			$this->paginate = array(
				'limit' => 30, 
				'order'=> 'Mt4Trade.OPEN_TIME DESC',
				'recursive'=>0,
				'conditions' => array(
					'CLOSE_TIME' => $time,
				)
			);
			$openPost = $this->paginate('Mt4Trade');
			#debug($openPost);die();
			$this->set('openPost',$openPost);

			if($this->RequestHandler->isAjax()) {
				$this->layout = 'ajax';
				$this->render('semua_open_post');
			}
		}

		
		/**
		* STAFF :: Client Wallet listing
		*/
		public function wallet_listing() {
			//Layout
			$this->layout = "staff.dashboard";
			//Page title
			$page_title = array(
				'icon' => "icon-signal",
				'name' => "Client Wallets"
			);
			$this->set('page_title',$page_title);

			//Paginate Trader Accounts Listing
			$this->paginate = array(
				'limit' => 20, 
				'order'=> 'Vault.acc_1 DESC',
				'conditions' => array(
					'Vault.partner' => 0
				)
			);
			$records = $this->paginate('Vault');
			#debug($records); die();
			$this->set('TRwallet',$records);

			if($this->RequestHandler->isAjax()) {
				$this->layout = 'ajax';
				$this->render('wallet_listing');
			}
		}

		/**
		* STAFF :: Partner Vault listing
		*/
		public function vault_listing() {
			//Layout
			$this->layout = "staff.dashboard";
			//Page title
			$page_title = array(
				'icon' => "icon-signal",
				'name' => "Partner Vaults"
			);
			$this->set('page_title',$page_title);

			//Paginate Trader Accounts Listing
			$this->paginate = array(
				'limit' => 20, 
				'order'=> 'Vault.acc_1 DESC',
				'conditions' => array(
					'Vault.partner' => 1
				)
			);
			$records = $this->paginate('Vault');
			$this->set('PRvault',$records);

			if($this->RequestHandler->isAjax()) {
				$this->layout = 'ajax';
				$this->render('vault_listing');
			}
		}

		/**
		* Staff :: Transfer Main Window
		*
		*/
		public function wallet_statement() {

			//Layout
			$this->layout = "staff.dashboard";
			//Page title
			$page_title = array(
				'icon' => "icon-money",
				'name' => "Wallet Statement"
			);
			$this->set('page_title',$page_title);

			//check for param request
			$filter = $this->params->named['process'];
			$uid = $this->params->named['uid'];
			#debug($filter); die();
			if(!empty($filter)){
				//list with paginate all pending request
				$this->paginate = array(
					'order' => 'VaultTransaction.created DESC',
					'limit' => 35,
					'recursive' => -1,
					'conditions' => array('VaultTransaction.vault_id' => $filter)
				);

				$Wtransact = $this->paginate('VaultTransaction');
				
				$this->set('Wtransact',$Wtransact);

				if($this->RequestHandler->isAjax()) {
					$this->layout = 'ajax';
					$this->render('wallet_statement');
				}
			} else {
				$this->Session->setFlash(__('Sorry :( Error publishing records.'),'default',array('class' => 'error'));
				$this->redirect(array('action' => 'backoffice'));
			}


			if(!empty($uid)){
				$result = $this->User->getUserNamePixById($uid);
				$this->set('userDetail', $result);
			}
			

		}

		/**
		* STAFF : Kira Semua Open Position
		***/
		public function JumlahActiveWallets(){
			$this->layout = "ajax";
			if($this->UserAuth->isLogged()){
				$total = $this->Vault->find('count',
					array(
						'recursive'=>0,
						'conditions' => array(
							'Vault.acc_1 >' => 0,
							'Vault.partner' => 0
						)
					)
				);
				if ($this->request->is('requested')) {
					return $total;
				} else {
					$this->set('JumlahActiveWallets', $total);
				}
			}
		}

		/**
		* STAFF : Kira Semua Open Position
		***/
		public function JumlahActiveVaults(){
			$this->layout = "ajax";
			if($this->UserAuth->isLogged()){
				$total = $this->Vault->find('count',
					array(
						'recursive'=>0,
						'conditions' => array(
							'Vault.acc_1 >' => 0,
							'Vault.partner' => 1
						)
					)
				);
				if ($this->request->is('requested')) {
					return $total;
				} else {
					$this->set('JumlahActiveWallets', $total);
				}
			}
		}

		/**
		* STAFF : Kira Semua Open Position
		***/
		public function JumlahOpenPost(){
			$this->layout = "ajax";
			if($this->UserAuth->isLogged()){
				$time = "1970-01-01 00:00:00";
				$total = $this->Mt4Trade->find('count',
					array(
						'order'=> 'Mt4Trade.OPEN_TIME DESC',
						'recursive'=>0,
						'conditions' => array(
							'CLOSE_TIME' => $time,
							'Mt4User.GROUP LIKE' => '%IK%'
						)
					)
				);
				if ($this->request->is('requested')) {
					return $total;
				} else {
					$this->set('JumlahOpenPost', $total);
				}
			}
		}
		

		/**
		* STAFF : Kira Semua Close Position
		***/
		public function JumlahClosePost(){
			$this->layout = "ajax";
			if($this->UserAuth->isLogged()){
				App::uses('CakeTime', 'Utility');
				$date = strtotime('today');
				$time = "1970-01-01 00:00:00";
				$tempoh = CakeTime::daysAsSql($time,$date, 'CLOSE_TIME');
				$total = $this->Mt4Trade->find('count', array(
					'conditions' => array(
		        		$tempoh,
		        		'SYMBOL NOT' => '',
		        		'Mt4User.GROUP LIKE' => '%IK%'
			        ),
				));
				#debug($total); die();

				if ($this->request->is('requested')) {
					return $total;
				} else {
					$this->set('JumlahClosePost', $total);
				}
			}
		}

		/**
		* STAFF : Kira Semua Total Deposit
		***/
		public function JumlahDeposit(){
			$this->layout = "ajax";
			if($this->UserAuth->isLogged()){

				$total = $this->Mt4Trade->find('all', array(
					'conditions' => array(
		        		'Mt4Trade.COMMENT LIKE' => '%DP%',
						'Mt4Trade.CMD' => '6',
						'Mt4User.GROUP LIKE' => '%IK%',
						'Mt4Trade.PROFIT NOT LIKE' => '%-%'

			        ),
			        'fields' => array(
						'sum(PROFIT) AS total'
					)
				));
				#debug($total); die();

				if ($this->request->is('requested')) {
					return $total[0][0]['total'];
				} else {
					$this->set('JumlahDeposit', $total[0][0]['total']);
				}
			}
		}

		/**
		* STAFF : Kira Semua Total Withdrawal
		***/
		public function JumlahWithdrawal(){
			$this->layout = "ajax";
			if($this->UserAuth->isLogged()){
				$total = $this->Mt4Trade->find('all', array(
					'conditions' => array(
		        		'Mt4Trade.COMMENT LIKE' => '%WD%',
						'Mt4Trade.CMD' => '6',
						'Mt4User.GROUP LIKE' => '%IK%',
						'Mt4Trade.PROFIT LIKE' => '%-%'
			        ),
			        'fields' => array(
						'sum(PROFIT) AS total'
					)
				));
				#debug($total); die();

				if ($this->request->is('requested')) {
					return $total[0][0]['total'];
				} else {
					$this->set('JumlahWithdrawal', $total[0][0]['total']);
				}
			}
		}

		/**
		* STAFF : Kira Semua Total Rebate Loss
		***/
		public function JumlahRebateLoss(){
			$this->layout = "ajax";
			if($this->UserAuth->isLogged()){
				$total = $this->Mt4Trade->find('all', array(
					'conditions' => array(
		        		'Mt4Trade.COMMENT LIKE' => '%Rebate #Loss%'
			        ),
			        'fields' => array(
						'sum(PROFIT) AS total'
					)
				));
				#debug($total); die();

				if ($this->request->is('requested')) {
					return $total[0][0]['total'];
				} else {
					$this->set('JumlahRebateLoss', $total[0][0]['total']);
				}
			}
		}


		/**
		* STAFF : Kira Semua Total Rebate Profit
		***/
		public function JumlahRebateProfit(){
			$this->layout = "ajax";
			if($this->UserAuth->isLogged()){
				$total = $this->Mt4Trade->find('all', array(
					'conditions' => array(
		        		'Mt4Trade.COMMENT LIKE' => '%Rebate #Profit%'
			        ),
			        'fields' => array(
						'sum(PROFIT) AS total'
					)
				));
				#debug($total); die();

				if ($this->request->is('requested')) {
					return $total[0][0]['total'];
				} else {
					$this->set('JumlahRebateProfit', $total[0][0]['total']);
				}
			}
		}

		/**
		* STAFF : Kira Semua Total commission affiliate
		***/
		public function JumlahCommission(){
			$this->layout = "ajax";
			if($this->UserAuth->isLogged()){
				$total = $this->Mt4Trade->find('all', array(
			        'conditions' => array(
			        	'Mt4Trade.COMMENT LIKE' => '%agent%'
					),
			        'fields' => array(
						'sum(PROFIT) AS total'
					)
				));
				#debug($total); die();

				if ($this->request->is('requested')) {
					return $total[0][0]['total'];
				} else {
					$this->set('JumlahCommission', $total[0][0]['total']);
				}
			}
		}

		/**
		* STAFF : Kira Semua Total commission partner
		***/
		public function JumlahCommissionPartner(){
			$this->layout = "ajax";
			if($this->UserAuth->isLogged()){
				$total = $this->Mt4Trade->find('all', array(
			        'conditions' => array(
						'Mt4Trade.COMMENT LIKE' => '%comm%'
					),
			        'fields' => array(
						'sum(PROFIT) AS total'
					)
				));
				#debug($total); die();

				if ($this->request->is('requested')) {
					return $total[0][0]['total'];
				} else {
					$this->set('JumlahCommissionPartner', $total[0][0]['total']);
				}
			}
		}
		


		/**
		* STAFF :: Deposit Main Window
		*
		*/
		public function deposit_request() {

			//Layout
			$this->layout = "staff.dashboard";
			//Page title
			$page_title = array(
				'icon' => "icon-money",
				'name' => "Deposit Request"
			);
			$this->set('page_title',$page_title);

		}

		/**
		* Staff :: Withdraw Main Window
		*
		*/
		public function withdrawal_request() {

			//Layout
			$this->layout = "staff.dashboard";
			//Page title
			$page_title = array(
				'icon' => "icon-money",
				'name' => "Withdrawal Request"
			);
			$this->set('page_title',$page_title);

		}

		/**
		* Staff :: Transfer Main Window
		*
		*/
		public function transfer_request() {

			//Layout
			$this->layout = "staff.dashboard";
			//Page title
			$page_title = array(
				'icon' => "icon-money",
				'name' => "Transfer Request"
			);
			$this->set('page_title',$page_title);

			//check for param request
			$filter = $this->params->named['filter'];
			#debug($filter); die();
			if($filter == 'pending'){
				//list with paginate all pending request
				$this->paginate = array(
					'order' => 'VaultTransaction.created DESC',
					'limit' => 35,
					'recursive' => 2,
					'conditions' => array('VaultTransaction.status' => 2)
				);

				$this->set('filter' , $filter);
			} else if($filter == 'approve'){
				//list with paginate all approved
				$this->paginate = array(
					'order' => 'VaultTransaction.created DESC',
					'limit' => 35,
					'recursive' => 2,
					'conditions' => array('VaultTransaction.status' => 3)
				);
				$this->set('filter' , $filter);
			} else if($filter == 'decline'){
				//list with paginate all declined
				$this->paginate = array(
					'order' => 'VaultTransaction.created DESC',
					'limit' => 35,
					'recursive' => 2,
					'conditions' => array('VaultTransaction.status' => 4)
				);
				$this->set('filter' , $filter);
			} else if($filter == 'new'){
				//list with paginate all transaction history
				$this->paginate = array(
					'order' => 'VaultTransaction.created DESC',
					'limit' => 35,
					'recursive' => 2,
					'conditions' => array('VaultTransaction.status' => 1)
				);
				$this->set('filter' , $filter);
			}
			
			$Wtransact = $this->paginate('VaultTransaction');
			$this->set('Wtransact',$Wtransact);

			if($this->RequestHandler->isAjax()) {
				$this->layout = 'ajax';
				$this->render('transfer_request');
			}

		}

		/**
		* Staff :: Transfer Detail Main Window
		*
		*/
		public function transfer_detail() {

			//check for param request
			#debug($this->request->params['named']['process']); die();
			if($this->request->params['named']['process'] == null){
				//jika kosong hantar terus ke page listing
				$this->Session->setFlash(__('Sorry :( Invalid Transaction.'),'default',array('class' => 'error'));
				$this->redirect(array('action' => 'transfer_request/filter:new'));
			} else {
				//Layout
				$this->layout = "staff.dashboard";
				//Page title
				$page_title = array(
					'icon' => "icon-money",
					'name' => "Transfer Detail"
				);
				$this->set('page_title',$page_title);

				//start cari details of transactions
				$vt_id = $this->request->params['named']['process'];
				$details = $this->VaultTransaction->find('first', array(
					'conditions' => array(
						'VaultTransaction.id' => $vt_id
					),
				));
				$this->set('TranDetails', $details);

				//dapatkan baki account semasa
				$bakiTracc = $this->Mt4User->bakiAcc($details['VaultTransaction']['tracc_no']);
				#debug($bakiTracc); die(); 
				$this->set('bakiTracc', $bakiTracc['Mt4User']);

				//call in user details tambahan
				$userId = $details['Vault']['user_id'];
				$user =$this->User->getUserById($userId);
				$this->set('userDetails',$user);
			}

		}

		/*****
		* STAFF :: Change status on the transaction for type code 1
		******/
		public function updateTransactionStatus_code1(){
			
			#setiap status update params
			$status = $this->request->data['Staff']['status'];
			$transId = $this->request->data['Staff']['transid'];
			$jumlah = $this->request->data['Staff']['jumlah'];
			$userId = $this->request->data['Staff']['userId'];
			$staffId = $this->request->data['Staff']['staffId'];
			$traccId = $this->request->data['Staff']['traccId'];

			## > update status field at VaultTransaction
			$data = array('status' => $status);
			$this->VaultTransaction->id = $transId;
			$this->VaultTransaction->save($data);

			## > add comment to VaultTransactionComment
			$message = $status;
			switch ($message){
				case "1":
				$message = "Status have been updated to NEW request.";
				break;
				case "2":
				$message = "We have received your request and proceeding within 24 hours time. Balance & status have been updated to PENDING for processing request. ";
				break;
				case "3":
				$message = "Congratulations ! Your transfer request have been APPROVED.";
				break;
				case "4":
				$message = "Sorry ! Your transfer request have been DECLINED. Please contact our finance department for further info.";
				break;
			};

			$data = array(
				'vault_transaction_id' => $transId,
				'comment' => "$message",
				'user_id' => $staffId
			);
			$this->VaultTransactionComment->create();
			$this->VaultTransactionComment->save($data);

			#initiate finance process
			//Jika status = 2
			## > deduct duit dari wallet 
			## > update acc1 field at Vault
			if($status == 2){
				$vaultId = $this->Vault->find('first', array(
					'conditions' =>array(
						'user_id' => $userId,
					),
					'recursive' => -1
				));

				$new_balance = $vaultId['Vault']['acc_1'] - $jumlah;
				$id = $vaultId['Vault']['id'];
				
				//update field
				$this->Vault->updateAll(
					array('Vault.acc_1' => $new_balance),
					array('Vault.id' => $id),
					array('Vault.user_id' => $userId)
				);
				
			}

			//Jika status = 4
			## > refund semula ke dalam IK Wallet
			if($status == 4){
				$vaultId = $this->Vault->find('first', array(
					'conditions' =>array(
						'user_id' => $userId,
					)
				));
				$new_balance = $vaultId['Vault']['acc_1'] + $jumlah;
				$id = $vaultId['Vault']['id'];
				
				//update field
				$this->Vault->updateAll(
					array('Vault.acc_1' => $new_balance),
					array('Vault.id' => $id),
					array('Vault.user_id' => $userId)
				);

				#$data = array('acc_1' => $new_balance);
				#$this->Vault->id = $vaultId['Vault']['id'];
				#$this->Vault->save($data);
			}

			//Jika status = 3
			## > run proc_WT_TRACC 
			if($status == 3){
				$data = array(
				'traccId' => $traccId,
				'tambahJumlah' => $jumlah,
				'type' => "WT TRACC",
				);
				#debug($data); die();
				$process = $this->addBalTracc($data);
				$this->log("WT PRACC, ".$jumlah, 'mt4Balance');
			}

			## > sent email status update to finance & user email

			## > sent session flash and back to reffered page
			$this->Session->setFlash(__('Status for transaction #'.$transId.' updated.'),'default',array('class' => 'success'));
			$this->redirect($this->referer());
		}

		/*****
		* STAFF :: Change status on the transaction for type code 10
		******/
		public function updateTransactionStatus_code10(){
			
			#setiap status update params
			$status = $this->request->data['Staff']['status'];
			$transId = $this->request->data['Staff']['transid'];
			$jumlah = $this->request->data['Staff']['jumlah'];
			$userId = $this->request->data['Staff']['userId'];
			$staffId = $this->request->data['Staff']['staffId'];
			$traccId = $this->request->data['Staff']['traccId'];

			## > update status field at VaultTransaction
			$data = array('status' => $status);
			$this->VaultTransaction->id = $transId;
			$this->VaultTransaction->save($data);

			## > add comment to VaultTransactionComment
			$message = $status;
			switch ($message){
				case "1":
				$message = "Status have been updated to NEW request.";
				break;
				case "2":
				$message = "We have received your request and proceeding within 24 hours time. Status have been updated to PENDING for processing request.";
				break;
				case "3":
				$message = "Congratulations ! Your transfer request have been APPROVED.";
				break;
				case "4":
				$message = "Sorry ! Your transfer request have been DECLINED. Please contact our finance department for further info.";
				break;
			};

			$data = array(
				'vault_transaction_id' => $transId,
				'comment' => "$message",
				'user_id' => $staffId
			);
			$this->VaultTransactionComment->create();
			$this->VaultTransactionComment->save($data);

			#initiate finance process
			//Jika status = 2
			## > deduct duit dari wallet 
			## > update acc1 field at Vault
			if($status == 2){
				$vaultId = $this->Vault->find('first', array(
					'conditions' =>array(
						'user_id' => $userId,
					),
					'recursive' => -1
				));

				$new_balance = $vaultId['Vault']['acc_1'] - $jumlah;
				$id = $vaultId['Vault']['id'];
				
				//update field
				$this->Vault->updateAll(
					array('Vault.acc_1' => $new_balance),
					array('Vault.id' => $id),
					array('Vault.user_id' => $userId)
				);
			}

			//Jika status = 4
			## > refund semula ke dalam IK Wallet
			if($status == 4){
				$vaultId = $this->Vault->find('first', array(
					'conditions' =>array(
						'user_id' => $userId,
					)
				));
				$new_balance = $vaultId['Vault']['acc_1'] + $jumlah;
				$id = $vaultId['Vault']['id'];
				
				//update field
				$this->Vault->updateAll(
					array('Vault.acc_1' => $new_balance),
					array('Vault.id' => $id),
					array('Vault.user_id' => $userId)
				);
			}

			//Jika status = 3
			## > run proc_WT_TRACC 
			if($status == 3){
				$data = array(
				'traccId' => $traccId,
				'tambahJumlah' => $jumlah,
				'type' => "VT PRACC",
				);
				#debug($data); die();
				$process = $this->addBalTracc($data);
				$this->log("VT PRACC, ".$jumlah, 'mt4Balance');
			}

			## > sent email status update to finance & user email

			## > sent session flash and back to reffered page
			$this->Session->setFlash(__('Status for transaction #'.$transId.' updated.'),'default',array('class' => 'success'));
			$this->redirect($this->referer());
		}

		/*****
		* STAFF :: Change status on the transaction for type code 4
		******/
		public function updateTransactionStatus_code4(){
			
			#setiap status update params
			$status = $this->request->data['Staff']['status'];
			$transId = $this->request->data['Staff']['transid'];
			$jumlah = $this->request->data['Staff']['jumlah'];
			$userId = $this->request->data['Staff']['userId'];
			$staffId = $this->request->data['Staff']['staffId'];
			$traccId = $this->request->data['Staff']['traccId'];

			## > update status field at VaultTransaction
			$data = array('status' => $status);
			$this->VaultTransaction->id = $transId;
			$this->VaultTransaction->save($data);

			## > add comment to VaultTransactionComment
			$message = $status;
			switch ($message){
				case "1":
				$message = "Status have been updated to NEW request.";
				break;
				case "2":
				$message = "We have received your request and proceeding within 24 hours time. Balance & Status have been updated to PENDING for processing request.";
				break;
				case "3":
				$message = "Congratulations ! Your transfer request have been APPROVED.";
				break;
				case "4":
				$message = "Sorry ! Your transfer request have been DECLINED. Please contact our finance department for further info.";
				break;
			};

			$data = array(
				'vault_transaction_id' => $transId,
				'comment' => "$message",
				'user_id' => $staffId
			);
			$this->VaultTransactionComment->create();
			$this->VaultTransactionComment->save($data);

			#initiate finance process
			//Jika status = 2 pending
			## > deduct duit dari acc trading 

			if($status == 2){
				$data = array(
					'traccId' => $traccId,
					'tambahJumlah' => '-'.$jumlah,
					'type' => "WT TRACC",
				);
				#debug($data); die();
				$process = $this->trigBalTracc($data);
				$this->log("WT TRACC, ".$jumlah, 'mt4Balance');
			}

			//Jika status = 4 decline
			## > refund semula ke dalam trading account
			if($status == 4){

				$data = array(
					'traccId' => $traccId,
					'tambahJumlah' => $jumlah,
					'type' => "CANCEL TRACC",
				);
				#debug($data); die();
				$process = $this->trigBalTracc($data);
				$this->log("CANCEL TRACC, ".$jumlah, 'mt4Balance');
			}

			//Jika status = 3 accepted
			## > update acc1 field at Vault
			if($status == 3){
				$vaultId = $this->Vault->find('first', array(
					'conditions' =>array(
						'user_id' => $userId,
					),
					'recursive' => -1
				));

				$new_balance = $vaultId['Vault']['acc_1'] + $jumlah;
				$id = $vaultId['Vault']['id'];
				
				//update field
				$this->Vault->updateAll(
					array('Vault.acc_1' => $new_balance),
					array('Vault.id' => $id),
					array('Vault.user_id' => $userId)
				);
			}

			## > sent email status update to finance & user email

			## > sent session flash and back to reffered page
			$this->Session->setFlash(__('Status for transaction #'.$transId.' updated.'),'default',array('class' => 'success'));
			$this->redirect($this->referer());
		}

		/*****
		* STAFF :: Change status on the transaction for type code 4
		******/
		public function updateTransactionStatus_code40(){
			
			#setiap status update params
			$status = $this->request->data['Staff']['status'];
			$transId = $this->request->data['Staff']['transid'];
			$jumlah = $this->request->data['Staff']['jumlah'];
			$userId = $this->request->data['Staff']['userId'];
			$staffId = $this->request->data['Staff']['staffId'];
			$traccId = $this->request->data['Staff']['traccId'];

			## > update status field at VaultTransaction
			$data = array('status' => $status);
			$this->VaultTransaction->id = $transId;
			$this->VaultTransaction->save($data);

			## > add comment to VaultTransactionComment
			$message = $status;
			switch ($message){
				case "1":
				$message = "Status have been updated to NEW request.";
				break;
				case "2":
				$message = "We have received your request and proceeding within 24 hours time. Status have been updated to PENDING for processing request.";
				break;
				case "3":
				$message = "Congratulations ! Your transfer request have been APPROVED.";
				break;
				case "4":
				$message = "Sorry ! Your transfer request have been DECLINED. Please contact our finance department for further info.";
				break;
			};

			$data = array(
				'vault_transaction_id' => $transId,
				'comment' => "$message",
				'user_id' => $staffId
			);
			$this->VaultTransactionComment->create();
			$this->VaultTransactionComment->save($data);

			#initiate finance process
			//Jika status = 2 pending
			## > deduct duit dari acc trading 

			if($status == 2){
				$data = array(
					'traccId' => $traccId,
					'tambahJumlah' => '-'.$jumlah,
					'type' => "VT PRACC",
				);
				#debug($data); die();
				$process = $this->trigBalTracc($data);
				$this->log("VT PRACC, ".$jumlah, 'mt4Balance');
			}

			//Jika status = 4 decline
			## > refund semula ke dalam trading account
			if($status == 4){

				$data = array(
					'traccId' => $traccId,
					'tambahJumlah' => $jumlah,
					'type' => "CANCEL TRACC",
				);
				#debug($data); die();
				$process = $this->trigBalTracc($data);
				$this->log("CANCEL TRACC, ".$jumlah, 'mt4Balance');
			}

			//Jika status = 3 accepted
			## > update acc1 field at Vault
			if($status == 3){
				$vaultId = $this->Vault->find('first', array(
					'conditions' =>array(
						'user_id' => $userId,
					),
					'recursive' => -1
				));

				$new_balance = $vaultId['Vault']['acc_1'] + $jumlah;
				$id = $vaultId['Vault']['id'];
				
				//update field
				$this->Vault->updateAll(
					array('Vault.acc_1' => $new_balance),
					array('Vault.id' => $id),
					array('Vault.user_id' => $userId)
				);
			}

			## > sent email status update to finance & user email

			## > sent session flash and back to reffered page
			$this->Session->setFlash(__('Status for transaction #'.$transId.' updated.'),'default',array('class' => 'success'));
			$this->redirect($this->referer());
		}


		/*****
		* STAFF :: Dapatkan who is who info
		******/
		public function requestUserInfo(){
			#debug($this->request->requested);
			$this->layout = "ajax";
			$userId = $this->request->params['uid'];
			$result = $this->User->getUserNamePixById($userId);
			return $result;
		}

		/*****
		* STAFF :: Update comment on the transaction
		******/
		public function updateTranComment(){
			#debug($this->request->data); die();
			$this->layout = "ajax";
			if($this->request->data['Staff']){
				$data = array(
					'vault_transaction_id' => $this->request->data['Staff']['vault_transaction_id'],
					'comment' => $this->request->data['Staff']['comment'],
					'user_id' => $this->request->data['Staff']['user_id']
				);
				$this->VaultTransactionComment->create();
				$this->VaultTransactionComment->save($data);
				$this->Session->setFlash(__('Comment for transaction #'.$data['vault_transaction_id'].' updated.'),'default',array('class' => 'success'));
				$this->redirect($this->referer());
			} else {
				$this->redirect($this->referer());
			}

		}

		/***
		* BACKEND balance trigger : Request httpsocket to web gateway +
		****/
		public function addBalTracc($data){

			$randKey = rand(1000000, 9999999);

			App::uses('HttpSocket', 'Network/Http');
			$HttpSocket = new HttpSocket();

			$mt4data = array(
				'cmd' => 'UserChangeBalance',
				'login' => $data['traccId'], 
				'amount' => $data['tambahJumlah'],
				'comment' => $data['type'].' '.$randKey
			);
			
			$results = $HttpSocket->post('http://iktrust.co.uk/webservice/ikwebgateway/triggerBalance.php', $mt4data);

			$what = json_decode($results->body); 
			$this->log('ProcessCode '.$what->result.', #'.$randKey, 'mt4balance');
		}

		/***
		* BACKEND balance trigger : Request httpsocket to web gateway -
		****/
		public function trigBalTracc($data){

			$randKey = rand(1000000, 9999999);

			App::uses('HttpSocket', 'Network/Http');
			$HttpSocket = new HttpSocket();

			$mt4data = array(
				'cmd' => 'UserChangeBalance',
				'login' => $data['traccId'], 
				'amount' => $data['tambahJumlah'],
				'comment' => $data['type'].' '.$randKey
			);
			
			$results = $HttpSocket->post('http://iktrust.co.uk/webservice/ikwebgateway/triggerBalance.php', $mt4data);

			$what = json_decode($results->body); 
			$what = json_decode($results->body); 
			$this->log('ProcessCode '.$what->result.', #'.$randKey, 'mt4balance');
		}

		/***
		*	STAFF :: All Commissions
		****/
		public function report_commission(){

			//Layout
			$this->layout = "staff.dashboard";
			//Page title
			$page_title = array(
				'icon' => "icon-money",
				'name' => "Affilliate Commissions"
			);
			$this->set('page_title',$page_title);

			//Paginate Trader Accounts Listing
			$this->paginate = array(
				'limit' => 35, 
				'order'=> 'Mt4Trade.MODIFY_TIME DESC',
				'recursive'=>0,
				'conditions' =>array(
					'Mt4Trade.COMMENT LIKE' => '%agent%',
				)
			);
			$trades = $this->paginate('Mt4Trade');
			#debug($trades); die();
			$this->set('reportComm',$trades);

			//start loading data to table top
			#Overall Commission
			$t1 = $this->Mt4Trade->OverallComm();
			$this->set('jumlahSemua', $t1);

			#Last Month
			$t2 = $this->Mt4Trade->LastMonthComm();
			$this->set('LastMonthComm', $t2);

			#Last Week
			$t3 = $this->Mt4Trade->LastWeekComm();
			$this->set('LastWeekComm', $t3);

			#Yesterday
			$t4 = $this->Mt4Trade->YesterdayComm();
			$this->set('YesterdayComm', $t4);

			#Today
			$t5 = $this->Mt4Trade->TodayComm();
			$this->set('TodayComm', $t5);

			if($this->RequestHandler->isAjax()) {
				$this->layout = 'ajax';
				$this->render('report_commission');
			}
		}

		/***
		*	STAFF :: All Commissions
		****/
		public function report_commission_partner(){

			//Layout
			$this->layout = "staff.dashboard";
			//Page title
			$page_title = array(
				'icon' => "icon-money",
				'name' => "Partner Commission"
			);
			$this->set('page_title',$page_title);

			//Paginate Trader Accounts Listing
			$this->paginate = array(
				'limit' => 35, 
				'order'=> 'Mt4Trade.MODIFY_TIME DESC',
				'recursive'=>0,
				'conditions' =>array(
					'Mt4Trade.COMMENT LIKE' => '%comm%',
				)
			);
			$trades = $this->paginate('Mt4Trade');
			#debug($trades); die();
			$this->set('reportComm',$trades);

			//start loading data to table top
			#Overall Commission
			$t1 = $this->Mt4Trade->OverallCommPartner();
			$this->set('jumlahSemua', $t1);

			#Last Month
			$t2 = $this->Mt4Trade->LastMonthCommPartner();
			$this->set('LastMonthComm', $t2);

			#Last Week
			$t3 = $this->Mt4Trade->LastWeekCommPartner();
			$this->set('LastWeekComm', $t3);

			#Yesterday
			$t4 = $this->Mt4Trade->YesterdayCommPartner();
			$this->set('YesterdayComm', $t4);

			#Today
			$t5 = $this->Mt4Trade->TodayCommPartner();
			$this->set('TodayComm', $t5);

			if($this->RequestHandler->isAjax()) {
				$this->layout = 'ajax';
				$this->render('report_commission');
			}
		}

		/***
		*	STAFF :: Report rebate profit
		****/
		public function report_rebate_profit(){

			//Layout
			$this->layout = "staff.dashboard";
			//Page title
			$page_title = array(
				'icon' => "icon-money",
				'name' => "Profit Rebates"
			);
			$this->set('page_title',$page_title);

			//Paginate Trader Accounts Listing
			$this->paginate = array(
				'limit' => 35, 
				'order'=> 'Mt4Trade.MODIFY_TIME DESC',
				'recursive'=>0,
				'conditions' =>array(
					'Mt4Trade.COMMENT LIKE' => '%Rebate #Profit%',
				)
			);
			$trades = $this->paginate('Mt4Trade');
			#debug($trades); die();
			$this->set('reportComm',$trades);

			//start loading data to table top
			#Overall Rebate prof
			$t1 = $this->Mt4Trade->OverallRebprof();
			$this->set('OverallRebprof', $t1);

			#Last Month
			$t2 = $this->Mt4Trade->LastMonthRebprof();
			$this->set('LastMonthRebprof', $t2);

			#Last Week
			$t3 = $this->Mt4Trade->LastWeekRebprof();
			$this->set('LastWeekRebprof', $t3);

			#Yesterday
			$t4 = $this->Mt4Trade->YesterdayRebprof();
			$this->set('YesterdayRebprof', $t4);

			#Today
			$t5 = $this->Mt4Trade->TodayRebprof();
			$this->set('TodayRebprof', $t5);

			if($this->RequestHandler->isAjax()) {
				$this->layout = 'ajax';
				$this->render('report_rebate_profit');
			}
		}

		/***
		*	STAFF :: Report rebate loss
		****/
		public function report_rebate_loss(){

			//Layout
			$this->layout = "staff.dashboard";
			//Page title
			$page_title = array(
				'icon' => "icon-money",
				'name' => "Loss Rebate"
			);
			$this->set('page_title',$page_title);

			//Paginate Trader Accounts Listing
			$this->paginate = array(
				'limit' => 35, 
				'order'=> 'Mt4Trade.MODIFY_TIME DESC',
				'recursive'=>0,
				'conditions' =>array(
					'Mt4Trade.COMMENT LIKE' => '%Rebate #Loss%',
				)
			);
			$trades = $this->paginate('Mt4Trade');
			#debug($trades); die();
			$this->set('reportComm',$trades);

			//start loading data to table top
			#Overall Rebate Loss
			$t1 = $this->Mt4Trade->OverallRebloss();
			$this->set('OverallRebloss', $t1);

			#Last Month
			$t2 = $this->Mt4Trade->LastMonthRebloss();
			$this->set('LastMonthRebloss', $t2);

			#Last Week
			$t3 = $this->Mt4Trade->LastWeekRebloss();
			$this->set('LastWeekRebloss', $t3);

			#Yesterday
			$t4 = $this->Mt4Trade->YesterdayRebloss();
			$this->set('YesterdayRebloss', $t4);

			#Today
			$t5 = $this->Mt4Trade->TodayRebloss();
			$this->set('TodayRebloss', $t5);

			if($this->RequestHandler->isAjax()) {
				$this->layout = 'ajax';
				$this->render('report_rebate_loss');
			}
		}

		/***
		*	STAFF :: All Closed Orders
		****/
		public function report_close_order(){
			//Layout
			$this->layout = "staff.dashboard";
			//Page title
			$page_title = array(
				'icon' => "icon-exchange",
				'name' => "Closed Position : Overall"

			);
			$this->set('page_title',$page_title);
			
			//start loading data to table top
			#Overall Close Order (LOSS)
			$t1 = $this->Mt4Trade->OverallLOSS();
			$this->set('OverallLOSS', $t1);

			#Overall Close Order (PROFIT)
			$t2 = $this->Mt4Trade->OverallPROFIT();
			$this->set('OverallPROFIT', $t2);

			#Overall Close Order Last Month(LOSS)
			$t3 = $this->Mt4Trade->OverallLastMonthLOSS();
			$this->set('OverallLastMonthLOSS', $t3);

			#Overall Close Order  Last Month (PROFIT)
			$t4 = $this->Mt4Trade->OverallLastMonthPROFIT();
			$this->set('OverallLastMonthPROFIT', $t4);

			#Overall Close Order Last Week(LOSS)
			$t3 = $this->Mt4Trade->OverallLastWeekLOSS();
			$this->set('OverallLastWeekLOSS', $t3);

			#Overall Close Order  Last Month (PROFIT)
			$t4 = $this->Mt4Trade->OverallLastWeekPROFIT();
			$this->set('OverallLastWeekPROFIT', $t4);

			#Overall Close Order Last Monday(LOSS)
			$t5 = $this->Mt4Trade->LastMondayLOSS();
			$this->set('LastMondayLOSS', $t5);

			#Overall Close Order  Last Monday (PROFIT)
			$t6 = $this->Mt4Trade->LastMondayPROFIT();
			$this->set('LastMondayPROFIT', $t6);

			#Overall Close Order Last Tuesday(LOSS)
			$t7 = $this->Mt4Trade->LastTuesdayLOSS();
			$this->set('LastTuesdayLOSS', $t7);

			#Overall Close Order  Last Tuesday (PROFIT)
			$t8 = $this->Mt4Trade->LastTuesdayPROFIT();
			$this->set('LastTuesdayPROFIT', $t8);

			#Overall Close Order Last Wednesday(LOSS)
			$t9 = $this->Mt4Trade->LastWednesdayLOSS();
			$this->set('LastWednesdayLOSS', $t9);

			#Overall Close Order  Last Wednesday (PROFIT)
			$t10 = $this->Mt4Trade->LastWednesdayPROFIT();
			$this->set('LastWednesdayPROFIT', $t10);

			#Overall Close Order Last Thursday(LOSS)
			$t11 = $this->Mt4Trade->LastThursdayLOSS();
			$this->set('LastThursdayLOSS', $t11);

			#Overall Close Order  Last Thursday (PROFIT)
			$t12 = $this->Mt4Trade->LastThursdayPROFIT();
			$this->set('LastThursdayPROFIT', $t12);

			#Overall Close Order Last Friday(LOSS)
			$t13 = $this->Mt4Trade->LastFridayLOSS();
			$this->set('LastFridayLOSS', $t13);

			#Overall Close Order  Last Friday (PROFIT)
			$t14 = $this->Mt4Trade->LastFridayPROFIT();
			$this->set('LastFridayPROFIT', $t14);


		}

		/***
		*	STAFF :: Yesterday Close Today
		****/
		public function report_close_order_today(){
			//Layout
			$this->layout = "staff.dashboard";
			//Page title
			$page_title = array(
				'icon' => "icon-exchange",
				'name' => "Closed Position : Today"
			);
			$this->set('page_title',$page_title);

			App::uses('CakeTime', 'Utility');
			$today = strtotime('today');
			$tempoh = CakeTime::daysAsSql($today,$today, 'Mt4Trade.CLOSE_TIME');
			#debug($tempoh);
			$this->paginate = array(
		        'conditions' => array(
	        		$tempoh,
	        		'Mt4Trade.SYMBOL NOT' => '',
	        		'Mt4User.GROUP LIKE' => '%IK%'
		        ),
		        'order' => 'Mt4Trade.CLOSE_TIME DESC',
		        'limit' => 50,
	    	);
		    $trades = $this->paginate('Mt4Trade');
			$this->set('reportCloseOrder' , $trades);
			#debug($trades); die();
			if($this->RequestHandler->isAjax()) {
				$this->layout = 'ajax';
				$this->render('report_close_order_today');
			}

		}

		/***
		*	STAFF :: Yesterday Close Orders
		****/
		public function report_close_order_yesterday(){
			//Layout
			$this->layout = "staff.dashboard";
			//Page title
			$page_title = array(
				'icon' => "icon-exchange",
				'name' => "Closed Position : Yesterday"
			);
			$this->set('page_title',$page_title);

			App::uses('CakeTime', 'Utility');
			$yesterday = strtotime('yesterday');
			$tempoh = CakeTime::daysAsSql($yesterday,$yesterday, 'Mt4Trade.CLOSE_TIME');
			#debug($tempoh);
			$this->paginate = array(
		        'conditions' => array(
	        		$tempoh,
	        		'Mt4Trade.SYMBOL NOT' => '',
	        		'Mt4User.GROUP LIKE' => '%IK%'
		        ),
		        'order' => 'Mt4Trade.CLOSE_TIME DESC',
		        'limit' => 50,
	    	);
		    $trades = $this->paginate('Mt4Trade');
			$this->set('reportCloseOrder' , $trades);
			#debug($trades); die();
			if($this->RequestHandler->isAjax()) {
				$this->layout = 'ajax';
				$this->render('report_close_order_yesterday');
			}

		}

		/***
		*	STAFF :: Overall Close Orders
		****/
		public function report_close_order_overall(){
			//Layout
			$this->layout = "staff.dashboard";
			//Page title
			$page_title = array(
				'icon' => "icon-exchange",
				'name' => "Closed Position : Overall"
			);
			$this->set('page_title',$page_title);

			$this->paginate = array(
		        'conditions' => array(
	        		'Mt4Trade.SYMBOL NOT' => '',
	        		'Mt4User.GROUP LIKE' => '%IK%'
		        ),
		        'order' => 'Mt4Trade.CLOSE_TIME DESC',
		        'limit' => 50,
	    	);
		    $trades = $this->paginate('Mt4Trade');
			$this->set('reportCloseOrder' , $trades);
			#debug($trades); die();
			if($this->RequestHandler->isAjax()) {
				$this->layout = 'ajax';
				$this->render('report_close_order_overall');
			}

		}

		/***
		*	STAFF :: Report Deposit
		****/
		public function report_deposit(){
			//Layout
			$this->layout = "staff.dashboard";
			//Page title
			$page_title = array(
				'icon' => "icon-exchange",
				'name' => "All Deposit"
			);
			$this->set('page_title',$page_title);

			$this->paginate = array(
		        'conditions' => array(
	        		'Mt4Trade.COMMENT LIKE' => '%DP%',
					'Mt4Trade.CMD' => '6',
					'Mt4Trade.LOGIN NOT LIKE' => '88%',
					'Mt4Trade.PROFIT NOT LIKE' => '%-%',
					'Mt4User.GROUP LIKE' => '%IK%'
		        ),
		        'order' => 'Mt4Trade.OPEN_TIME DESC',
		        'limit' => 50,
	    	);
		    $trades = $this->paginate('Mt4Trade');
			$this->set('reportDeposit' , $trades);
			#debug($trades); die();
			
			//start loading data to table top
			#Overall Deposit
			$t1 = $this->Mt4Trade->OverallDepo();
			$this->set('OverallDepo', $t1);

			#Last Month
			$t2 = $this->Mt4Trade->LastMonthDepo();
			$this->set('LastMonthDepo', $t2);

			#Last Week
			$t3 = $this->Mt4Trade->LastWeekDepo();
			$this->set('LastWeekDepo', $t3);

			#Yesterday
			$t4 = $this->Mt4Trade->YesterdayDepo();
			$this->set('YesterdayDepo', $t4);

			#Today
			$t5 = $this->Mt4Trade->TodayDepo();
			$this->set('TodayDepo', $t5);

			if($this->RequestHandler->isAjax()) {
				$this->layout = 'ajax';
				$this->render('report_deposit');
			}

		}

		/***
		*	STAFF :: Report Withdrawal
		****/
		public function report_withdrawal(){
			//Layout
			$this->layout = "staff.dashboard";
			//Page title
			$page_title = array(
				'icon' => "icon-exchange",
				'name' => "All Withdrawal"
			);
			$this->set('page_title',$page_title);

			$this->paginate = array(
		        'conditions' => array(
	        		'Mt4Trade.COMMENT LIKE' => '%WD%',
					'Mt4Trade.CMD' => '6',
					'Mt4Trade.LOGIN NOT LIKE' => '88%',
					'Mt4Trade.PROFIT LIKE' => '%-%',
					'Mt4User.GROUP LIKE' => '%IK%'
		        ),
		        'order' => 'Mt4Trade.OPEN_TIME DESC',
		        'limit' => 50,
	    	);

	    	//start loading data to table top
			#Overall Deposit
			$t1 = $this->Mt4Trade->OverallWdrw();
			$this->set('OverallWdrw', $t1);

			#Last Month
			$t2 = $this->Mt4Trade->LastMonthWdrw();
			$this->set('LastMonthWdrw', $t2);

			#Last Week
			$t3 = $this->Mt4Trade->LastWeekWdrw();
			$this->set('LastWeekWdrw', $t3);

			#Yesterday
			$t4 = $this->Mt4Trade->YesterdayWdrw();
			$this->set('YesterdayWdrw', $t4);

			#Today
			$t5 = $this->Mt4Trade->TodayWdrw();
			$this->set('TodayWdrw', $t5);

		    $trades = $this->paginate('Mt4Trade');
			$this->set('reportWithdrawal' , $trades);
			#debug($trades); die();
			if($this->RequestHandler->isAjax()) {
				$this->layout = 'ajax';
				$this->render('report_withdrawal');
			}

		}

		/***
		*	STAFF :: Kira Profit & Loss Semalam / Hari Ni
		****/
		public function profitLossClient_semalam(){
			$semalam= $this->Mt4Trade->jumlahCloseOrder('yesterday'); 
			#$hariNi = $this->Mt4Trade->jumlahCloseOrder('today');
			#debug($semalam); 
			#debug($hariNi); die();
			if ($this->request->is('requested')) {
				return $semalam;
				#return $hariNi;
			}
		}
		public function profitLossClient_hariNi(){
			#$semalam= $this->Mt4Trade->jumlahCloseOrder('yesterday'); 
			$hariNi = $this->Mt4Trade->jumlahCloseOrder('today');
			#debug($semalam); 
			#debug($hariNi); die();
			if ($this->request->is('requested')) {
				#return $semalam;
				return $hariNi;
			}
		}

		/****
		*	STAFF :: Baca Log TODOTODOTODOTODOTODOTODO
		*****/

		public function baca_error_log(){
			debug(APP_DIR);
			App::uses('Folder', 'Utility');
			App::uses('File', 'Utility');
			$dir = new Folder('/tmp/logs');
			$files = $dir->find('.*\error.log');

			foreach ($files as $file) {
			    $contents = $file->read();
			    debug($contents);
			    $file->close();
			}
		}

		public function updateStatusPL(){

			$this->layout = 'ajax';

			####### Data Array #######

			#Overall Close Order Last Friday(LOSS)
			$TodayLOSS = $this->Mt4Trade->TodayLOSS();
			$TodayMYLOSS = $this->Mt4Trade->TodayMYLOSS();
			#debug($TodayLOSS);debug($TodayMYLOSS);
			#Overall Close Order  Last Friday (PROFIT)
			$TodayPROFIT = $this->Mt4Trade->TodayPROFIT();
			$TodayMYPROFIT = $this->Mt4Trade->TodayMYPROFIT();

			$TotalClosedAll = $this->Mt4Trade->TotalClosedAll();
			$TotalClosedMY = $this->Mt4Trade->TotalClosedMY();
			#debug($TodayPROFIT);debug($TodayMYPROFIT); die();

			#masa report
			$time = date('d-m-Y g:iA',strtotime('now'));

			#sending email
			App::uses('CakeEmail', 'Network/Email');
			$email = new CakeEmail();
			$email->config('default');
			$email->template('default', 'default');
			$email->emailFormat('both');
			$email->viewVars(array('name' => 'FXSdesk IK Trust'));
			$email->from(array('fxsdesk@iktrust.com' => 'FXSdesk IK Trust'));
			$email->replyTo(array('fxsdesk@iktrust.com' => 'FXSdesk IK Trust'));
			$email->sender(array('fxsdesk@iktrust.com' => 'FXSdesk IK Trust'));
			$email->to(array('finance@iktrust.com' => 'Finance IK TRUST'));
			#$email->bcc(array('ttarmizi@gmail.com' => 'Mr. Tarmizi', 'anuarinvestor@gmail.com' => 'Mr. Anuar', 'salleh.iktrust@gmail.com' => 'Mr. Salleh', 'arifsanchez@gmail.com' => 'Mr. Arif'));
			$email->subject('[UPDATE] P/L Risk #'.$time);
			$email->addHeaders(array('Tag' => 'Report'));

			$body=__('<b>IK TRUST | Closed Trade Report</b><br/><br/>Overall (LOSS) = '.$TodayLOSS.'<br/>Overall (PROFIT) = '.$TodayPROFIT.'<br/><br/>IKtrust.my (LOSS) = '.$TodayMYLOSS.'<br/>IKtrust.my (PROFIT) = '.$TodayMYPROFIT.'<br/><br/>Today Closed Trade All = '.$TotalClosedAll.'<br/> Today Closed Trade .my = '.$TotalClosedMY.'');
			#debug($body); die();

			#sending email
			try{
				$result = $email->send($body);
				$this->log($result, 'debug');
			} catch (Exception $ex){
				$this->log($ex, 'notify_email');
			}

			#sending sms notification
			App::uses('HttpSocket', 'Network/Http');
			$HttpSocket = new HttpSocket();
            $results = $HttpSocket->post('http://bulk.ezlynx.net:7001/BULK/BULKMT.aspx', array(
                'user' => 'instafx',
                'pass' => 'instafx8000',
                'msisdn' => '60136454002;60127181461;60192711461;60123854983;60129746478',
                'body' => '- IK TRUST Overall(L) = ['.$TodayLOSS.'] , Overall(P) = ['.$TodayPROFIT.'] , IKtrust.my(L) = ['.$TodayMYLOSS.'] , IKtrust.my(P) = ['.$TodayMYPROFIT.'] , Today Closed All = ['.$TotalClosedAll.'] , Today Closed .my = ['.$TotalClosedMY.'] '.$time.'',
                'smstype' => 'TEXT',
                'sender' => 'IKTRUST',
            ));
		}
	}
?>