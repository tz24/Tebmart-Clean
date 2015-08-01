<?php
/* run header & page-top */
get_header();
echo get_theme_generator('page_top');
?>

<div id="content">
   <div class="inner sidebar-right">

      <div id="main">
			<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', T_NAME ); ?></p>

			<?php get_search_form(); ?>

			<div class="space20"></div>

			<div class="one_half">
				<h4><?php _e( 'Categories', T_NAME); ?></h4>
				<ul class="ul_links">
					<?php wp_list_categories( array( 'title_li' => false ) ); ?>
				</ul>

				<div class="space20"></div>

				<h4><?php _e( 'Posts', T_NAME); ?></h4>
				<ul class="ul_links">
					<?php
						$found_query = new WP_Query(array('showposts' => 50));
						while ($found_query->have_posts()) : $found_query->the_post();
					?>
					<li><a href="<?php the_permalink() ?>" title="<?php printf( __("Permanent Link to %s", T_NAME), get_the_title() ); ?>"><?php the_title(); ?></a></li>
					<?php endwhile; ?>
				</ul>
			</div>

			<div class="one_half last">
				<h4><?php _e( 'Pages', T_NAME); ?></h4>
					<ul class="ul_links">
					<?php get_theme_generator( 'site_menu', 'ul_links' ); ?>
				</ul>
			</div>

      </div>

      <div id="sidebar"><?php dynamic_sidebar("blog"); ?></div>

   </div>
</div>
<?php get_footer(); ?>