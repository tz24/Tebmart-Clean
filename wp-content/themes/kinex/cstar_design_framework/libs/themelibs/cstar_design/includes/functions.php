<?php
if ( !class_exists('CodeStarFunctions') ){

class CodeStarFunctions{

   function site_title(){

      global $page, $paged;

      $out   = wp_title( '&laquo;', true, 'right' );
      $out  .= get_bloginfo( 'name' );

      $site_description = get_bloginfo( 'description', 'display' );
      if ( !empty($site_description) && ( is_home() || is_front_page() ) ) {	$out  .= " &laquo; ". $site_description; }
      if ( $paged >= 2 || $page >= 2 ){ $out  .= ' &laquo; ' . sprintf( __( 'Page %s', T_NAME ), max( $paged, $page ) ); }

		return $out;

	}

	function ie_hack(){
return "<!--[if IE 6]>
<link href='".T_CSS."/ie6.css'	media='screen' rel='stylesheet' type='text/css'>
<script type='text/javascript' src='".T_JS."/ie6.js'></script>
<![endif]-->
<!--[if IE 7]><link href='".T_CSS."/ie7.css' media='screen' rel='stylesheet' type='text/css'><![endif]-->
<!--[if IE 8]><link href='".T_CSS."/ie8.css' media='screen' rel='stylesheet' type='text/css'><![endif]-->
<!--[if IE]><script type='text/javascript' src='".T_JS."/iefix.js'></script><![endif]-->
";
	}

   function header_area(){

		if( get_theme_option('general', 'header_widget') == 'off'){ return ''; }
		
		echo '<div class="inner-right">';
      if( get_theme_option('general', 'header_area') == 'widget'){
         dynamic_sidebar('header_widget');
      }else{
         echo do_shortcode(get_theme_option('general', 'header_area_html'));
      }
		echo '</div>';

   }

   function site_menu($class=null){

		$class = $class?$class:'sf-menu';
		
      if ( function_exists('wp_nav_menu') && has_nav_menu('primary') ){

			$walker = ( get_theme_option('general', 'menu_arrow') == 'on' ) ? new Children_Menu_Walker : '';

         echo '<div class="menu">';
         wp_nav_menu( array(
            'theme_location' => 'primary',
            'container'       => false,
            'menu_class'      => $class,
				'walker'				=> $walker
         ));
         echo '</div>';
         
        
         if( get_theme_option("advanced", "is_responsive") == 'on' ){
            echo '<div class="responsive-menu">';
            dropdown_menu(array(
               'theme_location'  => 'primary',
               'menu_class'      => 'responsive-nav',
               'dropdown_title'  => __('Go to...', T_NAME),
               'indent_string'   => '-'
            ));
             echo '</div>';
         }
         
      } else {
         ?>
         <div class="menu">
         <ul class="<?php echo $class; ?>">
            <?php if (get_theme_option('advanced', 'home_translate') != ''): ?>
            <li<?php if ( is_home() ){ echo ' class="current_page_item"'; } ?>><a href="<?php echo home_url('/'); ?>"><?php echo get_theme_option('advanced', 'home_translate'); ?></a></li>
            <?php endif; ?>
            <?php
					$exclude_pages = get_theme_option('advanced', 'menu_exclude');
               wp_list_pages('sort_column=menu_order&title_li=&exclude='.$exclude_pages);
            ?>
         </ul>
         </div>
         <?php
            if( get_theme_option("advanced", "is_responsive") == 'on' ){
            echo '<div class="responsive-menu">';
            $args = array(
               'sort_column'  => 'menu_order',
               'title_li'     => '',
               'exclude'      => $exclude_pages
            ); 
            $get_pages = get_pages($args);
         ?>
         <select id="responsive-nav" onchange='document.location.href=this.options[this.selectedIndex].value;'> 
            <option value="" <?php if ( is_home() ){ echo ' selected="selected"'; } ?>><?php _e('Go to...', T_NAME); ?></option>
            <?php if (get_theme_option('advanced', 'home_translate') != ''): ?>
            <option value="<?php echo home_url('/'); ?>"><?php echo get_theme_option('advanced', 'home_translate'); ?></option>
            <?php endif; ?>
            <?php echo get_page_selectbox($get_pages,0); ?>
         </select>
         <?php
            echo '</div>';
         }
      
      }

   }

	
	function sliders($id=null, $nosc=false){
   
		global $wpdb;
		
		$item_table       = $wpdb->prefix . "slider_items";
		$category_table   = $wpdb->prefix . "slider_categories";

		$get_slides			= $wpdb->get_results("SELECT * FROM " . $item_table . " WHERE c_id REGEXP '(^".$id.",)|(,".$id."$)|(,".$id.",)|^".$id."$' ORDER BY orderby DESC");
		$get_slider			= $wpdb->get_row( $wpdb->prepare("SELECT * FROM " . $category_table . " WHERE id = %d", $id) );
		$get_count			= count($get_slides);
		
      if ( $get_count == 0 ){
      
         if( get_theme_option('homepage', 'custom_slider') == '' ){
            return '<div id="slider"><div class="inner"><div class="noslider"></div></div></div>';
         }else{
            return '';
         }
         
      }
		
		ob_start();
		
		if($get_slider->s_id != 1 && $nosc == false){
			echo '<div id="slider"><div class="inner">';
		}

		if( $get_slider->s_id == 1) {

			
			$settings			= unserialize($get_slider->c_value);

			$fullwidth			= ($settings["s_fullwidth"] == 'on')?true:false;
			$inner_style		= ($fullwidth)?' style="width:100%;"':'';
			$slider_style		= ($fullwidth)?'100%':$settings["s_width"].'px';
			$nav_style			= ($fullwidth)?' style="right:49%;"':'';
			$height				= $settings["s_height"];
			$width				= $settings["s_width"];
			$margin				= ($settings["s_margin"])?' style="margin:'.$settings["s_margin"].'px auto;"':'';
         $effect				= apply_filters('effect_preview', $settings["s_effect"]);

			$out	 = '';
			$out	.= (!$nosc)?'<div id="slider"><div class="inner"'.$inner_style.'>':'';

			/* is responsive active */
         if( get_theme_option("advanced", "is_responsive") == 'on' ){
          
            $image_resp    = unserialize($get_slides[0]->s_value);
            
            $out  .= '<div class="cycle-responsive"'.$margin.'>';
            if( isset($settings["s_responsive"]) ){
               $resp_src = get_the_image( 'url', $settings["s_responsive"], array($width,$height) );
               $out  .= '<img src="'.$resp_src.'" />';
            }else if( isset($image_resp['s_layer1_image']) ){
               $resp_src   = get_the_image( 'url', $image_resp['s_layer1_image'], array($width,$height) );
               $out  .= '<img src="'.$resp_src.'" />';
            }            
            $out  .= '</div>';

         }
         
         
			$out	.= '<div id="cycle-'.$get_slider->id.'" class="cycle-wrapper"'.$margin.'>';
         
         
         
        
         
			$out	.= '<ul class="cycle-slider" data-fx="'.$effect.'" data-delay="'.$settings["s_delay"].'000" data-height="'.$height.'" style="width:'.$slider_style.'; height:'.$height.'px;">';

			
			$str	 = '';
			foreach($get_slides as $item){

				
				$value         = unserialize($item->s_value);
				$tag   		   = $item->s_name;
				$alt_tag       = ($tag)?' alt="'.$tag.'"':'';

				
				$timthumb		= $value["s_layer1_timthumb"];
				$layer1_type	= $value["s_layer1_type"];
				$layer1_bg		= $value["s_layer1_background"];
				$layer1_image	= $value["s_layer1_image"];
				$layer1_text	= do_shortcode($value["s_layer1_text"]);
				$layer1_src		= ($timthumb == 'on')?get_the_image( 'url', $layer1_image, array($width,$height) ):$layer1_image;
				$layer1_out		= ($layer1_type == 'image')?'<div class="layer1"><img src="'.$layer1_src.'" '.$alt_tag.'/></div>':'<div class="layer1">'.$layer1_text.'</div>';

				
				$layer2_type	= $value["s_layer2_type"];
				$layer2_image	= $value["s_layer2_image"];
				$layer2_text	= do_shortcode($value["s_layer2_text"]);
				$layer2_out		= ($layer2_type == 'image')?'<div class="layer2"><img src="'.$layer2_image.'" '.$alt_tag.'/></div>':'<div class="layer2">'.$layer2_text.'</div>';

				
				$layer3_type	= $value["s_layer3_type"];
				$layer3_image	= $value["s_layer3_image"];
				$layer3_text	= do_shortcode($value["s_layer3_text"]);
				$layer3_out		= ($layer3_type == 'image')?'<div class="layer3"><img src="'.$layer3_image.'" '.$alt_tag.'/></div>':'<div class="layer3">'.$layer3_text.'</div>';

				
				$get_link = $this->get_custom_link($value);

				$link_type		= $get_link['type'];
				$link_href		= $get_link['link'];
				$link_target	= $get_link['target'];

				$single = ($get_count == 1)?' display:block;':'';

				$str	.= '<li style="width:'.$slider_style.'; height:'.$height.'px; '.$layer1_bg.$single.'">';
				$str	.= ( !empty($link_type) )?'<a href="'.$link_href.'" class="cycle-link"'.$link_target.'></a>':'';
				$str	.= ($fullwidth)?'<div style="width:'.$width.'px;" class="cycle-content">':'';
				$str	.= ( ( !empty($layer3_image) || !empty($layer3_text) ) && !empty($layer3_type) )?$layer3_out:'';
				$str	.= ( ( !empty($layer2_image) || !empty($layer2_text) ) && !empty($layer2_type) )?$layer2_out:'';
				$str	.= ($fullwidth)?'</div>':'';
				$str	.= ( ( !empty($layer1_image) || !empty($layer1_text) ) && !empty($layer1_type) && !$fullwidth)?$layer1_out:'';
				$str	.= '</li>';

			}

			$out	.= $str;
			$out	.= '</ul>';
			$out	.= ($settings["s_nav"] == "on" && $get_count != 1)?'<div class="cycle-nav" '.$nav_style.'><div class="cycle-bulles"></div><div class="cycle-ps"></div></div>':'';
			$out	.='</div>';
			$out	.= (!$nosc)?'</div></div>':'';

			
			echo $out;
         
		}

		
		else if( $get_slider->s_id == 2) {

			
			wp_enqueue_script('jquery-nivo');

			
			$settings	= unserialize($get_slider->c_value);

			$height		   = $settings["s_height"];
			$width		   = $settings["s_width"];
			$delay		   = $settings["s_delay"];
			$slices		   = $settings["s_slices"];
			$boxcols		   = $settings["s_boxcols"];
			$boxrows		   = $settings["s_boxrows"];
			$effect		   = $settings["s_effect"];
			$timthumb	   = $settings["s_timthumb"];
			$margin		   = $settings["s_margin"];
         
			$thumbnail     = $settings["s_thumbnail"];
			$thumbnail_w   = $settings["s_thumbnail_width"];
			$thumbnail_h   = $settings["s_thumbnail_height"];
         
			$border		   = ($settings["s_border"]=='on')?' data-border="true"':'';
			$margin2		   = ($settings["s_thumbnail"]=='on')?($margin+$thumbnail_h):$margin;
			$space		   = ($margin)?'margin:'.$margin.'px 0 '.$margin2.'px 0;':'';

			$delay		= ($delay == 0)?999:$delay;
			$slices		= ($slices)?$slices:7;
			$boxcols		= ($boxcols)?$boxcols:6;
			$boxrows		= ($boxrows)?$boxrows:2;
         
			$thumbs     = ($settings["s_thumbnail"]=='on')?"true":"false";
			$is_thumbnail_active    = ($settings["s_thumbnail"]=='on')?" active_thumbs":" deactive_thumbs";

			$out	 = '';
			$out	.= '<div class="nivo-wrapper'.$is_thumbnail_active.'" style="'.$space.'" ><div id="nivo-'.$get_slider->id.'" class="nivoSlider" data-slices="'.$slices.'" data-thumbs="'.$thumbs.'" data-boxcols="'.$boxcols.'" data-boxrows="'.$boxrows.'" data-speed="'.$delay.'000" data-effect="'.$effect.'"'.$border.'>';

			
			$str	 = '';
			foreach($get_slides as $item){

				
				$value		= unserialize($item->s_value);
				$image		= $value["s_image"];
				$tag   		= $item->s_name;
				$content		= $value["s_content"];

				$get_link   = $this->get_custom_link($value);

				$link_type		= $get_link['type'];
				$link_href		= $get_link['link'];
				$link_target	= $get_link['target'];

            
				$caption_id 	      = ($content)?' title="#htmlcaption'.$item->id.'"':'';
				$alt_tag             = ($tag)?' alt="'.$tag.'"':'';
				$image_src		      = ($timthumb == 'on')?get_the_image( 'url', $image, array($width,$height) ):$image;
				$image_src_thumb		= ($thumbnail == 'on')?" data-thumb=\"".get_the_image( 'url', $image, array($thumbnail_w,$thumbnail_h) )."\"":"";

				$str .= ( !empty($link_type) )?'<a href="'.$link_href.'"'.$link_target.'>':'';
				$str .= '<img src="'.$image_src.'" '.$caption_id.$alt_tag.$image_src_thumb.'/>';
				$str .= ( !empty($link_type) )?'</a>':'';
			}

			$out	.= $str;
			$out	.= '</div>';
			$out	.= '</div>';

			$contents  = '';
			foreach($get_slides as $item){
				$value	 	 = unserialize($item->s_value);
				$contents	.= ($value["s_content"])?'<div id="htmlcaption'.$item->id.'" class="nivo-html-caption">'.do_shortcode($value["s_content"]).'</div>':'';
			}
			$out	.= $contents;

			
			echo $out;
		}

		
		else if( $get_slider->s_id == 3) {

			
			$settings = unserialize($get_slider->c_value);

			$uri		= T_URI;
			$height	= ($settings["s_height"]+30);
			$width	= $settings["s_width"];
			$margin	= $settings["s_margin"];
			$sid		= $get_slider->id;

			
			wp_enqueue_script('swfobject');


			$js = '<script type="text/javascript">
	jQuery(window).load(function() {
		var flashvars = {};
		var params = {};
		flashvars.xml_file = "'.$uri.'/swf/flashmo/flashmoXML.php?id='.$sid.'";
		params.wmode = "transparent";
		swfobject.embedSWF("'.$uri.'/swf/flashmo/flashmo.swf", "flashmo'.$sid.'", "'.$width.'", "'.$height.'", "10", false, flashvars, params, false);
	});
</script>';

			$out	 = '';
			$out	.= $js;
			$out	.= '<div class="flashmo" style="margin:'.$margin.'px 0; width:'.$width.'px; height:'.$height.'px;">';
			$out	.= '<div id="flashmo'.$sid.'" style="margin:20px auto;"></div>';
			$out	.= '</div>';

         if( get_theme_option("advanced", "is_responsive") == 'on' ){
            $image_resp = unserialize($get_slides[0]->s_value);
            $src_resp = ( isset($settings["s_responsive"]) ) ? $settings["s_responsive"] : $image_resp['s_image'];
            echo '<div class="flashmo-responsive" style="margin:'.$margin.'px 0;"><span class="codeCover"></span><img src="'.get_the_image( 'url', $src_resp, array($width,$height) ).'"></div>';
         }
         
			echo $out;
		}

		
		else if( $get_slider->s_id == 4) {

			
			$settings = unserialize($get_slider->c_value);

			$uri		= T_URI;
			$margin	= $settings["s_margin"];
			$height	= ($settings["s_height"]+50)+($margin*2);
			$width	= $settings["s_width"];
			$sid		= $get_slider->id;
			
			wp_enqueue_script('swfobject');

			$js = '<script type="text/javascript">
	jQuery(window).load(function() {
		var flashvars = {};
		flashvars.cssSource = "'.$uri.'/swf/piecemaker/piecemaker.css";
		flashvars.xmlSource = "'.$uri.'/swf/piecemaker/piecemakerXML.php?id='.$sid.'";
		var params = {};
		params.play = "true";
		params.menu = "false";
		params.scale = "showall";
		params.wmode = "transparent";
		params.allowfullscreen = "true";
		params.allowscriptaccess = "always";
		swfobject.embedSWF("'.$uri.'/swf/piecemaker/piecemaker.swf", "piecemaker'.$sid.'", "'.$width.'", "'.$height.'", "10", null, flashvars, params, null);
	});
</script>';

			$out	 = '';
			$out	.= $js;
			$out	.= '<div class="piecemaker" style="width:'.$width.'px; height:'.$height.'px;">';
			$out	.= '<div id="piecemaker'.$sid.'"></div>';
			$out	.= '</div>';

         if( get_theme_option("advanced", "is_responsive") == 'on' ){
            $image_resp = unserialize($get_slides[0]->s_value);
            $src_resp = ( isset($settings["s_responsive"]) ) ? $settings["s_responsive"] : $image_resp['s_image'];
            echo '<div class="piecemaker-responsive" style="margin:'.$margin.'px 0;"><span class="codeCover"></span><img src="'.get_the_image( 'url', $src_resp, array($width,$height) ).'"></div>';
         }
         
			echo $out;
		}

      
		else if( $get_slider->s_id == 5) {

			
			wp_enqueue_script('jquery-kwicks');
			
			
			$settings = unserialize($get_slider->c_value);

			$height				= $settings["s_height"];
			$width				= $settings["s_width"];
			$timthumb			= $settings["s_timthumb"];
			$between				= ($get_count !=1 )?($get_count*60):0;
			$max_width			= ($width - $between);
			$margin				= ($settings["s_margin"])?' margin:'.$settings["s_margin"].'px 0;':'';

			$out	 = '';
			$out	.= '<ul id="kwicks-'.$get_slider->id.'" class="kwicks" data-max="'.$max_width.'" data-width="'.$width.'" style="width:'.$width.'px; height:'.$height.'px;'.$margin.'">';

			
			$i=0;
			$output   = '';
			foreach($get_slides as $item){


				$value = unserialize($item->s_value);

            $get_link      = $this->get_custom_link($value);
				$link_type		= $get_link['type'];
				$link_href		= $get_link['link'];
				$link_target	= $get_link['target'];
            
            
				$last     = ($i==$get_count-1)?' last':'';
				$content  = (@$value['s_content'])?'<div class="kw_desc" style="width:'.$max_width.'px;"><div class="kw_desc_inside">'.do_shortcode($value['s_content']).'</div></div>':'';
				$title    = ($item->s_name)?'<div class="kw_title">'.$item->s_name.'</div>':'';

				$image_src		= ($timthumb == 'on')?get_the_image( 'url', $value['s_image'], array($width,$height) ):$value['s_image'];

				$output  .= '<li class="kwick'.$last.'">';
				$output  .= '<div class="kw_shadow"></div>';
				$output  .= $title;
				$output  .= $content;
				$output  .= '<div class="kw_img">';
            $output  .= ( !empty($link_type) )?'<a href="'.$link_href.'"'.$link_target.'>':'';
				$output  .= '<img src="'.$image_src.'" alt="'.$item->s_name.'" width="'.$width.'" height="'.$height.'"/>';
				$output  .= ( !empty($link_type) )?'</a>':'';
				$output  .= '</div>';
				$output  .= '</li>';
            
				$i++;
			}
         
			$out	.= $output;
			$out	.= '</ul>';
         
         if( get_theme_option("advanced", "is_responsive") == 'on' ){
            $image_resp = unserialize($get_slides[0]->s_value);
            $src_resp = ( isset($settings["s_responsive"]) ) ? $settings["s_responsive"] : $image_resp['s_image'];
            echo '<div class="kwicks-responsive" style="'.$margin.'"><span class="codeCover"></span><img src="'.get_the_image( 'url', $src_resp, array($width,$height) ).'"></div>';
         }
         
			echo $out;
		}

		
		else if( $get_slider->s_id == 6) {

			
			wp_enqueue_script('jquery-codeslide');
			
			
			$settings	= unserialize($get_slider->c_value);

			$height		= $settings["s_height"];
			$width		= $settings["s_width"];
			$delay		= $settings["s_delay"];
			$autoplay	= (!$delay)?'false':'true';
			$buttons		= ($settings["s_nav"] == 'on')?'true':'false';
			$sid			= $get_slider->id;
			$timthumb	= $settings["s_timthumb"];
			$margin		= ($settings["s_margin"])?' margin:'.$settings["s_margin"].'px 0;':'';
			$border		= ($settings["s_border"]=='on')?'<span class="codeCover"></span>':'';

			$out	 = '';
			$out	.= '<div id="codeslide_'.$sid.'" class="cslider" data-delay="'.$delay.'000" data-autoplay="'.$autoplay.'" data-buttons="'.$buttons.'" data-width="'.$width.'" data-height="'.$height.'" style="width:'.$width.'px; height:'.$height.'px;'.$margin.'">';
			$out	.= '<div class="csliders">';
			$out	.= $border;
			$out	.= '<ul>';

			$output   = '';
			foreach($get_slides as $item){


				$value = unserialize($item->s_value);

				$content  = (@$value['s_content'])?'<div class="cslider_content">'.do_shortcode(@$value['s_content']).'</div>':'';

				$get_link = $this->get_custom_link($value);

				$link_type		= $get_link['type'];
				$link_href		= $get_link['link'];
				$link_target	= $get_link['target'];

				$link_content  = ( !empty($link_type) )?'<a href="'.$link_href.'"'.$link_target.'>':'';
				$link_content_end  = ( !empty($link_type) )?'</a>':'';

				$image_src		= ($timthumb == 'on')?get_the_image( 'url', $value['s_image'], array($width,$height) ):$value['s_image'];

				$output  .= '<li>';
				$output  .= $content;
				$output  .= $link_content.'<img src="'.$image_src.'" alt="'.$item->s_name.'"/>'.$link_content_end;
				$output  .= '</li>';

			}

			$out	.= $output;
			$out	.= '</ul>';
			$out	.= '</div></div>';

         if( get_theme_option("advanced", "is_responsive") == 'on' ){
            $image_resp = unserialize($get_slides[0]->s_value);
            $src_resp = ( isset($settings["s_responsive"]) ) ? $settings["s_responsive"] : $image_resp['s_image'];
            echo '<div class="cslider-responsive" style="'.$margin.'"><span class="codeCover"></span><img src="'.get_the_image( 'url', $src_resp, array($width,$height) ).'"></div>';
         }
         
         echo $out;
		}
      
      else if( $get_slider->s_id == 7) {

			wp_enqueue_script('jquery-flexslider');
			$settings	= unserialize($get_slider->c_value);

         $height		   = $settings["s_height"];
			$width		   = $settings["s_width"];
			$effect		   = $settings["s_effect"];
			$delay		   = $settings["s_delay"].'000';
			$autoplay	   = ($settings["s_autoplay"] == 'on')?'true':'false';
			$controlnav	   = ($settings["s_controlnav"] == 'on')?'true':'false';
			$directionnav  = ($settings["s_directionnav"] == 'on')?'true':'false';
         $margin		   = ($settings["s_margin"])?' style="margin:'.$settings["s_margin"].'px 0;"':'';
         $border		   = ($settings["s_border"]=='on')?'<span class="codeCover"></span>':'';
			$timthumb	   = $settings["s_timthumb"];


         
         $out   =  '<div class="flex-wrapper"'.$margin.'>';
         $out  .=  '<div class="flexslider" data-flex-cnav="'.$controlnav.'" data-flex-dnav="'.$directionnav.'" data-flex-effect="'.$effect.'" data-flex-autoplay="'.$autoplay.'" data-flex-delay="'.$delay.'">'.$border;
         $out  .=  '<ul class="slides">';
         

         
         foreach($get_slides as $item){

				$value = unserialize($item->s_value);
            
            $content_posistion  = ( isset($value['s_content_position']) )?strtolower($value['s_content_position']):'bottom-right';

            $content  = (@$value['s_content'])?'<div class="flex-content '.$content_posistion.'">'.do_shortcode(@$value['s_content']).'</div>':'';
         
				$get_link = $this->get_custom_link($value);

				$link_type		= $get_link['type'];
				$link_href		= $get_link['link'];
				$link_target	= $get_link['target'];

				$link_content  = ( !empty($link_type) )?'<a href="'.$link_href.'"'.$link_target.'>':'';
				$link_content_end  = ( !empty($link_type) )?'</a>':'';

				$image_src		= ($timthumb == 'on')?get_the_image( 'url', $value['s_image'], array($width,$height) ):$value['s_image'];

				$out  .= '<li>';
				$out  .= $link_content.'<img src="'.$image_src.'" alt="'.$item->s_name.'"/>'.$link_content_end;
				$out  .= $content;
				$out  .= '</li>';
            
         }
         
         $out  .=  '</ul>';
         $out  .=  '</div>';
         $out  .=  '</div>';
         
         echo $out;
         
?>

<?php  

		}

		if($get_slider->s_id != 1 && $nosc == false){
			echo '</div></div>';
		}
		
		return ob_get_clean();

   }

   function home_intro(){
      $content  = '';
      $content .= '<div id="intro"><div class="inner">';
      $content .= apply_filters('the_content', stripslashes( get_theme_option("homepage", "intro_content") ));
      $content .= '</div></div>';
      return $content;
   }
	
   function home_content(){

		$home_widgets		= '';
      $content				= '';
      $option_sidebar	= get_theme_option('homepage','home_page_layout');
      $frontpage_id		= get_option('page_on_front');

		
      if( !empty($frontpage_id) ){
         $home_page_id	= $frontpage_id;
      } else {
         $home_page_id	= get_theme_option('homepage','home_page');
      }
		
		$home_page_id		= apply_filters('home_layout', $home_page_id);
		$option_sidebar	= apply_filters('home_sidebar', $option_sidebar);
      
      if( is_blog($home_page_id) ){
			global $post;
			$post->ID = $home_page_id;
         ob_start();
			require_once(T_PATH . "/template-blog.php");
			return ob_get_clean();
      }else if( is_portfolio($home_page_id) ){
			global $post;
			$post->ID = $home_page_id;
			ob_start();
			require_once(T_PATH . "/template-portfolio.php");
			return ob_get_clean();
      }

      
      if( $home_page_id ){

         $get_page         = &get_page($home_page_id);
         $home_content     = $get_page->post_content;
         $options          = get_post_meta($get_page->ID, '_post_options', true);
			$page_sidebar     = @$options["sidebar"];
         $widget_sidebar   = @$options["widget_sidebar"];

      } else {
         $home_content = get_theme_option("homepage", "home_content");
      }

      if( !empty( $option_sidebar ) ){
         $home_sidebar = $option_sidebar;
      } else {
         $home_sidebar = $page_sidebar;
      }

      
      if($home_sidebar =='right'){ $sidebar = ' sidebar-right'; } else if( $home_sidebar == 'left'){ $sidebar = ' sidebar-left'; } else { $sidebar = ''; }
      if($home_sidebar == 'left' || $home_sidebar == 'right') { 
			
			ob_start();
			if( !empty( $option_sidebar ) ) {
				dynamic_sidebar('homepage'); 
			} else if( !empty( $widget_sidebar ) ) { 
				dynamic_sidebar($widget_sidebar);
			} else {
				dynamic_sidebar('page');
			}
			$home_widgets = ob_get_clean();
			$home_widgets	= $home_widgets?'<div id="sidebar">'.$home_widgets.'</div>':'';
		}

      $content .= '<div id="content"><div class="inner'.$sidebar.'"><div id="main">';
      $content .= apply_filters('the_content', stripslashes( $home_content ));
      $content .= '</div>'.$home_widgets.'</div></div>';
		
		return $content;

   }

   function footer_widgets(){

      $get_widgets = get_theme_option('footer', 'footer_widget_model');

      if( !empty( $get_widgets ) ) {

         switch ($get_widgets) {

            case 'model1':
               $widget  = array("piece" => 1, "class" => "width100");
            break;

            case 'model2':
               $widget  = array("piece" => 2, "class" => "one_half");
            break;

            case 'model3':
               $widget  = array("piece" => 3, "class" => "one_third");
            break;

            case 'model4':
               $widget  = array("piece" => 4, "class" => "one_fourth");
            break;

            case 'model5':
               $widget  = array("piece" => 5, "class" => "one_fifth");
            break;

            case 'model6':
               $widget  = array("piece" => 6, "class" => "one_sixth");
            break;

            case 'model7':
               $widget  = array("piece" => 3, "class" => "one_fourth", "featured" => "one_half", "queue" => 1);
            break;

            case 'model8':
               $widget  = array("piece" => 3, "class" => "one_fourth", "featured" => "one_half", "queue" => 3);
            break;

            case 'model9':
               $widget  = array("piece" => 3, "class" => "one_fourth", "featured" => "one_half", "queue" => 2);
            break;

            case 'model10':
               $widget  = array("piece" => 3, "class" => "one_sixth", "featured" => "two_third", "queue" => 1);
            break;

            case 'model11':
               $widget  = array("piece" => 3, "class" => "one_sixth", "featured" => "two_third", "queue" => 3);
            break;

            case 'model12':
               $widget  = array("piece" => 3, "class" => "one_sixth", "featured" => "two_third", "queue" => 2);
            break;

            case 'model13':
               $widget  = array("piece" => 4, "class" => "one_fifth", "featured" => "two_fifth", "queue" => 4);
            break;

            case 'model14':
               $widget  = array("piece" => 4, "class" => "one_fifth", "featured" => "two_fifth", "queue" => 1);
            break;

            case 'model15':
               $widget  = array("piece" => 4, "class" => "one_sixth", "featured" => "one_half", "queue" => 1);
            break;

            case 'model16':
               $widget  = array("piece" => 4, "class" => "one_sixth", "featured" => "one_half", "queue" => 4);
            break;

         }

         dynamic_sidebar('footer_widget_before');

         for($i = 1; $i < $widget["piece"]+1; $i++){

            if( $i == $widget["piece"] ){ $last = ' last'; }else{ $last = ''; }

            if( isset($widget["queue"]) && $widget["queue"] == $i ){
               $class = $widget["featured"];
            }else{
               $class = $widget["class"];
            }

            echo '<div class="'.$class.$last.'">';
            dynamic_sidebar("sidebar_footer_widget_".$i);
            echo '</div>';

         }
         
         dynamic_sidebar('footer_widget_after');


      }

   }

   function sidebar_widgets($post_id){

      
      if( is_page() || ( function_exists( 'is_bbpress' ) && is_bbpress() ) ){
			$sidebar = "page";
		}

      
      if( is_home() ){
			$sidebar = "home";
		}

      if( is_blog() || is_single() ){
			$sidebar	= "blog";
		}

      
      if(!empty($post_id)){
		
			$custom = get_post_meta($post_id, '_post_options', true);

         if(!empty($custom["widget_sidebar"])){
				$sidebar = $custom["widget_sidebar"];
			}

		}

      if(isset($sidebar)){
			dynamic_sidebar($sidebar);
		}

   }
   
   function is_footer_included(){
      if( get_theme_option('footer', 'footer_widget_area') == 'off' ) { return false; }
      else if( is_active_sidebar('sidebar_footer_widget_1') ){ return true; }
      else if( is_active_sidebar('sidebar_footer_widget_2') ){ return true; }
      else if( is_active_sidebar('sidebar_footer_widget_3') ){ return true; }
      else if( is_active_sidebar('sidebar_footer_widget_4') ){ return true; }
      else if( is_active_sidebar('footer_widget_before') || is_active_sidebar('footer_widget_after') ){ return true; }
      else{ return false; }
   }

	function post_meta(){
		
		global $post;
		
		$out	 = '';
		$out	.= '<span>'.__('on ', T_NAME).'<a href="'.get_month_link(get_the_time('Y'), get_the_time('m')).'">'.get_the_date().'</a></span>';
		$out	.= '<span>'.sprintf( __('in %s', T_NAME), get_the_category_list(', ') ).'</span>';
		
		if( get_theme_option('blog', 'blog_post_tags') != 'off' ){
			$out	.= '<span>'.get_the_tag_list(__('tags: ', T_NAME),', ').'</span>';
		}
		
		if( ( $post->comment_count > 0 || comments_open() ) && get_theme_option("advanced", "comment_post") == "on" ){
			ob_start();
			comments_popup_link(__('No Comments',T_NAME), __('1 Comment',T_NAME), __('% Comments',T_NAME),'');
			$out	.= '<span clasS="">'.__('with ', T_NAME).ob_get_clean().'</span>';
		}

		return $out;
	}

   /* creating blog featured image */
   function blog_featured_image($page_layout='', $image_layout, $size=null){

	 	$post_id = get_the_id();
		$options = get_post_meta($post_id, '_post_options', true);
		$type = @$options["_post_type"];

		if($type == 'custom'){ return do_shortcode($options["_post_type_custom"]); }
      if (!has_post_thumbnail()){ return ''; }

		$image_src_array = wp_get_attachment_image_src(get_post_thumbnail_id(),'full', true);

      if($page_layout == 'full' || $page_layout == ''){
			$width = 948;
		}else if(is_numeric($page_layout)){
         $width = $page_layout;
      }else{
         $width = 618;
      }

		$align = ' ';
      
		if($image_layout=='left' || $image_layout=='right'){

		if(is_numeric($page_layout)){
         $width = $page_layout;
		}else{
         $width = get_theme_option('blog', 'blog_image_width');
		}
         $height = get_theme_option('blog', 'blog_image_height');
         $align = ' align'.$image_layout;
      }else if(is_numeric($image_layout)){
         $height = $image_layout;
      }else{
         $height  = get_theme_option('blog', 'blog_fixed_height');
      }

		if( !empty($size) ){ $height = $size; }
      
		$post_title = get_the_title($post_id);
      $thumb_src = get_the_image( 'id', get_post_thumbnail_id(), array($width,$height) );

      switch($type){

         case 'image':
            $image 		= @$options["_post_lightbox_image"];
            $image_src 	= ($image)?$image:$image_src_array[0];
            $output  	= '<a href="'.$image_src.'" class="imageborder icon_'.$type.$align.'" rel="prettyPhoto[group]"><img src="'.$thumb_src.'" alt="'.$post_title.'" width="'.$width.'" height="'.$height.'"/></a>';
         break;

         case 'video':
            $video         = @$options["_post_lightbox_video"];
            $video_width   = @$options["_post_lightbox_video_width"];
            $video_width	= ($video_width)?$video_width:800;
            $video_height  = @$options["_post_lightbox_video_height"];
            $video_height	= ($video_height)?$video_height:480;
            $video_src     = ($video)?$video.'?&amp;width='.$video_width.'&amp;height='.$video_height:$image_src_array[0];
            $output        = '<a href="'.$video_src.'" class="imageborder icon_'.$type.$align.'" rel="prettyPhoto[group]"><img src="'.$thumb_src.'" width="'.$width.'" height="'.$height.'"/></a>';
         break;

         case 'link':
            $get_link = $this->get_custom_link($options);
            $link_href		= @$get_link['link'];
            $link_target	= @$get_link['target'];
            $output  = '<a href="'.$link_href.'" class="imageborder icon_'.$type.$align.'"'.$link_target.'><img src="'.$thumb_src.'" width="'.$width.'" height="'.$height.'"/></a>';
         break;

         case 'document':
            $link_type        = @$options["_post_document"];
            $link_page        = @$options["_post_doc_page"];
            $link_category    = @$options["_post_doc_category"];
            $link_post        = @$options["_post_doc_post"];
            $link_custom      = @$options["_post_doc_custom"];
            $link_target      = @$options["_post_doc_target"];
            if($link_type == 'page' && !empty($link_page)){
               $link_href = get_page_link($link_page);
            }else if($link_type == 'category' && !empty($link_category)){
               $link_href = get_category_link($link_category);
            }else if($link_type == 'post' && !empty($link_post)){
               $link_href = get_permalink($link_post);
            }else if($link_type == 'custom'){
               $link_href = $link_custom;
            }
            $link_target = ($link_target)?' target="'.$link_target.'"':'';
            $output  = '<a href="'.$link_href.'" class="imageborder icon_'.$type.$align.'"'.$link_target.'><img src="'.$thumb_src.'" width="'.$width.'" height="'.$height.'"/></a>';
         break;
         
         case 'lightbox':
            $lightbox_href       = @$options["_post_lightbox_href"];
            $lightbox_icon       = @$options["_post_lightbox_icon"];
            $lightbox_icon       = ($lightbox_icon)?$lightbox_icon:$type;
            $lightbox_content    = @$options["_post_lightbox_content"];
            $lightbox_width      = @$options["_post_lightbox_content_width"];
            $lightbox_width		= ($lightbox_width)?$lightbox_width:800;
            $lightbox_height     = @$options["_post_lightbox_content_height"];
            $lightbox_height		= ($lightbox_height)?$lightbox_height:480;
            $lightbox_src        = ($lightbox_href)?$lightbox_href.'?iframe=true&amp;width='.$lightbox_width.'&amp;height='.$lightbox_height:'';
            $lightbox_src        = ($lightbox_content)?'#inline-'.$post_id:$lightbox_src;

            $output  = '<a href="'.$lightbox_src.'" class="imageborder icon_'.$lightbox_icon.$align.'" rel="prettyPhoto[inline]"><img src="'.$thumb_src.'" width="'.$width.'" height="'.$height.'"/></a>';

            if( !empty($lightbox_content)){
               $output .= '<div id="inline-'.$post_id.'" data-width="'.$lightbox_width.'" data-height="'.$lightbox_height.'" class="inhide">'.$lightbox_content.'</div>';
            }
         break;
         
         default:
            $is_featured = get_theme_option('blog', 'blog_featured_lightbox');
            if(  empty($is_featured) || $is_featured == 'off' ){
                  $output  = '<a href="'.get_permalink().'" title="'.sprintf( __("Permanent Link to %s", T_NAME), $post_title ).'" class="imageborder icon_document'.$align.'"><img src="'.$thumb_src.'" alt="'.$post_title.'" width="'.$width.'" height="'.$height.'"/></a>';
            }else{
                  $output  = '<a href="'.$image_src_array[0].'" class="imageborder icon_image'.$align.'" rel="prettyPhoto[group]" title="'.$post_title.'"><img src="'.$thumb_src.'" alt="'.$post_title.'" width="'.$width.'" height="'.$height.'"/></a>';
            }
            if( is_single() ){
               $is_lightbox  = get_theme_option('blog', 'blog_single_featured_lightbox');
               if($is_lightbox == 'off'){
                  $output  = '<img src="'.$thumb_src.'" alt="'.$post_title.'" class="imageborder'.$align.'" width="'.$width.'" height="'.$height.'"/>';
               }else{
                  $output  = '<a href="'.$image_src_array[0].'" class="imageborder icon_image'.$align.'" rel="prettyPhoto[group]" title="'.$post_title.'"><img src="'.$thumb_src.'" alt="'.$post_title.'" width="'.$width.'" height="'.$height.'"/></a>';
               }
            }
         break;
      }
      
      return $output;
      
   }
   
   /* creating portfolio featured image */
   function portfolio_featured_image($page_layout='', $column_height='', $image_height=''){

		$post_id = get_the_id();
		$options = get_post_meta($post_id, '_post_options', true);
		$type 	= @$options["_post_type"];

		if($type == 'custom'){
			$output   = do_shortcode($options['_post_type_custom']);
			$output  .= '<div class="clear"></div>';
			return $output;
		}
      
      if (!has_post_thumbnail()){ return ''; }

		$image_src_array = wp_get_attachment_image_src(get_post_thumbnail_id(),'full', true);

      if($page_layout == 'full' || $page_layout == ''){
			$width = 948;
		}else if(is_numeric($page_layout)){
         $width = $page_layout;
		}else{
         $width = 630;
      }

      if( is_numeric ($image_height) ){
         $height = $image_height;
      } else if( is_single() ){
         $height = get_theme_option('portfolio', 'portfolio_single_height');
      } else {
         $height = get_theme_option('portfolio', 'portfolio_height_'.$column_height);
      }

      $thumb_src = get_the_image( 'id', get_post_thumbnail_id(), array($width,$height) );
      
      if(is_single()){
         return '<img class="imageborder" src="'.$thumb_src.'" width="'.$width.'" height="'.$height.'"/>';
      } else {

			$post_title = get_the_title($post_id);

         switch($type){

            case 'image':
               $image = $options["_post_lightbox_image"];
               $image_src = ($image)?$image:$image_src_array[0];
               $output  = '<a href="'.$image_src.'" class="imageborder icon_'.$type.'" rel="prettyPhoto[group]"><img src="'.$thumb_src.'" alt="'.$post_title.'" width="'.$width.'" height="'.$height.'"/></a>';
            break;

            case 'video':
               $video         = $options["_post_lightbox_video"];
               $video_width   = $options["_post_lightbox_video_width"];
					$video_width	= ($video_width)?$video_width:800;
               $video_height  = $options["_post_lightbox_video_height"];
					$video_height	= ($video_height)?$video_height:480;
               $video_src = ($video)?$video.'?&amp;width='.$video_width.'&amp;height='.$video_height:$image_src_array[0];
               $output  = '<a href="'.$video_src.'" class="imageborder icon_'.$type.'" rel="prettyPhoto[group]"><img src="'.$thumb_src.'" width="'.$width.'" height="'.$height.'"/></a>';
            break;

            case 'link':
               $link_type        = $options["_post_link"];
               $link_page        = $options["_post_link_page"];
               $link_category    = $options["_post_link_category"];
               $link_post        = $options["_post_link_post"];
               $link_custom      = $options["_post_link_custom"];
               $link_target      = $options["_post_link_target"];

               if($link_type == 'page' && !empty($link_page)){
                  $link_href = get_page_link($link_page);
               }else if($link_type == 'category' && !empty($link_category)){
                  $link_href = get_category_link($link_category);
               }else if($link_type == 'post' && !empty($link_post)){
                  $link_href = get_permalink($link_post);
               }else if($link_type == 'custom'){
                  $link_href = $link_custom;
               }

               $link_target = ($link_target)?' target="'.$link_target.'"':'';
               $output  = '<a href="'.$link_href.'" class="imageborder icon_'.$type.'"'.$link_target.'><img src="'.$thumb_src.'" width="'.$width.'" height="'.$height.'"/></a>';
            break;

            case 'document':
               $link_type        = $options["_post_document"];
               $link_page        = $options["_post_doc_page"];
               $link_category    = $options["_post_doc_category"];
               $link_post        = $options["_post_doc_post"];
               $link_custom      = $options["_post_doc_custom"];
               $link_target      = $options["_post_doc_target"];

               if($link_type == 'page' && !empty($link_page)){
                  $link_href = get_page_link($link_page);
               }else if($link_type == 'category' && !empty($link_category)){
                  $link_href = get_category_link($link_category);
               }else if($link_type == 'post' && !empty($link_post)){
                  $link_href = get_permalink($link_post);
               }else if($link_type == 'custom'){
                  $link_href = $link_custom;
               }

               $link_target = ($link_target)?' target="'.$link_target.'"':'';
               $output  = '<a href="'.$link_href.'" class="imageborder icon_'.$type.'"'.$link_target.'><img src="'.$thumb_src.'" width="'.$width.'" height="'.$height.'"/></a>';
            break;

            case 'lightbox':
               $lightbox_href       = $options["_post_lightbox_href"];
               $lightbox_icon       = $options["_post_lightbox_icon"];
               $lightbox_icon       = ($lightbox_icon)?$lightbox_icon:$type;
               $lightbox_content    = $options["_post_lightbox_content"];
               $lightbox_width      = $options["_post_lightbox_content_width"];
					$lightbox_width		= ($lightbox_width)?$lightbox_width:800;
               $lightbox_height     = $options["_post_lightbox_content_height"];
					$lightbox_height		= ($lightbox_height)?$lightbox_height:480;
               $lightbox_src        = ($lightbox_href)?$lightbox_href.'?iframe=true&amp;width='.$lightbox_width.'&amp;height='.$lightbox_height:'';
               $lightbox_src        = ($lightbox_content)?'#inline-'.$post_id:$lightbox_src;

               $output  = '<a href="'.$lightbox_src.'" class="imageborder icon_'.$lightbox_icon.'" rel="prettyPhoto[inline]"><img src="'.$thumb_src.'" width="'.$width.'" height="'.$height.'"/></a>';

               if( !empty($lightbox_content)){
                  $output .= '<div id="inline-'.$post_id.'" data-width="'.$lightbox_width.'" data-height="'.$lightbox_height.'" class="inhide">'.$lightbox_content.'</div>';
               }
            break;

            default:
               $output  = '<a href="'.$image_src_array[0].'" class="imageborder icon_image" rel="prettyPhoto[group]" title="'.$post_title.'"><img src="'.$thumb_src.'" alt="'.$post_title.'" width="'.$width.'" height="'.$height.'"/></a>';
            break;
         }
         
         return $output;
         
      }

   }

   function page_top($args=null){

      if( get_theme_option('advanced', 'page_top') == "off" || is_home() || is_front_page() ){
         return;
      }

		$custom_css = @$args['_intro_bg'] ?' style="'.$args['_intro_bg'].'"':'';

      ob_start();
      ?>
      <div id="page-top"<?php echo $custom_css; ?>>
         <div class="inner">
            <?php
               $title	= '';
               $output	= '';
               $text		= '';
               
               if ( is_singular() ) {
                  $title = get_the_title();
               }

               if (is_archive()){
                  $title = __('Archives', T_NAME);
                  if (is_category()) {
                     $title = __( 'Category Archives for ', T_NAME ) . single_cat_title('',false);
                  }elseif(is_tag()){
                     $title = __( 'Tag Archives for ', T_NAME ) . single_tag_title('',false);
                  }elseif(is_day()){
                     $title = __( 'Daily Archives for ', T_NAME ) . get_the_date('F d, Y');
                  }elseif(is_month()){
                     $title = __( 'Monthly Archives for ', T_NAME ) . get_the_date('F Y');
                  }elseif(is_year()){
                     $title = __( 'Yearly Archives for ', T_NAME ) . get_the_date('Y');
                  }elseif(is_author()){
                     global $wp_query;
                     $title = __( 'Archives by ', T_NAME ) . get_the_author_meta( 'display_name', $wp_query->post->post_author );
                  }
               }
               
               /* If bbPress is installed and we're on a bbPress page. */
               if ( function_exists( 'is_bbpress' ) && is_bbpress() ){  
                  $title = bbp_title('', false);
               }
               
               if ( is_404() ) {
                  $title = __( 'Page Not Found', T_NAME );
                  $text  = '';
                  $title = stripslashes($title);
                  $text  = stripslashes($text);
               }

               if ( is_search() ) {
                  $title = __( 'Search results for "', T_NAME ) . stripslashes( strip_tags( get_search_query() ) ) . '"';
                  $text  = '';
                  $text  = stripslashes($text);
               }

               if ( isset($title) && ( @$args["_intro_type"] == 'title' || @$args["_intro_type"] == null || @$args["_intro_type"] == 'both' )  ) {
                  $output	.= '<h1 class="page-title">'.$title.'</h1>';
               }

               if( isset($text) || ( $args["_intro_type"] != 'title' && $args["_intro_type"] != null )  ) {
                  $output	.= '<div>'.do_shortcode(@$args['_teaser_content']).'</div>';
               }

               if( isset($text) ){
                  $output	.= $text;
               }

               echo @$output;

               if( ( get_theme_option('advanced', 'site_breadcrumbs') == 'on' && @$args['_breadcrumbs_page'] != 'off' ) ){ breadcrumbs_plus(); }
            ?>
         </div>
      </div>
      <?php
      return ob_get_clean();
   }

   /* get google fonts */
   function get_google_fonts(){

      $fonts = array();
      $the_fonts = array();

      $available_fonts = get_available_fonts();
      $the_fonts = $available_fonts["google"];

      $check_font = array(
         get_theme_option('font', 'font_family'),
         get_theme_option('font', 'top_menu_font_family'),
         get_theme_option('font', 'sub_menu_font_family'),
         get_theme_option('font', 'headings_font_family')
      );

		if( empty($check_font) ){ return; }
      
      foreach ($check_font as $font){
         if( in_array ( $font, $the_fonts ) && !empty($font)) {
            $fonts[] = $font;
         }
      }

		$fonts = array_unique($fonts);
		
      if( empty($fonts) ){
         return false;
      }else{
         return $fonts;
      }

   }


   function get_font_face_dir($font=null){

      $fonts = array();
      $dirs = @array_filter(glob(T_PATH.'/fonts/*'), 'is_dir');

		if( empty($dirs) ){ return; }
		
      foreach($dirs as $dir){
      
         $stylesheet = $dir.'/stylesheet.css';

         if(file_exists($stylesheet)){
            
            $file_content = file_get_contents($stylesheet);
            
            if( preg_match_all("/@font-face\s*{.*?font-family\s*:\s*('|\")(.*?)\\1.*?}/is", $file_content, $matchs) ){
               
               foreach($matchs[0] as $index => $css){
                  
                  $font_folder = basename($dir);
                  $fonts[$font_folder.'|'.$matchs[2][$index]] = array(
                     'folder' => $font_folder,
                     'name' => $matchs[2][$index],
                     'css' => $css,
                  );

               } 

            } 

         } 

      } 

      if( !empty($font) ){

         foreach( $fonts as $key => $val ){
            if( $val["name"] == $font ){  $css = str_replace("url('", "url('../fonts/".$val["folder"]."/",$val["css"]); }
         }
         
         return $css;

      }else{

         $font = array();
         foreach( $fonts as $key => $val ){
            $font[] = $val["name"];
         }
         return $font;
         
      }

   }

   function get_font_face_fonts(){

      $fonts = array();
      $the_fonts = array();
      $available_fonts = get_available_fonts();
      $the_fonts = $available_fonts["@font-face"];

      $check_font = array(
         get_theme_option('font', 'font_family'),
         get_theme_option('font', 'top_menu_font_family'),
         get_theme_option('font', 'sub_menu_font_family'),
         get_theme_option('font', 'headings_font_family')
      );

		if( empty($check_font) ){ return; }
		
      foreach ($check_font as $val){
         if( in_array ( $val, $the_fonts ) && !empty($val)) {
            $fonts[] = $val;
         }
      }

		$fonts = array_unique($fonts);
		
      $str = '';
      foreach( $fonts as $key=>$val){
         $str .= $this->get_font_face_dir($val);
      }

      if( empty($str) ){
         return false;
      }else{
         return $str;
      }

   }

	function get_custom_link($value){

		$out = array();

		$link_type        = @$value["_post_link"];
		$link_page        = @$value["_post_link_page"];
		$link_category    = @$value["_post_link_category"];
		$link_post        = @$value["_post_link_post"];
		$link_custom      = @$value["_post_link_custom"];
		$link_target      = @$value["_post_link_target"];

		if($link_type == 'page' && !empty($link_page)){
			$link_href = get_page_link($link_page);
		}else if($link_type == 'category' && !empty($link_category)){
			$link_href = get_category_link($link_category);
		}else if($link_type == 'post' && !empty($link_post)){
			$link_href = get_permalink($link_post);
		}else if($link_type == 'custom'){
			$link_href = $link_custom;
		}else{
			$link_href = '';
		}

		$link_target = ($link_target)?' target="'.$link_target.'"':'';

		$out['type']	= $link_type;
		$out['link']	= $link_href;
		$out['target'] = $link_target;

		return $out;
	}
   
   // generate and choose slideshow
	function slideshow( $slider_id=null, $nosc=false ){
      if( is_numeric( $slider_id ) ){
         return $this->sliders( $slider_id, $nosc );
      } else if( is_string( $slider_id ) ){
         echo '<div id="slider">';
         putRevSlider($slider_id);
         echo '</div>';
      }
   }   
   
   function cstar(){
   
      if( get_theme_option("homepage", "home_slideshow") != "off" ){
         $home_slider_id   = apply_filters('slider_preview', get_theme_option("homepage", "home_page_slider"));
         $custom_slider    = get_theme_option('homepage', 'custom_slider');
         if( !empty( $custom_slider ) ){
            echo '<div id="slider">'.do_shortcode($custom_slider).'</div>'; 
         }else if( !empty( $home_slider_id ) ){
            echo $this->slideshow($home_slider_id);
         }else{
            echo '<div id="slider"><div class="inner"><div class="noslider"></div></div></div>';
         }
      }

      if( get_theme_option("homepage", "homepage_intro") != "off" ){
			echo get_theme_generator("home_intro");
		}
      
		echo get_theme_generator("home_content");
      
   }

} /* end of CodeStarFunctions Class */

} /* end of CodeStarFunctions Class if */

function get_theme_generator($function){
   global $cs_generator;
	if( !isset( $cs_generator ) ){
      $cs_generator = new CodeStarFunctions;
   }
   $args = array_slice( func_get_args(), 1 );
   return call_user_func_array(array( &$cs_generator, $function ), $args );
}