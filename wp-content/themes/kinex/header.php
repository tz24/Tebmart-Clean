<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<?php if( get_theme_option("advanced", "is_responsive") == 'on' ){ ?>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<?php } ?>
<title><?php echo get_theme_generator("site_title"); ?></title>

<link href="<?php echo get_theme_option("general","site_favicon"); ?>" rel="icon" type="image/x-icon" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<script type='text/javascript'>
	jQuery.noConflict();	function goBack(){	  window.history.back()	}
</script>
<?php wp_head(); ?>
<?php echo get_theme_generator("ie_hack"); ?>
<?php if( get_theme_option('general','google_analytics_position') == 'header' ){ echo stripslashes(get_theme_option('general','google_analytics_code')); } ?>
<script  type="text/javascript">
$(function () { 
    $(".datepicker").datetimepicker(); 
});
</script>
</head>
<body <?php body_class(); ?>>
<?php if( get_theme_option('advanced', 'layout_boxed') == 'on' ){ echo '<div id="boxed-layout">'; } ?>
<div id="header">
   <div class="inner">
      <a href="<?php echo home_url( '/' ); ?>" class="logo"><img src="<?php echo get_theme_option("general","site_logo"); ?>" alt="<?php bloginfo('name'); ?>"/></a>
      <?php echo get_theme_generator("header_area"); ?>
      <?php //get_theme_generator("site_menu"); ?>
	<div class="header-right">		<div class="header-right-top">
	   <?php
		$current_user = wp_get_current_user();
		if ( is_user_logged_in() ) {
			if($current_user->user_firstname != null){
				$user_info = $current_user->user_firstname;
			}
			else{
				$user_info = $current_user->user_login;
			}

		
		echo '<div class="cuser">Welcome, '.$user_info.'</div>';
		}
		else {	echo '<div class="cuser">Welcome, Visitors</div>';
		}
		if ( is_user_logged_in() ) {
			echo do_shortcode('[widgets_on_pages id="After login"]');			
		} else {
			echo do_shortcode('[widgets_on_pages id="Top Menu"]');
		}
	  ?>		</div>
	  <?php echo do_shortcode('[searchbar]'); //echo do_shortcode('[widgets_on_pages id="Top Search Block"]');  ?>
	</div>	
   </div>
   <div class="menu-div">
		<div class="inner">
<?php

if(!is_user_logged_in() && is_page('sell-books'))
{
	wp_safe_redirect('/tebmart/log-in');
	exit;
}
if(is_user_logged_in() && is_page('my-account'))
{
	wp_safe_redirect('/tebmart/sell-books');
	exit;	
}if(!is_user_logged_in() && is_page('my-account')){	wp_safe_redirect('/tebmart/log-in');	exit;	}
?>
			<?php get_theme_generator("site_menu"); ?>
		</div>
   </div>
</div>