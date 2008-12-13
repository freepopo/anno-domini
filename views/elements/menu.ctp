<? $calendars = $this->requestAction('/calendars/findCalendars');?>
<div class="_menu">
<ul>
	<li><?=$html->link('All-In-One','/');?></li>
	<? foreach ($calendars as $calendar): ?>
	<li><a href="<?=$html->url('/view/'.$calendar['Calendar']['shortname']);?>"><?=$calendar['Calendar']['name'];?><!--[if gte IE 7]><!--></a><!--<![endif]-->
		<!--[if lte IE 6]><table><tr><td><![endif]-->
		<ul>
			<? foreach ($calendar['Tag'] as $tag): ?>
			<li><?=$html->link($tag['name'],'/view/'.$calendar['Calendar']['shortname'].'/'.$tag['shortname']);?></li>
			<? endforeach; ?>
		</ul>
		<!--[if lte IE 6]></td></tr></table></a><![endif]-->
	</li>
	<? endforeach; ?>
	<? if ($session->check('Auth')): ?>
	<li><a href="<?=$html->url('/admin');?>">Admin<!--[if gte IE 7]><!--></a><!--<![endif]-->
		<!--[if lte IE 6]><table><tr><td><![endif]-->
		<ul>
			<li><?=$html->link('Edit Events','/admin/events/');?></li>
			<li><?=$html->link('Edit Calendars','/admin/calendars/');?></li>
			<li><?=$html->link('Edit Tags','/admin/tags/');?></li>
			<li><?=$html->link('Logout','/admin/logout/');?></li>
		</ul>
		<!--[if lte IE 6]></td></tr></table></a><![endif]-->
	</li>
	<? endif; ?>
</ul>
</div>
<div style="clear: both; width: 100%; height: 1px;"></div>