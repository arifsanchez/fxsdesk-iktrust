<?php
App::uses('Controller', 'Controller');
class AppController extends Controller {
	
	var $helpers = array('Form', 'Html', 'Session', 'Js', 'Usermgmt.UserAuth', 'Usermgmt.Image');
	
	public $components = array('Session', 'RequestHandler', 'Usermgmt.UserAuth','Security');

	function beforeFilter() {
		parent::beforeFilter();
    	$this->_setupSecurity();
    	
		$this->userAuth();
	}
	
	private function userAuth() {
		$this->UserAuth->beforeFilter($this);
	}

	public function _setupSecurity() {
	    $this->Security->blackHoleCallback = '_badRequest';
	    if(Configure::read('forceSSL')) {
	        $this->Security->requireSecure('*');
	    }
	}

	/**
	* The main SecurityComponent callback.
	* Handles both missing SSL problems and general bad requests.
	*/

	public function _badRequest() {
	    if(Configure::read('forceSSL') && !$this->RequestHandler->isSSL()) {
	        $this->_forceSSL();
	    } else {
	        $this->cakeError('error400');
	    }
	    exit;
	}

	/**
	* Redirect to the same page, but with the https protocol and exit.
	*/

	public function _forceSSL() {
	    $this->redirect('https://' . env('SERVER_NAME') . $this->here);
	    exit;
	}
}