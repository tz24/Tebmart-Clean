<?php
$options = get_post_meta($post->ID, '_post_options', true);
$sidebar = @$options["sidebar"];

if(empty($sidebar)){
	$sidebar = get_theme_option('portfolio','portfolio_single_layout');
}

$portfolio_single_featured             = get_theme_option('portfolio', 'portfolio_single_featured');
$blog_single_featured_image_layout     = get_theme_option('portfolio', 'portfolio_single_featured_image_layout');

get_header();
echo get_theme_generator('page_top', $options);
?>
<div id="content">
   <div class="inner<?php if($sidebar =='right'){ echo ' sidebar-right'; } else if( $sidebar == 'left'){ echo ' sidebar-left';} ?>">
      <div id="main">
      <?php
         if ( have_posts() ) : the_post();

				if( $portfolio_single_featured == "on" ){
					echo '<div class="post-featured">';
               echo get_theme_generator("portfolio_featured_image", $sidebar);
					echo '</div>';
            }

            the_content();

            if ( get_theme_option("advanced", "comment_post") == "on" ) { comments_template( '', true ); }

         endif;
      ?>
      </div>
      <?php if($sidebar == 'left' || $sidebar == 'right'){ get_sidebar(); } ?>
   </div>
</div>
<?php get_footer(); ?>