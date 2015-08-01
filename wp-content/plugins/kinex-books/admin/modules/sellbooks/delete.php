<?php ob_start();

function delete()
{
	global $wpdb;
	
	echo"Delete record coding";
	
	$hs_prefix = $wpdb->prefix;
	
	if(isset($_GET['id'])){
		
		
		$hs_detete_table = $hs_prefix."sellbooks";
		
		$wpdb->query($wpdb->prepare("DELETE FROM ".$hs_detete_table." WHERE id = '".$_GET['id']."'"));		
		
		$location = "Location: admin.php?page=view_trash&action=delete";
		
		header($location);
		
	}
	
		
} //end of function


ob_clean(); ?>