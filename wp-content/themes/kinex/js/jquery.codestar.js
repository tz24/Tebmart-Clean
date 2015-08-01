/***************************************************************************
    Script		: jQuery easing
	Version		: 1.3
	Authors		: George Smith
***************************************************************************/
jQuery.easing['jswing']=jQuery.easing['swing'];jQuery.extend(jQuery.easing,{def:'easeOutQuad',swing:function(x,t,b,c,d){return jQuery.easing[jQuery.easing.def](x,t,b,c,d);},easeInQuad:function(x,t,b,c,d){return c*(t/=d)*t+b;},easeOutQuad:function(x,t,b,c,d){return-c*(t/=d)*(t-2)+b;},easeInOutQuad:function(x,t,b,c,d){if((t/=d/2)<1)return c/2*t*t+b;return-c/2*((--t)*(t-2)-1)+b;},easeInCubic:function(x,t,b,c,d){return c*(t/=d)*t*t+b;},easeOutCubic:function(x,t,b,c,d){return c*((t=t/d-1)*t*t+1)+b;},easeInOutCubic:function(x,t,b,c,d){if((t/=d/2)<1)return c/2*t*t*t+b;return c/2*((t-=2)*t*t+2)+b;},easeInQuart:function(x,t,b,c,d){return c*(t/=d)*t*t*t+b;},easeOutQuart:function(x,t,b,c,d){return-c*((t=t/d-1)*t*t*t-1)+b;},easeInOutQuart:function(x,t,b,c,d){if((t/=d/2)<1)return c/2*t*t*t*t+b;return-c/2*((t-=2)*t*t*t-2)+b;},easeInQuint:function(x,t,b,c,d){return c*(t/=d)*t*t*t*t+b;},easeOutQuint:function(x,t,b,c,d){return c*((t=t/d-1)*t*t*t*t+1)+b;},easeInOutQuint:function(x,t,b,c,d){if((t/=d/2)<1)return c/2*t*t*t*t*t+b;return c/2*((t-=2)*t*t*t*t+2)+b;},easeInSine:function(x,t,b,c,d){return-c*Math.cos(t/d*(Math.PI/2))+c+b;},easeOutSine:function(x,t,b,c,d){return c*Math.sin(t/d*(Math.PI/2))+b;},easeInOutSine:function(x,t,b,c,d){return-c/2*(Math.cos(Math.PI*t/d)-1)+b;},easeInExpo:function(x,t,b,c,d){return(t==0)?b:c*Math.pow(2,10*(t/d-1))+b;},easeOutExpo:function(x,t,b,c,d){return(t==d)?b+c:c*(-Math.pow(2,-10*t/d)+1)+b;},easeInOutExpo:function(x,t,b,c,d){if(t==0)return b;if(t==d)return b+c;if((t/=d/2)<1)return c/2*Math.pow(2,10*(t-1))+b;return c/2*(-Math.pow(2,-10*--t)+2)+b;},easeInCirc:function(x,t,b,c,d){return-c*(Math.sqrt(1-(t/=d)*t)-1)+b;},easeOutCirc:function(x,t,b,c,d){return c*Math.sqrt(1-(t=t/d-1)*t)+b;},easeInOutCirc:function(x,t,b,c,d){if((t/=d/2)<1)return-c/2*(Math.sqrt(1-t*t)-1)+b;return c/2*(Math.sqrt(1-(t-=2)*t)+1)+b;},easeInElastic:function(x,t,b,c,d){var s=1.70158;var p=0;var a=c;if(t==0)return b;if((t/=d)==1)return b+c;if(!p)p=d*.3;if(a<Math.abs(c)){a=c;var s=p/4;}
else var s=p/(2*Math.PI)*Math.asin(c/a);return-(a*Math.pow(2,10*(t-=1))*Math.sin((t*d-s)*(2*Math.PI)/p))+b;},easeOutElastic:function(x,t,b,c,d){var s=1.70158;var p=0;var a=c;if(t==0)return b;if((t/=d)==1)return b+c;if(!p)p=d*.3;if(a<Math.abs(c)){a=c;var s=p/4;}
else var s=p/(2*Math.PI)*Math.asin(c/a);return a*Math.pow(2,-10*t)*Math.sin((t*d-s)*(2*Math.PI)/p)+c+b;},easeInOutElastic:function(x,t,b,c,d){var s=1.70158;var p=0;var a=c;if(t==0)return b;if((t/=d/2)==2)return b+c;if(!p)p=d*(.3*1.5);if(a<Math.abs(c)){a=c;var s=p/4;}
else var s=p/(2*Math.PI)*Math.asin(c/a);if(t<1)return-.5*(a*Math.pow(2,10*(t-=1))*Math.sin((t*d-s)*(2*Math.PI)/p))+b;return a*Math.pow(2,-10*(t-=1))*Math.sin((t*d-s)*(2*Math.PI)/p)*.5+c+b;},easeInBack:function(x,t,b,c,d,s){if(s==undefined)s=1.70158;return c*(t/=d)*t*((s+1)*t-s)+b;},easeOutBack:function(x,t,b,c,d,s){if(s==undefined)s=1.70158;return c*((t=t/d-1)*t*((s+1)*t+s)+1)+b;},easeInOutBack:function(x,t,b,c,d,s){if(s==undefined)s=1.70158;if((t/=d/2)<1)return c/2*(t*t*(((s*=(1.525))+1)*t-s))+b;return c/2*((t-=2)*t*(((s*=(1.525))+1)*t+s)+2)+b;},easeInBounce:function(x,t,b,c,d){return c-jQuery.easing.easeOutBounce(x,d-t,0,c,d)+b;},easeOutBounce:function(x,t,b,c,d){if((t/=d)<(1/2.75)){return c*(7.5625*t*t)+b;}else if(t<(2/2.75)){return c*(7.5625*(t-=(1.5/2.75))*t+.75)+b;}else if(t<(2.5/2.75)){return c*(7.5625*(t-=(2.25/2.75))*t+.9375)+b;}else{return c*(7.5625*(t-=(2.625/2.75))*t+.984375)+b;}},easeInOutBounce:function(x,t,b,c,d){if(t<d/2)return jQuery.easing.easeInBounce(x,t*2,0,c,d)*.5+b;return jQuery.easing.easeOutBounce(x,t*2-d,0,c,d)*.5+c*.5+b;}});

/***************************************************************************
	Script		: All of Codestar's Plugins
	Version		: 1.0
	Authors		: Codestar
	Desc		   : It is for my premium wordpress themes.
	Licence		: Commercial - MIT Licence
	
	(c) 2011 - 2012 Codestar <http://www.codestarlive.com>
***************************************************************************/
;(function($){
  
   $.fn.extend({
      fixfooter: function() {
         
         var fix   = $(this).appendTo('div#content');
         $.extend({
            refixfooter: function() {
               var documentHeight   = $(document.body).height() - fix.height(),
               windowHeight         = $(window).height();
               if (documentHeight < windowHeight) {
                  fix.height(windowHeight - documentHeight);
               }
            }
         });
         
         $.refixfooter();
         $(window).bind('load resize scroll', $.refixfooter);
         
      }
  });
  
})(jQuery);


;(function($){

$.fn.codetab = function() {

	jQuery("ul:nth-child(1) > li:nth-child(1)", this).addClass("active");
	jQuery("ul:nth-child(2) > li:nth-child(1)", this).show();
	jQuery(this).on("click", "ul:nth-child(1) li:not(.active) a", function() {
		jQuery(this).parent().addClass("active").siblings().removeClass("active");
		jQuery(this).parent().parent().next().find("> li").hide(); 
		jQuery(this).parent().parent().next().find("> li:nth-child(" + (jQuery(this).parent().index()+1) + ")").fadeIn();
	});

};

})(jQuery);


jQuery(document).ready ( function (){

   jQuery("div#fix-footer").fixfooter();
   
	jQuery('input#s').focus(function(){
		if(this.value==this.defaultValue){
			this.value='';
		}}).blur(function(){
		if(jQuery.trim(this.value)==''){
			this.value=(this.defaultValue)?this.defaultValue:'';
		}
	});

	jQuery("h5.toggle").click(function(){
		jQuery(this).toggleClass("active").next().slideToggle("fast");
		return false;
	});
   
   jQuery("div.accordion").each(function (){
   
      jQuery("> h5:nth-child(1)",this).addClass("active").next().show();
      jQuery(this).on("click", "> h5:not(.active)", function(){
         _this = jQuery(this);
         _this.next().slideToggle("fast", "easeInOutExpo").siblings("div.accordion_content:visible").slideUp("fast", "easeInOutExpo");
         _this.addClass("active").siblings(this).removeClass("active");
      });
   
   });
   
	jQuery("a.icon_link, a.icon_document, a.icon_video, a.icon_image, a.icon_lightbox").hover(function(){
      jQuery("img:first",this).animate({opacity: '.3'},"fast");
   },function(){
      jQuery("img:first",this).animate({opacity: '1'},"fast");
   });

   
	jQuery("a.top").click( function (){
	
		var browser = jQuery.support.opera ? jQuery("html") : jQuery("html, body"); 
		browser.animate({scrollTop: 0}, 500);

		return false;
		
	});
   
	jQuery("a.box-hide").click( function (){
		jQuery(this).parent().slideUp("fast");
		return false;
	});
   
	jQuery(".cs-button").hover(function(){
		
      var bghover       = jQuery(this).attr('data-bghover');
		var bghovertext   = jQuery(this).attr('data-bghovertext');
      
      if(bghover){
			jQuery(this).css('background-color', bghover);
		}
		if(bghovertext){
			jQuery('span',this).css('color', bghovertext);
		}
      
	},
	function(){
		
      var bgcolor    = jQuery(this).attr('data-bgcolor');
		var textcolor  = jQuery(this).attr('data-textcolor');
      
		if(bgcolor){
			jQuery(this).css('background-color', bgcolor);
		}
		if(textcolor){
			jQuery('span',this).css('color', textcolor);
		}
      
	});

});