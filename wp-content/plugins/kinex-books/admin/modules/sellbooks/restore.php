<?php ob_start();

function restore()
{
	global $wpdb , $current_user;
	
	get_currentuserinfo();
	
	$hs_prefix = $wpdb->prefix;
	
	$hs_edit_fields = array(					
		'is_trash' => 'no'	
							
	);
			
			$hs_edit_table = $hs_prefix."sellbooks";
			
			$hs_where =array( 'id' => $_GET['id'] );
			
			$wpdb->update($hs_edit_table, $hs_edit_fields,$hs_where);
			
			
			header("Location: admin.php?page=view_trash&action=restore");			
			exit();
			
} //end of function


ob_clean(); ?>