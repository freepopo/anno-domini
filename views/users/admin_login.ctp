<h1>Users</h1>
<h2>Log In</h2>

<hr/><br/>

<div class="form">
<?=$form->create('User',array('name'=>'userLoginForm','action'=>'admin_login'));?>
<div class="optional"><?=$form->input('username',array('label'=>'Username '));?></div>
<div class="optional"><?=$form->input('password',array('type'=>'password','label'=>'Password '));?></div>
<?=$calendar->button('Log In',array('form'=>'userLoginForm'));?>
</form>
</div>