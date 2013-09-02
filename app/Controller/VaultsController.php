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
	public $uses = array("Vault","VaultTransaction","Mt4User","Usermgmt.User","Mt4Trade");
	
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
	 * Deposit :: Process depos acc from wallet
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
		#debug($bakiAcc1Wallet);

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
				$data = array(
					'vault_id' => $vaultId,
					'jumlah' => $intmount,
					'tracc_no' => $acc,
					'type' => 1,
					'status' => 1,
					'description' => "TR IK WALLET #".$vaultId
				);
				//sent to transfer request queue
				$this->VaultTransaction->create();
				$this->VaultTransaction->save($data);
				$this->Session->setFlash(__('Transfer request has been sent to IK Trust HQ'),'default',array('class' => 'success'));
				$this->redirect(array('controller' =>'vaults', 'action' => 'mywallet_history'));
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
	public function kiraTotalWallet() {
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

}

?>