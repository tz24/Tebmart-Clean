<?php
get_header();
echo get_theme_generator('page_top');
$sidebar = get_theme_option('blog','blog_page_layout');
?>
<div id="content">
   <div class="inner<?php if($sidebar =='right'){ echo ' sidebar-right'; } else if( $sidebar == 'left'){ echo ' sidebar-left';} ?>">
      <div id="main">
      <?php get_template_part('loop','archive'); ?>
      <?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } ?>
      </div>
      <div id="sidebar"><?php dynamic_sidebar("blog"); ?></div>
   </div>
</div>
<?php get_footer(); ?>