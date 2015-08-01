<?php
if( is_blog() ){
   return get_template_part("template-blog", "blog");
} else if( is_portfolio() ){
   return get_template_part("template-portfolio", "portfolio");
}

do_action('set_post_id'); // set post id for extra plugins
$options = get_post_meta($post->ID, '_post_options', true);
$sidebar = @$options["sidebar"];

get_header();
echo get_theme_generator('page_top', $options);
?>
<div id="content">
   <div class="inner<?php if($sidebar =='right'){ echo ' sidebar-right'; } else if( $sidebar == 'left'){ echo ' sidebar-left';} ?>">
      <div id="main">
      <?php
         if ( have_posts() ) : the_post();
            woocommerce_content();
            if ( get_theme_option("advanced", "comment_page") == "on" ) { comments_template( '', true ); }
         endif;
      ?>
      </div>
      <?php if($sidebar == 'left' || $sidebar == 'right'){ get_sidebar(); } ?>
   </div>
</div>
<?php get_footer(); ?>