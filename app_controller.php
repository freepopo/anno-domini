<?
/**
 * Anno Domini
 * App Controller
 * This file contains application-wide controller functions.
 *
 * PHP versions 4 and 5
 * @copyright	David Golding
 * @version		2.1 revision 4
 * @license		http://www.opensource.org/licenses/mit-license.php The MIT License
 *
 */
class AppController extends Controller {
	
/**
 * Helpers to be included in all controllers
 *
 * @var array $helpers Application helpers to be used application-wide
 */
	var $helpers = array('Ajax','Form','Html','Javascript','Calendar');

/**
 * Parses supplied URL string for detecting calendar/tag/date combinations.
 *
 * @param string $calendar First chunk in the URL string, which is usually the calendar's shortname
 * @param string $tag Second chunk in the URL string, usually the tag's shortname
 * @param string $date Last chunk, usually the date, formatted as m-yyyy or mm-yyyy
 * @return array $output Parsed elements of URL string matched and keyed to their respective types
 */

	function parseUrl($calendar=null,$tag=null,$date=null) {
		if (!$tag && !$calendar) { // URL = calendars/view
			$month = date('n');
			$year = date('Y');
			$tag = 'all';
			$calendar = 'all';
		} 
		
		if ($calendar && !$tag) { // URL ~ calendars/view/calendar OR calendars/view/1-2008
			$calendar = explode("-",$calendar);
			if (array_key_exists(1,$calendar)) {		//check to see if a month-year was passed or a calendar shortname
				$month = $calendar[0];
				$year = $calendar[1];
				$calendar = 'all';
				$tag = 'all';
			} else {
				$month = date('n');
				$year = date('Y');
				$tag = 'all';
				$calendar = $calendar[0];
			}
		} else {				// URL ~ calendars/view/calendar/tag OR calendars/view/calendar/1-2008
			$tag = explode("-",$tag);
			if (array_key_exists(1,$tag)) { // check for month-year in $tag or tag shortname
				$month = $tag[0];
				$year = $tag[1];
				$tag = 'all';
			} else {
				if ($date) {
					$month = explode("-",$date);
					$year = $month[1];
					$month = $month[0];
				} else {
					$month = date('n');
					$year = date('Y');
				}
				$tag = $tag[0];
			}
		}
		
		$stamp = mktime(0,0,0,$month,1,$year);
		
		$output = array('calendar'=>$calendar,'tag'=>$tag,'month'=>$month,'year'=>$year,'stamp'=>$stamp);
		return $output;
	}
	
/**
 * Returns the Prev link settings for the previous month in the calendar
 *
 * @param array $pass Calendar shortname, Tag shortname, or Date
 * @return string $url Path string to previous month in the current calendar
 */
	function findPrev($pass=array()) {
		$output = array();
		$today = true;
		$url = null;
		for ($i=0; $i<count($pass); $i++) {
			$is_date = explode("-",$pass[$i]); //check to see if it's a month-year or calendar/tag
			if (array_key_exists(1,$is_date)) { //yes, it's a month-year
				$i = count($pass)+1;				// break out of loop
				$month = ($is_date[0]-1 != 0 ? $is_date[0]-1 : 12);
				$year = ($is_date[0]-1 == 0 ? $is_date[1]-1 : $is_date[1]);
				$output[$i-2] = $month."-".$year;
				$today = false;
			} else {							//no, it's not a month-year
				$output[$i] = $pass[$i];
			}
		}
		
		if ($today == true) {
			$month = (date('n')-1 != 0 ? date('n')-1 : 12);
			$year = (date('n')-1 == 0 ? date('Y')-1 : date('Y'));
			$output[count($output)+1] = $month."-".$year;
		}
		
		foreach ($output as $val) {
			$url .= $val."/";
		}
		
		return $url;
	}
	
/**
 * Returns the Next link settings for the next month in the calendar
 *
 * @param array $pass Calendar shortname, Tag shortname, or Date
 * @return string $url Path string to next month in the current calendar
 */
	function findNext($pass=array()) {
		$output = array();
		$today = true;
		$url = null;
		for ($i=0; $i<count($pass); $i++) {
			$is_date = explode("-",$pass[$i]); //check to see if it's a month-year or calendar/tag
			if (array_key_exists(1,$is_date)) { //yes, it's a month-year
				$i = count($pass)+1;				// break out of loop
				$month = ($is_date[0]+1 != 13 ? $is_date[0]+1 : 1);
				$year = ($is_date[0]+1 == 13 ? $is_date[1]+1 : $is_date[1]);
				$output[$i-2] = $month."-".$year;
				$today = false;
			} else {							//no, it's not a month-year
				$output[$i] = $pass[$i];
			}
		}
		
		if ($today == true) {
			$month = (date('n')+1 != 13 ? date('n')+1 : 1);
			$year = (date('n')+1 == 13 ? date('Y')+1 : date('Y'));
			$output[count($output)+1] = $month."-".$year;
		}
		
		foreach ($output as $val) {
			$url .= $val."/";
		}
		
		return $url;
	}
}
?>