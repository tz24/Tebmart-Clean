<?php  ob_start();

function edit()
{
	print edit_reservation_query();
	edit_reservation_form();
}




function edit_reservation_form()
{

		global $wpdb , $current_user;

		$id = $_GET['id'];
		$hsb_prefix = $wpdb->prefix;
		$all_rec_q = "SELECT * FROM ".$hsb_prefix."sellbooks where id=".$id ;
		$hswp_table = $wpdb->get_row($all_rec_q);
		//print_r($hswp_table->id);

	?>

    <?php if(isset($_GET['action'])) { ?>


    <div class="updated">
    	<p><?php

		$action = $_GET['action'];

		switch($action){

			case 'add':

				echo "Created Successfully";

			break;



			case 'edit':

				echo "Updated Successfully !";

			break;

			default:
				$success_message = "Not call";

		}


    	?></p>

	</div>

    <?php } ?>

	<div class="wrap">
				<h2>Update Sell Book Details</h2>
				<form id="createuser" class="validate" name="createuser" method="post" action="" onsubmit="return reserve_validation()">
					<table class="form-table">
						<tbody>
							<tr class="form-field form-required">
								<th><label for="fname">ISBN1kjsldkfhla</label></th>
                                <td><input type="text" value="<?php print $hswp_table->isn; ?>" name="isn"/><input type="hidden" name="email" value="<?php $current_user = wp_get_current_user(); echo $current_user->user_email; ?>"/></td>
                            </tr>

                            <tr class="form-field">
								<th><label for="fname">Book Title <span class="required">*</span></label></th>
                                <td><input type="text" value="<?php print $hswp_table->book_title; ?>" name="book_title"></td>
                            </tr>
                            <tr class="form-field">
								<th><label for="edition">Edition <span class="required">*</span></label></th>
                                <td><input type="text" value="<?php print $hswp_table->edition; ?>" name="edition"></td>
                            </tr>
							<tr class="form-field">
								<th><label for="author">Author <span class="required">*</span></label></th>
                                <td><input type="text" value="<?php print $hswp_table->author; ?>" name="author"></td>
                            </tr>
							<tr class="form-field">
								<th><label for="course_code">Course Code <span class="required">*</span></label></th>
                                <td><input type="text" value="<?php print $hswp_table->course_code; ?>" name="course_code"></td>
                            </tr>
							<tr class="form-field">
								<th><label for="book_condition">Book Condition <span class="required">*</span></label></th>
                                <td><input type="radio" value="Good" name="book_condition" <?php if($hswp_table->book_condition=="Good"){ print "CHECKED"; }?> />Good</br>
								<input type="radio" value="Average" name="book_condition" <?php if($hswp_table->book_condition=="Average"){ print "CHECKED"; }?> />Average</br>
								<input type="radio" value="Poor" name="book_condition" <?php if($hswp_table->book_condition=="Poor"){ print "CHECKED"; }?> />Poor</br>
								</td>
                            </tr>
							<tr class="form-field">
								<th><label for="meeting_location">Choose a meeting location: <span class="required">*</span></label></th>
                                <td><input type="radio" value="IC Atrium / Hall" name="meeting_location" <?php if($hswp_table->meeting_location=="IC Atrium / Hall"){ print "CHECKED"; }?>/>IC Atrium / Hall</br>
									<input type="radio" value="Library" name="meeting_location" <?php if($hswp_table->meeting_location=="Library"){ print "CHECKED"; }?>/>Library</br>
									<input type="radio" value="Student Centre" name="meeting_location" <?php if($hswp_table->meeting_location=="Student Centre"){ print "CHECKED"; }?>/>Student Centre</br>
								</td>
                            </tr>
							<tr class="form-field">
								<th><label for="isn">Pickup Time <span class="required">*</span></label></th>
								<td> <input type="text"   id="delivery_time" class="datepicker" name="delivery_time" value="<?php print $hswp_table->delivery_time; ?>"/></td>
							</tr>
							<tr class="form-field">
								<th><label for="isn">Contact Phone <span class="required">*</span></label></th>
								<td> <input type="text"   id="contact_phone" name="contact_phone" value="<?php print $hswp_table->contact_phone; ?>"/></td>
							</tr>
   							<tr>
								<th><label for="more_info">More info</label></th>
                                <td><textarea name="more_info" cols="50" rows="2"><?php print $hswp_table->more_info; ?></textarea></td>
                            </tr>
						</tbody>
					</table>


					<p class="submit">
                    	<input id="updateoffer" class="button button-primary" type="submit" value="Update Offer" name="updateoffer">
					</p>


				</form>
			</div>

	<?php

}



function edit_reservation_query(){


	if(isset($_POST['updateoffer'])){


		global $wpdb , $current_user;

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
			'last_update' => date("Y-m-d H:i:s")



	   );

	   		print_r($wp_booking_data);

			$id = $_GET['id'];
	   		echo $table_name = $wpdb->prefix."sellbooks";
			$where = array('id' => $id);
			//$hs_where = "where id == ".$id ;

			//$all_rec_q = "SELECT * FROM ".$hsb_prefix."onlinebooking where id=".$id ;
			//$wpdb->update( $table, $data, $where, $format = null, $where_format = null );


			$wpdb->update( $table_name, $wp_booking_data, $where );

			header("Location: admin.php?page=edit&id=$id&action=edit");

			//add_action('admin_notices', 'display_edit_message');

			exit();


	}




}


ob_clean();
?>