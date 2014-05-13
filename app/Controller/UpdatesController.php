<?php

    class UpdatesController extends AppController{

        public $uses = array('Project','ProfessionalExperience','Formation','Photo');

        public function beforeFilter(){
            parent::beforeFilter();
            if(! $this->userIsSupervisor() ){
                $this->Session->setFlash("Você não tem acesso a este painel.");
                $this->redirect(array('controller'=>'users','action'=>'logout'));
            }


        }

        public function index(){
            $this->Project->recursive = 1;
            $options = array ('conditions' => array('Project.accepted' => 0 ));
            $this->set('projects', $this->Project->find('all',$options));

            $this->ProfessionalExperience->recursive = 1;
            $options = array ('conditions' => array('ProfessionalExperience.accepted' => 0 ));
            $this->set('professionalExperiences', $this->ProfessionalExperience->find('all',$options));

            $this->Formation->recursive = 1;
            $options = array ('conditions' => array('Formation.accepted' => 0 ));
            $this->set('formations', $this->Formation->find('all',$options));

            $this->Photo->recursive = 1;
            $options = array ('conditions' => array('Photo.type' => 'proposal'));
            $this->set('photos', $this->Photo->find('all',$options));

        }

        public function acceptProject($id = null){
            if (!$this->Project->exists($id)) {
                throw new NotFoundException(__('Projeto está inválido.'));
            }else{
                $data['Project']['id'] = $id;
                $data['Project']['accepted'] = 1;
                if ($this->Project->save($data)) {
                    $this->Session->setFlash(__('O Projeto foi aceito.'), 'flash/success');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash(__('Projeto não pode ser aceito, tente novamente.'), 'flash/error');
                    $this->redirect(array('action' => 'index'));
                }
            }



        }

        public function acceptProfessionalExperience($id = null){
            if (!$this->ProfessionalExperience->exists($id)) {
                throw new NotFoundException(__('Experiência Profissional está inválido.'));
            }else{
                $data['ProfessionalExperience']['id'] = $id;
                $data['ProfessionalExperience']['accepted'] = 1;
                if ($this->ProfessionalExperience->save($data)) {
                    $this->Session->setFlash(__('A Experiência Profissional foi aceito.'), 'flash/success');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash(__('Experiência Profissional não pode ser aceito, tente novamente.'), 'flash/error');
                    $this->redirect(array('action' => 'index'));
                }
            }



        }

        public function acceptFormation($id = null){
            if (!$this->Formation->exists($id)) {
                throw new NotFoundException(__('Formação está inválido.'));
            }else{
                $data['Formation']['id'] = $id;
                $data['Formation']['accepted'] = 1;
                if ($this->Formation->save($data)) {
                    $this->Session->setFlash(__('A Formação foi aceito.'), 'flash/success');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash(__('Formação não pode ser aceito, tente novamente.'), 'flash/error');
                    $this->redirect(array('action' => 'index'));
                }
            }
        }

    }