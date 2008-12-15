<?
/**
 * Calendar helper
 *		manages view logic for calendar-specific methods
 *
 */
class CalendarHelper extends Helper {
	
/**
 * Other helpers used by this class
 *
 * @var array $helpers	Names of included core helper classes
 */
	var $helpers = array('Html','Ajax');
	
/**
 * Returns formatted event links for a diven date
 *
 * @param int $month	The month being rendered
 * @param int $day	The day being rendered
 * @param int $year	The year being rendered
 * @param array $events	A preformatted events array, usually provided by the Event model's find methods
 * @return List of matching events in the DB for the given day-month-year with formatted links for displaying event details
 */
	function events($month=null,$day=null,$year=null,$events=array()) {
		$entry = array();
		$i = 0;
		$x = 0;
		$max = Configure::read('Calendar.max_items');
		$maxed = false;
		if ($month < 10) { $month = "0".$month; }
		if ($day < 10) { $day = "0".$day; }
	
		if (empty($events)) { 
			return null; 
		} else {
			foreach ($events as $event) {
				$date = strtotime($event['Event']['date']);
				$_day = date("d",$date); 
				$_month = date("m",$date);
				$_year = date("Y", $date);
				if ($_day == $day && $_month == $month && $_year == $year) {
					$entry[$i]['headline'] = $event['Event']['headline'];
					$entry[$i]['id'] = $event['Event']['id'];
				}
				$i++;
			}
			
			if ($entry) {
				$output = '<ul>';
				foreach ($entry as $item) {
					if ($x == $max) {
						$output .= '<li id="max_'.$day.'_toggle" class="toggle"><a href="#" onClick="new Effect.SlideDown(\'max_'.$day.'\'); $(\'max_'.$day.'_toggle\').style.display=\'none\';">more...</a></li>';
						$output .= '<div id="max_'.$day.'" style="display: none;">';
						$maxed = true;
					}
					$output .= '<li><a href="#" onClick="new Effect.SlideUpAndDown(\'details_'.$item['id'].'\',\'1\');">'.$item['headline'].'</a></li>';
					$x++;
				}
				if ($maxed == true) {
					$output .= '<li class="toggle"><a href="#" onClick="new Effect.SlideUp(\'max_'.$day.'\'); $(\'max_'.$day.'_toggle\').style.display=\'inline\';">less...</a></li>';
					$output .= '</div>';
				}
				$output .= '</ul>';
				return $this->output($output); 
			} else {
				return null;
			}
		}
	}
	
/**
 * Returns the table cell's day as a digit, modified if it matches today's date
 *
 * @param int $day	The day in the table cell cycle
 * @param int $month	The current month for the whole table
 * @param int $year	The current year for the whole table
 * @return	A digit representing the cell's day, given a class="today" if matching today's date
 */
	function today($day=null,$month=null,$year=null) {
		if ($day == date('j') && $month == date('m') && $year == date('Y')) {
			$output = '<b class="today">'.$day.'</b>';
		} else {
			$output = '<b>'.$day.'</b>';
		}
		return $this->output($output);
	}
	
/**
 * Renders a button to replace default browser UI buttons/submit inputs
 *
 * @param string $text	The text of the button
 * @param array $options	Options for calling form submissions or to be used as a link
 * @param string $type	If set to effect, will display a <div> element based on a given ID ($options['id'] must be set)
 * @return A formatted button
 */
	function button($text=null,$options=array(),$type='default'){
	$output = null;
	$link = null;
		if (isset($options['form'])) {
			$link = "document.".$options['form'].".submit()";
		}
		
		if (isset($options['anchor'])) {
			$anchor = '#'.$options['anchor'].'" name=\"'.$options['anchor'];
		} else {
			$anchor = "#";
		}
		
		if (isset($options['link'])) {
			$link = "window.location='".$this->Html->url($options['link'])."'";
		}
		
		if ($type=='ajax' && isset($options['url']) && isset($options['update'])) {
			$output = $this->Ajax->link('<span>'.$text.'</span>',$options['url'],array('update'=>$options['update'],'class'=>'btn','loading'=>'$(\''.$options['loading'].'\').style.display=\'inline\'','loaded'=>'$(\''.$options['loading'].'\').style.display=\'none\''),null,false);
		}
		
		if ($type=='effect' && isset($options['effect'])) {
			$link = 'new Effect.'.$options['effect'].'($(\''.$options['id'].'\'),0.5);';
		}
		
		if ($output) { 
			return $output; 
		} else {
			return '<a href="'.$anchor.'" class="btn" onClick="'.$link.'" '.(isset($options['style']) ? 'style=\''.$options['style'].'\'' : '').'><span>'.$text.'</span></a>';
		}
	}
}
?>