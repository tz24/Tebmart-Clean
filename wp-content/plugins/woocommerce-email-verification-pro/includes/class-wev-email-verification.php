<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class WEV_Email_Verification{

	public $customer_id;
 
	public function __construct() {
	
		//Handle localisation
		//$this->load_plugin_textdomain();
		//add_action( 'init', array( $this, 'load_localisation' ), 0 );

		add_action('init', array( $this, 'add_shortcode' ));
		add_action( 'user_register', array( $this, 'create_temp_user' ) ); 
	}

	/* Short code for user activation */
	public function add_shortcode() {

	/* If passkey available, verify and activate user */

	if ($_GET['passkey']) {

	global $wpdb, $wp_version, $woocommerce;

	$did = htmlspecialchars($_GET['passkey']); //passkey

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
	$customer_id  = $this->wev_create_new_customer($email, $username, $password);

	//if activate, redirect user to account page, if not home page
	 if(!empty($customer_id)){

		$current_user = get_user_by( 'id', $customer_id );
		wp_set_auth_cookie( $customer_id, true );

		//delete user data from temporary table
		$wpdb->delete( 'wa_wev_temp_user', array( 'confirm_code' => $did ) );

		// Redirect
		if ( wp_get_referer() ) {
			$redirect = esc_url( wp_get_referer() );
		} else {
			$redirect = esc_url( get_permalink( wc_get_page_id( 'myaccount' ) ) );
		}

		wp_redirect( apply_filters( 'woocommerce_registration_redirect', $redirect ) );
		exit;

		}
			}else{	
			wp_redirect( home_url() ); exit;
			}
			
		}//end of check pass key 
	}
	}

	/* Create permanat user account*/
	public function wev_create_new_customer( $email, $username, $password ) {
	global $wpdb, $wp_version, $wc_points_rewards;
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

			$customer_id =	$wpdb->query($sql);

			$user_id = get_user_by( 'email', $email);
			$ud = $user_id->ID;

			$user = new WP_User( $ud );
			$user ->add_role( 'customer' );
			if($wc_points_rewards)	{ $wc_points_rewards->refresh_user_points_balance( $ud );    $points = get_option( 'wc_points_rewards_account_signup_points' );if ( ! empty( $points ) )WC_Points_Rewards_Manager::increase_points( $ud, $points, 'account-signup' ); }
	do_action( 'woocommerce_created_customer', $ud, $new_customer_data, $password_generated);
	return $ud;

	}else{
	//return new WP_Error( 'registration-error', '<strong>' . __( 'ERROR', 'woocommerce' ) . '</strong>: ' . __( 'Couldn&#8217;t register you&hellip; please contact us if you continue to have problems.', 'woocommerce' ) );
	return false;
	}
}

	/* create temporary user account */
	public function create_temp_user($user_id){
	if ( !current_user_can( 'manage_options' ) ) {
		global $woocommerce;

		if (!$user_id) return;

		global $wpdb, $wp_version;
		$sSql = $wpdb->prepare("
		SELECT *
		FROM `{$wpdb->base_prefix}users`
		WHERE `ID` = %d
		LIMIT 1
		",
		array($user_id));
	
		$data = array();
		$data = $wpdb->get_row($sSql, ARRAY_A);

		$form = array('user_email' => $data['user_email'],'user_login' => $data['user_login'],'user_pass' => $data['user_pass']);

		$to = $form['user_email'];
		$un = $form['user_login'];
		$pw = $form['user_pass'];
		$admin_email = get_bloginfo('admin_email');
		$hash = md5($un.$pw);
		$email =$this->send_verification($to, $un, $pw, $hash);
		//Delete if any unverified account exist with the email
 
$result = $wpdb->get_results("SELECT * FROM wa_wev_temp_user WHERE user_email = '".$to."'");
	if(count($result) > 0) { $sSql = $wpdb->prepare("DELETE FROM `wa_wev_temp_user` WHERE `user_email` = %d LIMIT 1", $to); $wpdb->query($sSql);}
					$sql = $wpdb->prepare(
			"INSERT INTO `".wa_wev_temp_user."`
			(`user_name`, `user_pass`, `user_email`, `confirm_code`)
			VALUES(%s, %s, %s, %s)",
			array($un,$pw,$to,$hash)
		);
		$wpdb->query($sql);

			/*$sSql = $wpdb->prepare("DELETE FROM `{$wpdb->base_prefix}users`
					WHERE `ID` = %d
					LIMIT 1", $user_id);   
			$wpdb->query($sSql); */ wp_delete_user( $user_id );

			$this->set_cart_cookies();

		
			if ( ! is_object( $woocommerce ) || version_compare( $woocommerce->version, '2.1', '<' ) ) {
			$woocommerce->add_message( sprintf( __( 'A confirmation link has been sent to your email address. Please follow the instructions in the email to activate your account.', 'wc_emailverification' )));
			}else{
			wc_add_notice( sprintf( __( 'A confirmation link has been sent to your email address. Please follow the instructions in the email to activate your account.', 'wc_emailverification' )), $notice_type = 'success');
			}}
	}


	private function set_cart_cookies( $set = true ) {
		if ( $set ) {
			wc_setcookie( 'woocommerce_items_in_cart', 1 );
			//wc_setcookie( 'woocommerce_cart_hash', md5( json_encode( $this->get_cart() ) ) );
		} elseif ( isset( $_COOKIE['woocommerce_items_in_cart'] ) ) {
			wc_setcookie( 'woocommerce_items_in_cart', 0, time() - 3600 );
			wc_setcookie( 'woocommerce_cart_hash', '', time() - 3600 );
		}

		do_action( 'woocommerce_set_cart_cookies', $set );
	}

	/* Verification Email  */
	public function send_verification($to, $un, $pw, $hash) {
		global $wpdb, $wp_version;
		$blogname = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);
		$headers = "Content-Type: text/htmlrn";

		$subject = sprintf( __( 'Activate your %s account', 'wc_emailverification'), $blogname);        
		$message = sprintf( __( 'Hello %s <br/><br/>','wc_emailverification'), $un); 
		$message .= __('To activate your account and access the feature you were trying to view, copy and paste the following link into your web browser:', 'wc_emailverification');
		$message .= "<br/><a href='";
		$message .= home_url('/').'activate?passkey='.$hash;
		$message .= "'>".home_url('/').'activate?passkey='.$hash."</a><br/><br/>";
		$message .= __( 'Thank you for registering with us.', 'wc_emailverification');
		$message .= sprintf( __( '<br/><br/>Yours sincerely,<br/> %s','wc_emailverification'), $blogname);

		woocommerce_mail($to, $subject, $message, $headers, $attachments);
		return;
	}

	/* load textdomain and localisation */
	public function load_plugin_textdomain () {
		$domain = 'wc_emailverification';
	    $locale = apply_filters( 'plugin_locale' , get_locale() , $domain );

	    load_textdomain( $domain , WP_LANG_DIR . '/' . $domain . '/' . $domain . '-' . $locale . '.mo' );
	    load_plugin_textdomain( $domain , FALSE , dirname( plugin_basename( $this->file ) ) . '/lang/' );
	}


	public function load_localisation () {
		load_plugin_textdomain( 'wc_emailverification' , false , dirname( plugin_basename( $this->file ) ) . '/lang/' );
	}
}