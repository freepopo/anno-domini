<?
class Event extends AppModel {
	var $name = 'Event';
	var $hasAndBelongsToMany = array('Tag');
	
	function findEvents($url=array()) {
		$events = $this->findAll(array('YEAR(date)='.$url['year'].' AND MONTH(date)='.$url['month']),null,null,null,null,2);
		if ($url['tag'] != 'all') {
			$events = $this->findEventsByTag($events,$url['tag']);
		}
		
		if ($url['calendar'] != 'all' && $url['tag'] == 'all') {
			$events = $this->findEventsByCalendar($events,$url['calendar']);
		}
		return $events;
	}
	
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