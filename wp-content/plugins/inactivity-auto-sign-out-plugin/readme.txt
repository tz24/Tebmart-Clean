=== Inactivity Auto Sign Out Plugin ===
Contributors: NipponMonkey
Donate link: 
Tags: Inactivity, auto, signout, sign, out, log, logout, plugin, automatically, buddypress, buddy, press, BP
Requires at least: ??? Try it!
Tested up to: 3.0.1
Stable tag: 0.2

This plugin automatically logs out the user after a period of inactivity. The time period can be configured and it works with BuddyPress.

== Description ==
This plugin automatically logs a user out after a certain period of time of inactivity.
It creates new meta data for each WP user and checks that the user hasn't been inactive for too long.
If the user has been inactive for too long, then the user is automatically logged out and redirected to a URL of your choice.
It tracks the users activity in both the main site and admin area.

You can set the maximum inactivity time and redirect URL by changing the defined constants in the plugin's PHP page - no admin menus are available yet see FAQs.

It's only a single PHP page, so it's easy to alter to work however you'd like it to work.

It works with BuddyPress too.

Let me know if you find a better way of doing this, and I'll update the plugin.

== Installation ==

1.	Upload the plugin's folder to the `/wp-content/plugins/` directory
2.	Activate the plugin through the 'Plugins' menu in WordPress
3.	That's it! You can test it is working correctly by changing the 
	MM_INACTIVITY_AUTO_LOG_OUT_MAX_INACTIVITY_TIME definition to a few seconds and seeing if you
	get automatically logged out or not.

== Frequently Asked Questions ==

= How do I change the inactivity time period? =

Change this code in the plugin's main php file. Set the time period to whatever you like.
It's in seconds, so 3x60x60 is equal to 3 hours of inactivity.

`define('MM_INACTIVITY_AUTO_LOG_OUT_MAX_INACTIVITY_TIME', 3*60*60);`

= How do I set the redirect URL on auto log out? =

You can change this definition to any URL you like. The default is site_url(), which is your home page.
You could set it to: 

`define('MM_INACTIVITY_AUTO_LOG_OUT_REDIRECT_URL', site_url());`

`define('MM_INACTIVITY_AUTO_LOG_OUT_REDIRECT_URL', 'http://www.example.com');`

`define('MM_INACTIVITY_AUTO_LOG_OUT_REDIRECT_URL', site_url() . '/auto-logged-out.html');`

== Screenshots ==

No screenshots!

== Changelog ==

= 0.2 =
* Added an activation call to stop you from being logged out when you first activate the plugin!

= 0.1 =
* The first version - design for simple installation!

= 0.0 =
* This version never actually existed!

== Installation Bug ==

[FIXED!] Currently, when you activate the plugin, you are automatically logged out!
