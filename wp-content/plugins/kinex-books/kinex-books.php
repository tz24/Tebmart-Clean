<?php  ob_start(); 

/*
Plugin Name: Kinexmedia Sell Books
Plugin URI: http://www.kinexmedia.ca/
Description: This Plugin is Created on Demand  by the Kinexmedia. Nobody has any right to use or modify this plugin without the prior permission of  Kinexmedia.
Version: 1.1
Author: Kinex Media
Author URI: http://www.kinexmedia.ca/
License: GPL2
*/


include("includes_files.php"); // include all the necessary files for the plugin


//wp_enqueue_script('jquery', get_plugin_dir() . '/admin/js/jquery-1.9.1.js');



register_activation_hook(__FILE__,'hsplugin_install');

register_uninstall_hook( __FILE__, 'hsplugin_uninstall' );


function hsplugin_install()
{
	
	//hsplugin_add_new_roles(); //add the roles & capabilities
	hsplugin_create_db(); // add the database tables
	
}


function hsplugin_uninstall()
{
	//hs_delete_tables();
}


function get_sellbook_ajax() {
	global $wpdb , $current_user;
	
	
	check_ajax_referer( "helloworld" );
	echo "Payment Status Updated!"."<br/>";
	

	$wp_payment_data = array(
	   
			'book_status' => $_POST['sval']

	   
	   );
	   
	   		//print_r($wp_payment_data);
			
			$id = $_POST['sid'];
	   		$table_name = $wpdb->prefix."sellbooks";
			$where = array('id' => $id);			
			
			$wpdb->update( $table_name, $wp_payment_data, $where );
									
			//header("Location: admin.php?page=edit_payments&user_id=$id&action=edit");
			add_action('admin_notices', 'display_update_message');
			//header("Location: admin.php?page=online_payment");	
	
	die();
	
	
}
add_action( 'wp_ajax_getsellbook', 'get_sellbook_ajax' );

add_action( 'wp_ajax_nopriv_getsellbook', 'get_sellbook_ajax' );



add_action('admin_menu', 'reservation_menu');


function reservation_menu()
	{
			add_menu_page( 'Sell Books', 'Sell Books', 'manage_options', 'sellbooklist', 'sellbook_listing', plugin_dir_url( __FILE__ )."admin/images/sell_books.png", '82' );
			
			add_submenu_page('sellbooklist', 'Add New Offer', 'Add New Offer', 'manage_options', 'sell_a_book', 'sellbook_form' );
			
			add_submenu_page('edit', 'Edit', 'Edit', 'manage_options', 'edit', 'edit' );
			
			add_submenu_page('view_trash', 'View Trash', 'View Trash', 'manage_options', 'view_trash', 'view_trash' );
			
			add_submenu_page('trash', 'Send Trash', 'Trash', 'manage_options', 'trash', 'trash' );
			
			add_submenu_page('view_restore', 'Restore', 'Restore', 'manage_options', 'restore', 'restore' );
			
			add_submenu_page('view_pending', 'View Pending Reservation', 'View Pending Reservation', 'manage_options', 'view_pending_reservation', 'view_pending_reservation' );
			
			add_submenu_page('view_complete', 'View Complete Reservation', 'View Complete Reservation', 'manage_options', 'view_complete_reservation', 'view_complete_reservation' );
			
			add_submenu_page('delete', 'Delete', 'Delete', 'manage_options', 'delete', 'delete' );
			
			add_submenu_page('Send Offer', 'Send Offer', 'Send Offer', 'manage_options', 'send_offer', 'send_offer' );
			
	}/*end of function*/

	


ob_clean();	  
?>  