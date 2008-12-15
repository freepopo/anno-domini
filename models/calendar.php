<?
/**
 * Calendar model
 *
 */
class Calendar extends AppModel {
	
/**
 * Name of the model for backwards compatibility in PHP 4
 *
 * @var string $name	The name of the model
 */
	var $name = 'Calendar';
	
/**
 * Associated models in a HABTM relationship
 *
 * @var array $hasAndBelongsToMany	Models that share a many-many relationship with this model
 */
	var $hasAndBelongsToMany = array('Tag');
	
/**
 * Returns calendars and their associated events from a given formatted URL array
 *
 * @param array $url	A pre-formatted array, usually parsed by AppController::parseUrl()
 * @return array $calendars	Find results for a given URL array, with associated Tags and Events
 */
	function findEvents($url=array()) {
		if ($url['calendar'] != 'all') {
			$calendars = $this->find('all',array('conditions'=>array('shortname'=>$url['calendar']),'order'=>'shortname ASC','recursive'=>2));
		} else {
			$calendars = $this->find('all',array('order'=>'shortname ASC','recursive'=>2));
		}
		return $calendars;
	}
}
?>