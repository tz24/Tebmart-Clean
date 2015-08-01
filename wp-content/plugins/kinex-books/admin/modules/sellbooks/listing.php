<?php ob_start();

function sellbook_listing()
{
	global $wpdb , $current_user;
	$url = site_url();
	
		if(isset($_GET['action'])) {
		?>
        <div class="updated">
        	<p>
			<?php
			
				$action = $_GET['action'];
				switch($action){
					case 'add':
					echo "Added Successfully";
					break;
					case 'delete':
					echo "Deleted Successfully";
					break;
					case 'edit':
					echo "Updated Successfully !";
					break;
					case 'restore':
					echo "Restored Successfully !";
					break;
					case 'trash':
					echo "Trashed Successfully !";
					break;
					default:
					$success_message = "Not call";
				}
			?>
            </p>
        </div>
   <?php }

   
	/*get Total No. of records in all*/
		
		
				$hsb_prefix = $wpdb->prefix;
				$where = " where is_trash='no' ORDER BY ID DESC";
				$where2 = " where is_trash='yes' ";
				$where3 = " where book_status='pending' and is_trash='no' ";
				$where4 = " where book_status='completed' and is_trash='no' ";
				
				
				$all_rec_q = "SELECT * FROM ".$hsb_prefix."sellbooks".$where2 ;
				$hswp_table2 = $wpdb->get_results($all_rec_q);
				$trash_items = count($hswp_table2);
				
				
				$all_rec_q = "SELECT * FROM ".$hsb_prefix."sellbooks".$where ;
				$hswp_table = $wpdb->get_results($all_rec_q);

				$total_rec = count($hswp_table);
				
				
				$all_rec_q = "SELECT * FROM ".$hsb_prefix."sellbooks".$where3 ;
				$hswp_table3 = $wpdb->get_results($all_rec_q);
				$total_pending = count($hswp_table3);
				
				$all_rec_q = "SELECT * FROM ".$hsb_prefix."sellbooks".$where4 ;
				$hswp_table4 = $wpdb->get_results($all_rec_q);
				$total_completed = count($hswp_table4);
				
				

?>	







	<div class="wrap sellbooks">
    		
			
		<?php screen_icon('edit-pages'); ?>
        
        <h2>Sell Books Listview</h2>

        
        <ul class="subsubsub">
		
			<li class="all"><a class="current" href="admin.php?page=<?php print $_GET['page']; ?>" style="color:#D54E21;">All Records<span class="count"> (<?php print $total_rec ?>)</span></a> </li>
		
            <?php if( $trash_items>0 ):	?>
            | <li class="all"><a class="current" href="admin.php?page=view_trash">Trash <span class="count"> (<?php print $trash_items ?>)</span></a> </li>
            <?php endif; ?>
        
		<?php /* ?>

            
            <?php if( $total_pending>0 ):	?>
            | <li class="all"><a class="current" href="admin.php?page=view_pending_reservation">Pending <span class="count"> (<?php print $total_pending ?>)</span></a> </li>
            <?php endif; ?>
            
            
            <?php if( $total_completed>0 ):	?>
            | <li class="all"><a class="current" href="admin.php?page=view_complete_reservation">Completed <span class="count"> (<?php print $total_completed ?>)</span></a> </li>
            <?php endif; ?>
        <?php */ ?>    
            
		</ul>
		
        
        <form method="get" class="sell_books" action="admin.php?page=<?php print $_GET['page']; ?>">
			<input type="hidden" name="page" value="<?php print $_GET['page']; ?>" />
            
            <input type="hidden" name="start_date" value="<?php print $_GET['start_date']; ?>" />
            <input type="hidden" name="end_date" value="<?php print $_GET['end_date']; ?>" />
			


    

    
    
<table cellspacing="0" class="wp-list-table widefat fixed users">
	<thead>
	<tr>
		<?php /* ?>
		<th style="" class="manage-column column-cb check-column" id="cb" scope="col">
        
        	<input type="checkbox">
        </th>
		<?php */ ?>

		<th style="width:70px;" class="manage-column column-name sortable <?php print $wmclass; ?>" scope="col">
        
        	<span>Book Id</span><span class="sorting-indicator"></span>
        
        </th>

		
		<th class="manage-column column-name sortable <?php print $wmclass; ?>" scope="col">
        
        	<span>User Name</span><span class="sorting-indicator"></span>
        
        </th>
		
         <th style="" class="manage-column column-name sortable <?php print $wmclass; ?>" id="first_name" scope="col">
        
        	<span>Book Title</span><span class="sorting-indicator"></span>
        
        </th>
        
        <th style="" class="manage-column column-name sortable <?php print $wmclass; ?>" id="facility" scope="col">
        
        	<span>ISN</span><span class="sorting-indicator"></span>
        
        </th>
        
        <th style="" class="manage-column column-name sortable <?php print $wmclass; ?>" id="facility" scope="col">
        
        	<span>Edition</span><span class="sorting-indicator"></span>
        
        </th>
        
        <th style="" class="manage-column column-name sortable <?php print $wmclass; ?>" id="facility" scope="col">
        
        	<span>Author</span><span class="sorting-indicator"></span>
        
        </th>
        
        <th style="" class="manage-column column-name sortable <?php print $wmclass; ?>" id="cc_fname" scope="col">
        
        	<span>Course Code</span><span class="sorting-indicator"></span>
        
        </th>
       
		<th style="" class="manage-column column-name sortable <?php print $wmclass; ?>" id="book_condition" scope="col">
        
        	<span>Book Condition</span><span class="sorting-indicator"></span>
        
        </th>
	   
	   
       <th style="" class="manage-column column-name sortable <?php print $wmclass; ?>" id="cc_payment_type" scope="col">
        
        	<span>Pickup Time</span><span class="sorting-indicator"></span>
        
        </th>
        
        <th style="" class="manage-column column-name sortable <?php print $wmclass; ?>" id="cc_card_number" scope="col">
        
        	<span>Meeting Location<span class="sorting-indicator"></span>
        
        </th>

		<th style="width:175px;" class="manage-column column-name sortable <?php print $wmclass; ?>" id="cc_card_number" scope="col">
        
        	<span>Estimate Offer<span class="sorting-indicator"></span>
        
        </th>
		
		<th class="manage-column column-name sortable <?php print $wmclass; ?>" scope="col">
        
        	<span>Book Status</span><span class="sorting-indicator"></span>
        
        </th>
        
     </tr>
	</thead>
    
	<?php 
		
		if($total_rec==0):
		
		print '<tr><td colspan="12" style="text-align:center; font-weight:bold;"><strong>No Records Found</strong></td>';
		endif;
	
	
	?>
	

	<tbody class="list:user" id="the-list">
    
    
    <?php 
	
				
		
		$c=0;
		
		for($i=0; $i <$total_rec; $i++)
		{ $c++; ?>
     

        <tr id="user-<?php print $hswp_table[$i]->id; ?>">
		
		<?php /* ?>
    	<th class="check-column" scope="row">
        <input type="checkbox" value="<?php print $hswp_table[$i]->id; ?>" class="administrator" id="user_<?php print $hswp_table[$i]->id; ?>" name="users[]">
        </th>
		<?php */ ?>
        
		<td class="role column-role"><?php print $hswp_table[$i]->id; ?></td>
	   
        <td class="username column-name">
             <strong><a href="javascript:void(0)"><?php $email = $hswp_table[$i]->email; $user = get_user_by( 'email', $email ); print $user->user_login; ?></a></strong>
			 <br>
             
             <div class="row-actions">
             
             <?php if(current_user_can('manage_options')): ?>
             	<span class="edit">
             		<a href="admin.php?page=edit&amp;id=<?php print $hswp_table[$i]->id; ?>">Edit</a> | 
                </span>
             <?php endif;
             
              if(current_user_can('manage_options')): ?>   
                <span class="delete">
                	<a href="admin.php?page=trash&amp;id=<?php print $hswp_table[$i]->id; ?>" class="submitdelete" onclick="return confirm_delete_msg('Are You Sure to Trash?')">Trash</a>
                </span>
               <?php endif;?>  
             </div>
        </td>
		
		<td class="role column-role"><a href="javascript:void(0)"><?php print $hswp_table[$i]->book_title; ?></a></td>
        
        <td class="role column-role"><?php print $hswp_table[$i]->isn; ?></td>
        
        <td class="role column-role"><?php print $hswp_table[$i]->edition; ?></td>
        
        <td class="role column-role"><?php print $hswp_table[$i]->author; ?></td>
        
        <td class="role column-role"><?php print $hswp_table[$i]->course_code; ?></td>
		
		<td class="role column-role"><?php print $hswp_table[$i]->book_condition; ?></td>
        
        <td class="role column-role"><?php print $hswp_table[$i]->delivery_time; ?></td>
        
        <td class="role column-role"><?php print $hswp_table[$i]->meeting_location; ?></td>
	
		<td class="role column-role">$<input type="text" id="est_amt-<?php print $hswp_table[$i]->id; ?>" value="<?php print $hswp_table[$i]->estimate_amount; ?>" name="estimate_amount" maxlength="4" size="4"> <a id="send-offer-<?php print $user->ID.'-'.$hswp_table[$i]->id.'-'.$hswp_table[$i]->email.'-'.$url.'-'.$hswp_table[$i]->book_title; ?>" class="send-offer button" href="javascript:void(0)" title="Send Offer">Send Offer</a></td>
		
	
		<?php /* ?><td class="role column-role">$<input type="text" value="<?php print $hswp_table[$i]->estimate_amount; ?>" name="estimate_amount" maxlength="4" size="4"> <a class="send-offer" href="admin.php?page=send_offer&amp;amt=<?php print $hswp_table[$i]->estimate_amount; ?>&amp;user_email=<?php print $hswp_table[$i]->email; ?>" title="Send Offer">Send Offer</a></td>
		
		<td class="role column-role"><a href="mailto:<?php print $hswp_table[$i]->email; ?>&subject=Send Offer" title="Send Offer">Send Offer</a></td><?php */ ?>

		<td class="role column-role">
        	<select name="book_status" class="pstatus <?php if($hswp_table[$i]->book_status == 'reject'){ print 'reject'; } elseif($hswp_table[$i]->book_status == 'accept'){ print 'accept'; } else{ print 'pending'; } ?>" style="width: 90px;" id="<?php print $hswp_table[$i]->id; ?>" >
            
            	<option value="">Choose Status</option>
                                    
                <?php $arr = array("pending","accept","reject");
	
					foreach( $arr as $val  )
					{
						$sel = ( $val==$hswp_table[$i]->book_status ) ? 'selected="selected"':"";
						print '<option value="'.$val.'" '.$sel.' >'.$val.'</option>';
					}
									
				?>
            </select>
        </td>
		
   </tr>
        
        
        <?php
		} //end of for loop
	
	?>
    
  
</tbody>
</table>

<!--Status update coding start here  --> 
<?php $nonce = wp_create_nonce( 'helloworld' ); ?>

<div class="wrap">
	<div id='loading'></div>
	<div id='helloworld'></div>
</div>

<!--Status update coding end here  --> 


<?php
/*
function get_hello_ajax() {
	check_ajax_referer( "helloworld" );
	?>Hello World!<?php
	die();
}
add_action( 'wp_ajax_gethello', 'get_hello_ajax' );
*/

?>


	<div class="tablenav bottom">

		<div class="alignleft actions">
		
			<div class="demo"></div>

	   </div>
		<div class="tablenav-pages one-page">
        	<span class="displaying-num"><?php print $total_rec; ?> items</span>

            
       </div>
		<br class="clear">
	</div>

    
    
</form>

<?php include('onchange_status.php'); ?>


<br class="clear">

    </div><!--end of wrap div-->
    

<?php	
	
}
/*end of function*/


ob_clean();
?>