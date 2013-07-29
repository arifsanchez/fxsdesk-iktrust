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
	public $uses = array("Mt4User","Usermgmt.User","Mt4Trade");

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

		//Dev data
		$acc = '6666';

		//Pull info trader
		$user = $this->UserAuth->getUser();
		$result = $this->Mt4User->find('first', array(
			'conditions' =>array(
				'Mt4User.LOGIN' => $acc,
			)
		));
		if($result['Mt4User']['EMAIL'] == $user['User']['email']){
			$this->set('MT_ACC',$result);	
		} else {
			$this->Session->setFlash('You are not authorized to acess trading account #'.$acc.' details.', 'default', array('class' => 'alert alert-error'));
			$this->redirect(array('action' => 'listing'));
		}

	}

}

?>