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
		public $uses = array("Vault","VaultTransaction","Mt4User","Usermgmt.User","Mt4Trade");

		/**
		* Staff Dashboard
		*
		* @param mixed What page to display
		* @return void
		*/
		public function backoffice() {

			//Layout
			$this->layout = "staff.dashboard";
			//Page title
			$page_title = array(
				'icon' => "icon-dashboard",
				'name' => "Staff Dashboard"
			);
			$this->set('page_title',$page_title);

		}

		/**
		* STAFF :: Accounts listing
		*/
		public function tracc_listing() {
			//Layout
			$this->layout = "staff.dashboard";
			//Page title
			$page_title = array(
				'icon' => "icon-signal",
				'name' => "All Trading Accounts"
			);
			$this->set('page_title',$page_title);

			//Paginate Trader Accounts Listing
			$this->paginate = array(
				'limit' => 35, 
				'order'=> 'Mt4User.REGDATE DESC',
				'recursive'=>0,
				'conditions' =>array(
					'Mt4User.GROUP LIKE' => '%IK%',
				)
			);
			$trades = $this->paginate('Mt4User');
			$this->set('MT_ACC',$trades);

			if($this->RequestHandler->isAjax()) {
				$this->layout = 'ajax';
				$this->render('tracc_listing');
			}
		}

		/**
		* STAFF :: Accounts listing
		*/
		public function agent_listing() {
			//Layout
			$this->layout = "staff.dashboard";
			//Page title
			$page_title = array(
				'icon' => "icon-signal",
				'name' => "All Agent Accounts"
			);
			$this->set('page_title',$page_title);

			//Paginate Trader Accounts Listing
			$this->paginate = array(
				'limit' => 35, 
				'order'=> 'Mt4User.REGDATE DESC',
				'recursive'=>0,
				'conditions' =>array(
					'Mt4User.GROUP LIKE' => '%Aff%',
				)
			);
			$trades = $this->paginate('Mt4User');
			$this->set('MT_ACC',$trades);

			if($this->RequestHandler->isAjax()) {
				$this->layout = 'ajax';
				$this->render('agent_listing');
			}
		}
		
		/**
		* STAFF :: Deposit Main Window
		*
		*/
		public function deposit_request() {

			//Layout
			$this->layout = "staff.dashboard";
			//Page title
			$page_title = array(
				'icon' => "icon-money",
				'name' => "Deposit Request"
			);
			$this->set('page_title',$page_title);

		}

		/**
		* Staff :: Withdraw Main Window
		*
		*/
		public function withdrawal_request() {

			//Layout
			$this->layout = "staff.dashboard";
			//Page title
			$page_title = array(
				'icon' => "icon-money",
				'name' => "Withdrawal Request"
			);
			$this->set('page_title',$page_title);

		}

		/**
		* Staff :: Transfer Main Window
		*
		*/
		public function transfer_request() {

			//Layout
			$this->layout = "staff.dashboard";
			//Page title
			$page_title = array(
				'icon' => "icon-money",
				'name' => "Transfer Request"
			);
			$this->set('page_title',$page_title);

			//check for param request
			$filter = $this->params->named['filter'];
			#debug($filter); die();
			if($filter == 'pending'){
				//list with paginate all pending request
				$this->paginate = array(
					'order' => 'VaultTransaction.created DESC',
					'limit' => 35,
					'recursive' => 2,
					'conditions' => array('VaultTransaction.status' => 2)
				);

				$this->set('filter' , $filter);
			} else if($filter == 'approve'){
				//list with paginate all approved
				$this->paginate = array(
					'order' => 'VaultTransaction.created DESC',
					'limit' => 35,
					'recursive' => 2,
					'conditions' => array('VaultTransaction.status' => 3)
				);
				$this->set('filter' , $filter);
			} else if($filter == 'decline'){
				//list with paginate all declined
				$this->paginate = array(
					'order' => 'VaultTransaction.created DESC',
					'limit' => 35,
					'recursive' => 2,
					'conditions' => array('VaultTransaction.status' => 4)
				);
				$this->set('filter' , $filter);
			} else if($filter == 'new'){
				//list with paginate all transaction history
				$this->paginate = array(
					'order' => 'VaultTransaction.created DESC',
					'limit' => 35,
					'recursive' => 2,
					'conditions' => array('VaultTransaction.status' => 1)
				);
				$this->set('filter' , $filter);
			}
			
			$Wtransact = $this->paginate('VaultTransaction');
			$this->set('Wtransact',$Wtransact);

			if($this->RequestHandler->isAjax()) {
				$this->layout = 'ajax';
				$this->render('transfer_request');
			}

		}

		/**
		* Staff :: Transfer Detail Main Window
		*
		*/
		public function transfer_detail() {

			//check for param request
			#debug($this->request->params['named']['process']); die();
			if($this->request->params['named']['process'] == null){
				//jika kosong hantar terus ke page listing
				$this->Session->setFlash(__('Sorry :( Invalid Tradsaction.'),'default',array('class' => 'error'));
				$this->redirect(array('action' => 'transfer_request/filter:new'));
			} else {
				//Layout
				$this->layout = "staff.dashboard";
				//Page title
				$page_title = array(
					'icon' => "icon-money",
					'name' => "Transfer Detail"
				);
				$this->set('page_title',$page_title);

				//start cari details of transactions
				$vt_id = $this->request->params['named']['process'];
				$details = $this->VaultTransaction->find('first', array(
					'conditions' => array(
						'VaultTransaction.id' => $vt_id
					),
				));
				$this->set('TranDetails', $details);

				//call in user details tambahan
				$userId = $details['Vault']['user_id'];
				$user =$this->User->getUserById($userId);
				$this->set('userDetails',$user);
			}

		}
	}
?>