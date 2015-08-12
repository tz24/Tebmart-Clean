	<!--This file is Corrrect for book information-->


<?php ob_start();


add_shortcode( 'sellerform', 'sellbook_form' );


	function sellbook_form()
	{

		global $woocommerce;


?>

	<!--Updated Alert message code start here-->
    <?php

		if(isset($_GET['action'])) { ?>


    <div class="updated">
    	<p><?php

		$action = $_GET['action'];

		switch($action){

			case 'add':

				echo "Payment Created Successfully";

			break;



			case 'edit':

				echo "Payment Updated Successfully !";

			break;

			default:
				$success_message = "Not call";

		}


    	?></p>

	</div>

    <?php } ?>
<!--Updated Alert message code end here-->
	<?php
		if ( is_user_logged_in() ) {
			if(is_admin()){
	?>
			<div class="wrap">


				<h2>Sell Books</h2>

				<form id="createuser" class="validate" name="createuser" method="post" action="" onsubmit="return reserve_validation()">
					<table class="form-table">
						<tbody>
							<tr class="form-field form-required">
								<th><label for="fname">ISBN</label></th>
                                <td><input type="text" value="" class="validate[required]" name="isn"/><input type="hidden" name="email" value="<?php $current_user = wp_get_current_user(); echo $current_user->user_email; ?>"/></td>
                            </tr>

                            <tr class="form-field">
								<th><label for="fname">Book Title <span class="required">*</span></label></th>
                                <td><input type="text" value="" name="book_title"></td>
                            </tr>
                            <tr class="form-field">
								<th><label for="edition">Edition <span class="required">*</span></label></th>
                                <td><input type="text" value="" name="edition"></td>
                            </tr>
							<tr class="form-field">
								<th><label for="author">Author <span class="required">*</span></label></th>
                                <td><input type="text" value="" name="author"></td>
                            </tr>
							<tr class="form-field">
								<th><label for="course_code">Course Code <span class="required">*</span></label></th>
                                <td><input type="text" value="" name="course_code"></td>
                            </tr>
							<tr class="form-field">
								<th><label for="book_condition">Book Condition <span class="required">*</span></label></th>
                                <td><input type="radio" value="Good" name="book_condition"/>Good</br>
								<input type="radio" value="Average" name="book_condition"/>Average</br>
								<input type="radio" value="Poor" name="book_condition"/>Poor</br>
								</td>
                            </tr>
							<tr class="form-field">
								<th><label for="meeting_location">Choose a meeting location: <span class="required">*</span></label></th>
                                <td><input type="radio" value="Dana Porter" name="meeting_location"/>Dana Porter</br>
								<input type="radio" value="Davis Centre" name="meeting_location"/>Davis Centre</br>
								<input type="radio" value="SLC" name="meeting_location"/>SLC</br>
								</td>
                            </tr>
							<tr class="form-field">
								<th><label for="isn">Pickup Time <span class="required">*</span></label></th>
								<td> <input type="text"   id="delivery_time" class="datepicker" name="delivery_time"/></td>
							</tr>
							<tr class="form-field">
								<th><label for="isn">Contact Phone <span class="required">*</span></label></th>
								<td><input type="text"   id="contact_phone" class="contact_phone" name="contact_phone"/></td>
							</tr>
   							<tr>
								<th><label for="more_info">More info</label></th>
                                <td><textarea name="more_info" cols="50" rows="2"></textarea></td>
                            </tr>
						</tbody>
					</table>


					<p class="submit">
                    	<input id="selloffer" class="button button-primary" type="submit" value="Request an Offer" name="sendrequest">
					</p>


				</form>
			</div>

		<?php }

		else{
			$url = plugins_url();
		?>



			<div class="buysearch-wrap">
				<form id="buysearchform" name="buysearchform" method="post" action="<?php echo site_url(); ?>/advanced-search">
					<table cellpadding="0" cellspacing="0" border="0" style="border:none; width:100%; !important; margin: 0 auto;" >
			            <tr class="form-field">
			                <td colspan="2"><input type="text" <?php if (isset($_POST['book_title'])) echo 'value="'.$_POST['book_title'].'"'; ?> name="book_title" placeholder="Book Title" class="book_title"></td>
			            </tr>
						<tr class="form-field form-required">
			                <td><input type="text" <?php if (isset($_POST['isn'])) echo 'value="'.$_POST['isn'].'"'; ?> name="isn" placeholder="ISBN"/></td>
							<td><input type="text" <?php if (isset($_POST['edition'])) echo 'value="'.$_POST['edition'].'"'; ?> name="edition" placeholder="Edition"></td>
			            </tr>
						<tr class="form-field">
			                <td><input type="text" <?php if (isset($_POST['author'])) echo 'value="'.$_POST['author'].'"'; ?> name="author" placeholder="Author"></td>
							<td><input type="text" <?php if (isset($_POST['course_code'])) echo 'value="'.$_POST['course_code'].'"'; ?> name="course_code" placeholder="Course Code"></td>
			            </tr>
						<input type="hidden" name="frm_search" value="ad_frm" />
					</table>
					<p style="margin:0 auto; width:20%;">
			           	<input id="buysearch" class="button button-primary cs-button normal yellow" type="submit" value="Advanced Search" name="buysearch">
					</p>

				</form>
			</div>
			<div class="wrap">
			<form id="createuser" name="createuser" method="post" action="" onsubmit="return reserve_validation()">
			<table cellpadding="0" cellspacing="0" border="0" style="border:none; width:900px; !important;" >

				<tr>
				  <td class="createuser_title">Book Informations</td>
				  <td><?php //echo do_shortcode('[tooltip title="Lorem Ipsum Message There"]Lorem Ipsum[/tooltip]'); ?></td>
				</tr>
				<tr class="form-field form-required">

					<th><img src="<?php echo $url ?>/kinex-books/admin/modules/sellbooks/tooltip.png"  class="tooltips" title="ISBN is a 10 digit or 13 digit numbers located at the back corner of the book.<br/>eg:99921-58-10-7 " /><label for="isn">ISBN</label></th>
                    <td ><input type="text" value="" id="isn" name="isn" class="validate[required]"/><input type="hidden" name="email" value="<?php $current_user = wp_get_current_user(); echo $current_user->user_email; ?>"/></td>
                </tr>
                <tr class="form-field">
					<th><img src="<?php echo $url ?>/kinex-books/admin/modules/sellbooks/tooltip.png"  class="tooltips" title="Book Title is  name of  book.<br> eg:YOU CAN WIN"/><label for="fname">Book Title <span class="required">*</span></label></th>
                    <td><input type="text" value="" name="book_title"></td>
                </tr>
                <tr class="form-field">
					<th><img src="<?php echo $url ?>/kinex-books/admin/modules/sellbooks/tooltip.png"  class="tooltips" title="The book edition should be written on the front cover, usually underneath the title.<br>eg:First published: July 2012" /><label for="edition">Edition <span class="required">*</span></label></th>
                    <td><input type="text" value="" name="edition"></td>
                </tr>
				<tr class="form-field">
					<th><img src="<?php echo $url ?>/kinex-books/admin/modules/sellbooks/tooltip.png"  class="tooltips" title="Author mean the writer of a book<br>eg:Yannick Lefebvre is  the author of Plugin Development book." /><label for="author">Author <span class="required">*</span></label></th>
                    <td><input type="text" value="" name="author"></td>
                </tr>
				<tr class="form-field">
					<th><img src="<?php echo $url ?>/kinex-books/admin/modules/sellbooks/tooltip.png"  class="tooltips" title="Course Code is unique number that identify what  type of course.<br>eg:IT-201 is course code for IT course."/><label for="course_code">Course Code <span class="required">*</span></label></th>
                    <td><input type="text" value="" name="course_code"></td>
                </tr>

				<tr class="form-field">
					<th><img src="<?php echo $url ?>/kinex-books/admin/modules/sellbooks/tooltip.png"  class="tooltips" title="Book Condition describe the condition of the used books that you want sell" /><label for="book_condition">Book Condition <span class="required">*</span></label></th>
				</tr>
				<tr class="form-field">
					<td>
						<input type="radio" value="Good" name="book_condition"/>Good</br>
						<input type="radio" value="Average" name="book_condition"/>Average</br>
						<input type="radio" value="Poor" name="book_condition"/>Poor</br>
					</td>
					<td><div  class="creatuser_div">
					<?php echo do_shortcode("[widgets_on_pages id='Book  Condition Guide Lines']"); ?>
					</div></td>
                </tr>
				<tr class="form-field">
					<th><img src="<?php echo $url ?>/kinex-books/admin/modules/sellbooks/tooltip.png"  class="tooltips" title="Choose a location from below three locations where you can  come." /><label for="meeting_location">Meeting Location: <span class="required">*</span></label></th>
				</tr>

				<tr class="form-field">
<!-- 					<th><label for="meeting_location">Choose a meeting location: <span class="required">*</span></label></th>
					<th><h3>Locations to pickup in UTSC :</h3></th> -->

					<td>
						<h7>Locations to pick up for UTSC :</h7> <br></br>
						<input type="radio" value="IC Atrium / Hall" name="meeting_location"/>IC Atrium / Hall</br>
						<input type="radio" value="Library" name="meeting_location"/>Library</br>
						<input type="radio" value="Student Centre" name="meeting_location"/>Student Centre</br>
					</td>
					<td>
						<h7>Locations to pick up for UWaterloo :</h7><br><br>
						<input type="radio" value="Dana Porter" name="meeting_location"/> Dana Porter </br>
						<input type="radio" value="Davis Centre" name="meeting_location"/>Davis Centre</br>
						<input type="radio" value="SLC" name="meeting_location"/>SLC</br>
					</td>


				<tr class="form-field">
					<th><img src="<?php echo $url ?>/kinex-books/admin/modules/sellbooks/tooltip.png"  class="tooltips" title="Metting Schedule is the suitable time to have come." /><label for="isn">Prefer Time <span class="required">*</span></label></th>
				    <td><input type="text"   id="delivery_time" class="datepicker" name="delivery_time"/></td>
				</tr>

				<tr class="form-field">
					<th></th>
				    <td><?php echo do_shortcode('[widgets_on_pages id="Working Hours"]'); ?></td>
				</tr>

				<tr class="form-field">
					<th><img src="<?php echo $url ?>/kinex-books/admin/modules/sellbooks/tooltip.png"  class="tooltips" title="Your Contact Phone Number" /><label for="isn">Contact Phone <span class="required">*</span></label></th>
				    <td><input type="text"   id="contact_phone" class="contact_phone" name="contact_phone"/></td>
				</tr>

   				<tr>
					<th><img src="<?php echo $url ?>/kinex-books/admin/modules/sellbooks/tooltip.png"  class="tooltips" title="More Information about your book." /><label for="more_info">More Information</label></th>
                    <td><textarea name="more_info" cols="50" rows="10"></textarea></td>
                </tr>

			</table>
			<p class="submit">
               	<input id="selloffer" class="button button-primary" type="submit" value="Submit an Offer" name="sendrequest">
			</p>


			</form>
			</div>

		<script type="text/javascript">
				function reserve_validation()
				{
					var x1=document.forms["createuser"]["isn"];
					var x2=document.forms["createuser"]["book_title"];
					var x3=document.forms["createuser"]["edition"];
					var x4=document.forms["createuser"]["author"];
					var x5=document.forms["createuser"]["course_code"];
					var x6=document.forms["createuser"]["contact_phone"];
					//var x7=document.forms["createuser"]["meeting_location"];
					var x8=document.forms["createuser"]["delivery_time"];
					//alert(x6);

					/*if (x1.value==null || x1.value=="")
					{
					  alert("ISN must be filled out");
					  x1.focus(); // set the focus to this input
					  return false;
					}*/

					if (x2.value==null || x2.value=="")
					{
					  alert("Book Title must be filled out");
					  x2.focus(); // set the focus to this input
					  return false;
					}

					if (x3.value==null || x3.value=="")
					{
					  alert("Edition must be filled out");
					  x3.focus(); // set the focus to this input
					  return false;
					}

					if (x4.value==null || x4.value=="")
					{
					  alert("Author must be filled out");
					  x4.focus(); // set the focus to this input
					  return false;
					}

					if (x5.value==null || x5.value=="")
					{
					  alert("Course Code must be filled out");
					  x5.focus(); // set the focus to this input
					  return false;
					}

					var bookgrade = document.getElementsByName("book_condition");
					if (bookgrade[0].checked == true) {
						//alert("Grade 1");
					} else if (bookgrade[1].checked == true) {
						//alert("Grade 2");
					}	else if (bookgrade[2].checked == true) {
						//alert("Grade 3");
					}	else if (bookgrade[3].checked == true) {
						//alert("Grade 4");
					} else {
						// no checked
						var msg = 'You must select Book Condition!';
						alert(msg);
						return false;
					}

					var mlocation = document.getElementsByName("meeting_location");

					if (mlocation[0].checked == true) {
						//alert("IC Atrium / Hall");
					} else if (mlocation[1].checked == true) {
						//alert("Library");
					}	else if (mlocation[2].checked == true) {
						//alert("Student Centre");
					} else if (mlocation[3].checked == true) {
						//alert("Student Centre");
					} else if (mlocation[4].checked == true) {
						//alert("Student Centre");
					} else if (mlocation[5].checked == true) {
						//alert("Student Centre");
					}else {

						// no checked
						var msg = 'You must select Meeting Location!';
						alert(msg);
						return false;
					}

					if (x8.value==null || x8.value=="")
					{
					  alert("Meeting Date must be selected");
					  x8.focus(); // set the focus to this input
					  return false;
					}

					if (x6.value==null || x6.value=="")
					{
					  alert("Contact Phone number must be filled out");
					  x6.focus(); // set the focus to this input
					  return false;
					}

					alert('Your request has been received, a representative will contact you shortly.');


					return true;

				}


            </script>

	<?php } }
		else{
			echo do_shortcode('[woocommerce_my_account]');
	?>


<?php

		/*
			echo '<div style="width:470px; margin-top:20px; float:left;">';
			echo "<h3>Please logged In for Sell Books.</h3>";
			//echo do_shortcode('[woocommerce_my_account]');
			echo do_shortcode('[wppb-login]');
			echo '</div>';
			echo '<div style="width:470px; margin-top:20px; float:left;">';
			echo "<h3>Registration</h3>";
			echo do_shortcode('[wppb-register]');
			echo '</div>';
		*/



		}
	?>

<?php


	}

	if(isset($_POST['sendrequest'])){

	   global $wpdb, $current_user;
	   $table_name = $wpdb->prefix . "sellbooks";


	   $wp_booking_data = array(

	   		'isn' => $_POST['isn'],
			'book_title' => $_POST['book_title'],
			'edition' => $_POST['edition'],
			'author' => $_POST['author'],
			'course_code' => $_POST['course_code'],
	   		'book_condition' => $_POST['book_condition'],
	   		'meeting_location' => $_POST['meeting_location'],
			'delivery_time' => $_POST['delivery_time'],
			'contact_phone' => $_POST['contact_phone'],
	   		'more_info'	=> $_POST['more_info'],
			'email'	=> $_POST['email'],
			'created_date' => date("Y-m-d H:i:s")



	   );

	$rows_affected = $wpdb->insert( $table_name, $wp_booking_data );
	$id = mysql_insert_id();

	// multiple recipients
	$to  = $_POST['email'];

	// subject
	$subject = "New Sell Book Request - ID # $id ";

	// message
	$message = '<html><body>';
	$message .= '<div style="margin:0 auto; width:600px; padding: 70px 0px;">';
	$message .= '<div style="margin:0 auto; width:200px;">';
	$message .= '<img alt="Tebmart" src="http://tebmart.com/wp-content/uploads/2014/05/email-logo.png" />';
	$message .= '</div><br/><br/>';
	$message .= '<div style="border:1px solid #ddd;">';
	$message .= '<div style="background-color:#f4ae34;">';
	$message .= '<h1 style="color: #fff; margin: 0px; padding: 28px 24px; text-shadow: rgb(246, 190, 93) 0px 1px 0px; display: block; font-family: Arial; font-size: 30px; font-weight: bold; text-align: left; line-height: 150%;" >Selling Books Quote</h1>';
	$message .= '</div>';
	$message .= '<div style="padding:20px;">';
	$message .= "<p>Dear Customer,<br/>We have received your request and it is currently under review. In the meanwhile, please wait patiently and a representative will contact you as soon as possible. If you have any concerns, please email us at info@tebmart.com or contact us at 6476778877. Your business is important to us!<br/></p>";
	$message .= "<p>Book Title : ";
	$message .= $_POST['book_title'];
	$message .= "</p>";
	$message .= "<p>Course Code : ";
	$message .= $_POST['course_code'];
	$message .= "</p>";
	$message .= "</p>";
	$message .= "<p>Book Condition : ";
	$message .= $_POST['book_condition'];
	$message .= "</p>";
	$message .= "</p>";
	$message .= "<p>Meeting Location : ";
	$message .= $_POST['meeting_location'];
	$message .= "</p>";
	$message .= "</p>";
	$message .= "<p>Contact Information : ";
	$message .= $_POST['contact_phone'];
	$message .= "</p>";
	$message .= "<p>Check out our new textbooks!</p>";
	$message .= '<p style="color:#505050">Want to know how to buy or sell books?  Please visit: <a href="http://tebmart.com/process/" title="Process">click here</a><br/>Get to know us, please visit:  <a href="http://tebmart.com/about-us/" title="About Us">click here</a><br/>Or follow us on <a href="https://facebook.com/pages/Tebmart/1443316865899682" title="Facebook">Facebook</a> and <a href="https://twitter.com/Teb_Mart" title="Twitter!">Twitter!</a><br/>Once again, thank you joining the Tebmart community!<br/><br /><strong style="text-align:center;">Tebmart</strong></p>';
	$message .= '</div>';
	$message .= '</div>';
	$message .= '</div>';
	$message .= '</body></html>';

	// To send HTML mail, the Content-type header must be set
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

	// Additional headers
	$headers .= 'From: Tebmart <info@tebmart.com>' . "\r\n";
	$headers .= 'Cc: info@tebmart.com' . "\r\n";
	$headers .= 'Bcc: info@tebmart.com' . "\r\n";

	// Mail it
	mail($to, $subject, $message, $headers);

	//alert('Thank you for Submit Details!');
	header('Location: http://www.tebmart.com/sell-books');
	die();

	}


ob_clean(); ?>