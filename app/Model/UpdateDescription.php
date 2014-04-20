<?php
App::uses('AppModel', 'Model');


class UpdateDescription extends AppModel {


    public $validate = array(
        'description' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Descrição não pode ficar inválido.',
            ),
        )
    );


    public $hasMany = array(
        'Update' => array(
            'className' => 'Update',
            'foreignKey' => 'update_description_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
    );

}
