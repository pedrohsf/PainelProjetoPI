<?php


 
App::uses('Controller', 'Controller');


class AppController extends Controller {
	
	public $theme = "Cakestrap";
	public $admLocal = '/painel_petzoo/';
	
	public $components = array(
		'Session', 
		'Auth' => array(
					'loginRedirect' => array('controller'=>'produtos','action'=>'index'), 
					'logoutRedirect' => array('controller'=>'users','action'=>'login')
		)
	);
	 
	
	public function beforeFilter(){
		$this->set('admLocal',$this->admLocal);
		
		$this->set('controller',strtolower($this->params['controller']));
		$this->set('logado',$this->Auth->loggedIn());
	}
	
}
