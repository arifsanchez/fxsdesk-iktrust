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
		public $uses = array("Vault","Mt4User","Usermgmt.User","Mt4Trade");

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
			$acc1 = $this->Vault->getAccBalance($userId);
			$this->set('acc1', $acc1['Vault']['acc_1']);
			$this->set('acc2', $acc1['Vault']['acc_2']);

			//Dapatkan senarai trading account
			$user = $this->UserAuth->getUser();
			$partnertag = $user['User']['partnertag'];
			$tradeAcc = $this->Mt4User->listPartnerAcc($partnertag);
			$this->set('tradeAcc', $tradeAcc);
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
				$this->Session->setFlash('You are not authorized to access trading account #'.$acc.' details.', 'default', array('class' => 'alert alert-error'));
				$this->redirect(array('action' => 'listing'));
			}
		}

	}
?>