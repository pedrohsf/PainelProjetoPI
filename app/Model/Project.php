<?php
App::uses('AppModel', 'Model');
/**
 * Project Model
 *
 * @property User $User
 */
class Project extends AppModel {

    public $actsAs = array(
        'MeioUpload' => array(
            'filename' => array(
                'maxSize' => '4 MB',
                'dir' => 'files{DS}uploads',
                'allowedMime' => array(
                    'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                    'application/octet-stream',
                    'application/msword',
                    'application/pdf',
                    'text/plain',
                    'application/vnd.oasis.opendocument.text',
                ),
                'allowedExt' => array(
                    '.docx',
                    '.doc',
                    '.pdf',
                    '.txt',
                    '.odt',
                    '.zip',
                ),

            ),
        ),
    );

    public $validate = array(
		'description' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
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
