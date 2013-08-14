<?php
	#Staff Controller

	App::uses('AppController', 'Controller');

	class StaffsController extends AppController {

		/**
		* Controller name
		*
		* @var string
		*/
		public $name = 'Staffs';

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
		public function backoffice() {

			$this->layout = 'staff.dashboard';

		}

	}
?>