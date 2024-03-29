<?php
/*
Cakephp 2.x User Management Premium Version (a product of Ektanjali Softwares Pvt Ltd)
Website- http://ektanjali.com
Plugin Demo- http://umpremium.ektanjali.com
Author- Chetan Varshney (The Director of Ektanjali Softwares Pvt Ltd)
Plugin Copyright No- 11498/2012-CO/L

UMPremium is a copyrighted work of authorship. Chetan Varshney retains ownership of the product and any copies of it, regardless of the form in which the copies may exist. This license is not a sale of the original product or any copies.

By installing and using UMPremium on your server, you agree to the following terms and conditions. Such agreement is either on your own behalf or on behalf of any corporate entity which employs you or which you represent ('Corporate Licensee'). In this Agreement, 'you' includes both the reader and any Corporate Licensee and Chetan Varshney.

The Product is licensed only to you. You may not rent, lease, sublicense, sell, assign, pledge, transfer or otherwise dispose of the Product in any form, on
a temporary or permanent basis, without the prior written consent of Chetan Varshney.

The Product source code may be altered (at your risk)

All Product copyright notices within the scripts must remain unchanged (and visible).

If any of the terms of this Agreement are violated, Chetan Varshney reserves the right to action against you.

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Product.

THE PRODUCT IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE PRODUCT OR THE USE OR OTHER DEALINGS IN THE PRODUCT.
*/

App::uses('UserMgmtAppController', 'Usermgmt.Controller');
class ContentsController extends UserMgmtAppController {
	/**
	 * This controller uses following models
	 *
	 * @var array
	 */
	public $uses = array('Usermgmt.User','Usermgmt.Content');
	/**
	 * This controller uses following components
	 *
	 * @var array
	 */
	public $components = array('RequestHandler', 'Usermgmt.Search');
	/**
	 * This controller uses following helpers
	 *
	 * @var array
	 */
	public $helpers = array('Js', 'Usermgmt.Tinymce', 'Usermgmt.Ckeditor');
	/**
	 * This controller uses following default pagination values
	 *
	 * @var array
	 */
	public $paginate = array(
		'limit' => 25
	);
	/**
	 * This controller uses search filters in following functions for ex index, online function
	 *
	 * @var array
	 */
	var $searchFields = array
		(
			'index' => array(
				'Content' => array(
					'Content'=> array(
						'type' => 'text',
						'label' => 'Search',
						'tagline' => 'Search by page name, title, url name',
						'condition' => 'multiple',
						'searchFields'=>array('Content.page_name', 'Content.page_title', 'Content.url_name'),
						'inputOptions'=>array('style'=>'width:300px;')
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
		if(isset($this->Security) &&  $this->RequestHandler->isAjax()){
			$this->Security->csrfCheck = false;
			$this->Security->validatePost = false;
		}
	}
	/**
	 * It displays all pages
	 *
	 * @access public
	 * @return array
	 */
	public function index() {
		$this->paginate = array('limit' => 10, 'order'=>'Content.id desc');
		$contents = $this->paginate('Content');
		$this->set('contents', $contents);
		if($this->RequestHandler->isAjax()) {
			$this->layout = 'ajax';
			$this->render('/Elements/all_contents');
		}
	}
	/**
	 * It is used to create a new page
	 *
	 * @access public
	 * @return void
	 */
	public function addPage() {
		if ($this->request->isPost()) {
			$this->Content->set($this->data);
			$contentValidate = $this->Content->contentValidate();
			if($this->RequestHandler->isAjax()) {
				$this->layout = 'ajax';
				$this->autoRender = false;
				if ($contentValidate) {
					$response = array('error' => 0, 'message' => 'Succes');
					return json_encode($response);
				} else {
					$response = array('error' => 1,'message' => 'failure');
					$response['data']['Content']  = $this->Content->validationErrors;
					return json_encode($response);
				}
			} else {
				if ($contentValidate) {
					$this->Content->save($this->request->data,false);
					$this->Session->setFlash(__('The page has been saved'),'default',array('class' => 'success'));
					$this->redirect('/allPages');
				}
			}
		}
	}
	/**
	 * It is used to edit existing page
	 *
	 * @access public
	 * @param integer $pageId page id
	 * @return void
	 */
	public function editPage($pageId=null) {
		$page= (isset($this->request->params['named']['page'])) ? $this->request->params['named']['page'] : 1;
		if (!empty($pageId)) {
			if(!$this->Content->isValidPageId($pageId)) {
				$this->redirect(array('action'=>'index', 'page'=>$page));
			}
			if ($this->request->isPut() || $this->request->isPost()) {
				$this->Content->set($this->data);
				$contentValidate = $this->Content->contentValidate();
				if($this->RequestHandler->isAjax()) {
					$this->layout = 'ajax';
					$this->autoRender = false;
					if ($contentValidate) {
						$response = array('error' => 0, 'message' => 'Succes');
						return json_encode($response);
					} else {
						$response = array('error' => 1,'message' => 'failure');
						$response['data']['Content']  = $this->Content->validationErrors;
						return json_encode($response);
					}
				} else {
					if ($contentValidate) {
						$this->Content->save($this->request->data,false);
						$this->Session->setFlash(__('The page has been saved'),'default',array('class' => 'success'));
						$this->redirect(array('action'=>'editPage', $pageId, 'page'=>$page));
					}
				}
			}  else {
				$this->request->data = $this->Content->read(null, $pageId);
			}
		} else {
			$this->redirect(array('action'=>'index', 'page'=>$page));
		}
	}
	/**
	 * It is used to view page details
	 *
	 * @access public
	 * @param integer $pageId page id
	 * @return array
	 */
	public function viewPage($pageId=null) {
		$page= (isset($this->request->params['named']['page'])) ? $this->request->params['named']['page'] : 1;
		if (!empty($pageId)) {
			$pageDetail = $this->Content->read(null, $pageId);
			if(empty($pageDetail)) {
				$this->redirect(array('action'=>'index', 'page'=>$page));
			}
			$this->set('pageDetail', $pageDetail);
			$this->set('pageId', $pageId);
		} else {
			$this->redirect(array('action'=>'index', 'page'=>$page));
		}
	}
	/**
	 * It is used to delete the page
	 *
	 * @access public
	 * @param integer $pageId page id
	 * @return void
	 */
	public function deletePage($pageId = null) {
		$page= (isset($this->request->params['named']['page'])) ? $this->request->params['named']['page'] : 1;
		if (!empty($pageId)) {
			if ($this->request->isPost()) {
				if ($this->Content->delete($pageId)) {
					$this->Session->setFlash(__('Selected page has been deleted successfully'),'default',array('class' => 'success'));
				}
			}
		}
		$this->redirect(array('action'=>'index', 'page'=>$page));
	}
	/**
	 * It is used to show page contents by url
	 *
	 * @access public
	 * @param string $urlName page url name
	 * @return void
	 */
	 public function content($urlName=null) {
		$invalidPage=true;
		if(!empty($urlName)) {
			$pageContents=$this->Content->findByUrlName($urlName);
			if(!empty($pageContents)) {
				//Layout
				$this->layout = "trader.dashboard";
				//Page title
				$page_title = array(
					'icon' => "icon-lightbulb",
					'name' => $pageContents['Content']['page_name'],
				);

				$this->set('page_title',$page_title);
				$invalidPage=false;
				
				$this->set('pageContents', $pageContents);
			}
		}
		if($invalidPage) {
			$this->redirect('/');
		}
	}
}