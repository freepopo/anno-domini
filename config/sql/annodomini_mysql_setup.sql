#ANNO DOMINI MYSQL SETUP SCHEMA
#
# Dump of table cake_sessions
# ------------------------------------------------------------

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL default '',
  `data` text,
  `expires` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table calendars
# ------------------------------------------------------------

CREATE TABLE `calendars` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `name` varchar(255) default NULL,
  `shortname` varchar(50) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;



# Dump of table calendars_tags
# ------------------------------------------------------------

CREATE TABLE `calendars_tags` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `calendar_id` int(10) default NULL,
  `tag_id` int(10) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;



# Dump of table events
# ------------------------------------------------------------

CREATE TABLE `events` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `date` datetime default NULL,
  `location` varchar(100) default NULL,
  `allday` tinyint(1) NOT NULL default '0',
  `headline` varchar(255) default NULL,
  `detail` text,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

INSERT INTO `events` (`id`,`date`,`location`,`allday`,`headline`,`detail`) VALUES (null,'2009-01-01 12:00:01','CakeForge','1','Anno Domini 2.0 Launched','A major improvement of the Anno Domini Calendar program for Cake 1.2 RC3');



# Dump of table events_tags
# ------------------------------------------------------------

CREATE TABLE `events_tags` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `event_id` int(10) unsigned NOT NULL default '0',
  `tag_id` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;



# Dump of table preferences
# ------------------------------------------------------------

CREATE TABLE `preferences` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(100) default NULL,
  `pref` varchar(255) default NULL,
  `description` text,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;



# Dump of table tags
# ------------------------------------------------------------

CREATE TABLE `tags` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `name` varchar(255) default NULL,
  `shortname` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;



# Dump of table users
# ------------------------------------------------------------

CREATE TABLE `users` (
  `id` int(11) NOT NULL auto_increment,
  `username` varchar(100) default NULL,
  `password` varchar(100) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

INSERT INTO `users` (`id`,`username`,`password`) VALUES (null,'admin','2087c48bb227316bfdc4d5a30bcd2796c679c7dc');


