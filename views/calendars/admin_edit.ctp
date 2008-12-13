<h1>Calendars</h1>
<h2>Edit Calendar</h2>

<?=$this->renderElement('admin_menu');?>

<div class="form">
<?php echo $form->create('Calendar',array('name'=>'calendarEditForm'));?>
<div class="optional"><?=$form->input('name',array('label'=>'Name '));?></div>
<div class="optional"><?=$form->input('shortname',array('label'=>'Shortname '));?></div>
<div class="optional"><?=$form->input('Tag',array('label'=>'Tags','type'=>'select','multiple'=>'checkbox','options'=>$tags));?></div>
<?=$calendar->button('Save Calendar',array('form'=>'calendarEditForm'));?>
</form>
</div>
