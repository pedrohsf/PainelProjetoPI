<?php
App::uses('AppController', 'Controller');



class FormationsController extends AppController {

    public $uses = array('Formation');

    public function index(){
        $this->Formation->recursive = 0;
        $this->paginate = array ('Formation' => array('conditions' => array('Formation.user_id' => $this->Auth->user('id') )));
        $this->set('formations', $this->paginate());
    }


    public function add(){
        if ($this->request->is('post')) {
            $this->Formation->create();
            $this->request->data['Formation']['user_id']  = $this->Auth->user('id');
            $this->request->data['Formation']['accepted']  = 0;
            if($this->Formation->save($this->request->data)){
                $this->Session->setFlash( _('Formação cadastrado com sucesso, espere a aprovação de um supervisor.'), 'flash/success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Formação não pode ser cadastrado, por favor tente novamente.'), 'flash/error');
                $this->redirect(array('action' => 'index'));
            }
        }
    }

    public function view($id = null) {
        if (!$this->Formation->exists($id)) {
            throw new NotFoundException(__('Formação está inválido.'));
        }

        $options = array('conditions' => array('Formation.' . $this->Formation->primaryKey => $id));

        $formation =  $this->Formation->find('first', $options);

        if ( $formation['Formation']['user_id'] != $this->Auth->user('id') ){
            if( ! $this->userIsSupervisor() ){
                $this->Session->setFlash(__('Você não é dono desta formação, não pode ter acesso as suas informações.'), 'flash/success');
                $this->redirect(array('action'=>'index'));
            }
        }else if ( (! $formation['Formation']['accepted']) AND empty($formation['Formation']['supervisor_description'])){
            $this->Session->setFlash(__('Esta formação ainda não foi avaliado por um supervisor.'), 'flash/success');
            $this->redirect(array('action'=>'index'));
        }
        $this->set('formation', $this->Formation->find('first', $options));
    }


    public function edit($id = null) {
        $this->Formation->id = $id;
        if (!$this->Formation->exists($id)) {
            throw new NotFoundException(__('Formação está inválido.'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {

            $options = array('conditions' => array('Formation.' . $this->Formation->primaryKey => $id));
            $formation = $this->Formation->find('first', $options);

            if ( $formation['Formation']['user_id'] != $this->Auth->user('id') ){
                if( ! $this->userIsSupervisor() ){
                    $this->Session->setFlash(__('Você não é dono desta formação, não pode ter acesso as suas informações.'), 'flash/success');
                    $this->redirect(array('action'=>'index'));
                }
            }

            $this->request->data['Formation']['accepted'] = 0; // valida aceitação do projeto
            // strripos verifica se existe uma cadeia de char em uma string
            if (stripos($formation['Formation']['supervisor_description'],">revisado<") === false){
                $this->request->data['Formation']['supervisor_description'] = $formation['Formation']['supervisor_description'] . ">revisado<"; // garantir que a antiga descrição do supervisor depois de atualizado vai vim com a flag de revisado
            }

            if ($this->Formation->save($this->request->data)) {
                $this->Session->setFlash(__('A formação foi reenviada com sucesso, espere uma nova revisão do supervisor.'), 'flash/success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Formação não pode ser salvo, por favor tente novamente.'), 'flash/error');
            }
        } else {
            $options = array('conditions' => array('Formation.' . $this->Formation->primaryKey => $id));

            $this->request->data = $this->Formation->find('first', $options);
        }

    }


    public function delete($id = null) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->Formation->id = $id;
        if (!$this->Formation->exists()) {
            throw new NotFoundException(__('Formação está inválido.'));
        }
        if ($this->Formation->delete()) {
            $this->Session->setFlash(__('Formação foi apagado.'), 'flash/success');
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Formação não pode ser apagado.'), 'flash/error');
        $this->redirect(array('action' => 'index'));
    }


}