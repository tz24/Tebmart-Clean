<?php
if ( !class_exists('CodeStarPlugins') ){

class CodeStarPlugins{

   function __construct(){
      
      require_once (T_PATH.'/'. F_REQ . '/plugins/cstar-resizer/cstar-resizer.php');

      if( !function_exists('breadcrumbs_plus') ){
         require_once (T_PATH.'/'. F_REQ . '/plugins/breadcrumbs-plus/breadcrumbs-plus.php');
      }
      
      if( !function_exists('wp_pagenavi') ){
         require_once (T_PATH.'/'. F_REQ . '/plugins/wp-pagenavi/wp-pagenavi.php');
      }
      
      if( !function_exists('dropdown_menu') ){
         require_once (T_PATH.'/'. F_REQ . '/plugins/dropdown-menus/dropdown-menus.php');
      }
      
      if( function_exists('icl_register_string') ){
         if( !function_exists('wpml_register_string') ){
            require_once (T_PATH.'/'. F_REQ . '/plugins/wpml-integration/wpml-integration.php');
         }
         require_once (T_PATH.'/'. F_REQ . '/plugins/wpml-integration/wpml-register-strings.php');
      }
      
      if( !function_exists('custom_woocommerce_output_content_wrapper') ){
         require_once (T_PATH.'/'. F_REQ . '/plugins/woocommerce-integration/woocommerce-integration.php');
      }
      
   }

} /* end of CodeStarPlugins Class */

} /* end of CodeStarPlugins Class if */