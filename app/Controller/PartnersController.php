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
				$this->set('balance', $TotalDownline);
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
				$this->set('balance', $TotalAgent);
			}
		}

	}
?>