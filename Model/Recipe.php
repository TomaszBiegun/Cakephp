<?php
App::uses('AppModel', 'Model');

/**
 * Recipe Model
 *
 */
class Recipe extends AppModel
{

    /**
     * Display field
     *
     * @var string
     */
//    public $displayField = 'name';

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'name' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'preparation' => array(
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
//    public $belongsTo = array(
//        'Diet' => array(
//            'className' => 'Diet',
//            'foreignKey' => 'diet_name'
//        )
//    );
//    public $hasMany = array(
//        'RecipeProduct' => array(
//            'className' => 'RecipeProduct'
//        )
//    );
}
