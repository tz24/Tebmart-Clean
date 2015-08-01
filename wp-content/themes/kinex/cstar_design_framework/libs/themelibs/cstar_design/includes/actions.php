<?php
if ( !class_exists('CodeStarActions') ){

class CodeStarActions{

   function __construct(){

      $this->after_plugin_activated();

		add_action('after_setup_theme',array(&$this, '_language_support'));

      add_action('wp_print_scripts', array(&$this, 'enqueue_scripts'), 100);
      add_action('wp_print_styles', array(&$this, 'enqueue_styles'), 100);

      add_action('add_meta_boxes', array(&$this, '_add_meta_box'));
      add_action('save_post', array(&$this, '_save_post'));

      add_action('admin_print_styles', array(&$this, '_custom_css'));
      add_action('admin_print_scripts', array(&$this, '_custom_js'));

      /* shortcode generator includes */
      add_action('media_buttons', array(&$this, 'media_shortcode_button'), 99);
      add_action('admin_footer', array(&$this, 'shortcode_codebox'));
      add_action('wp_ajax_get-shortcode', array(&$this, 'shortcode_generator'));
      add_action('wp_ajax_get-shortcode-preview', array(&$this, 'shortcode_preview'));
      
      add_action('init', array(&$this, 'init_custom_options'));
      
      /* bbpress integration */
      if ( function_exists( 'is_bbpress' ) ){
         add_action('set_post_id', array(&$this, 'set_post') );
      }
      
	}
   
   function set_post(){
   
      if ( bbp_is_forum_archive() ) {
         global $post;
         wp_reset_query();
         wp_reset_postdata();
         $post = get_page_by_title( get_the_title() );
         return $post;
      }
      return;
      
   }
   
   function init_custom_options(){
      if( get_theme_option('advanced', 'error_reporting') != 'on' ){ error_reporting(0); }
   }

	function _language_support(){
		load_theme_textdomain( T_NAME, T_PATH . '/languages' );
	}
	
   function media_shortcode_button() {
      echo '<a href="#" class="codebox"><img src="'.T_URI.'/'.F_REQ.'/images/shortcode_add.png" alt="" /></a>';
   }

   function shortcode_codebox() {
      $shortcodes = get_available_shortcodes();
   ?>
   <div id="cstar-shortcode-generator" style="display:none;">
      <a id="shortcode-close" href="#"></a>
		<div id="sc-header">
			<div id="shortcode-logo"></div>
			<select id="shortcode-selector">
				<option value=""><?php _e( 'Select a shortcode', T_NAME ); ?></option>
				<?php
					foreach( $shortcodes as $key=> $val){

						echo '<optgroup label="'.$val["nicename"].'" id="'.$key.'">';
						foreach ( $val["options"] as $name => $shortcode ) {
							echo '<option value='.$name.'>'.$shortcode['desc'].'</option>';
						}
						echo '</optgroup>';
					}
				?>
			</select>
			<a href="#" id="exit-preview"><img src="<?php echo T_URI."/".F_REQ."/images/exit_preview.png"; ?>" alt=""/></a>
		</div>
		<div id="load-shortcode"></div>
		<div id="load-preview">
			<iframe id="shortcode-iframe" name="shortcode-iframe" src=""></iframe>
		</div>
		<input type="hidden" name="shortcode-uri" id="shortcode-uri" value="<?php echo admin_url('admin-ajax.php'); ?>" />
   </div>
   <div id="shortcode-overlay"></div>
   <?php
	}
   
   function shortcode_generator(){
      include(T_PATH.'/'.F_REQ.'/plugins/shortcoder/generator.php');
      die(); /* ending ajax */
   }
   
   function shortcode_preview(){
      include(T_PATH.'/'.F_REQ.'/plugins/shortcoder/preview.php');
      die(); /* ending ajax */
   }

   function _custom_css(){
      wp_enqueue_style('custom-cstar', T_URI .'/'. F_REQ .'/css/custom-cstar.css');
   }

   function _custom_js(){
      wp_enqueue_script('custom-js', T_URI .'/'. F_REQ .'/js/custom-cstar.js');
   }


   function _add_meta_box(){

      /* adding post metaboxes */
      add_meta_box(
			'post_meta_box'
			,__( 'Theme Custom Fields', T_NAME )
			,array( &$this, 'post_meta_box' )
			,'post'
			,'normal'
			,'high'
      );

		/* adding post metaboxes */
      add_meta_box(
			'page_meta_box'
			,__( 'Theme Custom Fields', T_NAME )
			,array( &$this, 'page_meta_box' )
			,'page'
			,'normal'
			,'high'
      );


      /* adding page sidebar metabox */
      add_meta_box(
			'page_sidebar_box'
			,__( 'Page Sidebar', T_NAME )
			,array( &$this, 'sidebar_meta_box' )
			,'page'
			,'side'
			,'low'
      );

      /* adding post sidebar metabox */
      add_meta_box(
			'post_sidebar_box'
			,__( 'Post Sidebar', T_NAME )
			,array( &$this, 'sidebar_meta_box' )
			,'post'
			,'side'
			,'low'
      );

   }

	function option_help($text){
		echo '<div class="option_tooltip"><img class="help_img" src="'.T_URI.'/'.F_PATH.'/libs/images/help.png"><span class="tooltip">'.$text.'</span></div>';
	}

	function	header_meta_box(){
		?>
		<div class="option_set">
			<div class="option_title">Header Type :</div>
			<div class="option_wrap"><?php render_item('select', '_intro_type', 'title,content,both', false, false, false, '_intro_type'); ?></div>
			<?php $this->option_help("From here, you can change page header tpye. have 3 (post title, custom content, both) different type. choose any type and try :) it is easy. btw you can use all of shortcode in custom content type."); ?>
			<div id="intro_type_show" style="position:relative;">
				<div class="option_title">Content :</div>
				<div class="option_wrap">
					<a href="#" data-target="_teaser_content" data-page="widget" class="codebox"><img src="<?php echo T_URI.'/'.F_REQ; ?>/images/shortcode_add.png" alt="" /></a>
					<?php render_item('textarea', '_teaser_content'); ?>
				</div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="option_set">
			<div class="option_title">Breadcrumbs :</div>
			<div class="option_wrap">
				<?php render_item('on_off_ui', '_breadcrumbs_page', false, get_theme_option('advanced', 'site_breadcrumbs')); ?>
			</div>
			<?php $this->option_help("From here, you can enable or disable breadcrumbs for this page/post"); ?>
			<div class="clear"></div>
		</div>
		<div class="option_set">
			<div class="option_title">Custom Header :</div>
			<div class="option_wrap">
				<?php render_item('on_off_ui', '_custom_header'); ?>
			</div>
			<?php $this->option_help("From here, you can change header skin. a easy and beautiful a option. turn on for custom header skin."); ?>
			<div id="_custom_header_wrap" style="display:none;">
				<div class="option_title">Header Background :</div>
				<div class="option_wrap">
					<?php render_item('background', '_intro_bg'); ?>
				</div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="tooltip_content" style="display: none;"><div class="tooltip_arrow"></div><div class="tooltip_text"></div></div>
		<?php
	}
	function page_meta_box(){
      /* Use nonce for verification */
      wp_nonce_field( plugin_basename( __FILE__ ), 'cstar_noncename' );
		$this->header_meta_box();
   }

   function post_meta_box(){
		global $post;
      /* Use nonce for verification */
      wp_nonce_field( plugin_basename( __FILE__ ), 'cstar_noncename' );

		$_post_options = get_post_meta($post->ID, '_post_options', true);
      $post_type = @$_post_options["_post_type"];
		?>
		<div class="option_set">
			<div class="option_title">Parent Page for Breadcrumbs :</div>
			<div class="option_wrap">
			<?php render_item('select', '_post_breadcrumbs_page', '[pages],[all],[desc],[id]'); ?>
			</div>
			<?php $this->option_help("From here, you can choose an any page for breadcrubms.  this option will needed for portfolio posts usually."); ?>
			<div class="clear"></div>
		</div>

		<div class="option_set">
			<div class="option_title">Featured Image Type :</div>
			<div class="option_wrap">
			<?php render_item('select', '_post_type', 'image,video,link,document,lightbox,custom', false, false, false, '_post_type'); ?>
			</div>
			<?php $this->option_help("Important an option! From here, you can change featured image type. you can set a link type or lightbox type or custom type."); ?>

			<ul id="post_types">
				<li id="type_image">

					<div class="option_title">Image :</div>
					<div class="option_wrap">
						<?php render_item('upload', '_post_lightbox_image'); ?>
					</div>
					<?php $this->option_help("If you want show a different image in lightbox, upload a new image."); ?>

				</li>
				<li id="type_video">

					<div class="option_title">Video Link :</div>
					<div class="option_wrap">
						<?php render_item('input', '_post_lightbox_video'); ?>
					</div>
					<?php $this->option_help("Video Link in Lightbox - Paste your full (YouTube or Vimeo) url. Only necessary when the lightbox type is video."); ?>

					<div class="option_title">Video Width :</div>
					<div class="option_wrap">
						<?php render_item('slider_ui','_post_lightbox_video_width','800,1000,1,px'); ?>
					</div>

					<div class="option_title">Video Height :</div>
					<div class="option_wrap">
						<?php render_item('slider_ui', '_post_lightbox_video_height', '480,1000,1,px'); ?>
					</div>

				</li>
				<li id="type_link">

					<div class="option_title">Link Type :</div>
					<div class="option_wrap">
						<?php render_item('select', '_post_link', 'page,category,post,custom', false, false, false, '_link_type'); ?>
					</div>
					<?php $this->option_help("From here, you can choose an any link type for featured image."); ?>


					<ul id="link_types">
						<li id="link_page">
							<div class="option_title">Page Link :</div>
							<div class="option_wrap">
								<?php render_item('select', '_post_link_page', '[pages],[all],[desc],[id]'); ?>
							</div>
						</li>
						<li id="link_category">
							<div class="option_title">Category Link :</div>
							<div class="option_wrap">
								<?php render_item('select', '_post_link_category', '[categories],[all],[desc],[id]'); ?>
							</div>
						</li>
						<li id="link_post">
							<div class="option_title">Post Link :</div>
							<div class="option_wrap">
								<?php render_item('select', '_post_link_post', '[posts],[all],[desc],[id]'); ?>
							</div>
						</li>
						<li id="link_custom">
							<div class="option_title">Custom Link :</div>
							<div class="option_wrap">
								<?php render_item('input', '_post_link_custom'); ?>
							</div>
						</li>
					</ul>

					<div class="option_title">Target Link :</div>
					<div class="option_wrap">
						<?php render_item('select', '_post_link_target', '_blank,_self,_top,_parent'); ?>
					</div>

				</li>

				<li id="type_document">
					<div class="option_title">Link Type :</div>
					<div class="option_wrap">
						<?php render_item('select', '_post_document', 'page,category,post,custom', false, false, false, '_doc_type'); ?>
					</div>
					<?php $this->option_help("From here, you can choose an any link type for featured image."); ?>

					<ul id="doc_types">
						<li id="doc_page">
							<div class="option_title">Page Link :</div>
							<div class="option_wrap">
								<?php render_item('select', '_post_doc_page', '[pages],[all],[desc],[id]'); ?>
							</div>
						</li>
						<li id="doc_category">
							<div class="option_title">Category Link :</div>
							<div class="option_wrap">
								<?php render_item('select', '_post_doc_category', '[categories],[all],[desc],[id]'); ?>
							</div>
						</li>
						<li id="doc_post">
							<div class="option_title">Post Link :</div>
							<div class="option_wrap">
								<?php render_item('select', '_post_doc_post', '[posts],[all],[desc],[id]'); ?>
							</div>
						</li>
						<li id="doc_custom">
							<div class="option_title">Custom Link :</div>
							<div class="option_wrap">
								<?php render_item('input', '_post_doc_custom'); ?>
							</div>
						</li>
					</ul>

					<div class="option_title">Target Link :</div>
					<div class="option_wrap">
						<?php render_item('select', '_post_doc_target', '_blank,_self,_top,_parent'); ?>
					</div>

				</li>

				<li id="type_lightbox">

					<div class="option_title">Link for Lightbox :</div>
					<div class="option_wrap">
						<?php render_item('input', '_post_lightbox_href'); ?>
					</div>
					<?php $this->option_help("From here, you can choose any url for featured image lightbox.<br />Example: http://themeforest.net/"); ?>


					<div class="option_or">- or -</div>

					<div class="option_title">Content for Lightbox :</div>
					<div class="option_wrap">
						<?php render_item('textarea', '_post_lightbox_content'); ?>
					</div>
					<?php $this->option_help("From here, you can choose any content for featured image lightbox.<br />Example: Hello World..."); ?>


					<div class="option_title">Lightbox Width :</div>
					<div class="option_wrap">
						<?php render_item('slider_ui','_post_lightbox_content_width','800,1000,1,px'); ?>
					</div>

					<div class="option_title">Lightbox Height :</div>
					<div class="option_wrap">
						<?php render_item('slider_ui', '_post_lightbox_content_height', '480,1000,1,px'); ?>
					</div>

					<div class="option_title">Featured Hover Icon <em>(optional)</em> :</div>
					<div class="option_wrap">
						<?php render_item('select', '_post_lightbox_icon', 'image,video,link,document'); ?>
					</div>

				</li>

				<li id="type_custom">
					<div class="option_title">Custom Content :</div>
					<div class="option_wrap">
						<a href="#" data-target="_post_type_custom" data-page="widget" class="codebox"><img src="<?php echo T_URI.'/'.F_REQ; ?>/images/shortcode_add.png" alt="" /></a>
						<?php render_item('textarea', '_post_type_custom'); ?>
					</div>
					<?php $this->option_help("From here, you can write any content from here."); ?>

				</li>

			</ul>

			<div class="clear"></div>
		</div>

		<?php

		/* include header meta box */
		$this->header_meta_box();

   }


   function sidebar_meta_box(){

		global $post;

      /* Use nonce for verification */
      wp_nonce_field( plugin_basename( __FILE__ ), 'cstar_noncename' );
      $_post_options = get_post_meta($post->ID, '_post_options', true);

		echo '<div class="page-sidebar option_select ">';

      render_item('checkbox', 'sidebar', 'left,full,right', false, false, false, 'sidebar');

      $get_sidebars = get_theme_option("cstar_custom", "sidebars");
      if( !empty($get_sidebars) ){

         $output   = '<select name="options[selectboxes][widget_sidebar][]">';
			$output  .= '<option value="">-- Choose one --</option>';
         foreach ($get_sidebars as $key => $sidebar){

            $selected = ($key == @$_post_options["widget_sidebar"])?' selected="selected"':'';

            $output .= '<option value="'.$key.'"'.$selected.'>'.$sidebar.'</option>';
         }
         $output .= '</select>';

      }else{

         $output = __('<strong>There is no any widget area. <br /><a href="widgets.php">Create a new widget area.</a></strong>', T_NAME);

      }

      echo '<div id="choose_sidebar">'.$output.'</div>';
		echo '<div class="clear"></div></div>';

   }

   function _save_post($post_id){

      /*
         verify this came from the our screen and with proper authorization,
         because save_post can be triggered at other times
      */
      if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){ return $post_id; }


      /* verify if this is an auto save routine.
         If it is our form has not been submitted, so we dont want to do anything
      */
      if ( !wp_verify_nonce( @$_POST['cstar_noncename'], plugin_basename( __FILE__ ) ) ) { return $post_id; }


      /* Check permissions */
      if ( 'page' == $_POST['post_type'] ) {
         if ( !current_user_can( 'edit_page', $post_id ) ) { return $post_id; }
      } else {
         if ( !current_user_can( 'edit_post', $post_id ) ) { return $post_id; }
      }

		$options				= $_REQUEST["options"];
      $options_name		= "_post_options";
      $exclude_opts		= array();
      $exclude_vals		= array('', 800, 480);

		if($options['checkboxes']['_custom_header'][0] == 'off'){
			$exclude_opts		= array('_custom_header', '_intro_bg');
		}

		if( get_theme_option('advanced', 'site_breadcrumbs') == 'on' && $options['checkboxes']['_breadcrumbs_page'][0] == 'on'){
			$exclude_opts[]		= '_breadcrumbs_page';
		}

		if( $options['checkboxes']['_custom_header'][0] == 'off'){
			$exclude_opts[]		= '_custom_header';
		}

      $opts = array();
		foreach($options as $key => $option) {

         if (empty($option) ) {
				delete_post_meta($post_id, $options_name);
				continue;
			}

         if( !is_array( $option ) && !in_array($key, $exclude_opts) ){
            $opts[$key] = stripslashes($option);
         } else {

            foreach($option as $op => $val){

               $values = array();

               foreach ($val as $k => $v){
                  if($v != "" ){
                     $values[] =  $v;
                  }
               }

               if( !in_array($op, $exclude_opts) ){
                  $opts[$op] = implode(",", $values);
               }
            }
         }

      }

		foreach($opts as $key => $val){
			if( in_array($val, $exclude_vals) ){
				unset($opts[$key]);
			}
		}

      if( empty($opts) ){
         delete_post_meta($post_id, $options_name);
      } else {

         if(get_post_meta($post_id, $options_name) != "" ){
            update_post_meta($post_id, $options_name, $opts);
         }else{
            add_post_meta($post_id, $options_name, $opts);
         }
      }

   }



   function enqueue_scripts(){

      if(is_admin() && @$_GET['action'] != 'get-shortcode-preview'){ return; }

      wp_enqueue_script('jquery');
      wp_enqueue_script('jquery-cycle', T_URI . '/js/jquery.cycle.all.js', array('jquery'));
      wp_enqueue_script('jquery-codestar', T_URI . '/js/jquery.codestar.js', array('jquery'));
      wp_enqueue_script('jquery-prettyPhoto', T_URI . '/js/jquery.prettyPhoto.js', array('jquery'));
      wp_enqueue_script('jquery-tools', T_URI . '/js/jquery.tools.min.js', array('jquery'));
      wp_enqueue_script('superfish', T_URI . '/js/superfish.js', array('jquery'));
      wp_enqueue_script('touchSwipe', T_URI . '/js/jquery.touchSwipe.js', array('jquery'));
      wp_enqueue_script('jquery-fitvids', T_URI . '/js/jquery.fitvids.js', array('jquery'));
      
      wp_register_script('jquery-nivo', T_URI . '/js/jquery.nivo.slider.js', array('jquery'));
      wp_register_script('jquery-kwicks', T_URI . '/js/jquery.kwicks-1.5.1.dev.js', array('jquery'));
      wp_register_script('jquery-codeslide', T_URI . '/js/jquery.codeslider.js', array('jquery'));
      wp_register_script('jquery-flexslider', T_URI . '/js/jquery.flexslider.js', array('jquery'));

      wp_enqueue_script('jquery-register', T_URI . '/js/jquery.register.js', false, false, true);

      if ( is_singular() && get_option( 'thread_comments' ) ){ wp_enqueue_script( 'comment-reply' ); }
   }

   function _create_dynamic_css(){

      if (is_writable(C_PATH)) {

			if(is_multisite()){
				global $blog_id;
				$cssFile = C_PATH.'/skin_'.$blog_id.'.css';
			}else{
				$cssFile = C_PATH.'/skin.css';
			}
         $fileHandle = @fopen($cssFile, 'w+');
			$cssContent = include(T_PATH ."/". F_REQ . "/skinable.php");
			
			if ($fileHandle){
            fwrite($fileHandle, $cssContent, strlen($cssContent));
         }

      }

      return false;
   }


   function enqueue_styles(){

      if(is_admin() && @$_GET['action'] != 'get-shortcode-preview'){ return; }

		if(is_multisite()){
			global $blog_id;
			$cssFile = C_URI.'/skin_'.$blog_id.'.css';
		}else{
			$cssFile = C_URI.'/skin.css';
		}
		

      $enqueue_fonts    = str_replace(' ', '+', get_theme_generator('get_google_fonts'));

      if($enqueue_fonts){

         if( count($enqueue_fonts) > 1 ){
            $google_fonts = implode('|', $enqueue_fonts);
         }else{
            $google_fonts = $enqueue_fonts[0];
         }

         printf("<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=%s' type='text/css' />\r\n", $google_fonts);
      }

      if( get_option("cacheCSS") == "on" ){
         $this->_create_dynamic_css();
         update_option("cacheCSS", "off");
      }

      wp_enqueue_style( 'custom-style',  T_URI . '/css/style.css');
      wp_enqueue_style( 'skin',  $cssFile);
      
      if( get_theme_option("advanced", "is_responsive") == 'on' ){
         wp_enqueue_style( 'responsive-style',  T_URI . '/css/responsive.css');
      }
      
      if( get_theme_option("advanced", "rtl") == "on"){
         wp_enqueue_style( 'rtl-style',  T_URI . '/css/rtl.css');
      }

      if( is_child_theme() ){
         wp_enqueue_style( 'root-style',  get_stylesheet_directory_uri() . '/style.css');
      }
   }

   function reset_combine(){
      update_option("cacheCSS", "on");
   }

   function after_plugin_activated(){
		global $pagenow;
      if ( ( 'plugins.php' == $pagenow && @$_GET['activate'] ) ||  ( 'plugins.php' == $pagenow && @$_GET['deactivate'] ) ||  ( 'themes.php' == $pagenow && @$_GET['activated'] ) ){
         $this->reset_combine();
      }
   }

} /* end of CodeStarActions Class */

} /* end of CodeStarActions Class if */