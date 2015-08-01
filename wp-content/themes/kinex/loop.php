<?php
$page_layout = $sidebar = get_theme_option('blog','blog_page_layout');
$blog_featured_image    = get_theme_option('blog','blog_featured_image');
if ( !have_posts() ) {
	echo '<p>'.__( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', T_NAME ).'</p>';
	echo '<div class="one_half">';
	get_search_form();
	echo '</div>';
}
if ( have_posts() ) while ( have_posts() ) : the_post();
   ?>
	<div class="post-wrapper">
		<h4><a href="<?php echo get_permalink() ?>" title="<?php printf( __("Permanent Link to %s", T_NAME), get_the_title() ); ?>"><?php the_title(); ?></a></h4>
		<p class="post-meta"><?php echo get_theme_generator('post_meta'); ?></p>
		<?php echo get_theme_generator("blog_featured_image", $page_layout, $blog_featured_image); ?>
		<div class="post-content">
		<?php
		if(get_theme_option('blog','blog_full_text') == "on"){
			global $more;
			$more = 0;
			the_content( get_theme_option('blog', 'blog_read_more'), true);
		}else{
			the_excerpt();
		?>
		<a href="<?php echo get_permalink() ?>" title="<?php printf( __("Permanent Link to %s", T_NAME), get_the_title() ); ?>" class="cs-button <?php echo get_theme_option('advanced', 'button_color').' '.get_theme_option('advanced', 'button_size'); ?>"><span><?php echo get_theme_option('blog', 'blog_read_more'); ?></span></a>
		<?php }	?>
		</div>
	</div>
   <?php
endwhile;
wp_reset_postdata();
?>