<?php
App::uses('AppController', 'Controller');
/**
 * Projects Controller
 *
 * @property Project $Project
 * @property PaginatorComponent $Paginator
 */
class ProjectsController extends AppController {

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
		$this->Project->recursive = 0;
        $this->paginate = array ('Project' => array('conditions' => array('Project.user_id' => $this->Auth->user('id') )));
		$this->set('projects', $this->paginate());
	}


    /*
     * Função para verificar as pendências do usuário
     * Caso ela exista...
     */


    public function view($id = null) {
        if (!$this->Project->exists($id)) {
            throw new NotFoundException(__('Projeto está inválido.'));
        }

        $options = array('conditions' => array('Project.' . $this->Project->primaryKey => $id));

        $projeto =  $this->Project->find('first', $options);

        if ( $projeto['Project']['user_id'] != $this->Auth->user('id') ){
            if( ! $this->userIsSupervisor() ){
                $this->Session->setFlash(__('Você não é dono deste projeto, não pode ter acesso as suas informações.'), 'flash/success');
                $this->redirect(array('action'=>'index'));
            }
        }else if ( (! $projeto['Project']['accepted']) AND empty($projeto['Project']['supervisor_description'])){
            $this->Session->setFlash(__('Este projeto ainda não foi avaliado por um supervisor.'), 'flash/success');
            $this->redirect(array('action'=>'index'));
        }
        $this->set('project', $this->Project->find('first', $options));
    }

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Project->create();
            $this->request->data['Project']['user_id'] = $this->Auth->user('id'); // valida o user online como dono do projeto
            $this->request->data['Project']['accepted'] = 0; // valida sempre que cadastrado ainda não foi avaliado
			if ($this->Project->save($this->request->data)) {
				$this->Session->setFlash(__('O Projeto foi enviado para análise, se aceito vai aparecer nos seus projetos automáticamente.'), 'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Projeto não pode ser salvo, por favor tente novamente.'), 'flash/error');
                $this->redirect(array('action' => 'index'));
			}
		}
		$users = $this->Project->User->find('list');
		$this->set(compact('users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
        $this->Project->id = $id;
		if (!$this->Project->exists($id)) {
			throw new NotFoundException(__('Project está inválido.'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {

            $options = array('conditions' => array('Project.' . $this->Project->primaryKey => $id));
            $projeto = $this->Project->find('first', $options);

            if ( $projeto['Project']['user_id'] != $this->Auth->user('id') ){
                if( ! $this->userIsSupervisor() ){
                    $this->Session->setFlash(__('Você não é dono deste projeto, não pode ter acesso as suas informações.'), 'flash/success');
                    $this->redirect(array('action'=>'index'));
                }
            }

            $this->request->data['Project']['accepted'] = 0; // valida aceitação do projeto
            // strripos verifica se existe uma cadeia de char em uma string
            if (stripos($projeto['Project']['supervisor_description'],">revisado<") === false){
                $this->request->data['Project']['supervisor_description'] = $projeto['Project']['supervisor_description'] . ">revisado<"; // garantir que a antiga descrição do supervisor depois de atualizado vai vim com a flag de revisado
            }

			if ($this->Project->save($this->request->data)) {
				$this->Session->setFlash(__('O projeto foi reenviado com sucesso, espere uma nova revisão do supervisor.'), 'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Project não pode ser salvo, por favor tente novamente.'), 'flash/error');
			}
		} else {
			$options = array('conditions' => array('Project.' . $this->Project->primaryKey => $id));

			$this->request->data = $this->Project->find('first', $options);
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
		$this->Project->id = $id;
		if (!$this->Project->exists()) {
			throw new NotFoundException(__('Project está inválido.'));
		}
		if ($this->Project->delete()) {
			$this->Session->setFlash(__('Project foi apagado.'), 'flash/success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Project não pode ser apagado.'), 'flash/error');
		$this->redirect(array('action' => 'index'));
	}

}
