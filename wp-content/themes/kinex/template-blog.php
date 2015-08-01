<?php
/* get custom post options */
$options			= get_post_meta($post->ID, '_post_options', true);
$page_layout	= @$sidebar = $options["sidebar"];

/* run header & page-top */
get_header();
echo get_theme_generator('page_top', $options);


if( empty($sidebar) || $sidebar == "full" ){
	$page_layout = $sidebar = get_theme_option('blog','blog_page_layout');
}

/* getting global blog options */
$blog_exclude           = get_theme_option('blog','blog_exclude');
$blog_featured_image    = get_theme_option('blog','blog_featured_image');
$blog_columns           = get_theme_option('blog','blog_columns');
$blog_columns           = ($blog_columns)?(int)$blog_columns:1;

/* calc grid columns */
if ( $blog_columns != 1 ) {
	if( $sidebar == 'full' || empty($sidebar) ){
		$page_layout = floor((920-25*($blog_columns-1))/$blog_columns);
	}else{
		$page_layout = floor((606-25*($blog_columns-1))/$blog_columns);
	}
}


/* set columns class */
$class = array('','half','third','fourth','fifth','sixth');
$css = $class[$blog_columns-1];
?>
<div id="content">
	<div class="inner<?php if($sidebar =='right'){ echo ' sidebar-right'; } else if( $sidebar == 'left'){ echo ' sidebar-left';} ?>">

      <div id="main">
      <?php
			/* page content text */
			$get_page	= &get_page($post->ID);
			echo apply_filters('the_content', $get_page->post_content);
			
			$sortby	= @$_GET['sortby'];
			
         /* make array exclude categories */
         $blog_excludes = explode(',', $blog_exclude);

         /* add '-' for exclude categories */
         foreach ($blog_excludes as $key => $value) {
            $blog_excludes[$key] = -$value;
         }

         /* fix paged on frontpage and homepage */
         if((is_front_page() || is_home() ) && version_compare($wp_version, "3.1", '>=')){
            $paged = ( get_query_var('paged') ) ? intval(get_query_var('paged')) : intval( get_query_var('page') );
         }else{
            $paged = intval(get_query_var('paged'));
         }

			if( isset($sortby) ){
				$idObj			= get_category_by_slug($sortby); 
				$id 				= $idObj->term_id;
				$exclude_cats	= $id;
			}else{
				$exclude_cats = implode(",",$blog_excludes);
			}

			/* creating query */
			$query = array(
				'cat' => $exclude_cats,
				'paged' => $paged
			);

			/* query posts */
         query_posts($query);

         /* if have posts, run. */
         $i = 0;
         if ( have_posts() ) while ( have_posts() ) : the_post();


            $i++;
            if ($blog_columns != 1) {
               if ($i%$blog_columns !== 0) {
                  echo "<div class=\"one_{$css}\">";
               } else {
                  echo "<div class=\"one_{$css} last\">";
               }
            }
            ?>
            <div class="post-wrapper">
				<h2 class="post-title"><a href="<?php echo get_permalink() ?>" title="<?php printf( __("Permanent Link to %s", T_NAME), get_the_title() ); ?>"><?php the_title(); ?></a></h2>
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
				<?php } ?>
				</div>

            </div>
            <?php
            if ($blog_columns != 1) {

					echo '</div>';

               if ($i%$blog_columns === 0) {
                  echo '<div class="clear"></div>';
               }

            }

         endwhile;

         wp_reset_postdata();
      ?>
      <?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); wp_reset_query(); } ?>
		</div>
      <?php if($sidebar == 'left' || $sidebar == 'right'){ get_sidebar(); } ?>
   </div>
</div>
<?php get_footer(); ?>