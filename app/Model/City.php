<?php

App::uses('AppModel', 'Model');
/**
 * Assinante Model
 *
 */
class City extends AppModel {


    public $belongsTo = array(
        'State' => array(
            'className' => 'State',
            'foreignKey' => 'state_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );




}
