<?php
App::uses('AppModel', 'Model');


class ProfessionalExperience extends AppModel {


    public $validate = array(
        'description' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Descrição não pode ficar inválido.',
            ),
        )
    );


    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

}
