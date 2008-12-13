///////////////////////////////////////////////////////////////////////////////////////////////////////////
// +---------------------------------------------------------------------------------------------------+//
// + $Id: README.txt 01 2008-01-25 davidgolding $
// +---------------------------------------------------------------------------------------------------+//
///////////////////////////////////////////////////////////////////////////////////////////////////////////

Welcome to Anno Domini 2.0!

I'm excited to release this improved calendar program. Here are some improvements in this version:

	1. Compatible with CakePHP 1.2 beta
	2. Improved back-end layout and design
	3. TONS of code trimmed for faster queries and page rendering
	4. Location field added
	5. Untimed events added
	6. Menu system built on CSS, not on Javascript
	7. Improved User management for adding, editing, and deleting multiple admin users
	8. Improved URL handling and better URL routes
	9. Improved front-end design, but still minimalist to make editing the design easy

------INSTALLATION NOTES------

Installing Anno Domini 2.0 is easy. If you're already familiar with Cake installations then this should work right out of the box.

1. Set up the MySQL database
	
	-To do this, just open the annodomini > annodomini_mysql_setup.sql file using PHPMyAdmin or any other MySQL database application. It will automatically create the tables for Anno Domini to work immediately.
	
	-Edit the annodomini > app > config > database.php file to reflect your MySQL connection settings.
	
2. Install the annodomini folder on your server
	
	-Just place the folder in the root folder on your server.
	
	-Make sure Cake 1.2 beta or later is installed. The Cake libraries contained in the cake folder should be added to the annodomini folder. The contents of the annodomini folder should be the following (after having added the cake libraries):
		
		/annodomini
			/.htaccess
			/app
			/cake
			/docs
			/index.php
			/vendors
	
3. Launch the application!
	
	-Pull up the annodomini directory in your web browser (e.g., http://domain.com/annodomini/)
	
	-The calendar should be up and running. If you experience problems, check out www.cakephp.org for information on how to get Cake working correctly.
	
	-Go to http://domain.com/annodomini/admin to create events. The default username and password is "admin" and "admin". You can change these by going to the "Users" area of the administration panel.
	
------OPTIONAL SETTINGS------
	
	Anno Domini houses its global variables in the annodomini > app > config > core.php file. You will find these at the very bottom of the file under the comment:
	
	/**
	 * Anno Domini Calendar Settings
	 *
	 */
	 
	 -Calendar.name is the global name of the calendar. This will be used in email submissions and the <title> tags in the layouts.
	 -Calendar.admin_email is the email address where you want calendar submissions to be sent.
	 -Calendar.max_items is the number of events you want displayed for a single day before a "more..." link appears. This helps keep your calendar from getting too crowded visually.
	 
------IMPORTANT URLS------
	
	Some areas of the program aren't accessible inside the application by clicking links, but they are accessible by entering direct URLs:
	
	- Event submissions: /annodomini/submit
	- Administration panel: /annodomini/admin