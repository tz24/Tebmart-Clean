<!--This file is sending emails  -->
<?php ob_start();
include('../../../../../../wp-load.php');
function get_send_offer_ajax() {
	global $wpdb , $current_user;

	$url = site_url();
	$id = $_POST['sid'];
	$email = $_POST['email'];
	$amt = $_POST['eval'];
	$uid = $_POST['userid'];
	$book_title = $_POST['btitle'];
	$rid = $curl.'/thanks-you?id='.$id;
	$user = get_user_by( 'email', $email );
	$admin_email = 'info@tebmart.com';
	$main_email = get_option('admin_email');
	$from_email='info@tebmart.com';
	$from_name = "Teb Mart";

	$to = $_POST['email'];
	$subject = "Sell Request Approved- Book: $book_title";
	$headers  = "From: no-reply@tebmart.com\r\n" . "X-Mailer: php\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
	$headers .= "Bcc: info@tebmart.com\r\n";
	$email_message = "

	<div style='margin:0 auto; width:600px; padding: 70px 0px;'>

		<div style='margin:0 auto; width:200px;'><img alt='Tebmart' src='http://www.tebmart.com/wp-content/uploads/2014/05/email-logo.png' /></div><br/><br/>

		<div style='border:1px solid #ddd;'>

		<div style='background-color:#f4ae34;'>
			<h1 style='color: #fff; margin: 0px; padding: 28px 24px; text-shadow: rgb(246, 190, 93) 0px 1px 0px; display: block; font-family: Arial; font-size: 30px; font-weight: bold; text-align: left; line-height: 150%;' >A New Offer</h1>
		</div>

		<div style='padding:20px;'>

			<p>Hello User,<br/><br/>

			The following request has been approved by Tebmart. Here are the details:<br/><br/>
			ID: $id<br/><br/>
			Book Name: $book_title<br/><br/>
			Sell Price: <strong>$$amt</strong><br/><br/>
			To Confirm this transaction, <a href=\"$url/thanks-you?rep=yes&id=$id&uid=$uid\" target='_blank'>Click Here</a><br/>
			</p>

			<p style='color:#505050'>Want to know how to buy or sell books? Please visit: <a href='http://www.tebmart.com/process/' title='Process'>click here</a><br/>
		Get to know us, please visit:  <a href='http://www.tebmart.com/about-us/' title='About Us'>click here</a><br/>
		Or follow us on <a href='https://www.facebook.com/pages/Tebmart/1443316865899682' title='Facebook'>Facebook</a> and <a href='https://twitter.com/Teb_Mart' title='Twitter!'>Twitter!</a><br/>
		Once again, thank you joining the Tebmart community!<br/>
		<br /><strong style='text-align:center;'>Tebmart</strong></p>

	</div>

	</div>
	</div>
	";
	mail($to,$subject,$email_message,$headers);




	$wp_payment_data = array(

			'estimate_amount' => $_POST['eval']


	   );

	$curl = $_POST['curl'];
	$table_name = $wpdb->prefix."sellbooks";
	$where = array('id' => $id);
	$wpdb->update( $table_name, $wp_payment_data, $where );

	add_action('admin_notices', 'display_update_message');



	die();
}
add_action( 'wp_ajax_getsendoffer', 'get_send_offer_ajax' );
add_action( 'wp_ajax_nopriv_getsendoffer', 'get_send_offer_ajax' );

ob_clean(); ?>
