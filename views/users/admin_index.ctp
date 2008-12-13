<h1>Users</h1>
<h2>List Users</h2>
<?=$this->renderElement('admin_menu');?>
<table cellspacing="0">
<tr>
	<th><?=$paginator->sort('username');?></th>
	<th>Password</th>
	<th>Actions</th>
</tr>
<? $i = 1; ?>
<? foreach ($users as $user): ?>
<tr class="<?=($i++ % 2 == 0 ? " odd" : " even");?>">
	<td><?=$user['User']['username'];?></td>
	<td><? for ($i = 0; $i < strlen($user['User']['password']); $i++) { echo "&#8226;"; } ?></td>
	<td>
		<?=$html->link($html->image('edit.png'),'/admin/users/edit/'.$user['User']['id'],null,null,false);?>&nbsp;
		<?=$html->link($html->image('delete.png'),'/admin/users/delete/'.$user['User']['id'],array('onClick'=>'return confirm(\'Are you sure you want to delete '.addslashes($user['User']['username']).' id '.$user['User']['id'].' ?\');'),null,false);?>
	</td>
</tr>
<? endforeach;?>
</table>
<br/><hr/><br/>
<div class="paging">
	<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?> | <?php echo $paginator->numbers();?> <?php echo $paginator->next(__('next', true).' >>', array(), null, array('class'=>'disabled'));?>
</div>