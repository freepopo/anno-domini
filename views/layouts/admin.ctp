<?=$html->docType('xhtml-strict');?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?=$html->charset('utf-8');?>
	<?=$javascript->link(array('prototype','scriptaculous.js?load=effects','calendar'));?>
	<?=$html->css('admin');?>
	<title><?=Configure::read('Calendar.name');?> :: Administration</title>
</head>
<body onLoad="new Effect.Fade('flashMessage',{delay: 3});">
<div id="tophead"><h5><?=Configure::read('Calendar.name');?></h5><h5 class="right">powered by <a href="http://www.cakeforge.org/projects/anno-domini">Anno Domini</a>&raquo;</h5></div>
<div id="menubar">
	<ul>
		<li><?=$html->link('Dashboard','/admin');?></li>
		<li><?=$html->link('Calendars','/admin/calendars');?></li>
		<li><?=$html->link('Tags','/admin/tags');?></li>
		<li><?=$html->link('Events','/admin/events');?></li>
		<li><?=$html->link('Users','/admin/users');?></li>
		<li style="float: right;"><?=$html->link('Logout','/admin/logout');?></li>
		<li style="float: right;"><?=$html->link('Go to Calendar','/');?></li>
	</ul>
</div>
<div id="flashMsg">
	<?
		if ($session->check('Message.flash')) {
			$session->flash();
		}
		
		if ($session->check('Message.auth')) {
			$session->flash('auth');
		}
	?>
</div>
<div id="wrapper">

<?=$content_for_layout;?>

</div>
</body>
</html>