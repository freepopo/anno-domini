<h1>Tags</h1>
<h2>Edit Tag</h2>

<?=$this->renderElement('admin_menu');?>

<div class="form">
<?php echo $form->create('Tag',array('name'=>'tagEditForm'));?>
<div class="optional"><?=$form->input('name',array('label'=>'Name '));?></div>
<div class="optional"><?=$form->input('shortname',array('label'=>'Shortname '));?></div>
<div class="optional"><?=$form->input('Calendar',array('label'=>'Calendars','type'=>'select','multiple'=>'checkbox','options'=>$calendars));?></div>
<?=$calendar->button('Save Tag',array('form'=>'tagEditForm'));?>
</form>
</div>
