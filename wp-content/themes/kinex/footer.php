<?php if( get_theme_option('advanced', 'fix_footer') != 'off' ) { ?><div id="fix-footer"></div><?php } ?>
<?php if( get_theme_generator('is_footer_included') ) { ?>
<div id="footer">
   <div class="inner"><?php echo get_theme_generator("footer_widgets"); ?></div>
</div>
<?php } ?>
<?php if( get_theme_option('footer', 'footer_copyright_area') != 'off' ) { ?>
<div id="copyright">
   <div class="inner"><?php echo do_shortcode(get_theme_option('footer', 'copyright')); ?></div>
</div>
<?php } ?>
<?php if( get_theme_option('advanced', 'layout_boxed') == 'on' ){ echo '<div class="clear"></div></div>'; } ?>
<div class="clear"></div>
<?php
   wp_footer();
   if( get_theme_option('general','google_analytics_position') == 'footer' ){ echo stripslashes(get_theme_option('general','google_analytics_code')); }
?>
</body>
</html>