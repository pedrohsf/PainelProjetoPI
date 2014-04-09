<?php
App::uses('AppController', 'Controller');
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
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}
	
	public function login(){
	
	
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

            pr( $this->request->data );

            exit();

			if ($this->User->save($this->request->data)) {
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

	
	public function busca_cep($cep){  
		$resultado = @file_get_contents('http://republicavirtual.com.br/web_cep.php?cep='.urlencode($cep).'&formato=query_string');  
		if(!$resultado){  
			$resultado = "&resultado=0&resultado_txt=erro+ao+buscar+cep";  
		}  
		parse_str($resultado, $retorno);   
		return $retorno;  
	}  
	
	
	public function buscar_o_cep(){ 
		$resultado_busca = $this->busca_cep('38700-254');  


		print_r ($resultado_busca);
		exit();
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
