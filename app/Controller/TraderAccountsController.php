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
		public $uses = array("Mt4User","Usermgmt.User","Mt4Trade");

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
					#'Mt4User.EMAIL' => "me@arif.my", //Test Account
					'Mt4User.GROUP LIKE' => '%IK%'
				)
			));
			$this->set('MT_ACC',$acc);
		}

		/**
		* Trader Account Details
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
				'name' => "Overview #".$acc.""
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
				$this->set('MT_ACC',$result);	
			} else {
				$this->Session->setFlash('You are not authorized to acess trading account #'.$acc.' details.', 'default', array('class' => 'alert alert-error'));
				$this->redirect(array('action' => 'listing'));
			}
			

			//Pull top 5 transactions
			$transact = $this->Mt4Trade->find('all', array(
				'conditions' =>array(
					'Mt4Trade.LOGIN' => $acc,

				),
				'limit' => 5,
				'order' => array('Mt4Trade.TICKET DESC'), 
			));
			$this->set('MT_TRANSACT',$transact);
		}


		/**
		* Trader Account Funding
		*
		* @param mixed What page to display
		* @return void
		*/
		public function funding() {
			$acc = $this->params['named']['acc'];
			//Layout
			$this->layout = "trader.dashboard";
			//Page title
			$page_title = array(
				'icon' => "icon-money",
				'name' => "Funding #".$acc.""
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
				#$this->set('MT_ACC',$result);	
			} else {
				$this->Session->setFlash('You are not authorized to access trading account #'.$acc.' details.', 'default', array('class' => 'alert alert-error'));
				$this->redirect(array('action' => 'listing'));
			}
		}
	}
?>