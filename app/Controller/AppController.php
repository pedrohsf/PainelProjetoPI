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

        // se estiver logado envia se o usuário é um supervisor ou não para todas as views
        if($this->Auth->loggedIn()){

            $this->set('supervisor', ($this->Auth->user('role') === 'Supervisor' ) ? TRUE : FALSE );

        }
        // seta variavel em todas as views para saber se user está ou não online
        $this->set('logado',$this->Auth->loggedIn());
        // seta variavel de endereço local do painel em todas as views para achar arquivos
        $this->set('admLocal',$this->admLocal);
        // seta variavel de controller em todas as views com o controller atual em minúsculo
		$this->set('controller',strtolower($this->params['controller']));
	}
	
}
