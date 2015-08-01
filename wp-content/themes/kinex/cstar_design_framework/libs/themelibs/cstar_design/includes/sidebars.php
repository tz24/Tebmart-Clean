<?php
if ( !class_exists('CodeStarSidebars') ){


class CodeStarSidebars{

   function __construct(){

      $this->sidebar_names = array(
			'page'		=>__('Page Widget Area', T_NAME),
			'blog'		=>__('Blog Widget Area', T_NAME),
			'portfolio' =>__('Portfolio Widget Area', T_NAME),
		);

      add_action('widgets_admin_page', array( &$this, '_add_sidebars') );
   }

   function _add_sidebars(){
      $get_custom_sidebars = get_theme_option("cstar_custom", "sidebars");
      ob_start();
      ?>
      <div id="add_sidebars">
         <div class="sidebar-name">
            <h3>Add Widgets For Page Sidebars</h3>
         </div>
         <div class="widget-holder inactive sidebar_wrap">

				<form action="widgets.php" method="POST" class="add_sidebar_form">
					<span class="title">Widget Area Name:</span>
					<?php render_item("input", "add_sidebar"); ?> <input type="submit" name="sidebar_action" value="add" class="save_sidebar" style="float:left;" />
					<div id="sidebar_error"></div>
				</form>

				<div class="sidebar_list">
					<?php if( !empty($get_custom_sidebars) ){ ?>
					<span class="title">Custom Widgets Area List:</span>
					<ul>
					<?php
						foreach ($get_custom_sidebars as $key => $sidebar){
							echo '<li><strong>'.$sidebar.'</strong> <a href="?rmv_sdbr='.$key.'" class="confirm"><img src="'.T_URI.'/'.F_REQ.'/images/remove.png"></a></li>';
						}
					?>
					</ul>
					<?php } ?>
				</div>

				<div class="clear"></div>

         </div>
      </div>
      <?php
      echo ob_get_clean();
   }



   function _register_sidebars(){

		/* if have sidebar on homepage */
		$home_page_layout = get_theme_option("homepage", "home_page_layout");
		if($home_page_layout == 'right' || $home_page_layout == 'left'){
			register_sidebar(array(
            'id' => 'homepage',
				'name' => __('Home Widget Area', T_NAME),
				'description' => __('Drag Widgets', T_NAME),
				'before_widget' => '<div id="%1$s" class="page_sidebar_widget %2$s">',
				'after_widget' => '</div>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>'
			));
		}

		/* creating default sidebars */
      foreach ($this->sidebar_names as $key => $name){

         register_sidebar( array(
         'id' => $key,
         'name' => $name,
         'description' => __( 'Drag widgets', T_NAME ),
         'before_widget' => '<div class="page_sidebar_widget %2$s">',
         'after_widget' => '</div>',
         'before_title' => '<h3 class="widget-title">',
         'after_title' => '</h3>',
         ) );

      }

		/* if active header widget */
      $header_area_type = get_theme_option("general", "header_area");
		if($header_area_type == 'widget'){
			register_sidebar(array(
            'id' => 'header_widget',
				'name' =>  __('Header Widget Area', T_NAME),
				'description' => __('Drag Widgets', T_NAME),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget' => '</div>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>'
			));
		}

      /* register footer widgets */
      $get_footer_widgets = get_theme_option("footer", "footer_widget_model");

      if( !empty( $get_footer_widgets ) ) {

         switch ($get_footer_widgets) {

            case 'model1':    $widgets = 1;  break;
            case 'model2':    $widgets = 2;  break;

            case 'model12':
            case 'model11':
            case 'model10':
            case 'model9':
            case 'model8':
            case 'model7':
            case 'model3':
               $widgets = 3;
            break;

            case 'model16':
            case 'model15':
            case 'model14':
            case 'model13':
            case 'model4':
               $widgets = 4;
            break;

            case 'model5':    $widgets = 5;  break;
            case 'model6':    $widgets = 6;  break;
            default:          $widgets = 6;  break;

         }

         for($i = 1; $i < $widgets+1; $i++){
            register_sidebar( array(
               'name'            => __( "Footer Widget (" . $i . ")", T_NAME ),
               'id'              => 'sidebar_footer_widget_'.$i,
               'description'     => __( 'Drag widgets for footer widget (' . $i . ')', T_NAME ),
               'before_widget'   => '<div class="footer_widget %2$s">',
               'after_widget'    => '</div>',
               'before_title'    => '<h3 class="widget-title">',
               'after_title'     => '</h3>',
            ) );
         }

      }
      
      
      $footer_widget_after = get_theme_option("footer", "footer_widget_after");
		if($footer_widget_after == 'on' ){
			register_sidebar(array(
            'id' => 'footer_widget_after',
				'name' => __('Footer Widget After Area', T_NAME),
				'description' => __('Drag Widgets', T_NAME),
				'before_widget' => '<div id="%1$s" class="page_sidebar_widget %2$s">',
				'after_widget' => '</div>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>'
			));
		}
      
      $footer_widget_before = get_theme_option("footer", "footer_widget_before");
		if($footer_widget_before == 'on' ){
			register_sidebar(array(
            'id' => 'footer_widget_before',
				'name' => __('Footer Widget Before Area', T_NAME),
				'description' => __('Drag Widgets', T_NAME),
				'before_widget' => '<div id="%1$s" class="page_sidebar_widget %2$s">',
				'after_widget' => '</div>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>'
			));
		}

      /* register custom sidebars */
      $get_custom_sidebars = get_theme_option("cstar_custom", "sidebars");
      if( !empty( $get_custom_sidebars ) ) {
         foreach ($get_custom_sidebars as $key => $sidebar){

            register_sidebar( array(
            'id' => $key,
            'name' => ucwords($sidebar),
            'description' => $sidebar,
            'description' => __( 'Drag widgets for all of pages sidebar: '. $sidebar, T_NAME ),
            'before_widget' => '<div class="page_sidebar_widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
            ) );

			}
		}

		register_widget('Widget_Shortcode_Inserter');

	}

} /* end of CodeStarSidebars Class */

} /* end of CodeStarSidebars Class if */

global $CodeStarSidebars;
$CodeStarSidebars = new CodeStarSidebars();
add_action('widgets_init', array($CodeStarSidebars,'_register_sidebars'));