<?php
/* get theme option */
function get_theme_option($option, $name = NULL, $default = NULL) {
   global $base_options;
   
   if ($name == NULL) {
   
		if (isset($base_options[$option])) {
			return $base_options[$option];
		} else {
			return false;
		}
      
   } else if (isset($base_options[$option][$name])) {
   
      return $base_options[$option][$name];
      
   } else if ($default != NULL) {
   
      return $default;
      
   } else {
   
      return false;
      
   }
}

/* set theme option */
function set_theme_option($option, $name, $value = NULL) {
	global $base_options;
   $option_save = T_SN . '_' . $option;
   $base_options[$option][$name] = $value;
   update_option($option_save, $base_options[$option]);
}

/* del theme option */
function del_theme_option($option, $name, $inname = NULL) {
	global $base_options;
   $option_save = T_SN . '_' . $option;
   
   if( $inname == NULL ){
      unset( $base_options[$option][$name] );
   }else{
      unset( $base_options[$option][$name][$inname] );
   }
	update_option($option_save, $base_options[$option]);
}

/* get available fonts */
function get_available_fonts(){
   return include(T_PATH.'/'.F_REQ .'/fonts.php');
}

/* get available shortcodes */
function get_available_shortcodes($shortcode=null){
   return include(T_PATH.'/'.F_REQ .'/plugins/shortcoder/availables.php');
}
?>