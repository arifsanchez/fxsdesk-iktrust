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
		public $uses = array("Vault","VaultTransaction","VaultTransactionComment","Mt4User","Usermgmt.User","Mt4Trade");

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

		/******
		* STAFF :: Tracc History
		******/
		public function tracc_history(){
			//start cari agent ID
			$tracc_id = $this->request->params['named']['process'];

			//Layout
			$this->layout = "staff.dashboard";
			//Page title
			$page_title = array(
				'icon' => "icon-group",
				'name' => "Accounts #".$tracc_id." History"
			);
			$this->set('page_title',$page_title);

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
				$this->render('tracc_history');
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
			//start cari agent ID
			$tracc_id = $this->request->params['named']['process'];

			//Layout
			$this->layout = "staff.dashboard";
			//Page title
			$page_title = array(
				'icon' => "icon-group",
				'name' => "Agent #".$tracc_id." History"
			);
			$this->set('page_title',$page_title);

			$bakiAcc = $this->Mt4User->bakiAcc($tracc_id);
			$this->set('nama_agent',$bakiAcc['Mt4User']['NAME']);
			$this->set('bakiAcc',$bakiAcc['Mt4User']['BALANCE']);

			//listing downline
			$downlines = $this->Mt4User->listingDownline($tracc_id);
			#debug($downlines); die();
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
				$this->Session->setFlash(__('Sorry :( Invalid Transaction.'),'default',array('class' => 'error'));
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

		/*****
		* STAFF :: Change status on the transaction
		******/
		public function updateTransactionStatus(){
			
			#setiap status update params
			$status = $this->request->data['Staff']['status'];
			$transId = $this->request->data['Staff']['transid'];
			$jumlah = $this->request->data['Staff']['jumlah'];
			$userId = $this->request->data['Staff']['userId'];
			$staffId = $this->request->data['Staff']['staffId'];
			$traccId = $this->request->data['Staff']['traccId'];

			## > update status field at VaultTransaction
			$data = array('status' => $status);
			$this->VaultTransaction->id = $transId;
			$this->VaultTransaction->save($data);

			## > add comment to VaultTransactionComment
			$message = $status;
			switch ($message){
				case "1":
				$message = "Status have been updated to NEW request.";
				break;
				case "2":
				$message = "We have received your request and proceeding within 24 hours time. Status have been updated to PENDING for processing request.";
				break;
				case "3":
				$message = "Congratulations ! Your transfer request have been APPROVED.";
				break;
				case "4":
				$message = "Sorry ! Your transfer request have been DECLINED. Please contact our finance department for further info.";
				break;
			};

			$data = array(
				'vault_transaction_id' => $transId,
				'comment' => "$message",
				'user_id' => $staffId
			);
			$this->VaultTransactionComment->create();
			$this->VaultTransactionComment->save($data);

			#initiate finance process
			//Jika status = 2
			## > deduct duit dari wallet 
			## > update acc1 field at Vault
			if($status == 2){
				$vaultId = $this->Vault->find('first', array(
					'conditions' =>array(
						'user_id' => $userId,
					)
				));
				$new_balance = $vaultId['Vault']['acc_1'] - $jumlah;
				$data = array('acc_1' => $new_balance);
				$this->Vault->id = $vaultId['Vault']['id'];
				$this->Vault->save($data);
				#debug($this->request); die();
			}

			//Jika status = 4
			## > refund semula ke dalam IK Wallet
			if($status == 4){
				$vaultId = $this->Vault->find('first', array(
					'conditions' =>array(
						'user_id' => $userId,
					)
				));
				$new_balance = $vaultId['Vault']['acc_1'] + $jumlah;
				$data = array('acc_1' => $new_balance);
				$this->Vault->id = $vaultId['Vault']['id'];
				$this->Vault->save($data);
			}

			//Jika status = 3
			## > run proc_WT_TRACC 
			if($status == 3){
				$data = array(
				'traccId' => $traccId,
				'tambahJumlah' => $jumlah,
				'type' => "WT TRACC",
				);
				#debug($data); die();
				$process = $this->addBalTracc($data);
				$this->log("WT TRACC, ".$jumlah, 'mt4Balance');
			}

			## > sent email status update to finance & user email

			## > sent session flash and back to reffered page
			$this->Session->setFlash(__('Status for transaction #'.$transId.' updated.'),'default',array('class' => 'success'));
			$this->redirect($this->referer());
		}


		/*****
		* STAFF :: Dapatkan who is who info
		******/
		public function requestUserInfo(){
			#debug($this->request->requested);
			$userId = $this->request->requested;
			$result = $this->User->getUserNamePixById($userId);
			return $result;
		}
		/*****
		* STAFF :: Update comment on the transaction
		******/
		public function updateTranComment(){
			#debug($this->request->data); die();
			if($this->request->data['Staff']){
				$data = array(
					'vault_transaction_id' => $this->request->data['Staff']['vault_transaction_id'],
					'comment' => $this->request->data['Staff']['comment'],
					'user_id' => $this->request->data['Staff']['user_id']
				);
				$this->VaultTransactionComment->create();
				$this->VaultTransactionComment->save($data);
				$this->Session->setFlash(__('Comment for transaction #'.$data['vault_transaction_id'].' updated.'),'default',array('class' => 'success'));
				$this->redirect($this->referer());
			} else {
				$this->redirect($this->referer());
			}

		}

		/***
		* BACKEND balance trigger : Request httpsocket to web gateway
		****/
		public function addBalTracc($data){

			$randKey = rand(1000000, 9999999);

			App::uses('HttpSocket', 'Network/Http');
			$HttpSocket = new HttpSocket();

			$mt4data = array(
				'cmd' => 'UserChangeBalance',
				'login' => $data['traccId'], 
				'amount' => $data['tambahJumlah'],
				'comment' => $data['type'].' '.$randKey
			);
			
			$results = $HttpSocket->post('http://iktrust.co.uk/webservice/ikwebgateway/triggerBalance.php', $mt4data);

			$what = json_decode($results->body); 
			$this->log('StatusCode '.$what->result, 'mt4balance');
		}

		/***
		*	STAFF :: All Commissions
		****/
		public function report_commission(){

			//Layout
			$this->layout = "staff.dashboard";
			//Page title
			$page_title = array(
				'icon' => "icon-money",
				'name' => "All Commissions History"
			);
			$this->set('page_title',$page_title);

			//Paginate Trader Accounts Listing
			$this->paginate = array(
				'limit' => 35, 
				'order'=> 'Mt4Trade.MODIFY_TIME DESC',
				'recursive'=>0,
				'conditions' =>array(
					'Mt4Trade.COMMENT LIKE' => '%agent%',
				)
			);
			$trades = $this->paginate('Mt4Trade');
			#debug($trades); die();
			$this->set('reportComm',$trades);

			if($this->RequestHandler->isAjax()) {
				$this->layout = 'ajax';
				$this->render('report_commission');
			}
		}

		/***
		*	STAFF :: All Commissions
		****/
		public function report_rebate(){

			//Layout
			$this->layout = "staff.dashboard";
			//Page title
			$page_title = array(
				'icon' => "icon-money",
				'name' => "All Rebates History"
			);
			$this->set('page_title',$page_title);

			//Paginate Trader Accounts Listing
			$this->paginate = array(
				'limit' => 35, 
				'order'=> 'Mt4Trade.MODIFY_TIME DESC',
				'recursive'=>0,
				'conditions' =>array(
					'Mt4Trade.COMMENT LIKE' => '%rebate%',
				)
			);
			$trades = $this->paginate('Mt4Trade');
			#debug($trades); die();
			$this->set('reportComm',$trades);

			if($this->RequestHandler->isAjax()) {
				$this->layout = 'ajax';
				$this->render('report_rebate');
			}
		}

		/***
		*	STAFF :: All Commissions
		****/
		public function totalOrderBySymbol(){
			/*$result = $this->Mt4Trade->find('count', array(
				'group' => array('Mt4Trade.LOGIN'),
				'recursive'=>0,
				'conditions' =>array(
				''
				)
			));
			*/

			$semalam = strtotime("yesterday");
			App::uses('CakeTime', 'Utility');
			$semalam =  CakeTime::nice($semalam);
			debug($semalam);
			#debug($result); 
			die();
		}

	}
?>