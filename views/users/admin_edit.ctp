<h1>Users</h1>
<h2>Edit User</h2>

<?=$this->renderElement('admin_menu');?>

<div class="form">
<?php echo $form->create('User',array('name'=>'userEditForm'));?>
<div class="optional"><?=$form->input('username',array('label'=>'Username '));?></div>
<div class="optional"><?=$form->input('password',array('label'=>'Password ','type'=>'password'));?></div>
<?=$calendar->button('Save User',array('form'=>'userEditForm'));?>
</form>
</div>
