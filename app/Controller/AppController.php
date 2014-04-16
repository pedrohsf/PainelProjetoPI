<?php


 
App::uses('Controller', 'Controller');


class AppController extends Controller {
	
	public $theme = "Cakestrap";
	public $admLocal = '/trabalho_pi/';

    public $AppAction;
    public $AppController;




    public $components = array(
        'Paginator',
        'Session',
        'Paginator',
        'Auth' => array(
            'loginRedirect' => array('controller' => 'users', 'action' => 'index'),
            'logoutRedirect' => array('controller' => 'users', 'action' => 'login')
        )
    );


	public function beforeFilter(){





        $this->AppAction = strtolower($this->params['action']);
        $this->AppController = strtolower($this->params['controller']);

        $this->set('admLocal',$this->admLocal);
		$this->set('controller',strtolower($this->params['controller']));
	}
	
}
