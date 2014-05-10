<?php

App::uses('AppModel', 'Model');
/**
 * Assinante Model
 *
 */
class Neighborhood extends AppModel {


    public $belongsTo = array(
        'City' => array(
            'className' => 'City',
            'foreignKey' => 'city_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );





}
