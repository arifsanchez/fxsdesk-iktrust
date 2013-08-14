<?php
App::uses('AppController', 'Controller');
/**
 * Mt4Users Controller
 *
 * @property Mt4User $Mt4User
 */
class Mt4UsersController extends AppController {

	public $paginate = array(
        'limit' => 15,
        'order' => array(
            'Mt4User.LOGIN' => 'desc'
        )
    );

/**
 * index method
 *
 * @return void
 */	
	public function trader() {
		$this->Mt4User->recursive = -1;
		$this->set('mt4Users', $this->paginate('Mt4User', array('Mt4User.GROUP LIKE' => 'IK%')));

	}

	public function partner() {
		$this->Mt4User->recursive = -1;
		$this->set('mt4Users', $this->paginate('Mt4User', array('Mt4User.COMMENT LIKE' => 'ML%')));

	}

	public function partner_client($acc = null) {
		$this->layout = 'admin';
		$this->Mt4User->recursive = -1;
		$this->set('mt4Users', $this->paginate('Mt4User', array('Mt4User.AGENT_ACCOUNT LIKE' => ''.$acc.'%')));

	}
	
	public function top_traders(){
		$this->layout = 'register_kabinet';		
	
		$data = $this->Mt4User->find('all', 
			array('conditions' => array(
				'Mt4User.BALANCE >' => '100', 
				'Mt4User.GROUP LIKE' => '%IK-i%',
				'Mt4User.COUNTRY !=' => array('Iran', 'India'),
			),
				'limit' => 1,
				'order' => array('Mt4User.BALANCE DESC')
		));
		debug($data);
		
        $this->loadModel('Countries');
		$flag = $this->Countries->find('all', 
			array('conditions' => array(
				'Countries.name' => $data[0]['Mt4User']['COUNTRY'],
			),
			'limit' => 1,
		)); 
		debug($flag);
		
       $this->set(compact('data', 'flag'));
	}	
	
	/*public function index() {
		$this->layout = 'admin';
		$this->Mt4User->recursive = -1;
		$this->set('mt4Users', $this->paginate());

		if($this->request->data){
			$VALUE = $this->request->data['Mt4User']['LOGIN'];
			
			if(!$this->Account->exists($VALUE)){
			} else {
				$this->redirect(array('action' => 'view',$VALUE));
			}
		}
	}*/
	
	public function search(){
		if($this->RequestHandler->isAjax() ) {
			Configure::write ('debug', 0);
			$this->autoRender=false;
			$this->Mt4User->recursive = -1;
			
			$users = $this->Mt4User->find('all',array('conditions'=>array('mt4Users.TICKET LIKE'=>'%'.$_GET['term'].'%')));
			$i=0;
			
			foreach($users as $user){
				$response[$i]['LOGIN']=$user['Mt4User']['LOGIN'];
				$i++;
			}
			echo json_encode($response);
	   }
	   
	   else{
			if (!empty($this->Mt4Trade->data)){
			}
			else{
				$this->redirect(array('action' => 'view', $this->data['Mt4User']['LOGIN']));
			}
		}
	}
}
