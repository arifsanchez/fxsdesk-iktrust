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

	}
?>