<?
class Calendar extends AppModel {
	var $name = 'Calendar';
	
	var $hasAndBelongsToMany = array('Tag');
	
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