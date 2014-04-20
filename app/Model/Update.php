<?php
App::uses('AppModel', 'Model');


class Update extends AppModel {

    public $actsAs = array(
        'MeioUpload' => array(
            'filename' => array(
                'maxSize' => '20 MB',
                'dir' => 'files{DS}uploads',
                'allowedMime' => array(
                    'application/x-rar-compressed',
                    'application/octet-stream',
                    'application/zip',
                ),
                'allowedExt' => array(
                    '.rar',
                    '.zip'
                ),

            ),
        ),
    );


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
