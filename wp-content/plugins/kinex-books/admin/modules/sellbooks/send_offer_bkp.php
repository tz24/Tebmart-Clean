<?php ob_start();
include('../../../../../../wp-load.php');
function get_send_offer_ajax() {
	global $wpdb , $current_user;


	check_ajax_referer( "helloworld" );
	echo "Payment Status Updated!"."<br/>";


	$wp_payment_data = array(

			'estimate_amount' => $_POST['eval']


	   );

	   		//print_r($wp_payment_data);

			$id = $_POST['sid'];
			$curl = $_POST['curl'];
	   		$table_name = $wpdb->prefix."sellbooks";
			$where = array('id' => $id);

			$wpdb->update( $table_name, $wp_payment_data, $where );

			//header("Location: admin.php?page=edit_payments&user_id=$id&action=edit");
			add_action('admin_notices', 'display_update_message');
			//header("Location: admin.php?page=online_payment");


		$email = $_POST['email'];
		$amt = $_POST['eval'];
		$rid = $curl.'/thanks-you?id='.$id;
		$user = get_user_by( 'email', $email );
		$admin_email = 'test@kinexmedia.com';
	$main_email = get_option('admin_email');
		echo '<h1 style="text-align:center;">Offer Send</h1>';
		$emailto = $email.','.$admin_email;
		$subject = 'A New offer has been submitted - ID "'.$$id.'"';
		$email_message = "

			Hi $user->first_name  $user->last_name<br/>
			A new offer has been submitted by Tebmart Team. Here are the details:
			<h2>ID: $$id </h2><br/>
			<h2>Book Name: $$amt </h2><br/>
			<h2>Offer Amount: $$amt </h2><br/>
			To Accept this offer,  <a href='$rid&rep=yes' title='Accept'>Click Here</a> <br/>/*To Decline this offer,  <a href='$rid&rep=no' title='Decline'>Click Here</a>*/<br/><br/>

			Any query about offer amount send email at <a href='mailto:info@tebmart.com' >info@tebmart.com</a>

		";
		$from_email='info@tebmart.com';
		$from_name = "Teb Mart";
		$headers = 'From: '.ucwords($from_name).' <'.$from_email.'>' . "\r\n";
			//add_filter('wp_mail_content_type',create_function('', 'return "text/html";'));
			mail($emailto, $subject, $email_message, $headers);


	die();


}
add_action( 'wp_ajax_getsendoffer', 'get_send_offer_ajax' );
add_action( 'wp_ajax_nopriv_getsendoffer', 'get_send_offer_ajax' );


function send_offer()
{
	echo 'Send Offer';
}
/*

function send_offer()
{
	$email = $_GET['user_email'];
	$amt = $_GET['estimate_amount'];
	print $email.$amt;

	echo '<h1 style="text-align:center;">Offer Send</h1>';
	/*if(isset($_POST['sendoffer'])) {*/
	/*	$emailto = $email;
		$subject = 'Book Estimate Offer';
		$email_message = "
			Email: $emailto <br/>

		";
		$from_email="no-reply@kinexmedia.com";
		$from_name = "Teb Mart";
		$headers = 'From: '.ucwords($from_name).' <'.$from_email.'>' . "\r\n";
			add_filter('wp_mail_content_type',create_function('', 'return "text/html";'));
			wp_mail($emailto, $subject, $email_message, $headers);  */

	/*}





}*/ //end of function


ob_clean(); ?>
