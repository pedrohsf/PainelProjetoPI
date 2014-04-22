<?php
App::uses('AppModel', 'Model');


class Update extends AppModel {



    public $validate = array(
        'table' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Usuario não pode ficar inválido.',
            ),
        )
    );


    public $belongsTo = array(
        'UpdateDescription' => array(
            'className' => 'UpdateDescription',
            'foreignKey' => 'update_description_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

}
