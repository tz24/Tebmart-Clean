<?php $nonce = wp_create_nonce( 'helloworld' ); ?>
<script type="text/javascript">
jQuery(".pstatus").change(function () {
	//alert('Testing');
	var cid = this.id;
	//alert(cid);
	var cval = this.value;
	//alert(cval);

jQuery.ajax({

		type: "post",url: "admin-ajax.php",data: { action: 'getsellbook',sval:cval,sid:cid, _ajax_nonce: '<?php echo $nonce; ?>' },

		beforeSend: function() {
			
			jQuery("#loading").show("slow"); 
			//jQuery("#backgroundPopup").fadeIn("slow"); 
			//jQuery("#popup_box").fadeIn("slow");
			

			
		}, //show loading just when link is clicked

		complete: function() { jQuery("#loading").hide("fast");}, //stop showing loading when the process is complete

		success: function(html){ //so, if data is retrieved, store it in html

		var url = "admin.php?page=follow_up&action=edit";

			//jQuery("#helloworld").html(html); //show the html inside helloworld div

			//jQuery("#helloworld").show("slow"); //animation

			

			//alert('Testing');

			
			jQuery('#backgroundPopup').click(function() {
				jQuery("#backgroundPopup").fadeOut("slow");
				jQuery("#popup_box").fadeOut("slow");
			});
			
			jQuery('.close').click(function() {
				jQuery("#backgroundPopup").fadeOut("slow");
				jQuery("#popup_box").fadeOut("slow");
			});
			
			//jQuery(location).attr('href',url);
			
		}

	}); //close jQuery.ajax(

});

//.change();


jQuery(".send-offer").click(function() {

	var sid = this.id;
	var sid2 = sid.split('-');
	var uid = sid2['2'];
	var s1 = sid2['3'];
	var s2 = sid2['4'];
	var s3 = sid2['5'];
	var bt = sid2['6'];
	var est = 'est_amt-' + s1;
	var est2 = document.getElementById(est).value;
	//alert(s2);
	//alert(uid);
	//alert('Offer Send..');
	
	
	jQuery.ajax({

		type: "post",url: "admin-ajax.php",data: { action: 'getsendoffer',eval:est2,sid:s1,email:s2,curl:s3,btitle:bt,userid:uid, _ajax_nonce: '<?php echo $nonce; ?>' },

		beforeSend: function() {
			jQuery("#loading").show("slow"); 
		}, //show loading just when link is clicked

		complete: function() { jQuery("#loading").hide("fast");}, //stop showing loading when the process is complete
		success: function(html){ //so, if data is retrieved, store it in html
		alert('offer send...');
		location.reload();
		var url = "admin.php?page=reservation";
		}

	}); //close jQuery.ajax(
});
</script>