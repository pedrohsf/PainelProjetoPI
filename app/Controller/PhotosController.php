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


	public function add($c = null , $a = null) {
		if ($this->request->is('post')) {
			$this->Photo->create();
            $this->request->data['Photo']['user_id'] = $this->Auth->user('id');
            $existeAlgumaFoto = $this->Photo->find('first',array('conditions'=>array('Photo.user_id' => $this->Auth->user('id'), 'Photo.type' => 'proposal')));

            $jaExistiaUpdate = "";
            if (!empty($existeAlgumaFoto)){
                $this->request->data['Photo']['id'] = $existeAlgumaFoto['Photo']['id'] ;
                if (stripos($existeAlgumaFoto['Photo']['supervisor_description'],">revisado<") === false){
                     $this->request->data['Photo']['supervisor_description'] = $existeAlgumaFoto['Photo']['supervisor_description'].">revisado<" ;
                }
                $jaExistiaUpdate = "você já havia enviado uma foto anterior que estava como proposta de imagem de perfil, essa a substituirá,";
            }


            if ($this->Photo->save($this->request->data)) {
                $this->Session->setFlash( _('Sua imagem foi salva com sucesso,'.$jaExistiaUpdate.' espere até que seja avaliada e liberada por um supervisor.'), 'flash/success');
                if(!empty($c) AND !empty($a)){
                    $this->redirect(array('controller'=>$c ,'action' => $a));
                }else{
                    $this->redirect(array('controller'=>'projects' ,'action' => 'index'));
                }
			} else {
				$this->Session->setFlash(__('Sua imagem não pode ser salva, por favor tente novamente.'), 'flash/error');
                if(!empty($c) AND !empty($a)){
                    $this->redirect(array('controller'=>$c ,'action' => $a));
                }else{
                    $this->redirect(array('controller'=>'projects' ,'action' => 'index'));
                }
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
				$this->Session->setFlash(__('Sua imagem foi salva com sucesso, espere até que seja avaliada e liberada por um supervisor.'), 'flash/success');
                $this->redirect(array('action' => 'index'));
            } else {
				$this->Session->setFlash(__('Sua imagem não pode ser salvo, por favor tente novamente.'), 'flash/error');
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
