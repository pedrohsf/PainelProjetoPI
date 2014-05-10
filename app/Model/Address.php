<?php

App::uses('AppModel', 'Model');
/**
 * Assinante Model
 *
 */
class Address extends AppModel {

    public $recursive = 3;

    public $belongsTo = array(
        'Neighborhood' => array(
            'className' => 'Neighborhood',
            'foreignKey' => 'neighborhood_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );



}
