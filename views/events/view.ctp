<div class="_header">
<?=$this->renderElement('menu');?>

<?=($data['calendar_name'] ? '<h1>'.$data['calendar_name'].'</h1>' : '');?>
<?=($data['tag_name'] ? '<h2>'.$data['tag_name'].'</h2>' : '');?>
<h2><?=date('F Y',$data['stamp']);?></h2>
<br/>
<p><?=$html->link('Prev','/view/'.$prev);?> | <?=$html->link('Next','/view/'.$next);?></p>
</div>

<div class="_calendar">
<?=$this->renderElement('calendar',array('events'=>$events,'data'=>$data));?>
</div>

<div class="_details">
<?=$this->renderElement('details',array('events'=>$events));?>
</div>