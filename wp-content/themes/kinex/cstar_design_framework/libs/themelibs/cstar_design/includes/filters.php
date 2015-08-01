<?php
if ( !class_exists('CodeStarFilters') ){

class CodeStarFilters{

   /* run filters */
   function __construct(){

      /* active theme formatter */
      remove_filter('the_content', 'wpautop');
      remove_filter('the_content', 'wptexturize');

      add_filter('the_content', array(&$this, 'theme_formatter'), 99);
      add_filter('widget_text', array(&$this, 'theme_formatter'), 99);
      add_filter('widget_text', 'do_shortcode', 11);

		/* adding li-children */
		if( get_theme_option('general', 'menu_arrow') == 'on'){
			add_filter( 'page_css_class', array(&$this, 'add_parent_class'), 10, 4);
		}

      if( get_theme_option('advanced', 'add_lightbox') != 'off'){
         add_filter('the_content', array(&$this, 'add_prettyPhoto_rel'), 12);
         add_filter('widget_text', array(&$this, 'add_prettyPhoto_rel'), 12);
      }

   }

   function add_prettyPhoto_rel($content){

      global $post;
      $pattern       = "/<a(.*?)href=('|\")([^>]*).(bmp|gif|jpeg|jpg|png)('|\")(.*?)>(.*?)<\/a>/i";
      $replacement   = '<a$1href=$2$3.$4$5 rel="prettyPhoto['.$post->ID.']"$6>$7</a>';
      $content       = preg_replace($pattern, $replacement, $content);
      return $content;
      
   }

   /* add parent class */
	function add_parent_class( $classes, $page, $depth, $args ){
		if ( is_array($args) && isset($args['has_children']) && $args['has_children'] == true ){
		  $classes[] = 'li-children';
		}
		return $classes;
	}

   /* theme formatter function */
   function theme_formatter($content) {
      $new_content = '';
      $pattern_full = '{(\[raw\].*?\[/raw\])}is';
      $pattern_contents = '{\[raw\](.*?)\[/raw\]}is';
      $pieces = preg_split($pattern_full, $content, -1, PREG_SPLIT_DELIM_CAPTURE);

      foreach ($pieces as $piece) {
         if (preg_match($pattern_contents, $piece, $matches)) {
            $new_content .= $matches[1];
         } else {
            $new_content .= wptexturize(wpautop($piece));
         }
      }

      return $new_content;
   }

} /* end of CodeStarFilters Class */

} /* end of CodeStarFilters Class if */