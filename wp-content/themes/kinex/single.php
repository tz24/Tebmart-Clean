<?php
if ( is_single_portfolio() ){
	return get_template_part("single-portfolio","single-portfolio");
}

$options = get_post_meta($post->ID, '_post_options', true);
$sidebar = @$options["sidebar"];

if(empty($sidebar)){
	$sidebar = get_theme_option('blog','blog_single_layout');
}
$blog_single_navigation						= get_theme_option('blog', 'blog_single_navigation');
$blog_single_featured                  = get_theme_option('blog', 'blog_single_featured');
$blog_single_featured_image_layout     = get_theme_option('blog', 'blog_single_featured_image_layout');

get_header();
echo get_theme_generator('page_top', $options);
?>
<div id="content">
   <div class="inner<?php if($sidebar =='right'){ echo ' sidebar-right'; } else if( $sidebar == 'left'){ echo ' sidebar-left';} ?>">
      <div id="main">
      <?php
         if ( have_posts() ) : the_post();
            if( $blog_single_featured == "on" ){

					echo '<div class="post-featured">';
               echo get_theme_generator("blog_featured_image", $sidebar, $blog_single_featured_image_layout);
					echo '</div>';
            }
            the_content();
            if ( get_theme_option("advanced", "comment_post") == "on" ) { comments_template( '', true ); }
         endif;
      ?>
		<?php if($blog_single_navigation == "on") { ?>
      <div class="post-navigation">
         <div class="post-previous"><?php previous_post_link( '%link', __( '&larr;', T_NAME ) . ' %title', true ); ?></div>
         <div class="post-next"><?php next_post_link( '%link', '%title ' . __( '&rarr;', T_NAME ) , true ); ?></div>
      </div>
		<?php } ?>
      </div>
      <?php if($sidebar == 'left' || $sidebar == 'right'){ get_sidebar(); } ?>
   </div>
</div>
<?php get_footer(); ?>