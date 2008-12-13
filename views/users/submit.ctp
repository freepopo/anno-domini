<h1>Submit Event</h1>

<?=$form->create('User',array('action'=>'submit'));?>
<div class="optional"><?=$form->input('email',array('label'=>'Your Email Address*: '));?></div>
<div class="optional"><?=$form->input('headline',array('label'=>'Event Headline*: '));?></div>
<div class="optional"><?=$form->input('date',array('label'=>'Date and Time*: '));?></div>
<div class="optional"><?=$form->input('untimed',array('label'=>' Include Time?','type'=>'select','options'=>array('Yes','No')));?></div>
<div class="optional"><?=$form->input('location',array('label'=>'Location*: '));?></div>
<div class="optional"><?=$form->input('details',array('label'=>'Details: ','type'=>'textarea','rows'=>5,'cols'=>40));?></div>
<?=$form->end('Submit');?>