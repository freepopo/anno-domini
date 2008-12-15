<?
/**
 * Tag model
 *
 */
class Tag extends AppModel {

/**
 * Name of the model for backwards compatibility in PHP 4
 *
 * @var string $name	The name of the model
 */
	var $name = 'Tag';
	
/**
 * Associated models in a HABTM relationship
 *
 * @var array $hasAndBelongsToMany	Models that share a many-many relationship with this model
 */
	var $hasAndBelongsToMany = array('Calendar','Event');
}
?>