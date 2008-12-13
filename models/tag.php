<?
class Tag extends AppModel {
	var $name = 'Tag';
	var $hasAndBelongsToMany = array('Calendar','Event');
}
?>