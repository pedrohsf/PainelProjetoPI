<?php


    class SocialsController extends AppController{


        public $uses = array('Social');


        public function add(){

            if(isset($this->request->data['Social']['type']) AND isset($this->request->data['Social']['link'])){
                $type = $this->request->data['Social']['type'];
                $link = $this->request->data['Social']['link'];
                // redes sociais possiveis de cadastro
                if(in_array($type,array('facebook','twitter','linkdin','google+'))){
                    // não pode estar vazio o link
                    if(!empty($link)){
                        $existType = $this->Social->find('first',array('conditions'=>array('Social.user_id' => $this->Auth->user('id'), 'Social.type' => $type)));

                        $existTypeMessage = "";
                        if (!empty($existType)){
                            $this->request->data['Social']['id'] = $existType['Social']['id'];
                            $existTypeMessage = "você já havia enviado um link, essa o substituirá,";
                            if(!empty($existType['Social']['supervisor_description'])){
                                if (stripos($existType['Social']['supervisor_description'],">revisado<") === false){
                                    $this->request->data['Social']['supervisor_description'] = $existType['Social']['supervisor_description'].">revisado<" ;
                                }
                            }
                        }
                        $this->request->data['Social']['user_id'] = $this->Auth->user('id');
                        $this->request->data['Social']['accepted'] = 0;
                        if ($this->Social->save($this->request->data)) {
                            $this->Session->setFlash( _('Sua rede social foi salva com sucesso, '.$existTypeMessage.' espere até que seja avaliada e liberada por um supervisor.'), 'flash/success');
                            $this->redirectByRole();
                        } else {
                            $this->Session->setFlash(__('Sua imagem não pode ser salva, por favor tente novamente.'), 'flash/error');
                        }


                    }else{
                        $this->Session->setFlash('Por favor insira um link para sua rede social.','flash/error');
                        $this->redirectByRole();
                    }

                }else{
                    $this->Session->setFlash('Não é possivel cadastrar essa rede social, entre em contato com o supervisor.','flash/error');
                    $this->redirectByRole();
                }
            }else{ // caso os campos de cadastro não sejam completados adequadamente
                $this->redirectByRole();
            }
        }

        public function delete($id = null){

            if (!$this->request->is('post')) {
                throw new MethodNotAllowedException();
            }
            $this->Social->id = $id;
            if (!$this->Social->exists()) {
                throw new NotFoundException(__('Social link inválido.'));
            }

            if(!($this->userIsSupervisor())){
                $deleteItem = $this->Social->find('first',array('conditions'=>array('Social.user_id' => $this->Auth->user('id'),'Social.id' => $id)));
                if(empty($deleteItem)){
                    $this->Session->setFlash(__('Você não pode fazer isto.'), 'flash/success');
                    $this->redirectByRole();
                }
            }

            if ($this->Social->delete()) {
                $this->Session->setFlash(__('Link apagado.'), 'flash/success');
                $this->redirectByRole();
            }

            $this->Session->setFlash(__('Link não pode ser apagado.'), 'flash/error');
            $this->redirectByRole();

        }

    }