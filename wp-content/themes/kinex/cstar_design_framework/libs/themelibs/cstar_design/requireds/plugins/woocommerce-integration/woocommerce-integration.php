<?php
global $shop_id, $options;

$shop_id    = get_option('woocommerce_shop_page_id');
$options    = array();
$options    = get_post_meta($shop_id, '_post_options', true);

remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
add_action( 'woocommerce_before_main_content', 'custom_woocommerce_before_main_content', 10);
add_action( 'woocommerce_after_main_content', 'custom_woocommerce_after_main_content', 10);


/* woocommerce before content */
function custom_woocommerce_before_main_content() {
global $shop_id, $options;
$sidebar    = @$options["sidebar"];
if( is_shop() ){
   $custom_css = @$options['_intro_bg'] ?' style="'.$options['_intro_bg'].'"':'';
}
?>
<div id="page-top"<?php echo $custom_css; ?>>
   <div class="inner">
      <?php
         $title	= '';
         $output	= '';
         $text		= '';
         
         if ( is_singular('product') ) {
            $title = get_the_title();
         } elseif ( is_search() ) {
            $title = sprintf( __( 'Search Results: &ldquo;%s&rdquo;', 'woocommerce' ), get_search_query() );
         } elseif ( is_tax() ) {
            $title = single_term_title("", false);
         } else{
            $title = ( $shop_page_title = get_option( 'woocommerce_shop_page_title' ) ) ? $shop_page_title : get_the_title($shop_id);
         }
         
         if ( isset($title) && ( @$options["_intro_type"] == 'title' || @$options["_intro_type"] == null || @$options["_intro_type"] == 'both' )  ) {
            $output	.= '<h1 class="page-title">'.$title.'</h2>';
         }
         if( isset($text) || ( $options["_intro_type"] != 'title' && $options["_intro_type"] != null )  ) {
            $output	.= '<div>'.do_shortcode(@$options['_teaser_content']).'</div>';
         }
         
         if( isset($text) ){
            $output	.= $text;
         }
         echo @$output;
         if( ( get_theme_option('advanced', 'site_breadcrumbs') == 'on' && @$options['_breadcrumbs_page'] != 'off' ) ){ 
            
            $args = array(
               'delimiter'  => ' &raquo; ',
               'wrap_before'  => '<div class="breadcrumb breadcrumbs"><div class="breadcrumbs-plus"><span class="breadcrumbs-title">'.__( 'You are here: ', T_NAME ).' </span>',
               'wrap_after' => '</div></div>',
               'home' => __( 'Home', T_NAME ),
            );
         
            woocommerce_breadcrumb( $args ); 
         }
      ?>
   </div>
</div>
<div id="content">
   <div class="inner<?php if($sidebar =='right'){ echo ' sidebar-right'; } else if( $sidebar == 'left'){ echo ' sidebar-left';} ?> woocommerce-page">
      <div id="main">
<?php
} 

/* woocommerce after content */
function custom_woocommerce_after_main_content(){ 
global $shop_id, $options;
$sidebar    = @$options["sidebar"];
?>
      </div>
      <?php if( ( $sidebar == 'left' || $sidebar == 'right' ) ){ ?>
         <div id="sidebar">
            <?php 
               if( isset( $options["widget_sidebar"] ) ){
                  get_theme_generator('sidebar_widgets',$shop_id);
               }else{
                  dynamic_sidebar('page');
               }
            ?>
         </div>
      <?php } ?>
   </div>
</div>
<?php }