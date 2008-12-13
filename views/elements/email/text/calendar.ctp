A user has submitted a request for an event to be added to the calendar:

Email:	<?=$user['email'];?>

Headline:	<?=$user['headline'];?>

Date and Time:	<?=$user['date'];?>

Untimed event (yes/no): <?=($user['untimed']==0 ? 'YES' : 'NO');?>

Location:	<?=$user['location'];?>

Details:	<?=$user['details'];?>