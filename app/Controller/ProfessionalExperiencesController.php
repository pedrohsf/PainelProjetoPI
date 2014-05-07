
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
            if($this->ProfessionalExperience->save($this->request->data)){
                $this->Session->setFlash( _('Experiência Profissional cadastrado com sucesso, espere a aprovação de um supervisor.'), 'flash/success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Experiência Profissional não pode ser cadastrado, por favor tente novamente.'), 'flash/error');
            }
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