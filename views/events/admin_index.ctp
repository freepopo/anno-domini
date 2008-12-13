<h1>Events</h1>
<h2>List Events</h2>
<?=$this->renderElement('admin_menu');?>
<table cellspacing="0">
<tr>
	<th><?=$paginator->sort('headline');?></th>
	<th><?=$paginator->sort('date');?></th>
	<th><?=$paginator->sort('location');?></th>
	<th>Details</th>
	<th><?=$paginator->sort('Display Time?','allday');?></th>
	<th>Actions</th>
</tr>
<? $i = 1; ?>
<? foreach ($events as $event): ?>
<tr class="<?=($i++ % 2 == 0 ? " odd" : " even");?>">
	<td><?=$event['Event']['headline'];?></td>
	<td><?=date('j M Y, g:i a',strtotime($event['Event']['date']));?></td>
	<td><?=$event['Event']['location'];?></td>
	<td><?=$event['Event']['detail'];?></td>
	<td style="text-align: center;"><?=($event['Event']['allday'] == 1 ? $html->image('exclamation.png') : $html->image('accept.png'));?></td>
	<td>
		<?=$html->link($html->image('edit.png'),'/admin/events/edit/'.$event['Event']['id'],null,null,false);?>&nbsp;
		<?=$html->link($html->image('delete.png'),'/admin/events/delete/'.$event['Event']['id'],array('onClick'=>'return confirm(\'Are you sure you want to delete '.addslashes($event['Event']['headline']).' id '.$event['Event']['id'].' ?\');'),null,false);?>
	</td>
</tr>
<? endforeach;?>
</table>
<br/><hr/><br/>
<div class="paging">
	<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?> | <?php echo $paginator->numbers();?> <?php echo $paginator->next(__('next', true).' >>', array(), null, array('class'=>'disabled'));?>
</div>