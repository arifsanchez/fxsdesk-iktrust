<?php
	#Exchangers Controller

	App::uses('AppController', 'Controller');

	class ExchangersController extends AppController {

		/**
		* Controller name
		*
		* @var string
		*/
		public $name = 'Exchangers';

		/**
		* This controller use vaults models and few other platform models
		* @var array
		*/
		public $uses = array("Vault","VaultTransaction","Mt4User","Usermgmt.User","Mt4Trade");


		/**
		* Exchanger Dashboard
		*/
		public function wallet() {
			//Layout
			$this->layout = "exchanger.dashboard";
			//Page title
			$page_title = array(
				'icon' => "icon-dashboard",
				'name' => "Exchanger Wallet"
			);
			$this->set('page_title',$page_title);

		}
	}
?>