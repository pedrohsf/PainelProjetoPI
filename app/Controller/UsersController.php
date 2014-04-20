<?php

App::uses('AppController', 'Controller');

require_once('ValidaCadastroEnderecosController.php');


/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends AppController {

/**
 * Components
 *
 * @var array
 */
    // receber a instancia da classe que valida o endereço
    public $validaCadastroEnderecoController;

    /*
     * Before Filter é chamado antes de qualquer validação, cadastro ou renderização da pagina...
     */
    public function beforeFilter(){
        parent::beforeFilter();
        // libera o cadastro de usuario para quem não está logado no painel
        $this->Auth->allow('add');
        // caso ele ja esteja logado não logar novamente, redirecionar a index
        if($this->Auth->loggedIn()){
            // não deixa fazer cadastro quando se está logado
            if($this->AppAction === 'add'){
                $this->redirect(array('action'=>'index'));
            }
            // não deixa alunos entrarem na área administrativa do supervisor
            if($this->AppAction === 'index'){
                if($this->Auth->user('role') !== 'Supervisor'){
                    $this->redirect(array('action'=>'painelAluno'));
                }
            }

        }



    }

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->User->recursive = 0;
        $this->paginate = array ('User' => array('conditions' => array('User.id !=' => $this->Auth->user('id') )));
        $this->set('users', $this->paginate());
	}

    /*
     * Action de login
     * @return void
     */
    public function login() {

        // Se a requisição for um post
        if($this->request->is('post')){
            // Tenta logar, se logar retorna um true, e todos os dados do user ficam no objeto AUTH
            if ($this->Auth->login()) {
                // se usuário não estiver sido confirmado como aceito, ele não deixa entrar
                if(! $this->Auth->user('accepted')){
                    $this->Session->setFlash( _('Seu cadastro ainda não foi confirmado, por favor entre em contato com o supervisor!'), 'flash/error');
                    $this->redirect(array('action' => 'logout'));
                }else{
                    // se for supervisor direciona para painel do supervisor
                    if($this->Auth->user('role') === 'Supervisor'){
                        $this->redirect(array('action'=>'index'));
                        // se não direciona para painel do aluno
                    }else{
                        $this->redirect(array('action'=>'painelAluno'));
                    }
                }
            } else {
                // se não conseguir entrar, é por que usuario ou senha esetão inválidos
                $this->Session->setFlash('Usuário ou senha estão inválidos, por favor tente novamente.', 'flash/error');
            }
            // Se já estiver logado, não tem necessidade de mostrar a tela de login novamente
        }else if($this->Auth->loggedIn()){

            $this->Session->setFlash(__('Você já está logado no sistema.'), 'flash/error');
            $this->redirect($this->Auth->redirect());
        }

    }

    public function logout() {
        $this->redirect($this->Auth->logout());
    }


    /*
     * Libera o registro do aluno
     * Primeiro parametro id do usuário segundo parametro se retorna ou não para view do user
     *
     * Ex: liberarRegistro(6,true) // libera o registro e retorna para users/view/6
     * Ex: liberarRegistro(6) // libera o registro e retorna para users/index
     *
     */

    public function liberarRegistro($id = null, $view = null){
        if(!empty($id) AND $id != null){
            if($this->userIsSupervisor()){
                if (!$this->User->exists($id)) {
                    throw new NotFoundException(__('User está inválido.'));
                }
                $this->User->id = $id;

                if ($this->User->save(array('User'=>array('accepted'=>1)))) {
                    $this->Session->setFlash(__('Usuário liberado para acessar o portal!'), 'flash/success');
                    if($view){
                        $this->redirect(array('action' => 'view',$id));
                    }
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash(__('User não pode ser liberado, por favor tente novamente.'), 'flash/error');
                }

            }
        }else{
            throw new NotFoundException(__('User está inválido.'));
        }
    }



    /*
     * Bloqueia o registro do usuário
     * Primeiro parametro id do usuário, segundo parametro se verdadeiro retorna a view de user
     *
     * bloquearRegistro (2,true) bloqueia o registro e retorna para users/view/2
     * bloquearRegistro (2) bloqueia o registro e retorna para users/index
     */
    public function bloquearRegistro($id = null, $view = null){
        if(!empty($id) AND $id != null){
            if($this->userIsSupervisor()){
                if (!$this->User->exists($id)) {
                    throw new NotFoundException(__('User está inválido.'));
                }
                $this->User->id = $id;

                if ($this->User->save(array('User'=>array('accepted'=>0)))) {
                    $this->Session->setFlash(__('Usuário bloqueado para acessar o portal!'), 'flash/success');
                    if($view){
                        $this->redirect(array('action' => 'view',$id));
                    }
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash(__('User não pode ser bloqueado, por favor tente novamente.'), 'flash/error');
                }

            }
        }else{
            throw new NotFoundException(__('User está inválido.'));
        }
    }


/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('User está inválido.'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() { 
		if ($this->request->is('post')) {
			$this->User->create();
            // Inicio da decodificação do array
            // Quando usa-se o web-service foi preciso codificar em utf 8 para poder passar pelo json e ir para o javascript
            // Quando o formulário volta eu decodifico todas as informações pra ter certeza que estão em utf8
            $requisicao = $this->request->data['User'] ;
            foreach($requisicao as $key => $value){

                if(!is_array($requisicao[$key]))
                    $requisicao[$key] = utf8_decode($value);
                else
                    foreach($requisicao[$key] as $key2 => $value2){

                        $requisicao[$key][$key2] = utf8_decode($value2);
                    }

            }
            $this->request->data['User'] = $requisicao;
            // Fim da decodificação do array
            // Pega o endereço a ser cadastrado
            $address = $this->request->data['User'];

            // OBjeto que cuida do cadastro dos endereços , se ja existir o mesmo endereço igualzinho cadastrado, ele retorna o id...
            $this->validaCadastroEnderecoController = New ValidaCadastroEnderecosController();
            // pega o id do endereço que foi informado.
            $idAddress = $this->validaCadastroEnderecoController->mergeAddresses($address);

            $saveUser['User'] = $this->request->data['User'];

            unset($saveUser['User']['Address']);
            unset($saveUser['User']['Neighborhood']);
            unset($saveUser['User']['City']);
            unset($saveUser['User']['State']);
            $saveUser['User']['address_id'] = $idAddress;

            if ($this->User->save($saveUser)) {
				$this->Session->setFlash( _('User foi salvo com sucesso, espere até que sua inscrição seja avaliada e liberada por um supervisor.'), 'flash/success');
				$this->redirect(array('action' => 'login'));
			} else {
				$this->Session->setFlash(__('User não pode ser salvo, por favor tente novamente.'), 'flash/error');
			}
		}

    }


    /*
     * Painel do aluno action
     *
     */

    public function painelAluno(){

        $usuario = $this->User->find('first',array('conditions'=>array('User.id'=>$this->Auth->user('id'))));
        $this->set('usuario',$usuario);
    }

	
/**
 * delete method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('User está inválido.'));
		}
		if ($this->User->delete()) {
			$this->Session->setFlash(__('User foi apagado.'), 'flash/success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('User não pode ser apagado.'), 'flash/error');
		$this->redirect(array('action' => 'index'));
	}
}
