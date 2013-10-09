<?php
	#Partners Controller

	App::uses('AppController', 'Controller');

	class PartnersController extends AppController {

		/**
		* Controller name
		*
		* @var string
		*/
		public $name = 'Partners';

		/**
		* This controller use vaults models and few other platform models
		* @var array
		*/
		public $uses = array("Vault","VaultTransaction","Mt4User","Usermgmt.User","Mt4Trade");

		/**
		* Partner Dashboard
		*/
		public function cabinet() {
			//Layout
			$this->layout = "partner.dashboard";
			//Page title
			$page_title = array(
				'icon' => "icon-dashboard",
				'name' => "Partner Cabinet"
			);
			$this->set('page_title',$page_title);

		}

		/**
		 * PARTNER : Request Account 1 Balance
		 *
		 * @access public
		 * @return array
		 */
		public function acc1_balance() {
			$this->layout = "ajax";
			$userId = $this->UserAuth->getUserId();
			$balance = $this->Vault->getAccBalance($userId);
			#debug($balance['Vault']['acc_1']);die();
			if ($this->request->is('requested')) {
				$bal = $balance['Vault']['acc_1'];
				return $bal;
			} else {
				$this->set('balance', $balance['Vault']['acc_1']);
			}
		}

		/**
		* Partner Wallet
		*/
		public function vault() {
			//Layout
			$this->layout = "partner.dashboard";
			//Page title
			$page_title = array(
				'icon' => "icon-money",
				'name' => "Partner Vault"
			);
			$this->set('page_title',$page_title);

			//Dapatkan user id
			$userId = $this->UserAuth->getUserId();
			//Check jika traders first time buka vault
			$checkVault = $this->Vault->checkVaultAccount($userId);

			//Request balance from vault db
			$vacc = $this->Vault->getAccBalance($userId);
			$this->set('acc1', $vacc['Vault']['acc_1']);
			$this->set('acc2', $vacc['Vault']['acc_2']);

			//Dapatkan senarai trading account
			$user = $this->UserAuth->getUser();
			$partnertag = $user['User']['partnertag'];
			$tradeAcc = $this->Mt4User->listPartnerAcc($partnertag);
			$this->set('tradeAcc', $tradeAcc);

			//request transaction dari vault == latest
			$vtrans = $this->VaultTransaction->listAllLatest($vacc['Vault']['id']);
			$this->set('vtrans_latest', $vtrans);

			//request transaction dari vault == new
			$vtrans1 = $this->VaultTransaction->listAllNew($vacc['Vault']['id']);
			$this->set('vtrans_new', $vtrans1);

			//request transaction dari vault == pending
			$vtrans2 = $this->VaultTransaction->listAllPending($vacc['Vault']['id']);
			$this->set('vtrans_pending', $vtrans2);

			//request transaction dari vault == approve
			$vtrans3 = $this->VaultTransaction->listAllApprove($vacc['Vault']['id']);
			$this->set('vtrans_approve', $vtrans3);

			//request transaction dari vault == decline
			$vtrans4 = $this->VaultTransaction->listAllDecline($vacc['Vault']['id']);
			$this->set('vtrans_decline', $vtrans4);
		}

		/**
		 * PARTNER :: Vault History
		 *
		 * @access public
		 * @return array
		 */
		public function vault_history() {
			//Layout
			$this->layout = "partner.dashboard";
			//Page title
			$page_title = array(
				'icon' => "icon-money",
				'name' => "Vault History"
			);
			$this->set('page_title',$page_title);

			//Dapatkan user id
			$userId = $this->UserAuth->getUserId();
			//Check jika traders first time buka vault
			$checkVault = $this->Vault->checkVaultAccount($userId);
			$acc1 = $this->Vault->getAccBalance($userId);

			//list with paginate all transaction history
			$this->paginate = array(
				'order' => 'VaultTransaction.created DESC',
				'limit' => 10,
				'conditions' =>array(
					'VaultTransaction.vault_id' => $acc1['Vault']['id'],
			));
			$Wtransact = $this->paginate('VaultTransaction');
			#debug($Wtransact); die();
			$this->set('Wtransact',$Wtransact);

			if($this->RequestHandler->isAjax()) {
				$this->layout = 'ajax';
				$this->render('vault_history');
			}
		}

		/***
		* Partner :: request kira total trader di dalam network , group by email
		***/

		public function kiraTotalClient(){
			$this->layout = "ajax";
			$user = $this->UserAuth->getUser();
			$partnertag = $user['User']['partnertag'];
			$TotalClient = $this->Mt4User->kiraTotalClient($partnertag);
			if ($this->request->is('requested')) {
				return $TotalClient;
			} else {
				$this->set('TotalClient', $TotalClient);
			}
		}

		/***
		* Partner :: request kira total downline
		***/

		public function kiraTotalDownline(){
			$this->layout = "ajax";
			$user = $this->UserAuth->getUser();
			$partnertag = $user['User']['partnertag'];
			$TotalDownline = $this->Mt4User->kiraTotalDownline($partnertag);
			if ($this->request->is('requested')) {
				return $TotalDownline;
			} else {
				$this->set('TotalDownline', $TotalDownline);
			}
		}

		/***
		* Partner :: request kira total downline
		***/

		public function kiraAccBawahAff(){
			$this->layout = "ajax";
			$partnertag = $this->request->params['named']['agent'];
			$TotalDownline = $this->Mt4User->kiraTotalDownline($partnertag);
			if ($this->request->is('requested')) {
				return $TotalDownline;
			} else {
				$this->set('TotalDownline', $TotalDownline);
			}
		}

		/***
		* Partner :: request kira total affilliate / sub ib
		***/

		public function kiraTotalAgent(){
			$this->layout = "ajax";
			$user = $this->UserAuth->getUser();
			$partnertag = $user['User']['partnertag'];
			$TotalAgent = $this->Mt4User->kiraTotalAgent($partnertag);
			if ($this->request->is('requested')) {
				return $TotalAgent;
			} else {
				$this->set('TotalAgent', $TotalAgent);
			}
		}

		/***
		* Partner :: trading_account_overview
		***/

		public function trading_account_overview(){
			$acc = $this->params['named']['acc'];
			//Layout
			$this->layout = "partner.dashboard";
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
			if($result['Mt4User']['LOGIN'] == $user['User']['partnertag']){
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

				if($this->RequestHandler->isAjax()) {
					$this->layout = 'ajax';
					$this->render('history');
				}
			} else {
				$this->Session->setFlash(__('You are not authorized to access trading account #'.$acc.' details.'), 'default', array('class' => 'error'));
				$this->redirect(array('action' => 'listing'));
			}
		}

		/**
		* PARTNER :: Trader Accounts listing
		*/
		public function mynetwork() {
			//Layout
			$this->layout = "partner.dashboard";
			//Page title
			$page_title = array(
				'icon' => "icon-signal",
				'name' => "All Trading Accounts"
			);
			$this->set('page_title',$page_title);

			//Pull info partner
			$user = $this->UserAuth->getUser();

			//Paginate Partner Network Listing
			$headerTagAff = substr($user['User']['partnertag'], -2);
			$this->paginate = array(
				'limit' => 15, 
				'order'=> 'Mt4User.REGDATE DESC',
				'recursive'=>0,
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
								'Mt4User.AGENT_ACCOUNT' => "".$user['User']['partnertag'].""
							)
						)
					)
				),
			);
			$trades = $this->paginate('Mt4User');
			$this->set('MT_ACC',$trades);

			if($this->RequestHandler->isAjax()) {
				$this->layout = 'ajax';
				$this->render('mynetwork');
			}
		}

		/***
		* Partner :: carian untuk Tracc History
		***/

		public function cariTracc(){
			$cari = $this->request->data['Partner']['tracc_no'];
			if($cari){
				$user = $this->UserAuth->getUser();
				$headerTagAff = substr($user['User']['partnertag'], -2);

				//check if this is a valid trading account
				$traccNo = $this->Mt4User->find('first', 
					array(
						'recursive'=>-1,
						'conditions' => array(
							'OR' => array(
								array(
									'AND' => array(
										'Mt4User.LOGIN LIKE' => $cari,
										'Mt4User.GROUP LIKE' => '%IK%',
										'Mt4User.AGENT_ACCOUNT LIKE' => '7'.$headerTagAff.'%',
									)
								),
								array(
									'AND' => array(
										'Mt4User.LOGIN LIKE' => $cari,
										'Mt4User.GROUP LIKE' => '%IK%',
										'Mt4User.AGENT_ACCOUNT' => "".$user['User']['partnertag'].""
									)
								)
							)
						),
						'fields' => array('Mt4User.LOGIN')
					));
				if(empty($traccNo)){
					$this->Session->setFlash(__('Sorry, you do not have access to view searched trading account number.'),'default',array('class' => 'error'));
					$this->redirect('mynetwork');
				} else {
					$this->redirect('mynetwork_history/process:'.$cari);
				}
			} else {
				$this->redirect($this->referer());
			}
		}

		/***
		* Partner :: carian guna email untuk Client
		***/

		public function cariClient(){
			$cari = $this->request->data['Partner']['email'];
			if($cari){
				//check if this is a valid trading account
				$email = $this->User->findByEmail($cari);
				if(empty($email)){
					$this->Session->setFlash(__('Email address search return empty result .'),'default',array('class' => 'error'));
					$this->redirect('myclient');
				} else {
					$this->redirect('myclient_profile/email:'.$cari);
				}
				
			} else {
				$this->redirect($this->referer());
			}
		}

		/**
		* PARTNER :: Ajax search client guna email
		*/
		function searchClient(){
			if($this->RequestHandler->isAjax() ) {
				Configure::write ( 'debug', 0 );
				$this->autoRender=false;
				$this->User->recursive = -1;
				$users = $this->User->find('all',array('conditions'=>array('User.email LIKE'=>'%'.$_GET['term'].'%')));
				#debug($users); die();
				
					$i=0;
					foreach($users as $user){
						$response[$i]['value'] = $user['User']['email'];
						$i++;
					}
				echo json_encode($response);
		   }
		}

		/**
		* PARTNER :: Trader Accounts History
		*/
		public function mynetwork_history() {
			//start cari tracc no
			$tracc_id = $this->request->params['named']['process'];

			//Layout
			$this->layout = "partner.dashboard";
			//Page title
			$page_title = array(
				'icon' => "icon-group",
				'name' => "Accounts #".$tracc_id." History"
			);
			$this->set('page_title',$page_title);

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
			$this->set('agentPost',$trades);

			$bakiAcc = $this->Mt4User->tentangDiri($tracc_id);
			$this->set('nama_trader',$bakiAcc['Mt4User']['NAME']);
			$this->set('email_trader',$bakiAcc['Mt4User']['EMAIL']);
			$this->set('bakiAcc',$bakiAcc['Mt4User']['BALANCE']);
			$this->set('bakiSemalam',$bakiAcc['Mt4User']['PREVBALANCE']);
			$this->set('leverage',$bakiAcc['Mt4User']['LEVERAGE']);
			$this->set('bakiCR',$bakiAcc['Mt4User']['CREDIT']);
			$this->set('equity',$bakiAcc['Mt4User']['MARGIN_FREE']+$bakiAcc['Mt4User']['MARGIN']);

			$traderOpenPost = $this->Mt4Trade->traderOpenPost($tracc_id);
			$this->set('traderOpenPost', $traderOpenPost);

			$traderClosePost = $this->Mt4Trade->traderClosePost($tracc_id);
			$this->set('traderClosePost', $traderClosePost);
			
			$traderTradeVol = $this->Mt4Trade->traderTradeVol($tracc_id);
				$this->set('traderTradeVol', $traderTradeVol);

			if($this->RequestHandler->isAjax()) {
				$this->layout = 'ajax';
				$this->render('mynetwork_history');
			}
		}

		/**
		* PARTNER :: Client listing
		*/
		public function myclient() {
			//Layout
			$this->layout = "partner.dashboard";
			//Page title
			$page_title = array(
				'icon' => "icon-signal",
				'name' => "All Registered Clients"
			);
			$this->set('page_title',$page_title);

			//Pull info partner
			$user = $this->UserAuth->getUser();

			//Paginate Partner Network Listing
			$headerTagAff = substr($user['User']['partnertag'], -2);
			$this->paginate = array(
				'limit' => 15, 
				'order'=> 'Mt4User.REGDATE DESC',
				'recursive'=>0,
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
								'Mt4User.AGENT_ACCOUNT' => "".$user['User']['partnertag'].""
							)
						)
					)
				),
				'group' => array('Mt4User.EMAIL')
			);
			$trades = $this->paginate('Mt4User');
			$this->set('MT_ACC',$trades);

			if($this->RequestHandler->isAjax()) {
				$this->layout = 'ajax';
				$this->render('myclient');
			}
		}

		/**
		* PARTNER :: Client listing
		*/
		public function myclient_profile() {
			//Layout
			$this->layout = "partner.dashboard";
			//Page title
			$page_title = array(
				'icon' => "icon-signal",
				'name' => "Client Profile"
			);
			$this->set('page_title',$page_title);


			//Dapatkan info tentang registered info
			$kunci = $this->request->params['named']['kunci'];
			#debug($kunci);
			$email = base64_decode($kunci);
			#debug($email);
			$user = $this->User->findByEmail($email);
			$this->set('user', $user);

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
		}

		/**
		* PARTNER :: Agent listing
		*/
		public function myagent() {
			//Layout
			$this->layout = "partner.dashboard";
			//Page title
			$page_title = array(
				'icon' => "icon-signal",
				'name' => "All Agents"
			);
			$this->set('page_title',$page_title);

			//Pull info partner
			$user = $this->UserAuth->getUser();

			//Paginate Partner Network Listing
			$this->paginate = array(
				'limit' => 15, 
				'order'=> 'Mt4User.REGDATE DESC',
				'recursive'=>0,
				'conditions' =>array(
					'Mt4User.GROUP LIKE' => '%Aff%',
					'Mt4User.AGENT_ACCOUNT' => "".$user['User']['partnertag'].""
				)
			);
			$trades = $this->paginate('Mt4User');
			$this->set('MT_ACC',$trades);

			if($this->RequestHandler->isAjax()) {
				$this->layout = 'ajax';
				$this->render('myagent');
			}
		}

		/**
		* PARTNER :: Agent Accounts history
		*/
		public function myagent_history() {
			//start cari agent ID
			$tracc_id = $this->request->params['named']['process'];

			//Layout
			$this->layout = "partner.dashboard";
			//Page title
			$page_title = array(
				'icon' => "icon-group",
				'name' => "Agent #".$tracc_id." History"
			);
			$this->set('page_title',$page_title);

			//check if the one nak check ni dibawah partnership downline dia
			$user = $this->UserAuth->getUser();
			$partnertag = $user['User']['partnertag']; // cari partnertag

			//cari agent_account untuk $tracc_id -TO DO

			//dapatkan agent account balance & name
			$bakiAcc = $this->Mt4User->bakiAcc($tracc_id);
			$this->set('nama_agent',$bakiAcc['Mt4User']['NAME']);
			$this->set('bakiAcc',$bakiAcc['Mt4User']['BALANCE']);

			//listing downline
			$downlines = $this->Mt4User->listingDownline($tracc_id);
			$this->set('downlines', $downlines);

			//Paginate Trader Accounts Listing
			$this->paginate = array(
				'limit' => 20, 
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
				$this->render('myagent_history');
			}
		}

		/**
		* PARTNER :: Check kewujudan dashboard Account
		*
		*/
		public function checkDashboardStatus(){
			$email = $this->request->params['named']['pass'];
			$adoTak = $this->User->getUserByEmail($email);
			#debug($adoTak);
			if ($this->request->is('requested')) {
				return $adoTak;
			} else {
				$this->set('statusDash', $adoTak);
			}
			#
		}

		/**
		* PARTNER :: Trading Account History
		*
		*/
		public function history() {
			//Layout
			$this->layout = "partner.dashboard";
			//Page title
			$page_title = array(
				'icon' => "glyphicon-table",
				'name' => "Partner Account History"
			);
			$this->set('page_title',$page_title);

			//Pull info trader
			$user = $this->UserAuth->getUser();
			$acc = $user['User']['partnertag'];

			//Paginate Trade history
			$this->paginate = array(
				'limit' => 30, 
				'order'=>'Mt4Trade.OPEN_TIME DESC', 
				'recursive'=>0,
				'conditions' =>array(
					'Mt4Trade.LOGIN' => $acc,
			));
			$trades = $this->paginate('Mt4Trade');
			$this->set('MT_TRANSACT',$trades);

			if($this->RequestHandler->isAjax()) {
				$this->layout = 'ajax';
				$this->render('history');
			}
		}

	}
?>