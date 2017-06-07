<?php
App::uses('AppModel', 'Model');

/**
 * Created by PhpStorm.
 * User: Tomasz
 * Date: 25.03.2016
 * Time: 10:15
 */
class Componnent extends AppModel
{
    public $belongsTo = array(
        'Product' => array(
            'className' => 'Product',
            'foreignKey' => 'product_id'
        )
    );
}