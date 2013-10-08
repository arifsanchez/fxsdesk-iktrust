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
		        		'SYMBOL NOT' => ''
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

		/****
		*	STAFF :: dapatkan details baki accoun trading
		*****/

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
					)
				));
				$new_balance = $vaultId['Vault']['acc_1'] - $jumlah;
				$data = array('acc_1' => $new_balance);
				#debug($data); die();
				$this->Vault->id = $vaultId['Vault']['id'];
				$this->Vault->save($data);
				
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
				$data = array('acc_1' => $new_balance);
				$this->Vault->id = $vaultId['Vault']['id'];
				$this->Vault->save($data);
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
					)
				));
				$new_balance = $vaultId['Vault']['acc_1'] - $jumlah;
				$data = array('acc_1' => $new_balance);
				$this->Vault->id = $vaultId['Vault']['id'];
				$this->Vault->save($data);
				#debug($this->request); die();
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
				$data = array('acc_1' => $new_balance);
				$this->Vault->id = $vaultId['Vault']['id'];
				$this->Vault->save($data);
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
				$data = array(
					'acc_1' => $new_balance
				);
				#debug($vaultId['Vault']['id']); die();
				$this->Vault->id = $vaultId['Vault']['id'];
				$this->Vault->saveField('acc_1', $new_balance);
				#debug($this->request); die();
				
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
					)
				));
				$new_balance = $vaultId['Vault']['acc_1'] + $jumlah;
				$data = array('acc_1' => $new_balance);
				$this->Vault->id = $vaultId['Vault']['id'];
				$this->Vault->save($data);
				#debug($this->request); die();
				
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
				'name' => "All Commissions History"
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

			if($this->RequestHandler->isAjax()) {
				$this->layout = 'ajax';
				$this->render('report_commission');
			}
		}

		/***
		*	STAFF :: All Commissions
		****/
		public function report_rebate(){

			//Layout
			$this->layout = "staff.dashboard";
			//Page title
			$page_title = array(
				'icon' => "icon-money",
				'name' => "All Rebates History"
			);
			$this->set('page_title',$page_title);

			//Paginate Trader Accounts Listing
			$this->paginate = array(
				'limit' => 35, 
				'order'=> 'Mt4Trade.MODIFY_TIME DESC',
				'recursive'=>0,
				'conditions' =>array(
					'Mt4Trade.COMMENT LIKE' => '%rebate%',
				)
			);
			$trades = $this->paginate('Mt4Trade');
			#debug($trades); die();
			$this->set('reportComm',$trades);

			if($this->RequestHandler->isAjax()) {
				$this->layout = 'ajax';
				$this->render('report_rebate');
			}
		}

		/***
		*	STAFF :: All Commissions TODOTODOTODOTODOTODOTODO
		****/
		public function report_close_order(){
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
		        ),
		        'order' => 'Mt4Trade.CLOSE_TIME DESC',
		        'limit' => 50,
	    	);
		    $trades = $this->paginate('Mt4Trade');
			$this->set('reportCloseOrder' , $trades);
			#debug($trades); die();
			if($this->RequestHandler->isAjax()) {
				$this->layout = 'ajax';
				$this->render('report_close_order');
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
	}
?>