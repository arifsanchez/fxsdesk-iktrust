<?php
	#Traders Controller

	App::uses('AppController', 'Controller');

	class TradersController extends AppController {

		/**
		* Controller name
		*
		* @var string
		*/
		public $name = 'Traders';

		/**
		* This controller does not use a model
		*
		* @var array
		*/
		public $uses = array();

		/**
		* Traders Dashboard
		*
		* @param mixed What page to display
		* @return void
		*/
		public function dashboard() {

			//Layout
			$this->layout = "trader.dashboard";
			//Page title
			$page_title = array(
				'icon' => "icon-signal",
				'name' => "Trader Dashboard"
			);
			$this->set('page_title',$page_title);

		}

		/**
		* Trader Identity Verification
		*
		* @param mixed What page to display
		* @return void
		*/
		public function verifyIdentity(){
			//Layout
			$this->layout = "trader.dashboard";
			//Page title
			$page_title = array(
				'icon' => "icon-cloud-upload",
				'name' => "Identity Verification"
			);
			$this->set('page_title',$page_title);

		}

		/**
		* Trader Security Mailbox
		*
		* @param mixed What page to display
		* @return void
		*/
		public function securityInbox(){
			//Layout
			$this->layout = "trader.dashboard";
			//Page title
			$page_title = array(
				'icon' => "icon-inbox",
				'name' => "Security Inbox"
			);
			$this->set('page_title',$page_title);
		}

		/**
		* Trader Support Request
		*
		* @param mixed What page to display
		* @return void
		*/
		public function sentSupportRequest(){
			//Layout
			$this->layout = "trader.dashboard";
			//Page title
			$page_title = array(
				'icon' => "icon-umbrella",
				'name' => "Sent Support Request"
			);
			$this->set('page_title',$page_title);
		}

		/**
		* Trader Wallet Home
		*
		* @param mixed What page to display
		* @return void
		*/
		public function myWallet(){
			//Layout
			$this->layout = "trader.dashboard";
			//Page title
			$page_title = array(
				'icon' => "icon-money",
				'name' => "My eWallet"
			);
			$this->set('page_title',$page_title);

		}
		
		/**
		* Traders Notification via email (TEST)
		*
		* @param mixed What page to display
		* @return void
		*/
		public function notify(){
			App::uses('CakeEmail', 'Network/Email');
			$email = new CakeEmail();

			$email->config('default');
			$email->template('default', 'default');
			$email->emailFormat('html');
			$email->viewVars(array('name' => 'IK Trust'));
			$email->from(array('support@iktrust.com' => 'IK Trust | FXsDesk'));
			$email->to(array('arifsanchez@gmail.com' => 'Arif Sanchez'));
			$email->subject('Test Postmark');
			$email->addHeaders(array('Tag' => 'Test Email'));
			$email->attachments(array(
			    'iktrust-logo.png' => array(
			        'file' => WWW_ROOT . 'img' . DS . 'iktrust-logo.png'
			    )
			));
			$result = $email->send('Message');
			$this->log($result, 'debug');

			debug($result); die();
		}

	}
?>