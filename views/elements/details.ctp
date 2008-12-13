<? if ($events): ?>
<? foreach($events as $event): ?>

<div id="details_<?=$event['Event']['id'];?>" style="display: none;">
	<h3><?=$event['Event']['headline'];?></h3>
	<?=(!$event['Event']['allday'] ? '<h4>'.date('D, F jS, g:i a',strtotime($event['Event']['date'])).'</h4>' : date('D, F jS',strtotime($event['Event']['date'])));?>
	<?=($event['Event']['location'] ? '<h4>'.$event['Event']['location'].'</h4>' : '');?>
	<?=($event['Event']['detail'] ? '<p>'.$event['Event']['detail'].'</p>' : '');?>
	<p><small><a href="#" onClick="new Effect.SlideUpAndDown('details_<?=$event['Event']['id'];?>',1);">close</a></small></p>
</div>

<? endforeach; ?>
<? endif; ?>