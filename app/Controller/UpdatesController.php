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
            $options = array ('conditions' => array('Project.accepted' => 0 ),'order'=>array('Project.created DESC'));
            $this->set('projects', $this->Project->find('all',$options));

            $this->ProfessionalExperience->recursive = 1;
            $options = array ('conditions' => array('ProfessionalExperience.accepted' => 0 ),'order'=>array('ProfessionalExperience.created DESC'));
            $this->set('professionalExperiences', $this->ProfessionalExperience->find('all',$options));

            $this->Formation->recursive = 1;
            $options = array ('conditions' => array('Formation.accepted' => 0 ),'order'=>array('Formation.created DESC'));
            $this->set('formations', $this->Formation->find('all',$options));

            $this->Photo->recursive = 1;
            $options = array ('conditions' => array('Photo.type' => 'proposal'),'order'=>array('Photo.created DESC'));
            $this->set('photos', $this->Photo->find('all',$options));

        }

        public function accept_project($id = null){
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

        public function accept_professional_experience($id = null){
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

        public function accept_formation($id = null){
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

        public function accept_photo($id = null){
            if (!$this->Photo->exists($id)) {
                throw new NotFoundException(__('Foto está inválido.'));
            }else{
                $photo = $this->Photo->find('first',array('conditions'=>array('Photo.id'=> $id)));

                $existUsedPhoto = $this->Photo->find('first',array('conditions'=>array( 'Photo.user_id'=>$photo['Photo']['user_id'] , 'Photo.type'=>'used' )));

                if(!empty($existUsedPhoto)){
                    if ($this->Photo->delete($existUsedPhoto['Photo']['id'])) {

                    }else{
                        $this->Session->setFlash(__('Ocorreu um erro durante a substituição da foto.'), 'flash/success');
                        $this->redirect(array('action' => 'index'));
                    }
                }

                $data['Photo']['id'] = $id;
                $data['Photo']['type'] = 'used';
                if ($this->Photo->save($data)) {
                    $this->Session->setFlash(__('A Foto foi aceita.'), 'flash/success');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash(__('Foto não pode ser aceito, tente novamente.'), 'flash/error');
                    $this->redirect(array('action' => 'index'));
                }
            }
        }

        public function description_update($id = null , $typeOfModel = null){

            if(!in_array($typeOfModel,array('ProfessionalExperience','Project','Formation','Photo')) ){
                throw new NotFoundException(__('Não é possivel fazer isto.'));
            }

            if (!$this->$typeOfModel->exists($id)) {
                throw new NotFoundException(__('Está solicitação está inválida.'));
            }

            $this->$typeOfModel->id = $id ;
            $data[$typeOfModel]['supervisor_description'] = $this->request->data['Info'];

            if(!empty($data[$typeOfModel]['supervisor_description'])){
                if($this->$typeOfModel->save($data)){
                    $this->Session->setFlash(__('A solicitação foi enviada com sucesso.'), 'flash/success');
                    $this->redirect(array('action' => 'index'));
                }
            }else{
                $this->Session->setFlash(__('A solicitação foi enviada com sucesso.'), 'flash/success');
                $this->redirect(array('action' => 'index'));

            }

            $this->redirect(array('action'=>'index'));


        }


    }