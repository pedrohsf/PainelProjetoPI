<?php
App::uses('AppController', 'Controller');
/**
 * Photos Controller
 *
 * @property Photo $Photo
 * @property PaginatorComponent $Paginator
 */
class PhotosController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');


	public function add() { 
		if ($this->request->is('post')) {
			$this->Photo->create();
			if ($this->Photo->save($this->request->data)) {
				$this->Session->setFlash(__('Photo foi salvo com sucesso!'), 'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Photo não pode ser salvo, por favor tente novamente.'), 'flash/error');
			}
		}
		$users = $this->Photo->User->find('list');
		$this->set(compact('users'));
	}

	public function edit($id = null) {
        $this->Photo->id = $id;
		if (!$this->Photo->exists($id)) {
			throw new NotFoundException(__('Photo está inválido.'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Photo->save($this->request->data)) {
				$this->Session->setFlash(__('Photo foi salvo com sucesso!'), 'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Photo não pode ser salvo, por favor tente novamente.'), 'flash/error');
			}
		} else {
			$options = array('conditions' => array('Photo.' . $this->Photo->primaryKey => $id));
			$this->request->data = $this->Photo->find('first', $options);
		}
		$users = $this->Photo->User->find('list');
		$this->set(compact('users'));
	}

	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Photo->id = $id;
		if (!$this->Photo->exists()) {
			throw new NotFoundException(__('Photo está inválido.'));
		}
		if ($this->Photo->delete()) {
			$this->Session->setFlash(__('Photo foi apagado.'), 'flash/success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Photo não pode ser apagado.'), 'flash/error');
		$this->redirect(array('action' => 'index'));
	}
}
