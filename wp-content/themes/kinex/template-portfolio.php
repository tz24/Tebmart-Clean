<?php
/* get custom post options */
$options            	= get_post_meta($post->ID, '_post_options', true);
$page_layout			= @$sidebar = $options["sidebar"];

/* run header & page-top */
get_header();
echo get_theme_generator('page_top', $options);


/* getting global portfolio options */
$categories                = get_theme_option("portfolio","portfolio_cats");
$portfolio_columns         = get_theme_option('portfolio','portfolio_columns');
$portfolio_count	         = get_theme_option('portfolio','portfolio_count');
$portfolio_columns         = ($portfolio_columns)?(int)$portfolio_columns:1;

/* calc grid columns */
if ($portfolio_columns != 1) {
	if( $sidebar == 'full' || empty($sidebar) ){
		$page_layout = floor((960-57*($portfolio_columns-1))/$portfolio_columns);
	}else{
		$page_layout = floor((630-43*($portfolio_columns-1))/$portfolio_columns);
	}
} else if ($portfolio_columns == 1 ) {
	if( $sidebar == 'full' || empty($sidebar) ){
		$page_layout = floor((960-57)/2);
	}else{
		$page_layout = floor((630-43)/2);
	}
}

/* set columns class */
$class = array('','half','third','fourth','fifth','sixth');
$css = $class[$portfolio_columns-1];
?>
<div id="content">
	<div class="inner<?php if($sidebar =='right'){ echo ' sidebar-right'; } else if( $sidebar == 'left'){ echo ' sidebar-left';} ?>">
		<div id="main" class="portfolio-wrap">
		<?php
		/* page content text */
		$get_page	= &get_page($post->ID);
		echo apply_filters('the_content', $get_page->post_content);

		/* fix paged on frontpage and homepage */
		if((is_front_page() || is_home() ) && version_compare($wp_version, "3.1", '>=')){
			$paged = (get_query_var('paged')) ?intval(get_query_var('paged')) : intval(get_query_var('page'));
		}else{
			$paged = intval(get_query_var('paged'));
		}
		
		$sortby	= @$_GET['sortby'];
		
		if( isset($sortby) ){
			$idObj		= get_category_by_slug($sortby); 
			$id 			= $idObj->term_id;
			$categories = $id;
		}

		/* creating query */
		$query = array(
			'cat' 			  => $categories,
			'posts_per_page' => $portfolio_count,
			'paged' 			  => $paged
		);

		/* query posts */
		query_posts($query);

		/* if have posts, run. */
		$i=0;
		if ( have_posts() ) while ( have_posts() ) : the_post();

			$post_options	= get_post_meta($post->ID, '_post_options', true);

			$i++;
			if ($portfolio_columns != 1) {
				if ($i%$portfolio_columns !== 0) {
					echo "<div class=\"one_{$css}\">";
				} else {
					echo "<div class=\"one_{$css} last\">";
				}
			}
		?>
		<?php
		echo ($portfolio_columns == 1)?'<div class="post-wrapper"><div class="one_half">':'';
		echo get_theme_generator("portfolio_featured_image", $page_layout, $portfolio_columns);
		echo ($portfolio_columns == 1)?'</div><div class="one_half last one_title">':'';

		if(get_theme_option('portfolio','portfolio_display_title') == "on"){
		?><h2 class="post-title"><?php if(get_theme_option('portfolio','portfolio_display_link') == "on"){?><a href="<?php echo get_permalink() ?>" title="<?php printf( __("Permanent Link to %s", T_NAME), get_the_title() ); ?>"><?php } ?><?php the_title(); ?><?php if(get_theme_option('portfolio','portfolio_display_link') == "on"){?></a><?php } ?></h2><?php
		}
		if ( get_theme_option('portfolio', 'portfolio_display_description') == 'on' ) {
		
			echo '<div class="post-content">';
			
			if(get_theme_option('portfolio','portfolio_full_text') == "on"):
			   global $more;
			   $more = 0;
			   the_content( __("Read More ..."), true);
			else:
			   the_excerpt();

				if ( get_theme_option('portfolio', 'portfolio_display_more') == 'on' ) {
					$button_class = ( get_theme_option('portfolio', 'portfolio_read_as_button') == 'on' )?' class="cs-button '.get_theme_option('advanced', 'button_color').' '.get_theme_option('advanced', 'button_size').'"':'';
				?>
			  <a href="<?php echo get_permalink() ?>" title="<?php printf( __("Permanent Link to %s", T_NAME), get_the_title() ); ?>"<?php echo $button_class; ?>><span><?php echo get_theme_option('portfolio', 'portfolio_read_more_text'); ?></span></a>
			  <?php
			  }
			endif;
			
			echo '</div>';
		}

		echo ($portfolio_columns == 1)?'</div></div>':'';

		if ($portfolio_columns != 1) {

			echo '</div>';

			if ($i%$portfolio_columns === 0) {
				echo '<div class="clear space20"></div>';
			}

		}

		endwhile;
		wp_reset_postdata();
		?>
      <?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } ?>
      </div>
      <?php if($sidebar == 'left' || $sidebar == 'right'){ get_sidebar(); } ?>
      <div class="clear"></div>
   </div>
</div>
<?php get_footer(); ?>