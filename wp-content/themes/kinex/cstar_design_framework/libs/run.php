<?php
/* Running the Codestar Framework for CStar Design WordPress Theme... */
if ( !class_exists('CodeStarFramework') ){

class CodeStarFramework{

   /* starting with init */
   function init(){

      $this->options_save();
      $this->options_load();
		$this->functions_load();
		$this->options_render_load();
      $this->register_menu();

      /* theme supports */
      add_theme_support( 'post-thumbnails' );
      add_theme_support( 'automatic-feed-links' );
      add_theme_support( 'custom-background' );

      $this->sidebar_save();

      /* including js and css on admin panel */
      add_action('admin_print_scripts', array(&$this, 'add_admin_scripts') );
      add_action('admin_print_styles', array(&$this, 'add_admin_styles') );

      /* admin notices */
      add_action('admin_notices',  array(&$this,'theme_notices'));

      /* get custom classes */
      $this->actions    = new CodeStarActions();
      $this->filters    = new CodeStarFilters();
      $this->plugins    = new CodeStarPlugins();
   }

   /* including admin panel scripts */
   function add_admin_scripts(){
      wp_enqueue_script('media-upload');
      wp_enqueue_script('jquery-ui-slider');
      wp_enqueue_script('jquery-ui-widget');
      wp_enqueue_script('framework'  , T_URI .'/'.F_PATH.'/libs/js/libs.js');
   }

   /* including admin panel styles */
   function add_admin_styles(){
      wp_enqueue_style('thickbox');
      wp_enqueue_style('framework', T_URI.'/'.F_PATH.'/libs/css/libs.css');
   }

   /* register theme menus */
   function register_menu(){

      register_nav_menus( array(
         'primary' => __( 'Primary Navigation', T_NAME ),
         'footer' => __( 'Footer Navigation', T_NAME ),
         'sidebar' => __( 'Sidebar Navigation', T_NAME )
      ) );

   }

   /* option save and update function */
   function options_save(){

      $action  = @$_REQUEST["action"];
      $options = @$_REQUEST["options"];
      if( isset($options) ) {

         /* getting option group via get page */
         $option_group     = @$_GET["page"];

         if( empty( $option_group ) ){
            $option_group  = @$_REQUEST["option_group"];
         }

         switch($action){

            /* option save */
            case 'save':

               $opts = array();

               /* getting all of options */
               foreach($options as $key => $option) {

                  /* if option type not array */
                  if( !is_array( $option ) ){
                     $opts[$key] = stripslashes($option);
                  } else {

                     /* if option is array */
                     foreach($option as $op => $val){

                        $values = array();

                        /* if option inside is array */
                        foreach ($val as $k => $v){
                           if($v != ""){
                              $values[] =  $v;
                           }
                        }

                        /* get clean option value */
                        $opts[$op] = implode(",", $values);
                     }
                  }
               }

               /* updating option */
               update_option( $option_group, $opts );

            break;

            /* deleting option group */
            case 'reset':
               delete_option($option_group);
            break;

         } /* end of switch */

         /* combine activing when set an option */
         update_option("cacheCSS", "on");

      } /* end of operation if */

   }

   /* sidebar widget area save function */
   function sidebar_save(){

      $get_sidebars  = get_theme_option("cstar_custom", "sidebars");
      $new_sidebar   = @$_REQUEST["options"]["add_sidebar"];

      if( empty( $get_sidebars ) ){ $get_sidebars = array(); }

      if( !empty($new_sidebar) ){

         $add_sidebar = array( $this->nice_name($new_sidebar) => stripslashes($new_sidebar));
         $all_sidebars = array_merge($get_sidebars, $add_sidebar);
         set_theme_option( "cstar_custom", "sidebars", $all_sidebars );
         $get_sidebars  = $all_sidebars;

      }

      $remove_sidebar   = @$_REQUEST["rmv_sdbr"];
      if( !empty($remove_sidebar) ){
         del_theme_option("cstar_custom", "sidebars", $remove_sidebar);
      }

   }

   /* load all of options */
   function options_load(){

      global $base_options, $option_groups;

      /* custom options join on general groups */
      array_push($option_groups, 'cstar_custom');

      /* creating base option array */
      $base_options = array();

      foreach ($option_groups as $option_group) {

         $get_options = get_option(T_SN.'_'.$option_group);

         /* if have options in DB */
         if ( !empty($get_options) ) {

            $base_options[$option_group] = $get_options;

         } else {
            /* if have not options in DB use cache options for defaults */
            $this->options_reset($option_group);
         }

      }

		/* $this->get_cache(); */
      return $base_options;

   }

   /* getting cache options for defaults */
	function get_cache(){

		global $base_options;

		$option_now = str_replace('cs_', '', $_GET['page']);

		if( isset( $base_options[$option_now] ) ) {
			foreach($base_options[$option_now] as $key=>$val){
				$base_options[$option_now][$key] = str_replace(T_URI.'/', '[path]/', $base_options[$option_now][$key]);
			}
			echo "<br><br>&#36;string = '".$this->options_encode($base_options[$option_now])."';<br />";
		}else{
			echo "<br><br>There is not any options...";
		}

	}

   /* encoding option contents */
	function options_encode( $content ) {
		return rtrim(strtr(base64_encode(gzdeflate(htmlspecialchars(serialize( $content )), 9)), '+/', '-_'), '=');
	}

   /* decoding option contents */
	function options_decode( $content ) {
		$decode = @gzinflate(base64_decode(strtr( $content, '-_', '+/')));
		return unserialize(htmlspecialchars_decode( $decode ) );
	}

   /* option reset function */
   function options_reset($option_group){

      global $base_options;

		$string = include(T_PATH ."/". F_REQ . "/option_cache.php");
		if(!$string){ return ''; }

      $base_options[$option_group] = $this->options_decode($string);

		if( empty( $base_options[$option_group] ) ){
			return '';
		}

      foreach($base_options[$option_group] as $key=>$val){
			$base_options[$option_group][$key] = str_replace('[path]', T_URI, $base_options[$option_group][$key]);
		}

   }

   /* including framework functions */
   function functions_load(){
      require_once (T_PATH .'/'. F_PATH . '/libs/functions.php');
   }

   /* admin panel notices */
   function theme_notices(){

      global $wp_version;
      $noties = array();

      /* check wordpress version */
      if( !version_compare( $wp_version, '3.0', '>=' ) ){
         $notices[] = 'Your Wordpress version('.$wp_version.') is too low. Please upgrade to 3.4+';
      }

      /* cache file permission check */
      if(!is_writeable(C_PATH)){
         $notices[]= 'The <b>CACHE</b> folder ( /'.str_replace( ABSPATH, '', C_PATH ).' ) is not writeable. Please set <b>CHMOD 777</b>';
         set_theme_option("cstar_design", "combineTO", "off");
      }

      /* cache images file permission check */
      if(!is_writeable(C_PATH.'/images')){
         $notices[]= 'The <b>CACHE</b> folder ( /'.str_replace( ABSPATH, '', C_PATH.'/images' ).' ) is not writeable. Please set <b>CHMOD 777</b>';
      }

      /* print notices */
      if( !empty($notices) ){

         $out = "<div class='error'>";
         foreach($notices as $key => $notice){
            $out  .= "<p>".($key+1).") ".$notice."</p>";
         }
         $out  .= "</div>";
         echo $out;

      }

   }

   /* including framework options */
   function options_render_load(){
      require_once( T_PATH ."/". F_PATH ."/libs/options.php");
   }

   /* nice name function for widgets */
   function nice_name($string){

      $string = preg_replace("@[^A-Za-z0-9\- ]@i", "", strtolower($string));
      $string = trim(preg_replace('/\s+/',' ', $string));
      $string = str_replace(' ', '_', $string);

      return $string;
   }

} /* end of CodeStarFramework Class */

} /* end of CodeStarFramework Class if */

$CodeStarFramework = new CodeStarFramework();
$CodeStarFramework->init();