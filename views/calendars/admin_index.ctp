<h1>Calendars</h1>
<h2>List Calendars</h2>
<?=$this->renderElement('admin_menu');?>
<table cellspacing="0">
<tr>
	<th><?=$paginator->sort('name');?></th>
	<th><?=$paginator->sort('shortname');?></th>
	<th>Actions</th>
</tr>
<? $i = 1; ?>
<? foreach ($calendars as $calendar): ?>
<tr class="<?=($i++ % 2 == 0 ? " odd" : " even");?>">
	<td><?=$calendar['Calendar']['name'];?></td>
	<td><?=$calendar['Calendar']['shortname'];?></td>
	<td>
		<?=$html->link($html->image('edit.png'),'/admin/calendars/edit/'.$calendar['Calendar']['id'],null,null,false);?>&nbsp;
		<?=$html->link($html->image('delete.png'),'/admin/calendars/delete/'.$calendar['Calendar']['id'],array('onClick'=>'return confirm(\'Are you sure you want to delete '.addslashes($calendar['Calendar']['name']).' id '.$calendar['Calendar']['id'].' ?\');'),null,false);?>
	</td>
</tr>
<? endforeach;?>
</table>
<br/><hr/><br/>
<div class="paging">
	<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?> | <?php echo $paginator->numbers();?> <?php echo $paginator->next(__('next', true).' >>', array(), null, array('class'=>'disabled'));?>
</div>