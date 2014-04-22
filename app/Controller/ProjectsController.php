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
		$this->set('projects', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Project->exists($id)) {
			throw new NotFoundException(__('Project está inválido.'));
		}
		$options = array('conditions' => array('Project.' . $this->Project->primaryKey => $id));
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
			if ($this->Project->save($this->request->data)) {
				$this->Session->setFlash(__('Project foi salvo com sucesso!'), 'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Project não pode ser salvo, por favor tente novamente.'), 'flash/error');
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
			if ($this->Project->save($this->request->data)) {
				$this->Session->setFlash(__('Project foi salvo com sucesso!'), 'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Project não pode ser salvo, por favor tente novamente.'), 'flash/error');
			}
		} else {
			$options = array('conditions' => array('Project.' . $this->Project->primaryKey => $id));
			$this->request->data = $this->Project->find('first', $options);
		}
		$users = $this->Project->User->find('list');
		$this->set(compact('users'));
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
