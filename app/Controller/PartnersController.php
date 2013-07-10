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
		* This controller does not use a model
		*
		* @var array
		*/
		public $uses = array();

		/**
		* Partner Dashboard
		*
		* @param mixed What page to display
		* @return void
		*/
		public function dashboard() {

			$this->layout = 'partners.dashboard';

		}

	}
?>