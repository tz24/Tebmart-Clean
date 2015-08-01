=== White Label Branding for WordPress ===
Author: Alberto Lau (RightHere LLC)
Author URL: http://plugins.righthere.com/white-label-branding/
Tags: white label branding, custom menus, custom dashboard panel, custom login, cms, WordPress, role manager, capability manager, WP MS, multisite, custom colors, downloadable content, import and export
Requires at least: 3.1
Tested up to: 3.8
Stable tag: 3.2.5 rev43116

======== CHANGE LOG ========
Version 3.2.5 rev43116 - December 12, 2013
* New Feature: Change label on menu in wp-admin (WLB Settings > Navigation - Sort Admin Menu)
* New Feature: Support for Custom Icons (type face) in wp-admin menu

Version 3.2.4 rev43091 - December 11, 2013
* Compatibility Fix: WordPress 3.8 top header logo broken
* Compatibility Fix: WordPress 3.8 custom icons feature broken

Version 3.2.3 rev40353 - September 23, 2013
* Bug Fixed: In the user list, fix the total number of users, so that it does not count the Administrators.

Version 3.2.2 rev37652 - June 24, 2013
* Bug Fixed: Download section not working on some websites

Version 3.2.1 rev37239 - June 10, 2013
* Compatibility Fix: Prevent PHP warning when using Gravity Forms
* Bug Fixed: Downloads section crashing
* Update: Updated Options Panel to latest version

Version 3.2 rev37021 - June 5, 2013
* Update: Options Panel updated to latest version
* Update: Compatibility fix, WLB error message showing on Shortcode icon dialog
* Bug Fixed: Prevent a PHP warning when saving navigation options
* Bug Fixed: When unchecking all dashboard items and saving, the unchecked items just became checked again.
* New Feature: Allow branding of the title in the link, when the header logo is replaced

Version 3.1.1 rev36145 - April 23, 2013
* Bug Fixed: Prevent php warning when using checkbox and load_option=false
* Update: Hook loading text domain after theme setup
* Update: As per WordPress recommendation use load text domain in the plugins_loaded hook
* Update: Add missing text to localization files
* Update: Added missing text in Spanish

Version 3.1.0 rev35663 - April 2, 2013
* New Feature: Added support for custom link for header logo (replace W)

Version 3.0.9 rev35659 - April 2, 2013
* Bug Fixed: Login button styling didn't work on WordPress 3.5.1

Version 3.0.8 rev35175 - March 21, 2013
* New Feature: Update Options Panel with Auto Update
* New Feature: WordPress 3.5.1 menu hover text color

Version 3.0.7 rev31694 - January 4, 2013
* Update: Compatibility with WordPress 3.5. Implement color scheme to new primary and secondary button wp-admin selectors
* New Feature: Hide the WordPress version from the footer
* New Feature: Option to disable Email branding
* Bug Fixed: Pushed screen options saving to the admin_init hook, as on some setups the roles where not defined before plugins_loaded
* Bug Fixed: Do not replace email from is the header is set (resolved conflict with Contact Form 7)
* Bug Fixed: Menu font showing orange when menu have sub-menu on hover
* Bug Fixed: Logo in footer disappeared in WordPress 3.5
* Bug Fixed: White background when hovering out of an item
* Bug Fixed: Sub menu background color not getting applied

Version 3.0.6 rev28864 - August 17, 2012
* New Feature: Allow to change the dashboard icon url
* Bug Fixed: Remove php warnings
* Bug Fixed: jQuery script is not registered on the login screen, so it is loading from WLB folder
* Bug Fixed: Added space to a very long ling so that it doesn't give a false positive on certain security scanners.
* New Feature: Sample Theme integration file (pushed plugins_loaded to after_theme_setup plugin initialization)

Version 3.0.5 rev26174 - June 16, 2012
* Depreciate: Remove header height option, use the header logo to replace the WP logo on the Tool bar (Admin bar).
* New Feature: Added control for setting the width of the logo in the Tool Bar.
* New Feature: Replace the logo in the frontend Tool Bar.
* Bug Fixed: Compatibility issues with WordPress 3.4 Tool Bar settings.
* Update: Add back compatibility with WordPress 3.3
* Update: Use the WordPress jQuery

Version 3.0.4 rev23458 - April 26, 2012
* New Feature: Added support for using {site_title} in Email From Name under Branding
* New Feature: Added support for using {site_url} to dynamically load the current site URL in the Email From Name.
* Bug Fixed: Prevent a php warning in certain WordPress installations
* Bug Fixed: Sub Menu items with ampersands (&) where not saved
* Bug Fixed: Gap between custom logo and login form.
* Bug Fixed: Compatibility fix, make the left footer replacement selector more specific, as there is a theme using the same ID in a widget #footer-left
* Improvement: Admin, Editor and Public dashboard support Shortcodes in content

Version 3.0.3 rev23096 - March 21, 2012
* Bug Fixed: Pages by User Role (PUR) fix, after WP 3.1 PUR was not restricting Custom Dashboards correctly.
* Bug Fixed: Login form label not getting WLB setting
* Bug Fixed: Compatibility issue with some other plugins that was hiding the WLB Advanced Settings tab.
* Bug Fixed: When login advanced templates are empty, even if this feature is deactivated there is a javascript error.
* Bug Fixed: Main menu is showing orange on click (focus), applied same color as hover

Version 3.0.2 rev14700 - December 20, 2011
* Bug Fixed: Admin Bar checkboxes are reset when saving a different panel
* Bug Fixed: Custom Post Type column not showing in WordPress 3.3
* New Feature: Added option to move the logout link to the Admin Bar. By default this is inside the profile submenu.

Version 3.0.1 rev14037 - December 17, 2011
* Bug Fixed: Allow non WLB administrator to edit hide dashboard widgets
* Bug Fixed: Hide dashboard widgets are unset when saving another panel
* Bug Fixed: Hide Profile on Admin Bar when hiding sub-menu
* Bug Fixed: Admin Bar broken when opening the navigation tab
* New Feature: Added option to hide the Welcome Dashboard Panel
* New Feature: Added option to disable the automatic color scheme generation
* New Feature: Enable Admin Bar customization for WordPress 3.3
* New Feature: Added option to disable WordPress 3.3 pointers
* New Feature: Added option to replace "Howdy" username

Version 3.0.0 rev12331 - November 27, 2011

* New Feature: Save, Export and Import settings for wp-admin color branding
* New Feature: Save, Export and Import settings for login template branding
* New Feature: Save, Export and Import global settings for White Label Branding
* New Feature: Added optional Downloadable Content when License key is entered
* New Feature: Add Favicon
* New Feature: Set WordPress from name and email address
* New Feature: Hide dashboard panels created by other plugins
* New Feature: Change order of wp-admin menu
* New Feature: Login Screen CSS Settings (logo, opacity and background)
* New Feature: Optional Drag and Drop file upload for Login Screen, Login Form and Favicon
* New Feature: Customize Login Form
* New Feature: Login form support for iPad, iPhone and Smartphones (small template trigger)
* New Feature: Custom Icons (optional)
* New Feature: Added advanced wp-admin color branding
* New Feature: Disable wp-admin for specific User Role
* New Feature: Disable specific Screen Options (Editor or lower user role)
* New Feature: Save Default Screen Options layout (global)
* New Feature: Save Default Screen Options layout (per user)
* New Feature: Merged all White Label Branding related menus under WLB Settings
* Update: New Options Panel version 2.0

Version 2.0.9 rev4627 - June 14, 2011
* Bug Fixed: login background was cropped at the bottom when using custom login form.

Version 2.0.8 rev4581 - May 14, 2011
* New Feature: Added automatic update notification
* New Feature: Added theme integration files
* New Feature: Updated the German translation files

Version 2.0.7 rev4032 - April 28, 2011
* Bug Fixed: Scrollbars not showing on iPad and iPhone on wp-login.php
* Updated custom login template

Version 2.0.6 rev3771 - April 20, 2011
* Bug Fixed: unbind click event to prevent tabs from closing immediately after opening on some sites
* Bug Fixed: alternative login template manipulation to prevent conflict with some themes using old Mootools libraries. 

Version 2.0.5 rev3145 - March 24, 2011
* Added the capabilities in parenthesis needed to show specific sub-menu

Version 2.0.4 rev2512 - March 23, 2011
* Bug fix, removed the style that the hidden Admin bar outputs (28 pixels in top)

Version 2.0.3 rev2348 - March 18, 2011
* New feature, remove word "WordPress" from the header title on admin pages
* Bug fix, avoid displaying the scrollbar on the admin when adding a developer image url
* bug fix, hide admin users option, narrowed the selector for admin users to avoid a conflict with other plugins and themes that add user lists
* bug fix, do not show the role manager option when editing a user if it is not the real administrator

Version 2.0.2 rev2072 - March 8, 2011
* Fixed feature that hides the real Administrator from the User List

Version 2.0.1 rev1847 - March 2, 2011
* Added support for hiding the new Admin Bar in WordPress 3.1
* Added support for hiding items in the new Admin Bar
* Added support for hiding Admin bar settings in My Profile
* Added support for login_logo_url in Login page templates

Version 2.0.0 rev1686 - February 11, 2011
* Added ability to hide standard WordPress Dashboard Panels one by one
* Added user Role Manager
* Added Capability Manager
* Added option to hide Administrator user role from users list. 
* Added WLB Custom Dashboard Panel tool

Version 1.5.0 - December 3, 2010
* Added option to hide Favorite Actions
* Added option to hide Screen Options
* Added login screen background settings
* Added login screen HTML and CSS customization
* Added custom dashboard panel viewable only to users with Editor role
  (old custom dashboard panel will be viewable to all user roles)
* Added support for German language
* Added support for Portuguese language

Version 1.2.2 - November 8, 2010
* Fixed broken login logo replacement from previous version

Version 1.2.1 - November 2, 2010
* Fixed minor conflict with MiniMeta Widget Plugin

Version 1.2.0 - September 22, 2010
* Hide Nag update message
* Hide Nag download message
* Hide Contextual Help
* Submenu customization

Version 1.1.0 - September 20, 2010
* Updated the interface
* Added support for Spanish language

Version 1.0.0 - September 15, 2010
* First release.


======== DESCRIPTION ========

This plugin lets you take complete control over wp-admin. Add your own branding to WordPress. From customizing the login logo, footer logo in wp-admin to creating your own Login Templates and Color Schemes. Add your own Dashboard Panels viewale to all users, Editors or only Administrators. Remove standard WordPress Dashboard Panels one-by-one and even custom Dashboard Panels added by installed plugins. Control the visibility of top level menu and sub-menus. Change the order of the top level menus. Hide update nag, Download link, Contextual Help, Screen Options, and hide the Administrator Role from the User List. Save your settings partially or complete, import and export settings. Enable advanced features like Dashboard Tool to add your own Dashboard Panels (visibility of these panels can be controlled with Pages by User Role plugin (http://codecanyon.net/item/pages-by-user-role-for-wordpress/136020?ref=RightHere). Enable Role and Capability Manager lets you take complete control over user roles, create your own user roles and add custom capabilities. Enter the License Key (Item Purchase Code) and get access to Free Downloadable Content.

== INSTALLATION ==

1. Upload the 'white-label-branding' folder to the '/wp-content/plugins/' directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Click on 'White Label Branding' in the left admin bar of your dashboard

== FREQUENTLY ASKED QUESTIONS ==

Q: Can I add a logo to the login screen that is bigger than the standard 300x80 pixels?
A: Yes, we have created our plugin so you can upload any size logo for the login screen.

Q: Can I provide a Editor access to only some menu options under the Appearance menu?
A: Yes, we give you full control over the Appearance menu for the role Editor. If you want you can choose to hide the following:

	- Themes
	- Widgets
	- Menus
	- Background
	- Header

Q: Can I add a to the header of footer in the wp-admin that is taller than the standard 32 pixels?
A: Yes, we have created our plugin so that you can upload any size logo to the header and footer. If you upload a logo taller than the standard 32 pixels. You will need to adjust the height of the top bar. This is easily done by entering the heigh in pixels under the 'Branding' tab.

Q: How come I can't see the changes to the menu that I have made?
A: This is because you are logged in as an Administrator. You need to be logged in as an Editor or a lower role.

Q: I have problems logging into wp-admin after i activated my custom login page. How do I login?
A: We have created this "shortcut" http://[your website]/wp-login.php?wlb_skip_login - which will skip the custom login and use the standard WordPress login.

== SOURCES - CREDITS & LICENSES ==

I've used the following opensource projects, graphics, fonts, API's or other files as listed. Thanks to the author for the creative work they made.


1) jQuery UI, http://jqueryui.com/

2) Pulpload, http://www.plupload.com/

3) Isolated Grass, http://graphicriver.net/item/isolated-grass/768801

Item Purchase Code: da918ed1-465a-4dec-9506-8c008b65fba4
Licensor's Author Username: vatesdesign
Licensee: RightHere LLC
License Type: ONE EXTENDED LICENSE

4) Icomoon:	Icons from Linecons designed by Sergey Shmidt (http://shmidt.in/)
		License: http://creativecommons.org/licenses/by-sa/3.0/us/