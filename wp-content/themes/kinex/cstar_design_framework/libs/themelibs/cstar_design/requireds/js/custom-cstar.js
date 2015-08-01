jQuery(document).ready( function (){

   /* codebox */
   jQuery('#widgets-right, div.wp-media-buttons, div.option_wrap').on('click', 'a.codebox', function(e) {
         
      var box_id = jQuery('#cstar-shortcode-generator'), box_height = box_id.outerHeight(),box_width = box_id.outerWidth(), overlay = jQuery("#shortcode-overlay");

      overlay.fadeTo(200, 0.8);
      box_id.css({'display':'block', 'margin-left' : -(box_width/2) + "px", 'margin-top' : -(box_height/2) + "px"}).fadeTo(300,1);

      jQuery('#shortcode-overlay, #shortcode-close').click(function() {
         overlay.fadeOut(300);
         box_id.fadeOut(200);
         return false;
      });
      
		jQuery("#load-preview, #exit-preview").hide();
		jQuery("#load-shortcode, #shortcode-selector").show();
		jQuery("#shortcode-iframe").attr('src', jQuery('#shortcode-uri').val() + '?action=get-shortcode-preview')
      
      return false;
      e.preventDefault();
    
   });

	/* toggle content */
	jQuery("h3.toggle").click(function(){
		jQuery(this).toggleClass("active").next().slideToggle("fast");
		return false;
	});
   
	/* footer, sidebar */
	jQuery('.footer_widget_model li').each( function(){

      elem = jQuery(this);
      
		if ( elem.find("input").is(":checked") ){ elem.addClass('selected'); }
      
		elem.bind('click blur focus option_name_trigger', function(){
			
         element = jQuery(this);
         
			if ( element.find("input").is(":checked") ){
			
            element.addClass('selected').siblings().removeClass("selected");
		
			}else{
         
				element.removeClass('selected');
				element.parent().find("input").each(function(){ jQuery(this).attr("checked", false); });
				
			}
			
		});

	});   

   /* footer, sidebar */
	jQuery('.sidebar li, .layout li').each( function(){

      elem     = jQuery(this);
      sidebar  = jQuery("#choose_sidebar");
      
		if ( elem.find("input").is(":checked") ){ elem.addClass('selected'); }
		if ( elem.find("input").is(":checked") && elem.find("input").val() != "full" ){ sidebar.show(); }
      
		elem.bind('click blur focus option_name_trigger', function(){
			
         element = jQuery(this);
         
         if( element.find("input").is(":checked") && element.find("input").val() != "full" ){
				sidebar.show();
			}else{
				sidebar.hide();
			}
         
			if ( element.find("input").is(":checked") ){
			
            element.addClass('selected').siblings().removeClass("selected");
		
			}else{
         
				element.removeClass('selected');
				element.parent().find("input").each(function(){ jQuery(this).attr("checked", false); });
				
			}
			
		});

	});
   

   jQuery("#_custom_header").each(function(){

      t = jQuery(this).val();
      
      if ( t == 'on' ){
         jQuery("#_custom_header_wrap").show();
      }
   
		jQuery(this).bind('on_off',function(event, t){
			
			if( t == "off" ){
				jQuery("#_custom_header_wrap").slideToggle('fast');
			}else{
				jQuery("#_custom_header_wrap").slideToggle('fast');
			}
			
			
		});
	
	});

	jQuery("#exit-preview").on('click', function(event) {
		jQuery("#load-preview, #exit-preview").hide();
		jQuery("#shortcode-iframe").contents().find("#shortcode-content").html('');
		jQuery("#load-shortcode, #shortcode-selector").show();
		return false;
	});
	
	
	function ucfirst(str) {
		var firstLetter = str.substr(0, 1);
		return firstLetter.toUpperCase() + str.substr(1);
	}

	/* tab cloner */
	jQuery('#cstar-shortcode-generator').on( 'change', 'select[data-id="count_tab"], select[data-id="count_accordion"]', function() {
		
		elem		= jQuery(this);
		id			= elem.data('id').replace('count_', '');
		count		= elem.find(':selected').val();
		idupper		= ucfirst(id);
		
		/* remove before added */
		jQuery(".counter").remove();

		for(i=0; i<count; i++){
			elem.parent().parent().parent().parent().parent().parent().append('<table width="100%" cellspacing="0" cellpadding="0" class="option_rows counter" data-id="'+id+'"><tbody><tr><td class="sc_1"><div class="option_text">'+idupper+' '+(i+1)+' Title:</div></td><td class="sc_2"><div class="option_input_text"><input type="text" class="shortcode-sub-attr" value=""></div></td></tr></tbody></table><table width="100%" cellspacing="0" cellpadding="0" class="option_rows counter" data-id="'+id+'"><tbody><tr><td class="sc_1"><div class="option_text">'+idupper+' '+(i+1)+' Content:</div></td><td class="sc_2"><div class="option_textarea"><textarea class="shortcode-content-attr"></textarea></div></td></tr></tbody></table>');
		}
		
	});
	

	jQuery('#shortcode-selector').on( "change", function() {
	
		elem_this = jQuery(this);
	
		shortcode_name = elem_this.find(':selected').val();
		shortcode_group = elem_this.find(':selected').parent().attr('id');
		
		elem_load = jQuery('#load-shortcode');
		elem_load.html('').addClass('shortcode-loader');
		elem_load.load(jQuery('#shortcode-uri').val() + '?action=get-shortcode&group='+ shortcode_group +'&shortcode='+ shortcode_name, function() {
			elem_load.removeClass('shortcode-loader');
		});
		
		cache_shortcodename = shortcode_name;
		
	});
	

	jQuery('#cstar-shortcode-generator').on('click', '#shortcode-insert, #shortcode-preview', function(event) {
		
		total_val = jQuery('#shortcode-values');
		total_val.val('');
		
		var sc_type		= jQuery("#shortcode-type");
		var post_type	= jQuery(this).data('type');
		spacer = (sc_type.data('oneline') == true)?'':'\n';
		
		var shortcode_name = cache_shortcodename;
		
      
		if ( sc_type.data('multiple') == true ) {
		
			jQuery('#load-shortcode .shortcode-attr').each(function() {
				this_val = jQuery(this).val();
				this_id = jQuery(this).data('id');
				total_val.val( total_val.val() + '[' + this_id + ']'+this_val+'[/' + this_id + ']\n');
			});
		
		
		} else if (sc_type.data('flexible') == true) {
		
			total_val = jQuery('#shortcode-values');
			total_val.val('[' + shortcode_name);
			
			jQuery('#load-shortcode .shortcode-attr').each(function() {
				this_val = jQuery(this).val();
				this_id = jQuery(this).data('id');
				if ( this_val !== '' ) {
					this_attr = ( this_id == "count_accordion" || this_id == "count_tab")?'': ' ' + this_id + '="' + this_val + '"';
					total_val.val( total_val.val() + this_attr );
				}
			});
			total_val.val(total_val.val() + ']\n');
			
			var sub_vals = '';
			var sub_attr;
			jQuery('table.counter').each(function() {
				
				elem_this = jQuery(this);
				elem_id = jQuery(this).data("id");
				
				if(elem_this.find(".shortcode-sub-attr").val() != undefined){
					sub_attr = ' title="' + elem_this.find(".shortcode-sub-attr").val() + '"';
				}
				if( elem_this.find(".shortcode-content-attr").val() != undefined ){
					sub_vals = sub_vals + '['+elem_id+sub_attr+']'+elem_this.find(".shortcode-content-attr").val()+'[/'+elem_id+']\n';
				}
			});
		
			
			total_val.val(total_val.val() + sub_vals + '[/' + shortcode_name + ']');

		}
		
		else if (sc_type.data('single') == true || sc_type.data('wrap') == true){
	  
		
			total_val.val('[' + shortcode_name);
			jQuery('#load-shortcode .shortcode-attr').each(function() {
				val = jQuery(this).val();
				if ( val !== '' ) {
					if( val == "off" || val == null || val == undefined || val == '0'){
						attr = '';
					}else{
						if(val == "on"){  val = '1'; }
						attr = ' ' + jQuery(this).data('id') + '="' + val + '"';
					}
					total_val.val( total_val.val() + attr );
				}
			});
			
			total_val.val(total_val.val() + ']' + spacer);

			if ( sc_type.data('single') != true ) {
				total_val.val(total_val.val() + jQuery('#shortcode-content').val() + spacer +'[/' + shortcode_name + ']');
			}
		
		}

		var shortcode = total_val.val();
		total_val.val('');
		
		if( post_type == 'insert' ){
		
			if ( typeof window.generator_target !== 'undefined' ) {
				jQuery('textarea#' + window.generator_target).val( jQuery('textarea#' + window.generator_target).val() + shortcode);
            window.generator_target = undefined;
         }else {
				window.send_to_editor(shortcode);
			}
         
         jQuery("#shortcode-overlay").fadeOut(200);
         jQuery("#cstar-shortcode-generator").hide();
         
		}else{
			jQuery('#load-shortcode, #shortcode-selector').hide();
			jQuery('#exit-preview').show();
			iframe_contents = jQuery("#shortcode-iframe").contents();
			iframe_contents.find('#shortcode-inputer').val(shortcode);
			iframe_contents.find('form').submit();
			jQuery('#load-preview').show();
			
		}

		event.preventDefault();
		return false;
	});

	jQuery('#widgets-right, div.option_wrap').on('click', 'a[data-page="widget"]',function(event) {
		window.generator_target = jQuery(this).attr('data-target');
	});
   
});