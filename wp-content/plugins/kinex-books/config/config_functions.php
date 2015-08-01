<?php 



	global $hsb_db_version;

	$hsb_db_version = "1.0";

	function get_plugin_dir()
	{
		return plugins_url() . '/kinex-books';
	}


function printable_date($date)
{
	return date("d M Y", strtotime($date));
}






	function hsplugin_create_db() {

	   global $wpdb;

	   global $hsb_db_version;

	

	   $table_name = $wpdb->prefix . "sellbooks";
	   	  

	   $hs_create_tables = "CREATE TABLE ".$table_name." (

	  id mediumint(9) NOT NULL AUTO_INCREMENT,

	  isn text NOT NULL,

	  book_title text NOT NULL,

	  edition text NOT NULL,
	  
	  author text NOT NULL,

	  course_code text NOT NULL,

	  book_condition text NOT NULL,

	  meeting_location text NOT NULL,
	  
	  delivery_time text NOT NULL,
	  
	  contact_phone text NOT NULL,

	  more_info text NOT NULL,


	  is_trash  varchar(255) Default 'no',

	  created_date  varchar(255) NOT NULL,

	  book_status  varchar(255) Default 'pending',
	  
	  email text NOT NULL,
	  
	  estimate_amount text NOT NULL,
  

	  PRIMARY KEY (id)

		)ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;
	
	
		";


	   require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

	   dbDelta( $hs_create_tables);

	 

	   add_option( "hsb_db_version", $hsb_db_version );

	}



	

function hsplugin_add_new_roles()

{

	global $wp_roles;

	

	// Owner role

			add_role( 'owner', 'Owner', array(

			    'read' 						=> true,

			    'read_private_pages'		=> true,

			    'read_private_posts'		=> true,

			    'edit_posts' 				=> true,

			    'edit_pages' 				=> true,

			    'edit_published_posts'		=> true,

			    'edit_published_pages'		=> true,

			    'edit_private_pages'		=> true,

			    'edit_private_posts'		=> true,

			    'edit_others_posts' 		=> true,

			    'edit_others_pages' 		=> true,

			    'publish_posts' 			=> true,

			    'publish_pages'				=> true,

			    'delete_posts' 				=> true,

			    'delete_pages' 				=> true,

			    'delete_private_pages'		=> true,

			    'delete_private_posts'		=> true,

			    'delete_published_pages'	=> true,

			    'delete_published_posts'	=> true,

			    'delete_others_posts' 		=> true,

			    'delete_others_pages' 		=> true,

			    'manage_categories' 		=> true,

			    'manage_links'				=> true,

			    'moderate_comments'			=> true,

			    'unfiltered_html'			=> true,

			    'upload_files'				=> true,

			   	'export'					=> true,

				'import'					=> true,

				'manage_woocommerce'		=> true,

				'manage_woocommerce_orders'	=> true,

				'manage_woocommerce_coupons'=> true,

				'manage_woocommerce_products'=>true,

				'view_woocommerce_reports'	=>true,

				

				

				

				

				

				

				

				

				'create_users'	=> true,

				'delete_users'	=> true,

				'edit_users'	=> true,

				'level_1'		=> true,

				'level_3'		=> true,

				'level_6'		=> true,

				'level_9'		=> true,

				'level_10'		=> true,

				'level_4'		=> true,

				'level_7'		=> true,

				'level_0'		=> true,

				'level_2'		=> true,

				'level_5'		=> true,

				'level_8'		=> true,

				'unfiltered_upload'	=> true,

				'add_users'	=> true,

				'list_users'	=> true,

				'manage_options'	=> true,

				'promote_users'	=> true,

				'remove_users'	=> true,

				

				

				

				

				

				'manage_customers'			=> true,

				'manage_payments'			=> true

				

				

				

			) );

			

			

		

		

		

		// additional capabilities for admin

			

			

			

			$admin_cap_arr = array(

								   "manage_customers",

								   

								   "manage_payments"

							

							);

			

			

			

			foreach( $admin_cap_arr as $roles_val)

			{

				$wp_roles->add_cap( 'administrator', $roles_val );

			}

		

		

		

		

		

					

			

	

	

} /* end of function hsplugin_add_new_roles */





?>