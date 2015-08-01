jQuery.noConflict();
jQuery(document).ready(function($){

   /* HEADER MENU PLUGIN */
   jQuery("ul.sf-menu")
   .supersubs({
      minWidth:    12,
      maxWidth:    27,
      extraWidth:  1
   })
   .superfish({
      animation:{opacity:'show', height:'show'},
      delay: 500,
      speed: 'fast',
      disableHI: true,
      autoArrows: false,
      dropShadows:false
   });

   /* CONTACT-FORM VALIDATE */
   if( jQuery.isFunction( jQuery.fn.validator ) ){

      jQuery.tools.validator.addEffect("onFail", function(errors, event) {
			jQuery.each(errors, function(index, error) {
				 error.input.addClass('invalid');
			});
      }, function(inputs)  {
			inputs.removeClass('invalid');
      });

      /* contact page form */
      jQuery('.sendform').validator({effect:'onFail'}).submit(function(e) {
         var form = jQuery(this);
         if (!e.isDefaultPrevented()) {

            var fid                 = form.find('input[name="form_id"]').val();
            var has_recaptcha       = form.find('div.recaptcha').data('recaptcha');
            var recaptcha_error     = form.find('div.error-recaptcha');

            _to                     = form.find('input[name="field_'+fid+'_to"]');
            _name                   = form.find('input[name="field_'+fid+'_name"]');
            _email                  = form.find('input[name="field_'+fid+'_email"]');
            _message                = form.find('textarea[name="field_'+fid+'_message"]');
            input_recaptcha			= form.find("input[name='recaptcha_response_field']");
            input_recaptcha_ch		= form.find("input[name='recaptcha_challenge_field']");
            success_div             = form.prev('.success');
            error_div               = success_div.prev('.error');
            
            jQuery.post(this.action,{
              'to':_to.val(),
              'name':_name.val(),
              'email':_email.val(),
              'message':_message.val(),
              'recaptcha_challenge_field': input_recaptcha_ch.val(),
              'recaptcha_response_field':	input_recaptcha.val()
            },function(data){

               recaptcha_error.hide();

               if( data == 'error-recaptcha' && has_recaptcha == true ){
                  success_div.hide();
                  error_div.hide();
                  recaptcha_error.fadeIn('fast');
               }else if ( data != '' ) {
                  success_div.hide();
                  error_div.hide().fadeIn("fast");
               }else{
                  success_div.hide().fadeIn("fast");
                  error_div.hide();
                 _name.val('');
                 _email.val('');
                 _message.val('');
               }

               if ( has_recaptcha == true ){
                  Recaptcha.reload();
               }

            });
            e.preventDefault();
         }
      });
   }

   /* TABS PLUGIN */
   jQuery(".tab").codetab();

   /* PRETTYPHOTO PLUGIN */
	jQuery("a[rel^='prettyPhoto']").prettyPhoto({social_tools: ''});

   jQuery("div#content").fitVids();

	if( jQuery.isFunction( jQuery.fn.kwicks ) ){
		jQuery('ul.kwicks').each(function() {

			var elem	= jQuery(this),
			max	= parseInt( elem.data("max") ),
			width	= parseInt( elem.data("width") );
			elem.kwicks({max:max, width:width, easing: "easeOutExpo", duration:1000});

		});
	}

   /* TOOLTIPS PLUGIN 2 */
   jQuery(".tip_up").tooltip({effect: 'slide', tipClass:'tt_up', offset: [0, 0], layout: '<div><span></span></div>'});
   jQuery(".tip_down").tooltip({effect: 'slide', tipClass:'tt_down', offset: [20, 0], position:'bottom center', layout: '<div><span></span></div>'});


   /* CYCLE SLIDER DEV. */
   jQuery('div.cycle-wrapper').each(function() {

      var elem    = jQuery(this);
      var cycle   = elem.find('ul.cycle-slider');
      var player  = elem.find('.cycle-ps');
      var delay   = parseInt( cycle.data("delay") );

      cycle.cycle({
         fx       :cycle.data("fx"),
         easing   :'easeInOutExpo',
         pause    :1,
         timeout  :delay,
         pager    :elem.find('.cycle-bulles'),
         before   :onBefore,
         after    :onAfter,
         height   :cycle.data("height"),
         width    :cycle.data("width"),
         first    :false,
         containerResize: false,
         slideResize: false,
         fit: 1
      });
    
      (delay == 0)?player.hide():player.show();

      player.on('click', function (e) {
         el = jQuery(this);
         el.toggleClass("cycle-play");
         cycle.cycle('toggle');
         e.preventDefault();
      });

      cycle.swipe({
           swipe:function(event, direction, distance, duration, fingerCount) {
            if(direction == 'left'){
               cycle.cycle('prev');
            }else if (direction == 'right'){
               cycle.cycle('next');
            }
           }
      });

   });

   function onBefore(cElem, nElem, o, f) {
      if (o.first){
         jQuery(cElem).find('.layer2').stop().animate({'top':o.height, 'opacity':1}, 2000, 'easeOutExpo');
         jQuery(cElem).find('.layer3').stop().animate({'top':o.height, 'opacity':1}, 2000, 'easeOutExpo');
      }
      jQuery(nElem).find('.layer2').css({top:o.height}).animate({'top':o.height, 'opacity':1}, 500, 'easeOutExpo');
      jQuery(nElem).find('.layer3').css({top:o.height}).animate({'top':o.height, 'opacity':1}, 500, 'easeOutExpo');
      o.first = true;
   }
   function onAfter(cElem, nElem, o, f) {

      jQuery(nElem).find('.layer2').animate({'top':0, 'opacity':1}, 500, 'easeOutExpo');
      jQuery(nElem).find('.layer3').delay(100).animate({'top':0, 'opacity':1}, 500, 'easeOutExpo');

   }

   /* CYCLE TICKER DEV. */
	jQuery('div.cycle-ticker').each(function() {

      var elem    = jQuery(this);
      var cycle   = elem.find('.cycle-ticks');
      var nextBtn = elem.find('.cycle-next');
      var prevBtn = elem.find('.cycle-prev');
      cycle.cycle({
         fx       :cycle.data("fx"),
         easing   :'easeInOutExpo',
         pause    :1,
         speed    :parseInt( cycle.data("speed") ),
         timeout  :parseInt( cycle.data("delay") ),
         next     :nextBtn,
         prev     :prevBtn,
         cleartype:true,
         cleartypeNoBg: true,
         before   :container_height
      });

   });

   function container_height(c,n){
      var current    = jQuery(c);
      var next       = jQuery(n);
      jQuery(current).css({width:current.width(), height:current.height()})
      jQuery(next).parent().parent().animate({height:next.height()+10});
   }

	if( jQuery.isFunction( jQuery.fn.codeslider ) ){

		jQuery('div.cslider').each(function() {

			var elem	= jQuery(this),
			delay	   = parseInt( elem.data("delay") ),
			play	   = elem.data("autoplay"),
			button	= elem.data("buttons"),
			width	   = parseInt( elem.data("width") ),
			height	= parseInt( elem.data("height") );
			elem.codeslider({'speed': delay, 'width':width, 'height':height, autoplay: play, buttons: button});
         
         elem.swipe({
           swipe:function(event, direction, distance, duration, fingerCount) {
            if(direction == 'right'){
               elem.find('div.prev').trigger('click');
            }else if (direction == 'left'){
               elem.find('div.next').trigger('click');
            }
           }
         });

		});

	}

	if( jQuery.isFunction( jQuery.fn.nivoSlider ) ){

		jQuery('div.nivoSlider').each(function() {

			var elem	= jQuery(this),
			speed    = parseInt( elem.data("speed") ),
			effect   = elem.data("effect"),
			slices   = elem.data("slices"),
			boxcols  = elem.data("boxcols"),
			boxrows  = elem.data("boxrows"),
			border   = elem.data("border");
			thumbs   = elem.data("thumbs");
			elem.nivoSlider({captionOpacity:1, pauseTime: speed, effect:effect, slices:slices, boxCols:boxcols,  boxRows:boxrows, controlNavThumbs:thumbs});

         if(border){
            jQuery('<div class="nivoCover"></div>').appendTo(elem);
         }
         
         elem.swipe({
           swipe:function(event, direction, distance, duration, fingerCount) {
            if(direction == 'right'){
               jQuery('a.nivo-prevNav').trigger('click');
            }else if (direction == 'left'){
               jQuery('a.nivo-nextNav').trigger('click');
            }
           }
         });
         
      });
	}
   
   jQuery(window).load(function() {
   
      if( jQuery.isFunction( jQuery.fn.flexslider ) ){

         jQuery('div.flexslider').each(function() {

            var elem	= jQuery(this),         
            delay	   = parseInt( elem.data("flex-delay") ),
            effect	= elem.data("flex-effect"),
            cnav  	= elem.data("flex-cnav"),
            dnav	   = elem.data("flex-dnav"),
            autoplay	= elem.data("flex-autoplay");
            
            elem.flexslider({
               animation: effect,
               slideshow: autoplay,
               slideshowSpeed: delay,
               pauseOnHover: true,
               smoothHeight: true,
               controlNav: cnav,
               directionNav: dnav,
               start: function(slider){
                  if( slider.width() < 600 ){
                     slider.find('div.flex-content').hide();
                  }
               }
            });

         });
      }
      
   });

});