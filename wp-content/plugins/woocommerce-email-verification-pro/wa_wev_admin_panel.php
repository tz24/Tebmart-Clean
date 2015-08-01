<?php
global $wpdb;
//if form submitted, check the data
if (isset($_POST['frm_tch_display']) && $_POST['frm_tch_display'] == 'yes') {

if(!empty($_GET['did'])){

	$did = isset($_GET['did']) ? $_GET['did'] : '0';

	$tch_success = '';

	$tch_success_msg = FALSE;

	// First check if ID exist with requested ID
	$sSql = $wpdb->prepare("SELECT COUNT(*) AS `count` FROM ".wa_wev_temp_user." WHERE `user_id` = %d", array($did));
	$result = '0';
	$result = $wpdb->get_var($sSql);
	if ($result != '1') { ?><div class="error fade"><p><strong>Selected details doesn't exist (1).</strong></p></div><?php
	} else {

		// Form submitted, check the action

		if (isset($_GET['ac']) && $_GET['ac'] == 'verify' && isset($_GET['did']) && $_GET['did'] != '') {
		//	Just security thingy that wordpress offers us
			//check_admin_referer('tch_form_show');
			//	Delete selected record from the table

			wa_wea_verify_account($_GET['confirm_code']);
			//	Set success message
			            $tch_success_msg = TRUE;
            $tch_success = "Selected account was successfully verified.";
        }
	}

	if ($tch_success_msg == TRUE) { ?><div class="updated fade"><p><strong><?php echo $tch_success; ?></strong></p></div><?php }

}else if($_POST['tch_group_item']&&$_POST['bor_action-2']=="delete"){

	$p_did = $_POST['tch_group_item'];

    $tch_success = '';

	$tch_success_msg = FALSE;

	for($i=0;$i<count($_POST['tch_group_item']);$i++){
$del_id=$_POST['tch_group_item'][$i];
$sSql = $wpdb->prepare("DELETE FROM `".wa_wev_temp_user."` WHERE `user_id` = %d LIMIT 1", $del_id);
			$wpdb->query($sSql);
}

			//	Set success message
			$tch_success_msg = TRUE;
			$tch_success = "Selected records were successfully deleted."; 


	if ($tch_success_msg == TRUE) { ?><div class="updated fade"><p><strong><?php echo $tch_success; ?></strong></p></div><?php }
    }
} 
/* Short code for user activation */
function wa_wea_verify_account($passkey) {
/* If passkey available, verify and activate user */
global $wpdb, $wp_version, $woocommerce;

    $did = $passkey; //passkey

    if($did) {
    $result = $wpdb->get_results("SELECT * FROM wa_wev_temp_user WHERE confirm_code = '".$did."'");
    if (count ($result) > 0) {

    $sSql= "SELECT * FROM wa_wev_temp_user WHERE confirm_code = '".$did."'";

    $data = array();

    $data = $wpdb->get_row($sSql, ARRAY_A);

    // Preset the form fields
    $form = array(
        'user_email' => $data['user_email'],
        'user_name' => $data['user_name'],
        'user_pass' => $data['user_pass']
    );

    $email = $form['user_email'];
    $username = $form['user_name'];
    $password = $form['user_pass'];

    remove_filter( 'user_register', array( $this, 'create_temp_user' ) );
    $customer_id  = wa_wev_create_new_verified_account($email, $username, $password);

    //if activate, redirect user to account page, if not home page
     if(!empty($customer_id)){

        //delete user data from temporary table
        $wpdb->delete( 'wa_wev_temp_user', array( 'confirm_code' => $did ) );
        }
            }else{  
           // exit;
            } 
        }//end of check pass key 
    }

/* Create permanat user account*/
     function wa_wev_create_new_verified_account( $email, $username, $password ) {
    global $wpdb, $wp_version,$wc_points_rewards;
       
       
        $pw = $password;
        $password_generated = true;

    $new_customer_data = apply_filters( 'woocommerce_new_customer_data', array(
        'user_login' => $username,
        'user_pass'  => $pw,
        'user_email' => $email,
        'role'       => 'customer'
    ) );

    if(is_null(username_exists( $username ))){

            $reg_date = date("Y-m-d H:i:s");

                                $sql = $wpdb->prepare(
            "INSERT INTO `{$wpdb->base_prefix}users`
            (`user_login`, `user_pass`, `user_email`, `user_nicename`, `display_name`, `user_registered`)
            VALUES(%s, %s, %s,%s, %s, %s)",
            array($username,$password,$email,$username, $username,$reg_date)
        );

            $customer_id =  $wpdb->query($sql);

            $user_id = get_user_by( 'email', $email);
            $ud = $user_id->ID;

			$user = new WP_User( $ud );
			$user ->add_role( 'customer' );
      
      if($wc_points_rewards)	{
      $wc_points_rewards->refresh_user_points_balance( $ud );    
    	$points = get_option( 'wc_points_rewards_account_signup_points' );

			if ( ! empty( $points ) )
			WC_Points_Rewards_Manager::increase_points( $ud, $points, 'account-signup' );
    	}
    
    do_action( 'woocommerce_created_customer', $ud, $new_customer_data, $password_generated);
    return $ud;

    }else{
    return false;
    }
}
 
global $wpdb; 
$pagenum = isset( $_GET['pagenum'] ) ? absint( $_GET['pagenum'] ) : 1;
$limit = 25;
$offset = ( $pagenum - 1 ) * $limit;
$entries = $wpdb->get_results( "SELECT * FROM wa_wev_temp_user order by user_id desc LIMIT $offset, $limit" ); 
echo '<div class="wrap">';
?>
	<script language="JavaScript" src="<?php echo plugins_url(); ?>/woocommerce-email-verification-pro/js/setting.js"></script>

<h2>Unverified Accounts</h2>
	<form name="frm_tch_display" method="post">
<table class="widefat">
    <thead>
        <tr>
        	<th class="check-column" scope="col"><input  type="checkbox" id="test"  /></th>
            <th scope="col" class="manage-column column-name" style="">Username</th>
            <th scope="col" class="manage-column column-name" style="">Email</th>
            <th scope="col" class="manage-column column-name" style="">Registered Date</th>
        </tr>
    </thead>
 
    <tfoot>
        <tr>
        		<th class="check-column" scope="col"><input type="checkbox" id="test" /></th>
            <th scope="col" class="manage-column column-name" style="">Username</th>
            <th scope="col" class="manage-column column-name" style="">Email</th>
             <th scope="col" class="manage-column column-name" style="">Registered Date</th>
        </tr>
    </tfoot>
 
    <tbody>

        <?php if( $entries ) { ?>
 
            <?php
            $count = 1;
            $class = '';
            foreach( $entries as $entry ) {
                $class = ( $count % 2 == 0 ) ? ' class="alternate"' : '';
            ?>
 
            <tr<?php echo $class; ?>>
            	<td align="left"><input class="checkbox1" type="checkbox" value="<?php echo $entry->user_id; ?>" name="tch_group_item[]"></td>
	
                <td><?php echo $entry->user_name; ?>
                	<div class="row-actions">
						<span class="trash"><a onClick="javascript:tch_delete('<?php echo $entry->user_id; ?>','<?php echo $entry->confirm_code; ?>')" href="javascript:void(0);">Verify</a></span> 
					</div></td>
                <td><?php echo $entry->user_email; ?></td>
                   <td><?php echo $entry->created_on; ?></td>
            </tr>
 
            <?php
                $count++;
            }
            ?>
 
        <?php } else { ?>
        <tr>
            <td colspan="2">No accounts yet</td>
        </tr>
        <?php } ?>
    </tbody>
</table>
<input type="hidden" name="frm_tch_display" value="yes"/>
  <p>
        <select name="bor_action-2">
            <option value="actions"><?php _e('Actions')?></option>
            <option value="delete"><?php _e('Delete')?></option>
        </select>
        <input type="submit" name="bor_form_action_changes-2" class="button-secondary" value="<?php _e('Apply')?>" />
    </p>
 </form>
<?php
$total = $wpdb->get_var( "SELECT COUNT(`user_id`) FROM wa_wev_temp_user" );
$num_of_pages = ceil( $total / $limit );
$page_links = paginate_links( array(
    'base' => add_query_arg( 'pagenum', '%#%' ),
    'format' => '',
    'prev_text' => __( '&laquo;', 'aag' ),
    'next_text' => __( '&raquo;', 'aag' ),
    'total' => $num_of_pages,
    'current' => $pagenum
) );
 
if ( $page_links ) {
    echo '<div class="tablenav"><div class="tablenav-pages" style="margin: 1em 0">' . $page_links . '</div></div>';
}
echo '</div>';