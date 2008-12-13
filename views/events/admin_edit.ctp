<h1>Events</h1>
<h2>Edit Event</h2>

<?=$this->renderElement('admin_menu');?>

<div class="form">
<?php echo $form->create('Event',array('name'=>'eventEditForm'));?>
<div class="optional"><?=$form->input('headline',array('label'=>'Headline '));?></div>
<div class="optional"><?=$form->input('date',array('label'=>'Date and Time '));?></div>
<div class="optional"><?=$form->input('location',array('label'=>'Location '));?></div>
<div class="optional"><?=$form->input('detail',array('type'=>'textarea','rows'=>'5','cols'=>'40','label'=>'Details '));?></div>
<div class="optional"><?=$form->input('allday',array('label'=>' Untimed?'));?></div>
<div class="optional"><?=$form->input('Tag',array('label'=>'Tags','type'=>'select','multiple'=>'checkbox','options'=>$tags));?></div>
<?=$calendar->button('Save Event',array('form'=>'eventEditForm'));?>
</form>
</div>
