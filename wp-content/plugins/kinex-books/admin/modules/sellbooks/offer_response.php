<?php ob_start();

add_shortcode( 'thanksoffer', 'offer_response' );

function offer_response() {
	global $wpdb , $current_user;
	$hsb_prefix = $wpdb->prefix;
	
	echo '<div style="width: 750px; margin: 0 auto; text-align: center; font-size: 18px;"><img alt="" src="http://www.tebmart.com/wp-content/uploads/2014/05/email-logo.png" /><br/><br/>
Your response has been submitted to the Tebmart Team. We will get in touch with you soon.</div>';
	
	$bookid=$_GET['id'];
	$user_id=$_GET['uid'];
	$bs=$_GET['rep'];
	if($bs=='yes'){
		$bs='accept';
	}
	if($bs=='no'){
		$bs='reject';
	}
	
	$user_first = get_user_meta( $user_id, 'first_name', true );
	$user_last = get_user_meta( $user_id, 'last_name', true );
	

	//$bookinfo = $wpdb->get_results("SELECT book_title,estimate_amount FROM $wpdb->sellbooks WHERE id = $bookid");
	$where = " where id='".$bookid."'";
	$all_rec_q = "SELECT book_title,estimate_amount FROM ".$hsb_prefix."sellbooks".$where ;
	$bookinfo = $wpdb->get_results($all_rec_q);
	
	foreach ( $bookinfo as $books ) 
	{
		$book_title=$books->book_title;
		$amt=$books->estimate_amount;
	}
	
	$user = get_user_by( 'email', $email );
	$admin_email = 'info@tebmart.com';
	$main_email = get_option('admin_email');

	$to = 'info@tebmart.com';
	$subject = "Offer Response - ID # $bookid ";
	$headers  = "From: no-reply@tebmart.com\r\n" . "X-Mailer: php\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
	$accept_email_message = "
	
	<div style='margin:0 auto; width:600px; padding: 70px 0px;'>
		
		<div style='margin:0 auto; width:200px;'><img alt='Tebmart' src='http://www.tebmart.com/wp-content/uploads/2014/05/email-logo.png' /></div><br/><br/>
	
		<div style='border:1px solid #ddd;'>
		
		<div style='background-color:#f4ae34;'>
			<h1 style='color: #fff; margin: 0px; padding: 28px 24px; text-shadow: rgb(246, 190, 93) 0px 1px 0px; display: block; font-family: Arial; font-size: 30px; font-weight: bold; text-align: left; line-height: 150%;' >Accepted Offer</h1>
		</div>
		
		<div style='padding:20px;'>
		
			<p>Hi,<br/><br/>
			
			Customer has agreed upon the offered price. Please follow up with customer regarding this transaction.<br/><br/>
			Transaction Number: $bookid<br/><br/>
			Name: $user_first $user_last<br/><br/>
			Book Name: $book_title<br/><br/>
			Offer Amount: $$amt<br/><br/>
			</p>
			<p>Please follow the guideline:
				<ol>
					<li>Check the back-end for status update</li>
					<li>Call the customer to confirm time, date and location</li>
					<li>Print 2 copies of invoice; one copy for the customer and one copy for the manager</li>
				</ol>
			</p>

			<p style='color:#505050'>At Tebmart, we strive to provide the perfect services to customers!<br/>
			At Tebmart, customer’s convenience is our top priority!<br/>
			At Tebmart, customers are more than just customers!<br/>
			<br/><strong style='text-align:center;'>Tebmart</strong></p>
	
		</div>
	
		</div>
	</div>
	
";



$reject_email_message = "
	
	<div style='margin:0 auto; width:600px; padding: 70px 0px;'>
		
		<div style='margin:0 auto; width:200px;'><img alt='Tebmart' src='http://www.tebmart.com/wp-content/uploads/2014/05/email-logo.png' /></div><br/><br/>
	
		<div style='border:1px solid #ddd;'>
		
		<div style='background-color:#f4ae34;'>
			<h1 style='color: #fff; margin: 0px; padding: 28px 24px; text-shadow: rgb(246, 190, 93) 0px 1px 0px; display: block; font-family: Arial; font-size: 30px; font-weight: bold; text-align: left; line-height: 150%;' >Rejected Offer</h1>
		</div>
		
		<div style='padding:20px;'>
		
			<p>Hi,<br/><br/>
			
			Customer has rejected the offered price. Please follow up with customer regarding this transaction.<br/><br/>
			Transaction Number: $bookid<br/><br/>
			Name: $user_first $user_last<br/><br/>
			Book Name: $book_title<br/><br/>
			Offer Amount: $$amt<br/><br/>
			</p>
			<p>Please follow the guideline:
				<ol>
					<li>Check the back-end for status update</li>
					<li>Call the customer to confirm time, date and location</li>
					<li>Print 2 copies of invoice; one copy for the customer and one copy for the manager</li>
				</ol>
			</p>

			<p style='color:#505050'>At Tebmart, we strive to provide the perfect services to customers!<br/>
			At Tebmart, customer’s convenience is our top priority!<br/>
			At Tebmart, customers are more than just customers!<br/>
			<br/><strong style='text-align:center;'>Tebmart</strong></p>
	
		</div>
	
		</div>
	</div>
	
";

	if($_GET['rep'] != NULL){
		if($bs=='accept'){
			mail($to,$subject,$accept_email_message,$headers);
		}
		else{
			mail($to,$subject,$reject_email_message,$headers);
		}
	}

	
	/*status update code start here*/
	if($_GET['rep'] != NULL){
	$wp_payment_data = array(
		'book_status' => $bs
	);
	//print_r($wp_payment_data);
		
	$table_name = $wpdb->prefix."sellbooks";
	$where = array('id' => $bookid);			
	$wpdb->update( $table_name, $wp_payment_data, $where );
	}
	/*status update code end here*/

}

ob_clean(); ?>