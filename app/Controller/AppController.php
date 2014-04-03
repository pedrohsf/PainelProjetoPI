<?php


 
App::uses('Controller', 'Controller');


class AppController extends Controller {
	
	public $theme = "Cakestrap";
	public $admLocal = '/trabalho_pi/';
	
	
	 
	
	public function beforeFilter(){
		$this->set('admLocal',$this->admLocal);
		
		$this->set('controller',strtolower($this->params['controller']));
	}
	
}
