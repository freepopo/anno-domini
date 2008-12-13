<?
//Initialize variables for the element =>
	$firstdate = mktime(0, 0, 0, $data['month'], 1, $data['year']);
	$lastdate = mktime(0, 0, 0, $data['month']+1, 0, $data['year']); 
	$firstday = strftime("%a", $firstdate);
	$next = 1;
	$days_array = array(
		1=>'Sun', 2=>'Mon', 3=>'Tue', 4=>'Wed', 5=>'Thu', 6=>'Fri', 7=>'Sat',
		8=>'Sun', 9=>'Mon',10=>'Tue',11=>'Wed',12=>'Thu',13=>'Fri',14=>'Sat',
		15=>'Sun',16=>'Mon',17=>'Tue',18=>'Wed',19=>'Thu',20=>'Fri',21=>'Sat',
		22=>'Sun',23=>'Mon',24=>'Tue',25=>'Wed',26=>'Thu',27=>'Fri',28=>'Sat',
		29=>'Sun',30=>'Mon',31=>'Tue',32=>'Wed',33=>'Thu',34=>'Fri',35=>'Sat',
		36=>'Sun',37=>'Mon',38=>'Tue',39=>'Wed',40=>'Thu',41=>'Fri',42=>'Sat'
	);
?>

<table class="calendar" cellspacing="0">
<?=$html->tableHeaders(array('Sun','Mon','Tue','Wed','Thu','Fri','Sat'));?>

<? /*** WEEK ONE ***/ ?>
<tr>
<? for ($i=1; $i<=7; $i++){ ?>
<? if ($next<=1 && $firstday != $days_array[$i]) : ?>
<td>&nbsp;</td>
<? else: ?>
<td>
	<?=$calendar->today($next,$data['month'],$data['year']);?><br/>
	<?=$calendar->events($data['month'],$next,$data['year'],$events);?>
</td>
<? $next++;?>
<? endif;?>
<? } ?>
</tr>

<? /*** WEEK TWO ***/ ?>
<tr>
<? for ($i=8; $i<=14; $i++){ ?>
<td>
	<?=$calendar->today($next,$data['month'],$data['year']);?><br/>
	<?=$calendar->events($data['month'],$next,$data['year'],$events);?>
</td>
<? $next++;?>
<? } ?>
</tr>

<? /*** WEEK THREE ***/ ?>
<tr>
<? for ($i=15; $i<=21; $i++){ ?>
<td>
	<?=$calendar->today($next,$data['month'],$data['year']);?><br/>
	<?=$calendar->events($data['month'],$next,$data['year'],$events);?>
</td>
<? $next++;?>
<? } ?>
</tr>

<? /*** WEEK FOUR ***/ ?>
<tr>
<? for ($i=22; $i<=28; $i++){ ?>
<? if (strftime("%d",$lastdate) < $next): ?>
<td>&nbsp;</td>
<? else: ?>
<td>
	<?=$calendar->today($next,$data['month'],$data['year']);?><br/>
	<?=$calendar->events($data['month'],$next,$data['year'],$events);?>
</td>
<? $next++;?>
<? endif; ?>
<? } ?>
</tr>

<? /*** WEEK FIVE ***/ ?>
<tr>
<? for ($i=29; $i<=35; $i++){ ?>
<? if (strftime("%d",$lastdate) < $next): ?>
<td>&nbsp;</td>
<? else: ?>
<td>
	<?=$calendar->today($next,$data['month'],$data['year']);?><br/>
	<?=$calendar->events($data['month'],$next,$data['year'],$events);?>
</td>
<? $next++;?>
<? endif; ?>
<? } ?>
</tr>

<? /*** WEEK SIX ***/ ?>
<? if ($next < strftime("%d",$lastdate)): /* check if there is a sixth line */?>
<tr>
<? for ($i=36; $i<=42; $i++){ ?>
<? if (strftime("%d",$lastdate) < $next): ?>
<td>&nbsp;</td>
<? else: ?>
<td>
	<?=$calendar->today($next,$data['month'],$data['year']);?><br/>
	<?=$calendar->events($data['month'],$next,$data['year'],$events);?>
</td>
<? $next++;?>
<? endif; ?>
<? } ?>
</tr>
<? endif;?>
</table>