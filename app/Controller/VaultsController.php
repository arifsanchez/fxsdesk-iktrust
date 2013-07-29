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
		$balance = $this->Vault->getAcc1Balance($userId);
		return $balance;
		$this->set('balance', $balance);
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

		//Request balance from vault db
		$userId = $this->UserAuth->getUserId();
		$result = $this->Vault->find('first', array(
			'conditions' =>array(
				'user_id' => $userId,
			)
		));
		$this->set('vault_acc',$result);
		
	}

}

?>