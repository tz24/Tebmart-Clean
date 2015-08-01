<?php ob_start();

function view_complete_reservation()
{
	global $wpdb , $current_user;
	
	
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
				$where = " where form_code='or' and is_trash='no' ";
				$where2 = " where form_code='or' and is_trash='yes' ";
				$where3 = " where form_code='or' and payment_status='pending' and is_trash='no' ";
				$where4 = " where form_code='or' and payment_status='completed' and is_trash='no' ";
				
				
				$all_rec_q = "SELECT * FROM ".$hsb_prefix."onlinebooking".$where2 ;
				$hswp_table2 = $wpdb->get_results($all_rec_q);
				$trash_items = count($hswp_table2);
				
				
				$all_rec_q = "SELECT * FROM ".$hsb_prefix."onlinebooking".$where ;
				$hswp_table4 = $wpdb->get_results($all_rec_q);

				$total_rec = count($hswp_table4);
				
				
				$all_rec_q = "SELECT * FROM ".$hsb_prefix."onlinebooking".$where3 ;
				$hswp_table3 = $wpdb->get_results($all_rec_q);
				$total_pending = count($hswp_table3);
				
				$all_rec_q = "SELECT * FROM ".$hsb_prefix."onlinebooking".$where4 ;
				$hswp_table = $wpdb->get_results($all_rec_q);
				$total_completed = count($hswp_table);

?>	
	<div class="wrap">
    		
			
		<?php screen_icon('users'); ?>
        
        <h2>All Completed Reservation Records</h2>
        
        
        
        <ul class="subsubsub">
        

            <li class="all"><a class="current" href="admin.php?page=reservation" >All Records<span class="count"> (<?php print $total_rec ?>)</span></a> </li>
            
            <?php if( $trash_items>0 ):	?>
            | <li class="all"><a class="current" href="admin.php?page=view_trash_reservation">Trash <span class="count"> (<?php print $trash_items ?>)</span></a> </li>
            <?php endif; ?>
            
            
            <?php if( $total_pending>0 ):	?>
            | <li class="all"><a class="current" href="admin.php?page=view_pending_reservation">Pending <span class="count"> (<?php print $total_pending ?>)</span></a> </li>
            <?php endif; ?>
            
            
            <?php if( $total_completed>0 ):	?>
            | <li class="all"><a class="current" href="admin.php?page=<?php print $_GET['page']; ?>" style="color:#D54E21;">Completed <span class="count"> (<?php print $total_completed ?>)</span></a> </li>
            <?php endif; ?>
            
		</ul>
        
        <form method="get" action="admin.php?page=<?php print $_GET['page']; ?>">
			<input type="hidden" name="page" value="<?php print $_GET['page']; ?>" />
            
            <input type="hidden" name="start_date" value="<?php print $_GET['start_date']; ?>" />
            <input type="hidden" name="end_date" value="<?php print $_GET['end_date']; ?>" />

    

    
    
<table cellspacing="0" class="wp-list-table widefat fixed users">
	<thead>
	<tr>
		<th style="" class="manage-column column-cb check-column" id="cb" scope="col">
        
        	<input type="checkbox">
         </th>
        
         <th style="" class="manage-column column-name sortable <?php print $wmclass; ?>" id="first_name" scope="col">
        
        	<span>Customer Name</span><span class="sorting-indicator"></span>
        
        </th>
        
         <th style="" class="manage-column column-name sortable <?php print $wmclass; ?>" scope="col">
        
        	<span>Order No.</span><span class="sorting-indicator"></span>
        
        </th>
        
        <th style="" class="manage-column column-name sortable <?php print $wmclass; ?>" id="facility" scope="col">
        
        	<span>Phone</span><span class="sorting-indicator"></span>
        
        </th>
        
        <th style="" class="manage-column column-name sortable <?php print $wmclass; ?>" id="facility" scope="col">
        
        	<span>Email</span><span class="sorting-indicator"></span>
        
        </th>
        
        <th style="" class="manage-column column-name sortable <?php print $wmclass; ?>" id="facility" scope="col">
        
        	<span>Facility</span><span class="sorting-indicator"></span>
        
        </th>
        
        <th style="" class="manage-column column-name sortable <?php print $wmclass; ?>" id="cc_fname" scope="col">
        
        	<span>Name on Card</span><span class="sorting-indicator"></span>
        
        </th>
       
       <th style="" class="manage-column column-name sortable <?php print $wmclass; ?>" id="cc_payment_type" scope="col">
        
        	<span>Payment Type</span><span class="sorting-indicator"></span>
        
        </th>
        
         <th style="" class="manage-column column-name sortable <?php print $wmclass; ?>" id="cc_card_number" scope="col">
        
        	<span>Card Number</span><span class="sorting-indicator"></span>
        
        </th>
        
        <th style="" class="manage-column column-name sortable <?php print $wmclass; ?>" id="cc_cvv_number" scope="col">
        
        	<span>CVV Number</span><span class="sorting-indicator"></span>
        
        </th>
        
        <th style="" class="manage-column column-name sortable <?php print $wmclass; ?>" id="cc_expiry" scope="col">
        
        	<span>Expiry (MM-YYYY)</span><span class="sorting-indicator"></span>
        
        </th>
        	
        <th style="" class="manage-column column-name sortable <?php print $wmclass; ?>" scope="col">
        
        	<span>Payment Date</span><span class="sorting-indicator"></span>
        
        </th>
        
        <th class="manage-column column-name sortable <?php print $wmclass; ?>" scope="col">
        
        	<span>Payment Status</span><span class="sorting-indicator"></span>
        
        </th>
            
        
     </tr>
	</thead>
    
	<?php 
		
		if($total_completed==0):
		
		print '<tr><td colspan="12" style="text-align:center; font-weight:bold;"><strong>No Records Found</strong></td>';
		endif;
	
	
	?>
	

	<tbody class="list:user" id="the-list">
    
    
    <?php 
	
				
		
		$c=0;
		
		for($i=0; $i <$total_completed; $i++)
		{ $c++; ?>
     
        
        <tr id="user-<?php print $hswp_table[$i]->id; ?>">
    
    	<th class="check-column" scope="row">
        <input type="checkbox" value="<?php print $hswp_table[$i]->id; ?>" class="administrator" id="user_<?php print $hswp_table[$i]->id; ?>" name="users[]">
        </th>
        
       
        <td class="username column-name">
        	
            
             <strong><a href="javascript:void(0)"><?php print $hswp_table[$i]->first_name." ".$hswp_table[$i]->last_name; ?></a></strong>
             <br>
             
             <div class="row-actions">
             
             <?php if(current_user_can('manage_options')): ?>
             	<span class="edit">
             		<a href="admin.php?page=edit_reservation&amp;user_id=<?php print $hswp_table[$i]->id; ?>">Edit</a> | 
                </span>
             <?php endif;
             
              if(current_user_can('manage_options')): ?>   
                <span class="delete">
                	<a href="admin.php?page=trash_reservation&amp;user_id=<?php print $hswp_table[$i]->id; ?>" class="submitdelete" onclick="return confirm_delete_msg('Are You Sure to Trash?')">Trash</a>
                </span>
               <?php endif;?>  
             </div>
        </td>
        
         <td class="role column-role"><a href="javascript:void(0)"><?php print $hswp_table[$i]->id; ?></a></td>
        
        <td class="role column-role"><a href="javascript:void(0)"><?php print $hswp_table[$i]->phone; ?></a></td>
        
        <td class="role column-role"><a href="javascript:void(0)"><?php print $hswp_table[$i]->email; ?></a></td>
        
        <td class="role column-role"><a href="javascript:void(0)"><?php print $hswp_table[$i]->facility; ?></a></td>
        
        <td class="role column-role"><a href="javascript:void(0)"><?php print $hswp_table[$i]->cc_fname." ".$hswp_table[$i]->cc_lname; ?></a></td>
        
        <td class="role column-role"><a href="javascript:void(0)"><?php print $hswp_table[$i]->cc_payment_type; ?></a></td>
        
        <td class="role column-role"><a href="javascript:void(0)"><?php print $hswp_table[$i]->cc_card_number; ?></a></td>
        
        <td class="role column-role"><a href="javascript:void(0)"><?php print $hswp_table[$i]->cc_cvv_number; ?></a></td>
        
        <td class="role column-role"><a href="javascript:void(0)"><?php print $hswp_table[$i]->cc_month."-".$hswp_table[$i]->cc_year; ?></a></td>
        
        <td class="role column-role"><a href="javascript:void(0)"><?php print $hswp_table[$i]->created_date; ?></a></td>
        
        <td class="role column-role">
        	<select name="payment_status" class="pstatus" id="<?php print $hswp_table[$i]->id; ?>">
            
            	<option value="">Choose Status</option>
                                    
                <?php $arr = array("pending","completed");
	
					foreach( $arr as $val  )
					{
						$sel = ( $val==$hswp_table[$i]->payment_status ) ? 'selected="selected"':"";
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
<script type="text/javascript">
$(".pstatus").change(function () {
	
	var cid = $(this).attr('id');
	
	var cval = $(this).val();
	//var param = 'user_id=' + cval;
    //alert(cid);
	//alert(cval);
	
	
jQuery.ajax({
	

	
		type: "post",url: "admin-ajax.php",data: { action: 'gethello',sval:cval,sid:cid, _ajax_nonce: '<?php echo $nonce; ?>' },
		beforeSend: function() {jQuery("#loading").show("slow");}, //show loading just when link is clicked
		complete: function() { jQuery("#loading").hide("fast");}, //stop showing loading when the process is complete
		success: function(html){ //so, if data is retrieved, store it in html
		var url = "admin.php?page=view_complete_reservation";
		
		
			jQuery("#helloworld").html(html); //show the html inside helloworld div
			jQuery("#helloworld").show("slow"); //animation
			$(location).attr('href',url);
			//alert('Testing');
		}
	}); //close jQuery.ajax(
});
//.change();


</script>

<div class="wrap">
	<div id='loading'></div>
	<div id='helloworld'></div>
</div>

<!--Status update coding end here-->





	<div class="tablenav bottom">

		<div class="alignleft actions">
			<!--<select name="action2">
				<option selected="selected" value="-1">Bulk Actions</option>
				<option value="delete">Delete</option>
			</select>
			<input type="submit" value="Apply" class="button-secondary action" id="doaction2" name="">-->
	   </div>
		<div class="tablenav-pages one-page">
        	<span class="displaying-num"><?php print $total_completed; ?> items</span>

            
       </div>
		<br class="clear">
	</div>

    
    
</form>


<br class="clear">

    </div><!--end of wrap div-->
    

<?php	
	
}
/*end of function*/


ob_clean();
?>