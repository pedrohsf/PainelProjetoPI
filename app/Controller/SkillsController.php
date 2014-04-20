<?php

    class SkillsController extends AppController{

        public $uses = array('Skill');

        public function index(){

            $this->Skill->recursive = 0;
            $this->set('skills', $this->paginate());

        }


        public function add(){
            if ($this->request->is('post')) {
                $this->Skill->create();

                if ($this->Skill->save($this->request->data)) {
                    $this->Session->setFlash( _('Skill cadastrado com sucesso.'), 'flash/success');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash(__('Skill não pode ser cadastrado, por favor tente novamente.'), 'flash/error');
                }
            }
        }

    }