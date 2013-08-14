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
		}

	}
?>