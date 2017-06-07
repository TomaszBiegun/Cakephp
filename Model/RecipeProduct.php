<?php
App::uses('AppModel', 'Model');
/**
 * RecipeProduct Model
 *
 */
class RecipeProduct extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'recipe_product';
//	public $belongsTo = array(
//			'Recipe' => array(
//					'className' => 'Recipe',
//					'foreignKey' => 'recipe_id'
//			)
//	);
}
