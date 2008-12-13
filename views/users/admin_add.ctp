<h1>Users</h1>
<h2>Create New User</h2>

<?=$this->renderElement('admin_menu');?>

<div class="form">
<?php echo $form->create('User',array('name'=>'userAddForm'));?>
<div class="optional"><?=$form->input('username',array('label'=>'Username '));?></div>
<div class="optional"><?=$form->input('password',array('label'=>'Password ','type'=>'password'));?></div>
<?=$calendar->button('Add User',array('form'=>'userAddForm'));?>
</form>
</div>
