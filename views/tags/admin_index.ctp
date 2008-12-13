<h1>Tags</h1>
<h2>List Tags</h2>
<?=$this->renderElement('admin_menu');?>
<table cellspacing="0">
<tr>
	<th><?=$paginator->sort('name');?></th>
	<th><?=$paginator->sort('shortname');?></th>
	<th>Actions</th>
</tr>
<? $i = 1; ?>
<? foreach ($tags as $tag): ?>
<tr class="<?=($i++ % 2 == 0 ? " odd" : " even");?>">
	<td><?=$tag['Tag']['name'];?></td>
	<td><?=$tag['Tag']['shortname'];?></td>
	<td>
		<?=$html->link($html->image('edit.png'),'/admin/tags/edit/'.$tag['Tag']['id'],null,null,false);?>&nbsp;
		<?=$html->link($html->image('delete.png'),'/admin/tags/delete/'.$tag['Tag']['id'],array('onClick'=>'return confirm(\'Are you sure you want to delete '.addslashes($tag['Tag']['name']).' id '.$tag['Tag']['id'].' ?\');'),null,false);?>
	</td>
</tr>
<? endforeach;?>
</table>
<br/><hr/><br/>
<div class="paging">
	<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?> | <?php echo $paginator->numbers();?> <?php echo $paginator->next(__('next', true).' >>', array(), null, array('class'=>'disabled'));?>
</div>