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

			$this->layout = 'traders.dashboard';

		}

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