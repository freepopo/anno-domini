<div id="menu">
	<ul>
		<li><?=$html->link('List','/admin/'.$this->params['controller'].'/index');?></li>
		<li><?=$html->link('New','/admin/'.$this->params['controller'].'/add');?></li>
		<?=($this->action == 'admin_edit' ? '<li>'.$html->link('Delete','/admin/'.$this->params['controller'].'/delete/'.$this->data[$this->params['models'][0]]['id'], array('onClick'=>'return confirm(\'Are you sure you want to delete this?\');')).'</li>' : '');?>
	</ul>
</div>