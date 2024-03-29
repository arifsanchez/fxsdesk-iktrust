<?php
App::uses('UserMgmtAppController', 'Usermgmt.Controller');
class UsersController extends UserMgmtAppController {
	/**
	 * This controller uses following models
	 *
	 * @var array
	 */
	public $uses = array('Vault','Usermgmt.User', 'Usermgmt.UserGroup', 'Usermgmt.UserSetting', 'Usermgmt.TmpEmail', 'Usermgmt.UserDetail', 'Usermgmt.UserActivity', 'Usermgmt.LoginToken', 'Usermgmt.UserGroupPermission', 'Usermgmt.UserContact');
	/**
	 * This controller uses following components
	 *
	 * @var array
	 */
	public $components = array('RequestHandler', 'Usermgmt.UserConnect', 'Cookie', 'Usermgmt.Search', 'Usermgmt.ControllerList');
	/**
	 * This controller uses following default pagination values
	 *
	 * @var array
	 */
	public $paginate = array(
		'limit' => 25
	);
	/**
	 * This controller uses following helpers
	 *
	 * @var array
	 */
	public $helpers = array('Js', 'Usermgmt.Tinymce', 'Usermgmt.Ckeditor');
	/**
	 * This controller uses search filters in following functions for ex index, online function
	 *
	 * @var array
	 */
	var $searchFields = array
		(
			'index' => array(
				'User' => array(
					'User'=> array(
						'type' => 'text',
						'label' => 'Search',
						'tagline' => 'Search by name, username, email',
						'condition' => 'multiple',
						'searchFields'=>array('User.first_name', 'User.last_name', 'User.username', 'User.email'),
						'searchFunc'=>array('plugin'=>'usermgmt', 'controller'=>'Users', 'function'=>'indexSearch'),
						'inputOptions'=>array('style'=>'width:200px;')
					),
					'User.id'=> array(
						'type' => 'text',
						'condition' => '=',
						'label' => 'User Id',
						'inputOptions'=>array('style'=>'width:50px;')
					),
					'User.user_group_id' => array(
						'type' => 'select',
						'condition' => 'comma',
						'label' => 'Group',
						'model' => 'UserGroup',
						'selector' => 'getGroups'
					),
					'User.email_verified' => array(
						'type' => 'select',
						'label' => 'Email Verified',
						'options' => array(''=>'Select', '0'=>'No', '1'=>'Yes')
					),
					'User.active' => array(
						'type' => 'select',
						'label' => 'Status',
						'options' => array(''=>'Select', '1'=>'Active', '0'=>'Inactive')
					)
				)
			),
			'online' => array(
				'UserActivity' => array(
					'UserActivity'=> array(
						'type' => 'text',
						'label' => 'Search',
						'tagline' => 'Search by name, email, ip address',
						'condition' => 'multiple',
						'searchFields'=>array('User.first_name', 'User.last_name', 'User.email', 'UserActivity.ip_address'),
						'inputOptions'=>array('style'=>'width:200px;')
					),
					'UserActivity.status' => array(
						'type' => 'select',
						'label' => 'Status',
						'options' => array(''=>'Select', '0'=>'Guest', '1'=>'Online')
					)
				)
			)
		);
	/**
	 * Called before the controller action.  You can use this method to configure and customize components
	 * or perform logic that needs to happen before each controller action.
	 *
	 * @return void
	 */
	public function beforeFilter() {
		parent::beforeFilter();
		$this->User->userAuth=$this->UserAuth;
		if(isset($this->Security) &&  ($this->RequestHandler->isAjax() || $this->action=='login')){
			$this->Security->csrfCheck = false;
			$this->Security->validatePost = false;
		}
	}
	/**
	 * It displays all users details
	 *
	 * @access public
	 * @return array
	 */
	public function index() {
        $this->layout = 'staff.dashboard';
        //Page title
			$page_title = array(
				'icon' => "glyphicon-parents",
				'name' => "All Clients"
			);
			$this->set('page_title',$page_title);
		$this->paginate = array('limit' => 20, 'order'=>'User.id desc', 'recursive'=>1);
		$users = $this->paginate('User');
		$i=0;
		foreach($users as $user) {
			$users[$i]['UserGroup']['name']=$this->UserGroup->getGroupsByIds($user['User']['user_group_id']);
			$i++;
		}
		$this->set('users', $users);
		if($this->RequestHandler->isAjax()) {
			$this->layout = 'ajax';
			$this->render('/Elements/filter_table');
		}
	}
	/**
	 * It displays search suggestions on all users index page
	 *
	 * @access public
	 * @return json
	 */
	public function indexSearch() {
		if($this->RequestHandler->isAjax()) {
			$results = array();
			if(isset($_GET['term'])) {
				$query = $_GET['term'];
				$results = $this->User->find('all', array('conditions'=>array('OR'=>array(array('User.username LIKE'=>'%'.$query.'%'), array('User.first_name LIKE'=>'%'.$query.'%'), array('User.last_name LIKE'=>'%'.$query.'%'), array('User.email LIKE'=>'%'.$query.'%@%'))), 'fields'=>array('User.username', 'User.first_name', 'User.last_name', 'User.email')));
			}
			$resultToPrint=array();
			$usernames=array();
			$names=array();
			$emails=array();
			foreach($results as $res) {
				if(stripos($res['User']['first_name'], $query) !==false || stripos($res['User']['last_name'], $query) !==false) {
					$names[] =$res['User']['first_name'].' '.$res['User']['last_name'];
				}
				if(stripos($res['User']['email'], $query) !==false) {
					$emails[] =$res['User']['email'];
				}
				if(stripos($res['User']['username'], $query) !==false) {
					$usernames[] =$res['User']['username'];
				}
			}
			$names = array_unique($names);
			$emails = array_unique($emails);
			$usernames = array_unique($usernames);
			$resultToPrint = array_merge($usernames, $names, $emails);
		}
		echo json_encode($resultToPrint);
		exit;
	}
	/**
	 * It displays all online users with in specified time
	 *
	 * @access public
	 * @return array
	 */
	public function online() {
		$this->paginate = array('limit' => 10, 'order'=>'UserActivity.modified desc', 'conditions'=>array('UserActivity.modified >'=>(date('Y-m-d G:i:s', strtotime('-'.VIEW_ONLINE_USER_TIME.' minutes', time()))), 'UserActivity.logout'=>0), 'fields'=>array('UserActivity.*', 'User.first_name', 'User.last_name', 'User.email'));
		$users = $this->paginate('UserActivity');
		$this->set('users', $users);
		if($this->RequestHandler->isAjax()) {
			$this->layout = 'ajax';
			$this->render('/Elements/online_users');
		}
	}
	/**
	 * It displays single user's full details by user id
	 *
	 * @access public
	 * @param integer $userId user id of user
	 * @return array
	 */
	public function viewUser($userId=null) {

		$page= (isset($this->request->params['named']['page'])) ? $this->request->params['named']['page'] : 1;
		if (!empty($userId)) {
			$user = $this->User->read(null, $userId);
			if(empty($user)) {
				$this->redirect(array('action'=>'index', 'page'=>$page));
			}
			$user['UserGroup']['name']=$this->UserGroup->getGroupsByIds($user['User']['user_group_id']);
			$this->set('user', $user);
			$this->set('userId', $userId);
		} else {
			$this->redirect(array('action'=>'index', 'page'=>$page));
		}
	}
	/**
	 * It displays logged in user's full details to user itself
	 *
	 * @access public
	 * @return array
	 */
	public function myprofile() {
		//Layout
		$this->layout = "trader.dashboard";
		//Page title
		$page_title = array(
			'icon' => "glyphicon-vcard",
			'name' => "Profile"
		);
		$this->set('page_title',$page_title);

		$userId = $this->UserAuth->getUserId();
		$user = $this->User->read(null, $userId);
		$user['UserGroup']['name']=$this->UserGroup->getGroupsByIds($user['User']['user_group_id']);
		$this->set('user', $user);
	}
	/**
	 * It is used to edit personal profile by user
	 *
	 * @access public
	 * @return array
	 */
	public function editProfile() {
		//Layout
		$this->layout = "trader.dashboard";
		//Page title
		$page_title = array(
			'icon' => "glyphicon-vcard",
			'name' => "Update Profile"
		);
		$this->set('page_title',$page_title);

		$userId = $this->UserAuth->getUserId();
		if (!empty($userId)) {
			#debug($this->request->data); die();
			$gender= $this->User->getGenderArray();
			$this->set('gender', $gender);
			$marital= $this->User->getMaritalArray();
			$this->set('marital', $marital);
			if ($this->request->isPut() || $this->request->isPost()) {
				$this->User->set($this->data);
				$this->UserDetail->set($this->data);
				$UserRegisterValidate = $this->User->RegisterValidate();
				$UserDetailRegisterValidate = $this->UserDetail->RegisterValidate();
				if($this->RequestHandler->isAjax()) {
					$this->layout = 'ajax';
					$this->autoRender = false;
					if ($UserRegisterValidate && $UserDetailRegisterValidate) {
						$response = array('error' => 0, 'message' => 'Succes');
						return json_encode($response);
					} else {
						$response = array('error' => 1,'message' => 'failure');
						$response['data']['User']   = $this->User->validationErrors;
						$response['data']['UserDetail'] = $this->UserDetail->validationErrors;
						return json_encode($response);
					}
				} else {
					if ($UserRegisterValidate && $UserDetailRegisterValidate) {
						if(is_uploaded_file($this->request->data['UserDetail']['photo']['tmp_name']) && !empty($this->request->data['UserDetail']['photo']['tmp_name'])) {
							$path_info = pathinfo($this->request->data['UserDetail']['photo']['name']);
							chmod ($this->request->data['UserDetail']['photo']['tmp_name'], 0644);
							$photo=time().mt_rand().".".$path_info['extension'];
							$fullpath= WWW_ROOT."img".DS.IMG_DIR;
							$res1 = is_dir($fullpath);
							if($res1 != 1)
								$res2= mkdir($fullpath, 0777, true);
							move_uploaded_file($this->request->data['UserDetail']['photo']['tmp_name'],$fullpath.DS.$photo);
							$this->request->data['UserDetail']['photo']=$photo;
						} else {
							unset($this->request->data['UserDetail']['photo']);
						}
						if(!ALLOW_CHANGE_USERNAME) {
							unset($this->request->data['User']['username']);
						}
						unset($this->request->data['User']['user_group_id']);
						$user =$this->User->getUserById($userId);
						if($user['User']['email'] != $this->request->data['User']['email']) {
							$this->request->data['User']['email_verified']=0;
							$user['User']['email']= $this->request->data['User']['email'];
							$this->User->sendVerificationMail($user);
							$this->LoginToken->deleteAll(array('LoginToken.user_id'=>$userId), false);
						}
						if(empty($user['User']['ip_address'])) {
							if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
								$this->request->data['User']['ip_address']=$_SERVER['HTTP_X_FORWARDED_FOR'];
							}
						}

						$this->User->saveAssociated($this->request->data);
						$this->Session->setFlash(__('Your profile has been successfully updated'), 'default', array('class' => 'success'));
						$this->redirect('/myprofile');
					}
				}
			} else {
				$user = $this->User->read(null, $userId);
				$this->request->data=null;
				if (!empty($user)) {
					$user['User']['password']='';
					$this->request->data = $user;
				}
			}
		} else {
			$this->redirect('/myprofile');
		}
	}
	/**
	 * It is used to log in user on the site by normal, facebook, twitter etc
	 *
	 * @access public
	 * @param string $connect login type for e.g. fb, twt or null for normal login
	 * @return void
	 */
	public function login($connect=null) {

		$this->layout = "public.access";

		$userId = $this->UserAuth->getUserId();
		if ($userId) {
			if($connect) {
				$this->render('popup');
			} else {
				$this->redirect("/dashboard");
			}
		}
		if($connect=='fb') {
			$this->login_facebook();
			$this->render('popup');
		} elseif($connect=='twt') {
			$this->login_twitter();
			$this->render('popup');
		} elseif($connect=='gmail') {
			$this->login_gmail();
			$this->render('popup');
		} elseif($connect=='ldn') {
			$this->login_linkedin();
			$this->render('popup');
		} elseif($connect=='fs') {
			$this->login_foursquare();
			$this->render('popup');
		} elseif($connect=='yahoo') {
			$this->login_yahoo();
			$this->render('popup');
		} else {
			if ($this->request->isPost()) {
				$errorMsg="";
				$loginValid=false;
				$this->User->set($this->data);
				$UserLoginValidate = $this->User->LoginValidate();
				if($UserLoginValidate) {
					$email  = $this->data['User']['email'];
					$password = $this->data['User']['password'];
					$user = $this->User->findByUsername($email);
					if(empty($user)) {
						$user = $this->User->findByEmail($email);
						if (empty($user)) {
							$errorMsg = __('Incorrect Email/Username or Password', true);
						}
					}
					if($user) {
						$hashed = $this->UserAuth->makePassword($password, $user['User']['salt']);
						if ($user['User']['password'] === $hashed) {
							if ($user['User']['active']==1) {
								if ($user['User']['email_verified']==1) {
									$loginValid=true;
								} else {
									$errorMsg = __('Your email has not been verified yet, please check your email for instruction', true);
								}
							} else {
								$errorMsg = __('Sorry ! Your account is not active, please contact our support team', true);
							}
						} else {
							$errorMsg = __('Incorrect Email/Username or Password', true);
						}
					}
				}
				if($this->RequestHandler->isAjax()) {
					$this->layout = 'ajax';
					$this->autoRender = false;
					if ($UserLoginValidate && $loginValid) {
						$response = array('error' => 0, 'message' => 'Succes');
						return json_encode($response);
					} else {
						$response = array('error' => 1,'message' => 'failure');
						if(empty($errorMsg)) {
							$response['data']['User'] = $this->User->validationErrors;
						} else {
							$response['data']['User'] = array('email'=>array($errorMsg));
						}
						return json_encode($response);
					}
				} else {
					if ($UserLoginValidate && $loginValid) {
						$this->UserAuth->login($user);
						$remember = (!empty($this->data['User']['remember']));
						if ($remember) {
							$this->UserAuth->persist('2 weeks');
						}
						$OriginAfterLogin=$this->Session->read('Usermgmt.OriginAfterLogin');
						$this->Session->delete('Usermgmt.OriginAfterLogin');
						$redirect = (!empty($OriginAfterLogin)) ? $OriginAfterLogin : LOGIN_REDIRECT_URL;
						$this->redirect($redirect);
					} else {
						$this->Session->setFlash(__($errorMsg), 'default', array('class' => 'error'));

					}
				}
			}
		}
	}
	private function login_facebook() {
		$userId = $this->UserAuth->getUserId();
		$this->Session->read();
		$this->layout=NULL;
		$fbData=$this->UserConnect->facebook_connect();
		if(isset($_GET['error'])) {
			/* Do nothing user canceled authentication */
		} elseif(!empty($fbData['loginUrl'])) {
			$this->redirect($fbData['loginUrl']);
		} else {
			$emailCheck=true;
			if(!empty($fbData['user_profile']['id'])) {
				$user = $this->User->findByFbId($fbData['user_profile']['id']);
				if(empty($user)) {
					$user = $this->User->findByEmail($fbData['user_profile']['email']);
					$emailCheck=false;
				}
				if(empty($user)) {
					if(SITE_REGISTRATION) {
						$user['User']['fb_id']=$fbData['user_profile']['id'];
						$user['User']['fb_access_token']=$fbData['user_profile']['accessToken'];
						$user['User']['user_group_id']=DEFAULT_GROUP_ID;
						if(!empty($fbData['user_profile']['username'])) {
							$user['User']['username']= $this->generateUserName($fbData['user_profile']['username']);
						} else {
							$user['User']['username']= $this->generateUserName($fbData['user_profile']['name']);
						}
						$password = $this->UserAuth->generatePassword();
						$user['User']['password'] = $this->UserAuth->generatePassword($password);
						$user['User']['email']=$fbData['user_profile']['email'];
						$user['User']['first_name']=$fbData['user_profile']['first_name'];
						$user['User']['last_name']=$fbData['user_profile']['last_name'];
						$user['User']['active']=1;
						$user['User']['email_verified']=1;
						if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
							$user['User']['ip_address']=$_SERVER['HTTP_X_FORWARDED_FOR'];
						}
						$userImageUrl = 'http://graph.facebook.com/'.$fbData['user_profile']['id'].'/picture?type=large';
						$photo = $this->updateProfilePic($userImageUrl);
						$user['UserDetail']['photo']=$photo;
						$user['UserDetail']['gender']=$fbData['user_profile']['gender'];
						$this->User->save($user,false);
						$userId=$this->User->getLastInsertID();
						$user['UserDetail']['user_id']=$userId;
						$this->UserDetail->save($user,false);
						$user = $this->User->findById($userId);
						$this->UserAuth->login($user);
						$this->Session->write('UserAuth.FacebookLogin', true);
						$this->Session->write('UserAuth.FacebookChangePass', true);
					} else {
						$this->Session->setFlash(__('Sorry new registration is currently disabled, please try again later'), 'default', array('class' => 'info'));
					}
				} else {
					if($user['User']['id'] !=1) {
						$user['User']['fb_id']=$fbData['user_profile']['id'];
						$user['User']['fb_access_token']=$fbData['user_profile']['accessToken'];
						$login=false;
						if(!$emailCheck) {
							$user['User']['email_verified']=1;
							$login=true;
						} else if($user['User']['email_verified']==1) {
							$login=true;
						} else if($user['User']['email']==$fbData['user_profile']['email']) {
							$user['User']['email_verified']=1;
							$login=true;
						}
						$this->User->save($user,false);
						if($login) {
							$user = $this->User->findById($user['User']['id']);
							if ($user['User']['active']==0) {
								$this->Session->setFlash(__('Sorry your account is not active, please contact to Administrator'), 'default', array('class' => 'info'));
							} else {
								$this->UserAuth->login($user);
								$this->Session->write('UserAuth.FacebookLogin', true);
							}
						} else {
							$this->Session->setFlash(__('Sorry your email is not verified yet'), 'default', array('class' => 'success'));
						}
					}
				}
			}
		}
	}
	private function login_twitter() {
		$userId = $this->UserAuth->getUserId();
		$this->Session->read();
		$this->layout=NULL;
		$twtData=$this->UserConnect->twitter_connect();
		if(isset($twtData['url'])) {
			$this->redirect($twtData['url']);
		} else if(!empty($twtData['user_profile'])) {
			if(!empty($twtData['user_profile']['id'])) {
				$twtId  = $twtData['user_profile']['id'];
				$user = $this->User->findByTwtId($twtId);
				if(empty($user)) {
					if(SITE_REGISTRATION) {
						$user['User']['twt_id']=$twtData['user_profile']['id'];
						$user['User']['twt_access_token']=$twtData['user_profile']['accessToken'];
						$user['User']['twt_access_secret']=$twtData['user_profile']['accessSecret'];
						$user['User']['user_group_id']=DEFAULT_GROUP_ID;
						$user['User']['username']= $this->generateUserName($twtData['user_profile']['screen_name']);
						$password = $this->UserAuth->generatePassword();
						$user['User']['password'] = $this->UserAuth->generatePassword($password);
						$name=preg_replace("/ /", "~", $twtData['user_profile']['name'], 1);
						$name= explode('~', $name);
						$user['User']['first_name']=$name[0];
						$user['User']['last_name']=(isset($name[1])) ? $name[1] : "";
						$user['User']['active']=1;
						if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
							$user['User']['ip_address']=$_SERVER['HTTP_X_FORWARDED_FOR'];
						}
						$user['UserDetail']['location']=$twtData['user_profile']['location'];
						$userImageUrl = 'http://api.twitter.com/1/users/profile_image?screen_name='.$twtData['user_profile']['screen_name'].'&size=original';
						$photo = $this->updateProfilePic($userImageUrl);
						$user['UserDetail']['photo']=$photo;
						$this->User->save($user,false);
						$userId=$this->User->getLastInsertID();
						$user['UserDetail']['user_id']=$userId;
						$this->UserDetail->save($user,false);
						$user = $this->User->findById($userId);
						$this->UserAuth->login($user);
						$this->Session->write('UserAuth.TwitterLogin', true);
						$this->Session->write('UserAuth.TwitterChangePass', true);
					} else {
						$this->Session->setFlash(__('Sorry new registration is currently disabled, please try again later.'), 'default', array('class' => 'info'));
					}
				} else {
					if($user['User']['id'] !=1) {
						if ($user['User']['id'] != 1 and $user['User']['active']==0) {
							$this->Session->setFlash(__('Sorry your account is not active, please contact our support staff.'), 'default', array('class' => 'info'));
						} else {
							$user['User']['twt_access_token']=$twtData['user_profile']['accessToken'];
							$user['User']['twt_access_secret']=$twtData['user_profile']['accessSecret'];
							$this->User->save($user,false);
							$this->UserAuth->login($user);
							$this->Session->write('UserAuth.TwitterLogin', true);
						}
					}
				}
			}
		}
	}
	private function login_gmail() {
		$userId = $this->UserAuth->getUserId();
		$this->Session->read();
		$this->layout=NULL;
		$gmailData=$this->UserConnect->gmail_connect();
		if(!isset($_GET['openid_mode'])) {
			$this->redirect($gmailData['url']);
		} else {
			if(!empty($gmailData)) {
				if(!empty($gmailData['email'])) {
					$user = $this->User->findByEmail($gmailData['email']);
					if(empty($user)) {
						if(SITE_REGISTRATION) {
							$user['User']['user_group_id']=DEFAULT_GROUP_ID;
							if(!empty($gmailData['name'])) {
								$user['User']['username']= $this->generateUserName($gmailData['name']);
							} else {
								$emailArr = explode('@', $gmailData['email']);
								$user['User']['username']= $this->generateUserName($emailArr[0]);
							}
							$password = $this->UserAuth->generatePassword();
							$user['User']['password'] = $this->UserAuth->generatePassword($password);
							$user['User']['first_name']=$gmailData['first_name'];
							$user['User']['last_name']=$gmailData['last_name'];
							$user['User']['email']=$gmailData['email'];
							$user['User']['active']=1;
							$user['User']['email_verified']=1;
							if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
								$user['User']['ip_address']=$_SERVER['HTTP_X_FORWARDED_FOR'];
							}
							$user['UserDetail']['location']=$gmailData['location'];
							$this->User->save($user,false);
							$userId=$this->User->getLastInsertID();
							$user['UserDetail']['user_id']=$userId;
							$this->UserDetail->save($user,false);
							$user = $this->User->findById($userId);
							$this->UserAuth->login($user);
							$this->Session->write('UserAuth.GmailLogin', true);
							$this->Session->write('UserAuth.GmailChangePass', true);
						} else {
							$this->Session->setFlash(__('Sorry new registration is currently disabled, please try again later'), 'default', array('class' => 'info'));
						}
					} else {
						if($user['User']['id'] !=1) {
							if($user['User']['email_verified'] !=1) {
								$user['User']['email_verified']=1;
								$this->User->save($user,false);
							}
							$user = $this->User->findById($user['User']['id']);
							if ($user['User']['active']==0) {
								$this->Session->setFlash(__('Sorry your account is not active, please contact our Support staff.'), 'default', array('class' => 'info'));
							} else {
								$this->UserAuth->login($user);
								$this->Session->write('UserAuth.GmailLogin', true);
							}
						}
					}
				}
			}
		}
	}
	private function login_yahoo() {
		$userId = $this->UserAuth->getUserId();
		$this->Session->read();
		$this->layout=NULL;
		$yahooData=$this->UserConnect->yahoo_connect();
		if(!isset($_GET['openid_mode'])) {
			$this->redirect($yahooData['url']);
		} else {
			if(!empty($yahooData)) {
				if(!empty($yahooData['email'])) {
					$user = $this->User->findByEmail($yahooData['email']);
					if(empty($user)) {
						if(SITE_REGISTRATION) {
							$user['User']['user_group_id']=DEFAULT_GROUP_ID;
							if(!empty($yahooData['name'])) {
								$user['User']['username']= $this->generateUserName($yahooData['name']);
							} else {
								$emailArr = explode('@', $yahooData['email']);
								$user['User']['username']= $this->generateUserName($emailArr[0]);
							}
							$password = $this->UserAuth->generatePassword();
							$user['User']['password'] = $this->UserAuth->generatePassword($password);
							$user['User']['first_name']=$yahooData['first_name'];
							$user['User']['last_name']=$yahooData['last_name'];
							$user['User']['email']=$yahooData['email'];
							$user['User']['active']=1;
							$user['User']['email_verified']=1;
							if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
								$user['User']['ip_address']=$_SERVER['HTTP_X_FORWARDED_FOR'];
							}
							$user['UserDetail']['gender']=$yahooData['gender'];
							$this->User->save($user,false);
							$userId=$this->User->getLastInsertID();
							$user['UserDetail']['user_id']=$userId;
							$this->UserDetail->save($user,false);
							$user = $this->User->findById($userId);
							$this->UserAuth->login($user);
							$this->Session->write('UserAuth.YahooLogin', true);
							$this->Session->write('UserAuth.YahooChangePass', true);
						} else {
							$this->Session->setFlash(__('Sorry new registration is currently disabled, please try again later'), 'default', array('class' => 'info'));
						}
					} else {
						if($user['User']['id'] !=1) {
							if($user['User']['email_verified'] !=1) {
								$user['User']['email_verified']=1;
								$this->User->save($user,false);
							}
							if ($user['User']['active']==0) {
								$this->Session->setFlash(__('Sorry your account is not active, please contact our Support Staff'), 'default', array('class' => 'info'));
							} else {
								$this->UserAuth->login($user);
								$this->Session->write('UserAuth.YahooLogin', true);
							}
						}
					}
				}
			}
		}
	}
	private function login_linkedin() {
		$userId = $this->UserAuth->getUserId();
		$this->Session->read();
		$this->layout=NULL;
		$ldnData=$this->UserConnect->linkedin_connect();
		if(!$_GET[LINKEDIN::_GET_RESPONSE]) {
			$this->redirect($ldnData['url']);
		} else {
			$ldnData = json_decode(json_encode($ldnData['user_profile']),TRUE);
			if(!empty($ldnData)) {
				if(!empty($ldnData['id'])) {
					$user = $this->User->findByLdnId($ldnData['id']);
					if(empty($user)) {
						if(SITE_REGISTRATION) {
							$user['User']['ldn_id']=$ldnData['id'];
							$user['User']['user_group_id']=DEFAULT_GROUP_ID;
							$user['User']['username']= $this->generateUserName($ldnData['first-name']. ' '.$ldnData['last-name']);
							$password = $this->UserAuth->generatePassword();
							$user['User']['password'] = $this->UserAuth->generatePassword($password);
							$user['User']['first_name']=$ldnData['first-name'];
							$user['User']['last_name']=$ldnData['last-name'];
							$user['User']['active']=1;
							if(isset($ldnData['picture-url'])) {
								$photo = $this->updateProfilePic($ldnData['picture-url']);
								$user['UserDetail']['photo']=$photo;
							}
							if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
								$user['User']['ip_address']=$_SERVER['HTTP_X_FORWARDED_FOR'];
							}
							$this->User->save($user,false);
							$userId=$this->User->getLastInsertID();
							$user['UserDetail']['user_id']=$userId;
							$this->UserDetail->save($user,false);
							$user = $this->User->findById($userId);
							$this->UserAuth->login($user);
							$this->Session->write('UserAuth.LinkedinLogin', true);
							$this->Session->write('UserAuth.LinkedinChangePass', true);
						} else {
							$this->Session->setFlash(__('Sorry new registration is currently disabled, please try again later'), 'default', array('class' => 'info'));
						}
					} else {
						if($user['User']['id'] !=1) {
							if ($user['User']['active']==0) {
								$this->Session->setFlash(__('Sorry your account is not active, please contact to Administrator'), 'default', array('class' => 'info'));
							} else {
								$this->UserAuth->login($user);
								$this->Session->write('UserAuth.LinkedinLogin', true);
							}
						}
					}
				}
			}
		}
	}
	private function login_foursquare() {
		$userId = $this->UserAuth->getUserId();
		$this->Session->read();
		$this->layout=NULL;
		$fsData=$this->UserConnect->foursquare_connect();
		if(!isset($_GET['code']) && !isset($_GET['error']) && empty($_SESSION['fs_access_token'])) {
			$this->redirect($fsData['url']);
		} else {
			$fsData = json_decode(json_encode($fsData['user_profile']),TRUE);
			if(!empty($fsData) && isset($fsData['user']['contact']['email'])) {
				$user = $this->User->findByEmail($fsData['user']['contact']['email']);
				if(empty($user)) {
					if(SITE_REGISTRATION) {
						$user['User']['user_group_id']=DEFAULT_GROUP_ID;
						$user['User']['username']= $this->generateUserName($fsData['user']['firstName']. ' '.$fsData['user']['lastName']);
						$password = $this->UserAuth->generatePassword();
						$user['User']['password'] = $this->UserAuth->generatePassword($password);
						$user['User']['email']=$fsData['user']['contact']['email'];
						$user['User']['first_name']=$fsData['user']['firstName'];
						$user['User']['last_name']=$fsData['user']['lastName'];
						$user['UserDetail']['gender']=$fsData['user']['gender'];
						if(isset($fsData['user']['photo'])) {
							$user['UserDetail']['photo']=$this->updateProfilePic($fsData['user']['photo']);
						}
						$user['User']['active']=1;
						$user['User']['email_verified']=1;
						if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
							$user['User']['ip_address']=$_SERVER['HTTP_X_FORWARDED_FOR'];
						}
						$this->User->save($user,false);
						$userId=$this->User->getLastInsertID();
						$user['UserDetail']['user_id']=$userId;
						$this->UserDetail->save($user,false);
						$user = $this->User->findById($userId);
						$this->UserAuth->login($user);
						$this->Session->write('UserAuth.FoursquareLogin', true);
						$this->Session->write('UserAuth.FoursquareChangePass', true);
					} else {
						$this->Session->setFlash(__('Sorry new registration is currently disabled, please try again later'), 'default', array('class' => 'info'));
					}
				} else {
					if($user['User']['id'] !=1) {
						if ($user['User']['active']==0) {
							$this->Session->setFlash(__('Sorry your account is not active, please contact to Administrator'), 'default', array('class' => 'info'));
						} else {
							$this->UserAuth->login($user);
							$this->Session->write('UserAuth.FoursquareLogin', true);
						}
					}
				}
			}
		}
	}
	/**
	 * It is used to generate unique username
	 *
	 * @access private
	 * @param string $name user's name to generate username
	 * @return String
	 */
	private function generateUserName($name=null) {
		$username='';
		if(!empty($name)) {
			$username = str_replace(' ', '', strtolower($name));
			while ($this->User->findByUsername($username)) {
				$username = str_replace(' ', '', strtolower($name)) . '_' . rand(1000, 9999);
			}
		}
		return $username;
	}
	/**
	 * It is used to log out user from the site
	 *
	 * @access public
	 * @param boolean $msg true for flash message on logout
	 * @return void
	 */
	public function logout($msg=true) {
		$this->log('User '. $this->UserAuth->getUserId().' logout', 'UserAccess');
		$this->UserAuth->logout();
		if($msg) {
			$this->Session->setFlash(__('You are successfully signed out'), 'default', array('class' => 'success'));
		}
		$this->redirect(LOGOUT_REDIRECT_URL);
	}
	/**
	 * It is used to register a user
	 *
	 * @access public
	 * @return void
	 */
	public function register() {

		$this->layout = "public.access";

		$userId = $this->UserAuth->getUserId();
		if ($userId) {
			$this->redirect("/dashboard");
		}
		if (SITE_REGISTRATION) {
			$userGroups=$this->UserGroup->getGroupsForRegistration();
			$this->set('userGroups', $userGroups);
			if ($this->request->isPost()) {
				if(USE_RECAPTCHA && !$this->RequestHandler->isAjax()) {
					$this->request->data['User']['captcha']= (isset($this->request->data['recaptcha_response_field'])) ? $this->request->data['recaptcha_response_field'] : "";
				}
				$this->User->set($this->data);
				$UserRegisterValidate = $this->User->RegisterValidate();
				if($this->RequestHandler->isAjax()) {
					$this->layout = 'ajax';
					$this->autoRender = false;
					if ($UserRegisterValidate) {
						$response = array('error' => 0, 'message' => 'Succes');
						return json_encode($response);
					} else {
						$response = array('error' => 1,'message' => 'failure');
						$response['data']['User']   = $this->User->validationErrors;
						return json_encode($response);
					}
				} else {
					if ($UserRegisterValidate) {
						if (!isset($this->data['User']['user_group_id'])) {
							$this->request->data['User']['user_group_id']=DEFAULT_GROUP_ID;
						} elseif (!$this->UserGroup->isAllowedForRegistration($this->data['User']['user_group_id'])) {
							$this->Session->setFlash(__('Please select correct register as'), 'default', array('class' => 'error'));
							return;
						}
						if (!EMAIL_VERIFICATION) {
							$this->request->data['User']['email_verified']=1;
						}
						$this->request->data['User']['active']=1;
						if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
							$this->request->data['User']['ip_address']=$_SERVER['HTTP_X_FORWARDED_FOR'];
						}
						$salt = $this->UserAuth->makeSalt();
						$this->request->data['User']['salt']=$salt;
						$this->request->data['User']['password'] = $this->UserAuth->makePassword($this->request->data['User']['password'], $salt);
						$this->User->save($this->request->data,false);
						$userId=$this->User->getLastInsertID();
						$this->request->data['UserDetail']['user_id']=$userId;
						$this->UserDetail->save($this->request->data,false);
						$user = $this->User->findById($userId);
						if (SEND_REGISTRATION_MAIL && !EMAIL_VERIFICATION) {
							$this->User->sendRegistrationMail($user);
						}
						if (EMAIL_VERIFICATION) {
							$this->User->sendVerificationMail($user);
						}
						if (isset($this->request->data['User']['active']) && $this->request->data['User']['active'] && !EMAIL_VERIFICATION) {
							$this->UserAuth->login($user);
							$this->redirect('/dashboard');
						} else {
							$this->Session->setFlash(__('Please check your mail and confirm your registration'));
							$this->redirect('/login');
						}
					}
				}
			}
		} else {
			$this->Session->setFlash(__('Sorry new registration is currently disabled, please try again later'), 'default', array('class' => 'info'));
			$this->redirect('/login');
		}
	}
	/**
	 * It is used to change password by user itself
	 *
	 * @access public
	 * @return void
	 */
	public function changePassword() {
		
		$userId = $this->UserAuth->getUserId();
		if ($this->request->isPost()) {
			$this->User->set($this->data);
			if(!empty($this->request->data['User']['emailVerifyCode']) && !empty($this->request->data['User']['email'])) {
				$tmpEmail = $this->TmpEmail->findByEmail($this->request->data['User']['email']);
				if(!empty($tmpEmail) && $tmpEmail['TmpEmail']['code']==$this->request->data['User']['emailVerifyCode']) {
					$user = $this->User->findById($userId);
					$userOld = $this->User->findByEmail($this->request->data['User']['email']);
					$success=0;
					if($this->Session->check('UserAuth.TwitterChangePass')) {
						$userOld['User']['twt_id']=$user['User']['twt_id'];
						$userOld['User']['twt_access_token']=$user['User']['twt_access_token'];
						$userOld['User']['twt_access_secret']=$user['User']['twt_access_secret'];
						if(empty($userOld['UserDetail']['photo'])) {
							$userOld['UserDetail']['photo'] = $user['UserDetail']['photo'];
						}
						if(empty($userOld['UserDetail']['location'])) {
							$userOld['UserDetail']['location'] = $user['UserDetail']['location'];
						}
						$this->Session->delete('UserAuth.EmailVerifyCode');
						$this->User->saveAssociated($userOld);
						$success=1;
					} elseif ($this->Session->check('UserAuth.LinkedinChangePass')) {
						$userOld['User']['ldn_id']=$user['User']['ldn_id'];
						if(empty($userOld['UserDetail']['photo'])) {
							$userOld['UserDetail']['photo'] = $user['UserDetail']['photo'];
						}
						$this->Session->delete('UserAuth.EmailVerifyCode');
						$this->User->saveAssociated($userOld);
						$success=1;
					}
					if($success) {
						$this->User->delete($userId, false);
						$this->UserDetail->delete($user['UserDetail']['id'], false);
						$this->TmpEmail->delete($tmpEmail['TmpEmail']['id'], false);
						$this->Session->delete('UserAuth.TwitterChangePass');
						$this->Session->delete('UserAuth.LinkedinChangePass');
						$this->UserAuth->login($userOld);
						$this->Session->setFlash(__('Your accounts were successfully merged'));
						$this->redirect('/dashboard');
					}
				} else {
					$this->Session->setFlash(__('Email verification code is incorrect, please try again'), 'default', array('class' => 'error'));
				}
			}
			if ($this->User->RegisterValidate()) {
				$user =$this->User->getUserById($userId);
				if(!empty($this->request->data['User']['email'])) {
					$user['User']['email'] = $this->request->data['User']['email'];
				}
				$salt = $this->UserAuth->makeSalt();
				$user['User']['salt'] = $salt;
				$user['User']['password'] = $this->UserAuth->makePassword($this->request->data['User']['password'], $salt);
				$this->User->save($user,false);
				$this->LoginToken->deleteAll(array('LoginToken.user_id'=>$userId), false);
				if(!empty($this->request->data['User']['email'])) {
					$this->User->sendVerificationMail($user);
				}
				if(SEND_PASSWORD_CHANGE_MAIL) {
					$this->User->sendChangePasswordMail($user);
				}
				$this->Session->delete('UserAuth.FacebookChangePass');
				$this->Session->delete('UserAuth.TwitterChangePass');
				$this->Session->delete('UserAuth.GmailChangePass');
				$this->Session->delete('UserAuth.LinkedinChangePass');
				$this->Session->delete('UserAuth.FoursquareChangePass');
				$this->Session->delete('UserAuth.YahooChangePass');
				$this->Session->setFlash(__('Password changed successfully'));
				$this->redirect('/dashboard');
			} else {
				if(isset($this->data['verify']) && !empty($this->request->data['User']['email'])) {
					$emailSent=1;
					if($this->Session->check('UserAuth.EmailVerifyCode')) {
						$emailSent += $this->Session->read('UserAuth.EmailVerifyCode');
					}
					if($emailSent >2) {
						$this->Session->setFlash(__('Sorry we have sent already 2 emails for verification code'), 'default', array('class' => 'info'));
					} else {
						$code= rand(10000, 1000000);
						$tmpEmail = $this->TmpEmail->findByEmail($this->request->data['User']['email']);
						$tmpEmail['TmpEmail']['code']=$code;
						$tmpEmail['TmpEmail']['email']=$this->request->data['User']['email'];
						$this->TmpEmail->save($tmpEmail, false);
						$this->User->sendVerificationCode($userId, $tmpEmail['TmpEmail']['email'], $code);
						$this->Session->write('UserAuth.EmailVerifyCode', $emailSent);
						$this->Session->setFlash(__('We have sent you an email verification code'));
					}
				}
			}
		}
	}
	/**
	 * It is used to change password of user by admin
	 *
	 * @access public
	 * @param integer $userId user id of user
	 * @return void
	 */
	public function changeUserPassword($userId=null) {
		$page= (isset($this->request->params['named']['page'])) ? $this->request->params['named']['page'] : 1;
		if (!empty($userId)) {
			if(!$this->User->isValidUserId($userId)) {
				$this->redirect(array('action'=>'index', 'page'=>$page));
			}
			$name=$this->User->getNameById($userId);
			$this->set('name', $name);
			if ($this->request->isPost()) {
				$this->User->set($this->data);
				$UserRegisterValidate = $this->User->RegisterValidate();
				if($this->RequestHandler->isAjax()) {
					$this->layout = 'ajax';
					$this->autoRender = false;
					if ($UserRegisterValidate) {
						$response = array('error' => 0, 'message' => 'Succes');
						return json_encode($response);
					} else {
						$response = array('error' => 1,'message' => 'failure');
						$response['data']['User']   = $this->User->validationErrors;
						return json_encode($response);
					}
				} else {
					if ($UserRegisterValidate) {
						$user =$this->User->getUserById($userId);
						$salt = $this->UserAuth->makeSalt();
						$user['User']['salt'] = $salt;
						$user['User']['password'] = $this->UserAuth->makePassword($this->request->data['User']['password'], $salt);
						$this->User->save($user,false);
						$this->LoginToken->deleteAll(array('LoginToken.user_id'=>$userId), false);
						$this->Session->setFlash(__('Password for %s changed successfully', $name));
						$this->redirect(array('action'=>'index', 'page'=>$page));
					}
				}
			}
		} else {
			$this->redirect(array('action'=>'index', 'page'=>$page));
		}
	}
	/**
	 * It is used to add user by Admin
	 *
	 * @access public
	 * @return void
	 */
	public function addUser() {
		$userGroups=$this->UserGroup->getGroups();
		unset($userGroups['']);
		$this->set('userGroups', $userGroups);
		if ($this->request->isPost()) {
			if($this->RequestHandler->isAjax()) {
				$this->layout = 'ajax';     // uses an empty layout
				$this->autoRender = false;  // renders nothing by default
			}
			$this->User->set($this->data);
			$UserRegisterValidate = $this->User->RegisterValidate();
			if($this->RequestHandler->isAjax()) {
				if ($UserRegisterValidate) {
					$response = array('error' => 0, 'message' => 'Succes');
					return json_encode($response);
				} else {
					$response = array('error' => 1,'message' => 'failure');
					$response['data']['User']   = $this->User->validationErrors;
					return json_encode($response);
				}
			} else {
				if ($UserRegisterValidate) {
					sort($this->request->data['User']['user_group_id']);
					$this->request->data['User']['user_group_id'] = implode(',',$this->request->data['User']['user_group_id']);
					$this->request->data['User']['active']=1;
					$this->request->data['User']['email_verified']=1;
					$this->request->data['User']['by_admin']=1;
					$salt = $this->UserAuth->makeSalt();
					$this->request->data['User']['salt']= $salt;
					$this->request->data['User']['password'] = $this->UserAuth->makePassword($this->request->data['User']['password'], $salt);
					$this->User->save($this->request->data,false);
					$userId=$this->User->getLastInsertID();
					$this->request->data['UserDetail']['user_id']=$userId;
					$this->UserDetail->save($this->request->data,false);
					$this->Session->setFlash(__('The user is successfully added'));
					$this->redirect('/addUser');
				}
			}
		}
	}
	/**
	 * It is used to edit user by Admin
	 *
	 * @access public
	 * @param integer $userId user id of user
	 * @return void
	 */
	public function editUser($userId=null) {
		$page= (isset($this->request->params['named']['page'])) ? $this->request->params['named']['page'] : 1;
		if (!empty($userId)) {
			if(!$this->User->isValidUserId($userId)) {
				$this->redirect(array('action'=>'index', 'page'=>$page));
			}
			$userGroups=$this->UserGroup->getGroups();
			$this->set('userGroups', $userGroups);
			$gender= $this->User->getGenderArray();
			$this->set('gender', $gender);
			$marital= $this->User->getMaritalArray();
			$this->set('marital', $marital);
			if ($this->request->isPut() || $this->request->isPost()) {
				$this->User->set($this->data);
				$this->UserDetail->set($this->data);
				$UserRegisterValidate = $this->User->RegisterValidate();
				$UserDetailRegisterValidate = $this->UserDetail->RegisterValidate();
				if($this->RequestHandler->isAjax()) {
					$this->layout = 'ajax';
					$this->autoRender = false;
					if ($UserRegisterValidate && $UserDetailRegisterValidate) {
						$response = array('error' => 0, 'message' => 'Succes');
						return json_encode($response);
					} else {
						$response = array('error' => 1,'message' => 'failure');
						$response['data']['User']   = $this->User->validationErrors;
						$response['data']['UserDetail'] = $this->UserDetail->validationErrors;
						return json_encode($response);
					}
				} else {
					if ($UserRegisterValidate && $UserDetailRegisterValidate) {
						if(is_uploaded_file($this->request->data['UserDetail']['photo']['tmp_name']) && !empty($this->request->data['UserDetail']['photo']['tmp_name']))
						{
							$path_info = pathinfo($this->request->data['UserDetail']['photo']['name']);
							chmod ($this->request->data['UserDetail']['photo']['tmp_name'], 0644);
							$photo=time().mt_rand().".".$path_info['extension'];
							$fullpath= ROOT.DS."app".DS."webroot".DS."img".DS.IMG_DIR;
							$res1 = is_dir($fullpath);
							if($res1 != 1)
								$res2= mkdir($fullpath, 0777, true);
							move_uploaded_file($this->request->data['UserDetail']['photo']['tmp_name'],$fullpath.DS.$photo);
							$this->request->data['UserDetail']['photo']=$photo;
						}
						else {
							unset($this->request->data['UserDetail']['photo']);
						}
						sort($this->request->data['User']['user_group_id']);
						$this->request->data['User']['user_group_id'] = implode(',',$this->request->data['User']['user_group_id']);
						$oldGroupId = $this->User->getGroupId($userId);
						if($oldGroupId != $this->request->data['User']['user_group_id']) {
							$this->UserActivity->updateAll(array('UserActivity.logout'=>1), array('UserActivity.user_id'=>$userId));
						}
						$this->User->saveAssociated($this->request->data);
						$this->Session->setFlash(__('The user is successfully updated'));
						$this->redirect(array('action'=>'index', 'page'=>$page));
					}
				}
			} else {
				$user = $this->User->read(null, $userId);
				$this->request->data=null;
				if (!empty($user)) {
					$user['User']['password']='';
					$this->request->data = $user;
					$this->request->data['User']['user_group_id'] = explode(',',$this->request->data['User']['user_group_id']);
				}
			}
		} else {
			$this->redirect(array('action'=>'index', 'page'=>$page));
		}
	}
	/**
	 * It is used to delete user by Admin
	 *
	 * @access public
	 * @param integer $userId user id of user
	 * @return void
	 */
	public function deleteUser($userId = null) {
		$page= (isset($this->request->params['named']['page'])) ? $this->request->params['named']['page'] : 1;
		if (!empty($userId)) {
			if ($this->request->isPost() || $this->RequestHandler->isAjax() || isset($_SERVER['HTTP_REFERER'])) {
				$res = $this->User->delete($userId, false);
				if($res) {
					$this->UserDetail->deleteAll(array('UserDetail.user_id'=>$userId), false);
					$this->LoginToken->deleteAll(array('LoginToken.user_id'=>$userId), false);
					$this->UserActivity->updateAll(array('UserActivity.deleted'=>1), array('UserActivity.user_id'=>$userId));
				}
				if($this->RequestHandler->isAjax()) {
					if($res) {
						echo "1";
					} else {
						echo '<img alt="Delete" src="'.SITE_URL.'usermgmt/img/delete.png">';
					}
				} else {
					if($res) {
						$this->Session->setFlash(__('Selected user is deleted successfully'));
					}
					$this->redirect(array('action'=>'index', 'page'=>$page));
				}
			}
		}
		exit;
	}
	/**
	 * It is used to delete user account by itself If allowed by admin in All settings
	 *
	 * @access public
	 * @param integer $userId user id of user
	 * @return void
	 */
	public function deleteAccount() {
		$userId = $this->UserAuth->getUserId();
		if (!empty($userId)) {
			if ($this->request->isPost() || isset($_SERVER['HTTP_REFERER'])) {
				if(ALLOW_DELETE_ACCOUNT && $userId !=1) {
					if ($this->User->delete($userId)) {
						$this->UserDetail->deleteAll(array('UserDetail.user_id'=>$userId), false);
						$this->LoginToken->deleteAll(array('LoginToken.user_id'=>$userId), false);
						$this->UserActivity->updateAll(array('UserActivity.deleted'=>1), array('UserActivity.user_id'=>$userId));
						$this->Session->setFlash(__('Your account is successfully deleted'));
						$this->logout(false);
					}
				} else {
					$this->Session->setFlash(__('Your are not allowed to delete account'), 'default', array('class' => 'info'));
				}
			}
			$this->redirect('/dashboard');
		} else {
			$this->redirect('/dashboard');
		}
	}
	/**
	 * It is used to logout user by Admin from online users page
	 *
	 * @access public
	 * @param integer $userId user id of user
	 * @return void
	 */
	public function logoutUser($userId = null) {
		if (!empty($userId)) {
			if ($this->request->isPost()) {
				$this->UserActivity->updateAll(array('UserActivity.logout'=>1), array('UserActivity.user_id'=>$userId));
				$this->Session->setFlash(__('User is successfully signed out'));
			}
			$this->redirect('/usersOnline');
		} else {
			$this->redirect('/usersOnline');
		}
	}
	/**
	 * It is used to logout & make inactive user and by Admin from online users page
	 *
	 * @access public
	 * @param integer $userId user id of user
	 * @return void
	 */
	public function makeInactive($userId = null) {
		$page= (isset($this->request->params['named']['page'])) ? $this->request->params['named']['page'] : 1;
		if ($this->request->isPost()) {
			if (!empty($userId)) {
				$this->UserActivity->updateAll(array('UserActivity.logout'=>1), array('UserActivity.user_id'=>$userId));
				$this->User->updateAll(array('User.active'=>0), array('User.id'=>$userId));
				$this->Session->setFlash(__('User is successfully signed out and deactivated'));
			}
		}
		$this->redirect(array('action'=>'index', 'page'=>$page));
	}
	/**
	 * It displays dashboard for logged in user
	 *
	 * @access public
	 * @return array
	 */
	public function dashboard() {
		$userId = $this->UserAuth->getUserId();
		$getGroupId = $this->UserAuth->getGroupId($userId);
		/* Do here something for user */
		#debug($getGroupId);die();
		if (!empty($userId)) {

			if($getGroupId == 1){
				$this->redirect(array('plugin' => '','controller' => 'staffs', 'action' => 'backoffice'));
			} else if ($getGroupId == 4){
				$this->redirect(array('plugin' => '','controller' => 'partners', 'action' => 'cabinet'));
			} else if ($getGroupId == 4){
				$this->redirect(array('plugin' => '','controller' => 'exchangers', 'action' => 'wallet'));
			} else if ($getGroupId == 2){
				//Check jika traders first time buka vault
				$checkVault = $this->Vault->checkVaultAccount($userId);
				$this->layout = "trader.dashboard";
			}
		} else {
			$this->redirect(LOGOUT_REDIRECT_URL);	
		}
	}
	/**
	 * It is used to activate or deactivate from all users page
	 *
	 * @access public
	 * @param integer $userId user id of user
	 * @return string
	 */
	public function makeActiveInactive($userId = null) {
		$page= (isset($this->request->params['named']['page'])) ? $this->request->params['named']['page'] : 1;
		$msg=__('Sorry there was a problem, please try again');
		if (!empty($userId)) {
			if ($this->request->isPost() || $this->RequestHandler->isAjax() || isset($_SERVER['HTTP_REFERER'])) {
				$res=$this->User->find('first', array('conditions' => array('User.id'=>$userId), 'fields' => array('User.active'), 'recursive'=>-1));
				if(!empty($res)) {
					if($res['User']['active']) {
						$this->User->id = $userId;
						$this->User->saveField('active', 0, false);
						$this->UserActivity->updateAll(array('UserActivity.logout'=>1), array('UserActivity.user_id'=>$userId));
					} else {
						$this->User->id = $userId;
						$this->User->saveField('active', 1, false);
						$this->UserActivity->updateAll(array('UserActivity.logout'=>0), array('UserActivity.user_id'=>$userId));
					}
					if($this->RequestHandler->isAjax()) {
						if($res['User']['active']) {
							echo '<img alt="Make Active" src="'.SITE_URL.'usermgmt/img/dis-approve.png">';
						} else {
							echo '<img alt="Make Inactive" src="'.SITE_URL.'usermgmt/img/approve.png">';
						}
					} else {
						if($res['User']['active']) {
							$this->Session->setFlash(__('Selected user is de-activated successfully'));
						} else {
							$this->Session->setFlash(__('Selected user is activated successfully'));
						}
						$this->redirect(array('action'=>'index', 'page'=>$page));
					}
				}
			}
		}
		exit;
	}
	/**
	 * It is Used to mark verified email of user from all users page
	 *
	 * @access public
	 * @param integer $userId user id of user
	 * @return string
	 */
	public function verifyEmail($userId = null) {
		$page= (isset($this->request->params['named']['page'])) ? $this->request->params['named']['page'] : 1;
		if (!empty($userId)) {
			if ($this->request->isPost() || $this->RequestHandler->isAjax() || isset($_SERVER['HTTP_REFERER'])) {
				$this->User->id = $userId;
				$this->User->saveField('email_verified', 1, false);
				if($this->RequestHandler->isAjax()) {
					if(!$this->User->field('email_verified')) {
						echo '<img alt="Verify Email" src="'.SITE_URL.'usermgmt/img/email-verify.png">';
					}
				} else {
					if($this->User->field('email_verified')) {
						$this->Session->setFlash(__('Email of selected user is verified successfully'));
					}
					$this->redirect(array('action'=>'index', 'page'=>$page));
				}
			}
		}
		exit;
	}
	/**
	 * It displays Access Denied Page if user wants to view the page without permission
	 *
	 * @access public
	 * @return void
	 */
	public function accessDenied() {
		//Layout
		$this->layout = "default";
		//Page title
		$page_title = array(
			'icon' => "icon-warning-sign",
			'name' => "Opps ! Something gone wrong."
		);
		$this->set('page_title',$page_title);
	}
	/**
	 * It is used to verify user's email address when users click on the link sent to their email address
	 *
	 * @access public
	 * @return void
	 */
	public function userVerification() {
		if (isset($_GET['ident']) && isset($_GET['activate'])) {
			$userId= $_GET['ident'];
			$activateKey= $_GET['activate'];
			$user = $this->User->read(null, $userId);
			if (!empty($user)) {
				if (!$user['User']['email_verified']) {
					$password = $user['User']['password'];
					$theKey = $this->User->getActivationKey($password);
					if ($activateKey==$theKey) {
						$user['User']['email_verified']=1;
						$res= $this->User->save($user,false);
						if (SEND_REGISTRATION_MAIL && EMAIL_VERIFICATION) {
							$this->User->sendRegistrationMail($user);
						}
						$this->Session->setFlash(__('Congratulation ! Email has been verified.'));
					}
				} else {
					$this->Session->setFlash(__('Opps ! Your email is already verified'));
				}
			} else {
				$this->Session->setFlash(__('Sorry something went wrong, please click on the link again'), 'default', array('class' => 'error'));
			}
		} else {
			$this->Session->setFlash(__('Sorry something went wrong, please click on the link again'), 'default', array('class' => 'error'));
		}
		$this->redirect('/login');
	}
	/**
	 * It is used to reset password of user itself, this function sends email with link to reset the password
	 *
	 * @access public
	 * @return void
	 */
	public function forgotPassword() {

		$this->layout = 'public.access';

		if ($this->request->isPost()) {
			$this->User->set($this->data);
			if ($this->User->LoginValidate()) {
				$email  = $this->data['User']['email'];
				$user = $this->User->findByUsername($email);
				if (empty($user)) {
					$user = $this->User->findByEmail($email);
					if (empty($user)) {
						$this->Session->setFlash(__('Incorrect Email/Username'), 'default', array('class' => 'error'));
						return;
					}
				}
				// check for unverified account
				if ($user['User']['id'] != 1 and $user['User']['email_verified']==0) {
					$this->Session->setFlash(__('Your registration has not been confirmed yet please verify your email before reset password'), 'default', array('class' => 'info'));
					return;
				}
				$this->User->sendForgotPasswordMail($user);
				$this->Session->setFlash(__('Success ! Check your email for further instruction.'));
				$this->redirect('/login');
			}
		}
	}
	/**
	 * It is used to send email verification mail to user with link to verify the email address
	 *
	 * @access public
	 * @return void
	 */
	public function emailVerification() {

		$this->layout = "public.access";

		if ($this->request->isPost()) {
			$this->User->set($this->data);
			if ($this->User->LoginValidate()) {
				$email  = $this->data['User']['email'];
				$user = $this->User->findByUsername($email);
				if (empty($user)) {
					$user = $this->User->findByEmail($email);
					if (empty($user)) {
						$this->Session->setFlash(__('Incorrect Email/Username'), 'default', array('class' => 'error'));
						return;
					}
				}
				if($user['User']['email_verified']==0) {
					$this->User->sendVerificationMail($user);
					$this->Session->setFlash(__('Please check your mail to verify your email address'));
				} else {
					$this->Session->setFlash(__('Your email is already verified'), 'default', array('class' => 'info'));
				}
				$this->redirect('/login');
			}
		}
	}
	/**
	 *  It is used to reset password when users click the link in their email
	 *
	 * @access public
	 * @return void
	 */
	public function activatePassword() {
		if ($this->request->isPost()) {
			if (!empty($this->data['User']['ident']) && !empty($this->data['User']['activate'])) {
				$this->set('ident',$this->data['User']['ident']);
				$this->set('activate',$this->data['User']['activate']);
				$this->User->set($this->data);
				if ($this->User->RegisterValidate()) {
					$userId= $this->data['User']['ident'];
					$activateKey= $this->data['User']['activate'];
					$user = $this->User->read(null, $userId);
					if (!empty($user)) {
						$password = $user['User']['password'];
						$thekey =$this->User->getActivationKey($password);
						if ($thekey==$activateKey) {
							$user['User']['password']=$this->data['User']['password'];
							$salt = $this->UserAuth->makeSalt();
							$user['User']['salt']= $salt;
							$user['User']['password'] = $this->UserAuth->makePassword($user['User']['password'], $salt);
							$this->User->save($user,false);
							$this->Session->setFlash(__('Your password has been reset successfully'));
							$this->redirect('/login');
						} else {
							$this->Session->setFlash(__('Something went wrong, please send password reset link again'), 'default', array('class' => 'error'));
						}
					} else {
						$this->Session->setFlash(__('Something went wrong, please click again on the link in email'), 'default', array('class' => 'error'));
					}
				}
			} else {
				$this->Session->setFlash(__('Something went wrong, please click again on the link in email'), 'default', array('class' => 'error'));
			}
		} else {
			if (isset($_GET['ident']) && isset($_GET['activate'])) {
				$this->set('ident',$_GET['ident']);
				$this->set('activate',$_GET['activate']);
			}
		}
	}
	/**
	 *  It is used to update profile pic from given url
	 *
	 * @access private
	 * @param integer $file_location url of pic
	 * @return String
	 */
	private function updateProfilePic($file_location) {
		$fullpath= WWW_ROOT."img".DS.IMG_DIR;
		$res1 = is_dir($fullpath);
		if($res1 != 1) {
			$res2= mkdir($fullpath, 0777, true);
		}
		$imgContent = file_get_contents($file_location);
		$photo=time().mt_rand().".jpg";
		$tempfile=$fullpath.DS.$photo;
		$fp = fopen($tempfile, "w");
		fwrite($fp, $imgContent);
		fclose($fp);
		return $photo;
	}
	/**
	 *  It id used to delete cache of cakephp on production
	 *
	 * @access public
	 * @return void
	 */
	public function deleteCache() {
		$iterator = new RecursiveDirectoryIterator(CACHE);
		foreach (new RecursiveIteratorIterator($iterator, RecursiveIteratorIterator::CHILD_FIRST) as $file) {
			$path_info = pathinfo($file);
			if($path_info['dirname']==CACHE."models"  && $path_info['basename']!='.svn') {
				@unlink($file->getPathname());
			}
			if($path_info['dirname']==CACHE."persistent"  && $path_info['basename']!='.svn') {
				@unlink($file->getPathname());
			}
			if($path_info['dirname']==CACHE."views"  && $path_info['basename']!='.svn') {
				@unlink($file->getPathname());
			}
			if($path_info['dirname']==TMP."cache" && $path_info['basename']!='.svn') {
				if(!is_dir($file->getPathname())) {
					@unlink($file->getPathname());
				}
			}
		}
		$this->Session->setFlash('Cache has been deleted successfully');
		$this->redirect('/dashboard');
	}
	/**
	 *  It is used to view user's permissions by admin
	 *
	 * @access public
	 * @param integer $userId user id of user
	 * @return void
	 */
	public function viewUserPermissions($userId) {
		$name='';
		$permissions=array();
		if (!empty($userId)) {
			$user = $this->User->read(null, $userId);
			if (!empty($user)) {
				$name = trim($user['User']['first_name']." ".$user['User']['last_name']);
				$userGroupIDArray= explode(',', $user['User']['user_group_id']);
				$userGroupIDArray = array_map('trim', $userGroupIDArray);
				$result = $this->UserGroupPermission->find('all',array('conditions'=>array('UserGroupPermission.user_group_id' => $userGroupIDArray, 'UserGroupPermission.allowed'=>1), 'fields'=>array('UserGroupPermission.controller', 'UserGroupPermission.action', 'UserGroup.name'), 'order'=>'UserGroupPermission.controller'));
				$allControllers=$this->ControllerList->getControllers();
				$allControllers = array_flip($allControllers);
				foreach($result as $row) {
					$conAct = $row['UserGroupPermission']['controller'].'/'.$row['UserGroupPermission']['action'];
					if(isset($permissions[$conAct])) {
						$permissions[$conAct]['group'] .= ", ".$row['UserGroup']['name'];
					} else {
						$permissions[$conAct]['controller'] = $row['UserGroupPermission']['controller'];
						$permissions[$conAct]['action'] = $row['UserGroupPermission']['action'];
						$permissions[$conAct]['group'] = $row['UserGroup']['name'];
						$permissions[$conAct]['index'] = $allControllers[$row['UserGroupPermission']['controller']];
					}
				}
				$this->set('permissions',$permissions);
				$this->set('name',$name);
			}
		}
		$this->set('permissions',$permissions);
		$this->set('name',$name);
	}
	/**
	 * It is used to redirect on login page while ajax call if user is not logged in
	 *
	 * @access public
	 * @return void
	 */
	public function ajaxLoginRedirect() {
		$this->render('/Elements/login_redirect');
	}
	/**
	 * It displays user profile with limited public details by username
	 *
	 * @access public
	 * @return array
	 */
	public function viewProfile($username) {
		$user = $this->User->findByUsername($username);
		$this->set('user', $user);
	}
	
	/**
	 * It is used to search emails on send email page
	 *
	 * @access public
	 * @return array
	 */
	public function searchEmails() {
		$results = array();
		$query = '';
		if($this->RequestHandler->isAjax()) {
			if(isset($_POST['data']['q'])) {
				$query = $_POST['data']['q'];
				$selectedUserIds=array();
				if(isset($_POST['data']['selIds'])) {
					$selectedUserIds = explode(',', $_POST['data']['selIds']);
				}
				$results = $this->User->find('all', array('conditions'=>array('OR'=>array(array('User.first_name LIKE'=>$query.'%'), array('User.last_name LIKE'=>$query.'%'), array('User.email LIKE'=>$query.'%@%')), 'User.email IS NOT NULL', 'User.email !='=>'', 'User.active'=>1, 'User.id NOT'=>$selectedUserIds), 'fields'=>array('User.id', 'User.first_name', 'User.last_name', 'User.email')));
			}
		}
		$resultToPrint=array();
		foreach($results as $res) {
			$resultToPrint[] = array('id' => $res['User']['id'], 'text' => $res['User']['first_name'].' '.$res['User']['last_name'].' ( '.$res['User']['email'].' )');
		}
		echo json_encode(array('q' => $query, 'results' => $resultToPrint));
		exit;
	}

	/**
	* Retrieve total number active client
	*
	* @access public
	* @return array
	*/

	public function kiraTotalClient() {
		$this->layout = "ajax";
		if($this->UserAuth->isLogged()){
			$total = $this->User->kiraTotalClient();
			#debug($total);die();
			if ($this->request->is('requested')) {
				return $total;
			} else {
				$this->set('TotalClient', $total);
			}
		}
	}

	/**
	* Retrieve total number active partner
	*
	* @access public
	* @return array
	*/

	public function kiraTotalPartner() {
		$this->layout = "ajax";
		if($this->UserAuth->isLogged()){
			$total = $this->User->kiraTotalPartner();
			#debug($total);die();
			if ($this->request->is('requested')) {
				return $total;
			} else {
				$this->set('TotalPartner', $total);
			}
		}
	}

}