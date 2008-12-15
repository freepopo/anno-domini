<?
/**
 * Event model
 *
 */
class Event extends AppModel {
	
/**
 * The name of the model
 *
 * @var string $name 	Name of this model for backwards compatibility in PHP 4
 */
	var $name = 'Event';
	
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
 * @return array $events	Find results for a given URL array, with associated Calendars and and Tags
 */
	function findEvents($url=array()) {
		$events = $this->find('all',array('conditions'=>array('YEAR(date)='.$url['year'].' AND MONTH(date)='.$url['month']),'recursive'=>2));
		if ($url['tag'] != 'all') {
			$events = $this->findEventsByTag($events,$url['tag']);
		}
		
		if ($url['calendar'] != 'all' && $url['tag'] == 'all') {
			$events = $this->findEventsByCalendar($events,$url['calendar']);
		}
		return $events;
	}
	
/**
 * Returns events from a given tag shortname
 *
 * @param array $events An events array, usually from a find method
 * @param string $tag	The tag shortname
 * @return array $output Events array that matches the given tag shortname
 */
	function findEventsByTag($events=array(),$tag=null) {
		$output = array();
		if (!$events) { 
			return null; 
		} else {
			$x = 0;
			foreach ($events as $event) {
				for ($i = 0; $i < count($event['Tag']); $i++) {
					if ($event['Tag'][$i]['shortname'] == $tag) {
						$output[$x] = $event;
						$x++;
					}
				}
			}
			if (!$output) { 
				return null; 
			} else {
				return $output;
			}
		}
	}
	
/**
 * Returns events from a given calendar shortname
 *
 * @param array $events An events array, usually from a find method
 * @param string $calendar	The calendar shortname
 * @return array $output Events array that matches the given calendar shortname
 */
	function findEventsByCalendar($events=array(),$calendar) {
		$output = array();
		if (!$events) {
			return null;
		} else {
			$x = 0;
			foreach ($events as $event) {
				$calendar_found = false;
				foreach ($event['Tag'] as $tag) {
					for ($i=0; $i<count($tag['Calendar']); $i++) {
						if ($tag['Calendar'][$i]['shortname'] == $calendar) {
							$output[$x] = $event;
							$calendar_found = true;
							$x++;
							break;
						}
					}
					if ($calendar_found == true) {
						break;
					}
				}
			}
			return $output;
		}
	}
}
?>