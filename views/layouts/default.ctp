<?=$html->docType('xhtml-strict');?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?=$html->charset('utf-8');?>
	<?=$javascript->link(array('prototype','scriptaculous.js?load=effects','calendar'));?>
	<?=$html->css('calendar');?>
	<title><?=Configure::read('Calendar.name');?></title>
</head>
<body onLoad="new Effect.Fade('flashMessage',{delay: 3});">
<div id="flashMsg"><? $session->flash();?></div>
<?=$content_for_layout;?>
</body>
</html>