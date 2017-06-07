<?php
App::uses('AppModel', 'Model');
/**
 * Diet Model
 *
 */
class Diet extends AppModel {

/**
 * Display field
 *
 * @var string
 */
//	public $displayField = 'name';
	var $actsAs = array('Media.Transfer', 'Media.Coupler', 'Media.Meta', 'Media.Generator');
//	public $hasMany = array(
//			'Recipe' => array(
//					'className' => 'Recipe',
//					'foreignKey' => 'diet_name'
//			)
//	);
}
