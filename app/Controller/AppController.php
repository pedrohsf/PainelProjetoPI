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
            'logoutRedirect' => array('controller' => 'users', 'action' => 'login'),
            'authError' => 'Desculpe mais você não tem permissão para acessar está área.'
        )
    );

    /*
     * Função criada para verificar se usuário é um supervisor
     * Todos que extenderem AppController podem usar, função global
     */

    protected function userIsSupervisor(){
        if($this->Auth->loggedIn()){

            if($this->Auth->user('role') === 'Supervisor'){
                return true;
            }

        }
        return false;
    }


    /*
     * Before Filter é chamado antes de qualquer validação, cadastro ou renderização da pagina...
     * Este before filter se repete para todos os controllers pois todos extender o APP Controller
     */

	public function beforeFilter(){





        $this->AppAction = strtolower($this->params['action']);
        $this->AppController = strtolower($this->params['controller']);

        $this->set('logado',$this->Auth->loggedIn());
        $this->set('admLocal',$this->admLocal);
		$this->set('controller',strtolower($this->params['controller']));
	}
	
}
