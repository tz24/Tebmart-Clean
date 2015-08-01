<?php
wpml_register_string( T_NAME , 'Header Widget Area Html Code', stripslashes(get_theme_option('general','header_area_html')));
wpml_register_string( T_NAME , 'Home Page Content', stripslashes(get_theme_option('homepage','home_content')));
wpml_register_string( T_NAME , 'Home Page Intro Content', stripslashes(get_theme_option('homepage','intro_content')));
wpml_register_string( T_NAME , 'Footer Copyright Text', stripslashes(get_theme_option('footer','copyright')));
wpml_register_string( T_NAME , 'Blog Read More Text', stripslashes(get_theme_option('blog','blog_read_more')));
wpml_register_string( T_NAME , 'Portfolio Read More Text', stripslashes(get_theme_option('portfolio','portfolio_read_more_text')));
wpml_register_string( T_NAME , 'Home Translate', stripslashes(get_theme_option('advanced','home_translate')));

/* Custom WPML Shortcode */
if( !function_exists('wpml_translate') ){
   function wpml_translate( $atts, $content = null ) {
      extract(shortcode_atts(array('lang' => ''), $atts));
      if($lang == ICL_LANGUAGE_CODE){ return do_shortcode($content); }
   }
   add_shortcode('wpml_translate', 'wpml_translate');
}
if( !function_exists('wpml_flags') ){
   function wpml_flags( $atts, $content = null ) {
      extract(shortcode_atts(array('name' => false), $atts));
      $languages = icl_get_languages('skip_missing=0&orderby=code');
      if(!empty($languages)){
         $content = '<div class="wpml_flags">';
         foreach($languages as $l){
            $name = ($name)?'<span>'. $l['translated_name'].'</span>':'';
            $is_active = ($l['active'])?' class="lang_active"':'';
            $content .= '<a href="'.$l['url'].'"'.$is_active.'>';
            $content .= '<img src="'.$l['country_flag_url'].'" alt="'.$l['language_code'].'"/>'.$name;
            $content .= '</a>';
         }
         $content  .= '</div>';
      }
      return $content;
   }
   add_shortcode('wpml_flags', 'wpml_flags');
}