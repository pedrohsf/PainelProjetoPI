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

    public function beforeFilter(){
        parent::beforeFilter();
        // libera o cadastro de usuario para quem não está logado no painel
        $this->Auth->allow('add');
        // caso ele ja esteja logado não logar novamente, redirecionar a index
        if($this->Auth->loggedIn()){
            if($this->AppAction === 'add'){
                $this->redirect(array('action'=>'index'));
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
                }
                // Redireciona para pagina definida na configuração do componente
                $this->redirect($this->Auth->redirect());
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
				$this->Session->setFlash( _('User foi salvo com sucesso!'), 'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('User não pode ser salvo, por favor tente novamente.'), 'flash/error');
			}
		}

    }

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
        $this->User->id = $id;
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('User está inválido.'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('User foi salvo com sucesso!'), 'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('User não pode ser salvo, por favor tente novamente.'), 'flash/error');
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
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
