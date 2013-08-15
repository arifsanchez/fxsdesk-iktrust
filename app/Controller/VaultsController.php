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
	public $uses = array("Vault","Mt4User","Usermgmt.User","Mt4Trade");
	
	/**
	 * This controller uses following components
	 *
	 * @var array
	 */
	public $components = array('RequestHandler', 'Cookie');

	/**
	 * Request Account 1 Balance
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
		$acc1 = $this->Vault->getAccBalance($userId);
		$this->set('acc1', $acc1['Vault']['acc_1']);
		$this->set('acc2', $acc1['Vault']['acc_2']);
		
		//Dapatkan senarai trading account
		$userEmail = $this->User->getEmailById($userId);
		$tradeAcc = $this->Mt4User->listTradeAcc($userEmail);
		$this->set('tradeAcc', $tradeAcc);
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

}

?>