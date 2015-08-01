<?php
/*
Plugin Name: Inactivity Auto Sign Out Plugin
Plugin URI: http://wordpress.org/extend/plugins/inactivity-auto-sign-out-plugin/
Description: This plugin automatically logs a user out after a certain period of inactivity. You can set the maximum inactivity time and redirect URL by changing the defined constants in the plugin. It's only a single PHP page, so it's easy to alter to work however you'd like it to work.

Version: 0.2
Author: NipponMonkey
Author URI: http://www.englishpubpool.co.uk
License: GPL2
*/
/*  Copyright 2010  NipponMonkey  (email : nipponmonkeyweb@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
/**
 * Max time of inactivity
 * @var unknown_type
 */
define('MM_INACTIVITY_AUTO_LOG_OUT_MAX_INACTIVITY_TIME', 2*60*60);
//define('MM_INACTIVITY_AUTO_LOG_OUT_MAX_INACTIVITY_TIME', 3*60*60);
/**
 * Used to store cookie value of last activity time on the server.
 * @var unknown_type
 */
define('MM_INACTIVITY_AUTO_LOG_OUT_NAME_LAST_ACTIVITY_TIME', 'mmialo_lat');
/**
 * Redirect page URL on auto log out
 * @var unknown_type
 */
define('MM_INACTIVITY_AUTO_LOG_OUT_REDIRECT_URL', site_url());

function mm_inactivity_auto_log_out_get_last_activity_time() {
	if (is_user_logged_in()) {
		return (int) get_usermeta(get_current_user_id(), MM_INACTIVITY_AUTO_LOG_OUT_NAME_LAST_ACTIVITY_TIME);
	}else {
		return 0;
	}
}

function mm_inactivity_auto_log_out_handle_inactivity_auto_logout() {
	if (is_user_logged_in()) {
		$last_activity_time = mm_inactivity_auto_log_out_get_last_activity_time();
		if ($last_activity_time + MM_INACTIVITY_AUTO_LOG_OUT_MAX_INACTIVITY_TIME < time()) {
			// log out
			mm_inactivity_auto_log_out_handle_auto_logout();
		}else {
			// Stay logged in and update cookie
			mm_inactivity_auto_log_out_handle_update_last_activity_cookie();
		}
	}
}
add_action('get_header', 'mm_inactivity_auto_log_out_handle_inactivity_auto_logout', 1);
add_action('admin_init', 'mm_inactivity_auto_log_out_handle_inactivity_auto_logout', 1);


function mm_inactivity_auto_log_out_handle_update_last_activity_cookie() {
	if (is_user_logged_in()) {
		$now = time();
		update_usermeta(get_current_user_id(), MM_INACTIVITY_AUTO_LOG_OUT_NAME_LAST_ACTIVITY_TIME, $now);
	}
}

/**
 * On login, set the last active time, so you aren't logged out straight away!
 * @param unknown_type $username
 */
function mm_inactivity_auto_log_out_handle_update_last_activity_cookie_on_login($username) {
	$now = time();
	try {
		$user_id = get_userdatabylogin($username)->ID;
		if ($user_id != null && $user_id > 0) {
			update_usermeta($user_id, MM_INACTIVITY_AUTO_LOG_OUT_NAME_LAST_ACTIVITY_TIME, $now);
		}
	}catch (Exception $ex) {
		
	}
}
add_action('wp_login', 'mm_inactivity_auto_log_out_handle_update_last_activity_cookie_on_login', 1);

/**
 * Logs out and redirects to home page!
 */
function mm_inactivity_auto_log_out_handle_auto_logout() {
	wp_logout();
	wp_redirect(MM_INACTIVITY_AUTO_LOG_OUT_REDIRECT_URL);
}


function mm_inactivity_auto_log_out_activate() {
	mm_inactivity_auto_log_out_handle_update_last_activity_cookie();
}
register_activation_hook( __FILE__, 'mm_inactivity_auto_log_out_activate' );