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
		public $uses = array("Mt4User","Usermgmt.User");

		/**
		* Trader Accounts listing
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
				'name' => "Trader Dashboard"
			);
			$this->set('page_title',$page_title);

			//Pull info trader
			$user = $this->UserAuth->getUser();
			$acc = $this->Mt4User->find('all', array(
				'conditions' =>array(
					'Mt4User.EMAIL' => $user['User']['email'],
					#'Mt4User.EMAIL' => "2012hmkvn@gmail.com",
					#'Mt4User.EMAIL' => "me@arif.my",
					'Mt4User.GROUP LIKE' => '%IK%'
				)
			));
			$this->set('MT_ACC',$acc);
		}

	}
?>