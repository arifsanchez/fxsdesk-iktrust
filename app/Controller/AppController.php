<?php
App::uses('Controller', 'Controller');
class AppController extends Controller {
	
	var $helpers = array('Form', 'Html', 'Session', 'Js', 'Usermgmt.UserAuth', 'Usermgmt.Image');
	
	public $components = array('Session', 'RequestHandler', 'Usermgmt.UserAuth','Security');

	function beforeFilter() {
		//REDIRECT TO HTTPS IF REQUEST IS NOT HTTPS
		if($_SERVER['HTTPS']!="on")
		{
			$redirect= "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
			header( "HTTP/1.1 301 Moved Permanently" );
			header("Location:$redirect");
			exit;
		}
		
		$this->userAuth();
	}
	
	private function userAuth() {
		$this->UserAuth->beforeFilter($this);
	}
}