<?php
	#Vault Controller

	App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class VaultsController extends AppController {

/**
 * Controller name
 *
 * @var string
 */
	public $name = 'Vaults';

	/**
	 * This controller use vaults models and few other platform models
	 * @var array
	 */
	public $uses = array("Vault","VaultTransaction","VaultTransactionComment","Mt4User","Usermgmt.User","Mt4Trade");
	
	/**
	 * This controller uses following components
	 *
	 * @var array
	 */
	public $components = array('RequestHandler', 'Cookie');

	/**
	 * USER : Request Account 1 Balance
	 *
	 * @access public
	 * @return array
	 */
	public function acc1_balance() {
		$this->layout = "ajax";
		$userId = $this->UserAuth->getUserId();
		$balance = $this->Vault->getAccBalance($userId);
		#debug($balance['Vault']['acc_1']);die();
		if ($this->request->is('requested')) {
			$bal = $balance['Vault']['acc_1'];
			return $bal;

			$cred = $balance['Vault']['acc_2'];
			return $cred;
		} else {
			$this->set('balance', $balance['Vault']['acc_1']);
		}
	}

	/**
	 * Management of Wallet
	 *
	 * @access public
	 * @return array
	 */
	public function manage() {
		//Layout
		$this->layout = "trader.dashboard";
		//Page title
		$page_title = array(
			'icon' => "icon-money",
			'name' => "My Wallet"
		);
		$this->set('page_title',$page_title);

		//Dapatkan user id
		$userId = $this->UserAuth->getUserId();
		//Check jika traders first time buka vault
		$checkVault = $this->Vault->checkVaultAccount($userId);

		//Request balance from vault db
		$vacc = $this->Vault->getAccBalance($userId);
		$this->set('acc1', $vacc['Vault']['acc_1']);
		$this->set('acc2', $vacc['Vault']['acc_2']);
		
		//Dapatkan senarai trading account
		$userEmail = $this->User->getEmailById($userId);
		$tradeAcc = $this->Mt4User->listTradeAcc($userEmail);
		$this->set('tradeAcc', $tradeAcc);

		//request transaction dari vault == latest
		$vtrans = $this->VaultTransaction->listAllLatest($vacc['Vault']['id']);
		$this->set('vtrans_latest', $vtrans);

		//request transaction dari vault == new
		$vtrans1 = $this->VaultTransaction->listAllNew($vacc['Vault']['id']);
		$this->set('vtrans_new', $vtrans1);

		//request transaction dari vault == pending
		$vtrans2 = $this->VaultTransaction->listAllPending($vacc['Vault']['id']);
		$this->set('vtrans_pending', $vtrans2);

		//request transaction dari vault == approve
		$vtrans3 = $this->VaultTransaction->listAllApprove($vacc['Vault']['id']);
		$this->set('vtrans_approve', $vtrans3);

		//request transaction dari vault == decline
		$vtrans4 = $this->VaultTransaction->listAllDecline($vacc['Vault']['id']);
		$this->set('vtrans_decline', $vtrans4);
	}

	/**
	 * Wallet Transaction History
	 *
	 * @access public
	 * @return array
	 */
	public function mywallet_history() {
		//Layout
		$this->layout = "trader.dashboard";
		//Page title
		$page_title = array(
			'icon' => "icon-money",
			'name' => "My Wallet History"
		);
		$this->set('page_title',$page_title);

		//Dapatkan user id
		$userId = $this->UserAuth->getUserId();
		//Check jika traders first time buka vault
		$checkVault = $this->Vault->checkVaultAccount($userId);
		$acc1 = $this->Vault->getAccBalance($userId);

		//list with paginate all transaction history
		$this->paginate = array(
			'order' => 'VaultTransaction.created DESC',
			'limit' => 10,
			'conditions' =>array(
				'VaultTransaction.vault_id' => $acc1['Vault']['id'],
		));
		$Wtransact = $this->paginate('VaultTransaction');
		#debug($Wtransact); die();
		$this->set('Wtransact',$Wtransact);

		if($this->RequestHandler->isAjax()) {
			$this->layout = 'ajax';
			$this->render('mywallet_history');
		}
	}

	/**
	 * TRADER :: Wallet Transaction 
	 *
	 * @access public
	 * @return array
	 */
	public function mywallet_transaction() {
		//check for param request
		#debug($this->request->params['named']['process']); die();
		if($this->request->params['named']['process'] == null){
			//jika kosong hantar terus ke page listing
			$this->Session->setFlash(__('Sorry :( Invalid Transaction.'),'default',array('class' => 'error'));
			$this->redirect(array('action' => 'mywallet_history/filter:new'));
		} else {
			//Layout
			$this->layout = "trader.dashboard";
			//Page title
			$page_title = array(
				'icon' => "icon-money",
				'name' => "Transaction Detail"
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
	* Trader :: Update comment on the transaction
	******/
	public function updateTranComment_trader(){
	#debug($this->request->data); die();
		$this->layout = "ajax";
		if($this->request->data['Vault']){
			$data = array(
				'vault_transaction_id' => $this->request->data['Vault']['vault_transaction_id'],
				'comment' => $this->request->data['Vault']['comment'],
				'user_id' => $this->request->data['Vault']['user_id']
			);

			#debug($data);die();
			$this->VaultTransactionComment->create();
			$this->VaultTransactionComment->save($data);
			$this->Session->setFlash(__('Comment for transaction #'.$data['vault_transaction_id'].' updated.'),'default',array('class' => 'success'));
			$this->redirect(array('controller' => 'Vaults', 'action' => 'mywallet_transaction/process:'.$data['vault_transaction_id'], 'plugin' => ''));
		} else {
			$this->Session->setFlash(__('Sorry ! , Invalid request.'),'default',array('class' => 'error'));
			$this->redirect(array('controller' => 'Vaults', 'action' => 'mywallet_transaction/process:'.$data['vault_transaction_id'], 'plugin' => ''));
		}

	}

	/*****
	* TRADER :: Dapatkan who is who info for trader
	******/
	public function requestUserInfo_trader(){
		#debug($this->request->params['uid']);
		$this->layout = "ajax"; 
		$userId = $this->request->params['uid'];
		$result = $this->User->getUserNamePixById($userId);
		return $result;
	}

	/**
	 * Deposit :: Bank Trasfer
	 *
	 * @access public
	 * @return array
	 */
	public function dp_banktransfer() {
		//Layout
		$this->layout = "trader.dashboard";
		//Page title
		$page_title = array(
			'icon' => "glyphicon-bank",
			'name' => "Deposit via Bank Transfer"
		);
		$this->set('page_title',$page_title);

		//Dapatkan user id
		$userId = $this->UserAuth->getUserId();
		//Check jika traders first time buka vault
		$checkVault = $this->Vault->checkVaultAccount($userId);
		$acc1 = $this->Vault->getAccBalance($userId);
		$this->set('acc1', $acc1);

	}

	/**
	 * Deposit :: Request Bank Trasfer confirmation
	 *
	 * @access public
	 * @return array
	 */
	public function request_deposit_banktransfer() {
		//Layout
		$this->layout = "ajax";

		if($this->request->data){
			#debug($this->request->data); die();
			//coming soon
			$this->Session->setFlash(__('Deposit via Bank Transfer request will be available soon.'),'default',array('class' => 'error'));
			$this->redirect(array('controller' =>'vaults', 'action' => 'manage'));
			
			//>> Vault ID
			$userId = $this->UserAuth->getUserId();
			$vault_id = $this->Vault->getID($userId);
			debug($vaultSiapa); die();
			$this->set('vaultSiapa', $vault_id['Vault']['id']);

			//>> Amount Request
			$amntReq = "100";
			$this->set('amount_request', $amntReq); 

			//>> Amount Due

			//save to vault transaction as new request
			$data = array(
				'vault_id' => $vault_id['Vault']['id'],
				'jumlah' => $this->request->data['Vault']['amount'],
				'type' => 2,
				'status' => 1,
				'description' => $this->request->data['Vault']['channel']
			);
			debug($data);
			#$this->VaultTransaction->create();
			#$this->VaultTransaction->save($data);

			//sent to transfer request queue

			//>> Invoice number = Transaction ID
			#$TRid = $vt_new['VaultTransaction']['id'];
			#$VId = $vault_id['Vault']['id'];
			#$trDate = $this->Time->toUnix($vt_new['VaultTransaction']['created'], null);
			#"TR-".$trDate."-".$VId."-".$TRid
			$invID = "IK1234";
			$this->set('invoiceID', $invID);

			$this->redirect(array('controller' =>'vaults', 'action' => 'invoice_bank_transfer','/request_queue:'.$INVid));
		}
		
	}

	/**
	 * Invoice Bank Transfer
	 *
	 * @access public
	 * @return array
	 */
	public function invoice_bank_transfer() {
		
		//dapatkan request id
		$INVid = $this->request->params['named']['request_queue'];
		if($this->request->params['named']['request_queue'] == null){
			$this->redirect(array('controller' =>'vaults', 'action' => 'manage'));
		}

		//Layout
		$this->layout = "trader.dashboard";
		//Page title
		$page_title = array(
			'icon' => "icon-money",
			'name' => "Invoice #".$INVid
		);
		$this->set('page_title',$page_title);

	}

	/**
	 * Deposit :: Credit Card
	 *
	 * @access public
	 * @return array
	 */
	public function dp_creditcard() {
		//Layout
		$this->layout = "trader.dashboard";
		//Page title
		$page_title = array(
			'icon' => "icon-money",
			'name' => "Deposit via Credit Card"
		);
		$this->set('page_title',$page_title);


	}

	/**
	 * Deposit :: Perfect Money
	 *
	 * @access public
	 * @return array
	 */
	public function dp_perfectmoney() {
		//Layout
		$this->layout = "trader.dashboard";
		//Page title
		$page_title = array(
			'icon' => "icon-money",
			'name' => "Deposit via Perfect Money"
		);
		$this->set('page_title',$page_title);

	}

	/**
	 * Deposit :: Webmoney
	 *
	 * @access public
	 * @return array
	 */
	public function dp_webmoney() {
		//Layout
		$this->layout = "trader.dashboard";
		//Page title
		$page_title = array(
			'icon' => "icon-money",
			'name' => "Deposit via Webmoney"
		);
		$this->set('page_title',$page_title);

	}
	
	/**
	 * Deposit :: IK Topup Card
	 *
	 * @access public
	 * @return array
	 */
	public function dp_ikcard() {
		//Layout
		$this->layout = "trader.dashboard";
		//Page title
		$page_title = array(
			'icon' => "icon-money",
			'name' => "Deposit via IK Topup Card"
		);
		$this->set('page_title',$page_title);

	}

	/**
	 * Deposit :: IK Marketplace
	 *
	 * @access public
	 * @return array
	 */
	public function dp_ikmarketplace() {
		//Layout
		$this->layout = "trader.dashboard";
		//Page title
		$page_title = array(
			'icon' => "icon-money",
			'name' => "Deposit via IK Marketplace"
		);
		$this->set('page_title',$page_title);

	}

	/**
	 * Deposit :: Payza
	 *
	 * @access public
	 * @return array
	 */
	public function dp_payza() {
		//Layout
		$this->layout = "trader.dashboard";
		//Page title
		$page_title = array(
			'icon' => "icon-money",
			'name' => "Deposit via Payza"
		);
		$this->set('page_title',$page_title);

	}

	/**
	 * TRADER :: Request transfer from wallet to tracc
	 *
	 * @access public
	 * @return array
	 */
	public function procdpaccwallet() {
		//request baki acc1
		$userId = $this->UserAuth->getUserId();
		$acc1 = $this->Vault->getAccBalance($userId);
		$vaultId = $acc1['Vault']['id'];
		$bakiAcc1Wallet = $acc1['Vault']['acc_1'];

		//get berapa amount nak transfer dari form
		$request = $this->request->data;

		if($request){
			$i = $request['Vault']['amount'];
			$acc = $request['Vault']['acc_trading'];

			App::uses('CakeNumber', 'Utility');
			$intmount = CakeNumber::precision($i,2);
			#debug($intmount);

			if ($intmount > $bakiAcc1Wallet){

				$this->Session->setFlash(__('Wallet Balance Insufficient for the transfer request.'),'default',array('class' => 'error'));
				$this->redirect(array('controller' =>'vaults', 'action' => 'manage'));
			} else if($intmount == 0){
				$this->Session->setFlash(__('Sorry, you have not enter any amount to transfer.'),'default',array('class' => 'info'));
				$this->redirect(array('controller' =>'vaults', 'action' => 'manage'));
			} else {
				if($request['Vault']['partner'] == 'yes'){
					$typecode = 10;
					$comment = "Vault Transfer #";
				} else if($request['Vault']['partner'] == null) {
					$typecode = 1;
					$comment = "Wallet Transfer #";
				}
				$data = array(
					'vault_id' => $vaultId,
					'jumlah' => $intmount,
					'tracc_no' => $acc,
					'type' => $typecode,
					'status' => 1,
					'description' => $comment.$vaultId
				);
				//sent to transfer request queue
				$this->VaultTransaction->create();
				$this->VaultTransaction->save($data);
				$this->Session->setFlash(__('Transfer request has been sent to IK Trust HQ'),'default',array('class' => 'success'));
				
				if($request['Vault']['partner'] == 'yes'){
					$this->redirect(array('controller' =>'partners', 'action' => 'vault_history'));	
				} else if($request['Vault']['partner'] == null){
					$this->redirect(array('controller' =>'vaults', 'action' => 'mywallet_history'));
				}
			}
		} else {
			$this->redirect(array('controller' =>'vaults', 'action' => 'manage'));
		}
	}

	/**
	 * TRADER :: Request transfer from tracc to wallet
	 *
	 * @access public
	 * @return array
	 */
	public function procwdaccwallet() {
		
		//sorting data masuk
		$request = $this->request->data;
		$userId = $this->UserAuth->getUserId();
		$acc1 = $this->Vault->getAccBalance($userId);
		$tracc = $request['Vault']['acc_trading'];
		$vaultId = $acc1['Vault']['id'];
		$bakiTracc = $this->Mt4User->bakiAcc($tracc);
		
		#debug($request); die();
		if($request){
			$i = $request['Vault']['amount'];
			
			#debug($bakiTracc); die();
			App::uses('CakeNumber', 'Utility');
			$intmount = CakeNumber::precision($i,2);
			#debug($intmount);

			if ($intmount > $bakiTracc['Mt4User']['BALANCE']){

				$this->Session->setFlash(__('Trading Account Balance Insufficient for the transfer request.'),'default',array('class' => 'error'));
				$this->redirect(array('controller' =>'vaults', 'action' => 'manage'));
			} else if($intmount == 0){
				$this->Session->setFlash(__('Sorry, you have not enter any amount to transfer.'),'default',array('class' => 'info'));
				$this->redirect(array('controller' =>'vaults', 'action' => 'manage'));
			} else {
				if($request['Vault']['partner'] == 'yes'){
					$typecode = 40;
					$comment = "Vault Transfer #";
				} else {
					$typecode = 4;
					$comment = "Wallet Transfer #";
				}
				$data = array(
					'vault_id' => $vaultId,
					'jumlah' => $intmount,
					'tracc_no' => $tracc,
					'type' => $typecode,
					'status' => 1,
					'description' => $comment.$tracc
				);
				//sent to transfer request queue
				$this->VaultTransaction->create();
				$this->VaultTransaction->save($data);
				$this->Session->setFlash(__('Transfer request has been sent to IK Trust HQ'),'default',array('class' => 'success'));

				if($request['Vault']['partner'] == 'yes'){
					$this->redirect(array('controller' =>'partners', 'action' => 'vault_history'));	
				} else {				
					$this->redirect(array('controller' =>'vaults', 'action' => 'mywallet_history'));
				}
			}
		} else {
			$this->redirect(array('controller' =>'vaults', 'action' => 'manage'));
		}
	}

	/**
	 * STAFF : Request Total IK Wallet
	 *
	 * @access public
	 * @return array
	 */
	public function kiraTotalWalletClient() {
		$this->layout = "ajax";
		if($this->UserAuth->isLogged()){
			$total = $this->Vault->kiraTotalWallet();
			#debug($total['0']['0']['total']);die();
			$total = $total['0']['0']['total'];
			if ($this->request->is('requested')) {
				return $total;
			} else {
				$this->set('TotalWallet', $total);
			}
		}
	}

	/**
	 * STAFF : Request Total IK Wallet Partner
	 *
	 * @access public
	 * @return array
	 */
	public function kiraTotalWalletPartner() {
		$this->layout = "ajax";
		if($this->UserAuth->isLogged()){
			$total = $this->Vault->kiraTotalWalletPartner();
			#debug($total['0']['0']['total']);die();
			$total = $total['0']['0']['total'];
			if ($this->request->is('requested')) {
				return $total;
			} else {
				$this->set('TotalWallet', $total);
			}
		}
	}

	/**
	 * STAFF : Kira Total Transfer to TradAcc Transaction with status New
	 *
	 * @access public
	 * @return array
	 */
	public function kiraTotalNewTRW_TRACC() {
		$this->layout = "ajax";
		if($this->UserAuth->isLogged()){
			$total = $this->VaultTransaction->kiraTotalNewTRW_TRACC();
			#debug($total);die();
			if ($this->request->is('requested')) {
				return $total;
			} else {
				$this->set('totalTRW_TRACC', $total);
			}
		}
	}

	/**
	 * STAFF : Kira Total Transfer to TradAcc Transaction with status Pending
	 *
	 * @access public
	 * @return array
	 */
	public function kiraTotalNewTRW_TRACC_code2() {
		$this->layout = "ajax";
		if($this->UserAuth->isLogged()){
			$total = $this->VaultTransaction->kiraTotalNewTRW_TRACC_code2();
			#debug($total);die();
			if ($this->request->is('requested')) {
				return $total;
			} else {
				$this->set('totalTRW_TRACC', $total);
			}
		}
	}

	/**
	 * STAFF : Kira Total Transfer to TradAcc Transaction with status Approve
	 *
	 * @access public
	 * @return array
	 */
	public function kiraTotalNewTRW_TRACC_code3() {
		$this->layout = "ajax";
		if($this->UserAuth->isLogged()){
			$total = $this->VaultTransaction->kiraTotalNewTRW_TRACC_code3();
			#debug($total);die();
			if ($this->request->is('requested')) {
				return $total;
			} else {
				$this->set('totalTRW_TRACC', $total);
			}
		}
	}

}

?>