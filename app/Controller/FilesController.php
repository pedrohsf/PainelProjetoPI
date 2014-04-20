
<?php


// Esta classe controla os arquivos dos trabalhos dos alunos
 class FilesController extends AppController{

     public $uses = array('File','Update');

     public function index(){

         $this->File->recursive = 0;
         $this->set('files', $this->paginate());


     }

 
     public function add(){

         if($this->request->is('post')){

             pr($this->request->data);
             exit();

             if($this->Update->save($this->request->data)){

                 print("echo");
                 exit();

             }


         }


     }


 }