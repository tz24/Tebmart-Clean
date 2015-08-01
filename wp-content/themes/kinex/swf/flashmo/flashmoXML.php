<?php
/* Start WordPress */
$parse_uri = explode('wp-content', $_SERVER['SCRIPT_FILENAME']);
$wp_load = $parse_uri[0].'wp-load.php';
require_once($wp_load);
	
global $wpdb;
$uri              = T_URI;
$id               = @$_REQUEST["id"];
$item_table       = $wpdb->prefix . "slider_items";;
$category_table   = $wpdb->prefix . "slider_categories";

$get_slides			= $wpdb->get_results("SELECT * FROM " . $item_table . " WHERE c_id REGEXP '(^".$id.",)|(,".$id."$)|(,".$id.",)|^".$id."$' ORDER BY orderby DESC");
$get_slider			= $wpdb->get_row( $wpdb->prepare("SELECT * FROM " . $category_table . " WHERE id = %d", $id) );

$settings         = unserialize($get_slider->c_value);
$width            = $settings['s_width'];
$height           = $settings['s_height'];
$delay            = $settings['s_delay'];
$timthumb         = $settings['s_timthumb'];
$autoplay         = ($delay == 0)?'false':'true';
$border         	= ($settings['s_border'] == 'on')?'true':'false';


$slides	= '';
$quality	= 100;
foreach($get_slides as $item){

   $value 				= unserialize($item->s_value);
   $link_type        = @$value["_post_link"];
   $link_page        = @$value["_post_link_page"];
   $link_category    = @$value["_post_link_category"];
   $link_post        = @$value["_post_link_post"];
   $link_custom      = @$value["_post_link_custom"];
   $link_target      = @$value["_post_link_target"];

   if($link_type == 'page' && !empty($link_page)){
      $link_href = get_page_link($link_page);
   }else if($link_type == 'category' && !empty($link_category)){
      $link_href = get_category_link($link_category);
   }else if($link_type == 'post' && !empty($link_post)){
      $link_href = get_permalink($link_post);
   }else if($link_type == 'custom'){
      $link_href = $link_custom;
   }else{
      $link_href = '';
   }


   $link_href   = ($link_href)?'<url>'.$link_href.'</url>':'';
   $link_target   = ($link_target)?'<target>'.$link_target.'</target>':'';


	$image_src		= ($timthumb == 'on')?get_the_image( 'url', $value['s_image'], array($width,$height) ):$value['s_image'];

   $slides  .= '<photo>';
   $slides  .= '<filename>'.$image_src.'</filename>';
   $slides  .= $link_href.$link_target;
   $slides  .= '</photo>';
}
$output = <<<XML
<?xml version="1.0" encoding="utf-8"?>
<photos>
<config hover_effect="true" border_effect="{$border}" auto_play="{$autoplay}" auto_play_duration="{$delay}" tween_duration="0.72" tween_delay="0.16" />
{$slides}
</photos>
XML;
header("Content-type: text/xml");
echo $output;
?>