<?php
/*
	Framework Name: CP (Codestar Panel)
	Plugin URI: http://codestarlive.com/
	Description: CP Framework is qucikly front-end generator for our wordpress themes!
	Version: 2.0
	Author: Codestar
	Author URI: http://codestarlive.com/
	License: General Public Licence
   This is framework has been created by CP Framework v2.0!
*/

define('F_PATH', 'cstar_design_framework');
define('F_LIB', 'libs/themelibs/cstar_design');
define('F_REQ', 'cstar_design_framework/libs/themelibs/cstar_design/requireds');
define('F_INC', 'cstar_design_framework/libs/themelibs/cstar_design/includes');
define('T_NAME', 'cstar_design');
define('T_SN', 'cs');
define('T_VER', 'v3.0');
define('T_URI', get_template_directory_uri() );
define('T_PATH', get_template_directory() );
define('T_IMG', T_URI.'/images');
define('T_JS', T_URI.'/js');
define('T_CSS', T_URI.'/css');
define('C_PATH', T_PATH.'/cache');
define('C_URI', T_URI.'/cache');

$option_groups = array("general","background","color","font","homepage","footer","blog","portfolio","advanced");

include_once( T_PATH ."/". F_PATH ."/libs/themelibs/cstar_design/includes/actions.php");
include_once( T_PATH ."/". F_PATH ."/libs/themelibs/cstar_design/includes/common.php");
include_once( T_PATH ."/". F_PATH ."/libs/themelibs/cstar_design/includes/filters.php");
include_once( T_PATH ."/". F_PATH ."/libs/themelibs/cstar_design/includes/functions.php");
include_once( T_PATH ."/". F_PATH ."/libs/themelibs/cstar_design/includes/plugins.php");
include_once( T_PATH ."/". F_PATH ."/libs/themelibs/cstar_design/includes/shortcodes.php");
include_once( T_PATH ."/". F_PATH ."/libs/themelibs/cstar_design/includes/sidebars.php");
include_once( T_PATH ."/". F_PATH ."/libs/themelibs/cstar_design/includes/slideshow.php");
include_once( T_PATH ."/". F_PATH ."/libs/themelibs/cstar_design/includes/widgets.php");
include_once( T_PATH ."/". F_PATH ."/libs/run.php");


add_action('admin_menu', 'framework_create_menu');
function framework_create_menu() {
add_menu_page('CStar Design', 'CStar Design', 'administrator', 'cs_general', 'cs_general');
add_submenu_page('cs_general', 'General', 'General', 'administrator', 'cs_general', 'cs_general');
add_submenu_page('cs_general', 'Background', 'Background', 'administrator', 'cs_background', 'cs_background');
add_submenu_page('cs_general', 'Color', 'Color', 'administrator', 'cs_color', 'cs_color');
add_submenu_page('cs_general', 'Font', 'Font', 'administrator', 'cs_font', 'cs_font');
add_submenu_page('cs_general', 'Homepage', 'Homepage', 'administrator', 'cs_homepage', 'cs_homepage');
add_submenu_page('cs_general', 'Footer', 'Footer', 'administrator', 'cs_footer', 'cs_footer');
add_submenu_page('cs_general', 'Blog', 'Blog', 'administrator', 'cs_blog', 'cs_blog');
add_submenu_page('cs_general', 'Portfolio', 'Portfolio', 'administrator', 'cs_portfolio', 'cs_portfolio');
add_submenu_page('cs_general', 'Advanced', 'Advanced', 'administrator', 'cs_advanced', 'cs_advanced');
}

function cs_general(){
?>
<form method="post"><div class="framework_wrapper">
<div class="framework_band framework_top"><div class="framework_logo"></div><div class="framework_action"><input type="submit" name="action" value="save" class="form_submits save_options"><input type="submit" name="action" value="reset" class="form_submits reset_options" onclick="return confirm('Are you sure you want to reset ?');"></div></div>
<div class="framework_content">
<table cellspacing="0" class="option_tables">
<tbody>
<tr>
<td>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('subheader','logo-header','Logo Settings', false,'','none',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Custom Site Logo','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','<div id="upload_site_logo_preview" class="upload_pic site_logo"></div>','', false,'','',''); ?></td></tr><tr><td><?php render_item('upload','site_logo','[path]/images/logo.png', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','The recommended dimensions is 250x100 pixels. And you can upload smaller or larger a logo than 250x100 pixels. but may need to change height of the header.','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Favicon','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','<div id="upload_site_favicon_preview" class="upload_pic site_favicon"></div>','', false,'','',''); ?></td></tr><tr><td><?php render_item('upload','site_favicon','[path]/images/favicon.ico', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','Favicon is a shortcut icon. The size must be 16x16 pixels.','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Header Height','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('slider_ui','header_height','120,500,1,px', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','Height of the header. It is very important a option. When you upload a smaller or larger logo or header background you will need to change height of the header.','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Logo Bottom','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('slider_ui','logo_bottom','30,500,1,px', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','When you change header of the height you will need to change bottom of the logo.','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Logo Left','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('slider_ui','logo_left','0,500,1,px', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','If you want move your logo from left to center, you will need this option.','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('subheader','menu-settings-general','Header Menu Settings', false,'','none',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Menu Arrows','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('on_off_ui','menu_arrow','off', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','You can be enable menu arrow for multi-level menu items.','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Menu Right','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('slider_ui','menu_right','0,500,1,px', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','You can move your menu from right to center via this option.','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('subheader','header-area','Header Area Settings', false,'','none',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Header Widget Area','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('on_off_ui','header_widget','on', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','Header right content, You can disable/enable it via this option.','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Header Widget Area Type','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('select','header_area','html=selected,widget', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','You can use a widget, also you can use some html code or shortcode.','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Header Widget Area Html Code','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tinymce','header_area_html','', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','If you are using a HTML Widget Area, write your html codes or shortcodes.','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('subheader','google-analytics','Google Analytics Code', false,'','none',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Analytics Code Position','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('select','google_analytics_position','header,footer=selected', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','Analytics code position, you can use your analytics code in footer or in header.','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Google Analytics Code','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('textarea','google_analytics_code','', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','Embed your google analytics code. also you can embed another analytics code or any javascript code.','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('subheader','custom-css','Custom CSS', false,'','none',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Custom CSS','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('textarea','custom_css','', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','You can write your custom css code here.','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</tbody>
</table>
</div>
<div class="framework_band framework_bottom"><div class="framework_action"><input type="submit" name="action" value="save" class="form_submits save_options"><input type="submit" name="action" value="reset" class="form_submits reset_options" onclick="return confirm('Are you sure you want to reset ?');"></div></div>
</div>
<div class="tooltip_content">
<div class="tooltip_arrow">&nbps;</div>
<div class="tooltip_text">&nbps;</div>
</div>
</form><?php
}

function cs_background(){
?>
<form method="post"><div class="framework_wrapper">
<div class="framework_band framework_top"><div class="framework_logo"></div><div class="framework_action"><input type="submit" name="action" value="save" class="form_submits save_options"><input type="submit" name="action" value="reset" class="form_submits reset_options" onclick="return confirm('Are you sure you want to reset ?');"></div></div>
<div class="framework_content">
<table cellspacing="0" class="option_tables">
<tbody>
<tr>
<td>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Background Header','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('background','background_header','background-image:url([path]/images/header_bg.png); background-repeat:no-repeat; background-attachment:scroll; background-position:50% 0%; background-color:#f9f9f9;', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','From here, you can change header background settings. can do detailed editing.','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Background Slideshow','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('background','background_slideshow','background-image:url([path]/images/slider_bg.png); background-repeat:repeat-x; background-attachment:scroll; background-position:50% 0%; background-color:#ffffff;', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','From here, you can change slideshow background settings. can do detailed editing.','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Background Intro','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('background','background_intro','background-image:url([path]/images/intro_bg.png); background-repeat:repeat-x; background-attachment:scroll; background-position:0% 100%; background-color:#f8f8f8;', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','From here, you can change intro background settings. can do detailed editing.','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Background Content','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('background','background_content','background-image:url([path]/images/content_bg.png); background-repeat:repeat-x; background-attachment:scroll; background-position:0% 0%; background-color:#ffffff;', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','From here, you can change content background settings. can do detailed editing.','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Background Footer','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('background','background_footer','background-image:none; background-repeat:no-repeat; background-attachment:scroll; background-position:0% 0%; background-color:#363636;', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','From here, you can change footer background settings. can do detailed editing.','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Background Copyright','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('background','background_copyright','background-image:url([path]/images/footer_bg.png); background-repeat:no-repeat; background-attachment:scroll; background-position:50% 0%; background-color:#000;', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','From here, you can change copyright background settings. can do detailed editing.','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Background PAGE TOP','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('background','background_top','background-image:url([path]/images/page_top_bg.png); background-repeat:repeat-x; background-attachment:scroll; background-position:0% 0%; background-color:#dddddd;', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','From here, you can change page top background settings. can do detailed editing.','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</tbody>
</table>
</div>
<div class="framework_band framework_bottom"><div class="framework_action"><input type="submit" name="action" value="save" class="form_submits save_options"><input type="submit" name="action" value="reset" class="form_submits reset_options" onclick="return confirm('Are you sure you want to reset ?');"></div></div>
</div>
<div class="tooltip_content">
<div class="tooltip_arrow">&nbps;</div>
<div class="tooltip_text">&nbps;</div>
</div>
</form><?php
}

function cs_color(){
?>
<form method="post"><div class="framework_wrapper">
<div class="framework_band framework_top"><div class="framework_logo"></div><div class="framework_action"><input type="submit" name="action" value="save" class="form_submits save_options"><input type="submit" name="action" value="reset" class="form_submits reset_options" onclick="return confirm('Are you sure you want to reset ?');"></div></div>
<div class="framework_content">
<table cellspacing="0" class="option_tables">
<tbody>
<tr>
<td>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('subheader','header-colors','Header Colors', false,'','none',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Text Color','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('colorpicker','header_text_color','#bbbbbb', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','Header content text color','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Link Color','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('colorpicker','header_link_color','#333333', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','Header link color','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Link Hover Color','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('colorpicker','header_link_hover_color','#ffc102', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','Header link hover color','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','DropDown Link Color','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('colorpicker','header_dropdown_link_color','#555555', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','Dropdown menu link color','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Dropdown Link hover color','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('colorpicker','header_dropdown_link_hover_color','#ffffff', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','Dropdown menu link hover color','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Dropdown Background Color','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('colorpicker','header_dropdown_link_bg_color','#f1f1f1', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','Dropdown menu background color.','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Dropdown Background Hover Color','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('colorpicker','header_dropdown_link_hover_bg_color','#aaaaaa', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','Dropdown link hover bg color','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('subheader','home-intro','Intro Content Colors', false,'','none',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Text Color','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('colorpicker','intro_text_color','#555555', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','Intro content text color','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Link Color','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('colorpicker','intro_link_color','#e8892f', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','Intro content link color','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Link Hover Color','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('colorpicker','intro_link_hover_color','#555555', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','Intro content link hover color','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Headers Color (H1,...,H6)','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('colorpicker','intro_headers_color','#555555', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','Intro Content typographies color from h1 to h6','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('subheader','page-colors','Page Content Colors', false,'','none',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Text Color','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('colorpicker','page_text_color','#555555', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','Page content text color','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Link Color','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('colorpicker','page_link_color','#e8892f', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','Page content link color','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Link Hover Color','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('colorpicker','page_link_hover_color','#555555', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','Page content link hover color','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Headers Color (H1,...,H6)','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('colorpicker','page_headers_color','#555555', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','Page Content typographies color from h1 to h6','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Divider Line Color','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('colorpicker','page_divider_color','#eeeeee', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','Divider line color, hr, hr with top and all lines.','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('subheader','footer-colors','Footer Colors', false,'','none',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Text Color','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('colorpicker','footer_text_color','#999999', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','Footer text color','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Link Color','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('colorpicker','footer_link_color','#cccccc', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','Footer link color','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Link Hover Color','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('colorpicker','footer_link_hover_color','#ffffff', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','Footer link hover color','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Headers Color (H1,...,H6)','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('colorpicker','footer_headers_color','#ffffff', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','Footer typographies color from h1 to h6','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('subheader','sub-header','Copyright Colors', false,'','none',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Text Color','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('colorpicker','copyright_text_color','#555555', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','Copyright text color','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Link Color','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('colorpicker','copyright_link_color','#e8892f', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','Copyright link color','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Link Hover Color','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('colorpicker','copyright_link_hover_color','#555555', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','Copyright link hover color','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('subheader','page-header','Page Header Colors', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Text Color','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('colorpicker','top_text_color','#555555', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','Page top (header) text color','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Link Color','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('colorpicker','top_link_color','#e8892f', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','Page top (header) link color','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Link Hover Color','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('colorpicker','top_link_hover_color','#555555', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','Page top (header) link hover color','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('subheader','slider-colors','Slider Colors', false,'','none',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Text Color','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('colorpicker','slider_text_color','', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','Slider default text color','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Link Color','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('colorpicker','slider_link_color','#88ac2e', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','Slider default link color','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Link Hover Color','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('colorpicker','slider_link_hover_color','#999999', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','Slider link hover color','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Headers Color (H1,...,H6)','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('colorpicker','slider_headers_color','', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','Slider typographies color from h1 to h6','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</tbody>
</table>
</div>
<div class="framework_band framework_bottom"><div class="framework_action"><input type="submit" name="action" value="save" class="form_submits save_options"><input type="submit" name="action" value="reset" class="form_submits reset_options" onclick="return confirm('Are you sure you want to reset ?');"></div></div>
</div>
<div class="tooltip_content">
<div class="tooltip_arrow">&nbps;</div>
<div class="tooltip_text">&nbps;</div>
</div>
</form><?php
}

function cs_font(){
?>
<form method="post"><div class="framework_wrapper">
<div class="framework_band framework_top"><div class="framework_logo"></div><div class="framework_action"><input type="submit" name="action" value="save" class="form_submits save_options"><input type="submit" name="action" value="reset" class="form_submits reset_options" onclick="return confirm('Are you sure you want to reset ?');"></div></div>
<div class="framework_content">
<table cellspacing="0" class="option_tables">
<tbody>
<tr>
<td>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('subheader','general-fonts','General Font Settings', false,'','none',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Font family','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('fonts','font_family','custom,google,@font-face', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','General body font family, for all pages.','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Font Size','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('slider_ui','font_size','12,100,1,px', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','General body font size, for all pages.','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Font Line Height','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('slider_ui','font_line_height','21,100,1,px', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','General body font line-height, for all pages.','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('subheader','header-menu-settonsg','Header Menu Font Settings', false,'','none',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Top Menu Font Family','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('fonts','top_menu_font_family','custom,google,@font-face', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','Top menu font family','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Top Menu Font Size','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('slider_ui','top_menu_font_size','17,100,1,px', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','Top menu font size','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Sub Menu Font Family','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('fonts','sub_menu_font_family','custom,google,@font-face', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','Sub menu font family','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Sub Menu Font Size','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('slider_ui','sub_menu_font_size','11,100,1,px', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','Sub menu font size','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('subheader','typography-font-size','Headings Font Settings', false,'','none',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Headings Font Family','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('fonts','headings_font_family','custom,google,@font-face', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','General typographies font family from h1 to h6','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','H1 Font Size','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('slider_ui','h1_font_size','32,100,1,px', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','H1 Font Size','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','H2 Font Size','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('slider_ui','h2_font_size','26,100,1,px', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','H2 Font Size','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','H3 Font Size','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('slider_ui','h3_font_size','20,100,1,px', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','H3 Font Size','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','H4 Font Size','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('slider_ui','h4_font_size','18,100,1,px', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','H4 Font Size','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','H5 Font Size','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('slider_ui','h5_font_size','16,100,1,px', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','H5 Font Size','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','H6 Font Size','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('slider_ui','h6_font_size','14,100,1,px', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','H6 Font Size','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Headings Line Height','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('slider_ui','headings_line_height','1,10,1,em', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','General typographies font line-height from h1 to h6','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('subheader','footer','Footer Font Settings', false,'','none',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Font Family','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('fonts','footer_font_family','custom,google,@font-face', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','From here, you can change footer font family.','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Font Size','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('slider_ui','footer_font_size','11,100,1,px', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','From here, you can change footer font size.','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</tbody>
</table>
</div>
<div class="framework_band framework_bottom"><div class="framework_action"><input type="submit" name="action" value="save" class="form_submits save_options"><input type="submit" name="action" value="reset" class="form_submits reset_options" onclick="return confirm('Are you sure you want to reset ?');"></div></div>
</div>
<div class="tooltip_content">
<div class="tooltip_arrow">&nbps;</div>
<div class="tooltip_text">&nbps;</div>
</div>
</form><?php
}

function cs_homepage(){
?>
<form method="post"><div class="framework_wrapper">
<div class="framework_band framework_top"><div class="framework_logo"></div><div class="framework_action"><input type="submit" name="action" value="save" class="form_submits save_options"><input type="submit" name="action" value="reset" class="form_submits reset_options" onclick="return confirm('Are you sure you want to reset ?');"></div></div>
<div class="framework_content">
<table cellspacing="0" class="option_tables">
<tbody>
<tr>
<td>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('subheader','home-page-slider','Home Page Slider Settings', false,'','none',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Home Page Slider','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('on_off_ui','home_slideshow','on', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','From here, you can enable or disable home page slideshow area.','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Home Page Slideshow','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('select','home_page_slider','[sliders],[all],[desc],[id]', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','Choose your slider for home page slideshow area.','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Custom Slider Area','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('textarea','custom_slider','', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','From here, you can put an custom slider shortcode or php code. <br />Ex. [unknowslider id=1]','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('subheader','home-page','Home Page Settings', false,'','none',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Home Page','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('select','home_page','[pages],[desc],[id]', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','From here, you can do a any page as home page. just page content will show on as homepage content.','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Home Page Layout','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('checkbox','home_page_layout','left,full,right', false,'','none','page_layout sidebar'); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','From here, you can add a slidebar for home page content area.','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Home Page Content','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tinymce','home_content','', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','Write your default home page content','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('subheader','home-page-intro','Home Page Intro Content Settings', false,'','none',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Home Page Intro','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('on_off_ui','homepage_intro','on', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','From here, you can enable or disable home page intro content area.','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Home Page Intro Content','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tinymce','intro_content','', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','Write your default home page intro content','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</tbody>
</table>
</div>
<div class="framework_band framework_bottom"><div class="framework_action"><input type="submit" name="action" value="save" class="form_submits save_options"><input type="submit" name="action" value="reset" class="form_submits reset_options" onclick="return confirm('Are you sure you want to reset ?');"></div></div>
</div>
<div class="tooltip_content">
<div class="tooltip_arrow">&nbps;</div>
<div class="tooltip_text">&nbps;</div>
</div>
</form><?php
}

function cs_footer(){
?>
<form method="post"><div class="framework_wrapper">
<div class="framework_band framework_top"><div class="framework_logo"></div><div class="framework_action"><input type="submit" name="action" value="save" class="form_submits save_options"><input type="submit" name="action" value="reset" class="form_submits reset_options" onclick="return confirm('Are you sure you want to reset ?');"></div></div>
<div class="framework_content">
<table cellspacing="0" class="option_tables">
<tbody>
<tr>
<td>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('subheader','footer-widget','Footer Widget Settings', false,'','none',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('full_text','footer_widget_models_info','Choose your footer widget model and go to <a href="widgets.php">Widgets</a> page for widget modifications.', false,'','none',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Footer Widget Area','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('on_off_ui','footer_widget_area','on', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','From here, you can enable or disable footer widget area','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Footer Widget Model','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('checkbox','footer_widget_model','model1,model2,model3,model4,model5,model6,model7,model8,model9,model10,model11,model12,model13,model14,model15,model16', false,'','none','footer_widget_model'); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','Choose your footer widget model','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Footer Widgets Before','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('on_off_ui','footer_widget_before','off', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','From here, adding a widget before Footer Widgets and you can see it as a new widget area from widgets manager','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Footer Widgets After','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('on_off_ui','footer_widget_after','off', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','From here, adding a widget after Footer Widgets and you can see it as a new widget area from widgets manager','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('subheader','footer-copyrights','Footer Copyright Settings', false,'','none',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Footer Copyright Area','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('on_off_ui','footer_copyright_area','on', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','From here, you can enable or disable footer copyright area','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Footer Copyright Text','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('textarea','copyright','', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','Footer copyright text','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</tbody>
</table>
</div>
<div class="framework_band framework_bottom"><div class="framework_action"><input type="submit" name="action" value="save" class="form_submits save_options"><input type="submit" name="action" value="reset" class="form_submits reset_options" onclick="return confirm('Are you sure you want to reset ?');"></div></div>
</div>
<div class="tooltip_content">
<div class="tooltip_arrow">&nbps;</div>
<div class="tooltip_text">&nbps;</div>
</div>
</form><?php
}

function cs_blog(){
?>
<form method="post"><div class="framework_wrapper">
<div class="framework_band framework_top"><div class="framework_logo"></div><div class="framework_action"><input type="submit" name="action" value="save" class="form_submits save_options"><input type="submit" name="action" value="reset" class="form_submits reset_options" onclick="return confirm('Are you sure you want to reset ?');"></div></div>
<div class="framework_content">
<table cellspacing="0" class="option_tables">
<tbody>
<tr>
<td>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('header','blog_general','Blog Page Settings (Default)', false,'','none',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Blog Page','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('select','blog_page','[pages]', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','Choose your default blog page. If you need multiple blog pages use blog shortcode.','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Blog Page Layout','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('checkbox','blog_page_layout','left,full,right', false,'','none','sidebar'); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','Default sidebar for blog pages.','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Column Layout','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('select','blog_columns','1,2,3,4,5,6', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','From here, you can choose a column type for blog page posts. default is no any column.','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Featured Image Layout','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('checkbox','blog_featured_image','left,full,right', false,'','none','layout'); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','From here, you can change featured image position. default is full.','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Featured Image for Lightbox','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('on_off_ui','blog_featured_lightbox','off', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','From here, you can enable or disable for featured image lightbox effect.','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Display Full Blog Posts','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('on_off_ui','blog_full_text','off', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','From here, you can show all posts content below featured image. if you disable it, Excerpt contents will active automatically.','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Post Tags','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('on_off_ui','blog_post_tags','on', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','From here, you can hidden post tags.','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Exclude Categories for blog page','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('checkbox','blog_exclude','[categories],[category],[all],[desc],[id]', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','Usually all categories are show on the blog page. and from here, you can exclude any of these categories.','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Gap Between Posts','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('slider_ui','blog_between','50,500,1,px', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','Gap between posts, also this is default. it will be same all of blog posts.','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Blog Read More Text','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('input','blog_read_more','Read More', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','From here, you can translate blog page read more text.','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('subheader','blog_floats','Left and Right Float Featured Image Sizes', false,'','none',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Image width','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('slider_ui','blog_image_width','300,960,1,px', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','if the above is selected left or right image layout. you can change width of the image.','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Image Height','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('slider_ui','blog_image_height','200,960,1,px', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','if the above is selected left or right image layout. you can change height of the image.','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('subheader','blog_full','Full Width Featured Image Size', false,'','none',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Image Height','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('slider_ui','blog_fixed_height','300,1000,1,px', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','if the above is selected full image layout. just you can change height of the image.','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('header','blog_single','Blog Single Page Settings', false,'','none',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Single Page Layout','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('checkbox','blog_single_layout','left,full,right', false,'','none','sidebar'); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','Default blog posts single page sidebar layout type. it will be same all the blog single pages.','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Single Featured Image','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('on_off_ui','blog_single_featured','off', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','From here, you can enable or disable featured image on blog single page.','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Single Featured Image Layout','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('checkbox','blog_single_featured_image_layout','left,full,right', false,'','none','layout'); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','From here, you can change featured image position. ','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Single Featured Image for Lightbox','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('on_off_ui','blog_single_featured_lightbox','on', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','From here, you can enable or disable for featured image lightbox effect.','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Previous & Next Navigation','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('on_off_ui','blog_single_navigation','off', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','From here, you can enable or disable previous & next posts navigation.','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</tbody>
</table>
</div>
<div class="framework_band framework_bottom"><div class="framework_action"><input type="submit" name="action" value="save" class="form_submits save_options"><input type="submit" name="action" value="reset" class="form_submits reset_options" onclick="return confirm('Are you sure you want to reset ?');"></div></div>
</div>
<div class="tooltip_content">
<div class="tooltip_arrow">&nbps;</div>
<div class="tooltip_text">&nbps;</div>
</div>
</form><?php
}

function cs_portfolio(){
?>
<form method="post"><div class="framework_wrapper">
<div class="framework_band framework_top"><div class="framework_logo"></div><div class="framework_action"><input type="submit" name="action" value="save" class="form_submits save_options"><input type="submit" name="action" value="reset" class="form_submits reset_options" onclick="return confirm('Are you sure you want to reset ?');"></div></div>
<div class="framework_content">
<table cellspacing="0" class="option_tables">
<tbody>
<tr>
<td>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('header','portfolio_head','Portfolio Page Settings (Default)', false,'','none',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Portfolio Page','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('select','portfolio_page','[pages]', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','Choose your default portfolio page. If you need multiple blog pages use portfolio shortcode.','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Portfolio Page Categories','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('checkbox','portfolio_cats','[categories],[all],[desc],[id]', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','From here, you can choose your portfolio category. also you can set multiple categories.','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Column Layout','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('select','portfolio_columns','1,2,3,4,5,6', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','From here, you can choose a column type for portfolio page. default column type is 3.','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Number of Posts to Show Per Page','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('slider_ui','portfolio_count','9,50,1,item', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','From here, you can choose number of posts to show per page for portfolio page.','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Display Title','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('on_off_ui','portfolio_display_title','on', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','From here, you can enable or disable portfolio post title.','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Display Title as Link','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('on_off_ui','portfolio_display_link','off', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','From here, you can enable or disable portfolio post title link. This link is for the post single page.','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Display Description','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('on_off_ui','portfolio_display_description','on', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','From here, you can enable or disable short description for portfolio posts.','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Portfolio Full Text','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('on_off_ui','portfolio_full_text','off', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','From here, you can enable or disable all content of the portfolio post. it is like full description.','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('subheader','read_more_header','Read More', false,'','none',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Display Read More','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('on_off_ui','portfolio_display_more','on', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','From here, you can enable or disable read more text or button.','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Display as button','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('on_off_ui','portfolio_read_as_button','off', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','From here, you can do read more text as button.','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Read More','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('input','portfolio_read_more_text','Reading...', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','From here, you can translate portfolio read more text.','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('subheader','portfolio_height','Height of Thumbnail', false,'','none',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','One (1) Column','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('slider_ui','portfolio_height_1','300,1000,1,px', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','One column image height.','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Two (2) Columns','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('slider_ui','portfolio_height_2','200,1000,1,px', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','Two columns image height.','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Three (3) Columns','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('slider_ui','portfolio_height_3','200,1000,1,px', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','Three columns image height.','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Four (4) Columns','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('slider_ui','portfolio_height_4','150,1000,1,px', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','Four columns image height.','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Five (5) Columns','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('slider_ui','portfolio_height_5','100,1000,1,px', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','Five columns image height.','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Six (6) Columns','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('slider_ui','portfolio_height_6','75,1000,1,px', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','Six columns image height.','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('header','portfolio_single_head','Portfolio Single Page Settings', false,'','none',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Select categories used in the portfolio (optional)','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('checkbox','portfolio_single_cats','[categories],[all],[desc],[id]', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','This option required for portfolio shortcode single pages. it is important for portfolio single page. if you are using a portfolio page as shortcode.','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Single Page Layout','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('checkbox','portfolio_single_layout','left,full,right', false,'','none','sidebar'); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','Default portfolio posts single page sidebar layout type. it will be same all the portfolio single pages.','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Single Featured Image','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('on_off_ui','portfolio_single_featured','off', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','From here, you can enable or disable featured image on portfolio single page.','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Single Featured Image Height','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('slider_ui','portfolio_single_height','300,1000,1,px', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','From here, you can change portfolio single featured image height.','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</tbody>
</table>
</div>
<div class="framework_band framework_bottom"><div class="framework_action"><input type="submit" name="action" value="save" class="form_submits save_options"><input type="submit" name="action" value="reset" class="form_submits reset_options" onclick="return confirm('Are you sure you want to reset ?');"></div></div>
</div>
<div class="tooltip_content">
<div class="tooltip_arrow">&nbps;</div>
<div class="tooltip_text">&nbps;</div>
</div>
</form><?php
}

function cs_advanced(){
?>
<form method="post"><div class="framework_wrapper">
<div class="framework_band framework_top"><div class="framework_logo"></div><div class="framework_action"><input type="submit" name="action" value="save" class="form_submits save_options"><input type="submit" name="action" value="reset" class="form_submits reset_options" onclick="return confirm('Are you sure you want to reset ?');"></div></div>
<div class="framework_content">
<table cellspacing="0" class="option_tables">
<tbody>
<tr>
<td>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('subheader','responsive-design-set','Responsive Design Settings', false,'','none',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Responsive Design','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('on_off_ui','is_responsive','off', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','From here, you can disable or enable responsive design.','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('subheader','resize-settings','Custom Image Resize Settings', false,'','none',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Use TimThumb','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('on_off_ui','timthumb','off', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','From here, You can deactive timthumb resizer. if  you disable it, cstar custom image resizer will be active for your thumbnails.','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('subheader','home','Advanced Header Settings', false,'','none',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Home Translate','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('input','home_translate','Home', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','From here, you can translate Top menu "HOME" text.','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Exclude Page IDs (comma separated)','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('input','menu_exclude','', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','From here, you can exclude any of these menus. Ex. 1,2,3','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('subheader','plugin-set','Advanced Plugin Settings', false,'','none',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','WP-PageNavi','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('on_off_ui','wp_pagenavi','on', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','From here, you can enable or disable WP-PageNavi plugin.','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','BreadCrumbs Plus','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('on_off_ui','site_breadcrumbs','on', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','From here, you can enable or disable BreadCrumbs Plus plugin.','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Auto-Lightbox Effect','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('on_off_ui','add_lightbox','on', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','From here, you can enable/disable Lightbox effect for all of content images. automatically lightbox!','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('subheader','button-settings','General Button Settings', false,'','none',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Button Color','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('select','button_color','blue,green,red,yellow,gray', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','From here, you can change all of button color, example: "post comment", "read more", "submit" and more buttons color.','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Button Size','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('select','button_size','xsmall,small,normal,medium,large,xlarge,xxlarge', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','From here, you can set general button size.','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('subheader','re-capt','reCAPTCHA Settings', false,'','none',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Public Key','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('input','recaptcha_public_key','', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','Using this in the JavaScript code that is served to your users.','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Private Key','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('input','recaptcha_private_key','', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','Using this when communicating between your server and our server. Be sure to keep it a secret.','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','reCAPTCHA Skin','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('select','recaptcha_skin','red,white,blackglass,clean', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','from here, you can use a different theme for re-captcha.','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','reCAPTCHA Error','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('input','recaptcha_error','<strong>Error</strong>: reCAPTCHA response was incorrect!', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','reCAPTCHA Error Message Translate.','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('full_text','re-captcha','You can create your keys from <a href="https://www.google.com/recaptcha/admin/create" target="_blank">Google - Create Re-Captcha Keys</a> and you will see re-captcha option on shortcode manager contact section, there is active/disable re-captcha.', false,'','none',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('subheader','othet-set','Other Settings', false,'','none',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Page Comments','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('on_off_ui','comment_page','off', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','From here, you can enable or disable all pages comment area.','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Post Comment','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('on_off_ui','comment_post','on', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','From here, you can enable or disable all posts comment area.','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Page Top Area','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('on_off_ui','page_top','on', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','From here, you can enable or disable all pages top area.','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Fix-Footer','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('on_off_ui','fix_footer','on', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','From here, you can enable or disable fix-footer features.','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','RTL Support','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('on_off_ui','rtl','off', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','From here, you can enable/disable rtl.css for RTL language support','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','PHP Error/Notice Reporting','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('on_off_ui','error_reporting','off', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','From here, you can enable php errors and notice disable... This option needed for theme support...','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('subheader','layout-settings','Boxed Layout Settings', false,'','none',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Boxed Layout ?','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('on_off_ui','layout_boxed','off', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','From here, you can set boxed layout..','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Box Shadow Opacity','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('slider_ui','layout_shadow_opacity','3,10,1,opacity,op', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','From here, you can set layout shadow.. if you want to disable it, set "0".','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Box Shadow Size','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('slider_ui','box_shadow_size','5,100,1,px', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','From here, you can set layout shadow size.','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Box max-width','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('slider_ui','box_max_width','1200,1500,1,px', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','From here you can set box max width.','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Box Top-Bottom Margin','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('slider_ui','box_margin','0,500,1,px', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','From here, you can set margin top and bottom between...','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('subheader','update-notifier','Theme Update Notifier', false,'','none',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="option_rows">
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td class="for_0"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('text','Update Notifier','', false,'','',''); ?></td></tr></table></td>
<td class="for_1"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('update','update_notifier','cstar_design', false,'','none',''); ?></td></tr></table></td>
<td class="for_2"><table cellspacing="0" cellpadding="0" width="100%"><tr><td><?php render_item('tooltip','From here, you can check current theme version.','', false,'','',''); ?></td></tr></table></td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</tbody>
</table>
</div>
<div class="framework_band framework_bottom"><div class="framework_action"><input type="submit" name="action" value="save" class="form_submits save_options"><input type="submit" name="action" value="reset" class="form_submits reset_options" onclick="return confirm('Are you sure you want to reset ?');"></div></div>
</div>
<div class="tooltip_content">
<div class="tooltip_arrow">&nbps;</div>
<div class="tooltip_text">&nbps;</div>
</div>
</form><?php
}

// Change number or products per row to 6
add_filter('loop_shop_columns', 'loop_columns');
if (!function_exists('loop_columns')) {
function loop_columns() {
return 6; // 6 products per row
}
}


add_filter('catalog_visibility_alternate_price_html', 'my_alternate_price_text', 10, 1);
function my_alternate_price_text($content) {
    return '<a href="' .get_permalink(woocommerce_get_page_id('myaccount')). '">Login</a> or <a href="'.site_url('/wp-login.php?action=register&redirect_to=' . get_permalink()).'">Register</a> to see price!';
}





/**
 * Add the field to the checkout
 **/
 /*
add_action('woocommerce_after_order_notes', 'my_custom_checkout_field');

function my_custom_checkout_field( $checkout ) {

    echo '<div id="my_custom_checkout_field"><h2>'.__('Choose a Pickup Location').'</h2>';

    woocommerce_form_field( 'my_field_name', array(
        'type'          => 'text',
        'class'         => array('my-field-class form-row-wide'),
        'label'         => __('Choose anyone location'),
        'placeholder'       => __('Enter something'),
        ), $checkout->get_value( 'my_field_name' ));

    echo '</div>';

}


add_action('woocommerce_after_order_notes', 'my_custom_checkout_field');

function my_custom_checkout_field($checkout) {
    echo '<div id="my_custom_checkout_field"><h3>'
        . __('Choose a Pickup Location') . '</h3>';

    woocommerce_form_field(
        'location', array(
            'type'     => 'select',
            'class'    => array('form-row-wide'),
            'required' => true,
            'label'    => __('choose anyone location'),
            'options'  => array(
                'Campus' => __('Campus', 'woocommerce'),
                'Library'   => __('Library', 'woocommerce'),
                'Food Court'  => __('Food Court', 'woocommerce')
            )
        ),
        $checkout->get_value('points_go_to')
    );

    echo '</div>';
}
*/
// Redefine woocommerce_output_related_products()
function woocommerce_output_related_products() {
woocommerce_related_products(4,4); // Display 3 products in rows of 3
}

    //Finally, save our extra registration user meta.
    add_action('user_register', 'myplugin_user_register');
    function myplugin_user_register ($user_id) {
		if ( isset( $_POST['first_name'] ) )
            update_user_meta($user_id, 'first_name', $_POST['first_name']);
		if ( isset( $_POST['last_name'] ) )
            update_user_meta($user_id, 'last_name', $_POST['last_name']);	
        if ( isset( $_POST['rpr_school'] ) )
            update_user_meta($user_id, 'rpr_school', $_POST['rpr_school']);
		if ( isset( $_POST['rpr_program'] ) )
            update_user_meta($user_id, 'rpr_program', $_POST['rpr_program']);	
    }


// Hook in
add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );

// Our hooked in function - $fields is passed via the filter!
function custom_override_checkout_fields( $fields ) {
	$fields['order']['rpr_school']['label'] = 'School Name';
    $fields['order']['rpr_school']['placeholder'] = 'School Name';
	$fields['order']['rpr_program']['label'] = 'Program';
	$fields['order']['rpr_program']['placeholder'] = 'Program';
    return $fields;
}	



/*This code for remove form price*/
/*
add_filter('woocommerce_variable_price_html','custom_from',10);
add_filter('woocommerce_grouped_price_html','custom_from',10);
add_filter('woocommerce_variable_sale_price_html','custom_from',10);
function custom_from($price){
	return false;
}
*/
/*
function patricks_custom_variation_price( $price, $product ) {
 
	$target_product_types = array( 
		'variable' 
	);
 
	if ( in_array ( $product->product_type, $target_product_types ) ) {
		// if variable product return and empty string
		return '';
	}
 
	// return normal price
	return $price;
}
add_filter('woocommerce_get_price_html', 'patricks_custom_variation_price', 10, 2);
*/

/*This code for remove form price*/

// Woocommerce New Customer Admin Notification Email
add_action('woocommerce_created_customer', 'admin_email_on_registration');
function admin_email_on_registration() {
    $user_id = get_current_user_id();
    wp_new_user_notification( $user_id );
}


?>