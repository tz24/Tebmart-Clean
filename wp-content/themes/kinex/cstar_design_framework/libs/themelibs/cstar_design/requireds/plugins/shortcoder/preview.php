<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title>Preview</title>
<?php
wp_deregister_script( 'admin-bar' );
wp_deregister_style( 'admin-bar' );
remove_action('wp_footer','wp_admin_bar_render', 999);
wp_head();
?>
<style type="text/css" media="screen">
html { margin-top: 0 !important; }
* html body { margin-top: 0 !important; }
body{  min-width:0; }
</style>
</head>
<body>
<form action="" method="post"><input type="hidden" name="shortcode" id="shortcode-inputer" /></form>
<div id="shortcode-content">
<?php echo do_shortcode(stripcslashes(@$_POST['shortcode'])); ?>
</div>
<?php wp_footer(); ?>
</body>
</html>