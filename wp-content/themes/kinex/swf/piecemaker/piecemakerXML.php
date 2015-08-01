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
$timthumb       	= $settings["s_timthumb"];


$slides  = '';
$quality	= 100;
foreach($get_slides as $item){
   
   $value 				= unserialize($item->s_value);
   $content        	= @$value["s_content"];
   $link_type        = @$value["_post_link"];
   $link_page        = @$value["_post_link_page"];
   $link_category    = @$value["_post_link_category"];
   $link_post        = @$value["_post_link_post"];
   $link_custom      = @$value["_s_link_custom"];
   $link_target      = @$value["_s_link_target"];
   
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
   
   
   $link_target    = ($link_target)?$link_target:'_self';
   $link_href      = ($link_href)?'<Hyperlink URL="'.$link_href.'" Target="'.$link_target.'" />':'';
   $content        = ($content)?'<Text>&lt;h1&gt;'.$item->s_name.'&lt;/h1&gt;&lt;p&gt;'.$content.'&lt;/p&gt;</Text>':'';
   
	$image_src		= ($timthumb == 'on')?get_the_image( 'url', $value['s_image'], array($width,$height) ):$value['s_image'];

   $slides        .= '<Image Source="'.$image_src.'" Title="'.$item->s_name.'">';
   $slides        .= $content.$link_href;
   $slides        .= '</Image>';
}

$output = <<<XML
<?xml version="1.0" encoding="utf-8"?>
<Piecemaker>
   <Contents>
	{$slides}
   </Contents>
   <Settings ImageWidth="{$width}" ImageHeight="{$height}" LoaderColor="0x333333" InnerSideColor="0x222222" SideShadowAlpha="0.8" DropShadowAlpha="0.7" DropShadowDistance="15" DropShadowScale="0.95" DropShadowBlurX="40" DropShadowBlurY="10" MenuDistanceX="20" MenuDistanceY="50" MenuColor1="0x999999" MenuColor2="0x333333" MenuColor3="0xFFFFFF" ControlSize="100" ControlDistance="20" ControlColor1="0x222222" ControlColor2="0xFFFFFF" ControlAlpha="0.8" ControlAlphaOver="0.95" ControlsX="450" ControlsY="280&#xD;&#xA;" ControlsAlign="center" TooltipHeight="30" TooltipColor="0x222222" TooltipTextY="5" TooltipTextStyle="P-Italic" TooltipTextColor="0xFFFFFF" TooltipMarginLeft="5" TooltipMarginRight="7" TooltipTextSharpness="50" TooltipTextThickness="-100" InfoWidth="400" InfoBackground="0xFFFFFF" InfoBackgroundAlpha="0.95" InfoMargin="15" InfoSharpness="0" InfoThickness="0" Autoplay="{$delay}" FieldOfView="45"></Settings>
	<Transitions>
      <Transition Pieces="9" Time="1.2" Transition="easeInOutBack" Delay="0.1" DepthOffset="300" CubeDistance="30"></Transition>
      <Transition Pieces="15" Time="3" Transition="easeInOutElastic" Delay="0.03" DepthOffset="200" CubeDistance="10"></Transition>
      <Transition Pieces="5" Time="1.3" Transition="easeInOutCubic" Delay="0.1" DepthOffset="500" CubeDistance="50"></Transition>
      <Transition Pieces="9" Time="1.25" Transition="easeInOutBack" Delay="0.1" DepthOffset="900" CubeDistance="5"></Transition>
   </Transitions>
</Piecemaker>
XML;
header("Content-type: text/xml");
echo $output;
?>