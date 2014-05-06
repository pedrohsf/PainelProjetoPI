<?php
App::uses('AppModel', 'Model');
/**
 * Photo Model
 *
 * @property User $User
 */
class Photo extends AppModel {


    var $actsAs = array(
        'MeioUpload' => array(
            'filename' => array(
                'thumbsizes' => array(
                    'mini' => array(
                        'width' => 30,
                   ),
                   'pequena' => array(
                        'width' => 48,
                   ),
                   'medio' => array(
                        'width' => 200,
                    )
                )
            )
        )
    );

    public $validate = array(
        'user_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
    );

    //The Associations below have been created with all possible keys, those that are not needed can be removed

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
