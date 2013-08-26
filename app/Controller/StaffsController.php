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
				'limit' => 15, 
				'order'=> 'Mt4User.BALANCE DESC',
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
		* STAFF :: Accounts history
		*/
		public function agent_history() {
			//Layout
			$this->layout = "staff.dashboard";
			//Page title
			$page_title = array(
				'icon' => "icon-group",
				'name' => "Agent Acc History"
			);
			$this->set('page_title',$page_title);

			
			//start cari agent ID
			$tracc_id = $this->request->params['named']['process'];

			//listing downline
			$downlines = $this->Mt4User->listingDownline($tracc_id);
			$this->set('downlines', $downlines);

			//Paginate Trader Accounts Listing
			$this->paginate = array(
				'limit' => 35, 
				'order'=> 'Mt4Trade.MODIFY_TIME DESC',
				'recursive'=>0,
				'conditions' =>array(
					'Mt4Trade.LOGIN LIKE' => $tracc_id,
				)
			);
			$trades = $this->paginate('Mt4Trade');
			$this->set('agentPost',$trades);

			if($this->RequestHandler->isAjax()) {
				$this->layout = 'ajax';
				$this->render('agent_history');
			}
		}

		/**
		* STAFF : Listing Semua Open Position
		***/
		public function semua_open_post(){
			
			//Layout
			$this->layout = "staff.dashboard";
			//Page title
			$page_title = array(
				'icon' => "icon-spinner",
				'name' => "All Open Posts"
			);
			$this->set('page_title',$page_title);

			$time = "1970-01-01 00:00:00";
			#debug($time);die();
			$this->paginate = array(
				'limit' => 30, 
				'order'=> 'Mt4Trade.OPEN_TIME DESC',
				'recursive'=>0,
				'conditions' => array(
					'CLOSE_TIME' => $time,
				)
			);
			$openPost = $this->paginate('Mt4Trade');
			#debug($openPost);die();
			$this->set('openPost',$openPost);

			if($this->RequestHandler->isAjax()) {
				$this->layout = 'ajax';
				$this->render('semua_open_post');
			}
		}

		/**
		* STAFF : Kira Semua Open Position
		***/
		public function JumlahOpenPost(){
			$this->layout = "ajax";
			if($this->UserAuth->isLogged()){
				$time = "1970-01-01 00:00:00";
				$total = $this->Mt4Trade->find('count',
					array(
						'order'=> 'Mt4Trade.OPEN_TIME DESC',
						'recursive'=>0,
						'conditions' => array(
							'CLOSE_TIME' => $time,
						)
					)
				);
				if ($this->request->is('requested')) {
					return $total;
				} else {
					$this->set('JumlahOpenPost', $total);
				}
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