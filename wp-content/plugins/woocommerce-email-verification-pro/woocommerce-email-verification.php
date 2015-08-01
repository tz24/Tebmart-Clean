<?php
/*
 * Plugin Name: WooCommerce Email Verification Pro
 * Version: 1.3
 * Plugin URI: http://weaveapps.com/shop/wordpress-plugins/woocommerce-email-verification/
 * Description: Sends a verification link on users mail ID to activate their account after register.
 * Author: subhansanjaya
 * Author URI: http://www.weaveapps.com/
 * Requires at least: 3.0
 * Tested up to: 3.9
 */
if(! defined( 'ABSPATH' )) exit; // Exit if accessed directly

require('includes/class-wev-email-verification.php');
require_once( ABSPATH . 'wp-admin/includes/user.php' );

global $wev;
$wev = new WEV_Email_Verification();

register_activation_hook( __FILE__,  'wev_install'  );

	 function wev_install() {
		global $wpdb, $wp_version;

		if($wpdb->get_var("show tables like '".wa_wev_temp_user. "'") != wa_wev_temp_user){
		$sSql = "CREATE TABLE IF NOT EXISTS `". wa_wev_temp_user. "` (";
		$sSql = $sSql . "`user_id` INT NOT NULL AUTO_INCREMENT ,";
		$sSql = $sSql . "`user_name` TEXT NOT NULL,";
		$sSql = $sSql . "`user_pass` TEXT NOT NULL,";
		$sSql = $sSql . "`user_email` TEXT NOT NULL,";
		$sSql = $sSql . "`user_level` TEXT NOT NULL,";
		$sSql = $sSql . "`confirm_code` TEXT NOT NULL,";
		$sSql = $sSql . "`created_on` timestamp NOT NULL DEFAULT current_timestamp,";
		$sSql = $sSql . "PRIMARY KEY (`user_id`)";
		$sSql = $sSql . ")";
		$wpdb->query($sSql);
	}
	}

//Localization
add_action('init', 'wevlocalization_init');
function wevlocalization_init() {
    $path = dirname(plugin_basename( __FILE__ )) . '/lang/';
    $loaded = load_plugin_textdomain( 'wc_emailverification', false, $path);
    if ($_GET['page'] == basename(__FILE__) && !$loaded) {          
       // echo '<div class="error">Sample Localization: ' . __('Could not load the localization file: ' . $path, 'localizationsample') . '</div>';
       // return;
    } 
} 

/* add admin menu */
global $wpdb;
		add_action('admin_menu', 'wa_my_menu');

function wa_my_menu() {
    add_users_page('Unverified Accounts', 'Unverified Accounts', 'edit_users', 'wa_wev-admin', 'wa_wev_panel');
}


function wa_wev_panel() {
		include 'wa_wev_admin_panel.php';
}