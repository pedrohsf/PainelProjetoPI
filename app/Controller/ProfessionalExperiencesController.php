
<?php



class ProfessionalExperiencesController extends AppController{

    public $uses = array("ProfessionalExperience");

    public function index(){
            $this->ProfessionalExperience->recursive = 0;
            $this->paginate = array ('ProfessionalExperience' => array('conditions' => array('ProfessionalExperience.user_id' => $this->Auth->user('id') )));
            $this->set('professionalExperiences', $this->paginate());
    }



    public function add(){
        if ($this->request->is('post')) {
            $this->ProfessionalExperience->create();
            $this->request->data['ProfessionalExperience']['user_id']  = $this->Auth->user('id');
            $this->request->data['ProfessionalExperience']['accepted']  = 0;
            if($this->ProfessionalExperience->save($this->request->data)){
                $this->Session->setFlash( _('Experiência Profissional cadastrado com sucesso, espere a aprovação de um supervisor.'), 'flash/success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Experiência Profissional não pode ser cadastrado, por favor tente novamente.'), 'flash/error');
            }
        }
    }


    public function view($id = null) {
        if (!$this->ProfessionalExperience->exists($id)) {
            throw new NotFoundException(__('Experiência Profissional está inválido.'));
        }

        $options = array('conditions' => array('ProfessionalExperience.' . $this->ProfessionalExperience->primaryKey => $id));

        $experience =  $this->ProfessionalExperience->find('first', $options);

        if ( $experience['ProfessionalExperience']['user_id'] != $this->Auth->user('id') ){
            if( ! $this->userIsSupervisor() ){
                $this->Session->setFlash(__('Você não é dono desta experiência profissional, não pode ter acesso as suas informações.'), 'flash/success');
                $this->redirect(array('action'=>'index'));
            }
        }else if ( (! $experience['ProfessionalExperience']['accepted']) AND empty($experience['ProfessionalExperience']['supervisor_description'])){
            $this->Session->setFlash(__('Esta experiência profissional ainda não foi avaliado por um supervisor.'), 'flash/success');
            $this->redirect(array('action'=>'index'));
        }
        $this->set('professionalExperiences', $this->ProfessionalExperience->find('first', $options));
    }

    public function edit($id = null) {
        $this->ProfessionalExperience->id = $id;
        if (!$this->ProfessionalExperience->exists($id)) {
            throw new NotFoundException(__('Experiencia Profissional está inválido.'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {

            $options = array('conditions' => array('ProfessionalExperience.' . $this->ProfessionalExperience->primaryKey => $id));
            $experience = $this->ProfessionalExperience->find('first', $options);

            if ( $experience['ProfessionalExperience']['user_id'] != $this->Auth->user('id') ){
                if( ! $this->userIsSupervisor() ){
                    $this->Session->setFlash(__('Você não é dono desta experiência profissional, não pode ter acesso as suas informações.'), 'flash/success');
                    $this->redirect(array('action'=>'index'));
                }
            }

            $this->request->data['ProfessionalExperience']['accepted'] = 0; // valida aceitação do projeto
            // strripos verifica se existe uma cadeia de char em uma string
            if (stripos($experience['ProfessionalExperience']['supervisor_description'],">revisado<") === false){
                $this->request->data['ProfessionalExperience']['supervisor_description'] = $experience['ProfessionalExperience']['supervisor_description'] . ">revisado<"; // garantir que a antiga descrição do supervisor depois de atualizado vai vim com a flag de revisado
            }

            if ($this->ProfessionalExperience->save($this->request->data)) {
                $this->Session->setFlash(__('A experiência profissional foi reenviada com sucesso, espere uma nova revisão do supervisor.'), 'flash/success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Project não pode ser salvo, por favor tente novamente.'), 'flash/error');
            }
        } else {
            $options = array('conditions' => array('ProfessionalExperience.' . $this->ProfessionalExperience->primaryKey => $id));

            $this->request->data = $this->ProfessionalExperience->find('first', $options);
        }

    }


    public function delete($id = null) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->ProfessionalExperience->id = $id;
        if (!$this->ProfessionalExperience->exists()) {
            throw new NotFoundException(__('Experiência Profissional está inválido.'));
        }
        if ($this->ProfessionalExperience->delete()) {
            $this->Session->setFlash(__('Experiência Profissional foi apagado.'), 'flash/success');
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Experiência Profissional não pode ser apagado.'), 'flash/error');
        $this->redirect(array('action' => 'index'));
    }



}