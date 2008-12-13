<?
class CalendarHelper extends Helper {
	
	var $helpers = array('Html','Ajax');
	
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
				$dday = date("d",$date); 
				$mmonth = date("m",$date);
				$yyear = date("Y", $date);
				if ($dday == $day && $mmonth == $month && $yyear == $year) {
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
	
	function today($day=null,$month=null,$year=null) {
		if ($day == date('j') && $month == date('m') && $year == date('Y')) {
			$output = '<b class="today">'.$day.'</b>';
		} else {
			$output = '<b>'.$day.'</b>';
		}
		return $this->output($output);
	}
	
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