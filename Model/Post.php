<?php
App::uses('AppModel', 'Model');

/**
 * Post Model
 *
 */
class Post extends AppModel
{

    /**
     * Display field
     *
     * @var string
     */
    public $displayField = 'title';
    var $actsAs = array('Media.Transfer', 'Media.Coupler', 'Media.Meta', 'Media.Generator');
    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'title' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'body' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
    );
}
